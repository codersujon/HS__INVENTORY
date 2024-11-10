</div>
<!--end wrapper-->

<!-- Bootstrap JS -->
<script src="{{ asset('backend') }}/assets/js/bootstrap.bundle.min.js"></script>


<!--plugins-->
<script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>

{{-- DATA TABLE --}}
<script src="{{ asset('backend') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/select2/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#Transaction-History').DataTable({
            lengthMenu: [[7, 10, 20, -1], [7, 10, 20, 'Todos']]
        });
      } );
</script>
<script>
    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
    $('.multiple-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });

</script>

<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });

</script>
<script>
    $(document).ready(function () {
        var table = $('#example2').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#example2_wrapper .col-md-6:eq(0)');
    });

</script>

<script src="{{ asset('backend') }}/assets/plugins/chartjs/js/Chart.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-knob/excanvas.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-knob/jquery.knob.js"></script>

<script src="{{ asset('backend') }}/assets/plugins/datetimepicker/js/legacy.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/datetimepicker/js/picker.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/datetimepicker/js/picker.time.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/datetimepicker/js/picker.date.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/bootstrap-material-datetimepicker/js/moment.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js"></script>

<script>
    $('.datepicker').pickadate({
        selectMonths: true,
        selectYears: true
    }),
    $('.timepicker').pickatime()
</script>
<script>
    $(function () {
        $('#date-time').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD HH:mm'
        });
        $('#date').bootstrapMaterialDatePicker({
            time: false
        });
        $('#time').bootstrapMaterialDatePicker({
            date: false,
            format: 'HH:mm'
        });
    });
</script>

<script>
    $(function () {
        $(".knob").knob();
    });
</script>
<script src="{{ asset('backend') }}/assets/js/index.js"></script>
<script src="{{ asset('backend') }}/assets/js/jquery.validate.min.js"></script>
<script src="{{ asset('backend') }}/assets/js/validationMessage.js"></script>
<script src="{{ asset('backend') }}/assets/js/notify.min.js"></script>
<script src="{{ asset('backend') }}/assets/js/handlebars.js"></script>
<script src="{{ asset('backend') }}/assets/js/ajax.js"></script>
<!--app JS-->
<script src="{{ asset('backend') }}/assets/js/app.js"></script>

</body>

</html>
