<?php
/* @var $this InfowizardFormvariableMasterController */
/* @var $data InfowizardFormvariableMaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('formvar_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->formvar_id), array('view', 'id'=>$data->formvar_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('formchk_id')); ?>:</b>
	<?php echo CHtml::encode($data->formchk_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_formvar_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_formvar_active); ?>
	<br />


</div>