<style>
    td.td0{
        padding-top: 0.3cm;
        padding-bottom: 0.2cm;
        padding-left: 1cm;

        colspan: 2;
    }
    td.td1{
        width: 50%;
        text-align: right;
        padding-top: 0.05cm;
        padding-bottom: 0.05cm;
        padding-left: 0.05cm;
        padding-right: 0.3cm;
    }

    td.td2{
        width: 50%;
        text-align: left;
        padding-top: 0.05cm;
        padding-bottom: 0.05cm;
        padding-left: 0.05cm;
        padding-right: 0.05cm;
        font-weight: bold;
    }
    td.td3{
        text-align: center;
        padding-top: 0.05cm;
        padding-bottom: 0.05cm;
        padding-left: 0.05cm;
        padding-right: 0.05cm;
    }
</style>

<div id="content">
    <!-- widget grid -->
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            <article class="col-sm-12">
                <!-- new widget -->
                <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                    <header><h2> Properties Requisition Header - FOR APPROVAL </h2></header>
                    <!-- widget div-->
                    <div class="modal-content">
                        <div class="widget-body">
                            <!-- content -->
                            <?php
                            $this->widget('Flashes');
                            $this->renderPartial('../propertiesRequisitionHeaders/requisitionHeader', array('modelHeader' => $modelHeader));
                            ?>
                            <!-- end content -->
                        </div>
                    </div>
                    <!-- end widget div -->
                </div>
                <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-togglebutton="false" data-widget-editbutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false">
                    <header><h2> Properties Requisition Details </h2></header>
                    <!-- widget div-->
                    <div class="modal-content">
                        <div class="widget-body">
                            <?php
                            $this->widget('zii.widgets.grid.CGridView', array(
                                'id' => 'properties-requisition-details-grid',
                                'dataProvider' => $model->searchByHeaderID(),
                                'filter' => $model,
                                'columns' => array(
                                    array(
                                        'name' => 'id',
                                        'filter' => false
                                    ),
//                                            'created_at',
//                                            'updated_at',
//                                            'header_id',
//                                            'ref_no',
                                    array(
                                        'name' => 'inv_id',
                                        'value' => '$data->inventory->name',
                                        'filter' => false,
                                        'header' => 'Inventory Name'
                                    ),
                                    array(
                                        'name' => 'inv_id',
                                        'value' => '$data->inventory->desc',
                                        'filter' => false,
                                        'header' => 'Description'
                                    ),
                                    array(
                                        'name' => 'item_code',
                                        'filter' => false,
                                    ),
                                    array(
                                        'name' => 'unit_id',
                                        'value' => '$data->units->abbr',
                                        'filter' => false,
                                    ),
                                    array(
                                        'name' => 'cost',
                                        'value' => 'Settings::setNumberFormat($data->cost,2)',
                                        'filter' => false,
                                    ),
                                    array(
                                        'name' => 'quantity',
                                        'filter' => false,
                                    ),
                                    array(
                                        'name' => 'location',
                                        'value' => '$data->locations->name',
                                        'filter' => false,
                                    ),
                                    array(
                                        'name' => 'total',
                                        'value' => 'Settings::setNumberFormat($data->total,2)',
                                        'filter' => false,
                                    ),
                                ),
                            ));
                            ?>

                            <table style="width: 100%">
                                <tr>
                                    <td colspan="4"  class="td3">
                                        <div>
                                            <?php print CHtml::beginForm('', 'POST', array('class' => 'smart-form')); ?>
                                            <?php $this->widget('Flashes'); ?>
                                            <?php echo CHtml::submitButton('APPROVED', array('class' => 'btn btn-sm btn-success', 'name' => 'cmdApprove')); ?>
                                            <?php echo CHtml::submitButton('DISAPPROVED', array('class' => 'btn btn-sm btn-danger', 'name' => 'cmdApprove')); ?> 
                                        </div>
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
                <!-- end widget div -->
            </article>
            <!-- end widget -->
        </div>
        <!-- end row -->
    </section>
    <!-- end widget grid -->
</div>      
<!-- END MAIN CONTENT -->