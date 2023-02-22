<?php
/* @var $this SpAllApplicationsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sp All Applications',
);

$this->menu=array(
	array('label'=>'Create SpAllApplications', 'url'=>array('create')),
	array('label'=>'Manage SpAllApplications', 'url'=>array('admin')),
);
?>

<h1>Sp All Applications</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
