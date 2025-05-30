@extends('layouts.base_user')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/slidehp.css') }}">
    <style>
        /*Component Table*/
        .wrapperTable {
            padding: 2rem 0;
        }

        .wrapperTable .pagination {
            margin-top: 20rem;
        }

        .wrapperTable .pagination .paginate_button.active .page-link {
            background: #32D18B !important;
            color: #fff;
            border-radius: 6px;
        }

        .wrapperTable .pagination .paginate_button .page-link {
            border: none;
            background: transparent !important;
            color: #535353;
            padding: .2rem .8rem;
            font-weight: 300;
        }

        .wrapperTable .tables {
            border-spacing: 0 10px !important;
            width: 100%;
            max-width: 100%;
        }

        .wrapperTable .tables thead tr {
            box-shadow: 0px 36px 80px rgba(0, 0, 0, 0.02), 0px 4.50776px 10.0172px rgba(0, 0, 0, 0.04);
        }

        .wrapperTable .tables thead tr th {
            color: #535353;
            font-weight: 300;
            vertical-align: middle;
            padding: .8rem;
            background-color: #fff;
        }

        .wrapperTable .tables thead tr th:first-child {
            -moz-border-radius: 10px 0px 0px 10px !important;
            -webkit-border-radius: 10px 0px 0px 10px !important;
        }

        .wrapperTable .tables thead tr th:last-child {
            -webkit-border-radius: 0px 10px 10px 0px !important;
            -moz-border-radius: 0px 10px 10px 0px !important;
        }

        .wrapperTable .tables tbody tr:last-child {
            box-shadow: 0px 36px 80px rgba(0, 0, 0, 0.02), 0px 4.50776px 10.0172px rgba(0, 0, 0, 0.04);
        }

        .wrapperTable .tables tbody tr td {
            color: #535353;
            font-weight: 400;
            vertical-align: middle;
            height: 100%;
            padding: .8rem;
            background-color: #fff;
            font-size: 16px;
        }

        .wrapperTable .tables tbody tr td:first-child {
            -moz-border-radius: 10px 0px 0px 10px !important;
            -webkit-border-radius: 10px 0px 0px 10px !important;
        }

        .wrapperTable .tables tbody tr td:last-child {
            -webkit-border-radius: 0px 10px 10px 0px !important;
            -moz-border-radius: 0px 10px 10px 0px !important;
        }

        .wrapperTable .tables tbody tr td .code .numberCode {
            color: #32D18B;
            text-decoration: none;
            transition: .3s;
        }

        .wrapperTable .tables tbody tr td .code .numberCode:hover {
            color: #259963;
            transition: .3s;
        }

        .wrapperTable .tables tbody tr td .detailName {
            display: flex;
            flex-direction: column;
        }

        .wrapperTable .tables tbody tr td .detailName .name {
            font-weight: 600;
        }

        .wrapperTable .tables tbody tr td .buttonAction {
            display: flex;
        }

        .wrapperTable .tables tbody tr td .buttonAction .buttons {
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: .5rem;
            border: none;
            border-radius: 6px;
            transition: .2s;
        }

        .wrapperTable .tables tbody tr td .buttonAction .success {
            margin-right: .5rem;
            background: #32D18B;
        }

        .wrapperTable .tables tbody tr td .buttonAction .success:hover {
            background: #259963;
            transition: .2s ease-in-out;
        }

        .wrapperTable .tables tbody tr td .buttonAction .danger {
            background: #DC3545;
        }

        .wrapperTable .tables tbody tr td .buttonAction .danger:hover {
            background: #b52b39;
            transition: .2s ease-in-out;
        }

        .wrapperTable .tables tbody tr td .address {
            display: block;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            max-width: 250px;
        }

        .wrapperTable .tables tbody tr td .status {
            border-radius: 5px;
            padding: .5rem .8rem;
            width: fit-content;
            color: #fff;
            font-weight: 500;
            text-align: center;
            font-size: 12px;
        }

        .wrapperTable .tables tbody tr td .status.status-warning {
            background-color: #FFC107;
        }

        .wrapperTable .tables tbody tr td .status.status-primary {
            background-color: #32D18B;
        }

        .wrapperTable .tables tbody tr td .status.status-danger {
            background-color: #DC3545;
        }

        @media screen and (max-width: 768px) {
            .dataTables_length {
                margin-bottom: .5rem;
                font-size: 12px;
            }

            .dataTables_wrapper .dataTables_filter {
                font-size: 12px;
            }

            .form-select,
            .form-control {
                font-size: 12px;
            }

            .wrapperTable .tables thead tr th {
                font-size: 14px;
            }

            .wrapperTable .tables tbody tr td {
                font-size: 14px;
            }
        }

        .btn-primary {
            background-color: #32D18B;
            border-radius: 5px !important;
        }

        .btn-primary:focus {
            background: #32D18B !important;
            border-color: #32D18B;
            box-shadow: 0 0 0 0.25rem rgba(45, 184, 120, 0.5);
        }

        .btn-primary:hover {
            background-color: #40a777;
        }

        .img-full {
            width: 100%;
            height: auto;
            display: block;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endsection

@section('content')
    <div class="container first-line">
        <div class="container">
            <img src="{{ url('assets_user/img/welcomehome.png') }}" alt="" class="img-full">
        </div>
    </div>
    <div class="container">
        <div class="row line">
            <div class="col-12 col-lg-3 mb-4 mb-lg-0">
                <div class="categoriesContainer">
                    <h4>Categories</h4>
                    <div class="wrapperCategories row">
                        @foreach (DB::table('base_plants')->get() as $item)
                            @if (DB::table('plants')->where('category_id', $item->id)->count() > 0)
                                <div class="col-12 col-sm-6 col-md-3 col-lg-12">
                                    <a href="{{ route('search') }}?category={{ $item->id }}" class="categoriesPlant">
                                        <div class="imagesCategories">
                                            <img src="{{ url('assets_user/img/categoriesImages.png') }}" alt="">
                                        </div>
                                        <p class="nameCategories">{{ $item->name_latin }}
                                            <span>({{ DB::table('plants')->where('category_id', $item->id)->count() }})</span>
                                        </p>
                                    </a>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
            <main class="product-grid">
                <a href="#" class="header-line">
                    <img src="https://cdn.builder.io/api/v1/image/assets/282631be213f4cdc9e5c0d357acf295c/bae6c7296546594691d429556149426dd736ff2d?placeholderIfAbsent=true"
                        alt="Best Offer" class="product-grid__icon" />
                    <p style="font-size: 2em; font-weight: bold; white-space: nowrap;">Best Offer</p>
                </a>
                <div class="product-grid__row">
                    @foreach (DB::table('plants')->where('status', 1)->limit(3)->get() as $item)
                        @php
                            $thumb = json_decode($item->thumb, true);
                            $imageSrc = isset($thumb[0]) ? url('thumbPlant/' . $thumb[0]) : '';
                            $rating = DB::table('comments')->where('plant_id', $item->id)->avg('rate');
                            $ratingFormatted = is_null($rating) ? '0.0' : number_format($rating, 1);
                            // Optional: hapus kalau nggak punya tabel orders
                            // $sold = DB::table('orders')->where('plant_id', $item->id)->sum('quantity');
                        @endphp
                        <article class="product-card">
                            <a href="{{ route('detail-plant', ['id' => $item->id]) }}">
                                <img src="{{ $imageSrc }}" alt="{{ $item->name }}" class="product-card__image" />
                                <div class="product-card__content">
                                    <div class="product-card__info">
                                        <h3 class="product-card__name">{{ $item->name }}</h3>
                                        <span class="product-card__price">${{ $item->price }}</span>
                                    </div>
                                    <div class="product-card__stats">
                                        @if ($item->stock <= 0)
                                            <span class="product-card__qty_habis">Out of Stock</span>
                                        @else
                                            <span class="product-card__qty">Quantity : {{ $item->stock }}</span>
                                        @endif


                                        <span class="product-card__rating">{{ $ratingFormatted }}</span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            </main>


            <div class="col-12 col">
                 <a href="#" class="header-line">
                    <img src="https://cdn.builder.io/api/v1/image/assets/282631be213f4cdc9e5c0d357acf295c/bae6c7296546594691d429556149426dd736ff2d?placeholderIfAbsent=true"
                        alt="Best Offer" class="product-grid__icon" />
                    <p style="font-size: 2em; font-weight: bold; white-space: nowrap;">List Plant</p>
                </a>
                <div class="gap-3 d-flex justify-center flex-wrap">
                            <!-- Loop through plants and display them -->
                     @foreach (DB::table('plants')->where('status', 1)->limit(8)->get() as $item)
                                @php
                                    $thumb = json_decode($item->thumb, true);
                                    $imageSrc = isset($thumb[0]) ? url('thumbPlant/' . $thumb[0]) : '';
                                    $rating = DB::table('comments')->where('plant_id', $item->id)->avg('rate');
                                    $ratingFormatted = is_null($rating) ? '0.0' : number_format($rating, 1);
                                    // Optional: hapus kalau nggak punya tabel orders
                                    // $sold = DB::table('orders')->where('plant_id', $item->id)->sum('quantity');
                                @endphp
                                <article class="product-card">
                                    <a href="{{ route('detail-plant', ['id' => $item->id]) }}">
                                        <img
                                            src="{{ $imageSrc }}"
                                            alt="{{ $item->name }}"
                                            class="product-card__image"
                                        />
                                        <div class="product-card__content">
                                            <div class="product-card__info">
                                                <h3 class="product-card__name">{{ $item->name }}</h3>
                                                <span class="product-card__price">${{ $item->price }}</span>
                                            </div>
                                            <div class="product-card__stats">
                                                @if ($item->stock <= 0)
                                                    <span class="product-card__qty_habis">Out of Stock</span>
                                                @else
                                                <span class="product-card__qty">Quantity : {{ $item->stock }}</span>

                                                @endif


                                                <span class="product-card__rating">{{ $ratingFormatted }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </article>
                            @endforeach
                </div>
            </div>
        </div>
        <div class="wrapperProduct line">
            <div class="d-flex justify-content-center mt-3 mb-3">
                <a href="{{ route('more') }}" class="button button-outline-primary md-button">View More</a>
            </div>
        </div>
    </div>




    <div class="wrapperService line">
        <div class="container d-flex">
            <div class="image">
                <img src="{{ url('assets_user/img/howwework.png') }}" alt="">
            </div>
            <div class="desc">
                <h2>How We Work ?</h2>
                <p class="mt-1" style="font-weight:300">Make space in your home for plants. you will feel better for it.
                    not only they are beautiful, but caring for them helps us.</p>
                <div class="items d-flex align-items-center">
                    <div class="image">
                        <img src="{{ url('assets_user/img/icon/delivery.png') }}" alt="">
                    </div>
                    <div class="text">
                        <h4 class="mb-1" style="font-size: 20px;">Free delivery worldwide</h4>
                        <p style="font-weight:300; font-size : 14px;">We offer free shipping for purchases over certain
                            amount.</p>
                    </div>
                </div>
                <div class="items d-flex align-items-center">
                    <div class="image">
                        <img src="{{ url('assets_user/img/icon/secure.png') }}" alt="">
                    </div>
                    <div class="text">
                        <h4 class="mb-1" style="font-size: 20px;">Secure payments</h4>
                        <p style="font-weight:300; font-size : 14px;">Your payment information is processed securely by us.
                        </p>
                    </div>
                </div>
                <div class="items d-flex align-items-center">
                    <div class="image">
                        <img src="{{ url('assets_user/img/icon/support.png') }}" alt="">
                    </div>
                    <div class="text">
                        <h4 class="mb-1" style="font-size: 20px;">Top-notch support</h4>
                        <p style="font-weight:300; font-size : 14px;">Any question? There is a Chat Feature to communicate
                            directly with us.</p>
                    </div>
                </div>
            </div>
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
                    <a href="/" class="footer__link">Home</a>
                    <a href="about" class="footer__link">About FloraTrade</a>
                    <a href="catalog" class="footer__link">Price List</a>
                    <a href="faq" class="footer__link">FAQ</a>
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
                        <img src="{{ url('assets_user/img/icon/pin (1).png') }}" alt="">
                        <span class="footer__contact-text">Curug Mekar - Bogor Barat, Bogor, Jawa Barat</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection

@section('js')
    <script src="{{ url('assets/vendor/jquery/jquery.min.js') }}"></script>
    <!--Datatable By Bootstrap-->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#catalogTable').DataTable({
                "info": false,
                "bSort": false,
            });
        });
    </script>
@endsection
