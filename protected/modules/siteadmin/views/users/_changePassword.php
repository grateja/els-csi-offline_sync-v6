<?php print CHtml::beginForm('', 'POST', array('role' => 'form')); ?>
<div class="box-body">
    <div class="form-group">
        <?php echo CHtml::activeLabelEx($model, 'username'); ?>   
        <?php print CHtml::activeTextField($model, 'username', array('class' => 'form-control', 'placeholder' => 'Username')); ?>
    </div>
    
    <div class="form-group">
        <?php echo CHtml::activeLabelEx($model, 'old_password'); ?>   
        <?php print CHtml::activePasswordField($model, 'old_password', array('class' => 'form-control', 'placeholder' => 'Old Password')); ?>
    </div>
    
    
    <div class="form-group">
        <?php echo CHtml::activeLabelEx($model, 'new_password'); ?>   
        <?php print CHtml::activePasswordField($model, 'new_password', array('class' => 'form-control', 'placeholder' => 'New Password')); ?>
    </div>
    
    <div class="form-group">
        <?php echo CHtml::activeLabelEx($model, 'confirm_password'); ?>   
        <?php print CHtml::activePasswordField($model, 'confirm_password', array('class' => 'form-control', 'placeholder' => 'Re-type New Password')); ?>
    </div>
    
<div class="box-footer">
    <?php print CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary pull-right')); ?>
</div>
<?php print CHtml::endForm(); ?>