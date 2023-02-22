<?php
/* @var $this PredefinedDepartmentMessageController */
/* @var $model PredefinedDepartmentMessage */

$this->breadcrumbs=array(
	'Predefined Department Messages'=>array('index'),
	$model->message_id,
);

$this->menu=array(
	array('label'=>'List PredefinedDepartmentMessage', 'url'=>array('index')),
	array('label'=>'Create PredefinedDepartmentMessage', 'url'=>array('create')),
	array('label'=>'Update PredefinedDepartmentMessage', 'url'=>array('update', 'id'=>$model->message_id)),
	array('label'=>'Delete PredefinedDepartmentMessage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->message_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PredefinedDepartmentMessage', 'url'=>array('admin')),
);
?>

<h1>View PredefinedDepartmentMessage #<?php echo $model->message_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'message_id',
		'message',
		'is_active',
		'created_on',
	),
)); ?>
