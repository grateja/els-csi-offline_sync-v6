<!-- NEW COL START --><br />
<article class="col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="col-lg-12">
            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-4" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">

                <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2>Customer Information</h2>
                </header>

                <div class="modal-content">
                    <?php $this->widget('Flashes');?>
                    <?php echo $this->renderPartial('_formCustomerInfo', array(
                                'model'=>$model,
                                'modelCards'=>$modelCards,
                                'modelCustomer'=>$modelCustomer,
                        )); ?>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-4" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">

                <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2>Top up </h2>
                </header>

                <div class="modal-content">
                    <div class="smart-form" style="text-align: center;padding-bottom: 10px;">
                        <?php print CHtml::link('<i class="fa fa-cubes">'.' Manage</i>',$this->createUrl('customerCards/admin'), array('class'=>'btn btn-primary btn-sm', 'style'=>'width: 150px;','id'=>'btnPayment' )); ?>
                    </div>&nbsp;
                    <?php $this->widget('Flashes');?>
                    <?php echo $this->renderPartial('_formLaoding', array(
                                'model'=>$model,
                                'modelCards'=>$modelCards,
                                'modelCustomer'=>$modelCustomer,
                        )); ?>
                </div>
            </div>
        </div>
    <br/><br/>
</article>