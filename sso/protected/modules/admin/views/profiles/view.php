<?php
/* @var $this ProfilesController */
/* @var $model Profiles */

$this->breadcrumbs=array(
	'Profiles'=>array('index'),
	$model->profile_id,
);

$this->menu=array(
	array('label'=>'List Profiles', 'url'=>array('index')),
	array('label'=>'Create Profiles', 'url'=>array('create')),
	array('label'=>'Update Profiles', 'url'=>array('update', 'id'=>$model->profile_id)),
	array('label'=>'Delete Profiles', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->profile_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Profiles', 'url'=>array('admin')),
);
?>

<h1>View Profiles #<?php echo $model->profile_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'profile_id',
		'user_id',
		'first_name',
		'last_name',
		'pan_card',
		'adhaar_number',
		'country_name',
		'state_name',
		'city_name',
		'address',
		'mobile_number',
	),
)); ?>
