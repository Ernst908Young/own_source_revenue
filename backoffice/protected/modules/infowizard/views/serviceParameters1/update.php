<?php
/* @var $this BoInformationWizardServiceParametersController */
/* @var $model BoInformationWizardServiceParameters */

$this->breadcrumbs=array(
	'Bo Information Wizard Service Parameters'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BoInformationWizardServiceParameters', 'url'=>array('index')),
	array('label'=>'Create BoInformationWizardServiceParameters', 'url'=>array('create')),
	array('label'=>'View BoInformationWizardServiceParameters', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BoInformationWizardServiceParameters', 'url'=>array('admin')),
);
?>

<h1>Update BoInformationWizardServiceParameters <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>