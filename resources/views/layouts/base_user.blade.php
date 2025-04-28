<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantsasri - Shop</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--Bootstrap Css-->
    <link rel="stylesheet" href="{{ url('assets_user/vendor/bootstrap/css/bootstrap.min.css') }}">

    <!--Slick CSS-->
    <link rel="stylesheet" href="{{ url('assets_user/vendor/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ url('assets_user/vendor/slick/slick-theme.css') }}">

    <!--App Css-->
    <link rel="stylesheet" href="{{ url('assets_user/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!--Main CSS-->
    <link rel="stylesheet" href="{{ url('assets_user/css/main.css') }}">
    @yield('css')
</head>

<body>

    <div id="app">
        <!-- <div id="navbar" class="fixed-top">
            <div class="container">
                <div class="navbar-wrapper">
                    <div class="leftSideNavbar">
                        <div class="logoBrand">
                            <a href="/">
                                <img src="{{ url('assets_user/img/plantsasriLogo.png') }}" alt="">
                            </a>
                        </div>
                        <div class="searchMenu">
                            <form action="{{ route('search') }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <div class="form-outline">
                                        <input type="search" id="form1" name="search" class="form-control" />
                                        <label class="form-label" for="form1">Search</label>
                                    </div>
                                    <button type="submit" class="buttonSearch button button-primary">
                                        <img src="{{ url('assets_user/img/icon/search_icon.svg') }}" alt="">
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="rightSideNavbar">
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
                                    <a href="{{ route('login') }}"
                                        class="button button-outline button-outline-primary">Login</a>
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

                    </div>
                </div>
            </div>
        </div> -->


        <nav class="navbar">
        <div class="navbar-left">
        <a href="{{ url('/') }}">
          <img src="{{ asset('assets/img/Logo FloraTrade.png') }}" alt="FloraTrade Logo" class="navbar__logo" style="width: 50px; height: auto;">
        </a>
          <a href="/about" class="nav-link">About</a>
          <a href="/catalog" class="nav-link highlight">Price List</a>
          <a href="#" class="nav-link">T&C</a>
          <a href="#" class="nav-link">FAQ</a>
          <a href="#" class="nav-link">Contact</a>
        </div>
        <div class="navbar-right">
          <a href="#" class="signup-btn">Sign Up</a>
          <a href="#" class="login-btn">Login</a>
          <img src="https://cdn.builder.io/api/v1/image/assets/282631be213f4cdc9e5c0d357acf295c/99d6ae149f838af0a95e85ddf6095b2fbab6c8ff?placeholderIfAbsent=true" class="logo" alt="FloraTrade Logo" />
        </div>
      </nav>


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
    @yield('js')
</body>

</html>
