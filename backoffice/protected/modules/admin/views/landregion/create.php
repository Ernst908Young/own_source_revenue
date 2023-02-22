<?php
/* @var $this LandregionController */
/* @var $model Landregion */

$this->breadcrumbs=array(
	'Landregions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Landregion', 'url'=>array('index')),
	array('label'=>'Manage Landregion', 'url'=>array('admin')),
);
?>

<h1>Create Landregion</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>