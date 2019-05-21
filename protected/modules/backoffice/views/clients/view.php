<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">View</h3>
            <?php echo CHtml::link('<i class="fa fa-plus"></i>', $this->createUrl('clients/create'), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
            <?php echo CHtml::link('<i class="fa fa-arrow-left"></i>', $this->createUrl('clients/admin'), array('class' => 'btn btn-xs btn-primary pull-right', 'data-toggle' => 'tooltip', 'title' => 'Back', 'style' => 'margin-right: 5px;')); ?>
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
                    <th>Dealer</th>
                    <td><?php print $model->dealers->fullName ?></td>
                </tr>
                <tr>
                    <th>Firstname</th>
                    <td><?php print $model->firstname ?></td>
                </tr>
                <tr>
                    <th>Middlename</th>
                    <td><?php print $model->middlename ?></td>
                </tr>
                <tr>
                    <th>Lastname</th>
                    <td><?php print $model->lastname ?></td>
                </tr>
                <tr>
                    <th>Company Name</th>
                    <td><?php print $model->company_name ?></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><?php print $model->address ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php print $model->email ?></td>
                </tr>
                <tr>
                    <th>Mobile</th>
                    <td><?php print $model->mobile ?></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><?php print $model->phone ?></td>
                </tr>
                <tr>
                    <th>Is Sync</th>
                    <td><?php print $model->isSync ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>