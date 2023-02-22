<?php
/* @var $this SpApplcationsDetailController */
/* @var $model SpApplcationsDetail */

$this->breadcrumbs=array(
	'Sp Applcations Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SpApplcationsDetail', 'url'=>array('index')),
	array('label'=>'Manage SpApplcationsDetail', 'url'=>array('admin')),
);
?>

<h1>Create SpApplcationsDetail</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>