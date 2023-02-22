<?php
/* @var $this CafTemplatesController */
/* @var $model CafTemplates */

$this->breadcrumbs=array(
    'Caf Templates'=>array('index'),
    'Create',
);

$this->menu=array(
   // array('label'=>'List CafTemplates', 'url'=>array('index')),
    array('label'=>'Manage CafTemplates', 'url'=>array('admin')),
);
?>

<!--<h1>Create CafTemplates</h1>-->

<?php $this->renderPartial('_form', array('model'=>$model)); ?>