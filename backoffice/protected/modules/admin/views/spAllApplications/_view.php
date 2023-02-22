<?php
/* @var $this SpAllApplicationsController */
/* @var $data SpAllApplications */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('app_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->app_id), array('view', 'id'=>$data->app_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('app_name')); ?>:</b>
	<?php echo CHtml::encode($data->app_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('app_url')); ?>:</b>
	<?php echo CHtml::encode($data->app_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_app_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_app_active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_on')); ?>:</b>
	<?php echo CHtml::encode($data->created_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remote_server')); ?>:</b>
	<?php echo CHtml::encode($data->remote_server); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_agent')); ?>:</b>
	<?php echo CHtml::encode($data->user_agent); ?>
	<br />


</div>