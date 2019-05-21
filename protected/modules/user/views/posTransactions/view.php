<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">View</h3>
            <?php echo CHtml::link('<i class="fa fa-plus"></i>', $this->createUrl('posTransactions/create'), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
            <?php echo CHtml::link('<i class="fa fa-arrow-left"></i>', $this->createUrl('posTransactions/admin'), array('class' => 'btn btn-xs btn-primary pull-right', 'data-toggle' => 'tooltip', 'title' => 'Back', 'style' => 'margin-right: 5px;')); ?>
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
                    <th>trans_date</th>
                    <td><?php print $model->trans_date ?></td>
                </tr>
                <tr>
                    <th>ref_no</th>
                    <td><?php print $model->ref_no ?></td>
                </tr>
                <tr>
                    <th>cust_id</th>
                    <td><?php print $model->cust_id ?></td>
                </tr>
                <tr>
                    <th>branch_id</th>
                    <td><?php print $model->branch_id ?></td>
                </tr>
                <tr>
                    <th>service_id</th>
                    <td><?php print $model->service_id ?></td>
                </tr>
                <tr>
                    <th>inv_id</th>
                    <td><?php print $model->inv_id ?></td>
                </tr>
                <tr>
                    <th>transaction_id</th>
                    <td><?php print $model->transaction_id ?></td>
                </tr>
                <tr>
                    <th>transaction_name</th>
                    <td><?php print $model->transaction_name ?></td>
                </tr>
                <tr>
                    <th>qty</th>
                    <td><?php print $model->qty ?></td>
                </tr>
                <tr>
                    <th>price</th>
                    <td><?php print $model->price ?></td>
                </tr>
                <tr>
                    <th>amount_net</th>
                    <td><?php print $model->amount_net ?></td>
                </tr>
                <tr>
                    <th>balance</th>
                    <td><?php print $model->balance ?></td>
                </tr>
                <tr>
                    <th>user_id</th>
                    <td><?php print $model->user_id ?></td>
                </tr>
                <tr>
                    <th>is_fully_paid</th>
                    <td><?php print $model->is_fully_paid ?></td>
                </tr>
                <tr>
                    <th>is_inventory</th>
                    <td><?php print $model->is_inventory ?></td>
                </tr>
                <tr>
                    <th>remarks</th>
                    <td><?php print $model->remarks ?></td>
                </tr>
                <tr>
                    <th>deleted_by</th>
                    <td><?php print $model->deleted_by ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>