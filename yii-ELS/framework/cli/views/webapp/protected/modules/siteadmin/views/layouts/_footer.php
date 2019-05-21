<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/jquery-ui.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/app.config.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> 
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/notification/SmartNotification.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/smartwidgets/jarvis.widget.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/sparkline/jquery.sparkline.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/jquery-validate/jquery.validate.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/masked-input/jquery.maskedinput.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/select2/select2.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/x-editable/x-editable.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/x-editable/moment.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/x-editable/jquery.mockjax.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/fastclick/fastclick.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/clockpicker/clockpicker.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/intl-tel-input-master/build/js/intlTelInput.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/intl-tel-input-master/build/js/intlTelInput.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/app.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/speech/voicecommand.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/jquery-nestable/jquery.nestable.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/flot/jquery.flot.cust.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/flot/jquery.flot.resize.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/fullcalendar/jquery.fullcalendar.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/alertify/alertify.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/loadingOverlay/waitMe.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/loadingOverlay/scripts.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/bootstrap-tags/bootstrap-tagsinput.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/clockpicker/clockpicker.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/bootstrap/bootstrap.min.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/clockpicker/clockpicker.min.js"></script>
<!--<script src="<?php // print Settings::get_baseUrl(); ?>/smartadmin/js/jquery.datetimepicker.js"></script>-->
<script>
    $(function () {
        $('.datepicker').datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: '1950:2050',
            dateFormat: 'yy-mm-dd'
        });
        $('.clockpicker').clockpicker({
            donetext: 'Done'
        });
//        $('.datetimepicker').datetimepicker({
//            format: 'Y-m-d H:m'
//        });
    });
</script>