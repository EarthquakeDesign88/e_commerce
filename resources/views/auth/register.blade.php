<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
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
    
   
</head>
<body>

<div class="wrapper">
    <div class="title">
        Register Here
    </div>
   

    <form id="form" method="POST">
       @csrf
        <div class="form">
            <div class="input_field">
                <input type="text" placeholder="Full Name" name="full_name" id="full_name" class="input" value="{{ old('full_name') }}">
                <i class="fas fa-user"></i>
                <span class="msg-error">
                    @error('full_name')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="input_field">
                <input type="text" placeholder="Username" name="username" id="username" class="input" value="{{ old('username') }}">
                <i class="fas fa-user"></i>
                <span class="msg-error">
                    @error('username')
                    {{ $message }}
                    @enderror
                </span>
               
            </div>
            <div class="input_field">
                <input type="text" placeholder="Email" name="email" id="email" class="input" value="{{ old('email') }}">
                <i class="far fa-envelope"></i>
                <span class="msg-error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </span>
                
            </div>
            <div class="input_field">
                <input type="text" placeholder="Phone" name="phone" id="phone" class="input" value="{{ old('phone') }}">
                <i class="fas fa-phone"></i>
                <span class="msg-error">
                    @error('phone')
                    {{ $message }}
                    @enderror
                </span>
                 
            </div>
            <div class="input_field">
                <input type="password" placeholder="Password" name="password" id="password" class="input"  value="{{ old('password') }}">
                <i class="fas fa-lock"></i>
                <span class="eye last-text" onclick="previewPassword()">
                    <i id="showPassword" class="fa fa-eye preview-text"></i> 
                    <i id="hidePassword" class="fa fa-eye-slash preview-text"></i>     
                </span>
                <span class="msg-error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </span>
            </div>
        
            <div class="input_field">
                <input type="password" placeholder="Confirm your password" name="password_confirmation" id="password_confirmation" class="input"  value="{{ old('password_confirmation') }}">
                <i class="fas fa-lock"></i>
                <span class="eye last-text" onclick="previewPassword2()">
                    <i id="showPassword2" class="fa fa-eye preview-text"></i> 
                    <i id="hidePassword2" class="fa fa-eye-slash preview-text"></i>     
                </span> 
                <span class="msg-error">
                    @error('password_confirmation')
                    {{ $message }}
                    @enderror
                </span>
            </div>

        

            <a class="text" href="{{ route('login') }}">Already registered?</a>
            <div>
                <button type="submit" class="btn-form" id="btn-form">Register</button>
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

    function previewPassword2() {
        var password_confirmation = document.getElementById("password_confirmation");
        var showPassword2 = document.getElementById("showPassword2");
        var hidePassword2 = document.getElementById("hidePassword2");

        if(password_confirmation.type === 'password') {
            password_confirmation.type = "text";
            showPassword2.style.display = "block";
            hidePassword2.style.display = "none";
        } else {
            password_confirmation.type = "password"
            showPassword.style2.display = "none";
            hidePassword.style2.display = "block";
        }
    }


    
  
</script>