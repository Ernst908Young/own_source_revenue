<?php
/* @var $this DuIpAdminDataManagerController */
/* @var $model DuIpAdminDataManager */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'du-ip-admin-data-manager-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'mrn'); ?>
		<?php echo $form->textField($model,'mrn',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'mrn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company_name'); ?>
		<?php echo $form->textField($model,'company_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'company_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'caf_id'); ?>
		<?php echo $form->textField($model,'caf_id'); ?>
		<?php echo $form->error($model,'caf_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'application_status'); ?>
		<?php echo $form->textField($model,'application_status',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'application_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_a'); ?>
		<?php echo $form->textField($model,'is_a',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'is_a'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_b'); ?>
		<?php echo $form->textField($model,'is_b',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'is_b'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_c'); ?>
		<?php echo $form->textField($model,'is_c',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'is_c'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_d'); ?>
		<?php echo $form->textField($model,'is_d',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'is_d'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
		<?php echo $form->error($model,'modified'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_by'); ?>
		<?php echo $form->textField($model,'created_by',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'created_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_active'); ?>
		<?php echo $form->textField($model,'is_active',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'is_active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->