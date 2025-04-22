@extends('layouts.base')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
@endsection



@section('menu')
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
            <ion-icon name="cash"></ion-icon>
        </div>
        <a href="{{ route('admin.pricing.index') }}" class="sidebar-menu">Manage Pricing</a>
    </li>
    <li class="list-menu">
        <div class="icon">
            <ion-icon name="easel"></ion-icon>
        </div>
        <a href="{{ route('admin.banner.index') }}" class="sidebar-menu">Manage Banner</a>
    </li>
    <li class="list-menu">
        <div class="icon">
            <ion-icon name="reader"></ion-icon>
        </div>
        <a href="{{ route('admin.terms.index') }}" class="sidebar-menu">Manage Terms</a>
    </li>
    <li class="list-menu">
        <div class="icon">
            <ion-icon name="person"></ion-icon>
        </div>
        <a href="{{ route('admin.user.index') }}" class="sidebar-menu">Manage User</a>
    </li>
    <li class="list-menu active">
        <div class="icon">
            <ion-icon name="receipt"></ion-icon>
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
        <h2 class="pageNameContent">Manage Invoice</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Manage Invoice</li>
        </ol>

        <div class="wrapperTable table-responsive">

            <div class="d-flex justify-content-end">
                <a class="btn btn-primary" href="{{ route('admin.invoice.create') }}">
                    Create Invoice

                </a>

            </div>
            <br>
            <table id="orderTable" class="tables" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Transaction Code</th>
                        <th>Date</th>
                        <th>Total Price</th>
                        <th>Payment</th>
                        <th></th>
                        <th>Action</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @php
                        $status = [];
                        $status[0] = 'Waiting Approval';
                        $status[1] = 'Order Processed';
                        $status[2] = 'Quarantine Processed';
                        $status[3] = 'Order Shipping';
                        $status[4] = 'Shipped';
                        $status[5] = 'Done / Reviews';
                    @endphp
                    @foreach ($data as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->kode_transaksi }}</td>
                            <td>{{ $item->date }}</td>
                            <td>${{ $item->total_price }}</td>

                            <td>
                                @if ($item->payment_method == 1)
                                    {{ 'MANUAL TRANSFER' }}
                                @elseif($item->payment_method == 2)
                                    {{ 'PAYPAL' }}
                                @elseif($item->payment_method == 3)
                                    {{ 'STRIPE' }}
                                @else
                                    {{ '-' }}
                                @endif
                            </td>
                            <td id="act-{{ $item->id }}">
                                @if ($item->status == 3)
                                    @if ($item->no_resi != null && $item->no_resi != '')
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#shipModal" data-id="{{ $item->id }}"
                                            data-file="{{ $item->file_resi }}" data-no="{{ $item->no_resi }}"
                                            data-url="{{ route('admin.invoice.addResi', ['id' => $item->id]) }}">
                                            <img width="20" height="20"
                                                src="{{ url('assets/img/file-tray-full-outline 1.svg') }}" alt="">
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#shipModal" data-id="{{ $item->id }}"
                                            data-file="{{ $item->file_resi }}" data-no="{{ $item->no_resi }}"
                                            data-url="{{ route('admin.invoice.addResi', ['id' => $item->id]) }}">
                                            <img width="20" height="20"
                                                src="{{ url('assets/img/file-tray-outline 1.svg') }}" alt="">
                                        </button>
                                    @endif
                                @endif
                            </td>

                            <td>
                                <select name="status" class="form-control stts" data-id="{{ $item->id }}">
                                    @foreach ($status as $key => $st)
                                        @if ($item->status == 0)
                                            <option value="{{ $key }}" disabled>{{ $st }}</option>
                                        @else
                                            @if ($key == $item->status)
                                                <option value="{{ $key }}" selected>{{ $st }}</option>
                                            @else
                                                <option value="{{ $key }}">{{ $st }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </td>

                            <td style="width: 20%">
                                <button onclick="copyInvoiceLink(this);"
                                    data-url="{{ route('admin.invoice.shareInvoiceLink', ['id' => $item->id]) }}"
                                    type="button" class="btn btn-info">
                                    <ion-icon name="leaf-outline"></ion-icon>
                                </button>
                                @if ($item->payment_method == 1)
                                    @if ($item->status == 0)
                                        <a class="btn btn-primary"
                                            href="{{ route('admin.invoice.approve', ['id' => $item->id]) }}">
                                            <ion-icon name="checkmark-done-outline"></ion-icon>
                                        </a>
                                    @endif
                                    @if (!is_null($item->manual_file))
                                        <a class="btn btn-primary"
                                            href="{{ route('admin.invoice.download', ['id' => $item->id]) }}">
                                            <ion-icon name="download-outline"></ion-icon>
                                        </a>
                                    @else
                                        <button class="btn btn-danger" disabled>
                                            <ion-icon name="download-outline"></ion-icon>
                                        </button>
                                    @endif
                                @endif
                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="#detailModal" data-id="{{ $item->id }}">
                                    <ion-icon name="leaf-outline"></ion-icon>
                                </button>
                                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#updateData" data-user_id='{{ $item->user_id }}'
                                    data-kode_transaksi="{{ $item->kode_transaksi }}" data-date="{{ $item->date }}"
                                    data-total_price="{{ $item->total_price }}"
                                    data-total_price_after_disc="{{ $item->total_price_after_disc }}"
                                    data-status="{{ $item->status }}" data-payment_method="
                                        @if ($item->payment_method == 1) {{ 'MANUAL TRANSFER' }}
                                    @elseif($item->payment_method == 2)
                                        {{ 'PAYPAL' }}
                                    @elseif($item->payment_method == 3)
                                        {{ 'STRIPE' }}
                                    @else
                                        {{ '-' }} @endif
                                            " data-currency="{{ $item->currency }}"
                                    data-no_resi="{{ $item->no_resi ? $item->no_resi : 'No Resi Belum Tersedia.' }}"
                                    data-hasPaid="{{ $item->hasPaid }}" data-discount="{{ $item->discount }}"
                                    data-discount_code="{{ $item->discount_code }}"
                                    data-nama_penerima="{{ $item->nama_penerima }}"
                                    data-alamat_penerima="{{ $item->alamat_penerima }}"
                                    data-email_penerima="{{ $item->email_penerima }}"
                                    data-negara_tujuan="{{ $item->negara_tujuan }}"
                                    data-provinsi_tujuan="{{ $item->provinsi_tujuan }}"
                                    data-kota_tujuan="{{ $item->kota_tujuan }}" data-zipcode="{{ $item->zipcode }}">
                                    <ion-icon name="create-outline"></ion-icon>
                                </button> --}}
                                <a class="btn btn-danger" href="{{ route('admin.invoice.delete', ['id' => $item->id]) }}">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>






    <!-- Modal -->
    <div class="modal fade" id="updateData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="updateDataLabel" aria-hidden="true">
        <div class="modal-dialog" id="updateDialog">
            <div id="modal-content" class="modal-content">
                <div class="modal-body">
                    Loading..
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="shipModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="shipModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="updateDialog">
            <div id="ship-content" class="modal-content">
                <div class="modal-body">
                    Loading..
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="detailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="updateDialog">
            <div  class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Tanaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-detail">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>


@endsection


@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.dropify').dropify();
    </script>



    <script>
        $(document).ready(function() {
            $('#orderTable').DataTable({

            });
        });
    </script>

    <script>
        function copyInvoiceLink(e) {
            navigator.clipboard.writeText(e.getAttribute("data-url"));
            alert("Copied the text: " + e.getAttribute("data-url"));

        }
    </script>

    <script>
        $('#updateData').on('shown.bs.modal', function(e) {
            var html = `
            <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/user/update/${$(e.relatedTarget).data('id')}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                            <label for="name" class="form-label">name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="isi name " value="${$(e.relatedTarget).data('name')}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="isi email " value="${$(e.relatedTarget).data('email')}">
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="isi phone " value="${$(e.relatedTarget).data('phone')}">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="isi address " value="${$(e.relatedTarget).data('address')}">
                        </div>


                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="${$(e.relatedTarget).data('role')}">${$(e.relatedTarget).data('role') == 0 ? 'Admin' : 'Invoice'}</option>
                                <option value="0">Admin</option>
                                <option value="1">Invoice</option>
                            </select>
                        </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
`;

            $('#modal-content').html(html);
            $('.dropify').dropify();

        });
    </script>

<script>



    $('#detailModal').on('shown.bs.modal', function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('admin.invoice.detailOrder') }}",
            method: "POST",
            data: {
                id: $(e.relatedTarget).data('id'),
            },
            success: function(data) {
                var html = '<div class="card" style="width: 18rem;"><ul class="list-group list-group-flush">';

                    data.forEach(element => {
                        html +=  '<li class="list-group-item">'+element+'</li>';

                    });
                    html += ' </ul></div>';
                    $('#modal-detail').html(html);

            },
            error: function(data) {
                console.log(data);
            }
        });
    });


    $('#shipModal').on('shown.bs.modal', function(e) {
        console.log("masuk SHIP");
        var html = `
        <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Resi To Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="${$(e.relatedTarget).data('url')}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="code" class="form-label">No Resi</label>
                    <input type="text" class="form-control" id="no_resi" name="no_resi" placeholder="isi no_resi " value="${$(e.relatedTarget).data('no')}">
                </div>

                <br>
                <input type="file" name="file" data-default-file="/fileResi/${$(e.relatedTarget).data('file')}" id="file_resi" class="dropify">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
`;

        $('#ship-content').html(html);
        $('.dropify').dropify();

    });



    $('.stts').change(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('admin.invoice.changeStatus') }}",
            method: "POST",
            data: {
                status: $(this).val(),
                id: $(this).data('id'),
            },
            success: function(data) {
                // $('#status-' + data.id).html(
                //     '<span class="badge bg-' + data.bg + '">' + data.status + '</span>'
                // );
                if (data.data.status == 3) {

                    if (data.data.no_resi == null) {
                        var html = `
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#shipModal" data-id="${data.id}"
                            data-file="" data-no="">
                            <img width="20" height="20" src="{{ url('assets/img/file-tray-outline 1.svg') }}" alt="">
                        </button>
                        `;
                    } else {
                        var html = `
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#shipModal" data-id="${data.id}"
                            data-file="${data.data.file_resi}" data-no="${data.data.no_resi}">
                            <img width="20" height="20" src="{{ url('assets/img/file-tray-outline 1.svg') }}" alt="">
                        </button>
                        `;

                    }
                    $('#act-' + data.id).html(
                        html
                    );
                }

                // $.ajax({
                //     url: "/admin/sendNotif",
                //     method: "POST",
                //     data: {
                //         id: data.id,
                //     }
                // });
            },
            error: function(data) {
                console.log(data);


            }

        });
    });
</script>
@endsection
