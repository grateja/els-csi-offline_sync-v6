<?php $this->renderPartial('/layouts/js/_regionsToBarangays'); ?>
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
    <div class="widget-body no-padding" >
        <div style="text-align: center;">
            <?php // print CHtml::beginForm($this->createUrl('admissionParents/clearParents'),'POST', array('class'=>'smart-form'));?>
            <?php //print CHtml::endForm(); ?>
        </div>
        <!--<form class="smart-form">-->
        <?php //  print CHtml::beginForm($this->createUrl('site/admission'),'POST', array('class'=>'smart-form'));?>
        <?php $this->widget('Flashes'); ?>
        <?php
        if (isset($_SESSION[AdmissionTestingParentsTmp::tbl()]) and $_SESSION[AdmissionTestingParentsTmp::tbl()][0]['id'] > 0) {
            $disabled = false;
        } else {
            $disabled = false;
        }
        ?>
        <fieldset>
            <?php print CHtml::activeHiddenField($modelParents, 'id'); ?>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($modelTestingParents, 'relationship_id'); ?>
                </label>
                <label class="input">
                    <?php echo CHtml::activeDropDownList($modelTestingParents, 'relationship_id', CHtml::listData(Relationships::model_getAllData_byDeleted(Utilities::NO), 'id', 'name'), array('prompt' => '-- select --', 'class' => 'form-control')); ?>
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($modelParents, 'firstname'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeTextField($modelParents, 'firstname', array('size' => 60, 'maxlength' => 255, 'disabled' => $disabled)); ?>
                    <b class="tooltip tooltip-top-left">
                        Parents/Guardian Firstname
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($modelParents, 'middlename'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeTextField($modelParents, 'middlename', array('size' => 60, 'maxlength' => 255, 'disabled' => $disabled)); ?>
                    <b class="tooltip tooltip-top-left">
                        Parents/Guardian Middlename
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($modelParents, 'lastname'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeTextField($modelParents, 'lastname', array('size' => 60, 'maxlength' => 255, 'disabled' => $disabled)); ?>
                    <b class="tooltip tooltip-top-left">
                        Parents/Guardian Lastname
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($modelParents, 'email'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeTextField($modelParents, 'email', array('size' => 60, 'maxlength' => 255, 'disabled' => $disabled)); ?>
                    <b class="tooltip tooltip-top-left">
                        Parents/Guardian Email
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($modelParents, 'mobile'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeTextField($modelParents, 'mobile', array('size' => 11, 'maxlength' => 11, 'disabled' => $disabled)); ?>
                    <b class="tooltip tooltip-top-left">
                        ex: 09171234567
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($modelParents, 'phone'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeTextField($modelParents, 'phone', array('size' => 20, 'maxlength' => 20, 'disabled' => $disabled)); ?>
                    <b class="tooltip tooltip-top-left">
                        ex: 6329091234
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($modelParents, 'occupation_id'); ?>
                </label>
                <label class="input">
                    <?php echo CHtml::activeDropDownList($modelParents, 'occupation_id', CHtml::listData(Occupations::model_getAllData_byDeleted(Utilities::NO), 'id', 'name'), array('prompt' => '-- select --', 'class' => 'form-control', 'disabled' => $disabled)); ?>
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($modelParents, 'occupation_type'); ?>
                </label>
                <label class="input">
                    <?php echo CHtml::activeDropDownList($modelParents, 'occupation_type', Occupations::getOccupationType(), array('prompt' => '-- select --', 'class' => 'form-control', 'disabled' => $disabled)); ?>
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($modelParents, 'employer'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeTextField($modelParents, 'employer', array('size' => 60, 'maxlength' => 255, 'disabled' => $disabled)); ?>
                    <b class="tooltip tooltip-top-left">
                        Employer
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($modelParents, 'employer_address'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeTextField($modelParents, 'employer_address', array('size' => 60, 'maxlength' => 255, 'disabled' => $disabled)); ?>
                    <b class="tooltip tooltip-top-left">
                        Employer Address
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($modelParents, 'employer_phone'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeTextField($modelParents, 'employer_phone', array('size' => 20, 'maxlength' => 20, 'disabled' => $disabled)); ?>
                    <b class="tooltip tooltip-top-left">
                        ex: 6329091234
                    </b> 
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($modelParents, 'is_alumnus'); ?>
                </label>
                <label class="input">
                    <?php echo CHtml::activeDropDownList($modelParents, 'is_alumnus', Utilities::get_ActiveSelect(), array('prompt' => '-- select --', 'class' => 'form-control', 'disabled' => $disabled)); ?>
                </label>
            </section>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($modelParents, 'batch_year'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-question-circle"></i>
                    <?php echo CHtml::activeTextField($modelParents, 'batch_year', array('size' => 20, 'maxlength' => 4, 'disabled' => $disabled)); ?>
                    <b class="tooltip tooltip-top-left">
                        Batch(Year)
                    </b> 
                </label>
            </section>


            <div class="widget-footer smart-form">
                <?php echo CHtml::submitButton('Add Parent/Guardian', array('class' => 'btn btn-sm btn-info', 'name' => 'cmdAddPG')); ?>

                <?php echo CHtml::submitButton('Save', array('class' => 'btn btn-sm btn-success', 'name' => 'cmdSubmit')); ?>
            </div>
        </fieldset>                
        <?php // print CHtml::endForm(); ?>
        <!--</form>-->


    </div>
    <!-- end widget content -->

</div>
<?php //$this->endWidget(); ?>
<!-- end widget div -->