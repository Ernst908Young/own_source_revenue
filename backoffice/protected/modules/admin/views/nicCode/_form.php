<?php
/* @var $this NicCodeController */
/* @var $model NicCode */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'nic-code-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nic_code'); ?>
		<?php echo $form->textField($model,'nic_code',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'nic_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_on'); ?>
		<?php echo $form->textField($model,'created_on'); ?>
		<?php echo $form->error($model,'created_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remote_ip'); ?>
		<?php echo $form->textField($model,'remote_ip',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'remote_ip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_agent'); ?>
		<?php echo $form->textField($model,'user_agent',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'user_agent'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->