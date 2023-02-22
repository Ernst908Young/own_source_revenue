<?php
/* @var $this ServiceProvidersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Service Providers',
);

$this->menu=array(
	array('label'=>'Create ServiceProviders', 'url'=>array('create')),
	array('label'=>'Manage ServiceProviders', 'url'=>array('admin')),
);
?>

<h1>Service Providers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
