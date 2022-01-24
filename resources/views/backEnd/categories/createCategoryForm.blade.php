@extends('backEnd.layouts.master')

@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><span> <a href="{{ route('showCategories') }}" data-toggle="tooltip" title="Back" class="btn btn-info" data-placement="bottom"> <i class="fa fa-chevron-left"></i></a></span>Create category</h3>
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
            <form class="" action="{{ route('insertCategory') }}" method="post" novalidate>
                @csrf
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Title<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="title" id="title" value="{{ old('title') }}" placeholder="Enter title" required="required" />
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Summary<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <textarea name="summary" id="summary" value="{{ old('summary') }}"><p>Enter summary</p></textarea>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Is parent<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="checkbox" name="is_parent" id="is_parent" value="1" checked>Yes
                    </div>
                </div>

                <div class="field item form-group d-none" id="parent_cat_div">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Parent Category<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 ">
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="">-- Parent Category --</option>
                            @foreach ($parent_cats as $p_cats)
                                <option value="{{ $p_cats->id }}">{{ $p_cats->title }}</option>
                            @endforeach
                        </select>
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
                            <input id="thumbnail" class="form-control" type="text" name="photo">
                          </div>
                          <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Status<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 ">
                        <select name="status" id="status" class="form-control">
                            {{-- <option value="">-- Status --</option> --}}
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>   
                </div>

                <div class="ln_solid">
                    <div class="form-group">
                        <div class="col-md-6 offset-md-3">
                            <button type='submit' class="btn btn-info">Submit</button>
                            <a href="{{ route('showCategories') }}" class="btn btn-outline-success">Cancel</a>
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

        $(document).ready(function() {
            $('#summary').summernote();
        });
    </script>

    <script>
        $('#is_parent').change(function(e) {
            e.preventDefault();
            var is_checked = $('#is_parent').prop('checked');
            // alert(is_checked);
            if(is_checked) {
                $('#parent_cat_div').addClass('d-none');
                $('#parent_cat_div').val('');
            } else {
                $('#parent_cat_div').removeClass('d-none');
            }
        });
    </script>
@endsection

