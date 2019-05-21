
<!-- NEW COL START -->
<br />
<article class="col-sm-12 col-md-12 col-lg-6">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-4" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">

            <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>Activate - Customer Cards</h2>
            </header>

            <div class="modal-content">
        <?php  print CHtml::beginForm('','POST', array('class'=>'smart-form'));?>
                <?php $this->widget('Flashes'); ?>
                <div class="widget-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Reg Date</th>
                                    <td><?php echo date("M-d-Y h:m ",strtotime($model->reg_date))?></td>
                                </tr>
                                <tr>
                                    <th>Last Transaction</th>
                                    <td><?php echo date("M-d-Y h:m ",strtotime($model->last_trans_date))?></td>
                                </tr>
                                <tr>
                                    <th>Expiration Date</th>
                                    <td><?php echo date("M-d-Y h:m ",strtotime($model->exp_date))?></td>
                                </tr>
                                <tr>
                                    <th>Card No.</th>
                                    <td><?php echo $model->card_no?></td>
                                </tr>
                                <tr>
                                    <th>Customer</th>
                                    <td><?php echo $model->customers->lnameFname; ?></td>
                                </tr>
                                <tr>
                                    <th>Client</th>
                                    <td><?php echo $model->clients->name?></td>
                                </tr>
                                <tr>
                                    <th>Laundry Shop</th>
                                    <td><?php echo $model->laundryShops->name?></td>
                                </tr>
                                <tr>
                                    <th>RF ID</th>
                                    <td>
                                        <?php echo CHtml::activeTextField($model,'rf_id',  array('class'=>'form-control','placeholder'=>'Rf ID', 'value' => $_SESSION[CustomerCards::tbl()]['rf_id'])); ?>
                                     <b class="tooltip tooltip-bottom-left">
                                                Enter RF ID
                                      </b> 
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;">    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Activate',  array('class'=>'btn btn-sm btn-danger','style'=>'width: 150px;')); ?></td>
                                </tr>
                            </thead>
                        </table>  
                        <?php print CHtml::endForm(); ?>
                    </div>
             </div>
            <!-- end widget content -->
            </div>
        </div>
        <!-- end widget div -->
</article>
