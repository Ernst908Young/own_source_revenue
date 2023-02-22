<?php
/* @var $this InfowizardDocumentchklistController */
/* @var $data InfowizardDocumentchklist */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('docchk_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->docchk_id), array('view', 'id'=>$data->docchk_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('chklist_id')); ?>:</b>
	<?php echo CHtml::encode($data->chklist_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_id')); ?>:</b>
	<?php echo CHtml::encode($data->doc_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('issuer_id')); ?>:</b>
	<?php echo CHtml::encode($data->issuer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('issueby_id')); ?>:</b>
	<?php echo CHtml::encode($data->issueby_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('issmap_id')); ?>:</b>
	<?php echo CHtml::encode($data->issmap_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('is_docchklist_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_docchklist_active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	*/ ?>

</div>