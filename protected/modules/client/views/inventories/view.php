<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">View</h3>
            <?php echo CHtml::link('<i class="fa fa-plus"></i>', $this->createUrl('inventories/create', array('categoryID'=>$model->category_id)), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
            <?php echo CHtml::link('<i class="fa fa-arrow-left"></i>', $this->createUrl('inventories/admin'), array('class' => 'btn btn-xs btn-primary pull-right', 'data-toggle' => 'tooltip', 'title' => 'Back', 'style' => 'margin-right: 5px;')); ?>
        </div>
        <div class="box-body">
            <div class="form-group" style="text-align: center;">
                <?php print CHtml::activeLabelEx($model, 'Uploaded Image'); ?>
                <div class="image-upload">
                    <div class ="square-img">
                        <?php print CHtml::image(Settings::get_baseUrl() . "/" . $model->file_path . "/" . $model->file_pics, "") ?>
                    </div>
                </div>
            </div>
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
                    <th>Branch</th>
                    <td><?php print $model->branches->name  ?></td>
                </tr>
                <tr>
                    <th>Client</th>
                    <td><?php print $model->clients->fullName ?></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td><?php print $model->name?></td>
                </tr>
                <tr>
                    <th>Bar Code</th>
                    <td><?php print $model->bar_code ?></td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td><?php print $model->category_id ?></td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td><?php print $model->price ?></td>
                </tr>
                <tr>
                    <th>Cost</th>
                    <td><?php print $model->cost ?></td>
                </tr>
                <tr>
                    <th>Tax</th>
                    <td><?php print $model->tax ?></td>
                </tr>
                <tr>
                    <th>Margin</th>
                    <td><?php print $model->margin ?></td>
                </tr>
                <tr>
                    <th>Qty Stock</th>
                    <td><?php print $model->qty_stock ?></td>
                </tr>
                <tr>
                    <th>Qty Reorder</th>
                    <td><?php print $model->qty_reorder ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>