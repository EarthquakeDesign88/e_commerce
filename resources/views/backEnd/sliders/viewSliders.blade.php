@extends('backEnd.layouts.master')

@section('content')


<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Sliders  
          <div class="btn-group">
            <a href="{{ route('createSlider') }}" class="btn btn-round btn-sm btn-outline-info"> <i class="fa fa-plus-circle mr-1"></i>Create slider</a>
            {{-- <a href="#" class="btn btn-round btn-sm btn-outline-success"><i class="fa fa-file-excel-o mr-1"></i>Import slider</a> --}}
          </div>
        </h3>


      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5   form-group pull-right top_search">
          <div>
            <p class="float-right mr-5">Total Sliders: {{ $sliders->count() }}</p>
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
                <th>Sub title</th>
                <th>Description</th>
                <th>Photo</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($sliders as $slider)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $slider->title }}</td>
            <td>{{ $slider->sub_title }}</td>
            <td>{!! html_entity_decode($slider->description) !!}</td>
            <td>
              <img src="{{ $slider->photo }}" alt="slider_image" height="90px" width="200px">
            </td>
            <td>
              <input type="checkbox" name="toggle" value="{{ $slider->id }}" data-toggle="toggle" data-toggle="switchbutton" {{ $slider->status == 'active' ? 'checked' : '' }} data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-size="small">
  
            </td>
            <td>  
                <div class="btn-group">
                  <a href="{{ route('editSlider', $slider->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-warning" data-placement="bottom"> <i class="fa fa-edit"></i></a>
                
                  <form action="{{ route('deleteSlider', $slider->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <a href="{{ route('deleteSlider', $slider->id) }}" data-toggle="tooltip" title="Delete" data-id="{{ $slider->id }}" class="btn btn-danger deleteBtn ml-2" data-placement="bottom"> <i class="fa fa-trash-o"></i></a>
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
          'Slider has been deleted.',
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
      url: "{{ route('sliderChangeStatus') }}",
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

