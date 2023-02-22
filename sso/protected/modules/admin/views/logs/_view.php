<?php
/* @var $this LogsController */
/* @var $data Logs */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('log_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->log_id), array('view', 'id'=>$data->log_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('token')); ?>:</b>
	<?php echo CHtml::encode($data->token); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event')); ?>:</b>
	<?php echo CHtml::encode($data->event); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('accessed_from_url')); ?>:</b>
	<?php echo CHtml::encode($data->accessed_from_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('accessed_on')); ?>:</b>
	<?php echo CHtml::encode($data->accessed_on); ?>
	<br />


</div>