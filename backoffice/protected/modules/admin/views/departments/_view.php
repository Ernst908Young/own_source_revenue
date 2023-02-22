<?php
/* @var $this DepartmentsController */
/* @var $data Departments */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('dept_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->dept_id), array('view', 'id'=>$data->dept_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('department_name')); ?>:</b>
	<?php echo CHtml::encode($data->department_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('department_unique_code')); ?>:</b>
	<?php echo CHtml::encode($data->department_unique_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('department_link')); ?>:</b>
	<?php echo CHtml::encode($data->department_link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('department_img')); ?>:</b>
	<?php echo CHtml::encode($data->department_img); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('added_on')); ?>:</b>
	<?php echo CHtml::encode($data->added_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dept_order')); ?>:</b>
	<?php echo CHtml::encode($data->dept_order); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_on')); ?>:</b>
	<?php echo CHtml::encode($data->updated_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_department_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_department_active); ?>
	<br />

	*/ ?>

</div>