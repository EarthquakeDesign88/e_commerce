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
                <a href="#" class="{{request()-> routeIs('showWishlist')? 'active' : '' }}">Wishlist</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="show-wishlist" id="wishlist_list">
            @include('frontEnd.layouts.wishlist_list')
        </div>

        <section id="do_action">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="total_area">
                            <a class="primary-btn cta-btn fload-right" href="{{ route('showAllProducts') }}">Go Shopping</a>
                            {{-- <a class="primary-btn cta-btn" href="">Add all item</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>       
</div>


        
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@section('scripts')
    <script>
        $(document).on('click', '.move_to_cart', function(e) {
            e.preventDefault();
            var rowId = $(this).data('id');
            var token = "{{ csrf_token() }}";
            var path = "{{ route('wishlistMoveToCart') }}";

            $.ajax({
                url: path,
                type: "POST",
                data: {
                    _token: token,
                    rowId: rowId,
                },
                beforeSend:function() {
                    $('#move_to_cart'+rowId).html('<i class="fa fa-spinner fa-spin"></i>Moving to cart...');
                },
                success:function(data) {
                    if(data['status']) {
                        $('body #cart_counter').html(data['cart_count']);
                        $('body #wishlist_list').html(data['wishlist_list']);
                        $('body #header-ajax').html(data['header']);
                        Swal.fire({
                                position: 'center',
                                icon: 'warning',
                                title: 'Opp!',
                                text: 'Something went wrong',
                                showConfirmButton: false,
                                timer: 1500,
                        });
                        setTimeout(window.location.reload.bind(window.location), 450);
                    } else{
                        $('body #cart_counter').html(data['cart_count']);
                        $('body #wishlist_list').html(data['wishlist_list']);
                        $('body #header-ajax').html(data['header']);
                        Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Success!',
                                text: 'Item has been moved to a cart',
                                showConfirmButton: false,
                                timer: 1500,
                        });
                        setTimeout(window.location.reload.bind(window.location), 450);
                    }
                },
                error:function(err) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Error!',
                        text: 'Something went wrong',
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    setTimeout(window.location.reload.bind(window.location), 450);
                }

                 
            })
        });
    </script>


@endsection


