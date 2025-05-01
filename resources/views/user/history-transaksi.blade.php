@extends('layouts.base_user')

@section('css')
    <!--CSS Profile-->
    <link rel="stylesheet" href="{{ url('assets_user/css/history-transaksi.css') }}">
    <link rel="stylesheet" href="{{ url('assets_user/css/checkout.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
        integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
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

    </style>
@endsection


@section('content')
    <div id="mainContent">
        <div class="container">
            <div class="first-line">
                <div class="row">
                    <div class="col-12 col-lg-4 col-xl-3 mb-4 mb-lg-0">
                        <div class="card card-user-menu">
                            <div class="user-detail">
                                <img src="{{ Auth::user()->thumb }}" alt="">
                                <p class="name-user">{{ Auth::user()->name }}</p>
                            </div>
                            <div class="menu-profile">
                                <a href="{{ route('profile') }}" class="menu">
                                    <ion-icon name="person"></ion-icon>
                                    Account
                                </a>
                                <a href="{{ route('chat', ['for' => 1]) }}" class="menu">
                                    <ion-icon name="chatbox-ellipses"></ion-icon>
                                    Chat
                                </a>
                                <a href="{{ route('history-transaction') }}" class="menu">
                                    <ion-icon name="cart"></ion-icon>
                                    History Transaction
                                </a>
                                {{-- <form action="{{ route('logout') }}" method="post">
                                    @csrf --}}
                                <a href="{{ route('logoutUser') }}" class="menu logout">
                                    <ion-icon name="log-out"></ion-icon>
                                    Logout
                                </a>
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 col-xl-9">
                        <div class="card">
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
                                                                {{-- @if ($item->status == 5)
                                                                    <button type="button"
                                                                        class="button button-outline-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#trackTransaksiModal"
                                                                        data-status="{{ $item->status }}">
                                                                        Track Order
                                                                    </button>
                                                                @endif --}}

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
                                                                {{-- @if ($item->status == 5)
                                                                    <button type="button"
                                                                        class="button button-outline-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#trackTransaksiModal"
                                                                        data-status="{{ $item->status }}">
                                                                        Track Order
                                                                    </button>
                                                                @endif --}}

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
                                                                {{-- @if ($item->status == 5)
                                                                    <button type="button"
                                                                        class="button button-outline-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#trackTransaksiModal"
                                                                        data-status="{{ $item->status }}">
                                                                        Track Order
                                                                    </button>
                                                                @endif --}}

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
                                                                {{-- @if ($item->status == 5)
                                                                    <button type="button"
                                                                        class="button button-outline-primary"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#trackTransaksiModal"
                                                                        data-status="{{ $item->status }}">
                                                                        Track Order
                                                                    </button>
                                                                @endif --}}

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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



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


    <div style="display: hidden;" id="listItem">

    </div>
    <footer>
        <div class="wrapperFooter container">
            <div class="about">
                <img src="{{ url('KlorofilFarm.png') }}" alt="">
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
                // var modal = $(this);
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
