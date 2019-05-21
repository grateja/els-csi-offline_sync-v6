<?php
//$lawyerName = Employees::sql_getFullName($model->emp_id);
Yii::app()->clientScript->registerScript("javascript", "
    
    $('select').select2({ width: 'resolve' });
    $('.select2-hidden-accessible').attr('hidden', true);
    $( 'input' ).addClass('form-control' );

", 2);
?>

<?php if ($model): ?>
    <?php foreach ($model as $model): ?>
        <option value="<?php print $model->id ?>"><?php print $model->name; ?></option>
    <?php endforeach; ?>


<?php else: ?>

<?php endif; ?>