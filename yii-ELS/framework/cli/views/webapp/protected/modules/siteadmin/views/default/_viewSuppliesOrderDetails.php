<div id="content">
    <!-- widget grid -->
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            <article class="col-sm-12">
                <!-- new widget -->
                <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2>Approved Purchase Order</h2>
                    </header>
                    <!-- widget div-->
                    <div class="modal-content">
                        <!-- new widget -->
                        <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Requisition Header</h2>
                            </header>
                            <!-- widget div-->
                            <div class="modal-content">
                                <div class="widget-body">
                                    <!-- content -->
                                    <?php
                                    $this->widget('Flashes');
                                    $this->renderPartial('../suppliesRequisitionForpoHeaders/_suppliesOrderHeader', array('modelHeader' => $modelHeader));
                                    ?>
                                    <!-- end content -->
                                </div>
                            </div>
                            <!-- end widget div -->
                        </div>
                        <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>Requisition Details</h2>
                            </header>
                            <!-- widget div-->
                            <div class="modal-content">
                                <div class="widget-body">
                                    <?php
                                    $this->widget('Flashes');
                                    $this->renderPartial('../suppliesRequisitionForpoDetails/_suppliesOrderDetails', array('modelDetails' => $modelDetails));
                                    ?>
                                    <table style="width: 100%; text-align: center">
                                        <tr>
                                            <td colspan="4"  class="td3">
                                                <div>
                                                    <?php print CHtml::beginForm('', 'POST', array('class' => 'smart-form')); ?>
                                                    <?php $this->widget('Flashes'); ?>
                                                    <?php echo CHtml::htmlButton('<i class="fa fa-thumbs-up"></i>' . ' Approved', array('class' => 'btn btn-sm btn-success', 'name' => 'cmdApprove', 'type' => 'submit', 'value' => 'APPROVED')); ?>
                                                    <?php echo CHtml::htmlButton('<i class="fa fa-thumbs-down"></i>' . ' Disapproved', array('class' => 'btn btn-sm btn-danger', 'name' => 'cmdApprove', 'type' => 'submit', 'value' => 'DISAPPROVED')); ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end widget div -->
                    </div>
                </div>
            </article>
            <!-- end widget -->
        </div>
        <!-- end row -->
    </section>
    <!-- end widget grid -->
</div>      
<!-- END MAIN CONTENT -->