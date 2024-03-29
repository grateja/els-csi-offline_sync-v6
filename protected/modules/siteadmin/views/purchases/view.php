<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">View</h3>
            <?php echo CHtml::link('<i class="fa fa-plus"></i>',$this->createUrl('purchases/create'), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
            <?php echo CHtml::link('<i class="fa fa-arrow-left"></i>', $this->createUrl('purchases/admin'), array('class' => 'btn btn-xs btn-primary pull-right', 'data-toggle' => 'tooltip', 'title' => 'Back', 'style' => 'margin-right: 5px;')); ?>
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
                                    <th>date</th>
                                    <td><?php print Settings::setDateTimeStandard($model->date)?></td>
                                </tr>
                                <tr>
                                    <th>Supplier</th>
                                    <td><?php print $model->suppliers->company_name?></td>
                                </tr>
                                <tr>
                                    <th>Received By</th>
                                    <td><?php print $model->employees->lnameFname?></td>
                                </tr>
                                <tr>
                                    <th>Item Name</th>
                                    <td><?php print $model->inventories->name?></td>
                                </tr>
                                <tr>
                                    <th>Quantity</th>
                                    <td><?php print $model->qty?></td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td><?php print $model->price?></td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td><?php print $model->total?></td>
                                </tr>
                                <tr>
                                    <th>Client</th>
                                    <td><?php print $model->clients->fullName?></td>
                                </tr>
                                <tr>
                                    <th>Branch</th>
                                    <td><?php print $model->branches->name?></td>
                                </tr>
                                            </table>
        </div>
    </div>
</div>