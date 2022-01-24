<?php

namespace App\Http\Controllers\frontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\ShoppingcartServiceProvider;
use Gloudemans\Shoppingcart\Facades\Cart;


class WishlistController extends Controller
{
    public function showWishlist()
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        return view('frontEnd.wishlist', compact('categories'));
    }

    public function wishlistStore(Request $request)
    {
        
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        $product = Product::getProductByWishlist($product_id);
        $product_price = $product[0]['offer_price'];

        $wishlist_array = [];

        foreach(Cart::instance('wishlist')->content() as $item) {
            $wishlist_array[] = $item->id;
        }

        if(in_array($product_id, $wishlist_array)) {
            $response['present'] = true;
            $response['message'] = "Item is already in your wishlist";
        } else {
            $result = Cart::instance('wishlist')->add($product_id, $product[0]['title'], $product_qty, $product_price)->associate('App\Models\Product');
            if($result) {
                $response['status'] = true;
                $response['message'] = "Item has been saved in wishlist";
                $response['wishlist_count'] = Cart::instance('wishlist')->count();
            }
        }

        return json_encode($response);
      
        
       
    }

    public function deleteFromWishlist(Request $request)
    {
        $id = $request->input('cart_id');
        Cart::instance('wishlist')->remove($id);
        $response['status'] = true;
        $response['wishlist_count'] = Cart::instance('wishlist')->count();
        $response['message'] = "Wishlist successfully removed";

        return json_encode($response);
    }

    public function wishlistMoveToCart(Request $request)
    {
        $id = $request->input('rowId');
        $item = Cart::instance('wishlist')->get($id);
        Cart::instance('wishlist')->remove($id);

        $result = Cart::instance('shopping')->add($item->id, $item->name, 1, $item->price)->associate('App\Models\Product');

        if($result) {
            $response['status'] = true;
            $response['cart_count'] = Cart::instance('shopping')->count();
            $response['message'] = "Item has been moved to a cart";
        }
        return json_encode($response);

        // if($request->ajax()) {
        //     $wishlist = view('frontEnd.layouts.wistlist_list')->render();
        //     $header = view('frontEnd.layouts.header')->render();
        //     $response['wishlist_list'] = $wishlist;
        //     $response['header'] = $header;
        // }
        // return $response; 
    }
}
