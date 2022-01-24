<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class CurrencyController extends Controller
{
    
    public function showCurrencies(Request $request)
    {
        $currencies = Currency::orderBy('id', 'DESC')->get();
        return view('backEnd.currencies.viewCurrencies', compact('currencies'));
    }

    public function createCurrency()
    {
        return view('backend.currencies.createCurrencyForm');
    }

    public function insertCurrency(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:currencies',
            'symbol' => 'required|nullable',
            'exchange_rate' => 'required|numeric|nullable',
            'code' => 'required|nullable',
            'status' => 'nullable|in:active,inactive',
        ]);

        $data = $request->all();

        $status = Currency::create($data);

        if($status) {
            return redirect('/admin/currencies')->with('success', 'Currency has been created successfully.');
        }else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function editCurrency($id) 
    {
        $currency = Currency::find($id);
        
        if($currency) {
            return view('backEnd.currencies.editCurrencyForm', compact('currency'));
        }else {
            return back()->with('error', 'Data not found');
        }
    }

    public function updateCurrency(Request $request, $id) 
    {
        $currency = Currency::find($id);
        
        if($currency) {
            $request->validate([
                'name' => 'required',
                'symbol' => 'required|nullable',
                'exchange_rate' => 'required|numeric|nullable',
                'code' => 'required|nullable',
                'status' => 'nullable|in:active,inactive',
            ]);
    
            $data = $request->all();
            $status = $currency->fill($data)->save();
    
            if($status) {
                return redirect('/admin/currencies')->with('success', 'Currency has been updated successfully.');
            }else {
                return back()->with('error', 'Something went wrong!');
            }
        }else {
            return back()->with('error', 'Data not found');
        }
       
    }

    public function deleteCurrency($id) {
        $currency = Currency::find($id);

        if($currency) {
            $status = $currency->delete();
            if($status) {
                return redirect('/admin/currencies')->with('success', 'Currency has been deleted successfully.');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        }
    }

    public function currencyChangeStatus(Request $request) 
    {
        if($request->mode == 'true') {
            $id = $request->id;
            DB::table('currencies')->where('id', $id)->update(['status' => 'active']);
        }else {
            $id = $request->id;
            DB::table('currencies')->where('id', $id)->update(['status' => 'inactive']);
        }
        return response()->json(['message' => 'Status has been updated successfully.', 'status' => true]);
    }
    
    public function currencyLoad(Request $request)
    {
        dd($request->all());
    }
}
