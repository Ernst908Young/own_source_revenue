<?php
/* @var $this InfowizardQuestionMasterController */
/* @var $model InfowizardQuestionMaster */

$this->breadcrumbs=array(
	'Infowizard Question Masters'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List InfowizardQuestionMaster', 'url'=>array('index')),
	array('label'=>'Create InfowizardQuestionMaster', 'url'=>array('create')),
	array('label'=>'Update InfowizardQuestionMaster', 'url'=>array('update', 'id'=>$model->question_id)),
	array('label'=>'Delete InfowizardQuestionMaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->question_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage InfowizardQuestionMaster', 'url'=>array('admin')),
);
?>

<h1>View InfowizardQuestionMaster #<?php echo $model->question_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'question_id',
		'name',
		'is_question_active',
		'created_date',
	),
)); ?>
