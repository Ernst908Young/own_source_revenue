<?php
/* @var $this ActiveTokensController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Active Tokens',
);

$this->menu=array(
	array('label'=>'Create ActiveTokens', 'url'=>array('create')),
	array('label'=>'Manage ActiveTokens', 'url'=>array('admin')),
);
?>

<h1>Active Tokens</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
