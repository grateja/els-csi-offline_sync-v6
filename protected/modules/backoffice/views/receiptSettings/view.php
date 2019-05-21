<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">View</h3>
            <?php echo CHtml::link('<i class="fa fa-plus"></i>', $this->createUrl('receiptSettings/create'), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
            <?php echo CHtml::link('<i class="fa fa-arrow-left"></i>', $this->createUrl('receiptSettings/admin'), array('class' => 'btn btn-xs btn-primary pull-right', 'data-toggle' => 'tooltip', 'title' => 'Back', 'style' => 'margin-right: 5px;')); ?>
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
                    <th>Client</th>
                    <td><?php print $model->clients->fullName ?></td>
                </tr>
                <tr>
                    <th>Branch</th>
                    <td><?php print $model->branches->name ?></td>
                </tr>
                <tr>
                    <th>Header</th>
                    <td><?php print $model->header ?></td>
                </tr>
                <tr>
                    <th>Message</th>
                    <td><?php print $model->message ?></td>
                </tr>
                <tr>
                    <th>Footer</th>
                    <td><?php print $model->footer ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>