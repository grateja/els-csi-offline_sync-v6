<?php print CHtml::beginForm('', 'POST', array('role' => 'form')); ?>
<div class="box-body">
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'name'); ?>
        <?php print CHtml::activeTextField($model, 'name', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'details'); ?>
        <?php print CHtml::activeTextArea($model, 'details', array('rows' => 3, 'class' => 'form-control', 'placeholder' => '')); ?>
    </div>
</div>

<div class="box-footer">
    <?php print CHtml::link('Back', $this->createUrl('subscriptions/admin'), array('class' => 'btn btn-default')); ?>
    <?php print CHtml::submitButton($model->isNewRecord ? 'Save' : 'Update', array('class' => 'btn btn-primary pull-right')); ?>
</div>
<?php print CHtml::endForm(); ?>