<?php
/* @var $this BoInformationWizardServiceParametersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bo Information Wizard Service Parameters',
);

$this->menu=array(
	array('label'=>'Create BoInformationWizardServiceParameters', 'url'=>array('create')),
	array('label'=>'Manage BoInformationWizardServiceParameters', 'url'=>array('admin')),
);
?>

<h1>Bo Information Wizard Service Parameters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
