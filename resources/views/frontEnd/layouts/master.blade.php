<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Earth shop Online shopping</title>
    {{-- Favicon --}}
    <link rel="apple-touch-icon" sizes="76x76" href="{{  asset('/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{  asset('/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{  asset('/images/favicon/favicon-16x16.png') }}">


    <link rel="apple-touch-icon" sizes="76x76" href="{{ \App\Models\Setting::value('apple_touch_icon') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ \App\Models\Setting::value('icon_md') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ \App\Models\Setting::value('icon_sm') }}">
    <link rel="manifest" href="{{  asset('/images/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{  asset('/images/favicon/safari-pinned-tab.svg') }}" color="#00bcb4">
    <link rel="shortcut icon" href="{{  asset('/images/favicon/favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#00bcb4">
    <meta name="msapplication-config" content="{{  asset('/images/favicon/browserconfig.xml') }}">
    <meta name="theme-color" content="#00bcb4">
    
    <!-- Search Engine -->
    <meta name="description" content="{{ \App\Models\Setting::value('meta_description') }}">
    <meta name="image" content="{{ \App\Models\Setting::value('meta_image') }}">
    <meta name="title" content="{{ \App\Models\Setting::value('meta_title') }}">
    <meta name="keywords" content="{{ \App\Models\Setting::value('meta_keywords') }}">
    <meta name="robots" content="index, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="Earthquake Design">
    
    <!-- Schema.org for Google -->
    <meta itemprop="name" content="{{ \App\Models\Setting::value('meta_title') }}">
    <meta itemprop="description" content="{{ \App\Models\Setting::value('meta_description') }}">
    <meta itemprop="image" content="{{ \App\Models\Setting::value('meta_image') }}">
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta name="og:title" content="{{ \App\Models\Setting::value('meta_title') }}">
    <meta name="og:description" content="{{ \App\Models\Setting::value('meta_description') }}">
    <meta name="og:image" content="{{ \App\Models\Setting::value('meta_image') }}">
    <meta name="og:url" content="{{ \App\Models\Setting::value('meta_url') }}">
    <meta name="og:site_name" content="{{ \App\Models\Setting::value('meta_url') }}">
    <meta name="og:type" content="website">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,900&display=swap" rel="stylesheet">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- Fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    {{-- Auto Search --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    {{-- Customize --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/grid.css') }}">
    <link rel="stylesheet" href="{{ asset('css/preload.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toTop.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <link rel="stylesheet" href="{{ asset('css/slick.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}"/>


</head>
<body>
   
    <header id="header-ajax">
        @include('frontEnd.layouts.header')
    </header>
    @include('frontEnd.layouts.preload')
        @yield('content')
    @include('frontEnd.layouts.footer')
    @include('frontEnd.layouts.scroll-loading')
    @include('frontEnd.layouts.toTop')


    {{-- JS --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- Customize --}}
    <script src="{{ asset('js/app.js')}}"></script>
    <script src="{{ asset('js/index.js')}}"></script>
    <script src="{{ asset('js/custom.js')}}"></script>


    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/nouislider.min.js') }}"></script>
    <script src="{{ asset('js/jquery.zoom.min.js') }}"></script>

    {{-- Auto Search --}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    {{-- Sweetalert2 --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.20/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.20/sweetalert2.min.js"></script>
 
    
    @yield('scripts')

    <script>
        $(document).on('click', '.cart_delete', function(e) {
            e.preventDefault();
            var cart_id = $(this).data('id');
            var token = "{{ csrf_token() }}";
            var path = "{{ route('deleteFromCart') }}";
            $('.reload').html('<i class="spinner-border text-warning"></i>');
            $.ajax({
                url: path,
                type: "POST",
                dataType: "JSON",
                data: {
                    cart_id: cart_id,
                    _token: token,
                },
                success:function(data) {
                    console.log(data);
                    if(data['status']) {
                        $('body #header-ajax').html(data['header']);
                        $('body #cart_counter').html(data['cart_count']);
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Success!',
                            text: data['message'],
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        setTimeout(window.location.reload.bind(window.location), 450);
                    }
                  
                },
                error:function(err) {
                    console.log(err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '.wishlist_delete', function(e) {
            e.preventDefault();
            var cart_id = $(this).data('id');
            var token = "{{ csrf_token() }}";
            var path = "{{ route('deleteFromWishlist') }}";

            $.ajax({
                url: path,
                type: "POST",
                dataType: "JSON",
                data: {
                    cart_id: cart_id,
                    _token: token,
                },
                success:function(data) {
                    console.log(data);
                    if(data['status']) {
                        $('body #header-ajax').html(data['header']);
                        $('body #wishlist_counter').html(data['wishlist_count']);
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Success!',
                            text: data['message'],
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        setTimeout(window.location.reload.bind(window.location), 450);
                    }
                },
                error:function(err) {
                    console.log(err);
                }
            });
        });
    </script> 

    <script>
        $(document).ready(function() {
            var path = "{{ route('autoSearch') }}";
            $('#search').autocomplete({
                source:function(request, response) {
                    $.ajax({
                        url: path,
                        dataType: "JSON",
                        data: {
                            term: request.term
                        },
                        success:function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 1,
            });
        });
    </script> 

    <script>
        // Category Bar
        let filter_col = document.querySelector('#filter-col')
        
        document.querySelector('#filter-toggle').addEventListener('click', () => filter_col.classList.toggle('active'))
        
        document.querySelector('#filter-close').addEventListener('click', () => filter_col.classList.toggle('active'))
    </script>

    
</body>

</html>
