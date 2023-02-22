<?php
/* @var $this SpAllApplicationsController */
/* @var $model SpAllApplications */

$this->breadcrumbs=array(
	'Sp All Applications'=>array('index'),
	$model->app_id,
);

$this->menu=array(
	array('label'=>'List SpAllApplications', 'url'=>array('index')),
	array('label'=>'Create SpAllApplications', 'url'=>array('create')),
	array('label'=>'Update SpAllApplications', 'url'=>array('update', 'id'=>$model->app_id)),
	array('label'=>'Delete SpAllApplications', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->app_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SpAllApplications', 'url'=>array('admin')),
);
?>

<h1>View SpAllApplications #<?php echo $model->app_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'app_id',
		'app_name',
		'app_url',
		'is_app_active',
		'created_on',
		'remote_server',
		'user_agent',
	),
)); ?>
