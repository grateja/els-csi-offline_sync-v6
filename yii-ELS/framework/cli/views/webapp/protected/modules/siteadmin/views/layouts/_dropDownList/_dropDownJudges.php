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
        <option value="<?php print $model->id ?>"><?php print Settings::setCapitalFirst($model->salutations->name) . '. ' . $model->lnameFname; ?></option>
    <?php endforeach; ?>


<?php else: ?>

<?php endif; ?>
<option value="zero"><?php print 'Add New'; ?></option>