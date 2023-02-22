<?php
/* @var $this DocumentsController */
/* @var $model Documents */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'doc_id'); ?>
		<?php echo $form->textField($model,'doc_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parent_doc_id'); ?>
		<?php echo $form->textField($model,'parent_doc_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'document_name'); ?>
		<?php echo $form->textField($model,'document_name',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'document'); ?>
		<?php echo $form->textField($model,'document'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'document_version'); ?>
		<?php echo $form->textField($model,'document_version'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'document_mime_type'); ?>
		<?php echo $form->textArea($model,'document_mime_type',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_document_active'); ?>
		<?php echo $form->textField($model,'is_document_active',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->