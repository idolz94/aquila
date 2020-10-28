<aside class="main-sidebar elevation-4 sidebar-light-info">
    <!-- Brand Logo -->
    <a href="/" class="brand-link text-center">
        <img src="/admin_assets/images/logo/logo-aq-h.png" alt="Aquila Logo" width="50%"> 
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="{{route('nguoibaoho.home')}}" class="{{ (request()->is('/')) ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>
                            thông báo và tin tức
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('nguoibaoho.diem-danh')}}" class="{{ (request()->is('diem-danh')) ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fas fa-check"></i>
                        <p>
                            Điểm danh
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('nguoibaoho.suc-khoe')}}" class="{{ (request()->is('suc-khoe')) ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fas fa-procedures"></i>
                        <p>
                            Tình trạng sức khoẻ
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('nguoibaoho.hoc-phi')}}" class="{{ (request()->is('hoc-phi')) ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>
                            Học phí
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('nguoibaoho.diem-so')}}" class="{{ (request()->is('diem-so')) ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>
                            Điểm số
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ route('nguoibaoho.formReport') }}" class="{{ (request()->is('report')) ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>
                            Form report
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>