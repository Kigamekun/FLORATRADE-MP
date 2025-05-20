@extends('layouts.base_user')


@section('css')
    <link rel="stylesheet" href="{{ url('assets_user/css/detailProduct.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection

@section('content')
    <div id="mainContent">
        <div class="container">
            <div class="row first-line">
                <div class="col-12 col-lg-8 col-xl-9">
                    <div class="card">
                        <div class="wrapperDetailProduct row">
                            <div class="col-12 col-lg-5">
                                <div class="wrapper-image-product">
                                    <div class="view-Images">
                                        @php
                                            $thumb = json_decode($data->thumb, true);
                                        @endphp

                                        @if (!is_null($thumb))
                                            @foreach ($thumb as $item)
                                                <div class="images-product">
                                                    <img src="{{ url('thumbPlant/' . $item) }}" alt="">
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                    <div class="nav-images">
                                        @if (!is_null($thumb))
                                            @foreach ($thumb as $item)
                                                <div class="images-nav">
                                                    <img src="{{ url('thumbPlant/' . $item) }}" alt="">
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-7">
                                <div class="wrapper-detail-product">
                                    <h1 class="name-product">{{ $data->name }}</h1>
                                    <div class="wrapper-rating">
                                        <div class="data-terjual">
                                            <p>Terjual</p>
                                            <span>{{ DB::table('carts')->where('plant_id',$data->id)->where('order_id','!=',NULL)->sum('qty') }}</span>
                                        </div>
                                        <div class="rating-product">
                                            <div class="icon">
                                                <img src="{{ url('assets_user/img/icon/star_icon.svg') }}" alt="">
                                            </div>
                                            <p> {{ (int) DB::table('comments')->where('plant_id', $data->id)->avg('rate') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="price-product">
                                        <p>${{ $data->price }}<span>/Plant</span></p>
                                    </div>
                                    <div class="wrapper-quantity-product">
                                        <p>Your Quantity Order</p>
                                        <div class="quantity-product">
                                            <button class="quantity-count quantity-count--minus" data-action="minus"
                                                type="button">-</button>
                                            <input id="product-qty" class="product-quantity" type="number"
                                                name="product-quantity" min="0" max="9999999" value="1">
                                            <button class="quantity-count quantity-count--add" data-action="add"
                                                type="button">+</button>
                                        </div>
                                        <p class="info">Min. order : 1 Plant</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="descripsi-product">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-detail-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-detail" type="button" role="tab" aria-controls="nav-detail"
                                    aria-selected="true">Detail</button>
                                <button class="nav-link" id="nav-shipping-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-shipping" type="button" role="tab" aria-controls="nav-shipping"
                                    aria-selected="false">Shipping</button>
                                <button class="nav-link" id="nav-revi1ew-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-review" type="button" role="tab" aria-controls="nav-review"
                                    aria-selected="false">Review</button>
                            </div>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-detail" role="tabpanel"
                                    aria-labelledby="nav-detail-tab">
                                    <p>Plant Name : <span class="primary-text">{{ $data->name }}</span></p>
                                    <p>Varietas Name : <span
                                            class="primary-text">{{ DB::table('base_plants')->where('id', $data->category_id)->first()->name_latin }}</span>
                                    </p>
                                    <div class="desc-section">
                                        <p>Description :</p>
                                        <p class="text-desc">
                                            {{ $data->description }}
                                        </p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-shipping" role="tabpanel"
                                    aria-labelledby="nav-shipping-ta1b">

                                    <div class="d-flex">
                                        <img class="img-icons" src="{{ url('assets_user/img/icon/pin (2).png') }}"
                                            alt="">
                                        <p class="text-desc">Send from <span class="fw-normal">Indonesia</span>
                                        </p>
                                    </div>

                                    <div class="d-flex mt-3">
                                        <img class="img-icons" src="{{ url('assets_user/img/icon/airplane.png') }}"
                                            alt="">
                                        <p class="text-desc">Delivery by<span class="fw-normal"> Plane</span></p>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="nav-review" role="tabpanel"
                                    aria-labelledby="nav-review-tab">

                                    <div class="d-flex review">
                                        @foreach (DB::table('comments')->where('plant_id', $data->id)->get() as $item)
                                            <div class="account d-flex align-items-center">
                                                <img class="img-icon-profile"
                                                    src="{{ url('assets_user/img/icon/profile_icon.svg') }}" alt="">
                                                <h6 class="ms-2">{{ DB::table('users')->where('id', $item->user_id)->first()->name }}
                                                </h6>
                                            </div>
                                            <div class="comment ms-3">
                                                <div class="star d-flex">
                                                    @for ($i = 0; $i < $item->rate; $i++)
                                                        <div class="icon">
                                                            <img src="{{ url('assets_user/img/icon/star_icon.svg') }}"
                                                                alt="">
                                                        </div>
                                                    @endfor
                                                </div>
                                                <div class="desc">
                                                    <p class="text-desc">
                                                        {{ $item->comment }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{-- <hr> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-3">
                    <div class="wrapper-summary">
                        <div class="card">
                            <h4>Summary</h4>
                            <div class="detail-summary">
                                <div class="total-order">
                                    <p>Your Order</p>
                                    <p><span id="sum-order">


                                            1
                                            {{-- @php
                                                $haveCount = false;
                                            @endphp
                                            @if (Auth::check())
                                            @else
                                                @foreach ($cart as $item)
                                                    @if ($item->plant_id == $data->id)
                                                        {{ $item->qty }}

                                                        @php
                                                            $haveCount = true;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @if (!$haveCount)
                                                    {{ 0 }}
                                                @endif
                                            @endif --}}

                                        </span> Plant</p>
                                </div>
                                <div class="total-price">
                                    <p>Price</p>
                                    <p>$ <span id="sum-price">
                                            {{-- @if (Auth::check())
                                        @else
                                            @foreach ($cart as $item)
                                                @if ($item->plant_id == $data->id)
                                                    {{ $item->total }}

                                                    @php
                                                        $haveCount = true;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if (!$haveCount)
                                                {{ 0 }}
                                            @endif
                                        @endif --}}


                                            {{ $data->price }}
                                        </span></p>
                                </div>
                            </div>
                            {{-- <form action="{{ route('add-to-cart', ['id' => $data->id]) }}" method="post">
                                @csrf --}}
                            <button data-url="{{ route('add-to-cart', ['id' => $data->id]) }}" id="add-to-cart"
                                class="button button-primary w-100">
                                <img src="{{ url('assets_user/img/icon/shopping-cart-white.svg') }}" alt="">
                                Add To Cart
                            </button>
                            {{-- </form> --}}
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
                <img src="{{ url('assets_user/img/icon/pin (1).png') }}" alt="" >
                <span class="footer__contact-text">Curug Mekar - Bogor Barat, Bogor, Jawa Barat</span>
              </div>
            </div>
          </div>
        </div>
    </footer>
@endsection



@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#add-to-cart").click(function() {
            console.log('clicked');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: $(this).attr('data-url'),
                method: "POST",
                data: {

                    qty: $("#product-qty").val()

                },
                success: function(data) {
                    // console.log('success');
                    // console.log(data);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Item has been added to your cart',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    $('#sum-order').html("1");
                    $('#product-qty').val(1);
                    $('#sum-price').html(@json($data->price));

                    $.ajax({
                        url: "{{ route('count-cart') }}",
                        method: "GET",

                        success: function(data) {
                            console.log(data);
                            $('#count-cart').html(data.count);
                        },
                        error: function(data) {
                            // console.log(data);
                        }

                    });

                },
                error: function(data) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Item failed added to your cart',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }

            });
        });
    </script>
    <script>
        $('.view-Images').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: false,
            adaptiveHeight: true,
            infinite: false,
            useTransform: true,
            speed: 400,
            asNavFor: '.nav-images',
            cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
        });

        $('.nav-images')
            .on('init', function(event, slick) {
                $('.nav-images .slick-slide.slick-current').addClass('is-active');
            })
            .slick({
                slidesToShow: 5,
                slidesToScroll: 5,
                dots: false,
                focusOnSelect: false,
                infinite: false,
                asNavFor: '.view-Images',
            });

        $('.view-Images').on('afterChange', function(event, slick, currentSlide) {
            $('.nav-images').slick('slickGoTo', currentSlide);
            var currrentNavSlideElem = '.nav-images .slick-slide[data-slick-index="' + currentSlide + '"]';
            $('.nav-images .slick-slide.is-active').removeClass('is-active');
            $(currrentNavSlideElem).addClass('is-active');
        });

        $('.nav-images').on('click', '.slick-slide', function(event) {
            event.preventDefault();
            var goToSingleSlide = $(this).data('slick-index');

            $('.view-Images').slick('slickGoTo', goToSingleSlide);
        });
    </script>

    <!--Quantity Input-->
    <script>
        var QtyInput = (function() {
            var $qtyInputs = $(".quantity-product");

            if (!$qtyInputs.length) {
                return;
            }

            var $inputs = $qtyInputs.find(".product-quantity");
            var $countBtn = $qtyInputs.find(".quantity-count");
            var qtyMin = parseInt($inputs.attr("min"));
            var qtyMax = parseInt($inputs.attr("max"));

            $inputs.change(function() {
                var $this = $(this);
                var $minusBtn = $this.siblings(".quantity-count--minus");
                var $addBtn = $this.siblings(".quantity-count--add");
                var qty = parseInt($this.val());

                if (isNaN(qty) || qty <= qtyMin) {
                    $this.val(qtyMin);
                    $minusBtn.attr("disabled", true);
                } else {
                    $minusBtn.attr("disabled", false);

                    if (qty >= qtyMax) {
                        $this.val(qtyMax);
                        $addBtn.attr('disabled', true);
                    } else {
                        $this.val(qty);
                        $addBtn.attr('disabled', false);
                    }
                }
            });

            $countBtn.click(function() {
                var operator = this.dataset.action;
                var $this = $(this);
                var $input = $this.siblings(".product-quantity");
                var qty = parseInt($input.val());

                if (operator == "add") {
                    qty += 1;
                    if (qty >= qtyMin + 1) {
                        $this.siblings(".quantity-count--minus").attr("disabled", false);
                    }

                    if (qty >= qtyMax) {
                        $this.attr("disabled", true);
                    }
                } else {
                    qty = qty <= qtyMin ? qtyMin : (qty -= 1);

                    if (qty == qtyMin) {
                        $this.attr("disabled", true);
                    }

                    if (qty < qtyMax) {
                        $this.siblings(".quantity-count--add").attr("disabled", false);
                    }
                }

                $input.val(qty);
                $('#sum-order').html(qty);
                $('#sum-price').html(@json($data->price) * qty);
            });
        })();
    </script>
@endsection
