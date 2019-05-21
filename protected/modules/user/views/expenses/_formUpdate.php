<?php print CHtml::beginForm('', 'POST', array('role' => 'form', 'autocomplete' => 'off')); ?>
<div class="box-body">


    <div class="form-group">
        <?php
            
            if ($_SESSION[Expenses::tbl()]['date'] == '') {
                $date = date('m-d-Y', strtotime(Settings::get_DateTime()));
            }else{
                $date = $_SESSION[Expenses::tbl()]['date'];
            }
        ?>
        <?php print CHtml::activeLabelEx($model, 'date'); ?>
        <?php print CHtml::activeTextField($model, 'date', array('value' => $date, 'class' => 'form-control datepicker', 'placeholder' => '')); ?>
    </div>

    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'expenses_type_id'); ?>
        <?php print CHtml::activeDropDownList($model, 'expenses_type_id', CHtml::listData(ExpensesTypes::model_getAllData_byDeleted(Utilities::NO), 'id', 'name'), array('class' => 'form-control', 'prompt' => 'Choose One')); ?>
    </div>

    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'amount'); ?>
        <?php print CHtml::activeTextField($model, 'amount', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'remarks'); ?>
        <?php print CHtml::activeTextField($model, 'remarks', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'is_deleted'); ?>
        <?php print CHtml::activeDropDownList($model, 'is_deleted', Utilities::get_ActiveSelect(), array('class' => 'form-control ', 'prompt' => '--select')); ?>
    </div>

</div>
</div>

<div class="box-footer">
    <?php print CHtml::link('Back', $this->createUrl('expenses/admin'), array('class' => 'btn btn-default')); ?>
    <?php print CHtml::submitButton($model->isNewRecord ? 'Save' : 'Update', array('class' => 'btn btn-primary pull-right')); ?>
</div>
<?php print CHtml::endForm(); ?>