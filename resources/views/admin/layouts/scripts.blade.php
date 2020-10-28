<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
{{ Html::script('admin_assets/plugins/jquery/jquery.min.js') }}
{{ Html::script('admin_assets/plugins/jquery-ui/jquery-ui.min.js') }}
<!-- Bootstrap -->
{{ Html::script('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}
<!-- overlayScrollbars -->
{{ Html::script('admin_assets/plugins/moment/moment.min.js') }}
<!-- date-range-picker -->
{{ Html::script('admin_assets/plugins/daterangepicker/daterangepicker.js') }}

<!-- Tempusdominus Bootstrap 4 -->
{{ Html::script('admin_assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js') }}
{{ Html::script('admin_assets/plugins/summernote/summernote-bs4.min.js') }}
{{ Html::script('admin_assets/plugins/select2/js/select2.min.js') }}
{{ Html::script('admin_assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}
<!-- color-picker -->
{{ Html::script('admin_assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}

{{ Html::script('admin_assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}

{{ Html::script('admin_assets/plugins/sweetalert2/sweetalert2.all.min.js') }}


<!-- ChartJS -->

<!-- fullCalendar 2.2.5 -->
{{ Html::script('admin_assets/plugins/fullcalendar/main.min.js') }}
{{ Html::script('admin_assets/plugins/fullcalendar/locales/vi.js') }}
{{ Html::script('admin_assets/plugins/fullcalendar-daygrid/main.min.js') }}
{{ Html::script('admin_assets/plugins/fullcalendar-timegrid/main.min.js') }}
{{ Html::script('admin_assets/plugins/fullcalendar-interaction/main.min.js') }}
{{ Html::script('admin_assets/plugins/fullcalendar-bootstrap/main.min.js') }}
{{ Html::script('admin_assets/plugins/tooltip-popper/popper.min.js') }}
{{ Html::script('admin_assets/plugins/tooltip-popper/tooltip.min.js') }}

<!-- InputMask -->
{{ Html::script('admin_assets/plugins/inputmask/jquery.inputmask.bundle.js') }}
<!-- DataTables -->
{{ Html::script('admin_assets/plugins/datatables/jquery.dataTables.js') }}
{{ Html::script('admin_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}
{{ Html::script('admin_assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}
{{ Html::script('admin_assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}
{{ Html::script('admin_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}
{{ Html::script('admin_assets/plugins/datatables-buttons/js/buttons.print.min.js') }}
{{ Html::script('admin_assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}
{{ Html::script('admin_assets/plugins/datatables-select/js/dataTables.select.min.js') }}
{{ Html::script('admin_assets/plugins/dataTables.checkboxes.min.js') }}

<!-- Sheet js -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.5/xlsx.full.min.js"></script> 
{{ Html::script('admin_assets/plugins/simple-money/simple.money.format.js') }}
{{ Html::script('admin_assets/dist/js/adminlte.js') }}
{{ Html::script(mix('admin/admin.js')) }}
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<!-- PAGE SCRIPTS -->
@yield('scripts')