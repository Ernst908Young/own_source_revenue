<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="site-min-height">
<div class="form form-horizontal" role="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('autoComplete'=>'off'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php if($action == 'add'){ ?>
	<div class="row">	
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="role_id">Select Role *</label>
			<div class="col-md-8">
			<?php echo $form->DropDownList($model_role,'role_id',CHtml::listData(UserExt::sGetRoles('district',$dept_id),'role_id','role_name'),
                        array('class'=>'form-control','required'=>'required','prompt'=>'Select Role','ajax' => 
                            array(
                                'type'=>'POST',
                                'url'=>Yii::app()->createUrl('user/GetDistrictUsingRole'),
                                'update'=>'#User_disctrict_id', 
								'data'=>array('role_id'=>'js:this.value'),
                            ))); ?>
			<?php echo $form->error($model_role,'role_id'); ?>
			
			
			</div>
		</div>
	</div>
	<div class="row">	
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="is_active"><?php echo $form->labelEx($model,'disctrict_id'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'disctrict_id',CHtml::listData(array(),'district_id','distric_name'),array('class'=>'form-control','required'=>'required','prompt'=>'Select District')); ?>
			<?php echo $form->error($model,'is_active'); ?>
			</div>
		</div>
	</div>
	
	<?php }else{ 
		$role_data = UserRoleMapping::model()->find('user_id=:user_id', array(':user_id'=>$model->uid));
		$role_id = $role_data['role_id'];
		echo $form->hiddenField(new UserRoleMapping,'role_id',array('value'=>$role_id,'maxlength'=>60,'class'=>'form-control','autocomplete' => 'off','required'=>'required','readonly'=>'readonly'));
		echo $form->hiddenField($model,'disctrict_id',array('class'=>'form-control','autocomplete' => 'off','required'=>'required','readonly'=>'readonly'));
	?>
		<!-- <div class="row">	
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="is_active"><?php echo $form->labelEx($model,'disctrict_id'); ?></label>
			<div class="col-md-8">
			<?php //echo $form->dropDownList($model,'disctrict_id',CHtml::listData(UserExt::sGetDistrictByRoleForEdit($dept_id,$role_id,$model->disctrict_id),'district_id','distric_name'),array('class'=>'form-control')); ?>
			<?php //echo $form->error($model,'is_active'); ?>
			</div>
		</div>
	</div> -->
	
	<?php } ?>
	
	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'full_name'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'full_name',array('size'=>60,'maxlength'=>60,'class'=>'form-control','autocomplete' => 'off','required'=>'required')); ?>
			<?php echo $form->error($model,'full_name'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'email'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128,'class'=>'form-control email_check','required'=>'required','pattern'=>'[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$','title'=>'Please enter valid email address.')); ?>
			<?php echo $form->error($model,'email'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'mobile'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'mobile',array('size'=>10,'maxlength'=>10,'class'=>'form-control','autocomplete' => 'off','pattern'=>'[0-9]{10}','title'=>'Please enter valid mobile number.')); ?>
			<?php echo $form->error($model,'mobile'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'password'); ?></label>
			<div class="col-md-8">
			
			<?php 
			if($action == 'add'){
				echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128,'class'=>'form-control','autocomplete' => 'off','required'=>'required','value'=>'')); 
			}else{
				echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128,'class'=>'form-control','autocomplete' => 'off','value'=>'')); 
			
			}
			?>
			
			<?php echo $form->error($model,'password'); ?>
			</div>
		</div>
	</div>

	<div class="row">	
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="is_active"><?php echo $form->labelEx($model,'is_active'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'is_active',array('1'=>'Y','0'=>'N'),array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'is_active'); ?>
			</div>
		</div>
	</div>
    
	<div class="row">
		<div class="form-gruop col-md-6">
			<?php echo CHtml::submitButton($action=='create' ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
		</div>
	</div>
	<?php echo $form->hiddenField($model,'dept_id',array('value'=>$dept_id,'size'=>11,'maxlength'=>11,'class'=>'form-control','readonly'=>'readonly')); ?>
	<?php if($action == 'edit'){ echo $form->hiddenField($model,'uid',array('size'=>11,'maxlength'=>11,'class'=>'form-control','readonly'=>'readonly')); } ?>
<?php $this->endWidget(); ?>

	</div><!-- form -->
</div>	
<?php if($action == 'edit'){ ?>
<script type="text/javascript">
	$( document ).ready(function() {
		
	});
</script>
<?php } ?>