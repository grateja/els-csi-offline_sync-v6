<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Create - <?= ucwords(InventoryCategories::sql_getName_byID($categoryID))?></h3>
        </div>
        <?php echo $this->renderPartial('_form', array('model' => $model, 'categoryID' => $categoryID)); ?>
    </div>
</div>