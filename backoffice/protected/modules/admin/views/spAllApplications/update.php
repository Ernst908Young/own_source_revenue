<?php
/* @var $this SpAllApplicationsController */
/* @var $model SpAllApplications */

$this->breadcrumbs=array(
	'Sp All Applications'=>array('index'),
	$model->app_id=>array('view','id'=>$model->app_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SpAllApplications', 'url'=>array('index')),
	array('label'=>'Create SpAllApplications', 'url'=>array('create')),
	array('label'=>'View SpAllApplications', 'url'=>array('view', 'id'=>$model->app_id)),
	array('label'=>'Manage SpAllApplications', 'url'=>array('admin')),
);
?>

<h1>Update SpAllApplications <?php echo $model->app_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>