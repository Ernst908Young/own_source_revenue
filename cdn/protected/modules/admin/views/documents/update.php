<?php
/* @var $this DocumentsController */
/* @var $model Documents */

$this->breadcrumbs=array(
	'Documents'=>array('index'),
	$model->doc_id=>array('view','id'=>$model->doc_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Documents', 'url'=>array('index')),
	array('label'=>'Create Documents', 'url'=>array('create')),
	array('label'=>'View Documents', 'url'=>array('view', 'id'=>$model->doc_id)),
	array('label'=>'Manage Documents', 'url'=>array('admin')),
);
?>

<h1>Update Documents <?php echo $model->doc_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>