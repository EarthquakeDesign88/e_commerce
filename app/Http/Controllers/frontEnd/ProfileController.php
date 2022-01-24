<?php

namespace App\Http\Controllers\frontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;

class ProfileController extends Controller
{
    public function userLogout()
    {
        Session::forget('user');
        Auth::logout();
        return redirect()->home()->with('success', 'Successfully logout');
    }

    public function showProfile()
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        $user =Auth::user();

        return view('frontEnd.user.profile', compact(['user','categories']));
    }

    public function updateProfile(Request $request)
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        $user = Auth::user();
        $id = $request->id;
        $user = DB::table('users')->where('id', $id)
        ->update([
           'full_name' => $request->full_name,
           'phone' => $request->phone
          ]);

    
        return redirect('/profile')->with('success', 'Your profile has been updated successfully.');
      
    }


    public function showAddress()
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        $user = Auth::user();
        return view('frontEnd.user.address', compact(['user', 'categories']));
    }

    public function updateAddress(Request $request)
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        $user = Auth::user();
        $id = $request->id;
        $user = DB::table('users')->where('id', $id)
        ->update([
           'address' => $request->address,
           'city' => $request->city,
           'state' => $request->state,
           'country' => $request->country,
           'postcode' => $request->postcode
          ]);

    
        return redirect('/address')->with('success', 'Your Address has been updated successfully.');
      
    }


    public function showOrderHistory()
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        $orders = DB::table('orders')->where('user_id', Auth::user()->id)
        ->orderBy('order_date','desc')->paginate(10); 

        return view('frontEnd.user.orderHistory', compact('categories', 'orders'));
    }

  
    public function searchOrderByDate(Request $request)
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        $startDate = $request->startDate;
        $endDate = $request->endDate;

        $orders = DB::table('orders')
        ->whereBetween('order_date',  [$startDate, $endDate])
        ->where('user_id', Auth::user()->id)
        ->orderBy('order_date','desc')->paginate(10); 


        return view('frontEnd.user.orderHistory', compact('categories', 'orders'));
    }

    public function cancelOrder(Request $request, $id)
    {
        $date = date('Y-m-d H:i:s');

        $order = DB::table('orders')->where('id', $id)
        ->update(['order_status' => $request->order_status,
                  'updated_at' => $date,
                  'sub_total' => 0,
                  'cancelled_date' => $date,
                  'total_amount' => 0,
                  'coupon' => 0,
                  'delivery_charge' => 0
                ]);

        $orderDetails = DB::table('order_details')->where('order_id', $id)
        ->update([
                    'quantity' => 0
                ]);
                
        return redirect('orderHistory')->with('success', 'Your order has been cancelled successfully.');
    }

    
    public function showHelp()
    {
        $categories = Category::where(['status'=>'active', 'is_parent'=> 1])->orderBy('title', 'ASC')->get();
        return view('frontEnd.user.help', compact('categories'));
    }


    
}
