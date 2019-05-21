

<?php print CHtml::beginForm('', 'POST', array('role' => 'form', 'enctype' => 'multipart/form-data',)); ?>
<div class="box-body">
    <div class="form-group" style="text-align: center;">
        <?php print CHtml::activeLabelEx($model, 'Upload Image*'); ?>
        <div class="image-upload">
            <div class ="square-img">
                <?php
                    print (!empty($_SESSION[Inventories::tbl()]['filename'])) ? CHtml::image(Settings::get_baseUrl() . "/" . $_SESSION[Inventories::tbl()]['path'] . "/" . $_SESSION[Inventories::tbl()]['filename'], '', array('id' => 'image-upload')) : CHtml::image(Settings::get_baseUrl() .'/'. $model->file_path.$model->file_pics, '', array('id' => 'image-upload'));
                ?>
                <div id="btnUpload" class="<?php ?>">
                    <?php
                        $this->widget('ext.EAjaxUpload.EAjaxUpload', array(
                            'id' => 'uploadFile',
                            'config' => array(
                                'action' => $this->createUrl('inventories/addPhotoSubmit'),
                                'allowedExtensions' => array("jpg", "jpeg", "png"), //array("jpg","jpeg","gif","exe","mov" and etc...
                                'sizeLimit' => 20 * 1024 * 1024, // maximum file size in bytes
                                'onComplete' => "js:function(id, fileName, responseJSON){ "
                                . " var url = '/' + location.pathname.split('/')[1] + '/'; "
                                . " pathPhoto = '/images/inventories/tmp/' + responseJSON.filename;"
                                . " $('#image-upload').attr('src', url + pathPhoto);"
                                . " }",
                            )
                        ));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'name'); ?>
        <?php print CHtml::activeTextField($model, 'name', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'desc'); ?>
        <?php print CHtml::activeTextField($model, 'desc', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <?php if ($model->category_id == InventoryCategories::INVENTORY_TYPE_SERVICES): ?>
            <div class="form-group">
                <?php print CHtml::activeLabelEx($model, 'group_id'); ?>
                <?php print CHtml::activeDropDownList($model, 'group_id', Utilities::get_ActiveServiceTypes(), array('class' => 'form-control', 'prompt' => '-- Select --')); ?>
            </div>
            <div class="form-group">
                <?php print CHtml::activeLabelEx($model, 'service_type_id'); ?>
                <?php print CHtml::activeDropDownList($model, 'service_type_id', CHtml::listData(ServiceTypes::model_getAllData_byDeleted(Utilities::NO), 'id', 'name'), array('class' => 'form-control', 'prompt' => '-- Select --', 'onChange' => 'showHideTokenField(this.value)')); ?>
            </div>
            <div class="form-group" id="tokenID">
                <?php print CHtml::activeLabelEx($model, 'token'); ?>  
                <?php print CHtml::activeTextField($model, 'token', array('class' => 'form-control', 'placeholder' => '0')); ?>

            </div>
        <?php endif; ?>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'bar_code'); ?>
        <?php print CHtml::activeTextField($model, 'bar_code', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'Selling Price'); ?>
        <?php print CHtml::activeTextField($model, 'price', array('class' => 'form-control', 'placeholder' => '0.00')); ?>
    </div>

    <!--    <div class="form-group">
    <?php print CHtml::activeLabelEx($model, 'margin'); ?>
    <?php print CHtml::activeTextField($model, 'margin', array('class' => 'form-control', 'placeholder' => '')); ?>
        </div>-->

    <?php if ($model->category_id != InventoryCategories::INVENTORY_TYPE_SERVICES): ?>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'qty_reorder'); ?>
        <?php print CHtml::activeTextField($model, 'qty_reorder', array('class' => 'form-control', 'placeholder' => '0')); ?>
    </div>
    <?php endif;?>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'is_deleted'); ?>
        <?php print CHtml::activeDropDownList($model, 'is_deleted',array(Utilities::get_ActiveSelect()),array('class' => 'form-control', 'placeholder' => '0')); ?>
    </div>
</div>

<div class="box-footer">
    <?php print CHtml::link('Back', $this->createUrl('inventories/admin'), array('class' => 'btn btn-default')); ?>
    <?php print CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary pull-right')); ?>
</div>
<?php print CHtml::endForm(); ?>


<script type = "text/javascript">
        function  showHideTokenField(val) {
            if (val == 4) {
                $('#tokenID').hide();
            } else {

                $('#tokenID').show();
            }
        }
</script>