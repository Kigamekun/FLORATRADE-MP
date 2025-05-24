@extends('layouts.base_user')

@section('css')
    <!--CSS Assets this page-->
    <link rel="stylesheet" href="{{ url('assets_user/css/moreExplorePlant.css') }}">
    <!--about,faq,terms CSS-->
    <link rel="stylesheet" href="{{ url('assets_user/css/about-faq.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/result.css') }}">
    <style>
        .price-slider-container {
            padding: 20px 0;
        }

        .price-labels {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-weight: bold;
        }

        #currentPrice {
            color: #4CAF50;
            font-weight: bold;
        }

        #priceSlider {
            width: 100%;
            height: 8px;
            -webkit-appearance: none;
            background: #d3d3d3;
            outline: none;
            border-radius: 10px;
        }

        #priceSlider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #4CAF50;
            cursor: pointer;
        }

        #priceSlider::-moz-range-thumb {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #4CAF50;
            cursor: pointer;
        }

        .product-card__qty {
            background-color: rgb(221, 241, 249);
            border: 1px solid rgb(0, 157, 255);
            color: rgb(0, 72, 255);
            font-size: 9px;
            padding: 2px 9px;
        }


        .product-card__qty_habis {
            background-color: rgb(249, 221, 224);
            border: 1px solid rgb(255, 0, 64);
            color: rgb(255, 0, 8);
            font-size: 9px;
            padding: 2px 9px;
        }
    </style>
@endsection


@section('content')

    <div id="mainContent">
        <div class="banner-title">
            <h1 class="title">Explore Plant</h1>
            <div class="breadchumb-wrapper">
                <a href="./main.html">Home</a>
                <span>-</span>
                <p>Explore</p>
            </div>
        </div>
        <div class="container line">
            <div class="row">
                <div class="col-12 col-lg-3 mb-4 mb-lg-0">
                    <div class="relativeContainer">
                        <div class="categoriesContainer">
                            <h4>Categories</h4>
                            <div class="wrapperCategories row">
                                @foreach (DB::table('base_plants')->get() as $item)
                                    @if (DB::table('plants')->where('category_id', $item->id)->count() > 0)
                                        <div class="col-12 col-sm-6 col-md-3 col-lg-12">
                                            <a href="{{ route('search') }}?category={{ $item->id }}"
                                                class="categoriesPlant">
                                                <div class="imagesCategories">
                                                    <img src="{{ url('assets_user/img/categoriesImages.png') }}"
                                                        alt="">
                                                </div>
                                                <p class="nameCategories">{{ $item->name_latin }}
                                                    <span>({{ DB::table('plants')->where('category_id', $item->id)->count() }})</span>
                                                </p>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach


                            </div>
                            <!-- In your HTML section (replace the price filter container) -->
                            <!-- Price Filter Section -->
                            <div class="priceFilterContainer">
                                <h4>Price Filter</h4>
                                <form action="{{ route('search') }}" method="GET"> <!-- Ensure the form uses GET -->
                                    <div class="priceFilterWrapper">
                                        <div class="price-slider-container">
                                            <div class="price-labels">
                                                <span>$2</span>
                                                <span id="currentPrice">$5.00</span>
                                                <span>$5</span>
                                            </div>
                                            <input name="price" type="range" min="2" max="5"
                                                step="0.1" value="{{ request('price', 5) }}" id="priceSlider">
                                        </div>
                                        <div class="d-flex justify-content-center mt-3">
                                            <button type="submit" class="button button-primary md-button">Apply
                                                Filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-9">
                    <div class="productContainer">
                        <a href="#" class="header-line">
                            <img src="{{ url('assets_user/img/icon/product_icon.svg') }}" alt="">
                            <p style="font-size: 2em; font-weight: bold; white-space: nowrap;">Product</p>
                        </a>

                        <div class="container">
                            <div class="row custom-product-grid gx-3 gy-4">
                                @if (count($data) != 0 && !empty($data))
                                    @foreach ($data as $item)
                                        @php
                                            $thumb = json_decode($item->thumb, true);
                                            $rating = number_format(
                                                (float) DB::table('comments')
                                                    ->where('plant_id', $item->id)
                                                    ->avg('rate') ?? 0,
                                                1,
                                            );
                                        @endphp

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <a href="{{ route('detail-plant', ['id' => $item->id]) }}"
                                                class="custom-product-card">
                                                <div class="custom-product-image">
                                                    <img src="{{ url('thumbPlant/' . $thumb[0]) }}"
                                                        alt="{{ $item->name }}">
                                                </div>
                                                <div class="custom-product-info">
                                                    <p class="custom-product-name">{{ $item->name }}</p>
                                                    <p class="custom-product-price">${{ $item->price }}</p>
                                                    @if ($item->stock <= 0)
                                                        <span class="product-card__qty_habis">Out of Stock</span>
                                                    @else
                                                        <span class="product-card__qty">Quantity :
                                                            {{ $item->stock }}</span>
                                                    @endif
                                                    <p class="custom-product-rating">{{ $rating }}</p>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach

                                    <div class="d-flex justify-content-end">
                                        {{ $data->links() }}
                                    </div>
                                @else
                                    <div class="container">
                                        <img class="w-100" src="{{ url('assets_user/img/empaty state.png') }}"
                                            alt="">
                                    </div>
                                @endif
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
                            <img src="{{ url('assets_user/img/icon/pin (1).png') }}" alt="">
                            <span class="footer__contact-text">Curug Mekar - Bogor Barat, Bogor, Jawa Barat</span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    @endsection


    // In your script section
    @section('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const priceSlider = document.getElementById('priceSlider');
                const currentPriceDisplay = document.getElementById('currentPrice');

                if (priceSlider && currentPriceDisplay) {
                    // Initialize with the current value from the request
                    const initialPrice = priceSlider.value;
                    currentPriceDisplay.textContent = `$${parseFloat(initialPrice).toFixed(2)}`;

                    // Update the displayed price as the slider moves
                    priceSlider.addEventListener('input', function() {
                        currentPriceDisplay.textContent = `$${parseFloat(this.value).toFixed(2)}`;
                    });
                }

                // Form submission handling
                const priceForm = document.querySelector('.priceFilterWrapper form');
                if (priceForm) {
                    priceForm.addEventListener('submit', function(e) {
                        // Ensure the price parameter is included
                        if (!this.querySelector('[name="price"]')) {
                            const hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = 'price';
                            hiddenInput.value = priceSlider.value;
                            this.appendChild(hiddenInput);
                        }
                    });
                }

                // Original pagination functionality
                @if (isset($_GET['page']))
                    $('ul.pagination li').hide().filter(':lt(1), :nth-child(2),:nth-child(3),:nth-last-child(1)')
                .show();
                @else
                    $('ul.pagination li').hide().filter(':lt(1), :nth-child(2),:nth-child(3),:nth-last-child(1)')
                .show();
                @endif
            });
        </script>
    @endsection
