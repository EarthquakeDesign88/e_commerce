@extends('frontEnd.layouts.master')


@section('content')
<form action="" method="post" class="form-group">
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
                            {{-- <input type="hidden" value="{{ $order->total_amount }}"> --}}
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
                     
                            <div id="paypal-button-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>


@endsection


<script
  {{-- src="https://www.paypal.com/sdk/js?client-id={{  env('PAYPAL_CLIENT_SECRET')  }}"> --}}
  src="https://www.paypal.com/sdk/js?client-id={{  env('PAYPAL_CLIENT_SECRET')  }} "> 
</script> 



<script>
    // paypal.Buttons().render('#paypal-button-container');

    paypal.Buttons({
    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '{{$order->total_amount}}',
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {
        window.location='/paypal/receipt/' + data.orderID + '/' + data.payerID;

      });
    }
  }).render('#paypal-button-container');


</script>
