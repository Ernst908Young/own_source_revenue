<?php
/* @var $this BoInformationWizardArchitectStructuralEngineerMasterController */
/* @var $model BoInformationWizardArchitectStructuralEngineerMaster */

$this->breadcrumbs=array(
	'Bo Information Wizard Architect Structural Engineer Masters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BoInformationWizardArchitectStructuralEngineerMaster', 'url'=>array('index')),
	array('label'=>'Manage BoInformationWizardArchitectStructuralEngineerMaster', 'url'=>array('admin')),
);
?>

<h1>Create BoInformationWizardArchitectStructuralEngineerMaster</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>