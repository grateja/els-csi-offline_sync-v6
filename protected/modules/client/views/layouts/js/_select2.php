<?php

Yii::app()->clientScript->registerScript("select2", "
        $(function(){
            $('select').select2();
            $('.select2-hidden-accessible').attr('hidden','true');
        });
    ", 2);
?>