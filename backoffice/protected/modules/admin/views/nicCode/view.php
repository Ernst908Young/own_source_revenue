<?php
/* @var $this NicCodeController */
/* @var $model NicCode */

$this->breadcrumbs=array(
	'Nic Codes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List NicCode', 'url'=>array('index')),
	array('label'=>'Create NicCode', 'url'=>array('create')),
	array('label'=>'Update NicCode', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete NicCode', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NicCode', 'url'=>array('admin')),
);
?>

<h1>View NicCode #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nic_code',
		'created_on',
		'remote_ip',
		'user_agent',
	),
)); ?>
