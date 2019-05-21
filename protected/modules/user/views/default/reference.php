<script>
    
    if ($("#saleschart").length) {
                          var d = [<?php print $dataRates; ?>];

                          for (var i = 0; i < d.length; ++i)
                                  d[i][0] += 60 * 60 * 1000;

                          function weekendAreas(axes) {
                                  var markings = [];
                                  var d = new Date(axes.xaxis.min);
                                  // go to the first Saturday
//						d.setUTCDate(d.getUTCDate())
                                  d.setUTCSeconds(0);
                                  d.setUTCMinutes(0);
                                  d.setUTCHours(0);
                                  var i = d.getTime();
                                  do {
                                          // when we don't set yaxis, the rectangle automatically
                                          // extends to infinity upwards and downwards
                                          markings.push({
                                                  xaxis : {
                                                          from : i,
                                                          to : i + 1 * 24 * 60 * 60 * 1000
                                                  }
                                          });
                                          i += 1 * 24 * 60 * 60 * 1000;
                                  } while (i < axes.xaxis.max);

                                  return markings;
                          }

                          var options = {
                                  xaxis : {
                                          mode : "time",
                                          tickLength : 5
                                  },
                                  series : {
                                          lines : {
                                                  show : true,
                                                  lineWidth : 1,
                                                  fill : true,
                                                  fillColor : {
                                                          colors : [{
                                                                  opacity : 0.1
                                                          }, {
                                                                  opacity : 0.15
                                                          }]
                                                  }
                                          },
                                          //points: { show: true },
                                          shadowSize : 0
                                  },
                                  selection : {
                                          mode : "x"
                                  },
                                  grid : {
                                          hoverable : true,
                                          clickable : true,
                                          tickColor : $chrt_border_color,
                                          borderWidth : 0,
                                          borderColor : $chrt_border_color,
                                  },
                                  tooltip : true,
                                  tooltipOpts : {
                                          content : "TLC value for <b>%x</b> was <span>%y</span>",
                                          dateFormat : "%y-%0m-%0d",
                                          defaultTheme : false
                                  },
                                  colors : [$chrt_second],

                          };

                          var plot = $.plot($("#saleschart"), [d], options);
                  };

</script>
                <!--CONTENT CONTAINER-->
                <!--===================================================-->
                <div id="content-container">
                    <div id="profilebody">
                        <div class="pad-all animated fadeInDown">
                            <div class="row">
                                <div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
                                    <div class="panel panel-default mar-no">
                                        <div class="panel-body">
                                            <a href="JavaScript:void(0);">
                                                <div class="pull-left">
                                                    <p class="profile-title text-bricky">Users</p>
                                                </div>
                                                <div class="pull-right text-bricky"> <i class="fa fa-users fa-4x"></i> </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
                                    <div class="panel panel-default mar-no">
                                        <div class="panel-body">
                                            <a href="JavaScript:void(0);">
                                                <div class="pull-left">
                                                    <p class="profile-title text-bricky">Inbox</p>
                                                </div>
                                                <div class="pull-right text-bricky"> <i class="fa fa-envelope fa-4x"></i> </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
                                    <div class="panel panel-default mar-no">
                                        <div class="panel-body">
                                            <a href="JavaScript:void(0);">
                                                <div class="pull-left">
                                                    <p class="profile-title text-bricky">FAQ</p>
                                                </div>
                                                <div class="pull-right text-bricky"> <i class="fa fa-headphones fa-4x"></i> </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
                                    <div class="panel panel-default mar-no">
                                        <div class="panel-body">
                                            <a href="JavaScript:void(0);">
                                                <div class="pull-left">
                                                    <p class="profile-title text-bricky">Settings</p>
                                                </div>
                                                <div class="pull-right text-bricky"> <i class="fa fa-cogs fa-4x"></i> </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
                                    <div class="panel panel-default mar-no">
                                        <div class="panel-body">
                                            <a href="JavaScript:void(0);">
                                                <div class="pull-left">
                                                    <p class="profile-title text-bricky">Calender</p>
                                                </div>
                                                <div class="pull-right text-bricky"> <i class="fa fa-calendar fa-4x"></i> </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
                                    <div class="panel panel-default mar-no">
                                        <div class="panel-body">
                                            <a href="JavaScript:void(0);">
                                                <div class="pull-left">
                                                    <p class="profile-title text-bricky">Pictures</p>
                                                </div>
                                                <div class="pull-right text-bricky"> <i class="fa fa-picture-o fa-4x"></i> </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div class="pageheader">
                        <h3><i class="fa fa-home"></i> Dashboard </h3>
                        <div class="breadcrumb-wrapper">
                            <span class="label">You are here:</span>
                            <ol class="breadcrumb">
                                <li> <a href="#"> Home </a> </li>
                                <li class="active"> Dashboard </li>
                            </ol>
                        </div>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->
                    <!--Page content-->
                    <!--===================================================-->
                    <div id="page-content">
                        <!--Widget-4 -->
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-9 col-sm-9 col-xs-10">
                                                <h3 class="mar-no"> <span class="counter">50.5 GB</span></h3>
                                                <p class="mar-ver-5"> Traffic this month </p>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-2"> <i class="fa fa-shopping-cart fa-3x text-info"></i> </div>
                                        </div>
                                        <div class="progress progress-striped progress-sm">
                                            <div style="width: 60%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar"> <span class="sr-only">60% Complete</span> </div>
                                        </div>
                                        <p> 4% higher than last month </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-9 col-sm-9 col-xs-10">
                                                <h3 class="mar-no"> <span class="counter">26.8%</span></h3>
                                                <p class="mar-ver-5">Server Load</p>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-2"> <i class="fa fa-envelope fa-3x text-danger"></i> </div>
                                        </div>
                                        <div class="progress progress-striped progress-sm">
                                            <div style="width: 60%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-danger"> <span class="sr-only">60% Complete</span> </div>
                                        </div>
                                        <p> 4% higher than last month </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="panel widget">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-9 col-sm-9 col-xs-10">
                                                <h3 class="mar-no"> <span class="counter">$14,500</span></h3>
                                                <p class="mar-ver-5"> Total Sales </p>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-2"> <i class="fa fa-users fa-3x text-success"></i> </div>
                                        </div>
                                        <div class="progress progress-striped progress-sm">
                                            <div style="width: 60%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-success"> <span class="sr-only">60% Complete</span> </div>
                                        </div>
                                        <p> 4% higher than last month </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="panel widget">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-9 col-sm-9 col-xs-10">
                                                <h3 class="mar-no"> <span class="counter">65</span>%</h3>
                                                <p class="mar-ver-5"> Search Traffic</p>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-2"> <i class="fa fa-search fa-3x text-info"></i> </div>
                                        </div>
                                        <div class="progress progress-striped progress-sm">
                                            <div style="width: 60%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-warning"> <span class="sr-only">60% Complete</span> </div>
                                        </div>
                                        <p> 4% higher than last month </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"> Network Performance </h3>
                                    </div>
                                    <div class="panel-body">
                                       <div class="col-md-8">
                                        <!--Flot Spline Chart placeholder -->
                                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
                                        <div id="flot-spline" style="height:275px;"></div>
                                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
                                       </div> 
                                       <div class="col-md-4">
                                            <ul class="list-unstyled">
                                                <li class="mar-btm">
                                                    <span class="label label-primary pull-right">75%</span>
                                                    <p> <i class="fa fa-dashboard text-primary"></i> CPU Usage</p>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar progress-bar-primary" style="width: 75%;">
                                                            <span class="sr-only">75%</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mar-btm">
                                                    <span class="label label-danger pull-right">55%</span>
                                                    <p><i class="fa fa-database text-danger"></i> Bandwidth</p>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar progress-bar-danger" style="width: 55%;">
                                                            <span class="sr-only">55%</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mar-btm">
                                                    <span class="label label-success pull-right">65%</span>
                                                    <p><i class="fa fa-cubes text-success"></i> Memory Usage</p>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar progress-bar-success" style="width: 65%;">
                                                            <span class="sr-only">65%</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mar-btm">
                                                    <span class="label label-warning pull-right">45%</span>
                                                    <p><i class="fa fa-hdd-o text-warning"></i> Disk Usage</p>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar progress-bar-warning" style="width: 45%;">
                                                            <span class="sr-only">45%</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mar-btm">
                                                    <span class="label label-mint pull-right">3/10</span>
                                                    <p> <i class="fa fa-at"></i> Domain</p>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar progress-bar-mint" style="width: 75%;">
                                                            <span class="sr-only">75%</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>                                       
                                       </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"> Sales Chart </h3>
                                    </div>
                                    <div class="panel-body">
                                        <!--Morris Area Chart placeholder-->
                                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
                                        <div id="demo-morris-color-donut" style="height:275px"></div>
                                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="panel">
                                    <div class="panel-body">
                                       <ul class="nav nav-section nav-justified">
                                          <li>
                                             <div class="section"> 
                                               <h4 class="nm"> 67 GB </h4>
                                                <p class="text-muted">Total Usage</p>
                                             </div>
                                          </li>
                                          <li>
                                             <div class="section"> 
                                               <h4 class="nm"> 320 GB </h4>
                                                <p class="text-muted">Total Space</p>
                                             </div>
                                          </li>
                                          <li>
                                             <div class="section"> 
                                               <h4 class="nm"> 58% </h4>
                                                <p class="text-muted">CPU</p>
                                             </div>
                                          </li>
                                       </ul>
                                        <!--Flot Area Chart placeholder-->
                                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
                                        <div id="demo-realtime" style="height:265px"></div>
                                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div id="carousel-example-vertical" class="carousel vertical slide" data-ride="carousel">
                                            <div class="carousel-inner" role="listbox">
                                                <div class="item active">
                                                    <div class="ticker-headline">
                                                        <div class="media">
                                                            <span class="pull-left"><i class="fa fa-twitter fa-4x text-azure"></i></span>
                                                            <div class="media-body">
                                                                <div class="h4"><strong>Semantha Schwarz</strong> <small>1 hour ago</small></div>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id quam elementum odio tristique euismod. 
                                                                    Suspendisse id nunc sed massa cursus efficitur. 
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <div class="ticker-headline">
                                                        <div class="media">
                                                            <span class="pull-left"><i class="fa fa-facebook fa-4x text-primary"></i></span>
                                                            <div class="media-body">
                                                                <div class="h4"><strong>Semantha Schwarz</strong> <small>1 hour ago</small></div>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id quam elementum odio tristique euismod. 
                                                                    Suspendisse id nunc sed massa cursus efficitur. Nullam id quam elementum odio tristique euismod. 
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <div class="ticker-headline">
                                                        <div class="media">
                                                            <span class="pull-left"><i class="fa fa-google-plus fa-4x text-danger"></i></span>
                                                            <div class="media-body">
                                                                <div class="h4"><strong>Semantha Schwarz</strong> <small>1 hour ago</small></div>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id quam elementum odio tristique euismod. 
                                                                    Suspendisse id nunc sed massa cursus efficitur. 
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Controls -->
                                            <a class="up carousel-control" href="#carousel-example-vertical" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="down carousel-control" href="#carousel-example-vertical" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel papernote">
                                    <div class="panel-body pad-no">
                                        <div class="carousel slide" id="c-slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="item active">
                                                    <h4>This is my note #1</h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id quam elementum odio tristique euismod. 
                                                        Suspendisse id nunc sed massa cursus efficitur. 
                                                    </p>
                                                </div>
                                                <div class="item">
                                                    <h4>This is my note #2</h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id quam elementum odio tristique euismod. 
                                                        Suspendisse id nunc sed massa cursus efficitur. 
                                                    </p>
                                                </div>
                                                <div class="item">
                                                    <h4>This is my note #3</h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id quam elementum odio tristique euismod. 
                                                        Suspendisse id nunc sed massa cursus efficitur. 
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"> Order List </h3>
                                    </div>
                                    <div class="panel-body">
                                        <!--Default Tabs (Left Aligned)--> 
                                        <!--===================================================-->
                                        <div class="tab-base">
                                            <!--Nav Tabs-->
                                            <ul class="nav nav-tabs">
                                                <li class="active"> <a data-toggle="tab" href="#demo-lft-tab-1"> Top Selling </a> </li>
                                                <li> <a data-toggle="tab" href="#demo-lft-tab-2">Most Viewed</a> </li>
                                                <li> <a data-toggle="tab" href="#demo-lft-tab-3">Recent Orders</a> </li>
                                            </ul>
                                            <!--Tabs Content-->
                                            <div class="tab-content">
                                                <div id="demo-lft-tab-1" class="tab-pane fade active in">
                                                    <!--Hover Rows--> 
                                                    <!--===================================================-->
                                                    <table class="table table-hover table-vcenter">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Project</th>
                                                                <th>Project Deadline</th>
                                                                <th>Status</th>
                                                                <th class="hidden-xs">Clients</th>
                                                                <th class="hidden-xs">Progress</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>IT Help Desk</td>
                                                                <td>11 May 2016</td>
                                                                <td>
                                                                    <div class="label label-table label-info">Block</div>
                                                                </td>
                                                                <td class="hidden-xs">Semantha Armstrong</td>
                                                                <td class="hidden-xs">
                                                                    <div class="progress progress-striped progress-sm">
                                                                        <div class="progress-bar progress-bar-primary" style="width: 25%;"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>Product Dev</td>
                                                                <td>15 May 2016</td>
                                                                <td>
                                                                    <div class="label label-table label-danger">On Hold</div>
                                                                </td>
                                                                <td class="hidden-xs">Jonathan Smith</td>
                                                                <td class="hidden-xs">
                                                                    <div class="progress progress-striped progress-sm">
                                                                        <div class="progress-bar progress-bar-success" style="width: 35%;"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td>Website Redesign</td>
                                                                <td>19 May 2016</td>
                                                                <td>
                                                                    <div class="label label-table label-success">Approved</div>
                                                                </td>
                                                                <td class="hidden-xs">Jacob Armstrong</td>
                                                                <td class="hidden-xs">
                                                                    <div class="progress progress-striped progress-sm">
                                                                        <div class="progress-bar progress-bar-info" style="width: 85%;"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>4</td>
                                                                <td>Local Ad</td>
                                                                <td>25 May 2016</td>
                                                                <td>
                                                                    <div class="label label-table label-warning">Pending</div>
                                                                </td>
                                                                <td class="hidden-xs">Sandra Smith</td>
                                                                <td class="hidden-xs">
                                                                    <div class="progress progress-striped progress-sm">
                                                                        <div class="progress-bar progress-bar-warning" style="width: 45%;"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>5</td>
                                                                <td>Design new theme</td>
                                                                <td>28 May 2016</td>
                                                                <td>
                                                                    <div class="label label-table label-warning">Pending</div>
                                                                </td>
                                                                <td class="hidden-xs">Will DeBrandon</td>
                                                                <td class="hidden-xs">
                                                                    <div class="progress progress-striped progress-sm">
                                                                        <div class="progress-bar progress-bar-danger" style="width: 55%;"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>6</td>
                                                                <td>Mockup Testing</td>
                                                                <td>31 May 2016</td>
                                                                <td>
                                                                    <div class="label label-table label-warning">Pending</div>
                                                                </td>
                                                                <td class="hidden-xs">Alexander Flynn</td>
                                                                <td class="hidden-xs">
                                                                    <div class="progress progress-striped progress-sm">
                                                                        <div class="progress-bar progress-bar-success" style="width: 75%;"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!--===================================================--> 
                                                    <!--End Hover Rows--> 
                                                </div>
                                                <div id="demo-lft-tab-2" class="tab-pane fade">
                                                    <div class="pad-btm form-inline">
                                                        <div class="row">
                                                            <div class="col-sm-6 text-xs-center">
                                                                <div class="form-group">
                                                                    <label class="control-label">Status</label>
                                                                    <select id="demo-foo-filter-status" class="form-control">
                                                                        <option value="">Show all</option>
                                                                        <option value="active">Active</option>
                                                                        <option value="disabled">Disabled</option>
                                                                        <option value="suspended">Suspended</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 text-xs-center text-right">
                                                                <div class="form-group">
                                                                    <input id="demo-foo-search" type="text" placeholder="Search" class="form-control" autocomplete="off">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Foo Table - Filtering -->
                                                    <!--===================================================-->
                                                    <table id="demo-foo-filtering" class="table table-bordered table-hover toggle-circle" data-page-size="7">
                                                        <thead>
                                                            <tr>
                                                                <th data-toggle="true">First Name</th>
                                                                <th class="hidden-xs">Last Name</th>
                                                                <th data-hide="phone, tablet">Job Title</th>
                                                                <th data-hide="phone, tablet" class="hidden-xs">DOB</th>
                                                                <th data-hide="phone, tablet">Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Albert</td>
                                                                <td class="hidden-xs">Desouza</td>
                                                                <td>System Architect</td>
                                                                <td class="hidden-xs">22 Jun 1972</td>
                                                                <td><span class="label label-table label-success">Active</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Teresa </td>
                                                                <td class="hidden-xs">L. Doe</td>
                                                                <td>Pre-Sales Support</td>
                                                                <td class="hidden-xs">3 Oct 1981</td>
                                                                <td><span class="label label-table label-dark">Disabled</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Veronica </td>
                                                                <td class="hidden-xs">Gusikowski</td>
                                                                <td>Civil Engineer/td> 
                                                                <td class="hidden-xs">19 Apr 1969</td>
                                                                <td><span class="label label-table label-danger">Suspended</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Bruce </td>
                                                                <td class="hidden-xs">Rogahn</td>
                                                                <td>CEO</td>
                                                                <td class="hidden-xs">13 Dec 1977</td>
                                                                <td><span class="label label-table label-success">Active</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Semantha</td>
                                                                <td class="hidden-xs">Halladay</td>
                                                                <td>Junior Technical Assistant</td>
                                                                <td class="hidden-xs">30 Dec 1991</td>
                                                                <td><span class="label label-table label-danger">Suspended</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Stevan </td>
                                                                <td class="hidden-xs">Hickle</td>
                                                                <td>Business Services Sales Representative</td>
                                                                <td class="hidden-xs">17 Oct 1987</td>
                                                                <td><span class="label label-table label-dark">Disabled</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Carolina </td>
                                                                <td class="hidden-xs">Hickle</td>
                                                                <td>Business Services Sales Representative</td>
                                                                <td class="hidden-xs">17 Oct 1987</td>
                                                                <td><span class="label label-table label-dark">Disabled</span></td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="5">
                                                                    <div class="text-right">
                                                                        <ul class="pagination"></ul>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    <!--===================================================-->
                                                    <!-- End Foo Table - Filtering -->
                                                </div>
                                                <div id="demo-lft-tab-3" class="tab-pane fade">
                                                    <!--Hover Rows--> 
                                                    <!--===================================================-->
                                                    <table class="table table-hover table-vcenter">
                                                        <thead>
                                                            <tr>
                                                                <th class="hidden-xs">&nbsp;</th>
                                                                <th>Profile</th>
                                                                <th>User ID</th>
                                                                <th class="hidden-xs">Date</th>
                                                                <th>Amount</th>
                                                                <th class="hidden-xs">Email Address</th>
                                                                <th>Status</th>
                                                                <th class="hidden-xs">Download</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="hidden-xs">
                                                                    <div class="checkbox">
                                                                        <label class="form-checkbox form-icon active">
                                                                        <input type="checkbox">
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="media-object center"> <img src="img/av1.png" alt="" class="img-rounded img-sm"> </div>
                                                                </td>
                                                                <td> Semantha Armstrong </td>
                                                                <td class="hidden-xs">3 Jan, 2013</td>
                                                                <td>$239.85</td>
                                                                <td class="hidden-xs">semantha@gmail.com</td>
                                                                <td>
                                                                    <div class="label label-table label-info">Block</div>
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <!--Split Buttons Dropdown--> 
                                                                    <!--===================================================-->
                                                                    <div class="btn-group btn-group-xs">
                                                                        <button class="btn btn-danger">Download</button>
                                                                        <button class="btn btn-danger dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button"> 
                                                                        <i class="dropdown-caret fa fa-caret-down"></i> 
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a href="#">Action</a> </li>
                                                                            <li><a href="#">Another action</a> </li>
                                                                            <li><a href="#">Something else here</a> </li>
                                                                            <li class="divider"></li>
                                                                            <li><a href="#">Separated link</a> </li>
                                                                        </ul>
                                                                    </div>
                                                                    <!--===================================================-->
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="hidden-xs">
                                                                    <div class="checkbox">
                                                                        <label class="form-checkbox form-icon active">
                                                                        <input type="checkbox">
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="media-object center"> <img src="img/av1.png" alt="" class="img-rounded img-sm"> </div>
                                                                </td>
                                                                <td> Jonathan Smith </td>
                                                                <td class="hidden-xs">3 Jan, 2013</td>
                                                                <td>$239.85</td>
                                                                <td class="hidden-xs">jonathan@gmail.com</td>
                                                                <td>
                                                                    <div class="label label-table label-danger">On Hold</div>
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <!--Split Buttons Dropdown--> 
                                                                    <!--===================================================-->
                                                                    <div class="btn-group btn-group-xs">
                                                                        <button class="btn btn-danger">Download</button>
                                                                        <button class="btn btn-danger dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button"> 
                                                                        <i class="dropdown-caret fa fa-caret-down"></i> 
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a href="#">Action</a> </li>
                                                                            <li><a href="#">Another action</a> </li>
                                                                            <li><a href="#">Something else here</a> </li>
                                                                            <li class="divider"></li>
                                                                            <li><a href="#">Separated link</a> </li>
                                                                        </ul>
                                                                    </div>
                                                                    <!--===================================================-->
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="hidden-xs">
                                                                    <div class="checkbox">
                                                                        <label class="form-checkbox form-icon active">
                                                                        <input type="checkbox">
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="media-object center"> <img src="img/av1.png" alt="" class="img-rounded img-sm"> </div>
                                                                </td>
                                                                <td> Jacob Armstrong </td>
                                                                <td class="hidden-xs">3 Jan, 2013</td>
                                                                <td>$1395.85</td>
                                                                <td class="hidden-xs">jacob@gmail.com</td>
                                                                <td>
                                                                    <div class="label label-table label-success">Approved</div>
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <!--Split Buttons Dropdown--> 
                                                                    <!--===================================================-->
                                                                    <div class="btn-group btn-group-xs">
                                                                        <button class="btn btn-danger">Download</button>
                                                                        <button class="btn btn-danger dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button"> 
                                                                        <i class="dropdown-caret fa fa-caret-down"></i> 
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a href="#">Action</a> </li>
                                                                            <li><a href="#">Another action</a> </li>
                                                                            <li><a href="#">Something else here</a> </li>
                                                                            <li class="divider"></li>
                                                                            <li><a href="#">Separated link</a> </li>
                                                                        </ul>
                                                                    </div>
                                                                    <!--===================================================-->
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="hidden-xs">
                                                                    <div class="checkbox">
                                                                        <label class="form-checkbox form-icon active">
                                                                        <input type="checkbox">
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="media-object center"> <img src="img/av1.png" alt="" class="img-rounded img-sm"> </div>
                                                                </td>
                                                                <td> Sandra Smith </td>
                                                                <td class="hidden-xs">3 Jan, 2013</td>
                                                                <td>$125.85</td>
                                                                <td class="hidden-xs">Sandra@gmail.com</td>
                                                                <td>
                                                                    <div class="label label-table label-warning">Pending</div>
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <!--Split Buttons Dropdown--> 
                                                                    <!--===================================================-->
                                                                    <div class="btn-group btn-group-xs">
                                                                        <button class="btn btn-danger">Download</button>
                                                                        <button class="btn btn-danger dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button"> 
                                                                        <i class="dropdown-caret fa fa-caret-down"></i> 
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a href="#">Action</a> </li>
                                                                            <li><a href="#">Another action</a> </li>
                                                                            <li><a href="#">Something else here</a> </li>
                                                                            <li class="divider"></li>
                                                                            <li><a href="#">Separated link</a> </li>
                                                                        </ul>
                                                                    </div>
                                                                    <!--===================================================-->
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="hidden-xs">
                                                                    <div class="checkbox">
                                                                        <label class="form-checkbox form-icon active">
                                                                        <input type="checkbox">
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="media-object center"> <img src="img/av1.png" alt="" class="img-rounded img-sm"> </div>
                                                                </td>
                                                                <td> Sandra </td>
                                                                <td class="hidden-xs">3 Jan, 2013</td>
                                                                <td>$239.85</td>
                                                                <td class="hidden-xs">Sandra@gmail.com</td>
                                                                <td>
                                                                    <div class="label label-table label-warning">Pending</div>
                                                                </td>
                                                                <td class="hidden-xs">
                                                                    <!--Split Buttons Dropdown--> 
                                                                    <!--===================================================-->
                                                                    <div class="btn-group btn-group-xs">
                                                                        <button class="btn btn-danger">Download</button>
                                                                        <button class="btn btn-danger dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button"> 
                                                                        <i class="dropdown-caret fa fa-caret-down"></i> 
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a href="#">Action</a> </li>
                                                                            <li><a href="#">Another action</a> </li>
                                                                            <li><a href="#">Something else here</a> </li>
                                                                            <li class="divider"></li>
                                                                            <li><a href="#">Separated link</a> </li>
                                                                        </ul>
                                                                    </div>
                                                                    <!--===================================================-->
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!--===================================================--> 
                                                    <!--End Hover Rows--> 
                                                </div>
                                            </div>
                                        </div>
                                        <!--===================================================--> 
                                        <!--End Default Tabs (Left Aligned)--> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--===================================================-->
                    <!--End page content-->
                </div>
                <!--===================================================-->
                <!--END CONTENT CONTAINER-->