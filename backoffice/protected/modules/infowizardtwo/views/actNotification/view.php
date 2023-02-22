<?php
/* @var $this ActNotificationController */
/* @var $model BoInformationWizardActNotification */

$this->breadcrumbs=array(
	'Bo Information Wizard Act Notifications'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BoInformationWizardActNotification', 'url'=>array('index')),
	array('label'=>'Create BoInformationWizardActNotification', 'url'=>array('create')),
	array('label'=>'Update BoInformationWizardActNotification', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BoInformationWizardActNotification', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BoInformationWizardActNotification', 'url'=>array('admin')),
);
?>

<h1>View BoInformationWizardActNotification #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'act_id',
		'notifiction',
		'notification_doc',
		'is_active',
		'created',
	),
)); ?>
