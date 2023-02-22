<?php
/* @var $this ApplicationsController */
/* @var $data Applications */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('application_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->application_id), array('view', 'id'=>$data->application_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('application_name')); ?>:</b>
	<?php echo CHtml::encode($data->application_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('application_desc')); ?>:</b>
	<?php echo CHtml::encode($data->application_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dept_id')); ?>:</b>
	<?php echo CHtml::encode($data->dept_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_application_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_application_active); ?>
	<br />


</div>