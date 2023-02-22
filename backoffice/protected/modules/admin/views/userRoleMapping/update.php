<?php
/* @var $this UserRoleMappingController */
/* @var $model UserRoleMapping */

$this->breadcrumbs=array(
	'User Role Mappings'=>array('index'),
	$model->mapping_id=>array('view','id'=>$model->mapping_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserRoleMapping', 'url'=>array('index')),
	array('label'=>'Create UserRoleMapping', 'url'=>array('create')),
	array('label'=>'View UserRoleMapping', 'url'=>array('view', 'id'=>$model->mapping_id)),
	array('label'=>'Manage UserRoleMapping', 'url'=>array('admin')),
);
?>

<h1>Update UserRoleMapping <?php echo $model->mapping_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>