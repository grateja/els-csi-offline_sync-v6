
        <!--<form class="smart-form">-->
        <?php  print CHtml::beginForm('','POST', array('class'=>'smart-form'));?>
     

            <fieldset>
                 <section>
                     <div class="input-group has-success" style="display: none;">
                        <span class="input-group-addon"><i class="fa fa-key"></i>&nbsp;&nbsp;Customer</span>   
                
                          <?php echo CHtml::activeDropDownList($modeltransactions,'customer_id',CHtml::listData(Customers::model_getAllData_byDeleted(Utilities::NO),'id','clientName'),
                                     array('class'=>'form-control','placeholder'=>'Customer Name','prompt'=>'--select--')); ?>
                        <b class="tooltip tooltip-bottom-left">
                                 Ex. Administration
                       </b> 
                    </div>
                </section>
                <section>
                     <div class="input-group has-success">
                        <span class="input-group-addon"><i class="fa fa-key"></i>&nbsp;&nbsp;Transaction</span>   
                
                          <?php echo CHtml::activeDropDownList($modeltransactions,'transaction_id',CHtml::listData(Transactions::model_getAllData_byMachineTypeID(Utilities::NO, $model->machine_type_id),'id','name'),
                                     array('class'=>'form-control','placeholder'=>'Customer Name','prompt'=>'--select--')); ?>
                        <b class="tooltip tooltip-bottom-left">
                                 Ex. Administration
                       </b> 
                    </div>
                </section>               
                <div class="widget-footer smart-form">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Submit',  array('class'=>'btn btn-sm btn-success')); ?>
                </div>
        </fieldset>

        <?php print CHtml::endForm(); ?>
        <!--</form>-->
