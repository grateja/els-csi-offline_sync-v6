<?php print CHtml::beginForm('', 'POST', array('class' => 'smart-form')); ?>
<fieldset>
    <div class ="row">
        <div class = "col-lg-12">
            <label>
                <?php echo CHtml::activeLabelEx($model, 'parent_id'); ?>
            </label>
            <label class="input">
                <?php echo CHtml::activeDropDownList($model, 'parent_id', CHtml::listData(Menus::model_getData_byIsDeleted(Utilities::NO), 'id', 'name'), array('prompt' => 'Choose One'));
                ?>
            </label>
        </div>              
        <div class = "col-lg-12">
            <label>
                <?php echo CHtml::activeLabelEx($model, 'name'); ?>
            </label>
            <label class="input"><i class="icon-prepend minia-icon-book"></i>
                <?php echo CHtml::activeTextField($model, 'name'); ?>
            </label>
        </div>
        <div class = "col-lg-12">
            <label>
                <?php echo CHtml::activeLabelEx($model, 'module_id'); ?>
            </label>
            <label class="input">
                <?php echo CHtml::activeDropDownList($model, 'module_id', CHtml::listData(Modules::model_getData_byIsDeleted(Utilities::NO), 'id', 'name'), array('prompt' => 'Choose One'));
                ?>
            </label>
        </div>
        <div class = "col-lg-12">
            <label>
                <?php echo CHtml::activeLabelEx($model, 'controller_id'); ?>
            </label>
            <label class="input">
                <?php echo CHtml::activeDropDownList($model, 'controller_id', CHtml::listData(Controllers::model_getData_byIsDeleted(Utilities::NO), 'id', 'name'), array('prompt' => 'Choose One'));
                ?>
            </label>
        </div>
        <div class = "col-lg-12">
            <label>
                <?php echo CHtml::activeLabelEx($model, 'action_id'); ?>
            </label>
            <label class="input">
                <?php echo CHtml::activeDropDownList($model, 'action_id', CHtml::listData(Actions::model_getData_byIsDeleted(Utilities::NO), 'id', 'name'), array('prompt' => 'Choose One'));
                ?>
            </label>
        </div>
        <div class = "col-lg-12">
            <label>
                <?php echo CHtml::activeLabelEx($model, 'is_parent'); ?>
            </label>
            <label class="input">
                <?php echo CHtml::activeDropDownList($model, 'is_parent', Utilities::get_ActiveSelect(), array('prompt' => 'Choose One'));
                ?>
            </label>
        </div>
        <div class = "col-lg-12">
            <label>
                <?php echo CHtml::activeLabelEx($model, 'is_url'); ?>
            </label>
            <label class="input">
                <?php echo CHtml::activeDropDownList($model, 'is_url', Utilities::get_ActiveSelect(), array('prompt' => 'Choose One'));
                ?>
            </label>
        </div>
    </div>
    <div class="footer-button">
        <?php echo CHtml::link('Back', $this->createUrl('menus/admin'), array('class' => 'btn btn-danger btn-sm')); ?>
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-sm btn-success')); ?>
    </div>
</fieldset>
<?php print CHtml::endForm(); ?>
