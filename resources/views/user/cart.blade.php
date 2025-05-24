@extends('layouts.base_user')


@section('css')
    <link rel="stylesheet" href="{{ url('assets_user/css/cart.css') }}">
@endsection

@section('content')
    <style>
        .text-disc {
            display: none;
        }

    </style>
    <div id="mainContent">
        <div class="container">
            <div class="row first-line">
                <div class="col-12 col-lg-8 col-xl-9">
                    <div class="card">
                        <h3>Your Cart</h3>
                        @if (!$authenticable)
                            <div class="alert alert-success" role="alert">
                                <div class="icon-alert">
                                    <img src="{{ url('assets_user/img/icon/alert-icon.svg') }}" alt="">
                                </div>
                                Hello, you are not logged in, please Sign In !
                            </div>
                        @endif
                        <div class="cart-container">
                            <div class="head-cart">
                                <div class="form-check checkbox-select">
                                    <input class="form-check-input checkbox-all"  id="select-all" type="checkbox" value=""
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Choose all
                                    </label>
                                </div>
                                <div class="delete-button delete-all">
                                    <a href="{{ route('delete-cart-all') }}"
                                        class="delete-cart-button text-decoration-none">
                                        <img src="{{ url('assets_user/img/icon/trash-delete-icon.svg') }}" alt="">
                                        Delete
                                    </a>
                                </div>
                            </div>
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
                                        <a href="{{ route('more') }}" class="button button-primary w-50 text-decoration-none mt-3">Start Shoping</a>
                                    </div>
                                    @else

                                @foreach ($data as $key => $item)
                                <div class="product-list">
                                    @php
                                        $plant = DB::table('plants')
                                            ->where('id', $item->plant_id)
                                            ->first();
                                    @endphp

                                    @php
                                    $thumb = json_decode($plant->thumb, true);
                                    @endphp
                                    <div class="form-check checkbox-select checkbox-item">
                                        <input class="form-check-input check-item" type="checkbox" data-price="{{ $plant->price * $item->qty }}" value="" data-item-id="@if(Auth::check()){{$item->id}}@else{{$key}}@endif" id="flexCheckDefault" checked>
                                    </div>
                                    <div class="product-detail">
                                        <div class="image-product">
                                            <img src="{{ url('thumbPlant/' . $thumb[0]) }}" alt="">
                                        </div>
                                        <div class="wrapper-info-product">
                                            <div class="name-price-product">

                                                @php
                                                    $total_cart += $plant->price * $item->qty;
                                                @endphp
                                                <h5>{{ $plant->name }}</h5>
                                                <p>$ <span
                                                        id="total-@if(Auth::check()){{$item->id}}@else{{$key}}@endif"
                                                        class="price">{{ $plant->price * $item->qty }}</span>
                                                </p>
                                            </div>
                                            <p class="price-per-plant">$ <span
                                                    class="price-plant">{{ $plant->price }}</span>/Plant</p>
                                            <div class="action-cart">
                                                <div class="quantity-product">
                                                    <button
                                                        data-id="@if(Auth::check()){{$item->id}}@else{{$key}}@endif"
                                                        class="de quantity-count quantity-count--minus"
                                                        data-action="minus" type="button" id="mins">-</button>

                                                    <input
                                                        id="qty-@if(Auth::check()){{$item->id}}@else{{$key}}@endif"
                                                        class="product-quantity" type="number" name="product-quantity"
                                                        min="1" max="10" value="{{ $item->qty }}">
                                                    <button
                                                        data-id="@if(Auth::check()){{ $item->id }}@else{{$key}}@endif"
                                                        class="in quantity-count quantity-count--add" data-action="add"
                                                        type="button">+</button>
                                                </div>

                                                @if (Auth::check())
                                                    <a href="{{ route('delete-cart', ['id' => $item->id]) }}"
                                                        class="delete-cart-button" style="text-decoration:none">
                                                    @else
                                                        <a href="{{ route('delete-cart', ['id' => $key]) }}"
                                                            class="delete-cart-button" style="text-decoration:none">
                                                @endif
                                                <img src="{{ url('assets_user/img/icon/trash-delete-icon.svg') }}"
                                                    alt="">
                                                Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                                    @endif
                                @else
                                    @if (empty($data))
                                    <div class="mt-5 d-flex align-items-center flex-column">
                                        <img src="{{ url('assets_user/img/state-cart.png') }}" alt="dafnafa">
                                        <h2 style="color: #535353;" class="mt-3">Yahh, your cart is empty</h2>
                                        <p style="color: #535353;" class="mt-1">Let's fill it with your favorite plant !</p>
                                        <button type="submit" class="button button-primary w-50 text-decoration-none mt-3">
                                            Start Shopping
                                        </button>
                                    </div>


                                    @else

                                @foreach ($data as $key => $item)
                                <div class="product-list">
                                    @php
                                        $plant = DB::table('plants')
                                            ->where('id', $item->plant_id)
                                            ->first();
                                    @endphp

                                    @php
                                    $thumb = json_decode($plant->thumb, true);
                                    @endphp
                                    <div class="form-check checkbox-select checkbox-item">
                                        <input class="form-check-input check-item" type="checkbox" data-price="{{ $plant->price * $item->qty }}" value="" data-item-id="@if(Auth::check()){{$item->id}}@else{{$key}}@endif" id="flexCheckDefault" checked>
                                    </div>
                                    <div class="product-detail">
                                        <div class="image-product">
                                            <img src="{{ url('thumbPlant/' . $thumb[0]) }}" alt="">
                                        </div>
                                        <div class="wrapper-info-product">
                                            <div class="name-price-product">

                                                @php
                                                    $total_cart += $plant->price * $item->qty;
                                                @endphp
                                                <h5>{{ $plant->name }}</h5>
                                                <p>$ <span
                                                        id="total-@if(Auth::check()){{$item->id}}@else{{$key}}@endif"
                                                        class="price">{{ $plant->price * $item->qty }}</span>
                                                </p>
                                            </div>
                                            <p class="price-per-plant">$ <span
                                                    class="price-plant">{{ $plant->price }}</span>/Plant</p>
                                            <div class="action-cart">
                                                <div class="quantity-product">
                                                    <button
                                                        data-id="@if(Auth::check()){{$item->id}}@else{{$key}}@endif"
                                                        class="de quantity-count quantity-count--minus"
                                                        data-action="minus" type="button" id="mins">-</button>

                                                    <input
                                                        id="qty-@if(Auth::check()){{$item->id}}@else{{$key}}@endif"
                                                        class="product-quantity" type="number" name="product-quantity"
                                                        min="1" max="10" value="{{ $item->qty }}">
                                                    <button
                                                        data-id="@if(Auth::check()){{ $item->id }}@else{{$key}}@endif"
                                                        class="in quantity-count quantity-count--add" data-action="add"
                                                        type="button">+</button>
                                                </div>

                                                @if (Auth::check())
                                                    <a href="{{ route('delete-cart', ['id' => $item->id]) }}"
                                                        class="delete-cart-button" style="text-decoration:none">
                                                    @else
                                                        <a href="{{ route('delete-cart', ['id' => $key]) }}"
                                                            class="delete-cart-button" style="text-decoration:none">
                                                @endif
                                                <img src="{{ url('assets_user/img/icon/trash-delete-icon.svg') }}"
                                                    alt="">
                                                Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                                    @endif

                                @endif


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-xl-3">

                    <form id="checkoutForm" action="{{ route('checkout') }}" method="post">
                        @csrf
                        <input type="hidden" name="subtotal" class="sub" id="total_cart"
                            value="{{ $total_cart }}">
                        <div class="wrapper-delivery">
                            <div class="card">
                                <h4>Delivery</h4>
                                <div class="promo-code">
                                    <div class="input-group">
                                        <input id="voucher-code"  name="voucher_code" type="text" class="form-control"
                                            placeholder="Enter promo code">
                                        <button id="button-promo" class="button button-outline-primary md-button"
                                            type="button">Apply</button>
                                    </div>
                                    <div id="alert-voucher">
                                    </div>
                                </div>
                                <div class="delivery-discount">
                                    <div class="subtotal">
                                        <p>Subtotal</p>
                                        <p>$ <span class="value sub">{{ $total_cart }}</span></p>
                                    </div>
                                    <div class="add-delivery-info">
                                        <div class="more-info">
                                            <p class="text-disc">Discount</p>
                                            <div id="val-disc" class="value-discount">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="total-fix">
                                    <p>Total</p>
                                    <p>$ <span class="value-total-fix sub" id="total-fix">{{ $total_cart }}</span></p>
                                </div>


                                @if ($authenticable)
                                    @if (!empty($data) && count($data) > 0)
                                    <button type="submit"
                                    class="button button-primary w-100 text-decoration-none">
                                    Checkout
                                    </button>
                                    @else
                                    <button type="submit"
                                    class="button button-primary w-100 text-decoration-none" disabled>
                                    Checkout
                                    </button>
                                    @endif
                                @else
                                    @if (!empty($data))
                                    <button type="submit"
                                    class="button button-primary w-100 text-decoration-none">
                                    Checkout
                                    </button>
                                    @else
                                    <button type="submit"
                                    class="button button-primary w-100 text-decoration-none" disabled>
                                    Checkout
                                    </button>
                                    @endif
                                @endif

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
    value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));

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
                        var html =
                            `<p class="disc-value-promo me-2">$<span class="value sub">${$('#total_cart').val()} </span> </p>
                            <p class="disc-value-promo"> - $<span class="value sub" id="value-has-disc">${data.disc_value}</span></p>`;
                        $('#val-disc').html(html);
                        $('.text-disc').css('display', 'block');
                        $('#total-fix').html(round(data.after_disc,2));
                    } else {
                        $('#val-disc').html('');
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
