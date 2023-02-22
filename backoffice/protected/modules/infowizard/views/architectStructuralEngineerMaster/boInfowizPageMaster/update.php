<?php
/* @var $this BoInfowizPageMasterController */
/* @var $model BoInfowizPageMaster */

$this->breadcrumbs=array(
	'Bo Infowiz Page Masters'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BoInfowizPageMaster', 'url'=>array('index')),
	array('label'=>'Create BoInfowizPageMaster', 'url'=>array('create')),
	array('label'=>'View BoInfowizPageMaster', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BoInfowizPageMaster', 'url'=>array('admin')),
);
?>

<h1>Update BoInfowizPageMaster <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>