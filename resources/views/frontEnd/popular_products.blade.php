@extends('frontEnd.layouts.master')

@section('content')
    <div class="bg-main">
        <div class="container">
            <div class="box">
                <div class="breadcumb">
                    <a href="{{ route('showHomepage') }}">Home</a>
                    <span><i class='bx bxs-chevrons-right'></i></span>
                    <a href="#" class="{{request()-> routeIs('showPopularProducts')? 'active' : '' }}">Popular products</a>
                </div>
            </div>

            <div class="box">
                <div class="row">
                    <div class="col-12 col-md-12">
                         <!-- Filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
                                <label>
									Sort By:
									<select class="input-select" id="sortBy" name="sortBy" onchange="this.form.submit()">
                                        <option value="default" @if(!empty($_GET['sortBy']) && $_GET['sortBy'] == 'default') selected @endif }}>Default Sort</option>
										<option value="priceAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy'] == 'priceAsc') selected @endif }}>Price Lower to Higeher</option>
										<option value="priceDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy'] == 'priceDesc') selected @endif }}>Price Higher to Lower</option>
                                        <option value="titleAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy'] == 'titleAsc') selected @endif }}>Alphabetical Ascending</option>
										<option value="titleDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy'] == 'titleDesc') selected @endif }}>Alphabetical Descending</option>
                                        <option value="discAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy'] == 'discAsc') selected @endif }}>Discount Lower to Higeher</option>
										<option value="discDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy'] == 'discDesc') selected @endif }}>Discount Higher to Lower</option>
									</select>
								</label>

								<label>
									Show:
									<select class="input-select">
										<option value="0">20</option>
										<option value="1">50</option>
									</select>
								</label>
							</div>

                            <div class="float-end text-muted">
                                Total Results: {{ $popular_products->total() }}
                            </div>
							
						</div>
                    </form>
                      
                        <div class="box">
                            <div class="row">
                                @if (count($popular_products) > 0)
                                    @foreach ($popular_products as $product)
                                        @if ($product->stock > 0)
                                        <div class="col-4 col-md-6 col-sm-12">
                                            <div class="product-card">
                                                @if ($product->conditions == 'new')
                                                    <span class="new-span">New</span>
                                                @elseif ($product->conditions == 'special')
                                                    <span class="special-span">Special</span>
                                                @elseif ($product->conditions == 'popular')
                                                    <span class="popular-span">Popular</span>
                                                @endif
                                                <div class="product-card-img">
                                                    <img src="{{ $product->photo }}" alt="productImage">
                                                    <img src="{{ $product->photo }}" alt="productImage">
                                                </div>
                                                <div class="product-card-info">
                                                    <div class="">                                                                         
                                                        <a href="{{ route('showProductDetail', $product->slug) }}" class="btn-flat btn-hover btn-cart-add">
                                                            <i class='bx bxs-show'></i>
                                                        </a>
                                                        <a href="javascript:void(0);" data-quantity="1" data-product-id="{{ $product->id }}" class="btn-flat btn-hover btn-cart-add add_to_wishlist" id="add_to_wishlist{{$product->id}}">
                                                            <i class='bx bxs-heart'></i>
                                                        </a>
                                                        <a href="" data-quantity="1" data-product-id="{{ $product->id }}" class="btn-flat btn-hover btn-cart-add add_to_cart" id="add_to_cart{{$product->id}}">
                                                            <i class='bx bxs-cart-add'></i>
                                                        </a>    
                                                    </div>
                                                    <div class="product-card-name">
                                                        {{ $product->title }}
                                                    </div>
                                                    <div class="product-card-price">
                                                        <span><del>฿{{ number_format($product->price, 2) }}</del></span>
                                                        <span class="curr-price">฿{{ number_format($product->offer_price, 2) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                            <div class="col-4 col-md-6 col-sm-12">
                                                <div class="product-card-img card">
                                                    <h4 class="text-muted">Sold Out</h4>
                                                </div>

                                                <div class="product-card-info" style="margin-top: 56px">
                                                    <div class="product-card-name">
                                                        {{ $product->title }}
                                                    </div>
                                                    <div class="product-card-price">
                                                        @if ($product->offer_price != $product->price)
                                                        <span><del>฿{{ number_format($product->price, 2) }}</del></span>
                                                        @else
                                                            
                                                        @endif
                                                        <span class="curr-price">฿{{ number_format($product->offer_price, 2) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif    
                                    @endforeach
                                @else
                                    <div class="alert alert-danger" role="alert">
                                        Product not found 
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{ $popular_products->appends($_GET)->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
        
@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        //Sort by
        $('#sortBy').change(function() {
            var sort = $('#sortBy').val();
            window.location = "{{url(''.$route.'')}}/?sort=" + sort;
        });

    });
</script>

<script>
    $(document).on('click', '.add_to_cart', function(e) {
        e.preventDefault();
        var product_id = $(this).data('product-id');
        var product_qty = $(this).data('quantity');
        
        var token = "{{ csrf_token() }}";
        var path = "{{ route('cartStore') }}";

        $.ajax({
            url: path,
            type: "POST",
            dataType: "JSON",
            data: {
                product_id: product_id,
                product_qty: product_qty,
                _token: token,
            },
            beforeSend:function() {
                $('#add_to_cart'+product_id).html('<i class="fa fa-spinner fa-spin"></i>');
            },
            complete:function() {
                $('#add_to_cart'+product_id).html('<i class="bx bxs-cart-add"></i>');
            },
            success:function(data) {
                console.log(data);
                if(data['status']) {
                    $('body #header-ajax').html(data['header']);
                    $('body #cart_counter').html(data['cart_count']);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: "Success!",
                        text: data['message'],
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    setTimeout(window.location.reload.bind(window.location), 450);
                }
            }
        });

    });
</script>

<script>
    $(document).on('click', '.add_to_wishlist', function(e) {
        e.preventDefault();
        var product_id = $(this).data('product-id');
        var product_qty = $(this).data('quantity');
        
        var token = "{{ csrf_token() }}";
        var path = "{{ route('wishlistStore') }}";

        $.ajax({
            url: path,
            type: "POST",
            dataType: "JSON",
            data: {
                product_id: product_id,
                product_qty: product_qty,
                _token: token,
            },
            beforeSend:function() {
                $('#add_to_wishlist'+product_id).html('<i class="fa fa-spinner fa-spin"></i>');
            },
            complete:function() {
                $('#add_to_wishlist'+product_id).html('<i class="bx bxs-heart"></i>');
            },
            success:function(data) {
                console.log(data);
                if(data['status']) {
                    $('body #header-ajax').html(data['header']);
                    $('body #wishlist_counter').html(data['wishlist_count']);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Success!',
                        text: data['message'],
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    setTimeout(window.location.reload.bind(window.location), 450);
                }
                else if(data['present']) {
                    $('body #header-ajax').html(data['header']);
                    $('body #wishlist_counter').html(data['wishlist_count']);
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'Oops!',
                        text: data['message'],
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    setTimeout(window.location.reload.bind(window.location), 450);
                }
                else {
                    $('body #header-ajax').html(data['header']);
                    $('body #wishlist_counter').html(data['wishlist_count']);
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Sorry!',
                        text: "You can't add that product.",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    setTimeout(window.location.reload.bind(window.location), 450);
                }
            }
        });

    });
</script>


@endsection


