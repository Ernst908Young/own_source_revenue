<?php
/* @var $this LandregionController */
/* @var $model Landregion */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'landregion-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'lr_name'); ?>
		<?php echo $form->textField($model,'lr_name',array('size'=>60,'maxlength'=>90)); ?>
		<?php echo $form->error($model,'lr_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lr_type'); ?>
		<?php echo $form->textField($model,'lr_type',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'lr_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hadbast_number'); ?>
		<?php echo $form->textField($model,'hadbast_number',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'hadbast_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vtc_code'); ?>
		<?php echo $form->textField($model,'vtc_code',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'vtc_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_lr_active'); ?>
		<?php echo $form->textField($model,'is_lr_active',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'is_lr_active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->