<?php
/* @var $this ActNotificationController */
/* @var $data BoInformationWizardActNotification */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('act_id')); ?>:</b>
	<?php echo CHtml::encode($data->act_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notifiction')); ?>:</b>
	<?php echo CHtml::encode($data->notifiction); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notification_doc')); ?>:</b>
	<?php echo CHtml::encode($data->notification_doc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />


</div>