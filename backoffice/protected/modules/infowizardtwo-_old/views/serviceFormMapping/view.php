<?php
/* @var $this ServiceFormMappingController */
/* @var $model ServiceFormMapping */

$this->breadcrumbs=array(
	'Service Form Mappings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ServiceFormMapping', 'url'=>array('index')),
	array('label'=>'Create ServiceFormMapping', 'url'=>array('create')),
	array('label'=>'Update ServiceFormMapping', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ServiceFormMapping', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ServiceFormMapping', 'url'=>array('admin')),
);
?>

<h1>View ServiceFormMapping #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'department_id',
		'service_id',
		'form_type_id',
		'form_name',
		'form_code',
		'form_version',
		'is_active',
		'created',
		'modified',
	),
)); ?>
