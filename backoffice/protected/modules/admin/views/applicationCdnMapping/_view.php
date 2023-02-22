<?php
/* @var $this ApplicationCdnMappingController */
/* @var $data ApplicationCdnMapping */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('map_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->map_id), array('view', 'id'=>$data->map_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('application_id')); ?>:</b>
	<?php echo CHtml::encode($data->application_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_id')); ?>:</b>
	<?php echo CHtml::encode($data->doc_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_mapping_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_mapping_active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remote_server')); ?>:</b>
	<?php echo CHtml::encode($data->remote_server); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mapping_created_on')); ?>:</b>
	<?php echo CHtml::encode($data->mapping_created_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_agent')); ?>:</b>
	<?php echo CHtml::encode($data->user_agent); ?>
	<br />


</div>