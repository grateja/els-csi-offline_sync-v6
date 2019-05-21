<?php 
   Yii::app()->clientScript->registerScript("javascript","
       
  //$('select').select2({ width: 'resolve' });   
  //$('.select2-hidden-accessible').attr('hidden', true);
  $( 'input' ).addClass('form-control' );

    function viewRemarks(remarks){
      $('.txtRemarks').popover({
        container: 'body',
        html : true,
      })
    }
    function clickViewRemarks(custID){
                window.location='?r=storeoic/customers/getDailyTransactions&id='+custID;
    }


    function reinstallDatePicker(id, data) {
            //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
        $('.datePicker').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['ja'],{'dateFormat':'yy-mm-dd'}));
        
        $( 'input' ).addClass('form-control' );
        $('select').select2({ width: 'resolve' });   
        $('.select2-hidden-accessible').attr('hidden', true);
    }
    ",2);
?>
<!--<select style="width: 100%"></select>-->

                    <?php $this->widget('Flashes');?>
                    <?php Settings::setDateTimeStandard($d);$static = array(  ''     => Yii::t('','All'),  );  ?>
                    <?php $i = 1;?>
                    <?php $this->widget('zii.widgets.grid.CGridView', array(
                        'id'=>'customers-grid',
                        'dataProvider'=>$modelCustomer->searchCustomerDashBoard(),   
                        'filter'=>$modelCustomer,
                        'afterAjaxUpdate' => 'reinstallDatePicker',
                        //'itemsCssClass' => 'table table-striped table-hover table-responsive',
                        'pagerCssClass'=>'pagination pull-right',
                        'columns'=>array(

                                array(
                                    'name'=>'created_at',
                                    'value'=>'Settings::setDateStandard($data->created_at)',
                                    'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                    array(
                                                'model' => $modelCustomer,
                                                'attribute' => 'created_at', // This is how it works for me.
                                                //'language' => 'pl',
                                                'htmlOptions' => array(
                                                    'class' => 'datePicker',
                                                ),
                                                'options' => array(  // (#3)
                                                'showOn' => 'focus', 
                                                'dateFormat' => 'yy-mm-dd',
                                                'showOtherMonths' => true,
                                                'selectOtherMonths' => true,
                                                'changeMonth' => true,
                                                'changeYear' => true,
                                                'showButtonPanel' => true,
                                             )
                                        ),
                                    true), 
                                    'htmlOptions' => array(
                                         'style' => 'width: 100px;text-align:center'
                                     ), 
                                    'headerHtmlOptions' => array(
                                            'style' => 'text-align: center;'
                                    ), 
                                ),
                                array(
                                    'header'=>'Client Type',
                                    'name' => 'cust_type',
                                    'value'=> '$data->custType',
                                    'filter'=> $static + Customers::get_ActiveCustType(),
                                    'headerHtmlOptions'=>array('width: 100px !important;'),
                                    'htmlOptions' => array(
                                         'style' => 'width: 100px;text-align:center'
                                    ), 
                                    'headerHtmlOptions' => array(
                                            'style' => 'text-align: center;'
                                    ), 
                                ),

                                array(
                                    'name'=>'id',
                                    'header' => 'Client Name',
                                    'value' => '$data->clientName',  
                                    'filter'=> $static + CHtml::listData(Customers::model_getAllData_byDeleted(Utilities::NO),'id','clientName'),
                                    'htmlOptions' => array(
                                         'style' => 'width: 200px;text-align:center'
                                    ), 
                                    'headerHtmlOptions' => array(
                                            'style' => 'text-align: center;'
                                    ), 
                                ),
                            
                                array(
                                    'name'=>'address',
                                    'header'=>'Address',
                                    'value' => '($data->cust_type == Customers::CUST_TYPE_PERSONAL)? $data->address1 : $data->company_address',
                                    'htmlOptions' => array(
                                         'style' => 'width: 400px;text-align:center'
                                     ), 
                                    'headerHtmlOptions' => array(
                                            'style' => 'text-align: center;'
                                    ), 
                                ),

                                array(
                                    'name' => 'billingHistory',
                                    'header' => 'Total Daily Transcation',
                                    'value' => '$data->billing',
                                    'filter' => false,
                                    'type'=>'raw',
                                    'htmlOptions' => array(
                                         'style' => 'width: 50px;text-align:center'
                                    ), 
                                    'headerHtmlOptions' => array(
                                            'style' => 'text-align: center;'
                                    ), 

                                ),

                             
                               
                            ),
                    )); ?>
