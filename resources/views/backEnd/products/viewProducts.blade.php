@extends('backEnd.layouts.master')

@section('content')


<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Products  
          <div class="btn-group">
            <a href="{{ route('createProduct') }}" class="btn btn-round btn-sm btn-outline-info"> <i class="fa fa-plus-circle mr-1"></i>Create product</a>
            {{-- <a href="#" class="btn btn-round btn-sm btn-outline-success"><i class="fa fa-file-excel-o mr-1"></i>Import banner</a> --}}
          </div>
        </h3>


      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5   form-group pull-right top_search">
          <div>
            <p class="float-right mr-5">Total Products: {{ $products->count() }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="col-lg-12">
      @include('backEnd.layouts.notification')
    </div>

</div>
<div class="col-md-12 col-sm-12 "> 
    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Photo</th>
                <th>Price</th>
                <th>Offer price</th>
                <th>Discount</th>
                <th>Condition</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $product->title }}</td>
            <td>
              <img src="{{ $product->photo }}" alt="product_image" height="150px" width="200px">
            </td>
            <td>{{ number_format($product->price, 2) }}</td>
            <td>{{ number_format($product->offer_price, 2) }}</td>
            <td>{{ $product->discount }} %</td>
            <td>
              @if($product->conditions == 'new')
                <p>  <span class="badge badge-pill badge-new">{{ $product->conditions }}</span> </p>
              @elseif($product->conditions == 'popular')
                <p> <span class="badge badge-pill badge-popular">{{ $product->conditions }}</span> </p>
              @else
                <p> <span class="badge badge-pill badge-special">{{ $product->conditions }}</span> </p>
              @endif
            </td>
            <td>
              <input type="checkbox" name="toggle" value="{{ $product->id }}" data-toggle="toggle" data-toggle="switchbutton" {{ $product->status == 'active' ? 'checked' : '' }} data-on="active" data-off="inactive" data-onstyle="success" data-offstyle="danger" data-size="small">
  
            </td>
            <td>  
                <div class="btn-group">

                  <a href="" class="btn btn-secondary" data-toggle="modal" title="view" data-target=".viewDetails{{$product->id}}" data-placement="bottom"><i class="fa fa-eye"></i></a>
                  <div class="modal fade viewDetails{{$product->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">{{ \Illuminate\Support\Str::upper($product->title)}}</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <strong>Summary:</strong>
                          <p> {!!  html_entity_decode($product->summary) !!}</p>
                          <strong>Description:</strong>
                          <p> {!!  html_entity_decode($product->description) !!}</p>

                          <div class="row">
                            <div class="col-md-3">
                              <strong>Price:</strong>
                              <p> {{ number_format($product->price, 2) }}</p>
                            </div>

                            <div class="col-md-3">
                              <strong>Offer price:</strong>
                              <p> {{ number_format($product->offer_price, 2) }}</p>
                            </div>

                            <div class="col-md-3">
                              <strong>Discount:</strong>
                              <p> {{ $product->discount}} %</p>
                            </div>

                            <div class="col-md-3">
                              <strong>Stock:</strong>
                              <p> {{ $product->stock}}</p>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6">
                              <strong>Category:</strong>
                              <p> {{ \App\Models\Category::where('id', $product->category_id)->value('title') }}</p>
                            </div>

                            <div class="col-md-6">
                              <strong>Child Category:</strong>
                              @if ($product->child_cat_id)
                                <p> {{ \App\Models\Category::where('id', $product->child_cat_id)->value('title') }}</p>
                              @else
                                <p> - </p>
                              @endif
                            </div>
                          </div>

                          
                          <div class="row">
                            <div class="col-md-6">
                              <strong>Brand:</strong>
                              <p> {{ \App\Models\Brand::where('id', $product->brand_id)->value('title') }}</p>
                            </div>

                            <div class="col-md-6">
                              <strong>Size:</strong>
                              <p> {{ $product->size }} </p>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6">
                              <strong>Condition:</strong>
                              @if($product->conditions == 'new')
                                <p>  <span class="badge badge-pill badge-new">{{ $product->conditions }}</span> </p>
                              @elseif($product->conditions == 'popular')
                                <p> <span class="badge badge-pill badge-popular">{{ $product->conditions }}</span> </p>
                              @else
                                <p> <span class="badge badge-pill badge-special">{{ $product->conditions }}</span> </p>
                              @endif
                            </div>

                            <div class="col-md-6">
                              <strong>Status:</strong>
                              @if ($product->status == 'active')
                                <p>  <span class="badge badge-pill badge-success">{{ $product->status }}</span></p>
                              @else
                              <p>  <span class="badge badge-pill badge-danger">{{ $product->status }}</span></p>
                              @endif
                            </div>
                          </div>
                          
                          <div class="row">
                            <div class="col-md-6">
                              <strong>Created date:</strong>
                              <p> {{date('d F Y H:i:s', strtotime($product->created_at))}} </p>             
                            </div>

                            <div class="col-md-6">
                              <strong>Updated date:</strong>
                              <p> {{date('d F Y H:i:s', strtotime($product->updated_at))}}  </p>
                            </div>
                          </div>
                      
                        

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                        </div>
                      </div>
                    </div>
                  </div>
                  <a href="{{ route('showProductAttribute', $product->id) }}" data-toggle="tooltip" title="Add Attribute" class="btn btn-primary ml-2" data-placement="bottom"> <i class="fa fa-plus"></i></a>
                  <a href="{{ route('editProduct', $product->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-warning ml-2" data-placement="bottom"> <i class="fa fa-edit"></i></a>
              
                  <form action="{{ route('deleteProduct', $product->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <a href="{{ route('deleteProduct', $product->id) }}" data-toggle="tooltip" title="Delete" data-id="{{ $product->id }}" class="btn btn-danger deleteBtn ml-2" data-placement="bottom"> <i class="fa fa-trash-o"></i></a>
                  </form>  
                </div>
                                 
            </td>
          </tr>
        @endforeach
        </tbody>
    </table>

</div>

    
@endsection


@section('scripts')


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
          'Product has been deleted.',
          'success'
        )
      }
    })

  });
</script>

<script>
  //Change status
  $('input[name=toggle]').change(function() {
    var mode = $(this).prop('checked');
    var id = $(this).val();
    // alert(id);

    $.ajax({
      url: "{{ route('productChangeStatus') }}",
      type: "POST",
      data:{
        _token: '{{ csrf_token() }}',
        mode: mode,
        id: id,
      },

      success:function(response){
        if(response.status) {
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Status has been updated successfully.',
            showConfirmButton: false,
            timer: 1500
          });
        } else {
          Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Please try again!',
            showConfirmButton: false,
            timer: 1500
          });
        }
      }
    })

  });
</script>


<style>

  .badge-new {
    color: #fff;
    background-color: #e60d0d;
  }

  .badge-popular {
    color: #fff;
    background-color: #7c2efa;
  }

  .badge-special {
    color: #fff;
    background-color: #05a2f7;
  }
</style>

@endsection




