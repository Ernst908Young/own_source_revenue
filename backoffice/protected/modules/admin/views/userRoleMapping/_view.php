<?php
/* @var $this UserRoleMappingController */
/* @var $data UserRoleMapping */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('mapping_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->mapping_id), array('view', 'id'=>$data->mapping_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('role_id')); ?>:</b>
	<?php echo CHtml::encode($data->role_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('department_id')); ?>:</b>
	<?php echo CHtml::encode($data->department_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lr_id')); ?>:</b>
	<?php echo CHtml::encode($data->lr_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_time')); ?>:</b>
	<?php echo CHtml::encode($data->created_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_time')); ?>:</b>
	<?php echo CHtml::encode($data->modified_time); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('is_mapping_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_mapping_active); ?>
	<br />

	*/ ?>

</div>