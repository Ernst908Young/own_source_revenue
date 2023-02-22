<?php
/* @var $this DuIpAdminDataManagerController */
/* @var $model DuIpAdminDataManager */

$this->breadcrumbs=array(
	'Du Ip Admin Data Managers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DuIpAdminDataManager', 'url'=>array('index')),
	array('label'=>'Create DuIpAdminDataManager', 'url'=>array('create')),
	array('label'=>'Update DuIpAdminDataManager', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DuIpAdminDataManager', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DuIpAdminDataManager', 'url'=>array('admin')),
);
?>

<h1>View DuIpAdminDataManager #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'mrn',
		'company_name',
		'caf_id',
		'application_status',
		'is_a',
		'is_b',
		'is_c',
		'is_d',
		'created',
		'modified',
		'created_by',
		'is_active',
	),
)); ?>
