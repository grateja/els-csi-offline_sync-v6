<?php $this->renderPartial('/layouts/js/_regionsToBarangays'); ?>
<!-- widget div-->
<div>
    <!-- widget edit box -->
    <div class="jarviswidget-editbox">
        <!-- This area used as dropdown edit box -->
    </div>
    <!-- end widget edit box -->

    <!-- widget content -->
    <div class="widget-body no-padding">

        <!--<form class="smart-form">-->
        <?php print CHtml::beginForm('', 'POST', array('class' => 'smart-form')); ?>
        <?php $this->widget('Flashes'); ?>

        <fieldset>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'module_id'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeDropDownList($model, 'module_id', CHtml::listData(Modules::model_getData_byIsDeleted(Utilities::NO), 'id', 'name'), array('prompt' => 'Choose One', 'id' => 'modules', 'class' => 'form-control'));
                    ?>
                    <b class="tooltip tooltip-bottom-left">
                        Modules
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'controller_id'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeDropDownList($model, 'controller_id', CHtml::listData(Controllers::model_getData_byIsDeleted(Utilities::NO), 'id', 'name'), array('prompt' => 'Choose One', 'id' => 'controller', 'class' => 'form-control'));
                    ?>
                    <b class="tooltip tooltip-bottom-left">
                        Controller
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'controller_name'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-book"></i>
                    <?php echo CHtml::activeTextField($model, 'controller_name', array('size' => 60, 'maxlength' => 255, 'placeholder' => '')); ?>
                    <b class="tooltip tooltip-bottom-left">
                        Controller Name
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'action_id'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeDropDownList($model, 'action_id', CHtml::listData(Actions::model_getData_byIsDeleted(Utilities::NO), 'id', 'name'), array('prompt' => 'Choose One', 'id' => 'controller', 'class' => 'form-control'));
                    ?>
                    <b class="tooltip tooltip-bottom-left">
                        Actions
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'action_name'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-book"></i>
                    <?php echo CHtml::activeTextField($model, 'action_name', array('size' => 60, 'maxlength' => 255, 'placeholder' => '')); ?>
                    <b class="tooltip tooltip-bottom-left">
                        Action Name
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'is_accesible'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeDropDownList($model, 'is_accesible', Utilities::get_ActiveSelect(), array('prompt' => 'Choose One', 'id' => 'controller', 'class' => 'form-control'));
                    ?>
                    <b class="tooltip tooltip-bottom-left">
                        Is Accesible
                    </b> 
                </label>
            </section>

            <div class="widget-footer smart-form">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-sm btn-success')); ?>
            </div>
        </fieldset>
        <?php print CHtml::endForm(); ?>
        <!--</form>-->
    </div>
    <!-- end widget content -->
</div>

