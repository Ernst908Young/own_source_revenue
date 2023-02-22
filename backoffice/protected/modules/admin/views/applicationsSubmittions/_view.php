<?php
/* @var $this ApplicationsSubmittionsController */
/* @var $data ApplicationsSubmittions */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('submission_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->submission_id), array('view', 'id'=>$data->submission_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('application_id')); ?>:</b>
	<?php echo CHtml::encode($data->application_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('field_id')); ?>:</b>
	<?php echo CHtml::encode($data->field_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('field_value')); ?>:</b>
	<?php echo CHtml::encode($data->field_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('application_status')); ?>:</b>
	<?php echo CHtml::encode($data->application_status); ?>
	<br />


</div>