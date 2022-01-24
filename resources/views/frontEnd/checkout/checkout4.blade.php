@extends('frontEnd.layouts.master')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">

@section('content')

    <div class="container">
        <div class="box">
            <div class="breadcumb">
                <a href="{{ route('showHomepage') }}">Home</a>
                <span><i class='bx bxs-chevrons-right'></i></span>
                <a href="#" class="{{request()-> routeIs('checkout4')? 'active' : '' }}">Review</a>
            </div>
        </div>
    </div>

    @include('frontEnd.layouts.progress_bar')

    <form action="{{ route('checkout4') }}" method="post">
        @csrf
        <div class="container">
            <div class="show-cart">
                <table class="table">
                    <thead>
                        <tr class="text-cart">
                            <td class="image">Image</td>
                            <td class="description">Product</td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() > 0)
                            @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                                <tr>
                                    <td class="cart_product">
                                        <img src="{{ $item->model->photo }}" alt=""width="100px" height="100px">
                                    </td>
                                    <td class="cart_description">
                                        <h5><a href="{{ route('showProductDetail', $item->model->slug) }}"> {{ $item->name }} </a></h5>
                                    </td>
                                    <td class="cart_price">
                                        <p>฿{{ number_format($item->price, 2) }}</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <p>{{ $item->qty }}</p>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">฿ {{ number_format($item->subtotal, 2) }} </p>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">
                                    <div class="alert alert-danger" role="alert">
                                        You dont' have any cart product!
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-6"></div>

                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">Card Totals</h5>
                            <table class="table-borderless" width="100%">
                                <tbody>
                                    <tr>
                                        <td> <strong>Sub total: </strong></td>
                                        <td><span class="float-end">฿ {{ Cart::subtotal() }}</span></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Shipping: </strong></td>
                                        <td><span class="float-end">฿ {{ number_format(Session::get('checkout')[0]['delivery_charge'])}}</span></td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Discount: </strong></td>
                                        <td>
                                            @if (Session::has('coupon'))
                                                <span class="float-end">฿ {{ number_format(session('coupon')['value'], 2) }}</span>
                                            @else
                                                <span class="float-end">฿ 0</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Total: </strong></td>
                                        @if(Session::has('coupon') && Session::has('checkout'))
                                            <td><span class="float-end">฿ {{ number_format((float) str_replace(',','', Cart::subtotal()) + Session::get('checkout')[0]['delivery_charge'] - session('coupon')['value'], 2) }}</span></td>
                                        @else
                                            <td><span class="float-end">฿ {{ number_format((float) str_replace(',','', Cart::subtotal()) + Session::get('checkout')[0]['delivery_charge'], 2) }}</span></td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>

                        
                            <div class="total_area float-end mt-2">
                                <a class="primary-btn cta-btn" href="{{ route('confirmationCheckout') }}">Confirm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
   </form>

        
</div>

@endsection

