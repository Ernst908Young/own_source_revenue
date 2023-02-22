<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>
<style type="text/css">
	fieldset {
		border: 2px solid #69A8CD
	}
	legend {
		padding: 0.2em 0.5em;
		border: 2px solid #69A8CD;
		background-color: #69A8CD;
		color: #fff;
		font-size: 90%;
		text-align: right;
		font-weight: bolder;
		
		border: 1px solid #69A8CD;
		-moz-border-radius: 35px;/*Firefox*/
		-webkit-border-radius: 35px;/*Safari, Chrome*/
		border-radius: 35px;
	}

	.button {
		border-top: 1px solid #96d1f8;
		background: #65a9d7;
		background: -webkit-gradient(linear, left top, left bottom, from(#3e779d), to(#65a9d7));
		background: -webkit-linear-gradient(top, #3e779d, #65a9d7);
		background: -moz-linear-gradient(top, #3e779d, #65a9d7);
		background: -ms-linear-gradient(top, #3e779d, #65a9d7);
		background: -o-linear-gradient(top, #3e779d, #65a9d7);
		padding: 5px 10px;
		-webkit-border-radius: 8px;
		-moz-border-radius: 8px;
		border-radius: 8px;
		-webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
		-moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
		box-shadow: rgba(0,0,0,1) 0 1px 0;
		text-shadow: rgba(0,0,0,.4) 0 1px 0;
		color: white;
		font-size: 14px;
		font-family: Georgia, serif;
		text-decoration: none;
		vertical-align: middle;
	}
	.button:hover {
		border-top-color: #28597a;
		background: #28597a;
		color: #ccc;
	}
	.button:active {
		border-top-color: #1b435e;
		background: #1b435e;
	}
</style>

<div class="form">

	<?php $form = $this -> beginWidget('CActiveForm', array('id' => 'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation' => false, ));
	?>

	<p class="note">
		Fields with <span class="required">*</span> are required.
	</p>

	<?php echo $form -> errorSummary($model); ?>

	<?php if(Yii::app()->user->hasFlash('error')):?>
	<div class="error" style="color:red">
		<?php echo Yii::app() -> user -> getFlash('error'); ?>
	</div>
	<br/>
	<?php endif; ?>

	<fieldset>
		<legend>
			Entrepreneur Registration
		</legend>
		<div class="row">
			<?php echo $form -> labelEx($profiles, 'first_name'); ?>
			<?php echo $form -> textField($profiles, 'first_name', array('size' => 40, 'required' => 'required', 'maxlength' => 64)); ?>
			<?php echo $form -> error($profiles, 'first_name'); ?>
		</div>

		<div class="row">
			<?php echo $form -> labelEx($profiles, 'last_name'); ?>
			<?php echo $form -> textField($profiles, 'last_name', array('size' => 40, 'required' => 'required', 'maxlength' => 64)); ?>
			<?php echo $form -> error($profiles, 'last_name'); ?>
		</div>

		<div class="row">
			<?php echo $form -> labelEx($profiles, 'pan_card'); ?>
			<?php echo $form -> textField($profiles, 'pan_card', array('size' => 40, 'maxlength' => 16)); ?>
			<?php echo $form -> error($profiles, 'pan_card'); ?>
		</div>

		<div class="row">
			<?php echo $form -> labelEx($profiles, 'adhaar_number'); ?>
			<?php echo $form -> textField($profiles, 'adhaar_number', array('size' => 40, 'maxlength' => 12)); ?>
			<?php echo $form -> error($profiles, 'adhaar_number'); ?>
		</div>
	</fieldset>

	<fieldset>
		<legend>
			Contact Details
		</legend>

		<div class="row">
			<?php echo $form -> labelEx($profiles, 'country_name'); ?>
			<?php echo $form -> textField($profiles, 'country_name', array('size' => 40, 'required' => 'required', 'maxlength' => 64)); ?>
			<?php echo $form -> error($profiles, 'country_name'); ?>
		</div>

		<div class="row">
			<?php echo $form -> labelEx($profiles, 'state_name'); ?>
			<?php echo $form -> textField($profiles, 'state_name', array('size' => 40, 'required' => 'required', 'maxlength' => 64)); ?>
			<?php echo $form -> error($profiles, 'state_name'); ?>
		</div>

		<div class="row">
			<?php echo $form -> labelEx($profiles, 'city_name'); ?>
			<?php echo $form -> textField($profiles, 'city_name', array('size' => 40, 'required' => 'required', 'maxlength' => 64)); ?>
			<?php echo $form -> error($profiles, 'city_name'); ?>
		</div>

		<div class="row">
			<?php echo $form -> labelEx($profiles, 'address'); ?>
			<?php echo $form -> textArea($profiles, 'address', array('rols' => 40, 'required' => 'required', 'cols' => 55)); ?>
			<?php echo $form -> error($profiles, 'address'); ?>
		</div>

		<div class="row">
			<?php echo $form -> labelEx($profiles, 'pin_code'); ?>
			<?php echo $form -> textField($profiles, 'pin_code', array('size' => 40, 'required' => 'required', 'maxlength' => 10)); ?>
			<?php echo $form -> error($profiles, 'pin_code'); ?>
		</div>

		<div class="row">
			<?php echo $form -> labelEx($profiles, 'mobile_number'); ?>
			<?php echo $form -> textField($profiles, 'mobile_number', array('size' => 40, 'required' => 'required', 'maxlength' => 16)); ?>
			<?php echo $form -> error($profiles, 'mobile_number'); ?>
		</div>

	</fieldset>

	<fieldset>
		<legend>
			Contact Details
		</legend>

		<div class="row">
			<?php echo $form -> labelEx($model, 'email'); ?>
			<?php echo $form -> textField($model, 'email', array('size' => 40, 'required' => 'required', 'maxlength' => 512)); ?>
			<?php echo $form -> error($model, 'email'); ?>
		</div>

		<div class="row">
			<?php echo $form -> labelEx($model, 'password'); ?>
			<?php echo $form -> passwordField($model, 'password', array('size' => 40, 'required' => 'required', 'maxlength' => 40)); ?>
			<?php echo $form -> error($model, 'password'); ?>
		</div>

		<div class="row">
			<label>Password Again</label>
			<input type="password" name="Users[passwordagain]" size="40" required="required" />
		</div>

	</fieldset>

	<div class="row buttons">
		<input class="button" type="submit" name="yt0" value="Create" />
	</div>

	<?php $this -> endWidget(); ?>

</div><!-- form -->