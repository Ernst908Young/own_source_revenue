<?php
/* @var $this PredefinedDepartmentMessageController */
/* @var $model PredefinedDepartmentMessage */

$this->breadcrumbs=array(
	'Predefined Department Messages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PredefinedDepartmentMessage', 'url'=>array('index')),
	array('label'=>'Manage PredefinedDepartmentMessage', 'url'=>array('admin')),
);
?>

<h1>Create PredefinedDepartmentMessage</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>