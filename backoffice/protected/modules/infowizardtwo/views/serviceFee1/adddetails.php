  <?php $allsubservices=explode(",",$serviceData['additional_sub_service']);?>                

<style>

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

</style>

<div class="portlet-body">

                                        <div class="mt-element-step">

                                            

                                            <div class="row step-thin">

                                               

                                                <div class="col-md-2 bg-grey  mt-step-col ">

                                                    <div class="mt-step-number bg-white font-grey">1</div>

                                                    <div class="mt-step-title uppercase font-grey-cascade">Master</div>

                                                    <div class="mt-step-content font-grey-cascade"> Form</div>

                                                </div>

                                                <div class="col-md-3 bg-grey  mt-step-col ">

                                                    <div class="mt-step-number bg-white font-grey">2</div>

                                                    <div class="mt-step-title uppercase font-grey-cascade">Parameter</div>

                                                    <div class="mt-step-content font-grey-cascade"> Form</div>

                                                </div>

                                                <div class="col-md-3 bg-grey  mt-step-col ">

                                                    <div class="mt-step-number bg-white font-grey">3</div>

                                                    <div class="mt-step-title uppercase font-grey-cascade">Inspection </div>

                                                    <div class="mt-step-content font-grey-cascade">Form</div>

                                                </div>

                                                <div class="col-md-2 bg-grey mt-step-col done active">

                                                    <div class="mt-step-number bg-white font-grey">4</div>

                                                    <div class="mt-step-title uppercase font-grey-cascade">Fee</div>

                                                    <div class="mt-step-content font-grey-cascade">Form</div>

                                                </div>

                                                <div class="col-md-2 bg-grey mt-step-col">

                                                    <div class="mt-step-number bg-white font-grey">5</div>

                                                    <div class="mt-step-title uppercase font-grey-cascade">Other </div>

                                                    <div class="mt-step-content font-grey-cascade">  Options</div>

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

                            <td class="acilppr"><select name="acilppr[is_fee_submitted]" onchange='hide("acilppr[add_condition],acilppr[fee_detail],acilppr[upload_fee_structure],acilppr[conditions],acilppr[nsc_deposit_token],acilppr[deposit_condition],acilppr[any_deposit_token],acilppr[bank_ifsc_code],acilppr[bank_name],acilppr[bank_account_number],acilppr[bank_account_holder_name],acilppr[trasary_head_detail],acilppr[paymeny_mode],acilppr[upload_fee_structure]","acilppr[is_fee_submitted]")' class="acilppr form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="ac"><select name="ac[is_fee_submitted]" onchange='hide("ac[add_condition],ac[fee_detail],ac[upload_fee_structure],ac[conditions],ac[nsc_deposit_token],ac[deposit_condition],ac[any_deposit_token],ac[bank_ifsc_code],ac[bank_name],ac[bank_account_number],ac[bank_account_holder_name],ac[trasary_head_detail],ac[paymeny_mode],ac[upload_fee_structure]","ac[is_fee_submitted]")' class="ac form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="as"><select name="as[is_fee_submitted]" onchange='hide("as[add_condition],as[fee_detail],as[upload_fee_structure],as[conditions],as[nsc_deposit_token],as[deposit_condition],as[any_deposit_token],as[bank_ifsc_code],as[bank_name],as[bank_account_number],as[bank_account_holder_name],as[trasary_head_detail],as[paymeny_mode],as[upload_fee_structure]","as[is_fee_submitted]")' class="as form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="at"><select name="at[is_fee_submitted]" onchange='hide("at[add_condition],at[fee_detail],at[upload_fee_structure],at[conditions],at[nsc_deposit_token],at[deposit_condition],at[any_deposit_token],at[bank_ifsc_code],at[bank_name],at[bank_account_number],at[bank_account_holder_name],at[trasary_head_detail],at[paymeny_mode],at[upload_fee_structure]","at[is_fee_submitted]")' class="at form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="duplicate"><select name="duplicate[is_fee_submitted]" onchange='hide("duplicate[add_condition],duplicate[fee_detail],duplicate[upload_fee_structure],duplicate[conditions],duplicate[nsc_deposit_token],duplicate[deposit_condition],duplicate[any_deposit_token],duplicate[bank_ifsc_code],duplicate[bank_name],duplicate[bank_account_number],duplicate[bank_account_holder_name],duplicate[trasary_head_detail],duplicate[paymeny_mode],duplicate[upload_fee_structure]","duplicate[is_fee_submitted]")' class="duplicate form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="renewal"><select name="renewal[is_fee_submitted]" onchange='hide("renewal[add_condition],renewal[fee_detail],renewal[upload_fee_structure],renewal[conditions],renewal[nsc_deposit_token],renewal[deposit_condition],renewal[any_deposit_token],renewal[bank_ifsc_code],renewal[bank_name],renewal[bank_account_number],renewal[bank_account_holder_name],renewal[trasary_head_detail],renewal[paymeny_mode],renewal[upload_fee_structure]","renewal[is_fee_submitted]")' class="renewal form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="return"><select name="return[is_fee_submitted]" onchange='hide("return[add_condition],return[fee_detail],return[upload_fee_structure],return[conditions],return[nsc_deposit_token],return[deposit_condition],return[any_deposit_token],return[bank_ifsc_code],return[bank_name],return[bank_account_number],return[bank_account_holder_name],return[trasary_head_detail],return[paymeny_mode],return[upload_fee_structure]","return[is_fee_submitted]")' class="return form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="maintainence"><select name="maintainence[is_fee_submitted]" onchange='hide("maintainence[add_condition],maintainence[fee_detail],maintainence[upload_fee_structure],maintainence[conditions],maintainence[nsc_deposit_token],maintainence[deposit_condition],maintainence[any_deposit_token],maintainence[bank_ifsc_code],maintainence[bank_name],maintainence[bank_account_number],maintainence[bank_account_holder_name],maintainence[trasary_head_detail],maintainence[paymeny_mode],maintainence[upload_fee_structure]","maintainence[is_fee_submitted]")' class="maintainence form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                        </tr>

                        <tr>

                            <td>

                                <strong>If Y, Add Condition</strong>

                            </td>

                             <td class="acilppr"> <input type="text" class="form-control cri acilppr" name="acilppr[add_condition]" placeholder="Conditions"></td>

                            <td class="ac"> <input type="text" class="form-control cri ac" name="ac[add_condition]" placeholder="Conditions"></td>
                            <td class="as"> <input type="text" class="form-control cri as" name="as[add_condition]" placeholder="Conditions"></td>
                            <td class="at"> <input type="text" class="form-control cri at" name="at[add_condition]" placeholder="Conditions"></td>

                            <td class="duplicate"><input type="text" class="form-control cri duplicate" name="duplicate[add_condition]" placeholder="Conditions"></td>

                            <td class="renewal"><input type="text" class="form-control cri renewal" name="renewal[add_condition]" placeholder="Conditions"></td>

                            <td class="return"><input type="text" class="form-control cri return" name="return[add_condition]" placeholder="Conditions"></td>

                            <td class="maintainence"><input type="text" class="form-control cri maintainence" name="maintainence[add_condition]" placeholder="Conditions"></td>

                      

                        </tr>

                         <tr>

                            <td><strong>If Y, Add Fee Details in INR</strong></td>

                           <td class="acilppr"> <input type="text" class="form-control cri acilppr" name="acilppr[fee_detail]" placeholder="INR"></td>

                            <td class="ac"> <input type="text" class="form-control cri aisct" name="ac[fee_detail]" placeholder="INR"></td>
                            <td class="as"> <input type="text" class="form-control cri aisct" name="as[fee_detail]" placeholder="INR"></td>
                            <td class="at"> <input type="text" class="form-control cri aisct" name="at[fee_detail]" placeholder="INR"></td>

                            <td class="duplicate"><input type="text" class="form-control cri duplicate" name="duplicate[fee_detail]" placeholder="INR"></td>

                            <td class="renewal"><input type="text" class="form-control cri renewal" name="renewal[fee_detail]" placeholder="INR"></td>

                            <td class="return"><input type="text" class="form-control cri return" name="return[fee_detail]" placeholder="INR"></td>

                            <td class="maintainence"><input type="text" class="form-control cri maintainence" name="maintainence[fee_detail]" placeholder="INR"></td>

                        </tr>

                        <tr>

                            <td>

                                <strong>Upload Fee Structure </strong>

                            </td>

                                    <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilppr[upload_fee_structure]" ></td>

                            <td class="ac"> <input type="file" class="form-control cri ac" name="ac[upload_fee_structure]" ></td>
                            <td class="as"> <input type="file" class="form-control cri as" name="as[upload_fee_structure]" ></td>
                            <td class="at"> <input type="file" class="form-control cri at" name="at[upload_fee_structure]" ></td>

                            <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[upload_fee_structure]" ></td>

                            <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[upload_fee_structure]" ></td>

                            <td class="return"><input type="file" class="form-control cri return" name="return[upload_fee_structure]" ></td>

                            <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[upload_fee_structure]" ></td>



                         

                        </tr>

                           <tr>

                            <td>

                                <strong>Allowed Mode of Payments</strong>

                            </td>

                       <td class="acilppr"><select name="acilppr[paymeny_mode]" class="form-control cri acilppr" multiple="multiple"><option value="Treasury Challan">Treasury Challan</option><option value="Internet Banking">Internet Banking</option><option value="RTGS">RTGS</option><option value="Debit Card">Debit Card</option><option value="Credit Card">Credit Card</option><option value="Wallets">Wallets</option><option value="Demand Draft">Demand Draft</option><option value="Challan">Challan</option><option value="Cash Deposit">Cash Deposit</option><option value="Cheque">Cheque</option><option value="Others">Others</option></select></td>

                            <td class="ac"><select name="ac[paymeny_mode]" class="form-control cri ac" multiple="multiple"><option value="Treasury Challan">Treasury Challan</option><option value="Internet Banking">Internet Banking</option><option value="RTGS">RTGS</option><option value="Debit Card">Debit Card</option><option value="Credit Card">Credit Card</option><option value="Wallets">Wallets</option><option value="Demand Draft">Demand Draft</option><option value="Challan">Challan</option><option value="Cash Deposit">Cash Deposit</option><option value="Cheque">Cheque</option><option value="Others">Others</option></select></td>
                            <td class="as"><select name="as[paymeny_mode]" class="form-control cri as" multiple="multiple"><option value="Treasury Challan">Treasury Challan</option><option value="Internet Banking">Internet Banking</option><option value="RTGS">RTGS</option><option value="Debit Card">Debit Card</option><option value="Credit Card">Credit Card</option><option value="Wallets">Wallets</option><option value="Demand Draft">Demand Draft</option><option value="Challan">Challan</option><option value="Cash Deposit">Cash Deposit</option><option value="Cheque">Cheque</option><option value="Others">Others</option></select></td>
                            <td class="at"><select name="at[paymeny_mode]" class="form-control cri at" multiple="multiple"><option value="Treasury Challan">Treasury Challan</option><option value="Internet Banking">Internet Banking</option><option value="RTGS">RTGS</option><option value="Debit Card">Debit Card</option><option value="Credit Card">Credit Card</option><option value="Wallets">Wallets</option><option value="Demand Draft">Demand Draft</option><option value="Challan">Challan</option><option value="Cash Deposit">Cash Deposit</option><option value="Cheque">Cheque</option><option value="Others">Others</option></select></td>

                            <td class="duplicate"><select name="duplicate[paymeny_mode]" class="form-control cri duplicate" multiple="multiple"><option value="Treasury Challan">Treasury Challan</option><option value="Internet Banking">Internet Banking</option><option value="RTGS">RTGS</option><option value="Debit Card">Debit Card</option><option value="Credit Card">Credit Card</option><option value="Wallets">Wallets</option><option value="Demand Draft">Demand Draft</option><option value="Challan">Challan</option><option value="Cash Deposit">Cash Deposit</option><option value="Cheque">Cheque</option><option value="Others">Others</option></select></td>

                            <td class="renewal"><select name="renewal[paymeny_mode]" class="form-control cri renewal" multiple="multiple"><option value="Treasury Challan">Treasury Challan</option><option value="Internet Banking">Internet Banking</option><option value="RTGS">RTGS</option><option value="Debit Card">Debit Card</option><option value="Credit Card">Credit Card</option><option value="Wallets">Wallets</option><option value="Demand Draft">Demand Draft</option><option value="Challan">Challan</option><option value="Cash Deposit">Cash Deposit</option><option value="Cheque">Cheque</option><option value="Others">Others</option></select></td>

                            <td class="return"><select name="return[paymeny_mode]" class="form-control cri return" multiple="multiple"><option value="Treasury Challan">Treasury Challan</option><option value="Internet Banking">Internet Banking</option><option value="RTGS">RTGS</option><option value="Debit Card">Debit Card</option><option value="Credit Card">Credit Card</option><option value="Wallets">Wallets</option><option value="Demand Draft">Demand Draft</option><option value="Challan">Challan</option><option value="Cash Deposit">Cash Deposit</option><option value="Cheque">Cheque</option><option value="Others">Others</option></select></td>

                            <td class="maintainence"><select name="maintainence[paymeny_mode]" class="form-control cri maintainence" multiple="multiple"><option value="Treasury Challan">Treasury Challan</option><option value="Internet Banking">Internet Banking</option><option value="RTGS">RTGS</option><option value="Debit Card">Debit Card</option><option value="Credit Card">Credit Card</option><option value="Wallets">Wallets</option><option value="Demand Draft">Demand Draft</option><option value="Challan">Challan</option><option value="Cash Deposit">Cash Deposit</option><option value="Cheque">Cheque</option><option value="Others">Others</option></select></td>





                        </tr>

                           <tr>

                            <td>

                                <strong>If Treasury Challan Selected, then  Give Treasury Head Details</strong>

                            </td>

                              <td class="acilppr"> <input type="text" class="form-control cri acilppr" name="acilppr[trasary_head_detail]" placeholder="Treasury Head Details"></td>

                            <td class="ac"> <input type="text" class="form-control cri ac" name="ac[trasary_head_detail]" placeholder="Treasury Head Details"></td>
                            <td class="as"> <input type="text" class="form-control cri as" name="as[trasary_head_detail]" placeholder="Treasury Head Details"></td>
                            <td class="at"> <input type="text" class="form-control cri at" name="at[trasary_head_detail]" placeholder="Treasury Head Details"></td>

                            <td class="duplicate"><input type="text" class="form-control cri duplicate" name="duplicate[trasary_head_detail]" placeholder="Treasury Head Details"></td>

                            <td class="renewal"><input type="text" class="form-control cri renewal" name="renewal[trasary_head_detail]" placeholder="Treasury Head Details"></td>

                            <td class="return"><input type="text" class="form-control cri return" name="return[trasary_head_detail]" placeholder="Treasury Head Details"></td>

                            <td class="maintainence"><input type="text" class="form-control cri maintainence" name="maintainence[trasary_head_detail]" placeholder="Treasury Head Details"></td>

                       



                        </tr>

                        <tr>

                            <td>

                                <strong>Bank Details [Account Holder Name]</strong>

                            </td>

                                <td class="acilppr"> <input type="text" class="form-control cri acilppr" name="acilppr[bank_account_holder_name]" placeholder="A/C Holder Name"></td>

                            <td class="ac"> <input type="text" class="form-control cri ac" name="ac[bank_account_holder_name]" placeholder="A/C Holder Name"></td>
                            <td class="as"> <input type="text" class="form-control cri as" name="as[bank_account_holder_name]" placeholder="A/C Holder Name"></td>
                            <td class="at"> <input type="text" class="form-control cri at" name="at[bank_account_holder_name]" placeholder="A/C Holder Name"></td>

                            <td class="duplicate"><input type="text" class="form-control cri duplicate" name="duplicate[bank_account_holder_name]" placeholder="A/C Holder Name"></td>

                            <td class="renewal"><input type="text" class="form-control cri renewal" name="renewal[bank_account_holder_name]" placeholder="A/C Holder Name"></td>

                            <td class="return"><input type="text" class="form-control cri return" name="return[bank_account_holder_name]" placeholder="A/C Holder Name"></td>

                            <td class="maintainence"><input type="text" class="form-control cri maintainence" name="maintainence[bank_account_holder_name]" placeholder="A/C Holder Name"></td>

                       

                        </tr>



                                            <tr>

                            <td>

                                <strong>Bank Account Number</strong>

                            </td>

                            <td class="acilppr"> <input type="text" class="form-control cri acilppr" name="acilppr[bank_account_number]" placeholder="Account Number"></td>

                            <td class="ac"> <input type="text" class="form-control cri ac" name="ac[bank_account_number]" placeholder="Account Number"></td>
                            <td class="as"> <input type="text" class="form-control cri as" name="as[bank_account_number]" placeholder="Account Number"></td>
                            <td class="at"> <input type="text" class="form-control cri at" name="at[bank_account_number]" placeholder="Account Number"></td>

                            <td class="duplicate"><input type="text" class="form-control cri duplicate" name="duplicate[bank_account_number]" placeholder="Account Number"></td>

                            <td class="renewal"><input type="text" class="form-control cri renewal" name="renewal[bank_account_number]" placeholder="Account Number"></td>

                            <td class="return"><input type="text" class="form-control cri return" name="return[bank_account_number]" placeholder="Account Number"></td>

                            <td class="maintainence"><input type="text" class="form-control cri maintainence" name="maintainence[bank_account_number]" placeholder="Account Number"></td>

                       

                        </tr>

                        <tr>

                            <td>

                                <strong>Bank Name </strong>

                            </td>

                            <td class="acilppr"> <input type="text" class="form-control cri acilppr" name="acilppr[bank_name]" placeholder="Bank Name"></td>

                            <td class="ac"> <input type="text" class="form-control cri ac" name="ac[bank_name]" placeholder="Bank Name"></td>
                            <td class="as"> <input type="text" class="form-control cri as" name="as[bank_name]" placeholder="Bank Name"></td>
                            <td class="at"> <input type="text" class="form-control cri at" name="at[bank_name]" placeholder="Bank Name"></td>

                            <td class="duplicate"><input type="text" class="form-control cri duplicate" name="duplicate[bank_name]" placeholder="Bank Name"></td>

                            <td class="renewal"><input type="text" class="form-control cri renewal" name="renewal[bank_name]" placeholder="Bank Name"></td>

                            <td class="return"><input type="text" class="form-control cri return" name="return[bank_name]" placeholder="Bank Name"></td>

                            <td class="maintainence"><input type="text" class="form-control cri maintainence" name="maintainence[bank_name]" placeholder="Bank Name"></td>

                       



                        </tr>

                           <tr>

                            <td><strong>Bank IFSC Code</strong></td>

                           <td class="acilppr"> <input type="text" class="form-control cri acilppr" name="acilppr[bank_ifsc_code]" placeholder="IFSC Code"></td>

                            <td class="ac"> <input type="text" class="form-control cri ac" name="ac[bank_ifsc_code]" placeholder="IFSC Code"></td>
                            <td class="as"> <input type="text" class="form-control cri as" name="as[bank_ifsc_code]" placeholder="IFSC Code"></td>
                            <td class="at"> <input type="text" class="form-control cri at" name="at[bank_ifsc_code]" placeholder="IFSC Code"></td>

                            <td class="duplicate"><input type="text" class="form-control cri duplicate" name="duplicate[bank_ifsc_code]" placeholder="IFSC Code"></td>

                            <td class="renewal"><input type="text" class="form-control cri renewal" name="renewal[bank_ifsc_code]" placeholder="IFSC Code"></td>

                            <td class="return"><input type="text" class="form-control cri return" name="return[bank_ifsc_code]" placeholder="IFSC Code"></td>

                            <td class="maintainence"><input type="text" class="form-control cri maintainence" name="maintainence[bank_ifsc_code]" placeholder="IFSC Code"></td>

                         </tr>



                            <tr>

                            <td>

                                <strong>Any Deposit Taken</strong>

                            </td>

                             <td class="acilppr"><select onchange='hide("acilppr[deposit_condition]","acilppr[any_deposit_token]")' name="acilppr[any_deposit_token]"  class="form-control cri acilppr"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="ac"><select onchange='hide("ac[deposit_condition]","ac[any_deposit_token]")' name="ac[any_deposit_token]" class="form-control cri" ac><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="as"><select onchange='hide("as[deposit_condition]","as[any_deposit_token]")' name="as[any_deposit_token]" class="form-control cri" as><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="at"><select onchange='hide("at[deposit_condition]","at[any_deposit_token]")' name="at[any_deposit_token]" class="form-control cri" at><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="duplicate"><select onchange='hide("duplicate[deposit_condition]","duplicate[any_deposit_token]")' name="duplicate[any_deposit_token]" class="form-control cri duplicate"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="renewal"><select onchange='hide("renewal[deposit_condition]","renewal[any_deposit_token]")' name="renewal[any_deposit_token]" class="form-control cri renewal"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="return"><select onchange='hide("return[deposit_condition]","return[any_deposit_token]")' name="return[any_deposit_token]" class="form-control cri return"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="maintainence"><select onchange='hide("maintainence[deposit_condition]","maintainence[any_deposit_token]")' name="maintainence[any_deposit_token]" class="form-control cri maintainence"><option value="Y">Yes</option><option value="N">No</option></select></td>

                           </tr>



                                   <tr>

                            <td>

                                <strong>If Y, then give Conditions</strong>

                            </td>

                               <td class="acilppr"> <input type="text" class="form-control cri acilppr" name="acilppr[deposit_condition]" placeholder="Deposit Condition"></td>

                            <td class="ac"> <input type="text" class="form-control cri ac" name="ac[deposit_condition]" placeholder="Deposit Condition"></td>
                            <td class="as"> <input type="text" class="form-control cri as" name="as[deposit_condition]" placeholder="Deposit Condition"></td>
                            <td class="at"> <input type="text" class="form-control cri at" name="at[deposit_condition]" placeholder="Deposit Condition"></td>

                            <td class="duplicate"><input type="text" class="form-control cri duplicate" name="duplicate[deposit_condition]" placeholder="Deposit Condition"></td>

                            <td class="renewal"><input type="text" class="form-control cri renewal" name="renewal[deposit_condition]" placeholder="Deposit Condition"></td>

                            <td class="return"><input type="text" class="form-control cri return" name="return[deposit_condition]" placeholder="Deposit Condition"></td>

                            <td class="maintainence"><input type="text" class="form-control cri maintainence" name="maintainence[deposit_condition]" placeholder="Deposit Condition"></td>

                       



                        </tr>

                        <tr>

                            <td>

                                <strong>Is Deposit Taken in the form of NSC</strong>

                            </td>

                           <td class="acilppr"><select onchange='hide("acilppr[conditions]","acilppr[nsc_deposit_token]")' name="acilppr[nsc_deposit_token]"  class="form-control cri acilppr"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="ac"><select onchange='hide("ac[conditions]","ac[nsc_deposit_token]")' name="ac[nsc_deposit_token]" class="form-control cri" aisct><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="as"><select onchange='hide("as[conditions]","as[nsc_deposit_token]")' name="as[nsc_deposit_token]" class="form-control cri" aisct><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="at"><select onchange='hide("at[conditions]","at[nsc_deposit_token]")' name="at[nsc_deposit_token]" class="form-control cri" aisct><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="duplicate"><select onchange='hide("duplicate[conditions]","duplicate[nsc_deposit_token]")' name="duplicate[nsc_deposit_token]" class="form-control cri duplicate"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="renewal"><select onchange='hide("renewal[conditions]","renewal[nsc_deposit_token]")' name="renewal[nsc_deposit_token]" class="form-control cri renewal"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="return"><select onchange='hide("return[conditions]","return[nsc_deposit_token]")' name="return[nsc_deposit_token]" class="form-control cri return"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="maintainence"><select onchange='hide("maintainence[conditions]","maintainence[nsc_deposit_token]")' name="maintainence[nsc_deposit_token]" class="form-control cri maintainence"><option value="Y">Yes</option><option value="N">No</option></select></td>





                        </tr>



                        <tr><td><strong>If Y, then give Conditions</strong></td>

                            <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilppr[conditions]" ></td>

                            <td class="ac"> <input type="file" class="form-control cri ac" name="ac[conditions]" ></td>
                            <td class="as"> <input type="file" class="form-control cri as" name="as[conditions]" ></td>
                            <td class="at"> <input type="file" class="form-control cri at" name="at[conditions]" ></td>

                            <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[conditions]" ></td>

                            <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[conditions]" ></td>

                            <td class="return"><input type="file" class="form-control cri return" name="return[conditions]" ></td>

                            <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[conditions]" ></td>

                         </tr>



                          

                        <tr>

                            <td><strong>Comments </strong></td>

                              <td class="acilppr"><textarea name="acilppr[comment]" class="form-control cri"></textarea></td>

                            <td class="ac"><textarea name="aisct[comment]" class="form-control cri"></textarea></td>
                            <td class="as"><textarea name="aisct[comment]" class="form-control cri"></textarea></td>
                            <td class="at"><textarea name="aisct[comment]" class="form-control cri"></textarea></td>

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
 <?php if(!in_array("Amendment - Cancellation",$allsubservices)) { ?> .ac{display: none;}  <?php } ?>
    <?php if(!in_array("Amendment - Surrender",$allsubservices)) { ?> .as{display: none;}  <?php } ?>
    <?php if(!in_array("Amendment - Transfer",$allsubservices)) { ?> .at{display: none;}  <?php } ?>


    <?php if(!in_array("Duplicate Copy",$allsubservices)) { ?> $(".duplicate").remove();   <?php } ?>

    <?php if(!in_array("Renewal",$allsubservices)) { ?> $(".renewal").remove(); <?php } ?>

    <?php if(!in_array("Return",$allsubservices)) { ?> $(".return").remove();  <?php } ?>

    <?php if(!in_array("Maintenance of Register",$allsubservices)) { ?> $(".maintainence").remove();  <?php } ?>





</script>



