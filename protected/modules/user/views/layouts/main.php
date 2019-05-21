<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php print Branches::model_getValue_byID(Settings::get_BranchID())->name ?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!--Dashboard 1-->
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/bootstrap/dist/css/bootstrap.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/adminlte/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/adminlte/dist/css/skins/_all-skins.min.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/morris/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/jvectormap/jquery-jvectormap.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

        <!--Dashboard 2->
        <!-- Ionic Icons -->
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <!--Others-->
        <link rel="shortcut icon" href="<?php print Settings::get_baseUrl(); ?>/images/favicon.png" type="image/x-icon">
        <!-- Select2 -->
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/select2/dist/css/select2.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/adminlte/bower_components/font-awesome/css/font-awesome.min.css">

        <link rel="stylesheet" type="text/css" media="screen" href="<?php print Settings::get_baseUrl(); ?>/css/flashes.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php print Settings::get_baseUrl(); ?>/css/ajax-loader.css">
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/css/icons.css" />
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/alertify/css/alertify.css" />
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/alertify/css/alertify.default.css" />
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/alertify/css/alertify.core.css" />
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/intl-tel-input-master/build/css/intlTelInput.css" />
        <link type="text/css" rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/smartadmin/css/loadingOverlay/waitMe.css">
        <!--<link rel="stylesheet" type="text/css" media="screen" href="<?php // print Settings::get_baseUrl()     ?>/smartadmin/css/smartadmin-production.min.css">-->

    </head>
    <!--<body class="hold-transition skin-blue sidebar-mini">-->
    <?php
        $cs = Yii::app()->clientScript;
        $cs->scriptMap = array(
            'jquery.js' => false,
        );
        $cs->coreScriptPosition = CClientScript::POS_END;
    ?>
    <body class="hold-transition skin-blue  sidebar-mini">
        <div class="wrapper">
            <?php $this->renderPartial('/layouts/_header'); ?>
            <?php $this->renderPartial('/layouts/_left'); ?>
            <div class="content-wrapper">
                <section class="content-header">
                    <?php $this->renderPartial('/layouts/_ribbon'); ?>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <?php $this->renderPartial('/layouts/js/_select2'); ?>
                        <?php $this->widget('Flashes'); ?>
                        <?php print $content; ?>
                    </div>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <?php $this->renderPartial('/layouts/_footer'); ?>
        </div><!-- ./wrapper -->
        <?php $this->renderPartial('/layouts/_footerScript'); ?>
    </body>
</html>