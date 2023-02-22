<?php
/* @var $this ActiveTokensController */
/* @var $model ActiveTokens */

$this->breadcrumbs=array(
	'Active Tokens'=>array('index'),
	$model->token_id=>array('view','id'=>$model->token_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ActiveTokens', 'url'=>array('index')),
	array('label'=>'Create ActiveTokens', 'url'=>array('create')),
	array('label'=>'View ActiveTokens', 'url'=>array('view', 'id'=>$model->token_id)),
	array('label'=>'Manage ActiveTokens', 'url'=>array('admin')),
);
?>

<h1>Update ActiveTokens <?php echo $model->token_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>