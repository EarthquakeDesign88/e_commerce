@extends('backEnd.layouts.master')

@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Website Setting</h3>
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
            <form class="" action="{{ route('updateWebsiteInfo') }}" method="post" novalidate>
                @method('put')
                @csrf

                @foreach ($web_info as $info)
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Title<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text" class="form-control" data-validate-length-range="6" data-validate-words="2" name="title" id="title" value="{{ $info->title }}" placeholder="Enter title" required="required" />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Logo<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="input-group-btn">
                                  <a id="logo" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                  </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="logo" value="{{ $info->logo }}">
                              </div>
                              <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                        </div>
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Phone<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text"  class="form-control" data-validate-length-range="6" data-validate-words="2" name="phone" id="phone" value="{{ $info->phone }}" placeholder="Enter phone" required="required" />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Email<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text"  class="form-control" data-validate-length-range="6" data-validate-words="2" name="email" id="email" value="{{ $info->email }}" placeholder="Enter email" required="required" />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Address<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <textarea id="message" required="required" class="form-control"  name="address" id="address" value="{{ $info->address }}" placeholder="Enter address" required="required" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10">{{ $info->address }}</textarea>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Facebook URL<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text"  class="form-control" data-validate-length-range="6" data-validate-words="2" name="facebook_url" id="facebook_url" value="{{ $info->facebook_url }}" placeholder="Enter URL" required="required" />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Instagram URL<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text"  class="form-control" data-validate-length-range="6" data-validate-words="2" name="instagram_url" id="instagram_url" value="{{ $info->instagram_url }}" placeholder="Enter URL" required="required" />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Line URL<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text"  class="form-control" data-validate-length-range="6" data-validate-words="2" name="line_url" id="line_url" value="{{ $info->line_url }}" placeholder="Enter URL" required="required" />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Meta title<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text"  class="form-control" data-validate-length-range="6" data-validate-words="2" name="meta_title" id="meta_title" value="{{ $info->meta_title }}" placeholder="Enter meta title" required="required" />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Meta keywords<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">                          
                            <textarea id="message" required="required" class="form-control"  name="meta_keywords" id="meta_keywords" value="{{ $info->meta_keywords }}" placeholder="Enter meta keywords" required="required" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10">{{ $info->meta_keywords }}</textarea>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Meta URL<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text"  class="form-control" data-validate-length-range="6" data-validate-words="2" name="meta_url" id="meta_url" value="{{ $info->meta_url }}" placeholder="Enter meta title" required="required" />
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Meta description<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">                          
                            <textarea id="message" required="required" class="form-control"  name="meta_description" id="meta_description" value="{{ $info->meta_description }}" placeholder="Enter meta keywords" required="required" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10">{{ $info->meta_description }}</textarea>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Meta Image <small>paste url</small><span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">                          
                            <textarea id="message" required="required" class="form-control"  name="meta_image" id="meta_image" value="{{ $info->meta_image }}" placeholder="Enter meta image" required="required" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="10" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10">{{ $info->meta_image }}</textarea>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Favicon apple icon<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="input-group-btn">
                                  <a id="apple_touch_icon" data-input="thumbnail2" data-preview="holder2" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                  </a>
                                </span>
                                <input id="thumbnail2" class="form-control" type="text" name="apple_touch_icon" value="{{ $info->apple_touch_icon }}">
                              </div>
                              <div id="holder2" style="margin-top:15px;max-height:100px;"></div>
                        </div>
                    </div>
                    
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Favicon icon 16px<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="input-group-btn">
                                  <a id="icon_md" data-input="thumbnail4" data-preview="holder4" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                  </a>
                                </span>
                                <input id="thumbnail4" class="form-control" type="text" name="icon_sm" value="{{ $info->icon_sm }}">
                              </div>
                              <div id="holder4" style="margin-top:15px;max-height:100px;"></div>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Favicon icon 32px<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <div class="input-group">
                                <span class="input-group-btn">
                                  <a id="icon_sm" data-input="thumbnail3" data-preview="holder3" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                  </a>
                                </span>
                                <input id="thumbnail3" class="form-control" type="text" name="icon_md" value="{{ $info->icon_md }}">
                              </div>
                              <div id="holder3" style="margin-top:15px;max-height:100px;"></div>
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
     $('#logo').filemanager('image');
     $('#apple_touch_icon').filemanager('image');
     $('#icon_sm').filemanager('image');
     $('#icon_md').filemanager('image');
     $('#manifest').filemanager('image');
     $('#mask_icon').filemanager('image');
     $('#shortcut_icon').filemanager('image');
     $('#msapplication_config').filemanager('image');
</script>
@endsection

