@extends('layouts.base_user')

@section('css')

    <title>Plantsasri - Terms & Conditional</title>

    <!--about,faq,terms CSS-->
    <link rel="stylesheet" href="{{ url('assets_user/css/about-faq.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

@endsection

@section('content')

<div class="app">

    <div id="mainContent">
        <div class="banner-title">
            <h1 class="title">Terms And Conditions</h1>
            <div class="breadchumb-wrapper">
                <a href="./main.html">Home</a>
                <span>-</span>
                <p>Terms And Conditions</p>
            </div>
        </div>
        <div class="content container">
            {!! DB::table('terms')->first()->terms !!}
        </div>
    </div>

</div>
    <footer>
        <div class="footer__container">
          <div class="footer__content">
            <div class="footer__brand">
              <h1 class="footer__logo">FloraTrade</h1>
              <p class="footer__tagline">
                Bringing Nature Closer to You with the Best Plants, the Best
                Prices, and the Best Care.
                <br />
                Your satisfaction and comfort is our priority.
              </p>
            </div>
      
            <nav class="footer__links">
              <a href="#" class="footer__link">Home</a>
              <a href="#" class="footer__link">About FloraTrade</a>
              <a href="#" class="footer__link">Explore Plants</a>
              <a href="#" class="footer__link">Price List</a>
              <a href="#" class="footer__link">FAQ</a>
              <a href="#" class="footer__link">Terms &amp; Condition</a>
            </nav>
      
            <div class="footer__contact">
              <h3 class="footer__contact-title">Contact Us</h3>
              
              <div class="footer__contact-item">
                <img src="{{ url('assets_user/img/icon/telephone-handle-silhouette 1.png') }}" alt="">
                <span class="footer__contact-text">+6280123719310</span>
              </div>
      
              <div class="footer__contact-item">
                <img src="{{ url('assets_user/img/icon/email 2.png') }}" alt="">
                <span class="footer__contact-text">floratrade9@gmail.com</span>
              </div>
      
              <div class="footer__contact-item">
                <img src="{{ url('assets_user/img/icon/pin (1).png') }}" alt="" >
                <span class="footer__contact-text">Curug Mekar - Bogor Barat, Bogor, Jawa Barat</span>
              </div>
            </div>
          </div>
        </div>
    </footer>

@endsection

@section('js')

<script src="{{ url('assets/vendor/jquery/jquery.min.js') }}"></script>
@endsection