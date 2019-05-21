<?php
$this->breadcrumbs = array(
    'Item Types',
);

$this->menu = array(
    array('label' => 'Create ItemTypes', 'url' => array('create')),
    array('label' => 'Manage ItemTypes', 'url' => array('admin')),
);
?>

<h1>Item Types</h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
