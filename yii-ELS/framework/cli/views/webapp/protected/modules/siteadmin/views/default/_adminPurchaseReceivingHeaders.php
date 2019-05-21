<?php

$this->widget('Flashes');
?>
<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'purchase-receiving-headers-grid',
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
        'purchase_order_id',
        'po_no',
        'rr_no',
        array(
            'name' => 'supplier_id',
            'value' => '$data->suppliers->name',
            'filter' => true,
            'header' => 'Supplier'
        ),
        array(
            'name' => 'grand_total',
            'filter' => false
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{approve}', // buttons here...
            'header' => 'Approve RR',
            'buttons' => array(// custom buttons options here...
                'approve' => array(
                    'label' => '<span rel = "tooltip" title="Approve RR" style="color:#333; font-size:17px; margin-top:2px" class="entypo-icon-thumbs-up"></span>',
                    'url' => 'Yii::app()->createUrl("siteadmin/default/_viewPurchaseReceivingDetails", array("HeaderId"=>$data->id))',
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
