<div class="container-fluid page-body-wrapper">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
<<<<<<< HEAD
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="index.html">
            <i class="mdi mdi-grid-large menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item nav-category"><a class="nav-link" href="{{route('customer.index')}}">Customer</a></li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
            <i class="menu-icon mdi mdi-card-text-outline"></i>
            <span class="menu-title">Form elements</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="form-elements">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic Elements</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
            <i class="menu-icon mdi mdi-chart-line"></i>
            <span class="menu-title">Charts</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="charts">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
            <i class="menu-icon mdi mdi-table"></i>
            <span class="menu-title">Tables</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="tables">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="pages/tables/basic-table.html">Basic table</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
            <i class="menu-icon mdi mdi-layers-outline"></i>
            <span class="menu-title">Icons</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="icons">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="pages/icons/font-awesome.html">Font Awesome</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <i class="menu-icon mdi mdi-account-circle-outline"></i>
            <span class="menu-title">User Pages</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
              <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
              <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
              <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
              <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="docs/documentation.html">
            <i class="menu-icon mdi mdi-file-document"></i>
            <span class="menu-title">Documentation</span>
          </a>
        </li>
      </ul>
    </nav>
=======
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
            </li>
        </ul>
    </nav>
>>>>>>> 73f16fa (updated purchase migrations)
