<?php
/* @var $this UserRoleModuleMappingController */
/* @var $model UserRoleModuleMapping */

$this->breadcrumbs=array(
	'User Role Module Mappings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserRoleModuleMapping', 'url'=>array('index')),
	array('label'=>'Create UserRoleModuleMapping', 'url'=>array('create')),
	array('label'=>'Update UserRoleModuleMapping', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserRoleModuleMapping', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserRoleModuleMapping', 'url'=>array('admin')),
);
?>

<h1>View UserRoleModuleMapping #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'role_id',
		'module_id',
		'district_id',
		'created_date_time',
		'updated_date_time',
		'is_active',
	),
)); ?>
