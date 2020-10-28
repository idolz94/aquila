<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Aquila | Nguoi Nha</title>
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

{{ Html::style('admin_assets/plugins/fontawesome-free/css/all.min.css') }}
<!-- {{ Html::style('admin_assets/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css') }} -->
{{ Html::style('admin_assets/plugins/select2/css/select2.min.css') }}

{{ Html::style('admin_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}
<!-- {{ Html::style('admin_assets/plugins/jqvmap/dist/jqvmap.min.css') }} -->
{{ Html::style('admin_assets/dist/css/adminlte.min.css') }}

{{ Html::style('admin_assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}
{{ Html::style('admin_assets/plugins/daterangepicker/daterangepicker.css') }}
<!-- {{ Html::style('admin_assets/plugins/summernote/dist/summernote-bs4.css') }} -->
{{ Html::style('admin_assets/plugins/sweetalert2/sweetalert2.min.css') }}
{{ Html::style('admin_assets/plugins/toastr/toastr.min.css') }}
{{ Html::style('client_assets/dist/css/client.css') }}

{{-- {{ Html::style('admin_assets/dist/css/admin.css') }} --}}
{{-- {{ Html::style('admin_assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }} --}}
{{-- {{ Html::style('css/_datatable.net.css') }} --}}

@yield('styles')
