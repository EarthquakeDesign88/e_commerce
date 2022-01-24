@extends('backEnd.layouts.master')

@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>About us Setup</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12">
        @include('backEnd.layouts.notification')
    </div>

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
            <form class="" action="{{ route('updateAboutUs') }}" method="post" novalidate>
                @method('put')
                @csrf

                @foreach ($aboutUs as $info)
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Header<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text" class="form-control" data-validate-length-range="6" data-validate-words="2" name="header" id="header" value="{{ $info->header }}" placeholder="Enter header" required="required" />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Content<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <textarea name="content" id="content" value="{{ $info->content }}"><p>{{ $info->content }}</p></textarea>
                        </div>
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">More details<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <textarea name="more_details" id="more_details" value="{{ $info->more_details }}"><p>{{ $info->more_details }}</p></textarea>
                        </div>
                    </div>
          
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Image<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="input-group-btn">
                                  <a id="image" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                  </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="image" value="{{ $info->image }}">
                              </div>
                              <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                        </div>
                    </div>



                    <div class="ln_solid">
                        <div class="form-group">
                            <div class="col-md-6 offset-md-3">
                                <button type='submit' class="btn btn-info float-right">Save change</button>
                            </div>
                        </div>
                    </div>
                   
                @endforeach
            </form>
        </div>
    </div>
</div>
  
@endsection


@section('scripts')
<script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
    $('#image').filemanager('image');


    $(document).ready(function() {
        $('#content').summernote();
        $('#more_details').summernote();
    });
</script>
@endsection

