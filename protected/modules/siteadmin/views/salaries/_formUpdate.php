<?php print CHtml::beginForm('', 'POST', array('role' => 'form')); ?>
<div class="box-body">
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'date_released'); ?>
        <?php print CHtml::activeTextField($model, 'date_released', array('class' => 'form-control datepicker', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'date_from'); ?>
        <?php print CHtml::activeTextField($model, 'date_from', array('class' => 'form-control datepicker', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'date_to'); ?>
        <?php print CHtml::activeTextField($model, 'date_to', array('class' => 'form-control datepicker', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'emp_id'); ?>
        <?php print CHtml::activeDropDownList($model, 'emp_id', CHtml::listData(Employees::model_getAllData_byDeleted(Utilities::NO), 'id', 'fullName'), array('class' => 'form-control', 'promp' => 'Choose One')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'branch_id'); ?>
        <?php print CHtml::activeDropDownList($model, 'branch_id', CHtml::listData(Branches::model_getAllData_byDeleted(Utilities::NO), 'id', 'name'), array('class' => 'form-control', 'promp' => 'Choose One')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'client_id'); ?>
        <?php print CHtml::activeDropDownList($model, 'client_id', CHtml::listData(Clients::model_getAllData_byDeleted(Utilities::NO), 'id', 'fullName'), array('class' => 'form-control', 'promp' => 'Choose One')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'expenses_type_id'); ?>
        <?php print CHtml::activeDropDownList($model, 'expenses_type_id', CHtml::listData(ExpensesTypes::model_getAllData_byDeleted(Utilities::NO), 'id', 'name'), array('class' => 'form-control', 'promp' => 'Choose One')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'title'); ?>
        <?php print CHtml::activeTextField($model, 'title', array('class' => 'form-control', 'placeholder' => '')); ?>
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
        <?php print CHtml::activeLabelEx($model, 'account_no'); ?>
        <?php print CHtml::activeTextField($model, 'account_no', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'bank_id'); ?>
        <?php print CHtml::activeTextField($model, 'bank_id', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
</div>

<div class="box-footer">
    <?php print CHtml::link('Back', $this->createUrl('salaries/admin'), array('class' => 'btn btn-default')); ?>
    <?php print CHtml::submitButton($model->isNewRecord ? 'Save' : 'Update', array('class' => 'btn btn-primary pull-right')); ?>
</div>
<?php print CHtml::endForm(); ?>