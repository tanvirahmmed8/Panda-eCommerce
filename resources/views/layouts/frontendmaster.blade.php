<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }} -  @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('dashboard/uplaods/logo') }}/{{ logo('fav_icon') }}">

    <!-- fraimwork - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/bootstrap.min.css">

    <!-- icon font - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard') }}/icons/font-awesome-old/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/stroke-gap-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/icofont.css">

    <!-- animation - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/animate.css">

    <!-- carousel - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/slick.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/slick-theme.css">

    <!-- popup - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/magnific-popup.css">

    <!-- jquery-ui - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/jquery-ui.css">

    <!-- select option - css include -->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/nice-select.css"> --}}

    <!-- woocommercen - css include -->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/woocommerce.css"> --}}

    @stack('stylesheet')

    <!-- custom - css include -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/style.css">
    <style media="screen">
        .rating_get {
        display: flex;
        flex-direction: row-reverse;
        justify-content: left;
        margin-left: 15px;
        }


        .rating_get > input{ display:none;}

        .rating_get > label {
        position: relative;
        width: 1.1em;
        font-size: 50px;
        color: #cd1212;
        cursor: pointer;
        }

        .rating_get > label::before{
        content: "\2605";
        position: absolute;
        opacity: 0;
        }

        .rating_get > label:hover:before,
        .rating_get > label:hover ~ label:before {
        opacity: 1 !important;
        }

        .rating_get > input:checked ~ label:before{
        opacity:1;
        }

        .rating_get:hover > input:checked ~ label:before{ opacity: 0.4; }




          </style>
    @livewireStyles

</head>

<body>

    <!-- body_wrap - start -->
    <div class="body_wrap">

        <!-- backtotop - start -->
        <div class="backtotop">
            <a href="#" class="scroll">
                <i class="far fa-arrow-up"></i>
            </a>
        </div>
        <!-- backtotop - end -->

        <!-- preloader - start -->
        <div id="preloader"></div>
        <!-- preloader - end -->


        <!-- header_section - start
        ================================================== -->
        <header class="header_section @if (Route::current()->getName() == 'index') header-style-no-collapse @endif">
            <div class="header_top">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-md-6">
                            <ul class="header_select_options ul_li">
                                {{-- <li>
                                    <div class="select_option">
                                        <div class="flug_wrap">
                                            <img src="{{ asset('frontend') }}/images/flug/flug_uk.png" alt="image_not_found">
                                        </div>
                                        <select>
                                            <option data-display="Select Option">Select Your Language</option>
                                            <option value="1" selected>English</option>
                                            <option value="2">Bangla</option>
                                            <option value="3" disabled>Arabic</option>
                                            <option value="4">Hebrew</option>
                                        </select>
                                    </div>
                                </li> --}}

                            </ul>
                        </div>
                        <div class="col col-md-6">
                            <p class="header_hotline">Call us: <strong>{{ setting('contact_number') }}</strong></p>
                            <a href="{{ route('vendor.registration') }}" class="header_hotline">Vendor Registration</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header_middle">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-lg-3 col-md-3 col-sm-12">
                            <div class="brand_logo">
                                <a class="brand_link" href="{{  route('index') }}">
                                    <img src="{{ asset('dashboard/uplaods/logo') }}/{{ logo('frontend_header_logo') }}" srcset="{{ asset('dashboard/uplaods/logo') }}/{{ logo('frontend_header_logo') }}" alt>
                                </a>
                            </div>
                        </div>
                        <div class="col col-lg-6 col-md-6 col-sm-12">
                            <div class="advance_serach">
                                <div class="select_option mb-0 clearfix">
                                    {{-- <select class="form-select border-0" style="box-shadow:none">
                                        <option data-display="All Categories">Select A Category</option>
                                        <option >New Arrival Products</option>
                                        <option value="2">Most Popular Products</option>
                                        <option value="3">Deals of the day</option>
                                        <option value="4">Mobile Accessories</option>
                                        <option value="5">Computer Accessories</option>
                                        <option value="6">Consumer Electronics</option>
                                        <option value="7">Automobiles & Motorcycles</option>
                                    </select> --}}
                                </div>
                                <div class="form_item">
                                    <form action="{{ route('shop') }}" method="GET">
                                        <input type="text" name="search" placeholder="Search Prudcts..." value="@isset($search) {{ $search }} @endisset">
                                        <button type="submit" class="search_btn"><i class="far fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col col-lg-3 col-md-3 col-sm-12">
                            <button class="mobile_menu_btn2 navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_menu_dropdown" aria-controls="main_menu_dropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fal fa-bars"></i>
                            </button>
                            <button type="button" class="cart_btn">
                               <ul class="header_icons_group ul_li_right">
                                    {{-- <li>
                                        <a href="#">
                                            <svg role="img" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" stroke="#051d43" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg>
                                            <span class="wishlist_counter">3</span>
                                        </a>
                                    </li> --}}
                                    <li>
                                        <a href="#">
                                            <span class="cart_icon">
                                                <i class="icon icon-ShoppingCart"></i>
                                                <small class="cart_counter">{{ cartcount() }}</small>
                                            </span>
                                        </a>
                                    </li>
                               </ul>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header_bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-md-3">
                            <div class="allcategories_dropdown">
                                <button class="allcategories_btn" type="button" data-bs-toggle="collapse" data-bs-target="#allcategories_collapse" aria-expanded="false" aria-controls="allcategories_collapse">
                                    <svg role="img" xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" viewBox="0 0 24 24" aria-labelledby="statsIconTitle" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none" color="#000"> <title id="statsIconTitle">Stats</title> <path d="M6 7L15 7M6 12L18 12M6 17L12 17"/> </svg>
                                    Browse categories
                                </button>
                                <div class="allcategories_collapse collapse" id="allcategories_collapse">
                                    <div class="card card-body">
                                        <ul class="allcategories_list ul_li_block">
                                            @foreach (cat() as $cat)
                                                <li><a href="{{ route('search.category', $cat->id) }}"><i class="icon icon-Starship"></i> {{ $cat->category_name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-md-6">
                            <nav class="main_menu navbar navbar-expand-lg">
                                <div class="main_menu_inner collapse navbar-collapse" id="main_menu_dropdown">
                                    <button type="button" class="offcanvas_close">
                                        <i class="fal fa-times"></i>
                                    </button>
                                    <ul class="main_menu_list ul_li">
                                        <li><a class="nav-link" href="{{ route('index') }}">Home</a></li>
                                        <li><a class="nav-link" href="{{ route('about') }}">About us</a></li>
                                        <li><a class="nav-link" href="{{ route('shop') }}">Shop</a></li>
                                        <li><a class="nav-link" href="{{ route('contact') }}">Contact Us</a></li>
                                    </ul>
                                </div>
                            </nav>
                            <div class="offcanvas_overlay"></div>
                        </div>

                        <div class="col col-md-3">
                            <ul class="header_icons_group ul_li_right">
                                @guest
                                    <li>
                                        <a href="{{ route('login.register') }}">Login/Register</a>
                                    </li>
                                @endguest

                                @auth
                                    <li>
                                        <a href="{{ route('home') }}">{{ Str::title(auth()->user()->name) }}</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            @if (auth()->user()->profile_photo)
                                            <img src="{{ asset('dashboard/uplaods/profile_photos') }}/{{ auth()->user()->profile_photo }}" width="30px"  class="img-fluid rounded-circle" alt="">
                                            @else
                                            <img src="{{ Avatar::create(Str::upper(auth()->user()->name))->toBase64() }}" width="30px" class="img-fluid rounded-circle" alt="">
                                            @endif
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                          <li><a class="dropdown-item" href="{{ route('home') }}">My Account</a></li>
                                          <li><hr class="dropdown-divider"></li>
                                          <li>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button class="btn btn-danger">Logout</button>
                                            </form>
                                          </li>
                                        </ul>
                                      </li>
                                    <li>

                                    </li>
                                @endauth

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header_section - end
        ================================================== -->

        <!-- main body - start
        ================================================== -->
        <main>
            <!-- sidebar cart - start
		================================================== -->
		<div class="sidebar-menu-wrapper">
            <div class="cart_sidebar">
                @php
                $subtotalg = 0;

                @endphp
                <button type="button" class="close_btn"><i class="fal fa-times"></i></button>
               @if (cartg()->count() > 0)
                 <ul class="cart_items_list ul_li_block mb_30 clearfix">
                     @foreach (cartg() as $cartg)
                         <li>
                             <div class="item_image">
                                 <img src="{{ asset('dashboard/uplaods/product_thumbnail') }}/{{ $cartg->productrel->thumbnail }}" alt="image_not_found">
                             </div>
                             <div class="item_content">
                                 <h4 class="item_title">{{ $cartg->productrel->name }}</h4>
                             </div>
                             @php
                                 $subtotalg += cart_total($cartg->product_id, $cartg->quantity);
                             @endphp
                              @if ($cartg->productrel->discounted_price)
                              <span class="remove_btn">{{ currency() }}{{ $cartg->quantity * $cartg->productrel->discounted_price }}</span>
                              @else
                              <span class="remove_btn">{{ currency() }}{{ $cartg->quantity * $cartg->productrel->regular_price }}</span>
                              @endif
                             {{-- <button type="button" class="remove_btn"><i class="fal fa-trash-alt">{{ $cartg->quantity }} </i></button> --}}
                         </li>
                     @endforeach

                 </ul>

                 <ul class="total_price ul_li_block mb_30 clearfix">
                     <li>
                         <span>Subtotal:</span>
                         <span>{{ currency() }}{{ ceil($subtotalg) }}</span>
                     </li>
                 </ul>

               @else
                <ul class="btns_group ul_li_block mb-5 clearfix">
                    <div class="empty_cart_content text-center">
                        <span class="cart_icon">
                            <i class="icon icon-ShoppingCart"></i>
                        </span>
                        <h3>There are no more items in your cart</h3>
                        <a class="btn btn_secondary" href="{{ route('shop') }}"><i class="far fa-chevron-left"></i> Continue shopping </a>
                    </div>
                </ul>
               @endif
               <ul class="btns_group ul_li_block clearfix">
                <li><a class="btn btn_primary" href="{{ route('cart') }}">View Cart</a></li>
                {{-- <li><a class="btn btn_secondary" href="checkout.html">Checkout</a></li> --}}
                </ul>
            </div>

            <div class="cart_overlay"></div>
        </div>
		<!-- sidebar cart - end
		================================================== -->


            @yield('content')


            <!-- newsletter_section - start
            ================================================== -->
            <section class="newsletter_section">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-lg-6">
                            <h2 class="newsletter_title text-white">Sign Up for Newsletter </h2>
                            <p>{{ setting('newsletter_text') }}</p>
                        </div>
                        <div class="col col-lg-6">
                            <form action="#!">
                                <div class="newsletter_form">
                                    <input type="email" name="email" placeholder="Enter your email address">
                                    <button type="submit" class="btn btn_secondary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- newsletter_section - end
            ================================================== -->

        </main>
        <!-- main body - end
        ================================================== -->

        <!-- footer_section - start
        ================================================== -->
        <footer class="footer_section">
            <div class="footer_widget_area">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-4 col-md-6 col-sm-6">
                            <div class="footer_widget footer_about">
                                <div class="brand_logo">
                                    <a class="brand_link" href="{{  route('index') }}">
                                        <img src="{{ asset('dashboard/uplaods/logo') }}/{{ logo('frontend_footer_logo') }}" srcset="{{ asset('dashboard/uplaods/logo') }}/{{ logo('frontend_footer_logo') }}" alt="logo_not_found">
                                    </a>
                                </div>
                                <ul class="social_round ul_li">
                                    <li><a href="#!"><i class="icofont-youtube-play"></i></a></li>
                                    <li><a href="#!"><i class="icofont-instagram"></i></a></li>
                                    <li><a href="#!"><i class="icofont-twitter"></i></a></li>
                                    <li><a href="#!"><i class="icofont-facebook"></i></a></li>
                                    <li><a href="#!"><i class="icofont-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col col-lg-2 col-md-3 col-sm-6">
                            <div class="footer_widget footer_useful_links">
                                <h3 class="footer_widget_title text-uppercase">Quick Links</h3>
                                <ul class="ul_li_block">
                                    <li><a href="{{ route('about') }}">About Us</a></li>
                                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                    <li><a href="{{ route('shop') }}">Products</a></li>
                                    @guest
                                    <li><a href="{{ route('login.register') }}">Login</a></li>
                                    <li><a href="{{ route('login.register') }}">Sign Up</a></li>
                                    @endguest
                                </ul>
                            </div>
                        </div>

                        <div class="col col-lg-2 col-md-3 col-sm-6">
                            <div class="footer_widget footer_useful_links">
                                <h3 class="footer_widget_title text-uppercase">Custom area</h3>
                                <ul class="ul_li_block">
                                    <li><a href="{{ route('home') }}">My Account</a></li>
                                    <li><a href="{{ route('home') }}">Orders</a></li>
                                    <li><a href="{{ route('team') }}">Team</a></li>
                                    <li><a href="#!">Privacy Policy</a></li>
                                    <li><a href="{{ route('cart') }}">My Cart</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col col-lg-4 col-md-6 col-sm-6">
                            <div class="footer_widget footer_contact">
                                <h3 class="footer_widget_title text-uppercase">Contact Onfo</h3>
                                <p>
                                    {{ setting('contact_info') }}
                                </p>
                                <div class="hotline_wrap">
                                    <div class="footer_hotline">
                                        <div class="item_icon">
                                            <i class="icofont-headphone-alt"></i>
                                        </div>
                                        <div class="item_content">
                                            <h4 class="item_title">Have any question?</h4>
                                            <span class="hotline_number">{{ setting('contact_number') }}</span>
                                        </div>
                                    </div>
                                    {{-- <div class="livechat_btn clearfix">
                                        <a class="btn border_primary" href="#!">Live Chat</a>
                                    </div> --}}
                                </div>
                                <ul class="store_btns_group ul_li">
                                    <li><a href="#!"><img src="{{ asset('frontend') }}/images/app_store.png" alt="app_store"></a></li>
                                    <li><a href="#!"><img src="{{ asset('frontend') }}/images/play_store.png" alt="play_store"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer_bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-md-6">
                            <p class="copyright_text">
                                {!! setting('copyright_area') !!}
                            </p>
                        </div>

                        <div class="col col-md-6">
                            <div class="payment_method">
                                <h4>Payment:</h4>
                                <img src="{{ asset('frontend') }}/images/payments_icon.png" alt="image_not_found">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer_section - end
        ================================================== -->

    </div>
    <!-- body_wrap - end -->

    <!-- fraimwork - jquery include -->
    <script src="{{ asset('frontend') }}/js/jquery.min.js"></script>
    <script src="{{ asset('frontend') }}/js/popper.min.js"></script>
    <script src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>

    <!-- carousel - jquery plugins collection -->
    <script src="{{ asset('frontend') }}/js/jquery-plugins-collection.js"></script>

    <!-- google map  -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDk2HrmqE4sWSei0XdKGbOMOHN3Mm2Bf-M&ver=2.1.6"></script>
    <script src="{{ asset('frontend') }}/js/gmaps.min.js"></script>

    <!-- custom - main-js -->
    <script src="{{ asset('frontend') }}/js/main.js"></script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/635cd650b0d6371309cc27dc/1gghaaasp';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();

    function reloadMyView() {
        $.get('/my-view', function (data) {
            $('#my-view-content').html(data);
        });
    }
    </script>
    <!--End of Tawk.to Script-->

    {!! NoCaptcha::renderJs() !!}
    @stack('script')
    @yield('script_b')
    @livewireScripts
</body>
</html>

