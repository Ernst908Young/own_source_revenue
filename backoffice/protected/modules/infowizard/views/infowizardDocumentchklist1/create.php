<?php
/* @var $this InfowizardDocumentchklistController */
/* @var $model InfowizardDocumentchklist */

$this->breadcrumbs=array(
	'Infowizard Documentchklists'=>array('index'),
	'Create',
);

//$this->menu=array(
//	array('label'=>'List InfowizardDocumentchklist', 'url'=>array('index')),
//	array('label'=>'Manage InfowizardDocumentchklist', 'url'=>array('admin')),
//);
?>

<!--<h1>Create InfowizardDocumentchklist</h1>-->

<?php $this->renderPartial('_form', array('model'=>$model,'Documentdata'=>$Documentdata,'Issuerdata'=>$Issuerdata,'countid'=>$countid)); ?>