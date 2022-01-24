@extends('frontEnd.layouts.master')

@section('content')
    <div class="bg-main">
        <div class="container">
            <div class="box">
                <div class="breadcumb">
                    <a href="{{ route('showHomepage') }}">home</a>
                    <span><i class='bx bxs-chevrons-right'></i></span>
                    <a href="#" class="{{request()-> routeIs('showProductCategory')? 'active' : '' }}">{{ $category->title }}</a>
                </div>
            </div>

            <div class="box">
                <div class="row">
                    <div class="col-4 filter-col" id="filter-col">
                        <div class="box filter-toggle-box">
                            <button class="btn-flat btn-hover" id="filter-close">close</button>
                        </div>

                        {{-- Categories --}}
                        <div class="box">
                            <span class="filter-header">
                                Categories
                            </span>
                            
                            <ul class="filter-list">
                                @if (count($categories) > 0)
                                    @foreach ($categories as $category_product)
                                        <li>                     
                                            <label for="cat{{ $category_product->slug }}">
                                                <a href="{{ route('showProductCategory', $category_product->slug) }}">
                                                    {{ $category_product->title }}
                                                </a>
                                                <small class="text-muted">({{ count($category_product->products) }})</small>
                                            </label>                 
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>


                
                    </div>

                    <div class="col-8 col-md-12">
                        <!-- Filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
								<label>
									Sort By:
									<select class="input-select" id="sortBy">
                                        <option selected>Default Sort</option>
										<option value="priceAsc" {{ $sort == 'priceAsc' ? 'selected' : '' }}>Price Lower to Higeher</option>
										<option value="priceDesc" {{ $sort  == 'priceDesc' ? 'selected' : '' }}>Price Higher to Lower</option>
                                        <option value="titleAsc" {{ $sort  == 'titleAsc' ? 'selected' : '' }}>Alphabetical Ascending</option>
										<option value="titleDesc" {{ $sort  == 'titleDesc' ? 'selected' : '' }}>Alphabetical Descending</option>
                                        <option value="discAsc" {{ $sort == 'discAsc' ? 'selected' : '' }}>Discount Lower to Higeher</option>
										<option value="discDesc" {{ $sort  == 'discDesc' ? 'selected' : '' }}>Discount Higher to Lower</option>
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
							
						</div>
                        <div class="box filter-toggle-box">
                            <button class="btn-flat btn-hover" id="filter-toggle">filter</button>
                        </div>
                        <div class="box">
                            <div class="row" id="product-data">
                                @include('frontEnd.layouts.loadingProducts')
                            </div>
                        </div>
                        {{ $products->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
        
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@section('scripts')

<script>
    $(document).ready(function() {
        //Sort by
        $('#sortBy').change(function() {
            var sort = $('#sortBy').val();
            window.location = "{{url(''.$route.'')}}/{{$category->slug}}?sort=" + sort;
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


