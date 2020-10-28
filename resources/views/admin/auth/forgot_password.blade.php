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
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
      
      <form action="{{ route('sendMailWithToken.forgot.' . $guard) }}" method="post">
        @method('PUT')
        @csrf
        <input type="hidden" name="type" value="{{ $guard }}">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="login.html">Login</a>
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
