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

        <?php print CHtml::beginForm('', 'POST', array('class' => 'smart-form')); ?>
        <?php $this->widget('Flashes'); ?>

        <fieldset>
            <div class="row">
                <section class="col col-6">
                    <label class="input">
                        <?php echo CHtml::activeDropDownList($modelUpdate, 'emp_id', CHtml::listData(Employees::model_getAllData_byDeleted(Utilities::NO), 'id', 'lnameFname'), array('prompt' => '-- Employee --', 'class' => 'form-control'));
                        ?>
                        <b class="tooltip tooltip-bottom-left">
                            Employee
                        </b> 
                    </label>
                </section>
            </div>
            <div class="row">
                <section class="col col-6">
                    <label class="input">
                        <?php echo CHtml::activeDropDownList($modelUpdate, 'role', CHtml::listData(Roles::model_getAllData_byIsDeleted(Utilities::NO), 'id', 'name'), array('prompt' => '-- Roles --', 'id' => 'cboRole', 'class' => 'form-control'));
                        ?>
                        <b class="tooltip tooltip-bottom-left">
                            Role
                        </b> 
                    </label>
                </section>
                <section class="col col-6">
                    <label class="input"><i class="icon-prepend glyphicon glyphicon-user"></i>
                        <?php echo CHtml::activeTextField($modelUpdate, 'username', array('placeholder' => 'Username')); ?>
                        <b class="tooltip tooltip-bottom-left">
                            Username
                        </b> 
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-6">
                    <label class="input"><i class="icon-prepend fa fa-envelope"></i>
                        <?php echo CHtml::activeTextField($modelUpdate, 'email', array('placeholder' => 'Email')); ?>
                        <b class="tooltip tooltip-bottom-left">
                            Email
                        </b> 
                    </label>
                </section>
                <section class="col col-6">
                    <label class="input">
                        <?php echo CHtml::activeDropDownList($modelUpdate, 'is_active', Utilities::get_ActiveSelect(), array('prompt' => '-- Is Active --', 'class' => 'form-control')); ?>
                        <b class="tooltip tooltip-bottom-left">
                            Is Active
                        </b> 
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-6">
                    <label class="input"><i class="icon-prepend fa fa-unlock-alt"></i>
                        <?php echo CHtml::activePasswordField($modelUpdate, 'new_password', array('placeholder' => 'New Password')); ?>
                        <b class="tooltip tooltip-bottom-left">
                            Password
                        </b> 
                    </label>
                </section>
                <section class="col col-6">
                    <label class="input"><i class="icon-prepend fa fa-lock"></i>
                        <?php echo CHtml::activePasswordField($modelUpdate, 'repeat_password', array('placeholder' => 'Repeat Password')); ?>
                        <b class="tooltip tooltip-bottom-left">
                            Confirm Password
                        </b> 
                    </label>
                </section>
            </div>

            <div class="widget-footer smart-form">
                <?php echo CHtml::link('<i class="fa fa-times">' . ' Cancel</i>', $this->createUrl('users/admin'), array('class' => 'btn btn-sm btn-danger', 'style' => 'width: 70px;')); ?>
                <?php echo CHtml::submitButton($modelUpdate->isNewRecord ? 'Update' : 'Update', array('class' => 'btn btn-sm btn-success', 'style' => 'width: 60px;')); ?>
            </div>

        </fieldset>

        <?php print CHtml::endForm(); ?>

    </div>
    <!-- end widget content -->
</div>


