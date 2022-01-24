@extends('frontEnd.layouts.master')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">

@section('content')

    <div class="container">
        <div class="box">
            <div class="breadcumb">
                <a href="{{ route('showHomepage') }}">Home</a>
                <span><i class='bx bxs-chevrons-right'></i></span>
                <a href="#" class="{{request()-> routeIs('checkout2')? 'active' : '' }}">Shipping</a>
            </div>
        </div>
    </div>

    @include('frontEnd.layouts.progress_bar')
    
    @if ($errors->any())          
        <div class="container">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">     
                <ul>
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }}</li>
                    @endforeach
                </ul>   
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>  
            </div>
        </div>
    @endif

    <form action="{{ route('checkout3') }}" method="post">
        @csrf
        <div class="container">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Method</th>
                    <th scope="col">Delivery Time</th>
                    <th scope="col">Price</th>
                    <th scope="col">Choose</th>
                  </tr>
                </thead>
                <tbody>
                    @if (count($shippings) > 0)
                        @foreach ($shippings as $shipping)
                            <tr>
                                <td>{{ $shipping->shipping_address }}</td>
                                <td>{{ $shipping->delivery_time }}</td>
                                <td>฿{{ number_format($shipping->delivery_charge, 2) }}</td>
                                <td><input class="form-check-input chk-shipping" type="radio" name="delivery_charge" id="delivery_charge{{$shipping->id}}" value="{{ $shipping->delivery_charge }}"></td>
                            </tr>
                                {{-- <input type="hidden" name="delivery_time" value="{{ $shipping->delivery_time }}">        --}}
                        @endforeach
                    @else
                        Shipping not found 
                    @endif
                </tbody>
            </table>
             
            <div class="total_area">
                <a class="primary-btn cta-btn fload-right" href="{{ route('checkout1') }}">Go back</a>
                <button type="submit" class="primary-btn" id="cta-btn">Continue</button>
            </div>
        </div>    
    </form>
    


@endsection


