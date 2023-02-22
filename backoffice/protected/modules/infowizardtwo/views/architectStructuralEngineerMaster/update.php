<?php
/* @var $this BoInformationWizardArchitectStructuralEngineerMasterController */
/* @var $model BoInformationWizardArchitectStructuralEngineerMaster */

$this->breadcrumbs=array(
	'Bo Information Wizard Architect Structural Engineer Masters'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BoInformationWizardArchitectStructuralEngineerMaster', 'url'=>array('index')),
	array('label'=>'Create BoInformationWizardArchitectStructuralEngineerMaster', 'url'=>array('create')),
	array('label'=>'View BoInformationWizardArchitectStructuralEngineerMaster', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BoInformationWizardArchitectStructuralEngineerMaster', 'url'=>array('admin')),
);
?>

<h1>Update BoInformationWizardArchitectStructuralEngineerMaster <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>