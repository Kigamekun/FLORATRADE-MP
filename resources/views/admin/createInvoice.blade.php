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
    <li class="list-menu">
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
        <h2 class="pageNameContent">Create Invoice</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Create Invoice</li>
        </ol>
        <div class="card p-5">

        <form action="{{ route('admin.invoice.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="" class="form-label">Nama Penerima</label>
                <input type="text" name="nama_penerima" id="nama_penerima" class="form-control">

            </div>
            <br>
            <div class="form-group">
                <label for="" class="form-label">Alamat Penerima</label>
                <input type="text" name="alamat_penerima" id="alamat_penerima" class="form-control">
            </div>
            <br>
            <div class="form-group">
                <label for="" class="form-label">Email Penerima</label>
                <input type="text" name="email_penerima" id="email_penerima" class="form-control">
            </div>
            <br>
            <div class="form-group">
                <label for="" class="form-label">Negara Tujuan</label>
                <input type="text" name="negara_tujuan" id="negara_tujuan" class="form-control">
            </div>
            <br>
            <div class="form-group">
                <label for="" class="form-label">Provinsi Tujuan</label>
                <input type="text" name="provinsi_tujuan" id="provinsi_tujuan" class="form-control">
            </div>
            <br>

            <div class="form-group">
                <label for="" class="form-label">Kota Tujuan</label>
                <input type="text" name="kota_tujuan" id="kota_tujuan" class="form-control">
            </div>
            <br>

            <div class="form-group">
                <label for="" class="form-label">Zipcode</label>
                <input type="text" name="zipcode" id="zipcode" class="form-control">
            </div>
            <br>


            <div class="form-group">
                <label for="" class="form-label">Currency</label>
                <input type="text" name="currency" id="currency" class="form-control">
            </div>

            <br>


            <div class="row">
                <div class="col-12 col-lg-4">
                    <select name="plants[]" id="" class='form-select mb-2'>
                        @foreach (DB::table('plants')->get() as $plant)
                            <option value="{{ $plant->id }}">{{ $plant->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-lg-4">
                    <input type="number" name="qty[]" placeholder="Masukan Jumlah" class="form-control mb-2">
                </div>
                <div class="col-12 col-lg-4">
                    <input type="number" name="price[]" placeholder="Masukan Harga" class="form-control mb-2">
                </div>
            </div>

            <div id="plants-area" class="row">

            </div>
            <div class="d-flex justify-content-end mt-2">
                <button class="btn btn-primary" type="button" onclick="addTanaman()">
                    +
                </button>
            </div>
            <div class="d-flex justify-content-end mt-2">
                <button class="btn btn-primary">
                    Submit
                </button>
            </div>

        </form>
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
        function addTanaman(params) {
            var html = `
                <div class="col-12 col-lg-4">
                    <select name="plants[]" id="" class="form-select mb-2">
                    @foreach (DB::table('plants')->get() as $plant)
                        <option value="{{ $plant->id }}">{{ $plant->name }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="col-12 col-lg-4">
                    <input type="number" name="qty[]" placeholder="Masukan Jumlah" id="" class="mb-2 form-control">
                </div>
                <div class="col-12 col-lg-4">
                    <input type="number" name="price[]" id="" placeholder="Masukan Harga" class="mb-2 form-control">
                </div>
                `;
            $('#plants-area').append(html);
        }

    </script>

@endsection
