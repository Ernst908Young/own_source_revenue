<?php
/* @var $this ApplicationsFieldsMappingController */
/* @var $data ApplicationsFieldsMapping */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('app_mapping_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->app_mapping_id), array('view', 'id'=>$data->app_mapping_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('application_id')); ?>:</b>
	<?php echo CHtml::encode($data->application_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('field_id')); ?>:</b>
	<?php echo CHtml::encode($data->field_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('field_name')); ?>:</b>
	<?php echo CHtml::encode($data->field_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('field_value')); ?>:</b>
	<?php echo CHtml::encode($data->field_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_mapping_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_mapping_active); ?>
	<br />


</div>