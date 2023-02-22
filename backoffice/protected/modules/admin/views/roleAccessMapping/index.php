<?php
/* @var $this RoleAccessMappingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Role Access Mappings',
);

$this->menu=array(
	array('label'=>'Create RoleAccessMapping', 'url'=>array('create')),
	array('label'=>'Manage RoleAccessMapping', 'url'=>array('admin')),
);
?>

<h1>Role Access Mappings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
