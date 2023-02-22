<?php
/* @var $this BoLandownerContactController */
/* @var $data BoLandownerContact */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('land_id')); ?>:</b>
	<?php echo CHtml::encode($data->land_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_type')); ?>:</b>
	<?php echo CHtml::encode($data->contact_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owner_name')); ?>:</b>
	<?php echo CHtml::encode($data->owner_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owner_contact_no')); ?>:</b>
	<?php echo CHtml::encode($data->owner_contact_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('owner_alternate_no')); ?>:</b>
	<?php echo CHtml::encode($data->owner_alternate_no); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('owner_email')); ?>:</b>
	<?php echo CHtml::encode($data->owner_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agent_name')); ?>:</b>
	<?php echo CHtml::encode($data->agent_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agent_contact_no')); ?>:</b>
	<?php echo CHtml::encode($data->agent_contact_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agent_alternate_no')); ?>:</b>
	<?php echo CHtml::encode($data->agent_alternate_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agent_email')); ?>:</b>
	<?php echo CHtml::encode($data->agent_email); ?>
	<br />

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