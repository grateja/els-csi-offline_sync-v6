<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">View</h3>
            <?php echo CHtml::link('<i class="fa fa-plus"></i>', $this->createUrl('expenses/create'), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
            <?php echo CHtml::link('<i class="fa fa-arrow-left"></i>', $this->createUrl('expenses/admin'), array('class' => 'btn btn-xs btn-primary pull-right', 'data-toggle' => 'tooltip', 'title' => 'Back', 'style' => 'margin-right: 5px;')); ?>
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
                    <th>Date</th>
                    <td><?php print $model->date ?></td>
                </tr>
                <tr>
                    <th>Ref No.</th>
                    <td><?php print $model->ref_no ?></td>
                </tr>
                <tr>
                    <th>Branch</th>
                    <td><?php print $model->branches->name ?></td>
                </tr>
                <tr>
                    <th>Client</th>
                    <td><?php print $model->clients->fullName ?></td>
                </tr>
                <tr>
                    <th>Expenses Type</th>
                    <td><?php print $model->expensesTypes->name ?></td>
                </tr>
                <tr>
                    <th>Title</th>
                    <td><?php print $model->title ?></td>
                </tr>
                <tr>
                    <th>Amount</th>
                    <td><?php print $model->amount ?></td>
                </tr>
                <tr>
                    <th>Remarks</th>
                    <td><?php print $model->remarks ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>