<?php
/* @var $this LandregionController */
/* @var $data Landregion */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('lr_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->lr_id), array('view', 'id'=>$data->lr_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lr_name')); ?>:</b>
	<?php echo CHtml::encode($data->lr_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lr_type')); ?>:</b>
	<?php echo CHtml::encode($data->lr_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hadbast_number')); ?>:</b>
	<?php echo CHtml::encode($data->hadbast_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vtc_code')); ?>:</b>
	<?php echo CHtml::encode($data->vtc_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_lr_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_lr_active); ?>
	<br />


</div>