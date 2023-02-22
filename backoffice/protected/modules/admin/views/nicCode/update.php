<?php
/* @var $this NicCodeController */
/* @var $model NicCode */

$this->breadcrumbs=array(
	'Nic Codes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List NicCode', 'url'=>array('index')),
	array('label'=>'Create NicCode', 'url'=>array('create')),
	array('label'=>'View NicCode', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage NicCode', 'url'=>array('admin')),
);
?>

<h1>Update NicCode <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>