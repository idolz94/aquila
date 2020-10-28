<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" title="Thu gọn menu"><i class="fas fa-angle-double-left"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- User name Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link nav-hover" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i> Xin chao {{ Auth::user()->ten }}
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item bg-info">
                    <!-- User name Start -->
                    <div class="username">
                        <h4>{{ Auth::user()->ten }}</h4>
                    </div>
                    <!-- User name End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media cus_media">
                        <div class="mr-3">
                            <i class="far fa-id-badge"></i>
                        </div>
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Hồ sơ cá nhân
                            </h3>
                            <p class="text-sm">Thông tin cá nhân</p>
                        </div>
                        <div class="media-footer">
                            <span class="float-right text-sm text-muted"><i class="fas fa-chevron-right"></i></span>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <div class="media cus_media p-3">
                    <a href="{{ route('changepassword.nguoibaoho') }}" class="btn btn-outline-info btn-sm">Đổi mật khẩu</a>
                    <a href="{{ route('logout.nguoibaoho') }}" class="btn btn-outline-info btn-sm">Đăng xuất</a>
                </div>
            </div>
        </li>
    </ul>
</nav>