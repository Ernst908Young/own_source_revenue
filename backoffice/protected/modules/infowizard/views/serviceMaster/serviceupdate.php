


<link rel="stylesheet" href="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
      <!-- select2 -->
	<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
	
        <!-- Theme framework -->
	<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/demonstration.min.js"></script>
<?php
/* @var $this InformationWizardServiceMasterController */
/* @var $model BoInformationWizardServiceMaster */
/* @var $form CActiveForm */
?>



<?php $serviceData['id']=$_GET['serviceID'];?>




                                

<div class="dashboard-home">
   <div class="applied-status">
<div class="row">
 
  <div class="col-md-3">    
  <a style="color:blue;" href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/serviceMaster/serviceupdate/serviceID/'.$serviceData['id'].'')?>" >1 Master Form</a>
</div>

<div class="col-md-3">    
  <a style="color:blue;" href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/serviceParameters/Addparams/serviceID/'.$serviceData['id'].'')?>" >2 Parameter Form </a>
</div>

<div class="col-md-3">    
  <a style="color:blue;" href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/serviceInspection/Adddetails/serviceID/'.$serviceData['id'].'')?>" >3 Inspection Form  </a>
</div>

<div class="col-md-3">    
  <a style="color:blue;" href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/serviceFee/Adddetails/serviceID/'.$serviceData['id'].'')?>" >4 Fee Form </a>
</div>

<div class="col-md-3">    
 <a style="color:blue;" href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/ServiceTimeline/create/serviceID/'.$serviceData['id'].'')?>" >5 Timelines Form </a>
</div>

<div class="col-md-3">    
  <a style="color:blue;" href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/ServiceStackholder/create/serviceID/'.$serviceData['id'].'')?>" >6 Stackholders Form</a>
</div>

<div class="col-md-3">    
  <a style="color:blue;" href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/ServiceValidity/create/serviceID/'.$serviceData['id'].'')?>" >7 Validity Form</a>
</div>

<div class="col-md-3">    
 <a style="color:blue;" href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/ServiceValidity/other/serviceID/'.$serviceData['id'].'')?>" >8 Other Form </a>
</div>
    



</div>

           <hr> 
			<?php  if(!empty($apps)){ ?>
			<div class="row">
	<div class="form-group col-md-4">
	<label class="control-label" for="application_name" >State/Central : </label>
	
			<label class="control-label1" for="application_name" ><b>
			<?php  $dist_lable=$apps['central_state']; if($dist_lable==1) { echo "Central"; } else { echo "State";} ?></b></label>

</div>

	<div class="col-md-4">
	<label for="application_name" >Select Department : </label>
		

			<label class="control-label1" for="application_name" ><b>
			<?php $issuername=serviceMasterController::getNameOfIssuerBy($apps['issuerby_id']); echo $issuername['name']; ?></b></label>
	</div>


	        <div class="col-md-4">
			<label for="application_name" >Service Name : </label>
		
			<label class="control-label1" for="application_name" ><b><?php echo $apps['service_name']; ?></b></label>

</div>
</div>  
	
			  
			 <div class="row">
	<div class="col-md-6">
	<label  for="application_name" >Service Incidence : </label>
			
<label class="control-label1" for="application_name" ><b>
<?php 
if($apps['incidence_pre_establishment']==1){ echo "Pre Establishment";  echo" ,"; echo"<br/>";  } 
				if($apps['incidence_pre_operation']==1){ echo "Pre Operations"; echo" ,"; echo"<br/>"; } 
				if($apps['incidence_post_operation']==1){ echo "Post Operations"; } ?>
</b></label> 
	</div>
	   <div class="col-md-6">
			<label for="application_name" > Sector Type : </label>
		
			<label class="control-label1" for="application_name" ><b><?php $key=$apps['id'];?>
			<a href="javascript:viewSector('<?php echo $key; ?>')">View</a>
<span id="s_<?php echo $key; ?>" style="display:none;"><?php $sector=explode(',',$apps['service_sector']); $aa=count($sector); for($i=0; $i<$aa ;$i++) { //echo $sector[$i]; }
				 $sectorname=serviceMasterController::getNameOfSeviceSector($sector[$i]); echo $sectorname['name']; if($i!=($aa-1)) echo " , <br>"; }?></span>				
				 </b></label>
	</div>
</div>
	<hr>
	<?php } ?>
	
    <form name="myForm" id="myForm" action="" method="POST">  
            <div class="row">
  <div class="col-md-6">
  <label  for="application_name" >Service Type<span class="required">*</span></label>
    
    <select name="service_type" id="service_type" class="form-control" required  >
                <option value="Approval"  <?php if($apps['service_type']=="Approval"){ echo " selected";} ?>>Approval</option>
    <option value="Certificates" <?php if($apps['service_type']=="Certificates"){ echo " selected";} ?>>Certificates</option>
    <option value="Intimation" <?php if($apps['service_type']=="Intimation"){ echo " selected";} ?>>Intimation</option>
    <option value="License" <?php if($apps['service_type']=="License"){ echo " selected";} ?>>License</option>
    <option value="Permission" <?php if($apps['service_type']=="Permission"){ echo " selected";} ?>>Permission</option>
    <option value="Permit" <?php if($apps['service_type']=="Permit"){ echo " selected";} ?>>Permit</option>
    <option value="Registration" <?php if($apps['service_type']=="Registration"){ echo " selected";} ?>>Registration</option>
    </select>
  </div>


  <div class="col-md-6">
  <label  for="application_name" >Additional Sub Service<span class="required"></span></label>
      
    <select name="additional_sub_service[]" id="additional_sub_service" class="select2-me"  multiple="multiple" >
   
                <?php $allList=InfowizardQuestionMasterExt::getMasterList('bo_information_wizard_additional_sub_service_master','id','sub_service_name'); ?>
                         <?php $a= explode(",",$apps['additional_sub_service']);foreach($allList as $k=>$v){ ?>
                <option value="<?php echo $v; ?>" <?php if(in_array($v,$a)){ echo " selected";}?>><?php echo $v; ?></option>  
                        <?php }?>
                
    </select>
 
</div>
</div>
  
  <!--<div class="row">
  <div class="form-group col-md-6">
  <label class="col-lg-4 col-sm-4 control-label" for="application_name" >Periodic Inspection<span class="required">*</span></label>
      <div class="col-md-8">
  <select class="form-control"  name="periodic_inspection" id="periodic_inspection" >
  <option value="">Select</option>
  <option value="Y">Yes</option>
  <option value="N">No</option>
  </select>
  </div></div></div>
  
  <div class="row">
  <div class="form-group col-md-6">
  <label class="col-lg-4 col-sm-4 control-label" for="application_name" >Checklist Periodic Inspection<span class="required">*</span></label>
      <div class="col-md-8">
  <select class="form-control"  name="checklist_periodic_inspection" id="checklist_periodic_inspection" >
  <option value="">Select</option>
  <option value="Y">Yes</option>
  <option value="N">No</option>
  </select>
  </div></div></div>-->
        

        

                <div class="row">
                    <div class="col-md-6">
                        <label  for="application_name" >

                           HSN Code (comma seprated)
                        </label>
                            <select name="hsn_code[]" class="select2-me" multiple="multiple" style="display:none;">
<?php $allList=InfowizardQuestionMasterExt::getMasterList('bo_information_wizard_hsn_code_master','hsn_code','comodity_name'); ?>
                         <?php foreach($allList as $k=>$v){ ?>
                                <option value="<?php echo $k; ?>"><?php echo $k."-".$v; ?></option>  
                        <?php }?>
                            </select>
                            <input class="form-control" readonly="">
                      
                    </div>
              
                    <div class="col-md-6">
                        <label for="application_name" >

                           NIC 2 Digit Code(comma seprated)
                        </label>

                       
                            <select name="nic_two_digit_code[]" class="select2-me" multiple="multiple" style="display:none" ><?php //echo 22;die;?>
<?php $allList=InfowizardQuestionMasterExt::getMasterList('bo_information_wizard_nic_two_digit_master','division_code','division_description'); //print_r($allList);?>
                         <?php foreach($allList as $k=>$v){ ?>
                                <option value="<?php echo $k; ?>"><?php echo $k."-".$v; ?></option>  
                        <?php }?>
                            </select>
                               <input class="form-control" readonly="">
                       
                    </div>
                </div>
        
                
  <div class="row">
                    <div class="col-md-6">
                        <label  for="application_name" >

                           SAC Digit Code(comma seprated)
                        </label>

                     
                            <select name="sac_code[]" class="select2-me" multiple="multiple" style="display:none">
<?php $allList=InfowizardQuestionMasterExt::getMasterList('bo_information_wizard_sac_code_master','sac_code','service_name'); ?>
                         <?php foreach($allList as $k=>$v){ ?>
                                <option value="<?php echo $k; ?>"><?php echo $k."-".$v; ?></option>  
                        <?php }?>
                            </select>
                               <input class="form-control" readonly="">
                      
                    </div>
               
                    <div class="col-md-6">
                        <label for="application_name" >

                          Applicable ACT<span class="required">&nbsp;</span>
                        </label>

           

                           <select name="act[]" class="select2-me" multiple="multiple" >
<?php $allList=InfowizardQuestionMasterExt::getMasterList('bo_information_wizard_act_master','id','act_name_english'); ?>
                               
                                    <?php //print_r($allList); 
                                    $a= explode(",",$apps['act']); ?>
                 <?php foreach($allList as $k=>$v){ ?>
                                <option value="<?php echo $k; ?>" <?php if(in_array($k,$a)){ echo " selected";}?>><?php echo $v; ?></option>  
                        <?php } ?>
                            </select>
                       
                    </div>
                </div>

  <!-- <div class="row">
                    <div class="col-md-6">
                        <label for="application_name" >

                         Whether the service needs to be applied for mandatorily or the service becomes mandatory after a certain threshold<span class="required">&nbsp;</span>
                        </label>

                      

                            <input type="radio" name="voluntary_mandatory_type" onclick="hideme('voluntary');" value="V" 
              <?php if($apps['voluntary_mandatory_type']=="V"){ ?> checked="checked" <?php } ?> >&nbsp;&nbsp;Voluntary <br>
                            <input type="radio" name="voluntary_mandatory_type" onclick="hideme('mandatory');" value="M" 
              <?php if($apps['voluntary_mandatory_type']=="M"){ ?> checked="checked" <?php } ?> >&nbsp;&nbsp;Mandatory <br>
                            <input type="radio" name="voluntary_mandatory_type" onclick="showme();" value="B" 
              <?php if($apps['voluntary_mandatory_type']=="B"){ ?> checked="checked" <?php } ?> >&nbsp;&nbsp;Mandatory after a certain Threshold </br>
                       
                    </div>
               
                    <div class="form-group col-md-6">
                        <label class="control-label" for="application_name" >

                       Applicability (Definer) Voluntary </label>

                     

                            <input type="text" name="definer_voluntary" class="form-control" 
              value="<?php if(!empty($apps['definer_voluntary'])){ echo $apps['definer_voluntary']; } ?>" />
                        
                    </div>
                </div> -->

  <!-- <div class="row">
                    <div class="form-group col-md-6">
                        <label class="control-label" for="application_name" >

                      Applicability (Qualifier) Voluntary </label>

                      
                            <input type="text" name="qualifier_voluntary" class="form-control"
              value="<?php if(!empty($apps['qualifier_voluntary'])){ echo $apps['qualifier_voluntary']; } ?>" />
                       
                    </div>
               
                    <div class="form-group col-md-6">
                        <label class="control-label" for="application_name" >

                     Applicability (Definer) Mandatory </label>

                        
<input class="form-control" name="definer_mandatory" placeholder="" type="text"
value="<?php if(!empty($apps['definer_mandatory'])){ echo $apps['definer_mandatory']; } ?>" />
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-question-circle tooltips" data-bs-original-title="For Department of Commercial Taxes - Registration under VAT Act is mandatory for greater than Rs. 10 Lakhs where the Definer is Turnover (in Rs.) and Qualifier is 10 lakhs"></i>
                                                        </span>
                       
                    </div>
                </div> -->

  <!-- <div class="row">
                    <div class="form-group col-md-6">
                        <label class="control-label" for="application_name" >

                     Applicability (Qualifier) Mandatory </label>

                    
<input class="form-control" name="qualifier_mandatory" placeholder="" type="text"
value="<?php if(!empty($apps['qualifier_mandatory'])){ echo $apps['qualifier_mandatory']; } ?>" />
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-question-circle tooltips" data-bs-original-title="For Department of Commercial Taxes - Registration under VAT Act is mandatory for greater than Rs. 10 Lakhs where the Definer is Turnover (in Rs.) and Qualifier is 10 lakhs"></i>
                                                        </span>
                            
                     
                    </div>
                </div> -->
      
                        
  
  
            
   <br><br><br>
     
 
    <input type="button" value="Save & Proceed" class="btn btn-primary" onclick="myFunction()">

      
                
             
	   
            </form>
       </div>
     </div>


	   <!-- Model Start Sector Type -->
	   <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="questionDiv" class="modal abc" style="margin:100px; background-color:#FFFFFF;">
        <div class="modal-header" >
          <button type="button" class="" data-bs-bs-dismiss="modal" aria-hidden="true" style="float:right; ">Close</button>
            <h4 class="modal-title" style="padding:10px;" >Service Sector</h4>
        </div>
       
       <div class="model-content" id="mcont" style="padding:10px; background-color:#FFFFFF;" >
	   </div>
   </div>
         <!-- Model End -->
       
	   <script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>

<script>
function myFunction() {
var r = confirm("You have already added other parameters/ service values in consecutive tabs, if you change this value then respective service values (data) will be lost of consecutive tabs and won't be recoverable. Please click on CANCEL to not to change the selected value and click OK to change the already selected values and then configure new values w.r.t. new selection.");
if (r == true) {
	document.getElementById("myForm").submit(); 
} 
else {
} 
//alert(txt);
}
function viewSector(key){
	$('#mcont').html($('#s_'+key).html());
	$('#questionDiv').modal('show');
}
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
			   var $select = $('#issuerby_id');
			   $select.html('');
                $.each(data, function(index, element) {
           	
					$select.append('<option value="' + element.issmap_id + '">' + element.name + '</option>');
        		});
				//alert(data);
				},
			
            error:function(jqXHR, textStatus, errorThrown){
                alert('error::'+errorThrown);
            }
            });
}

$(".voluntary").hide();
$(".mandatory").hide();
function hideme(tryi){
$(".voluntary").hide();
$(".mandatory").hide();
$("."+tryi).toggle();

}
<?php if($apps['voluntary_mandatory_type']=="V"){ ?>
$(".mandatory").hide();
$(".voluntary").show();
<?php } ?>

<?php if($apps['voluntary_mandatory_type']=="M"){ ?>
$(".voluntary").hide();
$(".mandatory").show();
<?php } ?>

<?php if($apps['voluntary_mandatory_type']=="B"){ ?>
$(".voluntary").show();
$(".mandatory").show();
<?php } ?>


function showme(){
$(".voluntary").show();
$(".mandatory").show();

}
	   </script>