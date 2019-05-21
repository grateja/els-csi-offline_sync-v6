<?php
$this->breadcrumbs=array(
	'Customer Cards',
);

$this->menu=array(
	array('label'=>'Create CustomerCards', 'url'=>array('create')),
	array('label'=>'Manage CustomerCards', 'url'=>array('admin')),
);
?>

<h1>Customer Cards</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
