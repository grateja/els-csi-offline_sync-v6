<?php
/**
 * This is the template for generating the form view for crud.
 * The following variables are available in this template:
 * - $ID: the primary key name
 * - $modelClass: the model class name
 * - $columns: a list of column schema objects
 */
?>
<?php print "<?php"; ?> print CHtml::beginForm('','POST', array('role' => 'form'));?>
<div class="box-body">
    <?php
    foreach ($columns as $column) {
        if ($column->name == 'id' || $column->name == 'created_at' || $column->name == 'updated_at' || $column->name == 'is_deleted') {

        } else {
            if ($column->isPrimaryKey)
                continue;
            ?>
            <div class="form-group">
                <?php print "<?php"; ?> print CHtml::activeLabelEx($model,'<?php print $column->name ?>'); ?>
                <?php print "<?php"; ?> print CHtml::activeTextField($model,'<?php print $column->name ?>', array('class' => 'form-control', 'placeholder' => '')); ?>
            </div>
            <?php
        }
    }
    ?>
</div>

<div class="box-footer">
    <?php print "<?php"; ?> print CHtml::link('Back', $this->createUrl('<?php print lcfirst($modelClass); ?>/admin'), array('class' => 'btn btn-default')); ?>
    <?php print "<?php"; ?> print CHtml::submitButton($model->isNewRecord ? 'Save' : 'Update',  array('class'=>'btn btn-primary pull-right')); ?>
</div>
<?php print "<?php"; ?> print CHtml::endForm(); ?>