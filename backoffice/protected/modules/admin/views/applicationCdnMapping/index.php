<?php
/* @var $this ApplicationCdnMappingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Application Cdn Mappings',
);

$this->menu=array(
	array('label'=>'Create ApplicationCdnMapping', 'url'=>array('create')),
	array('label'=>'Manage ApplicationCdnMapping', 'url'=>array('admin')),
);
?>

<h1>Application Cdn Mappings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
