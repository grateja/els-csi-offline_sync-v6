<?php print CHtml::beginForm('', 'POST', array('class' => 'smart-form')); ?>
<fieldset>
    <div class="row">
        <div class="col col-4">
            <label>
                <?php echo CHtml::activeLabelEx($model, 'Employee'); ?>
            </label>
            <label class="input">
                <?php echo CHtml::activeDropDownList($model, 'emp_id', CHtml::listData(Employees::model_getAllData_byDeleted(Utilities::NO), 'id', 'lnameFname'), array('prompt' => 'Choose Employee'));
                ?>
            </label>
        </div>
        <div class="col col-4">
            <label>
                <?php echo CHtml::activeLabelEx($model, 'Role'); ?>
            </label>
            <label class="input">
                <?php echo CHtml::activeDropDownList($model, 'role', CHtml::listData(Roles::model_getAllData_byIsDeleted(Utilities::NO), 'id', 'name'), array('prompt' => 'Choose Role', 'id' => 'cboAccountTypeId'));
                ?>
            </label>
        </div>

        <div class="col col-4">
            <label>
                <?php echo CHtml::activeLabelEx($model, 'Username'); ?>
            </label>
            <label class="input"><i class="icon-prepend minia-icon-book"></i>
                <?php echo CHtml::activeTextField($model, 'username', array('placeholder' => 'Username')); ?>
                <b class="tooltip tooltip-bottom-left">
                    Username
                </b> 
            </label>
        </div>
        <div class="col col-4">
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'Email'); ?>
                </label>
            <label class="input"><i class="icon-prepend minia-icon-book"></i>
                <?php echo CHtml::activeTextField($model, 'email', array('placeholder' => 'Email')); ?>
                <b class="tooltip tooltip-bottom-left">
                    Email
                </b> 
            </label>
        </div>

        <div class="col col-4">
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'New Password'); ?>
                </label>
            <label class="input"><i class="icon-prepend minia-icon-book"></i>
                <?php echo CHtml::activePasswordField($model, 'new_password', array('placeholder' => 'Password')); ?>
            </label>
        </div>
        <div class="col col-4">
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'Confirm Password'); ?>
                </label>
            <label class="input"><i class="icon-prepend minia-icon-book"></i>
                <?php echo CHtml::activePasswordField($model, 'confirm_password', array('placeholder' => 'Confirm Password')); ?>
            </label>
        </div>   
    </div>
    <div class="footer-button">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-sm btn-success', 'style' => 'width: 60px;')); ?>
    </div>
</fieldset>
<?php print CHtml::endForm(); ?>


