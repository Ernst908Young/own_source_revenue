<?php
/* @var $this ServiceTimelineController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bo Infowizard Service Timelines',
);

$this->menu=array(
	array('label'=>'Create BoInfowizardServiceTimeline', 'url'=>array('create')),
	array('label'=>'Manage BoInfowizardServiceTimeline', 'url'=>array('admin')),
);
?>

<h1>Bo Infowizard Service Timelines</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
