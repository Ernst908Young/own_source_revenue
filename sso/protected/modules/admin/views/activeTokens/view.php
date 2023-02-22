<?php
/* @var $this ActiveTokensController */
/* @var $model ActiveTokens */

$this->breadcrumbs=array(
	'Active Tokens'=>array('index'),
	$model->token_id,
);

$this->menu=array(
	array('label'=>'List ActiveTokens', 'url'=>array('index')),
	array('label'=>'Create ActiveTokens', 'url'=>array('create')),
	array('label'=>'Update ActiveTokens', 'url'=>array('update', 'id'=>$model->token_id)),
	array('label'=>'Delete ActiveTokens', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->token_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ActiveTokens', 'url'=>array('admin')),
);
?>

<h1>View ActiveTokens #<?php echo $model->token_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'token_id',
		'user_id',
		'token',
		'callback_url',
		'callback_failure_url',
		'callback_success_url',
		'token_created_on',
		'token_access_on',
	),
)); ?>
