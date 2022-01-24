<?php

namespace App\Http\Controllers\backEnd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Shipping;
use App\Models\Logistic;


class ShippingController extends Controller
{
    public function showShippings()
    {
        $shippings = Shipping::orderBy('id', 'DESC')->get();
        return view('backEnd.shippings.viewShippings', compact('shippings'));
    }

    public function createShipping()
    {
        return view('backend.shippings.createShippingForm');
    }

    public function insertShipping(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required',
            'delivery_time' => 'required',
            'delivery_charge' => 'required|numeric|nullable',
            'status' => 'nullable|in:active,inactive',
        ]);

        $data = $request->all();

        $status = Shipping::create($data);

        if($status) {
            return redirect('/admin/shippings')->with('success', 'Shipping has been created successfully.');
        }else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function editShipping($id) 
    {
        $shipping = Shipping::find($id);
        
        if($shipping) {
            return view('backEnd.shippings.editShippingForm', compact('shipping'));
        }else {
            return back()->with('error', 'Data not found');
        }
    }

    public function updateShipping(Request $request, $id) 
    {
        $shipping = Shipping::find($id);
        
        if($shipping) {
            $request->validate([
                'shipping_address' => 'required',
                'delivery_time' => 'required',
                'delivery_charge' => 'required',
                'status' => 'nullable|in:active,inactive',
            ]);
    
            $data = $request->all();
            $status = $shipping->fill($data)->save();
    
            if($status) {
                return redirect('/admin/shippings')->with('success', 'Shipping has been updated successfully.');
            }else {
                return back()->with('error', 'Something went wrong!');
            }
        }else {
            return back()->with('error', 'Data not found');
        }
       
    }

    public function deleteShipping($id) {
        $shipping = Shipping::find($id);

        if($shipping) {
            $status = $shipping->delete();
            if($status) {
                return redirect('/admin/shippings')->with('success', 'Shipping has been deleted successfully.');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        }
    }

    public function shippingChangeStatus(Request $request) 
    {
        if($request->mode == 'true') {
            $id = $request->id;
            DB::table('shippings')->where('id', $id)->update(['status' => 'active']);
        }else {
            $id = $request->id;
            DB::table('shippings')->where('id', $id)->update(['status' => 'inactive']);
        }
        return response()->json(['message' => 'Status has been updated successfully.', 'status' => true]);
    }


    public function showLogistics(Request $request)
    {
        $logistics = Logistic::orderBy('id', 'DESC')->get();
        return view('backEnd.logistics.viewlogistics', compact('logistics'));
    }

    public function createLogistic()
    {
        return view('backend.logistics.createLogisticForm');
    }

    public function insertLogistic(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:logistics',
            'contact' => 'required|nullable',
            'link' => 'required|nullable',
            'status' => 'nullable|in:active,inactive',
        ]);

        $data = $request->all();

        $status = Logistic::create($data);

        if($status) {
            return redirect('/admin/logistics')->with('success', 'Logistic has been created successfully.');
        }else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function editLogistic($id) 
    {
        $logistic = Logistic::find($id);
        
        if($logistic) {
            return view('backEnd.logistics.editLogisticForm', compact('logistic'));
        }else {
            return back()->with('error', 'Data not found');
        }
    }

    public function updateLogistic(Request $request, $id) 
    {
        $logistic = Logistic::find($id);
        
        if($logistic) {
            $request->validate([
                'title' => 'required|nullable',
                'contact' => 'required|nullable',
                'link' => 'required|nullable',
                'status' => 'nullable|in:active,inactive',
            ]);
    
            $data = $request->all();
            $status = $logistic->fill($data)->save();
    
            if($status) {
                return redirect('/admin/logistics')->with('success', 'Logistic has been updated successfully.');
            }else {
                return back()->with('error', 'Something went wrong!');
            }
        }else {
            return back()->with('error', 'Data not found');
        }
       
    }

    public function deleteLogistic($id) {
        $logistic = Logistic::find($id);

        if($logistic) {
            $status = $logistic->delete();
            if($status) {
                return redirect('/admin/logistics')->with('success', 'Logistic has been deleted successfully.');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        }
    }

    public function logisticChangeStatus(Request $request) 
    {
        if($request->mode == 'true') {
            $id = $request->id;
            DB::table('logistics')->where('id', $id)->update(['status' => 'active']);
        }else {
            $id = $request->id;
            DB::table('logistics')->where('id', $id)->update(['status' => 'inactive']);
        }
        return response()->json(['message' => 'Status has been updated successfully.', 'status' => true]);
    }

}