<?php
/* @var $this ViewAPIAccessLogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Api Access Logs',
);

$this->menu=array(
	array('label'=>'Create ApiAccessLog', 'url'=>array('create')),
	array('label'=>'Manage ApiAccessLog', 'url'=>array('admin')),
);
?>

<h1>Api Access Logs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
