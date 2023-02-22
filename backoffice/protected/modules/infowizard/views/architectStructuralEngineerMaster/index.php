<?php
/* @var $this BoInformationWizardArchitectStructuralEngineerMasterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bo Information Wizard Architect Structural Engineer Masters',
);

$this->menu=array(
	array('label'=>'Create BoInformationWizardArchitectStructuralEngineerMaster', 'url'=>array('create')),
	array('label'=>'Manage BoInformationWizardArchitectStructuralEngineerMaster', 'url'=>array('admin')),
);
?>

<h1>Bo Information Wizard Architect Structural Engineer Masters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
