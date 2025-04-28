@extends('layouts.admin')



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
    <li class="list-menu active">
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
    <div class="contentMain">
        <h2 class="pageNameContent">Manage User</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
            <li class="breadcrumb-item active">Manage User</li>
        </ol>
        <ul class="nav nav-pills mb-3 tabsMenu" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-user-tab" data-bs-toggle="pill" data-bs-target="#allUserTab"
                    type="button" role="tab" aria-controls="allUserTab" aria-selected="true">All User</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="approved-tab-user" data-bs-toggle="pill" data-bs-target="#approvedTab"
                    type="button" role="tab" aria-controls="approvedTab" aria-selected="false">Approval User
                    Register</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="allUserTab" role="tabpanel" aria-labelledby="all-user-tab">

                <div class="wrapperTable table-responsive">
                    <table id="manageUserTable" class="tables" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Count Request</th>
                                <th>Paid</th>
                                <th>Not Paid</th>
                                <th>Date Verification</th>
                                <th>Number Phone</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($allUser as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <div class="detailName">
                                            <p class="name">{{ $item->name }}</p>
                                        </div>
                                    </td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ DB::table('pengajuan')->where('user_id', $item->id)->count() }}</td>
                                    <td>Rp.{{ DB::table('pengajuan')->where('user_id', $item->id)->where('status', '>=', 5)->sum('jumlah_pembayaran') }}
                                    </td>
                                    <td>Rp.{{ DB::table('pengajuan')->where('user_id', $item->id)->where('status', '<', 5)->sum('jumlah_pembayaran') }}
                                    </td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <a href="https://wa.me/62{{ $item->phone }}"
                                            style="text-decoration: none">{{ $item->phone }} </a>
                                    </td>
                                    <td>
                                        <div class="buttonAction">
                                            @if ($item->confirmed)
                                                <button class="buttons success text-white">
                                                    Approved
                                                </button>
                                            @else
                                                <button class="btn btn-warning text-white">
                                                    Waiting
                                                </button>
                                            @endif
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="tab-pane fade" id="approvedTab" role="tabpanel" aria-labelledby="approved-tab-user">

                <div class="wrapperTable table-responsive">
                    <table id="approvalUser" class="tables" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Number Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usNonApprove as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <div class="detailName">
                                            <p class="name">{{ $item->name }}</p>
                                        </div>
                                    </td>
                                    <td>{{ $item->email }}</td>
                                    <td><a href="https://wa.me/{{ $item->phone }}"
                                            style="text-decoration: none">{{ $item->phone }} </a></td>
                                    <td>

                                        <div class="buttonAction">
                                            <form action="{{ route('approve', ['id' => $item->id]) }}" method="post">
                                                @csrf
                                                <button class="buttons success">
                                                    <img src="{{ url('assets/img/approveIcon.svg') }}" alt="">
                                                </button>
                                            </form>



                                            <button class="buttons danger">
                                                <img src="{{ url('assets/img/close_icon.svg') }}" alt="">
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
@endsection



@section('js')
    <script>
        $(document).ready(function() {
            $('#manageUserTable').DataTable({
                "info": false,
                "bSort": false,
            });
        });

        $(document).ready(function() {
            $('#approvalUser').DataTable({
                "info": false,
                "bSort": false,
            });
        });
    </script>
@endsection
