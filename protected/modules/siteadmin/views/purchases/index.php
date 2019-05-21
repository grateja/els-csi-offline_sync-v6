<?php
$this->breadcrumbs=array(
	'Receiving Inventories',
);

$this->menu=array(
	array('label'=>'Create Purchases', 'url'=>array('create')),
	array('label'=>'Manage Purchases', 'url'=>array('admin')),
);
?>

<h1>Receiving Inventories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
