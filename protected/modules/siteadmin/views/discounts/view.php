<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">View</h3>
            <?php echo CHtml::link('<i class="fa fa-plus"></i>', $this->createUrl('discounts/create'), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
            <?php echo CHtml::link('<i class="fa fa-arrow-left"></i>', $this->createUrl('discounts/admin'), array('class' => 'btn btn-xs btn-primary pull-right', 'data-toggle' => 'tooltip', 'title' => 'Back', 'style' => 'margin-right: 5px;')); ?>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <tr>
                    <th>Date Created</th>
                    <td><?php echo Settings::setDateTimeStandard($model->created_at) ?></td>
                </tr>
                <tr>
                    <th>Last Modified</th>
                    <td><?php echo Settings::setDateTimeStandard($model->updated_at) ?></td>
                </tr>
                <tr>
                    <th>Client</th>
                    <td><?php print $model->clients->fullName ?></td>
                </tr>
                <tr>
                    <th>Branch</th>
                    <td><?php print $model->branches->name ?></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td><?php print $model->name ?></td>
                </tr>
                <tr>
                    <th>Discount Type</th>
                    <td><?php print $model->discount_type_id ?></td>
                </tr>
                <tr>
                    <th>Value</th>
                    <td><?php print $model->value ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>