@extends('layouts.base')



@section('menu')
    <div class="sidebar-menu-wrapper">
        <li class="listMenuName">
            <p>Admin Menu</p>
        </li>
        <li class="list-menu active">
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
        <h2 class="pageNameContent">Dashboard</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active"></li>
        </ol>
    </div>
@endsection
