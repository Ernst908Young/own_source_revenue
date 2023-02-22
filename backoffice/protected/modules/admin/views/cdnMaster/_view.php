<?php
/* @var $this CdnMasterController */
/* @var $data CdnMaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->doc_id), array('view', 'id'=>$data->doc_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_name')); ?>:</b>
	<?php echo CHtml::encode($data->doc_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_type')); ?>:</b>
	<?php echo CHtml::encode($data->doc_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_max_size')); ?>:</b>
	<?php echo CHtml::encode($data->doc_max_size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_min_size')); ?>:</b>
	<?php echo CHtml::encode($data->doc_min_size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_created_on')); ?>:</b>
	<?php echo CHtml::encode($data->doc_created_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remote_ip')); ?>:</b>
	<?php echo CHtml::encode($data->remote_ip); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_agent')); ?>:</b>
	<?php echo CHtml::encode($data->user_agent); ?>
	<br />

	*/ ?>

</div>