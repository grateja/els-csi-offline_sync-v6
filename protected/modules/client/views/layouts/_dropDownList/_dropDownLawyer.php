<?php
//$lawyerName = Employees::sql_getFullName($model->emp_id);
Yii::app()->clientScript->registerScript("javascript", "
    
    $('select').select2({ width: 'resolve' });
    $('.select2-hidden-accessible').attr('hidden', true);

", 2);
?>
<style>
    .select2-drop-mask{
        min-width: 300px;
    }
</style>
<?php if ($model): ?>

    <?php foreach ($model as $model): ?>
        <?php if ($category == Employees::LAWYER_TYPE_ALL): ?>
            <option value="<?php print $model->id; ?>"><?php print $model->lawyerName; ?></option>
        <?php else: ?>
            <option value="<?php print $model->emp_id; ?>"><?php print $model->lawyerName; ?></option>
        <?php endif; ?>

    <?php endforeach; ?> 
    <option value="" class="<?php print $class; ?>">None <?php print $name; ?></option>
<?php else: ?>

<?php endif; ?>