<?php
/* @var $this UserRoleModuleMappingController */
/* @var $model UserRoleModuleMapping */

$this->breadcrumbs=array(
	'User Role Module Mappings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserRoleModuleMapping', 'url'=>array('index')),
	array('label'=>'Create UserRoleModuleMapping', 'url'=>array('create')),
	array('label'=>'View UserRoleModuleMapping', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserRoleModuleMapping', 'url'=>array('admin')),
);
?>

<h1>Update UserRoleModuleMapping <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>