<option value="" class="<?php print $class; ?>">-- select <?php print $name; ?> --</option>
<?php if ($model): ?>
    <?php foreach ($model as $model): ?>
        <option value="<?php print $model->id ?>"><?php print $model->name; ?></option>
    <?php endforeach; ?>
<?php else: ?>

<?php endif; ?>