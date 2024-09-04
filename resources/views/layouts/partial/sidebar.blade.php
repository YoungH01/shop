<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile border-bottom">
        <a href="#" class="nav-link flex-column">
          <div class="nav-profile-image">
            <img src="https://play-lh.googleusercontent.com/Aqp_wNSGx1JGiuOD5FHk3fa5iQcZ2NzB9hy75N5lBrDm2OrQ_Jnka7__-yXQe1pjHCM" alt="profile" />
            <!--change to offline or busy as needed-->
          </div>
          <div class="nav-profile-text d-flex ml-0 mb-3 flex-column">
            <span class="font-weight-semibold mb-1 mt-2 text-center">Bui Dinh Hoang Hung</span>
            <span class="text-secondary icon-sm text-center">$3499.00</span>
          </div>
        </a>
      </li>
      <li class="nav-item pt-3">
        <a class="nav-link d-block" href="index.html">
          <img class="sidebar-brand-logo" src="{{asset('assets_pluginAdmin/images/logo.svg')}}" alt="" />
          <img class="sidebar-brand-logomini" src="{{asset('assets_pluginAdmin/images/logo-mini.svg')}}" alt="" />
          <div class="small font-weight-light pt-1">Responsive Dashboard</div>
        </a>
        <form class="d-flex align-items-center" action="#">
          <div class="input-group">
            <div class="input-group-prepend">
              <i class="input-group-text border-0 mdi mdi-magnify"></i>
            </div>
            <input type="text" class="form-control border-0" placeholder="Search" />
          </div>
        </form>
      </li>
      <li class="pt-2 pb-1">
        <span class="nav-item-head">Template Pages</span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard.layout')}}">
          <i class="mdi mdi-compass-outline menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item {{Request::is('dashboard/customer*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('customer.view')}}">
          <i class="mdi mdi-contacts menu-icon"></i>
          <span class="menu-title">Customer</span>
        </a>
      </li>
      <li class="nav-item {{Request::is('dashboard/admin*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('admins.view')}}">
          <i class="mdi mdi-account-key menu-icon"></i>
          <span class="menu-title">Admin</span>
        </a>
      </li>
      <li class="nav-item {{Request::is('dashboard/product*') ? 'active' : '' }}">
        <a class="nav-link " href="{{route('product.view')}}">
          <i class="mdi mdi-cube menu-icon"></i>
          <span class="menu-title">Products</span>
        </a>
      </li>
      <li class="nav-item {{Request::is('dashboard/category*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('category.view')}}">
          <i class="mdi mdi-database-minus menu-icon"></i>
          <span class="menu-title">Category</span>
        </a>
      </li>
      <li class="nav-item {{Request::is('dashboard/orders*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('orders.view')}}">
          <i class="mdi mdi-file-multiple menu-icon"></i>
          <span class="menu-title">Orders</span>
        </a>
      </li>
      <li class="nav-item pt-3">
        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
          @csrf
        </form>
        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" target="_blank">
          <i class="fa-solid fa-power-off menu-icon"></i>
          <span class="menu-title">Logout</span>
        </a>
      </li>
    </ul>
  </nav>