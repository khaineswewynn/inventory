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
                <a class="nav-link" href="{{ route('purchase.index') }}">
                    <i class="menu-icon mdi mdi-floor-plan"></i>
                    <span class="menu-title">Purchase</span>
                </a>
            </li>
            @can('admin', auth()->user())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('permission.index') }}">
                        <i class="menu-icon mdi mdi-floor-plan"></i>
                        <span class="menu-title">Permission</span>
                    </a>
                </li>
            @endcan
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="menu-icon mdi mdi-floor-plan"></i>
                    <span class="menu-title">User</span>
                </a>
            </li>
            <li class="na-item mt-3">
                @auth
                    <a href="/logout" class=" nav-link btn btn-outline-danger">Logout</a>
                @endauth
            </li>
        </ul>
    </nav>
