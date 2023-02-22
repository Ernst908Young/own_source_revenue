<?php
/* @var $this RoleAccessController */
/* @var $model RoleAccess */

$this->breadcrumbs=array(
	'Role Accesses'=>array('index'),
	$model->access_id=>array('view','id'=>$model->access_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RoleAccess', 'url'=>array('index')),
	array('label'=>'Create RoleAccess', 'url'=>array('create')),
	array('label'=>'View RoleAccess', 'url'=>array('view', 'id'=>$model->access_id)),
	array('label'=>'Manage RoleAccess', 'url'=>array('admin')),
);
?>

<h1>Update RoleAccess <?php echo $model->access_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>