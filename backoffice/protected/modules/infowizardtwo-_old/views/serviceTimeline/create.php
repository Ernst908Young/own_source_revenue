  <?php $allsubservices=explode(",",$serviceData['additional_sub_service']); 
 
 // $gon->gov_act_dh="N";//print_r($_SESSION['ServiceTimeline']);?>                 
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
	.col-md-1{width:12.50% !important;}
        .uppercase { font-size: 16px !important;
 
}
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
												 <div class="col-md-1 bg-grey done mt-step-col active">
                                                    <div class="mt-step-number bg-white font-grey">5</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/ServiceTimeline/create/serviceID/'.$serviceData['id'].'')?>" >Timelines</a></div>
                                                    <div class="mt-step-content font-grey-cascade">Form</div>
                                                </div>
												 <div class="col-md-1 bg-grey  mt-step-col ">
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
                                <strong> Is there provision for Deemed Approval </strong>
                            </td>
                            <td class="acilppr">
			                <select name="acilppr[deemed_approval]" onchange='hide("acilppr[yes_deemed]","acilppr[deemed_approval]")' class="acilppr form-control cri">
 <option value="Y" <?php if(!empty($_SESSION['ServiceTimeline']['service']) && $_SESSION['ServiceTimeline']['service']['deemed_approval']=="y"){ echo "selected"; }?>>Yes</option><option value="N" <?php if(!empty($_SESSION['ServiceTimeline']['service']) && $_SESSION['ServiceTimeline']['service']['deemed_approval']=="N"){ echo "selected"; }?>>No</option>
 </select></td>                
							<td class="ao">
							<select name="ao[deemed_approval]" onchange='hide("ao[yes_deemed]","ao[deemed_approval]")' class="ao form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Others']) && $_SESSION['ServiceTimeline']['Amendment - Others']['deemed_approval']=="y"){ echo "selected"; }?>>Yes</option><option value="N" <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Others']) && $_SESSION['ServiceTimeline']['Amendment - Others']['deemed_approval']=="N"){ echo "selected"; }?>>No</option></select></td>                
                            <td class="ac">
							<select name="ac[deemed_approval]" onchange='hide("ac[yes_deemed]","ac[deemed_approval]")' class="ac form-control cri">
										<option value="Y" <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Cancellation']) && $_SESSION['ServiceTimeline']['Amendment - Cancellation']['deemed_approval']=="y"){ echo "selected"; }?>>Yes</option><option value="N" <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Cancellation']) && $_SESSION['ServiceTimeline']['Amendment - Cancellation']['deemed_approval']=="N"){ echo "selected"; }?>>No</option></select></td>                
                           
                            <td class="as">
							<select name="as[deemed_approval]" onchange='hide("as[yes_deemed]","as[deemed_approval]")' class="as form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Surrender']) && $_SESSION['ServiceTimeline']['Amendment - Surrender']['deemed_approval']=="y"){ echo "selected"; }?>>Yes</option><option value="N" <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Surrender']) && $_SESSION['ServiceTimeline']['Amendment - Surrender']['deemed_approval']=="N"){ echo "selected"; }?>>No</option></select></td>                
                            <td class="at">
							<select name="at[deemed_approval]" onchange='hide("at[yes_deemed]","at[deemed_approval]")' class="at form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Transfer']) && $_SESSION['ServiceTimeline']['Amendment - Transfer']['deemed_approval']=="y"){ echo "selected"; }?>>Yes</option><option value="N"<?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Transfer']) && $_SESSION['ServiceTimeline']['Amendment - Transfer']['deemed_approval']=="N"){ echo "selected"; }?>>No</option></select></td>                
                            <td class="duplicate">
							<select name="duplicate[deemed_approval]" onchange='hide("duplicate[yes_deemed]","duplicate[deemed_approval]")' class="duplicate form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceTimeline']['Duplicate Copy']) && $_SESSION['ServiceTimeline']['Duplicate Copy']['deemed_approval']=="y"){ echo "selected"; }?>>Yes</option><option value="N" <?php if(!empty($_SESSION['ServiceTimeline']['Duplicate Copy']) && $_SESSION['ServiceTimeline']['Duplicate Copy']['deemed_approval']=="N"){ echo "selected"; } ?>>No</option></select></td>                
                            <td class="renewal">
							<select name="renewal[deemed_approval]" onchange='hide("renewal[yes_deemed]","renewal[deemed_approval]")' class="renewal form-control cri">
						<option value="Y" <?php if(!empty($_SESSION['ServiceTimeline']['Renewal']) && $_SESSION['ServiceTimeline']['Renewal']['deemed_approval']=="y"){ echo "selected"; }?>>Yes</option><option value="N" <?php if(!empty($_SESSION['ServiceTimeline']['Renewal']) && $_SESSION['ServiceTimeline']['Renewal']['deemed_approval']=="N"){ echo "selected"; }?>>No</option></select></td>                
                            <td class="return">
							<select name="return[deemed_approval]" onchange='hide("return[yes_deemed]","return[deemed_approval]")' class="return form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceTimeline']['Return']) && $_SESSION['ServiceTimeline']['Return']['deemed_approval']=="y"){ echo "selected"; }?>>Yes</option><option value="N" <?php if(!empty($_SESSION['ServiceTimeline']['Return']) && $_SESSION['ServiceTimeline']['Return']['deemed_approval']=="N"){ echo "selected"; }?>>No</option></select></td>                
                            <td class="maintainence">
							<select name="maintainence[deemed_approval]" onchange='hide("maintainence[yes_deemed]","maintainence[deemed_approval]")' 
							class="maintainence form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceTimeline']['Maintenance of Register']) && $_SESSION['ServiceTimeline']['Maintenance of Register']['deemed_approval']=="y"){ echo "selected"; }?>>Yes</option><option value="N" <?php if(!empty($_SESSION['ServiceTimeline']['Maintenance of Register']) && $_SESSION['ServiceTimeline']['Maintenance of Register']['deemed_approval']=="N"){ echo "selected"; }?>>No</option></select></td>                
                        </tr>
						<tr >
                            <td>
                                <strong> </strong>
                            </td>
                            <td class="acilppr"> <input type="text" class="form-control cri acilppr" name="acilppr[yes_deemed]" placeholder="Others" value="<?php if(!empty($_SESSION['ServiceTimeline']['service']['yes_deemed'])){ echo $_SESSION['ServiceTimeline']['service']['yes_deemed']; }?>"></td>
							<td class="ao"> <input type="text" class="form-control cri ao" name="ao[yes_deemed]" placeholder="Others" value="
<?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Others']['yes_deemed'])){ echo $_SESSION['ServiceTimeline']['Amendment - Others']['yes_deemed']; }?>"></td>
                            <td class="ac"> <input type="text" class="form-control cri ac" name="ac[yes_deemed]" placeholder="Others" value="
<?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Cancellation']['yes_deemed'])){ echo $_SESSION['ServiceTimeline']['Amendment - Cancellation']['yes_deemed']; }?>"></td>
                            <td class="as"> <input type="text" class="form-control cri as" name="as[yes_deemed]" placeholder="Others" value="<?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Surrender']['yes_deemed'])){ echo $_SESSION['ServiceTimeline']['Amendment - Surrender']['yes_deemed']; }?>"></td>
                            <td class="at"> <input type="text" class="form-control cri at" name="at[yes_deemed]" placeholder="Others" value="<?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Transfer']['yes_deemed'])){ echo $_SESSION['ServiceTimeline']['Amendment - Transfer']['yes_deemed']; }?>"></td>
                            <td class="duplicate"><input type="text" class="form-control cri duplicate" name="duplicate[yes_deemed]" placeholder="Others" value="<?php if(!empty($_SESSION['ServiceTimeline']['Duplicate Copy']['yes_deemed'])){ echo $_SESSION['ServiceTimeline']['Duplicate Copy']['yes_deemed']; }?>"></td>
                            <td class="renewal"><input type="text" class="form-control cri renewal" name="renewal[yes_deemed]" placeholder="Others" value="<?php if(!empty($_SESSION['ServiceTimeline']['Renewal']['yes_deemed'])){ echo $_SESSION['ServiceTimeline']['Renewal']['yes_deemed']; }?>"></td>
                            <td class="return"><input type="text" class="form-control cri return" name="return[yes_deemed]" placeholder="Others" value="<?php if(!empty($_SESSION['ServiceTimeline']['Return']['yes_deemed'])){ echo $_SESSION['ServiceTimeline']['Return']['yes_deemed']; }?>"></td>
                            <td class="maintainence"><input type="text" class="form-control cri maintainence" name="maintainence[yes_deemed]" placeholder="Others" value="<?php if(!empty($_SESSION['ServiceTimeline']['Maintenance of Register']['yes_deemed'])){ echo $_SESSION['ServiceTimeline']['Maintenance of Register']['yes_deemed']; }?>"></td>


                        </tr>
						
						
						<tr>
                            <td>
                                <strong>Prevalent Timeline for the Service as per GO / Notification</strong>
                            </td>
                            <td class="acilppr"><div class="row" style="padding-left:20px;">
						
                                        <div id="acilpprAdd" countadd="0">
                                       <input  type="text" name="acilppr[go_notification_dh_no][]" size="6px" />
							<select name="acilppr[go_notification_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="acilppr[go_notification_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button btn btn-success" type="button" rel="acilpprAdd">Add</button>
                                                      </div>  
                                     <?php 
									 if(!empty($_SESSION['ServiceTimeline']['service']['go_notification'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['service']['go_notification']); } //echo $go=count($go_notification);?>
                           
                                <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;">   
 <input  type="text" name="acilppr[go_notification_dh_no][]"  size="6px" value="<?php if($gon->go_notification_dh_no){ echo $gon->go_notification_dh_no; } ?>"/>
                                                 <select name="acilppr[go_notification_dh][]" >
                                                        <option value="Days" <?php if($gon->go_notification_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->go_notification_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="acilppr[go_notification_condition][]" class="form-control"> <?php if(!empty($gon->go_notification_condition)){ echo $gon->go_notification_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
                            
							<p class="acilpprAdd"></p>
			                </td>
							<td class="ao"><div class="row" style="padding-left:20px;"><div id="aoAdd" countadd="0" style="float:left;">
							<input  type="text" name="ao[go_notification_dh_no][]"  size="6px" />
							<select name="ao[go_notification_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="ao[go_notification_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button btn btn-success" type="button" rel="aoAdd">Add</button></div>
							
                                                         
                           <?php //echo $_SESSION['ServiceTimeline']['service']['go_notification']; 
									 if(!empty($_SESSION['ServiceTimeline']['Amendment - Others']['go_notification'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Others']['go_notification']); } ?>
                           
                                <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;">   
                                                   <input type="text" name="ao[go_notification_dh_no][]"  size="6px" value="<?php if($gon->go_notification_dh_no){ echo $gon->go_notification_dh_no; } ?>"/>					
                                                 <select name="ao[go_notification_dh][]" >
                                                     <option value="Days" <?php if($gon->go_notification_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->go_notification_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="ao[go_notification_condition][]" class="form-control"> <?php if(!empty($gon->go_notification_condition)){ echo $gon->go_notification_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
                                                        <p class="aoAdd"></p>
			
							</td>
							<td class="ac" ><div class="row" style="padding-left:20px;"><div id="acAdd" countadd="0" style="float:left;">
							<input  type="text" name="ac[go_notification_dh_no][]"  size="6px" />
							<select name="ac[go_notification_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="ac[go_notification_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button btn btn-success" type="button" rel="acAdd">Add</button></div>
							
                           <?php //echo $_SESSION['ServiceTimeline']['service']['go_notification']; 
									 if(!empty($_SESSION['ServiceTimeline']['Amendment - Cancellation']['go_notification'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Cancellation']['go_notification']); } ?>
                           
                                <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;">  
                                                   <input  type="text" name="ac[go_notification_dh_no][]"  size="6px" value="<?php if($gon->go_notification_dh_no){ echo $gon->go_notification_dh_no; } ?>"/>					
                                                 
                                                 <select name="ac[go_notification_dh][]" >
                                                        <option value="Days" <?php if($gon->go_notification_dh_no=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->go_notification_dh_no=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="ac[go_notification_condition][]" class="form-control"> <?php if(!empty($gon->go_notification_condition)){ echo $gon->go_notification_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
                                      
                                                        
                                                        <p class="acAdd"></p>
			
							</td>
							<td class="as"><div class="row" style="padding-left:20px;"><div id="asAdd" countadd="0" style="float:left;">
							<input  type="text" name="as[go_notification_dh_no][]"  size="6px" />
							<select name="as[go_notification_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="as[go_notification_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button btn btn-success" type="button" rel="asAdd">Add</button></div>
                                                      
                            <?php //echo $_SESSION['ServiceTimeline']['service']['go_notification']; 
									 if(!empty($_SESSION['ServiceTimeline']['Amendment - Surrender']['go_notification'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Surrender']['go_notification']); } ?>
                           
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;">  
                                                   <input  type="text" name="as[go_notification_dh_no][]"  size="6px" value="<?php if($gon->go_notification_dh_no){ echo $gon->go_notification_dh_no; } ?>"/>
							
                                                 <select name="as[go_notification_dh][]" >
                                                        <option value="Days" <?php if($gon->go_notification_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->go_notification_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="aast[go_notification_condition][]" class="form-control"> <?php if(!empty($gon->go_notification_condition)){ echo $gon->go_notification_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="asAdd"></p>
			                </td>
							
							
							<td class="at">
							<div class="row" style="padding-left:20px;"><div id="atAdd" countadd="0" style="float:left;">
							<input  type="text" name="at[go_notification_dh_no][]"  size="6px" />
							<select name="at[go_notification_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="at[go_notification_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button btn btn-success" type="button" rel="atAdd">Add</button></div>
                                                        	
                            <?php //echo $_SESSION['ServiceTimeline']['service']['go_notification']; 
									 if(!empty($_SESSION['ServiceTimeline']['Amendment - Transfer']['go_notification'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Transfer']['go_notification']); } ?>
                           
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;">  
                                                   <input  type="text" name="at[go_notification_dh_no][]"  size="6px" value="<?php if($gon->go_notification_dh_no){ echo $gon->go_notification_dh_no; } ?>"/>
							
                                                 <select name="at[go_notification_dh][]" >
                                                        <option value="Days" <?php if($gon->go_notification_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->go_notification_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="at[go_notification_condition][]" class="form-control"> <?php if(!empty($gon->go_notification_condition)){ echo $gon->go_notification_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="atAdd"></p>
			                </td>
							
							
                              <td class="duplicate"><div class="row" style="padding-left:20px;"><div id="duplicateAdd" countadd="0" style="float:left;">
							  <input  type="text" name="duplicate[go_notification_dh_no][]"  size="6px" />
							<select name="duplicate[go_notification_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="duplicate[go_notification_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button btn btn-success" type="button" rel="duplicateAdd">Add</button></div>
							     	
																<?php //echo $_SESSION['ServiceTimeline']['service']['go_notification']; 
									 if(!empty($_SESSION['ServiceTimeline']['Duplicate Copy']['go_notification'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Duplicate Copy']['go_notification']); } ?>
                           
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;">  
                                                   <input  type="text" name="duplicate[go_notification_dh_no][]"  size="6px" value="<?php if($gon->go_notification_dh_no){ echo $gon->go_notification_dh_no; } ?>">
							
                                                 <select name="duplicate[go_notification_dh][]" >
                                                        <option value="Days" <?php if($gon->go_notification_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->go_notification_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="duplicate[go_notification_condition][]" class="form-control"> <?php if(!empty($gon->go_notification_condition)){ echo $gon->go_notification_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
                                                        
                                                        <p class="duplicateAdd"></p>
			                 </td>
							 
							 
							 <td class="renewal"><div class="row" style="padding-left:20px;"><div id="renewalAdd" countadd="0" style="float:left;">
							 <input  type="text" name="renewal[go_notification_dh_no][]"  size="6px" />
							<select name="renewal[go_notification_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="renewal[go_notification_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button btn btn-success" type="button" rel="renewalAdd">Add</button></div>
                                                        
														  <?php //echo $_SESSION['ServiceTimeline']['service']['go_notification']; 
									 if(!empty($_SESSION['ServiceTimeline']['Renewal']['go_notification'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Renewal']['go_notification']); } ?>
                           
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                   <input  type="text" name="renewal[go_notification_dh_no][]"  size="6px" value="<?php if($gon->go_notification_dh_no){ echo $gon->go_notification_dh_no; } ?>"/>
                                                 <select name="renewal[go_notification_dh][]" >
                                                        <option value="Days" <?php if($gon->go_notification_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->go_notification_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="renewal[go_notification_condition][]" class="form-control"> <?php if(!empty($gon->go_notification_condition)){ echo $gon->go_notification_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
                                                             
							<p class="renewalAdd"></p>
			                 </td>
							 
							  <td class="return"><div class="row" style="padding-left:20px;"><div id="returnAdd" countadd="0" style="float:left;">
							 <input  type="text" name="return[go_notification_dh_no][]"  size="6px" />
							<select name="return[go_notification_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="return[go_notification_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button btn btn-success" type="button" rel="returnAdd">Add</button></div>
                                                        
														<?php //echo $_SESSION['ServiceTimeline']['service']['go_notification']; 
									 if(!empty($_SESSION['ServiceTimeline']['Return']['go_notification'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Return']['go_notification']); } ?>
                           
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;">   
                                                   <input  type="text" name="return[go_notification_dh_no][]"  size="6px" value="<?php if($gon->go_notification_dh_no){ echo $gon->go_notification_dh_no; } ?>"/>							
                                                 <select name="return[go_notification_dh][]" >
                                                        <option value="Days" <?php if($gon->go_notification_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->go_notification_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="return[go_notification_condition][]" class="form-control"> <?php if(!empty($gon->go_notification_condition)){ echo $gon->go_notification_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="returnAdd"></p>
			                 </td>
							 
							 <td class="maintainence"><div class="row" style="padding-left:20px;"><div id="maintainenceAdd" countadd="0" style="float:left;">
							 <input  type="text" name="maintainence[go_notification_dh_no][]"  size="6px" />
							<select name="maintainence[go_notification_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="maintainence[go_notification_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button btn btn-success" type="button" rel="maintainenceAdd">Add</button></div>
                                                        
                                                        
														<?php  
									 if(!empty($_SESSION['ServiceTimeline']['Maintenance of Register']['go_notification'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Maintenance of Register']['go_notification']); } ?>
                           
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;">    
                  <input  type="text" name="maintainence[go_notification_dh_no][]"  size="6px" 
				  value="<?php if(!empty($gon->go_notification_dh_no)){  echo $gon->go_notification_dh_no; } ?>"  />
							
                                                 <select name="maintainence[go_notification_dh][]" >
                                                        <option value="Days" <?php if($gon->go_notification_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->go_notification_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="maintainence[go_notification_condition][]" class="form-control"> <?php if(!empty($gon->go_notification_condition)){ echo $gon->go_notification_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
                                                             
							<p class="maintainenceAdd"></p>
			                 </td>
                            
                        </tr>
		
					<!----------------------------------------------------GOV ACT Start-------------------------------------------------------------------------->				
						<tr>
                            <td>
                                <strong>Timeline for the Service In the Governing ACT</strong>
                            </td>
                             <td class="acilppr"><div class="row" style="padding-left:20px;"><div id="acilpprGovAdd" countgov_act="0">
							<input  type="text" name="acilppr[gov_act_dh_no][]" size="6px" />
							<select name="acilppr[gov_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="acilppr[gov_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act btn btn-success" type="button" gt="acilpprGovAdd">Add</button></div>
							<?php if(!empty($_SESSION['ServiceTimeline']['service']['gov_act'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['service']['gov_act']); } ?>
                                                              
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="acilppr[gov_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_dh_no)){ echo $gon->gov_act_dh_no; } ?>"/>
							
                                                 <select name="acilppr[gov_act_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->gov_act_dh) && $gon->gov_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->gov_act_dh) && $gon->gov_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="acilppr[gov_act_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_condition)){ echo $gon->gov_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="acilpprGovAdd"></p>
			                </td>
							
							
							<td class="ao"><div class="row" style="padding-left:20px;"><div id="aoGovAdd" countgov_act="0" style="float:left;">
							<input  type="text" name="ao[gov_act_dh_no][]"  size="6px" />
							<select name="ao[gov_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="ao[gov_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act btn btn-success" type="button" gt="aoGovAdd">Add</button></div>
                               <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Others']['gov_act'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Others']['gov_act']); } ?>                         
                                                          
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="ao[gov_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_dh_no)){ echo $gon->gov_act_dh_no; } ?>"/>
							
                                                 <select name="ao[gov_act_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->gov_act_dh) && $gon->gov_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->gov_act_dh) && $gon->gov_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="ao[gov_act_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_condition)){ echo $gon->gov_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="aoGovAdd"></p>
			
							</td>
							
							
							<td class="ac"><div class="row" style="padding-left:20px;"><div id="acGovAdd" countgov_act="0" style="float:left;">
							<input  type="text" name="ac[gov_act_dh_no][]"  size="6px" />
							<select name="ac[gov_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="ac[gov_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act btn btn-success" type="button" gt="acGovAdd">Add</button></div>
                                                        
                                     <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Cancellation']['gov_act'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Cancellation']['gov_act']); } ?>                                         
                                                           
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="ac[gov_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_dh_no)){ echo $gon->gov_act_dh_no; } ?>"/>
							
                                                 <select name="ac[gov_act_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->gov_act_dh) && $gon->gov_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->gov_act_dh) && $gon->gov_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="ac[gov_act_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_condition)){ echo $gon->gov_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="acGovAdd"></p>
			
							</td>
							
							
							<td class="as"><div class="row" style="padding-left:20px;"><div id="asGovAdd" countgov_act="0" style="float:left;">
							<input  type="text" name="as[gov_act_dh_no][]"  size="6px" />
							<select name="as[gov_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="as[gov_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act btn btn-success" type="button" gt="asGovAdd">Add</button></div>
                                                        
                                       <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Surrender']['gov_act'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Surrender']['gov_act']); } ?>
									                   
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="as[gov_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_dh_no)){ echo $gon->gov_act_dh_no; } ?>"/>
							
                                                 <select name="as[gov_act_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->gov_act_dh) && $gon->gov_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->gov_act_dh) && $gon->gov_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="as[gov_act_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_condition)){ echo $gon->gov_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="asGovAdd"></p>
			                </td>
							
							
							<td class="at"><div class="row" style="padding-left:20px;"><div id="atGovAdd" countgov_act="0" style="float:left;">
							<input  type="text" name="at[gov_act_dh_no][]"  size="6px" />
							<select name="at[gov_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="at[gov_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act btn btn-success" type="button" gt="atGovAdd">Add</button></div>
                                      <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Transfer']['gov_act'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Transfer']['gov_act']); } ?>                  
                                                        
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="at[gov_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_dh_no)){ echo $gon->gov_act_dh_no; } ?>"/>
							
                                                 <select name="at[gov_act_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->gov_act_dh) && $gon->gov_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->gov_act_dh) && $gon->gov_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="at[gov_act_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_condition)){ echo $gon->gov_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="atGovAdd"></p>
			                </td>
							
							
                              <td class="duplicate"><div class="row" style="padding-left:20px;"><div id="duplicateGovAdd" countgov_act="0" style="float:left;">
							  <input  type="text" name="duplicate[gov_act_dh_no][]"  size="6px" />
							<select name="duplicate[gov_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="duplicate[gov_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act btn btn-success" type="button" gt="duplicateGovAdd">Add</button></div>
							<?php if(!empty($_SESSION['ServiceTimeline']['Duplicate Copy']['gov_act'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Duplicate Copy']['gov_act']); } ?>
                                                         
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="duplicate[gov_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_dh_no)){ echo $gon->gov_act_dh_no; } ?>"/>
							
                                                 <select name="duplicate[gov_act_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->gov_act_dh) && $gon->gov_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->gov_act_dh) && $gon->gov_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="duplicate[gov_act_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_condition)){ echo $gon->gov_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="duplicateGovAdd"></p>
			                 </td>
							 
							
							 
							 <td class="renewal"><div class="row" style="padding-left:20px;"><div id="renewalGovAdd" countgov_act="0" style="float:left;">
							 <input  type="text" name="renewal[gov_act_dh_no][]"  size="6px" />
							<select name="renewal[gov_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="renewal[gov_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act btn btn-success" type="button" gt="renewalGovAdd">Add</button></div>
							<?php if(!empty($_SESSION['ServiceTimeline']['Renewal']['gov_act'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Renewal']['gov_act']); } ?>
                                                        
                                                        
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="renewal[gov_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_dh_no)){ echo $gon->gov_act_dh_no; } ?>"/>
							
                                                 <select name="renewal[gov_act_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->gov_act_dh) && $gon->gov_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->gov_act_dh) && $gon->gov_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="renewal[gov_act_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_condition)){ echo $gon->gov_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="renewalGovAdd"></p>
			                 </td>
							 
							 
							 
							  <td class="return"><div class="row" style="padding-left:20px;"><div id="returnGovAdd" countgov_act="0" style="float:left;">
							 <input  type="text" name="return[gov_act_dh_no][]"  size="6px" />
							<select name="return[gov_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="return[gov_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act btn btn-success" type="button" gt="returnGovAdd">Add</button></div>
							<?php if(!empty($_SESSION['ServiceTimeline']['Return']['gov_act'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Return']['gov_act']); } ?>
                                                          
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="return[gov_act_dh_no][]" size="6px"  
												  value="<?php if(!empty($gon->gov_act_dh_no)){ echo $gon->gov_act_dh_no; } ?>"/>
							
                                                 <select name="return[gov_act_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->gov_act_dh) && $gon->gov_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->gov_act_dh) && $gon->gov_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="return[gov_act_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_condition)){ echo $gon->gov_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="returnGovAdd"></p>
			                 </td>
							 
							 
							 <td class="maintainence"><div class="row" style="padding-left:20px;"><div id="maintainenceGovAdd" countgov_act="0" style="float:left;">
							 <input  type="text" name="maintainence[gov_act_dh_no][]"  size="6px" />
							<select name="maintainence[gov_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="maintainence[gov_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act btn btn-success" type="button" gt="maintainenceGovAdd">Add</button></div>
							<?php if(!empty($_SESSION['ServiceTimeline']['Maintenance of Register']['gov_act'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Maintenance of Register']['gov_act']); } ?>
                                                        
                                                         
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                          <input  type="text" name="maintainence[gov_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_dh_no)){ echo $gon->gov_act_dh_no; } ?>"/>
							
                                                 <select name="maintainence[gov_act_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->gov_act_dh) && $gon->gov_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->gov_act_dh) && $gon->gov_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="maintainence[gov_act_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_condition)){ echo $gon->gov_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="maintainenceGovAdd"></p>
			                 </td>
                            
                        </tr>
						
						<tr>
                            <td>
                                <strong>First Appellate in the Governing Act </strong>
                            </td>
                           
							
							<td class="acilppr"><textarea name="acilppr[gov_act_first_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['service']['gov_act_first_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['service']['gov_act_first_appellate']; }?>
                                </textarea>
                            </td>
							 <td class="ao"><textarea name="ao[gov_act_first_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Others']['gov_act_first_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Amendment - Others']['gov_act_first_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="ac"><textarea name="ac[gov_act_first_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Cancellation']['gov_act_first_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Amendment - Cancellation']['gov_act_first_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="as"><textarea name="as[gov_act_first_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Surrender']['gov_act_first_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Amendment - Surrender']['gov_act_first_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="at"><textarea name="at[gov_act_first_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Transfer']['gov_act_first_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Amendment - Transfer']['gov_act_first_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="duplicate"><textarea name="duplicate[gov_act_first_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Duplicate Copy']['gov_act_first_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Duplicate Copy']['gov_act_first_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="renewal"><textarea name="renewal[gov_act_first_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Renewal']['gov_act_first_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Renewal']['gov_act_first_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="return"><textarea name="return[gov_act_first_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Return']['gov_act_first_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Return']['gov_act_first_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="maintainence"><textarea name="maintainence[gov_act_first_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Maintenance of Register']['gov_act_first_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Maintenance of Register']['gov_act_first_appellate']; } ?>
                                </textarea>
                            </td>


                        </tr>
						
						<tr>
                            <td>
                                <strong>Timeline for Disposal of appeal by First Appellate</strong>
                            </td>
                               <td class="acilppr"><div class="row" style="padding-left:20px;"><div id="acilpprGovfirstAdd" countgov_actfirst="0">
							<input  type="text" name="acilppr[gov_act_first_dh_no][]" size="6px" />
							<select name="acilppr[gov_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="acilppr[gov_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act_first btn btn-success" type="button" gt="acilpprGovfirstAdd">Add</button></div>
                                                        
                                                      <?php if(!empty($_SESSION['ServiceTimeline']['service']['gov_act_first'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['service']['gov_act_first']); } ?>

  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="acilppr[gov_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_first_dh_no)){ echo $gon->gov_act_first_dh_no; } ?>"/>
							
                                                 <select name="acilppr[gov_act_first_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->gov_act_first_dh) && $gon->gov_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->gov_act_first_dh) && $gon->gov_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="acilppr[gov_act_first_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_first_condition)){ echo $gon->gov_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
					
							<p class="acilpprGovfirstAdd"></p>
			                </td>
							
							
							
							<td class="ao"><div class="row" style="padding-left:20px;"><div id="aoGovfirstAdd" countgov_actfirst="0" style="float:left;">
							<input  type="text" name="ao[gov_act_first_dh_no][]"  size="6px" />
							<select name="ao[gov_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="ao[gov_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act_first btn btn-success" type="button" gt="aoGovfirstAdd">Add</button></div>
                                                        
                           <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Others']['gov_act_first'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Others']['gov_act_first']); } ?>
				                                    
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="acilppr[gov_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_first_dh_no)){ echo $gon->gov_act_first_dh_no; } ?>"/>
							
                                                 <select name="acilppr[gov_act_first_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->gov_act_first_dh) && $gon->gov_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->gov_act_first_dh) && $gon->gov_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="acilppr[gov_act_first_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_first_condition)){ echo $gon->gov_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="aoGovfirstAdd"></p>
			
							</td>
							
							
							<td class="ac"><div class="row" style="padding-left:20px;"><div id="acGovfirstAdd" countgov_actfirst="0" style="float:left;">
							<input  type="text" name="ac[gov_act_first_dh_no][]"  size="6px" />
							<select name="ac[gov_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="ac[gov_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act_first btn btn-success" type="button" gt="acGovfirstAdd">Add</button></div>
							
                                    <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Cancellation']['gov_act_first'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Cancellation']['gov_act_first']); } ?>
				                                                  
                                                         
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="ac[gov_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_first_dh_no)){ echo $gon->gov_act_first_dh_no; } ?>"/>
							
                                                 <select name="ac[gov_act_first_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->gov_act_first_dh) && $gon->gov_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->gov_act_first_dh) && $gon->gov_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="ac[gov_act_first_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_first_condition)){ echo $gon->gov_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="acGovfirstAdd"></p>
			
							</td>
							
							
							<td class="as"><div class="row" style="padding-left:20px;"><div id="asGovfirstAdd" countgov_actfirst="0" style="float:left;">
							<input  type="text" name="as[gov_act_first_dh_no][]"  size="6px" />
							<select name="as[gov_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="as[gov_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act_first btn btn-success" type="button" gt="asGovfirstAdd">Add</button></div>
                                 <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Surrender']['gov_act_first'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Surrender']['gov_act_first']); } ?>
				                                                     
                                                         
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="as[gov_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_first_dh_no)){ echo $gon->gov_act_first_dh_no; } ?>"/>
							
                                                 <select name="as[gov_act_first_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->gov_act_first_dh) && $gon->gov_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->gov_act_first_dh) && $gon->gov_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="as[gov_act_first_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_first_condition)){ echo $gon->gov_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
                                                            
							<p class="asGovfirstAdd"></p>
			                </td>
							
						
							<td class="at"><div class="row" style="padding-left:20px;"><div id="atGovfirstAdd" countgov_actfirst="0" style="float:left;">
							<input  type="text" name="at[gov_act_first_dh_no][]"  size="6px" />
							<select name="at[gov_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="at[gov_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act_first btn btn-success" type="button" gt="atGovfirstAdd">Add</button></div>
                                                        
                                     <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Transfer']['gov_act_first'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Transfer']['gov_act_first']); } ?>
				                                                  
                                                        
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="as[gov_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_first_dh_no)){ echo $gon->gov_act_first_dh_no; } ?>"/>
							
                                                 <select name="at[gov_act_first_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->gov_act_first_dh) && $gon->gov_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->gov_act_first_dh) && $gon->gov_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="at[gov_act_first_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_first_condition)){ echo $gon->gov_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="atGovfirstAdd"></p>
			                </td>
							
							
                              <td class="duplicate"><div class="row" style="padding-left:20px;"><div id="duplicateGovfirstAdd" countgov_actfirst="0" style="float:left;">
							  <input  type="text" name="duplicate[gov_act_first_dh_no][]"  size="6px" />
							<select name="duplicate[gov_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="duplicate[gov_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act_first btn btn-success" type="button" gt="duplicateGovfirstAdd">Add</button></div>
                                               <?php if(!empty($_SESSION['ServiceTimeline']['Duplicate Copy']['gov_act_first'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Duplicate Copy']['gov_act_first']); } ?>
				                                       
                                                        
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="duplicate[gov_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_first_dh_no)){ echo $gon->gov_act_first_dh_no; } ?>"/>
							
                                                 <select name="duplicate[gov_act_first_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->gov_act_first_dh) && $gon->gov_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->gov_act_first_dh) && $gon->gov_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="duplicate[gov_act_first_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_first_condition)){ echo $gon->gov_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="duplicateGovfirstAdd"></p>
			                 </td>
							 
							
							 
							 <td class="renewal"><div class="row" style="padding-left:20px;"><div id="renewalGovfirstAdd" countgov_actfirst="0" style="float:left;">
							 <input  type="text" name="renewal[gov_act_first_dh_no][]"  size="6px" />
							<select name="renewal[gov_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="renewal[gov_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act_first btn btn-success" type="button" gt="renewalGovfirstAdd">Add</button></div>
							 <?php if(!empty($_SESSION['ServiceTimeline']['Renewal']['gov_act_first'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Renewal']['gov_act_first']); } ?>
				                             
                                                         
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="renewal[gov_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_first_dh_no)){ echo $gon->gov_act_first_dh_no; } ?>"/>
							
                                                 <select name="renewal[gov_act_first_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->gov_act_first_dh) && $gon->gov_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->gov_act_first_dh) && $gon->gov_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="renewal[gov_act_first_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_first_condition)){ echo $gon->gov_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="renewalGovfirstAdd"></p>
			                 </td>
							 
							 
                                          <td class="return"><div class="row" style="padding-left:20px;"><div id="returnGovfirstAdd" countgov_actfirst="0" style="float:left;">
							 <input  type="text" name="return[gov_act_first_dh_no][]"  size="6px" />
							<select name="return[gov_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="return[gov_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act_first btn btn-success" type="button" gt="returnGovfirstAdd">Add</button></div>
                                              <?php if(!empty($_SESSION['ServiceTimeline']['Return']['gov_act_first'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Return']['gov_act_first']); } ?>
				          
                                                        
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="return[gov_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_first_dh_no)){ echo $gon->gov_act_first_dh_no; } ?>"/>
							
                                                 <select name="return[gov_act_first_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->gov_act_first_dh) && $gon->gov_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->gov_act_first_dh) && $gon->gov_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="return[gov_act_first_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_first_condition)){ echo $gon->gov_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="returnGovfirstAdd"></p>
			                 </td>
							 
							 <td class="maintainence"><div class="row" style="padding-left:20px;"><div id="maintainenceGovfirstAdd" countgov_actfirst="0" style="float:left;">
							 <input  type="text" name="maintainence[gov_act_first_dh_no][]"  size="6px" />
							<select name="maintainence[gov_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="maintainence[gov_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act_first btn btn-success" type="button" gt="maintainenceGovfirstAdd">Add</button></div>
							
<?php if(!empty($_SESSION['ServiceTimeline']['Maintenance of Register']['gov_act_first'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Maintenance of Register']['gov_act_first']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="maintainence[gov_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_first_dh_no)){ echo $gon->gov_act_first_dh_no; } ?>"/>
							
                                                 <select name="maintainence[gov_act_first_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->gov_act_first_dh) && $gon->gov_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->gov_act_first_dh) && $gon->gov_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="maintainence[gov_act_first_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_first_condition)){ echo $gon->gov_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
                                                             
							<p class="maintainenceGovfirstAdd"></p>
			                 </td>
                            
                        </tr>
						
						<tr>
                            <td>
                                <strong>Second Appellate in the Governing Act </strong>
                            </td>
                            <td class="acilppr"><textarea name="acilppr[gov_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['service']['gov_act_second_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['service']['gov_act_second_appellate']; }?>
                                </textarea>
                            </td>
							 <td class="ao"><textarea name="ao[gov_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Others']['gov_act_second_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Amendment - Others']['gov_act_second_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="ac"><textarea name="ac[gov_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Cancellation']['gov_act_second_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Amendment - Cancellation']['gov_act_second_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="as"><textarea name="as[gov_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Surrender']['gov_act_second_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Amendment - Surrender']['gov_act_second_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="at"><textarea name="at[gov_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Transfer']['gov_act_second_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Amendment - Transfer']['gov_act_second_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="duplicate"><textarea name="duplicate[gov_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Duplicate Copy']['gov_act_second_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Duplicate Copy']['gov_act_second_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="renewal"><textarea name="renewal[gov_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Renewal']['gov_act_second_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Renewal']['gov_act_second_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="return"><textarea name="return[gov_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Return']['gov_act_second_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Return']['gov_act_second_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="maintainence"><textarea name="maintainence[gov_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Maintenance of Register']['gov_act_second_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Maintenance of Register']['gov_act_second_appellate']; } ?>
                                </textarea>
                            </td>

                        </tr>
						
						<tr>
                            <td>
                                <strong>Timeline for Disposal of appeal by Second Appellate</strong>
                            </td>
                            
                               <td class="acilppr"><div class="row" style="padding-left:20px;"><div id="acilpprGovsecondAdd" countgov_actsecond="0">
							<input  type="text" name="acilppr[gov_act_second_dh_no][]" size="6px" />
							<select name="acilppr[gov_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="acilppr[gov_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act_second btn btn-success" type="button" gt="acilpprGovsecondAdd">Add</button></div>
                                                        
                                          <?php 
									 if(!empty($_SESSION['ServiceTimeline']['service']['gov_act_second'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['service']['gov_act_second']); } ?>
									 
									                 
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="acilppr[gov_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_second_dh_no)){ echo $gon->gov_act_second_dh_no; } ?>"/>
							
                                                 <select name="acilppr[gov_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->gov_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->gov_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="acilppr[gov_act_second_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_second_condition)){ echo $gon->gov_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>

							<p class="acilpprGovsecondAdd"></p>
			                </td>
							<td class="ao"><div class="row" style="padding-left:20px;"><div id="aoGovsecondAdd" countgov_actsecond="0" style="float:left;">
							<input  type="text" name="ao[gov_act_second_dh_no][]"  size="6px" />
							<select name="ao[gov_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="ao[gov_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act_second btn btn-success" type="button" gt="aoGovsecondAdd">Add</button></div>
							<?php 
									 if(!empty($_SESSION['ServiceTimeline']['Amendment - Others']['gov_act_second'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Others']['gov_act_second']); } ?>
									 
                                                         
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="ao[gov_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_second_dh_no)){ echo $gon->gov_act_second_dh_no; } ?>"/>
							
                                                 <select name="ao[gov_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->gov_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->gov_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="ao[gov_act_second_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_second_condition)){ echo $gon->gov_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="aoGovsecondAdd"></p>
			
							</td>
							<td class="ac"><div class="row" style="padding-left:20px;"><div id="acGovsecondAdd" countgov_actsecond="0" style="float:left;">
							<input  type="text" name="ac[gov_act_second_dh_no][]"  size="6px" />
							<select name="ac[gov_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>

							<textarea  name="ac[gov_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act_second btn btn-success" type="button" gt="acGovsecondAdd">Add</button></div>
							<?php 
									 if(!empty($_SESSION['ServiceTimeline']['Amendment - Cancellation']['gov_act_second'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Cancellation']['gov_act_second']); } ?>
                                                         
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="ac[gov_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_second_dh_no)){ echo $gon->gov_act_second_dh_no; } ?>"/>
							
                                                 <select name="ac[gov_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->gov_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->gov_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="ac[gov_act_second_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_second_condition)){ echo $gon->gov_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="acGovsecondAdd"></p>
			
							</td>
							<td class="as"><div class="row" style="padding-left:20px;"><div id="asGovsecondAdd" countgov_actsecond="0" style="float:left;">
							<input  type="text" name="as[gov_act_second_dh_no][]"  size="6px" />
							<select name="as[gov_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="as[gov_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act_second btn btn-success" type="button" gt="asGovsecondAdd">Add</button></div>
							<?php 
									 if(!empty($_SESSION['ServiceTimeline']['Amendment - Surrender']['gov_act_second'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Surrender']['gov_act_second']); } ?>
                                                         
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="as[gov_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_second_dh_no)){ echo $gon->gov_act_second_dh_no; } ?>"/>
							
                                                 <select name="as[gov_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->gov_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->gov_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="as[gov_act_second_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_second_condition)){ echo $gon->gov_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="asGovsecondAdd"></p>
			                </td>
							
							
							<td class="at"><div class="row" style="padding-left:20px;"><div id="atGovsecondAdd" countgov_actsecond="0" style="float:left;">
							<input  type="text" name="at[gov_act_second_dh_no][]"  size="6px" />
							<select name="at[gov_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="at[gov_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act_second btn btn-success" type="button" gt="atGovsecondAdd">Add</button></div>
                               <?php 
									 if(!empty($_SESSION['ServiceTimeline']['Amendment - Transfer']['gov_act_second'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Transfer']['gov_act_second']); } ?>                         
                                                       
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="at[gov_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_second_dh_no)){ echo $gon->gov_act_second_dh_no; } ?>"/>
							
                                                 <select name="at[gov_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->gov_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->gov_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="at[gov_act_second_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_second_condition)){ echo $gon->gov_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
                                                            
							<p class="atGovsecondAdd"></p>
			                </td>
							
							
                              <td class="duplicate"><div class="row" style="padding-left:20px;"><div id="duplicateGovsecondAdd" countgov_actsecond="0" style="float:left;">
							  <input  type="text" name="duplicate[gov_act_second_dh_no][]"  size="6px" />
							<select name="duplicate[gov_act_second_dh][]">
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="duplicate[gov_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act_second btn btn-success" type="button" gt="duplicateGovsecondAdd">Add</button></div>
							<?php 
									 if(!empty($_SESSION['ServiceTimeline']['Duplicate Copy']['gov_act_second'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Duplicate Copy']['gov_act_second']); } ?>
									 
                                                        
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="duplicate[gov_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_second_dh_no)){ echo $gon->gov_act_second_dh_no; } ?>"/>
							
                                                 <select name="duplicate[gov_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->gov_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->gov_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="duplicate[gov_act_second_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_second_condition)){ echo $gon->gov_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="duplicateGovsecondAdd"></p>
			                 </td>
					
							 
							 <td class="renewal"><div class="row" style="padding-left:20px;"><div id="renewalGovsecondAdd" countgov_actsecond="0" style="float:left;">
							 <input  type="text" name="renewal[gov_act_second_dh_no][]"  size="6px" />
							<select name="renewal[gov_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="renewal[gov_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act_second btn btn-success" type="button" gt="renewalGovsecondAdd">Add</button></div>
							<?php 
									 if(!empty($_SESSION['ServiceTimeline']['Renewal']['gov_act_second'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Renewal']['gov_act_second']); } ?>
									 
                          
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="acilppr[gov_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_second_dh_no)){ echo $gon->gov_act_second_dh_no; } ?>"/>
							
                                                 <select name="renewal[gov_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->gov_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->gov_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="renewal[gov_act_second_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_second_condition)){ echo $gon->gov_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="renewalGovsecondAdd"></p>
			                 </td>
                                         		 
							 <td class="return"><div class="row" style="padding-left:20px;"><div id="returnGovsecondAdd" countgov_actsecond="0" style="float:left;">
							 <input  type="text" name="return[gov_act_second_dh_no][]"  size="6px" />
							<select name="return[gov_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="return[gov_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act_second btn btn-success" type="button" gt="returnGovsecondAdd">Add</button></div>
                                         <?php if(!empty($_SESSION['ServiceTimeline']['Return']['gov_act_second'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Return']['gov_act_second']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="return[gov_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_second_dh_no)){ echo $gon->gov_act_second_dh_no; } ?>"/>
							
                                                 <select name="return[gov_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->gov_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->gov_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="return[gov_act_second_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_second_condition)){ echo $gon->gov_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="returnGovsecondAdd"></p>
			                 </td>
							 
							 <td class="maintainence"><div class="row" style="padding-left:20px;"><div id="maintainenceGovsecondAdd" countgov_actsecond="0" style="float:left;">
							 <input  type="text" name="maintainence[gov_act_second_dh_no][]"  size="6px" />
							<select name="maintainence[gov_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="maintainence[gov_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_gov_act_second btn btn-success" type="button" gt="maintainenceGovsecondAdd">Add</button></div>
							<?php 
									 if(!empty($_SESSION['ServiceTimeline']['Maintenance of Register']['gov_act_second'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Maintenance of Register']['gov_act_second']); } ?>
									 
                                                        
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="maintainence[gov_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->gov_act_second_dh_no)){ echo $gon->gov_act_second_dh_no; } ?>"/>
							
                                                 <select name="maintainence[gov_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->gov_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->gov_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="maintainence[gov_act_second_condition][]" class="form-control"> <?php if(!empty($gon->gov_act_second_condition)){ echo $gon->gov_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="maintainenceGovsecondAdd"></p>
			                 </td>
                            
                            
                        </tr>
						
						<!---------------------------------------------------GOV ACT END-------------------------------------------------------------->
						
						
						<!----------------------------------------------------------UKACT-----Start----------------------------------------------------------------------->	
			
			<tr>
                            <td>
                                <strong>Timeline for the Service In the Uttarakhand Single Window Act </strong>
                            </td>
                             <td class="acilppr"><div class="row" style="padding-left:20px;"><div id="acilpprukswAdd" countuksw_act="0">
							<input  type="text" name="acilppr[uksw_act_dh_no][]" size="6px" />
							<select name="acilppr[uksw_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="acilppr[uksw_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act btn btn-success" type="button" gt="acilpprukswAdd">Add</button></div>
                            <?php if(!empty($_SESSION['ServiceTimeline']['service']['uksw_act'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['service']['uksw_act']); } ?>
	                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="acilppr[uksw_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_dh_no)){ echo $gon->uksw_act_dh_no; } ?>"/>
							
                                                 <select name="acilppr[uksw_act_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->uksw_act_dh) && $gon->uksw_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->uksw_act_dh) && $gon->uksw_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="acilppr[uksw_act_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_condition)){ echo $gon->uksw_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
                                 
							<p class="acilpprukswAdd"></p>
			                </td>
							<td class="ao"><div class="row" style="padding-left:20px;"><div id="aoukswAdd" countuksw_act="0" style="float:left;">
							<input  type="text" name="ao[uksw_act_dh_no][]"  size="6px" />
							<select name="ao[uksw_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="ao[uksw_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act btn btn-success" type="button" gt="aoukswAdd">Add</button></div>
                              <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Others']['uksw_act'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Others']['uksw_act']); } ?>
	                                                      
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="ao[uksw_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_dh_no)){ echo $gon->uksw_act_dh_no; } ?>"/>
							
                                                 <select name="ao[uksw_act_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->uksw_act_dh) && $gon->uksw_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->uksw_act_dh) && $gon->uksw_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="ao[uksw_act_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_condition)){ echo $gon->uksw_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
                                                            
							<p class="aoukswAdd"></p>
			
							</td>
							<td class="ac"><div class="row" style="padding-left:20px;"><div id="acukswAdd" countuksw_act="0" style="float:left;">
							<input  type="text" name="ac[uksw_act_dh_no][]"  size="6px" />
							<select name="ac[uksw_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="ac[uksw_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act btn btn-success" type="button" gt="acukswAdd">Add</button></div>
							<?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Cancellation']['uksw_act'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Cancellation']['uksw_act']); } ?>
	                            
                                                        
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="ac[uksw_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_dh_no)){ echo $gon->uksw_act_dh_no; } ?>"/>
							
                                                 <select name="ac[uksw_act_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->uksw_act_dh) && $gon->uksw_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->uksw_act_dh) && $gon->uksw_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="ac[uksw_act_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_condition)){ echo $gon->uksw_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="acukswAdd"></p>
			
							</td>
							<td class="as"><div class="row" style="padding-left:20px;"><div id="asukswAdd" countuksw_act="0" style="float:left;">
							<input  type="text" name="as[uksw_act_dh_no][]"  size="6px" />
							<select name="as[uksw_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="as[uksw_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act btn btn-success" type="button" gt="asukswAdd">Add</button></div>
							<?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Surrender']['uksw_act'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Surrender']['uksw_act']); } ?>
	                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="as[uksw_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_dh_no)){ echo $gon->uksw_act_dh_no; } ?>"/>
							
                                                 <select name="as[uksw_act_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->uksw_act_dh) && $gon->uksw_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->uksw_act_dh) && $gon->uksw_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="as[uksw_act_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_condition)){ echo $gon->uksw_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="asukswAdd"></p>
			                </td>
							
						
							<td class="at"><div class="row" style="padding-left:20px;"><div id="atukswAdd" countuksw_act="0" style="float:left;">
							<input  type="text" name="at[uksw_act_dh_no][]"  size="6px" />
							<select name="at[uksw_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="at[uksw_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act btn btn-success" type="button" gt="atukswAdd">Add</button></div>
							<?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Transfer']['uksw_act'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Transfer']['uksw_act']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="at[uksw_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_dh_no)){ echo $gon->uksw_act_dh_no; } ?>"/>
							
                                                 <select name="at[uksw_act_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->uksw_act_dh) && $gon->uksw_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->uksw_act_dh) && $gon->uksw_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="at[uksw_act_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_condition)){ echo $gon->uksw_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="atukswAdd"></p>
			                </td>
							
							
                              <td class="duplicate"><div class="row" style="padding-left:20px;"><div id="duplicateukswAdd" countuksw_act="0" style="float:left;">
							  <input  type="text" name="duplicate[uksw_act_dh_no][]"  size="6px" />
							<select name="duplicate[uksw_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="duplicate[uksw_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act btn btn-success" type="button" gt="duplicateukswAdd">Add</button></div>
							<?php if(!empty($_SESSION['ServiceTimeline']['Duplicate Copy']['uksw_act'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Duplicate Copy']['uksw_act']); } ?>
	                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="duplicate[uksw_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_dh_no)){ echo $gon->uksw_act_dh_no; } ?>"/>
							
                                                 <select name="duplicate[uksw_act_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->uksw_act_dh) && $gon->uksw_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->uksw_act_dh) && $gon->uksw_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="duplicate[uksw_act_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_condition)){ echo $gon->uksw_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="duplicateukswAdd"></p>
			                 </td>
							 
							 
							 
							 <td class="renewal"><div class="row" style="padding-left:20px;"><div id="renewalukswAdd" countuksw_act="0" style="float:left;">
							 <input  type="text" name="renewal[uksw_act_dh_no][]"  size="6px" />
							<select name="renewal[uksw_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="renewal[uksw_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act btn btn-success" type="button" gt="renewalukswAdd">Add</button></div>
							<?php if(!empty($_SESSION['ServiceTimeline']['Renewal']['uksw_act'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Renewal']['uksw_act']); }  ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="renewal[uksw_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_dh_no)){ echo $gon->uksw_act_dh_no; } ?>"/>
							
                                                 <select name="renewal[uksw_act_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->uksw_act_dh) && $gon->uksw_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->uksw_act_dh) && $gon->uksw_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="renewal[uksw_act_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_condition)){ echo $gon->uksw_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="renewalukswAdd"></p>
			                 </td>
                                         <td class="return"><div class="row" style="padding-left:20px;"><div id="returnukswAdd" countuksw_act="0" style="float:left;">
							 <input  type="text" name="return[uksw_act_dh_no][]"  size="6px" />
							<select name="return[uksw_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="return[uksw_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act btn btn-success" type="button" gt="returnukswAdd">Add</button></div>
                                                        <?php if(!empty($_SESSION['ServiceTimeline']['Return']['uksw_act'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Return']['uksw_act']); } ?>
	                            
                                                       
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="return[uksw_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_dh_no)){ echo $gon->uksw_act_dh_no; } ?>"/>
							
                                                 <select name="return[uksw_act_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->uksw_act_dh) && $gon->uksw_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->uksw_act_dh) && $gon->uksw_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="return[uksw_act_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_condition)){ echo $gon->uksw_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="returnukswAdd"></p>
			                 </td>
							 
							 <td class="maintainence"><div class="row" style="padding-left:20px;"><div id="maintainenceukswAdd" countuksw_act="0" style="float:left;">
							 <input  type="text" name="maintainence[uksw_act_dh_no][]"  size="6px" />
							<select name="maintainence[uksw_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="maintainence[uksw_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act btn btn-success" type="button" gt="maintainenceukswAdd">Add</button></div>
							<?php if(!empty($_SESSION['ServiceTimeline']['Maintenance of Register']['uksw_act'])){
                                     $go_notification= json_decode($_SESSION['ServiceTimeline']['Maintenance of Register']['uksw_act']); } ?>
	                            
                                                        
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="maintainence[uksw_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_dh_no)){ echo $gon->uksw_act_dh_no; } ?>"/>
							
                                                 <select name="maintainence[uksw_act_dh][]" >
                                                        <option value="Days" <?php if(!empty($gon->uksw_act_dh) && $gon->uksw_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if(!empty($gon->uksw_act_dh) && $gon->uksw_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="maintainence[uksw_act_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_condition)){ echo $gon->uksw_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="maintainenceukswAdd"></p>
			                 </td>
                            
                        </tr>
						
						
						<tr>
                            <td>
                                <strong>First Appellate in the UkSW Act </strong>
                            </td>
							
                            <td class="acilppr"><textarea name="acilppr[uksw_act_first_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['service']['uksw_act_first_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['service']['uksw_act_first_appellate']; } ?>
                                </textarea>
                            </td>
							 <td class="ao"><textarea name="ao[uksw_act_first_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Others']['uksw_act_first_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Amendment - Others']['uksw_act_first_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="ac"><textarea name="ac[uksw_act_first_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Cancellation']['uksw_act_first_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Amendment - Cancellation']['uksw_act_first_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="as"><textarea name="as[uksw_act_first_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Surrender']['uksw_act_first_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Amendment - Surrender']['uksw_act_first_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="at"><textarea name="at[uksw_act_first_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Transfer']['uksw_act_first_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Amendment - Transfer']['uksw_act_first_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="duplicate"><textarea name="duplicate[uksw_act_first_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Duplicate Copy']['uksw_act_first_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Duplicate Copy']['uksw_act_first_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="renewal"><textarea name="renewal[uksw_act_first_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Renewal']['uksw_act_first_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Renewal']['uksw_act_first_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="return"><textarea name="return[uksw_act_first_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Return']['uksw_act_first_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Return']['uksw_act_first_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="maintainence"><textarea name="maintainence[uksw_act_first_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Maintenance of Register']['uksw_act_first_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Maintenance of Register']['uksw_act_first_appellate']; } ?>
                                </textarea>
                            </td>

                        </tr>
						<tr>
                            <td>
                                <strong>Timeline for Disposal of appeal by First Appellate (UkSW)</strong>
                            </td>
                               <td class="acilppr"><div class="row" style="padding-left:20px;"><div id="acilpprukswfirstAdd" countuksw_actfirst="0">
							<input  type="text" name="acilppr[uksw_act_first_dh_no][]" size="6px" />
							<select name="acilppr[uksw_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="acilppr[uksw_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act_first btn btn-success" type="button" gt="acilpprukswfirstAdd">Add</button></div>
                                                         <?php if(!empty($_SESSION['ServiceTimeline']['service']['uksw_act_first'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['service']['uksw_act_first']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="acilppr[uksw_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_first_dh_no)){ echo $gon->uksw_act_first_dh_no; } ?>"/>
							
                                                 <select name="acilppr[uksw_act_first_dh][]" >
                                                        <option value="Days" <?php if($gon->uksw_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->uksw_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="acilppr[uksw_act_first_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_first_condition)){ echo $gon->uksw_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
	
							<p class="acilpprukswfirstAdd"></p>
			                </td>
							<td class="ao"><div class="row" style="padding-left:20px;"><div id="aoukswfirstAdd" countuksw_actfirst="0" style="float:left;">
							<input  type="text" name="ao[uksw_act_first_dh_no][]"  size="6px" />
							<select name="ao[uksw_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="ao[uksw_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act_first btn btn-success" type="button" gt="aoukswfirstAdd">Add</button></div>
                                                          <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Others']['uksw_act_first'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Others']['uksw_act_first']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="ao[uksw_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_first_dh_no)){ echo $gon->uksw_act_first_dh_no; } ?>"/>
							
                                                 <select name="ao[uksw_act_first_dh][]" >
                                                        <option value="Days" <?php if($gon->uksw_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->uksw_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="ao[uksw_act_first_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_first_condition)){ echo $gon->uksw_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="aoukswfirstAdd"></p>
			
							</td>
							<td class="ac"><div class="row" style="padding-left:20px;"><div id="acukswfirstAdd" countuksw_actfirst="0" style="float:left;">
							<input  type="text" name="ac[uksw_act_first_dh_no][]"  size="6px" />
							<select name="ac[uksw_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="ac[uksw_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act_first btn btn-success" type="button" gt="acukswfirstAdd">Add</button></div>
                                                          <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Cancellation']['uksw_act_first'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Cancellation']['uksw_act_first']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="ac[uksw_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_first_dh_no)){ echo $gon->uksw_act_first_dh_no; } ?>"/>
							
                                                 <select name="ac[uksw_act_first_dh][]" >
                                                        <option value="Days" <?php if($gon->uksw_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->uksw_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="ac[uksw_act_first_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_first_condition)){ echo $gon->uksw_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="acukswfirstAdd"></p>
			
							</td>
							<td class="as"><div class="row" style="padding-left:20px;"><div id="asukswfirstAdd" countuksw_actfirst="0" style="float:left;">
							<input  type="text" name="as[uksw_act_first_dh_no][]"  size="6px" />
							<select name="as[uksw_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="as[uksw_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act_first btn btn-success" type="button" gt="asukswfirstAdd">Add</button></div>
                                                         <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Surrender']['uksw_act_first'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Surrender']['uksw_act_first']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="as[uksw_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_first_dh_no)){ echo $gon->uksw_act_first_dh_no; } ?>"/>
							
                                                 <select name="as[uksw_act_first_dh][]" >
                                                        <option value="Days" <?php if($gon->uksw_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->uksw_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="as[uksw_act_first_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_first_condition)){ echo $gon->uksw_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
                                                        
							<p class="asukswfirstAdd"></p>
			                </td>
							
							
							<td class="at"><div class="row" style="padding-left:20px;"><div id="atukswfirstAdd" countuksw_actfirst="0" style="float:left;">
							<input  type="text" name="at[uksw_act_first_dh_no][]"  size="6px" />
							<select name="at[uksw_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="at[uksw_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act_first btn btn-success" type="button" gt="atukswfirstAdd">Add</button></div>
                                                         <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Transfer']['uksw_act_first'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Transfer']['uksw_act_first']); }?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="at[uksw_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_first_dh_no)){ echo $gon->uksw_act_first_dh_no; } ?>"/>
							
                                                 <select name="at[uksw_act_first_dh][]" >
                                                        <option value="Days" <?php if($gon->uksw_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->uksw_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="at[uksw_act_first_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_first_condition)){ echo $gon->uksw_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="atukswfirstAdd"></p>
			                </td>
							
							
                              <td class="duplicate"><div class="row" style="padding-left:20px;"><div id="duplicateukswfirstAdd" countuksw_actfirst="0" style="float:left;">
							  <input  type="text" name="duplicate[uksw_act_first_dh_no][]"  size="6px" />
							<select name="duplicate[uksw_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="duplicate[uksw_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act_first btn btn-success" type="button" gt="duplicateukswfirstAdd">Add</button></div>
                                                        <?php if(!empty($_SESSION['ServiceTimeline']['Duplicate Copy']['uksw_act_first'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Duplicate Copy']['uksw_act_first']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="duplicate[uksw_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_first_dh_no)){ echo $gon->uksw_act_first_dh_no; } ?>"/>
							
                                                 <select name="duplicate[uksw_act_first_dh][]" >
                                                        <option value="Days" <?php if($gon->uksw_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->uksw_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="duplicate[uksw_act_first_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_first_condition)){ echo $gon->uksw_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="duplicateukswfirstAdd"></p>
			                 </td>
							 
							
							 
							 <td class="renewal"><div class="row" style="padding-left:20px;"><div id="renewalukswfirstAdd" countuksw_actfirst="0" style="float:left;">
							 <input  type="text" name="renewal[uksw_act_first_dh_no][]"  size="6px" />
							<select name="renewal[uksw_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="renewal[uksw_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act_first btn btn-success" type="button" gt="renewalukswfirstAdd">Add</button></div>
                                                        <?php if(!empty($_SESSION['ServiceTimeline']['Renewal']['uksw_act_first'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Renewal']['uksw_act_first']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="renewal[uksw_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_first_dh_no)){ echo $gon->uksw_act_first_dh_no; } ?>"/>
							
                                                 <select name="renewal[uksw_act_first_dh][]" >
                                                        <option value="Days" <?php if($gon->uksw_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->uksw_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="renewal[uksw_act_first_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_first_condition)){ echo $gon->uksw_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="renewalukswfirstAdd"></p>
			                 </td>
                                          <td class="return"><div class="row" style="padding-left:20px;"><div id="returnukswfirstAdd" countuksw_actfirst="0" style="float:left;">
							 <input  type="text" name="return[uksw_act_first_dh_no][]"  size="6px" />
							<select name="return[uksw_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="return[uksw_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act_first btn btn-success" type="button" gt="returnukswfirstAdd">Add</button></div>
                                                        <?php if(!empty($_SESSION['ServiceTimeline']['Return']['uksw_act_first'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Return']['uksw_act_first']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="return[uksw_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_first_dh_no)){ echo $gon->uksw_act_first_dh_no; } ?>"/>
							
                                                 <select name="return[uksw_act_first_dh][]" >
                                                        <option value="Days" <?php if($gon->uksw_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->uksw_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="return[uksw_act_first_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_first_condition)){ echo $gon->uksw_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="returnukswfirstAdd"></p>
			                 </td>
							 
							 <td class="maintainence"><div class="row" style="padding-left:20px;"><div id="maintainenceukswfirstAdd" countuksw_actfirst="0" style="float:left;">
							 <input  type="text" name="maintainence[uksw_act_first_dh_no][]"  size="6px" />
							<select name="maintainence[uksw_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="maintainence[uksw_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act_first btn btn-success" type="button" gt="maintainenceukswfirstAdd">Add</button></div>
                                                        <?php if(!empty($_SESSION['ServiceTimeline']['Maintenance of Register']['uksw_act_first'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Maintenance of Register']['uksw_act_first']); }?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="maintainence[uksw_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_first_dh_no)){ echo $gon->uksw_act_first_dh_no; } ?>"/>
							
                                                 <select name="maintainence[uksw_act_first_dh][]" >
                                                        <option value="Days" <?php if($gon->uksw_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->uksw_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="maintainence[uksw_act_first_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_first_condition)){ echo $gon->uksw_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="maintainenceukswfirstAdd"></p>
			                 </td>
                            
                        </tr>
						
						<tr>
                            <td>
                                <strong>Second Appellate in the UkSW Act </strong>
                            </td>
							
							 <td class="acilppr"><textarea name="acilppr[gov_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['service']['uksw_act_second_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['service']['uksw_act_second_appellate']; }?>
                                </textarea>
                            </td>
							 <td class="ao"><textarea name="ao[uksw_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Others']['uksw_act_second_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Amendment - Others']['uksw_act_second_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="ac"><textarea name="ac[uksw_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Cancellation']['uksw_act_second_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Amendment - Cancellation']['uksw_act_second_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="as"><textarea name="as[uksw_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Surrender']['uksw_act_second_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Amendment - Surrender']['uksw_act_second_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="at"><textarea name="at[uksw_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Transfer']['uksw_act_second_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Amendment - Transfer']['uksw_act_second_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="duplicate"><textarea name="duplicate[uksw_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Duplicate Copy']['uksw_act_second_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Duplicate Copy']['uksw_act_second_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="renewal"><textarea name="renewal[uksw_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Renewal']['uksw_act_second_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Renewal']['uksw_act_second_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="return"><textarea name="return[uksw_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Return']['uksw_act_second_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Return']['uksw_act_second_appellate']; } ?>
                                </textarea>
                            </td>
                            <td class="maintainence"><textarea name="maintainence[uksw_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Maintenance of Register']['uksw_act_second_appellate'])){
                                    echo $_SESSION['ServiceTimeline']['Maintenance of Register']['uksw_act_second_appellate']; } ?>
                                </textarea>
                            </td>



                            
                        </tr>
						
						<tr>
                            <td>
                                <strong>Timeline for Disposal of appeal by Second Appellate (UkSW)</strong>
                            </td>
                            
                               <td class="acilppr"><div class="row" style="padding-left:20px;"><div id="acilpprukswsecondAdd" countuksw_actsecond="0">
							<input  type="text" name="acilppr[uksw_act_second_dh_no][]" size="6px" />
							<select name="acilppr[uksw_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="acilppr[uksw_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act_second btn btn-success" type="button" gt="acilpprukswsecondAdd">Add</button></div>
                                                        
                                                         <?php if(!empty($_SESSION['ServiceTimeline']['service']['uksw_act_second'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['service']['uksw_act_second']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="acilppr[uksw_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_second_dh_no)){ echo $gon->uksw_act_second_dh_no; } ?>"/>
							
                                                 <select name="acilppr[uksw_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->uksw_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->uksw_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="acilppr[uksw_act_second_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_second_condition)){ echo $gon->uksw_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="acilpprukswsecondAdd"></p>
			                </td>
							
							<td class="ao"><div class="row" style="padding-left:20px;"><div id="aoukswsecondAdd" countuksw_actsecond="0" style="float:left;">
							<input  type="text" name="ao[uksw_act_second_dh_no][]"  size="6px" />
							<select name="ao[uksw_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="ao[uksw_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act_second btn btn-success" type="button" gt="aoukswsecondAdd">Add</button></div>
                                                        
                                                                           <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Others']['uksw_act_second'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Others']['uksw_act_second']); }?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="ao[uksw_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_second_dh_no)){ echo $gon->uksw_act_second_dh_no; } ?>"/>
							
                                                 <select name="ao[uksw_act_second_dh][]" >
                              <option value="Days" <?php if($gon->uksw_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->uksw_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> 
							</select>
							<textarea  name="ao[uksw_act_second_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_second_condition)){ echo $gon->uksw_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="aoukswsecondAdd"></p>
			
							</td>
							
							<td class="ac"><div class="row" style="padding-left:20px;"><div id="acukswsecondAdd" countuksw_actsecond="0" style="float:left;">
							<input  type="text" name="ac[uksw_act_second_dh_no][]"  size="6px" />
							<select name="ac[uksw_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="ac[uksw_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act_second btn btn-success" type="button" gt="acukswsecondAdd">Add</button></div>
                                                        
                                                                           <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Cancellation']['uksw_act_second'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Cancellation']['uksw_act_second']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="ac[uksw_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_second_dh_no)){ echo $gon->uksw_act_second_dh_no; } ?>"/>
							
                                                 <select name="ac[uksw_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->uksw_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->uksw_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="ac[uksw_act_second_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_second_condition)){ echo $gon->uksw_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="acukswsecondAdd"></p>
			
							</td>
							
							<td class="as"><div class="row" style="padding-left:20px;"><div id="asukswsecondAdd" countuksw_actsecond="0" style="float:left;">
							<input  type="text" name="as[uksw_act_second_dh_no][]"  size="6px" />
							<select name="as[uksw_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="as[uksw_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act_second btn btn-success" type="button" gt="asukswsecondAdd">Add</button></div>
                                                        
                                                        <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Surrender']['uksw_act_second'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Surrender']['uksw_act_second']); }?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="as[uksw_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_second_dh_no)){ echo $gon->uksw_act_second_dh_no; } ?>"/>
							
                                                 <select name="as[uksw_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->uksw_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->uksw_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="as[uksw_act_second_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_second_condition)){ echo $gon->uksw_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="asukswsecondAdd"></p>
			                </td>
							
							
							<td class="at"><div class="row" style="padding-left:20px;"><div id="atukswsecondAdd" countuksw_actsecond="0" style="float:left;">
							<input  type="text" name="at[uksw_act_second_dh_no][]"  size="6px" />
							<select name="at[uksw_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="at[uksw_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act_second btn btn-success" type="button" gt="atukswsecondAdd">Add</button></div>
                                                        
                                                                           <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Transfer']['uksw_act_second'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Transfer']['uksw_act_second']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="at[uksw_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_second_dh_no)){ echo $gon->uksw_act_second_dh_no; } ?>"/>
							
                                                 <select name="at[uksw_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->uksw_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->uksw_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="at[uksw_act_second_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_second_condition)){ echo $gon->uksw_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="atukswsecondAdd"></p>
			                </td>
							
							
                              <td class="duplicate"><div class="row" style="padding-left:20px;"><div id="duplicateukswsecondAdd" countuksw_actsecond="0" style="float:left;">
							  <input  type="text" name="duplicate[uksw_act_second_dh_no][]"  size="6px" />
							<select name="duplicate[uksw_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="duplicate[uksw_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act_second btn btn-success" type="button" gt="duplicateukswsecondAdd">Add</button></div>
                                                                           <?php if(!empty($_SESSION['ServiceTimeline']['Duplicate Copy']['uksw_act_second'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Duplicate Copy']['uksw_act_second']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="duplicate[uksw_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_second_dh_no)){ echo $gon->uksw_act_second_dh_no; } ?>"/>
							
                                                 <select name="duplicate[uksw_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->uksw_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->uksw_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="duplicate[uksw_act_second_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_second_condition)){ echo $gon->uksw_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="duplicateukswsecondAdd"></p>
			                 </td>
							 
							
							 
							 <td class="renewal"><div class="row" style="padding-left:20px;"><div id="renewalukswsecondAdd" countuksw_actsecond="0" style="float:left;">
							 <input  type="text" name="renewal[uksw_act_second_dh_no][]"  size="6px" />
							<select name="renewal[uksw_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="renewal[uksw_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act_second btn btn-success" type="button" gt="renewalukswsecondAdd">Add</button></div>
                             <?php if(!empty($_SESSION['ServiceTimeline']['Renewal']['uksw_act_second'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Renewal']['uksw_act_second']); } ?>                            
                                                                           
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="renewal[uksw_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_second_dh_no)){ echo $gon->uksw_act_second_dh_no; } ?>"/>
							
                                                 <select name="renewal[uksw_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->uksw_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->uksw_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="renewal[uksw_act_second_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_second_condition)){ echo $gon->uksw_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="renewalukswsecondAdd"></p>
			                 </td>
                                          <td class="return"><div class="row" style="padding-left:20px;"><div id="returnukswsecondAdd" countuksw_actsecond="0" style="float:left;">
							 <input  type="text" name="return[uksw_act_second_dh_no][]"  size="6px" />
							<select name="return[uksw_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="return[uksw_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act_second btn btn-success" type="button" gt="returnukswsecondAdd">Add</button></div>
                    <?php if(!empty($_SESSION['ServiceTimeline']['Renewal']['uksw_act_second'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Renewal']['uksw_act_second']); } ?>                                    
                                                                          
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="return[uksw_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_second_dh_no)){ echo $gon->uksw_act_second_dh_no; } ?>"/>
							
                                                 <select name="return[uksw_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->uksw_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->uksw_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="return[uksw_act_second_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_second_condition)){ echo $gon->uksw_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
                                                             
							<p class="returnukswsecondAdd"></p>
			                 </td>
							 
							 <td class="maintainence"><div class="row" style="padding-left:20px;"><div id="maintainenceukswsecondAdd" countuksw_actsecond="0" style="float:left;">
							 <input  type="text" name="maintainence[uksw_act_second_dh_no][]"  size="6px" />
							<select name="maintainence[uksw_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="maintainence[uksw_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_uksw_act_second btn btn-success" type="button" gt="maintainenceukswsecondAdd">Add</button></div>
                                                        
                                                        <?php if(!empty($_SESSION['ServiceTimeline']['Maintenance of Register']['uksw_act_second'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Maintenance of Register']['uksw_act_second']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="maintainence[uksw_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->uksw_act_second_dh_no)){ echo $gon->uksw_act_second_dh_no; } ?>"/>
							
                                                 <select name="maintainence[uksw_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->uksw_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->uksw_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="maintainence[uksw_act_second_condition][]" class="form-control"> <?php if(!empty($gon->uksw_act_second_condition)){ echo $gon->uksw_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
                                                        
							<p class="maintainenceukswsecondAdd"></p>
			                 </td>
                            
                            
                        </tr>
                       
			
			<!----------------------------------------------------------UKACT------End---------------------------------------------------------------------->	
					
					
					<!----------------------------------------------------------UkRTS------Start---------------------------------------------------------------------->
			
			 <tr>
                            <td>
                                <strong>Timeline for the Service In the Uttarakhand Right to Services  Act </strong>
                            </td>
                             <td class="acilppr"><div class="row" style="padding-left:20px;"><div id="acilpprukrtsAdd" countukrts_act="0">
							<input  type="text" name="acilppr[ukrts_act_dh_no][]" size="6px" />
							<select name="acilppr[ukrts_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="acilppr[ukrts_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act btn btn-success" type="button" gt="acilpprukrtsAdd">Add</button></div>
                                                        
                                                         <?php if(!empty($_SESSION['ServiceTimeline']['service']['ukrts_act'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['service']['ukrts_act']); }?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="acilppr[ukrts_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_dh_no)){ echo $gon->ukrts_act_dh_no; } ?>"/>
							
                                                 <select name="acilppr[ukrts_act_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="acilppr[ukrts_act_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_condition)){ echo $gon->ukrts_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="acilpprukrtsAdd"></p>
			                </td>
							
							<td class="ao"><div class="row" style="padding-left:20px;"><div id="aoukrtsAdd" countukrts_act="0" style="float:left;">
							<input  type="text" name="ao[ukrts_act_dh_no][]"  size="6px" />
							<select name="ao[ukrts_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="ao[ukrts_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act btn btn-success" type="button" gt="aoukrtsAdd">Add</button></div>
                                                                           <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Others']['ukrts_act'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Others']['ukrts_act']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="ao[ukrts_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_dh_no)){ echo $gon->ukrts_act_dh_no; } ?>"/>
							
                                                 <select name="ao[ukrts_act_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="ao[ukrts_act_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_condition)){ echo $gon->ukrts_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
                                                        
							<p class="aoukrtsAdd"></p>
			
							</td>
							
							
							<td class="ac"><div class="row" style="padding-left:20px;"><div id="acukrtsAdd" countukrts_act="0" style="float:left;">
							<input  type="text" name="ac[ukrts_act_dh_no][]"  size="6px" />
							<select name="ac[ukrts_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="ac[ukrts_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act btn btn-success" type="button" gt="acukrtsAdd">Add</button></div>
                                                        
                                                           <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Cancellation']['ukrts_act'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Cancellation']['ukrts_act']);} ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="ac[ukrts_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_dh_no)){ echo $gon->ukrts_act_dh_no; } ?>"/>
							
                                                 <select name="ac[ukrts_act_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="ac[ukrts_act_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_condition)){ echo $gon->ukrts_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="acukrtsAdd"></p>
			
							</td>
							
							
							<td class="as"><div class="row" style="padding-left:20px;"><div id="asukrtsAdd" countukrts_act="0" style="float:left;">
							<input  type="text" name="as[ukrts_act_dh_no][]"  size="6px" />
							<select name="as[ukrts_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="as[ukrts_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act btn btn-success" type="button" gt="asukrtsAdd">Add</button></div>
                                                        
                                                           <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Surrender']['ukrts_act'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Surrender']['ukrts_act']);} ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="as[ukrts_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_dh_no)){ echo $gon->ukrts_act_dh_no; } ?>"/>
							
                                                 <select name="as[ukrts_act_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="as[ukrts_act_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_condition)){ echo $gon->ukrts_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="asukrtsAdd"></p>
			                </td>
							
						
							<td class="at"><div class="row" style="padding-left:20px;"><div id="atukrtsAdd" countukrts_act="0" style="float:left;">
							<input  type="text" name="at[ukrts_act_dh_no][]"  size="6px" />
							<select name="at[ukrts_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="at[ukrts_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act btn btn-success" type="button" gt="atukrtsAdd">Add</button></div>
                                                        
                                                           <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Transfer']['ukrts_act'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Transfer']['ukrts_act']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="at[ukrts_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_dh_no)){ echo $gon->ukrts_act_dh_no; } ?>"/>
							
                                                 <select name="at[ukrts_act_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="at[ukrts_act_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_condition)){ echo $gon->ukrts_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="atukrtsAdd"></p>
			                </td>
							
							
                              <td class="duplicate"><div class="row" style="padding-left:20px;"><div id="duplicateukrtsAdd" countukrts_act="0" style="float:left;">
							  <input  type="text" name="duplicate[ukrts_act_dh_no][]"  size="6px" />
							<select name="duplicate[ukrts_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="duplicate[ukrts_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act btn btn-success" type="button" gt="duplicateukrtsAdd">Add</button></div>
                                                           <?php if(!empty($_SESSION['ServiceTimeline']['Duplicate Copy']['ukrts_act'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Duplicate Copy']['ukrts_act']);} ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="acilppr[ukrts_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_dh_no)){ echo $gon->ukrts_act_dh_no; } ?>"/>
							
                                                 <select name="duplicate[ukrts_act_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="duplicate[ukrts_act_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_condition)){ echo $gon->ukrts_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="duplicateukrtsAdd"></p>
			                 </td>
							 
						
							 
							 <td class="renewal"><div class="row" style="padding-left:20px;"><div id="renewalukrtsAdd" countukrts_act="0" style="float:left;">
							 <input  type="text" name="renewal[ukrts_act_dh_no][]"  size="6px" />
							<select name="renewal[ukrts_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="renewal[ukrts_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act btn btn-success" type="button" gt="renewalukrtsAdd">Add</button></div>
                                                           <?php if(!empty($_SESSION['ServiceTimeline']['Renewal']['ukrts_act'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Renewal']['ukrts_act']); }?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="renewal[ukrts_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_dh_no)){ echo $gon->ukrts_act_dh_no; } ?>"/>
							
                                                 <select name="renewal[ukrts_act_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="renewal[ukrts_act_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_condition)){ echo $gon->ukrts_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
                                                             
							<p class="renewalukrtsAdd"></p>
			                 </td>
                                         	 <td class="return"><div class="row" style="padding-left:20px;"><div id="returnukrtsAdd" countukrts_act="0" style="float:left;">
							 <input  type="text" name="return[ukrts_act_dh_no][]"  size="6px" />
							<select name="return[ukrts_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="return[ukrts_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act btn btn-success" type="button" gt="returnukrtsAdd">Add</button></div>
                                                           <?php if(!empty($_SESSION['ServiceTimeline']['Return']['ukrts_act'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Return']['ukrts_act']); }?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="return[ukrts_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_dh_no)){ echo $gon->ukrts_act_dh_no; } ?>"/>
							
                                                 <select name="return[ukrts_act_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="return[ukrts_act_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_condition)){ echo $gon->ukrts_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
                                                        
							<p class="returnukrtsAdd"></p>
			                 </td>
							 
							 <td class="maintainence"><div class="row" style="padding-left:20px;"><div id="maintainenceukrtsAdd" countukrts_act="0" style="float:left;">
							 <input  type="text" name="maintainence[ukrts_act_dh_no][]"  size="6px" />
							<select name="maintainence[ukrts_act_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="maintainence[ukrts_act_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act btn btn-success" type="button" gt="maintainenceukrtsAdd">Add</button></div>
                                                           <?php if(!empty($_SESSION['ServiceTimeline']['Maintenance of Register']['ukrts_act'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Maintenance of Register']['ukrts_act']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="maintainence[ukrts_act_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_dh_no)){ echo $gon->ukrts_act_dh_no; } ?>"/>
							
                                                 <select name="maintainence[ukrts_act_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="maintainence[ukrts_act_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_condition)){ echo $gon->ukrts_act_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
                                                             
							<p class="maintainenceukrtsAdd"></p>
			                 </td>
                            
                        </tr>
					
						
						<tr>
                            <td>
                                <strong>First Appellate in the UkRTS Act </strong>
                            </td>
                            <td class="acilppr"><textarea name="acilppr[ukrts_act_first_appellate]" class="form-control cri">
                                
<?php if(!empty($_SESSION['ServiceTimeline']['service']['ukrts_act_first_appellate'])){ echo $_SESSION['ServiceTimeline']['service']['ukrts_act_first_appellate']; }?>

                                </textarea></td>
                                <td class="ao"><textarea name="ao[ukrts_act_first_appellate]" class="form-control cri">
                                               
<?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Others']['ukrts_act_first_appellate'])){ echo $_SESSION['ServiceTimeline']['Amendment - Others']['ukrts_act_first_appellate']; }?>
                        
                                    </textarea></td>
                                    <td class="ac"><textarea name="ac[ukrts_act_first_appellate]" class="form-control cri">
                                          
<?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Cancellation']['ukrts_act_first_appellate'])){ echo $_SESSION['ServiceTimeline']['Amendment - Cancellation']['ukrts_act_first_appellate']; }?>

                                        </textarea></td>
                                        <td class="as"><textarea name="as[ukrts_act_first_appellate]" class="form-control cri">
                                          
<?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Surrender']['ukrts_act_first_appellate'])){ echo $_SESSION['ServiceTimeline']['Amendment - Surrender']['ukrts_act_first_appellate']; }?>

                                            </textarea></td>
                                            <td class="at"><textarea name="at[ukrts_act_first_appellate]" class="form-control cri">
                                          
<?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Transfer']['ukrts_act_first_appellate'])){ echo $_SESSION['ServiceTimeline']['Amendment - Transfer']['ukrts_act_first_appellate']; }?>

                                                </textarea></td>
                                                <td class="duplicate"><textarea name="duplicate[ukrts_act_first_appellate]" class="form-control cri">
                                          
<?php if(!empty($_SESSION['ServiceTimeline']['Duplicate Copy']['ukrts_act_first_appellate'])){ echo $_SESSION['ServiceTimeline']['Duplicate Copy']['ukrts_act_first_appellate']; }?>

                                                    </textarea></td>
                                                    <td class="renewal"><textarea name="renewal[ukrts_act_first_appellate]" class="form-control cri">
                                          
<?php if(!empty($_SESSION['ServiceTimeline']['Renewal']['ukrts_act_first_appellate'])){ echo $_SESSION['ServiceTimeline']['Renewal']['ukrts_act_first_appellate']; }?>

                                                        </textarea></td>
                                                        <td class="return"><textarea name="return[ukrts_act_first_appellate]" class="form-control cri">
                                          
<?php if(!empty($_SESSION['ServiceTimeline']['Return']['ukrts_act_first_appellate'])){ echo $_SESSION['ServiceTimeline']['Return']['ukrts_act_first_appellate']; }?>

                                                            </textarea></td>
                                                            <td class="maintainence"><textarea name="maintainence[ukrts_act_first_appellate]" class="form-control cri">
                                
          
<?php if(!empty($_SESSION['ServiceTimeline']['Maintenance of Register']['ukrts_act_first_appellate'])){ echo $_SESSION['ServiceTimeline']['Maintenance of Register']['ukrts_act_first_appellate']; }?>

                                                                </textarea></td>

                        </tr>
						
						
					<tr>
                            <td>
                                <strong>Timeline for Disposal of appeal by First Appellate (UkRTS)</strong>
                            </td>
                               <td class="acilppr"><div class="row" style="padding-left:20px;"><div id="acilpprukrtsfirstAdd" countukrts_actfirst="0">
							<input  type="text" name="acilppr[ukrts_act_first_dh_no][]" size="6px" />
							<select name="acilppr[ukrts_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="acilppr[ukrts_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act_first btn btn-success" type="button" gt="acilpprukrtsfirstAdd">Add</button></div>
                                                                     <?php if(!empty($_SESSION['ServiceTimeline']['service']['ukrts_act_first'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['service']['ukrts_act_first']);} ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="acilppr[ukrts_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_first_dh_no)){ echo $gon->ukrts_act_first_dh_no; } ?>"/>
							
                                                 <select name="acilppr[ukrts_act_first_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="acilppr[ukrts_act_first_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_first_condition)){ echo $gon->ukrts_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="acilpprukrtsfirstAdd"></p>
			                </td>
							<td class="ao"><div class="row" style="padding-left:20px;"><div id="aoukrtsfirstAdd" countukrts_actfirst="0" style="float:left;">
							<input  type="text" name="ao[ukrts_act_first_dh_no][]"  size="6px" />
							<select name="ao[ukrts_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="ao[ukrts_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act_first btn btn-success" type="button" gt="aoukrtsfirstAdd">Add</button></div>
                                                        
                                                                     <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Others']['ukrts_act_first'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Others']['ukrts_act_first']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="ao[ukrts_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_first_dh_no)){ echo $gon->ukrts_act_first_dh_no; } ?>"/>
							
                                                 <select name="ao[ukrts_act_first_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="ao[ukrts_act_first_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_first_condition)){ echo $gon->ukrts_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="aoukrtsfirstAdd"></p>
			
							</td>
							<td class="ac"><div class="row" style="padding-left:20px;"><div id="acukrtsfirstAdd" countukrts_actfirst="0" style="float:left;">
							<input  type="text" name="ac[ukrts_act_first_dh_no][]"  size="6px" />
							<select name="ac[ukrts_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="ac[ukrts_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act_first btn btn-success" type="button" gt="acukrtsfirstAdd">Add</button></div>
                                                        
                                                                     <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Cancellation']['ukrts_act_first'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Cancellation']['ukrts_act_first']); }?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="ac[ukrts_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_first_dh_no)){ echo $gon->ukrts_act_first_dh_no; } ?>"/>
							
                                                 <select name="ac[ukrts_act_first_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="ac[ukrts_act_first_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_first_condition)){ echo $gon->ukrts_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="acukrtsfirstAdd"></p>
			
							</td>
							<td class="as"><div class="row" style="padding-left:20px;"><div id="asukrtsfirstAdd" countukrts_actfirst="0" style="float:left;">
							<input  type="text" name="as[ukrts_act_first_dh_no][]"  size="6px" />
							<select name="as[ukrts_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="as[ukrts_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act_first btn btn-success" type="button" gt="asukrtsfirstAdd">Add</button></div>
                                                                     <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Surrender']['ukrts_act_first'])){
																	  $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Surrender']['ukrts_act_first']);} ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="as[ukrts_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_first_dh_no)){ echo $gon->ukrts_act_first_dh_no; } ?>"/>
							
                                                 <select name="as[ukrts_act_first_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="as[ukrts_act_first_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_first_condition)){ echo $gon->ukrts_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
                                                            
							<p class="asukrtsfirstAdd"></p>
			                </td>
							
							
							<td class="at"><div class="row" style="padding-left:20px;"><div id="atukrtsfirstAdd" countukrts_actfirst="0" style="float:left;">
							<input  type="text" name="at[ukrts_act_first_dh_no][]"  size="6px" />
							<select name="at[ukrts_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="at[ukrts_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act_first btn btn-success" type="button" gt="atukrtsfirstAdd">Add</button></div>
                                                                     <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Transfer']['ukrts_act_first'])){ 
																	 $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Transfer']['ukrts_act_first']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="at[ukrts_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_first_dh_no)){ echo $gon->ukrts_act_first_dh_no; } ?>"/>
							
                                                 <select name="at[ukrts_act_first_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="at[ukrts_act_first_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_first_condition)){ echo $gon->ukrts_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="atukrtsfirstAdd"></p>
			                </td>
							
							
                              <td class="duplicate"><div class="row" style="padding-left:20px;"><div id="duplicateukrtsfirstAdd" countukrts_actfirst="0" style="float:left;">
							  <input  type="text" name="duplicate[ukrts_act_first_dh_no][]"  size="6px" />
							<select name="duplicate[ukrts_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="duplicate[ukrts_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act_first btn btn-success" type="button" gt="duplicateukrtsfirstAdd">Add</button></div>
                                                                     <?php if(!empty($_SESSION['ServiceTimeline']['Duplicate Copy']['ukrts_act_first'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Duplicate Copy']['ukrts_act_first']); }?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="duplicate[ukrts_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_first_dh_no)){ echo $gon->ukrts_act_first_dh_no; } ?>"/>
							
                                                 <select name="duplicate[ukrts_act_first_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="duplicate[ukrts_act_first_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_first_condition)){ echo $gon->ukrts_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="duplicateukrtsfirstAdd"></p>
			                 </td>
							 <td class="renewal"><div class="row" style="padding-left:20px;"><div id="renewalukrtsfirstAdd" countukrts_actfirst="0" style="float:left;">
							 <input  type="text" name="renewal[ukrts_act_first_dh_no][]"  size="6px" />
							<select name="renewal[ukrts_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="renewal[ukrts_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act_first btn btn-success" type="button" gt="renewalukrtsfirstAdd">Add</button></div>
                                                                     <?php if(!empty($_SESSION['ServiceTimeline']['Renewal']['ukrts_act_first'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Renewal']['ukrts_act_first']); }?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="renewal[ukrts_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_first_dh_no)){ echo $gon->ukrts_act_first_dh_no; } ?>"/>
							
                                                 <select name="renewal[ukrts_act_first_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="renewal[ukrts_act_first_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_first_condition)){ echo $gon->ukrts_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="renewalukrtsfirstAdd"></p>
			                 </td>		 
							 <td class="return"><div class="row" style="padding-left:20px;"><div id="returnukrtsfirstAdd" countukrts_actfirst="0" style="float:left;">
							 <input  type="text" name="return[ukrts_act_first_dh_no][]"  size="6px" />
							<select name="return[ukrts_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="return[ukrts_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act_first btn btn-success" type="button" gt="returnukrtsfirstAdd">Add</button></div>
                                                                     <?php if(!empty($_SESSION['ServiceTimeline']['Return']['ukrts_act_first'])){ $go_notification= json_decode($_SESSION['ServiceTimeline']['Return']['ukrts_act_first']); }?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="return[ukrts_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_first_dh_no)){ echo $gon->ukrts_act_first_dh_no; } ?>"/>
							
                                                 <select name="return[ukrts_act_first_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="return[ukrts_act_first_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_first_condition)){ echo $gon->ukrts_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="returnukrtsfirstAdd"></p>
			                 </td>
							 
					
							 
							 <td class="maintainence"><div class="row" style="padding-left:20px;"><div id="maintainenceukrtsfirstAdd" countukrts_actfirst="0" style="float:left;">
							 <input  type="text" name="maintainence[ukrts_act_first_dh_no][]"  size="6px" />
							<select name="maintainence[ukrts_act_first_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="maintainence[ukrts_act_first_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act_first btn btn-success" type="button" gt="maintainenceukrtsfirstAdd">Add</button></div>
                                                                     <?php if(!empty($_SESSION['ServiceTimeline']['Maintenance of Register']['ukrts_act_first'])){
													 $go_notification= json_decode($_SESSION['ServiceTimeline']['Maintenance of Register']['ukrts_act_first']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="maintainence[ukrts_act_first_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_first_dh_no)){ echo $gon->ukrts_act_first_dh_no; } ?>"/>
							
                                                 <select name="maintainence[ukrts_act_first_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_first_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_first_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="maintainence[ukrts_act_first_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_first_condition)){ echo $gon->ukrts_act_first_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
                                                             
							<p class="maintainenceukrtsfirstAdd"></p>
			                 </td>
                            
                        </tr>
						
						
						<tr>
                            <td>
                                <strong>Second Appellate in the UkRTS Act </strong>
                            </td>
                            <td class="acilppr"><textarea name="acilppr[ukrts_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['service']['ukrts_act_second_appellate'])){ echo $_SESSION['ServiceTimeline']['service']['ukrts_act_second_appellate']; }?> 
                                </textarea></td>
                                <td class="ao"><textarea name="ao[ukrts_act_second_appellate]" class="form-control cri">
                                         <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Others']['ukrts_act_second_appellate'])){ echo $_SESSION['ServiceTimeline']['Amendment - Others']['ukrts_act_second_appellate']; }?>                    

                                    </textarea></td>
                                    <td class="ac"><textarea name="ac[ukrts_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Cancellation']['ukrts_act_second_appellate'])){ echo $_SESSION['ServiceTimeline']['Amendment - Cancellation']['ukrts_act_second_appellate']; }?>
                                        </textarea></td>
                                        <td class="as"><textarea name="as[ukrts_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Surrender']['ukrts_act_second_appellate'])){ echo $_SESSION['ServiceTimeline']['Amendment - Surrender']['ukrts_act_second_appellate']; }?>
                                            </textarea></td>
                                            <td class="at"><textarea name="at[ukrts_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Transfer']['ukrts_act_second_appellate'])){ echo $_SESSION['ServiceTimeline']['Amendment - Transfer']['ukrts_act_second_appellate']; }?>
                                                </textarea></td>
                                                <td class="duplicate"><textarea name="duplicate[ukrts_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Duplicate Copy']['ukrts_act_second_appellate'])){ echo $_SESSION['ServiceTimeline']['Duplicate Copy']['ukrts_act_second_appellate']; }?>
                                                    </textarea></td>
                                                    <td class="renewal"><textarea name="renewal[ukrts_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Renewal']['ukrts_act_second_appellate'])){ echo $_SESSION['ServiceTimeline']['Renewal']['ukrts_act_second_appellate']; }?>
                                                        </textarea></td>
                                                        <td class="return"><textarea name="return[ukrts_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Return']['ukrts_act_second_appellate'])){ echo $_SESSION['ServiceTimeline']['Return']['ukrts_act_second_appellate']; }?>
                                                            </textarea></td>
                                                            <td class="maintainence"><textarea name="maintainence[ukrts_act_second_appellate]" class="form-control cri">
                                <?php if(!empty($_SESSION['ServiceTimeline']['Maintenance of Register']['ukrts_act_second_appellate'])){ echo $_SESSION['ServiceTimeline']['Maintenance of Register']['ukrts_act_second_appellate']; }?>
                                                                </textarea></td>

                        </tr>
						
						
						<tr>
                            <td>
                                <strong>Timeline for Disposal of appeal by Second Appellate (UkRTS)</strong>
                            </td>
                            
                               <td class="acilppr"><div class="row" style="padding-left:20px;"><div id="acilpprukrtssecondAdd" countukrts_actsecond="0">
							<input  type="text" name="acilppr[ukrts_act_second_dh_no][]" size="6px" />
							<select name="acilppr[ukrts_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="acilppr[ukrts_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act_second btn btn-success" type="button" gt="acilpprukrtssecondAdd">Add</button></div>
							   <?php if(!empty($_SESSION['ServiceTimeline']['service']['ukrts_act_second'])){
													 $go_notification= json_decode($_SESSION['ServiceTimeline']['service']['ukrts_act_second']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="acilppr[ukrts_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_second_dh_no)){ echo $gon->ukrts_act_second_dh_no; } ?>"/>
							
                                                 <select name="acilppr[ukrts_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="acilppr[ukrts_act_second_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_second_dh_no)){ echo $gon->ukrts_act_second_dh_no; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
							<p class="acilpprukrtssecondAdd"></p>
			                </td>
							
							
							<td class="ao"><div class="row" style="padding-left:20px;"><div id="aoukrtssecondAdd" countukrts_actsecond="0" style="float:left;">
							<input  type="text" name="ao[ukrts_act_second_dh_no][]"  size="6px" />
							<select name="ao[ukrts_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="ao[ukrts_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act_second btn btn-success" type="button" gt="aoukrtssecondAdd">Add</button></div>
							<?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Others']['ukrts_act_second'])){
													 $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Others']['ukrts_act_second']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="ao[ukrts_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_second_dh_no)){ echo $gon->ukrts_act_second_dh_no; } ?>"/>
							
                                                 <select name="ao[ukrts_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="ao[ukrts_act_second_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_second_condition)){ echo $gon->ukrts_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
						
							<p class="aoukrtssecondAdd"></p>
			
							</td>
							
							
							<td class="ac"><div class="row" style="padding-left:20px;"><div id="acukrtssecondAdd" countukrts_actsecond="0" style="float:left;">
							<input  type="text" name="ac[ukrts_act_second_dh_no][]"  size="6px" />
							<select name="ac[ukrts_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="ac[ukrts_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act_second btn btn-success" type="button" gt="acukrtssecondAdd">Add</button></div>
							<?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Cancellation']['ukrts_act_second'])){
													 $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Cancellation']['ukrts_act_second']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="ac[ukrts_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_second_dh_no)){ echo $gon->ukrts_act_second_dh_no; } ?>"/>
							
                                                 <select name="ac[ukrts_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="ac[ukrts_act_second_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_second_condition)){ echo $gon->ukrts_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
						
							<p class="acukrtssecondAdd"></p>
			
							</td>
							
							
							
							<td class="as"><div class="row" style="padding-left:20px;"><div id="asukrtssecondAdd" countukrts_actsecond="0" style="float:left;">
							<input  type="text" name="as[ukrts_act_second_dh_no][]"  size="6px" />
							<select name="as[ukrts_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="as[ukrts_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act_second btn btn-success" type="button" gt="asukrtssecondAdd">Add</button></div>
							<?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Surrender']['ukrts_act_second'])){
													 $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Surrender']['ukrts_act_second']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="as[ukrts_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_second_dh_no)){ echo $gon->ukrts_act_second_dh_no; } ?>"/>
							
                                                 <select name="as[ukrts_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="as[ukrts_act_second_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_second_condition)){ echo $gon->ukrts_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
						
							<p class="asukrtssecondAdd"></p>
			                </td>
							
							
							<td class="at"><div class="row" style="padding-left:20px;"><div id="atukrtssecondAdd" countukrts_actsecond="0" style="float:left;">
							<input  type="text" name="at[ukrts_act_second_dh_no][]"  size="6px" />
							<select name="at[ukrts_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="at[ukrts_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act_second btn btn-success" type="button" gt="atukrtssecondAdd">Add</button></div>
							<?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Transfer']['ukrts_act_second'])){
													 $go_notification= json_decode($_SESSION['ServiceTimeline']['Amendment - Transfer']['ukrts_act_second']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="at[ukrts_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_second_dh_no)){ echo $gon->ukrts_act_second_dh_no; } ?>"/>
							
                                                 <select name="at[ukrts_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="at[ukrts_act_second_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_second_condition)){ echo $gon->ukrts_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
						
							<p class="atukrtssecondAdd"></p>
			                </td>
							
							
                              <td class="duplicate"><div class="row" style="padding-left:20px;"><div id="duplicateukrtssecondAdd" countukrts_actsecond="0" style="float:left;">
							  <input  type="text" name="duplicate[ukrts_act_second_dh_no][]"  size="6px" />
							<select name="duplicate[ukrts_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="duplicate[ukrts_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act_second btn btn-success" type="button" gt="duplicateukrtssecondAdd">Add</button></div>
							<?php if(!empty($_SESSION['ServiceTimeline']['Duplicate Copy']['ukrts_act_second'])){
													 $go_notification= json_decode($_SESSION['ServiceTimeline']['Duplicate Copy']['ukrts_act_second']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="duplicate[ukrts_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_second_dh_no)){ echo $gon->ukrts_act_second_dh_no; } ?>"/>
							
                                                 <select name="duplicate[ukrts_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="duplicate[ukrts_act_second_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_second_condition)){ echo $gon->ukrts_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
						
							<p class="duplicateukrtssecondAdd"></p>
			                 </td>
							 
							 
							 <td class="renewal"><div class="row" style="padding-left:20px;"><div id="renewalukrtssecondAdd" countukrts_actsecond="0" style="float:left;">
							 <input  type="text" name="renewal[ukrts_act_second_dh_no][]"  size="6px" />
							<select name="renewal[ukrts_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="renewal[ukrts_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act_second btn btn-success" type="button" gt="renewalukrtssecondAdd">Add</button></div>
							<?php if(!empty($_SESSION['ServiceTimeline']['Renewal']['ukrts_act_second'])){
													 $go_notification= json_decode($_SESSION['ServiceTimeline']['Renewal']['ukrts_act_second']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="renewal[ukrts_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_second_dh_no)){ echo $gon->ukrts_act_second_dh_no; } ?>"/>
							
                                                 <select name="renewal[ukrts_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="renewal[ukrts_act_second_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_second_condition)){ echo $gon->ukrts_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
						
							<p class="renewalukrtssecondAdd"></p>
			                 </td>
							 
							 
							 <td class="return"><div class="row" style="padding-left:20px;"><div id="returnukrtssecondAdd" countukrts_actsecond="0" style="float:left;">
							 <input  type="text" name="return[ukrts_act_second_dh_no][]"  size="6px" />
							<select name="return[ukrts_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="return[ukrts_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act_second btn btn-success" type="button" gt="returnukrtssecondAdd">Add</button></div>
							<?php if(!empty($_SESSION['ServiceTimeline']['Return']['ukrts_act_second'])){
													 $go_notification= json_decode($_SESSION['ServiceTimeline']['Return']['ukrts_act_second']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="return[ukrts_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_second_dh_no)){ echo $gon->ukrts_act_second_dh_no; } ?>"/>
							
                                                 <select name="return[ukrts_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="return[ukrts_act_second_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_second_condition)){ echo $gon->ukrts_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
						
							<p class="returnukrtssecondAdd"></p>
			                 </td>
							 
							 
							 
							 
							 
							 
						
						
						<td class="maintainence"><div class="row" style="padding-left:20px;"><div id="maintainenceukrtssecondAdd" countukrts_actsecond="0" style="float:left;">
							 <input  type="text" name="maintainence[ukrts_act_second_dh_no][]"  size="6px" />
							<select name="maintainence[ukrts_act_second_dh][]" >
							<option value="Days">Days</option>
							<option value="Hours">Hours</option> </select>
							<textarea  name="maintainence[ukrts_act_second_condition][]" class="form-control" ></textarea></div>
							<button style="float:left;" class="add_button_ukrts_act_second btn btn-success" type="button" gt="maintainenceukrtssecondAdd">Add</button></div>
							<?php if(!empty($_SESSION['ServiceTimeline']['Maintenance of Register']['ukrts_act_second'])){
													 $go_notification= json_decode($_SESSION['ServiceTimeline']['Maintenance of Register']['ukrts_act_second']); } ?>
                            
  <?php if(!empty($go_notification)){ 
                                    foreach($go_notification as $gon){
                                    ?>
                                              <div class="row"  style="padding-left:20px;"> 
                                                  <input  type="text" name="maintainence[ukrts_act_second_dh_no][]" size="6px"  value="<?php if(!empty($gon->ukrts_act_second_dh_no)){ echo $gon->ukrts_act_second_dh_no; } ?>"/>
							
                                                 <select name="maintainence[ukrts_act_second_dh][]" >
                                                        <option value="Days" <?php if($gon->ukrts_act_second_dh=="Days"){ echo " selected"; } ?>>Days</option>
							<option value="Hours" <?php if($gon->ukrts_act_second_dh=="Hours"){ echo " selected"; } ?>>Hours</option> </select>
							<textarea  name="maintainence[ukrts_act_second_condition][]" class="form-control"> <?php if(!empty($gon->ukrts_act_second_condition)){ echo $gon->ukrts_act_second_condition; } ?></textarea>
                                <a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a>
                                </div>
                                <?php } }  ?>
						
							<p class="maintainenceukrtssecondAdd"></p>
			                 </td>
                            
                            
                        </tr>
                        
			
			<!----------------------------------------------------------UkRTS------End---------------------------------------------------------------------->
					
						
						
						
						
					
					
					
					
					
					
					
					
					
					
					
					
                        <tr>
                            <td>
                                <strong>Comments </strong>
                            </td>
                            <td class="acilppr"><textarea name="acilppr[comment]" class="form-control cri">
                                 <?php if(!empty($_SESSION['ServiceTimeline']['service']['comment'])){ echo $_SESSION['ServiceTimeline']['service']['comment']; }?>
                                               
                                </textarea></td>
                                <td class="ao"><textarea name="ao[comment]" class="form-control cri">
                                                              <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Others']['comment'])){ echo $_SESSION['ServiceTimeline']['Amendment - Others']['comment']; }?>
                                               
                                    </textarea></td>
                                    <td class="ac"><textarea name="ac[comment]" class="form-control cri">
                                 <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Cancellation']['comment'])){ echo $_SESSION['ServiceTimeline']['Amendment - Cancellation']['comment']; }?>
                                               
                                        </textarea></td>
                                        <td class="as"><textarea name="as[comment]" class="form-control cri">
                                 <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Surrender']['comment'])){ echo $_SESSION['ServiceTimeline']['Amendment - Surrender']['comment']; }?>
                                       
                                            </textarea></td>
                                            <td class="at"><textarea name="at[comment]" class="form-control cri">
                                 <?php if(!empty($_SESSION['ServiceTimeline']['Amendment - Transfer']['comment'])){ echo $_SESSION['ServiceTimeline']['Amendment - Transfer']['comment']; }?>
                                       
                                                </textarea></td>
                                                <td class="duplicate"><textarea name="duplicate[comment]" class="form-control cri">
                                 <?php if(!empty($_SESSION['ServiceTimeline']['Duplicate Copy']['comment'])){ echo $_SESSION['ServiceTimeline']['Duplicate Copy']['comment']; }?>
                                       
                                                    </textarea></td>
                                                    <td class="renewal"><textarea name="renewal[comment]" class="form-control cri">
                                 <?php if(!empty($_SESSION['ServiceTimeline']['Renewal']['comment'])){ echo $_SESSION['ServiceTimeline']['Renewal']['comment']; }?>
                                       
                                                        </textarea></td>
                                                        <td class="return"><textarea name="return[comment]" class="form-control cri">
                                 <?php if(!empty($_SESSION['ServiceTimeline']['Return']['comment'])){ echo $_SESSION['ServiceTimeline']['Return']['comment']; }?>
                                       
                                                            </textarea></td>
                                                            <td class="maintainence"><textarea name="maintainence[comment]" class="form-control cri">
                                 <?php if(!empty($_SESSION['ServiceTimeline']['Maintenance of Register']['comment'])){ echo $_SESSION['ServiceTimeline']['Maintenance of Register']['comment']; }?>
                                       
                                                                </textarea></td>

                        </tr>
                    </tbody>
                </table>
				<?php if(empty($_SESSION['ServiceTimeline'])) { ?>
                <input type="submit" value="Save" class="btn btn-primary">
				<?php } ?>
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

     <!------------Go Notification start------------>
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
	  
	 <!------------Gov Act start------------>  
	  $(document).ready(function () {
	$(".add_button_gov_act").click(function(){
	var gh=$(this).attr("gt");

		var kl=$("#"+gh).attr("countgov_act");
	if(kl==5){return false;}
	    var ty=	$("#"+gh).html();
	$("."+gh).append('<div class="row"  style="padding-left:20px;">'+ty+"<a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a><div>");

	$("#"+gh).attr("countgov_act",parseInt(kl)+1);
		$(".rmv").click(function(){
	$(this).parent('div').remove();
	});
	});
 });
 
 <!------------Gov Act First start------------>
  $(document).ready(function () {
	$(".add_button_gov_act_first").click(function(){
	var gh=$(this).attr("gt");

		var kl=$("#"+gh).attr("countgov_actfirst");
	if(kl==5){return false;}
	    var ty=	$("#"+gh).html();
	$("."+gh).append('<div class="row"  style="padding-left:20px;">'+ty+"<a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a><div>");

	$("#"+gh).attr("countgov_actfirst",parseInt(kl)+1);
		$(".rmv").click(function(){
	$(this).parent('div').remove();
	});
	});
 });
   
   <!------------Gov Act Second start------------>
  $(document).ready(function () {
	$(".add_button_gov_act_second").click(function(){
	var gh=$(this).attr("gt");

		var kl=$("#"+gh).attr("countgov_actsecond");
	if(kl==5){return false;}
	    var ty=	$("#"+gh).html();
	$("."+gh).append('<div class="row"  style="padding-left:20px;">'+ty+"<a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a><div>");

	$("#"+gh).attr("countgov_actsecond",parseInt(kl)+1);
		$(".rmv").click(function(){
	$(this).parent('div').remove();
	});
	});
 });
   
    <!------------uksw Act start------------>  
	  $(document).ready(function () {
	$(".add_button_uksw_act").click(function(){
	var gh=$(this).attr("gt");

		var kl=$("#"+gh).attr("countuksw_act");
	if(kl==5){return false;}
	    var ty=	$("#"+gh).html();
	$("."+gh).append('<div class="row"  style="padding-left:20px;">'+ty+"<a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a><div>");

	$("#"+gh).attr("countuksw_act",parseInt(kl)+1);
		$(".rmv").click(function(){
	$(this).parent('div').remove();
	});
	});
 });
 
 <!------------Uksw Act First start------------>
  $(document).ready(function () {
	$(".add_button_uksw_act_first").click(function(){
	var gh=$(this).attr("gt");

		var kl=$("#"+gh).attr("countuksw_actfirst");
	if(kl==5){return false;}
	    var ty=	$("#"+gh).html();
	$("."+gh).append('<div class="row"  style="padding-left:20px;">'+ty+"<a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a><div>");

	$("#"+gh).attr("countuksw_actfirst",parseInt(kl)+1);
		$(".rmv").click(function(){
	$(this).parent('div').remove();
	});
	});
 });
   
   <!------------Uksw Act Second start------------>
  $(document).ready(function () {
	$(".add_button_uksw_act_second").click(function(){
	var gh=$(this).attr("gt");

		var kl=$("#"+gh).attr("countuksw_actsecond");
	if(kl==5){return false;}
	    var ty=	$("#"+gh).html();
	$("."+gh).append('<div class="row"  style="padding-left:20px;">'+ty+"<a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a><div>");

	$("#"+gh).attr("countuksw_actsecond",parseInt(kl)+1);
		$(".rmv").click(function(){
	$(this).parent('div').remove();
	});
	});
 });
 
 <!------------ukrts Act start------------>  
	  $(document).ready(function () {
	$(".add_button_ukrts_act").click(function(){
	var gh=$(this).attr("gt");

		var kl=$("#"+gh).attr("countukrts_act");
	if(kl==5){return false;}
	    var ty=	$("#"+gh).html();
	$("."+gh).append('<div class="row"  style="padding-left:20px;">'+ty+"<a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a><div>");

	$("#"+gh).attr("countukrts_act",parseInt(kl)+1);
		$(".rmv").click(function(){
	$(this).parent('div').remove();
	});
	});
 });
 
 <!------------ukrts Act First start------------>
  $(document).ready(function () {
	$(".add_button_ukrts_act_first").click(function(){
	var gh=$(this).attr("gt");

		var kl=$("#"+gh).attr("countukrts_actfirst");
	if(kl==5){return false;}
	    var ty=	$("#"+gh).html();
	$("."+gh).append('<div class="row"  style="padding-left:20px;">'+ty+"<a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a><div>");

	$("#"+gh).attr("countukrts_actfirst",parseInt(kl)+1);
		$(".rmv").click(function(){
	$(this).parent('div').remove();
	});
	});
 });
   
   <!------------ukrts Act Second start------------>
  $(document).ready(function () {
	$(".add_button_ukrts_act_second").click(function(){
	var gh=$(this).attr("gt");

		var kl=$("#"+gh).attr("countukrts_actsecond");
	if(kl==5){return false;}
	    var ty=	$("#"+gh).html();
	$("."+gh).append('<div class="row"  style="padding-left:20px;">'+ty+"<a href='javascript:void(0)' class='btn btn-danger rmv'> Remove</a><div>");

	$("#"+gh).attr("countukrts_actsecond",parseInt(kl)+1);
		$(".rmv").click(function(){
	$(this).parent('div').remove();
	});
	});
 });
 	$(".rmv").click(function(){
	$(this).parent('div').remove();
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