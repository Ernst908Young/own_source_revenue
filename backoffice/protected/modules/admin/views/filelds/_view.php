<?php
/* @var $this FileldsController */
/* @var $data Filelds */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('field_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->field_id), array('view', 'id'=>$data->field_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('field_name')); ?>:</b>
	<?php echo CHtml::encode($data->field_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('field_desc')); ?>:</b>
	<?php echo CHtml::encode($data->field_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('filed_type')); ?>:</b>
	<?php echo CHtml::encode($data->filed_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_field_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_field_active); ?>
	<br />


</div>