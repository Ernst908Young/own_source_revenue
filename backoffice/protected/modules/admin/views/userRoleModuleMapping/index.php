<?php
/* @var $this UserRoleModuleMappingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Role Module Mappings',
);

$this->menu=array(
	array('label'=>'Create UserRoleModuleMapping', 'url'=>array('create')),
	array('label'=>'Manage UserRoleModuleMapping', 'url'=>array('admin')),
);
?>

<h1>User Role Module Mappings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
