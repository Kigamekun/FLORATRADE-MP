@extends('layouts.base_user')

@section('css')

    <title>Plantsasri - Terms & Conditional</title>

    <!--about,faq,terms CSS-->
    <link rel="stylesheet" href="{{ url('assets_user/css/about-faq.css') }}">

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
    <div class="wrapperFooter container">
        <div class="about">
            <img src="{{ url('assets_user/img/Logo_Plantsasri 1 1.png') }}" alt="">
            <p>Find the various types of plants you want with Plantsasri. Your satisfaction and comfort is our priority.
            </p>
        </div>
        <div class="links">
            <a href="">Home</a>
            <a href="">About Plantsasri</a>
            <a href="{{ route('more') }}">Explore Plants</a>
            <a href="{{ route('catalog') }}">List Price</a>
            <a href="{{ route('faq') }}">Faq</a>
            <a href="{{ route('terms') }}">Terms & Condition</a>
        </div>
        <div class="contact">
            <p>Contact Us</p>
            <a class="item email" href="">
                <img src="{{ url('assets_user/img/icon/email 2.png') }}" alt="">
                <p>dadaiafh@gmail.com</p>
            </a>
            <a class="item call" href="">
                <img src="{{ url('assets_user/img/icon/telephone-handle-silhouette 1.png') }}" alt="">
                <p>+6286473563</p>
            </a>
            <a class="item address" href="">
                <img src="{{ url('assets_user/img/icon/pin (1).png') }}" alt="">
                <p>GARDEN, No.13 Jalan Cijahe, Curug Mekar - Bogor Barat, Bogor, Jawa Barat</p>
            </a>
        </div>
    </div>
    <div class="wrapperCopy container">
        <p>© 2022 Plantsasri, Design By Startcode</p>
        <p><b>English</b></p>
    </div>
</footer>

@endsection

@section('js')

<script src="{{ url('assets/vendor/jquery/jquery.min.js') }}"></script>
@endsection