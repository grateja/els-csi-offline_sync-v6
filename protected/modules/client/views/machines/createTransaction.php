<!-- NEW COL START -->
<br/>
<article class="col-sm-12 col-md-12 col-lg-12">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-4" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">

            <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>Create - Washing Machine</h2>
            </header>  
                <article class="col-sm-8 col-md-8 col-lg-12"><br />
                    <div class="jarviswidget jarviswidget-color-blueDark">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                            <h2>Selected Customer Card</h2>
                        </header>
                        <div class="modal-content">
                            <div>
                                <?php echo $this->renderPartial('_formSessionSelectedCustomer', array('model' => $model, 'modelHeader' => $modelHeader)); ?>
                            </div>
                        </div>
                    </div>
                </article>
            <div class="modal-content">  
                 <?php $this->widget('Flashes'); ?>
                

                 <?php echo $this->renderPartial('_veiwMachineInfo', array('model'=>$model)); ?>
                 <?php echo $this->renderPartial('_formCreateTransaction', array('modeltransactions'=>$modeltransactions, 'model'=>$model)); ?>
                 <?php echo $this->renderPartial('adminCustomerCards', array('modelCards'=>$modelCards, 'machines' => $model)); ?>
            </div>
               
        </div><br /><br /><br /><br />
</article>