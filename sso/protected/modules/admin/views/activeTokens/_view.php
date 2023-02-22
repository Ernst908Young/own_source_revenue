<?php
/* @var $this ActiveTokensController */
/* @var $data ActiveTokens */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('token_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->token_id), array('view', 'id'=>$data->token_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('token')); ?>:</b>
	<?php echo CHtml::encode($data->token); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('callback_url')); ?>:</b>
	<?php echo CHtml::encode($data->callback_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('callback_failure_url')); ?>:</b>
	<?php echo CHtml::encode($data->callback_failure_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('callback_success_url')); ?>:</b>
	<?php echo CHtml::encode($data->callback_success_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('token_created_on')); ?>:</b>
	<?php echo CHtml::encode($data->token_created_on); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('token_access_on')); ?>:</b>
	<?php echo CHtml::encode($data->token_access_on); ?>
	<br />

	*/ ?>

</div>