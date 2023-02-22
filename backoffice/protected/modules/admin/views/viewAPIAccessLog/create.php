<?php
/* @var $this ViewAPIAccessLogController */
/* @var $model ApiAccessLog */

$this->breadcrumbs=array(
	'Api Access Logs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ApiAccessLog', 'url'=>array('index')),
	array('label'=>'Manage ApiAccessLog', 'url'=>array('admin')),
);
?>

<h1>Create ApiAccessLog</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>