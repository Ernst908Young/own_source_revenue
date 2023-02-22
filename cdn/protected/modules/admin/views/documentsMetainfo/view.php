<?php
/* @var $this DocumentsMetainfoController */
/* @var $model DocumentsMetainfo */

$this->breadcrumbs=array(
	'Documents Metainfos'=>array('index'),
	$model->info_id,
);

$this->menu=array(
	array('label'=>'List DocumentsMetainfo', 'url'=>array('index')),
	array('label'=>'Create DocumentsMetainfo', 'url'=>array('create')),
	array('label'=>'Update DocumentsMetainfo', 'url'=>array('update', 'id'=>$model->info_id)),
	array('label'=>'Delete DocumentsMetainfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->info_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DocumentsMetainfo', 'url'=>array('admin')),
);
?>

<h1>View DocumentsMetainfo #<?php echo $model->info_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'info_id',
		'doc_id',
		'uploaded_by',
		'department_id',
		'application_id',
		'uploaded_on',
	),
)); ?>
