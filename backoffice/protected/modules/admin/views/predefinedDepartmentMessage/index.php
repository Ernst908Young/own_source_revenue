<?php
/* @var $this PredefinedDepartmentMessageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Predefined Department Messages',
);

$this->menu=array(
	array('label'=>'Create PredefinedDepartmentMessage', 'url'=>array('create')),
	array('label'=>'Manage PredefinedDepartmentMessage', 'url'=>array('admin')),
);
?>

<h1>Predefined Department Messages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
