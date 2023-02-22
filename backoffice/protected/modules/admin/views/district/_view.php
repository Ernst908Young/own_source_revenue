<?php
/* @var $this DistrictController */
/* @var $data District */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('district_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->district_id), array('view', 'id'=>$data->district_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('distric_name')); ?>:</b>
	<?php echo CHtml::encode($data->distric_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_on')); ?>:</b>
	<?php echo CHtml::encode($data->created_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_active); ?>
	<br />


</div>