<?php
/* @var $this BoLandownerContactController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bo Landowner Contacts',
);

$this->menu=array(
	array('label'=>'Create BoLandownerContact', 'url'=>array('create')),
	array('label'=>'Manage BoLandownerContact', 'url'=>array('admin')),
);
?>

<h1>Bo Landowner Contacts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
