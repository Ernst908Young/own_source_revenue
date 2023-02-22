<?php
/* @var $this PredefinedDepartmentMessageController */
/* @var $model PredefinedDepartmentMessage */

$this->breadcrumbs=array(
	'Predefined Department Messages'=>array('index'),
	$model->message_id=>array('view','id'=>$model->message_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PredefinedDepartmentMessage', 'url'=>array('index')),
	array('label'=>'Create PredefinedDepartmentMessage', 'url'=>array('create')),
	array('label'=>'View PredefinedDepartmentMessage', 'url'=>array('view', 'id'=>$model->message_id)),
	array('label'=>'Manage PredefinedDepartmentMessage', 'url'=>array('admin')),
);
?>

<h1>Update PredefinedDepartmentMessage <?php echo $model->message_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>