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
<div class="col-lg-12">
    <div class="metronicManage">
        <header>
            <span><i class="fa fa-th"></i>Manage - Menus</span>
            <?php print CHtml::link('<i class="brocco-icon-plus"></i>', $this->createUrl('menus/create'), array('class' => 'btn-back', 'data-tooltip' => 'Create')); ?>
        </header>
                <?php $static = array('' => Yii::t('', 'All')); ?>
                <?php
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'municipalities-grid',
                    'dataProvider' => $model->search(),
                    'afterAjaxUpdate' => 'reinstallDatePicker',
                    'filter' => $model,
                    'columns' => array(
//                        array(
//                            'name' => 'created_at',
//                            'value' => 'Settings::setDateStandard($data->created_at)',
//                            'htmlOptions' => array('width' => '150px'),
//                            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
//                                'model' => $model,
//                                'attribute' => 'created_at', // This is how it works for me.
//                                'i18nScriptFile' => 'jquery.ui.datepicker-ja.js',
//                                'htmlOptions' => array(
//                                    'class' => 'datePicker',
//                                ),
//                                'options' => array(// (#3)
//                                    'showOn' => 'focus',
//                                    'dateFormat' => 'yy-mm-dd',
//                                    'showOtherMonths' => true,
//                                    'selectOtherMonths' => true,
//                                    'changeMonth' => true,
//                                    'changeYear' => true,
//                                    'showButtonPanel' => true,
//                                )
//                                ), true),
//                            'htmlOptions' => array(
//                                'style' => 'width: 120px;'
//                            ),
//                        ),
                        array(
                            'name' => 'parent_id',
                            'value' => '$data->name',
                            'filter' => $static + CHtml::ListData(Menus::model_getData_byIsDeleted(Utilities::NO), 'id', 'name'),
                            'htmlOptions' => array(
                                'style' => 'width: 200px;'
                            ),
                        ),
                        array(
                            'name' => 'name',
                            'value' => '$data->name',
                            'htmlOptions' => array(
                                'style' => 'width: 300px;'
                            ),
                        ),
                        array(
                            'name' => 'module_id',
                            'value' => '$data->modules->name',
                            'filter' => $static + CHtml::ListData(Modules::model_getData_byIsDeleted(Utilities::NO), 'id', 'name'),
                            'htmlOptions' => array(
                                'style' => 'width: 100px;'
                            ),
                        ),
                        array(
                            'name' => 'controller_id',
                            'value' => '$data->controllers->name',
                            'filter' => $static + CHtml::ListData(Controllers::model_getData_byIsDeleted(Utilities::NO), 'id', 'name'),
                            'htmlOptions' => array(
                                'style' => 'width: 200px;'
                            ),
                        ),
                        array(
                            'name' => 'action_id',
                            'value' => '$data->actions->name',
                            'filter' => $static + CHtml::ListData(Actions::model_getData_byIsDeleted(Utilities::NO), 'id', 'name'),
                            'htmlOptions' => array(
                                'style' => 'width: 200px;'
                            ),
                        ),
                        array(
                            'name' => 'is_parent',
                            'value' => '$data->isParent',
                            'filter' => $static + Utilities::get_ActiveSelect(),
                            'htmlOptions' => array(
                                'style' => 'width: 100px;'
                            ),
                        ),
                        array(
                            'name' => 'is_url',
                            'value' => '$data->isUrl',
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
    </div>
</article>


