<?php
/* @var $this ServiceFormMappingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Service Form Mappings',
);

$this->menu=array(
	array('label'=>'Create ServiceFormMapping', 'url'=>array('create')),
	array('label'=>'Manage ServiceFormMapping', 'url'=>array('admin')),
);
?>

<h1>Service Form Mappings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
