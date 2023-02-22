<?php
/* @var $this ActNotificationController */
/* @var $model BoInformationWizardActNotification */

$this->breadcrumbs=array(
	'Bo Information Wizard Act Notifications'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BoInformationWizardActNotification', 'url'=>array('index')),
	array('label'=>'Manage BoInformationWizardActNotification', 'url'=>array('admin')),
);
?>

<h1>Create BoInformationWizardActNotification</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>