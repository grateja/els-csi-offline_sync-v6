<?php
$this->breadcrumbs = array(
    'Role Based Accesses',
);

$this->menu = array(
    array('label' => 'Create RoleBasedAccess', 'url' => array('create')),
    array('label' => 'Manage RoleBasedAccess', 'url' => array('admin')),
);
?>

<h1>Role Based Accesses</h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
