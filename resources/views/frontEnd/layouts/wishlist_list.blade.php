<table class="table">
    <thead>
        <tr class="text-cart">
            {{-- <td class="delete-all"><a href=""><i class="far fa-trash-alt" data-id=""></i></a></td> --}}
            <td class="image">Image</td>
            <td class="description">Product</td>
            <td class="price">Price</td>
            <td class="total"></td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        @if (\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count() > 0)
            @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->content() as $item)
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

                    <td class="cart_total">
                        <a href="javascript:void(0);" data-id="{{ $item->rowId }}" class="btn-flat btn-hover btn-shop-now move_to_cart" id="move_to_cart{{ $item->rowId }}">Add to cart</a>
                    </td>
                    <td class="cart_deleteItem">
                        <a  href="" class="wishlist_delete" data-id="{{ $item->rowId }}"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6">
                    <div class="alert alert-danger" role="alert">
                        You don't have any wishlist product!
                    </div>
                </td>
            </tr>
        @endif
   
    </tbody>
</table>

