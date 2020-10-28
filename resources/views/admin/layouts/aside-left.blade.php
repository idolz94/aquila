<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link text-center elevation-3">
      <img src="/admin_assets/images/logo/logo-aq-h.png" alt="Aquila Logo" width="50%">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if(Auth::guard('admin')->user()->role == Config::get('admin.role.supper_admin.val'))
            <li class="nav-item">
              <a href="{{route('admin.manage.index')}}" class="{{ (request()->is('manage*')) ? 'nav-link active' : 'nav-link' }}">
                <i class="nav-icon fas fa-user-tie"></i>
                <p>Admin</p>
              </a>
            </li>
          @endif
       
          <li class="nav-item has-treeview {{ (request()->is('hoc-vien')) || (request()->is('hoc-vien/create')) || (request()->is('khamsuckhoe')) || (request()->is('tinhtrangnghien')) || (request()->is('phong')) || (request()->is('hanhkiem')) || (request()->is('kyluat')) || (request()->is('diengiai-taichinh')) || (request()->is('sukien')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                Học viên
                <i class="right fas fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.hoc-vien.index')}}" class="{{ (request()->is('hoc-vien'))  ? 'nav-link active' : 'nav-link' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách</p> 
                </a>
              </li>
              @if(Auth::guard('admin')->user()->role == Config::get('admin.role.supper_admin.val') || Auth::guard('admin')->user()->role == Config::get('admin.role.quan_ly.val'))
              <li class="nav-item">
                <a href="{{route('admin.hoc-vien.create')}}" class="{{ (request()->is('hoc-vien/create')) ? 'nav-link active' : 'nav-link' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.khamsuckhoe.index')}}" class="{{ (request()->is('khamsuckhoe')) ? 'nav-link active' : 'nav-link' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Khám sức khoẻ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.tinhtrangnghien.index')}}" class="{{ (request()->is('tinhtrangnghien')) ? 'nav-link active' : 'nav-link' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tình Trạng Nghiện</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.phong.index')}}" class="{{ (request()->is('phong')) ? 'nav-link active' : 'nav-link' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Phòng ở</p>
                </a>
              </li>
              @endif
              @if(Auth::guard('admin')->user()->role == Config::get('admin.role.supper_admin.val') || Auth::guard('admin')->user()->role == Config::get('admin.role.dao_tao.val') ||  Auth::guard('admin')->user()->role == Config::get('admin.role.quan_ly.val'))
              <li class="nav-item">
                <a href="{{route('admin.hanhkiem.index')}}" class="{{ (request()->is('hanhkiem')) ? 'nav-link active' : 'nav-link' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hạnh kiểm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.kyluat.index')}}" class="{{ (request()->is('kyluat')) ? 'nav-link active' : 'nav-link' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kỷ luật</p>
                </a>
              </li>
              @endif
              @if(Auth::guard('admin')->user()->role == Config::get('admin.role.supper_admin.val') || Auth::guard('admin')->user()->role == Config::get('admin.role.tai_chinh.val') ||  Auth::guard('admin')->user()->role == Config::get('admin.role.quan_ly.val'))
              <li class="nav-item">
                <a href="{{route('admin.diengiai-taichinh.index')}}" class="{{ (request()->is('diengiai-taichinh')) ? 'nav-link active' : 'nav-link' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tài chính học viên</p>
                </a>
              </li>
              @endif
              @if(Auth::guard('admin')->user()->role == Config::get('admin.role.supper_admin.val') ||  Auth::guard('admin')->user()->role == Config::get('admin.role.quan_ly.val'))
              <li class="nav-item">
                <a href="{{route('admin.sukien.index')}}" class="{{ (request()->is('sukien')) ? 'nav-link active' : 'nav-link' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sự kiện học viên</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @if(Auth::guard('admin')->user()->role == Config::get('admin.role.supper_admin.val') || Auth::guard('admin')->user()->role == Config::get('admin.role.dao_tao.val') ||  Auth::guard('admin')->user()->role == Config::get('admin.role.quan_ly.val'))
          <li class="nav-item  has-treeview {{ (request()->is('giaovien')) || (request()->is('chucvu')) || (request()->is('hephai')) ? 'menu-open' : '' }}">
            <a href="{{route('admin.giaovien.index')}}" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>Giáo viên
                <i class="right fas fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.giaovien.index')}}" class="{{ (request()->is('giaovien')) ? 'nav-link active' : 'nav-link' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách giáo viên</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.chucvu.index')}}" class="{{ (request()->is('chucvu')) ? 'nav-link active' : 'nav-link' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách chức vụ</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.hephai.index')}}" class="{{ (request()->is('hephai')) ? 'nav-link active' : 'nav-link' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách hệ phái</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if(Auth::guard('admin')->user()->role == Config::get('admin.role.supper_admin.val') || Auth::guard('admin')->user()->role == Config::get('admin.role.dao_tao.val') ||  Auth::guard('admin')->user()->role == Config::get('admin.role.quan_ly.val'))
          <li class="nav-item has-treeview  {{ (request()->is('lophoc')) || (request()->is('lydo')) || (request()->is('lophoc/diem/list')) || (request()->is('lophoc/diemdanh/list')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fab fa-buromobelexperte"></i>
              <p>
                Lớp học
                <i class="right fas fa-angle-right"></i>
              </p>
            </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.lophoc.index')}}" class="{{ (request()->is('lophoc')) ? 'nav-link active' : 'nav-link' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Danh sách lớp học</p>
                  </a>
                  </li>
                <li class="nav-item">
                  <a href="{{route('admin.lydo.index')}}" class="{{ (request()->is('lydo')) ? 'nav-link active' : 'nav-link' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Danh sách lý do điểm</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.lophoc.diem')}}" class="{{ (request()->is('lophoc/diem/list')) ? 'nav-link active' : 'nav-link' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Danh sách điểm</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.lophoc.diemdanh')}}" class="{{ (request()->is('lophoc/diemdanh/list')) ? 'nav-link active' : 'nav-link' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Danh sách điểm danh</p>
                  </a>
                </li>
              </ul>
          </li>
          @endif
          @if(Auth::guard('admin')->user()->role == Config::get('admin.role.supper_admin.val')
          ||  Auth::guard('admin')->user()->role == Config::get('admin.role.quan_ly.val'))
          <li class="nav-item has-treeview {{ (request()->is('nhomcha')) || (request()->is('nhom')) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>
                Nhóm
                <i class="right fas fa-angle-right"></i>
              </p>
            </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('admin.nhomcha.index')}}" class="{{ (request()->is('nhomcha')) ? 'nav-link active' : 'nav-link' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Nhóm chính</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('admin.nhom.index')}}" class="{{ (request()->is('nhom')) ? 'nav-link active' : 'nav-link' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Nhóm học viên</p>
                  </a>
                </li>
              </ul>
          </li>
          @endif
          @if(Auth::guard('admin')->user()->role == Config::get('admin.role.supper_admin.val') ||
          Auth::guard('admin')->user()->role == Config::get('admin.role.dao_tao.val')
          ||  Auth::guard('admin')->user()->role == Config::get('admin.role.quan_ly.val'))
          <li class="nav-item">
            <a href="{{route('admin.bomon.index')}}" class="{{ (request()->is('bomon')) ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Bộ môn</p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{route('admin.monhoc.index')}}" class="{{ (request()->is('monhoc')) ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon fas fa-book"></i>
              <p>Môn học</p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{route('admin.thoi-khoa-bieu.all.lophoc')}}" class="{{ (request()->is('thoi-khoa-bieu/index/')) || (request()->is('thoi-khoa-bieu/all/lophoc'))  ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>Thời khóa biểu</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.huongnghiep.index')}}" class="{{ (request()->is('huongnghiep')) ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>Hướng nghiệp</p>
            </a>
          </li>
          @endif
          @if(Auth::guard('admin')->user()->role == Config::get('admin.role.supper_admin.val') ||
            Auth::guard('admin')->user()->role == Config::get('admin.role.quan_ly.val'))
          <li class="nav-item">
            <a href="{{route('admin.report.index')}}" class="{{ (request()->is('report')) ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon far fa-file"></i>
              <p>Khiếu nại</p>
            </a>
          </li>
          @endif
          @if(Auth::guard('admin')->user()->role == Config::get('admin.role.supper_admin.val') ||
            Auth::guard('admin')->user()->role == Config::get('admin.role.quan_ly.val'))
          <li class="nav-item">
            <a href="{{route('admin.baocao.index')}}" class="{{ (request()->is('baocao')) || (request()->is('baocao/filter')) ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon far fa-calendar"></i>
              <p>Báo cáo theo tháng</p>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>