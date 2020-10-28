<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
{{ Html::script('admin_assets/plugins/jquery/jquery.min.js') }}
{{ Html::script('admin_assets/plugins/jquery-ui/jquery-ui.min.js') }}
<!-- Bootstrap -->
{{ Html::script('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}
<!-- overlayScrollbars -->
{{ Html::script('admin_assets/plugins/chart.js/Chart.min.js') }}
{{ Html::script('admin_assets/plugins/sparklines/sparkline.js') }}
{{ Html::script('admin_assets/plugins/jqvmap/jquery.vmap.min.js') }}
{{ Html::script('admin_assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}
{{ Html::script('admin_assets/plugins/jquery-knob/jquery.knob.min.js') }}
{{ Html::script('admin_assets/plugins/moment/moment.min.js') }}
{{ Html::script('admin_assets/plugins/daterangepicker/daterangepicker.js') }}
{{ Html::script('admin_assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}
{{ Html::script('admin_assets/plugins/summernote/summernote-bs4.min.js') }}
{{ Html::script('admin_assets/plugins/select2/js/select2.min.js') }}
{{ Html::script('admin_assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}

{{ Html::script('admin_assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}

{{ Html::script('admin_assets/plugins/sweetalert2/sweetalert2.all.min.js') }}

{{-- {{ Html::script('admin_assets/plugins/jquery-mousewheel/jquery.mousewheel.js') }}
{{ Html::script('admin_assets/plugins/raphael/raphael.min.js') }}
{{ Html::script('admin_assets/plugins/jquery-mapael/jquery.mapael.min.js') }}
{{ Html::script('admin_assets/plugins/jquery-mapael/maps/usa_states.min.js') }}
{{ Html::script('admin_assets/plugins/timepicker/bootstrap-timepicker.min.js') }} --}}
<!-- ChartJS -->
<!-- PAGE SCRIPTS -->

{{ Html::script('admin_assets/plugins/datatables/jquery.dataTables.js') }}
{{ Html::script('admin_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}
<!-- DataTables -->
{{ Html::script('admin_assets/dist/js/adminlte.js') }}
<!-- {{ Html::script('admin_assets/dist/js/pages/dashboard2.js') }} -->
{{ Html::script(mix('admin/admin.js')) }}
{{ Html::script(mix('client_assets/js/diemdanh.js')) }}
@yield('scripts')