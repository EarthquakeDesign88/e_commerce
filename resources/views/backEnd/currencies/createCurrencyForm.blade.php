@extends('backEnd.layouts.master')

@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><span> <a href="{{ route('showCurrencies') }}" data-toggle="tooltip" title="Back" class="btn btn-info" data-placement="bottom"> <i class="fa fa-chevron-left"></i></a></span>Create currency</h3>
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
            <form class="" action="{{ route('insertCurrency') }}" method="post" novalidate>
                @csrf

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Currency Name<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" class="form-control" data-validate-length-range="6" data-validate-words="2" name="name" id="name" value="{{ old('name') }}" placeholder="Enter name" required="required" />
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Symbol<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" class="form-control" data-validate-length-range="6" data-validate-words="2" name="symbol" id="symbol" value="{{ old('symbol') }}" placeholder="Enter symbol" required="required" />
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Exchange Rate<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text"  class="form-control" data-validate-length-range="6" data-validate-words="2" name="exchange_rate" id="exchange_rate" value="{{ old('exchange_rate') }}" placeholder="Enter exchange rate" required="required" />
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Code<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text"  class="form-control" data-validate-length-range="6" data-validate-words="2" name="code" id="code" value="{{ old('code') }}" placeholder="Enter code" required="required" />
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
                            <a href="{{ route('showCurrencies') }}" class="btn btn-outline-success">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
  
@endsection


