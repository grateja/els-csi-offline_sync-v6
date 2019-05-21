<?php !
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
                    <h2>Manage Customer Cards</h2>
            </header>
            <br />
            <?php if($_GET['custID'] != ''):  ?>
                <div class="table-responsive">
                    <table class="table androidHeader table-responsive" style="width: 40%; margin-left: auto; margin-right: auto;">
                        <thead>
                            <tr>
                                <th colspan="2" style="text-align: center;">Customer Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: left; width: 50%;">Name</td>
                                <td style="text-align: left;"><?php print $customers->lnameFname; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br />
                </div>
            <?php endif; ?>
            
            <br />
            <div class="modal-content"> 
                <div class="smart-form" style="text-align: center;padding-bottom: 10px;">
               
                    <?php $static = array('' => Yii::t('','All'));?>
                    <?php $this->widget('zii.widgets.grid.CGridView', array(
                        'id'=>'customer-cards-grid',
                        'dataProvider'=>$model->searchByCustomer(),
                        'filter'=>$model,
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

                            array(
                                'name'=>'created_at',
                                'value'=>'Settings::setDateStandard($data->created_at)',
                                'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                array(
                                            'model' => $model,
                                            'attribute' => 'created_at', // This is how it works for me.
                                            //'language' => 'pl',
                                            'i18nScriptFile' => 'jquery.ui.datepicker-ja.js',
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
                                'name'=>'reg_date',
                                'value'=>'Settings::setDateStandard($data->reg_date)',
                                'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                array(
                                            'model' => $model,
                                            'attribute' => 'reg_date', // This is how it works for me.
                                            //'language' => 'pl',
                                            'i18nScriptFile' => 'jquery.ui.datepicker-ja.js',
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
                                'name'=>'last_trans_date',
                                'value'=>'Settings::setDateStandard($data->last_trans_date)',
                                'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                array(
                                            'model' => $model,
                                            'attribute' => 'last_trans_date', // This is how it works for me.
                                            //'language' => 'pl',
                                            'i18nScriptFile' => 'jquery.ui.datepicker-ja.js',
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

//                            array(
//                                'name'=>'exp_date',
//                                'value'=>'Settings::setDateStandard($data->exp_date)',
//                                'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
//                                array(
//                                            'model' => $model,
//                                            'attribute' => 'exp_date', // This is how it works for me.
//                                            //'language' => 'pl',
//                                            'i18nScriptFile' => 'jquery.ui.datepicker-ja.js',
//                                            'htmlOptions' => array(
//                                                'class' => 'datePicker',
//                                            ),
//                                            'options' => array(  // (#3)
//                                            'showOn' => 'focus', 
//                                            'dateFormat' => 'yy-mm-dd',
//                                            'showOtherMonths' => true,
//                                            'selectOtherMonths' => true,
//                                            'changeMonth' => true,
//                                            'changeYear' => true,
//                                            'showButtonPanel' => true,
//                                         )
//                                    ),
//                                true),
//                                'htmlOptions' => array(
//                                     'style' => 'width: 150px;'
//                                 ),
//                                'headerHtmlOptions' => array(
//                                        'style' => 'text-align: center; (background-color:powderblue;)'
//                                ), 
//                            ),
                            
                            array(
                                'name' => 'card_no',
                                'header' => 'Card No.',
                                'value' => '$data->card_no',
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
                            
//                            array(
//                                'name' => 'customer_id',
//                                'value' => '$data->customers->name',
//                                'filter' => $static + CHtml::ListData(Customers::model_getAllData(),'id','name'),
//                                'htmlOptions' => array(
//                                     'style' => 'width: 200px;'
//                                 ),
//                                'headerHtmlOptions' => array(
//                                        'style' => 'text-align: center; (background-color:powderblue;)'
//                                ), 
//                            ),
                            array(
                                'name' => 'is_activated',
                                'value' => '$data->isActivated',
                                'filter' => $static + Utilities::get_ActiveSelect(),
                                'htmlOptions'=>array('width'=>'100px'),
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
                            
//                            array(
//                                'header' => 'Top Up',
//                                'value' => '$data->cmdBtnTopUp',
//                                'type' => 'raw',
//                                'htmlOptions'=>array('width'=>'100px'),
//                                'headerHtmlOptions' => array(
//                                        'style' => 'text-align: center; (background-color:powderblue;)'
//                                ), 
//                          
//                            ),
                            array(
                                'header' => 'Transactions',
                                'value' => '$data->cmdBtnTransactions',
                                'type' => 'raw',
                                'htmlOptions'=>array('width'=>'100px'),
                                'headerHtmlOptions' => array(
                                        'style' => 'text-align: center; (background-color:powderblue;)'
                                ), 
                            ),                                 
//                            
//                            array(
//                                'class' => 'CLinkColumn',
//                                'header' => 'Action',
//                                'label' =>"Update",
//                                'urlExpression' => 'Yii::app()->createUrl("storeoic/customerCards/activate", array("customerCardID"=>$data->id))'
//                            ), 
                            
                            
                        ),
                    )); ?>
                </div>
            </div>
        </div>
</article>
<br/>