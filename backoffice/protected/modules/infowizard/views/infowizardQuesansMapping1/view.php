<?php
/* @var $this InfowizardQuesansMappingController */
/* @var $model InfowizardQuesansMapping */

$this->breadcrumbs=array(
	'Infowizard Quesans Mappings'=>array('index'),
	$model->queans_mapp_id,
);

$this->menu=array(
	array('label'=>'List InfowizardQuesansMapping', 'url'=>array('index')),
	array('label'=>'Create InfowizardQuesansMapping', 'url'=>array('create')),
	array('label'=>'Update InfowizardQuesansMapping', 'url'=>array('update', 'id'=>$model->queans_mapp_id)),
	array('label'=>'Delete InfowizardQuesansMapping', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->queans_mapp_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage InfowizardQuesansMapping', 'url'=>array('admin')),
);
?>

<h1>View InfowizardQuesansMapping #<?php echo $model->queans_mapp_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'queans_mapp_id',
		'department_id',
		'deptservice_id',
		'question_id',
		'anscat_id',
		'answer_detail',
		'is_quesans_active',
		'priority',
		'created_date',
	),
)); ?>
