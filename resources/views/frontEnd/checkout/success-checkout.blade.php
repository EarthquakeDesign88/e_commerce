@extends('frontEnd.layouts.master')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">

@section('content')

    <div class="container">
        <div class="box">
            <div class="breadcumb">
                <a href="{{ route('showHomepage') }}">Home</a>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="col-md-12 order-details">
        <div class="section-title text-center">
            <h3 class="title mt-2 text-success">Your order has been placed.</h3>
            <p class="text-muted">You will receive an email of your order details.</p>
            <p class="text-success"><a href="{{ route('showOrderHistory') }}">Order number #{{ $order }}</a></p>
            
        </div>
    </div>    

    
@endsection

