<?php 
   Yii::app()->clientScript->registerScript("javascript","
              
//  $('select').select2({ width: 'resolve' });
//  $('.select2-hidden-accessible').attr('hidden', true);
  $( 'input' ).addClass('form-control' );

    function reinstallDatePicker(id, data) {
            //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
        $('.datePicker').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['ja'],{'dateFormat':'yy-mm-dd'}));
        
        $( 'input' ).addClass('form-control' );       
        $('select').select2({ width: 'resolve' });
        $('.select2-hidden-accessible').attr('hidden', true);
    }
    ",2);
?>


                    <?php $static = array('' => Yii::t('','All'));?>
                    <?php $this->widget('zii.widgets.grid.CGridView', array(
                        'id'=>'customer-transactions-grid',
                        'dataProvider'=>$model->searchActiveTransactions(),
                        'afterAjaxUpdate' => 'reinstallDatePicker',
                        //'itemsCssClass' => 'table table-striped table-hover table-responsive',
                        'pagerCssClass'=>'pagination pull-right', 
                        'filter'=>$model,
                        'columns'=>array(

                            array(
                                'name'=>'created_at',
                                'value'=>'Settings::setDateStandard($data->created_at)',
                                'filter' => false,
                                'htmlOptions' => array(
                                     'style' => 'width: 100px;'
                                 ),
                                'headerHtmlOptions' => array(
                                        'style' => 'text-align: center; (background-color:powderblue;)'
                                ), 
                            ),
                            
                            array(
                                'name' => 'machine_id',
                                'value' => '$data->machines->name',
                                'filter' => $static + CHtml::ListData(Machines::model_getAllData_byDeleted(Utilities::NO),'id','name'),
                                'htmlOptions' => array(
                                     'style' => 'width: 150px; text-align: center;'
                                 ),
                                'headerHtmlOptions' => array(
                                        'style' => 'text-align: center; (background-color:powderblue;)'
                                ), 
                            ),
                   
                             array(
                                'name' => 'customer_id',
                                'header' => 'Customer Name',
                                'value' => '$data->customers->clientName',
                                'filter' => $static + CHtml::ListData(Customers::model_getAllData_byDeleted(Utilities::NO),'id','clientName'),
                                'htmlOptions' => array(
                                     'style' => 'width: 150px;text-align: center;'
                                 ),
                                'headerHtmlOptions' => array(
                                        'style' => 'text-align: center; (background-color:powderblue;)'
                                ), 
                            ),
                            
                            array(
                                'name' => 'rf_id',
//                                'header' => 'Name',
                                'value' => '$data->rf_id',  
                                'htmlOptions' => array(
                                     'style' => 'text-align: center;'
                                 ),
                                'headerHtmlOptions' => array(
                                        'style' => 'text-align: center; (background-color:powderblue;)'
                                ), 
                            ),
                           
                            array(
                                'name' => 'transaction_id',
                                'value' => '$data->transactions->name',
                                'filter' => $static + CHtml::ListData(Transactions::model_getAllData_byIsDeleted(Utilities::NO),'id','name'),
                                'htmlOptions' => array(
                                     'style' => 'width: 150px;text-align: center;'
                                 ),
                                'headerHtmlOptions' => array(
                                        'style' => 'text-align: center; (background-color:powderblue;)'
                                ), 
                            ),
                            
                            array(
                                'name' => 'amount',
//                                'header' => 'Loaded',
                                'value' => '$data->amount',
                                'htmlOptions' => array(
                                     'style' => 'width: 150px;text-align: center;'
                                 ),
                                'headerHtmlOptions' => array(
                                        'style' => 'text-align: center; (background-color:powderblue;)'
                                ), 
                            ),
                            
                            array(
                                'name' => 'balance',
                                'header' => 'Credit Balance',
                                'value' => '$data->balance',  
                                'htmlOptions' => array(
                                     'style' => 'width: 150px;text-align: center;'
                                 ),
                                'headerHtmlOptions' => array(
                                        'style' => 'text-align: center; (background-color:powderblue;)'
                                ), 
                            ),
 
                        ),
                    )); ?>
