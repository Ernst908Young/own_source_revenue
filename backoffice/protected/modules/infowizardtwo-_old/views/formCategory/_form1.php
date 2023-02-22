<?php
/* @var $this InfowizardQuestionMasterController */
/* @var $model InfowizardQuestionMaster */
/* @var $form CActiveForm */
?>
<style>
    .errorMessage{color:red;}    
    .portlet.box .dataTables_wrapper .dt-buttons {
    margin-top: -52px !important;
}
</style>
<!--<div class="row">
	<div class="dt-buttons" style="margin-bottom: 10px; float:right; margin-right:15px" >
	   <a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/formCategory/index/')?>"><span>Form Category List</span></a>
	</div>  -->
</div>
<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>Update Form Category </div>
    <div class='tools'>
	
	</div>
	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bo-infowizard-issuer-master-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php
	//echo "<pre/>"; 
	//print_r($model);die;
	?>
		 
  <?php 
  $formsData =Yii::app()->db->createCommand("SELECT  id ,category_code,category_name as name FROM  bo_infowiz_form_categories  WHERE is_active='Y' AND parent_id='0' ")->queryAll();
  $cat_list =array();
  if(isset($formsData) && !empty($formsData) && count($formsData)>0){ 
  
   
	  foreach($formsData as $cat_name){
		  $cat_list[$cat_name['id']]=$cat_name['category_code'].": ".$cat_name['name'];
	  }
	  
  }
  if(isset($cat_list) && count($cat_list)>0){
	  $cotain ='Select Parent';
  }else{
	  $cotain ='No Parent';
  }
    //echo "<pre/>"; 
	//print_r($model->parent_id);die;
 ?>
 
    <div class="row" style="margin:10px 0 10px 0;">
		 
			   <label class="col-lg-2 col-sm-2 control-label" for="application_name" ><?php echo $form->labelEx($model,'is_parent'); ?><span class="required" aria-required="true"></span></label>
				<div class=" form-group col-md-4">
					<?php echo $form->dropDownList($model,'parent_id', $cat_list,array('empty'=>$cotain,'disabled'=>true,'class'=>'form-control','autocomplete' => 'off','required'=>'required'));  ?>
					<?php echo $form->error($model,'parent_id'); ?>
				</div>
		 
	</div>
	
	
		 
   <div class="row" style="margin:10px 0 10px 0;">  
			<label class="col-lg-2 col-sm-2 control-label" for="application_name" > 
			 Category Name <span class="required" aria-required="true">*</span></label>
			<div class="form-group col-md-4">
		    <?php echo $form->textField($model,'category_name',array('class'=>'form-control','size'=>50,'maxlength'=>200,'autocomplete' => 'off','required'=>'required','onclick'=>'return lettersOnly()')); ?>
		    <?php echo $form->error($model,'category_name'); ?>
		    </div> 
	</div> 

	<div class="row" style="margin:10px 0 10px 0;">
		 
			   <label class="col-lg-2 col-sm-2 control-label" for="application_name" ><?php echo $form->labelEx($model,'is_active ?'); ?><span class="required" aria-required="true">*</span></label>
				<div class=" form-group col-md-4">
					<?php echo $form->dropDownList($model,'is_active',array('Y'=>'Y','N'=>'N'),array('class'=>'form-control','autocomplete' => 'off','required'=>'required'));  ?>
					<?php echo $form->error($model,'is_active'); ?>
				</div>
		 
	</div>

	<div class="form-group row buttons" align="center">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-4">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Update',array('class'=>'btn btn-primary')); ?>
                </div>
	</div>

<?php $this->endWidget(); ?>

</div></div></div></div>
<!-- form -->
<style>
function lettersOnly(evt) {
       evt = (evt) ? evt : event;
       var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
          ((evt.which) ? evt.which : 0));
       if (charCode > 33 && (charCode < 65 || charCode > 90) &&
          (charCode < 97 || charCode > 122)) {
          return false;
       }
       return true;
     }
	 </style>