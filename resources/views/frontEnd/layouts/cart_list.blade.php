<table class="table">
    <thead>
        <tr class="text-cart">
            {{-- <td class="delete-all"><a href=""><i class="far fa-trash-alt" data-id=""></i></a></td> --}}
            <td class="image">Image</td>
            <td class="description">Product</td>
            <td class="price">Price</td>
            <td class="quantity">Quantity</td>
            <td class="total">Total</td>
            <td class="reload" id="reload"></td>
        </tr>
    </thead>
    <tbody>
        @if (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() > 0)
            @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                <tr>
                    {{-- <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $item->rowId }}" id="flexCheckChecked">  
                        </div>
                    </td> --}}
                    <td class="cart_product">
                        <img src="{{ $item->model->photo }}" alt=""width="100px" height="100px">
                    </td>
                    <td class="cart_description">
                        <h5><a href="{{ route('showProductDetail', $item->model->slug) }}"> {{ $item->name }} </a></h5>
                    </td>
                    <td class="cart_price">
                        <p>฿{{ number_format($item->price, 2) }}</p>
                    </td>
                    <td class="cart_quantity">
                        <input type="number" class="qty-text" data-id="{{ $item->rowId }}" id="qty-input-{{ $item->rowId }}" step="1" min="1" max="99" name="quantity" value="{{ $item->qty }}">    
                        <input type="hidden" data-id="{{ $item->rowId }}" data-product-quantity="{{ $item->model->stock }}" id="update-cart-{{ $item->rowId }}">
                    </td>
                 
                    <td class="cart_total">
                        <p class="cart_total_price">฿ {{ number_format($item->subtotal, 2) }} </p>
                    </td>
                    <td class="cart_deleteItem">
                        <a class="cart_delete" data-id="{{ $item->rowId }}" href=""><i class="fa fa-times"></i></a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6">
                    <div class="alert alert-danger" role="alert">
                        You dont' have any cart product!
                    </div>
                </td>
            </tr>
        @endif


   
    </tbody>
</table>


