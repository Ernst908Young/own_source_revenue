<?php
/* @var $this ApplicationCdnMappingController */
/* @var $model ApplicationCdnMapping */

$this->breadcrumbs=array(
	'Application Cdn Mappings'=>array('index'),
	$model->map_id,
);

$this->menu=array(
	array('label'=>'List ApplicationCdnMapping', 'url'=>array('index')),
	array('label'=>'Create ApplicationCdnMapping', 'url'=>array('create')),
	array('label'=>'Update ApplicationCdnMapping', 'url'=>array('update', 'id'=>$model->map_id)),
	array('label'=>'Delete ApplicationCdnMapping', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->map_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ApplicationCdnMapping', 'url'=>array('admin')),
);
?>

<h1>View ApplicationCdnMapping #<?php echo $model->map_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'map_id',
		'application_id',
		'doc_id',
		'is_mapping_active',
		'remote_server',
		'mapping_created_on',
		'user_agent',
	),
)); ?>
