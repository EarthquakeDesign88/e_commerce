<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title"><i class="fa fa-cube"></i> <span>Admin Management</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ asset('images_template/admin_logo.png') }}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome</span>
                <h2>{!! Auth::user()->username !!}</h2>
            </div>
            </div>
            <!-- /menu profile quick info -->

            <br />
            

 
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Settings</h3>
                <ul class="nav side-menu">
            
                <li><a href="{{ route('adminDashboard') }}"><i class="fa fa-pie-chart"></i> Dashboard </a>
                </li>
                <li><a><i class="fa fa-edit"></i> Products Management<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('showProducts') }}" class="{{request()-> routeIs('showProducts')? 'active' : '' }}">Products</a></li>
                        <li><a href="{{ route('showCategories') }}" class="{{request()-> routeIs('showCategories')? 'active' : '' }}">Categories</a></li>
                        <li><a href="{{ route('showBrands') }}" class="{{request()-> routeIs('showBrands')? 'active' : '' }}">Brands</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-tags"></i> Coupons Management<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('showCoupons') }}" class="{{request()-> routeIs('showCoupons')? 'active' : '' }}">Coupons</a></li>
                    </ul>
                </li>
              
                <li><a><i class="fa fa-shopping-cart"></i> Orders Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('showOrders') }}" class="{{request()-> routeIs('showOrders')? 'active' : '' }}">Orders</a></li>
                    </ul>
                </li>

                <li><a><i class="fa fa-truck"></i> Shipping Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('showShippings') }}" class="{{request()-> routeIs('showShippings')? 'active' : '' }}">Shipping Fee</a></li>
                        <li><a href="{{ route('showLogistics') }}" class="{{request()-> routeIs('showLogistics')? 'active' : '' }}">Logistics</a></li>
                    </ul>
                </li>

                <li><a><i class="fa fa-credit-card"></i> Payment Transaction <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('showPaypalTransactions') }}" class="{{request()-> routeIs('showPaypalTransactions')? 'active' : '' }}">Paypal</a></li>
                        <li><a href="{{ route('showOmiseTransactions') }}" class="{{request()-> routeIs('showOmiseTransactions')? 'active' : '' }}">Omise</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-user"></i> Users Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a href="{{ route('showCustomers') }}" class="{{request()-> routeIs('showCustomers')? 'active' : '' }}">Customers</a></li>
                    <li><a href="{{ route('showAdmins') }}" class="{{request()-> routeIs('showAdmins')? 'active' : '' }}">Admins</a></li>
                    </ul>
                </li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>Layouts</h3>
                <ul class="nav side-menu">

                <li><a><i class="fa fa-cog"></i> Genaral settings<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('setWebsiteInfo') }}" class="{{request()-> routeIs('setWebsiteInfo')? 'active' : '' }}">Website Setting</a></li>
                        <li><a href="{{ route('setSMTP') }}" class="{{request()-> routeIs('setSMTP')? 'active' : '' }}">SMTP Config</a></li>     
                        <li><a href="{{ route('setPaypal') }}" class="{{request()-> routeIs('setPaypal')? 'active' : '' }}">Paypal Config</a></li> 
                        <li><a href="{{ route('setOmise') }}" class="{{request()-> routeIs('setOmise')? 'active' : '' }}">Omise Config</a></li>                     
                    </ul>
                </li>
                <li><a><i class="fa fa-clone"></i> Page Setup<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('setAboutUs') }}" class="{{request()-> routeIs('setAboutUs')? 'active' : '' }}">About us</a></li> 
                        <li><a href="{{ route('showBanners') }}" class="{{request()-> routeIs('showBanners')? 'active' : '' }}">Banners</a></li>
                        <li><a href="{{ route('showSliders') }}" class="{{request()-> routeIs('showSliders')? 'active' : '' }}">Sliders</a></li>
                        <li><a href="{{ route('showCurrencies') }}" class="{{request()-> routeIs('showCurrencies')? 'active' : '' }}">Currencies</a></li>  
                    </ul>
                </li>
            </div>
            

            </div>
            <!-- /sidebar menu -->
            
         
        </div>
        </div>
       
        <!-- top navigation -->
        <div class="top_nav">
        <div class="nav_menu">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <nav class="nav navbar-nav">
            
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('images_template/admin_logo.png') }}" alt="">{!! Auth::user()->name !!}
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="javascript:;"> Profile</a>
                    <a class="dropdown-item"  href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                    </a>
                    <a class="dropdown-item"  href="{{ route('showHomepage') }}">
                        <span>Go to homepage</span>
                    </a>
               
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item"  href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </form>    
                </div>
                </li>

                {{-- <li role="presentation" class="nav-item dropdown open">
                <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                </a>
                <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                    <li class="nav-item">
                    <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                    </a>
                    </li>
                    <li class="nav-item">
                    <a class="dropdown-item">
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                    </a>
                    </li>
                    <li class="nav-item">
                    <div class="text-center">
                        <a class="dropdown-item">
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    </li>
                </ul>
                </li> --}}
            </ul>
            </nav>
        </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            @yield('content')
        </div>
        <!-- /page content -->

    </div>
</div>


