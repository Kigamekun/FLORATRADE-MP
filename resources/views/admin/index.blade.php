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
{{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.5.0/css/all.css"> --}}

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.3/MarkerCluster.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.3/MarkerCluster.Default.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.heat/0.2.0/leaflet-heat.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">

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
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
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
                        <div class="stat-value">{{ $totalOrders }}</div>
                        <div class="stat-icon"><i class="fas fa-shopping-bag"></i></div>
                        <div class="mt-2">
                            <span class="text-success"><i class="fas fa-arrow-up"></i> 12.5%</span>
                            <small class="text-muted ml-2">from last month</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card stat-card success">
                    <div class="card-body">
                        <div class="stat-title">Total Revenue</div>
                        <div class="stat-value">{{ $totalRevenue }}</div>
                        <div class="stat-icon"><i class="fas fa-dollar-sign"></i></div>
                        <div class="mt-2">
                            <span class="text-success"><i class="fas fa-arrow-up"></i> 8.3%</span>
                            <small class="text-muted ml-2">from last month</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card stat-card warning">
                    <div class="card-body">
                        <div class="stat-title">Conversion Rate</div>
                        <div class="stat-value">5.28%</div>
                        <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                        <div class="mt-2">
                            <span class="text-danger"><i class="fas fa-arrow-down"></i> 1.2%</span>
                            <small class="text-muted ml-2">from last month</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card stat-card danger">
                    <div class="card-body">
                        <div class="stat-title">Avg. Order Value</div>
                        <div class="stat-value">$245.80</div>
                        <div class="stat-icon"><i class="fas fa-tags"></i></div>
                        <div class="mt-2">
                            <span class="text-success"><i class="fas fa-arrow-up"></i> 3.7%</span>
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
                    <div class="card-header">
                        <h6>Geographic Order Distribution</h6>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="mapViewDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-layer-group"></i> Map View
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="mapViewDropdown">
                                <a class="dropdown-item map-view-option active" href="#" data-view="markers">Markers View</a>
                                <a class="dropdown-item map-view-option" href="#" data-view="heatmap">Heatmap View</a>
                                <a class="dropdown-item map-view-option" href="#" data-view="cluster">Cluster View</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" id="exportMapData">Export Map Data</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div id="map"></div>
                        <div class="map-controls">
                            <button class="map-control-btn active" data-filter="all">All Orders</button>
                            <button class="map-control-btn" data-filter="pending">Pending</button>
                            <button class="map-control-btn" data-filter="processing">Processing</button>
                            <button class="map-control-btn" data-filter="completed">Completed</button>
                            <button class="map-control-btn" data-filter="cancelled">Cancelled</button>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="geo-stats">
                            <div class="geo-stat-item">
                                <h4>Top Country</h4>
                                <p>United States</p>
                            </div>
                            <div class="geo-stat-item">
                                <h4>Top City</h4>
                                <p>New York</p>
                            </div>
                            <div class="geo-stat-item">
                                <h4>Int'l Orders</h4>
                                <p>38%</p>
                            </div>
                            <div class="geo-stat-item">
                                <h4>New Markets</h4>
                                <p>+3</p>
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
                <div class="card mb-4">
                    <div class="card-header">
                        <h6>Order Status Distribution</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="height: 200px;">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders and Best Selling Products -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6>Recent Orders</h6>
                        {{-- <a href="{{ route('admin.order.index') }}" class="btn btn-sm btn-primary">View All</a> --}}
                    </div>
                    <div class="card-body">
                        <div class="custom-filter">
                            <select id="statusFilter" class="form-select">
                                <option value="">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                            <select id="countryFilter" class="form-select">
                                <option value="">All Countries</option>
                                @foreach ($orders->pluck('negara_tujuan')->unique() as $country)
                                    <option value="{{ $country }}">{{ $country }}</option>
                                @endforeach
                            </select>
                            <select id="paymentFilter" class="form-select">
                                <option value="">All Payment Methods</option>
                                @foreach ($orders->pluck('payment_method')->unique() as $method)
                                    <option value="{{ $method }}">{{ $method }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="ordersTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Transaction Code</th>
                                        <th>Customer</th>
                                        <th>Country</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders->take(5) as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->kode_transaksi }}</td>
                                            <td>{{ $order->nama_penerima }}</td>
                                            <td class="country">{{ $order->negara_tujuan }}</td>
                                            <td>{{ \Carbon\Carbon::parse($order->date)->format('M d, Y') }}</td>
                                            <td>{{ $order->currency }} {{ number_format($order->total_price, 2) }}</td>
                                            <td>
                                                <span class="status-badge {{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span>
                                            </td>
                                            <td>
                                                {{-- <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-sm btn-action btn-view"><i class="fas fa-eye"></i></a> --}}
                                                {{-- <a href="{{ route('admin.order.edit', $order->id) }}" class="btn btn-sm btn-action btn-edit"><i class="fas fa-pen"></i></a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3 d-flex justify-content-center">
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item disabled">
                                        <span class="page-link">&laquo;</span>
                                    </li>
                                    <li class="page-item active">
                                        <span class="page-link">1</span>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">&raquo;</a>
                                    </li>
                                </ul>
                            </nav>
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
                        <div class="product-performance">
                            <div class="product-item">
                                <div class="product-image">
                                    <img src="/api/placeholder/50/50" alt="Plant 1">
                                </div>
                                <div class="product-details">
                                    <h5 class="product-name">Monstera Deliciosa</h5>
                                    <p class="product-category">Indoor Plants</p>
                                </div>
                                <div class="product-stats">
                                    <div class="product-stat">
                                        <p class="product-stat-value">127</p>
                                        <p class="product-stat-label">Sold</p>
                                    </div>
                                    <div class="product-stat">
                                        <p class="product-stat-value">$3,810</p>
                                        <p class="product-stat-label">Revenue</p>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item">
                                <div class="product-image">
                                    <img src="/api/placeholder/50/50" alt="Plant 2">
                                </div>
                                <div class="product-details">
                                    <h5 class="product-name">Fiddle Leaf Fig</h5>
                                    <p class="product-category">Indoor Plants</p>
                                </div>
                                <div class="product-stats">
                                    <div class="product-stat">
                                        <p class="product-stat-value">98</p>
                                        <p class="product-stat-label">Sold</p>
                                    </div>
                                    <div class="product-stat">
                                        <p class="product-stat-value">$2,940</p>
                                        <p class="product-stat-label">Revenue</p>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item">
                                <div class="product-image">
                                    <img src="/api/placeholder/50/50" alt="Plant 3">
                                </div>
                                <div class="product-details">
                                    <h5 class="product-name">Snake Plant</h5>
                                    <p class="product-category">Succulents</p>
                                </div>
                                <div class="product-stats">
                                    <div class="product-stat">
                                        <p class="product-stat-value">86</p>
                                        <p class="product-stat-label">Sold</p>
                                    </div>
                                    <div class="product-stat">
                                        <p class="product-stat-value">$1,720</p>
                                        <p class="product-stat-label">Revenue</p>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item">
                                <div class="product-image">
                                    <img src="/api/placeholder/50/50" alt="Plant 4">
                                </div>
                                <div class="product-details">
                                    <h5 class="product-name">Peace Lily</h5>
                                    <p class="product-category">Flowering Plants</p>
                                </div>
                                <div class="product-stats">
                                    <div class="product-stat">
                                        <p class="product-stat-value">74</p>
                                        <p class="product-stat-label">Sold</p>
                                    </div>
                                    <div class="product-stat">
                                        <p class="product-stat-value">$1,480</p>
                                        <p class="product-stat-label">Revenue</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Trend Analysis and Shipping Performance -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6>Order Trend Analysis</h6>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="trendPeriodDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                This Month
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="trendPeriodDropdown">
                                <a class="dropdown-item" href="#">Last 7 Days</a>
                                <a class="dropdown-item active" href="#">This Month</a>
                                <a class="dropdown-item" href="#">Last Month</a>
                                <a class="dropdown-item" href="#">This Quarter</a>
                                <a class="dropdown-item" href="#">This Year</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="trendChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6>Shipping Performance</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h5 class="text-muted mb-2">Average Delivery Time</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="mb-0">3.4 days</h3>
                                <span class="badge bg-success">-0.6 days</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 68%" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small class="text-muted">Target: 4 days</small>
                        </div>
                        <div class="mb-3">
                            <h5 class="text-muted mb-2">On-Time Delivery Rate</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="mb-0">94.2%</h3>
                                <span class="badge bg-success">+2.8%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 94%" aria-valuenow="94" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small class="text-muted">Target: 90%</small>
                        </div>
                        <div class="mt-4">
                            <h5 class="text-muted mb-3">Top Shipping Methods</h5>
                            <div class="shipping-timeline">
                                <div class="timeline-item completed">
                                    <div class="timeline-dot"></div>
                                    <h5>Express Shipping (48%)</h5>
                                    <p>2-3 business days</p>
                                </div>
                                <div class="timeline-item completed">
                                    <div class="timeline-dot"></div>
                                    <h5>Standard Shipping (35%)</h5>
                                    <p>4-6 business days</p>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-dot"></div>
                                    <h5>Economy Shipping (17%)</h5>
                                    <p>7-10 business days</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Demographics and Payment Analysis -->
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6>Customer Demographics</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="height: 200px;">
                            <canvas id="customerDemographicsChart"></canvas>
                        </div>
                        <div class="mt-4">
                            <h5 class="text-muted mb-3">Customer Segments</h5>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>New Customers</span>
                                    <span>38%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 38%" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Returning Customers</span>
                                    <span>45%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Loyal Customers</span>
                                    <span>17%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 17%" aria-valuenow="17" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="mb-0">Credit Card</h6>
                                    <small class="text-muted">Visa, Mastercard, Amex</small>
                                </div>
                                <div class="text-primary font-weight-bold">48%</div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="mb-0">Digital Wallet</h6>
                                    <small class="text-muted">PayPal, Google Pay</small>
                                </div>
                                <div class="text-primary font-weight-bold">32%</div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="mb-0">Bank Transfer</h6>
                                    <small class="text-muted">Direct deposit</small>
                                </div>
                                <div class="text-primary font-weight-bold">15%</div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">Others</h6>
                                    <small class="text-muted">Cash on delivery, etc.</small>
                                </div>
                                <div class="text-primary font-weight-bold">5%</div>
                            </div>
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
                        <div class="chart-container" style="height: 200px;">
                            <canvas id="inventoryChart"></canvas>
                        </div>
                        <div class="mt-4">
                            <div class="alert alert-warning p-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <div>
                                        <h6 class="mb-0">Low Stock Alert</h6>
                                        <small>5 products below threshold</small>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Snake Plant</span>
                                    <span class="text-danger">3 left</span>
                                </div>
                                <div class="progress mb-2">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span>Fiddle Leaf Fig</span>
                                    <span class="text-warning">7 left</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script> --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.5.3/leaflet.markercluster.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.heat/0.2.0/leaflet-heat.js"></script>

    <script>
       $(document).ready(function() {
    // Initialize date range picker
    $('#daterange').daterangepicker({
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    // Initialize Leaflet map
    var map = L.map('map').setView([0, 0], 2);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Dummy data for orders with geo coordinates
    const orderData = [
        // Original data from the template
        // Additional dummy data to show better visualization
        {id: 1001, lat: 40.7128, lng: -74.0060, customer: "John Smith", status: "completed", amount: "USD 150.00", country: "United States", city: "New York", date: "May 1, 2023"},
        {id: 1002, lat: 34.0522, lng: -118.2437, customer: "Alice Johnson", status: "processing", amount: "USD 85.45", country: "United States", city: "Los Angeles", date: "May 2, 2023"},
        {id: 1003, lat: 51.5074, lng: -0.1278, customer: "Richard Wilson", status: "completed", amount: "GBP 120.00", country: "United Kingdom", city: "London", date: "May 3, 2023"},
        {id: 1004, lat: 48.8566, lng: 2.3522, customer: "Marie Dupont", status: "pending", amount: "EUR 95.50", country: "France", city: "Paris", date: "May 4, 2023"},
        {id: 1005, lat: 35.6762, lng: 139.6503, customer: "Takashi Yamamoto", status: "processing", amount: "JPY 8500.00", country: "Japan", city: "Tokyo", date: "May 5, 2023"},
        {id: 1006, lat: -33.8688, lng: 151.2093, customer: "Emma Wilson", status: "completed", amount: "AUD 210.75", country: "Australia", city: "Sydney", date: "May 6, 2023"},
        {id: 1007, lat: 55.7558, lng: 37.6173, customer: "Ivan Petrov", status: "pending", amount: "RUB 5400.00", country: "Russia", city: "Moscow", date: "May 7, 2023"},
        {id: 1008, lat: 19.4326, lng: -99.1332, customer: "Carlos Hernandez", status: "processing", amount: "MXN 1850.00", country: "Mexico", city: "Mexico City", date: "May 8, 2023"},
        {id: 1009, lat: -23.5505, lng: -46.6333, customer: "Ana Silva", status: "completed", amount: "BRL 320.00", country: "Brazil", city: "São Paulo", date: "May 9, 2023"},
        {id: 1010, lat: 28.6139, lng: 77.2090, customer: "Raj Sharma", status: "pending", amount: "INR 7500.00", country: "India", city: "New Delhi", date: "May 10, 2023"}
    ];

    // Create custom marker icons based on status
    function getMarkerIcon(status) {
        let iconColor;
        switch(status) {
            case 'pending': iconColor = '#f6c23e'; break;
            case 'processing': iconColor = '#4e73df'; break;
            case 'completed': iconColor = '#1cc88a'; break;
            case 'cancelled': iconColor = '#e74a3b'; break;
            default: iconColor = '#36b9cc'; break;
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

        // If heatLayer exists, remove it
        if (heatLayer && map.hasLayer(heatLayer)) {
            map.removeLayer(heatLayer);
        }

        // Current view mode
        const currentView = $('.map-view-option.active').data('view') || 'markers';

        // Heat map points
        let heatPoints = [];

        orders.forEach(order => {
            // Create marker with popup
            const marker = L.marker([order.lat, order.lng], {
                icon: getMarkerIcon(order.status.toLowerCase())
            }).bindPopup(`
                <strong>Order #${order.id}</strong><br>
                Customer: ${order.customer}<br>
                Status: <span class="badge status-badge ${order.status.toLowerCase()}">${order.status}</span><br>
                Amount: ${order.amount}<br>
                Location: ${order.city}, ${order.country}<br>
                Date: ${order.date}
            `);

            // Add to appropriate layer
            if (currentView === 'markers') {
                marker.addTo(markersLayer);
            } else if (currentView === 'cluster') {
                clusterLayer.addLayer(marker);
            }

            // Add point for heat map
            heatPoints.push([order.lat, order.lng, 1]);
        });

        // Apply appropriate view
        if (currentView === 'cluster') {
            map.addLayer(clusterLayer);
        } else if (currentView === 'heatmap') {
            heatLayer = L.heatLayer(heatPoints, {radius: 25, blur: 15, maxZoom: 10}).addTo(map);
        }
    }

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

        const csvContent = "data:text/csv;charset=utf-8,ID,Customer,Country,City,Status,Amount,Date,Latitude,Longitude\n" +
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
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Current Period',
                data: [15000, 22000, 19500, 28000, 32000, 36500, 42000],
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                borderColor: 'rgba(78, 115, 223, 1)',
                pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                pointBorderColor: '#fff',
                pointRadius: 4,
                pointHoverRadius: 6,
                borderWidth: 3,
                fill: true
            },
            {
                label: 'Previous Period',
                data: [12000, 18000, 15500, 24000, 26000, 28500, 32000],
                backgroundColor: 'rgba(28, 200, 138, 0.05)',
                borderColor: 'rgba(28, 200, 138, 1)',
                pointBackgroundColor: 'rgba(28, 200, 138, 1)',
                pointBorderColor: '#fff',
                pointRadius: 4,
                pointHoverRadius: 6,
                borderWidth: 3,
                fill: true
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

    // Order Status Chart
    const statusChart = new Chart(document.getElementById('statusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'Processing', 'Pending', 'Cancelled'],
            datasets: [{
                data: [45, 25, 20, 10],
                backgroundColor: ['#1cc88a', '#4e73df', '#f6c23e', '#e74a3b'],
                hoverBackgroundColor: ['#17a673', '#2e59d9', '#dda20a', '#c23321'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            cutoutPercentage: 70,
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: '#858796',
                    boxWidth: 12
                }
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
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function(previousValue, currentValue) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percent = Math.round((currentValue/total) * 100);
                        return data.labels[tooltipItem.index] + ': ' + percent + '%';
                    }
                }
            }
        }
    });

    // Trend Chart
    const trendChart = new Chart(document.getElementById('trendChart'), {
        type: 'line',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            datasets: [
                {
                    label: 'Orders',
                    data: [68, 95, 82, 120],
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointBorderColor: '#fff',
                    pointRadius: 4,
                    borderWidth: 2,
                    lineTension: 0.3,
                    fill: true
                },
                {
                    label: 'Revenue',
                    data: [12500, 16800, 14200, 21500],
                    backgroundColor: 'rgba(28, 200, 138, 0)',
                    borderColor: 'rgba(28, 200, 138, 1)',
                    pointBackgroundColor: 'rgba(28, 200, 138, 1)',
                    pointBorderColor: '#fff',
                    pointRadius: 4,
                    borderWidth: 2,
                    lineTension: 0.3,
                    fill: false,
                    yAxisID: 'y-axis-2'
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        fontColor: '#858796'
                    }
                }],
                yAxes: [
                    {
                        type: 'linear',
                        position: 'left',
                        id: 'y-axis-1',
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
                            maxTicksLimit: 5
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Orders',
                            fontColor: '#858796'
                        }
                    },
                    {
                        type: 'linear',
                        position: 'right',
                        id: 'y-axis-2',
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            fontColor: '#858796',
                            beginAtZero: true,
                            maxTicksLimit: 5,
                            callback: function(value) {
                                return '$' + number_format(value);
                            }
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Revenue',
                            fontColor: '#858796'
                        }
                    }
                ]
            },
            legend: {
                display: true,
                position: 'top',
                labels: {
                    fontColor: '#858796',
                    boxWidth: 12
                }
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
                        if (tooltipItem.datasetIndex === 1) {
                            return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                        }
                        return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });

    // Customer Demographics Chart
    const customerDemographicsChart = new Chart(document.getElementById('customerDemographicsChart'), {
        type: 'doughnut',
        data: {
            labels: ['18-24', '25-34', '35-44', '45-54', '55+'],
            datasets: [{
                data: [15, 30, 25, 18, 12],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#dda20a', '#c23321'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            cutoutPercentage: 65,
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: '#858796',
                    boxWidth: 10,
                    padding: 15
                }
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
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function(previousValue, currentValue) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percent = Math.round((currentValue/total) * 100);
                        return data.labels[tooltipItem.index] + ': ' + percent + '%';
                    }
                }
            }
        }
    });

    // Payment Method Chart
    const paymentMethodChart = new Chart(document.getElementById('paymentMethodChart'), {
        type: 'pie',
        data: {
            labels: ['Credit Card', 'Digital Wallet', 'Bank Transfer', 'Others'],
            datasets: [{
                data: [48, 32, 15, 5],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#dda20a'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
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
                    label: function(tooltipItem, data) {
                        return data.labels[tooltipItem.index] + ': ' + data.datasets[0].data[tooltipItem.index] + '%';
                    }
                }
            }
        }
    });

    // Inventory Chart
    const inventoryChart = new Chart(document.getElementById('inventoryChart'), {
        type: 'bar',
        data: {
            labels: ['Indoor Plants', 'Outdoor Plants', 'Succulents', 'Flowering Plants', 'Accessories'],
            datasets: [{
                label: 'In Stock',
                backgroundColor: '#4e73df',
                hoverBackgroundColor: '#2e59d9',
                data: [125, 87, 64, 73, 42],
            }, {
                label: 'Low Stock',
                backgroundColor: '#f6c23e',
                hoverBackgroundColor: '#dda20a',
                data: [12, 8, 15, 5, 3],
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 0,
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
                        maxTicksLimit: 6
                    },
                    maxBarThickness: 25,
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 150,
                        maxTicksLimit: 5,
                        padding: 10,
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: true,
                position: 'top',
                labels: {
                    fontColor: '#858796',
                    boxWidth: 12
                }
            },
            tooltips: {
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
        }
    });

    // Dropdown period change handler for trend chart
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
        const newRevenueData = newOrderData.map(val => val * 180); // Revenue is proportional to orders

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
        return Array.from({length: length}, () => Math.floor(Math.random() * (max - min + 1)) + min);
    }
});
    </script>
@endsection
