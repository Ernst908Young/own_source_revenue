<?php
/* @var $this ViewAPIAccessLogController */
/* @var $model ApiAccessLog */

$this->breadcrumbs=array(
	'New Api Access Logs'=>array('index'),
	$model->access_id,
);

$this->menu=array(
	array('label'=>'List ApiAccessLog', 'url'=>array('index')),
	array('label'=>'Create ApiAccessLog', 'url'=>array('create')),
	array('label'=>'Update ApiAccessLog', 'url'=>array('update', 'id'=>$model->access_id)),
	array('label'=>'Delete ApiAccessLog', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->access_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ApiAccessLog', 'url'=>array('admin')),
);
?>

<h1>View ApiAccessLog #<?php echo $model->access_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'access_id',
		'sp_tag',
		'request_method',
		'request_uri',
		'request_time',
		'post_info',
		'user_agent',
		'created_date_time',
		'remote_ip',
		'response_return',
	),
)); ?>
