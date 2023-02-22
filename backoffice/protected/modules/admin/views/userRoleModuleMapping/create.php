<?php
/* @var $this UserRoleModuleMappingController */
/* @var $model UserRoleModuleMapping */

$this->breadcrumbs=array(
	'User Role Module Mappings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserRoleModuleMapping', 'url'=>array('index')),
	array('label'=>'Manage UserRoleModuleMapping', 'url'=>array('admin')),
);
?>

<h1>Create UserRoleModuleMapping</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>