<?php 
   Yii::app()->clientScript->registerScript("javascript","
     $(function(){
        
          $.ajax({
                type    : 'GET',
                url     : '?r=storeoic/machines/retreiveSessionChecked',
                async   : false,
                success : function(returnMsg) {
                    var result  = JSON.parse(returnMsg);
                    $.each(JSON.parse(result.data), function(idx, obj) {
                        if(obj.statusID != 1){
                               setSessionData('checked', obj.machineID, obj.statusID); 
                        }else{
                               setSessionData('checked', obj.machineID, obj.statusID); 
                        }
                    });
   
//                        if(obj.statusID != 1){
//                             $('#myonoffswitch'+obj.machineID).attr('disabled','false'); 
//                             console.log($('#myonoffswitch'+obj.machineID));
//                        }else{
//                             $('#myonoffswitch'+obj.machineID).attr('disabled','true'); 
//                        }
                }   
          });
    });
    

    $( 'input' ).addClass('form-control' );
    function reinstallDatePicker(id, data) {
            //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
        $('.datePicker').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['en-US'],{'dateFormat':'yy-mm-dd'}));
        
        $( 'input' ).addClass('form-control' );       
        //$('select').select2({ width: 'resolve' });
       // $('.select2-hidden-accessible').attr('hidden', true);
    }
    
    /* live switch */
//        $('input[type=\"checkbox\"]#myonoffswitch').click(function() {
//                if ($(this).prop('checked')) {
//                       $(this).attr('disabled', 'true');
//                        $(this).addClass('form-control');
//                } else {
//                       $(this).attr('disabled', 'false');
//                }
//        });
        
    /* set session data */
       
       function setSessionData(fieldID, id, val){
        $.ajax({
                type    : 'GET',
                url     : '?r=storeoic/machines/setSessionData',
                data    : 'fieldID=' + fieldID + '&rowID=' + id + '&value=' + val,
                async   : false,
                success : function(data) {
                }   
          });
        }
        
    /* Update Record */
        function updateStatus(id, val, status){
            alertify.set({ labels: {
                ok     : 'Yes',
                cancel : 'No',
                class   : 'form-control'
            } });
            
            if(status != 1){
                var message = 'Are you sure you want to turn ON this Machine ?';
            }else{
                var message = 'Are you sure you want to turn OFF this Machine ?';
            }
            
            alertify.confirm(message, function (e) {
                if (e) {
                    $.ajax({
                           type    : 'GET',
                           url     : '?r=storeoic/machines/updateStatus',
                           data    : 'rowID=' + id + '&value=' + val + '&status=' + status,
                           async   : false,
                           success : function(data) {
                             if (data != 1) {
                                     setSessionData('checked', id, data);
                              } else {
                                     setSessionData('checked', id, data);
                              }
                              $('#machines-grid').load(location.href +  ' #machines-grid', function(responseTxt, statusTxt, xhr){ });
                       
                              messageBox(1);
                           }   
                     });
                } else {
                    $('#machines-grid').load(location.href +  ' #machines-grid', function(responseTxt, statusTxt, xhr){ });
                    messageBox(0);    

                }
            });
        }
        
    function messageBox(val){
        if(val ==1){
             $.smallBox({
                    title : 'Message!',
                    content : 'Status Successfully Updated!',
                    color : '#739E73',
                    icon : 'fa fa-check shake animated',
                    number : '1',
                    timeout : 4000
            });
            reinstallDatePicker();
        }else{
             $.smallBox({
                    title : 'Warning!',
                    content : 'No changes has been made.',
                    color : '#C46A69',
                    icon : 'fa fa-warning shake animated',
                    number : '1',
                    timeout : 4000
            });
             reinstallDatePicker();
        }
       
           return 0;
        }
        
        
    ",2);
?>
                    <?php $this->widget('Flashes');?>
                    <?php $static = array('' => Yii::t('','All'));?>
                    <?php $this->widget('zii.widgets.grid.CGridView', array(
                            'id'=>'machines-grid',
                            'dataProvider'=>$modelMachine->searchMachines(),
                            'filter'=>$modelMachine,
                            'afterAjaxUpdate' => 'reinstallDatePicker',
                            //'itemsCssClass' => 'table table-striped table-hover table-responsive',
                            'pagerCssClass'=>'pagination pull-right',
                            'columns'=>array(
                                    array(
                                        'header' => 'Id',
                                        'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                                        'headerHtmlOptions' => array(
                                                'style' => 'text-align: center; (background-color:powderblue;)'
                                        ),
                                           'htmlOptions' => array(
                                                  'style' => 'text-align: center; (background-color:powderblue;)'
                                       ),
                                    ),
                                    array(
                                        'name'=> 'img_file',
                                        'header'=> 'Image',
                                        'value'=> '$data->image',
                                        'headerHtmlOptions' => array(
                                                'style' => 'text-align: center; (background-color:powderblue;)'
                                        ),
                                           'htmlOptions' => array(
                                                  'style' => 'text-align: center; (background-color:powderblue;)'
                                       ),
                                        'type'=>'raw',
                                        'filter'=>false,
                                    ),
                                    array(
                                        'name'=>'created_at',
                                        'value'=>'Settings::setDateStandard($data->created_at)',
                                        'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', 
                                        array(
                                                    'model' => $modelMachine,
                                                    'attribute' => 'created_at', // This is how it works for me.
                                                    'language' => 'en-US',
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
                                             'style' => 'width: 100px;'
                                         ),
                                        'headerHtmlOptions' => array(
                                                'style' => 'text-align: center; (background-color:powderblue;)'
                                        ), 
                                    ),
//                                   
                                  
                                
                                    array(
                                        'name'=> 'name',
                                        'value'=> '$data->name',
                                        'headerHtmlOptions' => array(
                                                'style' => 'text-align: center; (background-color:powderblue;)'
                                        ),
                                           'htmlOptions' => array(
                                                  'style' => 'text-align: center; (background-color:powderblue;)'
                                       ),
                                    ),
                                   
                                array(
                                        'name'=> 'machine_type_id',
                                        'value'=> '$data->machineTypes->name',
                                        'filter' => $static + CHtml::listData(MachineTypes::model_getAllData_byDeleted(Utilities::NO),'id','name'),
                                        'headerHtmlOptions' => array(
                                            'style' => 'text-align: center; (background-color:powderblue;)'
                                        ),
                                        'htmlOptions' => array(
                                                'style' => 'text-align: center; (background-color:powderblue;)'
                                        ),
                                ),
                                 array(
                                    'name'=> 'name',
                                    'header' => 'Usage',
                                    'value'=> '$data->totalCycleCountPerDay',
                                    'headerHtmlOptions' => array(
                                          'style' => 'text-align: center; (background-color:powderblue;)'
                                        ),
                                        'htmlOptions' => array(
                                            'style' => 'text-align: center; (background-color:powderblue;)'
                                        ),
                                    ),
                        
                            ),
                    )); ?>