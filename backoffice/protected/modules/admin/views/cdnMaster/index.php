<?php
/* @var $this CdnMasterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cdn Masters',
);

$this->menu=array(
	array('label'=>'Create CdnMaster', 'url'=>array('create')),
	array('label'=>'Manage CdnMaster', 'url'=>array('admin')),
);
?>

<h1>Cdn Masters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
