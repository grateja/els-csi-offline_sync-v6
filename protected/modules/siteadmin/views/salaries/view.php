<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">View</h3>
            <?php echo CHtml::link('<i class="fa fa-plus"></i>', $this->createUrl('salaries/create'), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
            <?php echo CHtml::link('<i class="fa fa-arrow-left"></i>', $this->createUrl('salaries/admin'), array('class' => 'btn btn-xs btn-primary pull-right', 'data-toggle' => 'tooltip', 'title' => 'Back', 'style' => 'margin-right: 5px;')); ?>
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
                    <th>date_released</th>
                    <td><?php print $model->date_released ?></td>
                </tr>
                <tr>
                    <th>date_from</th>
                    <td><?php print $model->date_from ?></td>
                </tr>
                <tr>
                    <th>date_to</th>
                    <td><?php print $model->date_to ?></td>
                </tr>
                <tr>
                    <th>emp_id</th>
                    <td><?php print $model->emp_id ?></td>
                </tr>
                <tr>
                    <th>branch_id</th>
                    <td><?php print $model->branch_id ?></td>
                </tr>
                <tr>
                    <th>client_id</th>
                    <td><?php print $model->client_id ?></td>
                </tr>
                <tr>
                    <th>expenses_type_id</th>
                    <td><?php print $model->expenses_type_id ?></td>
                </tr>
                <tr>
                    <th>title</th>
                    <td><?php print $model->title ?></td>
                </tr>
                <tr>
                    <th>amount</th>
                    <td><?php print $model->amount ?></td>
                </tr>
                <tr>
                    <th>remarks</th>
                    <td><?php print $model->remarks ?></td>
                </tr>
                <tr>
                    <th>account_no</th>
                    <td><?php print $model->account_no ?></td>
                </tr>
                <tr>
                    <th>bank_id</th>
                    <td><?php print $model->bank_id ?></td>
                </tr>
                <tr>
                    <th>is_sync</th>
                    <td><?php print $model->is_sync ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>