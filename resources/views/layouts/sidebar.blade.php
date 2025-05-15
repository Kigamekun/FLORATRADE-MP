<div class="sidebar-menu-wrapper">
    <li class="listMenuName"><p>Home Dashboard</p></li>
    <li class="list-menu {{ request()->routeIs('admin.index') ? 'active' : '' }}">
        <div class="icon"><ion-icon name="grid"></ion-icon></div>
        <a href="{{ route('admin.index') }}" class="sidebar-menu">Dashboard</a>
    </li>

    <li class="listMenuName"><p>Admin Menu</p></li>

    <li class="list-menu {{ request()->routeIs('admin.plants.*') ? 'active' : '' }}">
        <div class="icon"><ion-icon name="folder-open"></ion-icon></div>
        <a href="{{ route('admin.plants.index') }}" class="sidebar-menu">Manage Categories</a>
    </li>

    <li class="list-menu {{ request()->routeIs('admin.plant.*') ? 'active' : '' }}">
        <div class="icon"><ion-icon name="leaf"></ion-icon></div>
        <a href="{{ route('admin.plant.index') }}" class="sidebar-menu">Manage Plant</a>
    </li>

    <li class="list-menu {{ request()->routeIs('admin.voucher.*') ? 'active' : '' }}">
        <div class="icon"><ion-icon name="card"></ion-icon></div>
        <a href="{{ route('admin.voucher.index') }}" class="sidebar-menu">Manage Voucher</a>
    </li>

    <li class="list-menu {{ request()->routeIs('admin.shipping.*') ? 'active' : '' }}">
        <div class="icon"><ion-icon name="airplane"></ion-icon></div>
        <a href="{{ route('admin.shipping.index') }}" class="sidebar-menu">Manage Shipping</a>
    </li>

    <li class="list-menu {{ request()->routeIs('admin.pricing.*') ? 'active' : '' }}">
        <div class="icon"><ion-icon name="cash"></ion-icon></div>
        <a href="{{ route('admin.pricing.index') }}" class="sidebar-menu">Manage Pricing</a>
    </li>

    <li class="list-menu {{ request()->routeIs('admin.faq.*') ? 'active' : '' }}">
        <div class="icon"><ion-icon name="help-circle"></ion-icon></div>
        <a href="{{ route('admin.faq.index') }}" class="sidebar-menu">Manage Faq</a>
    </li>

    <li class="list-menu {{ request()->routeIs('admin.order.*') ? 'active' : '' }}">
        <div class="icon"><ion-icon name="cart"></ion-icon></div>
        <a href="{{ route('admin.order.index') }}" class="sidebar-menu">Manage Transaction</a>
    </li>

    <!-- <li class="list-menu {{ request()->routeIs('admin.chat') || request()->routeIs('admin.chatDetail') ? 'active' : '' }}">
        <div class="icon"><ion-icon name="chatbubbles"></ion-icon></div>
        <a href="{{ route('admin.chat') }}" class="sidebar-menu">Chat</a>
    </li> -->

    <li class="listMenuName"><p>User</p></li>
    <li class="list-menu {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
        <div class="icon"><ion-icon name="person"></ion-icon></div>
        <a href="{{ route('admin.user.index') }}" class="sidebar-menu">Manage User</a>
    </li>
</div>
