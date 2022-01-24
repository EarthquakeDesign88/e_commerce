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
use Gloudemans\Shoppingcart\ShoppingcartServiceProvider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;



class CartController extends Controller
{
    public function showCart()
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        return view('frontEnd.cart', compact('categories'));
    }


    public function cartStore(Request $request)
    {
      
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        $product = Product::getProductByCart($product_id);
        $product_price = $product[0]['offer_price'];

        $cart_array = [];

        foreach(Cart::instance('shopping')->content() as $item) {
            $cart_array[] = $item->id;
        }

        $result = Cart::instance('shopping')->add($product_id, $product[0]['title'], $product_qty, $product_price)->associate('App\Models\Product');

        if($result) {
            $response['status'] = true;
            $response['product_id'] = $product_id;
            $response['total'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
            $response['message'] = "Item was added to your cart";
        }
        
      
        
        return json_encode($response);
    }



    public function updateCart(Request $request) 
    {       
        $request->validate([
            'product_qty' => 'required|numeric',
        ]);


        $rowId = $request->input('rowId');
        $request_qty = $request->input('product_qty');
        $stock_qty = $request->input('stock_qty');

      
        if($request_qty < 1) {
            $response['message'] = "You can't add less than 1.";
            $response['status'] = false;
        }
        elseif($request_qty > $stock_qty) {
            $response['message'] = "We currently do not have enought items in stock.";
            $response['status'] = false;
        }
        else {
            Cart::instance('shopping')->update($rowId, $request_qty);
            $response['message'] = "Quantity was updated successful.";
            $response['status'] = true;
            $response['total'] = Cart::subtotal();
            $response['cart_count'] = Cart::instance('shopping')->count();
        }
        
  
        return json_encode($response);

    }


    public function deleteFromCart(Request $request)
    {
        $id = $request->input('cart_id');
        Cart::instance('shopping')->remove($id);
        $response['status'] = true;
        $response['total'] = Cart::subtotal();
        $response['cart_count'] = Cart::instance('shopping')->count();
        $response['message'] = "Item has been removed from a cart";

        // if($request->ajax()) {
        //     $header = view('frontEnd.layouts.header')->render();
        //     $response['header'] = $header;
        // }
        return json_encode($response);
    }


    //Coupon
    public function applyCoupon(Request $request) {
        $coupon = Coupon::where('code', $request->input('code'))->first();
        
        if(!$coupon) {
            return back()->with('error', 'Invalid coupon code, Please try again.');
        }
        if($coupon) {
            $total_price = (float)str_replace(',', '', Cart::instance('shopping')->subtotal());
            session()->put('coupon',[
                'id' => $coupon->id,
                'code' => $coupon->code,
                'value' => $coupon->discount($total_price),
            ]);

            return back()->with('success', 'Coupon applied successfully.');
        }
    }


    
   
 
}
