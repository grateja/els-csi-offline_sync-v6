<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Profile</h3>
            <?php echo CHtml::link('<i class="fa fa-edit"></i>', $this->createUrl('branches/update' ,array('id' => Settings::get_BranchID())), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
            <?php echo CHtml::link('<i class="fa fa-arrow-left"></i>', $this->createUrl('branches/admin'), array('class' => 'btn btn-xs btn-primary pull-right', 'data-toggle' => 'tooltip', 'title' => 'Back', 'style' => 'margin-right: 5px;')); ?>
        </div>
        <div class="form-group" style="text-align: center;"><br />
            <?php // print CHtml::activeLabelEx($model, ''); ?>
            <div class="image-upload">
                <div class ="square-img">
                    <?php print CHtml::image(Settings::get_baseUrl() . "/" . $model->file_path . "/" . $model->file_pics, "") ?>
                </div>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered">

                <tr>
                    <th>Owner</th>
                    <td><?php print $model->clients->fullName ?></td>
                </tr>
                 <tr>
                    <th>Shop Name</th>
                    <td><?php print $model->name?></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><?php print $model->address ?></td>
                </tr>
                
                <tr>
                    <th>Contact Number</th>
                    <td><?php print $model->contact_no ?></td>
                </tr>
                
                <tr>
                    <th>Email Address</th>
                    <td><?php print $model->email_address ?></td>
                </tr>
                
                <tr>
                    <th>Receipt Header</th>
                    <td><?php print $model->header_rcpt_msg ?></td>
                </tr>
                
                <tr>
                    <th>Receipt Footer</th>
                    <td><?php print $model->footer_rcpt_msg ?></td>
                </tr>
                <tr>
                    <th>Date Created</th>
                    <td><?php echo Settings::setDateTimeStandard($model->created_at) ?></td>
                </tr>
                <tr>
                    <th>Last Modified</th>
                    <td><?php echo Settings::setDateTimeStandard($model->updated_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>