<?php
/* @var $this NicMasterController */
/* @var $model NicMaster */

$this->breadcrumbs=array(
	'Nic Masters'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List NicMaster', 'url'=>array('index')),
	array('label'=>'Create NicMaster', 'url'=>array('create')),
	array('label'=>'View NicMaster', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage NicMaster', 'url'=>array('admin')),
);
?>

<h1>Update NicMaster <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>