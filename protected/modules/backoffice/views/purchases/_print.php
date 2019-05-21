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
            <td style="text-align:center; font-size: 16px;" colspan="3" ><b>Purchases REPORT</b></td>
        </tr>
    </table><br/>

    <hr style="margin-top: 1px;"/>

    <?php

        $static = array('' => Yii::t('', 'All'));

        $this->widget('ext.groupgridview.GroupGridView', array(
            'id' => 'grid-expr',
            'dataProvider' => $model,
//            'mergeColumns' => array('is_deleted'),
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
                if (!isset($totals['total']))
                    $totals['total'] = 0;
                $totals['total'] += $data['total'];
            },
            'extraRowExpression' => '"<span class=\"subtotal pull-right\"> <b>Total : ₱ ".Settings::setNumberFormat($totals["total"],2)."</b></span>"',
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
                    'header' => 'Purchase Date',
                    'name' => 'date ',
                    'value' => 'Settings::setDateStandard($data->date)',
                    'filter' => false,
                    'headerHtmlOptions' => array(
                        'style' => 'width: 10%;'
                    ),
                ),
                array(
                    'name' => 'inv_id',
                    'header' => 'Item',
                    'value' => '$data->inventories->name',
                    'filter' => false,
                    'headerHtmlOptions' => array(
                        'style' => 'width: 10%;'
                    ),
                ),
                array(
                    'name' => 'qty',
                    'value' => '$data->qty',
                    'filter' => false,
                    'headerHtmlOptions' => array(
                        'style' => 'width: 10%;'
                    ),
                ),
                array(
                    'name' => 'price',
                    'header' => 'Cost',
                    'value' => '$data->price',
                    'filter' => false,
                    'headerHtmlOptions' => array(
                        'style' => 'width: 10%;'
                    ),
                ),
                array(
                    'name' => 'total',
                    'value' => '$data->total',
                    'filter' => false,
                    'headerHtmlOptions' => array(
                        'style' => 'width: 10%;'
                    ),
                ),
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