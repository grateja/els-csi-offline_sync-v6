<aside id="left-panel">
    <div class="shortcuts">
        <?php
        $model = Users::model_getAllData_byActive(Utilities::NO);
        $count = count($model);

        ?>
        <ul>                                                                                                     
            <li><a href="#"><span class="icon24 icomoon-icon-support"></span></a></li>
            <?php if (Settings::get_Role() == Roles::ROLE_ADMINISTRATOR || Settings::get_Role() != Roles::ROLE_SALES_ADMIN) { ?>  
                <li>
                    <a target="_blank" href="<?php print settings::get_baseUrl(); ?>/index.php?r=siteadmin/purchaseOrderHeaders/adminForApproval" title="PO For Approval" onclick="setSessionData(this.href)">
                        <span class="icon24 entypo-icon-feather"></span>
                        <b class="badge">
                            <?php
                            if ($countForApproval == 0) {
                                
                            } else {

                                print $countForApproval;
                            }
                            ?>
                        </b>
                    </a>
                </li> 
            <?php } else { ?>
                <li><a><span class="icon24 entypo-icon-feather"></span></a></li>   
            <?php } ?>
            <?php if (Settings::get_Role() == Roles::ROLE_ADMINISTRATOR || Settings::get_Role() != Roles::ROLE_SALES) { ?>  
                <li>
                    <a target="_blank" href="<?php print settings::get_baseUrl(); ?>/index.php?r=siteadmin/customerSalesOrderHeaders/adminViewOverride" title="Override VSO" onclick="setSessionData(this.href)">
                        <span class="icon24 icomoon-icon-redo"></span>
                        <b class="badge">
                            <?php
                            if ($modelOverrideCount == 0) {
                                
                            } else {

                                print $modelOverrideCount;
                            }
                            ?>
                        </b>
                    </a>
                </li> 
            <?php } else { ?>
                <li><a><span class="icon24 icomoon-icon-redo"></span></a></li>   
            <?php } ?>

            <?php if (Settings::get_Role() == Roles::ROLE_ADMINISTRATOR || Settings::get_Role() == Roles::ROLE_COST_ACCOUNTANT) { ?>  
                <li>
                    <a target="_blank" href="<?php print settings::get_baseUrl(); ?>/index.php?r=siteadmin/customers/adminNoCreditLimit" title="No Credit Limit">
                        <span class="icon24 silk-icon-credit-card"></span>
                        <b class="badge">
                            <?php
                            if ($creditLimitCount == 0) {
                                
                            } else {

                                print $creditLimitCount;
                            }
                            ?>
                        </b>
                    </a>
                </li> 
            <?php } else { ?>
                <li><a><span class="icon24 silk-icon-credit-card"></span></a></li>   
            <?php } ?>
        </ul>
    </div>
    <div class="login-info">
        <span>
            <a id="show-shortcut" data-action="">
                <i class ="icomoon-icon-user-2"></i>
                <span>
                    Hi! <?php print Settings::get_Username(); ?> 
                </span>
            </a> 
        </span>
    </div>

    <?php
    $model = Utilities::model_getByID(Users::model(), Settings::get_UserID());

    if ($model->is_override_useraccess == Utilities::YES) {

        $menus = UserBasedAccess::model_getParentUserID(Utilities::NO, Settings::get_UserID(), Utilities::YES);
    } else {

        $menus = RoleBasedAccess::model_getParentUserID(Utilities::NO, Settings::get_UserID(), Utilities::YES, $model->role);
    }
    ?>
    <nav>
        <?php
        foreach ($menus as $menus):
            ?>
            <ul class="ulBackground">
                <li>
                    <?php if ($menus->menus->is_url == Utilities::YES): ?>
                        <?php if ($menus->menus->params): ?>
                            <?php $params = "?" . $menus->menus->params; ?>
                        <?php endif; ?>
                        <?php $params = $menus->menus->params; ?>
                        <?php print CHtml::link("<i class='" . $menus->menus->i_class . "'></i><span class='" . $menus->menus->span_class . "'>&nbsp;" . $menus->menus->name . "</span>", $this->createUrl($menus->menus->controller_name . "/" . $menus->menus->action_name), array('title' => $menus->menus->name, 'class' => $menus->menus->link_class, 'onclick' => 'setSessionData(this.href)'));
                        ?>
                    <?php else: ?>
                        <a href="#"><i class="<?php print $menus->menus->i_class; ?>"></i> <span class="<?php print $menus->menus->span_class; ?>"><?php print $menus->menus->name; ?></span></a>             
                    <?php endif; ?>

                    <?php if ($menus->menus->is_parent == Utilities::YES): ?>      
                        <?php
                        if ($model->is_override_useraccess == Utilities::YES) {

                            $subMenu1 = UserBasedAccess::model_getChildrenByParentIDUserID($menus->menus->id, Settings::get_UserID(), Utilities::YES);
                        } else {
                            $subMenu1 = RoleBasedAccess::model_getChildrenByParentIDUserID($menus->menus->id, Settings::get_UserID(), Utilities::YES, $model->role);
                        }
                        ?>

                        <ul>                            
                            <?php foreach ($subMenu1 as $subMenu1): ?>
                                <?php if ($subMenu1->menus->params != ''): ?>
                                    <?php $paramsArr = explode("=", $subMenu1->menus->params); ?>
                                <?php else: ?>
                                    <?php $params = null; ?>
                                <?php endif; ?>
                                <?php if ($subMenu1->menus->is_url == Utilities::YES): ?>
                                    <?php $liClass = str_replace("'", "", $subMenu1->menus->li_class); ?>
                                    <?php $liClassArr = explode("::", $subMenu1->menus->li_class); ?>
                                    <?php $menuClass = $subMenu1->menus->li_class; ?>
                                    <li>
                                        <a href="#"><i class ="minia-icon-book"></i><span class="menu-item-parent"><?php print $subMenu1->menus->name ?></span></a>
                                        <ul>
                                            <li class="<?php print $subMenu1->menus->name ?>" >
                                                <?php print CHtml::link('<i class ="minia-icon-file-add"></i>Manage', $this->createUrl($subMenu1->menus->controller_name . '/' . $subMenu1->menus->action_name), array('onclick' => 'setSessionData(this.href)')); ?>
                                            </li>
                                        </ul>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a href="#"><i class ="minia-icon-book"></i><?php print $subMenu1->menus->name; ?></a>  
                                        <ul>

                                            <?php
                                            if ($model->is_override_useraccess == Utilities::YES) {
                                                $subMenu2 = UserBasedAccess::model_getChildrenByParentIDUserID($subMenu1->menus->id, Settings::get_UserID(), Utilities::YES);
                                            } else {
                                                $subMenu2 = RoleBasedAccess::model_getChildrenByParentIDUserID($subMenu1->menus->id, Settings::get_UserID(), Utilities::YES, $model->role);
                                            }
                                            ?>
                                            <?php foreach ($subMenu2 as $subMenu2): ?>

                                                <?php if ($subMenu2->menus->params != ''): ?>
                                                    <?php $paramsArr = explode("=", $subMenu2->menus->params); ?>
                                                <?php else: ?>
                                                    <?php $paramsArr = null; ?>
                                                <?php endif; ?>

                                                <?php if ($subMenu2->menus->is_url == Utilities::YES): ?>
                                                    <?php $liClass = str_replace("'", "", $subMenu2->menus->li_class); ?>
                                                    <?php $liClassArr = explode("::", $subMenu2->menus->li_class); ?>
                                                    <?php $menuClass = $subMenu2->menus->li_class; ?>
                                                    <li>
                                                        <?php
                                                        if ($paramsArr[1] != "") {
                                                            print CHtml::link('<i class ="minia-icon-file-add"></i>' . $subMenu2->menus->name, $this->createUrl($subMenu2->menus->controller_name . '/' . $subMenu2->menus->action_name, array($paramsArr[0] => ($paramsArr != NULL) ? $paramsArr[1] : "")), array('onclick' => 'setSessionData(this.href)'));
                                                        } else {
                                                            print CHtml::link('<i class ="minia-icon-file-add"></i>' . $subMenu2->menus->name, $this->createUrl($subMenu2->menus->controller_name . '/' . $subMenu2->menus->action_name), array('onclick' => 'setSessionData(this.href)'));
                                                        }
                                                        ?>
                                                    </li>  
                                                <?php else: ?>
                                                    <li>
                                                        <a href="#"><?php print $subMenu2->menus->name; ?></a>  
                                                        <ul>
                                                            <?php
                                                            if ($model->is_override_useraccess == Utilities::YES) {
                                                                $subMenu3 = UserBasedAccess::model_getChildrenByParentIDUserID($subMenu2->menus->id, Settings::get_UserID(), Utilities::YES);
                                                            } else {
                                                                $subMenu3 = RoleBasedAccess::model_getChildrenByParentIDUserID($subMenu2->menus->id, Settings::get_UserID(), Utilities::YES, $model->role);
                                                            }
                                                            ?>
                                                            <?php foreach ($subMenu3 as $subMenu3): ?>
                                                                <?php if ($subMenu3->menus->params != ''): ?>
                                                                    <?php $params2Arr = explode("=", $subMenu3->menus->params); ?>
                                                                <?php else: ?>
                                                                    <?php $params2Arr = null; ?>
                                                                <?php endif; ?>

                                                                <li>

                                                                    <?php
                                                                    if ($paramsArr[1] != "") {
                                                                        print CHtml::link('<i class ="minia-icon-file-add"></i>' . $subMenu3->menus->name, $this->createUrl($subMenu3->menus->controller_name . '/' . $subMenu3->menus->action_name, array($params2Arr[0] => ($params2Arr != NULL) ? $params2Arr[1] : "")), array('onclick' => 'setSessionData(this.href)'));
                                                                    } else {
                                                                        print CHtml::link('<i class ="minia-icon-file-add"></i>' . $subMenu3->menus->name, $this->createUrl($subMenu3->menus->controller_name . '/' . $subMenu3->menus->action_name), array('onclick' => 'setSessionData(this.href)'));
                                                                    }
                                                                    ?>
                                                                    <?php // print CHtml::link('<i class ="minia-icon-file-add"></i>' . $subMenu3->menus->name, $this->createUrl($subMenu3->menus->controller_name . '/' . $subMenu3->menus->action_name, array($params2Arr[0] => ($params2Arr[1]) ? $params2Arr[1] : "")), array('onclick' => 'setSessionData(this.href)')); ?>
                                                                </li>  
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul> 
                    <?php endif; ?>
                </li>
            </ul>
            <?php
        endforeach;
        ?>
    </nav>
    <?php //$this->renderPartial('/layouts/_leftUserManagement');    ?>
    <?php //$this->renderPartial('/layouts/_leftCustomerManagement');   ?>
    <?php //$this->renderPartial('/layouts/_leftInventoryManagement'); ?>
    <?php //$this->renderPartial('/layouts/_leftMasterList'); ?>
    <?php //$this->renderPartial('/layouts/_leftAccountingManagement'); ?>
    <?php //$this->renderPartial('/layouts/_leftProductionManagement'); ?>
    <?php //$this->renderPartial('/layouts/_leftOperationManagement'); ?>
    <?php //$this->renderPartial('/layouts/_leftSalesManagement'); ?>
    <?php //$this->renderPartial('/layouts/_leftRecordManagement'); ?>
    <?php //$this->renderPartial('/layouts/_leftReportManagement');  ?>
    <?php //$this->renderPartial('/layouts/_leftAdminAccess');    ?>

</aside>
<!-- END NAVIGATION -->
<script>
    $(document).ready(function () {
        var defaultHref = 'http://localhost/cpe-inventory/index.php?r=siteadmin/default/index';
        var sessionHref = retrieveSessionDataUrl();

        loc = (sessionHref == '') ? defaultHref : sessionHref;
        newloc = retrieveCurrentURL()
        $('ul a').filter(function () {
            if (loc == newloc) {
                return this.href == newloc;
            } else {
                if (this.href == loc) {
                    return this.href == loc;
                } else {
                    return this.href == newloc;
                }
            }
        }).parent().addClass('active');

        var countActive = $('li.active').length;

        if (countActive > 1) {
            $('ul a').filter(function () {
                return this.href == loc;
            }).parent().removeClass('active');
            $('ul a').filter(function () {
                return this.href == newloc;
            }).parent().addClass('active');
        }
    });

    function setSessionData(val) {
        loc = escape(val);
        $.ajax({
            type: 'GET',
            url: '?r=siteadmin/settings/setSessionData',
            data: 'fieldID=' + 'url' + '&value=' + loc + '&controllerID=' + 'Settings',
            success: function (data) {
            }
        });
    }

    function retrieveSessionDataUrl() {
        var result = "";
        $.ajax({
            type: 'POST',
            url: '?r=siteadmin/settings/retrieveSessionDataUrl',
            dataType: "html",
            async: false,
            success: function (data) {
                result = data;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("get session failed " + errorThrown);
            }
        });

        return result;
    }

    function retrieveCurrentURL() {
        return '<?php print $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>';
    }
</script>
