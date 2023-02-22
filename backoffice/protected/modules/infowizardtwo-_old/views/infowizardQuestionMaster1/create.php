<?php
/* @var $this InfowizardQuestionMasterController */
/* @var $model InfowizardQuestionMaster */

$this->breadcrumbs=array(
	'Infowizard Question Masters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List InfowizardQuestionMaster', 'url'=>array('index')),
	array('label'=>'Manage InfowizardQuestionMaster', 'url'=>array('admin')),
);
?>


<?php $this->renderPartial('_form', array('model'=>$model)); ?>