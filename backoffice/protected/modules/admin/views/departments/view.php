<?php
/* @var $this DepartmentsController */
/* @var $model Departments */

$this->breadcrumbs=array(
	'Departments'=>array('index'),
	$model->dept_id,
);

$this->menu=array(
	array('label'=>'List Departments', 'url'=>array('index')),
	array('label'=>'Create Departments', 'url'=>array('create')),
	array('label'=>'Update Departments', 'url'=>array('update', 'id'=>$model->dept_id)),
	array('label'=>'Delete Departments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->dept_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Departments', 'url'=>array('admin')),
);
?>

<h1>View Departments #<?php echo $model->dept_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'dept_id',
		'department_name',
		'department_unique_code',
		'department_link',
		'department_img',
		'added_on',
		'dept_order',
		'updated_on',
		'is_department_active',
	),
)); ?>
