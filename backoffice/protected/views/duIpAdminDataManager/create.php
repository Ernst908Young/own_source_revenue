<?php
/* @var $this DuIpAdminDataManagerController */
/* @var $model DuIpAdminDataManager */

$this->breadcrumbs=array(
	'Du Ip Admin Data Managers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DuIpAdminDataManager', 'url'=>array('index')),
	array('label'=>'Manage DuIpAdminDataManager', 'url'=>array('admin')),
);
?>

<h1>Create DuIpAdminDataManager</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>