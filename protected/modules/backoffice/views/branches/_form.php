<?php print CHtml::beginForm('', 'POST', array('role' => 'form')); ?>
<div class="box-body">   
         <div class="form-group" style="text-align: center;">
        <?php print CHtml::activeLabelEx($model, 'Upload Image*'); ?>
        <div class="image-upload">
            <div class ="square-img">
                <?php
                    print (!empty($_SESSION[Branches::tbl()]['filename'])) ? CHtml::image(Settings::get_baseUrl() . "/" . $_SESSION[Branches::tbl()]['path'] . "/" . $_SESSION[Branches::tbl()]['filename'], '', array('id' => 'image-upload')) : CHtml::image(Settings::get_baseUrl() . "/images/noimage.png", '', array('id' => 'image-upload'));
                ?>
                <div id="btnUpload" class="<?php ?>">
                    <?php
                    $this->widget('ext.EAjaxUpload.EAjaxUpload', array(
                        'id' => 'uploadFile',
                        'config' => array(
                            'action' => $this->createUrl('branches/addPhotoSubmit'),
                            'allowedExtensions' => array("jpg", "jpeg", "png"), //array("jpg","jpeg","gif","exe","mov" and etc...
                            'sizeLimit' => 20 * 1024 * 1024, // maximum file size in bytes
                            'onComplete' => "js:function(id, fileName, responseJSON){ "
                            . " var url = '/' + location.pathname.split('/')[1] + '/'; "
                            . " pathPhoto = '/images/tmp/' + responseJSON.filename;"
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
        <?php print CHtml::activeLabelEx($model, 'address'); ?>
        <?php print CHtml::activeTextField($model, 'address', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'city_id'); ?>
        <?php print CHtml::activeDropDownList($model, 'city_id', CHtml::listData(Municipalities::model_getData_byIsDeleted(Utilities::NO),'id','name'), array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'contact_no'); ?>
        <?php print CHtml::activeTextField($model, 'contact_no', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'email_address'); ?>
        <?php print CHtml::activeTextField($model, 'email_address', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'header_rcpt_msg'); ?>
        <?php print CHtml::activeTextArea($model, 'header_rcpt_msg', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'footer_rcpt_msg'); ?>
        <?php print CHtml::activeTextArea($model, 'footer_rcpt_msg', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
</div>

<div class="box-footer">
    <?php print CHtml::link('Back', $this->createUrl('branches/admin'), array('class' => 'btn btn-default')); ?>
    <?php print CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary pull-right')); ?>
</div>
<?php print CHtml::endForm(); ?>