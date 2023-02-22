<?php
/* @var $this SpApplcationsDetailController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sp Applcations Details',
);

$this->menu=array(
	array('label'=>'Create SpApplcationsDetail', 'url'=>array('create')),
	array('label'=>'Manage SpApplcationsDetail', 'url'=>array('admin')),
);
?>

<h1>Sp Applcations Details</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
