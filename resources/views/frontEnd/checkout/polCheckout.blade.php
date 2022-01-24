@extends('frontEnd.layouts.master')


@section('content')

    <form action="{{ route('responsePOLPayment') }}" method="post">
        @csrf
        <div class="section">
            <div class="container text-center my-3">
                <div class="row">
                    <div class="col-md-12 order-details">
                        <div class="section-title text-center">
                            <h3 class="title text-custom">Your Order #{{ $order->order_number }}</h3>
                        </div>
                       
                        <div class="order-summary">
                            <div class="order-col">
                           
                            <div class="order-col">
                                <div><strong>TOTAL AMOUNT</strong></div>
                                <div><strong class="order-total">฿{{ number_format($order->total_amount, 2)}}</strong></div>
                                <input type="hidden" value="{{ $order->total_amount }}" name="total_amount">
                            </div>
                        </div>
                  
                       <div class="form-one">
                            <div class="total_area" style="padding:10px">
                                <ul>
                                    <li>
                                        Payment Status
                                        @if ($order->payment_status == 'unpaid')
                                            <span class="badge bg-danger">Unpaid</span>
                                        @else
                                            <span class="badge bg-success">Paid</span>
                                        @endif
                                                   
                                    </li>
                                </ul>  
                            </div>
                        </div>

                        <script type="text/javascript" src="https://cdn.omise.co/omise.js"
                            data-key="{{ env('OMISE_PUBLIC_KEY') }}"
                            data-image="{{ asset('/images/favicon/favicon-32x32.png') }}"
                            data-frame-label="Earth Shop"
                            data-button-label="Pay now "
                            data-submit-label="Submit"
                            data-location="no"
                            data-amount="{{  $amount }}"
                            data-currency="thb"
                            >
                        </script>

                    </div>
                </div>
            </div>
        </div>    
    </form>



@endsection

<style>
    .omise-checkout-button {
        display: block;
        width: 100%;
        height: 44px;
        border: 0px;
        background-color: #00bcb4;
        color: rgb(255, 255, 255);
        font-weight: 700;
        font-size: 16px;
        line-height: 44px;
        text-align: center;
        cursor: pointer;
        border-radius: 4px;
        user-select: none;
        transition: background-color 0.2s ease 0s;
    }

    .omise-checkout-button:hover{
        background: linear-gradient(90deg, #9dfffa, #00bcb4);
        transition: 0.2s;
        transform: scale(0.96);
        cursor: pointer;
    }
</style>