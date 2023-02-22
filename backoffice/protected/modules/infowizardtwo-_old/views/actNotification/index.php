<?php
/* @var $this ActNotificationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bo Information Wizard Act Notifications',
);

$this->menu=array(
	array('label'=>'Create BoInformationWizardActNotification', 'url'=>array('create')),
	array('label'=>'Manage BoInformationWizardActNotification', 'url'=>array('admin')),
);
?>

<h1>Bo Information Wizard Act Notifications</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
