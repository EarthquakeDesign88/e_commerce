@extends('backEnd.layouts.master')

@section('content')

<div class="col-lg-12">
    @include('backEnd.layouts.notification')
</div>

<div class="page-title">
    <div class="title_left">
    <h3><span> <a href="{{ route('showProducts') }}" data-toggle="tooltip" title="Back" class="btn btn-info" data-placement="bottom"> <i class="fa fa-chevron-left"></i></a></span>Product Attribute</h3>
    </div>
</div>

<div class="clearfix"></div>


<div class="row">
    <div class="col-md-12 col-sm-12">
        @if ($errors->any())          
            <div class="alert alert-danger alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="text-info">
            <h3>{{ $product->title }}</h3>
        </div>
    </div>
</div>


<form action="{{ route('addProductAttribute', $product->id) }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-7">
            <div id="product_attribute" class="content" data-mfield-options='{"section": ".group","btnAdd":"#btnAdd-1","btnRemove":".btnRemove"}'>
                <button type="button" id="btnAdd-1" class="btn btn-sm btn-success"> <i class="fa fa-plus mr-1"></i> Add</button>
                <div class="row group mt-2">
                    <div class="col-md-2">
                        <label for="size">Size</label>
                        <input class="form-control form-control-sm" name="size[]" placeholder="eg. S" type="text">
                    </div>
                    <div class="col-md-2">
                        <label for="originalPrice">Original Price</label>
                        <input class="form-control form-control-sm" name="original_price[]" placeholder="eg. 1200" type="number" min="1">
                    </div>
                    <div class="col-md-2">
                        <label for="offerPrice">Offer Price</label>
                        <input class="form-control form-control-sm" name="offer_price[]" placeholder="eg. 1200" type="number" min="1">
                    </div>
                    <div class="col-md-2">
                        <label for="stock">Stock</label>
                        <input class="form-control form-control-sm" name="stock[]" placeholder="eg. 4" type="number" min="1">
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-sm btn-danger btnRemove mt-4"><i class="fa fa-trash-o"></i></button>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-info mt-2"> Submit</button>
        </div>
        
        <div class="col-md-5">
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Original Price</th>
                        <th>Offer Price</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($productAttribute) > 0)
                        @foreach ($productAttribute as $product_attr)
                        <tr>
                            <td>{{ $product_attr->size }}</td>
                            <td>{{ number_format($product_attr->original_price, 2) }}</td>
                            <td>{{ number_format($product_attr->offer_price, 2)}}</td>
                            <td>{{ $product_attr->stock }}</td>
                            <td>
                                <form action="{{ route('deleteProductAttribute', $product_attr->id ) }}" method="post">
                                    @csrf
                                    {{-- @method('delete') --}}
                                    <a href="" data-toggle="tooltip" title="delete" data-id="{{ $product_attr->id  }}" class="btn btn-danger deleteBtn ml-2" data-placement="bottom"> <i class="fa fa-trash-o"></i></a>
                                </form>  
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">Data not found</td>
                        </tr>
                    @endif
        
                </tbody>
            </table>
        
        </div>
    </div>
</form>

  
@endsection


@section('scripts')
    <script src="{{ asset('admin/js/multifield/jquery.multifield.min.js') }}"></script>
    <script>
        $('#product_attribute').multifield();
    </script>



    <script>
    //Delete
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  
    $('.deleteBtn').click(function(e){
      var form = $(this).closest('form');
      var dataID = $(this).data('id');
      e.preventDefault();
  
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
          Swal.fire(
            'Deleted!',
            'product attribute has been deleted successfully.',
            'success'
          )
        }
      })
  
    });
    </script> 
  

@endsection

