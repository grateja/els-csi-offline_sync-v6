<?php print CHtml::beginForm('','POST', array('role' => 'form'));?>
<div class="box-body">
                <div class="form-group">
                <?php print CHtml::activeLabelEx($model,'client_id'); ?>
                <?php print CHtml::activeTextField($model,'client_id', array('class' => 'form-control', 'placeholder' => '')); ?>
            </div>
                        <div class="form-group">
                <?php print CHtml::activeLabelEx($model,'branch_id'); ?>
                <?php print CHtml::activeTextField($model,'branch_id', array('class' => 'form-control', 'placeholder' => '')); ?>
            </div>
                        <div class="form-group">
                <?php print CHtml::activeLabelEx($model,'file_path'); ?>
                <?php print CHtml::activeTextField($model,'file_path', array('class' => 'form-control', 'placeholder' => '')); ?>
            </div>
                        <div class="form-group">
                <?php print CHtml::activeLabelEx($model,'file_pics'); ?>
                <?php print CHtml::activeTextField($model,'file_pics', array('class' => 'form-control', 'placeholder' => '')); ?>
            </div>
                        <div class="form-group">
                <?php print CHtml::activeLabelEx($model,'header'); ?>
                <?php print CHtml::activeTextField($model,'header', array('class' => 'form-control', 'placeholder' => '')); ?>
            </div>
                        <div class="form-group">
                <?php print CHtml::activeLabelEx($model,'message'); ?>
                <?php print CHtml::activeTextField($model,'message', array('class' => 'form-control', 'placeholder' => '')); ?>
            </div>
                        <div class="form-group">
                <?php print CHtml::activeLabelEx($model,'footer'); ?>
                <?php print CHtml::activeTextField($model,'footer', array('class' => 'form-control', 'placeholder' => '')); ?>
            </div>
                        <div class="form-group">
                <?php print CHtml::activeLabelEx($model,'is_sync'); ?>
                <?php print CHtml::activeTextField($model,'is_sync', array('class' => 'form-control', 'placeholder' => '')); ?>
            </div>
            </div>

<div class="box-footer">
    <?php print CHtml::link('Back', $this->createUrl('receiptSettings/admin'), array('class' => 'btn btn-default')); ?>
    <?php print CHtml::submitButton($model->isNewRecord ? 'Save' : 'Update',  array('class'=>'btn btn-primary pull-right')); ?>
</div>
<?php print CHtml::endForm(); ?>