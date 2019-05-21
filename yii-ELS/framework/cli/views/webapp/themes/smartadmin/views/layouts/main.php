<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <title><?php print Settings::model_getValue_byID(Settings::CONFIG_COMPANY_NAME)->value?></title>
        <meta name="description" content="">
        <meta name="author" content="">	
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php print Settings::get_baseUrl(); ?>/smartadmin/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php print Settings::get_baseUrl(); ?>/smartadmin/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php print Settings::get_baseUrl(); ?>/smartadmin/css/smartadmin-production.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php print Settings::get_baseUrl(); ?>/smartadmin/css/smartadmin-skins.min.css">
        <link rel="apple-touch-icon" href="<?php print Settings::get_baseUrl(); ?>/smartadmin/img/splash/sptouch-icon-iphone.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php print Settings::get_baseUrl(); ?>/smartadmin/img/splash/touch-icon-ipad.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php print Settings::get_baseUrl(); ?>/smartadmin/img/splash/touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php print Settings::get_baseUrl(); ?>/smartadmin/img/splash/touch-icon-ipad-retina.png">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php print Settings::get_baseUrl(); ?>/css/flashes.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php print Settings::get_baseUrl(); ?>/css/ajax-loader.css">
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/css/icons.css" />
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/alertify/css/alertify.css" />
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/alertify/css/alertify.default.css" />
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/alertify/css/alertify.core.css" />
        <link rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/intl-tel-input-master/build/css/intlTelInput.css" />
        <link type="text/css" rel="stylesheet" href="<?php print Settings::get_baseUrl(); ?>/smartadmin/css/loadingOverlay/waitMe.css">
        <link rel="shortcut icon" href="<?php print Settings::get_baseUrl(); ?>/images/favicon.png" type="image/x-icon">
    </head>
    <body class="animated fadeInDown fixed-page-footer">        
        <?php print $content; ?>
    </body>
</html>
