@extends('backEnd.layouts.master')

@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>SMTP Config</h3>
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
            <form class="" action="{{ route('updateSMTP') }}" method="post" novalidate>
                @csrf
                @php
                    $MAIL_MAILER = env('MAIL_MAILER');
                    $MAIL_HOST = env('MAIL_HOST');
                    $MAIL_PORT= env('MAIL_PORT');
                    $MAIL_ENCRYPTION = env('MAIL_ENCRYPTION');
                    $MAIL_USERNAME = env('MAIL_USERNAME');
                    $MAIL_PASSWORD = env('MAIL_PASSWORD');
                    $MAIL_FROM_ADDRESS = env('MAIL_FROM_ADDRESS');
                    $MAILGUN_DOMAIN = env('MAILGUN_DOMAIN');
                    $MAILGUN_SECRET = env('MAILGUN_SECRET');
                @endphp
                    <div class="field item form-group">
                        <input type="hidden" name="types[]" value="MAIL_MAILER">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Type<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <select name="MAIL_MAILER" id="MAIL_MAILER" class="form-control" onchange="checkMailDriver();">
                                <option value="sendmail" @if($MAIL_MAILER == 'sendmail') selected @endif>SendMail</option>
                                <option value="SMTP" @if($MAIL_MAILER == 'smtp') selected @endif>SMTP</option>
                                <option value="mailgun" @if($MAIL_MAILER == 'mailgun') selected @endif>Mailgun</option>
                            </select>
                        </div>
                    </div>
                   
               
                    <div id="smtp">
                        <div class="field item form-group">
                            <input type="hidden" name="types[]" value="MAIL_HOST">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">MAIL HOST<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="MAIL_HOST" id="MAIL_HOST" value="{{ $MAIL_HOST }}" readonly/>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <input type="hidden" name="types[]" value="MAIL_PORT">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">MAIL PORT<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="MAIL_PORT" id="MAIL_PORT" value="{{ $MAIL_PORT }}" readonly/>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <input type="hidden" name="types[]" value="MAIL_ENCRYPTION">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">MAIL ENCRYPTION<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="MAIL_ENCRYPTION" id="MAIL_ENCRYPTION" value="{{ $MAIL_ENCRYPTION }}" readonly/>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <input type="hidden" name="types[]" value="MAIL_USERNAME">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">MAIL USERNAME<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="MAIL_USERNAME" id="MAIL_USERNAME" value="{{ $MAIL_USERNAME }}" readonly/>
                            </div>
                        </div>
                        {{-- <div class="field item form-group">
                            <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">MAIL PASSWORD<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="MAIL_PASSWORD" id="MAIL_PASSWORD" value="{{ $MAIL_PASSWORD }}" readonly/>
                            </div>
                        </div> --}}
                        <div class="field item form-group">
                            <input type="hidden" name="types[]" value="MAIL_FROM_ADDRESS">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">MAIL FROM ADDRESS<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="MAIL_FROM_ADDRESS" id="MAIL_FROM_ADDRESS" value="{{ $MAIL_FROM_ADDRESS }}" readonly/>
                            </div>
                        </div>
                    </div>
               

                    <div id="mailgun">
                        <div class="field item form-group">
                            <input type="hidden" name="types[]" value="MAILGUN_DOMAIN">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">MAILGUN DOMAIN<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="MAILGUN_DOMAIN" id="MAILGUN_DOMAIN" value="{{ $MAILGUN_DOMAIN }}" readonly/>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <input type="hidden" name="types[]" value="MAILGUN_SECRET">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">MAILGUN SECRET<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="MAILGUN_SECRET" id="MAILGUN_SECRET" value="{{ $MAILGUN_SECRET }}" readonly/>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="ln_solid">
                        <div class="form-group">
                            <div class="col-md-6 offset-md-3">
                                <button type='submit' class="btn btn-primary float-right">Update</button>
                            </div>
                        </div>
                    </div> --}}
          
            </form>
        </div>
    </div>
</div>
  
@endsection


<script>
    $(document).ready(function() {
        checkMailDriver();
    });

    function checkMailDriver() {
        if($('select[name=MAIL_MAILER]').val() == 'mailgun') {
            $('#mailgun').show();
            $('#smtp').hide();
        } else {
            $('#mailgun').hide();
            $('#smtp').show();
        }
    }
</script>

