@extends('backEnd.layouts.master')

@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><span> <a href="{{ route('showCoupons') }}" data-toggle="tooltip" title="Back" class="btn btn-info" data-placement="bottom"> <i class="fa fa-chevron-left"></i></a></span>Create coupon</h3>
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
            <form class="" action="{{ route('insertCoupon') }}" method="post" novalidate>
                @csrf
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Coupon Code<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="code" id="code" value="{{ old('code') }}" placeholder="Enter code" required="required" />
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Coupon Type<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 ">
                        <select name="type" id="type" class="form-control">
                            {{-- <option value="">-- Type --</option> --}}
                            <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                            <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Percent</option>
                        </select>
                    </div>   
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Coupon Value<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="value" id="value" value="{{ old('value') }}" placeholder="Enter value" required="required" />
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
                            <a href="{{ route('showCoupons') }}" class="btn btn-outline-success">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
  
@endsection


