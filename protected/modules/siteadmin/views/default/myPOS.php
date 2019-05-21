
<div class ="col-lg-8">
    <div class="nav-tabs-custom" style="cursor: auto;">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs pull-right ui-sortable-handle">
            <li><a href="#fullService" data-toggle="tab">Full Service </a></li>
            <li><a href="#selfService" data-toggle="tab">Self Service</a></li>
            <li class="active"><a href="#items" data-toggle="tab">Items</a></li>
            <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
            <li>

                <input type="text" id="myInput" onkeyup="myFunction()"  placeholder="Search ..." class="form-control" style='width: 150px; padding: 4px'>
            </li>
        </ul>
        <div class="tab-content no-padding">

            <div class="chart tab-pane" id="fullService" style="position: relative;">
                <div class="col-sm-12">
                    <ul class="myProducts">
                        <?php $model = Inventories::model_getAllData_byCategoryIDServiceTypeID(Settings::get_BranchID(), Utilities::NO, InventoryCategories::INVENTORY_TYPE_SERVICES, Utilities::FULL_SERVICE); ?>
                        <?php foreach ($model as $model): ?>
                                <li>
                                    <a>
                                        <div class="small-box" onclick="showQuantityModal(<?= $model->id; ?>)">
                                            <div class="col-sm-2">
                                                ​<picture >
                                                    <!--<source srcset="<?= Settings::get_baseUrl() . '/' . $model->file_path . $model->file_pics; ?>" type="image/svg+xml">-->
                                                    <img src="<?= Settings::get_baseUrl() . '/' . $model->file_path . $model->file_pics; ?>" class="img-fluid img-thumbnail" alt="<?= $model->desc ?>">

                                                    <figcaption style="text-align: center; "><strong><?= $model->name ?></strong><br /><?= $model->price ?></figcaption>
                                                </picture>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="chart tab-pane" id="selfService" style="position: relative;  "> 
                <div class="col-sm-12">
                    <ul class='myProducts'>
                        <?php $model = Inventories::model_getAllData_byCategoryIDServiceTypeID(Settings::get_BranchID(), Utilities::NO, InventoryCategories::INVENTORY_TYPE_SERVICES, Utilities::SELF_SERVICE); ?>
                        <?php foreach ($model as $model): ?>
                                <li> <a>  <div class="small-box" onclick="showQuantityModal(<?= $model->id; ?>)">
                                            <div class="col-sm-2">
                                                ​<picture >
                                                    <!--<source srcset="<?= Settings::get_baseUrl() . '/' . $model->file_path . $model->file_pics; ?>" type="image/svg+xml">-->
                                                    <img src="<?= Settings::get_baseUrl() . '/' . $model->file_path . $model->file_pics; ?>" class="img-fluid img-thumbnail" alt="<?= $model->desc ?>">

                                                    <figcaption style="text-align: center; "><strong><?= $model->name ?></strong><br /><?= $model->price ?></figcaption>
                                                </picture>
                                            </div>
                                        </div>
                                    </a> </li>
                            <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class=" chart tab-pane active" id="items" style="position: relative; ">
                <div class="col-sm-12">
                    <ul class='myProducts'>
                        <?php $model = Inventories::model_getAllData_byCategoryID(InventoryCategories::INVENTORY_TYPE_PRODUCT, Utilities::NO, Settings::get_BranchID()) ?>
                        <?php foreach ($model as $model): ?>
                                <li> <a>  <div class="small-box" onclick="showQuantityModal(<?= $model->id; ?>)">
                                            <div class="col-sm-2">
                                                ​<picture >
                                                    <!--<source srcset="<?= Settings::get_baseUrl() . '/' . $model->file_path . $model->file_pics; ?>" type="image/svg+xml">-->
                                                    <img src="<?= Settings::get_baseUrl() . '/' . $model->file_path . $model->file_pics; ?>" class="img-fluid img-thumbnail" alt="<?= $model->desc ?>">

                                                    <figcaption style="text-align: center; "><strong><?= $model->name ?></strong><br /><?= $model->price ?></figcaption>
                                                </picture>
                                            </div>
                                        </div>
                                    </a></li>
                            <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="box box-primary">

        <div class="box-body">
            <form action="#" method="post">
                <div class="form-group">
                    <div class="input-group input-group-sm">     
                        <?php echo CHtml::activeDropDownList($posTransactions, 'cust_id', CHtml::listData(Customers::model_getAllData_byDeleted(Utilities::NO), 'id', 'lnameFname'), array('prompt' => '--Select Customer--', 'id' => 'customerName', 'class' => 'form-control select2 select2-hidden-accessible', 'style' => 'width: 100%;', 'onChange' => 'searchTransactions()')); ?>

                        <span class="input-group-btn">
                            <a type="button" class="btn btn-success" onClick="js: showCustomerModal()"><i  class="fa fa-plus"></i></a>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo CHtml::activeTextArea($posTransactions, 'remarks', array('class' => 'form-control', 'placeholder' => 'Remarks', 'id' => 'refNote', 'class' => 'form-control')); ?>

                </div>

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body no-padding" style="height: 250px !important;overflow-y: auto">
                        <table class="table table-striped table-hover" id="posTable">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th style="width: 40px">Amount</th>
                                    <th style="width: 10px;" >Delete</i></th>
                                </tr>
                            </thead>
                            <tbody>  </tbody>
                        </table>
                    </div>

                </div>
                <table class="table table-striped table-bordered table-hover">
                    <tbody>
                        <tr>
                            <td  width="70%" style="text-align:right;"><b>Total Items</b></td>
                            <td class="text-right"  style="font-weight:bold;"><span id="totalItems">0</span></td>
                        </tr>
                        <tr>
                            <td width="70%" style="text-align:right;"><span id="add_discount"> <b>Total Amount Due</b></span></td>
                            <td class="text-right"  style="font-weight:bold;"><span id="totalPayable">0</span></td>
                        </tr>

                    </tbody>
                </table>

            </form>
        </div>
        <div class="box-footer clearfix ">

            <a class="btn btn-app pull-right" onClick="js: saveTransactions()" id="saveBtn">
                <i class="fa fa-save"></i> Save
            </a>
            <a class="btn btn-app pull-right" onClick="js: showPaymentModal()" id="payment" style="display: none;">
                <i class="fa fa-money"></i> Payment
            </a> 
            <!--<a class="btn btn-app pull-right" onClick="js:  showPrintJobOrder()" disabled='disabled'>-->
            <a class="btn btn-app pull-right" disabled='disabled'>
                <i class="fa fa-print"></i> Print
            </a>
        </div>
    </div>
</div>
<input type="hidden" name="quantityValue" id="quantityValue"/>
<input type="hidden" name="inventoryID" id="inventoryID"/>
<input type="hidden" name="discountTypeID" id="discountTypeID"/>
<input type="hidden" name="totalPoints" id="totalPoints"/>
<input type="hidden" name="totalLoadBalance" id="totalLoadBalance"/>
<input type="hidden" name="headerID" id="headerID"/>

