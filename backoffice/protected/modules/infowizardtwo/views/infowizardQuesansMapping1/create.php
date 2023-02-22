<?php
/* @var $this InfowizardQuesansMappingController */
/* @var $model InfowizardQuesansMapping */

$this->breadcrumbs=array(
	'Infowizard Quesans Mappings'=>array('index'),
	'Create',
);

?>


<?php $this->renderPartial('_form', array('model'=>$model,'deptdata'=>$deptdata,'questiondata'=>$questiondata,'deptservdata'=>$deptservdata,'anscatdata'=>$anscatdata)); ?>