<?php print CHtml::beginForm('','POST', array('role' => 'form'));?>
<div class="box-body">
                <div class="form-group">
                <?php print CHtml::activeLabelEx($model,'branch_id'); ?>
                <?php print CHtml::activeTextField($model,'branch_id', array('class' => 'form-control', 'placeholder' => '')); ?>
            </div>
                        <div class="form-group">
                <?php print CHtml::activeLabelEx($model,'client_id'); ?>
                <?php print CHtml::activeTextField($model,'client_id', array('class' => 'form-control', 'placeholder' => '')); ?>
            </div>
                        <div class="form-group">
                <?php print CHtml::activeLabelEx($model,'customer_id'); ?>
                <?php print CHtml::activeTextField($model,'customer_id', array('class' => 'form-control', 'placeholder' => '')); ?>
            </div>
                        <div class="form-group">
                <?php print CHtml::activeLabelEx($model,'card_id'); ?>
                <?php print CHtml::activeTextField($model,'card_id', array('class' => 'form-control', 'placeholder' => '')); ?>
            </div>
                        <div class="form-group">
                <?php print CHtml::activeLabelEx($model,'card_no'); ?>
                <?php print CHtml::activeTextField($model,'card_no', array('class' => 'form-control', 'placeholder' => '')); ?>
            </div>
                        <div class="form-group">
                <?php print CHtml::activeLabelEx($model,'transaction_id'); ?>
                <?php print CHtml::activeTextField($model,'transaction_id', array('class' => 'form-control', 'placeholder' => '')); ?>
            </div>
                        <div class="form-group">
                <?php print CHtml::activeLabelEx($model,'credited'); ?>
                <?php print CHtml::activeTextField($model,'credited', array('class' => 'form-control', 'placeholder' => '')); ?>
            </div>
                        <div class="form-group">
                <?php print CHtml::activeLabelEx($model,'debited'); ?>
                <?php print CHtml::activeTextField($model,'debited', array('class' => 'form-control', 'placeholder' => '')); ?>
            </div>
                        <div class="form-group">
                <?php print CHtml::activeLabelEx($model,'balance'); ?>
                <?php print CHtml::activeTextField($model,'balance', array('class' => 'form-control', 'placeholder' => '')); ?>
            </div>
                        <div class="form-group">
                <?php print CHtml::activeLabelEx($model,'user_id'); ?>
                <?php print CHtml::activeTextField($model,'user_id', array('class' => 'form-control', 'placeholder' => '')); ?>
            </div>
                        <div class="form-group">
                <?php print CHtml::activeLabelEx($model,'remarks'); ?>
                <?php print CHtml::activeTextField($model,'remarks', array('class' => 'form-control', 'placeholder' => '')); ?>
            </div>
            </div>

<div class="box-footer">
    <?php print CHtml::link('Back', $this->createUrl('customerCardTransactions/admin'), array('class' => 'btn btn-default')); ?>
    <?php print CHtml::submitButton($model->isNewRecord ? 'Save' : 'Update',  array('class'=>'btn btn-primary pull-right')); ?>
</div>
<?php print CHtml::endForm(); ?>