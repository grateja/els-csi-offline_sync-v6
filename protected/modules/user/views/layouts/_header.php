<header class="main-header">

    <a href="<?php print Settings::get_baseUrl() . '/index.php?r=' . Settings::get_ModuleID() . '/default/index'; ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>ELS</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>ELS - CSI</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle"class="btn btn-info" data-toggle="modal" data-target="#topupModal">
                        <i class="fa fa-id-card"> RFid</i>
                    </a>

                </li>
                <!-- /.messages-menu -->

                <!-- Notifications Menu -->
                <!--                <li class="dropdown notifications-menu">
                                     Menu toggle button 
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-bell-o"></i>
                                        <span class="label label-warning">10</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="header">You have 10 notifications</li>
                                        <li>
                                             Inner Menu: contains the notifications 
                                            <ul class="menu">
                                                <li> start notification 
                                                    <a href="#">
                                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                                    </a>
                                                </li>
                                                 end notification 
                                            </ul>
                                        </li>
                                        <li class="footer"><a href="#">View all</a></li>
                                    </ul>
                                </li>-->
                <!-- Tasks Menu -->
                <!--                <li class="dropdown tasks-menu">
                                     Menu Toggle Button 
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-flag-o"></i>
                                        <span class="label label-danger">9</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="header">You have 9 tasks</li>
                                        <li>
                                             Inner menu: contains the tasks 
                                            <ul class="menu">
                                                <li> Task item 
                                                    <a href="#">
                                                         Task title and progress text 
                                                        <h3>
                                                            Design some buttons
                                                            <small class="pull-right">20%</small>
                                                        </h3>
                                                         The progress bar 
                                                        <div class="progress xs">
                                                             Change the css width attribute to simulate progress 
                                                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                                <span class="sr-only">20% Complete</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                 end task item 
                                            </ul>
                                        </li>
                                        <li class="footer">
                                            <a href="#">View all tasks</a>
                                        </li>
                                    </ul>
                                </li>-->
                <!-- User Account Menu -->
                <?php
                    $model = new Employees();
                    $model = Utilities::model_getByID(Employees::model(), Settings::get_EmployeeID());
                ?>
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="<?php print ($model->file_path != '')?Settings::get_baseUrl().'/'.$model->file_path.$model->file_pics: Settings::get_baseUrl().'/adminlte/dist/img/user2-160x160.jpg'; ?>" class="user-image" alt="User Image">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <?php
                            print $model->firstname;
                        ?>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                               <img src="<?php print ($model->file_path != '')?Settings::get_baseUrl().'/'.$model->file_path.$model->file_pics: Settings::get_baseUrl().'/adminlte/dist/img/user2-160x160.jpg'; ?>" class="img-circle" alt="User Image">
                      

                            <p>
                                <?= $model->fullName ?> 
                                <small>Member since <?= Settings::setDateStandard($model->created_at); ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                       <?php echo CHtml::link('<i class="fa fa-user">Profile</i>', $this->createUrl('employees/view', array('id'=>$model->id)), array('class' => 'btn btn-default btn-flat pull-right', 'data-toggle' => 'tooltip', 'title' => 'Create')); ?>
     
                            </div>
                            <div class="pull-right">
                                <?php print CHtml::link('<i class="fa fa-sign-out"></i> Sign out', $this->createUrl('/site/logout'), array('data-logout-msg' => 'You can improve your security further after logging out by closing this opened browser', 'class' => 'btn btn-default btn-flat')); ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-custom-menu -->
    </nav>
</header>


<div class="modal modal-primary fade" id="topupModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Customer Card Transaction</h4>
            </div>
            <div class="modal-body">
                <?php $model = new CustomerCards(); ?>

                <div class="form-group">
                    <?php echo CHtml::activeLabelEx($model, 'Search for customer or RFid number'); ?>
                    <?php echo CHtml::activeDropDownList($model, 'id', CHtml::listData(CustomerCards::model_getAllData_byClientID(Utilities::NO), 'id', 'name'), array('id' => "customerID", 'class' => 'form-control', 'prompt' => '--select--', 'style' => 'width: 100%')); ?>
                </div>

                <div class="form-group">
                    <?php echo CHtml::activeLabelEx($model, 'amount'); ?>
                    <?php echo CHtml::activeTextField($model, 'amount', array('class' => 'form-control', 'placeholder' => '0.00', 'id' => 'transAmount')); ?>

                </div>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onCLick="js: topUP(2)">Top Down</button>
                <button type="button" class="btn btn-success" onCLick="js: topUP(1)">Top UP</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
        function topUP(val) {

            var transactionType = val;
            var customerID = $('#customerID').val();
            var transAmount = $('#transAmount').val();

            if (!$.isNumeric(transAmount)) {
                messageBox(0, 'Please input a valid amount!...');
            } else {

                $.ajax({
                    type: 'GET',
                    url: '?r=user/customerCards/topup',
                    data: 'customerID=' + customerID + '&transAmount=' + transAmount + '&transactionType=' + transactionType,
                    async: false,
                    success: function (returnMsg) {
                        console.log(returnMsg);
                        var result = JSON.parse(returnMsg);
                        if (result.isError == 0) {
                            $('#topupModal').modal('hide');
                            messageBox(1, result.message);
                        } else {

                            $('#topupModal').modal('show');
                            messageBox(0, result.message);
                        }
                    }
                });
            }


        }
</script>