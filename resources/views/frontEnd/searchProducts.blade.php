@extends('frontEnd.layouts.master')

@section('content')
    <div class="bg-main">
        <div class="container">
            <div class="box">
                <div class="breadcumb">
                    <a href="{{ route('showHomepage') }}">Home</a>
                    <span><i class='bx bxs-chevrons-right'></i></span>
                    <a href="{{ route('showAllProducts') }}">All products</a>
                    <span><i class='bx bxs-chevrons-right'></i></span>
                    <a href="#" class="{{request()-> routeIs('searchResults')? 'active' : '' }}">Search products</a>
                </div>
            </div>

            <div class="box">
                <div class="row">
                    <div class="col-4 filter-col" id="filter-col">
                        <div class="box filter-toggle-box">
                            <button class="btn-flat btn-hover" id="filter-close">close</button>
                        </div>

                        <form action="{{ route('productsFilter') }}" method="post">
                            @csrf
                            {{-- Categories --}}
                            <div class="box">
                                <span class="filter-header">
                                    Categories
                                </span>
                                
                                <ul class="filter-list">
                                    @if (count($categories) > 0)
                                        @if (!empty($_GET['category']))
                                            @php
                                                $filter_cats = explode(',', $_GET['category']);  
                                            @endphp

                                            @foreach ($categories as $category_product)
                                            <li>
                                                <div class="group-checkbox mb-2">
                                                    <input type="checkbox" 
                                                        @if (!empty($filter_cats && in_array($category_product->slug, $filter_cats)))
                                                            checked 
                                                        @endif
                                                    id="cat{{ $category_product->slug }}" name="category[]" onchange="this.form.submit()" value="{{ $category_product->slug }}">
                                                    <label for="cat{{ $category_product->slug }}">
                                                        <a href="{{ route('showProductCategory', $category_product->slug) }}">
                                                            {{ $category_product->title }}
                                                        </a>
                                                        <small class="text-muted">({{ count($category_product->products) }})</small>
                                                        <i class='bx bx-check'></i>
                                                    </label>
                                                </div>
                                            </li>
                                            @endforeach

                                        @else
                                            @foreach ($categories as $category_product)
                                                <li>
                                                    <div class="group-checkbox mb-2">
                                                        <input type="checkbox" id="cat{{ $category_product->slug }}" name="category[]" onchange="this.form.submit()" value="{{ $category_product->slug }}">
                                                        <label for="cat{{ $category_product->slug }}">
                                                            <a href="{{ route('showProductCategory', $category_product->slug) }}">
                                                                {{ $category_product->title }}
                                                            </a>
                                                            <small class="text-muted">({{ count($category_product->products) }})</small>
                                                            <i class='bx bx-check'></i>
                                                        </label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif

                                   
                                    @endif
                                </ul>
                            </div>

                            {{-- Brands --}}
                            <div class="box">
                                <span class="filter-header">
                                    Brands
                                </span>
                                <ul class="filter-list">
                                    @if(count($brands) > 0)
                                        @if (!empty($_GET['brand']))
                                            @php
                                                $filter_brands = explode(',', $_GET['brand']);  
                                            @endphp
                                            @foreach ($brands as $brand)
                                            <li>
                                                <div class="group-checkbox">
                                                    <input type="checkbox" 
                                                    @if (!empty($filter_brands && in_array($brand->slug, $filter_brands)))
                                                        checked 
                                                    @endif
                                                    id="brand{{ $brand->slug }}" name="brand[]" onchange="this.form.submit()" value="{{ $brand->slug }}">
                                                    <label for="brand{{ $brand->slug }}">
                                                        <a href="#">
                                                            {{ $brand->title }}
                                                        </a>
                                                        <small class="text-muted">({{ count($brand->products) }})</small>
                                                        <i class='bx bx-check'></i>
                                                    </label>
                                                </div>
                                            </li>
                                            @endforeach
                                        @else
                                            @foreach ($brands as $brand)
                                            <li>
                                                <div class="group-checkbox">
                                                    <input type="checkbox" id="brand{{ $brand->slug }}" name="brand[]" onchange="this.form.submit()" value="{{ $brand->slug }}">
                                                    <label for="brand{{ $brand->slug }}">
                                                        <a href="#">
                                                            {{ $brand->title }}
                                                        </a>
                                                        <small class="text-muted">({{ count($brand->products) }})</small>
                                                        <i class='bx bx-check'></i>
                                                    </label>
                                                </div>
                                            </li>
                                            @endforeach
                                        @endif

                                    @endif
                                </ul>
                            </div>

                            {{-- Size --}}
                            {{-- <div class="box">
                                <span class="filter-header">
                                    Size
                                </span> 
                                <ul class="filter-list">
                                    <li>
                                        <div class="group-checkbox">
                                            <input type="checkbox" id="sm-size" name="size" value="S" onchange="this.form.submit()"
                                            @if (!empty($_GET['size']) && $_GET['size'] == 'S')
                                                checked 
                                            @endif
                                            >
                                            <label for="sm-size">
                                                Small
                                                <small class="text-muted">({{ \App\Models\Product::where(['status'=>'Active', 'size'=>'S'])->count() }})</small>
                                                <i class='bx bx-check'></i>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="group-checkbox">
                                            <input type="checkbox" id="md-size" name="size" value="M" name="size" value="M" onchange="this.form.submit()">
                                            <label for="md-size">
                                                Medium
                                                <small class="text-muted">({{ \App\Models\Product::where(['status'=>'Active', 'size'=>'M'])->count() }})</small>
                                                <i class='bx bx-check'></i>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="group-checkbox">
                                            <input type="checkbox" id="l-size" name="size" value="L" name="size" value="L" onchange="this.form.submit()">
                                            <label for="l-size">
                                                Large
                                                <small class="text-muted">({{ \App\Models\Product::where(['status'=>'Active', 'size'=>'L'])->count() }})</small>
                                                <i class='bx bx-check'></i>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="group-checkbox">
                                            <input type="checkbox" id="xl-size" name="size" value="XL" name="size" value="XL" onchange="this.form.submit()">
                                            <label for="xl-size">
                                                Extra large
                                                <small class="text-muted">({{ \App\Models\Product::where(['status'=>'Active', 'size'=>'XL'])->count() }})</small>
                                                <i class='bx bx-check'></i>
                                            </label>
                                        </div>
                                    </li>                    
                                </ul>
                            </div> --}}
                        </div>
                        
                    
                    <div class="col-8 col-md-12">
                         <!-- Filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
                               Your keyword is <span> <b> {{ $keyword }}</b></span>
							</div>

                            <div class="float-end text-muted">
                                Total Results: {{ $products->total() }}
                            </div>
							
						</div>
                    </form>
                        <div class="box filter-toggle-box">
                            <button class="btn-flat btn-hover" id="filter-toggle">filter</button>
                        </div>

                        <div class="box">
                            <div class="row">
                                @if (count($products) > 0)
                                    @foreach ($products as $product)
                                        <div class="col-4 col-md-6 col-sm-12">
                                            <div class="product-card">
                                                <div class="product-card-img">
                                                    <img src="{{ $product->photo }}" alt="productImage">
                                                    <img src="{{ $product->photo }}" alt="productImage">
                                                </div>
                                                <div class="product-card-info">
                                                    <div class="product-btn">
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
                                    @endforeach
                                @else
                                    <div class="alert alert-danger" role="alert">
                                        Product not found 
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{ $products->appends($_GET)->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@section('scripts')

{{-- <script>
    $(document).ready(function() {
        //Sort by
        $('#sortBy').change(function() {
            var sort = $('#sortBy').val();
            window.location = "{{url(''.$route.'')}}?sort=" + sort;
        });

    });
</script> --}}

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






