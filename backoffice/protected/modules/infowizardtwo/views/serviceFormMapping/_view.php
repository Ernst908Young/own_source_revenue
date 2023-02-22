<?php
/* @var $this ServiceFormMappingController */
/* @var $data ServiceFormMapping */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('department_id')); ?>:</b>
	<?php echo CHtml::encode($data->department_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('service_id')); ?>:</b>
	<?php echo CHtml::encode($data->service_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('form_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->form_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('form_name')); ?>:</b>
	<?php echo CHtml::encode($data->form_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('form_code')); ?>:</b>
	<?php echo CHtml::encode($data->form_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('form_version')); ?>:</b>
	<?php echo CHtml::encode($data->form_version); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />

	*/ ?>

</div>