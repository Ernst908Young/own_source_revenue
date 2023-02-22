<?php
/* @var $this ApplicationsSubmittionsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Applications Submittions',
);

$this->menu=array(
	array('label'=>'Create ApplicationsSubmittions', 'url'=>array('create')),
	array('label'=>'Manage ApplicationsSubmittions', 'url'=>array('admin')),
);
?>

<h1>Applications Submittions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
