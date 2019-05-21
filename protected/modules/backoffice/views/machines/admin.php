<?php 
   Yii::app()->clientScript->registerScript("javascript","
              
  $( 'input' ).addClass('form-control' );

    function reinstallDatePicker(id, data) {
            //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
        $('.datePicker').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['ja'],{'dateFormat':'yy-mm-dd'}));
        
        $( 'input' ).addClass('form-control' );       
        $('select').select2({ width: 'resolve' });
        $('.select2-hidden-accessible').attr('hidden', true);
    }
    ",2);
?>
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Manage</h3>
            <?php echo CHtml::link('<i class="fa fa-plus"></i>', $this->createUrl('machines/create'), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
        </div>
        <div class="box-body">

            <?php $this->widget('Flashes'); ?>
            <?php $static = array('' => Yii::t('', 'All')); ?>
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'machines-grid',
                'dataProvider' => $model->searchMachines(),
                'filter' => $model,
                'afterAjaxUpdate' => 'reinstallDatePicker',
                'itemsCssClass' => 'table table-striped table-hover table-responsive',
                'pagerCssClass' => 'pagination pull-right',
                'columns' => array(
                    array(
                        'header' => 'Id',
                        'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                        'headerHtmlOptions' => array(
                            'style' => 'text-align: center; (background-color:powderblue;)'
                        ),
                    ),
                    array(
                        'name' => 'created_at',
                        'value' => 'Settings::setDateStandard($data->created_at)',
                        'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => $model,
                            'attribute' => 'created_at', // This is how it works for me.
                            'language' => 'en-US',
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
                            'style' => 'width: 100px;'
                        ),
                        'headerHtmlOptions' => array(
                            'style' => 'text-align: center; (background-color:powderblue;)'
                        ),
                    ),
                    array(
                        'name' => 'serial_no',
                        'value' => '$data->serial_no',
                        'headerHtmlOptions' => array(
                            'style' => 'text-align: center; (background-color:powderblue;)'
                        ),
                    ),
                    array(
                        'name' => 'name',
                        'value' => '$data->name',
                        'headerHtmlOptions' => array(
                            'style' => 'text-align: center; (background-color:powderblue;)'
                        ),
                    ),
                    array(
                        'name' => 'ip_address',
                        'value' => '$data->ip_address',
                        'headerHtmlOptions' => array(
                            'style' => 'text-align: center; (background-color:powderblue;)'
                        ),
                    ),
                     array(
                        'name' => 'is_deleted',
                        'value' => '$data->isDeleted',
                        'headerHtmlOptions' => array(
                            'style' => 'text-align: center; (background-color:powderblue;)'
                        ),
                    ),
//                    array(
//                        'name' => 'machine_type_id',
//                        'value' => '$data->machineTypes->name',
//                        'filter' => $static + CHtml::listData(MachineTypes::model_getAllData_byDeleted(Utilities::NO), 'id', 'name'),
//                        'headerHtmlOptions' => array(
//                            'style' => 'text-align: center; (background-color:powderblue;)'
//                        ),
//                    ),
//                    array(
//                        'name' => 'machine_status_id',
//                        'value' => '$data->statusRemarks',
//                        'filter' => $static + CHtml::listData(MachineStatuses::model_getAllData_byIsDeleted(Utilities::NO), 'id', 'name'),
//                        'headerHtmlOptions' => array(
//                            'style' => 'text-align: center; (background-color:powderblue;)'
//                        ),
//                    ),
                    array(
                        'name' => 'id',
                        'header' => 'Usage',
                        'value' => '$data->totalCycleCOunt',
                        'headerHtmlOptions' => array(
                            'style' => 'text-align: center; (background-color:powderblue;)'
                        ),
                        'htmlOptions' => array(
                            'style' => 'text-align: center; (background-color:powderblue;)'
                        ),
                    ),
                    
                    array(
                        'header' => 'Action',
                        'class' => 'CButtonColumn',
                        'htmlOptions' => array(
                            'style' => 'text-align: center; font-weight: bold;',
                            'width' => '100px',
                        ),
                        'template' => '{update}{delete}',
                        'headerHtmlOptions' => array(
                            'style' => 'width: 100px; text-align: center; (background-color:powderblue;)'
                        ),
                    ),
                ),
            ));
            ?>
        </div>
    </div>
</div>