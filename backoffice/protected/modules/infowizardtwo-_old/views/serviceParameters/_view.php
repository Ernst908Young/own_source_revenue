<?php
/* @var $this BoInformationWizardServiceParametersController */
/* @var $data BoInformationWizardServiceParameters */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('service_id')); ?>:</b>
	<?php echo CHtml::encode($data->service_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('service_type')); ?>:</b>
	<?php echo CHtml::encode($data->service_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_online')); ?>:</b>
	<?php echo CHtml::encode($data->is_online); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_integrated_with_swcs')); ?>:</b>
	<?php echo CHtml::encode($data->is_integrated_with_swcs); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_in_uttarakhand_right_to_service_act')); ?>:</b>
	<?php echo CHtml::encode($data->is_in_uttarakhand_right_to_service_act); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_statutory_forms_available')); ?>:</b>
	<?php echo CHtml::encode($data->is_statutory_forms_available); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('statutory_form_no')); ?>:</b>
	<?php echo CHtml::encode($data->statutory_form_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statutory_form_upload')); ?>:</b>
	<?php echo CHtml::encode($data->statutory_form_upload); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statutory_forms_creation')); ?>:</b>
	<?php echo CHtml::encode($data->statutory_forms_creation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_checkList')); ?>:</b>
	<?php echo CHtml::encode($data->document_checkList); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_checklist_upload')); ?>:</b>
	<?php echo CHtml::encode($data->document_checklist_upload); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_checklist_creation')); ?>:</b>
	<?php echo CHtml::encode($data->document_checklist_creation); ?>
	<br />

	*/ ?>

</div>