<?php
/* @var $this ApplicationsController */
/* @var $model Applications */
/* @var $form CActiveForm */
?>
<div class="site-min-height">
<div class="form">
   <style type="text/css">
      .select_error{
      color:red;
      }
      .errorSummary{
      display: block;
      color:red;
      border: 1px solid red;
      }
      .btn_select{
      	    margin-top: 8px;
      	    padding: 0px 25px;
      	    top:25px;
      	    position: relative;
      }
      .roleViewbox{
		display: inline;
		background: #ddd;
		color:blue;
	}
   </style>
<div class="form form-horizontal" role="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'applications-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" ><?php echo $form->labelEx($model,'application_name'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'application_name',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'application_name'); ?>
			</div>
		</div>
	</div>	
	<div class="row">		
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_desc"><?php echo $form->labelEx($model,'application_desc'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'application_desc',array('size'=>60,'maxlength'=>512,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'application_desc'); ?>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-md-6">
			<div class="col-md-12">
			<label class="roleView"></label>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="dept_id"><?php echo $form->labelEx($model,'dept_id'); ?></label>
			<div class="col-md-8">
			<?php echo "<select id='Applications_dept_id' class='form-control' name='Applications[dept_id]'></select>";?>
			<?php echo $form->error($model,'dept_id'); ?>
			</div>
		</div>
	</div>	
	<div class="row">	
		<div class="form-group col-md-6">
			<input type="hidden" name="Applications[app_apprvr_id]" id="Applications_roles_id_values"/>
			<label class="col-lg-4 col-sm-4 control-label" for="Applications_approver_id"><?php echo $form->labelEx($model,'Select Approver'); ?></label>
			<div class="col-md-8">
			<?php echo "<select id='Applications_approver_id' class='form-control' name='Applications[Applications_approver_id]'>
							<option value=''>Please Select Dept First</option>
						</select>";?>
			<?php echo $form->error($model,'dept_id'); ?>
			</div>
		</div>
	</div>	
	
	<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="is_application_active"><?php echo $form->labelEx($model,'is_application_active'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'is_application_active',array('Y'=>'Y','N'=>'N'),array('class'=>'form-control'))?>
			<?php echo $form->error($model,'is_application_active'); ?>
			</div>
		</div>	
		<div class="form-group col-md-6">
			<div class="roles"></div>
		</div>
	</div>

	<div class="row">
		<div class="form-gruop col-md-6">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

		</div><!--form -->
	</div>
</div>
<script type="text/javascript">
	$('#Applications_application_name').keyup(function(){
		var fname=$('#Applications_application_name').val();
		 fname = fname.replace(' ', '_');
		 fname = fname.replace('/[^A-Za-z\-]/', ''); 
		$('#Applications_application_name').val(fname);
	})
		$( document ).ready(function() {

			var url ="<?php echo Yii::app()->createUrl('ajax/alldept');?>";
	   	    getAllDeptAPI(url,'#Applications_dept_id');
	   	    
	   	   
	});
		$('#Applications_dept_id').change(function(){
			var dept_id=$('#Applications_dept_id').val();
			var url ="<?php echo Yii::app()->createUrl('ajax/getdeptallroles');?>";
			getDeptRoles(url,dept_id);
		})
		$('#Applications_approver_id').change(function(){
			var aprvr=$('#Applications_approver_id').val();
			var prevroles=$("#Applications_roles_id_values").val();
			if(prevroles==='')
				$("#Applications_roles_id_values").val(aprvr);
			else
				$("#Applications_roles_id_values").val(prevroles+";"+aprvr);
			var url ="<?php echo Yii::app()->createUrl('ajax/getrolesnameviaid');?>";
			getApprvrNameviaId(url,aprvr);
		})
</script>