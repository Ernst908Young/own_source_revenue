<?php
/* @var $this BoInformationWizardArchitectStructuralEngineerMasterController */
/* @var $model BoInformationWizardArchitectStructuralEngineerMaster */

$this->breadcrumbs=array(
	'Bo Information Wizard Architect Structural Engineer Masters'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BoInformationWizardArchitectStructuralEngineerMaster', 'url'=>array('index')),
	array('label'=>'Create BoInformationWizardArchitectStructuralEngineerMaster', 'url'=>array('create')),
	array('label'=>'Update BoInformationWizardArchitectStructuralEngineerMaster', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BoInformationWizardArchitectStructuralEngineerMaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BoInformationWizardArchitectStructuralEngineerMaster', 'url'=>array('admin')),
);
?>

<h1>View BoInformationWizardArchitectStructuralEngineerMaster #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'profession_name',
		'profession_body',
		'created',
	),
)); ?>
