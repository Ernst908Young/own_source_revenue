<?php
/* @var $this DuIpAdminDataManagerController */
/* @var $model DuIpAdminDataManager */

$this->breadcrumbs=array(
	'Du Ip Admin Data Managers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DuIpAdminDataManager', 'url'=>array('index')),
	array('label'=>'Create DuIpAdminDataManager', 'url'=>array('create')),
	array('label'=>'View DuIpAdminDataManager', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DuIpAdminDataManager', 'url'=>array('admin')),
);
?>

<h1>Update DuIpAdminDataManager <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>