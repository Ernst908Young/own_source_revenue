<style>
.control-label1 {
	text-align: left ;
	margin-bottom: 0;
    padding-top: 7px;
	margin-top: 1px;
    font-weight: 400;
}
.required{color:red !important}
</style>

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
.page-sidebar.navbar-collapse.collapse {
    display: none !important;
}
</style>

<?php
/* @var $this InformationWizardServiceMasterController */
/* @var $model BoInformationWizardServiceMaster */
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
<style>    
    .page-content{margin-left:0px !important    ;}
</style>
<div class="portlet-body">
                                        <div class="mt-element-step">
                                            
                                            <div class="row step-thin">
                                               
                                                <div class="col-md-2 bg-grey done mt-step-col active">
                                                    <div class="mt-step-number bg-white font-grey">1</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade">Master</div>
                                                    <div class="mt-step-content font-grey-cascade"> Form</div>
                                                </div>
                                                <div class="col-md-3 bg-grey  mt-step-col ">
                                                    <div class="mt-step-number bg-white font-grey">2</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade">Parameter</div>
                                                    <div class="mt-step-content font-grey-cascade"> Form</div>
                                                </div>
                                                <div class="col-md-3 bg-grey  mt-step-col">
                                                    <div class="mt-step-number bg-white font-grey">3</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade">Inspection </div>
                                                    <div class="mt-step-content font-grey-cascade">Form</div>
                                                </div>
                                                <div class="col-md-2 bg-grey mt-step-col ">
                                                    <div class="mt-step-number bg-white font-grey">4</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade">Fee</div>
                                                    <div class="mt-step-content font-grey-cascade">Form</div>
                                                </div>
                                                  <div class="col-md-2 bg-grey mt-step-col">
                                                    <div class="mt-step-number bg-white font-grey">5</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade">Other </div>
                                                    <div class="mt-step-content font-grey-cascade">  Option</div>
                                                </div>
                                                
                                            </div>
                                            
                                           
                                        </div>
                                    </div>

<div class='portlet box green'>
<!--<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>Create Service Master</div>
    <div class='tools'>
	
	</div>
	
</div>-->
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">

            
			<?php  if(!empty($apps)){ ?>
			<div class="row">
	<div class="form-group col-md-6">
	<label class="col-lg-4 col-sm-4 control-label" for="application_name" >State/Central : </label>
			<div class="col-md-8">
			<label class="control-label1" for="application_name" ><b>
			<?php  $dist_lable=$apps['central_state']; if($dist_lable==1) { echo "State"; } else { echo "Central";} ?></b></label>
	</div></div></div>
	
	<div class="row">
	<div class="form-group col-md-6">
	<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Select Department : </label>
			<div class="col-md-8">
			<label class="control-label1" for="application_name" ><b>
			<?php $issuername=serviceMasterController::getNameOfIssuerBy($apps['issuerby_id']); echo $issuername['name']; ?></b></label>
	</div></div></div>
			
			<div class="row">
	        <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Service Name : </label>
			<div class="col-md-8">
			<label class="control-label1" for="application_name" ><b><?php echo $apps['service_name']; ?></b></label>
	</div></div></div>  
	
			  
			  <div class="row">
	<div class="form-group col-md-6">
	<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Service Incidence : </label>
			<div class="col-md-8">
<label class="control-label1" for="application_name" ><b>
<?php 
if($apps['incidence_pre_establishment']==1){ echo "Pre Establishment";  echo" ,"; echo"<br/>";  } 
				if($apps['incidence_pre_operation']==1){ echo "Pre Operations"; echo" ,"; echo"<br/>"; } 
				if($apps['incidence_post_operation']==1){ echo "Post Operations"; } ?>
</b></label> 
	</div></div></div>
	
	<div class="row">
	   <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" > Sector Type : </label>
			<div class="col-md-8">
			<label class="control-label1" for="application_name" ><b><?php $sector=explode(',',$apps['service_sector']); $aa=count($sector); for($i=0; $i<$aa ;$i++) { //echo $sector[$i]; }
				 $sectorname=serviceMasterController::getNameOfSeviceSector($sector[$i]); echo $sectorname['name']; if($i!=($aa-1)) echo " ,<br/>"; }?> </b></label>
	</div></div></div>
	
	<?php } ?>
	
	
		<form name="" action="" method="POST">	
            <div class="row">
	<div class="form-group col-md-6">
	<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Service Type<span class="required">*</span></label>
			<div class="col-md-8">
		<select name="service_type" id="service_type" class="form-control" required  >
		<option value="Approval">Approval</option>
		<option value="Certificates">Certificates</option>
		<option value="Intimation">Intimation</option>
		<option value="License">License</option>
		<option value="Permission">Permission</option>
		<option value="Permit">Permit</option>
		<option value="Registration">Registration</option>
		</select>
	</div></div></div>
	
	
	<div class="row">
	<div class="form-group col-md-6">
	<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Additional Sub Service<span class="required">*</span></label>
			<div class="col-md-8">
		<select name="additional_sub_service[]" id="additional_sub_service" class="form-control" required  multiple="multiple" >
		<option value="Amendment - Cancellation">Amendment - Cancellation</option>
		<option value="Amendment - Surrender">Amendment - Surrender</option>
		<option value="Amendment - Transfer">Amendment - Transfer</option>
		<option value="Amendment - Others">Amendment - Others</option>
		<option value="Duplicate Copy">Duplicate Copy</option>
		<option value="Renewal">Renewal</option>
		<option value="Return">Return</option>
		<option value="Maintenance of Register">Maintenance of Register</option>
		</select>
		<p>( You can select multiple option by pressing CTRL  ) </p>
	</div></div></div>
	
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
                    <div class="form-group col-md-6">
                        <label class="col-lg-4 col-sm-4 control-label" for="application_name" >

                           HSN Code (comma seprated)
                        </label>

                        <div class="col-md-8">

                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
        
  <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-lg-4 col-sm-4 control-label" for="application_name" >

                           NIC 2 Digit Code(comma seprated)
                        </label>

                        <div class="col-md-8">

                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
        
                
  <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-lg-4 col-sm-4 control-label" for="application_name" >

                           SAC Digit Code(comma seprated)
                        </label>

                        <div class="col-md-8">

                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
  <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-lg-4 col-sm-4 control-label" for="application_name" >

                          Applicable ACT
                        </label>

                        <div class="col-md-8">

                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
  <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-lg-4 col-sm-4 control-label" for="application_name" >

                         Whether the service needs to be applied for mandatorily or the service becomes mandatory after a certain threshold
                        </label>

                        <div class="col-md-8">

                            <input type="checkbox">&nbsp;&nbsp;Voluntary <br>
                            <input type="checkbox">&nbsp;&nbsp;Mandatory <br>
                            <input type="checkbox">&nbsp;&nbsp;Mandatory after a certain Threshold </br>
                        </div>
                    </div>
                </div>
  <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-lg-4 col-sm-4 control-label" for="application_name" >

                       Applicability (Definer) Voluntary </label>

                        <div class="col-md-8">

                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
  <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-lg-4 col-sm-4 control-label" for="application_name" >

                      Applicability (Qualifier) Voluntary </label>

                        <div class="col-md-8">

                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
  <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-lg-4 col-sm-4 control-label" for="application_name" >

                     Applicability (Definer) Mandatory </label>

                         <div class="input-group col-md-8" style="padding-left: 14px;">
<input class="form-control" id="" placeholder="" type="text">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-question-circle tooltips" data-original-title="For Department of Commercial Taxes - Registration under VAT Act is mandatory for greater than Rs. 10 Lakhs where the Definer is Turnover (in Rs.) and Qualifier is 10 lakhs"></i>
                                                        </span>
                        </div>
                    </div>
                </div>
  <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-lg-4 col-sm-4 control-label" for="application_name" >

                     Applicability (Qualifier) Mandatory </label>

                     <div class="input-group col-md-8" style="padding-left: 14px;">
<input class="form-control" id="" placeholder="" type="text">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-question-circle tooltips" data-original-title="For Department of Commercial Taxes - Registration under VAT Act is mandatory for greater than Rs. 10 Lakhs where the Definer is Turnover (in Rs.) and Qualifier is 10 lakhs"></i>
                                                        </span>
                            
                        </div>
                    </div>
                </div>
			
		                    
	
	
	          
    <div class="row buttons" align="center">
	<input type="submit" value="Save & Proceed" class="btn btn-primary" >
	</div>          
                
                
            </form>
       </div></div></div></div><!-- form -->
	   <script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>

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
	   </script>