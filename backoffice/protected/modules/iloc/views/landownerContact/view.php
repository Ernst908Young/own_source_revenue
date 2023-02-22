<?php
/* @var $this BoLandownerContactController */
/* @var $model BoLandownerContact */

$this->breadcrumbs=array(
	'Bo Landowner Contacts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BoLandownerContact', 'url'=>array('index')),
	array('label'=>'Create BoLandownerContact', 'url'=>array('create')),
	array('label'=>'Update BoLandownerContact', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BoLandownerContact', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BoLandownerContact', 'url'=>array('admin')),
);
?>

<h1>View BoLandownerContact #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'land_id',
		'contact_type',
		'owner_name',
		'owner_contact_no',
		'owner_alternate_no',
		'owner_email',
		'agent_name',
		'agent_contact_no',
		'agent_alternate_no',
		'agent_email',
		'is_active',
		'created',
		'modified',
	),
)); ?>
