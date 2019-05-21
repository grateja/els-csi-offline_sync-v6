<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">View</h3>
            <?php echo CHtml::link('<i class="fa fa-arrow-left"></i>', $this->createUrl('customerCards/admin'), array('class' => 'btn btn-xs btn-primary pull-right', 'data-toggle' => 'tooltip', 'title' => 'Back', 'style' => 'margin-right: 5px;')); ?>
        </div>
        <div class="box-body">

            <?php $this->widget('Flashes'); ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Reg Date</th>
                            <td><?php echo date("M-d-Y h:m ", strtotime($model->reg_date)) ?></td>
                        </tr>
                        <tr>
                            <th>Last Transaction</th>
                            <td><?php echo date("M-d-Y h:m ", strtotime($model->last_trans_date)) ?></td>
                        </tr>
                        <tr>
                            <th>Expiration Date</th>
                            <td><?php echo date("M-d-Y h:m ", strtotime($model->exp_date)) ?></td>
                        </tr>
                        <tr>
                            <th>Card No.</th>
                            <td><?php echo $model->card_no ?></td>
                        </tr>
                        <tr>
                            <th>RF ID</th>
                            <td>
                                <?php if ($model->rf_id != ''): ?>
                                    <?php print $model->rf_id; ?>
                                <?php else: ?>
                                    <span style="color: red;">( not set )</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Customer</th>
                            <td><?php echo $model->customers->lnameFname; ?></td>
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
                            <th>Is Activated</th>
                            <td><?php echo $model->isActivated ?></td>
                        </tr>
                        <tr>
                            <th>Is Deleted</th>
                            <td><?php echo $model->isDeleted ?></td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>