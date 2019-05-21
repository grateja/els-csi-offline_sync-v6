<?php $this->renderPartial('/layouts/js/_regionsToBarangays'); ?>
<!-- widget div-->
<div>
    <!-- widget edit box -->
    <div class="jarviswidget-editbox">
        <!-- This area used as dropdown edit box -->
    </div>
    <!-- end widget edit box -->

    <!-- widget content -->
    <div class="widget-body no-padding">

        <!--<form class="smart-form">-->
        <?php print CHtml::beginForm('', 'POST', array('class' => 'smart-form')); ?>
        <?php $this->widget('Flashes'); ?>

        <fieldset>

            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'Employee'); ?>
                </label>
                <label class="input">
                    <?php echo CHtml::activeDropDownList($model, 'emp_id', CHtml::listData(Employees::model_getAllData_byDeleted(Utilities::NO), 'id', 'lnameFname'), array('prompt' => 'Choose One', 'class' => 'form-control', 'disabled' => 'disabled'));
                    ?>
                    <b class="tooltip tooltip-bottom-left">
                        Type of your Account
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'username'); ?>
                </label>
                <label class="input"><i class="icon-prepend glyphicon glyphicon-user"></i>
                    <?php echo CHtml::activeTextField($model, 'username', array('class' => 'form-control', 'disabled' => 'disabled')); ?>
                    <b class="tooltip tooltip-bottom-left">
                        Username
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'email'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-envelope"></i>
                    <?php echo CHtml::activeTextField($model, 'email'); ?>
                    <b class="tooltip tooltip-bottom-left">
                        Email
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'old_password'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-unlock-alt"></i>
                    <?php echo CHtml::activePasswordField($model, 'old_password'); ?>
                    <b class="tooltip tooltip-bottom-left">
                        Old Password
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'new_password'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-unlock-alt"></i>
                    <?php echo CHtml::activePasswordField($model, 'new_password'); ?>
                    <b class="tooltip tooltip-bottom-left">
                        New Password
                    </b> 
                </label>
            </section>

            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'repeat_password'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-lock"></i>
                    <?php echo CHtml::activePasswordField($model, 'repeat_password'); ?>
                    <b class="tooltip tooltip-bottom-left">
                        Repeat Password
                    </b> 
                </label>
            </section>

            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'account_type_id'); ?>
                </label>
                <label class="input">
                    <?php echo CHtml::activeDropDownList($model, 'account_type_id', CHtml::listData(AccountTypes::model_getData_byIsDeleted(Utilities::NO), 'id', 'name'), array('prompt' => 'Choose One', 'id' => 'cboAccountTypeId', 'class' => 'form-control'));
                    ?>
                    <b class="tooltip tooltip-bottom-left">
                        Type of your Account
                    </b> 
                </label>
            </section>



            <section>
                <label><?php echo CHtml::activeLabelEx($model, 'is_active'); ?></label>
                <label class="input">
                    <?php echo CHtml::activeDropDownList($model, 'is_active', Utilities::get_ActiveSelect(), array('class' => 'form-control')); ?>
                    <b class="tooltip tooltip-top-left">Soft Delete</b> 
                </label>
            </section>

            <div class="widget-footer smart-form">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Update' : 'Update', array('class' => 'btn btn-sm btn-success')); ?>
            </div>
        </fieldset>

        <?php print CHtml::endForm(); ?>
        <!--</form>-->

    </div>
    <!-- end widget content -->

</div>

