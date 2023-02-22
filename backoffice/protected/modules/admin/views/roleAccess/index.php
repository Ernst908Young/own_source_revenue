<?php
/* @var $this RoleAccessController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Role Accesses',
);

$this->menu=array(
	array('label'=>'Create RoleAccess', 'url'=>array('create')),
	array('label'=>'Manage RoleAccess', 'url'=>array('admin')),
);
?>

<h1>Role Accesses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
