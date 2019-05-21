<?php
    header('Cache-Control: cache'); //no cache
    session_start();
    error_reporting(1);
    date_default_timezone_set('Asia/Manila');
    $yii=dirname(__FILE__).'/../framework/yii.php';
    $config=dirname(__FILE__).'/protected/config/main.php';
    defined('YII_DEBUG') or define('YII_DEBUG',true);
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
    require_once($yii);
    Yii::createWebApplication($config)->run();
