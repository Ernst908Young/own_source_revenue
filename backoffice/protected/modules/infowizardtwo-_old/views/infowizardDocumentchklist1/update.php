<?php
/* @var $this InfowizardDocumentchklistController */
/* @var $model InfowizardDocumentchklist */

$this->breadcrumbs=array(
	'Infowizard Documentchklists'=>array('index'),
	$model->name=>array('view','id'=>$model->docchk_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List InfowizardDocumentchklist', 'url'=>array('index')),
	array('label'=>'Create InfowizardDocumentchklist', 'url'=>array('create')),
	array('label'=>'View InfowizardDocumentchklist', 'url'=>array('view', 'id'=>$model->docchk_id)),
	array('label'=>'Manage InfowizardDocumentchklist', 'url'=>array('admin')),
);
?>

<h1>Update InfowizardDocumentchklist <?php echo $model->docchk_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>