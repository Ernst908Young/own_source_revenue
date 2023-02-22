<?php
/* @var $this InfowizardFormvariableMasterController */
/* @var $model InfowizardFormvariableMaster */

$this->breadcrumbs=array(
	'Infowizard Formvariable Masters'=>array('index'),
	$model->name=>array('view','id'=>$model->formvar_id),
	'Update',
);

?>

<?php $this->renderPartial('_form', array('model'=>$model,'check'=>$check)); ?>