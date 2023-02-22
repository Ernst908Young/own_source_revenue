<?php
/* @var $this CdnMasterController */
/* @var $model CdnMaster */

$this->breadcrumbs=array(
	'Cdn Masters'=>array('index'),
	$model->doc_id,
);

$this->menu=array(
	array('label'=>'List CdnMaster', 'url'=>array('index')),
	array('label'=>'Create CdnMaster', 'url'=>array('create')),
	array('label'=>'Update CdnMaster', 'url'=>array('update', 'id'=>$model->doc_id)),
	array('label'=>'Delete CdnMaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->doc_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CdnMaster', 'url'=>array('admin')),
);
?>

<h1>View CdnMaster #<?php echo $model->doc_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'doc_id',
		'doc_name',
		'doc_type',
		'doc_max_size',
		'doc_min_size',
		'doc_created_on',
		'remote_ip',
		'user_agent',
	),
)); ?>
