
<script src="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/raphael/raphael.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php print Settings::get_baseUrl(); ?>/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/moment/min/moment.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php print Settings::get_baseUrl(); ?>/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php print Settings::get_baseUrl(); ?>/adminlte/dist/js/adminlte.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/Chart.js/Chart.js"></script>

<!--Others-->
<!-- Select2 -->
<script src="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
<!--<script src="<?php print Settings::get_baseUrl() ?>/smartadmin/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="<?php print Settings::get_baseUrl() ?>/smartadmin/js/plugin/datatables/dataTables.colReorder.min.js"></script>-->
<!--<script src="<?php print Settings::get_baseUrl() ?>/smartadmin/js/plugin/datatables/dataTables.bootstrap.min.js"></script>--> 
<script src="<?php print Settings::get_baseUrl() ?>/smartadmin/js/plugin/datatables/jquery.dataTables.min.js"></script> 
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/notification/SmartNotification.min.js"></script>   
<script src="<?php print Settings::get_baseUrl(); ?>/adminlte/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script src="<?php print Settings::get_baseUrl() ?>/smartadmin/js/plugin/uploader/js/vendor/jquery.ui.widget.js"></script>
<script src="<?php print Settings::get_baseUrl() ?>/smartadmin/js/plugin/uploader/js/jquery.iframe-transport.js"></script>
<script src="<?php print Settings::get_baseUrl() ?>/smartadmin/js/plugin/uploader/js/jquery.fileupload.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/TableExport/dist/js/tableexport.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/FileSaver/FileSaver.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/xlxs/xlsx.core.min.js"></script>

<script>


        $(function () {
            $('.datepicker').datepicker({
                autoclose: true
            });
            $("select").select2({
                width: 'resolve'
            });
            $('.salaryExpensesTypeID').val(<?= ExpensesTypes::EXPENSES_TYPE_SALARIES?>);

        });
        function messageBox(val, message) {
            if (val == 1) {
                $.smallBox({
                    title: 'Message!',
                    content: message,
                    color: '#739E73',
                    icon: 'fa fa-check shake animated',
                    number: '1',
                    timeout: 1000
                });
            } else {
                $.smallBox({
                    title: 'Warning!',
                    content: message,
                    color: '#C46A69',
                    icon: 'fa fa-warning shake animated',
                    number: '1',
                    timeout: 1000
                });
            }

            return 0;
        }

        function numberWithCommas(num) {
            var parts = num.toString().split('.');
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            return parts.join('.');
        }


       
</script>
