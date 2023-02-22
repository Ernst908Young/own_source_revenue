<?php
/* @var $this DocumentsMetainfoController */
/* @var $model DocumentsMetainfo */

$this->breadcrumbs=array(
	'Documents Metainfos'=>array('index'),
	$model->info_id=>array('view','id'=>$model->info_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DocumentsMetainfo', 'url'=>array('index')),
	array('label'=>'Create DocumentsMetainfo', 'url'=>array('create')),
	array('label'=>'View DocumentsMetainfo', 'url'=>array('view', 'id'=>$model->info_id)),
	array('label'=>'Manage DocumentsMetainfo', 'url'=>array('admin')),
);
?>

<h1>Update DocumentsMetainfo <?php echo $model->info_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>