<?php
/* @var $this ApplicationsSubmittionsController */
/* @var $model ApplicationsSubmittions */

$this->breadcrumbs=array(
	'Applications Submittions'=>array('index'),
	$model->submission_id=>array('view','id'=>$model->submission_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ApplicationsSubmittions', 'url'=>array('index')),
	array('label'=>'Create ApplicationsSubmittions', 'url'=>array('create')),
	array('label'=>'View ApplicationsSubmittions', 'url'=>array('view', 'id'=>$model->submission_id)),
	array('label'=>'Manage ApplicationsSubmittions', 'url'=>array('admin')),
);
?>

<h1>Update Application Submission <?php echo $model->submission_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>