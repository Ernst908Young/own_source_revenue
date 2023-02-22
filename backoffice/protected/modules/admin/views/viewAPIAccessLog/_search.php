<?php
/* @var $this ViewAPIAccessLogController */
/* @var $model ApiAccessLog */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'access_id'); ?>
		<?php echo $form->textField($model,'access_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sp_tag'); ?>
		<?php echo $form->textField($model,'sp_tag',array('size'=>60,'maxlength'=>512)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'request_method'); ?>
		<?php echo $form->textField($model,'request_method',array('size'=>60,'maxlength'=>512)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'request_uri'); ?>
		<?php echo $form->textField($model,'request_uri',array('size'=>60,'maxlength'=>512)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'request_time'); ?>
		<?php echo $form->textField($model,'request_time',array('size'=>60,'maxlength'=>512)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_info'); ?>
		<?php echo $form->textArea($model,'post_info',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_agent'); ?>
		<?php echo $form->textField($model,'user_agent',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_date_time'); ?>
		<?php echo $form->textField($model,'created_date_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'remote_ip'); ?>
		<?php echo $form->textField($model,'remote_ip',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'response_return'); ?>
		<?php echo $form->textArea($model,'response_return',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->