<?php
/* @var $this BoInformationWizardServiceParametersController */
/* @var $model BoInformationWizardServiceParameters */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'service_id'); ?>
		<?php echo $form->textField($model,'service_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'service_type'); ?>
		<?php echo $form->textField($model,'service_type',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_online'); ?>
		<?php echo $form->textField($model,'is_online',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_integrated_with_swcs'); ?>
		<?php echo $form->textField($model,'is_integrated_with_swcs',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_in_uttarakhand_right_to_service_act'); ?>
		<?php echo $form->textField($model,'is_in_uttarakhand_right_to_service_act',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_statutory_forms_available'); ?>
		<?php echo $form->textField($model,'is_statutory_forms_available',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'statutory_form_no'); ?>
		<?php echo $form->textField($model,'statutory_form_no',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'statutory_form_upload'); ?>
		<?php echo $form->textField($model,'statutory_form_upload',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'statutory_forms_creation'); ?>
		<?php echo $form->textArea($model,'statutory_forms_creation',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'document_checkList'); ?>
		<?php echo $form->textField($model,'document_checkList',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'document_checklist_upload'); ?>
		<?php echo $form->textArea($model,'document_checklist_upload',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'document_checklist_creation'); ?>
		<?php echo $form->textField($model,'document_checklist_creation',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->