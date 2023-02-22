<?php
/* @var $this ActiveTokensController */
/* @var $model ActiveTokens */

$this->breadcrumbs=array(
	'Active Tokens'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ActiveTokens', 'url'=>array('index')),
	array('label'=>'Manage ActiveTokens', 'url'=>array('admin')),
);
?>

<h1>Create ActiveTokens</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>