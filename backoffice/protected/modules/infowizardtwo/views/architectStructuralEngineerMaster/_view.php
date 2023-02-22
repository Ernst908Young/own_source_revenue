<?php
/* @var $this BoInformationWizardArchitectStructuralEngineerMasterController */
/* @var $data BoInformationWizardArchitectStructuralEngineerMaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('profession_name')); ?>:</b>
	<?php echo CHtml::encode($data->profession_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('profession_body')); ?>:</b>
	<?php echo CHtml::encode($data->profession_body); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />


</div>