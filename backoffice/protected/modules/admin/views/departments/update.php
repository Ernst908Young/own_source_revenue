<?php
/* @var $this DepartmentsController */
/* @var $model Departments */

$this->breadcrumbs=array(
	'Departments'=>array('index'),
	$model->dept_id=>array('view','id'=>$model->dept_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Departments', 'url'=>array('index')),
	array('label'=>'Create Departments', 'url'=>array('create')),
	array('label'=>'View Departments', 'url'=>array('view', 'id'=>$model->dept_id)),
	array('label'=>'Manage Departments', 'url'=>array('admin')),
);
?>

<h1>Update Departments <?php echo $model->dept_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>