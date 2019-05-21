<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/chartjs/chart.bundle.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/plugin/chartjs/utils.js"></script>
<script src="<?php print Settings::get_baseUrl(); ?>/smartadmin/js/tilt.jquery.js"></script>
<style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    @-webkit-keyframes animate-width {
        0% {
            width: 0;
        }
        100% {
            visibility: visible;
        }
    }
    @-moz-keyframes animate-width {
        0% {
            width: 0;
        }
        100% {
            visibility: visible;
        }
    }
    @keyframes animate-width {
        0% {
            width: 0;
        }
        100% {
            visibility: visible;
        }
    }
    @-webkit-keyframes animate-height {
        0% {
            height: 0;
        }
        100% {
            visibility: visible;
        }
    }
    @-moz-keyframes animate-height {
        0% {
            height: 0;
        }
        100% {
            visibility: visible;
        }
    }
    @keyframes animate-height {
        0% {
            height: 0;
        }
        100% {
            visibility: visible;
        }
    }

    .stat-levels {
        max-width: 100%;
        padding: 25px;
        padding-top: 0;
    }

    .stat-bar {
        background-color: #bbb;
        height: 20px;
        border-radius: 15px;
        margin-bottom: 5px;
        margin-left: 0;
    }
    .stat-bar:last-child {
        margin-bottom: 0;
    }

    .stat-bar-rating {
        border-radius: 4px;
        float: left;
        width: 0;
        height: 100%;
        text-align: center;
    }

    .stat-bar-rating {
        -webkit-animation-fill-mode: forwards;    background: linear-gradient(-45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
        -webkit-background-size: 40px 40px;
        background-size: 40px 40px;
    }

    .stat-bar-rating {
        visibility: hidden;
        width: 0;
        -webkit-animation: animate-width;
        -moz-animation: animate-width;
        animation: animate-width;
        animation-timing-function: cubic-bezier(0.35, 0.95, 0.67, 0.99);
        -webkit-animation-timing-function: cubic-bezier(0.35, 0.95, 0.67, 0.99);
        -moz-animation-timing-function: cubic-bezier(0.35, 0.95, 0.67, 0.99);
        animation-duration: 0.5s;
        -webkit-animation-duration: 0.5s;
        -moz-animation-duration: 0.5s;
        animation-fill-mode: forwards;
    }

    .stat-bar .stat-bar-rating {
        -webkit-animation-delay: 0s;
        border-radius: 20px;
        color: #fff;
        font-weight: bold;
        -webkit-animation-fill-mode: forwards;    background: linear-gradient(-45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
        -webkit-background-size: 40px 40px;
        background-size: 40px 40px;
    }

    #progress-one {
        background-color: #3FB8AE;
        border: 1px solid #777777;
    }
    #progress-two {
        background-color: #DC4646;
        border: 1px solid #777777;

    }
    #progress-three {
        background-color: #D4DF5A;
        border: 1px solid #777777;

    }
    #progress-four {
        background-color: #ffcd56;
        border: 1px solid #777777;

    }
    #progress-five {
        background-color: #736876;
        border: 1px solid #777777;

    }
</style>
<div class ="col-lg-12 no-padding">
    <div class ="col-lg-8 col-md-12">
        <div class ="chart-dashboard-1">
            <p class ="dashboard-text-1">
                <i class ="entypo-icon-thumbs-up"></i>
                Top Progressive Management ***&nbsp;From 2018 - 2019 
            </p>
            <div class="stat-levels"  width="undefined" height="90%">
                <i class ="silk-icon-star"></i>
                Sales Management 95%
                <div class="stat-1 stat-bar">
                    <span id ="progress-one" class="stat-bar-rating" role="stat-bar" style="width: 95%;"></span>
                </div>
                <i class ="silk-icon-star"></i>
                Operational Management 83%
                <div class="stat-2 stat-bar">
                    <span id ="progress-two" class="stat-bar-rating" role="stat-bar" style="width: 83%;"></span>
                </div>
                <i class ="silk-icon-star"></i>
                Production Management 77%
                <div class="stat-3 stat-bar">
                    <span id ="progress-three" class="stat-bar-rating" role="stat-bar" style="width: 77%;"></span>
                </div>
                <i class ="silk-icon-star"></i>
                Employee Management 56%
                <div class="stat-4 stat-bar">
                    <span id ="progress-four" class="stat-bar-rating" role="stat-bar" style="width: 56%;"></span>
                </div>
                <i class ="silk-icon-star"></i>
                Customer Management 30%
                <div class="stat-5 stat-bar">
                    <span id ="progress-five" class="stat-bar-rating" role="stat-bar" style="width: 30%;"></span>
                </div>
            </div>
        </div>
    </div>
    <div class ="col-lg-4 col-md-12">
        <div class ="What-you-have-today">
            <div class ="What-you-have-today-text">
                <strong>What you have today ?</strong>
            </div>
            <div class ="border-bottom">
                <div class ="brocco-icon-file"></div>
                <b> ---- </b> 
                <span>Verbal Sales Order</span>
                <?php
                if (Settings::get_Role() == Roles::ROLE_ADMINISTRATOR) {
                    print CHtml::link('GO', $this->createUrl('customerSalesOrderHeaders/admin'), array('class' => 'btn btn-sm btn-warning', 'target' => '_blank'));
                } else {
                    
                }
                ?>
            </div>
            <div class ="border-bottom">
                <div class ="icomoon-icon-basket"></div>
                <b> ---- </b> 
                <span>View Open Job Order</span>
                <?php
                if (Settings::get_Role() == Roles::ROLE_ADMINISTRATOR) {
                    print CHtml::link('GO', $this->createUrl('CustomerJobOrderHeaders/admin'), array('class' => 'btn btn-sm btn-danger', 'target' => '_blank'));
                } else {
                    
                }
                ?>
            </div>
            <div class ="border-bottom">
                <div class ="brocco-icon-target-3"></div>
                <b> ---- </b> 
                <span>Monitor Employees</span>
                <?php
                if (Settings::get_Role() == Roles::ROLE_ADMINISTRATOR) {
                    print CHtml::link('GO', $this->createUrl('employees/admin'), array('class' => 'btn btn-sm btn-primary', 'target' => '_blank'));
                } else {
                    
                }
                ?>
            </div>
            <div class ="border-bottom">
                <div class ="entypo-icon-users"></div>
                <b> ---- </b> 
                <span>Manage Customers</span>
                <?php
                if (Settings::get_Role() == Roles::ROLE_ADMINISTRATOR) {
                    print CHtml::link('GO', $this->createUrl('customers/admin'), array('class' => 'btn btn-sm btn-success', 'target' => '_blank'));
                } else {
                    
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class ="col-lg-12 no-padding">

    <div id="bar" class = "col-lg-8 col-md-12">
        <div class ="chart-dashboard-2">
            <p class ="dashboard-text-2">
                <i class ="entypo-icon-thumbs-up"></i>
                Top Progressive Employees    ***From 2018 - 2019 
            </p>
            <canvas id="chartjs-1" class="chartjs" width="undefined" height="90%"></canvas>
        </div>
    </div>
    <div class ="col-lg-4 col-md-12">
        <div class ="What-you-have-today">
            <div class ="What-you-have-today-text">
                <strong>Top Performing Clients As of This Month</strong>
            </div>
            <div class ="dashboard-number">
                <c class ="number1">1</c>
                <span>Jackson Javier  </span>
                <b> ₱ 3,000,000.00 </b> 
            </div>
            <div class ="dashboard-number">
                <c class ="number2">2</c>
                <span>Paolo Balona</span>
                <b> ₱ 2,700,000.00 </b> 
            </div>
            <div class ="dashboard-number">
                <c class ="number3">3</c>
                <span>‎Jao Magdaluyo</span>
                <b> ₱ 2,300,000.00 </b> 
            </div>
            <div class ="dashboard-number">
                <c class ="number4">4</c>
                <span>‎Mark Anthony Naval‎ </span>
                <b> ₱ 2,000,000.00 </b> 
            </div>
            <div class ="dashboard-number">
                <c class ="number5">5</c>
                <span>Diane Francesca</span>
                <b> ₱ 1,950,000.00 </b> 
            </div>
            <div class ="What-you-have-today-text">
                <strong>Top Employees Attendance As of This Month</strong>
            </div>
            <div class ="dashboard-number">
                <c class ="number1">1</c>
                <span>Ronnie Cruz  </span>
                <b>100 % on time</b> 
            </div>
            <div class ="dashboard-number">
                <c class ="number2">2</c>
                <span>Chester Tan</span>
                <b>99.7 % on time</b> 
            </div>
            <div class ="dashboard-number">
                <c class ="number3">3</c>
                <span>Christine Quimbao</span>
                <b>98.5 % on time</b> 
            </div>
            <div class ="dashboard-number">
                <c class ="number4">4</c>
                <span>Michael Go</span>
                <b>98.2 % on time</b> 
            </div>
            <div class ="dashboard-number">
                <c class ="number5">5</c>
                <span>John Xenon</span>
                <b>97.9 % on time</b> 
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('progress').each(function () {
            var max = $(this).val();
            $(this).val(0).animate({value: max}, {duration: 2000, easing: 'easeOutCirc'});
        });
    });
</script>
<!-- Bar Chart -->
<script>
    new Chart(document.getElementById("chartjs-1"),
            {
                "type": "bar",
                "data": {
                    "labels": ["Ronnie Cruz", "Chester Tan", "Annabelle", "Christine Quimbao", "Michael Go", "John Xenon", "Ricky Rumbawa"],
                    "datasets": [{
                            "label": "My First Dataset", "data": [30, 59, 80, 95, 40, 67, 23],
                            "fill": false,
                            "fontFamily": "'Century Gothic', sans-serif",
                            "borderColor": ["#ff6384", "#ff9f40", "#ffcd56", "#4bc0c0", "#36a2eb", "#9966ff", "#c9cbcf"],
                            "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"],
                            "borderWidth": 1
                        }]},
                "options": {
                    "scales": {"yAxes": [{"ticks": {
                                    "beginAtZero": true,
                                    fontFamily: "'Century Gothic', sans-serif"
                                }}]},
                    legend: {
                        display: false
                    },
                    tooltips: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return tooltipItem.yLabel;
                            }
                        }
                    }
                }
            });
</script>
<script>
    $(function () {
        $(".What-you-have-today").hide();
        $(".What-you-have-today").fadeIn(1000).show();
    });
</script>