<?php
/* @var $this DuIpAdminDataManagerController */
/* @var $data DuIpAdminDataManager */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mrn')); ?>:</b>
	<?php echo CHtml::encode($data->mrn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_name')); ?>:</b>
	<?php echo CHtml::encode($data->company_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caf_id')); ?>:</b>
	<?php echo CHtml::encode($data->caf_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('application_status')); ?>:</b>
	<?php echo CHtml::encode($data->application_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_a')); ?>:</b>
	<?php echo CHtml::encode($data->is_a); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_b')); ?>:</b>
	<?php echo CHtml::encode($data->is_b); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('is_c')); ?>:</b>
	<?php echo CHtml::encode($data->is_c); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_d')); ?>:</b>
	<?php echo CHtml::encode($data->is_d); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified')); ?>:</b>
	<?php echo CHtml::encode($data->modified); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_active); ?>
	<br />

	*/ ?>

</div>