<?php print CHtml::beginForm('', 'POST', array('role' => 'form', 'autoComplete' => 'off')); ?>
<div class="box-body">

    <div class="form-group">
        <?php
            if ($_SESSION[Purchases::tbl()]['date'] == '') {
                $date  = date('m-d-Y' , strtotime(Settings::get_DateTime()));
            }
        ?>
        <?php print CHtml::activeLabelEx($model, 'date'); ?>
        <?php print CHtml::activeTextField($model, 'date', array('class' => 'form-control datepicker', 'placeholder' => '')); ?>
    </div> 
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'supplier_id'); ?>
        <?php print CHtml::activeDropDownList($model, 'supplier_id', CHtml::listData(Suppliers::model_getAllData_byDeletedClientID(Utilities::NO, Settings::get_ClientID()), 'id', 'fullName'), array('class' => 'form-control', 'prompt' => '-- Select --')); ?>
    </div> 

     <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'Received By'); ?>
        <?php print CHtml::activeDropDownList($model, 'received_by_empid', CHtml::listData(Employees::model_getAllData_byIsClientID(Utilities::NO, Settings::get_ClientID()), 'id', 'lnameFname'), array('class' => 'form-control', 'prompt' => '-- Select --')); ?>
    </div> 
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'Item Name'); ?>
        <?php echo CHtml::activeDropDownList($model, 'inv_id', CHtml::listData(Inventories::model_getAllProducts_byCategoryID(InventoryCategories::INVENTORY_TYPE_SERVICES, Utilities::NO, Settings::get_BranchID()), 'id', 'name'), array('class' => 'form-control', 'prompt' => '--select--')); ?>
    </div>


    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'qty'); ?>
        <?php print CHtml::activeTextField($model, 'qty', array('class' => 'form-control ', 'placeholder' => '0', 'id' => 'quantity', 'onInput' => 'js: computeTotalAmount()')); ?>
    </div> 

    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'Cost'); ?>
        <?php print CHtml::activeTextField($model, 'price', array('class' => 'form-control ', 'placeholder' => '0.00', 'id' => 'price', 'onInput' => 'js: computeTotalAmount()')); ?>
    </div> 



    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'total'); ?>
        <?php print CHtml::activeTextField($model, 'total', array('class' => 'form-control ', 'id' => 'totalAmount', 'placeholder' => '0.00', 'readonly' => 'readOnly')); ?>
    </div> 

    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'is_deleted'); ?>
        <?php print CHtml::activeDropDownList($model, 'is_deleted', Utilities::get_ActiveSelect(), array('class' => 'form-control ', 'prompt' => '--select')); ?>
    </div>
</div>

<div class="box-footer">
    <?php print CHtml::link('Back', $this->createUrl('purchases/admin'), array('class' => 'btn btn-default')); ?>
    <?php print CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary pull-right')); ?>
</div>
<?php print CHtml::endForm(); ?>
<script type="text/javascript">

        function computeTotalAmount() {
            var qauntity = document.getElementById('quantity').value;
            var price = document.getElementById('price').value;

            if (qauntity == '')
                qauntity = 0;

            if (price == '')
                price = 0;

            if ($.isNumeric(qauntity) && $.isNumeric(price)) {
                var totalamount = parseFloat(qauntity) * parseFloat(price);
                $('#totalAmount').val(parseFloat(totalamount).toFixed(2));
            } else {
                $('#quantity').val('0.00');
            }
        }

</script>