<?php
/**
 * This is the template for generating the 'view' view for crud.
 * The following variables are available in this template:
 * - $ID: the primary key name
 * - $modelClass: the model class name
 * - $columns: a list of column schema objects
 */
?>
<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">View</h3>
            <?php print "<?php"; ?> echo CHtml::link('<i class="fa fa-plus"></i>',$this->createUrl('<?php print lcfirst($modelClass); ?>/create'), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
            <?php print "<?php"; ?> echo CHtml::link('<i class="fa fa-arrow-left"></i>', $this->createUrl('<?php print lcfirst($modelClass); ?>/admin'), array('class' => 'btn btn-xs btn-primary pull-right', 'data-toggle' => 'tooltip', 'title' => 'Back', 'style' => 'margin-right: 5px;')); ?>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <?php
                foreach ($columns as $column) {
                    if ($column->name == 'is_deleted' || $column->name == 'id') {
                    } else {
                        if ($column->name == 'created_at') {
                            print '<tr>
                                    <th>Date Created</th>
                                    <td><?php echo Settings::setDateTimeStandard($model->' . $column->name . ')?></td>
                                </tr>
                                ';
                        } else if ($column->name == 'updated_at') {
                            print '<tr>
                                    <th>Last Modified</th>
                                    <td><?php echo Settings::setDateTimeStandard($model->' . $column->name . ')?></td>
                                </tr>
                                ';
                        } else {
                            print '<tr>
                                    <th>' . $column->name . '</th>
                                    <td><?php print $model->' . $column->name . '?></td>
                                </tr>
                                ';
                        }
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>