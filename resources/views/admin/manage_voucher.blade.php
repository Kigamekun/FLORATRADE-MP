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

    <li class="list-menu active">
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
    <li class="list-menu">
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
        <h2 class="pageNameContent">Manage Voucher</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Manage Voucher</li>
        </ol>

        <div class="wrapperTable table-responsive">

            <div class="d-flex justify-content-end">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createData">
                    Create Voucher
                </button>

            </div>
            <br>
            <table id="voucherTable" class="tables" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Discount</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->disc }}%</td>
                            <td style="width: 20%">

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#updateData" data-id="{{ $item->id }}"
                                    data-code="{{ $item->code }}" data-disc="{{ $item->disc }}" data-url="{{ route('admin.voucher.update', ['id'=>$item->id]) }}">
                                    <img width="20" height="20" src="{{ url('assets/img/create-outline 1.svg') }}"
                                        alt="">
                                </button>
                                <a class="btn btn-danger"
                                    href="{{ route('admin.voucher.delete', ['id' => $item->id]) }}"><img width="20"
                                        height="20" src="{{ url('assets/img/trash-outline 1.svg') }}" alt=""></a>

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
    <div class="modal fade" id="createData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="createDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div id="modal-content" class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Buat Voucher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.voucher.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="code" class="form-label">Kode Voucher</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="Masukan code">
                        </div>

                        <div class="mb-3">
                            <label for="disc" class="form-label">Nominal Discount</label>
                            <input type="text" class="form-control" id="disc" name="disc" placeholder="Masukan jumlah discount">
                        </div>

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
            $('#voucherTable').DataTable({

            });
        });
    </script>


    <script>
        $('#updateData').on('shown.bs.modal', function(e) {
            var html = `
            <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Voucher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="${$(e.relatedTarget).data('url')}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="code" class="form-label">Kode Voucher</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="isi code " value="${$(e.relatedTarget).data('code')}">
                    </div>

                    <div class="mb-3">
                        <label for="disc" class="form-label">Nominal Discount</label>
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
    </script>
@endsection
