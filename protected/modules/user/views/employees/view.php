<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Profile</h3>
            <?php echo CHtml::link('<i class="fa fa-edit"></i>', $this->createUrl('employees/create', array('id' => $model->id)), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
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
                    <th>Date Created</th>
                    <td><?php echo Settings::setDateTimeStandard($model->created_at) ?></td>
                </tr>
                <tr>
                    <th>Last Modified</th>
                    <td><?php echo Settings::setDateTimeStandard($model->updated_at) ?></td>
                </tr>
                <tr>
                    <th>employee_no</th>
                    <td><?php print $model->employee_no ?></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td><?php print $model->fullName ?></td>
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
                    <th>Email</th>
                    <td><?php print $model->email ?></td>
                </tr>
                <tr>
                    <th>Birthdate</th>
                    <td><?php print $model->birthdate ?></td>
                </tr>
                
                <tr>
                    <th>Address</th>
                    <td><?php print $model->address1 ?></td>
                </tr>
                
                <tr>
                    <th>Branch</th>
                    <td><?php print $model->clients->firstname?></td>
                
                <tr>
                    <th>Is Active</th>
                    <td><?php print $model->isActive ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>