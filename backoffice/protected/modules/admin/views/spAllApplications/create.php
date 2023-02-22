<?php
/* @var $this SpAllApplicationsController */
/* @var $model SpAllApplications */

$this->breadcrumbs=array(
	'Sp All Applications'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SpAllApplications', 'url'=>array('index')),
	array('label'=>'Manage SpAllApplications', 'url'=>array('admin')),
);
?>

<h1>Create SpAllApplications</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>