<?php print CHtml::beginForm('', 'POST', array('role' => 'form')); ?>
<div class="box-body">
    <div class="form-group" style="text-align: center;">
        <?php print CHtml::activeLabelEx($model, 'Upload Image*'); ?>
        <div class="image-upload">
            <div class ="square-img">
                <?php
                print (!empty($_SESSION[ReceiptSettings::tbl()]['filename'])) ? CHtml::image(Settings::get_baseUrl() . "/" . $_SESSION[ReceiptSettings::tbl()]['path'] . "/" . $_SESSION[ReceiptSettings::tbl()]['filename'], '', array('id' => 'image-upload')) : CHtml::image(Settings::get_baseUrl() . "/" . $model->file_path . "/" . $model->file_pics, '', array('id' => 'image-upload'));
                ?>
                <div id="btnUpload" class="<?php print $visibility ?>">
                    <?php
                    $this->widget('ext.EAjaxUpload.EAjaxUpload', array(
                        'id' => 'uploadFile',
                        'config' => array(
                            'action' => $this->createUrl('receiptSettings/addPhotoSubmit'),
                            'allowedExtensions' => array("jpg", "jpeg", "png"), //array("jpg","jpeg","gif","exe","mov" and etc...
                            'sizeLimit' => 20 * 1024 * 1024, // maximum file size in bytes
                            'onComplete' => "js:function(id, fileName, responseJSON){ "
                            . " var url = '/' + location.pathname.split('/')[1] + '/'; "
                            . " pathPhoto = '/images/receipts/tmp/' + responseJSON.filename;"
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
        <?php print CHtml::activeLabelEx($model, 'client_id'); ?>
        <?php print CHtml::activeDropDownList($model, 'client_id', CHtml::listData(Clients::model_getAllData_byDeleted(Utilities::NO), 'id', 'fullName'), array('class' => 'form-control', 'prompt' => 'Choose One')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'branch_id'); ?>
        <?php print CHtml::activeDropDownList($model, 'branch_id', CHtml::listData(Branches::model_getAllData_byDeleted(Utilities::NO), 'id', 'name'), array('class' => 'form-control', 'prompt' => 'Choose One')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'header'); ?>
        <?php print CHtml::activeTextField($model, 'header', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'message'); ?>
        <?php print CHtml::activeTextField($model, 'message', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'footer'); ?>
        <?php print CHtml::activeTextField($model, 'footer', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
</div>

<div class="box-footer">
    <?php print CHtml::link('Back', $this->createUrl('receiptSettings/admin'), array('class' => 'btn btn-default')); ?>
    <?php print CHtml::submitButton($model->isNewRecord ? 'Save' : 'Update', array('class' => 'btn btn-primary pull-right')); ?>
</div>
<?php print CHtml::endForm(); ?>