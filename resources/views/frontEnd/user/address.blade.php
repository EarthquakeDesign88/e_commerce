<title>Address</title>
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
                            <form action="{{ route('updateAddress') }}" method="post">
                                @csrf
                                <div class="card border-0">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary float-end">
                                            <i class="fas fa-save"></i> Save change
                                        </button>
                                        <div class="row gy-1">
                                            <div class="col-12">
                                                <label class="form-label" for="address">Address</label>
                                                <input type="text" class="form-control" name="address" id="address" placeholder="address" value="{{ $user->address }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="city">City</label>
                                                <input type="text" class="form-control" name="city" id="city" placeholder="city" value="{{ $user->city }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="state">State</label>
                                                <input type="text" class="form-control" name="state" id="state" placeholder="state" value="{{ $user->state }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="state">Country</label>
                                                <input type="text" class="form-control" name="country" id="country" placeholder="state" value="{{ $user->country }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="postcode">Postcode</label>
                                                <input type="text" class="form-control" name="postcode"  id="postcode" placeholder="postcode" value="{{ $user->postcode }}">
                                            </div>
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection