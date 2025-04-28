@extends('layouts.base')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer">

    <style>

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

    <li class="list-menu active">
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
            <ion-icon name="person"></ion-icon>
        </div>
        <a href="{{ route('admin.user.index') }}" class="sidebar-menu">Manage User</a>
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
        <h2 class="pageNameContent">Manage Transaction</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Manage Transaction</li>
        </ol>

        <div class="wrapperTable table-responsive">

            {{-- <div class="d-flex justify-content-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createData">
                    Create Transaction

                </button>

            </div> --}}
            <br>
            <table id="orderTable" class="tables" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Transaction Code</th>
                        <th>Date</th>
                        <th>Total Price</th>
                        <th>Discount</th>
                        <th>Real Price</th>
                        <th>User Id</th>
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
                            <td>{{ $item->discount }}%</td>
                            <td>${{ $item->total_price_after_disc }}</td>
                            <td>{{ $item->user_id }}</td>
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
                                            data-url="{{ route('admin.order.addResi', ['id' => $item->id]) }}">
                                            <img width="20" height="20"
                                                src="{{ url('assets/img/file-tray-full-outline 1.svg') }}" alt="">
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#shipModal" data-id="{{ $item->id }}"
                                            data-file="{{ $item->file_resi }}" data-no="{{ $item->no_resi }}"
                                            data-url="{{ route('admin.order.addResi', ['id' => $item->id]) }}">
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
                                @if ($item->payment_method == 1)
                                    @if ($item->status == 0)
                                        <a class="btn btn-primary mb-1"
                                        href="{{ route('admin.order.approve', ['id' => $item->id]) }}">
                                        <ion-icon name="checkmark-done-outline"></ion-icon>
                                        </a>
                                    @endif
                                    @if (!is_null($item->manual_file))
                                        <a class="btn btn-primary mb-1"
                                            href="{{ route('admin.order.download', ['id' => $item->id]) }}">
                                            <ion-icon name="download-outline"></ion-icon>
                                        </a>
                                    @else
                                        <button class="btn btn-danger mb-1" disabled>
                                            <ion-icon name="download-outline"></ion-icon>
                                        </button>
                                    @endif
                                @endif
                                <button type="button" class="btn btn-info mb-1" data-bs-toggle="modal"
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
                                    @else
                                        {{ 'STRIPE' }} @endif
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
                                <a class="btn btn-danger" href="{{ route('admin.order.delete', ['id' => $item->id]) }}">
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




    <!-- Modal -->
    <div class="modal fade" id="detailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog" id="updateDialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Plant</h5>
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
    <div class="modal fade" id="createData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="createDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div id="modal-content" class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Create Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.order.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="user_id">User ID</label>
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="" selected>Pilih User</option>
                                @foreach (DB::table('users')->get() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="mb-3">
                            <label for="total_price">Total Price</label>
                            <input type="text" class="form-control" id="total_price" name="total_price"
                                placeholder="Total Price" required>
                        </div>

                        <div class="mb-3">
                            <label for="date">Date</label>
                            <input type="text" class="form-control" id="date" name="date" placeholder="Date" required>
                        </div>

                        <div class="mb-3">
                            <label for="currency">Currency</label>
                            <input type="text" class="form-control" id="currency" name="currency" placeholder="Currency"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="total_price_after_disc">Total Price After Discount</label>
                            <input type="text" class="form-control" id="total_price_after_disc"
                                name="total_price_after_disc" placeholder="Total Price After Discount" required>
                        </div>


                        <div class="mb-3">
                            <label for="discount_code">Discount Code</label>
                            <input type="text" class="form-control" id="discount_code" name="discount_code"
                                placeholder="Discount Code" required>
                        </div>

                        <div class="mb-3">
                            <label for="discount">Discount</label>
                            <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount"
                                required>

                        </div>

                        <div class="mb-3">
                            <label for="tax">Tax</label>
                            <input type="text" class="form-control" id="tax" name="tax" placeholder="Tax" required>

                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="nama_penerima">Nama Penerima</label>
                            <input type="text" class="form-control" id="nama_penerima" name="nama_penerima"
                                placeholder="Nama Penerima" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="alamat_penerima">Alamat Penerima</label>
                            <input type="text" class="form-control" id="alamat_penerima" name="alamat_penerima"
                                placeholder="Alamat Penerima" required>

                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="email_penerima">Email Penerima</label>
                            <input type="text" class="form-control" id="email_penerima" name="email_penerima"
                                placeholder="Email Penerima" required>

                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="negara_tujuan">Negara Tujuan</label>
                            <input type="text" class="form-control" id="negara_tujuan" name="negara_tujuan"
                                placeholder="Negara Tujuan" required>

                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="provinsi_tujuan">Provinsi Tujuan</label>
                            <input type="text" class="form-control" id="provinsi_tujuan" name="provinsi_tujuan"
                                placeholder="Provinsi Tujuan" required>

                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="kota_tujuan">Kota Tujuan</label>
                            <input type="text" class="form-control" id="kota_tujuan" name="kota_tujuan"
                                placeholder="Kota Tujuan" required>

                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="zipcode">Zipcode</label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Zipcode"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="payment_method">Payment Method</label>
                            <select class="form-control" id="payment_method" name="payment_method" required>
                                <option value="">Payment Method</option>
                                <option value="PAYPAL">PAYPAL</option>
                                <option value="MANUAL">MANUAL</option>
                                <option value="STRIPE">STRIPE</option>

                            </select>

                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="manual_file">Manual File</label>
                            <input type="text" class="form-control" id="manual_file" name="manual_file"
                                placeholder="Manual File" required>

                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="shipping_method">Shipping Method</label>
                            <select class="form-select" id="ship" name="ship" aria-label="Default select example">
                                <option selected>Select A Shipping Method</option>
                                @foreach (DB::table('shipping_fees')->orderBy('count', 'ASC')->get()
        as $item)
                                    <option value="{{ $item->ship_method . '-' . $item->price }}">
                                        {{ $item->ship_method . '-$' . $item->price }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="shipping_price">Shipping Price</label>
                            <input type="text" class="form-control" id="shipping_price" name="shipping_price"
                                placeholder="Shipping Price" required>

                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="no_resi">No Resi</label>
                            <input type="text" class="form-control" id="no_resi" name="no_resi" placeholder="No Resi"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="file_resi">File Resi</label>
                            <input type="text" class="form-control" id="file_resi" name="file_resi"
                                placeholder="File Resi" required>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                </form>
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
        $('#updateData').on('shown.bs.modal', function(e) {
            var html = `
            <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="code" class="form-label">code</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="isi code " value="${$(e.relatedTarget).data('code')}">
                    </div>

                    <div class="mb-3">
                        <label for="disc" class="form-label">disc</label>
                        <input type="text" class="form-control" id="disc" name="disc" placeholder="isi disc " value="${$(e.relatedTarget).data('disc')}"
                        >
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


        $('#detailModal').on('shown.bs.modal', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.order.detailOrder') }}",
                method: "POST",
                data: {
                    id: $(e.relatedTarget).data('id'),
                },
                success: function(data) {
                    var listItem = '';
                    data.forEach(element => {
                        listItem += `<div class="item">
                                <div class="images-item">
                                    <img src="${element.thumb}">
                                </div>
                                <div class="detail-item">
                                    <h5>${element.nama}</h5>
                                    <h6>$${element.price} x ${element.qty} : $${element.total}</h6>
                                </div>
                            </div>`;
                    })

                    var html = `
                        <div class="wrapper-item">
                                ${listItem}
                        </div>
                    `;
                    $('#modal-detail').html(html);

                },
                error: function(data) {
                    console.log(data);
                }
            });
        });


        $('#shipModal').on('shown.bs.modal', function(e) {
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
            </form>`;

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
                url: "{{ route('admin.order.changeStatus') }}",
                method: "POST",
                data: {
                    status: $(this).val(),
                    id: $(this).data('id'),
                },
                success: function(data) {
                    if (data.data.status == 3) {
                        if (data.data.no_resi == null) {
                            var html = `
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#shipModal" data-id="${data.id}"
                                data-file="" data-no="" data-url="/admin/order/addResi/${data.id}">
                                <img width="20" height="20" src="{{ url('assets/img/file-tray-outline 1.svg') }}" alt="">
                            </button>
                            `;
                        } else {
                            var html = `
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#shipModal" data-id="${data.id}"
                                data-file="${data.data.file_resi}" data-url="/admin/order/addResi/${data.id}" data-no="${data.data.no_resi}">
                                <img width="20" height="20" src="{{ url('assets/img/file-tray-outline 1.svg') }}" alt="">
                            </button>
                            `;
                        }
                        $('#act-' + data.id).html(
                            html
                        );
                    }
                },
                error: function(data) {
                    console.log(data);


                }

            });
        });
    </script>
@endsection
