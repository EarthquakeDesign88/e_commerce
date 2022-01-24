@if (count($products) > 0)
    @foreach ($products as $product)
        <div class="col-4 col-md-6 col-sm-12">
            @if ($product->stock > 0)
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
                            @if ($product->offer_price != $product->price)
                                <span><del>฿{{ number_format($product->price, 2) }}</del></span>
                            @else
                                
                            @endif
                                <span class="curr-price">฿{{ number_format($product->offer_price, 2) }}</span>
                        </div>
                    </div>
                </div>
            @else
                <div class="product-card-img card">
                    <h4 class="text-muted">Sold Out</h4>
                </div>
                <div class="product-card-info">
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
            @endif
        </div>
    @endforeach
@else
    <div class="alert alert-danger" role="alert">
        Product not found
    </div>
@endif