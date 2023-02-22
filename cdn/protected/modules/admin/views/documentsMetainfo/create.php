<?php
/* @var $this DocumentsMetainfoController */
/* @var $model DocumentsMetainfo */

$this->breadcrumbs=array(
	'Documents Metainfos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DocumentsMetainfo', 'url'=>array('index')),
	array('label'=>'Manage DocumentsMetainfo', 'url'=>array('admin')),
);
?>

<h1>Create DocumentsMetainfo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>