<?php print CHtml::beginForm('', 'POST', array('role' => 'form')); ?>
<div class="box-body">

    <div class="form-group">
        <?php print CHtml::activeLabelEx($customers, 'Name'); ?>
        <?php print CHtml::activeTextField($customers, 'lnameFname', array('class' => 'form-control  ', 'disabled' => 'disabled', 'placeholder' => '')); ?>
    </div>

    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'reg_date'); ?>
        <?php print CHtml::activeTextField($model, 'reg_date', array('class' => 'form-control datepicker', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php echo CHtml::activeLabelEx($model, 'card_no'); ?>
        <?php echo CHtml::activeTextField($model, 'card_no', array('class' => 'form-control', 'placeholder' => 'Card No.', 'value' => $_SESSION[CustomerCards::tbl()]['card_no'], 'readOnly' => true)); ?>

    </div>
    <div class="form-group">
        <?php echo CHtml::activeLabelEx($model, 'amount'); ?>
        <?php echo CHtml::activeTextField($model, 'amount', array('class' => 'form-control', 'placeholder' => 'Load Amount', 'value' => $_SESSION[CustomerCards::tbl()]['amount'])); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'rf_id'); ?>
        <?php echo CHtml::activeTextField($model, 'rf_id', array('class' => 'form-control', 'placeholder' => 'Rf ID', 'value' => $_SESSION[CustomerCards::tbl()]['rf_id'])); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'card_type_id'); ?>
        <?php echo CHtml::activeDropDownList($model, 'card_type_id', Utilities::get_ActiveCardType(), array('prompt' => '-- Select --', 'id' => 'cardTypeID', 'class' => 'form-control', 'onChange' => 'js: showHideDivCardUser(this.value)', 'value' => $_SESSION[CustomerCards::tbl()]['card_type_id'])); ?>
    </div>
    <div style ='display: none' id="divCardUser">
        <div class="form-group">
            <?php print CHtml::activeLabelEx($model, 'card_user_id'); ?>
            <?php echo CHtml::activeDropDownList($model, 'card_user_id', CHtml::listData(Employees::model_getAllData_byIsWithCard_andIsDeleted(0,Utilities::NO), 'id', 'lnameFname'), array('prompt' => '-- Select --', 'class' => 'form-control', 'style' => 'width: 100%','placeholder' => 'Rf ID', 'value' => $_SESSION[CustomerCards::tbl()]['card_user_id'])); ?>
        </div>
    </div>
</div>
<div class="box-footer">
    <?php print CHtml::link('Back', $this->createUrl('customers/admin'), array('class' => 'btn btn-default')); ?>
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-sm btn-success')); ?>
</div>

<?php print CHtml::endForm(); ?>

<script type="text/javascript">
       
        function showHideDivCardUser(val) {
            if (val == 2) {
                $('#divCardUser').show();
            } else {

                $('#divCardUser').hide();
            }
        }
</script>