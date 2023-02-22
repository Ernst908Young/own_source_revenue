<?php
/* @var $this ApplicationsSubmittionsController */
/* @var $model ApplicationsSubmittions */

$this->breadcrumbs=array(
	'Applications Submittions'=>array('index'),
	$model->submission_id,
);

$this->menu=array(
	array('label'=>'List ApplicationsSubmittions', 'url'=>array('index')),
	array('label'=>'Create ApplicationsSubmittions', 'url'=>array('create')),
	array('label'=>'Update ApplicationsSubmittions', 'url'=>array('update', 'id'=>$model->submission_id)),
	array('label'=>'Delete ApplicationsSubmittions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->submission_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ApplicationsSubmittions', 'url'=>array('admin')),
);
?>

<h1>View Application Submission #<?php echo $model->submission_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'submission_id',
		'application_id',
		'user_id',
		'field_id',
		'field_value',
		'application_status',
	),
)); ?>
