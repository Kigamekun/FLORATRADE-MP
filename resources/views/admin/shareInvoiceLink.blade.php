@extends('layouts.base')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
@endsection



@section('menu')

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




</style>
<div class="sidebar-menu-wrapper">
    <li class="listMenuName">
        <p>Admin Menu</p>
    </li>
    <li class="list-menu ">
        <div class="icon">
            <ion-icon name="grid"></ion-icon>
        </div>
        <a href="/admin" class="sidebar-menu">Dashboard Admin</a>
    </li>
    <li class="list-menu ">
        <div class="icon">
            <ion-icon name="folder-open"></ion-icon>
        </div>
        <a href="{{ route('admin.plants.index') }}" class="sidebar-menu">Manage Marga (Plants)</a>
    </li>

    <li class="list-menu ">
        <div class="icon">
            <ion-icon name="leaf"></ion-icon>
        </div>
        <a href="{{ route('admin.plant.index') }}" class="sidebar-menu">Manage Plant</a>
    </li>

    <li class="list-menu ">
        <div class="icon">
            <ion-icon name="card"></ion-icon>
        </div>
        <a href="{{ route('admin.voucher.index') }}" class="sidebar-menu">Manage Voucher</a>
    </li>

    <li class="list-menu">
        <div class="icon">
            <ion-icon name="airplane"></ion-icon>
        </div>
        <a href="{{ route('admin.shipping.index') }}" class="sidebar-menu">Manage Shipping</a>
    </li>

    <li class="list-menu ">
        <div class="icon">
            <ion-icon name="cart"></ion-icon>
        </div>
        <a href="{{ route('admin.order.index') }}" class="sidebar-menu">Manage Transaction</a>
    </li>

    <li class="list-menu">
        <div class="icon">
            <ion-icon name="cart"></ion-icon>
        </div>
        <a href="{{ route('admin.pricing.index') }}" class="sidebar-menu">Manage Pricing</a>
    </li>
    <li class="list-menu">
        <div class="icon">
            <ion-icon name="cart"></ion-icon>
        </div>
        <a href="{{ route('admin.banner.index') }}" class="sidebar-menu">Manage Banner</a>
    </li>
    <li class="list-menu">
        <div class="icon">
            <ion-icon name="cart"></ion-icon>
        </div>
        <a href="{{ route('admin.terms.index') }}" class="sidebar-menu">Manage Terms</a>
    </li>
    <li class="list-menu">
        <div class="icon">
            <ion-icon name="cart"></ion-icon>
        </div>
        <a href="{{ route('admin.user.index') }}" class="sidebar-menu">Manage User</a>
    </li>
    <li class="list-menu active">
        <div class="icon">
            <ion-icon name="cart"></ion-icon>
        </div>
        <a href="{{ route('admin.invoice.index') }}" class="sidebar-menu">Manage Invoice</a>
    </li>
    <li class="list-menu">
        <div class="icon">
            <ion-icon name="receipt"></ion-icon>
        </div>
        <a href="{{ route('admin.faq.index') }}" class="sidebar-menu">Manage Faq</a>
    </li>
</div>
@endsection

@section('content')
    <style>
        .dropify-wrapper .dropify-message p {
            font-size: 14px;
        }

    </style>

    <div class="contentMain">
        <h2 class="pageNameContent">Pay Invoice</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Pay Invoice</li>
        </ol>

        @if ($data->hasPaid)
            <center>
            <div class="alert alert-primary" role="alert">
                <strong>Success</strong>
            </div>
            </center>
        @else
        <p id="ttlp" style="display: none;" data-total="{{ $data->total_price }}"
        class="bold-text">${{ $data->total_price }}</p>

        <center>
        <div class="card p-5">
            <center>
                <div id="paypal-button"></div>

            <button type="button" id="manualTrx" class="btn btn-primary mt-5" style="width: 250px"
                data-bs-toggle="modal" data-bs-target="#exampleModal">
                Manual Transaction
            </button>
            <br>
            {{-- <button type="button" id="xenditTrx" class="btn btn-primary mt-5" style="width: 250px">
                Xendit Transaction
            </button> --}}
            <button type="button" id="stripeTrx" class="btn btn-primary mt-5" style="width: 250px"
                data-bs-toggle="modal" data-bs-target="#stripeTransaction">
                Stripe Transaction
            </button>
            </center>
        </div>
        </center>

        @endif
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
                        <button data-id="{{ $item->id }}"
                            class="btn btn-outline-info w-100 mt-2 manual-transaction-button"> {{ $item->type_payment }}
                        </button>
                    @endforeach

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="stripeTransaction" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="stripeTransactionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stripeTransactionLabel">Stripe Payment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form role="form" action="{{ route('admin.invoice.stripePayment') }}" method="post" class="require-validation"
        data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
        id="payment-form">
        @csrf
        <div class="modal-body">

            <div class='form-row row'>
                <div class='col-xs-12 form-group required'>
                    <label class='control-label'>Name on Card</label> <input class='form-control'
                        size='4' type='text'>
                </div>
            </div>
            <br>
            <div class='form-row row'>
                <div class='col-xs-12 form-group card required'>
                    <label class='control-label'>Card Number</label> <input autocomplete='off'
                        class='form-control card-number' size='20' type='text'>
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


            <br>

            <div class='form-row row'>
                <div class='col-md-12 error form-group hide'>
                    <div class='alert-danger alert'>Please correct the errors and try
                        again.</div>
                </div>
            </div>




        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Understood</button>
        </div>
    </form>
    </div>
    </div>
</div>

@endsection




@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.dropify').dropify();
    </script>

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
                <h5 class="modal-title" id="exampleModalLabel">Transaction Manual</h5>
                <button type="button" id="close-bill" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <td>Total Bill</td>
                                <td>${$('#ttlp').text()}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        ${data[0]}
                    </div>
                </div>

                <form id="buy" action="{{ route('admin.invoice.manualPayment') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="manual_payment_id" name="manual_payment_id" value="${data[1]}">
                    <input type="file" id="file" name="file_payment">
                    <button  type="submit" class="btn btn-outline-success w-100">
                    Select Payment
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
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <td>Total Bill</td>
                                <td>${$('#ttlp').text()}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        ${data[0]}
                    </div>
                </div>

                <form id="buy" action="{{ route('admin.invoice.manualPayment') }}" method="POST" encytpe>
                    @csrf
                    <input type="hidden" id="manual_payment_id" name="manual_payment_id" value="${data[1]}">
                    <button  type="submit" class="btn btn-outline-success w-100">
                    Select Payment
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
                    <button data-id="{{ $item->id }}" class="btn btn-outline-info w-100 mt-2 manual-transaction-button">
                        {{ $item->type_payment }}
                    </button>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>`;

        $('#modal-manual-content').html(html);
    });
</script>


<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    paypal.Button.render({
        env: 'sandbox',
        style: {
            color: 'blue',
            shape: 'rect',
            label: 'paypal',
            size: 'medium'
        },

        payment: function(data, actions) {

            return actions.request.post("{{ route('admin.invoice.create_payment') }}", {
                _token: "{{ csrf_token() }}",
                id: @json($id)
            }).then(function(res) {
                return res.id;
        });
        },
        onCancel: function(data, actions) {

        },

        onError: function(err) {
            console.log('Paypal merchant got an error !');
            console.log(err);
        },
        // Execute the payment:
        // 1. Add an onAuthorize callback
        onAuthorize: function(data, actions) {

            return actions.request.post("{{ route('admin.invoice.execute_payment') }}", {
                    _token: "{{ csrf_token() }}",
                    paymentID: data.paymentID,
                    payerID: data.payerID,
                    id: @json($id),
                })
                .then(function(res) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Transaction has been successful !',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    locatin.reload();
                    // 3. Show the buyer a confirmation message.
                });
        }
    }, '#paypal-button');
</script>



<script type="text/javascript" src="https://js.stripe.com/v2/"></script>


<script type="text/javascript">
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

            var id = $("<input>").attr({
                    "type": "hidden",
                    "name": "id"
                }).val(@json($id));


                $form.append(id);

            $form.get(0).submit();
        }
    }
});
</script>



<script>
    $("#modal-manual-content").on('submit', '#buy', function() {
        var id = $("<input>").attr({
            "type": "hidden",
            "name": "id"
        }).val(@json($id));
        $(this).append(id);
        return true;
    });
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
@endsection
