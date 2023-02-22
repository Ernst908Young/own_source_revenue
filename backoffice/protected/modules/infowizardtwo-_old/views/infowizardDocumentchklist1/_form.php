<style>

</style>
<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>Create Document CheckList</div>
    <div class='tools'>
	
	</div>
	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'infowizard-documentchklist-form',
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
	<label class="col-lg-4 col-sm-4 control-label" for="application_name" >
	<?php echo $form->labelEx($model,'Select Issuer'); ?><span class="required" aria-required="true"> * </span></label>
	<div class="col-md-8">
	<?php echo $form->dropDownList($model,'issuer_id',CHtml::listData($Issuerdata,'issuer_id','name'),array('class'=>'form-control','autocomplete' => 'off',
	'required'=>'required','onchange'=>'showUser(this.value)')); ?>
	<?php echo $form->error($model,'issuer_id'); ?>
	</div>
	</div>
	</div>


    <div class="row">
	<div class="form-group col-md-6">
	<label class="col-lg-4 col-sm-4 control-label" for="application_name" >
	<?php echo $form->labelEx($model,'Issued By'); ?><span class="required" aria-required="true"> * </span></label>
	<div class="col-md-8">	
	<?php echo $form->dropDownList($model,'issmap_id',array(),array('class'=>'form-control','autocomplete' => 'off','required'=>'required')); ?>
	<?php echo $form->error($model,'issmap_id'); ?>
	<?php //echo $form->hiddenField($model,'issuerby_id',array('value'=>'123')); ?>
	</div>
	</div>
	</div>
	
	<div class="row">
	<div class="form-group col-md-6">
	<label class="col-lg-4 col-sm-4 control-label" for="application_name" >
	<?php echo $form->labelEx($model,'Type of Document'); ?><span class="required" aria-required="true"> * </span></label>
	<div class="col-md-8">
	<?php echo $form->dropDownList($model,'doc_id[]',CHtml::listData($Documentdata,'doc_id','name'),array('class'=>'form-control','autocomplete' => 'off','required'=>'required','multiple'=>'multiple')); ?>
	<?php echo $form->error($model,'doc_id'); ?>
	</div>
	</div>
	</div>
     
	 
	 <div class="row">
	<div class="form-group col-md-6">
	<label class="col-lg-4 col-sm-4 control-label" for="application_name" >
	<?php echo $form->labelEx($model,'Checklist ID'); ?></label>
	<div class="col-md-8">
	<?php $id=$countid+1; $count='UK-DCL-'.$id; echo $form->textField($model,'chklist_id',array('class'=>'form-control','size'=>50,'maxlength'=>50,'value'=>$count,
	'readonly' => true)); ?>
	<?php echo $form->error($model,'chklist_id'); ?>
	</div>
	</div>
	</div>
	
	<div class="row">
	<div class="form-group col-md-6">
	<label class="col-lg-4 col-sm-4 control-label" for="application_name" >
	<?php echo $form->labelEx($model,'Checklist Document Name'); ?><span class="required" aria-required="true"> * </span></label>
	<div class="col-md-8">
	<?php echo $form->textField($model,'name',array('class'=>'form-control','size'=>50,'maxlength'=>200,'required'=>'required')); ?>
	<?php echo $form->error($model,'name'); ?>
	</div>
	</div>
	</div>

	<div class="row">
	<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >
			<?php echo $form->labelEx($model,'Is Active'); ?><span class="required" aria-required="true"> * </span></label>
			<div class="col-md-8">
		<?php echo $form->dropDownList($model,'is_docchklist_active',array('Y'=>'Y','N'=>'N'),array('class'=>'form-control','size'=>1,'maxlength'=>1,'autocomplete' => 'off','required'=>'required')); ?>
		<?php echo $form->error($model,'is_docchklist_active'); ?>
	</div></div>
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
                url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/InfowizardDocumentchklist/issuermappingall",
				dataType:'json',
			    data:
                {
                post_issuerid: str
                },
			   
               success:  function(data) { //alert(data);
			   var $select = $('#InfowizardDocumentchklist_issmap_id');
			   $select.html('');
                $.each(data, function(index, element) {
           			//alert(element.issmap_id);
					$select.append('<option value="' + element.issmap_id + '">' + element.name + '</option>');
					//$select.append('<option>'+element.app_name+'<option>');
        		});
				//alert(data);
				},
			
            error:function(jqXHR, textStatus, errorThrown){
                alert('error::'+errorThrown);
            }
            });
}
</script>