@extends('layouts.base_user')

@section('css')
    <!--CSS Profile-->
    <link rel="stylesheet" href="{{ url('assets_user/css/history-transaksi.css') }}">
    <link rel="stylesheet" href="{{ url('assets_user/css/checkout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
        integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <!-- With this -->


    <style>
        /* Add the new sidebar styles */
    .account-page .nav-icon {
        width: 19px;
        height: 19px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: inherit;
        margin-right: 15px;
    }

    .account-page .logout .nav-icon {
        color: #f00;
    }

        .account-page {
            padding: 20px 0;
            overflow: hidden;
        }

        @media (max-width: 991px) {
            .account-page {
                padding-bottom: 100px;
            }
        }

        .account-page .container {
            margin: 26px auto 0;
            width: 100%;
            max-width: 1158px;
            margin-top: 10px;
        }

        @media (max-width: 991px) {
            .container {
                max-width: 100%;
            }
        }

        .content-wrapper {
            display: flex;
            gap: 20px;
            margin-top: 100px;
        }

        @media (max-width: 991px) {
            .content-wrapper {
                flex-direction: column;
                align-items: stretch;
                gap: 0px;
            }
        }

        /* Sidebar styles */
        .sidebar {
            width: 22%;
        }

        @media (max-width: 991px) {
            .sidebar {
                width: 100%;
            }
        }

        .user-info {
            border-radius: 10px;
            background-color: #ffffff;
            padding: 19px 14px 46px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        @media (max-width: 991px) {
            .user-info {
                margin-top: 30px;
            }
        }

        .avatar-name {
            display: flex;
            margin-left: 14px;
            align-items: center;
            gap: 17px;
        }

        @media (max-width: 991px) {
            .avatar-name {
                margin-left: 10px;
            }
        }

        .avatar-small {
            color: #6b6f6d;
            background-color: rgba(237, 237, 237, 1);
            border-radius: 50%;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .username {
            color: #494c4b;
            font-size: 16px;
            font-weight: 400;
        }

        .account-page .divider {
            border: none;
            border-top: 1px solid rgba(182, 183, 187, 1);
            width: 100%;
            margin-top: 18px;
            background-color: #b6b7bb;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            width: 100%;
            margin-top: 20px;
        }

    .account-page .nav-item {
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 16px;
        color: #494c4b;
        text-decoration: none;
        margin-top: 10px;
        padding: 10px 0 10px 16px;
    }

    .account-page .nav-item.active {
        font-weight: 500;
    }

    .account-page .nav-text {
        color: #494c4b;
    }

        .account-page .logout {
            color: #f00;
        }

        .account-page .logout .nav-text {
            color: #f00;
        }

        /* Main content styles */
        .main-content {
            width: 78%;
        }

        @media (max-width: 991px) {
            .main-content {
                width: 100%;
                margin-top: 30px;
            }
        }

        /* Existing history transaction styles */
        #tabtwo {
            display: none;
        }

        .dropify-wrapper .dropify-message p {
            font-size: 14px;
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
            color: #2DB878;
        }

        .wrapper-item .item {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
                -ms-flex-align: center;
                    align-items: center;
            margin: 1rem 0;
        }

        .wrapper-item .item .images-item {
            margin-right: .5rem;
        }

        .wrapper-item .item .images-item img {
            width: 100%;
            height: 100%;
            min-width: 64px;
            min-height: 64px;
            max-width: 64px;
            max-height: 64px;
            -o-object-fit: contain;
                object-fit: contain;
            -o-object-position: center;
                object-position: center;
            border-radius: 10px;
        }

        .wrapper-item .item .detail-item h6, .wrapper-item .item .detail-item h5 {
            color: #535353;
        }

        .wrapper-item .item .detail-item h5 {
            font-weight: 300;
            margin-bottom: .5rem;
            font-size: 16px;
        }

        .wrapper-item .item .detail-item h6 {
            font-weight: 500;
            font-size: 14px;
        }

        /* Adjust history transaction content to fit new layout */
        .history-container {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .nav-tabs {
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 20px;
        }

        .nav-link {
            color: #6b6f6d;
            font-weight: 500;
        }

        .nav-link.active {
            color: #33b87d;
            border-bottom: 3px solid #33b87d;
        }

        .history-item {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .head-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e9ecef;
        }

        .status {
            margin-left: auto;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
        }

        .status.success {
            background-color: #d4edda;
            color: #155724;
        }

        .status.danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .body-item {
            display: flex;
        }

        .image-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 15px;
        }

        .detail-item {
            flex: 1;
        }

        .name-item {
            color: #33b87d;
            font-weight: 500;
            text-decoration: none;
        }

        .action-item {
            display: flex;
            gap: 10px;
        }

        .button {
            padding: 8px 15px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            border: none;
        }

        .button-primary {
            background-color: #33b87d;
            color: white;
        }

        .button-outline-primary {
            background-color: white;
            color: #33b87d;
            border: 1px solid #33b87d;
        }

        .button-text {
            background: none;
            color: #33b87d;
            text-decoration: underline;
        }
    </style>
@endsection

@section('content')
    <main class="account-page">
        <div class="container">
            <div class="content-wrapper">
                <!-- Sidebar -->
                <aside class="sidebar">
                    <div class="user-info">
                        <div class="avatar-name">
                            <div class="avatar-small">
                                @if(Auth::user()->thumb)
                                    <img src="{{ Auth::user()->thumb }}" alt="" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                                @else
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                @endif
                            </div>
                            <h3 class="username">{{ Auth::user()->name }}</h3>
                        </div>
                        <hr class="divider">
                        <nav class="sidebar-nav">
                            <a href="{{ route('profile') }}" class="nav-item active">
                                <img src="{{ asset('assets_user/img/icon/user-solid.svg') }}" alt="profile" class="nav-icon">
                                <span class="nav-text">Account</span>
                            </a>
                            <!--
                            <a href="{{ route('chat', ['for' => 1]) }}" class="nav-item">
                                <img src="{{ asset('assets_user/img/icon/cart-shopping-solid.svg') }}" alt="profile" class="nav-icon">
                                <span class="nav-text">Chat</span>
                            </a>
                            -->
                            <a href="{{ route('history-transaction') }}" class="nav-item">
                                <img src="{{ asset('assets_user/img/icon/cart-shopping-solid.svg') }}" alt="profile" class="nav-icon">
                                <span class="nav-text">History Transaction</span>
                            </a>
                            <a href="{{ route('logoutUser') }}" class="nav-item logout">
                                <svg class="nav-icon" viewBox="0 0 512 512" width="19" height="19" fill="red" xmlns="http://www.w3.org/2000/svg">
  <!-- Font Awesome Free 6.4.0 sign-out-alt icon (converted to inline SVG) -->
  <path d="M160 416H96c-17.67 0-32-14.33-32-32V128c0-17.67 14.33-32 32-32h64c17.67 0 32-14.33 32-32S177.7 32 160 32H96C42.98 32 0 74.98 0 128v256c0 53.02 42.98 96 96 96h64c17.67 0 32-14.33 32-32S177.7 416 160 416zM502.6 233.4l-128-128c-12.51-12.51-32.76-12.49-45.25 0c-12.5 12.5-12.5 32.75 0 45.25L402.8 224H192C174.3 224 160 238.3 160 256s14.31 32 32 32h210.8l-73.38 73.38c-12.5 12.5-12.5 32.75 0 45.25s32.75 12.5 45.25 0l128-128C515.1 264.2 515.1 247.8 502.6 233.4z"/>
</svg>
                                <span class="nav-text">Logout</span>
                            </a>
                        </nav>
                    </div>
                </aside>

                <!-- Main Content -->
                <section class="main-content">
                    <div class="history-container">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-All-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-All" type="button" role="tab" aria-controls="nav-All"
                                aria-selected="true">All</button>
                            <button class="nav-link" id="nav-done-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-done" type="button" role="tab" aria-controls="nav-done"
                                aria-selected="false">Done</button>
                            <button class="nav-link" id="nav-proccess-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-proccess" type="button" role="tab" aria-controls="nav-proccess"
                                aria-selected="false">Proccess</button>
                            <button class="nav-link" id="nav-failed-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-failed" type="button" role="tab" aria-controls="nav-failed"
                                aria-selected="false">Failed</button>
                        </div>

                        @if ($data->count() == 0)
                            <div class="mt-5 d-flex align-items-center flex-column">
                                <img src="{{ url('assets_user/img/state-cart.png') }}" alt="dafnafa">
                                <h2 style="color: #535353;" class="mt-3">Yahh, your cart is empty</h2>
                                <p style="color: #535353;" class="mt-1">Let's fill it with your favorite plant !</p>
                                <button type="submit" class="button button-primary w-50 text-decoration-none mt-3">
                                    Start Shopping
                                </button>
                            </div>
                        @endif

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-All" role="tabpanel"
                                aria-labelledby="nav-All-tab">
                                <input type="hidden" name="id_selected" id="id_selected">
                                <input type="hidden" name="total_selected" id="total_selected">
                                @foreach ($data as $item)
                                    <div class="history-item">
                                        <div class="head-item">
                                            <div class="icon">
                                                <img src="{{ url('assets_user/img/icon/icon-history-transaksi.svg') }}"
                                                    alt="">
                                            </div>
                                            <div class="date">{{ $item->date }}</div>
                                            @if ($item->status < 0)
                                                <div class="status danger">
                                                    Failed
                                                </div>
                                            @elseif($item->status == 5)
                                                <div class="status success">
                                                    Done
                                                </div>
                                            @elseif($item->status >= 0)
                                                <div class="status success">
                                                    Proccess
                                                </div>
                                            @endif
                                            <div class="id-transaksi">{{ $item->kode_transaksi }}</div>
                                        </div>

                                        @php
                                        $thumb = json_decode(DB::table('plants')->where('id',DB::table('carts')->where('order_id',$item->id)->first()->plant_id)->first()->thumb, true);
                                        @endphp

                                        <div class="body-item">
                                            <div class="image-item">
                                                <img src="{{ url('thumbPlant/'.$thumb[0]) }}" alt="">
                                            </div>
                                            <div class="detail-item">
                                                <a href="#" class="name-item">{{ DB::table('plants')->where('id',DB::table('carts')->where('order_id',$item->id)->first()->plant_id)->first()->name }}</a>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="price">
                                                        <span>
                                                            @if ($item->total_price == $item->total_price_after_disc)
                                                                @if ($item->payment_method == 1)
                                                                    @php
                                                                        $cc = DB::table('credit_cards')
                                                                            ->where('id', $item->manual_payment_id)
                                                                            ->first();
                                                                    @endphp

                                                                    {{ $cc->currency_symbol }}
                                                                    {{ $item->total_price_after_disc + $item->shipping_price }}
                                                                @else
                                                                    ${{ $item->total_price_after_disc + $item->shipping_price }}
                                                                @endif
                                                            @else
                                                                @if ($item->payment_method == 1)
                                                                    @php
                                                                        $cc = DB::table('credit_cards')
                                                                            ->where('id', $item->manual_payment_id)
                                                                            ->first();
                                                                    @endphp
                                                                    <span
                                                                        style="text-decoration-line: line-through;text-decoration-thickness: 3px;">
                                                                        {{ $cc->currency_symbol }}
                                                                        {{ $item->total_price + $item->shipping_price }}</span>
                                                                    /
                                                                    {{ $cc->currency_symbol }}
                                                                    {{ $item->total_price_after_disc + $item->tax + $item->shipping_price }}
                                                                @else
                                                                    <span
                                                                        style="text-decoration-line: line-through;text-decoration-thickness: 3px;">
                                                                        ${{ $item->total_price + $item->shipping_price }}</span>
                                                                    /
                                                                    ${{ $item->total_price_after_disc + $item->tax + $item->shipping_price }}
                                                                @endif
                                                            @endif
                                                    </div>
                                                    <div class="action-item">
                                                        @if ($item->payment_method == 1 && $item->status == 0)
                                                            @if (is_null($item->manual_file))
                                                                <button type="button" class="btn btn-success"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal"
                                                                    data-id="{{ $item->id }}"
                                                                    data-manual_payment_id="{{ $item->manual_payment_id }}"
                                                                    data-shipping_price="{{ $item->shipping_price }}"
                                                                    data-shipping_method="{{ $item->shipping_method }}"
                                                                    data-total_price_after_disc="{{ $item->total_price_after_disc }}">
                                                                    Manual Transaction
                                                                </button>
                                                            @else
                                                                <button type="button" class="btn btn-success"
                                                                    disabled>
                                                                    ✓
                                                                </button>
                                                            @endif
                                                        @endif

                                                        <button type="button" class="button button-text"
                                                            data-bs-toggle="modal" data-bs-target="#seeDetailModal"
                                                            data-id='{{ $item->id }}'
                                                            data-user_id='{{ $item->user_id }}'
                                                            data-kode_transaksi="{{ $item->kode_transaksi }}"
                                                            data-date="{{ $item->date }}"
                                                            @if ($item->payment_method == 1) data-total_price="{{ $item->total_price }}"
                                                            data-total_price_after_disc="{{ $item->total_price_after_disc }}"
                                                            data-shipping_price="{{ $item->shipping_price }}"
                                                            data-tax="{{ $item->tax }}"
                                                            data-currency_symbol="{{ $cc->currency_symbol }}"
                                                            @else
                                                            data-total_price="{{ $item->total_price }}"
                                                            data-total_price_after_disc="{{ $item->total_price_after_disc }}"
                                                            data-shipping_price="{{ $item->shipping_price }}"
                                                            data-tax="{{ $item->tax }}"
                                                            data-currency_symbol="$" @endif
                                                            data-status="{{ $item->status }}"
                                                            data-payment_method="
                                                                            @if ($item->payment_method == 1) {{ 'MANUAL TRANSFER' }}
                                                            @elseif($item->payment_method == 2)
                                                                {{ 'PAYPAL' }}
                                                            @else
                                                                {{ 'STRIPE' }} @endif"
                                                            data-currency="{{ $item->currency }}"
                                                            data-tax="{{ $item->tax }}"
                                                            data-no_resi="{{ $item->no_resi ? $item->no_resi : 'No Resi Belum Tersedia.' }}"
                                                            data-hasPaid="{{ $item->hasPaid }}"
                                                            data-discount="{{ $item->discount }}"
                                                            data-discount_code="{{ $item->discount_code }}"
                                                            data-nama_penerima="{{ $item->nama_penerima }}"
                                                            data-alamat_penerima="{{ $item->alamat_penerima }}"
                                                            data-email_penerima="{{ $item->email_penerima }}"
                                                            data-negara_tujuan="{{ $item->negara_tujuan }}"
                                                            data-provinsi_tujuan="{{ $item->provinsi_tujuan }}"
                                                            data-kota_tujuan="{{ $item->kota_tujuan }}"
                                                            data-shipping_method="{{ $item->shipping_method }}"
                                                            data-zipcode="{{ $item->zipcode }}">
                                                            See Details
                                                        </button>
                                                        <button type="button" class="button button-outline-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#trackTransaksiModal"
                                                            data-alamat_penerima="{{ $item->alamat_penerima }}"
                                                            data-nama_penerima="{{ $item->nama_penerima }}"
                                                            data-resi="{{ $item->no_resi ? $item->no_resi : 'No Resi Belum Tersedia.' }}"
                                                            data-status="{{ $item->status }}">
                                                            Track Order
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="tab-pane fade" id="nav-done" role="tabpanel"
                                aria-labelledby="nav-done-tab">
                                <input type="hidden" name="id_selected" id="id_selected">
                                <input type="hidden" name="total_selected" id="total_selected">
                                @foreach (App\Models\Order::where(['user_id' => Auth::id(),'status'=>5])->get() as $item)
                                    <div class="history-item">
                                        <div class="head-item">
                                            <div class="icon">
                                                <img src="{{ url('assets_user/img/icon/icon-history-transaksi.svg') }}"
                                                    alt="">
                                            </div>
                                            <div class="date">{{ $item->date }}</div>
                                            @if ($item->status < 0)
                                                <div class="status danger">
                                                    Failed
                                                </div>
                                            @elseif($item->status == 5)
                                                <div class="status success">
                                                    Done
                                                </div>
                                            @elseif($item->status >= 0)
                                                <div class="status success">
                                                    Proccess
                                                </div>
                                            @endif
                                            <div class="id-transaksi">{{ $item->kode_transaksi }}</div>
                                        </div>
                                        <div class="body-item">
                                            <div class="image-item">
                                                <img src="{{ Auth::user()->thumb }}" alt="">
                                            </div>
                                            <div class="detail-item">
                                                <a href="#" class="name-item">{{ $item->nama_penerima }}</a>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="price">
                                                        <span>
                                                            @if ($item->total_price == $item->total_price_after_disc)
                                                                @if ($item->payment_method == 1)
                                                                    @php
                                                                        $cc = DB::table('credit_cards')
                                                                            ->where('id', $item->manual_payment_id)
                                                                            ->first();
                                                                    @endphp

                                                                    {{ $cc->currency_symbol }}
                                                                    {{ $item->total_price_after_disc + $item->shipping_price }}
                                                                @else
                                                                    ${{ $item->total_price_after_disc + $item->shipping_price }}
                                                                @endif
                                                            @else
                                                                @if ($item->payment_method == 1)
                                                                    @php
                                                                        $cc = DB::table('credit_cards')
                                                                            ->where('id', $item->manual_payment_id)
                                                                            ->first();
                                                                    @endphp
                                                                    <span
                                                                        style="text-decoration-line: line-through;text-decoration-thickness: 3px;">
                                                                        {{ $cc->currency_symbol }}
                                                                        {{ $item->total_price + $item->shipping_price }}</span>
                                                                    /
                                                                    {{ $cc->currency_symbol }}
                                                                    {{ $item->total_price_after_disc + $item->tax + $item->shipping_price }}
                                                                @else
                                                                    <span
                                                                        style="text-decoration-line: line-through;text-decoration-thickness: 3px;">
                                                                        ${{ $item->total_price + $item->shipping_price }}</span>
                                                                    /
                                                                    ${{ $item->total_price_after_disc + $item->tax + $item->shipping_price }}
                                                                @endif
                                                            @endif
                                                    </div>
                                                    <div class="action-item">
                                                        @if ($item->payment_method == 1 && $item->status == 0)
                                                            @if (is_null($item->manual_file))
                                                                <button type="button" class="btn btn-success"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal"
                                                                    data-id="{{ $item->id }}"
                                                                    data-manual_payment_id="{{ $item->manual_payment_id }}"
                                                                    data-shipping_price="{{ $item->shipping_price }}"
                                                                    data-shipping_method="{{ $item->shipping_method }}"
                                                                    data-total_price_after_disc="{{ $item->total_price_after_disc }}">
                                                                    Manual Transaction
                                                                </button>
                                                            @else
                                                                <button type="button" class="btn btn-success"
                                                                    disabled>
                                                                    ✓
                                                                </button>
                                                            @endif
                                                        @endif

                                                        <button type="button" class="button button-text"
                                                            data-bs-toggle="modal" data-bs-target="#seeDetailModal"
                                                            data-id='{{ $item->id }}'
                                                            data-user_id='{{ $item->user_id }}'
                                                            data-kode_transaksi="{{ $item->kode_transaksi }}"
                                                            data-date="{{ $item->date }}"
                                                            @if ($item->payment_method == 1) data-total_price="{{ $item->total_price }}"
                                                            data-total_price_after_disc="{{ $item->total_price_after_disc }}"
                                                            data-shipping_price="{{ $item->shipping_price }}"
                                                            data-tax="{{ $item->tax }}"
                                                            data-currency_symbol="{{ $cc->currency_symbol }}"
                                                            @else
                                                            data-total_price="{{ $item->total_price }}"
                                                            data-total_price_after_disc="{{ $item->total_price_after_disc }}"
                                                            data-shipping_price="{{ $item->shipping_price }}"
                                                            data-tax="{{ $item->tax }}"
                                                            data-currency_symbol="$" @endif
                                                            data-status="{{ $item->status }}"
                                                            data-payment_method="
                                                                            @if ($item->payment_method == 1) {{ 'MANUAL TRANSFER' }}
                                                            @elseif($item->payment_method == 2)
                                                                {{ 'PAYPAL' }}
                                                            @else
                                                                {{ 'STRIPE' }} @endif"
                                                            data-currency="{{ $item->currency }}"
                                                            data-tax="{{ $item->tax }}"
                                                            data-no_resi="{{ $item->no_resi ? $item->no_resi : 'No Resi Belum Tersedia.' }}"
                                                            data-hasPaid="{{ $item->hasPaid }}"
                                                            data-discount="{{ $item->discount }}"
                                                            data-discount_code="{{ $item->discount_code }}"
                                                            data-nama_penerima="{{ $item->nama_penerima }}"
                                                            data-alamat_penerima="{{ $item->alamat_penerima }}"
                                                            data-email_penerima="{{ $item->email_penerima }}"
                                                            data-negara_tujuan="{{ $item->negara_tujuan }}"
                                                            data-provinsi_tujuan="{{ $item->provinsi_tujuan }}"
                                                            data-kota_tujuan="{{ $item->kota_tujuan }}"
                                                            data-shipping_method="{{ $item->shipping_method }}"
                                                            data-zipcode="{{ $item->zipcode }}">
                                                            See Details
                                                        </button>
                                                        <button type="button" class="button button-outline-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#trackTransaksiModal"
                                                            data-alamat_penerima="{{ $item->alamat_penerima }}"
                                                            data-nama_penerima="{{ $item->nama_penerima }}"
                                                            data-resi="{{ $item->no_resi ? $item->no_resi : 'No Resi Belum Tersedia.' }}"
                                                            data-status="{{ $item->status }}">
                                                            Track Order
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="tab-pane fade" id="nav-proccess" role="tabpanel"
                                aria-labelledby="nav-proccess-tab">
                                <input type="hidden" name="id_selected" id="id_selected">
                                <input type="hidden" name="total_selected" id="total_selected">
                                @foreach (App\Models\Order::where(['user_id' => Auth::id()])->where('status','>=',0)->get() as $item)
                                    <div class="history-item">
                                        <div class="head-item">
                                            <div class="icon">
                                                <img src="{{ url('assets_user/img/icon/icon-history-transaksi.svg') }}"
                                                    alt="">
                                            </div>
                                            <div class="date">{{ $item->date }}</div>
                                            @if ($item->status < 0)
                                                <div class="status danger">
                                                    Failed
                                                </div>
                                            @elseif($item->status == 5)
                                                <div class="status success">
                                                    Done
                                                </div>
                                            @elseif($item->status >= 0)
                                                <div class="status success">
                                                    Proccess
                                                </div>
                                            @endif
                                            <div class="id-transaksi">{{ $item->kode_transaksi }}</div>
                                        </div>
                                        <div class="body-item">
                                            <div class="image-item">
                                                <img src="{{ Auth::user()->thumb }}" alt="">
                                            </div>
                                            <div class="detail-item">
                                                <a href="#" class="name-item">{{ $item->nama_penerima }}</a>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="price">
                                                        <span>
                                                            @if ($item->total_price == $item->total_price_after_disc)
                                                                @if ($item->payment_method == 1)
                                                                    @php
                                                                        $cc = DB::table('credit_cards')
                                                                            ->where('id', $item->manual_payment_id)
                                                                            ->first();
                                                                    @endphp

                                                                    {{ $cc->currency_symbol }}
                                                                    {{ $item->total_price_after_disc + $item->shipping_price }}
                                                                @else
                                                                    ${{ $item->total_price_after_disc + $item->shipping_price }}
                                                                @endif
                                                            @else
                                                                @if ($item->payment_method == 1)
                                                                    @php
                                                                        $cc = DB::table('credit_cards')
                                                                            ->where('id', $item->manual_payment_id)
                                                                            ->first();
                                                                    @endphp
                                                                    <span
                                                                        style="text-decoration-line: line-through;text-decoration-thickness: 3px;">
                                                                        {{ $cc->currency_symbol }}
                                                                        {{ $item->total_price + $item->shipping_price }}</span>
                                                                    /
                                                                    {{ $cc->currency_symbol }}
                                                                    {{ $item->total_price_after_disc + $item->tax + $item->shipping_price }}
                                                                @else
                                                                    <span
                                                                        style="text-decoration-line: line-through;text-decoration-thickness: 3px;">
                                                                        ${{ $item->total_price + $item->shipping_price }}</span>
                                                                    /
                                                                    ${{ $item->total_price_after_disc + $item->tax + $item->shipping_price }}
                                                                @endif
                                                            @endif
                                                    </div>
                                                    <div class="action-item">
                                                        @if ($item->payment_method == 1 && $item->status == 0)
                                                            @if (is_null($item->manual_file))
                                                                <button type="button" class="btn btn-success"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal"
                                                                    data-id="{{ $item->id }}"
                                                                    data-manual_payment_id="{{ $item->manual_payment_id }}"
                                                                    data-shipping_price="{{ $item->shipping_price }}"
                                                                    data-shipping_method="{{ $item->shipping_method }}"
                                                                    data-total_price_after_disc="{{ $item->total_price_after_disc }}">
                                                                    Manual Transaction
                                                                </button>
                                                            @else
                                                                <button type="button" class="btn btn-success"
                                                                    disabled>
                                                                    ✓
                                                                </button>
                                                            @endif
                                                        @endif

                                                        <button type="button" class="button button-text"
                                                            data-bs-toggle="modal" data-bs-target="#seeDetailModal"
                                                            data-id='{{ $item->id }}'
                                                            data-user_id='{{ $item->user_id }}'
                                                            data-kode_transaksi="{{ $item->kode_transaksi }}"
                                                            data-date="{{ $item->date }}"
                                                            @if ($item->payment_method == 1) data-total_price="{{ $item->total_price }}"
                                                            data-total_price_after_disc="{{ $item->total_price_after_disc }}"
                                                            data-shipping_price="{{ $item->shipping_price }}"
                                                            data-tax="{{ $item->tax }}"
                                                            data-currency_symbol="{{ $cc->currency_symbol }}"
                                                            @else
                                                            data-total_price="{{ $item->total_price }}"
                                                            data-total_price_after_disc="{{ $item->total_price_after_disc }}"
                                                            data-shipping_price="{{ $item->shipping_price }}"
                                                            data-tax="{{ $item->tax }}"
                                                            data-currency_symbol="$" @endif
                                                            data-status="{{ $item->status }}"
                                                            data-payment_method="
                                                                            @if ($item->payment_method == 1) {{ 'MANUAL TRANSFER' }}
                                                            @elseif($item->payment_method == 2)
                                                                {{ 'PAYPAL' }}
                                                            @else
                                                                {{ 'STRIPE' }} @endif"
                                                            data-currency="{{ $item->currency }}"
                                                            data-tax="{{ $item->tax }}"
                                                            data-no_resi="{{ $item->no_resi ? $item->no_resi : 'No Resi Belum Tersedia.' }}"
                                                            data-hasPaid="{{ $item->hasPaid }}"
                                                            data-discount="{{ $item->discount }}"
                                                            data-discount_code="{{ $item->discount_code }}"
                                                            data-nama_penerima="{{ $item->nama_penerima }}"
                                                            data-alamat_penerima="{{ $item->alamat_penerima }}"
                                                            data-email_penerima="{{ $item->email_penerima }}"
                                                            data-negara_tujuan="{{ $item->negara_tujuan }}"
                                                            data-provinsi_tujuan="{{ $item->provinsi_tujuan }}"
                                                            data-kota_tujuan="{{ $item->kota_tujuan }}"
                                                            data-shipping_method="{{ $item->shipping_method }}"
                                                            data-zipcode="{{ $item->zipcode }}">
                                                            See Details
                                                        </button>
                                                        <button type="button" class="button button-outline-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#trackTransaksiModal"
                                                            data-alamat_penerima="{{ $item->alamat_penerima }}"
                                                            data-nama_penerima="{{ $item->nama_penerima }}"
                                                            data-resi="{{ $item->no_resi ? $item->no_resi : 'No Resi Belum Tersedia.' }}"
                                                            data-status="{{ $item->status }}">
                                                            Track Order
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="tab-pane fade" id="nav-failed" role="tabpanel"
                                aria-labelledby="nav-failed-tab">
                                <input type="hidden" name="id_selected" id="id_selected">
                                <input type="hidden" name="total_selected" id="total_selected">
                                @foreach (App\Models\Order::where(['user_id' => Auth::id()])->where('status','<',0)->get() as $item)
                                    <div class="history-item">
                                        <div class="head-item">
                                            <div class="icon">
                                                <img src="{{ url('assets_user/img/icon/icon-history-transaksi.svg') }}"
                                                    alt="">
                                            </div>
                                            <div class="date">{{ $item->date }}</div>
                                            @if ($item->status < 0)
                                                <div class="status danger">
                                                    Failed
                                                </div>
                                            @elseif($item->status == 5)
                                                <div class="status success">
                                                    Done
                                                </div>
                                            @elseif($item->status >= 0)
                                                <div class="status success">
                                                    Proccess
                                                </div>
                                            @endif
                                            <div class="id-transaksi">{{ $item->kode_transaksi }}</div>
                                        </div>
                                        <div class="body-item">
                                            <div class="image-item">
                                                <img src="{{ Auth::user()->thumb }}" alt="">
                                            </div>
                                            <div class="detail-item">
                                                <a href="#" class="name-item">{{ $item->nama_penerima }}</a>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="price">
                                                        <span>
                                                            @if ($item->total_price == $item->total_price_after_disc)
                                                                @if ($item->payment_method == 1)
                                                                    @php
                                                                        $cc = DB::table('credit_cards')
                                                                            ->where('id', $item->manual_payment_id)
                                                                            ->first();
                                                                    @endphp

                                                                    {{ $cc->currency_symbol }}
                                                                    {{ $item->total_price_after_disc + $item->shipping_price }}
                                                                @else
                                                                    ${{ $item->total_price_after_disc + $item->shipping_price }}
                                                                @endif
                                                            @else
                                                                @if ($item->payment_method == 1)
                                                                    @php
                                                                        $cc = DB::table('credit_cards')
                                                                            ->where('id', $item->manual_payment_id)
                                                                            ->first();
                                                                    @endphp
                                                                    <span
                                                                        style="text-decoration-line: line-through;text-decoration-thickness: 3px;">
                                                                        {{ $cc->currency_symbol }}
                                                                        {{ $item->total_price + $item->shipping_price }}</span>
                                                                    /
                                                                    {{ $cc->currency_symbol }}
                                                                    {{ $item->total_price_after_disc + $item->tax + $item->shipping_price }}
                                                                @else
                                                                    <span
                                                                        style="text-decoration-line: line-through;text-decoration-thickness: 3px;">
                                                                        ${{ $item->total_price + $item->shipping_price }}</span>
                                                                    /
                                                                    ${{ $item->total_price_after_disc + $item->tax + $item->shipping_price }}
                                                                @endif
                                                            @endif
                                                    </div>
                                                    <div class="action-item">
                                                        @if ($item->payment_method == 1 && $item->status == 0)
                                                            @if (is_null($item->manual_file))
                                                                <button type="button" class="btn btn-success"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal"
                                                                    data-id="{{ $item->id }}"
                                                                    data-manual_payment_id="{{ $item->manual_payment_id }}"
                                                                    data-shipping_price="{{ $item->shipping_price }}"
                                                                    data-shipping_method="{{ $item->shipping_method }}"
                                                                    data-total_price_after_disc="{{ $item->total_price_after_disc }}">
                                                                    Manual Transaction
                                                                </button>
                                                            @else
                                                                <button type="button" class="btn btn-success"
                                                                    disabled>
                                                                    ✓
                                                                </button>
                                                            @endif
                                                        @endif

                                                        <button type="button" class="button button-text"
                                                            data-bs-toggle="modal" data-bs-target="#seeDetailModal"
                                                            data-id='{{ $item->id }}'
                                                            data-user_id='{{ $item->user_id }}'
                                                            data-kode_transaksi="{{ $item->kode_transaksi }}"
                                                            data-date="{{ $item->date }}"
                                                            @if ($item->payment_method == 1) data-total_price="{{ $item->total_price }}"
                                                            data-total_price_after_disc="{{ $item->total_price_after_disc }}"
                                                            data-shipping_price="{{ $item->shipping_price }}"
                                                            data-tax="{{ $item->tax }}"
                                                            data-currency_symbol="{{ $cc->currency_symbol }}"
                                                            @else
                                                            data-total_price="{{ $item->total_price }}"
                                                            data-total_price_after_disc="{{ $item->total_price_after_disc }}"
                                                            data-shipping_price="{{ $item->shipping_price }}"
                                                            data-tax="{{ $item->tax }}"
                                                            data-currency_symbol="$" @endif
                                                            data-status="{{ $item->status }}"
                                                            data-payment_method="
                                                                            @if ($item->payment_method == 1) {{ 'MANUAL TRANSFER' }}
                                                            @elseif($item->payment_method == 2)
                                                                {{ 'PAYPAL' }}
                                                            @else
                                                                {{ 'STRIPE' }} @endif"
                                                            data-currency="{{ $item->currency }}"
                                                            data-tax="{{ $item->tax }}"
                                                            data-no_resi="{{ $item->no_resi ? $item->no_resi : 'No Resi Belum Tersedia.' }}"
                                                            data-hasPaid="{{ $item->hasPaid }}"
                                                            data-discount="{{ $item->discount }}"
                                                            data-discount_code="{{ $item->discount_code }}"
                                                            data-nama_penerima="{{ $item->nama_penerima }}"
                                                            data-alamat_penerima="{{ $item->alamat_penerima }}"
                                                            data-email_penerima="{{ $item->email_penerima }}"
                                                            data-negara_tujuan="{{ $item->negara_tujuan }}"
                                                            data-provinsi_tujuan="{{ $item->provinsi_tujuan }}"
                                                            data-kota_tujuan="{{ $item->kota_tujuan }}"
                                                            data-shipping_method="{{ $item->shipping_method }}"
                                                            data-zipcode="{{ $item->zipcode }}">
                                                            See Details
                                                        </button>
                                                        <button type="button" class="button button-outline-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#trackTransaksiModal"
                                                            data-alamat_penerima="{{ $item->alamat_penerima }}"
                                                            data-nama_penerima="{{ $item->nama_penerima }}"
                                                            data-resi="{{ $item->no_resi ? $item->no_resi : 'No Resi Belum Tersedia.' }}"
                                                            data-status="{{ $item->status }}">
                                                            Track Order
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <!--Modal Track Order-->
    <div class="modal fade modal-tracking" id="trackTransaksiModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="trackTransaksiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" id="tracking-body">
                <div class="modal-body">
                    Loading ...
                </div>
            </div>
        </div>
    </div>

    <!--Modal See Detail-->
    <div class="modal fade modal-detail" id="seeDetailModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="seeDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content" id="details-order">
                <div class="modal-body">
                    Loading ...
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-manual-content">
                <div class="modal-body">
                    Loading ...
                </div>
            </div>
        </div>
    </div>

    <div style="display: hidden;" id="listItem"></div>

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
    <!--Ion Icon-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $('.dropify').dropify();
    </script>
    <script>
        $(document).ready(function() {
            $("#exampleModal").on('show.bs.modal', function(e) {
                console.log('ada');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('get-info-manual-transaction') }}",
                    data: {
                        id: $(e.relatedTarget).data('manual_payment_id'),
                    },
                    success: function(data) {
                        var html = `
                        <div class="modal-header">
                            <h5 class="modal-title" id="seeDetailModalLabel">
                                Manual Transaction</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                <div class="cardd mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="thint-text">Total Bill</p>
                                        <p class="primary-text">${$('#total_selected').val()}</p>
                                    </div>
                                </div>
                                <div class="cardd mb-3">
                                    <div class="card-body">
                                        <ul>
                                            ${data[0]}
                                        </ul>
                                    </div>
                                </div>

                                <form id="add_bukti_pembayaran" action="{{ route('add-bukti-pembayaran') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="${$('#id_selected').val()}" required />
                                        <input type="file" name="file" class="dropify" required />
                                        </br>
                                        <button  type="submit" class="button button-primary w-100">
                                            Pay
                                        </button>
                                </form>
                            </div>`;

                        $("#modal-manual-content").html(html);
                        $('.dropify').dropify();
                    }
                });
            });

            $('#exampleModal').on('show.bs.modal', function(e) {
                $('#id_selected').val($(e.relatedTarget).data('id'));
                $('#total_selected').val($(e.relatedTarget).data('total_price_after_disc') + $(e
                    .relatedTarget).data('shipping_price'));
            });

            $('#seeDetailModal').on('show.bs.modal', function(e) {
                var listItem = '';

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('get-detail-item-transaction') }}",
                    data: {
                        id: $(e.relatedTarget).data('id'),
                    },
                    success: function(data) {
                        data.forEach(element => {
                            listItem += `<div class="item">
                                    <div class="images-item">
                                        <img src="${element.thumb}">
                                    </div>
                                    <div class="detail-item">
                                        <h5>${element.nama}</h5>
                                        <h6>$${element.price} x ${element.qty} : $${element.total}</h6>
                                    </div>
                                </div>
                                `;
                        });

                        var html = `<div class="modal-header">
                            <h5 class="modal-title" id="seeDetailModalLabel">
                                Transaction
                                Detail</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="line-detail">
                                <h5>Info Transaction</h5>
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td>No. Invoice</td>
                                            <td class="primary-text">
                                                ${$(e.relatedTarget).data('kode_transaksi')}</td>
                                        </tr>
                                        <tr>
                                            <td>Transaction Date</td>
                                            <td>${$(e.relatedTarget).data('date')}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="line-detail">
                                <div class="wrapper-item">
                                    ${listItem}
                                </div>
                            </div>
                            <div class="line-detail">
                                <h5>Info Delivered</h5>
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td>No Resi</td>
                                            <td>${$(e.relatedTarget).data('no_resi')}</td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td class="bold-text">${$(e.relatedTarget).data('nama_penerima')}</td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>${$(e.relatedTarget).data('alamat_penerima')}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="line-detail">
                                <h5>Payment Details</h5>
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td>Method Payment</td>
                                            <td class="bold-text">${$(e.relatedTarget).data('payment_method')}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td>${$(e.relatedTarget).data('currency_symbol')} ${$(e.relatedTarget).data('total_price')}</td>
                                        </tr>
                                        <tr>
                                            <td>Discount</td>
                                            <td>${$(e.relatedTarget).data('discount') + '%'}</td>
                                        </tr>
                                        <tr>
                                            <td>Total Price After Disc</td>
                                            <td>${$(e.relatedTarget).data('currency_symbol')} ${$(e.relatedTarget).data('total_price_after_disc')}</td>
                                        </tr>
                                        <tr>
                                            <td>Tax</td>
                                            <td>${$(e.relatedTarget).data('currency_symbol')} ${$(e.relatedTarget).data('tax') }</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping</td>
                                            <td>${$(e.relatedTarget).data('currency_symbol')} ${$(e.relatedTarget).data('shipping_price') }</td>
                                        </tr>
                                        <tr>
                                            <td class="bold-text">Total All
                                            </td>
                                            <td class="bold-text">${$(e.relatedTarget).data('currency_symbol')} ${$(e.relatedTarget).data('total_price_after_disc') + $(e.relatedTarget).data('tax') + $(e.relatedTarget).data('shipping_price')}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>`;
                        $('#details-order').html(html);
                    }
                });
            })
        })

        $(document).ready(function() {
            $('.modal-tracking').on('show.bs.modal', function(e) {
                var stats = [
                    "Waiting approval", "Order Processed", "Quarantine Process", "Order Shipped",
                    "Shipped", "Reviews"
                ];

                var step = '';
                for (let i = 0; i <= 5; i++) {
                    if (i <= $(e.relatedTarget).data('status')) {
                        step += `<div class="tracking">
                                        <div class="process-track">
                                            <div class="bullets-track now-proccess">
                                            </div>
                                            <div class="line-track">
                                            </div>
                                        </div>
                                        <p class="name-process">
                                            ${stats[i]}
                                        </p>
                                    </div>`;
                    } else {
                        step += `<div class="tracking">
                                        <div class="process-track">
                                            <div class="bullets-track">
                                            </div>
                                            <div class="line-track">
                                            </div>
                                        </div>
                                        <p class="name-process">
                                            ${stats[i]}
                                        </p>
                                    </div>`;
                    }
                }

                var html = `
                <div class="modal-header">
                    <h5 class="modal-title" id="trackTransaksiModalLabel">Tracking
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3 mb-md-0">
                            <div class="detail-tracking">
                                <div class="line-tracking number-tracking">
                                    <p class="title-detail">No
                                        Resi</p>
                                    <h4 class="bold-text">
                                        ${$(e.relatedTarget).data('resi')}
                                        </h4>
                                </div>
                                <div class="line-tracking">
                                    <p class="title-detail">
                                        Sender</p>
                                    <h4 class="bold-text">
                                        Plantsasri ID</h4>
                                </div>
                                <div class="line-tracking">
                                    <p class="title-detail">
                                        Receiver</p>
                                    <h4 class="bold-text">${$(e.relatedTarget).data('nama_penerima')}</h4>
                                    <h4 class="address">${$(e.relatedTarget).data('alamat_penerima')}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="process-tracking">
                                <div class="tracking-images">
                                    <img src="{{ url('assets_user/img/tracking-vector.svg') }}" alt="">
                                </div>
                                <p class="status">Status :
                                    <span>${stats[$(e.relatedTarget).data('status')]}</span>
                                </p>
                                <div class="card">
                                    ${step}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
                var modal = $(this);
                modal.find('#tracking-body').html(html);
            })
        })
    </script>

    <script>
        history.pushState(null, null, location.href);
        window.onpopstate = function() {
            history.go(1);
        };
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

    @if (isset($_GET['message']))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'success',
            html: @json($_GET['message']),
            showConfirmButton: false,
            timer: 4000
        })
    </script>
    @endif
@endsection