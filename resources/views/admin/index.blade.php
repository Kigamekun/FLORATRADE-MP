@extends('layouts.base')


@section('menu')
    <div class="sidebar-menu-wrapper">
        <li class="listMenuName">
            <p>Admin Dashboard</p>
        </li>
        <li class="list-menu active">
            <div class="icon">
                <ion-icon name="grid"></ion-icon>
            </div>
            <a href="/admin" class="sidebar-menu">Dashboard</a>
        </li>
        <li class="list-menu">
            <div class="icon">
                <ion-icon name="folder-open"></ion-icon>
            </div>
            <a href="{{ route('admin.plants.index') }}" class="sidebar-menu">Manage Marga (Plants)</a>
        </li>
        <li class="list-menu">
            <div class="icon">
                <ion-icon name="leaf"></ion-icon>
            </div>
            <a href="{{ route('admin.plant.index') }}" class="sidebar-menu">Manage Plant</a>
        </li>
        <li class="list-menu">
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
        <li class="list-menu">
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
    <!-- Font Awesome 6 Free (official CDN) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.css" />

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.3/MarkerCluster.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.3/MarkerCluster.Default.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.heat/0.2.0/leaflet-heat.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">

  <link rel="stylesheet" href="https://unpkg.com/leaflet.fullscreen/Control.FullScreen.css" />


    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #1cc88a;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --info-color: #36b9cc;
            --dark-color: #5a5c69;
            --light-color: #f8f9fc;
            --card-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            --border-radius: 0.35rem;
        }

        .contentMain {
            padding: 1.5rem;
            background: var(--light-color);
        }

        .pageNameContent {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 1.5rem;
        }

        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1.25rem;
        }

        .card-header h6 {
            font-weight: 700;
            margin: 0;
            font-size: 1rem;
            color: var(--dark-color);
        }

        .card-body {
            padding: 1.25rem;
        }

        .stat-card {
            border-left: 0.25rem solid;
            min-height: 100px;
        }

        .stat-card.primary {
            border-left-color: var(--primary-color);
        }

        .stat-card.success {
            border-left-color: var(--secondary-color);
        }

        .stat-card.warning {
            border-left-color: var(--warning-color);
        }

        .stat-card.danger {
            border-left-color: var(--danger-color);
        }

        .stat-card .stat-title {
            text-transform: uppercase;
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.25rem;
        }

        .stat-card .stat-value {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0;
        }

        .stat-card .stat-icon {
            position: absolute;
            top: 50%;
            right: 1.25rem;
            transform: translateY(-50%);
            font-size: 2rem;
            opacity: 0.3;
            color: var(--dark-color);
        }

        .stat-card.primary .stat-icon {
            color: var(--primary-color);
        }

        .stat-card.success .stat-icon {
            color: var(--secondary-color);
        }

        .stat-card.warning .stat-icon {
            color: var(--warning-color);
        }

        .stat-card.danger .stat-icon {
            color: var(--danger-color);
        }

        #map {
            height: 450px;
            width: 100%;
            border-radius: var(--border-radius);
            margin-bottom: 1.5rem;
            box-shadow: var(--card-shadow);
        }

        .map-controls {
            background: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1000;
        }

        .map-control-btn {
            margin: 2px;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            background: #f8f9fc;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.3s;
        }

        .map-control-btn:hover {
            background: #e3e6f0;
        }

        .map-control-btn.active {
            background: var(--primary-color);
            color: white;
        }

        .custom-filter {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .custom-filter .form-select,
        .custom-filter .form-control {
            height: 38px;
            border-radius: var(--border-radius);
            border: 1px solid #d1d3e2;
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            flex-grow: 1;
            min-width: 200px;
        }

        .custom-filter .form-select:focus,
        .custom-filter .form-control:focus {
            border-color: #bac8f3;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .custom-filter .date-range {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table th {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #e3e6f0;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.8rem;
            white-space: nowrap;
            color: var(--dark-color);
        }

        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #e3e6f0;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.05);
        }

        .status-badge {
            padding: 0.25em 0.6em;
            font-size: 75%;
            font-weight: 700;
            border-radius: 10rem;
            display: inline-block;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            min-width: 80px;
        }

        .status-badge.pending {
            background-color: #f6c23e;
            color: white;
        }

        .status-badge.processing {
            background-color: #4e73df;
            color: white;
        }

        .status-badge.completed {
            background-color: #1cc88a;
            color: white;
        }

        .status-badge.cancelled {
            background-color: #e74a3b;
            color: white;
        }

        .btn-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            border-radius: 0.2rem;
            margin-right: 5px;
            color: white;
        }

        .btn-view {
            background-color: var(--primary-color);
        }

        .btn-edit {
            background-color: var(--warning-color);
        }

        .btn-delete {
            background-color: var(--danger-color);
        }

        .pagination {
            display: flex;
            list-style: none;
            border-radius: 0.35rem;
            padding-left: 0;
            margin: 20px 0;
        }

        .pagination .page-item .page-link {
            position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: var(--primary-color);
            background-color: #fff;
            border: 1px solid #dddfeb;
        }

        .pagination .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .pagination .page-item.disabled .page-link {
            color: #858796;
            pointer-events: none;
            cursor: auto;
            background-color: #fff;
            border-color: #dddfeb;
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        .custom-legend {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 10px;
            gap: 15px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-right: 15px;
            font-size: 0.85rem;
            cursor: pointer;
        }

        .legend-color {
            width: 15px;
            height: 15px;
            border-radius: 3px;
            margin-right: 5px;
        }

        .data-highlight {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }

        .geo-stats {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .geo-stat-item {
            background: white;
            border-radius: var(--border-radius);
            padding: 10px;
            text-align: center;
            box-shadow: 0 0.1rem 0.5rem rgba(0, 0, 0, 0.05);
        }

        .geo-stat-item h4 {
            margin: 0;
            font-size: 0.8rem;
            color: var(--dark-color);
            font-weight: 600;
        }

        .geo-stat-item p {
            margin: 5px 0 0;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .shipping-timeline {
            position: relative;
            padding-left: 45px;
            margin-bottom: 15px;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 15px;
        }

        .timeline-item:before {
            content: '';
            position: absolute;
            left: -30px;
            top: 0;
            width: 2px;
            height: 100%;
            background-color: #e3e6f0;
        }

        .timeline-item:last-child:before {
            height: 15px;
        }

        .timeline-item .timeline-dot {
            position: absolute;
            left: -36px;
            top: 0;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: var(--primary-color);
            border: 2px solid white;
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.2);
        }

        .timeline-item.completed .timeline-dot {
            background-color: var(--secondary-color);
        }

        .timeline-item.cancelled .timeline-dot {
            background-color: var(--danger-color);
        }

        .timeline-item h5 {
            margin: 0;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--dark-color);
        }

        .timeline-item p {
            margin: 5px 0 0;
            font-size: 0.8rem;
            color: #858796;
        }

        .product-performance {
            margin-top: 15px;
        }

        .product-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: var(--border-radius);
            background-color: #fff;
            box-shadow: 0 0.1rem 0.2rem rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        .product-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.2rem 0.5rem rgba(0, 0, 0, 0.1);
        }

        .product-image {
            width: 50px;
            height: 50px;
            border-radius: 5px;
            overflow: hidden;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-details {
            flex-grow: 1;
        }

        .product-name {
            margin: 0;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        .product-category {
            margin: 0;
            font-size: 0.75rem;
            color: #858796;
        }

        .product-stats {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-left: auto;
            padding-left: 15px;
        }

        .product-stat {
            text-align: center;
        }

        .product-stat-value {
            margin: 0;
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .product-stat-label {
            margin: 0;
            font-size: 0.65rem;
            color: #858796;
            text-transform: uppercase;
        }

        .custom-tooltip {
            position: absolute;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            z-index: 1000;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .progress {
            height: 10px;
            border-radius: var(--border-radius);
            margin-top: 5px;
            background-color: #eaecf4;
        }

        .progress-bar {
            height: 100%;
            border-radius: var(--border-radius);
        }
    </style>


    <div class="contentMain">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="pageNameContent">Advanced Admin Dashboard</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Overview</li>
                </ol>
            </div>
            <div>
                {{-- <div class="input-group">
                    <input type="text" class="form-control" id="daterange" placeholder="Date Range" readonly>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fas fa-calendar-alt"></i>
                        </span>
                    </div>
                </div> --}}
            </div>
        </div>

        <!-- Key Performance Indicators -->
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card stat-card primary">
                    <div class="card-body">
                        <div class="stat-title">Total Orders</div>
                        <div class="stat-value">{{ number_format($currentMonthOrders) }}</div>
                        <div class="stat-icon"><i class="fas fa-shopping-bag"></i></div>
                        <div class="mt-2">
                            <span class="{{ $orderGrowth >= 0 ? 'text-success' : 'text-danger' }}">
                                <i class="fas fa-arrow-{{ $orderGrowth >= 0 ? 'up' : 'down' }}"></i>
                                {{ abs($orderGrowth) }}%
                            </span>
                            <small class="text-muted ml-2">from last month</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stat-card success">
                    <div class="card-body">
                        <div class="stat-title">Total Revenue</div>
                        <div class="stat-value">@currency($currentRevenue)</div>
                        <div class="stat-icon"><i class="fa-solid fa-dollar-sign"></i></div>
                        <div class="mt-2">
                            <span class="{{ $revenueGrowth >= 0 ? 'text-success' : 'text-danger' }}">
                                <i class="fa-solid fa-arrow-{{ $revenueGrowth >= 0 ? 'up' : 'down' }}"></i>
                                {{ abs($revenueGrowth) }}%
                            </span>
                            <small class="text-muted ml-2">from last month</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stat-card warning">
                    <div class="card-body">
                        <div class="stat-title">Conversion Rate</div>
                        <div class="stat-value">{{ $conversionRate }}%</div>
                        <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                        <div class="mt-2">
                            <!-- Tambahkan logika perbandingan conversion rate jika diperlukan -->
                            <span class="text-secondary">N/A</span>
                            <small class="text-muted ml-2">from last month</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stat-card danger">
                    <div class="card-body">
                        <div class="stat-title">Avg. Order Value</div>
                        <div class="stat-value">@currency($avgOrderValue)</div>
                        <div class="stat-icon"><i class="fas fa-tags"></i></div>
                        <div class="mt-2">
                            <!-- Tambahkan logika pertumbuhan AOV jika diperlukan -->
                            <span class="text-secondary">N/A</span>
                            <small class="text-muted ml-2">from last month</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- GIS Map -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header" style="display: flex; justify-content: start;">
                        <h6>Geographic Map</h6>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light dropdown-toggle ms-5" type="button" id="mapViewDropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-layer-group"></i> Map View
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="mapViewDropdown">
                                <a class="dropdown-item map-view-option active" href="#"
                                    data-view="markers">Markers View</a>
                                <a class="dropdown-item map-view-option" href="#" data-view="heatmap">Heatmap
                                    View</a>
                                <a class="dropdown-item map-view-option" href="#" data-view="cluster">Cluster
                                    View</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" id="exportMapData">Export Map Data</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card-body p-0" style="position: relative;">
    <div id="map">
        <div class="map-controls" style="width: 500px">
            <!-- tombol-tombol filter -->
            <button class="map-control-btn active" data-filter="all">All Orders</button>
            <button class="map-control-btn" data-filter="waiting approval">Waiting Approval</button>
            <button class="map-control-btn" data-filter="order processed">Order Processed</button>
            <button class="map-control-btn" data-filter="quarantine process">Quarantine Process</button>
            <button class="map-control-btn" data-filter="order shipped">Order Shipped</button>
            <button class="map-control-btn" data-filter="shipped">Shipped</button>
            <button class="map-control-btn" data-filter="review">Review</button>
        </div>
    </div>
</div>

                    <div class="card-footer">
                        <div class="geo-stats">
                            <div class="geo-stat-item">
                                <h4>Top Country</h4>
                                <p>{{ $topCountry->negara_tujuan ?? 'N/A' }}</p>
                            </div>
                            <div class="geo-stat-item">
                                <h4>Top City</h4>
                                <p>{{ $topCity->kota_tujuan ?? 'N/A' }}</p>
                            </div>
                            <div class="geo-stat-item">
                                <h4>Int'l Orders</h4>
                                <p>{{ $internationalPercentage }}%</p>
                            </div>
                            <div class="geo-stat-item">
                                <h4>New Markets</h4>
                                <p>+{{ $newMarketsCount }}</p>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6>Sales Analytics</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="revenueChart"></canvas>
                        </div>
                        <div class="custom-legend">
                            <div class="legend-item" data-dataset="0">
                                <div class="legend-color" style="background-color: rgba(78, 115, 223, 0.8)"></div>
                                <span>Current Period</span>
                            </div>
                            <div class="legend-item" data-dataset="1">
                                <div class="legend-color" style="background-color: rgba(78, 115, 223, 0.3)"></div>
                                <span>Previous Period</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Recent Orders and Best Selling Products -->
        <div class="row">


            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6>Payment Method Analysis</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="height: 200px;">
                            <canvas id="paymentMethodChart"></canvas>
                        </div>
                        <div class="mt-4">
                            @foreach ($paymentData as $category => $data)
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-0">{{ $category }}</h6>
                                        <small class="text-muted">{{ $data['subtext'] }}</small>
                                    </div>
                                    <div class="text-primary font-weight-bold">
                                        {{ number_format($data['percentage'], 1) }}%
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6>Inventory Status</h6>
                    </div>
                    <div class="card-body">
                        @if ($lowStockCount > 0)
                            <div class="alert alert-warning p-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <div>
                                        <h6 class="mb-0">Low Stock Alert</h6>
                                        <small>{{ $lowStockCount }} product{{ $lowStockCount > 1 ? 's' : '' }} below
                                            threshold</small>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="mt-3">
                            @foreach ($stock as $plant)
                                <div class="d-flex justify-content-between mb-1">
                                    <span>{{ $plant->name }} ({{ $plant->category->name }})</span>
                                    <span
                                        class="@if ($plant->stock < 10) text-danger @elseif($plant->stock < 20) text-warning @endif">
                                        {{ $plant->stock }} left
                                    </span>
                                </div>
                                <div class="progress mb-3">
                                    @php
                                        // Hitung persentase stok (max 100% jika stok melebihi threshold)
                                        $percentage = min(($plant->stock / 20) * 100, 100);
                                        $color =
                                            $plant->stock < 10
                                                ? 'danger'
                                                : ($plant->stock < 20
                                                    ? 'warning'
                                                    : 'success');
                                    @endphp
                                    <div class="progress-bar bg-{{ $color }}" role="progressbar"
                                        style="width: {{ $percentage }}%" aria-valuenow="{{ $plant->stock }}"
                                        aria-valuemin="0" aria-valuemax="20">
                                    </div>
                                </div>
                            @endforeach

                            <!-- Pagination -->
                            <div class="mt-4">
                                {{ $stock->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6>Best Selling Plants</h6>
                    </div>
                    <div class="card-body">
                        @forelse($bestSellingPlants as $plant)
                            {{-- Gunakan list-group untuk konsistensi spacing --}}
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex align-items-center justify-content-between px-0 py-3">
                                    <div class="d-flex align-items-center">
                                        @php
                                            $thumbs = json_decode($plant['image'], true);
                                            $src = url('thumbPlant/' . ($thumbs[0] ?? 'placeholder.png'));
                                        @endphp
                                        <img src="{{ $src }}" alt="{{ $plant['name'] }}" class="rounded me-3"
                                            width="50" height="50">
                                        <div>
                                            <h6 class="mb-1">{{ $plant['name'] }}</h6>
                                            <small class="text-muted">{{ $plant['category'] }}</small>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <div class="mb-1">
                                            <span class="fw-bold">{{ $plant['sold'] }}</span><br>
                                            <small class="text-muted">Sold</small>
                                        </div>
                                        <div>
                                            <span class="fw-bold">@currency($plant['revenue'])</span><br>
                                            <small class="text-muted">Revenue</small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @empty
                            <div class="text-center py-5">
                                <i class="fas fa-seedling fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">No sales data available</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>


        <!-- Customer Demographics and Payment Analysis -->

    </div>
@endsection

@section('js')
    @php
        $statusMap = [
            0 => 'Waiting Approval',
            1 => 'Order Processed',
            2 => 'Quarantine Process',
            3 => 'Order Shipped',
            4 => 'Shipped',
            5 => 'Review',
        ];

        $orderDataArray = $mapOrders->map(function ($order) use ($statusMap) {
            return [
                'id' => $order->id,
                'lat' => (float) $order->latitude,
                'lng' => (float) $order->longitude,
                'customer' => $order->nama_penerima,
                'status' => $statusMap[$order->status] ?? 'Unknown',
                'amount' => $order->currency . ' ' . number_format($order->total_price_after_disc),
                'country' => $order->negara_tujuan,
                'city' => $order->kota_tujuan,
                'date' => \Carbon\Carbon::parse($order->created_at)->format('M j, Y'),
            ];
        });
    @endphp

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

    {{-- <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.3/leaflet.markercluster.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-measure@3.1.0/dist/leaflet-measure.css" />
    <script src="https://cdn.jsdelivr.net/npm/leaflet-measure@3.1.0/dist/leaflet-measure.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.heat/0.2.0/leaflet-heat.js"></script>
  <script src="https://unpkg.com/leaflet.fullscreen/Control.FullScreen.js"></script>

    <script>
        $(document).ready(function() {
            const myAPIKey = "3683694c43d1498d95c56706e0f3ceac";
            const orderData = @json($orderDataArray);
            $('#daterange').daterangepicker({
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            });
            const statusChartData = {
                labels: {!! json_encode(array_keys($orderStatuses)) !!},
                data: {!! json_encode(array_values($orderStatuses)) !!}
            };
            const revenueData = {
                labels: {!! json_encode($monthlyRevenue->pluck('month')) !!},
                current: {!! json_encode($monthlyRevenue->pluck('revenue')) !!}
            };
            const inventoryData = {
                labels: {!! json_encode(
                    $plants->groupBy('category.name')->map(function ($item, $key) {
                        return $key;
                    }),
                ) !!},
                stock: {!! json_encode(
                    $plants->groupBy('category.name')->map(function ($item) {
                        return $item->sum('stock');
                    }),
                ) !!}
            };
        var map = L.map('map', {
            fullscreenControl: true, // Aktifkan tombol fullscreen
            fullscreenControlOptions: {
                position: 'topleft'
            }
        }).setView([0, 0], 2);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);



            const homeLatLng = [-6.595038, 106.816635]; // Koordinat Bogor

            const homeIcon = L.icon({
                    iconUrl: `https://api.geoapify.com/v2/icon/?type=awesome&color=red&size=42&icon=home&contentSize=15&scaleFactor=2&apiKey=3683694c43d1498d95c56706e0f3ceac`,
                    iconSize: [31, 46], // size of the icon
                    iconAnchor: [15.5, 42], // point of the icon which will correspond to marker's location
                    popupAnchor: [0, -45] // point from which the popup should open relative to the iconAnchor
                    });

            // Tambahkan marker Home (warna kuning)
            const homeMarker = L.marker(homeLatLng, {
                icon: homeIcon,
            }).bindPopup("<strong>Home Location</strong><br>Bogor, Jawa Barat").addTo(map);

            const geocoder = L.Control.geocoder({
                defaultMarkGeocode: false,
                position: 'topleft',
                geocoder: L.Control.Geocoder.nominatim({
                    serviceUrl: 'https://nominatim.openstreetmap.org/'
                })
            }).addTo(map);

            // Event handler untuk pencarian
            geocoder.on('markgeocode', function(e) {
                map.setView(e.geocode.center, 8);
                L.marker(e.geocode.center)
                    .bindPopup(e.geocode.name)
                    .addTo(map);
            });

            const infoControl = L.control({
                        position: 'bottomright'
                    });
                        infoControl.onAdd = function(map) {
                            this._div = L.DomUtil.create('div', 'map-info');
                            this.update();
                            return this._div;
                        };
                        infoControl.update = function() {
                            this._div.innerHTML = `
                    <h4 class="map-title">Order Distribution Analysis</h4>
                    <p class="map-description">Visualisasi distribusi order berdasarkan lokasi pelanggan</p>
                `;
            };
            infoControl.addTo(map);

            // Filter amount dengan slider
            const sliderControl = L.control({
                position: 'bottomleft'
            });
            sliderControl.onAdd = function(map) {
                this._div = L.DomUtil.create('div', 'slider-filter');
                this._div.innerHTML = `
                    <div class="slider-container">
                        <label>Filter by Amount:</label>
                        <input type="range" id="amountSlider" min="0" max="1000" value="0" class="form-control-range">
                        <span id="sliderValue">0</span>
                    </div>
                `;
                return this._div;
            };
            sliderControl.addTo(map);

            L.control.measure({
                position: 'bottomleft',
                primaryLengthUnit: 'meters',
                secondaryLengthUnit: 'kilometers',
                primaryAreaUnit: 'sqmeters',
                autoPan : false,
            }).addTo(map);

            // Style tambahan
            const style = document.createElement('style');
            style.innerHTML = `
                .map-info {
                    background: white;
                    padding: 10px;
                    border-radius: 5px;
                    box-shadow: 0 1px 5px rgba(0,0,0,0.4);
                }
                .map-title {
                    margin: 0 0 5px 0;
                    font-size: 16px;
                }
                .map-description {
                    margin: 0;
                    font-size: 12px;
                    color: #666;
                }
                .slider-filter {
                    background: white;
                    padding: 10px;
                    border-radius: 5px;
                    margin-top: 10px;
                    box-shadow: 0 1px 5px rgba(0,0,0,0.4);
                }
                .slider-container {
                    width: 200px;
                }
                #sliderValue {
                    margin-left: 10px;
                    font-weight: bold;
                }
            `;
            document.head.appendChild(style);

            // Implementasi filter amount
            let minAmount = 0;
            let maxAmount = Math.max(...orderData.map(o => {
                return parseFloat(o.amount.replace(/[^0-9.]/g, ''));
            }));
            // Update slider
            document.getElementById('amountSlider').max = maxAmount;
            document.getElementById('amountSlider').value = minAmount;
            document.getElementById('sliderValue').textContent = formatCurrency(minAmount);

            // Fungsi format currency
            function formatCurrency(value) {
                return new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD',
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }).format(value);
            }

            // Update slider label
            document.querySelector('.slider-container label').textContent = 'Filter by Amount (USD):';

            // Update event listener untuk handle USD
            document.getElementById('amountSlider').addEventListener('input', function(e) {
                const value = parseFloat(e.target.value);
                document.getElementById('sliderValue').textContent = formatCurrency(value);
                visibleOrders = orderData.filter(order => {
                    const amount = parseFloat(order.amount.replace(/[^0-9.]/g, ''));
                    return amount >= value;
                });
                updateMarkers(visibleOrders);
            });

            // Error handling
            geocoder.on('error', function(e) {
                console.error('Geocoding error:', e.error);
                alert('Gagal menemukan lokasi. Silakan coba kata kunci lain.');
            });

            // Dummy data for orders with geo coordinates
            // Create custom marker icons based on status
            function getMarkerIcon(status) {
                let iconColor;
                switch (status) {
                    case 'waiting approval':
                        iconColor = '#f6c23e';
                        break;
                    case 'order processed':
                        iconColor = '#4e73df';
                        break;
                    case 'quarantine process':
                        iconColor = '#e74a3b';
                        break;
                    case 'order shipped':
                        iconColor = '#1cc88a';
                        break;
                    case 'shipped':
                        iconColor = '#36b9cc';
                        break;
                    case 'review':
                        iconColor = '#f8f9fc';
                        break;
                    default:
                        iconColor = '#858796';
                        break;

                }

                return L.divIcon({
                    html: `<div style="background-color: ${iconColor}; width: 12px; height: 12px; border-radius: 50%; border: 2px solid white;"></div>`,
                    className: 'custom-div-icon',
                    iconSize: [30, 30],
                    iconAnchor: [15, 15]
                });
            }

            // Initialize empty layers for different map views
            let markersLayer = L.layerGroup().addTo(map);
            let heatLayer;
            let clusterLayer = L.markerClusterGroup();
            let visibleOrders = orderData;

            // Function to update markers on the map
            function updateMarkers(orders) {
                // Clear existing markers
                markersLayer.clearLayers();
                clusterLayer.clearLayers();
                arrowsLayer.clearLayers(); // 🧼 Hapus semua garis putus-putus

                if (heatLayer && map.hasLayer(heatLayer)) {
                    map.removeLayer(heatLayer);
                }

                const currentView = $('.map-view-option.active').data('view') || 'markers';

                let heatPoints = [];

                const statusStyleMap = {
                    'Waiting Approval': {
                        color: '#FFA500', icon: 'clock'
                    },
                    'Order Processed': {
                        color: '#1E90FF', icon: 'cogs'
                    },
                    'Quarantine Process': {
                        color: '#800080', icon: 'shield-virus'
                    },
                    'Order Shipped': {
                        color: '#00CED1', icon: 'truck-loading'
                    },
                    'Shipped': {
                        color: '#32CD32', icon: 'truck'
                    },
                    'Review': {
                        color: '#FFD700', icon: 'star'
                    }
                };

                orders.forEach(order => {
                    const style = statusStyleMap[order.status] || {
                        color: '#808080',
                        icon: 'question-circle'
                    };

                    const markerIcon = L.icon({
                        iconUrl: `https://api.geoapify.com/v2/icon/?type=awesome&color=${encodeURIComponent(style.color)}&size=42&icon=${style.icon}&contentSize=15&scaleFactor=2&apiKey=3683694c43d1498d95c56706e0f3ceac`,
                        iconSize: [31, 46],
                        iconAnchor: [15.5, 42],
                        popupAnchor: [0, -45]
                    });

                    const amount = parseFloat(order.amount.replace(/[^0-9.]/g, ''));
                    const marker = L.marker([order.lat, order.lng], {
                        icon: markerIcon
                    }).bindPopup(`
                        <strong>Order #${order.id}</strong><br>
                        Customer: ${order.customer}<br>
                        Status: <span class="badge status-badge ${order.status.toLowerCase().replace(/\s/g, '-')}">${order.status}</span><br>
                        Amount: ${formatCurrency(amount)}<br>
                        Location: ${order.city}, ${order.country}<br>
                        Date: ${order.date}
                    `);

                    // Buat polyline dan tambahkan ke arrowsLayer, bukan langsung ke map
                    const arrow = L.polyline([homeLatLng, [order.lat, order.lng]], {
                        color: 'orange',
                        weight: 4,
                        dashArray: '5, 10',
                        opacity: 1
                    });

                    // arrow.addTo(arrowsLayer);

                    // Hitung jarak dalam kilometer
                    const distance = map.distance(homeLatLng, [order.lat, order.lng]) / 1000; // hasil dalam kilometer
                    const distanceText = `Jarak: ${distance.toFixed(2)} km`;

                    // Tambahkan event click pada garis
                    arrow.on('click', function (e) {
                        L.popup()
                            .setLatLng(e.latlng)
                            .setContent(distanceText)
                            .openOn(map);
                    });

                    arrow.addTo(arrowsLayer);


                    if (arrow.arrowheads) {
                        arrow.arrowheads({ size: '10px', frequency: 'endonly', fill: true });
                    }

                    if (currentView === 'markers') {
                        marker.addTo(markersLayer);
                    } else if (currentView === 'cluster') {
                        clusterLayer.addLayer(marker);
                    }

                    heatPoints.push([order.lat, order.lng, 1]);
                });

                // Tampilkan layer view yang aktif
                if (currentView === 'cluster') {
                    map.addLayer(clusterLayer);
                } else if (currentView === 'heatmap') {
                    heatLayer = L.heatLayer(heatPoints, {
                        radius: 25,
                        blur: 15,
                        maxZoom: 10
                    }).addTo(map);
                }
            }

            const arrowsLayer = L.layerGroup().addTo(map); // global, hanya sekali buat


            // Initial map update
            updateMarkers(orderData);



            // Map control filter buttons
            $('.map-control-btn').on('click', function() {
                $('.map-control-btn').removeClass('active');
                $(this).addClass('active');

                const filter = $(this).data('filter');

                if (filter === 'all') {
                    visibleOrders = orderData;
                } else {
                    visibleOrders = orderData.filter(order => order.status.toLowerCase() === filter);
                }

                updateMarkers(visibleOrders);
            });

            // Map view options
            $('.map-view-option').on('click', function(e) {
                e.preventDefault();

                $('.map-view-option').removeClass('active');
                $(this).addClass('active');

                updateMarkers(visibleOrders);

                // Update dropdown button text
                $('#mapViewDropdown').html(`<i class="fas fa-layer-group"></i> ${$(this).text()}`);
            });

            // Export map data
            $('#exportMapData').on('click', function(e) {
                e.preventDefault();

                const csvContent =
                    "data:text/csv;charset=utf-8,ID,Customer,Country,City,Status,Amount,Date,Latitude,Longitude\n" +
                    visibleOrders.map(order =>
                        `${order.id},"${order.customer}","${order.country}","${order.city}","${order.status}","${order.amount}","${order.date}",${order.lat},${order.lng}`
                    ).join("\n");

                const encodedUri = encodeURI(csvContent);
                const link = document.createElement("a");
                link.setAttribute("href", encodedUri);
                link.setAttribute("download", "map_data_export.csv");
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });

            // Table filters
            $('#statusFilter, #countryFilter, #paymentFilter').on('change', function() {
                const statusFilter = $('#statusFilter').val().toLowerCase();
                const countryFilter = $('#countryFilter').val().toLowerCase();
                const paymentFilter = $('#paymentFilter').val().toLowerCase();

                $('#ordersTable tbody tr').each(function() {
                    const statusCell = $(this).find('td .status-badge').text().toLowerCase();
                    const countryCell = $(this).find('td.country').text().toLowerCase();
                    const paymentCell = $(this).find('td.payment').text().toLowerCase();

                    const showStatus = !statusFilter || statusCell.includes(statusFilter);
                    const showCountry = !countryFilter || countryCell.includes(countryFilter);
                    const showPayment = !paymentFilter || paymentCell.includes(paymentFilter);

                    $(this).toggle(showStatus && showCountry && showPayment);
                });
            });

            // Revenue Chart
            const revenueChart = new Chart(document.getElementById('revenueChart'), {
                type: 'line',
                data: {
                    labels: revenueData.labels,
                    datasets: [{
                        label: 'Revenue',
                        data: revenueData.current,
                        borderColor: '#4e73df',
                        fill: false
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 0
                        }
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                fontColor: '#858796',
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                color: 'rgb(234, 236, 244)',
                                zeroLineColor: 'rgb(234, 236, 244)',
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            },
                            ticks: {
                                fontColor: '#858796',
                                beginAtZero: true,
                                maxTicksLimit: 5,
                                padding: 10,
                                callback: function(value, index, values) {
                                    return '$' + number_format(value);
                                }
                            }
                        }]
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        intersect: false,
                        mode: 'index',
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                            }
                        }
                    }
                }
            });

            // Custom legend click handler
            $('.legend-item').on('click', function() {
                const datasetIndex = $(this).data('dataset');
                const isVisible = revenueChart.isDatasetVisible(datasetIndex);

                // Toggle dataset visibility
                if (isVisible) {
                    revenueChart.hide(datasetIndex);
                    $(this).addClass('inactive');
                } else {
                    revenueChart.show(datasetIndex);
                    $(this).removeClass('inactive');
                }
            });


            // Payment Method Chart
            // Payment Method Chart
            const paymentMethodChart = new Chart(document.getElementById('paymentMethodChart'), {
                type: 'pie',
                data: {
                    labels: @json($paymentMethods->keys()),
                    datasets: [{
                        data: @json($paymentMethods->values()),
                        backgroundColor: [
                            '#4e73df', // Manual
                            '#1cc88a', // PayPal
                            '#36b9cc' // Stripe
                        ],
                        hoverBackgroundColor: [
                            '#2e59d9',
                            '#17a673',
                            '#2c9faf'
                        ]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutoutPercentage: 65,
                    legend: {
                        display: true,
                        position: 'right',
                        labels: {
                            boxWidth: 12,
                            padding: 20
                        }
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                const label = data.labels[tooltipItem.index];
                                const value = data.datasets[0].data[tooltipItem.index];
                                const total = data.datasets[0].data.reduce((a, b) => a + b, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            });

            $('#trendPeriodDropdown').next('.dropdown-menu').find('.dropdown-item').on('click', function(e) {
                e.preventDefault();

                // Update dropdown button text
                $('#trendPeriodDropdown').text($(this).text());

                // Remove active class from all items
                $(this).siblings().removeClass('active');

                // Add active class to clicked item
                $(this).addClass('active');

                // Generate new random data for demonstration
                const newOrderData = generateRandomData(4, 60, 130);
                const newRevenueData = newOrderData.map(val => val *
                    180); // Revenue is proportional to orders

                // Update chart data
                trendChart.data.datasets[0].data = newOrderData;
                trendChart.data.datasets[1].data = newRevenueData;
                trendChart.update();
            });

            // Helper function to format numbers with commas
            function number_format(number, decimals, dec_point, thousands_sep) {
                // Default values
                decimals = decimals || 0;
                dec_point = dec_point || '.';
                thousands_sep = thousands_sep || ',';

                // Format the number
                number = parseFloat(number);

                if (isNaN(number) || !isFinite(number)) {
                    return '';
                }

                number = number.toFixed(decimals);

                var parts = number.split('.');
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);

                return parts.join(dec_point);
            }

            // Helper function to generate random data for charts
            function generateRandomData(length, min, max) {
                return Array.from({
                    length: length
                }, () => Math.floor(Math.random() * (max - min + 1)) + min);
            }
        });
    </script>
@endsection
