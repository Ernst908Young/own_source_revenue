<?php
/* @var $this ApplicationCdnMappingController */
/* @var $model ApplicationCdnMapping */

$this->breadcrumbs=array(
	'Application Cdn Mappings'=>array('index'),
	$model->map_id=>array('view','id'=>$model->map_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ApplicationCdnMapping', 'url'=>array('index')),
	array('label'=>'Create ApplicationCdnMapping', 'url'=>array('create')),
	array('label'=>'View ApplicationCdnMapping', 'url'=>array('view', 'id'=>$model->map_id)),
	array('label'=>'Manage ApplicationCdnMapping', 'url'=>array('admin')),
);
?>

<h1>Update ApplicationCdnMapping <?php echo $model->map_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>