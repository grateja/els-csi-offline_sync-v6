<style>
    #faLeft .fa {
        float: left !important;
        color: #353535 !important;
    }
</style>
<!--<form class="smart-form">-->
<?php print CHtml::beginForm('', 'POST', array('class' => 'smart-form')); ?>
<?php $this->widget('Flashes'); ?>

<div class="box-body">
    <div class="form-group">
        <?php echo CHtml::activeLabelEx($model, 'ip_address'); ?>
        <?php echo CHtml::activeTextField($model, 'ip_address', array('class' => 'form-control')); ?>

    </div> 
    <div class="form-group">
        <?php echo CHtml::activeLabelEx($model, 'name'); ?>
        <?php echo CHtml::activeTextField($model, 'name', array('class' => 'form-control')); ?>

    </div>
    <div class="form-group">
        <?php echo CHtml::activeLabelEx($model, 'machine_type_id'); ?>
       <?php echo CHtml::activeDropDownList($model, 'machine_type_id', CHtml::listData(MachineTypes::model_getAllData_byDeleted(Utilities::NO), 'id', 'name'), array('class' => 'form-control', 'prompt' => '--select--'));?>
    </div>
    
    <div class="form-group">
        <?php echo CHtml::activeLabelEx($model, 'serial_no'); ?>
        <?php echo CHtml::activeTextField($model, 'serial_no', array('class' => 'form-control')); ?> 
    </div>
    
    <div class="box-footer smart-form">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-sm btn-success')); ?>
    </div>
</div>

<?php print CHtml::endForm(); ?>
<!--</form>-->
