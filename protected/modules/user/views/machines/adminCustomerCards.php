<?php 
   Yii::app()->clientScript->registerScript("javascript","
              
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
<br />
<article class="col-sm-12">
        <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-4" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
        <!--<h1>Non-Enrollment Payment Headers</h1>-->

            <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>  
                    <h2>Select Customer</h2>
            </header>
            <div class="modal-content"> 
                <div class="smart-form" style="text-align: center;padding-bottom: 10px;">
               
                    <?php $static = array('' => Yii::t('','All'));?>
                    <?php $this->widget('zii.widgets.grid.CGridView', array(
                        'id'=>'customer-cards-grid',
                        'dataProvider'=>$modelCards->searchCustomerCards(),
                        'filter'=>$modelCards,
                        'afterAjaxUpdate' => 'reinstallDatePicker',
                        //'itemsCssClass' => 'table table-striped table-hover table-responsive',
                        'pagerCssClass'=>'pagination pull-right', 
                        'columns'=>array(
                            array(
                                'name' => 'id',
                                'value' => '$data->id',
                                'filter' => false,
                                'htmlOptions'=>array('width'=>'20px'),
                                'headerHtmlOptions' => array(
                                        'style' => 'text-align: center; (background-color:powderblue;)'
                                ), 
                            ),
                            /*
                            array(
                                'name'=>'created_at',
                                'value'=>'Settings::setDateStandard($data->created_at)',
                                'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                array(
                                            'model' => $modelCards,
                                            'attribute' => 'created_at', // This is how it works for me.
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
                                     'style' => 'width: 150px;'
                                 ),
                                'headerHtmlOptions' => array(
                                        'style' => 'text-align: center; (background-color:powderblue;)'
                                ), 
                            ),
                             * 
                             */

                            array(
                                'name'=>'reg_date',
                                'value'=>'Settings::setDateStandard($data->reg_date)',
                                'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                array(
                                            'model' => $modelCards,
                                            'attribute' => 'reg_date', // This is how it works for me.
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
                                     'style' => 'width: 150px;'
                                 ),
                                'headerHtmlOptions' => array(
                                        'style' => 'text-align: center; (background-color:powderblue;)'
                                ), 
                            ),

                         
                            array(
                                'name' => 'rf_id',
                                'header' => 'Rf ID',
                                'value' => '$data->rf_id',
                                'headerHtmlOptions' => array(
                                        'style' => 'text-align: center; (background-color:powderblue;)'
                                ), 
                            ),
                            
                            array(
                                'name' => 'customer_id',
                                'header'=>'Last Name',
                                'value' => '$data->customers->lastname',
                              //  'filter' => $static + CHtml::ListData(Customers::model_getAllData_byDeleted(Utilities::NO),'id','name'),
                                'htmlOptions' => array(
                                     'style' => 'width: 200px;'
                                 ),
                                'headerHtmlOptions' => array(
                                        'style' => 'text-align: center; (background-color:powderblue;)'
                                ), 
                            ),
                            array(
                                'name' => 'customer_id',
                                'header'=>'First Name',
                                'value' => '$data->customers->firstname',
                              //  'filter' => $static + CHtml::ListData(Customers::model_getAllData_byDeleted(Utilities::NO),'id','name'),
                                'htmlOptions' => array(
                                     'style' => 'width: 200px;'
                                 ),
                                'headerHtmlOptions' => array(
                                        'style' => 'text-align: center; (background-color:powderblue;)'
                                ), 
                            ),
                            
                            
                            array(
                                'header' => 'Balance',
                                'value' => 'Utilities::setNumberFormat($data->cardBalance, 2)', 
                                'filter' => false,
                                'htmlOptions'=>array('width'=>'100px'),
                                'headerHtmlOptions' => array(
                                        'style' => 'text-align: center; (background-color:powderblue;)'
                                ), 
                            ),                              
                            array(
                                'class' => 'CLinkColumn',
                                'header' => 'Action',
                                'label' =>"Select",
                                'urlExpression' => 'Yii::app()->createUrl("user/machines/selectCustomer", array("custCardID" => $data->id, "machineID" => $_GET["machineID"]))',
                                'htmlOptions' => array('style' => 'width: 50px; text-align:center'),
                                'headerHtmlOptions' => array(
                                    'style' => 'text-align: center;'
                                ),                                
                            ), 
                        ),
                    )); ?>
                </div>
            </div>
        </div>
</article>
<br/>