<?php
/* @var $this LandownerConnectController */
/* @var $model LandownerConnect */

$this->breadcrumbs=array(
	'Landrequester Connects'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
