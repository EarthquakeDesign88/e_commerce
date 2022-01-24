<?php

namespace App\Http\Controllers\backEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Category;


class DashboardController extends Controller
{
    public function adminDashboard() 
    {
        $orders = Order::all();
        $order_pending = DB::table('orders')
                ->where('order_status', '=', 'pending')
                ->get();

        $order_processing = DB::table('orders')
        ->where('order_status', '=', 'processing')
        ->get();

        $order_delivered = DB::table('orders')
        ->where('order_status', '=', 'delivered')
        ->get();

        $order_completed = DB::table('orders')
        ->where('order_status', '=', 'completed')
        ->get();

        $order_cancelled = DB::table('orders')
        ->where('order_status', '=', 'cancelled')
        ->get();

        $total_sales = DB::table('orders')->get()->sum("total_amount");
        $total_paid = DB::table('orders')->where('payment_status', '=', 'paid')->get()->sum("total_amount");
        $total_unpaid = DB::table('orders')->where('payment_status', '=', 'unpaid')->get()->sum("total_amount");

        $users = User::all();

        return view('backEnd.dashboard', compact([  'orders', 
                                                    'order_pending', 
                                                    'order_processing',
                                                    'order_delivered',
                                                    'order_completed',
                                                    'order_cancelled',
                                                    'total_sales',
                                                    'total_paid',
                                                    'total_unpaid',
                                                    'users',                                                          
                                                    ]));
    }
}
