<?php

namespace App\Http\Controllers\frontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Order;
use Gloudemans\Shoppingcart\ShoppingcartServiceProvider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;


class PaypalController extends Controller
{
    public function getCheckout()
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        $setPayment = Setting::select('paypal_sandbox')->first();
       
        $order = Order::findOrFail(session()->get('order_id'));
        $amount = $order->total_amount;
        
        $request = new OrdersCreateRequest();

        if($order['payment_status'] == 'unpaid'){
            return view('frontEnd.checkout.paypalCheckout', compact('order','categories'));
        } else {
            return redirect('/');
        }
 
    }


    public function responsePayment($paypalOrderID, $payerID) {
        $order = Order::findOrFail(session()->get('order_id'));
        $order_id = $order->id;
        $order_number = $order->order_number;
        $payment_status = $order->payment_status;
        $amount = $order->total_amount;


        if($payment_status == 'unpaid') {
            DB::table('orders')->where('order_number', $order_number)
            ->update(['payment_status' => 'paid']);

            $date = date('Y-m-d H:i:s');
            $newPayment =  array(
                'transaction_date' => $date,
                'amount' => $amount,
                'paypal_order_id' => $paypalOrderID,
                'payer_id' => $payerID,
                'order_number' => $order_number,
                'payment_status' => 'paid',
                'created_at' => $date
            );


            if($newPayment) {
                $create_Payment = DB::table('paypal_transactions')
                ->insert($newPayment);
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
}
