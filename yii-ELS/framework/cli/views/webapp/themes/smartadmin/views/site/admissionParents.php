




<article class="col-sm-12 col-md-12 col-lg-6" style="width: 100%;">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-4" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">

        <header>
            <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
            <h2>
                Admission Apply
            </h2>
        </header>

        <?php print CHtml::beginForm($this->createUrl('site/admission'), 'POST', array('class' => 'smart-form')); ?>

        <?php
        $this->widget('zii.widgets.jui.CJuiAccordion', array(
            'panels' => array(
                '<b>Parents/Guardian Info</b>' => $this->renderPartial('admission/_formParents', array(
                    'modelTestingParents' => $modelTestingParents,
                    'modelParents' => $modelParents,
                    ), true),
            ),
            'options' => array(
                'animated' => 'bounceslide',
                'style' => array('minHeight' => '100'),
                'collapsible' => true,
                'autoHeight' => true,
            ),
        ));


        print CHtml::endForm();
        ?>       

        <?php //echo $this->renderPartial('_formStudentInfo', array('model'=>$model)); ?>

    </div>
    <br /><br /><br />
</article>




