<?php
Yii::app()->clientScript->registerScript("javascript", "

    $( 'input' ).addClass('form-control' );

    function reinstallDatePicker(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
        $('.datePicker').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['ja'],{'dateFormat':'yy-mm-dd'}));

        $( 'input' ).addClass('form-control' );
        $('select').select2({ width: 'resolve' });
        $('.select2-hidden-accessible').attr('hidden', true);
    }
", 2);
?>

<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Manage</h3>
            <?php echo CHtml::link('<i class="fa fa-plus"></i>', $this->createUrl('receiptSettings/create'), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
        </div>
        <div class="box-body">
            <?php $static = array('' => Yii::t('', 'All')); ?>
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'receipt-settings-grid',
                'dataProvider' => $model->search(),
                'afterAjaxUpdate' => 'reinstallDatePicker',
                'filter' => $model,
                'columns' => array(
                    array(
                        'header' => 'Date Created',
                        'name' => 'created_at',
                        'value' => 'Settings::setDateStandard($data->created_at)',
                        'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => $model,
                            'attribute' => 'created_at',
                            'htmlOptions' => array(
                                'class' => 'datePicker',
                            ),
                            'options' => array(
                                'showOn' => 'focus',
                                'dateFormat' => 'yy-mm-dd',
                                'showOtherMonths' => true,
                                'selectOtherMonths' => true,
                                'changeMonth' => true,
                                'changeYear' => true,
                                'showButtonPanel' => true,
                            )
                            ), true),
                        'headerHtmlOptions' => array(
                            'style' => 'width: 10%;'
                        ),
                    ),
                    array(
                        'name' => 'client_id',
                        'value' => '$data->clients->fullName',
                        'filter' => $static + CHtml::listData(Clients::model_getAllData_byDeleted(Utilities::NO), 'id', 'fullName'),
                        'headerHtmlOptions' => array(
                            'style' => 'width: 20%;'
                        ),
                    ),
                    array(
                        'name' => 'branch_id',
                        'value' => '$data->branches->name',
                        'filter' => $static + CHtml::listData(Branches::model_getAllData_byDeleted(Utilities::NO), 'id', 'name'),
                        'headerHtmlOptions' => array(
                            'style' => 'width: 15%;'
                        ),
                    ),
                    array(
                        'name' => 'header',
                        'value' => '$data->header',
                        'headerHtmlOptions' => array(
                            'style' => 'width: 15%;'
                        ),
                    ),
                    array(
                        'name' => 'message',
                        'value' => '$data->message',
                        'headerHtmlOptions' => array(
                            'style' => 'width: 15%;'
                        ),
                    ),
                    array(
                        'name' => 'footer',
                        'value' => '$data->footer',
                        'headerHtmlOptions' => array(
                            'style' => 'width: 15%;'
                        ),
                    ),
                    array(
                        'class' => 'CButtonColumn',
                        'header' => 'Action',
                        'template' => '{view}{update}{delete}',
                        'viewButtonLabel' => '<span class="minia-icon-search"></span>',
                        'viewButtonOptions' => ['title' => '', 'data-tooltip' => 'View',],
                        'viewButtonImageUrl' => false,
                        'updateButtonLabel' => '<span class="icomoon-icon-pencil-2"></span>',
                        'updateButtonOptions' => ['title' => '', 'data-tooltip' => 'Update',],
                        'updateButtonImageUrl' => false,
                        'deleteButtonLabel' => '<span style="color:red;" class="icomoon-icon-remove"></span>',
                        'deleteButtonOptions' => ['title' => '', 'data-tooltip' => 'Delete',],
                        'deleteButtonImageUrl' => false,
                        'deleteConfirmation' => 'Are you sure you want to delete?',
                        'htmlOptions' => array(
                            'style' => 'width: 10%;'
                        ),
                    ),
                ),
            ));
            ?>
        </div>
    </div>
</div>