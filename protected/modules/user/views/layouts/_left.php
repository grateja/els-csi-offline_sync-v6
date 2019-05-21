<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <?php
            $model = new Branches();
            $model = Utilities::model_getByID(Branches::model(), Settings::get_BranchID());
        ?>
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php print ($model->file_path != '') ? Settings::get_baseUrl() . '/' . $model->file_path . $model->file_pics : Settings::get_baseUrl() . '/adminlte/dist/img/user2-160x160.jpg'; ?>" class="img-circle" alt="User Image">

            </div>
            <div class="pull-left info">
                <p><?php print $model->name ?></p>
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
        <ul class="sidebar-menu tree" data-widget="tree">
            <?php $this->renderPartial('/layouts/_leftMenus'); ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

 