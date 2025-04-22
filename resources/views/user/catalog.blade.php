@extends('layouts.base_user')

@section('css')
    <!--CSS Assets this page-->
    <link rel="stylesheet" href="{{ url('assets_user/css/moreExplorePlant.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <!--about,faq,terms CSS-->
    <link rel="stylesheet" href="{{ url('assets_user/css/about-faq.css') }}">

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
.form-select, .form-control {
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
</style>
@endsection

@section('content')
    <div id="mainContent">

        <div id="mainContent">
            <div class="banner-title">
                <h1 class="title">List Proce</h1>
                <div class="breadchumb-wrapper">
                    <a href="./main.html">Home</a>
                    <span>-</span>
                    <p>List Proce</p>
                </div>
            </div>
            <div class="wrapperCatalog container mt-5">
                <a href="#" class="header-line">
                    <img src="{{ url('assets_user/img/icon/product_icon.svg') }}" alt="">
                    <p>Price list</p>
                </a>
                <div class="alert alert-success alert-dismissible fade show w-100 my-4 d-flex flex-column align-items-start" role="alert">
                    <p><b>P>12</b> = wholesale price for purchases above 12 products</p>
                    <p><b>P>50</b> = wholesale price for purchases above 50 products</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="tableCatalog">

                    <div class="wrapperTable table-responsive">
                        <table id="catalogTable" class="tables" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    @foreach (DB::table('pricings')->orderBy('count','ASC')->get() as $item)
                                        <th scope="col">P > {{ $item->count }}</th>
                                    @endforeach
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data as $item)
                                    <tr>
                                        <td scope="row">{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->stock }}</td>
                                        <td>${{ $item->price }}</td>
                                        @foreach (DB::table('pricings')->orderBy('count','ASC')->get() as $pricing)
                                            <td>${{ $item->price - ($item->price * $pricing->value/100) }}</td>
                                        @endforeach

                                        <td>
                                            <a href="{{ route('detail-plant', ['id'=>$item->id]) }}" class="btn btn-primary">See Plant</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <footer>
        <div class="wrapperFooter container">
            <div class="about">
                <img src="{{ url('assets_user/img/Logo_Plantsasri 1 1.png') }}" alt="">
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
