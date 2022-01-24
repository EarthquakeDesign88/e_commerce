<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    public function showCoupons()
    {
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('backEnd.coupons.viewCoupons', compact('coupons'));
    }

    public function createCoupon()
    {
        return view('backEnd.coupons.createCouponForm');
    }

    public function insertCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'status' => 'nullable|in:active,inactive',
        ]);

        $data = $request->all();
        $status = Coupon::create($data);

        if($status) {
            return redirect('/admin/coupons')->with('success', 'Coupon has been created successfully.');
        }else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function editCoupon($id) 
    {
        $coupon = Coupon::find($id);
        
        if($coupon) {
            return view('backEnd.coupons.editCouponForm', compact('coupon'));
        }else {
            return back()->with('error', 'Data not found');
        }
    }

    public function updateCoupon(Request $request, $id) 
    {
        $coupon = Coupon::find($id);
        
        if($coupon) {
            $request->validate([
                'code' => 'required',
                'type' => 'required|in:fixed,percent',
                'value' => 'required|numeric',
                'status' => 'nullable|in:active,inactive',
            ]
            );
    
            $data = $request->all();
            $status = $coupon->fill($data)->save();
    
            if($status) {
                return redirect('/admin/coupons')->with('success', 'Coupon has been updated successfully.');
            }else {
                return back()->with('error', 'Something went wrong!');
            }
        }else {
            return back()->with('error', 'Data not found');
        }
       
    }

    public function deleteCoupon($id) {
        $coupon = Coupon::find($id);

        if($coupon) {
            $status = $coupon->delete();
            if($status) {
                return redirect('/admin/coupons')->with('success', 'Coupon has been deleted successfully.');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        }
    }


    public function couponChangeStatus(Request $request) 
    {
        if($request->mode == 'true') {
            $id = $request->id;
            DB::table('coupons')->where('id', $id)->update(['status' => 'active']);
        }else {
            $id = $request->id;
            DB::table('coupons')->where('id', $id)->update(['status' => 'inactive']);
        }
        return response()->json(['message' => 'Status has been updated successfully.', 'status' => true]);
    }
}
