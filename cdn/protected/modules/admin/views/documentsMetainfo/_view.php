<?php
/* @var $this DocumentsMetainfoController */
/* @var $data DocumentsMetainfo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('info_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->info_id), array('view', 'id'=>$data->info_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_id')); ?>:</b>
	<?php echo CHtml::encode($data->doc_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uploaded_by')); ?>:</b>
	<?php echo CHtml::encode($data->uploaded_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('department_id')); ?>:</b>
	<?php echo CHtml::encode($data->department_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('application_id')); ?>:</b>
	<?php echo CHtml::encode($data->application_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uploaded_on')); ?>:</b>
	<?php echo CHtml::encode($data->uploaded_on); ?>
	<br />


</div>