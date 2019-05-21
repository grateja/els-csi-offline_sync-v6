<br/>
<article class="col-sm-12 col-md-12 col-lg-7">
    <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-4" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
        <header>
            <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
            <h2>Update - User</h2>
        </header>

        <div class="modal-content">
            <div class="smart-form" style="text-align: center;padding-bottom: 10px;">
                <?php //print CHtml::link('<i class="fa fa-plus-circle">' . ' Create New</i>', $this->createUrl('users/admin'), array('class' => 'btn btn-success btn-sm', 'style' => 'width: 150px;', 'id' => 'btnPayment')); ?>
            </div>
            <?php echo $this->renderPartial('_formAdminUpdate', array('model' => $model, 'modelUpdate' => $modelUpdate)); ?>
        </div>
    </div>
</article>

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
<article class="col-sm-12 col-md-12 col-lg-12">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-4" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">

        <header>
            <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
            <h2>Manage Users</h2>
        </header>

        <div class="modal-content">
            <div class="smart-form" style="text-align: center;padding-bottom: 10px;">
                <?php //print CHtml::link('<i class="fa fa-plus-circle">' . ' Create New</i>', $this->createUrl('users/create'), array('class' => 'btn btn-success btn-sm', 'style' => 'width: 150px;', 'id' => 'btnPayment')); ?>

                <?php $static = array('' => Yii::t('', 'All')); ?>
                <?php
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'users-grid',
                    'dataProvider' => $model->search(),
                    'afterAjaxUpdate' => 'reinstallDatePicker',
                    'filter' => $model,
                    'columns' => array(
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
                            'name' => 'emp_id',
                            'header' => 'Employee',
                            'value' => '$data->employees->lnameFname',
                            'filter' => $static + CHtml::ListData(Employees::model_getAllData_byDeleted(Utilities::NO), 'id', 'lnameFname'),
                            'htmlOptions' => array(
                                'style' => 'width: 300px;'
                            ),
                        ),
                        'username',
                        'email',
                        array(
                            'name' => 'role',
                            'header' => 'Roles',
                            'value' => '$data->roles->name',
                            'filter' => $static + CHtml::ListData(Employees::model_getAllData_byDeleted(Utilities::NO), 'id', 'lnameFname'),
                            'htmlOptions' => array(
                                'style' => 'width: 150px;'
                            ),
                        ),
                        array(
                            'name' => 'is_active',
                            'value' => '$data->isActive',
                            'filter' => $static + Utilities::get_ActiveSelect(),
                            'htmlOptions' => array(
                                'style' => 'width: 100px;'
                            ),
                            'type' => 'raw',
                        ),
                        array(
                            'class' => 'CButtonColumn',
                            'header' => 'Action',
                            'template' => '{view}{update}', // buttons here...
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
    <br/><br/>
</article>


<!--<article class="col-sm-6 col-md-6 col-lg-6">
    <div role="widget" style="" class="jarviswidget jarviswidget-color-blueDark" id="wid-id-4" data-widget-editbutton="false">
        <header role="heading">
            <div role="menu" class="jarviswidget-ctrls">
                <a data-original-title="Collapse" href="javascript:void(0);" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom"><i class="fa fa-minus "></i></a> 
                <a data-original-title="Fullscreen" href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom"><i class="fa fa-expand "></i></a> <a data-original-title="Delete" href="javascript:void(0);" class="button-icon jarviswidget-delete-btn" rel="tooltip" title="" data-placement="bottom"><i class="fa fa-times"></i></a>
            </div>
            <span class="widget-icon"><i class="fa fa-table"></i></span>
            <h2>Transaction Module Authorization</h2>
            <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
        </header>
        <div role="content">
            <div class="smart-form">
                <fieldset>
                    <section>
                        <label>User Account</label>
                        <label class="select">
                            <select id="userAccount" class="select2" onchange="setCheckModuleByUserAccount()">
                                <option></option>
                                <option value="1">admin - Admin Admin (Super Administrator)</option>
                            </select>
                        </label>
                    </section>              
                    <div class="tree smart-form">
                        <ul>
                            <li>
                                <span><i class="fa fa-lg fa-folder-open"></i> Modules</span>
                                <ul>
                                    <li>
                                        <span><label class="checkbox inline-block">
                                                <input type="checkbox" name="checkbox-inline" class="mod" value="100">
                                                <i></i>Dashboard</label></span>
                                    </li><li>
                                        <span><i class="fa fa-lg fa-plus-circle"></i> Security Administration</span>
                                        <ul>
                                            <li>
                                                <span><label class="checkbox inline-block">
                                                        <input type="checkbox" name="checkbox-inline" class="mod" value="327"><i></i>Account Types</label></span>
                                            </li><li>
                                                <span><label class="checkbox inline-block">
                                                        <input type="checkbox" name="checkbox-inline" class="mod" value="328"><i></i>User Accounts</label></span>
                                            </li></ul>
                                    </li><li>
                                        <span><i class="fa fa-lg fa-plus-circle"></i> Maintenance</span>
                                        <ul>
                                            <li>
                                                <span><label class="checkbox inline-block">
                                                        <input type="checkbox" name="checkbox-inline" class="mod" value="335"><i></i>Account Codes</label></span>
                                            </li><li>
                                                <span><label class="checkbox inline-block">
                                                        <input type="checkbox" name="checkbox-inline" class="mod" value="336"><i></i>Cost Centers</label></span>
                                            </li><li>
                                                <span><label class="checkbox inline-block">
                                                        <input type="checkbox" name="checkbox-inline" class="mod" value="343"><i></i>Supplier / Contractor</label></span>
                                            </li><li>
                                                <span><label class="checkbox inline-block">
                                                        <input type="checkbox" name="checkbox-inline" class="mod" value="345"><i></i>Bank Account Maintenance</label></span>
                                            </li><li>
                                                <span><label class="checkbox inline-block">
                                                        <input type="checkbox" name="checkbox-inline" class="mod" value="344"><i></i>Bank Maintenance</label></span>
                                            </li></ul>
                                    </li><li>
                                        <span><i class="fa fa-lg fa-plus-circle"></i> Reports</span>
                                        <ul>
                                            <li>
                                                <span><label class="checkbox inline-block">
                                                        <input type="checkbox" name="checkbox-inline" class="mod" value="351"><i></i>Registers Report</label></span>
                                            </li></ul>
                                    </li><li>
                                        <span><i class="fa fa-lg fa-plus-circle"></i> Transactions</span>
                                        <ul>
                                            <li>
                                                <span><label class="checkbox inline-block">
                                                        <input type="checkbox" name="checkbox-inline" class="mod" value="342"><i></i>Project Voucher</label></span>
                                            </li><li>
                                                <span><i class="fa fa-lg fa-plus-circle"></i> Petty Cash</span>
                                                <ul>
                                                    <li>
                                                        <span><label class="checkbox inline-block">
                                                                <input type="checkbox" name="checkbox-inline" class="mod" value="304"><i></i>Petty Cash Voucher</label></span>
                                                    </li>

                                                    <li>
                                                        <span><label class="checkbox inline-block">
                                                                <input type="checkbox" name="checkbox-inline" class="mod" value="337"><i></i>Petty Cash Replenishment</label></span>
                                                    </li>
                                                </ul>
                                            </li><li>
                                                <span><label class="checkbox inline-block">
                                                        <input type="checkbox" name="checkbox-inline" class="mod" value="301"><i></i>Check Voucher</label></span>
                                            </li><li>
                                                <span><label class="checkbox inline-block">
                                                        <input type="checkbox" name="checkbox-inline" class="mod" value="302"><i></i>Journal Voucher</label></span>
                                            </li><li>
                                                <span><label class="checkbox inline-block">
                                                        <input type="checkbox" name="checkbox-inline" class="mod" value="303"><i></i>Payable Voucher</label></span>
                                            </li><li>
                                                <span><label class="checkbox inline-block">
                                                        <input type="checkbox" name="checkbox-inline" class="mod" value="309"><i></i>Bank Reconciliation</label></span>
                                            </li><li>
                                                <span><label class="checkbox inline-block">
                                                        <input type="checkbox" name="checkbox-inline" class="mod" value="310"><i></i>Payable Voucher (for Project)</label></span>
                                            </li></ul>
                                    </li><li>
                                        <span><i class="fa fa-lg fa-plus-circle"></i> Task Staging</span>
                                        <ul>
                                            <li>
                                                <span><label class="checkbox inline-block">
                                                        <input type="checkbox" name="checkbox-inline" class="mod" value="362"><i></i>Manage</label></span>
                                            </li></ul>
                                    </li>                                                    </ul>
                            </li>
                        </ul>
                    </div>
                    <section>
                        <button onclick="checkAll('mod')" class="btn btn-primary btn-sm">Check All</button>
                        <button onclick="uncheckAll('mod')" class="btn btn-primary btn-sm">Uncheck All</button>
                    </section> 
                    <section class="text-right">
                        <button onclick="saveNavigationAuthorizationByUserAccount()" class="btn btn-primary btn-sm">Save</button>
                    </section>
                </fieldset>
            </div>
        </div>
    </div>
    <br/><br/>
</article>


<article class="col-sm-6 col-md-6 col-lg-6">
    <div role="widget" style="" class="jarviswidget jarviswidget-color-blueDark" id="wid-id-5" data-widget-editbutton="false">
        <header role="heading">
            <div role="menu" class="jarviswidget-ctrls">
                <a data-original-title="Collapse" href="javascript:void(0);" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="" data-placement="bottom"><i class="fa fa-minus "></i></a> 
                <a data-original-title="Fullscreen" href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom"><i class="fa fa-expand "></i></a> <a data-original-title="Delete" href="javascript:void(0);" class="button-icon jarviswidget-delete-btn" rel="tooltip" title="" data-placement="bottom"><i class="fa fa-times"></i></a>
            </div>
            <span class="widget-icon"><i class="fa fa-table"></i></span>
            <h2>Transaction Status Authorization</h2>
            <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
        </header>
        <div role="content">
            <div class="smart-form">
                <fieldset> 
                    <section>
                        <label>User Account</label>
                        <label class="select">
                            <select id="authorizationUserAccount" class="select2" onchange="setCheckCASByUserAccount()">
                                <option></option>
<?php foreach ($user_account['rows'] as $user_account) { ?>
                                        <option value="<?php echo $user_account['account_id']; ?>"><?php echo $user_account['user_account'] . ' - ' . ucwords($user_account['first_name']) . ' ' . ucwords($user_account['last_name']) . ' (' . ucwords($user_account['account_type']) . ')'; ?></option>
<?php } ?>
                            </select>
                        </label>
                    </section>  
                    <section>
                        <label>Source Module</label>
                        <label class="select">
                            <select id="authorizationSource" class="select2" onchange="setCheckCASByUserAccount()">
                                <option></option>
<?php foreach ($source['rows'] as $source) { ?>
                                        <option value="<?php echo $source['transaction_source_id']; ?>"><?php echo ucwords($source['transaction_source_title']); ?></option>
<?php } ?>
                            </select>
                        </label>
                    </section>    
                    <section>
                        <label class="label">Status</label>
                        <div class="row">
                            <div class="col col-12" style="height: 200px; width: 97%; overflow-y: scroll;">
<?php foreach ($status['rows'] as $status) { ?>
                                        <label class="checkbox">
                                            <input type="checkbox" class='cas2' value="<?php echo $status['transaction_status_id'] ?>">
                                            <i></i><?php echo ucwords($status['transaction_status_title']); ?></label>
<?php } ?>                                      
                            </div>
                        </div>
                    </section>
                    <section>
                        <button onclick="checkAll('cas2')" class="btn btn-primary btn-sm">Check All</button>
                        <button onclick="uncheckAll('cas2')" class="btn btn-primary btn-sm">Uncheck All</button>
                    </section> 
                    <section class="text-right">
                        <button onclick="saveStatusByAccountType()" class="btn btn-primary btn-sm">Save</button>
                    </section>
                </fieldset>
            </div>
        </div>
    </div>
    <br/><br/>
</article>-->