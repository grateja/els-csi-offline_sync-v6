<?php
Yii::app()->clientScript->registerScript("javascript", "
       
    $('select').select2({ width: 'resolve' });
    $('.select2-hidden-accessible').attr('hidden', true);
    $( 'input' ).addClass('form-control' );

    function reinstallDatePicker(id, data) {
            //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
        $('.datePicker').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['ja'],{'dateFormat':'yy-mm-dd'}));
        
        $( 'input' ).addClass('form-control' );
        $('select').select2({ width: 'resolve' });
        $('.select2-hidden-accessible').attr('hidden', true);
        hover();
    }
    
    function hover()
    {
        $('[rel=tooltip]').tooltip();
    }
    ", 2);
?>
<br />
<article class="col-sm-12">
    <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-4" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
        <!--<h1>Non-Enrollment Payment Headers</h1>-->

        <header>
            <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
            <h2>Manage Role Based Access</h2>
        </header>

        <div class="modal-content">     
            <div class="smart-form" style="text-align: center;padding-bottom: 1px;">
                <?php print CHtml::link('<i class="fa fa-plus-circle">' . ' Create New</i>', $this->createUrl('roleBasedAccess/create'), array('class' => 'btn btn-success btn-sm', 'style' => 'width: 150px;', 'id' => 'btnPayment')); ?>
            </div>

            <?php $static = array('' => Yii::t('', 'All')); ?>
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'role-based-access-grid',
                'dataProvider' => $model->search(),
                'afterAjaxUpdate' => 'reinstallDatePicker',
                'filter' => $model,
                'columns' => array(
                    array(
                        'name' => 'id',
                        'value' => '$data->id',
                        'filter' => false,
                        'htmlOptions' => array(
                            'style' => 'width: 50px;'
                        ),
                    ),
                    array(
                        'name' => 'created_at',
                        'value' => 'Settings::setDateStandard($data->created_at)',
                        'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => $model,
                            'attribute' => 'created_at', // This is how it works for me.
                            'htmlOptions' => array(
                                'class' => 'datePicker',
                            ),
                            'options' => array(// (#3)
                                'showOn' => 'focus',
                                'dateFormat' => 'yy-mm-dd',
                                'showOtherMonths' => true,
                                'selectOtherMonths' => true,
                                'changeMonth' => true,
                                'changeYear' => true,
                                'showButtonPanel' => true,
                            )
                            ), true),
                        'htmlOptions' => array(
                            'style' => 'width: 120px;'
                        ),
                    ),
                    array(
                        'name' => 'module_id',
                        'value' => '$data->modules->name',
                        'filter' => $static + CHtml::ListData(Modules::model_getData_byIsDeleted(Utilities::NO), 'id', 'name'),
                        'htmlOptions' => array(
                            'style' => 'width: 150px;'
                        ),
                    ),
                    array(
                        'name' => 'role_id',
                        'value' => '$data->roles->name',
                        'filter' => $static + CHtml::ListData(Roles::model_getAllData_byIsDeleted(Utilities::NO), 'id', 'name'),
                        'htmlOptions' => array(
                            'style' => 'width: 150px;'
                        ),
                    ),
                    array(
                        'name' => 'controller_id',
                        'value' => '$data->controllers->name',
                        'filter' => $static + CHtml::ListData(Controllers::model_getData_byIsDeleted(Utilities::NO), 'id', 'name'),
                        'htmlOptions' => array(
                            'style' => 'width: 150px;'
                        ),
                    ),
                    'controller_name',
                    array(
                        'name' => 'action_id',
                        'value' => '$data->actions->name',
                        'filter' => $static + CHtml::ListData(Actions::model_getData_byIsDeleted(Utilities::NO), 'id', 'name'),
                        'htmlOptions' => array(
                            'style' => 'width: 150px;'
                        ),
                    ),
                    'action_name',
                    array(
                        'name' => 'is_accesible',
                        'value' => '$data->isAccesible',
                        'filter' => $static + Utilities::get_ActiveSelect(),
                        'htmlOptions' => array(
                            'style' => 'width: 100px;'
                        ),
                    ),
                    array(
                        'name' => 'is_deleted',
                        'value' => '$data->isDeleted',
                        'filter' => $static + Utilities::get_ActiveSelect(),
                        'htmlOptions' => array(
                            'style' => 'width: 100px;'
                        ),
                        'type' => 'raw',
                    ),
                    array(
                        'class' => 'CButtonColumn',
                        'header' => 'Action',
                        'template' => '{view}{update}{delete}', // buttons here...
                        'viewButtonLabel' => '<span rel = "tooltip" title="View" class="minia-icon-search"></span>', // custom icon
                        'viewButtonOptions' => array(
                            'title' => '',
                        ),
                        'viewButtonImageUrl' => false, // disable default image
                        'updateButtonLabel' => '<span rel = "tooltip" title="Update" class="icomoon-icon-pencil"></span>', // custom icon
                        'updateButtonOptions' => array(
                            'title' => '',
                        ),
                        'updateButtonImageUrl' => false, // disable default image
                        'deleteButtonLabel' => '<span rel = "tooltip" title="Delete" class="icomoon-icon-remove"></span>',
                        'deleteButtonOptions' => array(
                            'title' => '',
                        ),
                        'deleteButtonImageUrl' => false,
                        'deleteConfirmation' => 'Are you sure you want to delete?', // confirmation message for delete 
                        'htmlOptions' => array(
                            'style' => 'width: 100px;'
                        ),
                    ),
                ),
            ));
            ?>
        </div>
    </div>
<br/><br/>
</article>

