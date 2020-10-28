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
      <p class="login-box-msg info-box-text">Đăng nhập</p>

      <form action="{{route('store.' . $guard)}}" method="post">
        @csrf
        <input type="hidden" name="type" value="{{ $guard }}">
        
        <div class="input-group mb-3">
          @if ($guard == "nguoibaoho")
            <input type="text" class="form-control" name="username" placeholder="số điện thoại của bạn">
          @endif
          @if ($guard == "admin")
            <input type="email" class="form-control" name="email" placeholder="Email">
          @endif
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="icheck-primary mb-3">
              <input type="checkbox" id="remember_me" name="remember_me">
              <label for="remember">
                Ghi nhớ đăng nhập
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
          </div>
          <!-- /.col -->
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
