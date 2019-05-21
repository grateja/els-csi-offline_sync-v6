<?php

$this->widget('Flashes');
?>
<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'purchase-order-headers-grid',
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
        'po_no',
//            array(
//                'name' => 'purchase_requisition_header_id',
//                'filter' => true,
//                'header' => 'PR ID'
//            ),
        'pr_no',
        array(
            'name' => 'supplier_id',
            'value' => '$data->suppliers->name',
            'filter' => true,
            'header' => 'Supplier'
        ),
        array(
            'name' => 'prepared_emp_id',
            'value' => '$data->preparedBy',
            'filter' => false,
            'header' => 'Prepared by'
        ),
        array(
            'name' => 'source_documents',
            'filter' => false
        ),
        array(
            'name' => 'grand_total',
            'filter' => false
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{approve}', // buttons here...
            'header' => 'Approve PO',
            'buttons' => array(// custom buttons options here...
                'approve' => array(
                    'label' => '<span rel = "tooltip" title="Approve PO" style="color:#333; font-size:17px; margin-top:2px" class="entypo-icon-thumbs-up"></span>',
                    'url' => 'Yii::app()->createUrl("siteadmin/default/_viewPurchaseOrderDetails", array("HeaderId"=>$data->id))',
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
