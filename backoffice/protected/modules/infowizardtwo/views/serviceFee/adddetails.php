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
                                                <div class="col-md-1 bg-grey  mt-step-col ">
                                                    <div class="mt-step-number bg-white font-grey">3</div>
                                                    <div class="mt-step-content font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/serviceInspection/Adddetails/serviceID/'.$serviceData['id'].'')?>" >Inspection </a></div>
                                                    <div class="mt-step-content font-grey-cascade">Form</div>
                                                </div>
                                                <div class="col-md-1 bg-grey mt-step-col done">
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




<!--<div class='portlet box green'>

    <div class='portlet-title'>

        <div class='caption'>

            <i style=" font-size:20px;" class='fa fa-plus'></i><b>Sub Form-3 Fee  </b>   Create Service Fee for <strong><?php echo $serviceData['service_name']?></strong></div>

        <div class='tools'>



        </div>



    </div>-->

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
							<th class="ac">
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

                                <strong>Any fees  to be submitted for Application</strong>

                            </td>

                            <td class="acilppr"><select name="acilppr[is_fee_submitted]" onchange='hide("acilppr[add_condition],acilppr[fee_detail],acilppr[upload_fee_structure],acilppr[conditions],acilppr[nsc_deposit_token],acilppr[deposit_condition],acilppr[any_deposit_token],acilppr[bank_ifsc_code],acilppr[bank_name],acilppr[bank_account_number],acilppr[bank_account_holder_name],acilppr[treasury_head_detail],acilppr[paymeny_mode],acilppr[upload_fee_structure],acilppr[treasury_head_ekosh],acilppr[payment_compulsory]","acilppr[is_fee_submitted]")' class="acilppr form-control cri">
						<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['service'])){if($_SESSION['ServiceFee']['service']['is_fee_submitted']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['service'])){if($_SESSION['ServiceFee']['service']['is_fee_submitted']=="N"){echo " selected";}} ?>>No</option>
		
							</select></td>

<td class="ao"><select name="ao[is_fee_submitted]" onchange=
'hide("ao[add_condition],ao[fee_detail],ao[upload_fee_structure],ao[conditions],ao[nsc_deposit_token],ao[deposit_condition],ao[any_deposit_token],ao[bank_ifsc_code],ao[bank_name],ao[bank_account_number],ao[bank_account_holder_name],ao[treasury_head_detail],ao[paymeny_mode],ao[upload_fee_structure],ao[treasury_head_ekosh],ao[payment_compulsory]",
"ao[is_fee_submitted]")' class="ao form-control cri">
<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){if($_SESSION['ServiceFee']['Amendment - Others']['is_fee_submitted']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){if($_SESSION['ServiceFee']['Amendment - Others']['is_fee_submitted']=="N"){echo " selected";}} ?>>No</option>
</select></td>



                            <td class="ac"><select name="ac[is_fee_submitted]" onchange='hide("ac[add_condition],ac[fee_detail],ac[upload_fee_structure],ac[conditions],ac[nsc_deposit_token],ac[deposit_condition],ac[any_deposit_token],ac[bank_ifsc_code],ac[bank_name],ac[bank_account_number],ac[bank_account_holder_name],ac[treasury_head_detail],ac[paymeny_mode],ac[upload_fee_structure],ac[treasury_head_ekosh],ac[payment_compulsory]","ac[is_fee_submitted]")' class="ac form-control cri">
<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){if($_SESSION['ServiceFee']['Amendment - Cancellation']['is_fee_submitted']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){if($_SESSION['ServiceFee']['Amendment - Cancellation']['is_fee_submitted']=="N"){echo " selected";}} ?>>No</option>
</select></td>
                            <td class="as"><select name="as[is_fee_submitted]" onchange='hide("as[add_condition],as[fee_detail],as[upload_fee_structure],as[conditions],as[nsc_deposit_token],as[deposit_condition],as[any_deposit_token],as[bank_ifsc_code],as[bank_name],as[bank_account_number],as[bank_account_holder_name],as[treasury_head_detail],as[paymeny_mode],as[upload_fee_structure],as[treasury_head_ekosh],as[payment_compulsory]","as[is_fee_submitted]")' class="as form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){if($_SESSION['ServiceFee']['Amendment - Surrender']['is_fee_submitted']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){if($_SESSION['ServiceFee']['Amendment - Surrender']['is_fee_submitted']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="at"><select name="at[is_fee_submitted]" onchange='hide("at[add_condition],at[fee_detail],at[upload_fee_structure],at[conditions],at[nsc_deposit_token],at[deposit_condition],at[any_deposit_token],at[bank_ifsc_code],at[bank_name],at[bank_account_number],at[bank_account_holder_name],at[treasury_head_detail],at[paymeny_mode],at[upload_fee_structure],at[treasury_head_ekosh],at[payment_compulsory]","at[is_fee_submitted]")' class="at form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){if($_SESSION['ServiceFee']['Amendment - Transfer']['is_fee_submitted']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){if($_SESSION['ServiceFee']['Amendment - Transfer']['is_fee_submitted']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="duplicate"><select name="duplicate[is_fee_submitted]" onchange='hide("duplicate[add_condition],duplicate[fee_detail],duplicate[upload_fee_structure],duplicate[conditions],duplicate[nsc_deposit_token],duplicate[deposit_condition],duplicate[any_deposit_token],duplicate[bank_ifsc_code],duplicate[bank_name],duplicate[bank_account_number],duplicate[bank_account_holder_name],duplicate[treasury_head_detail],duplicate[paymeny_mode],duplicate[upload_fee_structure],duplicate[treasury_head_ekosh],duplicate[payment_compulsory]","duplicate[is_fee_submitted]")' class="duplicate form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy'])){if($_SESSION['ServiceFee']['Duplicate Copy']['is_fee_submitted']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy'])){if($_SESSION['ServiceFee']['Duplicate Copy']['is_fee_submitted']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="renewal"><select name="renewal[is_fee_submitted]" onchange='hide("renewal[add_condition],renewal[fee_detail],renewal[upload_fee_structure],renewal[conditions],renewal[nsc_deposit_token],renewal[deposit_condition],renewal[any_deposit_token],renewal[bank_ifsc_code],renewal[bank_name],renewal[bank_account_number],renewal[bank_account_holder_name],renewal[treasury_head_detail],renewal[paymeny_mode],renewal[upload_fee_structure],renewal[treasury_head_ekosh],renewal[payment_compulsory]","renewal[is_fee_submitted]")' class="renewal form-control cri"><option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Renewal'])){if($_SESSION['ServiceFee']['Renewal']['is_fee_submitted']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceFee']['Renewal'])){if($_SESSION['ServiceFee']['Renewal']['is_fee_submitted']=="N"){echo " selected";}} ?>>No</option></select></td>

                            <td class="return"><select name="return[is_fee_submitted]" onchange='hide("return[add_condition],return[fee_detail],return[upload_fee_structure],return[conditions],return[nsc_deposit_token],return[deposit_condition],return[any_deposit_token],return[bank_ifsc_code],return[bank_name],return[bank_account_number],return[bank_account_holder_name],return[treasury_head_detail],return[paymeny_mode],return[upload_fee_structure],
							return[treasury_head_ekosh],return[payment_compulsory]","return[is_fee_submitted]")' class="return form-control cri"><option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Return'])){if($_SESSION['ServiceFee']['Return']['is_fee_submitted']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceFee']['Return'])){if($_SESSION['ServiceFee']['Return']['is_fee_submitted']=="N"){echo " selected";}} ?>>No</option></select></td>

                            <td class="maintainence"><select name="maintainence[is_fee_submitted]" onchange='hide("maintainence[add_condition],maintainence[fee_detail],maintainence[upload_fee_structure],maintainence[conditions],maintainence[nsc_deposit_token],maintainence[deposit_condition],maintainence[any_deposit_token],maintainence[bank_ifsc_code],maintainence[bank_name],maintainence[bank_account_number],maintainence[bank_account_holder_name],maintainence[treasury_head_detail],maintainence[paymeny_mode],maintainence[upload_fee_structure],maintainence[treasury_head_ekosh],maintainence[payment_compulsory]","maintainence[is_fee_submitted]")' class="maintainence form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){if($_SESSION['ServiceFee']['Maintenance of Register']['is_fee_submitted']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){if($_SESSION['ServiceFee']['Maintenance of Register']['is_fee_submitted']=="N"){echo " selected";}} ?>>No</option></select></td>

                        </tr>

                        <tr>

                            <td>

                                <strong>If Y, Add Condition</strong>

                            </td>

                             <td class="acilppr"> <input type="text" class="form-control cri acilppr" name="acilppr[add_condition]" placeholder="Conditions" value="<?php if(!empty($_SESSION['ServiceFee']['service'])){ echo $_SESSION['ServiceFee']['service']['add_condition']; }?>"  /></td>
                             <td class="ao"> <input type="text" class="form-control cri ao" name="ao[add_condition]" placeholder="Conditions"
							 value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){ echo $_SESSION['ServiceFee']['Amendment - Others']['add_condition']; }?>"  /></td>
                            <td class="ac"> <input type="text" class="form-control cri ac" name="ac[add_condition]" placeholder="Conditions" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){ echo $_SESSION['ServiceFee']['Amendment - Cancellation']['add_condition']; }?>"  /></td>
                            <td class="as"> <input type="text" class="form-control cri as" name="as[add_condition]" placeholder="Conditions" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){ echo $_SESSION['ServiceFee']['Amendment - Surrender']['add_condition']; }?>"  /></td>
                            <td class="at"> <input type="text" class="form-control cri at" name="at[add_condition]" placeholder="Conditions" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){ echo $_SESSION['ServiceFee']['Amendment - Transfer']['add_condition']; }?>"  /></td>

                            <td class="duplicate"><input type="text" class="form-control cri duplicate" name="duplicate[add_condition]" placeholder="Conditions" value="<?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy'])){ echo $_SESSION['ServiceFee']['Duplicate Copy']['add_condition']; }?>"  /></td>

                            <td class="renewal"><input type="text" class="form-control cri renewal" name="renewal[add_condition]" placeholder="Conditions" value="<?php if(!empty($_SESSION['ServiceFee']['Renewal'])){ echo $_SESSION['ServiceFee']['Renewal']['add_condition']; }?>"  /></td>

                            <td class="return"><input type="text" class="form-control cri return" name="return[add_condition]" placeholder="Conditions" value="<?php if(!empty($_SESSION['ServiceFee']['Return'])){ echo $_SESSION['ServiceFee']['Return']['add_condition']; }?>"  /></td>

                            <td class="maintainence"><input type="text" class="form-control cri maintainence" name="maintainence[add_condition]" placeholder="Conditions"
							value="<?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){ echo $_SESSION['ServiceFee']['Maintenance of Register']['add_condition']; }?>"  /></td>

                        </tr>

                         <tr>

                            <td><strong>If Y, Add Fee Details in INR</strong></td>

<td class="acilppr"> <input type="text" class="form-control cri acilppr" name="acilppr[fee_detail]" placeholder="INR" value="<?php if(!empty($_SESSION['ServiceFee']['service'])){ echo $_SESSION['ServiceFee']['service']['fee_detail']; }?>"  /></td>
                             <td class="ao"> <input type="text" class="form-control cri ao" name="ao[fee_detail]" placeholder="INR"
							 value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){ echo $_SESSION['ServiceFee']['Amendment - Others']['fee_detail']; }?>"  /></td>
                            <td class="ac"> <input type="text" class="form-control cri ac" name="ac[fee_detail]" placeholder="INR" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){ echo $_SESSION['ServiceFee']['Amendment - Cancellation']['fee_detail']; }?>"  /></td>
                            <td class="as"> <input type="text" class="form-control cri as" name="as[fee_detail]" placeholder="INR" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){ echo $_SESSION['ServiceFee']['Amendment - Surrender']['fee_detail']; }?>"  /></td>
                            <td class="at"> <input type="text" class="form-control cri at" name="at[fee_detail]" placeholder="INR" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){ echo $_SESSION['ServiceFee']['Amendment - Transfer']['fee_detail']; }?>"  /></td>

                            <td class="duplicate"><input type="text" class="form-control cri duplicate" name="duplicate[fee_detail]" placeholder="INR" value="<?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy'])){ echo $_SESSION['ServiceFee']['Duplicate Copy']['fee_detail']; }?>"  /></td>

                            <td class="renewal"><input type="text" class="form-control cri renewal" name="renewal[fee_detail]" placeholder="INR" value="<?php if(!empty($_SESSION['ServiceFee']['Renewal'])){ echo $_SESSION['ServiceFee']['Renewal']['fee_detail']; }?>"  /></td>

                            <td class="return"><input type="text" class="form-control cri return" name="return[fee_detail]" placeholder="INR" value="<?php if(!empty($_SESSION['ServiceFee']['Return'])){ echo $_SESSION['ServiceFee']['Return']['fee_detail']; }?>"  /></td>

                            <td class="maintainence"><input type="text" class="form-control cri maintainence" name="maintainence[fee_detail]" placeholder="INR"
							value="<?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){ echo $_SESSION['ServiceFee']['Maintenance of Register']['fee_detail']; }?>"  /></td>

                              <input type="hidden" class="form-control cri acilppr" name="acilppr[upload_fee_structure]"  value="<?php if(!empty($_SESSION['ServiceFee']['service'])){ echo $_SESSION['ServiceFee']['service']['upload_fee_structure']; }?>"  />
                           <input type="hidden" class="form-control cri ao" name="ao[upload_fee_structure]"  value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){ echo $_SESSION['ServiceFee']['Amendment - Others']['upload_fee_structure']; }?>"  />
                            <input type="hidden" class="form-control cri ac" name="ac[upload_fee_structure]"  value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){ echo $_SESSION['ServiceFee']['Amendment - Cancellation']['upload_fee_structure']; }?>"  />
                           <input type="hidden" class="form-control cri as" name="as[upload_fee_structure]"  value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){ echo $_SESSION['ServiceFee']['Amendment - Surrender']['upload_fee_structure']; }?>"  />
                            <input type="hidden" class="form-control cri at" name="at[upload_fee_structure]"  value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){ echo $_SESSION['ServiceFee']['Amendment - Transfer']['upload_fee_structure']; }?>"  />

                           <input type="hidden" class="form-control cri duplicate" name="duplicate[upload_fee_structure]"  value="<?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy'])){ echo $_SESSION['ServiceFee']['Duplicate Copy']['upload_fee_structure']; }?>"  />

                            <input type="hidden" class="form-control cri renewal" name="renewal[upload_fee_structure]"  value="<?php if(!empty($_SESSION['ServiceFee']['Renewal'])){ echo $_SESSION['ServiceFee']['Renewal']['upload_fee_structure']; }?>"  />

                            <td class="return"><input type="hidden" class="form-control cri return" name="return[upload_fee_structure]"  value="<?php if(!empty($_SESSION['ServiceFee']['Return'])){ echo $_SESSION['ServiceFee']['Return']['upload_fee_structure']; }?>"  />

                            <td class="maintainence"><input type="hidden" class="form-control cri maintainence" name="maintainence[upload_fee_structure]" 
							value="<?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){ echo $_SESSION['ServiceFee']['Maintenance of Register']['upload_fee_structure']; }?>"  /></td>

                                 
                        </tr>


                           <tr>

                            <td>

                                <strong>Allowed Mode of Payments</strong>

                            </td>

                       <td class="acilppr"><select name="acilppr[paymeny_mode]" class="form-control cri acilppr" multiple="multiple">
<option value="Treasury Challan"<?php if(!empty($_SESSION['ServiceFee']['service'])){if($_SESSION['ServiceFee']['service']['paymeny_mode']=="Treasury Challan")
	{echo " selected";}} ?> >Treasury Challan</option>
<option value="Internet Banking"<?php if(!empty($_SESSION['ServiceFee']['service'])){if($_SESSION['ServiceFee']['service']['paymeny_mode']=="Internet Banking")
	{echo " selected";}} ?>>Internet Banking</option>
<option value="RTGS" <?php if(!empty($_SESSION['ServiceFee']['service'])){if($_SESSION['ServiceFee']['service']['paymeny_mode']=="RTGS")
	{echo " selected";}} ?>>RTGS</option>
<option value="Debit Card" <?php if(!empty($_SESSION['ServiceFee']['service'])){if($_SESSION['ServiceFee']['service']['paymeny_mode']=="Debit Card")
	{echo " selected";}} ?>>Debit Card</option>
<option value="Credit Card" <?php if(!empty($_SESSION['ServiceFee']['service'])){if($_SESSION['ServiceFee']['service']['paymeny_mode']=="Credit Card")
	{echo " selected";}} ?>>Credit Card</option>
<option value="Wallets" <?php if(!empty($_SESSION['ServiceFee']['service'])){if($_SESSION['ServiceFee']['service']['paymeny_mode']=="Wallets")
	{echo " selected";}} ?>>Wallets</option>
<option value="Demand Draft" <?php if(!empty($_SESSION['ServiceFee']['service'])){if($_SESSION['ServiceFee']['service']['paymeny_mode']=="Demand Draft")
	{echo " selected";}} ?>>Demand Draft</option>
<option value="Challan" <?php if(!empty($_SESSION['ServiceFee']['service'])){if($_SESSION['ServiceFee']['service']['paymeny_mode']=="Challan")
	{echo " selected";}} ?>>Challan</option>
<option value="Cash Deposit" <?php if(!empty($_SESSION['ServiceFee']['service'])){if($_SESSION['ServiceFee']['service']['paymeny_mode']=="Cash Deposit")
	{echo " selected";}} ?>>Cash Deposit</option>
<option value="Cheque" <?php if(!empty($_SESSION['ServiceFee']['service'])){if($_SESSION['ServiceFee']['service']['paymeny_mode']=="Cheque")
	{echo " selected";}} ?>>Cheque</option>
<option value="Others" <?php if(!empty($_SESSION['ServiceFee']['service'])){if($_SESSION['ServiceFee']['service']['paymeny_mode']=="Others")
	{echo " selected";}} ?>>Others</option></select></td>
	
	<td class="ao"><select name="ao[paymeny_mode]" class="form-control cri ao" multiple="multiple">
<option value="Treasury Challan"<?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){if($_SESSION['ServiceFee']['Amendment - Others']['paymeny_mode']=="Treasury Challan")
	{echo " selected";}} ?> >Treasury Challan</option>
<option value="Internet Banking"<?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){if($_SESSION['ServiceFee']['Amendment - Others']['paymeny_mode']=="Internet Banking")
	{echo " selected";}} ?>>Internet Banking</option>
<option value="RTGS" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){if($_SESSION['ServiceFee']['Amendment - Others']['paymeny_mode']=="RTGS")
	{echo " selected";}} ?>>RTGS</option>
<option value="Debit Card" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){if($_SESSION['ServiceFee']['Amendment - Others']['paymeny_mode']=="Debit Card")
	{echo " selected";}} ?>>Debit Card</option>
<option value="Credit Card" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){if($_SESSION['ServiceFee']['Amendment - Others']['paymeny_mode']=="Credit Card")
	{echo " selected";}} ?>>Credit Card</option>
<option value="Wallets" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){if($_SESSION['ServiceFee']['Amendment - Others']['paymeny_mode']=="Wallets")
	{echo " selected";}} ?>>Wallets</option>
<option value="Demand Draft" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){if($_SESSION['ServiceFee']['Amendment - Others']['paymeny_mode']=="Demand Draft")
	{echo " selected";}} ?>>Demand Draft</option>
<option value="Challan" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){if($_SESSION['ServiceFee']['Amendment - Others']['paymeny_mode']=="Challan")
	{echo " selected";}} ?>>Challan</option>
<option value="Cash Deposit" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){if($_SESSION['ServiceFee']['Amendment - Others']['paymeny_mode']=="Cash Deposit")
	{echo " selected";}} ?>>Cash Deposit</option>
<option value="Cheque" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){if($_SESSION['ServiceFee']['Amendment - Others']['paymeny_mode']=="Cheque")
	{echo " selected";}} ?>>Cheque</option>
<option value="Others" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){if($_SESSION['ServiceFee']['Amendment - Others']['paymeny_mode']=="Others")
	{echo " selected";}} ?>>Others</option></select></td>
	
					   
<td class="ac"><select name="ac[paymeny_mode]" class="form-control cri ac" multiple="multiple">
<option value="Treasury Challan"<?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){if($_SESSION['ServiceFee']['Amendment - Cancellation']['paymeny_mode']=="Treasury Challan")
	{echo " selected";}} ?> >Treasury Challan</option>
<option value="Internet Banking"<?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){if($_SESSION['ServiceFee']['Amendment - Cancellation']['paymeny_mode']=="Internet Banking")
	{echo " selected";}} ?>>Internet Banking</option>
<option value="RTGS" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){if($_SESSION['ServiceFee']['Amendment - Cancellation']['paymeny_mode']=="RTGS")
	{echo " selected";}} ?>>RTGS</option>
<option value="Debit Card" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){if($_SESSION['ServiceFee']['Amendment - Cancellation']['paymeny_mode']=="Debit Card")
	{echo " selected";}} ?>>Debit Card</option>
<option value="Credit Card" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){if($_SESSION['ServiceFee']['Amendment - Cancellation']['paymeny_mode']=="Credit Card")
	{echo " selected";}} ?>>Credit Card</option>
<option value="Wallets" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){if($_SESSION['ServiceFee']['Amendment - Cancellation']['paymeny_mode']=="Wallets")
	{echo " selected";}} ?>>Wallets</option>
<option value="Demand Draft" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){if($_SESSION['ServiceFee']['Amendment - Cancellation']['paymeny_mode']=="Demand Draft")
	{echo " selected";}} ?>>Demand Draft</option>
<option value="Challan" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){if($_SESSION['ServiceFee']['Amendment - Cancellation']['paymeny_mode']=="Challan")
	{echo " selected";}} ?>>Challan</option>
<option value="Cash Deposit" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){if($_SESSION['ServiceFee']['Amendment - Cancellation']['paymeny_mode']=="Cash Deposit")
	{echo " selected";}} ?>>Cash Deposit</option>
<option value="Cheque" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){if($_SESSION['ServiceFee']['Amendment - Cancellation']['paymeny_mode']=="Cheque")
	{echo " selected";}} ?>>Cheque</option>
<option value="Others" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){if($_SESSION['ServiceFee']['Amendment - Cancellation']['paymeny_mode']=="Others")
	{echo " selected";}} ?>>Others</option></select></td>
	
	<td class="as"><select name="as[paymeny_mode]" class="form-control cri as" multiple="multiple">
<option value="Treasury Challan"<?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){if($_SESSION['ServiceFee']['Amendment - Surrender']['paymeny_mode']=="Treasury Challan")
	{echo " selected";}} ?> >Treasury Challan</option>
<option value="Internet Banking"<?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){if($_SESSION['ServiceFee']['Amendment - Surrender']['paymeny_mode']=="Internet Banking")
	{echo " selected";}} ?>>Internet Banking</option>
<option value="RTGS" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){if($_SESSION['ServiceFee']['Amendment - Surrender']['paymeny_mode']=="RTGS")
	{echo " selected";}} ?>>RTGS</option>
<option value="Debit Card" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){if($_SESSION['ServiceFee']['Amendment - Surrender']['paymeny_mode']=="Debit Card")
	{echo " selected";}} ?>>Debit Card</option>
<option value="Credit Card" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){if($_SESSION['ServiceFee']['Amendment - Surrender']['paymeny_mode']=="Credit Card")
	{echo " selected";}} ?>>Credit Card</option>
<option value="Wallets" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){if($_SESSION['ServiceFee']['Amendment - Surrender']['paymeny_mode']=="Wallets")
	{echo " selected";}} ?>>Wallets</option>
<option value="Demand Draft" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){if($_SESSION['ServiceFee']['Amendment - Surrender']['paymeny_mode']=="Demand Draft")
	{echo " selected";}} ?>>Demand Draft</option>
<option value="Challan" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){if($_SESSION['ServiceFee']['Amendment - Surrender']['paymeny_mode']=="Challan")
	{echo " selected";}} ?>>Challan</option>
<option value="Cash Deposit" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){if($_SESSION['ServiceFee']['Amendment - Surrender']['paymeny_mode']=="Cash Deposit")
	{echo " selected";}} ?>>Cash Deposit</option>
<option value="Cheque" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){if($_SESSION['ServiceFee']['Amendment - Surrender']['paymeny_mode']=="Cheque")
	{echo " selected";}} ?>>Cheque</option>
<option value="Others" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){if($_SESSION['ServiceFee']['Amendment - Surrender']['paymeny_mode']=="Others")
	{echo " selected";}} ?>>Others</option></select></td>
	
	<td class="at"><select name="at[paymeny_mode]" class="form-control cri at" multiple="multiple">
<option value="Treasury Challan"<?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){if($_SESSION['ServiceFee']['Amendment - Transfer']['paymeny_mode']=="Treasury Challan")
	{echo " selected";}} ?> >Treasury Challan</option>
<option value="Internet Banking"<?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){if($_SESSION['ServiceFee']['Amendment - Transfer']['paymeny_mode']=="Internet Banking")
	{echo " selected";}} ?>>Internet Banking</option>
<option value="RTGS" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){if($_SESSION['ServiceFee']['Amendment - Transfer']['paymeny_mode']=="RTGS")
	{echo " selected";}} ?>>RTGS</option>
<option value="Debit Card" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){if($_SESSION['ServiceFee']['Amendment - Transfer']['paymeny_mode']=="Debit Card")
	{echo " selected";}} ?>>Debit Card</option>
<option value="Credit Card" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){if($_SESSION['ServiceFee']['Amendment - Transfer']['paymeny_mode']=="Credit Card")
	{echo " selected";}} ?>>Credit Card</option>
<option value="Wallets" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){if($_SESSION['ServiceFee']['Amendment - Transfer']['paymeny_mode']=="Wallets")
	{echo " selected";}} ?>>Wallets</option>
<option value="Demand Draft" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){if($_SESSION['ServiceFee']['Amendment - Transfer']['paymeny_mode']=="Demand Draft")
	{echo " selected";}} ?>>Demand Draft</option>
<option value="Challan" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){if($_SESSION['ServiceFee']['Amendment - Transfer']['paymeny_mode']=="Challan")
	{echo " selected";}} ?>>Challan</option>
<option value="Cash Deposit" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){if($_SESSION['ServiceFee']['Amendment - Transfer']['paymeny_mode']=="Cash Deposit")
	{echo " selected";}} ?>>Cash Deposit</option>
<option value="Cheque" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){if($_SESSION['ServiceFee']['Amendment - Transfer']['paymeny_mode']=="Cheque")
	{echo " selected";}} ?>>Cheque</option>
<option value="Others" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){if($_SESSION['ServiceFee']['Amendment - Transfer']['paymeny_mode']=="Others")
	{echo " selected";}} ?>>Others</option></select></td>
	
	<td class="duplicate"><select name="duplicate[paymeny_mode]" class="form-control cri duplicate" multiple="multiple">
<option value="Treasury Challan"<?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy '])){if($_SESSION['ServiceFee']['Duplicate Copy ']['paymeny_mode']=="Treasury Challan")
	{echo " selected";}} ?> >Treasury Challan</option>
<option value="Internet Banking"<?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy '])){if($_SESSION['ServiceFee']['Duplicate Copy ']['paymeny_mode']=="Internet Banking")
	{echo " selected";}} ?>>Internet Banking</option>
<option value="RTGS" <?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy '])){if($_SESSION['ServiceFee']['Duplicate Copy ']['paymeny_mode']=="RTGS")
	{echo " selected";}} ?>>RTGS</option>
<option value="Debit Card" <?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy '])){if($_SESSION['ServiceFee']['Duplicate Copy ']['paymeny_mode']=="Debit Card")
	{echo " selected";}} ?>>Debit Card</option>
<option value="Credit Card" <?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy '])){if($_SESSION['ServiceFee']['Duplicate Copy ']['paymeny_mode']=="Credit Card")
	{echo " selected";}} ?>>Credit Card</option>
<option value="Wallets" <?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy '])){if($_SESSION['ServiceFee']['Duplicate Copy ']['paymeny_mode']=="Wallets")
	{echo " selected";}} ?>>Wallets</option>
<option value="Demand Draft" <?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy '])){if($_SESSION['ServiceFee']['Duplicate Copy ']['paymeny_mode']=="Demand Draft")
	{echo " selected";}} ?>>Demand Draft</option>
<option value="Challan" <?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy '])){if($_SESSION['ServiceFee']['Duplicate Copy ']['paymeny_mode']=="Challan")
	{echo " selected";}} ?>>Challan</option>
<option value="Cash Deposit" <?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy '])){if($_SESSION['ServiceFee']['Duplicate Copy ']['paymeny_mode']=="Cash Deposit")
	{echo " selected";}} ?>>Cash Deposit</option>
<option value="Cheque" <?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy '])){if($_SESSION['ServiceFee']['Duplicate Copy ']['paymeny_mode']=="Cheque")
	{echo " selected";}} ?>>Cheque</option>
<option value="Others" <?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy '])){if($_SESSION['ServiceFee']['Duplicate Copy ']['paymeny_mode']=="Others")
	{echo " selected";}} ?>>Others</option></select></td>
	
	<td class="renewal"><select name="renewal[paymeny_mode]" class="form-control cri renewal" multiple="multiple">
<option value="Treasury Challan"<?php if(!empty($_SESSION['ServiceFee']['Renewal'])){if($_SESSION['ServiceFee']['Renewal']['paymeny_mode']=="Treasury Challan")
	{echo " selected";}} ?> >Treasury Challan</option>
<option value="Internet Banking"<?php if(!empty($_SESSION['ServiceFee']['Renewal'])){if($_SESSION['ServiceFee']['Renewal']['paymeny_mode']=="Internet Banking")
	{echo " selected";}} ?>>Internet Banking</option>
<option value="RTGS" <?php if(!empty($_SESSION['ServiceFee']['Renewal'])){if($_SESSION['ServiceFee']['Renewal']['paymeny_mode']=="RTGS")
	{echo " selected";}} ?>>RTGS</option>
<option value="Debit Card" <?php if(!empty($_SESSION['ServiceFee']['Renewal'])){if($_SESSION['ServiceFee']['Renewal']['paymeny_mode']=="Debit Card")
	{echo " selected";}} ?>>Debit Card</option>
<option value="Credit Card" <?php if(!empty($_SESSION['ServiceFee']['Renewal'])){if($_SESSION['ServiceFee']['Renewal']['paymeny_mode']=="Credit Card")
	{echo " selected";}} ?>>Credit Card</option>
<option value="Wallets" <?php if(!empty($_SESSION['ServiceFee']['Renewal'])){if($_SESSION['ServiceFee']['Renewal']['paymeny_mode']=="Wallets")
	{echo " selected";}} ?>>Wallets</option>
<option value="Demand Draft" <?php if(!empty($_SESSION['ServiceFee']['Renewal'])){if($_SESSION['ServiceFee']['Renewal']['paymeny_mode']=="Demand Draft")
	{echo " selected";}} ?>>Demand Draft</option>
<option value="Challan" <?php if(!empty($_SESSION['ServiceFee']['Renewal'])){if($_SESSION['ServiceFee']['Renewal']['paymeny_mode']=="Challan")
	{echo " selected";}} ?>>Challan</option>
<option value="Cash Deposit" <?php if(!empty($_SESSION['ServiceFee']['Renewal'])){if($_SESSION['ServiceFee']['Renewal']['paymeny_mode']=="Cash Deposit")
	{echo " selected";}} ?>>Cash Deposit</option>
<option value="Cheque" <?php if(!empty($_SESSION['ServiceFee']['Renewal'])){if($_SESSION['ServiceFee']['Renewal']['paymeny_mode']=="Cheque")
	{echo " selected";}} ?>>Cheque</option>
<option value="Others" <?php if(!empty($_SESSION['ServiceFee']['Renewal'])){if($_SESSION['ServiceFee']['Renewal']['paymeny_mode']=="Others")
	{echo " selected";}} ?>>Others</option></select></td>
	
	<td class="return"><select name="return[paymeny_mode]" class="form-control cri return" multiple="multiple">
<option value="Treasury Challan"<?php if(!empty($_SESSION['ServiceFee']['Return'])){if($_SESSION['ServiceFee']['Return']['paymeny_mode']=="Treasury Challan")
	{echo " selected";}} ?> >Treasury Challan</option>
<option value="Internet Banking"<?php if(!empty($_SESSION['ServiceFee']['Return'])){if($_SESSION['ServiceFee']['Return']['paymeny_mode']=="Internet Banking")
	{echo " selected";}} ?>>Internet Banking</option>
<option value="RTGS" <?php if(!empty($_SESSION['ServiceFee']['Return'])){if($_SESSION['ServiceFee']['Return']['paymeny_mode']=="RTGS")
	{echo " selected";}} ?>>RTGS</option>
<option value="Debit Card" <?php if(!empty($_SESSION['ServiceFee']['Return'])){if($_SESSION['ServiceFee']['Return']['paymeny_mode']=="Debit Card")
	{echo " selected";}} ?>>Debit Card</option>
<option value="Credit Card" <?php if(!empty($_SESSION['ServiceFee']['Return'])){if($_SESSION['ServiceFee']['Return']['paymeny_mode']=="Credit Card")
	{echo " selected";}} ?>>Credit Card</option>
<option value="Wallets" <?php if(!empty($_SESSION['ServiceFee']['Return'])){if($_SESSION['ServiceFee']['Return']['paymeny_mode']=="Wallets")
	{echo " selected";}} ?>>Wallets</option>
<option value="Demand Draft" <?php if(!empty($_SESSION['ServiceFee']['Return'])){if($_SESSION['ServiceFee']['Return']['paymeny_mode']=="Demand Draft")
	{echo " selected";}} ?>>Demand Draft</option>
<option value="Challan" <?php if(!empty($_SESSION['ServiceFee']['Return'])){if($_SESSION['ServiceFee']['Return']['paymeny_mode']=="Challan")
	{echo " selected";}} ?>>Challan</option>
<option value="Cash Deposit" <?php if(!empty($_SESSION['ServiceFee']['Return'])){if($_SESSION['ServiceFee']['Return']['paymeny_mode']=="Cash Deposit")
	{echo " selected";}} ?>>Cash Deposit</option>
<option value="Cheque" <?php if(!empty($_SESSION['ServiceFee']['Return'])){if($_SESSION['ServiceFee']['Return']['paymeny_mode']=="Cheque")
	{echo " selected";}} ?>>Cheque</option>
<option value="Others" <?php if(!empty($_SESSION['ServiceFee']['Return'])){if($_SESSION['ServiceFee']['Return']['paymeny_mode']=="Others")
	{echo " selected";}} ?>>Others</option></select></td>
	 
	<td class="maintainence"><select name="maintainence[paymeny_mode]" class="form-control cri maintainence" multiple="multiple">
<option value="Treasury Challan"<?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){if($_SESSION['ServiceFee']['Maintenance of Register']['paymeny_mode']=="Treasury Challan")
	{echo " selected";}} ?> >Treasury Challan</option>
<option value="Internet Banking"<?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){if($_SESSION['ServiceFee']['Maintenance of Register']['paymeny_mode']=="Internet Banking")
	{echo " selected";}} ?>>Internet Banking</option>
<option value="RTGS" <?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){if($_SESSION['ServiceFee']['Maintenance of Register']['paymeny_mode']=="RTGS")
	{echo " selected";}} ?>>RTGS</option>
<option value="Debit Card" <?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){if($_SESSION['ServiceFee']['Maintenance of Register']['paymeny_mode']=="Debit Card")
	{echo " selected";}} ?>>Debit Card</option>
<option value="Credit Card" <?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){if($_SESSION['ServiceFee']['Maintenance of Register']['paymeny_mode']=="Credit Card")
	{echo " selected";}} ?>>Credit Card</option>
<option value="Wallets" <?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){if($_SESSION['ServiceFee']['Maintenance of Register']['paymeny_mode']=="Wallets")
	{echo " selected";}} ?>>Wallets</option>
<option value="Demand Draft" <?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){if($_SESSION['ServiceFee']['Maintenance of Register']['paymeny_mode']=="Demand Draft")
	{echo " selected";}} ?>>Demand Draft</option>
<option value="Challan" <?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){if($_SESSION['ServiceFee']['Maintenance of Register']['paymeny_mode']=="Challan")
	{echo " selected";}} ?>>Challan</option>
<option value="Cash Deposit" <?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){if($_SESSION['ServiceFee']['Maintenance of Register']['paymeny_mode']=="Cash Deposit")
	{echo " selected";}} ?>>Cash Deposit</option>
<option value="Cheque" <?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){if($_SESSION['ServiceFee']['Maintenance of Register']['paymeny_mode']=="Cheque")
	{echo " selected";}} ?>>Cheque</option>
<option value="Others" <?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){if($_SESSION['ServiceFee']['Maintenance of Register']['paymeny_mode']=="Others")
	{echo " selected";}} ?>>Others</option></select></td>
	
	
                        </tr>

                           <tr>

                            <td>

                                <strong>If Treasury Challan Selected, then  Give Treasury Head Details</strong>

                            </td>
							
							<td class="acilppr"> <input type="text" class="form-control cri acilppr" name="acilppr[treasury_head_detail]" placeholder="Treasury Head Details" value="<?php if(!empty($_SESSION['ServiceFee']['service'])){ echo $_SESSION['ServiceFee']['service']['treasury_head_detail']; }?>"  /></td>
                             <td class="ao"> <input type="text" class="form-control cri ao" name="ao[treasury_head_detail]" placeholder="Treasury Head Details"
							 value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){ echo $_SESSION['ServiceFee']['Amendment - Others']['treasury_head_detail']; }?>"  /></td>
                            <td class="ac"> <input type="text" class="form-control cri ac" name="ac[treasury_head_detail]" placeholder="Treasury Head Details" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){ echo $_SESSION['ServiceFee']['Amendment - Cancellation']['treasury_head_detail']; }?>"  /></td>
                            <td class="as"> <input type="text" class="form-control cri as" name="as[treasury_head_detail]" placeholder="Treasury Head Details" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){ echo $_SESSION['ServiceFee']['Amendment - Surrender']['treasury_head_detail']; }?>"  /></td>
                            <td class="at"> <input type="text" class="form-control cri at" name="at[treasury_head_detail]" placeholder="Treasury Head Details" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){ echo $_SESSION['ServiceFee']['Amendment - Transfer']['treasury_head_detail']; }?>"  /></td>

                            <td class="duplicate"><input type="text" class="form-control cri duplicate" name="duplicate[treasury_head_detail]" placeholder="Treasury Head Details" value="<?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy'])){ echo $_SESSION['ServiceFee']['Duplicate Copy']['treasury_head_detail']; }?>"  /></td>

                            <td class="renewal"><input type="text" class="form-control cri renewal" name="renewal[treasury_head_detail]" placeholder="Treasury Head Details" value="<?php if(!empty($_SESSION['ServiceFee']['Renewal'])){ echo $_SESSION['ServiceFee']['Renewal']['treasury_head_detail']; }?>"  /></td>

                            <td class="return"><input type="text" class="form-control cri return" name="return[treasury_head_detail]" placeholder="Treasury Head Details" value="<?php if(!empty($_SESSION['ServiceFee']['Return'])){ echo $_SESSION['ServiceFee']['Return']['treasury_head_detail']; }?>"  /></td>

                            <td class="maintainence"><input type="text" class="form-control cri maintainence" name="maintainence[treasury_head_detail]" placeholder="Treasury Head Details"
							value="<?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){ echo $_SESSION['ServiceFee']['Maintenance of Register']['treasury_head_detail']; }?>"  /></td>

                            
                       
                        </tr>
						
						
						<tr>

                            <td>

                                <strong>Treasury Head in E-Kosh</strong>

                            </td>

                            <td class="acilppr"><select name="acilppr[treasury_head_ekosh]" class="acilppr form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
							<td class="ao"><select name="ao[treasury_head_ekosh]" class="ao form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee ']['service'])){if($_SESSION['ServiceFee']['service']['treasury_head_ekosh']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['service'])){if($_SESSION['ServiceFee']['service']['treasury_head_ekosh']=="N"){echo " selected";}} ?>>No</option>
		
							</select></td>

                            <td class="ac"><select name="ac[treasury_head_ekosh]" class="ac  form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){if($_SESSION['ServiceFee']['Amendment - Cancellation']['treasury_head_ekosh']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){if($_SESSION['ServiceFee']['Amendment - Cancellation']['treasury_head_ekosh']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="as"><select name="as[treasury_head_ekosh]" class="as form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){if($_SESSION['ServiceFee']['Amendment - Surrender']['treasury_head_ekosh']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){if($_SESSION['ServiceFee']['Amendment - Surrender']['treasury_head_ekosh']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="at"><select name="at[treasury_head_ekosh]" class="at form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){if($_SESSION['ServiceFee']['Amendment - Transfer']['treasury_head_ekosh']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){if($_SESSION['ServiceFee']['Amendment - Transfer']['treasury_head_ekosh']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="duplicate"><select name="duplicate[treasury_head_ekosh]" class="duplicate form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy'])){if($_SESSION['ServiceFee']['Duplicate Copy']['treasury_head_ekosh']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy'])){if($_SESSION['ServiceFee']['Duplicate Copy']['treasury_head_ekosh']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="renewal"><select name="renewal[treasury_head_ekosh]" class="renewal form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Renewal'])){if($_SESSION['ServiceFee']['Renewal']['treasury_head_ekosh']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceFee']['Renewal'])){if($_SESSION['ServiceFee']['Renewal']['treasury_head_ekosh']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="return"><select name="return[treasury_head_ekosh]" class="return form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Return'])){if($_SESSION['ServiceFee']['Return']['treasury_head_ekosh']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceFee']['Return'])){if($_SESSION['ServiceFee']['Return']['treasury_head_ekosh']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="maintainence"><select name="maintainence[treasury_head_ekosh]" class="maintainence form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){if($_SESSION['ServiceFee']['Maintenance of Register']['treasury_head_ekosh']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){if($_SESSION['ServiceFee']['Maintenance of Register']['treasury_head_ekosh']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                        </tr>

                        <tr>

                            <td>

                                <strong>Bank Details [Account Holder Name]</strong>

                            </td>
							
							<td class="acilppr"> <input type="text" class="form-control cri acilppr" name="acilppr[bank_account_holder_name]" placeholder="A/C Holder Name" value="<?php if(!empty($_SESSION['ServiceFee']['service'])){ echo $_SESSION['ServiceFee']['service']['bank_account_holder_name']; }?>"  /></td>
                             <td class="ao"> <input type="text" class="form-control cri ao" name="ao[bank_account_holder_name]" placeholder="A/C Holder Name"
							 value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){ echo $_SESSION['ServiceFee']['Amendment - Others']['bank_account_holder_name']; }?>"  /></td>
                            <td class="ac"> <input type="text" class="form-control cri ac" name="ac[bank_account_holder_name]" placeholder="A/C Holder Name" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){ echo $_SESSION['ServiceFee']['Amendment - Cancellation']['bank_account_holder_name']; }?>"  /></td>
                            <td class="as"> <input type="text" class="form-control cri as" name="as[bank_account_holder_name]" placeholder="A/C Holder Name" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){ echo $_SESSION['ServiceFee']['Amendment - Surrender']['bank_account_holder_name']; }?>"  /></td>
                            <td class="at"> <input type="text" class="form-control cri at" name="at[bank_account_holder_name]" placeholder="A/C Holder Name" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){ echo $_SESSION['ServiceFee']['Amendment - Transfer']['bank_account_holder_name']; }?>"  /></td>

                            <td class="duplicate"><input type="text" class="form-control cri duplicate" name="duplicate[bank_account_holder_name]" placeholder="A/C Holder Name" value="<?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy'])){ echo $_SESSION['ServiceFee']['Duplicate Copy']['bank_account_holder_name']; }?>"  /></td>

                            <td class="renewal"><input type="text" class="form-control cri renewal" name="renewal[bank_account_holder_name]" placeholder="A/C Holder Name" value="<?php if(!empty($_SESSION['ServiceFee']['Renewal'])){ echo $_SESSION['ServiceFee']['Renewal']['bank_account_holder_name']; }?>"  /></td>

                            <td class="return"><input type="text" class="form-control cri return" name="return[bank_account_holder_name]" placeholder="A/C Holder Name" value="<?php if(!empty($_SESSION['ServiceFee']['Return'])){ echo $_SESSION['ServiceFee']['Return']['bank_account_holder_name']; }?>"  /></td>

                            <td class="maintainence"><input type="text" class="form-control cri maintainence" name="maintainence[bank_account_holder_name]" placeholder="A/C Holder Name"
							value="<?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){ echo $_SESSION['ServiceFee']['Maintenance of Register']['bank_account_holder_name']; }?>"  /></td>

                           
                        </tr>



                                            <tr>

                            <td>

                                <strong>Bank Account Number</strong>

                            </td>
							
							<td class="acilppr"> <input type="text" class="form-control cri acilppr" name="acilppr[bank_account_number]" placeholder="Account Number" value="<?php if(!empty($_SESSION['ServiceFee']['service'])){ echo $_SESSION['ServiceFee']['service']['bank_account_number']; }?>"  /></td>
                             <td class="ao"> <input type="text" class="form-control cri ao" name="ao[bank_account_number]" placeholder="Account Number"
							 value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){ echo $_SESSION['ServiceFee']['Amendment - Others']['bank_account_number']; }?>"  /></td>
                            <td class="ac"> <input type="text" class="form-control cri ac" name="ac[bank_account_number]" placeholder="Account Number" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){ echo $_SESSION['ServiceFee']['Amendment - Cancellation']['bank_account_number']; }?>"  /></td>
                            <td class="as"> <input type="text" class="form-control cri as" name="as[bank_account_number]" placeholder="Account Number" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){ echo $_SESSION['ServiceFee']['Amendment - Surrender']['bank_account_number']; }?>"  /></td>
                            <td class="at"> <input type="text" class="form-control cri at" name="at[bank_account_number]" placeholder="Account Number" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){ echo $_SESSION['ServiceFee']['Amendment - Transfer']['bank_account_number']; }?>"  /></td>

                            <td class="duplicate"><input type="text" class="form-control cri duplicate" name="duplicate[bank_account_number]" placeholder="Account Number" value="<?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy'])){ echo $_SESSION['ServiceFee']['Duplicate Copy']['bank_account_number']; }?>"  /></td>

                            <td class="renewal"><input type="text" class="form-control cri renewal" name="renewal[bank_account_number]" placeholder="Account Number" value="<?php if(!empty($_SESSION['ServiceFee']['Renewal'])){ echo $_SESSION['ServiceFee']['Renewal']['bank_account_number']; }?>"  /></td>

                            <td class="return"><input type="text" class="form-control cri return" name="return[bank_account_number]" placeholder="Account Number" value="<?php if(!empty($_SESSION['ServiceFee']['Return'])){ echo $_SESSION['ServiceFee']['Return']['bank_account_number']; }?>"  /></td>

                            <td class="maintainence"><input type="text" class="form-control cri maintainence" name="maintainence[bank_account_number]" placeholder="Account Number"
							value="<?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){ echo $_SESSION['ServiceFee']['Maintenance of Register']['bank_account_number']; }?>"  /></td>

                        </tr>

                        <tr>

                            <td>

                                <strong>Bank Name </strong>

                            </td>
							
							<td class="acilppr"> <input type="text" class="form-control cri acilppr" name="acilppr[bank_name]" placeholder="Bank Name" value="<?php if(!empty($_SESSION['ServiceFee']['service'])){ echo $_SESSION['ServiceFee']['service']['bank_name']; }?>"  /></td>
                             <td class="ao"> <input type="text" class="form-control cri ao" name="ao[bank_name]" placeholder="Bank Name"
							 value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){ echo $_SESSION['ServiceFee']['Amendment - Others']['bank_name']; }?>"  /></td>
                            <td class="ac"> <input type="text" class="form-control cri ac" name="ac[bank_name]" placeholder="Bank Name" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){ echo $_SESSION['ServiceFee']['Amendment - Cancellation']['bank_name']; }?>"  /></td>
                            <td class="as"> <input type="text" class="form-control cri as" name="as[bank_name]" placeholder="Bank Name" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){ echo $_SESSION['ServiceFee']['Amendment - Surrender']['bank_name']; }?>"  /></td>
                            <td class="at"> <input type="text" class="form-control cri at" name="at[bank_name]" placeholder="Bank Name" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){ echo $_SESSION['ServiceFee']['Amendment - Transfer']['bank_name']; }?>"  /></td>

                            <td class="duplicate"><input type="text" class="form-control cri duplicate" name="duplicate[bank_name]" placeholder="Bank Name" value="<?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy'])){ echo $_SESSION['ServiceFee']['Duplicate Copy']['bank_name']; }?>"  /></td>

                            <td class="renewal"><input type="text" class="form-control cri renewal" name="renewal[bank_name]" placeholder="Bank Name" value="<?php if(!empty($_SESSION['ServiceFee']['Renewal'])){ echo $_SESSION['ServiceFee']['Renewal']['bank_name']; }?>"  /></td>

                            <td class="return"><input type="text" class="form-control cri return" name="return[bank_name]" placeholder="Bank Name" value="<?php if(!empty($_SESSION['ServiceFee']['Return'])){ echo $_SESSION['ServiceFee']['Return']['bank_name']; }?>"  /></td>

                            <td class="maintainence"><input type="text" class="form-control cri maintainence" name="maintainence[bank_name]" placeholder="Bank Name"
							value="<?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){ echo $_SESSION['ServiceFee']['Maintenance of Register']['bank_name']; }?>"  /></td>

                        </tr>

                           <tr>

                            <td><strong>Bank IFSC Code</strong></td>
							
							<td class="acilppr"> <input type="text" class="form-control cri acilppr" name="acilppr[bank_ifsc_code]" placeholder="IFSC Code" value="<?php if(!empty($_SESSION['ServiceFee']['service'])){ echo $_SESSION['ServiceFee']['service']['bank_ifsc_code']; }?>"  /></td>
                             <td class="ao"> <input type="text" class="form-control cri ao" name="ao[bank_ifsc_code]" placeholder="IFSC Code"
							 value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){ echo $_SESSION['ServiceFee']['Amendment - Others']['bank_ifsc_code']; }?>"  /></td>
                            <td class="ac"> <input type="text" class="form-control cri ac" name="ac[bank_ifsc_code]" placeholder="IFSC Code" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){ echo $_SESSION['ServiceFee']['Amendment - Cancellation']['bank_ifsc_code']; }?>"  /></td>
                            <td class="as"> <input type="text" class="form-control cri as" name="as[bank_ifsc_code]" placeholder="IFSC Code" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){ echo $_SESSION['ServiceFee']['Amendment - Surrender']['bank_ifsc_code']; }?>"  /></td>
                            <td class="at"> <input type="text" class="form-control cri at" name="at[bank_ifsc_code]" placeholder="IFSC Code" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){ echo $_SESSION['ServiceFee']['Amendment - Transfer']['bank_ifsc_code']; }?>"  /></td>

                            <td class="duplicate"><input type="text" class="form-control cri duplicate" name="duplicate[bank_ifsc_code]" placeholder="IFSC Code" value="<?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy'])){ echo $_SESSION['ServiceFee']['Duplicate Copy']['bank_ifsc_code']; }?>"  /></td>

                            <td class="renewal"><input type="text" class="form-control cri renewal" name="renewal[bank_ifsc_code]" placeholder="IFSC Code" value="<?php if(!empty($_SESSION['ServiceFee']['Renewal'])){ echo $_SESSION['ServiceFee']['Renewal']['bank_ifsc_code']; }?>"  /></td>

                            <td class="return"><input type="text" class="form-control cri return" name="return[bank_ifsc_code]" placeholder="IFSC Code" value="<?php if(!empty($_SESSION['ServiceFee']['Return'])){ echo $_SESSION['ServiceFee']['Return']['bank_ifsc_code']; }?>"  /></td>

                            <td class="maintainence"><input type="text" class="form-control cri maintainence" name="maintainence[bank_ifsc_code]" placeholder="IFSC Code"
							value="<?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){ echo $_SESSION['ServiceFee']['Maintenance of Register']['bank_ifsc_code']; }?>"  /></td>

                         </tr>



                            <tr>

                            <td>

                                <strong>Any Deposit Taken</strong>

                            </td>

                             <td class="acilppr"><select onchange='hide("acilppr[deposit_condition]","acilppr[any_deposit_token]")' name="acilppr[any_deposit_token]"  class="form-control cri acilppr">
							 <option value="Y" <?php if(!empty($_SESSION['ServiceFee']['service'])){if($_SESSION['ServiceFee']['service']['any_deposit_token']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['service'])){if($_SESSION['ServiceFee']['service']['any_deposit_token']=="N"){echo " selected";}} ?>>No</option>
		
							 </select></td>
<td class="ao"><select onchange='hide("ao[deposit_condition]","ao[any_deposit_token]")' name="ao[any_deposit_token]" class="form-control cri" ac>
<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){if($_SESSION['ServiceFee']['Amendment - Others']['any_deposit_token']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){if($_SESSION['ServiceFee']['Amendment - Others']['any_deposit_token']=="N"){echo " selected";}} ?>>No</option>
</select></td>
                            <td class="ac"><select onchange='hide("ac[deposit_condition]","ac[any_deposit_token]")' name="ac[any_deposit_token]" class="form-control cri" ac>
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){if($_SESSION['ServiceFee']['Amendment - Cancellation']['any_deposit_token']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){if($_SESSION['ServiceFee']['Amendment - Cancellation']['any_deposit_token']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="as"><select onchange='hide("as[deposit_condition]","as[any_deposit_token]")' name="as[any_deposit_token]" class="form-control cri" as>
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){if($_SESSION['ServiceFee']['Amendment - Surrender']['any_deposit_token']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){if($_SESSION['ServiceFee']['Amendment - Surrender']['any_deposit_token']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="at"><select onchange='hide("at[deposit_condition]","at[any_deposit_token]")' name="at[any_deposit_token]" class="form-control cri" at>
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){if($_SESSION['ServiceFee']['Amendment - Transfer']['any_deposit_token']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){if($_SESSION['ServiceFee']['Amendment - Transfer']['any_deposit_token']=="N"){echo " selected";}} ?>>No</option></select></td>

                            <td class="duplicate"><select onchange='hide("duplicate[deposit_condition]","duplicate[any_deposit_token]")' name="duplicate[any_deposit_token]" class="form-control cri duplicate">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy'])){if($_SESSION['ServiceFee']['Duplicate Copy']['any_deposit_token']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy'])){if($_SESSION['ServiceFee']['Duplicate Copy']['any_deposit_token']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="renewal"><select onchange='hide("renewal[deposit_condition]","renewal[any_deposit_token]")' name="renewal[any_deposit_token]" class="form-control cri renewal"><option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Renewal'])){if($_SESSION['ServiceFee']['Renewal']['any_deposit_token']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceFee']['Renewal'])){if($_SESSION['ServiceFee']['Renewal']['any_deposit_token']=="N"){echo " selected";}} ?>>No</option></select></td>

                            <td class="return"><select onchange='hide("return[deposit_condition]","return[any_deposit_token]")' name="return[any_deposit_token]" class="form-control cri return"><option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Return'])){if($_SESSION['ServiceFee']['Return']['any_deposit_token']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceFee']['Return'])){if($_SESSION['ServiceFee']['Return']['any_deposit_token']=="N"){echo " selected";}} ?>>No</option></select></td>

                            <td class="maintainence"><select onchange='hide("maintainence[deposit_condition]","maintainence[any_deposit_token]")' name="maintainence[any_deposit_token]" class="form-control cri maintainence">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){if($_SESSION['ServiceFee']['Maintenance of Register']['any_deposit_token']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){if($_SESSION['ServiceFee']['Maintenance of Register']['any_deposit_token']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                           </tr>



                                   <tr>

                            <td>

                                <strong>If Y, then give Conditions</strong>

                            </td>
							
							<td class="acilppr"> <input type="text" class="form-control cri acilppr" name="acilppr[deposit_condition]" placeholder="Deposit Condition" value="<?php if(!empty($_SESSION['ServiceFee']['service'])){ echo $_SESSION['ServiceFee']['service']['deposit_condition']; }?>"  /></td>
                             <td class="ao"> <input type="text" class="form-control cri ao" name="ao[deposit_condition]" placeholder="Deposit Condition"
							 value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){ echo $_SESSION['ServiceFee']['Amendment - Others']['deposit_condition']; }?>"  /></td>
                            <td class="ac"> <input type="text" class="form-control cri ac" name="ac[deposit_condition]" placeholder="Deposit Condition" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){ echo $_SESSION['ServiceFee']['Amendment - Cancellation']['deposit_condition']; }?>"  /></td>
                            <td class="as"> <input type="text" class="form-control cri as" name="as[deposit_condition]" placeholder="Deposit Condition" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){ echo $_SESSION['ServiceFee']['Amendment - Surrender']['deposit_condition']; }?>"  /></td>
                            <td class="at"> <input type="text" class="form-control cri at" name="at[deposit_condition]" placeholder="Deposit Condition" value="<?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){ echo $_SESSION['ServiceFee']['Amendment - Transfer']['deposit_condition']; }?>"  /></td>

                            <td class="duplicate"><input type="text" class="form-control cri duplicate" name="duplicate[deposit_condition]" placeholder="Deposit Condition" value="<?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy'])){ echo $_SESSION['ServiceFee']['Duplicate Copy']['deposit_condition']; }?>"  /></td>

                            <td class="renewal"><input type="text" class="form-control cri renewal" name="renewal[deposit_condition]" placeholder="Deposit Condition" value="<?php if(!empty($_SESSION['ServiceFee']['Renewal'])){ echo $_SESSION['ServiceFee']['Renewal']['deposit_condition']; }?>"  /></td>

                            <td class="return"><input type="text" class="form-control cri return" name="return[deposit_condition]" placeholder="Deposit Condition" value="<?php if(!empty($_SESSION['ServiceFee']['Return'])){ echo $_SESSION['ServiceFee']['Return']['deposit_condition']; }?>"  /></td>

                            <td class="maintainence"><input type="text" class="form-control cri maintainence" name="maintainence[deposit_condition]" placeholder="Deposit Condition"
							value="<?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){ echo $_SESSION['ServiceFee']['Maintenance of Register']['deposit_condition']; }?>"  /></td>


                              
                        </tr>

                        <tr>

                            <td>

                                <strong>Is Deposit Taken in the form of NSC</strong>

                            </td>

                           <td class="acilppr"><select onchange='hide("acilppr[conditions]","acilppr[nsc_deposit_token]")' name="acilppr[nsc_deposit_token]"  class="form-control cri acilppr">
						   <option value="Y" <?php if(!empty($_SESSION['ServiceFee']['service'])){if($_SESSION['ServiceFee']['service']['nsc_deposit_token']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['service'])){if($_SESSION['ServiceFee']['service']['nsc_deposit_token']=="N"){echo " selected";}} ?>>No</option>
		
						   </select></td>
						   
<td class="ao"><select onchange='hide("ao[conditions]","ao[nsc_deposit_token]")' name="ao[nsc_deposit_token]" class="form-control cri" aisct>
<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){if($_SESSION['ServiceFee']['Amendment - Others']['nsc_deposit_token']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){if($_SESSION['ServiceFee']['Amendment - Others']['nsc_deposit_token']=="N"){echo " selected";}} ?>>No</option>
</select></td>
                            <td class="ac"><select onchange='hide("ac[conditions]","ac[nsc_deposit_token]")' name="ac[nsc_deposit_token]" class="form-control cri" aisct>
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){if($_SESSION['ServiceFee']['Amendment - Cancellation']['nsc_deposit_token']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){if($_SESSION['ServiceFee']['Amendment - Cancellation']['nsc_deposit_token']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="as"><select onchange='hide("as[conditions]","as[nsc_deposit_token]")' name="as[nsc_deposit_token]" class="form-control cri" aisct>
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){if($_SESSION['ServiceFee']['Amendment - Surrender']['nsc_deposit_token']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){if($_SESSION['ServiceFee']['Amendment - Surrender']['nsc_deposit_token']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="at"><select onchange='hide("at[conditions]","at[nsc_deposit_token]")' name="at[nsc_deposit_token]" class="form-control cri" aisct>
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){if($_SESSION['ServiceFee']['Amendment - Transfer']['nsc_deposit_token']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){if($_SESSION['ServiceFee']['Amendment - Transfer']['nsc_deposit_token']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="duplicate"><select onchange='hide("duplicate[conditions]","duplicate[nsc_deposit_token]")' name="duplicate[nsc_deposit_token]" class="form-control cri duplicate">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy'])){if($_SESSION['ServiceFee']['Duplicate Copy']['nsc_deposit_token']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy'])){if($_SESSION['ServiceFee']['Duplicate Copy']['nsc_deposit_token']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="renewal"><select onchange='hide("renewal[conditions]","renewal[nsc_deposit_token]")' name="renewal[nsc_deposit_token]" class="form-control cri renewal"><option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Renewal'])){if($_SESSION['ServiceFee']['Renewal']['nsc_deposit_token']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceFee']['Renewal'])){if($_SESSION['ServiceFee']['Renewal']['nsc_deposit_token']=="N"){echo " selected";}} ?>>No</option></select></td>

                            <td class="return"><select onchange='hide("return[conditions]","return[nsc_deposit_token]")' name="return[nsc_deposit_token]" class="form-control cri return"><option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Return'])){if($_SESSION['ServiceFee']['Return']['nsc_deposit_token']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceFee']['Return'])){if($_SESSION['ServiceFee']['Return']['nsc_deposit_token']=="N"){echo " selected";}} ?>>No</option></select></td>

                            <td class="maintainence"><select onchange='hide("maintainence[conditions]","maintainence[nsc_deposit_token]")' name="maintainence[nsc_deposit_token]" class="form-control cri maintainence">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){if($_SESSION['ServiceFee']['Maintenance of Register']['nsc_deposit_token']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){if($_SESSION['ServiceFee']['Maintenance of Register']['nsc_deposit_token']=="N"){echo " selected";}} ?>>No</option>
							</select></td>





                        </tr>



                        <tr><td><strong>If Y, then give Conditions</strong></td>

                            <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilppr[conditions]" ></td>
                            <td class="ao"> <input type="file" class="form-control cri ao" name="ao[conditions]" ></td>
                            <td class="ac"> <input type="file" class="form-control cri ac" name="ac[conditions]" ></td>
                            <td class="as"> <input type="file" class="form-control cri as" name="as[conditions]" ></td>
                            <td class="at"> <input type="file" class="form-control cri at" name="at[conditions]" ></td>

                            <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[conditions]" ></td>

                            <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[conditions]" ></td>

                            <td class="return"><input type="file" class="form-control cri return" name="return[conditions]" ></td>

                            <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[conditions]" ></td>

                         </tr>


<tr>

                            <td>

                                <strong>Payment Compulsory</strong>

                            </td>

                            <td class="acilppr"><select name="acilppr[payment_compulsory]" class="acilppr form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
							<td class="ao"><select name="ao[payment_compulsory]" class="ao form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee ']['service'])){if($_SESSION['ServiceFee']['service']['payment_compulsory']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['service'])){if($_SESSION['ServiceFee']['service']['payment_compulsory']=="N"){echo " selected";}} ?>>No</option>
		
							</select></td>

                            <td class="ac"><select name="ac[payment_compulsory]" class="ac  form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){if($_SESSION['ServiceFee']['Amendment - Cancellation']['payment_compulsory']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){if($_SESSION['ServiceFee']['Amendment - Cancellation']['payment_compulsory']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="as"><select name="as[payment_compulsory]" class="as form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){if($_SESSION['ServiceFee']['Amendment - Surrender']['payment_compulsory']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){if($_SESSION['ServiceFee']['Amendment - Surrender']['payment_compulsory']=="N"){echo " selected";}} ?>>No</option>
							</select></td>
                            <td class="at"><select name="at[payment_compulsory]" class="at form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){if($_SESSION['ServiceFee']['Amendment - Transfer']['payment_compulsory']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){if($_SESSION['ServiceFee']['Amendment - Transfer']['payment_compulsory']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="duplicate"><select name="duplicate[payment_compulsory]" class="duplicate form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy'])){if($_SESSION['ServiceFee']['Duplicate Copy']['payment_compulsory']=="Y"){echo " selected";}} ?>>Yes</option>
<option value="N" <?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy'])){if($_SESSION['ServiceFee']['Duplicate Copy']['payment_compulsory']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="renewal"><select name="renewal[payment_compulsory]" class="renewal form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Renewal'])){if($_SESSION['ServiceFee']['Renewal']['payment_compulsory']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceFee']['Renewal'])){if($_SESSION['ServiceFee']['Renewal']['payment_compulsory']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="return"><select name="return[payment_compulsory]" class="return form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Return'])){if($_SESSION['ServiceFee']['Return']['payment_compulsory']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceFee']['Return'])){if($_SESSION['ServiceFee']['Return']['payment_compulsory']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                            <td class="maintainence"><select name="maintainence[payment_compulsory]" class="maintainence form-control cri">
							<option value="Y" <?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){if($_SESSION['ServiceFee']['Maintenance of Register']['payment_compulsory']=="Y"){echo " selected";}} ?> >Yes</option><option value="N"  <?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){if($_SESSION['ServiceFee']['Maintenance of Register']['payment_compulsory']=="N"){echo " selected";}} ?>>No</option>
							</select></td>

                        </tr>
                          

                        <tr>

                            <td><strong>Comments </strong></td>
							
							<td class="acilppr"><textarea name="acilppr[comment]" class="form-control cri" ><?php if(!empty($_SESSION['ServiceFee']['service'])){ echo $_SESSION['ServiceFee']['service']['comment']; }?></textarea></td>
							 <td class="ao"><textarea name="ao[comment]" class="form-control cri" ><?php if(!empty($_SESSION['ServiceFee']['Amendment - Others'])){ echo $_SESSION['ServiceFee']['Amendment - Others']['comment']; }?></textarea></td>
                            <td class="ac"><textarea name="ac[comment]" class="form-control cri" ><?php if(!empty($_SESSION['ServiceFee']['Amendment - Cancellation'])){ echo $_SESSION['ServiceFee']['Amendment - Cancellation']['comment']; }?></textarea></td>
                            <td class="as"><textarea name="as[comment]" class="form-control cri" ><?php if(!empty($_SESSION['ServiceFee']['Amendment - Surrender'])){ echo $_SESSION['ServiceFee']['Amendment - Surrender']['comment']; }?></textarea></td>
                            <td class="at"><textarea name="at[comment]" class="form-control cri" ><?php if(!empty($_SESSION['ServiceFee']['Amendment - Transfer'])){ echo $_SESSION['ServiceFee']['Amendment - Transfer']['comment']; }?></textarea></td>
                            <td class="duplicate"><textarea name="duplicate[comment]" class="form-control cri" ><?php if(!empty($_SESSION['ServiceFee']['Duplicate Copy'])){ echo $_SESSION['ServiceFee']['Duplicate Copy']['comment']; }?></textarea></td>
                            <td class="renewal"><textarea name="renewal[comment]" class="form-control cri" ><?php if(!empty($_SESSION['ServiceFee']['Renewal'])){ echo $_SESSION['ServiceFee']['Renewal']['comment']; }?></textarea></td>
                            <td class="return"><textarea name="return[comment]" class="form-control cri" ><?php if(!empty($_SESSION['ServiceFee']['Return'])){ echo $_SESSION['ServiceFee']['Return']['comment']; }?></textarea></td>
                            <td class="maintainence"><textarea name="maintainence[comment]" class="form-control cri" ><?php if(!empty($_SESSION['ServiceFee']['Maintenance of Register'])){ echo $_SESSION['ServiceFee']['Maintenance of Register']['comment']; }?></textarea></td>
							
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



