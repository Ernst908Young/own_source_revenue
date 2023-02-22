<?php
/* @var $this NicMasterController */
/* @var $model NicMaster */

$this->breadcrumbs=array(
	'Nic Masters'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List NicMaster', 'url'=>array('index')),
	array('label'=>'Create NicMaster', 'url'=>array('create')),
	array('label'=>'Update NicMaster', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete NicMaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NicMaster', 'url'=>array('admin')),
);
?>

<h1>View NicMaster #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parent_id',
		'code',
		'description',
		'level',
	),
)); ?>
