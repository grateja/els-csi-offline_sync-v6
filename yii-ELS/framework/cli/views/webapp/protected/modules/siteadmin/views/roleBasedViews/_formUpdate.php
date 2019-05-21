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
                    <?php echo CHtml::activeLabelEx($model, 'role_id'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeDropDownList($model, 'role_id', CHtml::listData(Roles::model_getAllData_byIsDeleted(Utilities::NO), 'id', 'name'), array('prompt' => 'Choose One', 'id' => 'roles', 'class' => 'form-control'));
                    ?>
                    <b class="tooltip tooltip-bottom-left">
                        Roles
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'menu_id'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeDropDownList($model, 'menu_id', CHtml::listData(Menus::model_getData_byIsDeleted(Utilities::NO), 'id', 'name'), array('prompt' => 'Choose One', 'id' => 'controller', 'class' => 'form-control'));
                    ?>
                    <b class="tooltip tooltip-bottom-left">
                        Menus
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'menu_name'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-book"></i>
                    <?php echo CHtml::activeTextField($model, 'menu_name', array('size' => 60, 'maxlength' => 255, 'placeholder' => '')); ?>
                    <b class="tooltip tooltip-bottom-left">
                        Menu Name
                    </b> 
                </label>
            </section>
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
                    <?php echo CHtml::activeLabelEx($model, 'is_viewable'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeDropDownList($model, 'is_viewable', Utilities::get_ActiveSelect(), array('prompt' => 'Choose One', 'id' => 'controller', 'class' => 'form-control'));
                    ?>
                    <b class="tooltip tooltip-bottom-left">
                        Is Viewable
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'is_deleted'); ?>
                </label>
                <label class="input">
                    <?php echo CHtml::activeDropDownList($model, 'is_deleted', Utilities::get_ActiveSelect(), array('class' => 'form-control')); ?>
                    <b class="tooltip tooltip-bottom-left">
                        active tagging
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

