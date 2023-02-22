<style type="text/css">
.detail-view{
	color:black;text-shadow:0 0 0 black;
}
</style>
<?php
/* @var $this ServiceProvidersController */
/* @var $model ServiceProviders */

$this->breadcrumbs=array(
	'Service Providers'=>array('index'),
	$model->sp_id,
);

$this->menu=array(
	array('label'=>'List ServiceProviders', 'url'=>array('index')),
	array('label'=>'Create ServiceProviders', 'url'=>array('create')),
	array('label'=>'Update ServiceProviders', 'url'=>array('update', 'id'=>$model->sp_id)),
	array('label'=>'Delete ServiceProviders', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->sp_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ServiceProviders', 'url'=>array('admin')),
);
?>

<h1>View ServiceProviders #<?php echo $model->sp_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'sp_id',
		'service_provider_name',
		'service_provider_tag',
		'remote_server_ip',
		'secret_key',
		'server_base_url',
		'is_service_provider_active',
	),
)); ?>
