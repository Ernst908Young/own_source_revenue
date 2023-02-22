<?php
/* @var $this InfowizardQuestionMasterController */
/* @var $model InfowizardQuestionMaster */

$this->breadcrumbs=array(
	'Infowizard Question Masters'=>array('index'),
	$model->name=>array('view','id'=>$model->question_id),
	'Update',
);


?>

<?php $this->renderPartial('_form', array('model'=>$model,'action' => 'edit')); ?>