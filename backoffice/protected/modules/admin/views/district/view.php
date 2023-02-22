<?php
/* @var $this DistrictController */
/* @var $model District */

$this->breadcrumbs=array(
	'Districts'=>array('index'),
	$model->district_id,
);

$this->menu=array(
	array('label'=>'List District', 'url'=>array('index')),
	array('label'=>'Create District', 'url'=>array('create')),
	array('label'=>'Update District', 'url'=>array('update', 'id'=>$model->district_id)),
	array('label'=>'Delete District', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->district_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage District', 'url'=>array('admin')),
);
?>

<h1>View District #<?php echo $model->district_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'district_id',
		'distric_name',
		'created_on',
		'is_active',
	),
)); ?>
