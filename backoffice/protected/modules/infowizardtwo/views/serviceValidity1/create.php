  <?php $allsubservices=explode(",",$serviceData['additional_sub_service']); //print_r($allsubservices); ?>                 
<style>
    <?php /*?><?php if(!in_array("Amendment - Cancellation",$allsubservices)) { ?> .aisct{display: none;}  <?php } ?>
    <?php if(!in_array("Duplicate Copy",$allsubservices)) { ?> .duplicate{display: none;}  <?php } ?>
   
    <?php if(!in_array("Return",$allsubservices)) { ?> .return{display: none;}  <?php } ?>
    <?php if(!in_array("Maintenance of Register",$allsubservices)) { ?> .maintainence{display: none;}  <?php } ?><?php */?>
	
	 <?php if(!in_array("Renewal",$allsubservices)) { ?> .renewal{display: none;}  <?php } ?>
</style>
 <?php
$base=Yii::app()->theme->baseUrl;
?>
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
                                                    <div class="mt-step-title uppercase font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/serviceInspection/Adddetails/serviceID/'.$serviceData['id'].'')?>" >Inspection </a></div>
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
												 <div class="col-md-1 bg-grey mt-step-col ">
                                                    <div class="mt-step-number bg-white font-grey">6</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/ServiceStackholder/create/serviceID/'.$serviceData['id'].'')?>" >Stackholders</a></div>
                                                    <div class="mt-step-content font-grey-cascade">Form</div>
                                                </div>
                                                  
												 <div class="col-md-1 bg-grey done  mt-step-col active">
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
                                  <input type="hidden" name="service_type[]" value="<?php echo "Renewal"; ?>">           
  <?php /*?><?php foreach ($allsubservices as $subservices) { ?>
                                
                                 <input type="hidden" name="service_type[]" value="<?php echo $subservices; ?>">
                            
                                <?php } ?><?php */?>
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                        <tr>
                            <th>
                            </th>
                            <th class="acilppr ">
                                <strong> <?php echo $serviceData['service_type']; ?></strong>
                            </th>
                           
                            <th class="renewal"> 
                                <strong>   Renewal</strong>
                                   
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <td>
                                <strong>Can the Investor choose the Validtity of Service</strong>
                            </td>
                            <td class="acilppr"><select name="acilppr[validtity_of_service]" class="form-control cri acilppr">
							<option value="Y">Yes</option><option value="N">No</option></select></td>
                          
                            <td class="renewal"><select name="renewal[validtity_of_service]" class="form-control cri renewal">
							<option value="Y">Yes</option><option value="N">No</option></select></td>
                            

                        </tr>

                        <tr>
                            <td >
                            </td>
                            <td><div class="row" style="padding-left:20px;"><div id="acilpprAdd" countadd="0" style="float:left;"><select name="acilppr[day_month_year][]" >
							<option value="Days">Days</option>
							<option value="Months">Months</option>
							<option value="Years">Years</option></select> 
							<input  type="text" name="acilppr[day_month_year_no][]" placeholder="Select">&nbsp;&nbsp;&nbsp;&nbsp;</div>
							<button style="float:left;" class="add_button btn btn-success" type="button" rel="acilpprAdd">Add</button></div>
							<p class="acilpprAdd"></p>
			
							</td>
                              <td><div class="row" style="padding-left:20px;"><div id="renewalAdd" countadd="0" style="float:left;"><select name="renewal[day_month_year][]" >
							<option value="Days">Days</option>
							<option value="Months">Months</option>
							<option value="Years">Years</option></select> 
							<input  type="text" name="renewal[day_month_year_no][]" placeholder="Select">&nbsp;&nbsp;&nbsp;&nbsp;</div>
							<button style="float:left;" class="add_button btn btn-success" type="button" rel="renewalAdd">Add</button></div>
							<p class="renewalAdd"></p>
			
							</td>
                            
                        </tr>

						 <tr>
                            <td>
                                <strong>Application for Renewal to be done before___</strong>
                            </td>
                            <td class="acilppr"><input type="text" name="acilppr[before_days]" class="form-control cri" /></td>
                            
                            <td class="renewal"><input type="text" name="renewal[before_days]" class="form-control cri" /></td>
                            

                        </tr>
						
						 <tr>
                            <td>
                                <strong>days of expiry of Validity or Within ___ days of expiry of Validity</strong>
                            </td>
                            <td class="acilppr"><input type="text" name="acilppr[within_days]" class="form-control cri" /></td>
                            
                            <td class="renewal"><input type="text" name="renewal[within_days]" class="form-control cri" />
							</td>
                            

                        </tr>

                 
                        <tr>
                            <td>
                                <strong>Comments </strong>
                            </td>
                            <td class="acilppr"><textarea name="acilppr[comment]" class="form-control cri"></textarea></td>
                            
                            <td class="renewal"><textarea name="renewal[comment]" class="form-control cri"></textarea></td>
                            

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
	$(".add_button").click(function(){
	var gh=$(this).attr("rel");

		var kl=$("#"+gh).attr("countadd");
	if(kl==5){return false;}
	    var ty=	$("#"+gh).html();
	$("."+gh).append('<div class="row"  style="padding-left:20px;">'+ty+"<a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a><div>");

	$("#"+gh).attr("countadd",parseInt(kl)+1);
		$(".rmv").click(function(){
	$(this).parent('div').remove();
	});
	});

	
      });
   

</script>
