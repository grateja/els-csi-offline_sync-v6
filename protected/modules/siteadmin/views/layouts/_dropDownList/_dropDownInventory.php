<?php
//$lawyerName = Employees::sql_getFullName($model->emp_id);
Yii::app()->clientScript->registerScript("javascript", "
    
    $('select').select2({ width: 'resolve' });
    $('.select2-hidden-accessible').attr('hidden', true);

", 2);
?>
<option value="" class="<?php print $class; ?>">Choose One <?php print $name; ?></option>
<?php if ($model): ?>
    <?php foreach ($model as $model): ?>
        <?php if ($category == Inventories::INVENTORY_TYPE_CUSTOMER): ?>
            <option value="<?php print $model->inventory_id ?>"><?php print $model->inventories->codeName; ?></option>
        <?php else: ?>
            <option value="<?php print $model->id ?>"><?php print $model->codeName; ?></option>
        <?php endif; ?>
    <?php endforeach; ?>
<?php else: ?>

<?php endif; ?>