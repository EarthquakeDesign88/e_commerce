<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
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
    
    <script src="{{ asset('js/validate.js') }}"></script>
</head>
<body>

<div class="wrapper">
    <div class="title">
        Login
    </div>


    <form id="form" action="{{ route('login') }}" method="POST" autocomplete="off">
       @csrf

        <div class="form">
            <div class="input_field">
                <input type="text"  placeholder="Enter your email" autofocus name="email" id="email" value="{{ old('email') }}" class="input" autofocus>
                <i class="far fa-envelope"></i>
                @error('email')
                <span class="msg-error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </span>
                @enderror
            </div>
            <div class="input_field">
                <input type="password" placeholder="Enter your password" autocomplete="current-password" name="password" id="password" value="{{ old('password') }}" class="input">
                <i class="fas fa-lock"></i>
                <span class="eye last-text" onclick="previewPassword()">
                    <i id="showPassword" class="fa fa-eye preview-text"></i> 
                    <i id="hidePassword" class="fa fa-eye-slash preview-text"></i>     
                </span>
                @error('password')
                <span class="msg-error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </span>
                @enderror
            </div>
        

            <div class="form-check ml-3">
                <input class="form-check-input" type="checkbox"id="remember_me" name="remember">
                <label for="remember_me" class="form-check-label" for="flexCheckChecked">
                    <span>Remember me</span>
                </label>
            </div>


            <div class="btn">
                <button type="submit" class="btn-form">Login</button>
            </div>

            <div class="forgor-pw">
                @if (Route::has('password.request'))
                <a class="btn btn-link text" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
                
            </div>
    </form>
  </div>
</div>	
	
</body>
</html>

   
<script type="text/javascript">
    function previewPassword() {
        var password = document.getElementById("password");
        var showPassword = document.getElementById("showPassword");
        var hidePassword = document.getElementById("hidePassword");

        if(password.type === 'password') {
            password.type = "text";
            showPassword.style.display = "block";
            hidePassword.style.display = "none";
        } else {
            password.type = "password"
            showPassword.style.display = "none";
            hidePassword.style.display = "block";
        }
    }

</script>
