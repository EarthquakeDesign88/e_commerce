@extends('backEnd.layouts.master')

@section('content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3><span> <a href="{{ route('showAdmins') }}" data-toggle="tooltip" title="Back" class="btn btn-info" data-placement="bottom"> <i class="fa fa-chevron-left"></i></a></span>Edit admin</h3>
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
            <form class="" action="{{ route('updateAdmin', $admin->id) }}" method="post" novalidate>
                @csrf
                <span class="section text-info">{{ $admin->username }}</span>
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Full name<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input class="form-control" name="full_name" id="full_name" value="{{ $admin->full_name }}" placeholder="Enter fullname" required="required"/>
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Email<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="email" class="form-control" name="email" id="email" value="{{ $admin->email }}" placeholder="Enter email" required="required" readonly/>
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Username<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text"class="form-control" name="username" id="username" value="{{ $admin->username }}" placeholder="Enter username" required="required" readonly/>
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Phone<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" class="form-control" name="phone" id="phone" value="{{ $admin->phone }}" placeholder="Enter phone" required="required"/>
                    </div>
                </div>
                
                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Address<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" class="form-control" name="address" id="address" value="{{ $admin->address }}" placeholder="Enter address" required="required"/>
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">State<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" class="form-control" name="state" id="state" value="{{ $admin->state }}" placeholder="Enter state" required="required"/>
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">City<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" class="form-control" name="city" id="city" value="{{ $admin->city }}" placeholder="Enter city" required="required"/>
                    </div>
                </div>

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Country<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" class="form-control" name="country" id="country" value="{{ $admin->country }}" placeholder="Enter country" required="required"/>
                    </div>
                </div>


                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Postcode<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6">
                        <input type="text" class="form-control" name="postcode" id="postcode" value="{{ $admin->postcode }}" placeholder="Enter postcode" required="required"/>
                    </div>
                </div>
              

                <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Role<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" class="form-control" name="role" id="role" value="{{ $admin->role }}" placeholder="Admin" readonly/>
                        {{-- <select name="role" id="role" class="form-control">
                            <option value="">-- Role --</option>
                            <option value="operation support">Operation Support</option>
                            <option value="product management">Product Management</option>
                            <option value="content management">Content Management</option>
                            <option value="admin">Admin</option>
                        </select> --}}
                    </div>   
                </div>

                <div class="ln_solid">
                    <div class="form-group">
                        <div class="col-md-6 offset-md-3">
                            <button type='submit' class="btn btn-info">Update</button>
                            <a href="{{ route('showAdmins') }}" class="btn btn-outline-success">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
  
@endsection


