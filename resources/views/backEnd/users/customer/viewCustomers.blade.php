@extends('backEnd.layouts.master')

@section('content')


<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Customers  
          <div class="btn-group">
            <a href="{{ route('createCustomer') }}" class="btn btn-round btn-sm btn-outline-info"> <i class="fa fa-plus-circle mr-1"></i>Create account</a>
            {{-- <a href="#" class="btn btn-round btn-sm btn-outline-success"><i class="fa fa-file-excel-o mr-1"></i>Import banner</a> --}}
          </div>
        </h3>


      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5   form-group pull-right top_search">
          <div>
            <p class="float-right mr-5">Total Customers: {{ $customers->count() }}</p>
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
              <th>Fullname</th>
              <th>Username</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Role</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
      @foreach ($customers as $customer)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $customer->full_name }}</td>
          <td>{{ $customer->username }}</td>
          <td>{{ $customer->email }}</td>
          <td>{{ $customer->phone }}</td>
          <td>{{ $customer->address }}, {{ $customer->city}} {{ $customer->state}} {{ $customer->country}} {{ $customer->postcode}}</td>
          <td>
            @if($customer->role == 'customer')
              <p> <span class="badge badge-pill badge-success">{{ $customer->role }}</span> </p>
            @else
              <p> <span class="badge badge-pill badge-info">{{ $customer->role }}</span> </p>
            @endif
          
          </td>
          <td>  
            <div class="btn-group">
              <a href="{{ route('editCustomer', $customer->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-warning" data-placement="bottom"> <i class="fa fa-edit"></i></a>
              <a href="{{ route('resetPasswordCustomer', $customer->id) }}" data-toggle="tooltip" title="Reset Password" class="btn btn-primary ml-2" data-placement="bottom"> <i class="fa fa-unlock-alt"></i></a>
              <form action="{{ route('deleteCustomer', $customer->id) }}" method="post">
                @csrf
                @method('delete')
                <a href="{{ route('deleteCustomer', $customer->id) }}" data-toggle="tooltip" title="Delete" data-id="{{ $customer->id }}" class="btn btn-danger deleteBtn ml-2" data-placement="bottom"> <i class="fa fa-trash-o"></i></a>
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
          'Customer account has been deleted.',
          'success'
        )
      }
    })

  });
</script>

@endsection