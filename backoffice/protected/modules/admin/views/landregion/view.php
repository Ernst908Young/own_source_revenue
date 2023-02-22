<?php
/* @var $this LandregionController */
/* @var $model Landregion */

$this->breadcrumbs=array(
	'Landregions'=>array('index'),
	$model->lr_id,
);

$this->menu=array(
	array('label'=>'List Landregion', 'url'=>array('index')),
	array('label'=>'Create Landregion', 'url'=>array('create')),
	array('label'=>'Update Landregion', 'url'=>array('update', 'id'=>$model->lr_id)),
	array('label'=>'Delete Landregion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->lr_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Landregion', 'url'=>array('admin')),
);
?>

<h1>View Landregion #<?php echo $model->lr_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'lr_id',
		'lr_name',
		'lr_type',
		'hadbast_number',
		'vtc_code',
		'is_lr_active',
	),
)); ?>
