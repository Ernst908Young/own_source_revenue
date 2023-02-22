<?php
/* @var $this SpApplcationsDetailController */
/* @var $data SpApplcationsDetail */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sp_app_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sp_app_id), array('view', 'id'=>$data->sp_app_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('app_id')); ?>:</b>
	<?php echo CHtml::encode($data->app_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timeline_period')); ?>:</b>
	<?php echo CHtml::encode($data->timeline_period); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('form_download_link')); ?>:</b>
	<?php echo CHtml::encode($data->form_download_link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('application_created_on')); ?>:</b>
	<?php echo CHtml::encode($data->application_created_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('procedure_link')); ?>:</b>
	<?php echo CHtml::encode($data->procedure_link); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('remote_ip')); ?>:</b>
	<?php echo CHtml::encode($data->remote_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_agent')); ?>:</b>
	<?php echo CHtml::encode($data->user_agent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_active); ?>
	<br />

	*/ ?>

</div>