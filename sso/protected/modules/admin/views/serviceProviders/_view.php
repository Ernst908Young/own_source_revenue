<?php
/* @var $this ServiceProvidersController */
/* @var $data ServiceProviders */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sp_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sp_id), array('view', 'id'=>$data->sp_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('service_provider_name')); ?>:</b>
	<?php echo CHtml::encode($data->service_provider_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('service_provider_tag')); ?>:</b>
	<?php echo CHtml::encode($data->service_provider_tag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remote_server_ip')); ?>:</b>
	<?php echo CHtml::encode($data->remote_server_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('secret_key')); ?>:</b>
	<?php echo CHtml::encode($data->secret_key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('server_base_url')); ?>:</b>
	<?php echo CHtml::encode($data->server_base_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_service_provider_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_service_provider_active); ?>
	<br />


</div>