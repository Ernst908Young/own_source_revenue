<?php
/* @var $this ProfilesController */
/* @var $model Profiles */

$this->breadcrumbs=array(
	'Profiles'=>array('index'),
	$model->profile_id=>array('view','id'=>$model->profile_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Profiles', 'url'=>array('index')),
	array('label'=>'Create Profiles', 'url'=>array('create')),
	array('label'=>'View Profiles', 'url'=>array('view', 'id'=>$model->profile_id)),
	array('label'=>'Manage Profiles', 'url'=>array('admin')),
);
?>

<h1>Update Profiles <?php echo $model->profile_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>