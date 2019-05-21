<script>
    
				$(function() {

					var trgt = [[1354586000000, 153], [1364587000000, 658], [1374588000000, 198], [1384589000000, 663], [1394590000000, 801], [1404591000000, 1080], [1414592000000, 353], [1424593000000, 749], [1434594000000, 523], [1444595000000, 258], [1454596000000, 688], [1464597000000, 364]], prft = [[1354586000000, 53], [1364587000000, 65], [1374588000000, 98], [1384589000000, 83], [1394590000000, 980], [1404591000000, 808], [1414592000000, 720], [1424593000000, 674], [1434594000000, 23], [1444595000000, 79], [1454596000000, 88], [1464597000000, 36]], sgnups = [[1354586000000, 647], [1364587000000, 435], [1374588000000, 784], [1384589000000, 346], [1394590000000, 487], [1404591000000, 463], [1414592000000, 479], [1424593000000, 236], [1434594000000, 843], [1444595000000, 657], [1454596000000, 241], [1464597000000, 341]], toggles = $("#rev-toggles"), target = $("#flotcontainer");

					var data = [{
						label : "Target Profit",
						data : trgt,
						bars : {
							show : true,
							align : "center",
							barWidth : 30 * 30 * 60 * 1000 * 80
						}
					}, {
						label : "Actual Profit",
						data : prft,
						color : '#3276B1',
						lines : {
							show : true,
							lineWidth : 3
						},
						points : {
							show : true
						}
					}, {
						label : "Actual Signups",
						data : sgnups,
						color : '#71843F',
						lines : {
							show : true,
							lineWidth : 1
						},
						points : {
							show : true
						}
					}]

					var options = {
						grid : {
							hoverable : true
						},
						tooltip : true,
						tooltipOpts : {
							//content: '%x - %y',
							//dateFormat: '%b %y',
							defaultTheme : false
						},
						xaxis : {
							mode : "time"
						},
						yaxes : {
							tickFormatter : function(val, axis) {
								return "$" + val;
							},
							max : 1200
						}

					};

					plot2 = null;

					function plotNow() {
						var d = [];
						toggles.find(':checkbox').each(function() {
							if ($(this).is(':checked')) {
								d.push(data[$(this).attr("name").substr(4, 1)]);
							}
						});
						if (d.length > 0) {
							if (plot2) {
								plot2.setData(d);
								plot2.draw();
							} else {
								plot2 = $.plot(target, d, options);
							}
						}

					};

					toggles.find(':checkbox').on('change', function() {
						plotNow();
					});
					plotNow()

				});
                                
                                function setActiveTab(val){
                                    $.ajax({
                                        type      : 'GET',
                                          url     : '?r=storeoic/default/setActiveTab',
                                          data    : 'sessionID=' + val,
                                          async   : false,
                                          success : function(data) {
                                          }
                                    });
                                }
                                
                                
                                
</script>
                    <!--===================================================-->
                    <div id="page-content">
                        <!--Widget-4 -->
                        <div class="row" id="rowMonitoring">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="fa fa-list-alt"> </i> Daily Monitoring</h3>
                                    </div>
                                    <div class="panel-body modal-content">
                                        <!--Default Tabs (Left Aligned)--> 
                                        <!--===================================================-->
                                        <div class="tab-base">
                                            <!--Nav Tabs-->
                                            <ul class="nav nav-tabs">
                                                <li class="<?php print $_SESSION['Default']['demo-lft-tab-1']; ?>"> <a data-toggle="tab" href="#demo-lft-tab-1" onclick="setActiveTab(1)">Transaction </a> </li>
                                                <li class="<?php print $_SESSION['Default']['demo-lft-tab-2']; ?>"> <a data-toggle="tab" href="#demo-lft-tab-2" onclick="setActiveTab(2)">Machine</a> </li>
                                                <li class="<?php print $_SESSION['Default']['demo-lft-tab-3']; ?>"> <a data-toggle="tab" href="#demo-lft-tab-3" onclick="setActiveTab(3)">Customer </a> </li>
                                            </ul>
                                            <!--Tabs Content-->
                                            <div class="tab-content">
                                                <div id="demo-lft-tab-1" class="tab-pane fade <?php print $_SESSION['Default']['demo-lft-tab-1']; ?>">
                                                    <!--Hover Rows--> 
                                                    <!--===================================================-->
                                                    
                                                    <?php $this->renderPartial('_activeTransactions', array('model'=>$model));?>
                                                    <!--===================================================--> 
                                                    <!--End Hover Rows--> 
                                                </div>
                                                <div id="demo-lft-tab-2" class="tab-pane fade <?php print $_SESSION['Default']['demo-lft-tab-2']; ?>">
<!--                                
                                                    <!-- Foo Table - Filtering -->
                                                    <!--===================================================-->
                                                   
                                                     <?php $this->renderPartial('_activeMachines', array('modelMachine'=>$modelMachine));?>
                                                    <!--===================================================-->
                                                    <!-- End Foo Table - Filtering -->
                                                </div>
                                                <div id="demo-lft-tab-3" class="tab-pane fade <?php print $_SESSION['Default']['demo-lft-tab-3']; ?>">
                                                    <!--Hover Rows--> 
                                                    <!--===================================================-->
                                                  
                                                    <?php $this->renderPartial('_customers', array('modelCustomer'=>$modelCustomer));?>
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
<!--                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"> <?php print date("F");?> revenue (week 1 to 4)</h3>
                                    </div>
                                    <div class="panel-body modal-content">
                                       <div class="col-md-12">
                                        Flot Spline Chart placeholder 
                                         ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
                                        <div id="bar-chart" style="height:275px;"></div>
                                         ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
                                       </div> 

                                    </div>
                                </div>
                            </div>
                           
                        </div>-->
<!--                    <div class="row">
                            
                              <div class="col-md-6">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"> <?php print date('F', strtotime('-2 month'));?> to <?php print date('F');?> Revenue Variance</h3>
                                    </div>
                                    <div class="panel-body modal-content">
                                        Morris Area Chart placeholder
                                         ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
                                      <div class="smart-form" id="rev-toggles">

                                            <div class="inline-group">

                                                    <label for="gra-0" class="checkbox">
                                                            <input type="checkbox" name="gra-0" id="gra-0" checked="checked">
                                                            <i></i> Target </label>
                                                    <label for="gra-1" class="checkbox">
                                                            <input type="checkbox" name="gra-1" id="gra-1" checked="checked">
                                                            <i></i> Actual </label>
                                                    <label for="gra-2" class="checkbox">
                                                            <input type="checkbox" name="gra-2" id="gra-2" checked="checked">
                                                            <i></i> Variance </label>
                                            </div>


                                    </div>

                                    <div class="padding-10">
                                            <div id="flotcontainer" class="chart-large has-legend-unique" style="height:255px;"></div>
                                    </div>
                                         ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
                                    </div>
                                </div>
                            </div>
                              <div class="col-md-6">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"> <?php print date('F');?> Revenue (week 2& 3) </h3>
                                    </div>
                                    <div class="panel-body modal-content">
                                        Morris Area Chart placeholder
                                         ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
                                        <div id="site-stats" class="chart has-legend" style="height:275px;"></div>
                                         ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
                                    </div>
                                </div>
                            </div>
                        </div><br />-->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="panel">
                                     <div class="panel-heading">
                                        <h3 class="panel-title">Sales Chart</h3>
                                    </div>
                                    <div class="panel-body modal-content" >
                                        <div id="rowSalesChart">
                                            <ul class="nav nav-section nav-justified" >
                                               <li>
                                                  <div class="section"> 
                                                      <h4 class="nm"> &#x20B1; <?php print Settings::setNumberFormat(CustomerTransactions::sql_getTotalAmountConsumedbyDate(Settings::get_firstDayOfTheMonth(), Settings::get_Date()), 2);?> </h4>
                                                     <p class="text-muted">Total Sales this month</p>
                                                  </div>
                                               </li>
                                               <li>
                                                  <div class="section"> 
                                                    <h4 class="nm">&#x20B1; <?php print Settings::setNumberFormat(CustomerTransactions::sql_getTotalAmountConsumedbyDate(Settings::get_firstDayOfTheWeek(), Settings::get_Date()), 2);?> </h4>
                                                     <p class="text-muted">Total Sales this week</p>
                                                  </div>
                                               </li>
                                               <li>
                                                  <div class="section"> 
                                                    <h4 class="nm"> &#x20B1; <?php print Settings::setNumberFormat(CustomerTransactions::sql_getTotalAmountConsumedbyDate(Settings::get_Date(), Settings::get_Date()), 2);?> </h4>
                                                     <p class="text-muted">Total Sales today</p>
                                                  </div>
                                               </li>
                                            </ul>
                                            </div>
                                        <!--Flot Area Chart placeholder-->
                                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
                                        <div id="saleschart" style="height:265px"></div>
                                        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel">
                                <div class="panel papernote" >
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Promos</h3>
                                    </div>
                                    <div class="panel-body modal-content" style="height:150px">
                                        <div id="carousel-example-vertical" class="carousel vertical slide" data-ride="carousel">
                                            <div class="carousel-inner" role="listbox">
                                                <div class="item active">
                                                    <div class="ticker-headline">
                                                        <div class="media">
                                                            <span class="pull-left"><i class="fa fa-cart-plus fa-4x text-azure"></i></span>
                                                            <div class="media-body">
                                                                <div class="h4"><strong>Promos of the Month #1</strong> <small></small></div>
                                                                <p>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <div class="ticker-headline">
                                                        <div class="media">
                                                            <span class="pull-left"><i class="fa fa-money fa-4x text-primary"></i></span>
                                                            <div class="media-body">
                                                                <div class="h4"><strong>Promos of the Month #2</strong> <small></small></div>
                                                                <p></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <div class="ticker-headline">
                                                        <div class="media">
                                                            <span class="pull-left"><i class="fa fa-shopping-basket fa-4x text-danger"></i></span>
                                                            <div class="media-body">
                                                                <div class="h4"><strong>Promos of the Month #3</strong> <small></small></div>
                                                                <p></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Controls -->
                                            <a class="up carousel-control" href="#carousel-example-vertical" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-up" style="display: none;"  aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="down carousel-control"  href="#carousel-example-vertical" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-down" style="display: none;" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel papernote">
                                    
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Notes</h3>
                                    </div>
                                    <div class="panel-body pad-no modal-content"  style="height:150px">
                                        <div class="carousel slide" id="c-slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="item active">
                                                   <div class="h4"><strong>Notes of the Week #1</strong> <small></small></div>
                                                    <p  </p>
                                                </div>
                                                <div class="item">
                                                   <div class="h4"><strong>Notes of the Week #2</strong> <small></small></div>
                                                    <p>  </p>
                                                </div>
                                                <div class="item">
                                                   
                                                   <div class="h4"><strong>Notes of the Week #3</strong> <small></small></div>
                                                    <p></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     
                    </div>
                    <!--===================================================-->
                    <!--End page content-->
                </div>
                <!--===================================================-->
