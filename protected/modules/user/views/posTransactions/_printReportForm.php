
<?php Yii::app()->clientScript->registerScript("javascript", "
    function getReportType(val){
            if(val == 1){
             $('.non-current-billing').hide();
            }else{
                 $('.non-current-billing').show();
            }
            
    };
    
", 2); ?>
<?php print CHtml::beginForm('', 'POST', array('class' => 'smart-form')); ?>
<div class="box-body">

    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'Report type: *'); ?>
        <?php echo CHtml::dropDownList('txtReportType', $_SESSION[PosTransactions::tbl()]['report_type'], PosTransactions::get_ActiveReportType(), array('class' => 'form-control','empty' => 'Choose One', 'onChange' => 'getReportType(this.value);')); ?>
    </div>
    <?php
        if ($_SESSION[PosTransactions::tbl()]['report_type'] == '') {
            $printDisplay = 'none;';
        } else {
            $printDisplay = 'block;';
        }
    ?>
    <div class="form-group non-current-billing" style="display: <?php print $printDisplay; ?>">
        <?php echo CHtml::activeLabelEx($model, 'From Date: *'); ?>
        <?php $this->renderPartial('/layouts/jui/_juiModelDatePicker', array('model' => $model, 'attribute' => 'created_at', array('class' => 'form-control','id' => 'fromDate', 'placeholder' => 'eg. mm-dd-yy'))); ?>
    </div>
    <div class="form-group non-current-billing" style="display: <?php print $printDisplay; ?>">
        <?php echo CHtml::activeLabelEx($model, 'To Date: *'); ?>
        <?php $this->renderPartial('/layouts/jui/_juiModelDatePicker', array('model' => $model, 'attribute' => 'updated_at', array('class' => 'form-control','id' => 'toDate', 'placeholder' => 'eg. mm-dd-yy'))); ?>
    </div>
</div>
<div class="box-footer">
    <?php print CHtml::htmlButton('Generate', array('class' => 'btn btn-sm btn-success', 'type' => 'submit', 'value' => 'submit', 'onclick' => 'displayReport();')); ?>
</div>
<?php print CHtml::endForm(); ?>

<title>Print Delivery Reports</title>
