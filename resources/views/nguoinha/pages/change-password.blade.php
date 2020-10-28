<!DOCTYPE html>
<html>
<head>
  @include('admin.layouts.head_assets')
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#">
      <img src="admin_assets/images/logo/logo-aq-h.png" width="50%" alt="Aquila center - Trung tâm giải cứu">
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg info-box-text">Đổi mật khẩu</p>

      <form action="{{route('changepassword.store.' . $guard)}}" method="post">
        @csrf
        <input type="hidden" name="type" value="{{ $guard }}">
        
        <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Mật khẩu cũ">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password-new" placeholder="Mật khẩu mới">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Đổi mật khẩu</button>
          </div>
        </div>
      </form>
      <p class="mb-3 mt-3">
      </p>
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- Script -->
@include('admin.layouts.scripts')
<!-- Page Script -->
@yield('script')
</body>
</html>
