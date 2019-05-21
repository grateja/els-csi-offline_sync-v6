<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">View</h3>
            <?php echo CHtml::link('<i class="fa fa-plus"></i>', $this->createUrl('posPaymentDetails/create'), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
            <?php echo CHtml::link('<i class="fa fa-arrow-left"></i>', $this->createUrl('posPaymentDetails/admin'), array('class' => 'btn btn-xs btn-primary pull-right', 'data-toggle' => 'tooltip', 'title' => 'Back', 'style' => 'margin-right: 5px;')); ?>
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
                    <th>header_id</th>
                    <td><?php print $model->header_id ?></td>
                </tr>
                <tr>
                    <th>transaction_id</th>
                    <td><?php print $model->transaction_id ?></td>
                </tr>
                <tr>
                    <th>inventory_id</th>
                    <td><?php print $model->inventory_id ?></td>
                </tr>
                <tr>
                    <th>price</th>
                    <td><?php print $model->price ?></td>
                </tr>
                <tr>
                    <th>amount_paid</th>
                    <td><?php print $model->amount_paid ?></td>
                </tr>
                <tr>
                    <th>is_sync</th>
                    <td><?php print $model->is_sync ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>