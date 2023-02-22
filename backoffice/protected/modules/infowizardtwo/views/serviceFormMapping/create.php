<?php
/* @var $this ServiceFormMappingController */
/* @var $model ServiceFormMapping */

$this->breadcrumbs=array(
	'Service Form Mappings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ServiceFormMapping', 'url'=>array('index')),
	array('label'=>'Manage ServiceFormMapping', 'url'=>array('admin')),
);
?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>