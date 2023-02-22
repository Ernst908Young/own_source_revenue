<?php
/* @var $this SpApplcationsDetailController */
/* @var $model SpApplcationsDetail */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sp-applcations-detail-form',
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
		<?php echo $form->labelEx($model,'sp_id'); ?>

	<select name="SpApplcationsDetail[sp_id]" id="SpApplcationsDetail_sp_id" class="form-control">
					<option value="">Please select the Service Provider</option>
					
	<?php
		$SpApps=SpApplicationsExt::getAllSSODept();
		if(!empty($SpApps)){
			foreach ($SpApps as $key => $SpApps) {
				?>
					<option value="<?=$SpApps['sp_id']?>"><?=$SpApps['service_provider_name']?></option>

				<?php
			}
		}
	?>
	</select>
		<?php echo $form->error($model,'sp_id'); ?>

	</div>
</div>
	<div class="row">
	<div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'timeline_period'); ?>
		<?php echo $form->textField($model,'timeline_period',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'timeline_period'); ?>
	</div>
	</div>

	<div class="row">
	<div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'app_id'); ?>

		<select name="SpApplcationsDetail[app_id]" id="SpApplcationsDetail_app_id" class='form-control'>
			<option value="">Please select the Service Provider first</option>

		</select>
		<?php echo $form->error($model,'app_id'); ?>
	</div>
	</div>

	<div class="row">
	<div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'form_download_link'); ?>
		<?php echo $form->textField($model,'form_download_link',array('size'=>60,'maxlength'=>500,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'form_download_link'); ?>
	</div>
</div>
	<div class="row">
	<div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'procedure_link'); ?>
		<?php echo $form->textField($model,'procedure_link',array('size'=>60,'maxlength'=>500,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'procedure_link'); ?>
		</div>
	</div>



	<div class="row">
	<div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'is_active'); ?>
		<?php echo $form->dropDownList($model,'is_active',array('Y'=>'Y','N'=>'N'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'is_active'); ?>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
	$("#SpApplcationsDetail_sp_id").change(function(){
		var val=$("#SpApplcationsDetail_sp_id").val();
		if(val=='')
			return false;
	    var posturl = "<?php echo Yii::app()->createAbsoluteUrl('admin/ajax/GetAllSPApplication');?>";
	    console.log(posturl);
	    var postdata = {"sp_id":val};
	    $.ajax({
	        type: "post",
	        cache: false,
	        url: posturl,
	        data: postdata,
	//dataType: "text json",
	        success: function (data) {
	            if (data != '') {
	            	var res=JSON.parse(data);
	                 $('#SpApplcationsDetail_app_id').empty();
                     $('#SpApplcationsDetail_app_id').append('<option  value="">Please Select Application</option>');
                     if(res.STATUS=='200'){
                    $.each(res.applications,function(key,object){ 
                        $('#SpApplcationsDetail_app_id').append('<option  value="' + object.app_id + '">' + object.app_name + '</option>');

                    });  
                    }   
	//console.log("coming "+data);
	            }
	            else
	                console.log("Error");
	             // stop preloader
	                $('#status').fadeOut(); // will first fade out the loading animation
	                $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
	                $('body').delay(350).css({'overflow':'visible'});
	        }
	    });	

	})
</script>
