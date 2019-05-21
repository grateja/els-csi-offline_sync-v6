<?php print CHtml::beginForm('', 'POST', array('role' => 'form')); ?>
<div class="box-body">
    <div class="form-group" style="text-align: center;">
        <?php print CHtml::activeLabelEx($model, 'Upload Image*'); ?>
        <div class="image-upload">
            <div class ="square-img">
                <?php
                print (!empty($_SESSION[Services::tbl()]['filename'])) ? CHtml::image(Settings::get_baseUrl() . "/" . $_SESSION[Services::tbl()]['path'] . "/" . $_SESSION[Services::tbl()]['filename'], '', array('id' => 'image-upload')) : CHtml::image(Settings::get_baseUrl() . "/images/noimage.png", '', array('id' => 'image-upload'));
                ?>
                <div id="btnUpload" class="<?php print $visibility ?>">
                    <?php
                    $this->widget('ext.EAjaxUpload.EAjaxUpload', array(
                        'id' => 'uploadFile',
                        'config' => array(
                            'action' => $this->createUrl('services/addPhotoSubmit'),
                            'allowedExtensions' => array("jpg", "jpeg", "png"), //array("jpg","jpeg","gif","exe","mov" and etc...
                            'sizeLimit' => 20 * 1024 * 1024, // maximum file size in bytes
                            'onComplete' => "js:function(id, fileName, responseJSON){ "
                            . " var url = '/' + location.pathname.split('/')[1] + '/'; "
                            . " pathPhoto = '/images/services/tmp/' + responseJSON.filename;"
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
        <?php print CHtml::activeLabelEx($model, 'branch_id'); ?>
        <?php print CHtml::activeDropDownList($model, 'branch_id', CHtml::listData(Branches::model_getAllData_byDeleted(Utilities::NO), 'id', 'name'), array('class' => 'form-control', 'prompt' => 'Choose One')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'name'); ?>
        <?php print CHtml::activeTextField($model, 'name', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'service_type_id'); ?>
        <?php print CHtml::activeDropDownList($model, 'service_type_id', CHtml::listData(ServicesTypes::model_getAllData_byDeleted(Utilities::NO), 'id', 'name'), array('class' => 'form-control', 'prompt' => 'Choose One')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'amount'); ?>
        <?php print CHtml::activeTextField($model, 'amount', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
</div>

<div class="box-footer">
    <?php print CHtml::link('Back', $this->createUrl('services/admin'), array('class' => 'btn btn-default')); ?>
    <?php print CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary pull-right')); ?>
</div>
<?php print CHtml::endForm(); ?>