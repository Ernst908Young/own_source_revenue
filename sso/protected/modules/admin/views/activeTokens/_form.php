<?php
/* @var $this ActiveTokensController */
/* @var $model ActiveTokens */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'active-tokens-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'token'); ?>
		<?php echo $form->textField($model,'token',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'token'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'callback_url'); ?>
		<?php echo $form->textField($model,'callback_url',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'callback_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'callback_failure_url'); ?>
		<?php echo $form->textField($model,'callback_failure_url',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'callback_failure_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'callback_success_url'); ?>
		<?php echo $form->textField($model,'callback_success_url',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'callback_success_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'token_created_on'); ?>
		<?php echo $form->textField($model,'token_created_on'); ?>
		<?php echo $form->error($model,'token_created_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'token_access_on'); ?>
		<?php echo $form->textField($model,'token_access_on'); ?>
		<?php echo $form->error($model,'token_access_on'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->