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
                    <label>
                        <?php echo CHtml::activeLabelEx($model,'reg_date'); ?>
                    </label>
                    <label class="input"><i class="icon-prepend fa fa-calendar"></i>
                        <?php $this->renderPartial('/layouts/jui/_juiModelDatePicker', array('model'=>$model,'attribute'=>'reg_date') );?>
                        <b class="tooltip tooltip-top-left">
                                Ex: 1998-05-27
                        </b>                                             
                    </label>
                </section>
                <section>
                    <label>
                        <?php echo CHtml::activeLabelEx($model,'last_trans_date'); ?>
                    </label>
                    <label class="input"><i class="icon-prepend fa fa-calendar"></i>
                        <?php $this->renderPartial('/layouts/jui/_juiModelDatePicker', array('model'=>$model,'attribute'=>'last_trans_date') );?>
                        <b class="tooltip tooltip-top-left">
                                Ex: 1998-05-27
                        </b>                                             
                    </label>
                </section>
                <section>
                    <label>
                        <?php echo CHtml::activeLabelEx($model,'exp_date'); ?>
                    </label>
                    <label class="input"><i class="icon-prepend fa fa-calendar"></i>
                        <?php $this->renderPartial('/layouts/jui/_juiModelDatePicker', array('model'=>$model,'attribute'=>'exp_date') );?>
                        <b class="tooltip tooltip-top-left">
                                Ex: 1998-05-27
                        </b>                                             
                    </label>
                </section>
                 <section>
                     <div class="input-group has-success">
                        <span class="input-group-addon"><i class="fa fa-key"></i>&nbsp;&nbsp;card_no</span>   
                
                          <?php echo CHtml::activeTextField($model,'card_no',
                                     array('class'=>'form-control','placeholder'=>'Card No.')); ?>
                        <b class="tooltip tooltip-bottom-left">
                                 Ex. Card No.
                       </b> 
                    </div>
                </section>
                 <section>
                     <div class="input-group has-success">
                        <span class="input-group-addon"><i class="fa fa-key"></i>&nbsp;&nbsp;rf_id</span>   
                
                          <?php echo CHtml::activeTextField($model,'rf_id',
                                     array('class'=>'form-control','placeholder'=>'Rf ID')); ?>
                        <b class="tooltip tooltip-bottom-left">
                                 Ex. Rf ID
                       </b> 
                    </div>
                </section>
                <section>
                    <div class="input-group has-success">
                        <span class="input-group-addon"><i class="fa fa-key"></i>&nbsp;&nbsp; Customer</span>

                            <?php echo CHtml::activeDropDownList($model,'customer_id', CHtml::listData(Customers::model_getAllData_byDeleted(Utilities::NO),'id','name'),
                                    array('class'=>'form-control', 'prompt'=>'--select--')); ?>
                        <b class="tooltip tooltip-bottom-left">
                                 ex. 
                       </b> 
                    </div>
                </section>
<!--                <section>
                    <div class="input-group has-success">
                        <span class="input-group-addon"><i class="fa fa-key"></i>&nbsp;&nbsp; Client</span>

                            <?php // echo CHtml::activeDropDownList($model,'client_id', CHtml::listData(Clients::model_getAllData_byIsDeleted(Utilities::NO),'id','name'),
//                                    array('class'=>'form-control', 'prompt'=>'--select--')); ?>
                        <b class="tooltip tooltip-bottom-left">
                                 ex. 
                       </b> 
                    </div>
                </section>-->
                <section>
                    <div class="input-group has-success">
                        <span class="input-group-addon"><i class="fa fa-key"></i>&nbsp;&nbsp; Laundry Shop</span>

                            <?php echo CHtml::activeDropDownList($model,'laundry_shop_id', CHtml::listData(LaundryShops::model_getAllData_byIsDeleted(Utilities::NO),'id','name'),
                                    array('class'=>'form-control', 'prompt'=>'--select--')); ?>
                        <b class="tooltip tooltip-bottom-left">
                                 ex. 
                       </b> 
                    </div>
                </section>
                <section>
                    <div class="input-group has-success">
                        <span class="input-group-addon"><i class="fa fa-key"></i>&nbsp;&nbsp; Employee</span>

                            <?php echo CHtml::activeDropDownList($model,'emp_id', CHtml::listData(Employees::model_getAllData_byIsDeleted(Utilities::NO),'id','name'),
                                    array('class'=>'form-control', 'prompt'=>'--select--')); ?>
                        <b class="tooltip tooltip-bottom-left">
                                 ex. 
                       </b> 
                    </div>
                </section>
                <section>
                     <div class="input-group has-success">
                        <label class="input-group-addon"><i class="fa fa-key"></i>&nbsp;&nbsp;Is Activated</label>
                        <label class="input">
                                <?php echo CHtml::activeDropDownList($model,'is_activated', Utilities::get_ActiveSelect(), array('class'=>'form-control')); ?>
                                <b class="tooltip tooltip-bottom-left">
                                        active tagging
                                </b> 
                        </label> 
                    </div>
                </section>
                <section>
                     <div class="input-group has-success">
                        <label class="input-group-addon"><i class="fa fa-key"></i>&nbsp;&nbsp;Is Deleted</label>
                        <label class="input">
                                <?php echo CHtml::activeDropDownList($model,'is_deleted', Utilities::get_ActiveSelect(), array('class'=>'form-control')); ?>
                                <b class="tooltip tooltip-bottom-left">
                                        active tagging
                                </b> 
                        </label> 
                    </div>
                </section>
                <div class="widget-footer smart-form">
                    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',  array('class'=>'btn btn-sm btn-success')); ?>
                </div>
        </fieldset>

        <?php print CHtml::endForm(); ?>
        <!--</form>-->

    </div>
    <!-- end widget content -->

</div>

