@extends('backEnd.layouts.master')

@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Omise Config</h3>
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
           
                    <div class="field item form-group">
                        <input type="hidden" name="types[]" value="OMISE_PUBLIC_KEY">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">OMISE PUBLIC KEY<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="OMISE_PUBLIC_KEY" id="OMISE_PUBLIC_KEY" value="{{ env('OMISE_PUBLIC_KEY') }}" readonly/>
                        </div>
                    </div>
                    <div class="field item form-group">
                        <input type="hidden" name="types[]" value="OMISE_SECRET_KEY">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">OMISE SECRET KEY<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="OMISE_SECRET_KEY" id="OMISE_SECRET_KEY" value="{{ env('OMISE_SECRET_KEY') }}" readonly/>
                        </div>
                    </div>

                
        </div>
    </div>
</div>
  
@endsection

