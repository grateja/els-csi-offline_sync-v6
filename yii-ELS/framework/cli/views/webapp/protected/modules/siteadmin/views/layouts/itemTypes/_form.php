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
        <?php print CHtml::beginForm('', 'POST', array('class' => 'smart-form')); ?>
        <?php $this->widget('Flashes'); ?>

        <fieldset>
            <section>
                <label>
                    <?php echo CHtml::activeLabelEx($model, 'name'); ?>
                </label>
                <label class="input"><i class="icon-prepend fa fa-book"></i>
                    <?php echo CHtml::activeTextField($model, 'name', array('size' => 60, 'maxlength' => 200)); ?>
                    <b class="tooltip tooltip-bottom-left">
                        Name
                    </b> 
                </label>
            </section>	                            

            <div class="widget-footer smart-form">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-sm btn-success')); ?>
            </div>
            <br /><br />

        </fieldset>

        <?php print CHtml::endForm(); ?>
        <!--</form>-->


    </div>
    <!-- end widget content -->

</div>
<?php //$this->endWidget(); ?>
<!-- end widget div -->
