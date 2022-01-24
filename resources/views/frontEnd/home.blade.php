@extends('frontEnd.layouts.master')
<!-- Slick -->
<link type="text/css" rel="stylesheet" href="{{ asset('css/slicks.css') }}"/>
<link type="text/css" rel="stylesheet" href="{{ asset('css/slick-theme.css') }}"/>
<link type="text/css" rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}"/>
{{-- <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}"/> --}}
<link type="text/css" rel="stylesheet" href="{{ asset('css/home_style.css') }}"/>

<marquee direction="left" class="text-main"> Welcome to Earth shop, shopping Online website<i class="bx bx-cart text-warning"></i></marquee>
{{-- @if (Auth::user()->role == 'admin') 
<marquee direction="left" class="text-danger"> You cannot use full functions. please change to <b>customer account.</b> </marquee>
@endif --}}
<div class="col-lg-12">
    @include('frontEnd.layouts.notification')
</div>
@section('content')
    {{-- Slider --}}
    <div class="hero">
        <div class="slider">
            <div class="container">
                @if(count($sliders) > 0)
                    @foreach ($sliders as $slider)
                        @if ($slider->id == 1)
                            <div class="slide active">
                                <div class="info">
                                    <div class="info-content">
                                        <h3 class="top-down">
                                            {{ $slider->sub_title }}
                                        </h3>
                                        <h2 class="top-down trans-delay-0-2">
                                            {{ $slider->title }}
                                        </h2>
                                        <p class="top-down trans-delay-0-4">
                                            {!! html_entity_decode($slider->description) !!}
                                        </p>
                                        <div class="top-down trans-delay-0-6">
                                            <button class="btn-flat btn-hover">
                                                <span>Earth Shop</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="img top-down">
                                    <img src="{{ $slider->photo }}" alt="SliderImage">
                                </div>
                            </div>
                        @else
                            <div class="slide">
                                <div class="info">
                                    <div class="info-content">
                                        <h3 class="top-down">
                                            {{ $slider->sub_title }}
                                        </h3>
                                        <h2 class="top-down trans-delay-0-2">
                                            {{ $slider->title }}
                                        </h2>
                                        <p class="top-down trans-delay-0-4">
                                            {!! html_entity_decode($slider->description) !!}
                                        </p>
                                        <div class="top-down trans-delay-0-6">
                                            <button class="btn-flat btn-hover">
                                                <span>shop now</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="img right-left">
                                    <img src="{{ $slider->photo }}" alt="SliderImage">
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
           
  
            </div>
            <!-- slider controller -->
            <button class="slide-controll slide-next">
                <i class='bx bxs-chevron-right'></i>
            </button>
            <button class="slide-controll slide-prev">
                <i class='bx bxs-chevron-left'></i>
            </button>

        </div>
    </div>
 
    

    <!-- promotion section -->
    <div class="promotion">
        <div class="row">
            @if (count($categories) > 0)
            @foreach ($categories as $category)
                <div class="col-4 col-md-12 col-sm-12">
                    <div class="promotion-box">
                        <div class="text">
                            <h3>{{ $category->title }}</h3>
                            <a href="{{ route('showProductCategory', $category->slug) }}"class="btn-flat btn-hover"><span>shop collection</span></a>
                        </div>
                        <img src="{{ $category->photo }}" alt="">
                    </div>
                </div>
            @endforeach
        @endif
           
        </div>
    </div>

    <div class="section-footer">
        <a href="{{ route('showAllProducts') }}" class="btn-flat btn-hover">SHOP NOW</a>
    </div>

    <!-- New products -->
    <div class="section">
        <div class="container">
            <div class="section-header">
                <h2>New product</h2>
            </div>
            <div class="row">
                @if (count($new_products) > 0)
                    @foreach ($new_products as $new_product )
                        <div class="col-3 col-md-6 col-sm-12">
                            <div class="product-card">
                                @if ($new_product->conditions == 'new')
                                    <span class="new-span">New</span>
                                @elseif ($new_product->conditions == 'special')
                                    <span class="special-span">Special</span>
                                @elseif ($new_product->conditios == 'popular')
                                    <span class="popular-span">Popular</span>
                                @endif
                                <div class="product-card-img">
                                    <img src="{{ $new_product->photo }}" alt="">
                                    <img src="{{ $new_product->photo }}" alt="">
                                </div>
                                <div class="product-card-info">
                                    <div class="">
                                        <a class="btn-flat btn-hover btn-cart-add" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $new_product->id }}">
                                            <i class='bx bxs-zoom-in'></i>
                                        </a>
                                          
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $new_product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Quick view <span class="text-main"> {{ $new_product->title }}</span></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="product-card-img">
                                                                <img src="{{ $new_product->photo }}" alt="productImage">
                                                                <img src="{{ $new_product->photo }}" alt="productImage">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 float-left">
                                                            <h5>{{ $new_product->title }} </h5>
                                                            <div class="product-info-detail">
                                                                <span class="rating">
                                                                    <i class='bx bxs-star'></i>
                                                                    <i class='bx bxs-star'></i>
                                                                    <i class='bx bxs-star'></i>
                                                                    <i class='bx bxs-star'></i>
                                                                    <i class='bx bxs-star'></i>
                                                                </span>
                                                            </div>
                                                            <div class="product-card-price">
                                                                @if ($new_product->offer_price != $new_product->price)
                                                                <span><del>฿{{ number_format($new_product->price, 2) }}</del></span>
                                                                @else
                                                                    
                                                                @endif
                                                                <span class="curr-price">฿{{ number_format($new_product->offer_price, 2) }}</span>
                                                            </div>
                                                            <p>  {!! html_entity_decode($new_product->description) !!}</p> <br>

                                                            <div class="quantity">
                                                                <input type="number" data-id="{{$new_product->id}}" class="qty-text" id="qty" step="1" min="1" max="99" name="quantity" value="1">
                                                            </div>
                                                            
                                                            <div class="mt-2">
                                                                <a href="{{ route('showProductDetail', $new_product->slug) }}" class="btn-flat btn-hover btn-cart-add">
                                                                    <i class='bx bxs-show'></i>
                                                                </a>
                                                          
                                                                <a href="javascript:void(0);" data-quantity="1" data-product-id="{{ $new_product->id }}" class="btn-flat btn-hover btn-cart-add add_to_wishlist" id="add_to_wishlist{{$new_product->id}}">
                                                                    <i class='bx bxs-heart'></i>
                                                                </a>
                                                            
                                                                <a href="javascript:void(0);" data-quantity="1" data-product-id="{{ $new_product->id }}" class="btn-flat btn-hover btn-cart-add add_to_cart" id="add_to_cart{{$new_product->id}}">
                                                                    <i class='bx bxs-cart-add'></i>
                                                                </a>    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                </div>
                                            </div>
                                        </div>
                                            <a href="{{ route('showProductDetail', $new_product->slug) }}" class="btn-flat btn-hover btn-cart-add">
                                                <i class='bx bxs-show'></i>
                                            </a>
                                            <a href="javascript:void(0);" data-quantity="1" data-product-id="{{ $new_product->id }}" class="btn-flat btn-hover btn-cart-add add_to_wishlist" id="add_to_wishlist{{$new_product->id}}">
                                                <i class='bx bxs-heart'></i>
                                            </a>
                                          
                                            <a href="javascript:void(0);" data-quantity="1" data-product-id="{{ $new_product->id }}" class="btn-flat btn-hover btn-cart-add add_to_cart" id="add_to_cart{{$new_product->id}}">
                                                <i class='bx bxs-cart-add'></i>
                                            </a>                                         
                                        </div>
                                        <div class="product-card-name">
                                            {{ $new_product->title }}
                                        </div>
                                        <div class="product-card-price">
                                            @if ($new_product->offer_price != $new_product->price)
                                                <span><del>฿{{ number_format($new_product->price, 2) }}</del></span>
                                            @else
                                                
                                            @endif
                                            <span class="curr-price">฿{{ number_format($new_product->offer_price, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            
                        @endforeach               
                    @endif
                
            </div>
            <div class="section-footer">
                <a href="{{ route('showNewProducts') }}" class="btn-flat-new btn-hover">view all</a>
            </div>
        </div>
    </div>

   
    <!-- Banner -->
    <div class="section container">
        <div class="row">
            @if (count($banners) > 0)
                @foreach ($banners as $banner)
                    <div class="banner-container">
                        <div class="banner">
                            <div class="shoe">
                                <img src="{{ $banner->photo }}" alt="">
                            </div>
                            <div class="content">
                                <span>upto</span>
                                <h3>{{ $banner->title }}</h3>
                                <p>{!! html_entity_decode($banner->description) !!}</p>
                                {{-- <a href="#" class="btn">veiw offer</a> --}}
                            </div>
                            <div class="women">
                                <img src="{{ $banner->photo }}" alt="">
                            </div>
                        </div>
                    
                    </div>
                @endforeach
            @endif
        </div>
    </div>

  


    <!-- Popular products -->
    <div class="section">
        <div class="container">
            <div class="section-header">
                <h2>Popular products</h2>
            </div>
          
            <div class="row">
                @if (count($popular_products) > 0)
                    @foreach ($popular_products as $popular_product)
                        <div class="col-3 col-md-6 col-sm-12">
                            <div class="product-card">
                                @if ($popular_product->conditions == 'new')
                                    <span class="new-span">New</span>
                                @elseif ($popular_product->conditions == 'special')
                                    <span class="special-span">Special</span>
                                @elseif ($popular_product->conditions == 'popular')
                                    <span class="popular-span">Popular</span>
                                @endif
                                <div class="product-card-img">
                                    <img src="{{ $popular_product->photo }}" alt="PopularProduct">
                                    <img src="{{ $popular_product->photo }}" alt="PopularProduct">
                                </div>
                                <div class="product-card-info">
                                    <div class="">
                                        <a class="btn-flat btn-hover btn-cart-add" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $popular_product->id }}">
                                            <i class='bx bxs-zoom-in'></i>
                                        </a>
                                   
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $popular_product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Quick view <span class="text-main"> {{ $popular_product->title }}</span></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="product-card-img">
                                                                <img src="{{ $popular_product->photo }}" alt="productImage">
                                                                <img src="{{ $popular_product->photo }}" alt="productImage">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 float-left">
                                                            <h5>{{ $popular_product->title }} </h5>
                                                            <div class="product-info-detail">
                                                                <span class="rating">
                                                                    <i class='bx bxs-star'></i>
                                                                    <i class='bx bxs-star'></i>
                                                                    <i class='bx bxs-star'></i>
                                                                    <i class='bx bxs-star'></i>
                                                                    <i class='bx bxs-star'></i>
                                                                </span>
                                                            </div>
                                                            <div class="product-card-price">                                                 
                                                                @if ($popular_product->offer_price != $popular_product->price)
                                                                    <span><del>฿{{ number_format($popular_product->price, 2) }}</del></span>
                                                                @else
                                                                    
                                                                @endif
                                                                <span class="curr-price">฿{{ number_format($popular_product->offer_price, 2) }}</span>
                                                            </div>
                                                            <p>  {!! html_entity_decode($popular_product->description) !!}</p> <br>

                                                            <div class="quantity">
                                                                <input type="number" data-id="{{$popular_product->id}}" class="qty-text" id="qty" step="1" min="1" max="99" name="quantity" value="1">
                                                            </div>
                                                            <div class="mt-2">
                                                                <a href="{{ route('showProductDetail', $popular_product->slug) }}" class="btn-flat btn-hover btn-cart-add">
                                                                    <i class='bx bxs-show'></i>
                                                                </a>
                                                                <a href="javascript:void(0);" data-quantity="1" data-product-id="{{ $popular_product->id }}" class="btn-flat btn-hover btn-cart-add add_to_wishlist" id="add_to_wishlist{{$popular_product->id}}">
                                                                    <i class='bx bxs-heart'></i>
                                                                </a>
                                                                <a href="javascript:void(0);" data-quantity="1" data-product-id="{{ $popular_product->id }}" class="btn-flat btn-hover btn-cart-add add_to_cart" id="add_to_cart{{$popular_product->id}}">
                                                                    <i class='bx bxs-cart-add'></i>
                                                                </a>    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ route('showProductDetail', $popular_product->slug) }}" class="btn-flat btn-hover btn-cart-add">
                                            <i class='bx bxs-show'></i>
                                        </a>
                                        <a href="javascript:void(0);" data-quantity="1" data-product-id="{{ $popular_product->id }}" class="btn-flat btn-hover btn-cart-add add_to_wishlist" id="add_to_wishlist{{$popular_product->id}}">
                                            <i class='bx bxs-heart'></i>
                                        </a>
                                        <a href="javascript:void(0);" data-quantity="1" data-product-id="{{ $popular_product->id }}" class="btn-flat btn-hover btn-cart-add add_to_cart" id="add_to_cart{{$popular_product->id}}">
                                            <i class='bx bxs-cart-add'></i>
                                        </a>    
                                    </div>
                                    <div class="product-card-name">
                                        {{ $popular_product->title }}
                                    </div>
                                    <div class="product-card-price">
                                        @if ($popular_product->offer_price != $popular_product->price)
                                        <span><del>฿{{ number_format($popular_product->price, 2) }}</del></span>
                                        @else
                                            
                                        @endif
                                        <span class="curr-price">฿{{ number_format($popular_product->offer_price, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
    
            <div class="section-footer">
                <a href="{{ route('showPopularProducts') }}" class="btn-flat-pop btn-hover">view all</a>
            </div>
        </div>
    </div>

    
    <!-- Special  products -->
    <div class="section">
        <div class="container">
            <div class="section-header">
                <h2>Special products</h2>
            </div>
          
            <div class="row">
                @if (count($special_products) > 0)
                    @foreach ($special_products as $special_product)
                        <div class="col-3 col-md-6 col-sm-12">
                            <div class="product-card">
                                @if ($special_product->conditions == 'new')
                                    <span class="new-span">New</span>
                                @elseif ($special_product->conditions == 'special')
                                    <span class="special-span">Special</span>
                                @elseif ($special_product->conditios == 'popular')
                                    <span class="popular-span">Popular</span>
                                @endif
                                <div class="product-card-img">
                                    <img src="{{ $special_product->photo }}" alt="SpecialProduct">
                                    <img src="{{ $special_product->photo }}" alt="SpecialProduct">
                                </div>
                                <div class="product-card-info">
                                    <div class="">
                                        <a class="btn-flat btn-hover btn-cart-add" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $special_product->id }}">
                                            <i class='bx bxs-zoom-in'></i>
                                        </a>
                                   
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $special_product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Quick view <span class="text-main"> {{ $special_product->title }}</span></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="product-card-img">
                                                                <img src="{{ $special_product->photo }}" alt="productImage">
                                                                <img src="{{ $special_product->photo }}" alt="productImage">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 float-left">
                                                            <h5>{{ $special_product->title }} </h5>
                                                            <div class="product-info-detail">
                                                                <span class="rating">
                                                                    <i class='bx bxs-star'></i>
                                                                    <i class='bx bxs-star'></i>
                                                                    <i class='bx bxs-star'></i>
                                                                    <i class='bx bxs-star'></i>
                                                                    <i class='bx bxs-star'></i>
                                                                </span>
                                                            </div>
                                                            <div class="product-card-price">
                                                                @if ($special_product->offer_price != $special_product->price)
                                                                    <span><del>฿{{ number_format($special_product->price, 2) }}</del></span>
                                                                @else
                                                                    
                                                                @endif
                                                                <span class="curr-price">฿{{ number_format($special_product->offer_price, 2) }}</span>
                                                            </div>
                                                            <p>  {!! html_entity_decode($special_product->description) !!}</p> <br>

                                                            <div class="quantity">
                                                                <input type="number" data-id="{{$special_product->id}}" class="qty-text" id="qty" step="1" min="1" max="99" name="quantity" value="1">
                                                            </div>
                                                            <div class="mt-2">
                                                                <a href="{{ route('showProductDetail', $special_product->slug) }}" class="btn-flat btn-hover btn-cart-add">
                                                                    <i class='bx bxs-show'></i>
                                                                </a>
                                                                <a href="javascript:void(0);" data-quantity="1" data-product-id="{{ $special_product->id }}" class="btn-flat btn-hover btn-cart-add add_to_wishlist" id="add_to_wishlist{{$special_product->id}}">
                                                                    <i class='bx bxs-heart'></i>
                                                                </a>
                                                                <a href="javascript:void(0);" data-quantity="1" data-product-id="{{ $special_product->id }}" class="btn-flat btn-hover btn-cart-add add_to_cart" id="add_to_cart{{$special_product->id}}">
                                                                    <i class='bx bxs-cart-add'></i>
                                                                </a>    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ route('showProductDetail', $special_product->slug) }}" class="btn-flat btn-hover btn-cart-add">
                                            <i class='bx bxs-show'></i>
                                        </a>
                                        <a href="javascript:void(0);" data-quantity="1" data-product-id="{{ $special_product->id }}" class="btn-flat btn-hover btn-cart-add add_to_wishlist" id="add_to_wishlist{{$special_product->id}}">
                                            <i class='bx bxs-heart'></i>
                                        </a>
                                        <a href="javascript:void(0);" data-quantity="1" data-product-id="{{ $special_product->id }}" class="btn-flat btn-hover btn-cart-add add_to_cart" id="add_to_cart{{$special_product->id}}">
                                            <i class='bx bxs-cart-add'></i>
                                        </a>    
                                    </div>
                                    <div class="product-card-name">
                                        {{ $special_product->title }}
                                    </div>
                                    <div class="product-card-price">
                                        @if ($special_product->offer_price != $special_product->price)
                                        <span><del>฿{{ number_format($special_product->price, 2) }}</del></span>
                                        @else
                                            
                                        @endif
                                        <span class="curr-price">฿{{ number_format($special_product->offer_price, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
    
            <div class="section-footer">
                <a href="{{ route('showSpecialProducts') }}" class="btn-flat-spc btn-hover">view all</a>
            </div>
        </div>
    </div>


        {{-- Top Selling --}}
        @if (count($best_selling) > 0)
        <div class="container">
            <h1 class="text-brand">Top10 Best Selling</h1>
            <div class="logo-slider">
                @foreach ($best_selling as $item)
                <div class="item"><a href="{{ route('showProductDetail', $item->slug) }}"><img src="{{ $item->photo }}" width="300px" height="160px" alt=""></a></div>
                @endforeach
            
            </div>
        </div>
        @endif
    
    {{-- Best Rated --}}
    @if (count($best_rated) > 0)
    <div class="container">
        <h1 class="text-brand">Top10 Best Rated</h1>
        <div class="logo-slider">
            @foreach ($best_rated as $item)
                <div class="item"><a href="{{ route('showProductDetail', $item->slug) }}"><img src="{{ $item->photo }}" width="300px" height="160px" alt=""></a></div>
                {{-- @for ($i=0; $i<5; $i++)
                    @if (round($item->reviews->avg('rate') > $i))
                        <i class='bx bxs-star'></i>
                    @else  

                    @endif      
                @endfor                --}}
            @endforeach
            
        </div>
    </div>
    @endif

    <!-- Promotional Banner -->
    <div class="section container">
        <div class="row">
            @if (count($pro_banners) > 0)
                @foreach ($pro_banners as $pro_banner)
                    <div class="banner-container">
                        <div class="banner">
                            <div class="shoe">
                                <img src="{{ $pro_banner->photo }}" alt="">
                            </div>
                            <div class="content">
                                <span>upto</span>
                                <h3>{{ $pro_banner->title }}</h3>
                                <p>{!! html_entity_decode($pro_banner->description) !!}</p>
                                {{-- <a href="#" class="btn">veiw offer</a> --}}
                            </div>
                           
                        </div>
                    
                    </div>
                @endforeach
            @endif
        </div>
    </div>




    {{-- Brand --}}
    @if (count($brands) > 0)
     <div class="container">
         <h1 class="text-brand">OUR BRAND</h1>
         <div class="logo-slider">
             @foreach ($brands as $brand)
             <div class="item"><a href="#"><img src="{{ $brand->photo }}" width="300px" height="160px" alt=""></a></div>
             @endforeach
         
         </div>
     </div>
    @endif




@endsection

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">    
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">  

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
@section('scripts')

<script>
    $('.logo-slider').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        dots: true,
        arrows: true,
        autoplayspeed: 2000,
        infiniite: true,
    });


</script>

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
                $('#add_to_cart'+product_id).html('<i class="fa fa-spinner fa-spin"></i>');
            },
            complete:function() {
                $('#add_to_cart'+product_id).html('<i class="bx bxs-cart-add"></i>');
            },
            success:function(data) {
                console.log(data);
                if(data['status'] == true) {
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
                else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'please login',
                    })
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


