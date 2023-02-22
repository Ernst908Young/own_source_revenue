<?php
/* @var $this CdnMasterController */
/* @var $model CdnMaster */
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
		<?php echo $form->label($model,'doc_name'); ?>
		<?php echo $form->textField($model,'doc_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'doc_type'); ?>
		<?php echo $form->textField($model,'doc_type',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'doc_max_size'); ?>
		<?php echo $form->textField($model,'doc_max_size',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'doc_min_size'); ?>
		<?php echo $form->textField($model,'doc_min_size',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'doc_created_on'); ?>
		<?php echo $form->textField($model,'doc_created_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'remote_ip'); ?>
		<?php echo $form->textField($model,'remote_ip',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_agent'); ?>
		<?php echo $form->textField($model,'user_agent',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->