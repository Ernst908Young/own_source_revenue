<?php
/* @var $this RoleAccessMappingController */
/* @var $model RoleAccessMapping */

$this->breadcrumbs=array(
	'Role Access Mappings'=>array('index'),
	$model->map_id,
);

$this->menu=array(
	array('label'=>'List RoleAccessMapping', 'url'=>array('index')),
	array('label'=>'Create RoleAccessMapping', 'url'=>array('create')),
	array('label'=>'Update RoleAccessMapping', 'url'=>array('update', 'id'=>$model->map_id)),
	array('label'=>'Delete RoleAccessMapping', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->map_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RoleAccessMapping', 'url'=>array('admin')),
);
?>

<h1>View RoleAccessMapping #<?php echo $model->map_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'map_id',
		'role_id',
		'access_id',
		'created_on',
		'ip_address',
		'user_agent',
		'is_active',
	),
)); ?>
