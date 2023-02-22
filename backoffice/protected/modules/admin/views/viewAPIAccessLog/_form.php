<?php
/* @var $this ViewAPIAccessLogController */
/* @var $model ApiAccessLog */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'api-access-log-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'sp_tag'); ?>
		<?php echo $form->textField($model,'sp_tag',array('size'=>60,'maxlength'=>512)); ?>
		<?php echo $form->error($model,'sp_tag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'request_method'); ?>
		<?php echo $form->textField($model,'request_method',array('size'=>60,'maxlength'=>512)); ?>
		<?php echo $form->error($model,'request_method'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'request_uri'); ?>
		<?php echo $form->textField($model,'request_uri',array('size'=>60,'maxlength'=>512)); ?>
		<?php echo $form->error($model,'request_uri'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'request_time'); ?>
		<?php echo $form->textField($model,'request_time',array('size'=>60,'maxlength'=>512)); ?>
		<?php echo $form->error($model,'request_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'post_info'); ?>
		<?php echo $form->textArea($model,'post_info',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'post_info'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_agent'); ?>
		<?php echo $form->textField($model,'user_agent',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'user_agent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_date_time'); ?>
		<?php echo $form->textField($model,'created_date_time'); ?>
		<?php echo $form->error($model,'created_date_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remote_ip'); ?>
		<?php echo $form->textField($model,'remote_ip',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'remote_ip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'response_return'); ?>
		<?php echo $form->textArea($model,'response_return',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'response_return'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->