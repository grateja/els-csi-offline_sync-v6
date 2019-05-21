<header id="header">

    <div id="logo-group">
        <span id="logo"> <img src="<?php print Settings::get_baseUrl(); ?>/smartadmin/img/logo.png" alt="SmartAdmin"> </span>
    </div>

</header>

<div id="main" role="main">

    <!-- MAIN CONTENT -->
    <div id="content" class="container">

        <div class="row">
            <h1 class="txt-color-red login-header-big"><?php print Settings::model_getValue_byID(1)->value ?></h1>
            <div class="hero">
                <div class="pull-left login-desc-box-l" style="width: 90%;">
                    <h4 class="paragraph-header">Educational Level Selection</h4>
                    <?php
                    //echo CHtml::imageButton('images/nursery.png',array('index','width'=>'150px','height'=>'150px'));
                    print CHtml::link(CHtml::image('images/nursery.png', NULL, array('index', 'width' => '150px', 'height' => '150px')), $this->createUrl('site/select', array('id' => EducationalLevels::LEVEL_PRESCHOOL)));
                    ?>    
                    &nbsp;&nbsp;&nbsp;
                    <?php
                    //echo CHtml::imageButton('images/grade_school.png',array('index','width'=>'150px','height'=>'150px'));
                    print CHtml::link(CHtml::image('images/grade_school.png', NULL, array('index', 'width' => '150px', 'height' => '150px')), $this->createUrl('site/select', array('id' => EducationalLevels::LEVEL_ELEMENTARY)));
                    ?>
                    &nbsp;&nbsp;&nbsp;
                    <?php
                    //echo CHtml::imageButton('images/high_school.png',array('index','width'=>'150px','height'=>'150px'));
                    print CHtml::link(CHtml::image('images/high_school.png', NULL, array('index', 'width' => '150px', 'height' => '150px')), $this->createUrl('site/select', array('id' => EducationalLevels::LEVEL_HIGHSCHOOL)));
                    ?>
                    &nbsp;&nbsp;&nbsp;
                    <?php
                    //echo CHtml::imageButton('images/college.png',array('index','width'=>'150px','height'=>'150px'));
                    print CHtml::link(CHtml::image('images/college.png', NULL, array('index', 'width' => '150px', 'height' => '150px')), $this->createUrl('site/select', array('id' => EducationalLevels::LEVEL_COLLEGE)));
                    ?>                                                                
                </div>                        
            </div>





            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
                <!--<form action="#" id="login-form" class="smart-form client-form">-->


                <!--</form>-->



                <!--h5 class="text-center"> - Or sign in using -</h5>
                                                                                        
                        <ul class="list-inline text-center">
                                <li>
                                        <a href="javascript:void(0);" class="btn btn-primary btn-circle"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                        <a href="javascript:void(0);" class="btn btn-info btn-circle"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                        <a href="javascript:void(0);" class="btn btn-warning btn-circle"><i class="fa fa-linkedin"></i></a>
                                </li>
                        </ul-->

            </div>
        </div>
    </div>

</div>