
<style>
        /* grid border */
    .grid-view table.items th{
     border-bottom: 1px solid gray !important;
     text-align: center;
      height: 30px;
    } 

    /* disable selected for merged cells */     
    .grid-view table.items td{
       height: 10px;
     border-bottom: 1px solid gray !important;
    } 
    
    .subtotal{
       float: right  !important;
       font-weight: bold !important;
       font-size: 12px !important;
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
      border-top: 1px solid gray;
    }
    .grid-view table.items  {
      /*// border-bottom: 1px solid gray;*/
    } 
 </style>


<div class="article">
    <table style="width: 100%;  font-family:'Arial';">
        <tr>
            <td style="text-align:center; font-size: 16px;" colspan="3" ><b>TRANSACTION REPORT</b></td>
        </tr>
    </table><br/>

    <hr style="margin-top: 1px;"/>

    <?php
        
        $static = array('' => Yii::t('', 'All'));
        $this->widget('ext.groupgridview.GroupGridView', array(
            'id' => 'grid-expr',
            'dataProvider' => $model,
//            'mergeColumns' => array('cust_id'),
            'extraRowColumns' => array('is_deleted'),
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
            'extraRowExpression' => '"<span class=\"subtotal \">Total Amount : ₱ ".Settings::setNumberFormat($totals["amount_net"],2)."&nbsp;&nbsp;&nbsp;&nbsp;  Total Balance: ₱ ".Settings::setNumberFormat($totals["balance"] ,2)."</span>"', 'columns' => array(
                array(
                    'name' => 'cust_id',
                    'header' => 'Customer',
                    'value' => '$data->customers->lnameFname',
                    'filter' => false,
                    'htmlOptions' => array(
                        'style' => 'text-align: left;width: 10%;'
                    ),
                    'headerHtmlOptions' => array(
                        'style' => 'text-align: center !important; (background-color:powderblue;)'
                    ),
                ),
                array(
                    'name' => 'updated_at',
                    'value' => 'Settings::setDateTimeStandard($data->updated_at)',
                    'header' => 'Date',
                    'filter' => false,
                    'htmlOptions' => array(
                        'style' => 'text-align: left;width: 10%;'
                    ),
                    'headerHtmlOptions' => array(
                        'style' => 'text-align: center; (background-color:powderblue;)'
                    ),
                ),
                array(
                    'name' => 'inv_id',
                    'header' => 'Item',
                    'value' => '$data->inventories->name',
                    'filter' => false,
                    'htmlOptions' => array(
                        'style' => 'text-align: left;width: 10%;'
                    ),
                    'headerHtmlOptions' => array(
                        'style' => 'text-align: center !important; (background-color:powderblue;)'
                    ),
                ),
                array(
                    'name' => 'qty',
                    'value' => '$data->qty',
                    'filter' => false,
                    'headerHtmlOptions' => array(
                        'style' => 'text-align: center; (background-color:powderblue;)'
                    ), 'htmlOptions' => array(
                        'style' => 'text-align: center;width: 10%;'
                    ),
                ),
                array(
                    'name' => 'price',
                    'value' => '$data->price',
                    'filter' => false,
                    'headerHtmlOptions' => array(
                        'style' => 'text-align: center; (background-color:powderblue;)'
                    ), 'htmlOptions' => array(
                        'style' => 'text-align: center;width: 10%;'
                    ),
                ),
                array(
                    'name' => 'remarks',
                    'header' => 'Remarks',
                    'value' => '$data->remarks',
                    'filter' => false,
                    'htmlOptions' => array(
                        'style' => 'text-align: right;width: 10%;'
                    ),
                    'headerHtmlOptions' => array(
                        'style' => 'text-align: center !important; (background-color:powderblue;)'
                    ),
                ),
                array(
                    'name' => 'is_fully_paid',
                    'header' => 'Paid',
                    'value' => '$data->isFullyPaid',
                    'filter' => false,
                    'htmlOptions' => array(
                        'style' => 'text-align: right;width: 10%;'
                    ),
                    'headerHtmlOptions' => array(
                        'style' => 'text-align: right; (background-color:powderblue;)'
                    ),
                ),
                array(
                    'name' => 'amount_net',
                    'header' => 'Amount',
                    'value' => '$data->amount_net',
                    'filter' => false,
                    'htmlOptions' => array(
                        'style' => 'text-align: right;width: 10%;'
                    ),
                    'headerHtmlOptions' => array(
                        'style' => 'text-align: right; (background-color:powderblue;)'
                    ),
                ),
                array(
                    'name' => 'balance',
                    'header' => 'Balance',
                    'value' => '$data->balance',
                    'filter' => false,
                    'htmlOptions' => array(
                        'style' => 'text-align: right;width: 10%;'
                    ),
                    'headerHtmlOptions' => array(
                        'style' => 'text-align: right; (background-color:powderblue;)'
                    ),
                ),
            ),
        ));
    ?>



    <br/><br/><br/>
    <table style="width: 30%; font-family:'Arial';">
        <tr>
            <td style="text-align:center; font-size: 12px;"><b><?php print Settings::get_Username(); ?></b></td>
        </tr>
        <tr>
            <td style="text-align:center; font-size: 12px;  border-top: 1px solid gray;"><b>Generated By</b></td>
        </tr>
    </table><br/>
</div>