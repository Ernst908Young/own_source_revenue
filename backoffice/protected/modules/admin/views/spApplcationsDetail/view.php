<?php
/* @var $this SpApplcationsDetailController */
/* @var $model SpApplcationsDetail */

$this->breadcrumbs=array(
	'Sp Applcations Details'=>array('index'),
	$model->sp_app_id,
);

$this->menu=array(
	array('label'=>'List SpApplcationsDetail', 'url'=>array('index')),
	array('label'=>'Create SpApplcationsDetail', 'url'=>array('create')),
	array('label'=>'Update SpApplcationsDetail', 'url'=>array('update', 'id'=>$model->sp_app_id)),
	array('label'=>'Delete SpApplcationsDetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->sp_app_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SpApplcationsDetail', 'url'=>array('admin')),
);
?>

<h1>View SpApplcationsDetail #<?php echo $model->sp_app_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'sp_app_id',
		'app_id',
		'timeline_period',
		'sp_id',
		'form_download_link',
		'application_created_on',
		'procedure_link',
		'remote_ip',
		'user_agent',
		'is_active',
	),
)); ?>
