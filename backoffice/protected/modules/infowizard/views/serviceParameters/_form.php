<?php
/* @var $this BoInformationWizardServiceParametersController */
/* @var $model BoInformationWizardServiceParameters */
/* @var $form CActiveForm */
?>
<style>
    span.required{color:red}
.control-label .required, .form-group .required {
    color: #333;
    font-size: 14px;
    padding-left: 2px;
     font-weight: 400;
}

.required .required{color:red;} 
.errorMessage {
    color: red;
}
</style>
<div class='portlet box green'>
    <div class='portlet-title'>
        <div class='caption'>
            <i style=" font-size:20px;" class='fa fa-list'></i>Create Service Master</div>
        <div class='tools'>

        </div>

    </div>
    <div class="portlet-body">

        <div class="site-min-height">
            <div class="form form-horizontal" role="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bo-information-wizard-service-parameters-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	     <p class="note">Fields with <span class="required">*</span> are required.</p>

<?php //echo $form->errorSummary($model); ?>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-lg-4 col-sm-4 control-label" for="application_name" >

		<?php echo $form->labelEx($model,'service_id'); ?>
                         </label>

                        <div class="col-md-8">
		<?php echo $form->dropDownList($model,'service_id',$sn,array('class'=>'form-control','autocomplete' => 'off','required'=>'required')); ?>
	<?php echo $form->error($model,'service_id'); ?>
	</div>
	</div>
	</div>

	                <div class="row">                    <div class="form-group col-md-6">                        <label class="col-lg-4 col-sm-4 control-label" for="application_name" >
		<?php echo $form->labelEx($model,'service_type'); ?>
             </label>

                        <div class="col-md-8">
		<?php echo $form->dropDownList($model,'service_type',array(),array('class'=>'form-control','autocomplete' => 'off','required'=>'required')); ?>
	<?php echo $form->error($model,'service_type'); ?>
	</div>
	</div>
	</div>

	                <div class="row">                    <div class="form-group col-md-6">                        <label class="col-lg-4 col-sm-4 control-label" for="application_name" >
		<?php echo $form->labelEx($model,'is_online'); ?>
             </label>

                        <div class="col-md-8">
		  <?php echo $form->dropDownList($model,'is_online',array('Y'=>'Yes','N'=>'No'),array('class'=>'form-control','size'=>1,'maxlength'=>1,'autocomplete' => 'off','required'=>'required')); ?>
		<?php echo $form->error($model,'is_online'); ?>
	</div>
	</div>
	</div>

	                <div class="row">                    <div class="form-group col-md-6">                        <label class="col-lg-4 col-sm-4 control-label" for="application_name" >
		<?php echo $form->labelEx($model,'is_integrated_with_swcs'); ?>
             </label>

                        <div class="col-md-8">
		  <?php echo $form->dropDownList($model,'is_integrated_with_swcs',array('Y'=>'Yes','N'=>'No'),array('class'=>'form-control','size'=>1,'maxlength'=>1,'autocomplete' => 'off','required'=>'required')); ?>
		<?php echo $form->error($model,'is_integrated_with_swcs'); ?>
	</div>
	</div>
	</div>

	                <div class="row">                    <div class="form-group col-md-6">                        <label class="col-lg-4 col-sm-4 control-label" for="application_name" >
		<?php echo $form->labelEx($model,'is_in_uttarakhand_right_to_service_act'); ?>
             </label>

                        <div class="col-md-8">
		  <?php echo $form->dropDownList($model,'is_in_uttarakhand_right_to_service_act',array('Y'=>'Yes','N'=>'No'),array('class'=>'form-control','size'=>1,'maxlength'=>1,'autocomplete' => 'off','required'=>'required')); ?>
		<?php echo $form->error($model,'is_in_uttarakhand_right_to_service_act'); ?>
	</div>
	</div>
	</div>

	                <div class="row">                    <div class="form-group col-md-6">                        <label class="col-lg-4 col-sm-4 control-label" for="application_name" >
		<?php echo $form->labelEx($model,'is_statutory_forms_available'); ?>
             </label>

                        <div class="col-md-8">
		  <?php echo $form->dropDownList($model,'is_statutory_forms_available',array('Y'=>'Yes','N'=>'No'),array('class'=>'form-control','size'=>1,'maxlength'=>1,'autocomplete' => 'off','required'=>'required')); ?>
		<?php echo $form->error($model,'is_statutory_forms_available'); ?>
	</div>
	</div>
	</div>

	                <div class="row">                    <div class="form-group col-md-6">                        <label class="col-lg-4 col-sm-4 control-label" for="application_name" >
		<?php echo $form->labelEx($model,'statutory_form_no'); ?>
             </label>

                        <div class="col-md-8">
		<?php echo $form->textField($model,'statutory_form_no',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'statutory_form_no'); ?>
	</div>
	</div>
	</div>

	                <div class="row">                    <div class="form-group col-md-6">                        <label class="col-lg-4 col-sm-4 control-label" for="application_name" >
		<?php echo $form->labelEx($model,'statutory_form_upload'); ?> </label>

                        <div class="col-md-8">
		<?php echo $form->textField($model,'statutory_form_upload',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'statutory_form_upload'); ?>
	</div>
	</div>
	</div>

	                <div class="row">                    <div class="form-group col-md-6">                        <label class="col-lg-4 col-sm-4 control-label" for="application_name" >
		<?php echo $form->labelEx($model,'statutory_forms_creation'); ?> </label>

                        <div class="col-md-8">
		<?php echo $form->textField($model,'statutory_forms_creation',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'statutory_forms_creation'); ?>
	</div>
	</div>
	</div>

	                <div class="row">                    <div class="form-group col-md-6">                        <label class="col-lg-4 col-sm-4 control-label" for="application_name" >
		<?php echo $form->labelEx($model,'document_checkList'); ?> </label>

                        <div class="col-md-8">
		  <?php echo $form->dropDownList($model,'document_checkList',array('Y'=>'Yes','N'=>'No'),array('class'=>'form-control','size'=>1,'maxlength'=>1,'autocomplete' => 'off','required'=>'required')); ?>
		<?php echo $form->error($model,'document_checkList'); ?>
	</div>
	</div>
	</div>

	                <div class="row">   
                            <div class="form-group col-md-6"> 
                                <label class="col-lg-4 col-sm-4 control-label" for="application_name" >
		<?php echo $form->labelEx($model,'document_checklist_upload'); ?>
             </label>

                        <div class="col-md-8">
		<?php echo $form->textField($model,'document_checklist_upload',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'document_checklist_upload'); ?>
	</div>
	</div>
	</div>

	                <div class="row">   
                            <div class="form-group col-md-6"> 
                                <label class="col-lg-4 col-sm-4 control-label" for="application_name" >
		<?php echo $form->labelEx($model,'document_checklist_creation'); ?> </label>

                        <div class="col-md-8">
		<?php echo $form->textField($model,'document_checklist_creation',array('class'=>'form-control','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'document_checklist_creation'); ?>
	</div>
	</div>
	</div>

	 	<div class="row buttons" align="center">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
                </div>

<?php $this->endWidget(); ?>

        
</div></div></div></div><!-- form -->


<script>
function showUser(str) { //alert(str); //alert("<?php echo Yii::app()->request->baseUrl; ?>/infowizard/infowizarddocumentchklist/issuermapping"); 
$.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/InformationWizardServiiceParameters/getServiceType",
				dataType:'json',
			    data:
                {
                post_issuerid: str
                },
			   
               success:  function(data) { //alert(data);
			   var $select = $('#BoInformationWizardServiceParameters_service_type');
			   $select.html('');
                $.each(data, function(index, element) {
           			$select.append('<option value="' + element.name + '">' + element.name + '</option>');
			});
			},
			
            error:function(jqXHR, textStatus, errorThrown){
                alert('error::'+errorThrown);
            }
            });
}
</script>