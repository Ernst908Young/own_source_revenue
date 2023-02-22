<?php
/* @var $this SpApplcationsDetailController */
/* @var $model SpApplcationsDetail */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'sp_app_id'); ?>
		<?php echo $form->textField($model,'sp_app_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'app_id'); ?>
		<?php echo $form->textField($model,'app_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'timeline_period'); ?>
		<?php echo $form->textField($model,'timeline_period',array('size'=>50,'maxlength'=>50)); ?>
	</div>


	<div class="row">
		<?php echo $form->label($model,'form_download_link'); ?>
		<?php echo $form->textField($model,'form_download_link',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'application_created_on'); ?>
		<?php echo $form->textField($model,'application_created_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'procedure_link'); ?>
		<?php echo $form->textField($model,'procedure_link',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'remote_ip'); ?>
		<?php echo $form->textField($model,'remote_ip',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_agent'); ?>
		<?php echo $form->textField($model,'user_agent',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_active'); ?>
		<?php echo $form->textField($model,'is_active',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->