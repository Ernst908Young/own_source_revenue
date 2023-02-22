<?php
/* @var $this FileldsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Filelds',
);

$this->menu=array(
	array('label'=>'Create Filelds', 'url'=>array('create')),
	array('label'=>'Manage Filelds', 'url'=>array('admin')),
);
?>

<h1>Fields</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
