
<script type="text/javascript">
        $('input').addClass('form-control');

        function reinstallDatePicker(id, data) {
            //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
            $('.datePicker').datepicker(jQuery.extend({showMonthAfterYear: false}, jQuery.datepicker.regional['us'], {'dateFormat': 'yy-mm-dd'}));

            $('input').addClass('form-control');
            $('select').select2({width: 'resolve'});
            $('.select2-hidden-accessible').attr('hidden', true);
        }
</script>
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Inventories</h3>

        </div>
        <div class="box-body">
            <?php $static = array('' => Yii::t('', 'All')); ?>
            <?php
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'inventories-grid',
                    'dataProvider' => $model->searchBranch(),
                    'filter' => $model,
                    'afterAjaxUpdate' => 'reinstallDatePicker',
                    'rowCssClassExpression' => '$data["rowColor"]',
                    'columns' => array(
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
                            'name' => 'category_id',
                            'value' => '$data->inventoryCategories->name',
                            'filter' => $static + CHtml::listdata(InventoryCategories::model_getAllData_byDeleted(Utilities::NO), 'id', 'name'),
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                        array(
                            'name' => 'id',
                            'header' => 'Item',
                            'value' => '$data->name',
                            'filter' => $static + CHtml::listData(Inventories::model_getAllData_byDeletedClientID(Utilities::NO, Settings::get_ClientID()), 'id', 'name'),
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                        array(
                            'header' => 'Product Pic',
                            'type' => 'html',
                            'value' => '(!empty($data->file_pics))?CHtml::image(Settings::get_baseUrl()."/".$data->file_path . "/".$data->file_pics,"",array("style"=>"width:50px;height:50px;")):CHtml::image(Settings::get_baseUrl()."/images/noimage.png","",array("style"=>"width:40px;height:40px;"))',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
//                        array(
//                            'name' => 'bar_code',
//                            'value' => '$data->bar_code',
//                            'headerHtmlOptions' => array(
//                                'style' => 'width: 10%;'
//                            ),
//                        ),
                        array(
                            'name' => 'cost',
                            'value' => '$data->cost',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                        array(
                            'name' => 'price',
                            'header' => 'Selling Price',
                            'value' => '$data->price',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
//                        array(
//                            'name' => 'tax',
//                            'value' => '$data->tax',
//                            'headerHtmlOptions' => array(
//                                'style' => 'width: 10%;'
//                            ),
//                        ),
                        array(
                            'name' => 'qty_reorder',
                            'header' => 'Reorder Qty',
                            'value' => '$data->qty_reorder',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
                        array(
                            'name' => 'qty_stock',
                            'header' => 'Available',
                            'value' => '$data->qty_stock',
                            'headerHtmlOptions' => array(
                                'style' => 'width: 10%;'
                            ),
                        ),
//                        array(
//                            'name' => 'is_deleted',
//                            'value' => 'Utilities::get_activeSelect($data->is_deleted)',
//                            'filter' => Utilities::get_ActiveSelect(),
//                            'headerHtmlOptions' => array(
//                                'style' => 'width: 10%;'
//                            ),
//                        ),
                        array(
                            'class' => 'CButtonColumn',
                            'header' => 'Action',
                            'template' => '{view}{update}',
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