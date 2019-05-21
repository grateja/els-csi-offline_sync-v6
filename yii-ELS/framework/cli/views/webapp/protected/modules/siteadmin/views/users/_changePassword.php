<?php print CHtml::beginForm('', 'POST', array('class' => 'smart-form')); ?>
<fieldset>
    <div class ="row">
        <div class ="col-lg-12">
            <label>
                <?php echo CHtml::activeLabelEx($model, 'username'); ?>
            </label>
            <label class="input">
                <center> <?php print $model->username; ?> </center>
            </label>
        </div>
        <div class ="col-lg-12">
            <label>
                <?php echo CHtml::activeLabelEx($model, 'old_password'); ?>
            </label>
            <label class="input"><i class="icon-prepend minia-icon-book"></i>
                <?php echo CHtml::activePasswordField($model, 'old_password'); ?>
            </label>
        </div>
        <div class ="col-lg-12">
            <label>
                <?php echo CHtml::activeLabelEx($model, 'new_password'); ?>
            </label>
            <label class="input"><i class="icon-prepend minia-icon-book"></i>
                <?php echo CHtml::activePasswordField($model, 'new_password'); ?>
            </label>
        </div>
        <div class ="col-lg-12">
            <label>
                <?php echo CHtml::activeLabelEx($model, 'repeat_password'); ?>
            </label>
            <label class="input"><i class="icon-prepend minia-icon-book"></i>
                <?php echo CHtml::activePasswordField($model, 'repeat_password'); ?>
            </label>
        </div>
    </div>
    <div class="footer-button">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save', array('class' => 'btn btn-sm btn-success' )); ?>
    </div>
</fieldset>
<?php print CHtml::endForm(); ?>