<?php
/* @var $this RoleAccessController */
/* @var $model RoleAccess */

$this->breadcrumbs=array(
	'Role Accesses'=>array('index'),
	$model->access_id,
);

$this->menu=array(
	array('label'=>'List RoleAccess', 'url'=>array('index')),
	array('label'=>'Create RoleAccess', 'url'=>array('create')),
	array('label'=>'Update RoleAccess', 'url'=>array('update', 'id'=>$model->access_id)),
	array('label'=>'Delete RoleAccess', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->access_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RoleAccess', 'url'=>array('admin')),
);
?>

<h1>View RoleAccess #<?php echo $model->access_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'access_id',
		'access_name',
		'access_created_on',
		'user_agent',
		'ip_address',
		'is_active',
	),
)); ?>
