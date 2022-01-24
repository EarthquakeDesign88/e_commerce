@extends('backEnd.layouts.master')

@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><span> <a href="{{ route('showBrands') }}" data-toggle="tooltip" title="Back" class="btn btn-info" data-placement="bottom"> <i class="fa fa-chevron-left"></i></a></span> Edit brand</h3>
      </div>
    </div>

    <div class="clearfix"></div>

</div>


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
        <div class="x_content">
            <form class="" action="{{ route('updateBrand', $brand->id) }}" method="post" novalidate>
                @csrf
                <span class="section text-info">{{ $brand->title }}</span>
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Title<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="title" id="title" value="{{ $brand->title }}" placeholder="Enter title" required="required" />
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Photo<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <div class="input-group">
                            <span class="input-group-btn">
                              <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose
                              </a>
                            </span>
                            <input id="thumbnail" class="form-control" type="text" name="photo" value="{{ $brand->photo }}">
                          </div>
                          <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Status<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 ">
                        <select name="status" id="status" class="form-control">
                            {{-- <option value="">-- Status --</option> --}}
                            <option value="active" {{ $brand->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $brand->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>   
                </div>

                <div class="ln_solid">
                    <div class="form-group">
                        <div class="col-md-6 offset-md-3">
                            <button type='submit' class="btn btn-info">Submit</button>
                            <a href="{{ route('showBrands') }}" class="btn btn-outline-success">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
  
@endsection


@section('scripts')
<script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
     $('#lfm').filemanager('image');


</script>
@endsection

