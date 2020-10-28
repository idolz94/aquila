<!DOCTYPE html>
<html>
<head>
  @include('admin.layouts.head_assets')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <div class="mess-role"
        data-role-admin="{{Auth::guard('admin')->user()->role }}"
  >
    </div>
  <!-- Header -->
  @include('admin.layouts.header')
  <!-- Main Sidebar Container -->
  @include('admin.layouts.aside-left')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- Footer -->
  @include('admin.layouts.footer')
  <div class="bg-load" style="display:none">
    <div class="lds-roller">
      <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
    </div>
  </div> 
</div>
<!-- Script -->
@include('admin.layouts.scripts')
<!-- Page Script -->
@include('admin.components.modals.alert-action')
</body>
</html>
