<div class="container-fluid page-body-wrapper">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('index') }}">
                    <i class="mdi mdi-grid-large menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">UI Elements</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('provider.index') }}">
                    <i class="menu-icon mdi mdi-floor-plan"></i>
                    <span class="menu-title">Provider</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('category.index') }}">
                    <i class="menu-icon mdi mdi-floor-plan"></i>
                    <span class="menu-title">Category</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('product.index') }}">
                    <i class="menu-icon mdi mdi-floor-plan"></i>
                    <span class="menu-title">Product</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('customer.index') }}">
                    <i class="menu-icon mdi mdi-account-circle-outline"></i>
                    <span class="menu-title">Customer</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('location.index') }}">
                    <i class="menu-icon mdi mdi-floor-plan"></i>
                    <span class="menu-title">Location</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('warehouse.index') }}">
                    <i class="menu-icon mdi mdi-floor-plan"></i>
                    <span class="menu-title">Warehouse</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('sale.index') }}">
                    <i class="menu-icon mdi mdi-floor-plan"></i>
                    <span class="menu-title">Sales</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('stocks.index') }}">
                    <i class="menu-icon mdi mdi-floor-plan"></i>
                    <span class="menu-title">Stock</span>
                </a>
            </li>
            @php
                $user = Auth::user();
            @endphp
            @if ($user && $user->role && $user->role->roles === 'Admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('assign-permissions') }}">
                        <i class="menu-icon mdi mdi-floor-plan"></i>
                        <span class="menu-title">Roles & Permissions</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('assign-roles') }}">
                        <i class="menu-icon mdi mdi-floor-plan"></i>
                        <span class="menu-title">User roles</span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
