<?php
/* @var $this ApplicationCdnMappingController */
/* @var $model ApplicationCdnMapping */

$this->breadcrumbs=array(
	'Application Cdn Mappings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ApplicationCdnMapping', 'url'=>array('index')),
	array('label'=>'Manage ApplicationCdnMapping', 'url'=>array('admin')),
);
?>

<h1>Create ApplicationCdnMapping</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>