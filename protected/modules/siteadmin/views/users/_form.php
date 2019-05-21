<?php print CHtml::beginForm('', 'POST', array('role' => 'form')); ?>
<div class="box-body">

    <div class="form-group">
        <?php echo CHtml::activeLabelEx($model, 'username'); ?>   
        <?php print CHtml::activeTextField($model, 'username', array('class' => 'form-control', 'placeholder' => 'Username')); ?>

    </div>

    <div class="form-group">
        <?php echo CHtml::activeLabelEx($model, 'new_password'); ?>   
        <?php print CHtml::activePasswordField($model, 'new_password', array('class' => 'form-control', 'placeholder' => 'Password')); ?>

    </div>
    <div class="form-group">
        <?php echo CHtml::activeLabelEx($model, 'confirm_password'); ?>   
        <?php print CHtml::activePasswordField($model, 'confirm_password', array('class' => 'form-control', 'placeholder' => 'Confirm Password')); ?>

    </div>

</div>

<div class="box-footer">
    <?php print CHtml::link('Back', $this->createUrl('users/admin'), array('class' => 'btn btn-default')); ?>
    <?php print CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary pull-right')); ?>
</div>
<?php print CHtml::endForm(); ?>