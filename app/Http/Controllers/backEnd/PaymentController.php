<?php

namespace App\Http\Controllers\backEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function showPaypalTransactions()
    {
        $paypal = DB::table('paypal_transactions')->get();
        return view('backend.paypal.viewPaypal', compact('paypal'));
    }

    public function showOmiseTransactions()
    {
        $omise = DB::table('omise_transactions')->get();
        return view('backend.omise.viewOmise', compact('omise'));
    }
}
