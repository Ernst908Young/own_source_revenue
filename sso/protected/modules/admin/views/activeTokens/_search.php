<?php
/* @var $this ActiveTokensController */
/* @var $model ActiveTokens */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'token_id'); ?>
		<?php echo $form->textField($model,'token_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'token'); ?>
		<?php echo $form->textField($model,'token',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'callback_url'); ?>
		<?php echo $form->textField($model,'callback_url',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'callback_failure_url'); ?>
		<?php echo $form->textField($model,'callback_failure_url',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'callback_success_url'); ?>
		<?php echo $form->textField($model,'callback_success_url',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'token_created_on'); ?>
		<?php echo $form->textField($model,'token_created_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'token_access_on'); ?>
		<?php echo $form->textField($model,'token_access_on'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->