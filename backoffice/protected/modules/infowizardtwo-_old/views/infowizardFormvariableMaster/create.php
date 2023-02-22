<?php
/* @var $this InfowizardFormvariableMasterController */
/* @var $model InfowizardFormvariableMaster */

$this->breadcrumbs=array(
	'Infowizard Formvariable Masters'=>array('index'),
	'Create',
);

//$this->menu=array(
//	array('label'=>'List InfowizardFormvariableMaster', 'url'=>array('index')),
//	array('label'=>'Manage InfowizardFormvariableMaster', 'url'=>array('admin')),
//);
?>


<?php $this->renderPartial('_form', array('model'=>$model,'countid'=>$countid,'check'=>$check)); ?>