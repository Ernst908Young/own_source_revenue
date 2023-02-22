<?php
/* @var $this NicCodeController */
/* @var $model NicCode */

$this->breadcrumbs=array(
	'Nic Codes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NicCode', 'url'=>array('index')),
	array('label'=>'Manage NicCode', 'url'=>array('admin')),
);
?>

<h1>Create NicCode</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>