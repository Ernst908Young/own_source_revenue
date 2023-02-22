<?php
/* @var $this CdnMasterController */
/* @var $model CdnMaster */

$this->breadcrumbs=array(
	'Cdn Masters'=>array('index'),
	$model->doc_id=>array('view','id'=>$model->doc_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CdnMaster', 'url'=>array('index')),
	array('label'=>'Create CdnMaster', 'url'=>array('create')),
	array('label'=>'View CdnMaster', 'url'=>array('view', 'id'=>$model->doc_id)),
	array('label'=>'Manage CdnMaster', 'url'=>array('admin')),
);
?>

<h1>Update CdnMaster <?php echo $model->doc_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>