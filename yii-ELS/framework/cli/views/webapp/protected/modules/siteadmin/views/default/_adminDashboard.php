<div class ="col-md-12">
    <div class = "col-md-8">
        <!-- Margin Left Section -->
        <section id = "marginLeft">
            <!-- Progress Bar Section -->
            <div class = "col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="entypo-icon-thumbs-up"></span>
                        <span><strong>Top Progressive Management</strong><sup>&nbsp;&nbsp;&nbsp;&nbsp;***From 2016 - 2017</sup></span>             
                        <div class="list-inline panel-actions">
                            <li><a id="panel-fullscreen1" role="button" title="Toggle fullscreen"><i class="glyphicon glyphicon-resize-full"></i></a></li>
                        </div>
                    </div>
                    <div class = "box">
                        <div id="myProgress1" style="background: #e1e1e1; border-radius: 20px; margin-left:7px; margin-right:7px;">
                            <div id="myBar1" class = "progress-bar-striped">Process Management 93%</div>
                        </div>
                        <div id="myProgress2" style="background: #e1e1e1; border-radius: 20px; margin-left:7px; margin-right:7px;">
                            <div id="myBar2" class = "progress-bar-striped">Sales Management 81%</div>
                        </div>
                        <div id="myProgress3" style="background: #e1e1e1; border-radius: 20px; margin-left:7px; margin-right:7px;">
                            <div id="myBar3" class = "progress-bar-striped">Record Management 68%</div>
                        </div>
                        <div id="myProgress4" style="background: #e1e1e1; border-radius: 20px; margin-left:7px; margin-right:7px;">
                            <div id="myBar4" class = "progress-bar-striped">Human Management 52%</div>
                        </div>
                    </div>
                </div>
            </div><!-- End Progress Bar Section -->

            <!-- Bar Graph Section -->
            <div class = "col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class = "icomoon-icon-bars"></span>
                        <span><strong>Weekly Graphs Status for each Client </strong><sup>&nbsp;&nbsp;&nbsp;&nbsp;***From Month of January to July</sup></span>
                        <div class="list-inline panel-actions">
                            <li><a id="panel-fullscreen2" role="button" title="Toggle fullscreen"><i class="glyphicon glyphicon-resize-full"></i></a></li>
                        </div>
                    </div>
                    <div class ="box">
                        <canvas id="barChart" style="margin:0 auto; margin-left:4px;" height="80"></canvas>
                    </div>
                </div>
            </div><!-- End Bar Graph Section -->

            <!-- Line Graph Section -->
            <div class = "col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class = "icomoon-icon-stats-up"></span>
                        <span><strong>Monthly Sales Graph Status for each Client</strong><sup>&nbsp;&nbsp;&nbsp;&nbsp;***From Month of January to July</sup></span>
                        <div class="list-inline panel-actions">
                            <li><a id="panel-fullscreen3" role="button" title="Toggle fullscreen"><i class="glyphicon glyphicon-resize-full"></i></a></li>
                        </div>
                    </div>
                    <div class="box">
                        <canvas id="lineChart"style="margin:0 auto; margin-left:4px;" height="80"></canvas>
                    </div>
                </div>
            </div><!-- End Line Graph Section -->

        </section><!-- End Margin Left Section -->
    </div><!-- End col 8 Section -->

    <div class = "col-sm-4">
        <!-- Margin Right Section -->
        <section id = "marginRight">
            <div class = "col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class = "entypo-icon-users">
                            <span><strong>Tranzend Developer Team</strong><sup> *** 2017</sup></span></span>
                        <div class="list-inline panel-actions">
                            <li><a id="panel-fullscreen4" role="button" title="Toggle fullscreen"><i class="glyphicon glyphicon-resize-full"></i></a></li>
                        </div>
                    </div>
                    <div class ="box2">
                        <br/><span><img src = "smartadmin/css/patterns/b1.png"/>
                            <b>Consultant</b> -- Senior Developer</span><br/>
                        <span><img src = "smartadmin/css/patterns/b2.png"/>
                            <b>Team Leader</b> -- Senior Developer</span><br/>
                        <span><img src = "smartadmin/css/patterns/b3.png"/>
                            <b>Junior</b> -- Software Developer</span><br/>
                        <span><img src = "smartadmin/css/patterns/b4.png"/>    
                            <b>Junior</b> -- Software Developer</span><br/>
                        <span><img src = "smartadmin/css/patterns/b5.png"/>    
                            <b>Junior</b> -- Software Developer</span><br/>
                        <span><img src = "smartadmin/css/patterns/g1.png"/>
                            <b>Quality</b> -- Assurance</span><br/><br/>
                    </div>
                </div>
            </div>

            <div class = "col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class = "brocco-icon-chart"></span>
                        <span><strong>Customer Vs. Supplier</strong><sup> *** 2016 - 2017</sup></span>
                        <div class="list-inline panel-actions">
                            <li><a id="panel-fullscreen5" role="button" title="Toggle fullscreen"><i class="glyphicon glyphicon-resize-full"></i></a></li>
                        </div>
                    </div>
                    <div class ="box4">
                        <canvas id="areaChart" height="235"></canvas>
                    </div>
                </div>
            </div>      
        </section>
    </div><!-- End col 4 Section -->

</div>
<script type="text/javascript">
    $(document).ready(function () {
        //Toggle fullscreen
        $("#panel-fullscreen1").click(function (e) {
            e.preventDefault();

            var $this = $(this);

            if ($this.children('i').hasClass('glyphicon-resize-full'))
            {
                $this.children('i').removeClass('glyphicon-resize-full');
                $this.children('i').addClass('glyphicon-resize-small');
                $this.attr('title', 'Minimize');
            } else if ($this.children('i').hasClass('glyphicon-resize-small'))
            {
                $this.children('i').removeClass('glyphicon-resize-small');
                $this.children('i').addClass('glyphicon-resize-full');
            }
            $(this).closest('.panel').toggleClass('panel-fullscreen');
        });
    });

    $(document).ready(function () {
        //Toggle fullscreen
        $("#panel-fullscreen2").click(function (e) {
            e.preventDefault();

            var $this = $(this);

            if ($this.children('i').hasClass('glyphicon-resize-full'))
            {
                $this.children('i').removeClass('glyphicon-resize-full');
                $this.children('i').addClass('glyphicon-resize-small');
                $this.attr('title', 'Minimize');

            } else if ($this.children('i').hasClass('glyphicon-resize-small'))
            {
                $this.children('i').removeClass('glyphicon-resize-small');
                $this.children('i').addClass('glyphicon-resize-full');
            }
            $(this).closest('.panel').toggleClass('panel-fullscreen');
        });
    });


    $(document).ready(function () {
        //Toggle fullscreen
        $("#panel-fullscreen3").click(function (e) {
            e.preventDefault();

            var $this = $(this);

            if ($this.children('i').hasClass('glyphicon-resize-full'))
            {
                $this.children('i').removeClass('glyphicon-resize-full');
                $this.children('i').addClass('glyphicon-resize-small');
                $this.attr('title', 'Minimize');
            } else if ($this.children('i').hasClass('glyphicon-resize-small'))
            {
                $this.children('i').removeClass('glyphicon-resize-small');
                $this.children('i').addClass('glyphicon-resize-full');
            }
            $(this).closest('.panel').toggleClass('panel-fullscreen');
        });
    });

    $(document).ready(function () {
        //Toggle fullscreen
        $("#panel-fullscreen4").click(function (e) {
            e.preventDefault();

            var $this = $(this);

            if ($this.children('i').hasClass('glyphicon-resize-full'))
            {
                $this.children('i').removeClass('glyphicon-resize-full');
                $this.children('i').addClass('glyphicon-resize-small');
                $this.attr('title', 'Minimize');
            } else if ($this.children('i').hasClass('glyphicon-resize-small'))
            {
                $this.children('i').removeClass('glyphicon-resize-small');
                $this.children('i').addClass('glyphicon-resize-full');
            }
            $(this).closest('.panel').toggleClass('panel-fullscreen');
        });
    });

    $(document).ready(function () {
        //Toggle fullscreen
        $("#panel-fullscreen5").click(function (e) {
            e.preventDefault();

            var $this = $(this);

            if ($this.children('i').hasClass('glyphicon-resize-full'))
            {
                $this.children('i').removeClass('glyphicon-resize-full');
                $this.children('i').addClass('glyphicon-resize-small');
                $this.attr('title', 'Minimize');
            } else if ($this.children('i').hasClass('glyphicon-resize-small'))
            {
                $this.children('i').removeClass('glyphicon-resize-small');
                $this.children('i').addClass('glyphicon-resize-full');
            }
            $(this).closest('.panel').toggleClass('panel-fullscreen');
        });
    });

    $(document).ready(function () {
        pageSetUp();
        // pagefunction
        var pagefunction = function () {
            // -------- BAR CHART FUNCTION START HERE ------- //           
            var barOptions = {
                scaleBeginAtZero: true,
                scaleShowGridLines: true,
                barShowStroke: true,
                responsive: true
            };
            var barData = {
                labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
                datasets: [
                    {
                        label: "Pending",
                        backgroundColor: "#f0ad4e",
                        data: [45, 60, 40, 80, 54, 30, 45]
                    },
                    {
                        label: "In Progress",
                        backgroundColor: "#149bdf",
                        data: [28, 38, 68, 47, 62, 70, 30]
                    },
                    {
                        label: "Finished",
                        backgroundColor: "#0bc433",
                        data: [34, 70, 80, 40, 38, 90, 61]
                    }
                ]
            };

            // To load bar chart function
            var ctx = document.getElementById("barChart").getContext("2d");
            Chart.Bar(ctx, {
                data: barData,
                options: barOptions
            });

            // -------- ENF OF BAR CHART FUNCTION --------- //

            // Lines Chart Start Here
            var lineOptions = {
                scaleShowGridLines: true,
                bezierCurve: true,
                pointDot: true,
                datasetStroke: true,
                datasetFill: true,
                responsive: true
            };

            var lineData = {labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "Pending",
                        backgroundColor: "#f0ad4e",
                        data: [12, 23, 32, 20, 15, 34, 20]
                    },
                    {
                        label: "In Progress",
                        backgroundColor: "#149bdf",
                        data: [28, 48, 40, 19, 86, 27, 90]
                    },
                    {
                        label: "Finished",
                        backgroundColor: "#0bc433",
                        data: [38, 78, 10, 50, 25, 77, 60]
                    }
                ]
            };

            // render chart
            var ctx = document.getElementById("lineChart").getContext("2d");
            Chart.Line(ctx, {
                data: lineData,
                options: lineOptions
            });

            // ------- AREA CHART START HERE -------
            var randomScalingFactor = function () {
                return Math.round(Math.random() * 100);
            };
            var areaOptions = {
                type: 'doughnut',
                data: {
                    datasets: [{
                            data: [
                                randomScalingFactor(),
                                randomScalingFactor()
                            ],
                            backgroundColor: [
                                window.chartColors.red,
                                window.chartColors.blue
                            ],
                            label: 'Dataset 1'
                        }],
                    labels: [
                        "Customer %",
                        "Supplier %"
                    ]
                },
                options: {
                    responsive: true,
                    legend: {
                        position: 'top'
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            };

            window.onload = function () {
                var ctx = document.getElementById("areaChart").getContext("2d");
                window.myDoughnut = new Chart(ctx, areaOptions);
            };


        }; // ---- END OF PAGE FUNCTION ---- //

        loadScript("<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/chartjs/chart.min.js", pagefunction);
    });

</script>

