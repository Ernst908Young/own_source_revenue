<?php
/* @var $this DistrictController */
/* @var $model District */

$this->breadcrumbs=array(
	'Districts'=>array('index'),
	$model->district_id=>array('view','id'=>$model->district_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List District', 'url'=>array('index')),
	array('label'=>'Create District', 'url'=>array('create')),
	array('label'=>'View District', 'url'=>array('view', 'id'=>$model->district_id)),
	array('label'=>'Manage District', 'url'=>array('admin')),
);
?>

<h1>Update District <?php echo $model->district_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>