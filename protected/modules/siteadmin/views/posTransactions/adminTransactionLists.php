<?php
    Yii::app()->clientScript->registerScript("javascript", "

    $( 'input' ).addClass('form-control' );

    function reinstallDatePicker(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
        $('.datePicker').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['ja'],{'dateFormat':'yy-mm-dd'}));

        $( 'input' ).addClass('form-control' );
        $('select').select2({ width: 'resolve' });
        $('.select2-hidden-accessible').attr('hidden', true);
    }
", 2);
?>

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Transactions</h3>
            <?php // echo CHtml::link('<i class="fa fa-plus"></i>', $this->createUrl('posTransactions/create'), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
        </div>
        <div class="box-body">
            <?php $static = array('' => Yii::t('', 'All')); ?>
            <?php
                $this->widget('ext.groupgridview.GroupGridView', array(
                    'id' => 'grid-expr',
                    'dataProvider' => $result,
                    'filter' => $filtersForm,
                    'mergeColumns' => array('cust_id'),
                    'extraRowColumns' => array('cust_id'),
                    'extraRowPos' => 'below',
                    'afterAjaxUpdate' => 'reinstallDatePicker',
                    'ajaxUpdate' => true,
                    'extraRowTotals' => function($data, $row, &$totals) {
                        if (!isset($totals['count']))
                            $totals['count'] = 0;
                        $totals['count'] ++;

                        if (!isset($totals['balance']))
                            $totals['balance'] = 0;
                        $totals['balance'] += $data['balance'];

                        if (!isset($totals['amount_net']))
                            $totals['amount_net'] = 0;
                        $totals['amount_net'] += $data['amount_net'];
                    },
                    'extraRowExpression' => '"<span class=\"subtotal pull-right\"> <b>Total : ₱ ".Settings::setNumberFormat($totals["amount_net"],2)."</b></span>"',
                    'columns' => array(
                        array(
                            'name' => 'cust_id',
                            'header' => 'Customer',
                            'value' => '$data->customers->lnameFname',
                            'filter' => $static + CHtml::listData(Customers::model_getAllData_byDeleted(Utilities::NO), 'id', 'lnameFname'),
                            'htmlOptions' => array(
                                'style' => 'width: 150px;text-align: left'
                            ),
                            'headerHtmlOptions' => array(
                                'style' => 'text-align: center !important; (background-color:powderblue;)'
                            ),
                        ),
                        array(
                            'name' => 'updated_at',
                            'value' => 'Settings::setDateTimeStandard($data->updated_at)',
                            'header' => 'Date',
                            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model' => $filtersForm,
                                'attribute' => 'updated_at', // This is how it works for me.
                                //'language' => 'pl',
                                'htmlOptions' => array(
                                    'class' => 'datePicker',
                                ),
                                'options' => array(// (#3)
                                    'showOn' => 'focus',
                                    'dateFormat' => 'yy-mm-dd',
                                    'showOtherMonths' => true,
                                    'selectOtherMonths' => true,
                                    'changeMonth' => true,
                                    'changeYear' => true,
                                    'showButtonPanel' => true,
                                )
                                ), true),
                            'htmlOptions' => array(
                                'style' => 'width: 150px;'
                            ),
                            'headerHtmlOptions' => array(
                                'style' => 'text-align: center; (background-color:powderblue;)'
                            ),
                        ),
                        array(
                            'name' => 'inv_id',
                            'header' => 'Item',
                            'value' => '$data->inventories->name',
                            'filter' => $static + CHtml::listData(Inventories::model_getAllData_byDeleted(Utilities::NO), 'id', 'name'),
                            'htmlOptions' => array(
                                'style' => 'width: 150px;text-align: center'
                            ),
                            'headerHtmlOptions' => array(
                                'style' => 'text-align: center !important; (background-color:powderblue;)'
                            ),
                        ),
                        array(
                            'name' => 'qty',
                            'value' => '$data->qty',
                            'headerHtmlOptions' => array(
                                'style' => 'text-align: center; (background-color:powderblue;)'
                            ), 'htmlOptions' => array(
                                'style' => 'width: 150px;text-align: center'
                            ),
                        ),
                        array(
                            'name' => 'price',
                            'value' => '$data->price',
                            'headerHtmlOptions' => array(
                                'style' => 'text-align: right; (background-color:powderblue;)'
                            ), 'htmlOptions' => array(
                                'style' => 'width: 150px;text-align: right'
                            ),
                        ),
                        array(
                            'name' => 'amount_net',
                            'header' => 'Amount',
                            'value' => '$data->amount_net',
                            'filter' => false, 'htmlOptions' => array(
                                'style' => 'width: 150px;text-align: right'
                            ),
                            'headerHtmlOptions' => array(
                                'style' => 'text-align: right; (background-color:powderblue;)'
                            ),
                        ),
                        array(
                            'name' => 'remarks',
                            'header' => 'Remarks',
                            'value' => '$data->remarks',
                            'htmlOptions' => array(
                                'style' => 'width: 150px;text-align: center'
                            ),
                            'headerHtmlOptions' => array(
                                'style' => 'text-align: center !important; (background-color:powderblue;)'
                            ),
                        ),
                        array(
                            'name' => 'is_fully_paid',
                            'header' => 'Paid',
                            'value' => '$data->isFullyPaid',
                            'filter' => Utilities::get_ActiveSelect(),
                            'htmlOptions' => array(
                                'style' => 'width: 150px;text-align: right'
                            ),
                            'headerHtmlOptions' => array(
                                'style' => 'text-align: right; (background-color:powderblue;)'
                            ),
                        ),
//                         array(
//                        'class' => 'CButtonColumn',
//                        'header' => 'Action',
//                        'template' => '{view}',
//                        'viewButtonLabel' => '<span class="minia-icon-search"></span>',
//                        'viewButtonOptions' => ['title' => '', 'data-tooltip' => 'View',],
//                        'viewButtonImageUrl' => false,
//                        'updateButtonLabel' => '<span class="icomoon-icon-pencil-2"></span>',
//                        'updateButtonOptions' => ['title' => '', 'data-tooltip' => 'Update',],
//                        'updateButtonImageUrl' => false,
//                        'deleteButtonLabel' => '<span style="color:red;" class="icomoon-icon-remove"></span>',
//                        'deleteButtonOptions' => ['title' => '', 'data-tooltip' => 'Delete',],
//                        'deleteButtonImageUrl' => false,
//                        'deleteConfirmation' => 'Are you sure you want to delete?',
//                        'htmlOptions' => array(
//                            'style' => 'width: 100px;'
//                        ),
//                    ),
                    ),
                ));
            ?>


        </div>
    </div>
</div>