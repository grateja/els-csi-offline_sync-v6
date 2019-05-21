
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
            <h3 class="box-title">Expenses</h3>
            <?php echo CHtml::link('<i class="fa fa-print"></i>', $this->createUrl('expenses/print', array('fromDate' => $_GET['fromDate'], 'toDate' => $_GET['toDate'])), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Print')); ?>
        </div>
        <div class="box-body">
            <?php $static = array('' => Yii::t('', 'All')); ?>
            <?php
                $this->widget('ext.groupgridview.GroupGridView', array(
                    'id' => 'grid-expr',
                    'dataProvider' => $result,
                    'filter' => $filtersForm,
                    'mergeColumns' => array('is_deleted'),
                    'extraRowColumns' => array('is_deleted'),
                    'extraRowPos' => 'below',
                    'afterAjaxUpdate' => 'reinstallDatePicker',
                    'ajaxUpdate' => true,
                    'extraRowTotals' => function($data, $row, &$totals) {
//                        if (!isset($totals['count']))
//                            $totals['count'] = 0;
//                        $totals['count'] ++;
//
//                        if (!isset($totals['balance']))
//                            $totals['balance'] = 0;
//                        $totals['balance'] += $data['balance'];
//
                        if (!isset($totals['amount']))
                            $totals['amount'] = 0;
                        $totals['amount'] += $data['amount'];
                    },
                    'extraRowExpression' => '"<span class=\"subtotal pull-right\"> <b>Total : ₱ ".Settings::setNumberFormat($totals["amount"],2)."</b></span>"',
                    'columns' => array(
                        array(
                            'header' => 'Date Created',
                            'name' => 'created_at',
                            'value' => 'Settings::setDateStandard($data->created_at)',
                            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model' => $filtersForm,
                                'attribute' => 'created_at',
                                'htmlOptions' => array(
                                    'class' => 'datePicker',
                                ),
                                'options' => array(
                                    'showOn' => 'focus',
                                    'dateFormat' => 'yy-mm-dd',
                                    'showOtherMonths' => true,
                                    'selectOtherMonths' => true,
                                    'changeMonth' => true,
                                    'changeYear' => true,
                                    'showButtonPanel' => true,
                                )
                                ), true),
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                        array(
                            'name' => 'date',
                            'value' => '$data->date',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                        array(
                            'name' => 'branch_id',
                            'value' => '$data->branches->name',
                            'filter' => CHtml::listData(Branches::model_getAllData_byClientId(Settings::get_ClientID()), 'id', 'name'),
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
//                    array(
//                        'name' => 'client_id',
//                        'value' => '$data->clients->fullName',
//                        'filter' => $static + CHtml::listData(Clients::model_getAllData_byDeleted(Utilities::NO), 'id', 'fullName'),
//                        'headerHtmlOptions' => array(
//                            'style' => 'width: 10%;'
//                        ),
//                    ),
//                    array(
//                        'name' => 'expenses_type_id',
//                        'value' => '$data->expenses_type_id',
//                        'headerHtmlOptions' => array(
//                            'style' => 'width: 10%;'
//                        ),
//                    ),
                        array(
                            'name' => 'title',
                            'value' => '$data->title',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                        array(
                            'name' => 'emp_id',
                            'header' => 'Employee',
                            'value' => '$data->employees->fullName',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                        array(
                            'name' => 'remarks',
                            'value' => '$data->remarks',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                        array(
                            'name' => 'amount',
                            'value' => '$data->amount',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                            'htmlOptions' => array(
                                'text-align' => 'right;'
                            ),
                        ),
                    ),
                ));
            ?>


        </div>
    </div>
</div>