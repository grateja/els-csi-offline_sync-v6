<?php print CHtml::beginForm('', 'POST', array('role' => 'form')); ?>
<div class="box-body">
          <div class="form-group" style="text-align: center;">
        <?php print CHtml::activeLabelEx($model, 'Upload Image*'); ?>
        <div class="image-upload">
            <div class ="square-img">
                <?php
                    print (!empty($_SESSION[Clients::tbl()]['filename'])) ? CHtml::image(Settings::get_baseUrl() . "/" . $_SESSION[Clients::tbl()]['path'] . "/" . $_SESSION[Clients::tbl()]['filename'], '', array('id' => 'image-upload')) : CHtml::image(Settings::get_baseUrl() . "/images/noimage.png", '', array('id' => 'image-upload'));
                ?>
                <div id="btnUpload" class="<?php ?>">
                    <?php
                    $this->widget('ext.EAjaxUpload.EAjaxUpload', array(
                        'id' => 'uploadFile',
                        'config' => array(
                            'action' => $this->createUrl('dealers/addPhotoSubmit'),
                            'allowedExtensions' => array("jpg", "jpeg", "png"), //array("jpg","jpeg","gif","exe","mov" and etc...
                            'sizeLimit' => 20 * 1024 * 1024, // maximum file size in bytes
                            'onComplete' => "js:function(id, fileName, responseJSON){ "
                            . " var url = '/' + location.pathname.split('/')[1] + '/'; "
                            . " pathPhoto = '/images/dealers/tmp/' + responseJSON.filename;"
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
        <?php print CHtml::activeLabelEx($model, 'firstname'); ?>
        <?php print CHtml::activeTextField($model, 'firstname', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'middlename'); ?>
        <?php print CHtml::activeTextField($model, 'middlename', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'lastname'); ?>
        <?php print CHtml::activeTextField($model, 'lastname', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'company_name'); ?>
        <?php print CHtml::activeTextField($model, 'company_name', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'address'); ?>
        <?php print CHtml::activeTextField($model, 'address', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'email'); ?>
        <?php print CHtml::activeTextField($model, 'email', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'mobile'); ?>
        <?php print CHtml::activeTextField($model, 'mobile', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>
    <div class="form-group">
        <?php print CHtml::activeLabelEx($model, 'phone'); ?>
        <?php print CHtml::activeTextField($model, 'phone', array('class' => 'form-control', 'placeholder' => '')); ?>
    </div>

</div>

<div class="box-footer">
    <?php print CHtml::link('Back', $this->createUrl('dealers/admin'), array('class' => 'btn btn-default')); ?>
    <?php print CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary pull-right')); ?>
</div>
<?php print CHtml::endForm(); ?>