<?php
/* @var $this DuIpAdminDataManagerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Du Ip Admin Data Managers',
);

$this->menu=array(
	array('label'=>'Create DuIpAdminDataManager', 'url'=>array('create')),
	array('label'=>'Manage DuIpAdminDataManager', 'url'=>array('admin')),
);
?>

<h1>Du Ip Admin Data Managers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
