<?php
/* @var $this DocumentsMetainfoController */
/* @var $model DocumentsMetainfo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'documents-metainfo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'doc_id'); ?>
		<?php echo $form->textField($model,'doc_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'doc_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uploaded_by'); ?>
		<?php echo $form->textField($model,'uploaded_by',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'uploaded_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'department_id'); ?>
		<?php echo $form->textField($model,'department_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'department_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'application_id'); ?>
		<?php echo $form->textField($model,'application_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'application_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uploaded_on'); ?>
		<?php echo $form->textField($model,'uploaded_on'); ?>
		<?php echo $form->error($model,'uploaded_on'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->