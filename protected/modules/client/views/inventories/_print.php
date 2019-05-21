<style>
    /* grid border */
    .grid-view table.items th{
        border-bottom: 1px solid gray !important;
        text-align: center;
        height: 30px;
    } 
    .grid-view table.items td{
        height: 10px;
        border-bottom: 1px solid gray !important;
    } 
    /* disable selected for merged cells */     

    .subtotal{
        float: right  !important;
        font-weight: bold !important;
        font-size: 12px !important;
        margin-bottom: 40px !important;
    }

    .grid-view .summary {
        display: none;
    }

    table
    {
        border-collapse:separate;
        border-spacing:0px 0px;
        width: 100%;
        font-size: 11px;
        font-family: "Arial" !important;
    }
    .extrarow {
        text-align: right !important;
        border-top: 1px solid gray;
        height: 30px;
    }
    .grid-view table.items  {
        /*// border-bottom: 1px solid gray;*/
    } 
</style> 

<div class="article">
    <table style="width: 100%; margin-top: 10px; font-family:'Arial';">
        <tr>
            <td style="text-align:center; font-size: 16px;" colspan="3" ><b>Inventory REPORT</b></td>
        </tr>
    </table><br/>

    <hr style="margin-top: 1px;"/>

    <?php

        $static = array('' => Yii::t('', 'All'));

        $this->widget('ext.groupgridview.GroupGridView', array(
            'id' => 'grid-expr',
            'dataProvider' => $model,
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
                        if (!isset($totals['qty_stock']))
                            $totals['qty_stock'] = 0;
                        $totals['qty_stock'] += $data['qty_stock'];
            },
             'extraRowExpression' => '"<span class=\"subtotal pull-right\"> <b>Total :  ".$totals["qty_stock"]."</b></span>"',
            'columns' => array(
                array(
                    'header' => 'Date Created',
                    'name' => 'created_at',
                    'value' => 'Settings::setDateStandard($data->created_at)',
                    'filter' => false,
                    'headerHtmlOptions' => array(
                        'style' => 'width: 10%;'
                    ),
                ),
                array(
                    'name' => 'category_id',
                    'value' => '$data->inventoryCategories->name',
                    'filter' => false,
                    'headerHtmlOptions' => array(
                        'style' => 'width: 10%;'
                    ),
                ),
                array(
                    'name' => 'id',
                    'header' => 'Item',
                    'value' => '$data->name',
                    'filter' => false,
                    'headerHtmlOptions' => array(
                        'style' => 'width: 10%;'
                    ),
                ),
               
                array(
                    'name' => 'cost',
                    'value' => '$data->cost',
                    'filter' => false,
                    'headerHtmlOptions' => array(
                        'style' => 'width: 10%;'
                    ),
                ),
                array(
                    'name' => 'price',
                    'header' => 'Selling Price',
                    'value' => '$data->price',
                    'filter' => false,
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
                    'filter' => false,
                    'headerHtmlOptions' => array(
                        'style' => 'width: 10%;'
                    ),
                ),
                array(
                    'name' => 'qty_stock',
                    'header' => 'Available',
                    'value' => '$data->qty_stock',
                    'filter' => false,
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



    <br/><br/><br/>
    <table style="width: 30%; margin-bottom: -20px; font-family:'Arial';">
        <tr>
            <td style="text-align:center; font-size: 12px;"><b><?php print Settings::get_Username(); ?></b></td>
        </tr>
        <tr>
            <td style="text-align:center; font-size: 12px;  border-top: 1px solid gray;"><b>Generated By</b></td>
        </tr>
    </table><br/>
</div>
<pagebreak/>