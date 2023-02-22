<?php
/* @var $this FileldsController */
/* @var $model Filelds */

$this->breadcrumbs=array(
	'Filelds'=>array('index'),
	$model->field_id=>array('view','id'=>$model->field_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Filelds', 'url'=>array('index')),
	array('label'=>'Create Filelds', 'url'=>array('create')),
	array('label'=>'View Filelds', 'url'=>array('view', 'id'=>$model->field_id)),
	array('label'=>'Manage Filelds', 'url'=>array('admin')),
);
?>

<h1>Update Fields <?php echo $model->field_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>