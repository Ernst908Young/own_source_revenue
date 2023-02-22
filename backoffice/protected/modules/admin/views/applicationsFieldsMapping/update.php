<?php
/* @var $this ApplicationsFieldsMappingController */
/* @var $model ApplicationsFieldsMapping */

$this->breadcrumbs=array(
	'Applications Fields Mappings'=>array('index'),
	$model->app_mapping_id=>array('view','id'=>$model->app_mapping_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ApplicationsFieldsMapping', 'url'=>array('index')),
	array('label'=>'Create ApplicationsFieldsMapping', 'url'=>array('create')),
	array('label'=>'View ApplicationsFieldsMapping', 'url'=>array('view', 'id'=>$model->app_mapping_id)),
	array('label'=>'Manage ApplicationsFieldsMapping', 'url'=>array('admin')),
);
?>

<h1>Update ApplicationsFieldsMapping <?php echo $model->app_mapping_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>