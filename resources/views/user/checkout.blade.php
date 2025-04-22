@extends('layouts.base_user')


@section('css')
    <link rel="stylesheet" href="{{ url('assets_user/css/checkout.css') }}">
    <script src="https://js.stripe.com/v3/"></script>

    <style>
        p.note {
            font-size: 1rem;
            color: red;
        }



        label.error {
            color: red;
            font-size: 1rem;
            display: block;
            margin-top: 5px;
        }

        label.error.fail-alert {
            border: 2px solid red;
            border-radius: 4px;
            line-height: 1;
            padding: 2px 0 6px 6px;
            background: #ffe6eb;
        }

        input.valid.success-alert {
            border: 2px solid #4CAF50;
            color: green;
        }

        input.error,
        textarea.error {
            border: 1px dashed red;
            font-weight: 300;
            color: red;
        }

        .hide {
            display: none;
        }


        .cardd {
            background: #FFFFFF;
            box-shadow: 0px 2px 60px rgba(0, 0, 0, 0.04), 0px 0.835552px 25.0666px rgba(0, 0, 0, 0.0287542), 0px 0.446726px 13.4018px rgba(0, 0, 0, 0.0238443), 0px 0.250431px 7.51293px rgba(0, 0, 0, 0.02), 0px 0.133002px 3.99006px rgba(0, 0, 0, 0.0161557), 0px 0.0553451px 1.66035px rgba(0, 0, 0, 0.0112458);
            border-radius: 8px;
            padding: 1rem;
        }

        .cardd .card-body ul {
            padding-left: .7rem;
            margin: 0;
        }

        .cardd .card-body ul li {
            padding: 0;
        }

        .cardd .card-body ul li:not(:last-child) {
            margin-bottom: 8px;
        }

        .cardd .card-body ul li::marker {
            color: #32D18B;
        }

        .paypal-button-context-iframe {
            display: flex;
            justify-content: center;
        }




        .hidden {
            display: none;
        }

        #payment-message {
            color: rgb(105, 115, 134);
            font-size: 16px;
            line-height: 20px;
            padding-top: 12px;
            text-align: center;
        }

        #payment-element {
            margin-bottom: 24px;
        }

        /* spinner/processing state, errors */
        .spinner,
        .spinner:before,
        .spinner:after {
            border-radius: 50%;
        }

        .spinner {
            color: #ffffff;
            font-size: 22px;
            text-indent: -99999px;
            margin: 0px auto;
            position: relative;
            width: 20px;
            height: 20px;
            box-shadow: inset 0 0 0 2px;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
        }

        .spinner:before,
        .spinner:after {
            position: absolute;
            content: "";
        }

        .spinner:before {
            width: 10.4px;
            height: 20.4px;
            background: #5469d4;
            border-radius: 20.4px 0 0 20.4px;
            top: -0.2px;
            left: -0.2px;
            -webkit-transform-origin: 10.4px 10.2px;
            transform-origin: 10.4px 10.2px;
            -webkit-animation: loading 2s infinite ease 1.5s;
            animation: loading 2s infinite ease 1.5s;
        }

        .spinner:after {
            width: 10.4px;
            height: 10.2px;
            background: #5469d4;
            border-radius: 0 10.2px 10.2px 0;
            top: -0.1px;
            left: 10.2px;
            -webkit-transform-origin: 0px 10.2px;
            transform-origin: 0px 10.2px;
            -webkit-animation: loading 2s infinite ease;
            animation: loading 2s infinite ease;
        }

        @-webkit-keyframes loading {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes loading {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @media only screen and (max-width: 600px) {
            form {
                width: 80vw;
                min-width: initial;
            }
        }



/* Buttons and links */
#submit {
  background: #5469d4;
  font-family: Arial, sans-serif;
  color: #ffffff;
  border-radius: 4px;
  border: 0;
  padding: 12px 16px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  display: block;
  transition: all 0.2s ease;
  box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
  width: 100%;
}
#submit:hover {
  filter: contrast(115%);
}
#submit:disabled {
  opacity: 0.5;
  cursor: default;
}


    </style>

@endsection

@section('content')
    @if (Auth::check())
        {{ $userId = Auth::user()->id }}
    @else
        {{ $userId = null }}
    @endif

    <div id="mainContent">
        <div class="container">
            <div class="checkout-container first-line card">
                <h4>Checkout Information</h4>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-personalData-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-personalData" type="button" role="tab" aria-controls="nav-personalData"
                        aria-selected="true">Data Requirement</button>
                    <button style="display: none" class="nav-link" id="nav-paymentConfirmation-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-paymentConfirmation" type="button" role="tab"
                        aria-controls="nav-paymentConfirmation" aria-selected="false">Payment Confirmation</button>



                    <button id="two" class="nav-link">Payment Confirmation</button>
                </div>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-personalData" role="tabpanel"
                        aria-labelledby="nav-personalData-tab">
                        <form id="checkout_information">
                            <input type="hidden" name="total" value="{{ $total }}">
                            <input type="hidden" name="voucher_code" value="{{ $voucher_code }}">
                            <input type="hidden" id="itsem" name="item" value="{{ $item }}">
                            <div class="row">

                                @if (!Auth::check())
                                    <div class="col-12 col-md-6 mb-4 mb-md-0">
                                        <h5 class="titleForm">Personal Information</h6>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-input">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            id="name">
                                                    </div>
                                                </div>
                                                {{-- <div class="col-6">
                                                <div class="form-input">
                                                    <label for="lastName" class="form-label">Last Name</label>
                                                    <input type="text" name="last_name" class="form-control"
                                                        id="lastName">
                                                </div>
                                            </div> --}}
                                                <div class="col-12">
                                                    <div class="form-input">
                                                        <label for="phoneNumber" class="form-label">Phone Number</label>
                                                        <input type="number" name="phone" class="form-control"
                                                            id="phone">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-input">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" name="email" class="form-control"
                                                            id="email">
                                                    </div>
                                                </div>
                                                {{-- <div class="col-6">
                                                <div class="form-input">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input name="username" type="text" class="form-control"
                                                        id="username">
                                                    <div id="infoHelpAccount" class="form-text">Create Account
                                                        Plantsasri !</div>
                                                </div>
                                            </div> --}}
                                                <div class="col-12">
                                                    <div class="form-input">
                                                        <label for="password" class="form-label">Password</label>
                                                        <input name="password" type="password" class="form-control"
                                                            id="password">
                                                    </div>
                                                </div>
                                                <div id="infoHelpAccount" class="form-text">Create Account
                                                    Plantsasri !</div>
                                                <div class="col-12"></div>
                                            </div>
                                    </div>
                                @endif
                                <div class="col-12 col-md-6">
                                    <h5 class="titleForm">Shiping Information</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-input">
                                                <label for="country" class="form-label">Country</label>
                                                <input type="text" id="search" name="country" placeholder="Search"
                                                    class="form-control" autocomplete="off" required />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-input">
                                                <label for="city" class="form-label">City</label>
                                                <input name="city" type="text" class="form-control" id="city">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-input">
                                                <label for="Province" class="form-label">Province</label>
                                                <input name="province" type="text" class="form-control"
                                                    id="province">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-input">
                                                <label for="zipCode" class="form-label">Zip Code</label>
                                                <input name="zipcode" type="text" class="form-control"
                                                    id="zipcode">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-input">
                                                <label for="address" class="form-label">Address</label>
                                                @if (Auth::check())
                                                    @if (!is_null(DB::table('address_users')->where('user_id', Auth::id())->first()))
                                                    <select name="" id="savedAddress" class="form-select">
                                                        <option value="">Select Your Saved Address</option>
                                                        @foreach (DB::table('address_users')->where('user_id',Auth::id())->get() as $itd)
                                                        <option value="{{$itd->address}}">{{$itd->address}}</option>
                                                        @endforeach
                                                    </select>
                                                    <br>
                                                    @endif
                                                @endif
                                                <textarea name="address" id="address" cols="30" rows="4" class="form-control">
@if (Auth::check())
{{ Auth::user()->address }}
@endif
</textarea>
                                                <div id="shipingInformation" class="form-text">Shiping Information
                                                    !
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button class="button button-primary">Next</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade paymentConfirmation" id="nav-paymentConfirmation" role="tabpanel"
                        aria-labelledby="nav-paymentConfirmation-tab">

                        @php
                            $qty = 0;
                            foreach (array_filter(explode('|', $item)) as $key => $value) {
                                if (Auth::check()) {
                                    $qty += DB::table('carts')
                                        ->where('id', $value)
                                        ->first()->qty;
                                } else {
                                    $qty += $cart[$value]['qty'];
                                }
                            }

                        @endphp
                        @php
                            $ship_method = [];
                        @endphp
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <div class="detail-customer">
                                    <h5 class="name-customer" id="name-customer">
                                        @if (Auth::check())
                                            {{ Auth::user()->name }}
                                        @endif
                                    </h5>
                                    <p class="number-phone" id="number-phone">
                                        @if (Auth::check())
                                            {{ Auth::user()->phone }}
                                        @endif
                                    </p>
                                    <p class="address" id="addr">
                                        @if (Auth::check())
                                            {{ Auth::user()->address }}
                                        @endif
                                    </p>
                                </div>
                                <div class="shipping-methode">
                                    <h5>Shipping Methode</h5>
                                    <p>Please select the shipping you want.</p>
                                    <div class="wrapper-select-methode">
                                        {{-- @foreach (DB::table('shipping_fees')->orderBy('count', 'ASC')->get()
    as $ship)
                                        @if ($ship->count >= $qty && !in_array($ship->ship_method, $ship_method))
                                            <div class="methode me-2">
                                                <input type="radio" id="planeMethode"
                                                    value="{{ $ship->ship_method . '-' . $ship->price }}"
                                                    name="flexRadioDefault">
                                                <label for="planeMethode">
                                                    <div class="name-shipping-methode">
                                                        <ion-icon name="airplane"></ion-icon>
                                                        <h6>{{ $ship->ship_method }}</h6>
                                                    </div>
                                                    <p class="price-methode">{{ $ship->price }}$</p>
                                                    <p class="desc-methode">Estimated arrival tomorrow</p>
                                                </label>
                                            </div>
                                            @php
                                                $ship_method[] = $ship->ship_method;
                                            @endphp
                                        @endif
                                    @endforeach --}}

                                        <select class="form-select" id="ship" name="ship"
                                            aria-label="Default select example">
                                            <option selected>Select A Shipping Method</option>

                                            )
                                            @foreach (DB::table('shipping_fees')->orderBy('count', 'ASC')->get()
        as $ship)
                                                @if ($ship->count >= $qty && !in_array($ship->ship_method, $ship_method))
                                                    <option value="{{ $ship->ship_method . '-' . $ship->price }}">
                                                        {{ $ship->ship_method . '-$' . $ship->price }}</option>
                                                    @php
                                                        $ship_method[] = $ship->ship_method;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="shipping-detail">
                                    <h5>Your Shooping</h5>
                                    <p>Make sure your purchases are correct</p>

                                    <div class="wrapper-item">
                                        @foreach (array_filter(explode('|', $item)) as $it)
                                            @php
                                                if (Auth::check()) {
                                                    $cart = DB::table('carts')
                                                        ->where('id', $it)
                                                        ->first();
                                                    $plant = DB::table('plants')
                                                        ->where(
                                                            'id',
                                                            DB::table('carts')
                                                                ->where('id', $it)
                                                                ->first()->plant_id,
                                                        )
                                                        ->first();
                                                    $thumb = json_decode($plant->thumb, true);
                                                } else {
                                                    $plts = $cart[$it];
                                                    $plant = DB::table('plants')
                                                        ->where('id', $plts['plant_id'])
                                                        ->first();
                                                    $thumb = json_decode($plant->thumb, true);
                                                }
                                            @endphp


                                            <div class="item">
                                                <div class="images-item">
                                                    @if (!is_null($plant->thumb))
                                                        <img src="{{ url('thumbPlant/' . $thumb[0]) }}" alt="">
                                                    @else
                                                        <img src="" alt="">
                                                    @endif
                                                </div>

                                                <div class="detail-item">
                                                    @if (Auth::check())
                                                        <h5>{{ $plant->name }}</h5>
                                                        @if ($whl)
                                                            @php
                                                                $wholesale = json_decode($plant->wholesale_price, true);
                                                                krsort($wholesale);
                                                                foreach ($wholesale as $key => $value) {
                                                                    if ($cart->qty >= $key) {
                                                                        $plant->price = $value;
                                                                        break;
                                                                    }
                                                                }
                                                            @endphp
                                                            <h6>${{ $plant->price }} x {{ $cart->qty }} :
                                                                {{ $plant->price * $cart->qty }}</h6>
                                                        @else
                                                            <h6>${{ $plant->price }} x {{ $cart->qty }} :
                                                                {{ $plant->price * $cart->qty }}</h6>
                                                        @endif
                                                    @else
                                                        <h5>{{ $plant->name }}</h5>
                                                        @if ($whl)
                                                            @php
                                                                $wholesale = json_decode($plant->wholesale_price, true);
                                                                krsort($wholesale);
                                                                foreach ($wholesale as $key => $value) {
                                                                    if ($plts['qty'] >= $key) {
                                                                        $plant->price = $value;
                                                                        break;
                                                                    }
                                                                }
                                                            @endphp
                                                            <h6>${{ $plant->price }} x {{ $plts['qty'] }} :
                                                                {{ $plant->price * $plts['qty'] }}</h6>
                                                        @else
                                                            <h6>${{ $plant->price }} x {{ $plts['qty'] }} :
                                                                {{ $plant->price * $plts['qty'] }}</h6>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="wrapper-summary">
                                    <form action="">
                                        <div class="card">
                                            <h4>Summary</h4>
                                            <div class="detail-summary">
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <p class="thint-text">Subtotal</p>
                                                    <p class="thint-text">${{ $total }}</p>
                                                </div>
                                                @if (!is_null($voucher_code))
                                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                                        <p class="thint-text">Discount</p>
                                                        <p class="thint-text">
                                                            {{ $dc = DB::table('vouchers')->where('code', $voucher_code)->first()->disc }}%
                                                            / ${{ $total - ($total * $dc) / 100 }}
                                                        </p>
                                                    </div>
                                                @endif
                                                <div class="d-flex align-items-center justify-content-between mb-2"
                                                    id="shipping_fees">

                                                </div>

                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <p class="bold-text">Total</p>

                                                    @if (!is_null($voucher_code))
                                                        <p id="ttlp"
                                                            data-total="{{ $total - ($total * $dc) / 100 }}"
                                                            class="bold-text">${{ $total - ($total * $dc) / 100 }}
                                                        </p>
                                                    @else
                                                        <p id="ttlp" data-total="{{ $total }}"
                                                            class="bold-text">${{ $total }}</p>
                                                    @endif
                                                </div>
                                                @if ($whl)
                                                    <br>
                                                    <div class="alert alert-info" role="alert">
                                                        This is a Wholesale Price !
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="dropdown">
                                                <button id="payton"
                                                    class="button button-primary w-100 d-flex align-items-center justify-content-center"
                                                    type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                    aria-expanded="false" disabled>
                                                    Select Payment
                                                    <ion-icon class="ms-2" name="chevron-down-outline"></ion-icon>

                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <button type="button"
                                                        class="dropdown-item d-flex justify-content-between align-items-center"
                                                        id="manualTrx" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal">
                                                        <p>Manual Transfer</p>
                                                        <div class="d-flex">
                                                            <img src="{{ url('assets_user/img/Mask group.png') }}"
                                                                class="ms-2">
                                                            <img src="{{ url('assets_user/img/Mask group (1).png') }}"
                                                                class="ms-2">
                                                            <img src="{{ url('assets_user/img/Mask group (2).png') }}"
                                                                class="ms-2">
                                                        </div>
                                                    </button>
                                                    <button
                                                        class="dropdown-item d-flex justify-content-between align-items-center"
                                                        type="button" id="stripeTrx" data-bs-toggle="modal"
                                                        data-bs-target="#stripeTransaction">
                                                        <p>Stripe Payment</p>
                                                        <img src="{{ url('assets_user/img/Stripe_logo,_revised_2016.png') }}"
                                                            style="width: 50px">
                                                    </button>
                                                    <div class="dropdown-item" id="paypal-button"></div>
                                                </ul>


                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-manual-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transaksi Manual</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @foreach (DB::table('credit_cards')->get() as $item)
                        {{-- <button data-id="{{ $item->id }}"
                        class="btn btn-outline-info w-100 mt-2 manual-transaction-button"> {{ $item->type_payment }}
                    </button> --}}

                        <button data-id="{{ $item->id }}" type="button"
                            class="button d-flex align-items-center justify-content-between w-100 mb-2 manual-transaction-button">
                            <div class="icon-name d-flex align-items-center thint-text">
                                <div class="icon me-2">
                                    <img src="./assets/img/icon/currency-dollar.png" alt="">
                                </div>
                                {{ $item->type_payment }}
                            </div>
                            <ion-icon name="chevron-forward-outline"></ion-icon>
                        </button>
                    @endforeach

                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="stripeTransaction" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="stripeTransactionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="stripeTransactionLabel">Stripe Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <input type="hidden" name="kodeTransaksi" id="kodeTransaksi">
                {{-- <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation"
                data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                @csrf
                <div class="modal-body">

                    <div class='form-row row'>
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label'>Name on Card</label> <input class='form-control' size='4'
                                type='text'>
                        </div>
                    </div>
                    <br>
                    <div class='form-row row'>
                        <div class='col-xs-12 form-group required'>
                            <label class='control-label'>Card Number</label> <input autocomplete='off'
                                class='form-control card-number' size='4' type='text'>
                        </div>
                    </div>
                    <br>


                    <div class='form-row row'>
                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                            <label class='control-label'>CVC</label> <input autocomplete='off'
                                class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                        </div>

                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label'>Expiration Month</label> <input
                                class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                        </div>

                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                            <label class='control-label'>Expiration Year</label> <input
                                class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                        </div>

                    </div>



                    <div class='form-row row'>
                        <div class='col-md-12 error form-group hide'>
                            <div class='alert-danger alert'>Please correct the errors and try
                                again.</div>
                        </div>
                    </div>




                </div>
                <div class="modal-footer">
                    <button type="submit" class="button button-primary">Pay</button>
                </div>
            </form> --}}

                <form id="payment-form">
                    <div class="modal-body">
                        <div id="payment-element">
                            <!--Stripe.js injects the Payment Element-->
                        </div>

                        <div id="payment-message" class="hidden"></div>
                    </div>
                    <div class="modal-footer">
                        <button id="submit" class="button button-primary">
                            <div class="spinner hidden" id="spinner"></div>
                            <span id="button-text">Pay now</span>
                        </button>
                    </div>
                </form>
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

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $("#exampleModal").delegate(".manual-transaction-button", "click", function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({

                type: 'POST',
                url: "{{ route('get-info-manual-transaction') }}",
                data: {
                    id: $(this).attr('data-id'),
                },
                success: function(data) {

                    var html = `
                    <div class="modal-header">
                        <div class="d-flex w-100" style="justify-content:space-between;align-items:center;">
                        <button type="button" class="btn me-5" onclick="back();" id="back-button">Back</button>
                        <h5 class="modal-title" id="exampleModalLabel">Transaction Manual</h5>
                        <button type="button" id="close-bill" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="cardd mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="thint-text">Total Bill</p>
                                <p class="primary-text">${$('#ttlp').text()}</p>
                            </div>
                        </div>
                        <div class="cardd mb-3">
                            <div class="card-body">
                                <ul>
                                    ${data[0]}
                                </ul>
                            </div>
                        </div>

                        <form id="buy" action="{{ route('buy') }}" method="POST">
                                @csrf

                        <input type="hidden" id="manual_payment_id" name="manual_payment_id" value="${data[1]}">
                                <button  type="submit" class="button button-primary w-100">
                                    Pay
                                </button>
                        </form>
                </div>`;
                    $("#modal-manual-content").html(html);
                }
            });
        });



        $(".manual-transaction-button").click(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({

                type: 'POST',
                url: "{{ route('get-info-manual-transaction') }}",
                data: {
                    id: $(this).attr('data-id'),
                },
                success: function(data) {
                    var html = `
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transaction Manual</h5>
                    <button type="button" id="close-bill" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="cardd mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="thint-text">Total Bill</p>
                                <p class="primary-text">${$('#ttlp').text()}</p>
                            </div>
                        </div>
                        <div class="cardd mb-3">
                            <div class="card-body">
                                <ul>
                                    ${data[0]}
                                </ul>
                            </div>
                        </div>

                        <form id="buy" action="{{ route('buy') }}" method="POST">
                                @csrf

                        <input type="hidden" id="manual_payment_id" name="manual_payment_id" value="${data[1]}">
                                <button  type="submit" class="button button-primary w-100">
                                    Pay
                                </button>
                        </form>
                </div>`;
                    $("#modal-manual-content").html(html);
                }
            });
        });


        $('#exampleModal').on('hidden.bs.modal', function() {
            var html = `
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transaksi Manual</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @foreach (DB::table('credit_cards')->get() as $item)

                    <button data-id="{{ $item->id }}" type="button" class="button d-flex align-items-center justify-content-between w-100 mb-2 manual-transaction-button">
                            <div class="icon-name d-flex align-items-center thint-text">
                                <div class="icon me-2">
                                    <img src="./assets/img/icon/currency-dollar.png" alt="">
                                </div>
                                {{$item->type_payment }}
                            </div>
                            <ion-icon name="chevron-forward-outline"></ion-icon>
                        </button>

                    @endforeach
                </div>`;

            $('#modal-manual-content').html(html);
        });

        function back() {
            var html = `
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transaksi Manual</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @foreach (DB::table('credit_cards')->get() as $item)

                    <button data-id="{{ $item->id }}" type="button" class="button d-flex align-items-center justify-content-between w-100 mb-2 manual-transaction-button">
                            <div class="icon-name d-flex align-items-center thint-text">
                                <div class="icon me-2">
                                    <img src="./assets/img/icon/currency-dollar.png" alt="">
                                </div>
                                {{$item->type_payment }}
                            </div>
                            <ion-icon name="chevron-forward-outline"></ion-icon>
                        </button>

                    @endforeach
                </div>`;

            $('#modal-manual-content').html(html);
        }
    </script>


    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        paypal.Button.render({
            env: 'sandbox', // Or 'production'
            style: {
                color: 'blue',
                shape: 'rect',
                label: 'paypal',
                size: 'medium'
            },

            // Set up the payment:
            // 1. Add a payment callback
            payment: function(data, actions) {
                // 2. Make a request to your server
                var checkout_information = $("#checkout_information").serialize();
                console.log(checkout_information);

                return actions.request.post("{{ route('create-payment') }}", {
                    checkoutInformation: checkout_information,
                    ship: $('#ship').val(),
                    userId: "{{ $userId }}"
                }, {
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"  // Tambahkan CSRF token di header
                    }
                }).then(function(res) {
                    if (res.new_item != '') {
                        $('#itsem').val(res.new_item);
                    }
                    // 3. Return res.id from the response
                    return res.id;
                });
            },

            onCancel: function(data, actions) {
                window.location.href = "{{ route('my-cart') }}";
            },

            onError: function(err) {
                console.log('Paypal merchant got an error !');
                console.log(err);
            },
            // Execute the payment:
            // 1. Add an onAuthorize callback
            onAuthorize: function(data, actions) {
                // 2. Make a request to your server
                var checkout_information = $("#checkout_information").serialize();
                return actions.request.post("{{ route('execute-payment') }}", {
                        paymentID: data.paymentID,
                        payerID: data.payerID,
                        checkoutInformation: checkout_information,
                        ship: $('#ship').val(),
                        userId: "{{ $userId }}"
                    }, {
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"  // Tambahkan CSRF token di header
                    }
                })
                    .then(function(res) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Transaction has been successful !',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        setTimeout(() => {
                            window.location.href = @json(env('APP_URL')) + '/history-transaction?message=Checkout with paypal has been successed !';
                        }, 1500);
                        // 3. Show the buyer a confirmation message.
                    });
            }
        }, '#paypal-button');
    </script>



{{-- <script type="text/javascript" src="https://js.stripe.com/v2/"></script> --}}

<script>
$('#stripeTransaction').on('shown.bs.modal', function(e) {

    const stripe = Stripe(@json(env('STRIPE_KEY')));

    const items = [{
        checkoutInformation:$("#checkout_information").serialize(),
        ship:$('#ship').val()
    }];
let elements;

initialize();
checkStatus();

document
    .querySelector("#payment-form")
    .addEventListener("submit", handleSubmit);

// Fetches a payment intent and captures the client secret
async function initialize() {
    const response = await fetch("/getStripeCheckout", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: JSON.stringify({items}),
    }).then((r) => r.json());

    console.log(response.clientSecret);
    elements = stripe.elements({clientSecret : response.clientSecret});

    const paymentElement = elements.create("payment");
    $('#kodeTransaksi').val(response.kodeTransaksi);
    paymentElement.mount("#payment-element");
}

async function handleSubmit(e) {

    e.preventDefault();

    const items = [{
        checkoutInformation:$("#checkout_information").serialize(),
        ship:$('#ship').val(),
        $kodeTransaksi:$('#kodeTransaksi').val()
    }];
    setLoading(true);
    const response = await fetch("/payStripe?kode="+$('#kodeTransaksi').val(), {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: JSON.stringify({items}),
    }).then((r) => r.json());


    const {
        error
    } = await stripe.confirmPayment({
        elements,
        confirmParams: {
            return_url: @json(env('APP_URL')) + '/history-transaction?message=Checkout with stripe has been successed !',
        },
    });

    if (error.type === "card_error" || error.type === "validation_error") {
        showMessage(error.message);
    } else {
        showMessage("An unexpected error occurred.");
    }

    setLoading(false);
}

// Fetches the payment intent status after payment submission
async function checkStatus() {
    const clientSecret = new URLSearchParams(window.location.search).get(
        "payment_intent_client_secret"
    );

    if (!clientSecret) {
        return;
    }

    const {
        paymentIntent
    } = await stripe.retrievePaymentIntent(clientSecret);

    switch (paymentIntent.status) {
        case "succeeded":
            showMessage("Payment succeeded!");
            break;
        case "processing":
            showMessage("Your payment is processing.");
            break;
        case "requires_payment_method":
            showMessage("Your payment was not successful, please try again.");
            break;
        default:
            showMessage("Something went wrong.");
            break;
    }
}

// ------- UI helpers -------

function showMessage(messageText) {
    const messageContainer = document.querySelector("#payment-message");

    messageContainer.classList.remove("hidden");
    messageContainer.textContent = messageText;

    setTimeout(function() {
        messageContainer.classList.add("hidden");
        messageText.textContent = "";
    }, 4000);
}


function setLoading(isLoading) {
            if (isLoading) {
                // Disable the button and show a spinner
                document.querySelector("#submit").disabled = true;
                document.querySelector("#spinner").classList.remove("hidden");
                document.querySelector("#button-text").classList.add("hidden");
            } else {
                document.querySelector("#submit").disabled = false;
                document.querySelector("#spinner").classList.add("hidden");
                document.querySelector("#button-text").classList.remove("hidden");
            }
        }

        });

</script>

{{-- <script type="text/javascript">
    $(function() {
        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
                $errorMessage.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                }
            });


            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }
        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                var checkout_information = $("#checkout_information").serialize();
                var input = $("<input>").attr({
                    "type": "hidden",
                    "name": "checkoutInformation"
                }).val(checkout_information);

                var ship = $("<input>").attr({
                    "type": "hidden",
                    "name": "ship"
                }).val($('#ship').val());


                $form.append(input);
                $form.append(ship);


                $form.get(0).submit();
            }
        }
    });
</script> --}}



    <script>
        $("#modal-manual-content").on('submit', '#buy', function() {

            var checkout_information = $("#checkout_information").serialize();
            console.log(checkout_information);
            var input = $("<input>").attr({
                "type": "hidden",
                "name": "checkoutInformation"
            }).val(checkout_information);

            var ship = $("<input>").attr({
                "type": "hidden",
                "name": "ship"
            }).val($('#ship').val());



            $(this).append(input);
            $(this).append(ship);

            return true;
        });
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script type="text/javascript">
        var route = "{{ url('autocomplete-search') }}";

        $('#search').typeahead({
            source: function(query, process) {
                return $.get(route, {
                    query: query
                }, function(data) {

                    return process(data);
                });
            }
        });



        jQuery.validator.addMethod("twoWords", function(value, element) {
            var reg1 = /^[a-zA-Z]+\s[a-zA-Z]+$/;
            if (reg1.test(value)) {
                return true;
            } else {
                return false;
            };
        }, "Your name must contain at least 2 words");


        $(document).ready(function() {
            $("#checkout_information").validate({
                errorClass: "error fail-alert",
                validClass: "valid success-alert",
                rules: {
                    name: {
                        required: true,
                        twoWords: true
                    },
                    phone: {
                        required: true,
                        number: true
                    },
                    password: {
                        required: true,
                        minlength: 8,
                    },
                    search: {
                        required: true
                    },
                    city: {
                        required: true,
                    },
                    province: {
                        required: true,
                    },
                    zipcode: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    address: {
                        required: true,
                    },

                },
                messages: {
                    name: {
                        required: "Please enter your name",
                    },
                    email: {
                        email: "The email should be in the format: abc@domain.tld"
                    },
                    address: {
                        required: "Address is required please input your address in edit Profile",
                    },
                },
                submitHandler: function(form, event) {
                    event.preventDefault();
                    $('#nav-paymentConfirmation-tab').click();
                    $('#one').removeClass('active');
                    $('#two').addClass('active');
                }
            });
        });

        $('#nav-personalData-tab').click(function() {
            $('#two').removeClass('active');
        });


        $('#ship').change(function (e) {
            if ($('#ship').val() != '') {

                var sh = $('#ship').val();
                var shp = sh.split('-');

                $('#payton').removeAttr("disabled");
                var wx = `<p class="thint-text">Shipping Fee</p>
                <p class="thint-text">$${shp[1]}</p>`;
                $('#shipping_fees').html(wx);
                var tts = parseFloat($('#ttlp').attr('data-total')) + parseFloat(shp[1]);
                $('#ttlp').html('$' + tts);

            }else {
                $('#payton').attr("disabled", true);
            }
        });
    </script>

    <script>
        $('#savedAddress').change(function () {
            $('#address').val($('#savedAddress').val());
        });
    </script>

@endsection
