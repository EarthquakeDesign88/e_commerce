<?php

namespace App\Http\Controllers\frontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\ProductReview;


class ProductReviewController extends Controller
{
    public function productReview(Request $request)
    {
        $this->validate($request, [
            'rate' => 'required|numeric',
            'reason' => 'required|string',
            'review' => 'required|string',
        ]);

        $data = $request->all();
        $status = ProductReview::create($data);
        if($status){
            return back()->with('success', 'Thanks for your feedback.');
        } else {
            return back()->with('error', 'Please try again!');
        }
    }
}
