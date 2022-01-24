<?php

namespace App\Http\Controllers\frontEnd;

use OmiseCharge;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use Gloudemans\Shoppingcart\ShoppingcartServiceProvider;
use OmiseCard;

class PayOnlineController extends Controller
{
    public function getCheckout()
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
       
        $order = Order::findOrFail(session()->get('order_id'));
        $amount = $order->total_amount *100;
        
        if($order['payment_status'] == 'unpaid'){
            return view('frontEnd.checkout.polCheckout', compact('order','categories', 'amount'));
        } else {
            return redirect('/');
        }
    }

    public function responsePOLPayment(Request $request)
    {
        define('OMISE_PUBLIC_KEY', env('OMISE_PUBLIC_KEY'));
        define('OMISE_SECRET_KEY', env('OMISE_SECRET_KEY'));

        $amount =  $request->input('total_amount') * 100;
        $order = Order::findOrFail(session()->get('order_id'));
        $order_number = $order->order_number;
        $payment_status = $order->payment_status;

        $charge = OmiseCharge::create(array(
            'amount' =>  $amount,
            'currency' => 'thb',
            'card' => $_POST["omiseToken"]
        ));


        $date = date('Y-m-d H:i:s');
        $newPayment =  array(
            'order_number' => $order_number,
            'amount' => $request->total_amount,
            'transaction_ref' => $charge['transaction'],
            'customer_name' => $charge['card']['name'],
            'card_brand' => $charge['card']['brand'],
            'last_digits' => $charge['card']['last_digits'],
            'transaction_date' => $date,
            'payment_status' => 'paid',
            'created_at' => $date
        );

       
     
        if($charge['status'] == 'successful') {
            
            $create_payment = DB::table('omise_transactions')
            ->insert($newPayment);

            $update_order = DB::table('orders')->where('order_number', '=', $order_number)
            ->update(['payment_status' =>  'paid',
                     'updated_at' => $date,
            ]);
            

            Cart::instance('shopping')->destroy();
            Session::forget('coupon');
            Session::forget('checkout');
            Mail::to($order['email'])->bcc($order['semail'])->send(new OrderMail($order));
            return redirect()->route('successfullyCheckout', $order['order_number']);
        }else {
            return redirect()->route('checkout1')->with('error', 'Please try again.');
        }

    }



}



