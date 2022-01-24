@extends('backEnd.layouts.master')

@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Paypal Config</h3>
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
            <form class="" action="{{ route('updatePaypal') }}" method="post" novalidate>
                <input type="hidden" name="payment_method" value="paypal">
                @method('patch')
                @csrf
                    <div class="field item form-group">
                        <input type="hidden" name="types[]" value="PAYPAL_CLIENT_ID">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">PAYPAL CLIENT ID<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="PAYPAL_CLIENT_ID" id="PAYPAL_CLIENT_ID" value="{{ env('PAYPAL_CLIENT_ID') }}" readonly/>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <input type="hidden" name="types[]" value="PAYPAL_CLIENT_SECRET">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">PAYPAL CLIENT SECRET<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="PAYPAL_CLIENT_SECRET" id="PAYPAL_CLIENT_SECRET" value="{{ env('PAYPAL_CLIENT_SECRET') }}" readonly/>
                        </div>
                    </div>
                    @foreach ($setPaypal as $setpay)
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">PAYPAL SANDBOX MODE<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input type="checkbox" name="paypal_sandbox" id="paypal_sandbox" class="mt-2"  value="{{ $setpay->paypal_sandbox }}" @if($setpay->paypal_sandbox == 1) checked @endif>
                            </div>
                        </div>
                    @endforeach
               
                    <div class="ln_solid">
                        <div class="form-group">
                            <div class="col-md-6 offset-md-3">
                                <button type='submit' class="btn btn-info float-right">Save change</button>
                            </div>
                        </div>
                    </div>
          
            </form>
        </div>
    </div>
</div>
  
@endsection

