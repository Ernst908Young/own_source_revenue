<?php
/* @var $this DocumentsController */
/* @var $data Documents */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->doc_id), array('view', 'id'=>$data->doc_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent_doc_id')); ?>:</b>
	<?php echo CHtml::encode($data->parent_doc_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_name')); ?>:</b>
	<?php echo CHtml::encode($data->document_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document')); ?>:</b>
	<?php echo CHtml::encode($data->document); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_version')); ?>:</b>
	<?php echo CHtml::encode($data->document_version); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_mime_type')); ?>:</b>
	<?php echo CHtml::encode($data->document_mime_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_document_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_document_active); ?>
	<br />


</div>