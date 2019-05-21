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
            <h3 class="box-title">Customers</h3>
            <?php echo CHtml::link('<i class="fa fa-plus"></i>', $this->createUrl('customers/create'), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
        </div>
        <div class="box-body">
            <?php $static = array('' => Yii::t('', 'All')); ?>
            <?php
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'customers-grid',
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
                            'name' => 'branch_id',
                            'header' => 'Branch',
                            'value' => '$data->branches->name',
                            'filter' => $static + CHtml::listData(Branches::model_getAllData_byClientId(Settings::get_ClientID()), 'id', 'name'),
                            'headerHtmlOptions' => array(
                                'style' => 'width: 30%;'
                            ),
                            'htmlOptions' => array(
                                'style' => 'text-align: left'
                            ),
                        ),
                        array(
                            'name' => 'id',
                            'header' => 'Name',
                            'value' => '$data->lnameFname',
                            'filter' => $static + CHtml::listData(Customers::model_getAllData_byDeletedCLientID(Utilities::NO, Settings::get_ClientID()), 'id', 'lnameFname'),
                            'headerHtmlOptions' => array(
                                'style' => 'width: 30%;'
                            ),
                        ),
                         array(
                            'name' => 'phone',
                            'value' => '$data->phone',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ), array(
                            'name' => 'mobile',
                            'value' => '$data->mobile',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ), array(
                            'name' => 'birthdate',
                            'value' => '($data->birthdate != "0000-00-00")?Settings::setDateStandard($data->birthdate):" "',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                        array(
                            'name' => 'token_wash',
                            'value' => '$data->token_wash',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                        array(
                            'name' => 'token_dry',
                            'value' => '$data->token_dry',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                        array(
                            'name' => 'token_titan',
                            'value' => '$data->token_titan',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                        array(
                            'header' => 'RFid Card',
                            'value' => '$data->cmdActivateBtn',
                            'type' => 'raw',
                            'htmlOptions' => array('width' => '100px'),
                            'headerHtmlOptions' => array(
                                'style' => 'text-align: center; (background-color:powderblue;)'
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