<?php
/* @var $this InfowizardQuesansMappingController */
/* @var $data InfowizardQuesansMapping */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('queans_mapp_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->queans_mapp_id), array('view', 'id'=>$data->queans_mapp_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('department_id')); ?>:</b>
	<?php echo CHtml::encode($data->department_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deptservice_id')); ?>:</b>
	<?php echo CHtml::encode($data->deptservice_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('question_id')); ?>:</b>
	<?php echo CHtml::encode($data->question_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('anscat_id')); ?>:</b>
	<?php echo CHtml::encode($data->anscat_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('answer_detail')); ?>:</b>
	<?php echo CHtml::encode($data->answer_detail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_quesans_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_quesans_active); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('priority')); ?>:</b>
	<?php echo CHtml::encode($data->priority); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	*/ ?>

</div>