<?php 
   Yii::app()->clientScript->registerScript("javascript","
              
    function getAmountByTransactionID(val){
        if(val == 4){
            $('#txtMachine').hide();
        }else{
            
            $('#txtMachine').show();
        }
        
         $.ajax({
                 type    : 'GET',
                 url     : '?r=storeoic/transactions/getAmountByTransactionID',
                 data    : 'transactionID=' + val,

                 success : function(data) {
                       $('#txtAmount').val(data);
                 }
             });
    }
    
    function findCustomerNumber(val){
        $.ajax({
                 type    : 'GET',
                 url     : '?r=storeoic/customerTransactions/findCustomerNumber',
                 data    : 'customerID=' + val,
                 success : function(data) {
                    $('#customerCard').html(data);
                 }
             });
    }
    
    ",2);
?>
<div>
<!-- widget edit box -->
    <div class="jarviswidget-editbox">
    <!-- This area used as dropdown edit box -->
    </div>
    <!-- end widget edit box -->

    <!-- widget content -->

    <div class="widget-body no-padding">

        <!--<form class="smart-form">-->
        <?php  print CHtml::beginForm('','POST', array('class'=>'smart-form'));?>
        <?php $this->widget('Flashes'); ?>

            <fieldset>

                <section>
                     <div class="input-group has-success">
                        <span class="input-group-addon"><i class="fa fa-key"></i>&nbsp;&nbsp;Amount</span>   
                
                          <?php echo CHtml::activeTextField($model,'credited',
                                     array('class'=>'form-control','placeholder'=>'0.00','id'=>'txtAmount')); ?>
                        <b class="tooltip tooltip-bottom-left">
                       </b> 
                    </div>
                </section>
                
                <section>
                     <div class="input-group has-success">
                        <span class="input-group-addon"><i class="fa fa-key"></i>&nbsp;&nbsp;Remarks</span>   
                
                          <?php echo CHtml::activeTextField($model,'remarks',
                                     array('class'=>'form-control','placeholder'=>'Remarks','id'=>'txtRemarks')); ?>
                        <b class="tooltip tooltip-bottom-left">
                       </b> 
                    </div>
                </section>
                <section>
                    <div class="widget-footer smart-form">
                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save',  array('class'=>'btn btn-sm btn-success')); ?>
                    </div>
                </section>
        </fieldset>

        <?php print CHtml::endForm(); ?>
        <!--</form>-->

    </div>
    <!-- end widget content -->

</div>

