<?php
/* @var $this ServiceProvidersController */
/* @var $model ServiceProviders */

$this->breadcrumbs=array(
	'Service Providers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ServiceProviders', 'url'=>array('index')),
	array('label'=>'Manage ServiceProviders', 'url'=>array('admin')),
);
?>

<h1>Create ServiceProviders</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>