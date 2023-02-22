<?php
/* @var $this NicCodeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Nic Codes',
);

$this->menu=array(
	array('label'=>'Create NicCode', 'url'=>array('create')),
	array('label'=>'Manage NicCode', 'url'=>array('admin')),
);
?>

<h1>Nic Codes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
