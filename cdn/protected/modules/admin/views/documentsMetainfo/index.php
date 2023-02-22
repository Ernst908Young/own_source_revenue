<?php
/* @var $this DocumentsMetainfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Documents Metainfos',
);

$this->menu=array(
	array('label'=>'Create DocumentsMetainfo', 'url'=>array('create')),
	array('label'=>'Manage DocumentsMetainfo', 'url'=>array('admin')),
);
?>

<h1>Documents Metainfos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
