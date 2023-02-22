<?php
/* @var $this FileldsController */
/* @var $model Filelds */
/* @var $form CActiveForm */
?>
<style type="text/css">
	.check_status{
		color:red;
	}
</style>
<div class="site-min-height">
<div class="form form-horizontal" role="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'filelds-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
	<?php
	    foreach (Yii::app()->user->getFlashes() as $key => $message) {
	        if ($key == 'Error') {
	?>
	                        <div class="alert alert-block alert-danger fade in">
	                            <button data-dismiss="alert" class="close close-sm" type="button">
	                                <i class="fa fa-times"></i>
	                            </button>
	                    <?php
	        } else {
	            echo "<div class='alert alert-info fade in'>
	                        <button data-dismiss='alert' class='close close-sm' type='button'>
	                            <i class='fa fa-times'></i>
	                        </button>";
	        }
	        
	        echo $message . "</div>\n";
	    }
	    ?>
	</div>

	<div class="row ">
	    <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="field_name" ><?php echo $form->labelEx($model,'field_name'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'field_name',array('size'=>60,'maxlength'=>64,'class'=>'form-control')); ?>
			<div class="check_status" style="display:none;"></div>
			<?php echo $form->error($model,'field_name'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		 <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="field_desc" ><?php echo $form->labelEx($model,'field_desc'); ?></label>
			<div class="col-md-8">
			<?php echo $form->textField($model,'field_desc',array('size'=>60,'maxlength'=>512,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'field_desc'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		 <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="filed_type" ><?php echo $form->labelEx($model,'filed_type'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'filed_type',array(''=>'Please select Field','separator'=>'separator','text'=>'text','button'=>'button','select'=>'select','multiselect'=>'multiselect','radio'=>'radio','textarea'=>'textarea','hidden'=>'hidden','password'=>'password','fileuploader'=>'fileuploader','document'=>'document','email'=>'email','number'=>'number','search'=>'search','url'=>'url','tel'=>'tel','range'=>'range','date'=>'date','month'=>'month','week'=>'week','time'=>'time','datetime'=>'datetime','datetime-local'=>'datetime-local','color'=>'color','label'=>'label'),array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'filed_type'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		 <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="department_name" ><?php echo $form->labelEx($model,'is_field_active'); ?></label>
			<div class="col-md-8">
			<?php echo $form->dropDownList($model,'is_field_active',array('Y'=>'Yes','N'=>'No'),array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'is_field_active'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-gruop col-md-6">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</div>
<script type="text/javascript">
$('document').load(function(){
	document.getElementById("filelds-form").reset();
});
	$('#Filelds_field_name').keyup(function(){
		var fname=$('#Filelds_field_name').val();
		 fname = fname.replace(' ', '_');
		 fname = fname.replace('/[^A-Za-z\-]/', ''); 
		$('#Filelds_field_name').val(fname);
	})
	$('#Filelds_field_name').blur(function(){
		var fname=$('#Filelds_field_name').val();
		var url="<?php echo Yii::app()->createUrl('/ajax');?>";
		 checkFieldName(url,fname);

	})
	$('#Filelds_filed_type').change(function(){
		var ftype=$('#Filelds_filed_type').val();
		console.log(ftype);
	})
</script>