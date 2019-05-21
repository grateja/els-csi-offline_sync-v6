<?php

$this->widget('ext.YiiDateTimePicker.jqueryDateTime', array(
    'name' => $attribute,
    'model' => $model,
    'attribute' => $attribute,
    'options' => array(
        'format' => 'H:i:s',
        'datepicker' => false,
        'value' => ($_SESSION[$table]['time'] == '' || $_SESSION[$table]['time'] == '00:00:00') ? NULL : $_SESSION[$table]['time'],
    //'theme' => 'dark',
    ), //DateTimePicker options
    'htmlOptions' => array(
        'disabled' => $disabled,
        'onblur' => 'setSessionData("' . $attribute . '",this.value)',
        'placeholder' => $placeholder
    ),
));
?>