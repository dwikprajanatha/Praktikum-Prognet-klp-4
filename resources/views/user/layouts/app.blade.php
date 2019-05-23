<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Alula - Multipurpose eCommerce Bootstrap4 Template</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicon -->
	<link rel="icon" href="assets/img/favicon.ico">

	<!--=============================================
    =            CSS  files       =
    =============================================-->
    
    <!-- Vendor CSS -->
    <link href= {{ asset("assets/css/vendors.css")}} rel="stylesheet">
	<!-- Main CSS -->
	<link href= {{ asset("assets/css/style.css")}} rel="stylesheet">

    @yield('css')


</head>

<body>
    
<!--====================  Header area ====================-->
    
<div class="header-area header-sticky">
            <!--====================  Navigation top ====================-->
    
            <div class="navigation-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!--====================  navigation section ====================-->
                                                
                            <div class="navigation-top-topbar pt-10 pb-10"> 
                                <div class="row align-items-center">
                                    <div class="col-lg-4 col-md-6 text-center text-md-left">
                                        <!--=======  header top social links  =======-->
    
                                        <div class="header-top-social-links">
                                            <span class="follow-text mr-15">Follow Us:</span>
                                            <!--=======  social link small  =======-->
                                            
                                            <ul class="social-link-small">
                                                <li><a href="http://www.facebook.com/"><i class="ion-social-facebook"></i></a></li>
                                                <li><a href="http://www.twitter.com/"><i class="ion-social-twitter"></i></a></li>
                                                <li><a href="http://plus.google.com/"><i class="ion-social-googleplus-outline"></i></a></li>
                                                <li><a href="http://www.instagram.com/"><i class="ion-social-instagram-outline"></i></a></li>
                                                <li><a href="http://www.youtube.com/"><i class="ion-social-youtube"></i></a></li>
                                            </ul>
                                            
                                            <!--=======  End of social link small  =======-->
                                        </div>
                                        
                                        
                                        <!--=======  End of header top social links  =======-->
                                    </div>
                                    <div class="col-lg-4 offset-lg-4 col-md-6">
                                        <!--=======  header top dropdown container  =======-->
                                        
                                        <div class="headertop-dropdown-container justify-content-center justify-content-md-end">
                                            <div class="header-top-single-dropdown">

                                            @if(isset(Auth::user()->first_name))

                                            <a href="javascript:void(0)" class="active-dropdown-trigger" id="user-options">Welcome, {{Auth::user()->first_name}} <i class="ion-ios-arrow-down"></i></a>
                                            <!--=======  dropdown menu items  =======-->
                                            
                                            <div class="header-top-single-dropdown__dropdown-menu-items deactive-dropdown-menu extra-small-mobile-fix">
                                                <ul>
                                                    <li><a href="{{route('profile')}}">My Account</a></li>
                                                    <li>
                                                    <a
                                                        onclick="event.preventDefault; document.getElementById('logout-form').submit();">
                                                        Logout
                                                    </a>

                                                    <form id="logout-form" action="{{route('user.logout')}}" method="POST" style="display: one;">
                                                        {{ csrf_field() }}
                                                    </form>
                                                        
                                                    </li>
                                                    
                                                </ul>
                                                
                                            @else
                                            
                                            <a href="javascript:void(0)" class="active-dropdown-trigger" id="user-options">Welcome, Guest<i class="ion-ios-arrow-down"></i></a>
                                            <!--=======  dropdown menu items  =======-->
                                            
                                            <div class="header-top-single-dropdown__dropdown-menu-items deactive-dropdown-menu extra-small-mobile-fix">
                                                <ul>
                                                    <li><a href="{{route('user.login')}}">Register</a></li>
                                                    <li><a href="{{route('user.login')}}">Login</a></li>
                                                </ul>
                                                @endif
                                                </div>
                                                
                                                <!--=======  End of dropdown menu items  =======-->
                                            </div>
                                            <span class="separator">|</span>
                                            <div class="header-top-single-dropdown">
                                                <a href="javascript:void(0)" class="active-dropdown-trigger" id="currency-options">USD <i class="ion-ios-arrow-down"></i></a>
                                                <!--=======  dropdown menu items  =======-->
                                                
                                                <div class="header-top-single-dropdown__dropdown-menu-items deactive-dropdown-menu">
                                                    <ul>
                                                        <li><a href="#">€ EURO</a></li>
                                                        <li><a href="#">£ Pound Sterling</a></li>
                                                        <li><a href="#">$ US Dollar</a></li>
                                                    </ul>
                                                </div>
                                                
                                                <!--=======  End of dropdown menu items  =======-->
                                            </div>
                                        </div>
                                        
                                        <!--=======  End of header top dropdown container  =======-->
                                    </div>
                                </div>
                            </div>
    
                            <!--====================  End of navigation section  ====================-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <!--====================  navigation top search ====================-->
    
    
                            <div class="navigation-top-search-area pt-25 pb-25">
                                <div class="row align-items-center">
                                    <div class="col-6 col-xl-2 col-lg-3 order-1 col-md-6 col-sm-5">
                                        <!--=======  logo  =======-->
                                        
                                        <div class="logo">
                                            <a href="{{route('home')}}">
                                                <img src="{{asset('assets/img/logo.png')}}" class="img-fluid" alt="">
                                            </a>
                                        </div>
                                        
                                        <!--=======  End of logo  =======-->
                                    </div>
    
                                    <div class="col-xl-5 offset-xl-1 col-lg-4 order-4 order-lg-2 mt-md-25 mt-sm-25">
                                        <!--=======  search bar  =======-->
                                        
                                        <div class="search-bar">
                                            <form action="#">
                                                <input type="search" placeholder="Search entire store here ...">
                                                <button type="submit"> <i class="icon-search"></i></button>
                                            </form>
                                        </div>
                                        
                                        <!--=======  End of search bar  =======-->
                                    </div>
    
                                    <div class="col-xl-3 col-lg-3 order-3 order-sm-2 order-lg-3 order-xs-3 col-md-4 col-sm-5 text-center text-sm-left mt-xs-25">
                                        <!--=======  customer support text  =======-->
                                        
                                        <div class="customer-support-text">
                                            <div class="icon">
                                                <img src="assets/img/icons/icon-header-phone.png" class="img-fluid" alt="">
                                            </div>
    
                                            <div class="text">
                                                <span>Customer Support</span>
                                                <p>(08) 12 345 789</p>
                                            </div>
                                        </div>
                                        
                                        <!--=======  End of customer support text  =======-->
                                    </div>
    
                                    <div class="col-6 col-xl-1 col-lg-2 text-right order-2 order-sm-3 order-lg-4 order-xs-2 col-md-2 col-sm-2">
                                        <!--=======  cart icon  =======-->
                                        
                                        <div class="header-cart-icon">
                                            <a href="javascript:void(0)" id="small-cart-trigger" class="small-cart-trigger">
                                                <i class="icon-shopping-cart"></i>
                                                <span class="cart-counter">{{ Session::has('cart') ? Session::get('cart')->totalQty : '0'}}</span>
                                            </a>

                                            <!--=======  Cart load =======-->
                                            
                                            <div class="small-cart deactive-dropdown-menu">

                                            @php 
                                            if(Session::has('cart')){
                                                $carts = Session::get('cart')->items;
                                            } else {
                                                $carts = null;
                                            }                                           
                                            @endphp
                                            
                                            
                                                <div class="small-cart-item-wrapper">
                                                    <!--======= Cart Item =======-->
                                                    @if(isset($carts))
                                                    @foreach($carts as $cart)
                                                    <div class="single-item">  
                                                        <div class="image">
                                                            <a href="single-product.html">
                                                                <img src="assets/img/cart-image/small2-90x90.jpg" class="img-fluid" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="content">
                                                            <p class="cart-name"><a href="single-product.html">{{$cart['item']->product_name}}</a></p>
                                                            <p class="cart-quantity"><span class="quantity-mes">{{$cart['qty']}} Pcs X </span>Rp.{{number_format($cart['item']->price)}}</p>
                                                        </div> 
                                                    </div>
                                                    
                                                    <!--======= End Cart Item =======-->
                                                    @endforeach
                                                    @else
                                                    <div class="single-item">
                                                    <div class="content">
                                                            <p class="cart-name">Your Cart is Empty</p>
                                                        </div> 
                                                    </div>


                                                    @endif
                                                    
                                                </div>

                                                

                                            
    
                                                <div class="cart-calculation-table">
                                                    <table class="table mb-25">
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-left">Sub-Total :</td>
                                                                <td class="text-right">Rp.{{Session::has('cart') ? number_format(Session::get('cart')->totalPrice) : 0}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left">Diskon :</td>
                                                                <td class="text-right">$4.00</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-left">Total :</td>

                                                                <td class="text-right">Rp.{{ Session::has('cart') ? number_format(Session::get('cart')->totalPrice) : 0}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
    
                                                    <div class="cart-buttons">
                                                        <a href="index.php?page=cart" class="theme-button">View Cart</a>
                                                        <a href="{{route('checkout')}}" class="theme-button">Checkout</a>
                                                    </div>
                                                </div>
    
                                            </div>
                                            
                                            <!--=======  End of small cart  =======-->
                                        </div>
                                        
                                        <!--=======  End of cart icon  =======-->
                                    </div>
                                </div>
                            </div>
    
                            <!--====================  End of navigation top search  ====================-->
                        </div>
                    </div>
                </div>
            </div>
                
            <!--====================  End of Navigation top  ====================-->
    
            <!--====================  navigation menu ====================-->
    
            <div class="navigation-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- navigation section -->
                            <div class="main-menu d-none d-lg-block">
                                <nav>
                                    <ul>
                                        <li class="menu-item-has-children"><a>KATEGORI</a>
                                            <ul class="mega-menu four-column">
                                                <li><a>Tanaman Hias</a>
                                                    <ul>
                                                        <li><a href="#">Tanaman Hias Bunga</a></li>
                                                        <li><a href="#">Tanaman Hias Daun</a></li>
                                                    </ul>
                                                </li>

                                                <li><a>Lokasi Tanam</a>
                                                    <ul>
                                                        <li><a href="#">Tanaman Indoor</a></li>
                                                        <li><a href="#">Tanaman Outdoor</a></li>       
                                                    </ul>
                                                </li>

                                                <li><a>Media Tanam</a>
                                                    <ul>
                                                        <li><a href="#">Tanaman Pot</a></li>
                                                        <li><a href="#">Tanaman Aquaphonic</a></li>       
                                                    </ul>
                                                </li>

                                                <li class="megamenu-banner d-none d-lg-block mt-30 w-100">
                                                    <a href="shop-left-sidebar.html" class="mb-0">
                                                        <img src="assets/img/banners/img-bottom-menu.jpg" class="img-fluid" alt="">
                                                    </a>
                                                </li>

                                            </ul>
                                        </li>
                                         
                                        <li class="menu-item-has-children"><a>PAGES</a>
                                            <ul class="sub-menu">
                                                <li class="menu-item-has-children"><a>Purchase</a>
                                                    <ul class="sub-menu">
                                                        <li><a href="#">Your Order</a></li>
                                                        <li><a href="#">Whislist</a></li>
                                                    </ul>
                                                </li>
                                                <li class="menu-item-has-children"><a>Account</a>
                                                    <ul class="sub-menu">
                                                        <li><a href="{{route('profile')}}">My Account</a></li>
                                                        <li><a href="index.php?page=login">Login Register</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            
                            </div>
                            <!-- end of navigation section -->
    
                            <!-- Mobile Menu -->
                            <div class="mobile-menu-wrapper d-block d-lg-none pt-15">
                                <div class="mobile-menu"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!--====================  End of navigation menu  ====================-->
        </div>
        
        <!--====================  End of Header area  ====================-->
    

    <!--====================  breadcrumb area ====================-->
    
    <div class="breadcrumb-area pt-10 pb-10 border-bottom mb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=======  breadcrumb content  =======-->
                    
                    <div class="breadcrumb-content">
                        <ul>
                            <li class="has-child"><a href="{{route('home')}}">Home</a></li>
                            @yield('breadcrumb')
                            
                        </ul>
                    </div>
                    
                    <!--=======  End of breadcrumb content  =======-->
                </div>
            </div>
        </div>
    </div>
    
    <!--====================  End of breadcrumb area  ====================-->

        @yield('content')


            <!--====================  footer area ====================-->
    
    <div class="footer-area">
        <div class="container">
            <div class="row mb-40">
                <div class="col-lg-12">
                    <div class="footer-content-wrapper border-top pt-40">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <!--=======  single footer widget  =======-->
                                
                                <div class="single-footer-widget">
                                    <div class="footer-logo mb-25">
                                        <img src="assets/img/logo-alula2.png" class="img-fluid" alt="">
                                    </div>
            
                                    <div class="footer-text-block mb-10">
                                        <h5 class="footer-text-block__title">Address</h5>
                                        <p class="footer-text-block__content">4710-4890 Breckinridge St, UK Burlington, VT 05401</p>
                                    </div>
            
                                    <div class="footer-text-block mb-10">
                                        <h5 class="footer-text-block__title">Need Help?</h5>
                                        <p class="footer-text-block__content">Call: 1-800-345-6789</p>
                                    </div>
            
                                    <div class="footer-social-icon-block">
                                        <ul>
                                            <li><a class="facebook-icon" href="http://www.facebook.com/"><i class="ion-social-facebook"></i></a></li>
                                            <li><a class="twitter-icon" href="http://www.twitter.com/"><i class="ion-social-twitter"></i></a></li>
                                            <li><a class="googleplus-icon" href="http://plus.google.com/"><i class="ion-social-googleplus"></i></a></li>
                                            <li><a class="instagram-icon" href="http://www.instagram.com/"><i class="ion-social-instagram-outline"></i></a></li>
                                            <li><a class="youtube-icon" href="http://www.youtube.com/"><i class="ion-social-youtube"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <!--=======  End of single footer widget  =======-->
                            </div>
            
                            <div class="col-lg-4 col-md-6 mt-sm-30">
                                <!--=======  single footer widget  =======-->
                                
                                <div class="single-footer-widget">
                                    <h4 class="footer-widget-title"><a href="#">Follow on instagram</a></h4>
            
                                    <div class="instagram-image-slider-wrapper">
                                        <div class="ht-slick-slider"
                                        data-slick-setting='{
                                            "slidesToShow": 4,
                                            "slidesToScroll": 1,
                                            "dots": false,
                                            "autoplay": false,
                                            "autoplaySpeed": 5000,
                                            "speed": 1000,
                                            "arrows": false,
                                            "rows": 2
                                        }'
                                        data-slick-responsive='[
                                            {"breakpoint":1501, "settings": {"slidesToShow": 4} },
                                            {"breakpoint":1199, "settings": {"slidesToShow": 4} },
                                            {"breakpoint":991, "settings": {"slidesToShow": 3} },
                                            {"breakpoint":767, "settings": {"slidesToShow": 4, "arrows": false} },
                                            {"breakpoint":575, "settings": {"slidesToShow": 4, "arrows": false} },
                                            {"breakpoint":479, "settings": {"slidesToShow": 2, "arrows": false} }
                                        ]'
                                        >
                                            <!--=======  single instagram image  =======-->
                                            
                                            <div class="single-instagram-image">
                                                <a href="#"><img src="assets/img/instagram/a1.jpg" class="img-fluid" alt=""></a>
                                            </div>
                                            
                                            <!--=======  End of single instagram image  =======-->
                                            <!--=======  single instagram image  =======-->
                                            
                                            <div class="single-instagram-image">
                                                <a href="#"><img src="assets/img/instagram/a2.jpg" class="img-fluid" alt=""></a>
                                            </div>
                                            
                                            <!--=======  End of single instagram image  =======-->
                                            <!--=======  single instagram image  =======-->
                                            
                                            <div class="single-instagram-image">
                                                <a href="#"><img src="assets/img/instagram/a3.jpg" class="img-fluid" alt=""></a>
                                            </div>
                                            
                                            <!--=======  End of single instagram image  =======-->
                                            <!--=======  single instagram image  =======-->
                                            
                                            <div class="single-instagram-image">
                                                <a href="#"><img src="assets/img/instagram/a4.jpg" class="img-fluid" alt=""></a>
                                            </div>
                                            
                                            <!--=======  End of single instagram image  =======-->
                                            <!--=======  single instagram image  =======-->
                                            
                                            <div class="single-instagram-image">
                                                <a href="#"><img src="assets/img/instagram/a5.jpg" class="img-fluid" alt=""></a>
                                            </div>
                                            
                                            <!--=======  End of single instagram image  =======-->
                                            <!--=======  single instagram image  =======-->
                                            
                                            <div class="single-instagram-image">
                                                <a href="#"><img src="assets/img/instagram/a6.jpg" class="img-fluid" alt=""></a>
                                            </div>
                                            
                                            <!--=======  End of single instagram image  =======-->
                                            <!--=======  single instagram image  =======-->
                                            
                                            <div class="single-instagram-image">
                                                <a href="#"><img src="assets/img/instagram/a7.jpg" class="img-fluid" alt=""></a>
                                            </div>
                                            
                                            <!--=======  End of single instagram image  =======-->
                                            <!--=======  single instagram image  =======-->
                                            
                                            <div class="single-instagram-image">
                                                <a href="#"><img src="assets/img/instagram/a8.jpg" class="img-fluid" alt=""></a>
                                            </div>
                                            
                                            <!--=======  End of single instagram image  =======-->
                                            <!--=======  single instagram image  =======-->
                                            
                                            <div class="single-instagram-image">
                                                <a href="#"><img src="assets/img/instagram/a1.jpg" class="img-fluid" alt=""></a>
                                            </div>
                                            
                                            <!--=======  End of single instagram image  =======-->
                                            <!--=======  single instagram image  =======-->
                                            
                                            <div class="single-instagram-image">
                                                <a href="#"><img src="assets/img/instagram/a2.jpg" class="img-fluid" alt=""></a>
                                            </div>
                                            
                                            <!--=======  End of single instagram image  =======-->
                                            <!--=======  single instagram image  =======-->
                                            
                                            <div class="single-instagram-image">
                                                <a href="#"><img src="assets/img/instagram/a3.jpg" class="img-fluid" alt=""></a>
                                            </div>
                                            
                                            <!--=======  End of single instagram image  =======-->
                                            <!--=======  single instagram image  =======-->
                                            
                                            <div class="single-instagram-image">
                                                <a href="#"><img src="assets/img/instagram/a4.jpg" class="img-fluid" alt=""></a>
                                            </div>
                                            
                                            <!--=======  End of single instagram image  =======-->
                                        </div>
                                    </div>  
                                </div>
                                
                                <!--=======  End of single footer widget  =======-->
                            </div>
            
                            <div class="col-lg-4 col-md-6 mt-md-30 mt-sm-30">
                                <!--=======  single footer widget  =======-->
                                
                                <div class="single-footer-widget">
                                    <h5 class="montserrat-footer-widget-title">Information</h5>
            
                                    <div class="footer-navigation">
                                        <nav>
                                            <ul>
                                                <li><a href="#">About Us</a></li>
                                                <li><a href="#">Privacy Policy</a></li>
                                                <li><a href="#">Contact Us</a></li>
                                                <li><a href="#">Gift Certificates</a></li>
                                                <li><a href="#">Specials</a></li>
                                                <li><a href="#">Delivery Information</a></li>
                                                <li><a href="#">Terms & Conditions</a></li>
                                                <li><a href="#">Brands</a></li>
                                                <li><a href="#">Affiliate</a></li>
                                                <li><a href="#">Site Map</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                
                                <!--=======  End of single footer widget  =======-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-text-area">
                        <div class="row align-items-center">
                            <div class="col-md-6 text-center text-md-left mb-sm-15">
                                <div class="copyright-text">
                                    <p>Copyright © 2019 <a href="#">Alula</a>. All Right Reserved.</p>
                                </div>
                            </div>
                            <div class="col-md-6 text-center text-md-right">
                                <div class="payment-logo">
                                    <img src="assets/img/icons/payment.png" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--====================  End of footer area  ====================-->
    <!-- scroll to top  -->
    <a href="#" class="scroll-top"></a>
    <!-- end of scroll to top -->
    

	<!--=============================================
    =            JS files        =
    =============================================-->
    
	<!-- Vendor JS -->
    <script src= {{asset("assets/js/vendors.js")}}></script>
    
	<!-- Active JS -->
	<script src= {{asset("assets/js/active.js")}}></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    @stack('javascript')

    

    <!--=====  End of JS files ======-->

</body>
</html>