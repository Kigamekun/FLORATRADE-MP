@extends('layouts.base_user')

@section('css')
    <link rel="stylesheet" href="{{ url('assets_user/css/cart.css') }}">
    <style>
        /* New styles from the design */
        .cart-page {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            align-items: stretch;
            background-color: rgba(245, 245, 245, 1);
            min-height: 100vh;
        }

        /* Navbar styles */
        .navbar {
            background-color: rgba(255, 255, 255, 1);
            display: flex;
            width: 100%;
            padding: 32px 68px;
            align-items: stretch;
            gap: 20px;
            font-family: Poppins, -apple-system, Roboto, Helvetica, sans-serif;
            font-weight: 500;
            text-align: center;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 24px;
            font-size: 16px;
            color: rgba(51, 184, 125, 1);
            justify-content: start;
            flex-wrap: wrap;
        }

        .nav-link {
            align-self: stretch;
            border-radius: 8px;
            margin-top: auto;
            margin-bottom: auto;
            padding: 8px 16px;
            text-decoration: none;
            color: rgba(51, 184, 125, 1);
            white-space: nowrap;
        }

        .nav-link-active {
            /* No special styling in the original design */
        }

        .auth-container {
            align-self: start;
            display: flex;
            align-items: start;
            gap: 23px;
        }

        .signup-btn {
            align-self: stretch;
            border-radius: 8px;
            background-color: rgba(51, 184, 125, 1);
            padding: 6px 15px;
            font-size: 15px;
            color: rgba(255, 255, 255, 1);
            text-decoration: none;
        }

        .login-btn {
            align-self: stretch;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 1);
            border: 1px solid rgba(51, 184, 125, 1);
            padding: 6px 16px;
            font-size: 16px;
            color: rgba(51, 184, 125, 1);
            text-decoration: none;
            white-space: nowrap;
        }

        .cart-icon {
            aspect-ratio: 1;
            object-fit: contain;
            object-position: center;
            width: 33px;
            flex-shrink: 0;
        }

        /* Main cart container */
        .cart-container {
            align-self: center;
            margin-top: 100px;
            width: 100%;
            max-width: 1138px;
            padding: 0 20px;
        }

        .cart-layout {
            gap: 20px;
            display: flex;
        }

        /* Cart items column */
        .cart-items-column {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            line-height: normal;
            width: 76%;
            margin-left: 0;
        }

        .cart-card {
            border-radius: 8px;
            background-color: #fff;
            display: flex;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
            padding: 35px 51px 63px;
            flex-direction: column;
            align-items: stretch;
            font-family: Poppins, -apple-system, Roboto, Helvetica, sans-serif;
        }

.cart-header {
    align-self: start;
    display: flex;
    align-items: center;
    gap: 21px;
    font-size: 30px;
    color: #2a2c2b;
    font-weight: 500;
    position: relative;
    margin-bottom: 15px;
}

.cart-header-icon {
    width: 34px;
    height: 34px;
    flex-shrink: 0;
    background-color: rgba(51, 184, 125, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 6px;
}

.cart-header-icon svg {
    width: 100%;
    height: 100%;
}

        .cart-title {
            flex-basis: auto;
            font-size: 30px;
            font-weight: 500;
        }

        .green-divider {
            border: 2px solid rgba(51, 184, 125, 1);
            margin-left: 97px;
            width: 59px;
            flex-shrink: 0;
            height: 2px;
        }

        .select-all-row {
            align-self: start;
            display: flex;
            margin-top: 30px;
            align-items: stretch;
            gap: 12px;
            font-size: 15px;
            color: #2a2c2b;
            font-weight: 400;
        }

        .checkbox-container {
            border-radius: 6px;
            border: 1px solid rgba(0, 0, 0, 1);
            align-self: start;
            display: flex;
            width: 20px;
            flex-shrink: 0;
            height: 20px;
            cursor: pointer;
        }

        .checkbox-container.checked {
            background-color: rgba(51, 184, 125, 0.2);
            position: relative;
        }

        .checkbox-container.checked::after {
            content: "✓";
            position: absolute;
            color: rgba(51, 184, 125, 1);
            font-size: 14px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .select-all-text {
            font-size: 15px;
            font-weight: 400;
        }

        .item-divider {
            border: 1px solid rgba(182, 183, 187, 1);
            background-color: #b6b7bb;
            margin-top: 29px;
            flex-shrink: 0;
            height: 0;
            border-width: 0 0 1px 0;
        }

        /* Cart item styles */
        .product-list {
            display: flex;
            margin-top: 23px;
            margin-left: 18px;
            width: 100%;
            align-items: stretch;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .item-details {
            display: flex;
            align-items: center;
            gap: 26px;
            font-size: 13px;
            color: #2a2c2b;
            font-weight: 400;
        }

        .item-checkbox {
            border-radius: 6px;
            border: 1px solid rgba(0, 0, 0, 1);
            align-self: stretch;
            display: flex;
            margin-top: auto;
            margin-bottom: auto;
            width: 21px;
            flex-shrink: 0;
            height: 20px;
            cursor: pointer;
        }

        .item-checkbox.checked {
            background-color: rgba(51, 184, 125, 0.2);
            position: relative;
        }

        .item-checkbox.checked::after {
            content: "✓";
            position: absolute;
            color: rgba(51, 184, 125, 1);
            font-size: 14px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .item-image {
            aspect-ratio: 0.86;
            object-fit: contain;
            object-position: center;
            width: 99px;
            border-radius: 6px;
            align-self: stretch;
            flex-shrink: 0;
        }

        .item-info {
            align-self: stretch;
            display: flex;
            margin-top: auto;
            margin-bottom: auto;
            flex-direction: column;
            align-items: start;
        }

        .item-name {
            font-size: 15px;
            font-weight: 500;
            color: #2a2c2b;
        }

        .item-price {
            color: #b4bab7;
            margin-top: 12px;
            font-size: 13px;
        }

        .quantity-control {
            align-self: stretch;
            display: flex;
            margin-top: 11px;
            align-items: stretch;
            white-space: nowrap;
        }

        .quantity-btn {
            border: 0.568px solid #b6b7bb;
            padding: 4px 15px;
            background: none;
            cursor: pointer;
            font-family: inherit;
        }

        .decrease {
            border-radius: 2.274px 0 0 2.274px;
            border-top: 0.568px solid var(--grey-200, #b6b7bb);
            border-bottom: 0.568px solid var(--grey-200, #b6b7bb);
            border-left: 0.568px solid var(--grey-200, #b6b7bb);
            border-right: none;
        }

        .increase {
            border-radius: 0 2.274px 2.274px 0;
            border-top: 0.568px solid var(--grey-200, #b6b7bb);
            border-bottom: 0.568px solid var(--grey-200, #b6b7bb);
            border-left: 0.568px solid var(--grey-200, #b6b7bb);
            border-right: none;
        }

        .quantity-value {
            padding: 4px 22px;
            border-top: 0.568px solid #b6b7bb;
            border-bottom: 0.568px solid #b6b7bb;
        }

        .item-total {
            align-self: start;
            margin-top: 7px;
            font-size: 19px;
            color: rgba(51, 184, 125, 1);
            font-weight: 500;
            white-space: nowrap;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .total-price {
            display: inline;
        }

        .delete-icon {
            aspect-ratio: 0.83;
            object-fit: contain;
            object-position: center;
            width: 15px;
            margin-top: 43px;
            margin-left: 18px;
            cursor: pointer;
        }

        /* Order summary column */
        .order-summary-column {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            line-height: normal;
            width: 24%;
            margin-left: 20px;
        }

        .summary-container {
            width: 100%;
            font-family: Poppins, -apple-system, Roboto, Helvetica, sans-serif;
        }

.coupon-container {
    border-radius: 8px;
    background-color: #fff;
    padding: 26px 28px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: 100%;
    box-sizing: border-box;
}

.coupon-input-group {
    width: 100%;
    margin: 0;
}

.coupon-label {
    color: #494c4b;
    font-size: 14px;
    align-self: start;
    margin-left: 10px; /* Added to align with input */
}

.coupon-input {
    border-radius: 4px;
    border: 1px solid rgba(51, 184, 125, 1);
    padding: 10px 15px;
    font-size: 13px;
    color: #b4bab7;
    width: 100%;
    height: 40px;
    box-sizing: border-box;
    margin: 0;
}

.apply-btn {
    border-radius: 4px;
    background-color: rgba(51, 184, 125, 1);
    color: white;
    border: 1px solid rgba(51, 184, 125, 1);
    padding: 5px 5px;
    height: 35px; /* Made 5px smaller */
    font-size: 14px;
    cursor: pointer;
    width: calc(100% - 120px); /* Adjusted width */
    margin-left: 10px; /* Added to align with input */
    text-align: center;
    transform: translateX(143%)
}

        .order-total-container {
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 1);
            margin-top: 19px;
            width: 100%;
            padding: 21px 22px;
            font-size: 13px;
            color: #494c4b;
            font-weight: 700;
        }

        .subtotal-row {
            display: flex;
            align-items: stretch;
            gap: 20px;
            font-weight: 500;
            justify-content: space-between;
        }

        .price-labels {
            display: flex;
            flex-direction: column;
        }

        .discount-label {
            margin-top: 13px;
        }

        .price-values {
            display: flex;
            flex-direction: column;
            white-space: nowrap;
        }

        .discount-value {
            margin-top: 13px;
        }

        .summary-divider {
            border: 1px solid rgba(182, 183, 187, 1);
            background-color: #b6b7bb;
            margin-top: 20px;
            width: 100%;
            flex-shrink: 0;
            height: 1px;
            border-width: 0 0 1px 0;
        }

        .total-row {
            display: flex;
            margin-top: 23px;
            align-items: stretch;
            gap: 20px;
            justify-content: space-between;
        }

        .checkout-btn {
            align-self: stretch;
            border-radius: 8px;
            background-color: rgba(51, 184, 125, 1);
            margin-top: 32px;
            min-height: 34px;
            padding: 7px 13px;
            gap: 8px;
            color: #fff;
            text-align: center;
            border: none;
            cursor: pointer;
            font-family: inherit;
            font-weight: 700;
            width: 100%;
        }

        /* Footer styles - Updated from second code */
        .footer__container {
            background-color: #fff;
            width: 100%;
            padding: 59px 75px;
        }

        .footer__content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
            font-family: Poppins, -apple-system, Roboto, Helvetica, sans-serif;
            color: #494c4b;
        }

        .footer__brand {
            display: flex;
            flex-direction: column;
            max-width: 300px;
        }

        .footer__logo {
            font-size: 61px;
            font-weight: 400;
            margin: 0;
        }

        .footer__tagline {
            font-size: 16px;
            font-weight: 300;
            line-height: 32px;
            margin-top: 22px;
        }

        .footer__links {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-top: 8px;
        }

        .footer__link {
            color: #494c4b;
            text-decoration: none;
            font-size: 16px;
            font-weight: 300;
        }

        .footer__contact {
            display: flex;
            flex-direction: column;
        }

        .footer__contact-title {
            font-size: 16px;
            font-weight: 300;
            margin: 0 0 17px 0;
        }

        .footer__contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 17px;
        }

        .footer__contact-item img {
            width: 20px;
            height: 20px;
        }

        .footer__contact-text {
            font-size: 16px;
            font-weight: 300;
        }

        /* Media queries */
        @media (max-width: 991px) {
            .navbar {
                max-width: 100%;
                padding-left: 20px;
                padding-right: 20px;
            }

            .nav-menu {
                max-width: 100%;
            }

            .nav-link {
                white-space: initial;
            }

            .login-btn {
                white-space: initial;
            }

            .cart-container {
                max-width: 100%;
            }

            .cart-layout {
                flex-direction: column;
                align-items: stretch;
                gap: 0;
            }

            .cart-items-column {
                width: 100%;
            }

            .cart-card {
                max-width: 100%;
                margin-top: 22px;
                padding-left: 20px;
                padding-right: 20px;
            }

            .green-divider {
                margin-left: 10px;
            }

            .item-divider {
                max-width: 100%;
            }

            .product-list {
                max-width: 100%;
            }

            .quantity-control {
                white-space: initial;
            }

            .quantity-btn {
                white-space: initial;
            }

            .quantity-value {
                padding-left: 20px;
                padding-right: 20px;
                white-space: initial;
            }

            .item-total {
                white-space: initial;
            }

            .delete-icon {
                margin-left: 10px;
                margin-top: 40px;
            }

            .order-summary-column {
                width: 100%;
            }

            .summary-container {
                margin-top: 22px;
            }

            .coupon-container {
                padding-left: 20px;
                padding-right: 20px;
            }

            .coupon-input {
                padding-right: 20px;
            }

            .apply-btn {
                white-space: initial;
            }

            .order-total-container {
                padding-left: 20px;
                padding-right: 20px;
            }

            .subtotal-row {
                margin-right: 2px;
            }

            .discount-label {
                margin-right: 2px;
            }

            .price-values {
                white-space: initial;
            }

            .total-row {
                margin-right: 2px;
            }

            .checkout-btn {
                margin-right: 2px;
            }

            .footer__container {
                padding-left: 20px;
                padding-right: 20px;
            }

            .footer__logo {
                font-size: 40px;
            }
        }

        /* Existing styles */
        .text-disc {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="cart-page">


        <main class="cart-container">
            <div class="cart-layout">
                <section class="cart-items-column">
                    <div class="cart-card">
                        <div class="cart-header">
                           <!-- Option 1: Direct SVG -->
<svg class="cart-header-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#33b87d" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
</svg>
                            <h1 class="cart-title">Your Cart</h1>
                        </div>
                        <div class="green-divider"></div>

                        @if (!$authenticable)
                            <div class="alert alert-success" role="alert">
                                <div class="icon-alert">
                                    <img src="{{ url('assets_user/img/icon/alert-icon.svg') }}" alt="">
                                </div>
                                Hello, you are not logged in, please Sign In !
                            </div>
                        @endif

                        <div class="select-all-row">
                            <div class="form-check checkbox-select">
                                <input class="form-check-input checkbox-all" id="select-all" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label select-all-text" for="flexCheckDefault">
                                    Choose all
                                </label>
                            </div>
                            <div class="delete-button delete-all">
                                <a href="{{ route('delete-cart-all') }}" class="delete-cart-button text-decoration-none">
                                    <img src="{{ url('assets_user/img/icon/trash-delete-icon.svg') }}" alt="">
                                    Delete
                                </a>
                            </div>
                        </div>

                        <hr class="item-divider">

                        <div class="body-cart">
                            @php
                                $total_cart = 0;
                            @endphp

                            @if ($authenticable)
                                @if ($data->count() == 0)
                                <div class="mt-5 d-flex align-items-center flex-column">
                                    <img src="{{ url('assets_user/img/state-cart.png') }}" alt="dafnafa">
                                    <h2 style="color: #535353;" class="mt-3">Yahh, your cart is empty</h2>
                                    <p style="color: #535353;" class="mt-1">Let's fill it with your favorite plant !</p>
                                    <a href="{{ route('more') }}" class="button button-primary w-50 text-decoration-none mt-3">Start Shopping</a>
                                </div>
                                @else
                                    @foreach ($data as $key => $item)
                                    @php
                                        $plant = DB::table('plants')
                                            ->where('id', $item->plant_id)
                                            ->first();
                                        $thumb = json_decode($plant->thumb, true);
                                    @endphp

                                    <div class="product-list">
                                        <div class="form-check checkbox-select checkbox-item">
                                            <input class="form-check-input check-item" type="checkbox" data-price="{{ $plant->price * $item->qty }}" value="" data-item-id="@if(Auth::check()){{$item->id}}@else{{$key}}@endif" id="flexCheckDefault" checked>
                                        </div>
                                        <div class="item-details">
                                            <img src="{{ url('thumbPlant/' . $thumb[0]) }}" alt="" class="item-image">
                                            <div class="item-info">
                                                <h3 class="item-name">{{ $plant->name }}</h3>
                                                <p class="item-price">$ <span class="price-plant">{{ $plant->price }}</span>/Plant</p>
                                                <div class="action-cart">
                                                    <div class="quantity-product quantity-control">
                                                        <button data-id="@if(Auth::check()){{$item->id}}@else{{$key}}@endif" class="de quantity-count quantity-count--minus quantity-btn decrease" data-action="minus" type="button" id="mins">-</button>
                                                        <input id="qty-@if(Auth::check()){{$item->id}}@else{{$key}}@endif" class="product-quantity quantity-value" type="number" name="product-quantity" min="1" max="10" value="{{ $item->qty }}">
                                                        <button data-id="@if(Auth::check()){{ $item->id }}@else{{$key}}@endif" class="in quantity-count quantity-count--add quantity-btn increase" data-action="add" type="button">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-total">
                                            <p class="total-price">$ <span id="total-@if(Auth::check()){{$item->id}}@else{{$key}}@endif" class="price">{{ $plant->price * $item->qty }}</span></p>
                                            @if (Auth::check())
                                                <a href="{{ route('delete-cart', ['id' => $item->id]) }}" class="delete-cart-button" style="text-decoration:none">
                                            @else
                                                <a href="{{ route('delete-cart', ['id' => $key]) }}" class="delete-cart-button" style="text-decoration:none">
                                            @endif
                                                <img src="{{ url('assets_user/img/icon/trash-delete-icon.svg') }}" alt="Delete" class="delete-icon">
                                            </a>
                                        </div>
                                    </div>
                                    <hr class="item-divider">
                                    @php
                                        $total_cart += $plant->price * $item->qty;
                                    @endphp
                                    @endforeach
                                @endif
                            @else
                                @if (empty($data))
                                <div class="mt-5 d-flex align-items-center flex-column">
                                    <img src="{{ url('assets_user/img/state-cart.png') }}" alt="dafnafa">
                                    <h2 style="color: #535353;" class="mt-3">Yahh, your cart is empty</h2>
                                    <p style="color: #535353;" class="mt-1">Let's fill it with your favorite plant !</p>
                                    <a href="{{ route('more') }}" class="button button-primary w-50 text-decoration-none mt-3">Start Shopping</a>
                                </div>
                                @else
                                    @foreach ($data as $key => $item)
                                    @php
                                        $plant = DB::table('plants')
                                            ->where('id', $item->plant_id)
                                            ->first();
                                        $thumb = json_decode($plant->thumb, true);
                                    @endphp

                                    <div class="product-list">
                                        <div class="form-check checkbox-select checkbox-item">
                                            <input class="form-check-input check-item" type="checkbox" data-price="{{ $plant->price * $item->qty }}" value="" data-item-id="@if(Auth::check()){{$item->id}}@else{{$key}}@endif" id="flexCheckDefault" checked>
                                        </div>
                                        <div class="item-details">
                                            <img src="{{ url('thumbPlant/' . $thumb[0]) }}" alt="" class="item-image">
                                            <div class="item-info">
                                                <h3 class="item-name">{{ $plant->name }}</h3>
                                                <p class="item-price">$ <span class="price-plant">{{ $plant->price }}</span>/Plant</p>
                                                <div class="action-cart">
                                                    <div class="quantity-product quantity-control">
                                                        <button data-id="@if(Auth::check()){{$item->id}}@else{{$key}}@endif" class="de quantity-count quantity-count--minus quantity-btn decrease" data-action="minus" type="button" id="mins">-</button>
                                                        <input id="qty-@if(Auth::check()){{$item->id}}@else{{$key}}@endif" class="product-quantity quantity-value" type="number" name="product-quantity" min="1" max="10" value="{{ $item->qty }}">
                                                        <button data-id="@if(Auth::check()){{ $item->id }}@else{{$key}}@endif" class="in quantity-count quantity-count--add quantity-btn increase" data-action="add" type="button">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-total">
                                            <p class="total-price">$ <span id="total-@if(Auth::check()){{$item->id}}@else{{$key}}@endif" class="price">{{ $plant->price * $item->qty }}</span></p>
                                            @if (Auth::check())
                                                <a href="{{ route('delete-cart', ['id' => $item->id]) }}" class="delete-cart-button" style="text-decoration:none">
                                            @else
                                                <a href="{{ route('delete-cart', ['id' => $key]) }}" class="delete-cart-button" style="text-decoration:none">
                                            @endif
                                                <img src="{{ url('assets_user/img/icon/trash-delete-icon.svg') }}" alt="Delete" class="delete-icon">
                                            </a>
                                        </div>
                                    </div>
                                    <hr class="item-divider">
                                    @php
                                        $total_cart += $plant->price * $item->qty;
                                    @endphp
                                    @endforeach
                                @endif
                            @endif
                        </div>
                    </div>
                </section>

                <section class="order-summary-column">
                    <form id="checkoutForm" action="{{ route('checkout') }}" method="post">
                        @csrf
                        <input type="hidden" name="subtotal" class="sub" id="total_cart" value="{{ $total_cart }}">
                        <div class="summary-container">
                            <div class="coupon-container">
                                <div class="coupon-input-group">
                                    <label for="coupon" class="coupon-label">Have coupon?</label>
                                    <input type="text" id="voucher-code" name="voucher_code" class="coupon-input" placeholder="Enter code here">
                                </div>
                                <button id="button-promo" class="apply-btn" type="button">Apply</button>
                            </div>
                            <div id="alert-voucher"></div>

                            <div class="order-total-container">
                                <div class="subtotal-row">
                                    <div class="price-labels">
                                        <p class="subtotal-label">Sub Total</p>
                                        <p class="discount-label">Discount</p>
                                    </div>
                                    <div class="price-values">
                                        <p class="subtotal-value">$ <span class="value sub">{{ $total_cart }}</span></p>
                                        <div id="val-disc" class="discount-value">
                                            $0
                                        </div>
                                    </div>
                                </div>

                                <hr class="summary-divider">

                                <div class="total-row">
                                    <p class="total-label">Total Price</p>
                                    <p class="total-value">$ <span class="value-total-fix sub" id="total-fix">{{ $total_cart }}</span></p>
                                </div>

                                @if ($authenticable)
                                    @if (!empty($data) && count($data) > 0)
                                    <button type="submit" class="checkout-btn">Check Out</button>
                                    @else
                                    <button type="submit" class="checkout-btn" disabled>Check Out</button>
                                    @endif
                                @else
                                    @if (!empty($data))
                                    <button type="submit" class="checkout-btn">Check Out</button>
                                    @else
                                    <button type="submit" class="checkout-btn" disabled>Check Out</button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </main>

        <!-- Updated Footer from second code -->
        <footer class="footer__container">
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
                    <a href="" class="footer__link">Home</a>
                    <a href="" class="footer__link">About FloraTrade</a>
                    <a href="" class="footer__link">Explore Plants</a>
                    <a href="" class="footer__link">Price List</a>
                    <a href="" class="footer__link">FAQ</a>
                    <a href="" class="footer__link">Terms &amp; Condition</a>
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
        </footer>
    </div>
@endsection

@section('js')
    <script>
        $('.checkbox-all').click(function() {
            $('.checkbox-item').toggleClass('show');
        });
        $('.checkbox-all').click(function() {
            $('.delete-all').toggleClass('show');
        });
    </script>

    <script>
        function round(value, exp) {
            if (typeof exp === 'undefined' || +exp === 0)
                return Math.round(value);

            value = +value;
            exp = +exp;

            if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
                return NaN;

            value = value.toString().split('e');
            value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));

            value = value.toString().split('e');
            return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
        }
    </script>

    <script>
        $("#button-promo").click(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('use-voucher') }}",
                method: "POST",
                data: {
                    code: $('#voucher-code').val(),
                    total_cart: $('#total_cart').val()
                },
                success: function(data) {
                    $('#alert-voucher').html(data.res);

                    if (data.status) {
                        var html = `$${data.disc_value}`;
                        $('#val-disc').html(html);
                        $('.text-disc').css('display', 'block');
                        $('#total-fix').html(round(data.after_disc,2));
                    } else {
                        $('#val-disc').html('$0');
                        $('#voucher-code').val('');
                        $('.text-disc').css('display', 'none');
                        $('#total-fix').html($('#total_cart').val());
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $(".in").click(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('increase') }}",
                method: "POST",
                data: {
                    id: $(this).attr('data-id'),
                    total: $('#total_cart').val()
                },
                success: function(data) {
                    $("#qty-" + data.id).val(data.qty);
                    $("#total-" + data.id).text(data.total);
                    $('.sub').text(data.total_all);
                    $('.sub').val(data.total_all);
                    $('#total_cart').val(data.total_all);
                    console.log('Success');
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $(".de").click(function() {
            if ($('#total_cart').val() > 1) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('decrease') }}",
                    method: "POST",
                    data: {
                        id: $(this).attr('data-id'),
                        total: $('#total_cart').val()
                    },
                    success: function(data) {
                        $("#qty-" + data.id).val(data.qty);
                        $("#total-" + data.id).text(data.total);
                        $('.sub').text(data.total_all);
                        $('.sub').val(data.total_all);
                        $('#total_cart').val(data.total_all);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }
        });
    </script>

    <script>
        $('#select-all').click(function(event) {
            if(this.checked) {
                $('.check-item').each(function() {
                    this.checked = true;
                });
            } else {
                $('.check-item').each(function() {
                    this.checked = false;
                });
            }
        });
    </script>

    <script>
        $(document).on('click','.check-item',function(){
            var isChecked = $(this).is(':checked');
            var checkedBoxes = document.querySelectorAll('.check-item:checked');
            var tot = 0;
            checkedBoxes.forEach(element => {
                tot += parseInt(element.getAttribute('data-price'));
            });
            $('.sub').text(tot);
            $('.sub').val(tot);
            $('#total_cart').val(tot);
        });
    </script>

    <script>
        $('#checkoutForm').submit(function(e) {
            var item = '';
            var checkedBoxes = document.querySelectorAll('.check-item:checked');
            checkedBoxes.forEach(element => {
                item += parseInt(element.getAttribute('data-item-id')) + '|';
            });
            $(this).append('<input type="hidden" name="item_selected" value="'+item+'" /> ');
            return true;
        });
    </script>

    @if (!is_null(Session::get('message')))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            position: 'center',
            icon: @json(Session::get('status')),
            title: @json(Session::get('status')),
            html: @json(Session::get('message')),
            showConfirmButton: false,
            timer: 4000
        })
    </script>
    @endif

    @if (!is_null(Session::get('error')))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var err = @json(Session::get('error'));
        console.log(err);
        var txt = '';
        Object.keys(err).forEach(element => {
            txt += err[element].message + '<br>';
        });
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Quantity is not available !',
            html: txt,
            footer:'try to reduce the quantity of the item',
            showConfirmButton: false,
            timer: 4000
        })
    </script>
    @endif

    @if (!is_null(Session::get('errdisc')))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: "Discount Code Invalid !",
            html: "You're discount code not in our database leave it blank if you don't use a discount code",
            footer:'try leave it blank or use correct code',
            showConfirmButton: false,
            timer: 4000
        })
    </script>
    @endif
@endsection