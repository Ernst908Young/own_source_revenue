  <?php $allsubservices=explode(",",$serviceData['additional_sub_service']);?>

                 

<style>

    <?php //if(!in_array("Amendment including cancellation Surrender Transfer",$allsubservices)) { ?> .aisct{display: none;}  <?php //} ?>
    
    <?php if(!in_array("Amendment - Cancellation",$allsubservices)) { ?> .ac{display: none;}  <?php } ?>
	 <?php if(!in_array("Amendment - Others",$allsubservices)) { ?> .ao{display: none;}  <?php } ?>
    <?php if(!in_array("Amendment - Surrender",$allsubservices)) { ?> .as{display: none;}  <?php } ?>
    <?php if(!in_array("Amendment - Transfer",$allsubservices)) { ?> .at{display: none;}  <?php } ?>

    <?php if(!in_array("Duplicate Copy",$allsubservices)) { ?> .duplicate{display: none;}  <?php } ?>

    <?php if(!in_array("Renewal",$allsubservices)) { ?> .renewal{display: none;}  <?php } ?>

    <?php if(!in_array("Return",$allsubservices)) { ?> .return{display: none;}  <?php } ?>

    <?php if(!in_array("Maintenance of Register",$allsubservices)) { ?> .maintainence{display: none;}  <?php } ?>



</style>
<style> 
.page-sidebar.navbar-collapse.collapse {
    display: none !important;
}   
    .page-content{margin-left:0px !important    ;}
	.col-md-1{width:12.50% !important;}
        .uppercase { font-size: 16px !important;
 
}
</style>


<?php $serviceData['id']=$_GET['serviceID'];?>
<div class="portlet-body">
                                       <div class="mt-element-step">
                                            
                                            <div class="row step-thin">
                                               
                                                <div class="col-md-1 bg-grey  mt-step-col ">
                                                    <div class="mt-step-number bg-white font-grey">1</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/serviceMaster/serviceupdate/serviceID/'.$serviceData['id'].'')?>" >Master</a></div>
                                                    <div class="mt-step-content font-grey-cascade"> Form</div>
                                                </div>
                                                <div class="col-md-1 bg-grey  mt-step-col ">
                                                    <div class="mt-step-number bg-white font-grey">2</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/serviceParameters/Addparams/serviceID/'.$serviceData['id'].'')?>" >Parameter</a></div>
                                                    <div class="mt-step-content font-grey-cascade"> Form</div>
                                                </div>
                                                <div class="col-md-1 bg-grey  mt-step-col done">
                                                    <div class="mt-step-number bg-white font-grey">3</div>
                                                    <div class="mt-step-content font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/serviceInspection/Adddetails/serviceID/'.$serviceData['id'].'')?>" >Inspection </a></div>
                                                    <div class="mt-step-content font-grey-cascade">Form</div>
                                                </div>
                                                <div class="col-md-1 bg-grey mt-step-col ">
                                                    <div class="mt-step-number bg-white font-grey">4</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/serviceFee/Adddetails/serviceID/'.$serviceData['id'].'')?>" >Fee</a></div>
                                                    <div class="mt-step-content font-grey-cascade">Form</div>
                                                </div>
												 <div class="col-md-1 bg-grey mt-step-col ">
                                                    <div class="mt-step-number bg-white font-grey">5</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/ServiceTimeline/create/serviceID/'.$serviceData['id'].'')?>" >Timelines</a></div>
                                                    <div class="mt-step-content font-grey-cascade">Form</div>
                                                </div>
												 <div class="col-md-1 bg-grey  mt-step-col">
                                                    <div class="mt-step-number bg-white font-grey">6</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/ServiceStackholder/create/serviceID/'.$serviceData['id'].'')?>" >Stakeholders</a></div>
                                                    <div class="mt-step-content font-grey-cascade">Form</div>
                                                </div>
                                                  
												 <div class="col-md-1 bg-grey  mt-step-col ">
                                                    <div class="mt-step-number bg-white font-grey">7</div>

                                                    <div class="mt-step-title uppercase font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/ServiceValidity/create/serviceID/'.$serviceData['id'].'')?>" >Validity</a></div>
                                                    <div class="mt-step-content font-grey-cascade"> Form</div>
                                                </div>
												<div class="col-md-1 bg-grey  mt-step-col ">
                                                    <div class="mt-step-number bg-white font-grey">8</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/ServiceValidity/other/serviceID/'.$serviceData['id'].'')?>" >Other </a></div>
                                                    <div class="mt-step-content font-grey-cascade">  Option</div>
                                                </div>
                                                
                                            </div>
                                            
                                           
                                        </div>
                                    </div>


<div class='portlet box green'>

<!--    <div class='portlet-title'>

        <div class='caption'>

            <i style=" font-size:20px;" class='fa fa-plus'></i><b>Sub Form-2 Inspection </b> <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;Create Service Inspection for <strong><?php echo $serviceData['service_name']?></strong></span></div>

        <div class='tools'>



        </div>-->



    </div>

    <div class="portlet-body" style="padding:0px;padding-bottom: 15px;">

        <div class="table-scrollable">

            <form name="" action="" method="POST">

                <input type="hidden" name="service_id" value="<?php echo $serviceData['id']?>">

                                <input type="hidden" name="service_type[]" value="<?php echo $serviceData['service_type']?>">

                                            

  <?php foreach ($allsubservices as $subservices) { ?>

                                

                                 <input type="hidden" name="service_type[]" value="<?php echo $subservices; ?>">

                            

                                <?php } ?>

                <table class="table table-striped table-bordered table-advance table-hover">

                    <thead>

                        <tr>

                            <th>

                            </th>

                            <th class="acilppr">
 <strong> <?php echo $serviceData['service_type']; ?></strong>

                            </th>
                            <th class="ao">
                                <strong>
                                    Amendment<br>Others </strong>
                            </th>
                            <th class="ac">
                                <strong>
                                    Amendment<br>Cancellation </strong>
                            </th>
                            <th class="as">
                                <strong>
                                    Amendment<br>Surrender </strong>
                            </th>
                            <th class="at">
                                <strong>
                                    Amendment<br>Transfer </strong>
                            </th>

                            <th class="duplicate"> 

                                <strong> Duplicate Copy</strong>

                                   

                            </th>

                            <th class="renewal"> 

                                <strong>   Renewal</strong>

                                   

                            </th>



                            <th class="return"> 

                                <strong>   Return</strong> 

                                 

                            </th>

                            <th class="maintainence">

                                <strong>    Maintenance of <br> Register </strong>

                                 

                            </th>





                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>

                                <strong>Are Inspections required ?</strong>

                            </td>

                            <td class="acilppr"><select name="acilppr[is_inspection_required]" class="acilppr form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
							<td class="ao"><select name="ao[is_inspection_required]" class="ao form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection ']['service'])){if($_SESSION['ServiceInspection']['service']['is_inspection_required']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['service'])){if($_SESSION['ServiceInspection']['service']['is_inspection_required']=="N"){echo " selected";}} ?>>No</option>
		
							</select></td>

                            <td class="ac"><select name="ac[is_inspection_required]" class="ac  form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['is_inspection_required']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['is_inspection_required']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="as"><select name="as[is_inspection_required]" class="as form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['is_inspection_required']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['is_inspection_required']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="at"><select name="at[is_inspection_required]" class="at form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['is_inspection_required']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['is_inspection_required']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="duplicate"><select name="duplicate[is_inspection_required]" class="duplicate form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['is_inspection_required']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['is_inspection_required']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="renewal"><select name="renewal[is_inspection_required]" class="renewal form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['is_inspection_required']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['is_inspection_required']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="return"><select name="return[is_inspection_required]" class="return form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['is_inspection_required']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['is_inspection_required']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="maintainence"><select name="maintainence[is_inspection_required]" class="maintainence form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['is_inspection_required']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['is_inspection_required']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                        </tr>

                        <tr>

                            <td>

                                <strong>Is the Inspection Mandatory ? </strong>

                            </td>

                            <td class="acilppr"><select name="acilppr[is_inspection_mandatory]" class="acilppr form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['service'])){if($_SESSION['ServiceInspection']['service']['is_inspection_mandatory']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['service'])){if($_SESSION['ServiceInspection']['service']['is_inspection_mandatory']=="N"){echo " selected";}} ?>>No</option>
		
							</select></td>
							<td class="ao"><select name="ao[is_inspection_mandatory]" class="ao form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){if($_SESSION['ServiceInspection']['Amendment - Others']['is_inspection_mandatory']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){if($_SESSION['ServiceInspection']['Amendment - Others']['is_inspection_mandatory']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="ac"><select name="ac[is_inspection_mandatory]" class="ac form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['is_inspection_mandatory']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['is_inspection_mandatory']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="as"><select name="as[is_inspection_mandatory]" class="as form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['is_inspection_mandatory']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['is_inspection_mandatory']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="at"><select name="at[is_inspection_mandatory]" class="at form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['is_inspection_mandatory']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['is_inspection_mandatory']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="duplicate"><select name="duplicate[is_inspection_mandatory]" class="duplicate form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['is_inspection_mandatory']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['is_inspection_mandatory']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="renewal"><select name="renewal[is_inspection_mandatory]" class="renewal form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['is_inspection_mandatory']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['is_inspection_mandatory']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="return"><select name="return[is_inspection_mandatory]" class="return form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['is_inspection_mandatory']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['is_inspection_mandatory']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="maintainence"><select name="maintainence[is_inspection_mandatory]" class="maintainence form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['is_inspection_mandatory']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['is_inspection_mandatory']=="N"){echo " selected";}} ?>>No</option></select></td>



                        </tr>

                         <tr>

                            <td><strong>Is there a fee required for Inspection ? </strong></td>

                            <td class="acilppr"><select name="acilppr[is_fee_required]" class="acilppr form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['service'])){if($_SESSION['ServiceInspection']['service']['is_fee_required']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['service'])){if($_SESSION['ServiceInspection']['service']['is_fee_required']=="N"){echo " selected";}} ?>>No</option>
		
							</select></td>
 <td class="ao"><select name="ao[is_fee_required]" class="ao form-control cri">
 <option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){if($_SESSION['ServiceInspection']['Amendment - Others']['is_fee_required']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){if($_SESSION['ServiceInspection']['Amendment - Others']['is_fee_required']=="N"){echo " selected";}} ?>>No</option>
 </select></td>
                            <td class="ac"><select name="ac[is_fee_required]" class="ac form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['is_fee_required']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['is_fee_required']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="as"><select name="as[is_fee_required]" class="as form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['is_fee_required']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['is_fee_required']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="at"><select name="at[is_fee_required]" class="at form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['is_fee_required']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['is_fee_required']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="duplicate"><select name="duplicate[is_fee_required]" class="duplicate form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['is_fee_required']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['is_fee_required']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="renewal"><select name="renewal[is_fee_required]" class="renewal form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['is_fee_required']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['is_fee_required']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="return"><select name="return[is_fee_required]" class="return form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['is_fee_required']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['is_fee_required']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="maintainence"><select name="maintainence[is_fee_required]" class="maintainence form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['is_fee_required']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['is_fee_required']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                        </tr>

                        <tr>

                            <td>

                                <strong>Is Self Certification Allowed in lieu of Inspection ? </strong>

                            </td>

                 <td class="acilppr"><select onchange='hide("acilppr[self_certification_creation],acilppr[self_certification_excerpt_from_act],acilppr[self_certification_format]","acilppr[is_self_creation_allowed_in_lieu_of_inspection]")' name="acilppr[is_self_creation_allowed_in_lieu_of_inspection]" class="acilppr form-control cri">
				 <option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['service'])){if($_SESSION['ServiceInspection']['service']['is_self_creation_allowed_in_lieu_of_inspection']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['service'])){if($_SESSION['ServiceInspection']['service']['is_self_creation_allowed_in_lieu_of_inspection']=="N"){echo " selected";}} ?>>No</option>
		
				 </select></td>
 <td class="ao"><select onchange='hide("ao[self_certification_creation],ao[self_certification_excerpt_from_act],ao[self_certification_format]","ao[is_self_creation_allowed_in_lieu_of_inspection]")' name="ao[is_self_creation_allowed_in_lieu_of_inspection]" class="ao form-control cri"><option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){if($_SESSION['ServiceInspection']['Amendment - Others']['is_self_creation_allowed_in_lieu_of_inspection']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){if($_SESSION['ServiceInspection']['Amendment - Others']['is_self_creation_allowed_in_lieu_of_inspection']=="N"){echo " selected";}} ?>>No</option></select></td>
 
                            <td class="ac"><select onchange='hide("ac[self_certification_creation],ac[self_certification_excerpt_from_act],ac[self_certification_format]","ac[is_self_creation_allowed_in_lieu_of_inspection]")' name="ac[is_self_creation_allowed_in_lieu_of_inspection]" class="ac form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['is_self_creation_allowed_in_lieu_of_inspection']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['is_self_creation_allowed_in_lieu_of_inspection']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="as"><select onchange='hide("as[self_certification_creation],as[self_certification_excerpt_from_act],as[self_certification_format]","as[is_self_creation_allowed_in_lieu_of_inspection]")' name="as[is_self_creation_allowed_in_lieu_of_inspection]" class="as form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['is_self_creation_allowed_in_lieu_of_inspection']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['is_self_creation_allowed_in_lieu_of_inspection']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="at"><select onchange='hide("at[self_certification_creation],at[self_certification_excerpt_from_act],at[self_certification_format]","at[is_self_creation_allowed_in_lieu_of_inspection]")' name="at[is_self_creation_allowed_in_lieu_of_inspection]" class="at form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['is_self_creation_allowed_in_lieu_of_inspection']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['is_self_creation_allowed_in_lieu_of_inspection']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="duplicate"><select onchange='hide("duplicate[self_certification_creation],duplicate[self_certification_excerpt_from_act],duplicate[self_certification_format]","duplicate[is_self_creation_allowed_in_lieu_of_inspection]")'  name="duplicate[is_self_creation_allowed_in_lieu_of_inspection]" class="duplicate form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['is_self_creation_allowed_in_lieu_of_inspection']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['is_self_creation_allowed_in_lieu_of_inspection']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="renewal"><select onchange='hide("renewal[self_certification_creation],renewal[self_certification_excerpt_from_act],renewal[self_certification_format]","renewal[is_self_creation_allowed_in_lieu_of_inspection]")' name="renewal[is_self_creation_allowed_in_lieu_of_inspection]" class="renewal form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['is_self_creation_allowed_in_lieu_of_inspection']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['is_self_creation_allowed_in_lieu_of_inspection']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="return"><select onchange='hide("return[self_certification_creation],return[self_certification_excerpt_from_act],return[self_certification_format]","return[is_self_creation_allowed_in_lieu_of_inspection]")' name="return[is_self_creation_allowed_in_lieu_of_inspection]" class="return form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['is_self_creation_allowed_in_lieu_of_inspection']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['is_self_creation_allowed_in_lieu_of_inspection']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="maintainence"><select onchange='hide("maintainence[self_certification_creation],maintainence[self_certification_excerpt_from_act],maintainence[self_certification_format]","maintainence[is_self_creation_allowed_in_lieu_of_inspection]")'name="maintainence[is_self_creation_allowed_in_lieu_of_inspection]" class="maintainence form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['is_self_creation_allowed_in_lieu_of_inspection']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['is_self_creation_allowed_in_lieu_of_inspection']=="N"){echo " selected";}} ?>>No</option></select></td>

                       

                        </tr>

                           <tr>

                            <td>

                                <strong>If Y, then upload relevant GO/ Excerpt from Act </strong>

                            </td>

                            <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilppr[self_certification_excerpt_from_act]" ></td>
                            <td class="ao"> <input type="file" class="form-control cri ao" name="ao[self_certification_excerpt_from_act]" ></td>
                            <td class="ac"> <input type="file" class="form-control cri ac" name="ac[self_certification_excerpt_from_act]" ></td>
                            <td class="as"> <input type="file" class="form-control cri as" name="as[self_certification_excerpt_from_act]" ></td>
                            <td class="at"> <input type="file" class="form-control cri at" name="at[self_certification_excerpt_from_act]" ></td>

                            <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[self_certification_excerpt_from_act]" ></td>

                            <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[self_certification_excerpt_from_act]" ></td>

                            <td class="return"><input type="file" class="form-control cri return" name="return[self_certification_excerpt_from_act]" ></td>

                            <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[self_certification_excerpt_from_act]" ></td>





                        </tr>

                           <tr>

                            <td>

                                <strong>If Y , then upload Self-certification Format </strong>

                            </td>

                            <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilppr[self_certification_format]" ></td>
                             <td class="ao"> <input type="file" class="form-control cri ao" name="ao[self_certification_format]" ></td>
                            <td class="ac"> <input type="file" class="form-control cri ac" name="ac[self_certification_format]" ></td>
                            <td class="as"> <input type="file" class="form-control cri as" name="as[self_certification_format]" ></td>
                            <td class="at"> <input type="file" class="form-control cri at" name="at[self_certification_format]" ></td>

                            <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[self_certification_format]" ></td>

                            <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[self_certification_format]" ></td>

                            <td class="return"><input type="file" class="form-control cri return" name="return[self_certification_format]" ></td>

                            <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[self_certification_format]" ></td>





                        </tr>

                        <tr>

                            <td>

                                <strong>Self Certification Format Creation</strong>

                            </td>

                            <td class="acilppr"> <a href="javascript:;" class="cri" name="acilppr[self_certification_creation]">Sub Form Link </a></td>
                            <td class="ao"> <a href="javascript:;" class="cri" name="ao[self_certification_creation]">Sub Form Link </a></td>
                            <td class="ac"> <a href="javascript:;" class="cri" name="ac[self_certification_creation]">Sub Form Link </a></td>
                            <td class="as"> <a href="javascript:;" class="cri" name="as[self_certification_creation]">Sub Form Link </a></td>
                            <td class="at"> <a href="javascript:;" class="cri" name="at[self_certification_creation]">Sub Form Link </a></td>

                            <td class="duplicate"> <a href="javascript:;" class="cri" name="duplicate[self_certification_creation]">Sub Form Link </a></td>

                            <td class="renewal"> <a href="javascript:;" class="cri" name="renewal[self_certification_creation]">Sub Form Link </a></td>

                            <td class="return"> <a href="javascript:;" class="cri" name="return[self_certification_creation]">Sub Form Link </a></td>

                            <td class="maintainence"> <a href="javascript:;" class="cri" name="maintainence[self_certification_creation]">Sub Form Link </a></td>



                        </tr>



                                            <tr>

                            <td>

                                <strong>Is Third Party Certification allowed in lieu of Departmental Inspection ? </strong>

                            </td>

                            <td class="acilppr"><select onchange='hide("acilppr[third_party_excerpt_from],acilppr[third_party_cettification_format],acilppr[inspecion_report_timeline]","acilppr[is_third_party_certification_allowed]")' name="acilppr[is_third_party_certification_allowed]" class="form-control cri acilppr">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['service'])){if($_SESSION['ServiceInspection']['service']['is_third_party_certification_allowed']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['service'])){if($_SESSION['ServiceInspection']['service']['is_third_party_certification_allowed']=="N"){echo " selected";}} ?>>No</option>
		
							</select></td>

 <td class="ao"><select onchange='hide("ao[third_party_excerpt_from],ao[third_party_cettification_format],ao[inspecion_report_timeline]","ao[is_third_party_certification_allowed]")' name="ao[is_third_party_certification_allowed]" class="form-control cri" ac>
 <option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){if($_SESSION['ServiceInspection']['Amendment - Others']['is_third_party_certification_allowed']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){if($_SESSION['ServiceInspection']['Amendment - Others']['is_third_party_certification_allowed']=="N"){echo " selected";}} ?>>No</option>
 </select></td>
 
                            <td class="ac"><select onchange='hide("ac[third_party_excerpt_from],ac[third_party_cettification_format],ac[inspecion_report_timeline]","ac[is_third_party_certification_allowed]")' name="ac[is_third_party_certification_allowed]" class="form-control cri" ac>
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['is_third_party_certification_allowed']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['is_third_party_certification_allowed']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="as"><select onchange='hide("as[third_party_excerpt_from],as[third_party_cettification_format],as[inspecion_report_timeline]","as[is_third_party_certification_allowed]")' name="as[is_third_party_certification_allowed]" class="form-control cri" as><option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['is_third_party_certification_allowed']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['is_third_party_certification_allowed']=="N"){echo " selected";}} ?>>No</option></select></td>
                            <td class="at"><select onchange='hide("at[third_party_excerpt_from],at[third_party_cettification_format],at[inspecion_report_timeline]","at[is_third_party_certification_allowed]")' name="at[is_third_party_certification_allowed]" class="form-control cri at">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['is_third_party_certification_allowed']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['is_third_party_certification_allowed']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="duplicate"><select onchange='hide("duplicate[third_party_excerpt_from],duplicate[third_party_cettification_format],duplicate[inspecion_report_timeline]","duplicate[is_third_party_certification_allowed]")' name="duplicate[is_third_party_certification_allowed]" class="form-control cri duplicate">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['is_third_party_certification_allowed']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['is_third_party_certification_allowed']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="renewal"><select onchange='hide("renewal[third_party_excerpt_from],renewal[third_party_cettification_format],renewal[inspecion_report_timeline]","renewal[is_third_party_certification_allowed]")' name="renewal[is_third_party_certification_allowed]" class="form-control cri renewal">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['is_third_party_certification_allowed']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['is_third_party_certification_allowed']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="return"><select onchange='hide("return[third_party_excerpt_from],return[third_party_cettification_format],return[inspecion_report_timeline]","return[is_third_party_certification_allowed]")' name="return[is_third_party_certification_allowed]" class="form-control cri return">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['is_third_party_certification_allowed']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['is_third_party_certification_allowed']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="maintainence"><select onchange='hide("maintainence[third_party_excerpt_from],maintainence[third_party_cettification_format],maintainence[inspecion_report_timeline]","maintainence[is_third_party_certification_allowed]")' name="maintainence[is_third_party_certification_allowed]" class="form-control cri maintainence">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['is_third_party_certification_allowed']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['is_third_party_certification_allowed']=="N"){echo " selected";}} ?>>No</option></select></td>



                        </tr>

                        <tr>

                            <td>

                                <strong>If Y, then upload relevant GO/ Excerpt from Act </strong>

                            </td>

                            <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilppr[third_party_excerpt_from]" ></td>
 <td class="ao"> <input type="file" class="form-control cri" ac name="ao[third_party_excerpt_from]" ></td>
                            <td class="ac"> <input type="file" class="form-control cri" ac name="ac[third_party_excerpt_from]" ></td>
                            <td class="as"> <input type="file" class="form-control cri" as  name="as[third_party_excerpt_from]" ></td>
                            <td class="at"> <input type="file" class="form-control cri" at name="at[third_party_excerpt_from]" ></td>

                            <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[third_party_excerpt_from]" ></td>

                            <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[third_party_excerpt_from]" ></td>

                            <td class="return"><input type="file" class="form-control cri return" name="return[third_party_excerpt_from]" ></td>

                            <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[third_party_excerpt_from]" ></td>





                        </tr>

                           <tr>

                            <td><strong>If Y , then upload Third Party Certification Format</strong></td>

                            <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilppr[third_party_cettification_format]" ></td>
 <td class="ao"> <input type="file" class="form-control cri ao" name="ao[third_party_cettification_format]" ></td>
                            <td class="ac"> <input type="file" class="form-control cri ac" name="ac[third_party_cettification_format]" ></td>
                            <td class="as"> <input type="file" class="form-control cri as" name="as[third_party_cettification_format]" ></td>
                            <td class="at"> <input type="file" class="form-control cri at" name="at[third_party_cettification_format]" ></td>

                            <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[third_party_cettification_format]" ></td>

                            <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[third_party_cettification_format]" ></td>

                            <td class="return"><input type="file" class="form-control cri return" name="return[third_party_cettification_format]" ></td>

                            <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[third_party_cettification_format]" ></td>

                        </tr>


                        <tr>

                            <td>

                                <strong>Third Party Certification Format Creation</strong>

                            </td>

                            <td class="acilppr"> <a href="javascript:;" class="cri" name="acilppr[third_party_certification_creation]">Sub Form Link </a></td>
                            <td class="ao"> <a href="javascript:;" class="cri" name="ao[third_party_certification_creation]">Sub Form Link </a></td>
                            <td class="ac"> <a href="javascript:;" class="cri" name="ac[third_party_certification_creation]">Sub Form Link </a></td>
                            <td class="as"> <a href="javascript:;" class="cri" name="as[third_party_certification_creation]">Sub Form Link </a></td>
                            <td class="at"> <a href="javascript:;" class="cri" name="at[third_party_certification_creation]">Sub Form Link </a></td>

                            <td class="duplicate"> <a href="javascript:;" class="cri" name="duplicate[third_party_certification_creation]">Sub Form Link </a></td>

                            <td class="renewal"> <a href="javascript:;" class="cri" name="renewal[third_party_certification_creation]">Sub Form Link </a></td>

                            <td class="return"> <a href="javascript:;" class="cri" name="return[third_party_certification_creation]">Sub Form Link </a></td>

                            <td class="maintainence"> <a href="javascript:;" class="cri" name="maintainence[third_party_certification_creation]">Sub Form Link </a></td>



                        </tr>

                            <tr>

                            <td>

                                <strong>Timeline for Inspection Report Submission</strong>

                            </td>
<td class="acilppr"> <input type="text" class="form-control cri acilppr" name="acilppr[inspecion_report_timeline]" placeholder="Hours / Days" value="<?php if(!empty($_SESSION['ServiceInspection']['service'])){ echo $_SESSION['ServiceInspection']['service']['inspecion_report_timeline']; }?>"  /></td>
                             <td class="ao"> <input type="text" class="form-control cri ao" name="ao[inspecion_report_timeline]" placeholder="Hours / Days"
							 value="<?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){ echo $_SESSION['ServiceInspection']['Amendment - Others']['inspecion_report_timeline']; }?>"  /></td>
                            <td class="ac"> <input type="text" class="form-control cri ac" name="ac[inspecion_report_timeline]" placeholder="Hours / Days" value="<?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){ echo $_SESSION['ServiceInspection']['Amendment - Cancellation']['inspecion_report_timeline']; }?>"  /></td>
                            <td class="as"> <input type="text" class="form-control cri as" name="as[inspecion_report_timeline]" placeholder="Hours / Days" value="<?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){ echo $_SESSION['ServiceInspection']['Amendment - Surrender']['inspecion_report_timeline']; }?>"  /></td>
                            <td class="at"> <input type="text" class="form-control cri at" name="at[inspecion_report_timeline]" placeholder="Hours / Days" value="<?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){ echo $_SESSION['ServiceInspection']['Amendment - Transfer']['inspecion_report_timeline']; }?>"  /></td>

                            <td class="duplicate"><input type="text" class="form-control cri duplicate" name="duplicate[inspecion_report_timeline]" placeholder="Hours / Days" value="<?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){ echo $_SESSION['ServiceInspection']['Duplicate Copy']['inspecion_report_timeline']; }?>"  /></td>

                            <td class="renewal"><input type="text" class="form-control cri renewal" name="renewal[inspecion_report_timeline]" placeholder="Hours / Days" value="<?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){ echo $_SESSION['ServiceInspection']['Renewal']['inspecion_report_timeline']; }?>"  /></td>

                            <td class="return"><input type="text" class="form-control cri return" name="return[inspecion_report_timeline]" placeholder="Hours / Days" value="<?php if(!empty($_SESSION['ServiceInspection']['Return'])){ echo $_SESSION['ServiceInspection']['Return']['inspecion_report_timeline']; }?>"  /></td>

      <td class="maintainence"><input type="text" class="form-control cri maintainence" name="maintainence[inspecion_report_timeline]" placeholder="Hours / Days"
							value="<?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){ echo $_SESSION['ServiceInspection']['Maintenance of Register']['inspecion_report_timeline']; }?>"  /></td>
							
                         

                        </tr>



                                   <tr>

                            <td>

                                <strong>Is the Inspection Checklist Available ?</strong>

                            </td>

                            <td class="acilppr"><select onchange='hide("acilppr[inspection_checklist_format_creation],acilppr[inspection_excerpt_from_act],acilpprs[inspection_checklist_format]","acilppr[is_inspection_checklist_available]")' name="acilppr[is_inspection_checklist_available]"  class="form-control cri acilppr">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['service'])){if($_SESSION['ServiceInspection']['service']['is_inspection_checklist_available']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['service'])){if($_SESSION['ServiceInspection']['service']['is_inspection_checklist_available']=="N"){echo " selected";}} ?>>No</option>
		
							</select></td>
							
<td class="ao"><select onchange='hide("ao[inspection_checklist_format_creation],ao[inspection_excerpt_from_act],ao[inspection_checklist_format]","ao[is_inspection_checklist_available]")' name="ao[is_inspection_checklist_available]" class="form-control cri" aisct>
<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){if($_SESSION['ServiceInspection']['Amendment - Others']['is_inspection_checklist_available']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){if($_SESSION['ServiceInspection']['Amendment - Others']['is_inspection_checklist_available']=="N"){echo " selected";}} ?>>No</option>
</select></td>

                            <td class="ac"><select onchange='hide("ac[inspection_checklist_format_creation],ac[inspection_excerpt_from_act],ac[inspection_checklist_format]","ac[is_inspection_checklist_available]")' name="ac[is_inspection_checklist_available]" class="form-control cri" aisct><option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['is_inspection_checklist_available']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['is_inspection_checklist_available']=="N"){echo " selected";}} ?>>No</option></select></td>
                            <td class="as"><select onchange='hide("as[inspection_checklist_format_creation],as[inspection_excerpt_from_act],as[inspection_checklist_format]","as[is_inspection_checklist_available]")' name="as[is_inspection_checklist_available]" class="form-control cri" aisct><option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['is_inspection_checklist_available']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['is_inspection_checklist_available']=="N"){echo " selected";}} ?>>No</option></select></td>
                            <td class="at"><select onchange='hide("at[inspection_checklist_format_creation],at[inspection_excerpt_from_act],at[inspection_checklist_format]","at[is_inspection_checklist_available]")' name="at[is_inspection_checklist_available]" class="form-control cri" aisct>
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['is_inspection_checklist_available']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['is_inspection_checklist_available']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="duplicate"><select onchange='hide("duplicate[inspection_checklist_format_creation],duplicate[inspection_excerpt_from_act],duplicate[inspection_checklist_format]","duplicate[is_inspection_checklist_available]")' name="duplicate[is_inspection_checklist_available]" class="form-control cri duplicate">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['is_inspection_checklist_available']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['is_inspection_checklist_available']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="renewal"><select onchange='hide("renewal[inspection_checklist_format_creation],renewal[inspection_excerpt_from_act],renewal[inspection_checklist_format]","renewal[is_inspection_checklist_available]")' name="renewal[is_inspection_checklist_available]" class="form-control cri renewal">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['is_inspection_checklist_available']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['is_inspection_checklist_available']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="return"><select onchange='hide("return[inspection_checklist_format_creation],return[inspection_excerpt_from_act],return[inspection_checklist_format]","return[is_inspection_checklist_available]")' name="return[is_inspection_checklist_available]" class="form-control cri return"><option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['is_inspection_checklist_available']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['is_inspection_checklist_available']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="maintainence"><select onchange='hide("maintainence[inspection_checklist_format_creation],maintainence[inspection_excerpt_from_act],maintainence[inspection_checklist_format]","maintainence[is_inspection_checklist_available]")' name="maintainence[is_inspection_checklist_available]" class="form-control cri maintainence">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['is_inspection_checklist_available']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['is_inspection_checklist_available']=="N"){echo " selected";}} ?>>No</option></select></td>





                        </tr>

                        <tr>

                            <td>

                                <strong>If Y, then upload relevant GO/ Excerpt from Act ?</strong>

                            </td>

                            <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilppr[inspection_excerpt_from_act]" ></td>
                          <td class="ao"> <input type="file" class="form-control cri ao" name="ao[inspection_excerpt_from_act]" ></td>
                            <td class="ac"> <input type="file" class="form-control cri ac" name="ac[inspection_excerpt_from_act]" ></td>
                            <td class="as"> <input type="file" class="form-control cri as" name="as[inspection_excerpt_from_act]" ></td>
                            <td class="at"> <input type="file" class="form-control cri at" name="at[inspection_excerpt_from_act]" ></td>

                            <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[inspection_excerpt_from_act]" ></td>

                            <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[inspection_excerpt_from_act]" ></td>

                            <td class="return"><input type="file" class="form-control cri return" name="return[inspection_excerpt_from_act]" ></td>

                            <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[inspection_excerpt_from_act]" ></td>

                        

                        </tr>



                        <tr><td><strong>If Y , then upload Inspection Checklist Format</strong></td>

                            <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilpprs[inspection_checklist_format]" ></td>
<td class="ao"> <input type="file" class="form-control cri ao" name="ao[inspection_checklist_format]" ></td>
                            <td class="ac"> <input type="file" class="form-control cri ac" name="ac[inspection_checklist_format]" ></td>
                            <td class="as"> <input type="file" class="form-control cri as" name="as[inspection_checklist_format]" ></td>
                            <td class="at"> <input type="file" class="form-control cri at" name="at[inspection_checklist_format]" ></td>

                            <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[inspection_checklist_format]" ></td>

                            <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[inspection_checklist_format]" ></td>

                            <td class="return"><input type="file" class="form-control cri return" name="return[inspection_checklist_format]" ></td>

                            <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[inspection_checklist_format]" ></td>

                         </tr>



                          <tr>

                            <td>

                                <strong>Inspection Checklist Format Creation</strong>

                            </td>

                            <td class="acilppr"> <a href="javascript:;" class="cri" name="acilppr[inspection_checklist_format_creation]">Sub Form Link </a></td>
<td class="ao"> <a href="javascript:;" class="cri" name="ao[inspection_checklist_format_creation]">Sub Form Link </a></td>
                            <td class="ac"> <a href="javascript:;" class="cri" name="ac[inspection_checklist_format_creation]">Sub Form Link </a></td>
                            <td class="as"> <a href="javascript:;" class="cri" name="as[inspection_checklist_format_creation]">Sub Form Link </a></td>
                            <td class="at"> <a href="javascript:;" class="cri" name="at[inspection_checklist_format_creation]">Sub Form Link </a></td>

                            <td class="duplicate"> <a href="javascript:;" class="cri" name="duplicate[inspection_checklist_format_creation]">Sub Form Link </a></td>

                            <td class="renewal"> <a href="javascript:;" class="cri" name="renewal[inspection_checklist_format_creation]">Sub Form Link </a></td>

                            <td class="return"> <a href="javascript:;" class="cri" name="return[inspection_checklist_format_creation]">Sub Form Link </a></td>

                            <td class="maintainence"> <a href="javascript:;" class="cri" name="maintainence[inspection_checklist_format_creation]">Sub Form Link </a></td>



                        </tr>

   <tr>

                            <td>

                                <strong>Are there Periodic Inspections mandated for the Service ? </strong>

                            </td>

                            <td class="acilppr"><select name="acilppr[periodic_inspection_mandate_for_service]"  class="form-control cri acilppr">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['service'])){if($_SESSION['ServiceInspection']['service']['periodic_inspection_mandate_for_service']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['service'])){if($_SESSION['ServiceInspection']['service']['periodic_inspection_mandate_for_service']=="N"){echo " selected";}} ?>>No</option>
		</select></td>
 <td class="ao"><select  name="ao[periodic_inspection_mandate_for_service]" class="form-control cri ao">
 <option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){if($_SESSION['ServiceInspection']['Amendment - Others']['periodic_inspection_mandate_for_service']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){if($_SESSION['ServiceInspection']['Amendment - Others']['periodic_inspection_mandate_for_service']=="N"){echo " selected";}} ?>>No</option>
 </select></td>
                            <td class="ac"><select  name="ac[periodic_inspection_mandate_for_service]" class="form-control cri ac">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['periodic_inspection_mandate_for_service']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['periodic_inspection_mandate_for_service']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="as"><select  name="as[periodic_inspection_mandate_for_service]" class="form-control cri as">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['periodic_inspection_mandate_for_service']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['periodic_inspection_mandate_for_service']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="at"><select  name="at[periodic_inspection_mandate_for_service]" class="form-control cri at">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['periodic_inspection_mandate_for_service']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['periodic_inspection_mandate_for_service']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="duplicate"><select name="duplicate[periodic_inspection_mandate_for_service]" class="form-control cri duplicate">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['periodic_inspection_mandate_for_service']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['periodic_inspection_mandate_for_service']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="renewal"><select  name="renewal[periodic_inspection_mandate_for_service]" class="form-control cri renewal">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['periodic_inspection_mandate_for_service']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['periodic_inspection_mandate_for_service']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="return"><select  name="return[periodic_inspection_mandate_for_service]" class="form-control cri return">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['periodic_inspection_mandate_for_service']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['periodic_inspection_mandate_for_service']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="maintainence"><select  name="maintainence[periodic_inspection_mandate_for_service]" class="form-control cri maintainence">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['periodic_inspection_mandate_for_service']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['periodic_inspection_mandate_for_service']=="N"){echo " selected";}} ?>>No</option></select></td>





                        </tr>



                     

                            <tr><td><strong>Checklist Available for Peridic Inspections</strong></td>

                             <td class="acilppr"><select onchange='hide("acilppr[upload_periodic_checklist_format]","acilppr[checklist_periodic_inspection_avilable]")' name="acilppr[checklist_periodic_inspection_avilable]"  class="form-control cri acilppr">
							 <option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['service'])){if($_SESSION['ServiceInspection']['service']['checklist_periodic_inspection_avilable']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['service'])){if($_SESSION['ServiceInspection']['service']['checklist_periodic_inspection_avilable']=="N"){echo " selected";}} ?>>No</option>
		
							 </select></td>
<td class="ao"><select onchange='hide("ao[upload_periodic_checklist_format]","ao[checklist_periodic_inspection_avilable]")' name="ao[checklist_periodic_inspection_avilable]" class="form-control cri ao">
<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){if($_SESSION['ServiceInspection']['Amendment - Others']['checklist_periodic_inspection_avilable']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){if($_SESSION['ServiceInspection']['Amendment - Others']['checklist_periodic_inspection_avilable']=="N"){echo " selected";}} ?>>No</option>
</select></td>
                            <td class="ac"><select onchange='hide("ac[upload_periodic_checklist_format]","ac[checklist_periodic_inspection_avilable]")' name="ac[checklist_periodic_inspection_avilable]" class="form-control cri ac">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['checklist_periodic_inspection_avilable']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['checklist_periodic_inspection_avilable']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="as"><select onchange='hide("as[upload_periodic_checklist_format]","as[checklist_periodic_inspection_avilable]")' name="as[checklist_periodic_inspection_avilable]" class="form-control cri as">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['checklist_periodic_inspection_avilable']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['checklist_periodic_inspection_avilable']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="at"><select onchange='hide("at[upload_periodic_checklist_format]","at[checklist_periodic_inspection_avilable]")' name="at[checklist_periodic_inspection_avilable]" class="form-control cri at">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['checklist_periodic_inspection_avilable']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['checklist_periodic_inspection_avilable']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="duplicate"><select onchange='hide("duplicate[upload_periodic_checklist_format]","duplicate[checklist_periodic_inspection_avilable]")' name="duplicate[checklist_periodic_inspection_avilable]" class="form-control cri duplicate">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['checklist_periodic_inspection_avilable']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['checklist_periodic_inspection_avilable']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="renewal"><select onchange='hide("renewal[upload_periodic_checklist_format]","renewal[checklist_periodic_inspection_avilable]")' name="renewal[checklist_periodic_inspection_avilable]" class="form-control cri renewal">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['checklist_periodic_inspection_avilable']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['checklist_periodic_inspection_avilable']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="return"><select onchange='hide("return[upload_periodic_checklist_format]","return[checklist_periodic_inspection_avilable]")' name="return[checklist_periodic_inspection_avilable]" class="form-control cri return">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['checklist_periodic_inspection_avilable']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['checklist_periodic_inspection_avilable']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="maintainence"><select onchange='hide("maintainence[upload_periodic_checklist_format]","maintainence[checklist_periodic_inspection_avilable]")' name="maintainence[checklist_periodic_inspection_avilable]" class="form-control cri maintainence"><option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['checklist_periodic_inspection_avilable']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['checklist_periodic_inspection_avilable']=="N"){echo " selected";}} ?>>No</option>
							</select></td>



                         </tr>



                       

                      

                        <tr>

                            <td>

                                <strong>If Yes, Then Upload Periodic Checklist Format</strong>

                            </td>

                            <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilppr[upload_periodic_checklist_format]" ></td>
 <td class="ao"> <input type="file" class="form-control cri ao" name="ao[upload_periodic_checklist_format]" ></td>
                            <td class="ac"> <input type="file" class="form-control cri ac" name="ac[upload_periodic_checklist_format]" ></td>
                            <td class="as"> <input type="file" class="form-control cri as" name="as[upload_periodic_checklist_format]" ></td>
                            <td class="at"> <input type="file" class="form-control cri at" name="at[upload_periodic_checklist_format]" ></td>

                            <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[upload_periodic_checklist_format]" ></td>

                            <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[upload_periodic_checklist_format]" ></td>

                            <td class="return"><input type="file" class="form-control cri return" name="return[upload_periodic_checklist_format]" ></td>

                            <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[upload_periodic_checklist_format]" ></td>

                        </tr>

                        

                          <tr>

                            <td>

                                <strong>Are Surprise Inspections allowed in the Service ?</strong>

                            </td>

                            <td class="acilppr"><select onchange='hide("acilppr[upload_periodic_checklist_format_sruprise]","acilppr[is_surprise_inspection_allowed_in_service]")' name="acilppr[is_surprise_inspection_allowed_in_service]" class="form-control cri acilppr">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['service'])){if($_SESSION['ServiceInspection']['service']['is_surprise_inspection_allowed_in_service']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['service'])){if($_SESSION['ServiceInspection']['service']['is_surprise_inspection_allowed_in_service']=="N"){echo " selected";}} ?>>No</option>
		
							</select></td>
<td class="ao"><select onchange='hide("ao[upload_periodic_checklist_format_sruprise]","ao[is_surprise_inspection_allowed_in_service]")' name="ao[is_surprise_inspection_allowed_in_service]" class="form-control cri ao">
<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){if($_SESSION['ServiceInspection']['Amendment - Others']['is_surprise_inspection_allowed_in_service']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){if($_SESSION['ServiceInspection']['Amendment - Others']['is_surprise_inspection_allowed_in_service']=="N"){echo " selected";}} ?>>No</option>
</select></td>
                            <td class="ac"><select onchange='hide("ac[upload_periodic_checklist_format_sruprise]","ac[is_surprise_inspection_allowed_in_service]")' name="ac[is_surprise_inspection_allowed_in_service]" class="form-control cri ac">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['is_surprise_inspection_allowed_in_service']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['is_surprise_inspection_allowed_in_service']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="as"><select onchange='hide("as[upload_periodic_checklist_format_sruprise]","as[is_surprise_inspection_allowed_in_service]")' name="as[is_surprise_inspection_allowed_in_service]" class="form-control cri as">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['is_surprise_inspection_allowed_in_service']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['is_surprise_inspection_allowed_in_service']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="at"><select onchange='hide("at[upload_periodic_checklist_format_sruprise]","at[is_surprise_inspection_allowed_in_service]")' name="at[is_surprise_inspection_allowed_in_service]" class="form-control cri at">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['is_surprise_inspection_allowed_in_service']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['is_surprise_inspection_allowed_in_service']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="duplicate"><select onchange='hide("duplicate[upload_periodic_checklist_format_sruprise]","duplicate[is_surprise_inspection_allowed_in_service]")' name="duplicate[is_surprise_inspection_allowed_in_service]" class="form-control cri duplicate">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['is_surprise_inspection_allowed_in_service']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['is_surprise_inspection_allowed_in_service']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="renewal"><select onchange='hide("renewal[upload_periodic_checklist_format_sruprise]","renewal[is_surprise_inspection_allowed_in_service]")' name="renewal[is_surprise_inspection_allowed_in_service]" class="form-control cri renewal">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['is_surprise_inspection_allowed_in_service']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['is_surprise_inspection_allowed_in_service']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="return"><select onchange='hide("return[upload_periodic_checklist_format_sruprise]","return[is_surprise_inspection_allowed_in_service]")' name="return[is_surprise_inspection_allowed_in_service]" class="form-control cri return">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['is_surprise_inspection_allowed_in_service']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['is_surprise_inspection_allowed_in_service']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="maintainence"><select onchange='hide("maintainence[upload_periodic_checklist_format_sruprise]","maintainence[is_surprise_inspection_allowed_in_service]")' name="maintainence[is_surprise_inspection_allowed_in_service]" class="form-control cri maintainence">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['is_surprise_inspection_allowed_in_service']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['is_surprise_inspection_allowed_in_service']=="N"){echo " selected";}} ?>>No</option>
							</select></td>





                        </tr>

                    

                        

                          

                        <tr>

                            <td><strong>If Yes, Then Upload Periodic Checklist Format</strong></td>

                            <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilppr[upload_periodic_checklist_format_sruprise]" ></td>
 <td class="ao"> <input type="file" class="form-control cri ao" name="ao[upload_periodic_checklist_format_sruprise]" ></td>
                            <td class="ac"> <input type="file" class="form-control cri ac" name="ac[upload_periodic_checklist_format_sruprise]" ></td>
                            <td class="as"> <input type="file" class="form-control cri as" name="as[upload_periodic_checklist_format_sruprise]" ></td>
                            <td class="at"> <input type="file" class="form-control cri at" name="at[upload_periodic_checklist_format_sruprise]" ></td>

                            <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[upload_periodic_checklist_format_sruprise]" ></td>

                            <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[upload_periodic_checklist_format_sruprise]" ></td>

                            <td class="return"><input type="file" class="form-control cri return" name="return[upload_periodic_checklist_format_sruprise]" ></td>

                            <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[upload_periodic_checklist_format_sruprise]" ></td>

     </tr>              <tr>

                            <td>

                                <strong>Checklist Available for Surprise Inspections</strong>

                            </td>

                            <td class="acilppr"><select onchange='hide("acilppr[document_checklist_upload],acilpprs[document_checklist_creation]","acilppr[is_surprise_inspection_allowed_in_service]")' name="acilppr[checklist_avilable_for_surprise]" class="form-control cri acilppr">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['service'])){if($_SESSION['ServiceInspection']['service']['checklist_avilable_for_surprise']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['service'])){if($_SESSION['ServiceInspection']['service']['checklist_avilable_for_surprise']=="N"){echo " selected";}} ?>>No</option>
		
							</select></td>
<td class="ao"><select onchange='hide("ao[document_checklist_upload],ao[document_checklist_creation]","ao[is_surprise_inspection_allowed_in_service]")' name="ao[checklist_avilable_for_surprise]" class="form-control cri ao">
<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){if($_SESSION['ServiceInspection']['Amendment - Others']['checklist_avilable_for_surprise']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){if($_SESSION['ServiceInspection']['Amendment - Others']['checklist_avilable_for_surprise']=="N"){echo " selected";}} ?>>No</option>
</select></td>
                            <td class="ac"><select onchange='hide("ac[document_checklist_upload],ac[document_checklist_creation]","ac[is_surprise_inspection_allowed_in_service]")' name="ac[checklist_avilable_for_surprise]" class="form-control cri ac">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['checklist_avilable_for_surprise']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['checklist_avilable_for_surprise']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="as"><select onchange='hide("as[document_checklist_upload],as[document_checklist_creation]","as[is_surprise_inspection_allowed_in_service]")' name="as[checklist_avilable_for_surprise]" class="form-control cri as">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['checklist_avilable_for_surprise']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['checklist_avilable_for_surprise']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="at"><select onchange='hide("at[document_checklist_upload],at[document_checklist_creation]","at[is_surprise_inspection_allowed_in_service]")' name="at[checklist_avilable_for_surprise]" class="form-control cri at">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['checklist_avilable_for_surprise']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['checklist_avilable_for_surprise']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="duplicate"><select onchange='hide("duplicate[document_checklist_upload],duplicate[document_checklist_creation]","duplicate[is_surprise_inspection_allowed_in_service]")' name="duplicate[checklist_avilable_for_surprise]" class="form-control cri duplicate">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['checklist_avilable_for_surprise']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['checklist_avilable_for_surprise']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="renewal"><select onchange='hide("renewal[document_checklist_upload],renewal[document_checklist_creation]","renewal[is_surprise_inspection_allowed_in_service]")' name="renewal[checklist_avilable_for_surprise]" class="form-control cri renewal">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['checklist_avilable_for_surprise']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['checklist_avilable_for_surprise']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="return"><select onchange='hide("return[document_checklist_upload],return[document_checklist_creation]","return[is_surprise_inspection_allowed_in_service]")' name="return[checklist_avilable_for_surprise]" class="form-control cri return">
							<option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['checklist_avilable_for_surprise']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['checklist_avilable_for_surprise']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="maintainence"><select onchange='hide("maintainence[document_checklist_upload],maintainence[document_checklist_creation]","maintainence[is_surprise_inspection_allowed_in_service]")' name="maintainence[checklist_avilable_for_surprise]" class="form-control cri maintainence"><option value="Y" <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['checklist_avilable_for_surprise']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['checklist_avilable_for_surprise']=="N"){echo " selected";}} ?>>No</option>
							</select></td>





                        </tr>

                          <tr>

                            <td>

                                <strong>Basis of Surprise Inspection</strong>

                            </td>

                            <td class="acilppr"><select onchange='hide("acilppr[document_checklist_upload],acilpprs[document_checklist_creation]","acilppr[basic_of_surprise_inspection]")' name="acilppr[basic_of_surprise_inspection]" class="form-control cri acilppr">
							<option value="Compliant" <?php if(!empty($_SESSION['ServiceInspection']['service'])){if($_SESSION['ServiceInspection']['service']['basic_of_surprise_inspection']=="Compliant"){echo " selected";}} ?>>Compliant</option>
<option value="Other" <?php if(!empty($_SESSION['ServiceInspection']['service'])){if($_SESSION['ServiceInspection']['service']['basic_of_surprise_inspection']=="Other"){echo " selected";}} ?>>Other</option>
							</select></td>
<td class="ao"><select onchange='hide("ao[document_checklist_upload],ao[document_checklist_creation]","ao[basic_of_surprise_inspection]")' name="ao[basic_of_surprise_inspection]" class="form-control cri ao">
<option value="Compliant" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){if($_SESSION['ServiceInspection']['Amendment - Others']['basic_of_surprise_inspection']=="Compliant"){echo " selected";}} ?>>Compliant</option>
<option value="Other" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){if($_SESSION['ServiceInspection']['Amendment - Others']['basic_of_surprise_inspection']=="Other"){echo " selected";}} ?>>Other</option>
</select></td>
                            <td class="ac"><select onchange='hide("ac[document_checklist_upload],ac[document_checklist_creation]","ac[basic_of_surprise_inspection]")' name="ac[basic_of_surprise_inspection]" class="form-control cri ac">
							<option value="Compliant" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['basic_of_surprise_inspection']=="Compliant"){echo " selected";}} ?>>Compliant</option>
<option value="Other" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){if($_SESSION['ServiceInspection']['Amendment - Cancellation']['basic_of_surprise_inspection']=="Other"){echo " selected";}} ?>>Other</option>
							</select></td>
                            <td class="as"><select onchange='hide("as[document_checklist_upload],as[document_checklist_creation]","as[basic_of_surprise_inspection]")' name="as[basic_of_surprise_inspection]" class="form-control cri as">
							<option value="Compliant" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['basic_of_surprise_inspection']=="Compliant"){echo " selected";}} ?>>Compliant</option>
<option value="Other" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){if($_SESSION['ServiceInspection']['Amendment - Surrender']['basic_of_surprise_inspection']=="Other"){echo " selected";}} ?>>Other</option>
							</select></td>
                            <td class="at"><select onchange='hide("at[document_checklist_upload],at[document_checklist_creation]","at[basic_of_surprise_inspection]")' name="at[basic_of_surprise_inspection]" class="form-control cri at">
							<option value="Compliant" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['basic_of_surprise_inspection']=="Compliant"){echo " selected";}} ?>>Compliant</option>
<option value="Other" <?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){if($_SESSION['ServiceInspection']['Amendment - Transfer']['basic_of_surprise_inspection']=="Other"){echo " selected";}} ?>>Other</option>
							</select></td>

                            <td class="duplicate"><select onchange='hide("duplicate[document_checklist_upload],duplicate[document_checklist_creation]","duplicate[basic_of_surprise_inspection]")' name="duplicate[basic_of_surprise_inspection]" class="form-control cri duplicate">
							<option value="Compliant" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['basic_of_surprise_inspection']=="Compliant"){echo " selected";}} ?>>Compliant</option>
<option value="Other" <?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){if($_SESSION['ServiceInspection']['Duplicate Copy']['basic_of_surprise_inspection']=="Other"){echo " selected";}} ?>>Other</option>
							</select></td>

                            <td class="renewal"><select onchange='hide("renewal[document_checklist_upload],renewal[document_checklist_creation]","renewal[basic_of_surprise_inspection]")' name="renewal[basic_of_surprise_inspection]" class="form-control cri renewal">
							<option value="Compliant" <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['basic_of_surprise_inspection']=="Compliant"){echo " selected";}} ?> >Compliant</option><option value="Other"  <?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){if($_SESSION['ServiceInspection']['Renewal']['basic_of_surprise_inspection']=="Other"){echo " selected";}} ?>>Other</option>
							</select></td>

                            <td class="return"><select onchange='hide("return[document_checklist_upload],return[document_checklist_creation]","return[basic_of_surprise_inspection]")' name="return[basic_of_surprise_inspection]" class="form-control cri return">
							<option value="Compliant" <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['basic_of_surprise_inspection']=="Compliant"){echo " selected";}} ?> >Compliant</option><option value="Other"  <?php if(!empty($_SESSION['ServiceInspection']['Return'])){if($_SESSION['ServiceInspection']['Return']['basic_of_surprise_inspection']=="Other"){echo " selected";}} ?>>Other</option>
							</select></td>

                            <td class="maintainence"><select onchange='hide("maintainence[document_checklist_upload],maintainence[document_checklist_creation]","maintainence[basic_of_surprise_inspection]")' name="maintainence[basic_of_surprise_inspection]" class="form-control cri maintainence">
							<option value="Compliant" <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['basic_of_surprise_inspection']=="Compliant"){echo " selected";}} ?> >Compliant</option><option value="Other"  <?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){if($_SESSION['ServiceInspection']['Maintenance of Register']['basic_of_surprise_inspection']=="Other"){echo " selected";}} ?>>Other</option>
							</select></td>





                        </tr>

                        <tr>

                            <td><strong>Comments </strong></td>

                            <td class="acilppr"><textarea name="acilppr[comment]" class="form-control cri" ><?php if(!empty($_SESSION['ServiceInspection']['service'])){ echo $_SESSION['ServiceInspection']['service']['comment']; }?></textarea></td>
							 <td class="ao"><textarea name="ao[comment]" class="form-control cri" ><?php if(!empty($_SESSION['ServiceInspection']['Amendment - Others'])){ echo $_SESSION['ServiceInspection']['Amendment - Others']['comment']; }?></textarea></td>
                            <td class="ac"><textarea name="ac[comment]" class="form-control cri" ><?php if(!empty($_SESSION['ServiceInspection']['Amendment - Cancellation'])){ echo $_SESSION['ServiceInspection']['Amendment - Cancellation']['comment']; }?></textarea></td>
                            <td class="as"><textarea name="as[comment]" class="form-control cri" ><?php if(!empty($_SESSION['ServiceInspection']['Amendment - Surrender'])){ echo $_SESSION['ServiceInspection']['Amendment - Surrender']['comment']; }?></textarea></td>
                            <td class="at"><textarea name="at[comment]" class="form-control cri" ><?php if(!empty($_SESSION['ServiceInspection']['Amendment - Transfer'])){ echo $_SESSION['ServiceInspection']['Amendment - Transfer']['comment']; }?></textarea></td>
                            <td class="duplicate"><textarea name="duplicate[comment]" class="form-control cri" ><?php if(!empty($_SESSION['ServiceInspection']['Duplicate Copy'])){ echo $_SESSION['ServiceInspection']['Duplicate Copy']['comment']; }?></textarea></td>
                            <td class="renewal"><textarea name="renewal[comment]" class="form-control cri" ><?php if(!empty($_SESSION['ServiceInspection']['Renewal'])){ echo $_SESSION['ServiceInspection']['Renewal']['comment']; }?></textarea></td>
                            <td class="return"><textarea name="return[comment]" class="form-control cri" ><?php if(!empty($_SESSION['ServiceInspection']['Return'])){ echo $_SESSION['ServiceInspection']['Return']['comment']; }?></textarea></td>
                            <td class="maintainence"><textarea name="maintainence[comment]" class="form-control cri" ><?php if(!empty($_SESSION['ServiceInspection']['Maintenance of Register'])){ echo $_SESSION['ServiceInspection']['Maintenance of Register']['comment']; }?></textarea></td>
                        </tr>

                    </tbody>

                </table>

                <input type="submit" value="Save" class="btn btn-primary">

            </form>

        </div>

    </div>

</div>



<script>

    

    $(document).ready(function () {

        $(".cri").each(function () {

            var str = $(this).attr("name");

            var res = str.replace("]", "");

            var res1 = res.replace("[", "_");

            $(this).attr("id", res1);

        });

    });



    function hide(nme,frm) {

       var frm1 = frm.replace("]", "");

            var frm2= frm1.replace("[", "_");

         var choosenOption = document.getElementById(frm2).value;           

        var nme1 = nme.split(",");

        for (var i = 0; i <= nme1.length; i++) {

            var res = nme1[i].replace("]", "");

            var res1 = res.replace("[", "_");

            if (choosenOption== "Y") {

                $("#" + res1).css("display", "block");

            } else {

                $("#" + res1).css("display", "none");

            }

         }

    }

         


</script>



