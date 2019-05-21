<?php print CHtml::beginForm('', 'POST', array('role' => 'form')); ?>
<div class="box-body">
    
    
    
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'transaction_id'); ?>
        <?php print CHtml::activeDropDownList($model, 'transaction_id', CHtml::listData(Transactions::model_getAllData_byIsDeleted(Utilities::NO), 'id', 'name'),array('class' => 'form-control', 'prompt' => '-- Select --')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'price'); ?>
        <?php print CHtml::activeTextField($model, 'price', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
   
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'inv_id'); ?>
        <?php print CHtml::activeDropDownList($model, 'inv_id', CHtml::listData(Inventories::model_getAllProducts_byCategoryIDClientID_isDeleted(InventoryCategories::INVENTORY_TYPE_SERVICES, Utilities::NO, Settings::get_ClientID()), 'id', 'name'),array('class' => 'form-control', 'prompt' => '-- Select --')); ?>
    </div>
</div>

<div class="box-footer">
    <?php print CHtml::link('Back', $this->createUrl('servicePrices/admin'), array('class' => 'btn btn-default')); ?>
    <?php print CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary pull-right')); ?>
</div>
<?php print CHtml::endForm(); ?>