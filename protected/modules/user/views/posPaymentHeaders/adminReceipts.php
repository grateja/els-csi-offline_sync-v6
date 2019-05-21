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
            <h3 class="box-title">Receipts</h3>
            <?php echo CHtml::link('<i class="fa fa-plus"></i>', $this->createUrl('posPaymentHeaders/create'), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
        </div>
        <div class="box-body">
            <?php $static = array('' => Yii::t('', 'All')); ?>
            <?php
                $this->widget('ext.groupgridview.GroupGridView', array(
                    'id' => 'grid-expr',
                    'dataProvider' => $result,
                    'filter' => $filtersForm,
                    'mergeColumns' => array('or_no'),
//                    'extraRowColumns' => array('or_no'),
                    'extraRowPos' => 'below',
                    'afterAjaxUpdate' => 'reinstallDatePicker',
                    'ajaxUpdate' => true,
                    'extraRowTotals' => function($data, $row, &$totals) {
                        if (!isset($totals['count']))
                            $totals['count'] = 0;
                        $totals['count'] ++;

                        if (!isset($totals['payable']))
                            $totals['payable'] = 0;
                        $totals['payable'] += $data['payable'];

                        if (!isset($totals['amount_net']))
                            $totals['amount_net'] = 0;
                        $totals['amount_net'] += $data['amount_net'];
                    },
//                    'extraRowExpression' => '"<span class=\"subtotal pull-right\"> <b>Total Balance: ₱ ".Settings::setNumberFormat($totals["amount_net"],2)."</b></span>"',
                    'columns' => array(
                        array(
                            'name' => 'customer_id',
                            'header' => 'Customer',
                            'value' => '$data->customers->lnameFname',
                            'filter' => $static + CHtml::listData(Customers::model_getAllData_byDeletedCLientID(Utilities::NO, Settings::get_ClientID()), 'id', 'lnameFname'),
                            'htmlOptions' => array(
                                'style' => 'width: 150px;text-align: center'
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
                                'i18nScriptFile' => 'jquery.ui.datepicker-ja.js',
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
                            'name' => 'or_no',
                            'value' => '$data->or_no',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                        array(
                            'name' => 'quantity',
                            'value' => '$data->quantity',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                        array(
                            'name' => 'discount',
                            'value' => '$data->discount',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                        array(
                            'name' => 'amount_net',
                            'header' => 'Amount Tendered',
                            'value' => '$data->amount_net',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                         array(
                            'name' => 'amount_change',
                            'header' => 'Change',
                            'value' => '$data->change',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                        array(
                            'class' => 'CButtonColumn',
                            'header' => 'Action',
                            'template' => '{view}',
                            'viewButtonLabel' => '<span class="minia-icon-search"></span>',
                            'viewButtonOptions' => ['title' => '', 'data-tooltip' => 'View',],
                            'viewButtonImageUrl' => false,
                            'updateButtonLabel' => '<span class="icomoon-icon-pencil-2"></span>',
                            'updateButtonOptions' => ['title' => '', 'data-tooltip' => 'Update',],
                            'updateButtonImageUrl' => false,
                            'deleteButtonLabel' => '<span style="color:red;" class="icomoon-icon-remove"></span>',
                            'deleteButtonOptions' => ['title' => '', 'data-tooltip' => 'Delete',],
                            'deleteButtonImageUrl' => false,
                            'deleteConfirmation' => 'Are you sure you want to delete?',
                            'htmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                    ),
                ));
            ?>
        </div>
    </div>
</div>