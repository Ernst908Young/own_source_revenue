<?php
/* @var $this FileldsController */
/* @var $model Filelds */

$this->breadcrumbs=array(
	'Filelds'=>array('index'),
	$model->field_id,
);

$this->menu=array(
	array('label'=>'List Filelds', 'url'=>array('index')),
	array('label'=>'Create Filelds', 'url'=>array('create')),
	array('label'=>'Update Filelds', 'url'=>array('update', 'id'=>$model->field_id)),
	array('label'=>'Delete Filelds', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->field_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Filelds', 'url'=>array('admin')),
);
?>

<h1>View Fields #<?php echo $model->field_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'field_id',
		'field_name',
		'field_desc',
		'filed_type',
		'is_field_active',
	),
)); ?>
