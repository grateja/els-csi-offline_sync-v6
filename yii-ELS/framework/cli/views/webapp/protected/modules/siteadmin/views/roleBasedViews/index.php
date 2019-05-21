<?php
$this->breadcrumbs = array(
    'Role Based Views',
);

$this->menu = array(
    array('label' => 'Create RoleBasedViews', 'url' => array('create')),
    array('label' => 'Manage RoleBasedViews', 'url' => array('admin')),
);
?>

<h1>Role Based Views</h1>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
