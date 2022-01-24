@extends('backEnd.layouts.master')

@section('content')


<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Coupons  
          <div class="btn-group">
            <a href="{{ route('createCoupon') }}" class="btn btn-round btn-sm btn-outline-info"> <i class="fa fa-plus-circle mr-1"></i>Create coupon</a>
            {{-- <a href="#" class="btn btn-round btn-sm btn-outline-success"><i class="fa fa-file-excel-o mr-1"></i>Import coupon</a> --}}
          </div>
        </h3>


      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5   form-group pull-right top_search">
          <div>
            <p class="float-right mr-5">Total Coupons: {{ $coupons->count() }}</p>
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
                <th>Code</th>
                <th>Type</th>
                <th>Value</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($coupons as $coupon)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td> {{ $coupon->code }}</td>
            <td>
                @if($coupon->type == 'fixed')
                  <span class="badge badge-pill badge-primary ">{{ $coupon->type }}</span>
                @else
                  <span class="badge badge-pill badge-success ">{{ $coupon->type }}</span>
                @endif
            </td>
  
            <td> 
              @if($coupon->type == 'percent')
                {{ $coupon->value }} %
              @else
                {{ $coupon->value }} 
              @endif
            
            </td>

            <td>
              <input type="checkbox" name="toggle" value="{{ $coupon->id }}" data-toggle="toggle" data-toggle="switchbutton" {{ $coupon->status == 'active' ? 'checked' : '' }} data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-size="small">
            </td>
            <td>  
                <div class="btn-group">
                  <a href="{{ route('editCoupon', $coupon->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-warning" data-placement="bottom"> <i class="fa fa-edit"></i></a>
                
                  <form action="{{ route('deleteCoupon', $coupon->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <a href="{{ route('deleteCoupon', $coupon->id) }}" data-toggle="tooltip" title="Delete" data-id="{{ $coupon->id }}" class="btn btn-danger deleteBtn ml-2" data-placement="bottom"> <i class="fa fa-trash-o"></i></a>
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
          'Coupon has been deleted.',
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
      url: "{{ route('couponChangeStatus') }}",
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



@endsection

