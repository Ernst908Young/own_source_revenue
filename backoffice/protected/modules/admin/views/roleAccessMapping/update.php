<?php
/* @var $this RoleAccessMappingController */
/* @var $model RoleAccessMapping */

$this->breadcrumbs=array(
	'Role Access Mappings'=>array('index'),
	$model->map_id=>array('view','id'=>$model->map_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RoleAccessMapping', 'url'=>array('index')),
	array('label'=>'Create RoleAccessMapping', 'url'=>array('create')),
	array('label'=>'View RoleAccessMapping', 'url'=>array('view', 'id'=>$model->map_id)),
	array('label'=>'Manage RoleAccessMapping', 'url'=>array('admin')),
);
?>

<h1>Update RoleAccessMapping <?php echo $model->map_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>