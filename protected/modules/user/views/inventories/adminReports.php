
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
            <h3 class="box-title">Inventory</h3>
             <?php echo CHtml::link('<i class="fa fa-print"></i>', $this->createUrl('inventories/print', array('fromDate' => $_GET['fromDate'], 'toDate' => $_GET['toDate'])), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Print')); ?>
       </div>
        <div class="box-body">
            <?php $static = array('' => Yii::t('', 'All')); ?>
            <?php
                $this->widget('ext.groupgridview.GroupGridView', array(
                    'id' => 'grid-expr',
                    'dataProvider' => $result,
                    'filter' => $filtersForm,
                    'mergeColumns' => array('is_deleted'),
//                    'extraRowColumns' => array('category_id'),
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
//                        if (!isset($totals['amount_net']))
//                            $totals['amount_net'] = 0;
//                        $totals['amount_net'] += $data['amount_net'];
                    },
                  //  'extraRowExpression' => '"<span class=\"subtotal pull-right\"> <b>Total : ₱ ".Settings::setNumberFormat($totals["amount_net"],2)."</b></span>"',
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
                            'name' => 'category_id',
                            'value' => '$data->inventoryCategories->name',
                            'filter' => $static + CHtml::listdata(InventoryCategories::model_getAllData_byDeleted(Utilities::NO), 'id', 'name'),
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                        array(
                            'name' => 'id',
                            'header' => 'Item',
                            'value' => '$data->name',
                            'filter' => $static + CHtml::listData(Inventories::model_getAllData_byDeleted(Utilities::NO), 'id', 'name'),
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                        array(
                            'header' => 'Product Pic',
                            'type' => 'html',
                            'value' => '(!empty($data->file_pics))?CHtml::image(Settings::get_baseUrl()."/".$data->file_path . "/".$data->file_pics,"",array("style"=>"width:50px;height:50px;")):CHtml::image(Settings::get_baseUrl()."/images/noimage.png","",array("style"=>"width:40px;height:40px;"))',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
//                        array(
//                            'name' => 'bar_code',
//                            'value' => '$data->bar_code',
//                            'headerHtmlOptions' => array(
//                                'style' => 'width: 10%;'
//                            ),
//                        ),
                        array(
                            'name' => 'cost',
                            'value' => '$data->cost',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                        array(
                            'name' => 'price',
                            'header' => 'Selling Price',
                            'value' => '$data->price',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
//                        array(
//                            'name' => 'tax',
//                            'value' => '$data->tax',
//                            'headerHtmlOptions' => array(
//                                'style' => 'width: 10%;'
//                            ),
//                        ),
                        array(
                            'name' => 'qty_reorder',
                            'header' => 'Reorder Qty',
                            'value' => '$data->qty_reorder',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                        array(
                            'name' => 'qty_stock',
                            'header' => 'Available',
                            'value' => '$data->qty_stock',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
//                        array(
//                            'name' => 'is_deleted',
//                            'value' => 'Utilities::get_activeSelect($data->is_deleted)',
//                            'filter' => Utilities::get_ActiveSelect(),
//                            'headerHtmlOptions' => array(
//                                'style' => 'width: 10%;'
//                            ),
//                        ),
                       
                    ),
                ));
            ?>


        </div>
    </div>
</div>