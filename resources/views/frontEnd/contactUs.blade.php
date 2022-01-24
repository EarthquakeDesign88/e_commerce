@extends('frontEnd.layouts.master')
<title>Contact</title>
<link rel="stylesheet" href="{{ asset('css/contact_us.css') }}">

@section('content')   
    <div class="col-lg-12">
        @include('frontEnd.layouts.notification')
    </div>
    <div class="contact-wrap">
        <div class="contact-in">
            <h1>Contact Info</h1>
            <h2><i class="fa fa-phone"></i> Phone</h2>
            <p>{{ \App\Models\Setting::value('phone') }}</p>
            <h2><i class="fa fa-envelope"></i> Email</h2>
            <p>{{ \App\Models\Setting::value('email') }}</p>
            <h2><i class="fa fa-map-marker"></i> Address</h2>
            <p>{{ \App\Models\Setting::value('address') }}</p>
            
        </div>
        <div class="contact-in">
            <h1>Send a Message</h1>
            <form action="{{ route('contactSubmit') }}" method="post">
                @csrf
                <input type="text" placeholder="Full Name" name="full_name" class="contact-in-input" >
                @error('full_name')
                    <p class="text-danger text-bold float-end">{{ $message }}</p>
                @enderror
                <input type="email" placeholder="Email" name="email" class="contact-in-input" >
                @error('email')
                    <p class="text-danger text-bold float-end">{{ $message }}</p>
                @enderror
                <input type="text" placeholder="Subject" name="subject" class="contact-in-input" >
                @error('subject')
                    <p class="text-danger text-bold float-end">{{ $message }}</p>
                @enderror
                <textarea placeholder="Message" name="message" class="contact-in-textarea"></textarea >
                @error('message')
                    <p class="text-danger text-bold float-end">{{ $message }}</p>
                @enderror
                <button type="submit" class="contact-in-btn">SUBMIT</button>
              
            </form>
        </div>
       
    </div>


<!-- Bothelp.io widget -->
<script type="text/javascript">
    !function(){var e={"buttons":[
        {"type":"messenger",
        "token":"https://www.facebook.com/103773555509386/"},
        {"type":"instagram","token":"https://www.instagram.com/"},
        {"type":"line","token":"https://line.me/th/"},
        {"type":"call","token":"+66888888888"}],
        "color":"ffc700","position":"right","bottomSpacing":"80",
        "callToActionMessage":"Contact for more information","displayOn":"everywhere","lang":"en"},
        t=document.location.protocol+"//bothelp.io",o=document.createElement("script");o.type="text/javascript",
        o.async=!0,o.src=t+"/widget-folder/widget-page.js",
        o.onload=function(){new BhWidgetPage.init(e)};var n=document.getElementsByTagName("script")[0];
        n.parentNode.insertBefore(o,n)}();
</script>

   
@endsection

