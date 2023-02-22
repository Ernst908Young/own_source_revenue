<?php
/* @var $this LandregionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Landregions',
);

$this->menu=array(
	array('label'=>'Create Landregion', 'url'=>array('create')),
	array('label'=>'Manage Landregion', 'url'=>array('admin')),
);
?>

<h1>Landregions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
