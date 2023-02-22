<?php
/* @var $this InfowizardQuestionMasterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Infowizard Question Masters',
);

$this->menu=array(
	array('label'=>'Create InfowizardQuestionMaster', 'url'=>array('create')),
	array('label'=>'Manage InfowizardQuestionMaster', 'url'=>array('admin')),
);
?>

<h1>Infowizard Question Masters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
