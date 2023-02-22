<?php
/* @var $this ServiceProvidersController */
/* @var $model ServiceProviders */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'service-providers-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'service_provider_name'); ?>
		<?php echo $form->textField($model,'service_provider_name',array('size'=>60,'maxlength'=>512)); ?>
		<?php echo $form->error($model,'service_provider_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'service_provider_tag'); ?>
		<?php echo $form->textField($model,'service_provider_tag',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'service_provider_tag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remote_server_ip'); ?>
		<?php echo $form->textField($model,'remote_server_ip',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'remote_server_ip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'secret_key'); ?>
		<?php echo $form->textField($model,'secret_key',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'secret_key'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'server_base_url'); ?>
		<?php echo $form->textField($model,'server_base_url',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'server_base_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_service_provider_active'); ?>
		<?php echo $form->textField($model,'is_service_provider_active',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'is_service_provider_active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->