<?php
/* @var $this CafTemplatesController */
/* @var $model CafTemplates */

$this->breadcrumbs=array(
    'Caf Templates'=>array('index'),
    $model->id=>array('view','id'=>$model->id),
    'Update',
);

$this->menu=array(
   // array('label'=>'List CafTemplates', 'url'=>array('index')),
    array('label'=>'Create CafTemplates', 'url'=>array('create')),
    array('label'=>'View CafTemplates', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Manage CafTemplates', 'url'=>array('admin')),
);
?>

<!--<h1>Update CafTemplates <?php //echo $model->id; ?></h1>-->

<?php $this->renderPartial('_form', array('model'=>$model)); ?>