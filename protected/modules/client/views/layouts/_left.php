<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <?php
            $model = new Clients();
            $model = Utilities::model_getByID(Clients::model(), Settings::get_ClientID());
        ?>
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php print ($model->file_path != '') ? Settings::get_baseUrl() . '/' . $model->file_path .'/'. $model->file_pics : Settings::get_baseUrl() . '/adminlte/dist/img/user2-160x160.jpg'; ?>" class="img-circle" alt="User Image">

            </div>
            <div class="pull-left info">
                <p><?php print $model->firstname ?></p>

                <?php if (Utilities::get_isOnline() == Utilities::YES): ?>

                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    <?php else: ?>

                        <a href="#"><i class="fa fa-circle text-danger"></i> Offline</a>
                <?php endif; ?>
            </div>
        </div>
        <!-- search form -->
<!--        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>-->
        <!-- /.search form -->  
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <?php $this->renderPartial('/layouts/_leftMenus'); ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>


<script>
//    $(document).ready(function () {
//        var defaultHref = '<?php print Settings::get_baseUrl() . '/index.php?r=' . Settings::get_ModuleID() . '/default/index'; ?>';
//        var sessionHref = retrieveSessionDataUrl();
//
//        loc = (sessionHref == '') ? defaultHref : sessionHref;
//        newloc = retrieveCurrentURL()
//        $('ul a').filter(function () {
//            if (loc == newloc) {
//                return this.href == newloc;
//            } else {
//                if (this.href == loc) {
//                    return this.href == loc;
//                } else {
//                    return this.href == newloc;
//                }
//            }
//        }).parent().addClass('active');
//
//        var countActive = $('li.active').length;
//
//        if (countActive > 1) {
//            $('ul a').filter(function () {
//                return this.href == loc;
//            }).parent().removeClass('active');
//            $('ul a').filter(function () {
//                return this.href == newloc;
//            }).parent().addClass('active');
//        }
//    });
//
//    function setSessionData(val) {
//        loc = escape(val);
//        $.ajax({
//            type: 'GET',
//            url: '?r=siteadmin/settings/setSessionData',
//            data: 'fieldID=' + 'url' + '&value=' + loc + '&controllerID=' + 'Settings',
//            success: function (data) {
//            }
//        });
//    }
//
//    function retrieveSessionDataUrl() {
//        var result = "";
//        $.ajax({
//            type: 'POST',
//            url: '?r=siteadmin/settings/retrieveSessionDataUrl',
//            dataType: "html",
//            async: false,
//            success: function (data) {
//                result = data;
//            },
//            error: function (jqXHR, textStatus, errorThrown) {
//                alert("get session failed " + errorThrown);
//            }
//        });
//
//        return result;
//    }
//
//    function retrieveCurrentURL() {
//        return '<?php print $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>';
//    }
</script>
