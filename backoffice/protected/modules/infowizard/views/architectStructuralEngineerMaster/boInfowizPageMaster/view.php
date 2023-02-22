<?php
/* @var $this BoInfowizPageMasterController */
/* @var $model BoInfowizPageMaster */

$this->breadcrumbs=array(
	'Bo Infowiz Page Masters'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BoInfowizPageMaster', 'url'=>array('index')),
	array('label'=>'Create BoInfowizPageMaster', 'url'=>array('create')),
	array('label'=>'Update BoInfowizPageMaster', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BoInfowizPageMaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BoInfowizPageMaster', 'url'=>array('admin')),
);
?>

<h1>View BoInfowizPageMaster #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'service_id',
		'page_name',
		'is_active',
		'created',
		'modified',
	),
)); ?>
