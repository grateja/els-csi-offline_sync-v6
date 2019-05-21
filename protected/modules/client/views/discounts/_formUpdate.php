<?php print CHtml::beginForm('', 'POST', array('role' => 'form')); ?>
<div class="box-body">
    <div class="form-group">
        <?php echo CHtml::activeLabelEx($model, 'branch_id'); ?>
        <?php echo CHtml::activeDropDownList($model, 'branch_id', CHtml::listData(Branches::model_getAllData_byClientId(Settings::get_ClientID()), 'id', 'name'), array('prompt' => 'Choose One', 'class' => 'form-control')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'name'); ?>
        <?php print CHtml::activeTextField($model, 'name', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'discount_type_id'); ?>
        <?php print CHtml::activeDropDownList($model, 'discount_type_id', Discounts::get_type(), array('class' => 'form-control', 'prompt' => '-- Select --')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'value'); ?>
        <?php print CHtml::activeTextField($model, 'value', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'is_deleted'); ?>
        <?php print CHtml::activeDropDownList($model, 'is_deleted', Utilities::get_ActiveSelect(), array('class' => 'form-control', 'prompt' => '-- Select --')); ?>
    </div>
</div>

<div class="box-footer">
    <?php print CHtml::link('Back', $this->createUrl('discounts/admin'), array('class' => 'btn btn-default')); ?>
    <?php print CHtml::submitButton($model->isNewRecord ? 'Save' : 'Update', array('class' => 'btn btn-primary pull-right')); ?>
</div>
<?php print CHtml::endForm(); ?>