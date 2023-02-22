<?php
/* @var $this ApplicationsFieldsMappingController */
/* @var $model ApplicationsFieldsMapping */

$this->breadcrumbs=array(
	'Applications Fields Mappings'=>array('index'),
	$model->app_mapping_id,
);

$this->menu=array(
	array('label'=>'List ApplicationsFieldsMapping', 'url'=>array('index')),
	array('label'=>'Create ApplicationsFieldsMapping', 'url'=>array('create')),
	array('label'=>'Update ApplicationsFieldsMapping', 'url'=>array('update', 'id'=>$model->app_mapping_id)),
	array('label'=>'Delete ApplicationsFieldsMapping', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->app_mapping_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ApplicationsFieldsMapping', 'url'=>array('admin')),
);
?>

<h1>View ApplicationsFieldsMapping #<?php echo $model->app_mapping_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'app_mapping_id',
		'application_id',
		'field_id',
		'field_name',
		'field_value',
		'is_mapping_active',
	),
)); ?>
