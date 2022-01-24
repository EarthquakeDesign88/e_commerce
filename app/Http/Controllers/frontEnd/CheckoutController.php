<?php

namespace App\Http\Controllers\frontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Shipping;
use App\Models\Order;
use Gloudemans\Shoppingcart\ShoppingcartServiceProvider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;


class CheckoutController extends Controller
{
    public function checkout1()
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        $user = Auth::user();
        return view('frontEnd.checkout.checkout1', compact('categories', 'user'));
    }

  
    public function checkout2(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|required|exists:users,email',
            'phone' => 'required',
            'country' => 'required|nullable',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required|nullable',
            'postcode' => 'required|numeric|nullable',
            // 'note' => 'required|nullable',
        ]);

        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        $shippings = Shipping::where(['status'=>'active'])->orderBy('shipping_address', 'ASC')->get();

        Session::put('checkout', [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postcode' => $request->postcode,
            'note' => $request->note,
            'sub_total' => $request->sub_total,
            'total_amount' => $request->total_amount,
        ]);

        return view('frontEnd.checkout.checkout2', compact('categories', 'shippings'));
    }


    public function checkout3(Request $request)
    {
        // dd($request->all());
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        $request->validate([
            'delivery_charge' => 'required'
        ]);

 
        Session::push('checkout', [
            'delivery_charge' => $request->delivery_charge
        ]);


        return view('frontEnd.checkout.checkout3', compact('categories'));
    }

    public function checkout4(Request $request)
    {
        $request->validate([
            'payment_method' => 'string|required',
            'payment_status' => 'string|in:paid,unpaid',
        ]);

        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        
        Session::push('checkout', [
            'payment_method' => $request->payment_method,
            'payment_status' => 'unpaid',
        ]);

        // dd(Session::get('checkout'));
        return view('frontEnd.checkout.checkout4', compact('categories'));
    }

    public function  confirmationCheckout()
    {
        $date = date('Y-m-d H:i:s');
        $order = new Order();
        $order['user_id'] = Auth()->user()->id;
        $order['order_number'] = Str::upper('ES-'.Str::random(7));
        $order['order_status'] = 'pending';
        $order['order_date'] = $date;

        // dd(Session::get('checkout'));
        $order['sub_total'] = Session::get('checkout')['sub_total'];
        $order['delivery_charge'] = Session::get('checkout')[0]['delivery_charge'];
        

        if(Session::has('coupon')) {
            $order['coupon'] = Session::get('coupon')['value'];
        } else {
            $order['coupon'] = 0;
        }

        $order['total_amount'] = (float)Session::get('checkout')['sub_total'] + Session::get('checkout')[0]['delivery_charge'] - $order['coupon'];
        $order['payment_method'] = Session::get('checkout')[1]['payment_method'];
        $order['payment_status'] = Session::get('checkout')[1]['payment_status'];

        $order['first_name'] = Session::get('checkout')['first_name'];
        $order['last_name'] = Session::get('checkout')['last_name'];
        $order['email'] = Session::get('checkout')['email'];
        $order['phone'] = Session::get('checkout')['phone'];
        $order['country'] = Session::get('checkout')['country'];
        $order['city'] = Session::get('checkout')['city'];
        $order['address'] = Session::get('checkout')['address'];
        $order['state'] = Session::get('checkout')['state'];
        $order['postcode'] = Session::get('checkout')['postcode'];
        $order['note'] = Session::get('checkout')['note'];
      
        $status = $order->save();
        if($status) {
            session()->put('order_id', $order->id);
        }

        
        foreach(Cart::instance('shopping')->content() as $item) {
            $product_id[] = $item->id;
            $product = Product::find($item->id);
            $quantity = $item->qty;
            $order->products()->attach($product, ['quantity'=>$quantity]);

            $stock = $product->stock - $quantity;

            // $stock = $product->stock;
            // $stock -= $quantity;
          
             $update_stock = DB::table('products')->where('id', $product_id)
            ->update(['stock' =>  $stock]);

        }

        if($order['payment_method'] == 'pol') {
            $pol = new PayOnlineController;
            return $pol->getCheckout();
        }

        elseif($order['payment_method'] == 'paypal') {
            $paypal = new PaypalController;
            return $paypal->getCheckout();
        }

        if($status) {
            Mail::to($order['email'])->bcc($order['semail'])->send(new OrderMail($order));
            Cart::instance('shopping')->destroy();
            Session::forget('coupon');
            Session::forget('checkout');
            return redirect()->route('successfullyCheckout', $order['order_number']);
        } else {
            return redirect()->route('checkout1')->with('error', 'Please try again.');
        }
        
        
    }


    public function successfullyCheckout($order)
    {    
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        $order = $order;
        return view('frontEnd.checkout.success-checkout', compact('order', 'categories'));
    }


}
