<?php $this->renderPartial('../layouts/js/_regionsToBarangays'); ?>
<?php
/*
  $form=$this->beginWidget('CActiveForm', array(
  'id'=>'students-form',
  'enableAjaxValidation'=>false,
  ));
 */
?>
<!-- widget div-->
<div>

    <!-- widget edit box -->
    <div class="jarviswidget-editbox">
        <!-- This area used as dropdown edit box -->

    </div>
    <!-- end widget edit box -->

    <!-- widget content -->
    <div class="widget-body no-padding">

        <!--<form class="smart-form">-->
        <?php // print CHtml::beginForm('','POST', array('class'=>'smart-form'));?>
        <?php $this->widget('Flashes'); ?>

        <fieldset>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'grade_level_id'); ?>
                </label>
                <label class="input">
                    <?php echo CHtml::activeDropDownList($model, 'grade_level_id', CHtml::listData(GradeLevels::model_getAllData_byActive(Utilities::YES), 'id', 'name'), array('prompt' => '-- select --', 'class' => 'form-control')); ?>
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'firstname'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeTextField($model, 'firstname', array('size' => 60, 'maxlength' => 255)); ?>
                    <b class="tooltip tooltip-top-left">
                        Student Firstname
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'middlename'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeTextField($model, 'middlename', array('size' => 60, 'maxlength' => 255)); ?>
                    <b class="tooltip tooltip-top-left">
                        Student Middlename
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'lastname'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeTextField($model, 'lastname', array('size' => 60, 'maxlength' => 255)); ?>
                    <b class="tooltip tooltip-top-left">
                        Student Lastname
                    </b> 
                </label>
            </section>

            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'email'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeTextField($model, 'email', array('size' => 60, 'maxlength' => 255)); ?>
                    <b class="tooltip tooltip-top-left">
                        Student Email
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'mobile'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeTextField($model, 'mobile', array('size' => 11, 'maxlength' => 11)); ?>
                    <b class="tooltip tooltip-top-left">
                        ex: 09171234567
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'phone'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeTextField($model, 'phone', array('size' => 20, 'maxlength' => 20)); ?>
                    <b class="tooltip tooltip-top-left">
                        ex: 6329091234
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'birthdate'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php print $this->renderPartial('../layouts/jui/_juiModelDatePicker', array('model' => $model, 'attribute' => 'birthdate')); ?>
                    <b class="tooltip tooltip-top-left">
                        ex: 1998-05-27 
                    </b>                                             
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'birthplace'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeTextField($model, 'birthplace', array('size' => 60, 'maxlength' => 255)); ?>
                    <b class="tooltip tooltip-top-left">
                        Birth Place
                    </b> 
                </label>
            </section>

            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'civil_status_id'); ?>
                </label>
                <label class="input">
                    <?php echo CHtml::activeDropDownList($model, 'civil_status_id', CHtml::listData(CivilStatus::model_getData_byIsDeleted(Utilities::NO), 'id', 'name'), array('prompt' => '-- select --', 'class' => 'form-control')); ?>
                </label>
            </section>
            <fieldset style=" border: #000;border-width: medium;"><span style="font-weight: bold">Present Address</span>
                <section>
                    <label>
                        <?php echo CHtml::activeLabelEx($model, 'address1'); ?>
                    </label>
                    <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                        <?php echo CHtml::activeTextField($model, 'address1', array('size' => 60, 'maxlength' => 255)); ?>
                        <b class="tooltip tooltip-top-left">
                            Student Address1
                        </b> 
                    </label>
                </section>
                <section>
                    <label>
                        <?php echo CHtml::activeLabelEx($model, 'address2'); ?>
                    </label>
                    <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                        <?php echo CHtml::activeTextField($model, 'address2', array('size' => 60, 'maxlength' => 255)); ?>
                        <b class="tooltip tooltip-top-left">
                            Student Address2
                        </b> 
                    </label>
                </section>
                <section>
                    <label>
                        <?php echo CHtml::activeLabelEx($model, 'region_id'); ?>
                    </label>
                    <label class="input">
                        <?php
                        echo CHtml::activeDropDownList($model, 'region_id', CHtml::listData(Regions::model_getData_byIsDeleted(Utilities::NO), 'id', 'name'), array(
                            'prompt' => '-- select --', 'id' => 'cboRegion', 'onchange' => 'findProvince();', 'class' => 'form-control')
                        );
                        ?>
                        <?php print CHtml::image(Yii::app()->baseUrl . '/images/ajax-loader1.gif', NULL, array('id' => 'loaderProvince', 'class' => 'displayNo')); ?>
                    </label>
                </section>
                <section>
                    <label>
                        <?php echo CHtml::activeLabelEx($model, 'province_id'); ?>
                    </label>
                    <label class="input">
                        <?php
                        if ($model->region_id != 0)
                            $byRegionID = $model->region_id;
                        else
                            $byRegionID = Utilities::NO;

                        if ($model->province_id == '' || $model->province_id == 0) {
                            $disabled = true;
                        } else {
                            $disabled = false;
                        }
                        ?>
                        <?php
                        echo CHtml::activeDropDownList($model, 'province_id', CHtml::listData(Provinces::model_getAllData_byRegionID($byRegionID), 'id', 'name'), array(
                            'empty' => '-- select --', 'id' => 'cboProvince', 'onchange' => 'findCity();', 'class' => 'form-control', 'disabled' => $disabled)
                        );
                        ?>
                        <?php print CHtml::image(Yii::app()->baseUrl . '/images/ajax-loader1.gif', NULL, array('id' => 'loaderMunicipality', 'class' => 'displayNo')); ?>
                    </label>
                </section>                                
                <section>
                    <label>
                        <?php echo CHtml::activeLabelEx($model, 'municipality_id'); ?>
                    </label>
                    <label class="input">
                        <?php
                        if ($model->province_id != 0)
                            $byProvinceID = $model->province_id;
                        else
                            $byProvinceID = -1;


                        if ($model->municipality_id == '' || $model->municipality_id == 0) {
                            $disabled = true;
                        } else {
                            $disabled = false;
                        }
                        ?>

                        <?php
                        echo CHtml::activeDropDownList($model, 'municipality_id', CHtml::listData(Municipalities::model_getAllData_byProvinceID($byProvinceID), 'id', 'name'), array(
                            'prompt' => '-- select --', 'id' => 'cboCity', 'onchange' => 'findBarangay();', 'class' => 'form-control', 'disabled' => $disabled)
                        );
                        ?>
                        <?php print CHtml::image(Yii::app()->baseUrl . '/images/ajax-loader1.gif', NULL, array('id' => 'loaderBarangay', 'class' => 'displayNo')); ?>
                    </label>
                </section>
                <section>
                    <label>
                        <?php echo CHtml::activeLabelEx($model, 'barangay_id'); ?>
                    </label>
                    <label class="input">
                        <?php
                        if ($model->municipality_id != 0)
                            $byCityID = $model->municipality_id;
                        else
                            $byCityID = -1;

                        if ($model->barangay_id == '' || $model->barangay_id == 0) {
                            $disabled = true;
                        } else {
                            $disabled = false;
                        }
                        ?>

                        <?php
                        echo CHtml::activeDropDownList($model, 'barangay_id', CHtml::listData(Barangays::model_getAllData_byMuncipalityID($byCityID), 'id', 'name'), array(
                            'prompt' => '-- select --', 'id' => 'cboBarangay', 'class' => 'form-control', 'disabled' => $disabled)
                        );
                        ?>
                    </label>
                </section>         
            </fieldset>                            
            <div class="widget-footer smart-form" style="text-align: center;">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Next >>' : 'Save', array('class' => 'btn btn-sm btn-info', 'onclick' => '$("#ui-id-3").click();')); ?>
            </div>
        </fieldset>             

        <fieldset>

        </fieldset>

        <?php // print CHtml::endForm();  ?>
        <!--</form>-->


    </div>
    <!-- end widget content -->

</div>
<?php //$this->endWidget();  ?>
<!-- end widget div -->