<?php
/* @var $this ActNotificationController */
/* @var $model BoInformationWizardActNotification */

$this->breadcrumbs=array(
	'Bo Information Wizard Act Notifications'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BoInformationWizardActNotification', 'url'=>array('index')),
	array('label'=>'Create BoInformationWizardActNotification', 'url'=>array('create')),
	array('label'=>'View BoInformationWizardActNotification', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BoInformationWizardActNotification', 'url'=>array('admin')),
);
?>

<h1>Update BoInformationWizardActNotification <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>