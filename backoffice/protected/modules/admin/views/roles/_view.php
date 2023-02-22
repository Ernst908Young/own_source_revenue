<?php
/* @var $this RolesController */
/* @var $data Roles */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('role_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->role_id), array('view', 'id'=>$data->role_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('role_name')); ?>:</b>
	<?php echo CHtml::encode($data->role_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rele_desc')); ?>:</b>
	<?php echo CHtml::encode($data->rele_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_role_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_role_active); ?>
	<br />


</div>