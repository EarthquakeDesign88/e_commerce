@extends('frontEnd.layouts.master')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">

@section('content')

    <div class="container">
        <div class="box">
            <div class="breadcumb">
                <a href="{{ route('showHomepage') }}">Home</a>
                <span><i class='bx bxs-chevrons-right'></i></span>
                <a href="#" class="{{request()-> routeIs('checkout3')? 'active' : '' }}">Payment</a>
            </div>
        </div>
    </div>

    @include('frontEnd.layouts.progress_bar')

    {{-- @if ($errors->any())          
    <div class="container">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          
            @foreach ($errors->all() as $error)
                <li> {{ $error }}</li>
            @endforeach
       
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>  
        </div>
    </div>
    @endif --}}

   <form action="{{ route('checkout4') }}" method="post">
        @csrf
        <div class="container">
            <div class="col-md-12 order-details">
            <div class="section-title text-center">
                <h3 class="title">Select payment</h3>
            </div>
            <div class="order-summary">
                
            </div>
            <div class="payment-method">
                <div class="input-radio">
                    <input type="radio" name="payment_method" id="payment-1" value="pod">
                    <label for="payment-1">
                        <span></span>
                        Pay on delivery
                    </label>
                    <div class="caption">
                        <p><img src="{{ asset('images_template/pod.jpg') }}" width="180" height="120" alt="pay on delivery"> </p>
                    </div>
                </div>
                <div class="input-radio">
                    <input type="radio" name="payment_method" id="payment-2" value="pol">
                    <label for="payment-2">
                        <span></span>
                        Pay online
                    </label>
                    <div class="caption">
                        <p><img src="{{ asset('images_template/omise.jpg') }}" width="180" height="80" alt="pay online"> </p>
                    </div>
                </div>
                <div class="input-radio">
                    <input type="radio" name="payment_method" id="payment-3" value="paypal">
                    <label for="payment-3">
                        <span></span>
                        Paypal
                    </label>
                    <div class="caption">
                        <p><img src="{{ asset('images_template/paypal.png') }}" width="180" height="60" alt="paypal"> </p>
                    </div>
                </div>
            </div>
          
        
        </div>
        <!-- /Order Details -->
    
            <div class="total_area">
                <a class="primary-btn cta-btn fload-right" href="{{ route('checkout2') }}">Go back</a>
                <button type="submit" class="primary-btn cta-btn">Continue</button>
            </div>
        </div>    
   </form>
    


@endsection

