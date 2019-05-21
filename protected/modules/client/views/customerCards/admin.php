

<div class="col-md-12">
    <div class="box box-primary">

        <div class="box-body">
            <?php if ($_GET['custID'] != ''): ?>
                <?php endif; ?>

            <?php $static = array('' => Yii::t('', 'All')); ?>
            <?php
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'customer-cards-grid',
                    'dataProvider' => $model->searchByCustomer(),
                    'filter' => $model,
                    'afterAjaxUpdate' => 'reinstallDatePicker',
                    'itemsCssClass' => 'table table-striped table-hover table-responsive',
                    'pagerCssClass' => 'pagination pull-right',
                    'columns' => array(
                        array(
                            'name' => 'id',
                            'value' => '$data->id',
                            'filter' => false,
                            'htmlOptions' => array('width' => '20px'),
                            'headerHtmlOptions' => array(
                                'style' => 'text-align: center; (background-color:powderblue;)'
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
                            'name' => 'created_at',
                            'value' => 'Settings::setDateStandard($data->created_at)',
                            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model' => $model,
                                'attribute' => 'created_at', // This is how it works for me.
                                //'language' => 'pl',
                                'i18nScriptFile' => 'jquery.ui.datepicker-ja.js',
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
                                'style' => 'width: 150px;'
                            ),
                            'headerHtmlOptions' => array(
                                'style' => 'text-align: center; (background-color:powderblue;)'
                            ),
                        ),
                        array(
                            'name' => 'reg_date',
                            'value' => 'Settings::setDateStandard($data->reg_date)',
                            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model' => $model,
                                'attribute' => 'reg_date', // This is how it works for me.
                                //'language' => 'pl',
                                'i18nScriptFile' => 'jquery.ui.datepicker-ja.js',
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
                                'style' => 'width: 150px;'
                            ),
                            'headerHtmlOptions' => array(
                                'style' => 'text-align: center; (background-color:powderblue;)'
                            ),
                        ),
                        array(
                            'name' => 'last_trans_date',
                            'value' => 'Settings::setDateStandard($data->last_trans_date)',
                            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model' => $model,
                                'attribute' => 'last_trans_date', // This is how it works for me.
                                //'language' => 'pl',
                                'i18nScriptFile' => 'jquery.ui.datepicker-ja.js',
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
                                'style' => 'width: 150px;'
                            ),
                            'headerHtmlOptions' => array(
                                'style' => 'text-align: center; (background-color:powderblue;)'
                            ),
                        ),
                        array(
                            'name' => 'rf_id',
                            'header' => 'Rf ID',
                            'value' => '$data->rf_id',
                            'headerHtmlOptions' => array(
                                'style' => 'text-align: center; (background-color:powderblue;)'
                            ),
                        ),
                        array(
                            'name' => 'customer_id',
                            'value' => '$data->customers->name',
                            'filter' => $static + CHtml::ListData(Customers::model_getAllData_byDeletedCLientID(Utilities::NO, Settings::get_clientID()), 'id', 'name'),
                            'htmlOptions' => array(
                                'style' => 'width: 200px;'
                            ),
                            'headerHtmlOptions' => array(
                                'style' => 'text-align: center; (background-color:powderblue;)'
                            ),
                        ),
                        array(
                            'name' => 'is_activated',
                            'value' => '$data->isActivated',
                            'filter' => $static + Utilities::get_ActiveSelect(),
                            'htmlOptions' => array('width' => '100px'),
                            'headerHtmlOptions' => array(
                                'style' => 'text-align: center; (background-color:powderblue;)'
                            ),
                        ),
                        array(
                            'header' => 'Balance',
                            'value' => 'Settings::setNumberFormat($data->cardBalance, 2)',
                            'filter' => false,
                            'htmlOptions' => array('width' => '100px'),
                            'headerHtmlOptions' => array(
                                'style' => 'text-align: center; (background-color:powderblue;)'
                            ),
                        ),
                        array(
                            'header' => 'Top Up',
                            'value' => '$data->cmdBtnTopUp',
                            'type' => 'raw',
                            'htmlOptions' => array('width' => '100px'),
                            'headerHtmlOptions' => array(
                                'style' => 'text-align: center; (background-color:powderblue;)'
                            ),
                        ),
                        array(
                            'header' => 'Top Down',
                            'value' => '$data->cmdBtnTopDown',
                            'type' => 'raw',
                            'htmlOptions' => array('width' => '100px'),
                            'headerHtmlOptions' => array(
                                'style' => 'text-align: center; (background-color:powderblue;)'
                            ),
                        ),
                    ),
                ));
            ?>
        </div>
    </div>
</div>
</article>
<br/>
