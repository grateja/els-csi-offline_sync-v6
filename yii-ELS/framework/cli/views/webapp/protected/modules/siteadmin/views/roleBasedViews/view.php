<br/>
<!-- NEW COL START -->
<article class="col-sm-12 col-md-12 col-lg-6">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-4" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
        <header>
            <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
            <h2>View - Role Based Access</h2>
        </header>

        <div class="modal-content">
            <!--<div class="widget-footer smart-form" style="text-align: center;padding-bottom: 20px;">-->
            <div class="smart-form" style="text-align: center;padding-bottom: 10px;">
                <?php print CHtml::link('<i class="fa fa-plus-circle">' . ' Create New</i>', $this->createUrl('roleBasedViews/create'), array('class' => 'btn btn-success btn-sm', 'style' => 'width: 150px;', 'id' => 'btnPayment')); ?>
                <?php print CHtml::link('<i class="fa fa-cubes">' . ' Manage</i>', $this->createUrl('roleBasedViews/admin'), array('class' => 'btn btn-primary btn-sm', 'style' => 'width: 150px;', 'id' => 'btnPayment')); ?>
            </div>

            <?php $this->widget('Flashes'); ?>
            <div class="widget-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <td><?php echo $model->roles->name ?></td>
                            </tr>
                            <tr>
                                <th>Menu</th>
                                <td><?php echo $model->menus->name ?></td>
                            </tr>
                            <tr>
                                <th>Menu Name</th>
                                <td><?php echo $model->menu_name ?></td>
                            </tr>
                            <tr>
                                <th>Date Created</th>
                                <td><?php echo date("M-d-Y h:m ", strtotime($model->created_at)) ?></td>
                            </tr>
                            <tr>
                                <th>Last Modified</th>
                                <td><?php echo date("M-d-Y h:m ", strtotime($model->updated_at)) ?></td>
                            </tr>
                            <tr>
                                <th>Is Viewable</th>
                                <td><?php echo $model->isViewable ?></td>
                            </tr>
                            <tr>
                                <th>Is Deleted</th>
                                <td><?php echo $model->isDeleted ?></td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- end widget content -->
        </div>
    </div>
    <!-- end widget div -->
</article>