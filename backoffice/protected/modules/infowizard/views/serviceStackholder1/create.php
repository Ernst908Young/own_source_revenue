  <?php $allsubservices=explode(",",$serviceData['additional_sub_service']);?>                 
<style>
    <?php if(!in_array("Amendment - Others",$allsubservices)) { ?> .ao{display: none;}  <?php } ?>
    <?php if(!in_array("Amendment - Cancellation",$allsubservices)) { ?> .ac{display: none;}  <?php } ?>
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
	.col-md-1{width:12.50% !important}
</style>
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
                                                <div class="col-md-1 bg-grey  mt-step-col">
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
												 <div class="col-md-1 bg-grey done mt-step-col active">
                                                    <div class="mt-step-number bg-white font-grey">6</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/ServiceStackholder/create/serviceID/'.$serviceData['id'].'')?>" >Stackholders</a></div>
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
            <i style=" font-size:20px;" class='fa fa-plus'></i><b>Sub Form-1 Service Parameter  </b>   Create Service Parameter for <strong><?php echo $serviceData['service_name']?></strong></div>
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
                                <strong>Duplicate Copy</strong>
                                   
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
                                <strong> Requires Services of Professionals to apply for the service </strong>
                            </td>
                            <td class="acilppr"><select name="acilppr[services_professionals]" class="acilppr form-control cri">
							<option value="Y">Yes</option><option value="N">No</option></select></td>                
							<td class="ao"><select name="ao[services_professionals]" class="ao form-control cri">
							<option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="ac"><select name="ac[services_professionals]" class="ac form-control cri">
							<option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="as"><select name="as[services_professionals]" class="as form-control cri">
							<option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="at"><select name="at[services_professionals]" class="at form-control cri">
							<option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="duplicate"><select name="duplicate[services_professionals]" class="duplicate form-control cri">
							<option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="renewal"><select name="renewal[services_professionals]" class="renewal form-control cri">
							<option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="return"><select name="return[services_professionals]" class="return form-control cri">
							<option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="maintainence"><select name="maintainence[services_professionals]" class="maintainence form-control cri">
							<option value="Y">Yes</option><option value="N">No</option></select></td>
                        </tr>
                        
                        <tr>
                            <td>
                                <strong> Please list the Professionals whose services are required for applying for this service </strong>
                            </td>
                            <td class="acilppr"><select name="acilppr[list_professional][]" class="form-control cri acilppr" multiple="multiple">
							<?php foreach($professionaldata as $que){ ?>
		                    <option value="<?php echo $que['id'];?>"><?php  echo $que['profession_name'];?></option>
		                    <?php }?>
							</select></td>
							<td class="ao"><select name="ao[list_professional][]" class="form-control cri ao" multiple="multiple">
							<?php foreach($professionaldata as $que){ ?>
		                    <option value="<?php echo $que['id'];?>"><?php echo $que['profession_name'];?></option>
		                    <?php }?></select></td>
                            <td class="ac"><select name="ac[list_professional][]" class="form-control cri ac" multiple="multiple">
							<?php foreach($professionaldata as $que){ ?>
		                    <option value="<?php echo $que['id'];?>"><?php echo $que['profession_name'];?></option>
		                    <?php }?></select></td>
                            <td class="as"><select name="as[list_professional][]" class="form-control cri as" multiple="multiple">
							<?php foreach($professionaldata as $que){ ?>
		                    <option value="<?php echo $que['id'];?>"><?php echo $que['profession_name'];?></option>
		                    <?php }?></select></td>
                            <td class="at"><select name="at[list_professional][]" class="form-control cri at" multiple="multiple">
							<?php foreach($professionaldata as $que){ ?>
		                    <option value="<?php echo $que['id'];?>"><?php echo $que['profession_name'];?></option>
		                    <?php }?></select></td>
                            <td class="duplicate"><select name="duplicate[list_professional][]" class="form-control cri duplicate" multiple="multiple">
							<?php foreach($professionaldata as $que){ ?>
		                    <option value="<?php echo $que['id'];?>"><?php echo $que['profession_name'];?></option>
		                    <?php }?></select></td>
                            <td class="renewal"><select name="renewal[list_professional][]" class="form-control cri renewal" multiple="multiple">
							<?php foreach($professionaldata as $que){ ?>
		                    <option value="<?php echo $que['id'];?>"><?php echo $que['profession_name'];?></option>
		                    <?php }?></select></td>
                            <td class="return"><select name="return[list_professional][]" class="form-control cri return" multiple="multiple">
							<?php foreach($professionaldata as $que){ ?>
		                    <option value="<?php echo $que['id'];?>"><?php echo $que['profession_name'];?></option>
		                    <?php }?></select></td>
                            <td class="maintainence"><select name="maintainence[list_professional][]" class="form-control cri maintainence" multiple="multiple">
							<?php foreach($professionaldata as $que){ ?>
		                    <option value="<?php echo $que['id'];?>"><?php echo $que['profession_name'];?></option>
		                    <?php }?></select></td>

                        </tr>
                                            <tr>
                            <td>
                                <strong> other </strong>
                            </td>
                            <td class="acilppr"> <input type="text" class="form-control cri acilppr" name="acilppr[other_professional]" placeholder="Others"></td>
							<td class="ao"> <input type="text" class="form-control cri aisct" name="ao[other_professional]" placeholder="Others"></td>
                            <td class="ac"> <input type="text" class="form-control cri aisct" name="ac[other_professional]" placeholder="Others"></td>
                            <td class="as"> <input type="text" class="form-control cri aisct" name="as[other_professional]" placeholder="Others"></td>
                            <td class="at"> <input type="text" class="form-control cri aisct" name="at[other_professional]" placeholder="Others"></td>
                            <td class="duplicate"><input type="text" class="form-control cri duplicate" name="duplicate[other_professional]" placeholder="Others"></td>
                            <td class="renewal"><input type="text" class="form-control cri renewal" name="renewal[other_professional]" placeholder="Others"></td>
                            <td class="return"><input type="text" class="form-control cri return" name="return[other_professional]" placeholder="Others"></td>
                            <td class="maintainence"><input type="text" class="form-control cri maintainence" name="maintainence[other_professional]" placeholder="Others"></td>


                        </tr>
                       

                        <tr>
                            <td>
                                <strong>Is the service delivery dependent on approvals from other departments / authorities ?</strong> 
                            </td>
                            <td class="acilppr"><select name="acilppr[delivery_dependent]" class="acilppr form-control cri">
							<option value="Y">Yes</option><option value="N">No</option></select></td>                
							<td class="ao"><select name="ao[delivery_dependent]" class="ao form-control cri">
							<option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="ac"><select name="ac[delivery_dependent]" class="ac form-control cri">
							<option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="as"><select name="as[delivery_dependent]" class="as form-control cri">
							<option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="at"><select name="at[delivery_dependent]" class="at form-control cri">
							<option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="duplicate"><select name="duplicate[delivery_dependent]" class="duplicate form-control cri">
							<option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="renewal"><select name="renewal[delivery_dependent]" class="renewal form-control cri">
							<option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="return"><select name="return[delivery_dependent]" class="return form-control cri">
							<option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="maintainence"><select name="maintainence[delivery_dependent]" class="maintainence form-control cri">
							<option value="Y">Yes</option><option value="N">No</option></select></td>
                        </tr>
						
						 <tr>
                            <td>
                                <strong>Please Select Relevant Central Govt. Department & Service</strong>
								<?php $centraldata=InfowizardQuestionMasterExt::getIssuermappingByIssuerId(1); ?>
                            </td>
                           <td class="acilppr"><select name="acilppr[central_department][]" class="form-control cri acilppr" multiple="multiple">
							<?php foreach($centraldata as $central){ ?>
		                    <option value="<?php echo $central['issmap_id'];?>"><?php echo $central['name'];?></option>
		                    <?php }?>
							</select></td>
							<td class="ao"><select name="ao[central_department][]" class="form-control cri ao" multiple="multiple">
							<?php foreach($centraldata as $central){ ?>
		                    <option value="<?php echo $central['issmap_id'];?>"><?php echo $central['name'];?></option>
		                    <?php }?></select></td>
                            <td class="ac"><select name="ac[central_department][]" class="form-control cri ac" multiple="multiple">
							<?php foreach($centraldata as $central){ ?>
		                    <option value="<?php echo $central['issmap_id'];?>"><?php echo $central['name'];?></option>
		                    <?php }?></select></td>
                            <td class="as"><select name="as[central_department][]" class="form-control cri as" multiple="multiple">
							<?php foreach($centraldata as $central){ ?>
		                    <option value="<?php echo $central['issmap_id'];?>"><?php echo $central['name'];?></option>
		                    <?php }?></select></td>
                            <td class="at"><select name="at[central_department][]" class="form-control cri at" multiple="multiple">
							<?php foreach($centraldata as $central){ ?>
		                    <option value="<?php echo $central['issmap_id'];?>"><?php echo $central['name'];?></option>
		                    <?php }?></select></td>
                            <td class="duplicate"><select name="duplicate[central_department][]" class="form-control cri duplicate" multiple="multiple">
							<?php foreach($centraldata as $central){ ?>
		                    <option value="<?php echo $central['issmap_id'];?>"><?php echo $central['name'];?></option>
		                    <?php }?></select></td>
                            <td class="renewal"><select name="renewal[central_department][]" class="form-control cri renewal" multiple="multiple">
							<?php foreach($centraldata as $central){ ?>
		                    <option value="<?php echo $central['issmap_id'];?>"><?php echo $central['name'];?></option>
		                    <?php }?></select></td>
                            <td class="return"><select name="return[central_department][]" class="form-control cri return" multiple="multiple">
							<?php foreach($centraldata as $central){ ?>
		                    <option value="<?php echo $central['issmap_id'];?>"><?php echo $central['name'];?></option>
		                    <?php }?></select></td>
                            <td class="maintainence"><select name="maintainence[central_department][]" class="form-control cri maintainence" multiple="multiple">
							<?php foreach($centraldata as $central){ ?>
		                    <option value="<?php echo $central['issmap_id'];?>"><?php echo $central['name'];?></option>
		                    <?php }?></select></td>
                        </tr>
						
						
						 <tr>
                            <td>
                                <strong>Please Select Relevant State Department & Service</strong>
								<?php $statedata=InfowizardQuestionMasterExt::getIssuermappingByIssuerId(2); ?>
                            </td>
 <td class="acilppr"><select name="acilppr[state_department][]" class="form-control cri acilppr" multiple="multiple">
							<?php foreach($statedata as $state){ ?>
		                    <option value="<?php echo $state['issmap_id'];?>"><?php echo $state['name'];?></option>
		                    <?php }?>
							</select></td>
							<td class="ao"><select name="ao[state_department][]" class="form-control cri ao" multiple="multiple">
							<?php foreach($statedata as $state){ ?>
		                    <option value="<?php echo $state['issmap_id'];?>"><?php echo $state['name'];?></option>
		                    <?php }?></select></td>
                            <td class="ac"><select name="ac[state_department][]" class="form-control cri ac" multiple="multiple">
							<?php foreach($statedata as $state){ ?>
		                    <option value="<?php echo $state['issmap_id'];?>"><?php echo $state['name'];?></option>
		                    <?php }?></select></td>
                            <td class="as"><select name="as[state_department][]" class="form-control cri as" multiple="multiple">
							<?php foreach($statedata as $state){ ?>
		                    <option value="<?php echo $state['issmap_id'];?>"><?php echo $state['name'];?></option>
		                    <?php }?></select></td>
                            <td class="at"><select name="at[state_department][]" class="form-control cri at" multiple="multiple">
							<?php foreach($statedata as $state){ ?>
		                    <option value="<?php echo $state['issmap_id'];?>"><?php echo $state['name'];?></option>
		                    <?php }?></select></td>
                            <td class="duplicate"><select name="duplicate[state_department][]" class="form-control cri duplicate" multiple="multiple">
							<?php foreach($statedata as $state){ ?>
		                    <option value="<?php echo $state['issmap_id'];?>"><?php echo $state['name'];?></option>
		                    <?php }?></select></td>
                            <td class="renewal"><select name="renewal[state_department][]" class="form-control cri renewal" multiple="multiple">
							<?php foreach($statedata as $state){ ?>
		                    <option value="<?php echo $state['issmap_id'];?>"><?php echo $state['name'];?></option>
		                    <?php }?></select></td>
                            <td class="return"><select name="return[state_department][]" class="form-control cri return" multiple="multiple">
							<?php foreach($statedata as $state){ ?>
		                    <option value="<?php echo $state['issmap_id'];?>"><?php echo $state['name'];?></option>
		                    <?php }?></select></td>
                            <td class="maintainence"><select name="maintainence[state_department][]" class="form-control cri maintainence" multiple="multiple">
							<?php foreach($statedata as $state){ ?>
		                    <option value="<?php echo $state['issmap_id'];?>"><?php echo $state['name'];?></option>
		                    <?php }?></select></td>
							                        </tr>

                      
                        
                        <tr>
                            <td>
                                <strong>Comments </strong>
                            </td>
                            <td class="acilppr"><textarea name="acilppr[comment]" class="form-control cri"></textarea></td>
							 <td class="ao"><textarea name="ao[comment]" class="form-control cri"></textarea></td>
                            <td class="ac"><textarea name="ac[comment]" class="form-control cri"></textarea></td>
                            <td class="as"><textarea name="as[comment]" class="form-control cri"></textarea></td>
                            <td class="at"><textarea name="at[comment]" class="form-control cri"></textarea></td>
                            <td class="duplicate"><textarea name="duplicate[comment]" class="form-control cri"></textarea></td>
                            <td class="renewal"><textarea name="renewal[comment]" class="form-control cri"></textarea></td>
                            <td class="return"><textarea name="return[comment]" class="form-control cri"></textarea></td>
                            <td class="maintainence"><textarea name="maintainence[comment]" class="form-control cri"></textarea></td>

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