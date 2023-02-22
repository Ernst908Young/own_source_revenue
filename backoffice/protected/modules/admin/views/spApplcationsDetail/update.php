<?php
/* @var $this SpApplcationsDetailController */
/* @var $model SpApplcationsDetail */

$this->breadcrumbs=array(
	'Sp Applcations Details'=>array('index'),
	$model->sp_app_id=>array('view','id'=>$model->sp_app_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SpApplcationsDetail', 'url'=>array('index')),
	array('label'=>'Create SpApplcationsDetail', 'url'=>array('create')),
	array('label'=>'View SpApplcationsDetail', 'url'=>array('view', 'id'=>$model->sp_app_id)),
	array('label'=>'Manage SpApplcationsDetail', 'url'=>array('admin')),
);
?>

<h1>Update SpApplcationsDetail <?php echo $model->sp_app_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>