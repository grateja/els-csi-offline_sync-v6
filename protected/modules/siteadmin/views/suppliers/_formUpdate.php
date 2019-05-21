<?php print CHtml::beginForm('', 'POST', array('role' => 'form')); ?>
<div class="box-body">
       <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'firstname'); ?>
        <?php print CHtml::activeTextField($model, 'firstname', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'middlename'); ?>
        <?php print CHtml::activeTextField($model, 'middlename', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'lastname'); ?>
        <?php print CHtml::activeTextField($model, 'lastname', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'company_name'); ?>
        <?php print CHtml::activeTextField($model, 'company_name', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'address'); ?>
        <?php print CHtml::activeTextField($model, 'address', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'email'); ?>
        <?php print CHtml::activeTextField($model, 'email', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'mobile'); ?>
        <?php print CHtml::activeTextField($model, 'mobile', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'phone'); ?>
        <?php print CHtml::activeTextField($model, 'phone', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>

</div>

<div class="box-footer">
    <?php print CHtml::link('Back', $this->createUrl('suppliers/admin'), array('class' => 'btn btn-default')); ?>
    <?php print CHtml::submitButton($model->isNewRecord ? 'Save' : 'Update', array('class' => 'btn btn-primary pull-right')); ?>
</div>
<?php print CHtml::endForm(); ?>