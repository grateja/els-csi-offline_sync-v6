<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">View</h3>
            <?php echo CHtml::link('<i class="fa fa-plus"></i>',$this->createUrl('customerCardTransactions/create'), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
            <?php echo CHtml::link('<i class="fa fa-arrow-left"></i>', $this->createUrl('customerCardTransactions/admin'), array('class' => 'btn btn-xs btn-primary pull-right', 'data-toggle' => 'tooltip', 'title' => 'Back', 'style' => 'margin-right: 5px;')); ?>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <tr>
                                    <th>Date Created</th>
                                    <td><?php echo Settings::setDateTimeStandard($model->created_at)?></td>
                                </tr>
                                <tr>
                                    <th>Last Modified</th>
                                    <td><?php echo Settings::setDateTimeStandard($model->updated_at)?></td>
                                </tr>
                                <tr>
                                    <th>branch_id</th>
                                    <td><?php print $model->branch_id?></td>
                                </tr>
                                <tr>
                                    <th>client_id</th>
                                    <td><?php print $model->client_id?></td>
                                </tr>
                                <tr>
                                    <th>customer_id</th>
                                    <td><?php print $model->customer_id?></td>
                                </tr>
                                <tr>
                                    <th>card_id</th>
                                    <td><?php print $model->card_id?></td>
                                </tr>
                                <tr>
                                    <th>card_no</th>
                                    <td><?php print $model->card_no?></td>
                                </tr>
                                <tr>
                                    <th>transaction_id</th>
                                    <td><?php print $model->transaction_id?></td>
                                </tr>
                                <tr>
                                    <th>credited</th>
                                    <td><?php print $model->credited?></td>
                                </tr>
                                <tr>
                                    <th>debited</th>
                                    <td><?php print $model->debited?></td>
                                </tr>
                                <tr>
                                    <th>balance</th>
                                    <td><?php print $model->balance?></td>
                                </tr>
                                <tr>
                                    <th>user_id</th>
                                    <td><?php print $model->user_id?></td>
                                </tr>
                                <tr>
                                    <th>remarks</th>
                                    <td><?php print $model->remarks?></td>
                                </tr>
                                            </table>
        </div>
    </div>
</div>