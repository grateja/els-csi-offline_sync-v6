

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
    
    function checkAll(value) {
        var btns = document.getElementsByClassName(value);
        for(i=0;i<btns.length;i++) {
            btns[i].checked = true;
        }
    }

    function uncheckAll(value) {
        var btns = document.getElementsByClassName(value);
        for(i=0;i<btns.length;i++) {
            btns[i].checked = false;
        }
    }
    
      function saveNavigationAuthorizationByUserAccount() {

        var userAccount = document.getElementById('userAccount').value;

        var chkArray = [];
        var unchkArray = [];

        $('.mod:checked').each(function() {
                chkArray.push($(this).val());
        });

        $('.mod:unchecked').each(function() {
                unchkArray.push($(this).val());
        });

        var selected;
        selected = chkArray.join(',') + ',';
        var unselected;
        unselected = unchkArray.join(',') + ',';       

        //alert(unselected);
        if (userAccount === '' || userAccount === null) {
            alertify.alert('Please select User Account.').set({transition:'fade', title: 'WARNING!', movable: false});
        } else {
            if(selected.length > 1){
                $.ajax({
                    url: '?r=siteadmin/users/ajaxSumbitUserAccess',
                    type: 'POST',
                    dataType: 'text',
                    data:{ userAccount:userAccount, selected:selected, unselected:unselected},

                    success: function(data) {
                   // alert(data);
                   console.log(data);
                   var result = JSON.parse(data);
                  //  alert(result.name);
                        alertify.alert(result.message).set({transition:'fade', title: 'SUCCESS!', movable: false});
                    },
                    error:{
                    }
                });	
            }else{
                    alertify.alert('Please Select at least one of the checkbox.').set({transition:'fade', title: 'WARNING!', movable: false});	
            }
        }
    }

    ", 2);
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.tree > ul').attr('role', 'tree').find('ul').attr('role', 'group');
        $('.tree').find('li:has(ul)').addClass('parent_li').attr('role', 'treeitem').find(' > span').attr('title', 'Collapse this branch').on('click', function (e) {
            var children = $(this).parent('li.parent_li').find(' > ul > li');
            if (children.is(':visible')) {
                children.hide('fast');
                $(this).attr('title', 'Expand this branch').find(' > i').removeClass().addClass('fa fa-lg fa-plus-circle');
            } else {
                children.show('fast');
                $(this).attr('title', 'Collapse this branch').find(' > i').removeClass().addClass('fa fa-lg fa-minus-circle');
            }
            e.stopPropagation();
        });

    });
</script>

<style>
    .access-role-contents {
        overflow-y: scroll;
        height: 75vh;
    }
</style>

<div class ="col-lg-12">
    <div class ="col-lg-8">
        <div class ="row">
            <div class="col-lg-12 padding-0">
                <div class="metronicCreate" style="height: 35vh">
                    <header class ="margin-bottom-10">
                        <span><i class="iconic-icon-plus-alt"></i>Create - Users</span>
                    </header>

                    <?php echo $this->renderPartial('_formAdmin', array('model' => $modelCreate)); ?>
                </div>
            </div>
            <div class="col-lg-12 padding-0">
                <div class="metronicManage" style="height: 46.5vh">
                    <header>
                        <span><i class="fa fa-th"></i>Manage - Employees</span>
                    </header>
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
                                    'style' => 'width: 15%;'
                                ),
                            ),
                            array(
                                'name' => 'emp_id',
                                'header' => 'Employee',
                                'value' => '$data->employees->lnameFname',
                                'filter' => $static + CHtml::ListData(Employees::model_getAllData_byDeleted(Utilities::NO), 'id', 'lnameFname'),
                                'htmlOptions' => array(
                                    'style' => 'width: 20%;'
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
                                    'style' => 'width: 15%;'
                                ),
                            ),
                            array(
                                'header' => 'Active',
                                'name' => 'is_active',
                                'value' => '$data->isActive',
                                'filter' => $static + Utilities::get_ActiveSelect(),
                                'htmlOptions' => array(
                                    'style' => 'width: 6%;'
                                ),
                                'type' => 'raw',
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
    </div>
    <div class ="row">
        <div class="col-lg-4">
            <div class="metronicCreate">
                <header> 
                    <span><i class="fa fa-th"></i>Transaction Module Authorization</span>
                </header>
                <div class="access-role-contents">
                    <div class="smart-form">
                        <fieldset>
                            <section>
                                <label>User Account</label>
                                <label class="select">
                                    <?php
                                    echo CHtml::activeDropDownList($model, 'id', CHtml::listData(Users::model_getAllData_byActive(Utilities::YES), 'id', 'username'), array('prompt' => 'Choose One', "id" => "userAccount", "class" => "select2"));
                                    ?>
                                </label>
                            </section>              
                            <div class="tree smart-form">
                                <ul>
                                    <li>
                                        <span><i class="fa fa-lg fa-folder-open"></i> Menus</span>
                                        <ul>
                                            <?php $modelMainMenus = Menus::model_getAllMainMenu(); ?>
                                            <?php foreach ($modelMainMenus as $menus) { ?>
                                                <?php if ($menus->is_parent == Utilities::NO) { ?>
                                                    <li>
                                                        <span>
                                                            <label class="checkbox inline-block">
                                                                <input type="checkbox" name="checkbox-inline" class="mod" value="<?php echo $menus->id ?>">
                                                                <i></i><?php echo $menus->name ?>
                                                            </label>
                                                        </span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li>
                                                        <span>
                                                            <label>
                                                                <b><i class="fa fa-lg fa-plus-circle"></i></b>
                                                                <?php echo $menus->name ?>
                                                            </label>
                                                        </span>
                                                        <ul>
                                                            <?php $subMenus1 = Menus::model_getAllSubMenu_byParentID($menus->id) ?>
                                                            <?php foreach ($subMenus1 as $menus1) { ?>
                                                                <?php if ($menus1->is_parent == Utilities::NO) { ?>
                                                                    <li style="display: none;">
                                                                        <span>
                                                                            <label class="checkbox inline-block">
                                                                                <input type="checkbox" name="checkbox-inline" class="mod" value="<?php echo $menus1->id ?>">
                                                                                <i></i><?php echo $menus1->name ?>
                                                                            </label>
                                                                        </span>
                                                                    </li>
                                                                <?php } else { ?>
                                                                    <li style="display: none;">
                                                                        <span>
                                                                            <label>
                                                                                <b><i class="fa fa-lg fa-plus-circle"></i></b>
                                                                                <?php echo $menus1->name ?>
                                                                            </label>
                                                                        </span>
                                                                        <ul>
                                                                            <?php $subMenus2 = Menus::model_getAllSubMenu_byParentID($menus1->id) ?>
                                                                            <?php foreach ($subMenus2 as $menus2) { ?>
                                                                                <?php if ($menus2->is_parent == Utilities::NO) { ?>
                                                                                    <li style="display: none;">
                                                                                        <span>
                                                                                            <label class="checkbox inline-block">
                                                                                                <input type="checkbox" name="checkbox-inline" class="mod" value="<?php echo $menus2->id ?>">
                                                                                                <i></i><?php echo $menus2->name ?>
                                                                                            </label>
                                                                                        </span>
                                                                                    </li>
                                                                                <?php } else { ?>
                                                                                    <li style="display: none;">
                                                                                        <span>
                                                                                            <label>
                                                                                                <b><i class="fa fa-lg fa-plus-circle"></i></b>
                                                                                                <?php echo $menus2->name ?>
                                                                                            </label>
                                                                                        </span>
                                                                                        <ul>
                                                                                            <?php $subMenus3 = Menus::model_getAllSubMenu_byParentID($menus2->id) ?>
                                                                                            <?php foreach ($subMenus3 as $menus3) { ?>
                                                                                                <?php if ($menus3->is_parent == Utilities::NO) { ?>
                                                                                                    <li style="display: none;">
                                                                                                        <span>
                                                                                                            <label class="checkbox inline-block">
                                                                                                                <input type="checkbox" name="checkbox-inline" class="mod" value="<?php echo $menus3->id ?>">
                                                                                                                <i></i><?php echo $menus3->name ?>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </li>
                                                                                                <?php } else { ?>
                                                                                                    <li style="display: none;">
                                                                                                        <span>
                                                                                                            <label>
                                                                                                                <b><i class="fa fa-lg fa-plus-circle"></i></b>
                                                                                                                <?php echo $menus3->name ?>
                                                                                                            </label>
                                                                                                        </span>
                                                                                                    </li>
                                                                                                <?php } ?>
                                                                                            <?php } ?>
                                                                                        </ul>
                                                                                    </li>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                        </ul>
                                                                    </li>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </ul>
                                                    </li>
                                                <?php } ?>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <section>
                                <button onclick="checkAll('mod')" class="btn btn-primary btn-sm">Check All</button>
                                <button onclick="uncheckAll('mod')" class="btn btn-primary btn-sm">Uncheck All</button>
                            </section> 
                            <section class="text-right">
                                <button onclick="saveNavigationAuthorizationByUserAccount()" class="btn btn-sm btn-success">Save</button>
                            </section>
                        </fieldset>
                    </div>  
                </div>
            </div>

            <br/>
        </div>
    </div>
</div>


