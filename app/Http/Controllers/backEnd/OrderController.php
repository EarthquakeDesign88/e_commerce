<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use App\Models\Logistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function showOrders()
    {
        $orders = Order::orderBy('id', 'DESC')->get();
        return view('backEnd.orders.viewOrders', compact('orders'));
    }

    public function showOrderDetails($id)
    {
        $orderDetails = Order::find($id);
        $logistics = Logistic::where(['status'=>'active'])->orderBy('title', 'ASC')->get();
        
        if($orderDetails) {
            return view('backEnd.orders.viewOrderDetails', compact('orderDetails', 'logistics'));
        } else {
            return back()->with('error', 'Data not found');
        }
    }

    public function showInvoice($id)
    {
        $invoice = Order::find($id);
      
        if($invoice) {
            return view('backEnd.orders.invoice', compact('invoice'));
        } else {
            return back()->with('error', 'Data not found');
        }
    }

    public function updateOrderStatus(Request $request, $id) {
        $date = date('Y-m-d H:i:s');
        $status = $request->order_status;
        $invoice_no = mt_rand(1000000, 9999999);

        if($status == 'pending'){
            $order = DB::table('orders')->where('id', $id)
            ->update(['order_status' =>  $status,
                      'updated_at' =>$date,
                    ]);
            
             return back()->with('success', 'Order status has been updated to pending successfully.');
        } 
        else if($status == 'processing') {
            $order = DB::table('orders')->where('id', $id)
            ->update(['order_status' =>  $status,
                      'updated_at' => $date,
                     ]);

             return back()->with('success', 'Order status has been updated to processing successfully.');
        } 
        else if($status == 'delivered') {   
            $order = DB::table('orders')->where('id', $id)
            ->update(['order_status' =>  $status,
                      'updated_at' => $date,
                      'delivered_date' => $date,
                      'invoice_no' => $invoice_no,
                     ]);

             return back()->with('success', 'Order status has been updated to delivered successfully.');
        } 
        else if($status == 'cancelled') {
            $order = DB::table('orders')->where('id', $id)
            ->update([
                        'order_status' =>  $status,
                        'updated_at' => $date,
                        'cancelled_date' => $date,
                        'sub_total' => 0,
                        'total_amount' => 0,
                        'coupon' => 0,
                        'delivery_charge' => 0
                     ]);

            $orderDetails = DB::table('order_details')->where('order_id', $id)
            ->update([
                        'quantity' => 0
                    ]);

             return back()->with('success', 'Order status has been updated to cancelled successfully.');
        }
    }

    public function updateOrderTracking(Request $request, $id) {
        $request->validate([
            'tracking_code' => 'required|nullable',
        ]);

        $date = date('Y-m-d H:i:s');
        $logistics_type = $request->logistics_type;
        $tracking_code =  $request->tracking_code;

        if($logistics_type){
            $order = DB::table('orders')->where('id', $id)
            ->update([
                      'updated_at' =>$date,
                      'logistics_type' => $logistics_type,
                      'tracking_code' => $tracking_code
                    ]);
            return back()->with('success', 'Order tracking has been updated successfully.');
        } else {
            return back()->with('error', 'Something went wrong, please try again');
        }
    }


    public function settleOrder(Request $request, $id) {
        $date = date('Y-m-d H:i:s');

        $order = DB::table('orders')->where('id', $id)
        ->update(['order_status' => $request->order_status,
                  'payment_status' => $request->payment_status,
                  'updated_at' => $date,
                ]);
                
        return back()->with('success', 'Order status has been updated to completed successfully.');
    }

}

