<?php
/**
 * This is the template for generating the update view for crud.
 * The following variables are available in this template:
 * - $ID: the primary key name
 * - $modelClass: the model class name
 * - $columns: a list of column schema objects
 */
?>
<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Update</h3>
        </div>
        <?php print "<?php"; ?> print $this->renderPartial('_formUpdate', array('model'=>$model)); ?>
    </div>
</div>