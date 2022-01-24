@extends('frontEnd.layouts.master')
<link rel="stylesheet" href="{{ asset('css/product_details.css') }}">
<script src="{{ asset('js/product-details.js') }}"></script>

@section('content')
<div class="col-lg-12">
    @include('frontEnd.layouts.notification')
</div>

<div class="bg-main">
    <div class="container">
        <div class="box">
            <div class="breadcumb">
                <a href="{{ route('showHomepage') }}">home</a>
                <span><i class='bx bxs-chevrons-right'></i></span>
                <a href="{{ route('showAllProducts') }}">all products</a>
                <span><i class='bx bxs-chevrons-right'></i></span>
                <a href="#" class="active">{{ $product->title }}</a>
            </div>
        </div>
      
        <div class="row product-row">
            @if ($product->stock > 0)
                <div class="col-5 col-md-12">
                    <div class="product-img" id="product-img">
                        <img src="{{ $product->photo }}" alt="ProductImage">
                    </div>
                </div>

                <div class="col-7 col-md-12">
                    <div class="product-info">
                        <h1>
                            {{ $product->title }}
                        </h1>
                        <div class="product-info-detail">
                            <span class="product-info-detail-title">Brand: {{ $product->brand->title }}</span>
                     
                        </div>
                        <div class="product-info-detail">
                            <span class="product-info-detail-title">Rated:</span>
                            @if ($conv_avgReview > 0)
                            <span class="rating">
                                @for($i=0; $i<5; $i++)
                                    @if ($conv_avgReview > $i)
                                        <i class='bx bxs-star'></i>                  
                                    @endif
                                @endfor
                            </span>
                            @else
                                <i class='bx bxs-star' aria-hidden="true"></i>    
                                <i class='bx bxs-star' aria-hidden="true"></i>    
                                <i class='bx bxs-star' aria-hidden="true"></i>    
                                <i class='bx bxs-star' aria-hidden="true"></i>                             
                                <i class='bx bxs-star' aria-hidden="true"></i>    
                            @endif
                        </div>
                        <p class="product-description">
                            {!! html_entity_decode($product->summary) !!}
                        </p>
                        @if ($product->offer_price != $product->price)
                            <div class="product-info-price">฿{{ number_format($product->offer_price, 2) }}</div>
                            <span><del>฿{{ number_format($product->price, 2) }}</del></span>
                        @else
                            <div class="product-info-price">฿{{ number_format($product->offer_price, 2) }}</div>
                        @endif
                        <div class="quantity">
                            <input type="number" data-id="{{$product->id}}" class="qty-text" id="qty" step="1" min="1" max="99" name="quantity" value="1">
                        </div>
                        <div>
                            <button class="btn-flat btn-hover add_to_wishlist" data-quantity="1" data-product-id="{{ $product->id }}" id="add_to_wishlist{{$product->id}}"><i class='bx bxs-heart'></i>add to wishlist</button>
                            <button class="btn-flat btn-hover add_to_cart" data-quantity="1" data-product-id="{{ $product->id }}" id="add_to_cart{{$product->id}}"><i class='bx bxs-cart-add'></i>add to cart</button>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-5 col-md-12">
                    <div class="product-img card" id="product-img" style="height: 400px">
                        <h4 class="text-muted">Sold Out</h4>
                    </div>
                </div>

                <div class="col-7 col-md-12">
                    <div class="product-info">
                        <h1>
                            {{ $product->title }}
                        </h1>
                        <div class="product-info-detail">
                            <span class="product-info-detail-title">Brand:</span>
                            <a href="#">{{ $product->brand->title }}</a>
                        </div>
                        <div class="product-info-detail">
                            <span class="product-info-detail-title">Rated:</span>
                            <span class="rating">
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                            </span>
                        </div>
                        <p class="product-description">
                            {!! html_entity_decode($product->summary) !!}
                        </p>
                        @if ($product->offer_price != $product->price)
                            <div class="product-info-price">฿{{ number_format($product->offer_price, 2) }}</div>
                            <span><del>฿{{ number_format($product->price, 2) }}</del></span>
                        @else
                            <div class="product-info-price">฿{{ number_format($product->offer_price, 2) }}</div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
       
    </div>
</div>
    
    <div class="container">
        <div class="box">
            <!-- Tabs navs -->
            <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a
                        class="nav-link active"
                        id="ex1-tab-1"
                        data-mdb-toggle="tab"
                        href="#ex1-tabs-1"
                        role="tab"
                        aria-controls="ex1-tabs-1"
                        aria-selected="true"
                    > 
                    <div class="box-header">
                        Description
                    </div>
                </a>
                
                </li>
                <li class="nav-item" role="presentation">
                    <a
                        class="nav-link"
                        id="ex1-tab-2"
                        data-mdb-toggle="tab"
                        href="#ex1-tabs-2"
                        role="tab"
                        aria-controls="ex1-tabs-2"
                        aria-selected="false"
                    > 
                    <div class="box-header">
                        Review 
                        <span class="text-muted"> ({{ count($product_review) }})</span>
                    </div>
                </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a
                        class="nav-link"
                        id="ex1-tab-3"
                        data-mdb-toggle="tab"
                        href="#ex1-tabs-3"
                        role="tab"
                        aria-controls="ex1-tabs-3"
                        aria-selected="false"
                    > 
                        <div class="box-header">
                            Additional Information
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a
                        class="nav-link"
                        id="ex1-tab-4"
                        data-mdb-toggle="tab"
                        href="#ex1-tabs-4"
                        role="tab"
                        aria-controls="ex1-tabs-4"
                        aria-selected="false"
                    > 
                        <div class="box-header">
                            Return & Cancellation
                        </div>
                    </a>
                </li>
            </ul>
            <!-- Tabs navs -->
            
            <!-- Tabs content -->
            <div class="tab-content" id="ex1-content">
                <div
                class="tab-pane fade show active"
                id="ex1-tabs-1"
                role="tabpanel"
                aria-labelledby="ex1-tab-1"
                >
                    {!! html_entity_decode($product->description) !!} 
                </div>
                
                <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                    <div class="row">                 
                        <div class="col-7">
                            <div class="user-rate">                     
                           @if (count($product_review) > 0)
                            @foreach ($product_review as $review)
                            <div class="user-info">
                                <div class="user-avt">
                                    <img src="{{ asset('images_template/user_review.png') }}" alt="">
                                </div>
                                <div class="user-name">
                                    <span class="name">{{ \App\Models\User::where('id', $review->user_id)->value('full_name') }} <span class="text-muted"><small>{{ \Carbon\Carbon::parse($review->created_at)->format('M d Y') }}</small></span></span>
                                    <span class="rating">
                                        @for($i=0; $i<6; $i++)
                                            @if ($review->rate > $i)
                                                <i class='bx bxs-star'></i>
                                            @endif
                                        @endfor
                                        <span>For {{ $review->reason }}</span>
                                    </span>
                    
                                </div>
                            </div>
                            <div class="user-rate-content text-muted">
                                {{ $review->review }}
                            </div>
                            @endforeach
                            {{ $product_review->links('vendor.pagination.custom') }}
                           @else
                               No reviews
                           @endif
            
                        </div>   
                    </div>
                        <div class="col-5">
                            <h5>Submit a review</h5>
                            @auth
                                <form action="{{ route('productReview', $product->slug) }}" class="review-form" method="post">
                                    @csrf
                                    <div class="mb-2">
                                        <div class="rate">
                                            <span class="text-rate">Your rating</span>
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div> 
                                        @error('rate')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="name" class="form-label text-rate">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Your name" value="{{ auth()->user()->username }}" readonly>
                                    </div>
                                    <div class="mb-2">
                                        <label for="name" class="form-label text-rate">Reason for your rating</label>
                                        <select name="reason" id="reason" name="reason">                  
                                            <option value="quality" {{ old('reason') == 'quanlity' ? 'selected' : '' }}>Quality</option> 
                                            <option value="value" {{ old('reason') == 'value' ? 'selected' : '' }}>Value</option> 
                                            <option value="design" {{ old('reason') == 'design' ? 'selected' : '' }}>Design</option> 
                                            <option value="price" {{ old('reason') == 'price' ? 'selected' : '' }}>Price</option> 
                                            <option value="other" {{ old('reason') == 'other' ? 'selected' : '' }}>Other</option> 
                                        </select>
                                        @error('reason')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="exampleFormControlTextarea1" class="form-label text-rate">Comment</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="review"></textarea>
                                        @error('review')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn-rate" >Submit</button>
                                </form>
                            @else
                                <p class="py-5">You need to login for writing review <a href="{{ route('login') }}">Click here!</a> to login</p>
                            @endif
                        </div>
                  </div>
                   
                </div>
                
                <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                    {!! html_entity_decode($product->additional_info) !!} 
                </div>

                <div class="tab-pane fade" id="ex1-tabs-4" role="tabpanel" aria-labelledby="ex1-tab-3">
                    {!! html_entity_decode($product->return_cancellation) !!} 
                </div>
            </div>
            <!-- Tabs content -->
        </div>

    </div>

@endsection

<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"
></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@section('scripts')

<script>
    $('.qty-text').change('key up', function() {
        var id = $(this).data('id');
        var spinner = $(this),input=spinner.closest('.quantity').find('input[type="number"]');
        var newVal = parseFloat(input.val());
        $('#add_to_cart'+id).attr('data-quantity', newVal);
    });
</script>


<script>
    $(document).on('click', '.add_to_cart', function(e) {
        e.preventDefault();
        var product_id = $(this).data('product-id');
        var product_qty = $(this).data('quantity');
        var product_price = $(this).data('price');
        
        var token = "{{ csrf_token() }}";
        var path = "{{ route('cartStore') }}";

        $.ajax({
            url: path,
            type: "POST",
            dataType: "JSON",
            data: {
                product_id: product_id,
                product_qty: product_qty,
                product_price: product_price,
                _token: token,
            },
            beforeSend:function() {
                $('#add_to_cart'+product_id).html('<i class="fa fa-spinner fa-spin"></i>Moving to cart...');
          
            },
            complete:function() {
                $('#add_to_cart'+product_id).html('<i class="bx bxs-cart-add"></i>add to cart');
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
                $('#add_to_wishlist'+product_id).html('<i class="fa fa-spinner fa-spin"></i>Moving to wishlist...');
            },
            complete:function() {
                $('#add_to_wishlist'+product_id).html('<i class="bx bxs-heart"></i>add to wishlist');
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

