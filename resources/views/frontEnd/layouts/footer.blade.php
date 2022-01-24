<!-- footer -->
<footer class="bg-second">
    <div class="container">
        <div class="row">
            <div class="col-3 col-md-6">
                <h3 class="footer-head">Products</h3>
                <ul class="menu">
                    <li><a href="#">Help center</a></li>
                    <li><a href="#">Contact us</a></li>
                    <li><a href="#">product help</a></li>
                    <li><a href="#">warranty</a></li>
                    <li><a href="#">order status</a></li>
                </ul>
            </div>
            <div class="col-3 col-md-6">
                <h3 class="footer-head">services</h3>
                <ul class="menu">
                    <li><a href="#">Help center</a></li>
                    <li><a href="#">Contact us</a></li>
                    <li><a href="#">product help</a></li>
                    <li><a href="#">warranty</a></li>
                    <li><a href="#">order status</a></li>
                </ul>
            </div>
            <div class="col-3 col-md-6">
                <h3 class="footer-head">Contact us</h3>
                <ul class="menu">
                    <li><a href="tel:{{ \App\Models\Setting::value('phone') }}"><i class="fas fa-phone-alt"></i> <small>{{ \App\Models\Setting::value('phone') }}</small></a></li>
                    <li><a href="mailto:{{ \App\Models\Setting::value('email') }}"><i class="far fa-envelope"></i> <small>{{ \App\Models\Setting::value('email') }}</small></a></li>
                    <li><a href="#"><i class="fas fa-map-marker-alt"></i> <small>{{ \App\Models\Setting::value('address') }}</small></a></li>
                </ul>
            </div>
            <div class="col-3 col-md-6 col-sm-12">
                <div class="contact">
                    <div class="contact-header">
                        <img src="{{ \App\Models\Setting::value('logo') }}" alt="LogoImage" width="300" height="80">
                    </div>
                    <ul class="contact-socials">
                        <a href="{{ \App\Models\Setting::value('facebook_url') }}" target="_blank"><li class="fab fa-facebook"></li></a>
                        <a href="{{ \App\Models\Setting::value('instagram_url') }}" target="_blank"><li class="fab fa-instagram-square"></li></a>
                        <a href="{{ \App\Models\Setting::value('line_url') }}" target="_blank"><li class="fab fa-line"></li></a>
                    </ul>
                </div>
             
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->
