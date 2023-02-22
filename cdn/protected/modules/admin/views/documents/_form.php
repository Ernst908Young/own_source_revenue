<?php
/* @var $this DocumentsController */
/* @var $model Documents */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'documents-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'parent_doc_id'); ?>
		<?php echo $form->textField($model,'parent_doc_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'parent_doc_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'document_name'); ?>
		<?php echo $form->textField($model,'document_name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'document_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'document'); ?>
		<?php echo $form->textField($model,'document'); ?>
		<?php echo $form->error($model,'document'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'document_version'); ?>
		<?php echo $form->textField($model,'document_version'); ?>
		<?php echo $form->error($model,'document_version'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'document_mime_type'); ?>
		<?php echo $form->textArea($model,'document_mime_type',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'document_mime_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_document_active'); ?>
		<?php echo $form->textField($model,'is_document_active',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'is_document_active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->