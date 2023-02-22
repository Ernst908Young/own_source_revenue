<?php
/* @var $this LandregionController */
/* @var $model Landregion */

$this->breadcrumbs=array(
	'Landregions'=>array('index'),
	$model->lr_id=>array('view','id'=>$model->lr_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Landregion', 'url'=>array('index')),
	array('label'=>'Create Landregion', 'url'=>array('create')),
	array('label'=>'View Landregion', 'url'=>array('view', 'id'=>$model->lr_id)),
	array('label'=>'Manage Landregion', 'url'=>array('admin')),
);
?>

<h1>Update Landregion <?php echo $model->lr_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>