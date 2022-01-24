
<title>Help</title>
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@extends('frontEnd.layouts.master')

@section('content')

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
                            <div class="card-body">
                                <div class="row gy-4">
                                  <h2 class="question-header">Freguently Asked Question(FAQs)</h2>
                                  <div class="accordion">
                                    <div>
                                      <input type="radio" name="example_accordion" id="section1" class="accordion__input">
                                      <label for="section1" class="accordion__label">Question1 ?</label>
                                      <div class="accordion__content">
                                        <p>Answer #1</p>
                                        <p>
                                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam sit reiciendis, ipsam quaerat,
                                          aperiam perspiciatis ad ullam architecto impedit natus illo nostrum molestias voluptas earum a
                                          voluptatibus fugiat fuga facere!
                                        </p>
                                      </div>
                                    </div>
                                    <div>
                                      <input type="radio" name="example_accordion" id="section2" class="accordion__input">
                                      <label for="section2" class="accordion__label">Question2 ?</label>
                                      <div class="accordion__content">
                                        <p>Answer #2</p>
                                        <p>
                                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam sit reiciendis, ipsam quaerat,
                                          aperiam perspiciatis ad ullam architecto impedit natus illo nostrum molestias voluptas earum a
                                          voluptatibus fugiat fuga facere!
                                        </p>
                                      </div>
                                    </div>
                                    <div>
                                      <input type="radio" name="example_accordion" id="section3" class="accordion__input">
                                      <label for="section3" class="accordion__label">Question3 ?</label>
                                      <div class="accordion__content">
                                        <p>Answer #3</p>
                                        <p>
                                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam sit reiciendis, ipsam quaerat,
                                          aperiam perspiciatis ad ullam architecto impedit natus illo nostrum molestias voluptas earum a
                                          voluptatibus fugiat fuga facere!
                                        </p>
                                      </div>
                                    </div>
                                    <div>
                                      <input type="radio" name="example_accordion" id="section4" class="accordion__input">
                                      <label for="section4" class="accordion__label">Question4 ?</label>
                                      <div class="accordion__content">
                                        <p>Answer #4</p>
                                        <p>
                                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam sit reiciendis, ipsam quaerat,
                                          aperiam perspiciatis ad ullam architecto impedit natus illo nostrum molestias voluptas earum a
                                          voluptatibus fugiat fuga facere!
                                        </p>
                                      </div>
                                    </div>
                                    <div>
                                      <input type="radio" name="example_accordion" id="section5" class="accordion__input">
                                      <label for="section5" class="accordion__label">Question5 ?</label>
                                      <div class="accordion__content">
                                        <p>Answer #5</p>
                                        <p>
                                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam sit reiciendis, ipsam quaerat,
                                          aperiam perspiciatis ad ullam architecto impedit natus illo nostrum molestias voluptas earum a
                                          voluptatibus fugiat fuga facere!
                                        </p>
                                      </div>
                                    </div>
                                    <div>
                                      <input type="radio" name="example_accordion" id="section6" class="accordion__input">
                                      <label for="section6" class="accordion__label">Question6 ?</label>
                                      <div class="accordion__content">
                                        <p>Answer #6</p>
                                        <p>
                                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam sit reiciendis, ipsam quaerat,
                                          aperiam perspiciatis ad ullam architecto impedit natus illo nostrum molestias voluptas earum a
                                          voluptatibus fugiat fuga facere!
                                        </p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
  

@endsection