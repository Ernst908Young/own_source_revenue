<?php
/* @var $this InfowizardQuesansMappingController */
/* @var $model InfowizardQuesansMapping */

$this->breadcrumbs=array(
	'Infowizard Quesans Mappings'=>array('index'),
	$model->queans_mapp_id=>array('view','id'=>$model->queans_mapp_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List InfowizardQuesansMapping', 'url'=>array('index')),
	array('label'=>'Create InfowizardQuesansMapping', 'url'=>array('create')),
	array('label'=>'View InfowizardQuesansMapping', 'url'=>array('view', 'id'=>$model->queans_mapp_id)),
	array('label'=>'Manage InfowizardQuesansMapping', 'url'=>array('admin')),
);
?>

<h1>Update InfowizardQuesansMapping <?php echo $model->queans_mapp_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>