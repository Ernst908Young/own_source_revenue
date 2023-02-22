<?php
/* @var $this ServiceFormMappingController */
/* @var $model ServiceFormMapping */

$this->breadcrumbs=array(
	'Service Form Mappings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ServiceFormMapping', 'url'=>array('index')),
	array('label'=>'Create ServiceFormMapping', 'url'=>array('create')),
	array('label'=>'View ServiceFormMapping', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ServiceFormMapping', 'url'=>array('admin')),
);
?>

<h1>Update ServiceFormMapping <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>