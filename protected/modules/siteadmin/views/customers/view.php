<div class="col-md-5">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">View</h3>
            <?php echo CHtml::link('<i class="fa fa-plus"></i>', $this->createUrl('customers/create'), array('class' => 'btn btn-xs btn-success pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
            <?php echo CHtml::link('<i class="fa fa-arrow-left"></i>', $this->createUrl('customers/admin'), array('class' => 'btn btn-xs btn-primary pull-right', 'data-toggle' => 'tooltip', 'title' => 'Back', 'style' => 'margin-right: 5px;')); ?>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <tr>
                    <th>Date Created</th>
                    <td><?php echo Settings::setDateTimeStandard($model->created_at) ?></td>
                </tr>
                <tr>
                    <th>Last Modified</th>
                    <td><?php echo Settings::setDateTimeStandard($model->updated_at) ?></td>
                </tr>
                <tr>
                    <th>Branch</th>
                    <td><?php print $model->branches->name ?></td>
                </tr>
                <tr>
                    <th>Client</th>
                    <td><?php print $model->clients->fullName ?></td>
                </tr>
                <tr>
                    <th>Firstname</th>
                    <td><?php print $model->firstname ?></td>
                </tr>
                <tr>
                    <th>Middlename</th>
                    <td><?php print $model->middlename ?></td>
                </tr>
                <tr>
                    <th>Lastname</th>
                    <td><?php print $model->lastname ?></td>
                </tr>
                <tr>
                    <th>Company Name</th>
                    <td><?php print $model->company_name ?></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><?php print $model->address ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php print $model->email ?></td>
                </tr>
                <tr>
                    <th>Mobile</th>
                    <td><?php print $model->mobile ?></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><?php print $model->phone ?></td>
                </tr>

                <tr>
                    <th>Birthdate</th>
                    <td><?php print Settings::setDateStandard($model->birthdate) ?></td>
                </tr>
          
                    
                <tr>
                    <th>Age</th>
                    <td>

                        <?php
                            //date in mm/dd/yyyy format; or it can be in other formats as well
                            $birthDate = date('m/d/Y', strtotime($model->birthdate));
                            //explode the date to get month, day and year
                            $birthDate = explode("/", $birthDate);
                            //get age from date or birthdate
                            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
                           if($model->birthdate != '0000-00-00'){
                             print $age .' yrs old';
                           }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="col-md-7">
    <div class="box box-primary">
          <div class="box-body">
            <?php if ($_GET['custID'] != ''): ?>
            <?php endif; ?>

            <?php $static = array('' => Yii::t('', 'All')); ?>
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'customer-cards-grid',
                'dataProvider' => $modelCards->searchByCustomer(),
                'filter' => $modelCards,
                'afterAjaxUpdate' => 'reinstallDatePicker',
                'itemsCssClass' => 'table table-striped table-hover table-responsive',
                'pagerCssClass' => 'pagination pull-right',
                'columns' => array(
                   
                    array(
                        'name' => 'reg_date',
                        'value' => 'Settings::setDateStandard($data->reg_date)',
                        'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => $modelCards,
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
                            'model' => $modelCards,
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
                        'filter' => $static + CHtml::ListData(Customers::model_getAllData_byDeleted(Utilities::NO), 'id', 'name'),
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
                            'style' => 'text-align: center; (background-color:powderblue; )'
                        ),
                    ),
                    array(
                        'name' => 'amount',
                        'header' => 'Balance',
                        'value' => 'Settings::setNumberFormat($data->cardBalance, 2)',
                        'filter' => false,
                        'htmlOptions' => array('width' => '100px'),
                        'headerHtmlOptions' => array(
                            'style' => 'text-align: center; (background-color:powderblue;color: #3c8dbc !importantß;)'
                        ),
                    ),
                  
                    
                ),
            ));
            ?>
        </div>
    </div>
</div>