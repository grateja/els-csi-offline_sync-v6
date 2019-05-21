<?php
$this->breadcrumbs=array(
	'User Based Accesses',
);

$this->menu=array(
	array('label'=>'Create UserBasedAccess', 'url'=>array('create')),
	array('label'=>'Manage UserBasedAccess', 'url'=>array('admin')),
);
?>

<h1>User Based Accesses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
