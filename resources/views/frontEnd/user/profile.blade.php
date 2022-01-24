<title>Profile</title>
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@extends('frontEnd.layouts.master')

@section('content')
    <div class="col-lg-12">
        @include('frontEnd.layouts.notification')
    </div>
    <section class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-11">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="list-group list-profile sticky-top">
                            <a href="{{ route('showProfile') }}"  class="list-group-item list-group-item-action {{ request()->routeIs('showProfile') ? 'active' : '' }}">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <a href="{{ route('showAddress') }}" class="list-group-item list-group-item-action {{ request()->routeIs('showAddress') ? 'active' : '' }}">
                                <i class="fa fa-home"></i> Address
                            </a>
                            <a href="{{  route('showOrderHistory')  }}" class="list-group-item list-group-item-action {{ request()->routeIs('showOrderHistory') || request()->routeIs('searchOrderByDate')  ? 'active' : '' }}">
                                <i class="fa fa-history"></i> Order History
                            </a>
                            <a href="{{  route('showHelp')  }}" class="list-group-item list-group-item-action {{ request()->routeIs('showHelp') ? 'active' : '' }}">
                                <i class="fas fa-question-circle"></i> Help
                            </a>
                            <a href="{{  route('showHomepage')  }}" class="list-group-item list-group-item-action">
                                <i class="fas fa-shopping-cart"></i> Home
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="container">
                            <div class="card border-0">
                            <form action="{{ route('updateProfile') }}" method="post">
                                @csrf
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary float-end btn-save">
                                            <i class="fas fa-save"></i> Save change
                                        </button>
                                        
                                        <div class="row gy-4">
                                            <div class="col-md-6">
                                                <label class="form-label" for="username">Username</label>
                                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="{{ $user->username }}" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="text" class="form-control" name="email" id="email" placeholder="email" value="{{ $user->email }}" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="full_name">Full name</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full name" value="{{ $user->full_name}}">                            
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="phone">Phone</label>                               
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="phone" value="{{ $user->phone }}">
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <div class="col-md-6">
                                                <label class="form-label" for="phone">Password</label> <br>
                                                <a href="{{ route('password.request') }}" class="btn btn-primary"><i class="fas fa-key"></i> Reset password</a>
                                            </div>
                                          
                                        </div>
                                    </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

 

@endsection


