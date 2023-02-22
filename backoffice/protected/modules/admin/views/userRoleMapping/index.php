<?php
/* @var $this UserRoleMappingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Role Mappings',
);

$this->menu=array(
	array('label'=>'Create UserRoleMapping', 'url'=>array('create')),
	array('label'=>'Manage UserRoleMapping', 'url'=>array('admin')),
);
?>

<h1>User Role Mappings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
