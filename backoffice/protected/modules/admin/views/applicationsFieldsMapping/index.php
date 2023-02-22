<?php
/* @var $this ApplicationsFieldsMappingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Applications Fields Mappings',
);

$this->menu=array(
	array('label'=>'Create ApplicationsFieldsMapping', 'url'=>array('create')),
	array('label'=>'Manage ApplicationsFieldsMapping', 'url'=>array('admin')),
);
?>

<h1>Applications Fields Mappings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
