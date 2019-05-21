
<div class="modal modal-primary fade" id="quantityModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Enter Quantity</h4>
            </div>
            <div class="modal-body">
                <?php $model = new PosTransactions(); ?>

                <div class="form-group">
                    <?php echo CHtml::activeTextField($model, 'qty', array('class' => 'form-control', 'id' => 'quantityValue', 'style' => 'width: 100%', 'onInput' => 'passQuantity(this.id,this.value)')); ?>
                </div>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success"  onClick="js:  saveInventoryTransaction()">Continue</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<div class="modal modal-primary fade" id="discountModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Select Discount</h4>
            </div>
            <div class="modal-body">
                <?php $model = new Discounts(); ?>

                <div class="form-group">
                    <?php echo CHtml::activeDropDownList($model, 'id', CHtml::listData(Discounts::model_getAllData_byDeleted(Utilities::NO), 'id', 'name'), array('class' => 'form-control', 'prompt' => '-- Select --', 'style' => 'width: 100%', 'onChange' => 'getDiscountType (this.value, this.id)', 'id' => 'discountTypeName')); ?>
                </div>  
                <div class="form-group" id="divDiscountValue">
                    <?php print CHtml::activeLabelEx($model, 'value'); ?>
                    <?php print CHtml::activeTextField($model, 'value', array('class' => 'form-control', 'placeholder' => '0.00')); ?>
                </div>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success"  onClick="js:  saveInventoryTransaction()">Continue</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<div class="modal modal-primary fade" id="paymentSuccess">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Message!</h4>
            </div>
            <div class="modal-body">

                <span>Payment Successful!. Do you want to print an official Receipt?</span>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" onClick="js: reloadPage()">Close</button>
                <button type="button" class="btn btn-success"  onClick="js:  printReceipt()">Print Receipt</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<div class="modal modal-primary fade" id="customerModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create - Customer</h4>
            </div>   
          <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'customer_form',
                    'enableAjaxValidation' => false,
                    'htmlOptions' => array(
                        'onsubmit' => "return false;", /* Disable normal form submit */
                        'onkeypress' => " if(event.keyCode == 13){ ajaxCreate(); } " /* Do ajax call when user presses enter key */
                    ),
                ));
            ?>
            <input type="hidden" name="spos_token" value="6a1bdeabc6148fc68b52ddbceabcc82d" /> 
            <div class="modal-body">

                <?php $modelCustomer = new Customers(); ?>

                <div class="form-group">
                    <?php print CHtml::activeLabelEx($modelCustomer, 'firstname'); ?>
                    <?php print CHtml::activeTextField($modelCustomer, 'firstname', array('class' => 'form-control', 'placeholder' => '')); ?>
                </div>
                <div class="form-group">
                    <?php print CHtml::activeLabelEx($modelCustomer, 'middlename'); ?>
                    <?php print CHtml::activeTextField($modelCustomer, 'middlename', array('class' => 'form-control', 'placeholder' => '')); ?>
                </div>
                <div class="form-group">
                    <?php print CHtml::activeLabelEx($modelCustomer, 'lastname'); ?>
                    <?php print CHtml::activeTextField($modelCustomer, 'lastname', array('class' => 'form-control', 'placeholder' => '')); ?>
                </div>
                <div class="form-group">
                    <?php print CHtml::activeLabelEx($modelCustomer, 'company_name'); ?>
                    <?php print CHtml::activeTextField($modelCustomer, 'company_name', array('class' => 'form-control', 'placeholder' => '')); ?>
                </div>
                <div class="form-group">
                    <?php print CHtml::activeLabelEx($modelCustomer, 'address'); ?>
                    <?php print CHtml::activeTextField($modelCustomer, 'address', array('class' => 'form-control', 'placeholder' => '')); ?>
                </div>

                <div class="form-group">
                    <?php print CHtml::activeLabelEx($modelCustomer, 'birthdate'); ?>
                    <?php print CHtml::activeTextField($modelCustomer, 'birthdate', array('class' => 'form-control datepicker', 'placeholder' => '', "autocomplete" => "off")); ?>
                </div>

                <div class="form-group">
                    <?php print CHtml::activeLabelEx($modelCustomer, 'email'); ?>
                    <?php print CHtml::activeTextField($modelCustomer, 'email', array('class' => 'form-control', 'placeholder' => '')); ?>
                </div>
                <div class="form-group">
                    <?php print CHtml::activeLabelEx($modelCustomer, 'mobile'); ?>
                    <?php print CHtml::activeTextField($modelCustomer, 'mobile', array('class' => 'form-control', 'placeholder' => '')); ?>
                </div>
                <div class="form-group">
                    <?php print CHtml::activeLabelEx($modelCustomer, 'phone'); ?>
                    <?php print CHtml::activeTextField($modelCustomer, 'phone', array('class' => 'form-control', 'placeholder' => '')); ?>
                </div>
            </div>

            <?php $this->endWidget(); ?>   

        </div>
        <div class="modal-footer">

            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success"  onClick="js:  ajaxCreate()">Save</button>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
