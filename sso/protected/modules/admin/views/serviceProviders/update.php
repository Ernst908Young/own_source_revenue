<?php
/* @var $this ServiceProvidersController */
/* @var $model ServiceProviders */

$this->breadcrumbs=array(
	'Service Providers'=>array('index'),
	$model->sp_id=>array('view','id'=>$model->sp_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ServiceProviders', 'url'=>array('index')),
	array('label'=>'Create ServiceProviders', 'url'=>array('create')),
	array('label'=>'View ServiceProviders', 'url'=>array('view', 'id'=>$model->sp_id)),
	array('label'=>'Manage ServiceProviders', 'url'=>array('admin')),
);
?>

<h1>Update ServiceProviders <?php echo $model->sp_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>