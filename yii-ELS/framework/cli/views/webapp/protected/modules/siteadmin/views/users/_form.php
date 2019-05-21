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
                    <?php echo CHtml::activeDropDownList($model, 'emp_id', CHtml::listData(Employees::model_getAllData_byDeleted(Utilities::NO), 'id', 'lnameFname'), array('prompt' => 'Choose One', 'class' => 'form-control'));
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
                    <?php echo CHtml::activeTextField($model, 'username'); ?>
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
                    <?php echo CHtml::activeLabelEx($model, 'password'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-unlock-alt"></i>
                    <?php echo CHtml::activePasswordField($model, 'new_password'); ?>
                    <b class="tooltip tooltip-bottom-left">
                        Password
                    </b> 
                </label>
            </section>

            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'confirm_password'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-lock"></i>
                    <?php echo CHtml::activePasswordField($model, 'confirm_password'); ?>
                    <b class="tooltip tooltip-bottom-left">
                        Confirm Password
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
            <div class="widget-footer smart-form">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-sm btn-success')); ?>
            </div>

        </fieldset>

        <?php print CHtml::endForm(); ?>
        <!--</form>-->

    </div>
    <!-- end widget content -->
</div>


