<!-- header -->
<link rel="stylesheet" href="{{ asset('css/header.css') }}">

<!-- mobile menu -->
<div class="mobile-menu bg-second">
    <a href="#" class="mb-logo"><img src="{{ \App\Models\Setting::value('logo') }}" alt="LogoImage" width="300" height="80"></a>
    <span class="mb-menu-toggle" id="mb-menu-toggle">
        <i class='bx bx-menu'></i>
    </span>
</div>

<div class="header-wrapper" id="header-wrapper">
    <span class="mb-menu-toggle mb-menu-close" id="mb-menu-close">
        <i class='bx bx-x'></i>
    </span>

    <!-- mid header -->
    <div class="bg-main ">
        
        <div class="mid-header container">
            <a href="#" class="logo"><img src="{{ \App\Models\Setting::value('logo') }}" alt="LogoImage" width="300" height="80"></a>
            {{-- Auto search --}}
            <div class="search">
                <form action="{{ route('searchResults') }}" method="get">
                    <input type="search" id="search" name="keyword" placeholder="Search">
                    {{-- <i class='bx bx-search-alt'></i> --}}
                </form>
            </div>
            {{-- <li class="dropdown">
                <a href="">฿THB</a>
                <i class='bx bxs-chevron-down'></i>
                <ul class="dropdown-content">
                    @foreach (\App\Models\Currency::where('status', 'Active')->get() as $currency)
                    <li><a href="javascript:;" onclick="currency_change('{{ $currency['code'] }}');">{{ $currency->symbol }}{{ \Illuminate\Support\Str::upper($currency->code) }}</a></li>
                    
                    @endforeach
                </ul>
            </li> --}}
           
            <ul class="user-menu">
                @if(Auth::check())
                    <li class="dropdown-account ">
                        <a href="#"> <p class="header-preview">{!! Auth::user()->username !!}</p></a>
                        <i class='bx bxs-chevron-down'></i>
                        <ul class="dropdown-content">
                            <li><i class="fas fa-user "></i><a href="{{ route('showProfile') }}">Profile</a></li>
                            <li><i class="fa fa-history"></i><a href="{{  route('showOrderHistory')  }}">History</a></li>
                            <li><i class="fas fa-question-circle"></i><a href="{{ route('showHelp') }}">Help</a></li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <li class="logout"><i class="fas fa-sign-out-alt"></i><a href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();">Sign out</a></li>
                            </form>         
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('showWishlist') }}">
                            <i class='bx bx-heart bx-sm'></i>
                            @if(\Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count() > 0)
                            <span class="fetch-qty" id="wishlist_counter">{{ \Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count() }}</span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('showCart') }}">
                            <i class='bx bx-cart'></i>
                                @if (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() > 0)
                                    <span class="fetch-qty" id="cart_counter">{{ \Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() }}</span>
                                @endif
                        </a>
                    </li>     
                @else
                    <li class="header-preview"><a href="{{ route('register') }}">Register</a></li>
                    <li class="header-preview"><a href="{{ route('login') }}">Login</a></li>
                @endif
            </ul>
            
            
        </div>
    </div>

    <div class="bg-second">
        <div class="bottom-header container">
            <ul class="main-menu">
                <li><a href="{{ route('showHomepage') }}" class="{{request()-> routeIs('showHomepage')? 'active' : '' }}">home</a></li>
                <!-- mega menu -->
                @if (count($categories) > 0)
                <li>
                    <a href="{{ route('showAllProducts') }}" class="{{request()-> routeIs('showAllProducts')? 'active' : '' }}">Shop</a>
                </li>

                @endif
                
                <li><a href="{{ route('showAboutUs') }}" class="{{ request()->routeIs('showAboutUs') ? 'active' : '' }}">About Us</a></li>
                <li><a href="{{ route('showContactUs') }}" class="{{ request()->routeIs('showContactUs') ? 'active' : '' }}">contact</a></li>
            </ul>
        </div>
    </div>
</div>





<script>
    document.querySelector(".right ul li").addEventListener("click", function(){
        this.classList.toggle("active");
    });
</script>

{{-- <script>
    function currency_change(currency_code) {
        $.ajax({
            type: 'POST',
            url: '{{ route('currencyLoad') }}',
            data: {
                currency_code: currency_code,
                _token: '{{ csrf_token() }}',
            },
            success:function(response) {
                if(response['status']) {
                    location.reload();
                }
                else {
                    alert('server error');
                }
            }
        });
    }
</script> --}}


