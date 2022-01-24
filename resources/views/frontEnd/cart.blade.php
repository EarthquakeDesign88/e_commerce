@extends('frontEnd.layouts.master')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">

@section('content')

    <div class="col-lg-12">
        @include('frontEnd.layouts.notification')
    </div>
    <div class="bg-main">
        <div class="container">
            <div class="box">
                <div class="breadcumb">
                    <a href="{{ route('showHomepage') }}">Home</a>
                    <span><i class='bx bxs-chevrons-right'></i></span>
                    <a href="#" class="{{request()-> routeIs('showCart')? 'active' : '' }}">Cart</a>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="show-cart" id="cart_list">
                @include('frontEnd.layouts.cart_list')
            </div>
          
            <div class="row">
                <div class="col-6">
                    <div class="billing-details">
                        <div class="form-group">
                            <div class="input-checkbox">
                                <div class="caption">
                                    <div class="section-title">
                                        <h3 class="title">Discount Coupon</h3>
                                    </div>
                                    <form action="{{ route('applyCoupon') }}" id="coupon_form" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input class="input" type="text" name="code" id="code" placeholder="Coupon code">
                                        </div>
                                        <button type="submit" class="btn-coupon mt-2">Apply</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">Card Totals</h5>
                            <table class="table-borderless" width="100%">
                                <tbody>
                                    <tr>
                                        <td> <strong>Sub total: </strong></td>
                                        <td><span class="float-end">฿ {{ \Gloudemans\Shoppingcart\Facades\Cart::subtotal() }}</span></td>
                                    </tr>
                                   
                                    <tr>
                                        <td> <strong>Discount: </strong></td>
                                        <td>
                                            @if (\Illuminate\Support\Facades\Session::get('coupon'))
                                                <span class="float-end">฿ {{ number_format(session('coupon')['value'], 2) }}</span>
                                            @else
                                                <span class="float-end">฿ 0</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <strong>Total: </strong></td>
                                        @if(Session::has('coupon'))
                                            <td><span class="float-end">฿ {{ number_format((float) str_replace(',','',\Gloudemans\Shoppingcart\Facades\Cart::subtotal()) - session('coupon')['value'], 2) }}</span></td>
                                        @else
                                            <td><span class="float-end">฿ {{ number_format((float) str_replace(',','',\Gloudemans\Shoppingcart\Facades\Cart::subtotal()), 2) }}</span></td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                         
                        </div>
                    </div>

                    <section id="do_action">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <a class="primary-btn fload-right" href="{{ route('showAllProducts') }}">Shopping</a>
                                        <a class="primary-btn" href="{{ route('checkout1') }}">Check Out</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

     

            
    </div>
        
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@section('scripts')
    <script>
        $(document).on('click', '.btn-coupon', function(e) {
            e.preventDefault();
            var code=$('input[name=code]').val();
            
            $('.btn-coupon').html('<i class="fa fa-spinner fa-spin"></i>Applying...');
            $('#coupon_form').submit();
        });

    </script>

    <script>
        $(document).on('click', '.qty-text', function(e) {
            var id = $(this).data('id');
            var spinner = $(this),input = spinner.closest(".cart_quantity").find('input[type="number"]');
            
            if(input.val() < 1) {
                return false;
            } 
            if(input.val() >= 1) {
                var newVal = parseFloat(input.val());
                $('#qty-input-' + id).val(newVal);
            }

            var stock_qty = $("#update-cart-"+id).data('product-quantity');
            update_cart(id, stock_qty);

            $('.reload').html('<i class="spinner-border text-warning"></i>');
       
        });

        function update_cart(id, stock_qty) {
            var rowId = id;
            var product_qty = $('#qty-input-'+rowId).val();
            var token = "{{ csrf_token() }}";
            var path = "{{ route('updateCart') }}";

            $.ajax({
                url: path,
                type: "POST",
                dataType: "JSON",
                data: {
                    _token: token,
                    product_qty: product_qty,
                    rowId: rowId,
                    stock_qty: stock_qty,
                },
                success:function(data) {
                    console.log(data);

                    if(data['status']) {
                        $('body #header-ajax').html(data['header']);
                        $('body #cart_counter').html(data['cart_count']);
                        $('body #cart_list').html(data['cart_list']);

                        // alert(data['message']);
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Success!',
                            text: data['message'],
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        setTimeout(window.location.reload.bind(window.location), 450);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data['message'],
                        })
                     
                    }
                    
                },
                error:function(err) {
                    console.log(err);
                }
            });

        }
    </script>


@endsection


