<?php
/* @var $this ServiceProvidersController */
/* @var $model ServiceProviders */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'sp_id'); ?>
		<?php echo $form->textField($model,'sp_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'service_provider_name'); ?>
		<?php echo $form->textField($model,'service_provider_name',array('size'=>60,'maxlength'=>512)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'service_provider_tag'); ?>
		<?php echo $form->textField($model,'service_provider_tag',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'remote_server_ip'); ?>
		<?php echo $form->textField($model,'remote_server_ip',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'secret_key'); ?>
		<?php echo $form->textField($model,'secret_key',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'server_base_url'); ?>
		<?php echo $form->textField($model,'server_base_url',array('size'=>60,'maxlength'=>1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_service_provider_active'); ?>
		<?php echo $form->textField($model,'is_service_provider_active',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->