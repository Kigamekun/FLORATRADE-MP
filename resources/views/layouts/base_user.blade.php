<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FloraTrade</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--Bootstrap Css-->
    <link rel="stylesheet" href="{{ url('assets_user/vendor/bootstrap/css/bootstrap.min.css') }}">

    <!--Slick CSS-->
    <link rel="stylesheet" href="{{ url('assets_user/vendor/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ url('assets_user/vendor/slick/slick-theme.css') }}">

    <!--App Css-->
    <link rel="stylesheet" href="{{ url('assets_user/css/app.css') }}">

    <!--Main CSS-->
    <link rel="stylesheet" href="{{ url('assets_user/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    @yield('css')
</head>

<body>

        <div id="app">
            <div id="navbar" class="fixed-top">
                <div class="container">
                    <div class="navbar-wrapper">
                        <div class="leftSideNavbar">
                            <div class="logoBrand">
                                <a href="/">
                                    <img src="{{ url('assets/img/Logo FloraTrade.png') }}" alt="">
                                </a>
                            </div>
                            <!-- Desktop Menu -->
                            <div class="menuLinks desktop-menu">
                                <a href="{{ url('/about') }}" class="nav-link">About</a>
                                <a href="{{ url('/catalog') }}" class="nav-link">Price List</a>
                                <a href="{{ url('/faq') }}" class="nav-link">FAQ</a>
                                <a href="{{ url('/chat/1') }}" class="nav-link">Contact</a>
                            </div>
                        </div>
                        
                        <div class="rightSideNavbar">
                            <!-- Auth & Cart Section -->
                            @if (Auth::check())
                                <div class="afterLogin">
                                    <a href="{{ route('profile') }}" class="profileWrapper icon">
                                        <img src="{{ Auth::user()->thumb }}" style="border-radius: 50%" alt="">
                                    </a>
                                    <div class="cartWrapper">
                                        <a href="{{ route('my-cart') }}" class="cart icon">
                                            <img src="{{ url('assets_user/img/icon/shopping-cart_icon.svg') }}" alt="">
                                            <div id="count-cart" class="totalItem">
                                                {{ DB::table('carts')->where(['user_id' => Auth::id(), 'order_id' => null])->count() }}
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="beforeLogin">
                                    <div class="buttonWrapper">
                                        <a href="{{ route('login') }}" class="button button-outline button-outline-primary">Login</a>
                                        <a href="{{ route('register') }}" class="button button-primary">Sign Up</a>
                                    </div>
                                    <div class="cartWrapper">
                                        <a href="{{ route('my-cart') }}" class="cart icon">
                                            <img src="{{ url('assets_user/img/icon/shopping-cart_icon.svg') }}" alt="">
                                            <div id="count-cart" class="totalItem">
                                                {{ is_null(json_decode(Cookie::get('cart'), true)) ? 0 : count(json_decode(Cookie::get('cart'), true)) }}
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Hamburger Menu Button (Mobile Only) -->
                            <button class="hamburger-btn mobile-only" onclick="toggleMobileMenu()">
                                ☰
                            </button>
                        </div>
                    </div>
                    
                    <!-- Mobile Menu -->
                    <div class="mobile-menu-wrapper">
                        <div class="mobile-menu">
                            <a href="{{ url('/about') }}" class="nav-link">About</a>
                            <a href="{{ url('/catalog') }}" class="nav-link">Price List</a>
                            <a href="{{ url('/faq') }}" class="nav-link">FAQ</a>
                            <a href="{{ url('/chat/1') }}" class="nav-link">Contact</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')
    </div>







    <!--Vendor-->
    <!--Jquery-->
    <script src="{{ url('assets_user/vendor/jquery/jquery.min.js') }}"></script>
    <!--Bootstrap-->
    <script src="{{ url('assets_user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!--Slick Js-->
    <script src="{{ url('assets_user/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ url('assets_user/vendor/slick/slick.js') }}"></script>

    <script>
        $('.wrapperBanner').slick({
            Infinity: true,
            centerMode: true,
            centerPadding: '120px',
            slidesToShow: 1,
            arrows: false,
            dots: true,
            appendDots: $('.slick-slider-dots'),

            responsive: [{
                    breakpoint: 1200,
                    settings: {
                        centerPadding: '100px'
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        centerPadding: '60px'
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        centerPadding: '40px'

                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        centerPadding: '40px'

                    }
                },
                {
                    breakpoint: 475,
                    settings: {
                        centerMode: false,
                    }
                }
            ]
        });
    </script>

    <script>
        $('.bestOfferProduct').slick({
            dots: false,
            infinite: false,
            arrows: false,
            speed: 300,
            slidesToShow: 3.2,
            slidesToScroll: 3,

            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 2.2,
                    slidesToScroll: 2,
                }
            }, ]
        });
    </script>
    <script>
    function toggleMobileMenu() {
        const mobileMenu = document.querySelector('.mobile-menu');
        mobileMenu.classList.toggle('active');
    }

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
        const mobileMenu = document.querySelector('.mobile-menu');
        const hamburgerBtn = document.querySelector('.hamburger-btn');
        
        if (!mobileMenu.contains(e.target) && !hamburgerBtn.contains(e.target)) {
            mobileMenu.classList.remove('active');
        }
    });
    </script>
    @yield('js')
</body>

</html>