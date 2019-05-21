<div class="col-lg-4">
    <div class="metronicCreate">
        <header>
            <span><i class="iconic-icon-plus-alt"></i>Create - Menus</span>
            <?php print CHtml::link('View/Search', $this->createUrl('menus/admin'), array('class' => 'btn-back')); ?>
        </header>
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
    </div>
</div>