<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">View</h3>
            <?php echo CHtml::link('<i class="fa fa-plus"></i>', $this->createUrl('users/create'), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
            <?php echo CHtml::link('<i class="fa fa-arrow-left"></i>', $this->createUrl('users/admin'), array('class' => 'btn btn-xs btn-primary pull-right', 'data-toggle' => 'tooltip', 'title' => 'Back', 'style' => 'margin-right: 5px;')); ?>
        </div>
        <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: left;"> Employee Name:</th>
                                <td> <?php echo $model->employees->lnameFname ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;"> Username:</th>
                                <td> <?php echo $model->username ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;"> Email:</th>
                                <td> <?php echo $model->email ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Date Created:</th>
                                <td> <?php echo $model->created_at ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Last Modified:</th>
                                <td> <?php echo $model->updated_at ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Is Active:</th>
                                <td> <?php echo $model->isActive; ?></td>
                            </tr>
                        </thead>
                    </table>
        </div>
    </div>
</div