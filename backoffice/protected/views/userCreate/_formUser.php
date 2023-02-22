<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
$sql="SELECT * FROM bo_district";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$list_districts=$command->queryAll();
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

	
	<div class="row">	
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="role_id">Select Role *</label>
			<div class="col-md-8">
			<?php echo $form->DropDownList($model_role,'role_id',CHtml::listData(RolesExt::getAllRoles(),'role_id','role_name'),
                        array('class'=>'form-control','required'=>'required','prompt'=>'Select Role')); ?>
			<?php echo $form->error($model_role,'role_id'); ?>
			
			
			</div>
		</div>
	</div>
	
	<div class="row">	
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="dept_id"><?php echo $form->labelEx($model,'dept_id'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'dept_id',CHtml::listData(DepartmentsExt::getDept(),'dept_id','department_name'),array('class'=>'form-control','required'=>'required','prompt'=>'Select Department')); ?>
			</div>
		</div>
	</div>
	
	<div class="row">	
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="is_active"><?php echo $form->labelEx($model,'disctrict_id'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'disctrict_id',CHtml::listData($list_districts,'district_id','distric_name'),array('class'=>'form-control','required'=>'required','prompt'=>'Select District')); ?>
			</div>
		</div>
	</div>
	
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
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'email_alert'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'email_alert',array('size'=>60,'maxlength'=>128,'class'=>'form-control email_check','pattern'=>'[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$','title'=>'Please enter valid email address.')); ?>
			<?php echo $form->error($model,'email_alert'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="mobile" ><?php echo $form->labelEx($model,'mobile'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'mobile',array('size'=>10,'maxlength'=>10,'class'=>'form-control','required'=>'required','autocomplete' => 'off','pattern'=>'[0-9]{10}','title'=>'Please enter valid mobile number.')); ?>
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
	
	
<?php $this->endWidget(); ?>

	</div><!-- form -->
</div>	
<?php if($action == 'edit'){ ?>
<script type="text/javascript">
	$( document ).ready(function() {
		
	});
</script>
<?php } ?>