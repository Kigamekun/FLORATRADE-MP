@extends('layouts.base_user')

@section('css')
    <!--CSS Assets this page-->
    <link rel="stylesheet" href="{{ url('assets_user/css/moreExplorePlant.css') }}">
    <!--about,faq,terms CSS-->
    <link rel="stylesheet" href="{{ url('assets_user/css/about-faq.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
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
                            <div class="priceFilterContainer">
                                <h4>Price Filter</h4>
                                <form action="{{ route('search') }}" method="POST">
                                    @csrf
                                    <div class="priceFilterWrapper">
                                        <div class="priceNumberValue">
                                            <div class="price-wrap">
                                                <input id="one">
                                                <label for="one">$</label>
                                            </div>
                                            <div class="price-wrap">
                                                <input id="two">
                                                <label for="two">$</label>
                                            </div>
                                        </div>
                                        <div class="price-field">
                                            <input name="min" type="range"
                                                min="{{ DB::table('plants')->orderBy('price', 'ASC')->pluck('price')->first() }}"
                                                max="{{ DB::table('plants')->orderBy('price', 'DESC')->pluck('price')->first() }}"
                                                value="{{ DB::table('plants')->orderBy('price', 'ASC')->pluck('price')->first() }}"
                                                id="lower">
                                            <input name="max" type="range"
                                                min="{{ DB::table('plants')->orderBy('price', 'ASC')->pluck('price')->first() }}"
                                                max="{{ DB::table('plants')->orderBy('price', 'DESC')->pluck('price')->first() }}"
                                                value="{{ DB::table('plants')->orderBy('price', 'DESC')->pluck('price')->first() }}"
                                                id="upper">
                                        </div>
                                        <div class="d-flex justify-content-center">
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
                            <p>Product</p>
                        </a>

                        <div class="container">
                            {{-- <div class="d-flex justify-content-center mt-3"> --}}

                            <div class="wrapperProduct row">

                                @if (count($data) != 0 && !empty($data))
                                    @foreach ($data as $item)
                                        @php
                                            $thumb = json_decode($item->thumb, true);
                                        @endphp

                                        <div class="col-6 col-lg-4">
                                            <a href="{{ route('detail-plant', ['id' => $item->id]) }}"
                                                class="product">
                                                <div class="imagesProduct">
                                                    <img src="{{ url('thumbPlant/' . $thumb[0]) }}" alt="">
                                                </div>
                                                <div class="infoProduct">
                                                    <p class="nameProduct">{{ $item->name }}</p>
                                                    <p class="price">${{ $item->price }}</p>
                                                    <p class="rating">
                                                        <img src="{{ url('assets_user/img/icon/star_icon.svg') }}"
                                                            alt="">
                                                        {{ (int) DB::table('comments')->where('plant_id', $item->id)->avg('rate') }}
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach


                                    <div class="d-flex justify-content-end">
                                        {{ $data->links() }}
                                    </div>
                                @else
                                    <div class="container">
                                        {{-- <div class="d-flex justify-content-center mt-3"> --}}
                                        <img class="w-100" src="{{ url('assets_user/img/empaty state.png') }}"
                                            alt="">
                                        {{-- </div> --}}
                                    </div>
                                @endif

                            </div>
                            {{-- </div> --}}
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
                <img src="{{ url('assets_user/img/icon/pin (1).png') }}" alt="" >
                <span class="footer__contact-text">Curug Mekar - Bogor Barat, Bogor, Jawa Barat</span>
              </div>
            </div>
          </div>
        </div>
    </footer>
    @endsection


    @section('js')
        <script>
            //Filter Price
            var lowerSlider = document.querySelector('#lower');
            var upperSlider = document.querySelector('#upper');

            document.querySelector('#two').value = upperSlider.value;
            document.querySelector('#one').value = lowerSlider.value;

            var lowerVal = parseInt(lowerSlider.value);
            var upperVal = parseInt(upperSlider.value);

            upperSlider.oninput = function() {
                lowerVal = parseInt(lowerSlider.value);
                upperVal = parseInt(upperSlider.value);

                if (upperVal < lowerVal + 4) {
                    lowerSlider.value = upperVal - 4;
                    if (lowerVal == lowerSlider.min) {
                        upperSlider.value = 4;
                    }
                }
                document.querySelector('#two').value = this.value
            };

            lowerSlider.oninput = function() {
                lowerVal = parseInt(lowerSlider.value);
                upperVal = parseInt(upperSlider.value);
                if (lowerVal > upperVal - 4) {
                    upperSlider.value = lowerVal + 4;
                    if (upperVal == upperSlider.max) {
                        lowerSlider.value = parseInt(upperSlider.max) - 4;
                    }
                }
                document.querySelector('#one').value = this.value
            };
        </script>

        {{-- @if (isset($_GET['page']))
            <script>
                $('ul.pagination li').hide().filter(':lt(1), :nth-child(2),:nth-child(3),:nth-last-child(1)').show();
            </script>
        @else
            <script>
                $('ul.pagination li').hide().filter(':lt(1), :nth-child(2),:nth-child(3),:nth-last-child(1)').show();
            </script>
        @endif --}}
    @endsection
