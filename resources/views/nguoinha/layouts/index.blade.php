<!DOCTYPE html>
<html>
<head>
  @include('nguoinha.layouts.head_assets')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Header -->
  @include('nguoinha.layouts.header')
  <!-- Main Sidebar Container -->
  @include('nguoinha.layouts.aside-left')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- Footer -->
  @include('nguoinha.layouts.footer')
</div>
<!-- Script -->
@include('nguoinha.layouts.scripts')
<!-- Page Script -->
{{-- @include('nguoinha.components.modals.alert-action') --}}
</body>
</html>
