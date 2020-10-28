<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- User login avatar -->
      <li class="nav-item dropdown user-menu d-flex align-items-center">
        <a href="#" class="dropdown-toggle nav-link nav-hover" data-toggle="dropdown">
          <i class="far fa-user"></i>
          <span class="hidden-xs">Xin chào, {{ Auth::guard('admin')->user()->ten }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-info">
            @if(  Auth::guard('admin')->user()->avatar)
            <img src="/storage/uploads/admin_avatar/icon128/{{Auth::guard('admin')->user()->avatar}}" class="img-circle" alt="User Image">
            @else
            <img src="/admin_assets/images/logo/logo-aq-h.png" class="img-circle" alt="User Image">
            @endif
            <p>
              {{ Auth::guard('admin')->user()->ten }}
              <small>{{ Auth::guard('admin')->user()->email }}</small>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="bg-white p-2 d-flex justify-content-between">
            <div class="">
              <a href="{{route('admin.manage.show',Auth::guard('admin')->user()->id)}}" class="btn btn-info"> <i class="far fa-user"></i> Profile</a>
            </div>
            <div class="">
              <a href="{{ route('logout.admin') }}" class="btn btn-default"> <i class="fas fa-sign-out-alt"></i> Sign out</a>
            </div>
          </li>
        </ul>

      </li>
    </ul>
  </nav>
  