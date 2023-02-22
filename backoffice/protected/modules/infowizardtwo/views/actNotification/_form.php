<?php
/* @var $this ActNotificationController */
/* @var $model BoInformationWizardActNotification */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bo-information-wizard-act-notification-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'act_id'); ?>
		<?php echo $form->textField($model,'act_id'); ?>
		<?php echo $form->error($model,'act_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notifiction'); ?>
		<?php echo $form->textArea($model,'notifiction',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notifiction'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notification_doc'); ?>
		<?php echo $form->textField($model,'notification_doc',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'notification_doc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_active'); ?>
		<?php echo $form->textField($model,'is_active',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'is_active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->