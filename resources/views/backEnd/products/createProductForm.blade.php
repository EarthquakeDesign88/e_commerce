@extends('backEnd.layouts.master')

@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><span> <a href="{{ route('showProducts') }}" data-toggle="tooltip" title="Back" class="btn btn-info" data-placement="bottom"> <i class="fa fa-chevron-left"></i></a></span>Create product </h3>
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
            <form class="" action="{{ route('insertProduct') }}" method="post" novalidate>
                @csrf
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Title<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="title" id="title" value="{{ old('title') }}" placeholder="Enter title" required="required" />
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Summary<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <textarea name="summary" id="summary" value="{{ old('summary') }}"><p>Enter summary</p></textarea>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Description<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <textarea name="description" id="description" value="{{ old('description') }}"><p>Enter description</p></textarea>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Additional Info<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <textarea name="additional_info" id="additional_info" value="{{ old('additional_info') }}"><p>Enter Additional Info</p></textarea>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Return Cancellation<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <textarea name="return_cancellation" id="return_cancellation" value="{{ old('return_cancellation') }}"><p>Enter return Cancellation</p></textarea>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Stock<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="number" min="0" class="form-control" data-validate-length-range="6" data-validate-words="2" name="stock" id="stock" value="{{ old('stock') }}" placeholder="Enter stock" required="required" />
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Price<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="number" min="0" step="any" class="form-control" data-validate-length-range="6" data-validate-words="2" name="price" id="price" value="{{ old('price') }}" placeholder="Enter price" required="required" />
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Discount(%)<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="number" min="0" step="any" class="form-control" data-validate-length-range="6" data-validate-words="2" name="discount" id="discount" value="{{ old('discount') }}" placeholder="Enter discount" required="required" />
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Brand<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <select name="brand_id" id="brand_id" class="form-control">
                            <option value="">-- Brand --</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Category<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <select id="category_id" name="category_id" class="form-control">
                            <option value="">-- Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="field item form-group d-none" id="child_cat_div">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Child Category<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <select id="chil_cat_id" name="child_cat_id" class="form-control">
                            <option value="">-- Child Category --</option>
                        </select>
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Size<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <select name="size" id="size" class="form-control">
                            <option value="">-- Size --</option>
                            <option value="S" {{old('size') == 'S' ? 'selected' : '' }}>Small</option>
                            <option value="M" {{old('size') == 'M' ? 'selected' : '' }}>Medium</option>
                            <option value="L" {{old('size') == 'L' ? 'selected' : '' }}>Large</option>
                            <option value="XL" {{old('size') == 'XL' ? 'selected' : '' }}>Extra Large</option>
                        </select>
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Conditions<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <select name="conditions" id="conditions" class="form-control">
                            <option value="">-- Condition --</option> 
                            <option value="new" {{old('conditions') == 'new' ? 'selected' : '' }}>New</option>
                            <option value="popular" {{old('conditions') == 'popular' ? 'selected' : '' }}>Popular</option>
                            <option value="special" {{old('conditions') == 'special' ? 'selected' : '' }}>Special</option>
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
                            <a href="{{ route('showProducts') }}" class="btn btn-outline-success">Cancel</a>
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
     $('#lfm2').filemanager('image');


     $(document).ready(function() {
        $('#summary').summernote();
        $('#description').summernote();
        $('#additional_info').summernote();
        $('#return_cancellation').summernote();

    });
</script>

<script>
    $('#category_id').change(function() {
        var category_id = $(this).val();
        
        if(category_id != null) {
            $.ajax({
                url: "/admin/category/"+category_id+"/child",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    category_id: category_id
                },
                success:function(response) {
                    var html_option = "<option value=''>-- Child Category --</option>";
                    if(response.status) {
                        $('#child_cat_div').removeClass('d-none');
                        $.each(response.data, function(id, title){
                            html_option += "<option value='"+id+"'>"+title+"</option>"
                        });
                    } else {
                        $('#child_cat_div').addClass('d-none');
                    }
                    $('#chil_cat_id').html(html_option);
                }
            });
        }
    });
</script>
@endsection

