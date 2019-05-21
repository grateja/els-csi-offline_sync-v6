<?php

$this->widget('Flashes');
?>
<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'properties-requisition-headers-grid',
    'dataProvider' => $model->searchForApproval(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'id',
            'value' => '$data->id',
            'filter' => false,
        ),
        array(
            'name' => 'date',
            'value' => '$data->date',
            'filter' => false,
        ),
        'ref_no',
        array(
            'name' => 'dept_id',
            'value' => '$data->departments->name',
            'filter' => true,
            'header' => 'Department'
        ),
        array(
            'name' => 'grand_total',
            'value' => '$data->grand_total',
            'filter' => false,
        ),
        array(
            'name' => 'prepared_emp_id',
            'value' => '$data->preparedBy',
            'filter' => false,
            'header' => 'Prepared by'
        ),
        array(
            'name' => 'purpose',
            'filter' => false
        ),
        array(
            'name' => 'remarks',
            'filter' => false
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{approve}', // buttons here...
            'header' => 'Approve Requisition',
            'buttons' => array(// custom buttons options here...
                'approve' => array(
                    'label' => '<span rel = "tooltip" title="Approve Requisition" style="color:#333; font-size:17px; margin-top:2px" class="entypo-icon-thumbs-up"></span>',
                    'url' => 'Yii::app()->createUrl("siteadmin/default/_viewPropertiesRequisitionDetails", array("HeaderId"=>$data->id,"modelHeader"=>$model))',
                    'options' => array(
                        'title' => '',
                    ),
                ),
            ),
            'htmlOptions' => array(
                'style' => 'width: 120px;'
            ),
        ),
    ),
));
?>
