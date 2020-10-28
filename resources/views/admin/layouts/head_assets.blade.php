<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Aquila | Dashboard</title>
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

{{ Html::style('admin_assets/plugins/fontawesome-free/css/all.min.css') }}
{{ Html::style('admin_assets/plugins/select2/css/select2.min.css') }}
{{ Html::style('admin_assets/plugins/fontawesome-free/css/all.min.css') }}
{{ Html::style('admin_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}
<!-- {{ Html::style('admin_assets/plugins/jqvmap/dist/jqvmap.min.css') }} -->
{{ Html::style('admin_assets/dist/css/adminlte.css') }}
<!-- daterange picker -->
{{ Html::style('admin_assets/plugins/daterangepicker/daterangepicker.css') }}
<!-- Tempusdominus Bbootstrap 4 -->
{{ Html::style('admin_assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}
<!-- color-picker -->
{{ Html::style('admin_assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}
<!-- date time-picker -->
{{ Html::style('admin_assets/plugins/bootstrap-datepicker/bootstrap-datepicker.css') }}
<!-- i check -->
{{ Html::style('admin_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}

{{ Html::style('admin_assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}

<!-- {{ Html::style('admin_assets/plugins/summernote/dist/summernote-bs4.css') }} -->
{{ Html::style('admin_assets/plugins/sweetalert2/sweetalert2.min.css') }}
{{ Html::style('admin_assets/plugins/toastr/toastr.min.css') }}

{{ Html::style('admin_assets/dist/css/admin.css') }}
<!-- DataTables -->
{{ Html::style('admin_assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}
{{ Html::style('admin_assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}
{{ Html::style('admin_assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}

<link rel="stylesheet" type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.10/css/dataTables.checkboxes.css">
<!-- fullCalendar -->
{{ Html::style('admin_assets/plugins/fullcalendar/main.min.css') }}
<!-- {{ Html::style('admin_assets/plugins/fullcalendar-interaction/main.min.css') }} -->
{{ Html::style('admin_assets/plugins/fullcalendar-daygrid/main.min.css') }}
{{ Html::style('admin_assets/plugins/fullcalendar-timegrid/main.min.css') }}
{{ Html::style('admin_assets/plugins/fullcalendar-bootstrap/main.min.css') }}

@yield('styles')
