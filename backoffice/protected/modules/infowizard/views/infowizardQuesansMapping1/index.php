<?php
/* @var $this InfowizardQuesansMappingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Infowizard Quesans Mappings',
);

$this->menu=array(
	array('label'=>'Create InfowizardQuesansMapping', 'url'=>array('create')),
	array('label'=>'Manage InfowizardQuesansMapping', 'url'=>array('admin')),
);
?>

<h1>Infowizard Quesans Mappings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
