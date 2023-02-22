<?php
/* @var $this RoleAccessController */
/* @var $data RoleAccess */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('access_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->access_id), array('view', 'id'=>$data->access_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('access_name')); ?>:</b>
	<?php echo CHtml::encode($data->access_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('access_created_on')); ?>:</b>
	<?php echo CHtml::encode($data->access_created_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_agent')); ?>:</b>
	<?php echo CHtml::encode($data->user_agent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip_address')); ?>:</b>
	<?php echo CHtml::encode($data->ip_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_active); ?>
	<br />


</div>