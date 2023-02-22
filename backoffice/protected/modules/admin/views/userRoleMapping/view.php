<?php
/* @var $this UserRoleMappingController */
/* @var $model UserRoleMapping */

$this->breadcrumbs=array(
	'User Role Mappings'=>array('index'),
	$model->mapping_id,
);

$this->menu=array(
	array('label'=>'List UserRoleMapping', 'url'=>array('index')),
	array('label'=>'Create UserRoleMapping', 'url'=>array('create')),
	array('label'=>'Update UserRoleMapping', 'url'=>array('update', 'id'=>$model->mapping_id)),
	array('label'=>'Delete UserRoleMapping', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->mapping_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserRoleMapping', 'url'=>array('admin')),
);
?>

<h1>View UserRoleMapping #<?php echo $model->mapping_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'mapping_id',
		'user_id',
		'role_id',
		'department_id',
		'lr_id',
		'created_time',
		'modified_time',
		'is_mapping_active',
	),
)); ?>
