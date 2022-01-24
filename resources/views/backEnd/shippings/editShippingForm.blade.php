@extends('backEnd.layouts.master')

@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><span> <a href="{{ route('showShippings') }}" data-toggle="tooltip" title="Back" class="btn btn-info" data-placement="bottom"> <i class="fa fa-chevron-left"></i></a></span>Edit shipping</h3>
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
            <form class="" action="{{ route('updateShipping', $shipping->id) }}" method="post" novalidate>
                @csrf
                <span class="section text-info">{{ $shipping->shipping_address }}</span>

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Shipping Type<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" class="form-control" data-validate-length-range="6" data-validate-words="2" name="shipping_address" id="shipping_address" value="{{ $shipping->shipping_address }}" placeholder="Enter shipping type" required="required" />
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Delivery Time<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" class="form-control" data-validate-length-range="6" data-validate-words="2" name="delivery_time" id="delivery_time" value="{{ $shipping->delivery_time }}" placeholder="Enter delivery time" required="required" />
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Delivery Charge<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="number" step="any" min="1" class="form-control" data-validate-length-range="6" data-validate-words="2" name="delivery_charge" id="delivery_charge" value="{{ $shipping->delivery_charge }}" placeholder="Enter delivery charge" required="required" />
                    </div>
                </div>

         
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Status<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 ">
                        <select name="status" id="status" class="form-control">
                            {{-- <option value="">-- Status --</option> --}}
                            <option value="active" {{ $shipping->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $shipping->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>   
                </div>

                <div class="ln_solid">
                    <div class="form-group">
                        <div class="col-md-6 offset-md-3">
                            <button type='submit' class="btn btn-info">Update</button>
                            <a href="{{ route('showShippings') }}" class="btn btn-outline-success">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
  
@endsection


