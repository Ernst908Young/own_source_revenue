<?php
/* @var $this CafTemplatesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Caf Templates',
);

$this->menu=array(
    array('label'=>'Create CafTemplates', 'url'=>array('create')),
    array('label'=>'Manage CafTemplates', 'url'=>array('admin')),
);
?>

<h1>Caf Templates</h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
)); ?>