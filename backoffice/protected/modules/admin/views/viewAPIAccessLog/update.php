<?php
/* @var $this ViewAPIAccessLogController */
/* @var $model ApiAccessLog */

$this->breadcrumbs=array(
	'Api Access Logs'=>array('index'),
	$model->access_id=>array('view','id'=>$model->access_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ApiAccessLog', 'url'=>array('index')),
	array('label'=>'Create ApiAccessLog', 'url'=>array('create')),
	array('label'=>'View ApiAccessLog', 'url'=>array('view', 'id'=>$model->access_id)),
	array('label'=>'Manage ApiAccessLog', 'url'=>array('admin')),
);
?>

<h1>Update ApiAccessLog <?php echo $model->access_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>