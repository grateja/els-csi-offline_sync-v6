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
            <h3 class="box-title">Users</h3>
            <?php echo CHtml::link('<i class="fa fa-plus"></i>', $this->createUrl('users/create'), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
        </div>
        <div class="box-body">
            <?php $static = array('' => Yii::t('', 'All')); ?>
            <?php
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'users-grid',
                    'dataProvider' => $model->searchUsers(),
                    'afterAjaxUpdate' => 'reinstallDatePicker',
                    'filter' => $model,
                    'columns' => array(
                        array(
                            'name' => 'branch_id',
                            'header' => 'Branch',
                            'value' => '$data->branches->name',
                            'filter' => $static + CHtml::listData(Branches::model_getAllData_byClientId(Settings::get_ClientID()), 'id', 'name'),
                            'htmlOptions' => array(
                                'style' => 'width: 15%;text-align: left'
                            ),
                            'headerHtmlOptions' => array(
                                'style' => 'text-align: center !important; (background-color:powderblue;)'
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
                                'style' => 'width: 15%;'
                            ),
                        ),
                        array(
                            'name' => 'emp_id',
                            'header' => 'Employee',
                            'value' => '$data->employees->lnameFname',
                            'filter' => $static + CHtml::ListData(Employees::model_getAllData_byDeletedClientID(Utilities::NO, Settings::get_ClientID()), 'id', 'lnameFname'),
                            'htmlOptions' => array(
                                'style' => 'width: 20%;'
                            ),
                        ),
                        'username',
                        'email',
                        array(
                            'name' => 'role_id',
                            'header' => 'Roles',
                            'value' => '$data->roles->name',
                            'filter' => $static + CHtml::ListData(Roles::model_getAllData_byDeleted(Utilities::NO), 'id', 'name'),
                            'htmlOptions' => array(
                                'style' => 'width: 15%;'
                            ),
                        ),
                        array(
                            'class' => 'CButtonColumn',
                            'header' => 'Action',
                            'template' => '{view}{update}', // buttons here...
                            'viewButtonLabel' => '<span class="minia-icon-search"></span>', // custom icon
                            'viewButtonOptions' => ['title' => '', 'data-tooltip' => 'View'],
                            'viewButtonImageUrl' => false, // disable default image
                            'updateButtonLabel' => '<span class="icomoon-icon-pencil"></span>', // custom icon
                            'updateButtonOptions' => ['title' => '', 'data-tooltip' => 'Update'],
                            'updateButtonImageUrl' => false, // disable default image
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