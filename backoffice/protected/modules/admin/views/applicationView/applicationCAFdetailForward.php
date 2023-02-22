<?php
/**
* to view the applictions forwarded by other departments
* @author: Hemant Thakur
*/
?>
<style type="text/css">


table.gridtable {
   font-family: verdana,arial,sans-serif;
   font-size:11px;
   color:#333333;
   width: 100%;
   border-width: 1px;
   border-color: #666666;
   border-collapse: collapse;
}
table.gridtable th {
   border-width: 1px;
   padding: 8px;
   border-style: solid;
   border-color: #666666;
   background-color: #dedede;
}
table.gridtable td {
   border-width: 1px;
   padding: 8px;
   border-style: solid;
   border-color: #666666;
   background-color: #ffffff;
}


table.gridtabledoc {
   font-family: verdana,arial,sans-serif;
   font-size:11px;
   color:#333333;
   width: 100%;
   border-width: 1px;
   border-color: #666666;
   border-collapse: collapse;
}
table.gridtabledoc th {
   border-width: 1px;
   padding: 8px;
   border-style: solid;
   border-color: #666666;
   background-color: #dedede;
}
table.gridtabledoc td {
   border-width: 1px;
   padding: 8px;
   border-style: solid;
   border-color: #666666;
   background-color: #ffffff;
}


table.gridtabledoc1 {
   font-family: verdana,arial,sans-serif;
   font-size:11px;
   color:#333333;
   width: 97%;
   margin-left: 20px;
   border-width: 1px;
   border-color: #666666;
   border-collapse: collapse;
}
table.gridtabledoc1 th {
   border-width: 1px;
   padding: 8px;
   border-style: solid;
   border-color: #666666;
   background-color: #dedede;
}
table.gridtabledoc1 td {
   border-width: 1px;
   padding: 8px;
   border-style: solid;
   border-color: #666666;
   background-color: #ffffff;
}
.txt
{
   color: #000000;
}


   .comment_section{
   display: inline;
   background: #ddd;
   color:red;
   resize: none;
   padding: 5px 15px 5px 15px;
   }
   .apprvr_comments{
   display: inline;
   background: #F7F7F7;
   color:#222;
   resize: none;
   padding: 5px 15px 5px 15px;  
   }
   #heading{
   background-color: #36c6d3;
   text-align: center;
   color:#fff;
   padding-top: 7px;
   padding-bottom: 7px;
   margin-bottom: 20px;
   font-weight: bold;
   }
   @media (min-width: 992px){
   .no_of_invest .col-md-2{
   width: 16.2%;     
   }
   }
   @media (min-width: 992px){
   .no_of_emp .col-md-2{
   width: 14.2%;     
   }
   }
   @media (min-width: 992px){
   .mean_fin .col-md-2{
   width: 14.2%;     
   }
   }
   .control-label{
   font-size: 0.9em;
   font-weight: 800;
   height: 20px;
   text-align: left;
   }
   .custom_text{
   width: 29.8%; 
   border: 1px solid #e2e2e4;
   box-shadow: none;
   color: #000000;
   display: inline;
   height: 34px;
   padding: 6px 12px;
   line-height: 1.428571429;
   background-color: #fff;font-size: 14px;
   }
   .custom_text_sno{
   width: 4.2%; 
   border: 1px solid #e2e2e4;
   box-shadow: none;
   color: #000000;
   display: inline;
   height: 34px;
   padding: 6px 12px;
   line-height: 1.428571429;
   background-color: #fff;font-size: 14px;
   }
   .custom_text_product{
   width: 84.8%; 
   border: 1px solid #e2e2e4;
   box-shadow: none;
   color: #000000;
   display: inline;
   height: 34px;
   padding: 6px 12px;
   line-height: 1.428571429;
   background-color: #fff;font-size: 14px;
   }
   .custom_text_product_man{
   width: 23.8%; 
   border: 1px solid #e2e2e4;
   box-shadow: none;
   color: #000000;
   display: inline;
   height: 34px;
   padding: 6px 12px;
   line-height: 1.428571429;
   }
   .custom_text_product_req{
   width: 45.8%; 
   border: 1px solid #e2e2e4;
   box-shadow: none;
   color: #000000;
   display: inline;
   height: 34px;
   padding: 6px 12px;
   line-height: 1.428571429;
   }
   ::-webkit-input-placeholder { font-size:.9em;font-weight: bold }
   ::-moz-placeholder { font-size:.9em; font-weight: bold}
   :-ms-input-placeholder { font-size:.9em; font-weight: bold}
   input:-moz-placeholder { font-size:.9em; font-weight: bold}
</style>
<div class="site-min-height">
<?php
   $this->breadcrumbs=array(
   'Application View',
);
$app_name=ApplicationExt::getAppNameViaId($data['application_id']);
echo "<section class='panel'><div style='color:#797979;font-size:1.8em' class='panel-heading'> <b>Applications Name:- ". $app_name['application_name'];
echo "<t class='pull-right'>&nbsp;&nbsp;Application IDs:- ".$data['submission_id']."<input type='hidden' id='sub_id' value='".$data['submission_id']."'>&nbsp;&nbsp;</t></b></div>";
   
echo "<div class='row'>";
foreach(Yii::app()->user->getFlashes() as $key => $message) {
   echo '<font color="red"><div class="alert-message error"><p>' . $message . "</font></p></div>\n";
}
echo "</div>";
$fields=json_decode($data['field_value']);
?>

<div class="panel-body">
      <fieldset title="Step1" class="step" id="default-step-0">
         <legend style="display:none">Enterprise Details</legend>
         <div id="heading">Enterprise Detail</div>
         <div class="row">
            <div class="col-xs-8 col-sm-6">
               <div class="form-group">
                    <label class='control-label'>IUID</label>
                  <input type="text"  id="IUID" class="form-control txt" name='IUID' value="<?=@$fields->IUID?>" readonly placeholder="IUID">
               </div>
            </div>
            <div class="col-xs-4 col-sm-6">
               <div class="form-group">
                     <label class='control-label'>Enterprise Name</label>
                  <input type="text"  id="company_name" class="form-control txt" value="<?=@$fields->company_name?>" readonly name="company_name" placeholder="*  Name of the Company / Unit">
                  <i class="error"></i>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-8 col-sm-6">
               <div class="form-group">
                     <label class='control-label'>Corresponding Address</label>
                  <textarea  id="Address" class="form-control txt" name="Address" readonly placeholder="*  Correspondence Address"><?=@$fields->Address?></textarea>
                  <i class="error"></i>
               </div>
            </div>
            <div class="col-xs-8 col-sm-6">
               <div class="form-group">
                  <label class='control-label'>Pin Code</label>
                  <input type="text"  id="pin_code" class="form-control txt"  value="<?=@$fields->pin_code?>" readonly  name="pin_code" placeholder="*  Pin Code">
                  <i class="error"></i>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-4 col-sm-6">
               <div class="form-group">
                  <label class='control-label'>Mobile Number</label>
                  <input type="text"  id="mob_number" class="form-control txt"  value="<?=@$fields->mob_number?>" readonly  name="mob_number" placeholder="Mobile Number">
                  <i class="error"></i>
               </div>
            </div>
            <div class="col-xs-4 col-sm-6">
               <div class="form-group">
                     <label class='control-label'>Telephone Number</label>
                  <input type="text"  id="tel_phone" class="form-control txt " value="<?=@$fields->tel_phone?>" readonly  name="tel_phone" placeholder="*  Telephone Number">
                  <i class="error"></i>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-8 col-sm-6">
               <div class="form-group">
                  <label class='control-label'>Email Address</label>
                  <input type="text"  id="email" class="form-control txt "  value="<?=@$fields->email?>" readonly  name="email" placeholder="*  Email">
                  <i class="error"></i>
               </div>
            </div>
            <div class="col-xs-4 col-sm-6">
               <div class="form-group">
                  <label class='control-label'>Fax</label>
                  <input type="text"  id="fax" class="form-control txt " value="<?=@$fields->fax?>" readonly  name="fax" placeholder="Fax">
                  <i class="error"></i>
               </div>
            </div>
         </div>
         <div id="heading">Details of M.D/Managing Partner/CEO / Lead   Promoter/ Proprietor</div>
         <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
               <div class="form-group">
                  <label class='control-label'>Name of the M.D/Managing Partner/CEO /Lead Promoter/Proprietor</label>
                  <input type="text"  id="md_name" class="form-control txt " value="<?=@$fields->md_name?>" readonly name="md_name" placeholder="*  Name of the M.D/Managing Partner/CEO /Lead Promoter/Proprietor">
                  <i class="error"></i>
               </div>
            </div>
            <div class="col-xs-3 col-sm-6 col-md-3">
               <div class="form-group"> 
                  <label class='control-label'>Email Address</label>

                  <input type="text"  id="md_email" class="form-control txt " value="<?=@$fields->md_email?>" readonly  name="md_email" placeholder="*  Email">
                  <i class="error"></i>
               </div>
            </div>
            <div class="col-xs-3 col-sm-6 col-md-3">
               <div class="form-group"> 
                  <label class='control-label'>Designation</label>

                  <input type="text"  id="md_designation" class="form-control txt " value="<?=@$fields->designation?>" readonly  name="md_designation" placeholder="*  Designation">
                  <i class="error"></i>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-8 col-sm-6">
               <div class="form-group">
                  <label class='control-label'>Mobile Number</label>

                  <input type="text"  id="md_mob" class="form-control txt "  value="<?=@$fields->md_mob?>" readonly name="md_mob" placeholder="Mobile Number">
                  <i class="error"></i>
               </div>
            </div>
            <div class="col-xs-4 col-sm-6">
               <div class="form-group">
                  <label class='control-label'>Telephone Number</label>

                  <input type="text"  id="md_tel" class="form-control txt "  value="<?=@$fields->md_tel?>" readonly name="md_tel" placeholder="Telephone Number">
                  <i class="error"></i>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-4 col-sm-6">
               <div class="form-group">
                  <label class='control-label'>Fax</label>

                  <input type="text"  id="md_fax" class="form-control txt "  value="<?=@$fields->md_fax?>" readonly name="md_fax" placeholder="FAX">
                  <i class="error"></i>
               </div>
            </div>
            <div class="col-xs-8 col-sm-6">
               <div class="form-group">
                  <label class='control-label'>Organisation Category</label>
                  <input type="text"  id="md_fax" class="form-control txt "  value="<?=@$fields->org_category?>" readonly name="md_fax" placeholder="FAX">
                  <i class="error"></i>
               </div>
            </div>
         </div>
         <div id="heading">Details of Authorized Coordinator/Person</div>
         <div class="row">
            <div class="col-xs-8 col-sm-6">
               <div class="form-group">
                  <label class='control-label'>Name</label>

                  <input type="text"  id="auth_name" class="form-control txt " name="auth_name"  value="<?=@$fields->auth_name?>" readonly placeholder="Name of Authorized Coordinator/Person">
                  <i class="error"></i>
               </div>
            </div>
            <div class="col-xs-8 col-sm-6">
               <div class="form-group">
                  <label class='control-label'>Designation</label>
                  <input type="text"  id="auth_designation" class="form-control txt "  value="<?=@$fields->auth_designation?>" readonly name="auth_designation" placeholder="*  Designation">
                  <i class="error"></i>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-4 col-sm-6">
               <div class="form-group">
                  <label class='control-label'>Email</label>
                  <input type="text"  id="auth_email" class="form-control txt "  value="<?=@$fields->auth_email?>" readonly name="auth_email" placeholder="Email">
                  <i class="error"></i>
               </div>
            </div>
            <div class="col-xs-8 col-sm-6">
               <div class="form-group">
                  <label class='control-label'>Mobile Number</label>
                  <input type="text"  id="auth_mob" class="form-control txt "  value="<?=@$fields->auth_mob?>" readonly name="auth_mob" placeholder="Mobile Number">
                  <i class="error"></i>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-4 col-sm-6">
               <div class="form-group">
                  <label class='control-label'>Telephone Number</label>
                  <input type="text"  id="auth_tel" class="form-control txt " value="<?=@$fields->auth_tel?>" readonly name="auth_tel" placeholder="Telephone Number">
                  <i class="error"></i>
               </div>
            </div>
            <div class="col-xs-8 col-sm-6">
               <div class="form-group">
                  <label class='control-label'>Fax Number</label>
                  <input type="text"  id="auth_fax" class="form-control txt "  value="<?=@$fields->auth_fax?>" readonly name="auth_fax" placeholder="Fax Number">
                  <i class="error"></i>
               </div>
            </div>
         </div>
         <div id="heading"> Financial Indicators of the Company / Firm for Last 3 Years in INR Lakhs (if any)</div>
         <div class="row">
            <div class="col-md-2">
               <div class="form-group">
                  <label class='control-label'>Year</label>
                  <i class="error"></i>
               </div>
            </div>
            <div class="col-md-2">
               <div class="form-group">
                  <label class='control-label'>Turn Over</label>
                  <i class="error"></i>
               </div>
            </div>
            <div class="col-md-2">
               <div class="form-group">
                  <label class='control-label'>Profit Before Tax</label>
               </div>
            </div>
            <div class="col-md-2">
               <div class="form-group">
                  <label class='control-label'>Net Worth</label>
                  <i class="error"></i>
               </div>
            </div>
            <div class="col-md-2">
               <div class="form-group">
                  <label class='control-label'>Reserves & Surplus</label>
                  <i class="error"></i>
               </div>
            </div>
            <div class="col-md-2">
               <div class="form-group">
                  <label class='control-label'>Share Capital</label>
                  <i class="error"></i>
               </div>
            </div>
         </div>
            <?php
               if(isset($fields->fnc_year)){
                  foreach ($fields->fnc_year as $key=>$value) { 
                     ?>
                     <div class="row">
                        <div class="col-md-2">
                           <div class="form-group">
                                <input type="text"  id="fnc_year1" class="form-control txt " readonly value="<?=@$fields->fnc_year[$key]?>" name="fnc_year[]" >
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <i class="error"></i>
                                <input type="text"  id="fnc_year1" class="form-control txt " readonly value="<?=@$fields->fnc_turnover[$key]?>" name="fnc_year[]">

                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <i class="error"></i>
                                <input type="text"  id="fnc_year1" class="form-control txt " readonly value="<?=@$fields->fnc_prftBfrTax[$key]?>" name="fnc_year[]" >

                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <i class="error"></i>
                                <input type="text"  id="fnc_year1" class="form-control txt " readonly value="<?=@$fields->fnc_netWrth[$key]?>" name="fnc_year[]" >

                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                                <input type="text"  id="fnc_year1" class="form-control txt " readonly value="<?=@$fields->fnc_rsrvSrpls[$key]?>" name="fnc_year[]" >
                              
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <i class="error"></i>
                                <input type="text"  id="fnc_year1" class="form-control txt " readonly value="<?=@$fields->fnc_sharCaps[$key]?>" name="fnc_year[]">
                           </div>
                        </div>
                     </div>
               <?php    
                  }
               }
            ?>
         <div id="heading">Organisation Details</div>
         <div class="row">
            <div class="col-xs-8 col-sm-6">
               <div class="form-group">
                  <label class='control-label'>Nature Of organisation</label>
                  <input type="text"  id="fnc_year1" class="form-control txt " readonly value="<?=@$fields->noforg?>" name="noforg">
                  <i class="error"></i>
               </div>
            </div>

            <div class="col-xs-8 col-sm-6">
               <div class="form-group">
                  <label class='control-label'>Project Status</label>
                  <input type="text"  id="project_status" class="form-control txt " readonly value="<?=@$fields->project_status?>" name="project_status" placeholder="Project Status...">
                  <i class="error"></i>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="form-group">
                  <label class='control-label'>Description about company</label>
                  <textarea  id="activity_of_company" class="form-control txt  col-md-12" readonly  name="activity_of_company"><?=@$fields->activity_of_company?></textarea>
                  <i class="error"></i>
               </div>
            </div>
         </div>
         <div class="row">&nbsp;</div>
      </fieldset>
      
      <fieldset title="Step 2" class="step" id="default-step-1" >
         <legend style="display:none"> Investment Details: </legend>
         <div class="row">&nbsp;</div>
         <div id="heading">Investment Details:</div>
         <div class="row">
            <div class="col-xs-8 col-sm-6">
               <div class="form-group">
                 <label class='control-label'>Natue of Unit</label>
                 <input type="text"  id="fnc_year1" class="form-control txt " readonly value="<?=@$fields->ntrofunit?>" name="ntrofunit">
                  <i class="error"></i>
               </div>
            </div>
            <div class="col-xs-8 col-sm-6">
               <div class="form-group">
                  <label class='control-label'>Unit Type</label>
                 <input type="text"  id="fnc_year1" class="form-control txt " readonly value="<?=@$fields->ntrofunittype?>" name="ntrofunittype">
                  <i class="error"></i>
               </div>
            </div>
         </div>


            <div class="row">&nbsp;</div>
            <div class="manufactiring_detail" <?php if(isset($fields->ntrofunit)) if($fields->ntrofunit=='Manufacturing') echo 'style="display:block"'; else echo 'style="display:none"';?>>
            <div id="heading">Raw Material Detail</div>
              <div class="row"> 
               <div class="col-md-4"><b>Name of the Raw Material</b></div>
                  <div class="col-md-4"><b>Annual Requirement Unit</b></div>
                     <div class="col-md-4"><b>Quantity</b></div>
                  <div id="TextBoxContainer" class="col-md-12">
                  	 <?php
                        if(isset($fields->Name_of_the_Raw_Material)){
                            foreach ($fields->Name_of_the_Raw_Material as $key => $value) {
          echo '<input name = "Name_of_the_Raw_Material['.$key.']" readonly class="custom_text" type="text" value = "' . $fields->Name_of_the_Raw_Material[$key] . '" />
                                <input name = "Annual_Requirement_Unit['.$key.']" readonly class="custom_text" type="text" value = "' . $fields->Annual_Requirement_Unit[$key] . '" />
                                <input name = "material_quantity['.$key.']" type="text" readonly class="custom_text" value = "' . $fields->material_quantity[$key] .'" />';
                      }

                  }

?>

			</div>
              </div>       
            </div>
            <div class="row">&nbsp;</div>
            <div class="service_detail" <?php if(isset($fields->ntrofunit)) if($fields->ntrofunit=='Services') echo 'style="display:block';else echo 'style="display:none"';?>>
               <div class="row">&nbsp;</div>
                <div id="heading">Proposed Product/Service Name</div>
                <div class="row">&nbsp;</div>
               <div class="row">
                  <div class="col-md-12"><b>Product Service Name</b></div>
                     <div id="TextBoxContainer2" class="col-md-12">
                          <?php 
                           if(isset($fields->product_service_name)){
                               foreach ($fields->product_service_name as $key => $value) {
                                   echo '<input name = "product_service_name['.$key.']" class="custom_text" type="text" readonly value = "' . $fields->product_service_name[$key] . '" />';
                               }
                           }
                       ?>
                     </div>
               </div>   
            </div>

            <div class="manufactiring_detail" <?php if(isset($fields->ntrofunit)) if($fields->ntrofunit=='Manufacturing') echo 'style="display:block"'; else echo 'style="display:none"';?>>
              <div class="row">&nbsp;</div>
              <div id="heading">Products to be Manufactured</div>
              <div class="row">&nbsp;</div>
               <div class="row" >
                     <div class="col-md-3"><b>Product Description</b></div>
                     <div class="col-md-4"><b>Annual Install Capacity</b></div>
                     <div class="col-md-2"><b>Quantity</b></div>
                     <div class="col-md-2"><b>NIC Code</b></div>
                        <div id="TextBoxContainer3" class="col-md-12">
                          <?php 
                        if(isset($fields->Product_Description)){
                            foreach ($fields->Product_Description as $key => $value) {
                                echo '<input name = "Product_Description['.$key.']" readonly class="custom_text_product_man" type="text" value = "' . $fields->Product_Description[$key] . '" />
                                      <input name = "Annual_Install_Capacity['.$key.']" readonly class="custom_text_product_man" type="text" value = "' . $fields->Annual_Install_Capacity[$key] . '" />
                                      <input name = "product_manufactured_Quantity['.$key.']" readonly class="custom_text_product_man" type="text" value = "' . $fields->product_manufactured_Quantity[$key] . '" />
                                      <input name = "NIC_Code['.$key.']" class="custom_text_product_man" readonly type="text" value = "' . @$fields->NIC_Code[$key] . '" />';
                            }
                        }
                    ?>
                        </div>
                     </div>
                       <div class="row">&nbsp;</div>
               <div id="heading">Process description</div>
                  <div class="row">
                     <div class="col-md-6">
                        <frameset>
                           <label class='control-label' style='font-size:0.9em'>* Type of Industry</label>
                           <div class="form-group">
                            <input type="text"  id="type_of_industry" class="form-control txt" readonly value="<?=@$fields->type_of_industry?>" name="type_of_industry" placeholder="">
                              <i class="error"></i>
                           </div>
                        </frameset>
                     </div>
                     <div class="col-md-6">
                        <frameset>
                           <label class='control-label' style='font-size:0.9em'>* Expected date of commercial production</label>
                           <div class="form-group">
                              <input type="text" readonly  id="other" class="form-control txt " value="<?=@$fields->expected_date_of_commercial_production?>" name="expected_date_of_commercial_production" placeholder="* Expected date of commercial production(MM/YY)">
                              <i class="error"></i>
                           </div>
                        </frameset>
                     </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                           <label class='control-label'>Brief Description about processes</label>
                           <textarea  id="Brief_Description_about_Processes" readonly class="form-control txt  col-md-12"  name="Brief_Description_about_Processes" placeholder=" Brief_Description_about_Processes"><?=@$fields->Brief_Description_about_Processes?></textarea>
                           <i class="error"></i>
                        </div>
                     </div>
                  </div>
            </div>
         <div class="row">&nbsp;</div>
      <div id="heading">Details of Investment (Rs in Crores)</div>
      <div class="row">
         <div class="col-md-12 no_of_invest">
            <div class="form-group">
               <fieldset style="padding-bottom:0px;">
                  <div class="col-md-2">
                     <div class="form-group">
                        <label class="control-label">Land</label>
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <label class="control-label">Building</label>
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <label class="nature_label control-label">Machinery/Equipment</label>
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <label class="control-label">Capital Margin</label>
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <label class="control-label">Other</label>
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <label class="control-label">Total</label>
                     </div>
                  </div>
                  <?php 
                     if(isset($fields->invstmnt_in_total)){
                     foreach ($fields->invstmnt_in_total as $key => $value) {
                      ?> 
                  <div class="row"> 
                  <div class="col-md-2">
                     <div class="form-group">
                        <input type="number"  id="duration_of_investment" min="0" max="10" class="form-control txt " readonly value="<?=@$fields->invstmnt_in_land[$key]?>" name="invstmnt_in_land[]" >
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <input type="number"  id="duration_of_investment" min="0" max="10" class="form-control txt " readonly value="<?=@$fields->invstmnt_in_building[$key]?>" name="invstmnt_in_building[]" >
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <input type="number"  id="duration_of_investment" min="0" max="10" class="form-control txt " readonly value="<?=@$fields->invstmnt_in_plant[$key]?>" name="invstmnt_in_plant[]" >
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <input type="number"  id="duration_of_investment" min="0" max="10" class="form-control txt " readonly value="<?=@$fields->invstmnt_in_wrkingcapital[$key]?>" name="invstmnt_in_plant[]" >
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <input type="number"  id="duration_of_investment" min="0" max="10" class="form-control txt " readonly value="<?=@$fields->invstmnt_in_other[$key]?>" name="invstmnt_in_other[]" >
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <input type="number"  id="duration_of_investment" min="0" max="10" class="form-control txt " readonly value="<?=@$fields->invstmnt_in_total[$key]?>" name="invstmnt_in_total[]" >
                     </div>
                  </div>
                  <?php
                     }
                     }
                     else{
                     echo '<div class="col-md-12">
                             <div class="form-group">
                                <input type="text"  class="form-control txt " readonly value="No Records..." placeholder="No Records...">
                             </div>
                          </div>';
                     }
                     
                     ?>
                    </div>
               </fieldset>
            </div>
         </div>
      </div>
      <div id="heading">Proposed Employement</div>
      <div class="row">
         <div class="col-md-12 no_of_emp">
            <frameset>
              <?php 
                  if(isset($fields->no_of_emp_mtotal)){
                     ?>
                     <table class="gridtable">
                        <thead>
                           <tr>
                              <th rowspan="2" class="text-center">Employment</th>
                              <th class="text-center">Male</th>
                              <th class="text-center">Female</th>
                           </tr>
                        </thead>
                        <tbody>
                        <tr>
                           <td>
                           
                              Skilled
                           
                           </td>
                           <td>
                              
                                 <input type="text"  id="mskl0" class="form-control txt  decimal" maxlength='10' value="<?=@$fields->no_of_emp_mskilled[0]?>" name="no_of_emp_mskilled[]" readonly placeholder="Skilled">
                              
                           </td>
                           <td>
                              
                                 <input type="text"  id="fskl0" class="form-control txt  decimal" maxlength='10' value="<?=@$fields->no_of_emp_fskilled[0]?>" name="no_of_emp_fskilled[]"  readonly  placeholder="Skilled">
                              
                           </td>
                        </tr>
                        <tr>
                         <td>
                           Unskilled
                          
                           </td>
                           <td>
                              
                           <input type="text"  id="munskl0" class="form-control txt  decimal" maxlength='10' value="<?=@$fields->no_of_emp_munskilled[0]?>" name="no_of_emp_munskilled[]" readonly   placeholder="Unskilled">
                             
                           </td>
                           <td>
                              
                           <input type="text"  id="funskl0" class="form-control txt  decimal" maxlength='10' value="<?=@$fields->no_of_emp_funskilled[0]?>" name="no_of_emp_funskilled[]"  readonly  placeholder="Unskilled">
                              
                           </td>
                        </tr>
                        <tr>
                           <td>
                              
                           Supervisory
                             
                           </td>

                           <td>
                              
                           <input type="text"  id="msprvsr0" class="form-control txt  decimal" maxlength='10' value="<?=@$fields->no_of_emp_msupervisory[0]?>" name="no_of_emp_msupervisory[]" readonly   placeholder="Supervisory">
                              
                           </td>
                           <td>
                              
                           <input type="text"  id="fsprvsr0" class="form-control txt  decimal" maxlength='10' value="<?=@$fields->no_of_emp_fsupervisory[0]?>" name="no_of_emp_fsupervisory[]" readonly   placeholder="Supervisory">
                           
                           </td>
                        </tr>
                        <tr>
                           <td>
                             
                           Engineer
                          
                           </td>

                           <td>
                             
                             <input type="text"  id="mengg0" class="form-control txt  decimal" maxlength='10' value="<?=@$fields->no_of_emp_mengineer[0]?>" name="no_of_emp_mengineer[]"  readonly  placeholder="Engineer">
                              
                           </td>
                           <td>
                              
                           <input type="text"  id="fengg0" class="form-control txt  decimal" maxlength='10' value="<?=@$fields->no_of_emp_fengineer[0]?>" name="no_of_emp_fengineer[]"  readonly  placeholder="Engineer">
                              
                           </td>
                        </tr>
                        <tr>
                           <td>
                              
                           IT/ITeS Professional
                           </td>

                           <td>
                              
                           <input type="text"  id="mit0" class="form-control txt  decimal" maxlength='10' value="<?=@$fields->no_of_emp_it_mprofessional[0]?>" name="no_of_emp_it_mprofessional[]"  readonly  placeholder="IT/ITeS Professional">
                             
                           </td>
                           <td>
                              
                           <input type="text"  id="fit0" class="form-control txt  decimal" maxlength='10' value="<?=@$fields->no_of_emp_it_fprofessional[0]?>" name="no_of_emp_it_fprofessional[]"  readonly  placeholder="IT/ITeS Professional">
                              
                           </td>
                        </tr>
                        <tr>
                           <td>
                              
                           Management
                       </td>

                           <td>
                              
                           <input type="text"  id="mmngmnt0" class="form-control txt  decimal" maxlength='10' value="<?=@$fields->no_of_emp_mmanagement[0]?>" name="no_of_emp_mmanagement[]" readonly   placeholder="Management">
                              
                           </td>
                           <td>
                              
                                 <input type="text"  id="fmngmnt0" class="form-control txt  decimal" maxlength='10' value="<?=@$fields->no_of_emp_fmanagement[0]?>" name="no_of_emp_fmanagement[]" readonly   placeholder="Management">                                    
                             
                           </td>
                        </tr>
                        <tr>
                           <td>
                              
                           Total
                           </td>

                           <td>
                              
                              <input type="text"  id="memptotal0" class="form-control txt " maxlength='10' value="<?=@$fields->no_of_emp_mtotal[0]?>" name="no_of_emp_mtotal[]" readonly placeholder="Total">
                             
                           </td>
                           <td>
                              
                              <input type="text"  id="femptotal0" class="form-control txt " maxlength='10' value="<?=@$fields->no_of_emp_ftotal[0]?>" name="no_of_emp_ftotal[]" readonly placeholder="Total">
                           </td>
                        </tr>

                        </tbody>
                     </table>


                  <?php
                  }
                   else{
                   echo '<div class="col-md-12">
                            <div class="form-group">
                                 <input type="text"  class="form-control txt " readonly value="No Records..." placeholder="No Records...">
                            </div>
                         </div>';
                  }
                  ?>
                  </div>
            </frameset>
         </div>
     


 <div class="row">&nbsp;</div>

      <fieldset title="Step 3" class="step" id="default-step-2" >
      
      <div id="heading">Requirements of Land /Space</div>
       <div class="row">
       <div class="col-xs-8 col-sm-6">
           <div class="form-group">
               <label class='control-label'>Do you have land?</label>
                <input type="text"  id="Proposed_details_of_Land" class="form-control txt" readonly value="<?=@$fields->have_own_land?>" name="have_own_land" >

           </div>
       </div>
      <div class="col-xs-8 col-sm-6">
         <div class="form-group">
             <label class='control-label'>Land Type</label>
              <input type="text"  id="Proposed_details_of_Land" class="form-control txt" readonly value="<?=@$fields->Proposed_details_of_Land?>" name="Proposed_details_of_Land" >
            <i class="error"></i>
         </div>
      </div>
   </div>
      <div style="padding-top:10px;"></div>
      <?php 
        if($fields->Proposed_details_of_Land=='Rented Space'){
            echo " <div id='heading' class='dt_land'>Details of Leased/Rented Space</div>";
            ?>
            <div class="land_leased">
               <fieldset>
                <div class="form-group col-md-6">
                 <label> Area In sq Meters</label>
                   <input type="text"  name="detail_of_leased_space_area_in_sq_meters" id="detail_of_leased_space_area_in_sq_meters" class="form-control txt " readonly value="<?=@$fields->detail_of_leased_space_area_in_sq_meters?>"  placeholder="* Land in Acres">
                   <i class="error"></i>
                </div>
                <div class="form-group col-md-6">
                 <label>Address</label>
                   <input type="text"  id="detail_of_leased_address" class="form-control txt " readonly value="<?=@$fields->detail_of_leased_address?>" name="detail_of_leased_address" placeholder="Address">
                   <i class="error"></i>
                </div>
                <div class="form-group col-md-6">
                 <label>Tehsil</label>
                   <input type="text"  id="detail_of_leased_space_tehsil" class="form-control txt " readonly value="<?=@$fields->tehsil?>" name="detail_of_leased_space_tehsil" placeholder="Tehsil">
                   <i class="error"></i>
                </div>
                <div class="form-group col-md-6">
                   <label>District</label>
                   <?php
                      $distric_name=DistrictExt::getDistricNameById($fields->land_disctric);

                   ?>
                   <input type="text"  id="land_disctric" class="form-control txt " readonly value="<?=@$distric_name?>" name="land_disctric" placeholder="District">
                   <i class="error"></i>
                </div>
             </fieldset>
            </div>
         <?php 
         }
         else{
            echo " <div id='heading' class='dt_land'>Detail of Land</div>";
            ?>
               <div class="land_leased_other">
                  <fieldset>
                     <div class="form-group col-md-6">
                      <label> Land in Sq. Meters</label>
                        <input type="text"  name="Land_in_Heetares" id="Land_in_Heetares" class="form-control txt " readonly value="<?=@$fields->Land_in_Hectares?>"  placeholder="* Land in Acres">
                        <i class="error"></i>
                     </div>
                     <div class="form-group col-md-6">
                      <label>Address</label>
                        <input type="text"  id="land_address" class="form-control txt " readonly value="<?=@$fields->land_address?>" name="land_address" placeholder="Address">
                        <i class="error"></i>
                     </div>
                       <?php
                          if (isset($fields->land_area_pin_code)) {
                              ?>
                              <div class="land_leased_other col-xs-8 col-sm-6">
                                  <div class="form-group">
                                      <label class="control-label check_no_own_land_lable"><sup>*</sup>Pin Code </label>
                                      <input type="text"  name="land_area_pin_code" id="land_area_pin_code" class="six_digit_zip_code form-control" value="<?= @$fields->land_area_pin_code ?>" placeholder="* Value">
                                      <i class="error"></i>
                                  </div>
                              </div>
                              <?php
                          }
                          if (isset($fields->Khasra_no)) {
                              ?>
                              <div class="col-xs-8 col-sm-6">
                                  <div class="form-group">
                                      <label class="control-label"><sup>*</sup>Plot/Khasra No</label>
                                      <input type="text"  id="Khasra_no" class="form-control address_field_with_space" maxlength="100" value="<?= @$fields->Khasra_no ?>" name="Khasra_no" placeholder="* Khasra_no">
                                      <i class="error"></i>
                                  </div>
                              </div>
                          <?php } ?>
                     <div class="form-group col-md-6">
                      <label>Tehsil</label>
                        <input type="text"  id="tehsil" class="form-control txt " readonly value="<?=@$fields->tehsil?>" name="tehsil" placeholder="Tehsil">
                        <i class="error"></i>
                     </div>
                     <div class="form-group col-md-6">
                        <label>District</label>
                          <?php
                           $distric_name=DistrictExt::getDistricNameById($fields->land_leased_disctric);

                        ?>
                        <input type="text"  id="land_leased_disctric" class="form-control txt " readonly value="<?=@$distric_name?>" name="land_leased_disctric" placeholder="District">
                        <i class="error"></i>
                     </div>
                  </fieldset>
               </div>
            <?php
         }
      ?>

       <div id="heading">Existing Approval Details</div>
             <div class="row">
                 <div class="col-md-3"><b>Name of the Department</b></div>
                 <div class="col-md-3"><b>Name of the Approval</b></div>
                 <div class="col-md-3"><b>Reference no of the letter</b></div>
                 <div class="col-md-3"><b>Date of the Approval</b></div>
                 <div id="existingDetailContainer" class="col-md-12">
                 <?php 
                    if(isset($fields->Name_of_the_Department)){
                        foreach ($fields->Name_of_the_Department as $key => $value) {
                              if(empty($fields->Name_of_the_Approval[$key]))
                              continue; 
                            echo '<input readonly name = "Name_of_the_Department['.$key.']" class="custom_text_product_man" type="text" value = "' . $fields->Name_of_the_Department[$key] . '" />
                            <input readonly name = "Name_of_the_Approval['.$key.']" class="custom_text_product_man" type="text" value = "' . $fields->Name_of_the_Approval[$key] . '" />
                            <input readonly name = "Reference_no_of_the_letter['.$key.']" class="custom_text_product_man" type="text" value = "' . $fields->Reference_no_of_the_letter[$key] . '" />
                            <input readonly type="date" name = "Date_of_the_Approval[]" value= "' . $fields->Date_of_the_Approval[$key] . '" class="custom_text_product_man" >';
                        }
                    
                    }
                    
                    ?>
                 </div>                  
             </div>
             <div class="row">&nbsp;</div>
             <div id="heading">Required Approvals</div>
              <div class="row">
                 <div class="col-md-6"><b>Name of the Department</b></div>
                 <div class="col-md-6"><b>Name of the Approval</b></div>
                 <div id="aprovalDetailContainer" class="col-md-12">
                 <?php 
                    if(isset($fields->requried_approval_department)){
                                  foreach ($fields->requried_approval_department as $key => $value) {
                                    if(empty($fields->required_approval_name[$key]))
                                       continue; 
                                      echo '<input readonly name = "requried_approval_department['.$key.']" class="custom_text_product_req" type="text" value = "' . $fields->requried_approval_department[$key] . '" />
                                      <input name = "required_approval_name['.$key.']" class="custom_text_product_req" type="text" value = "' . $fields->required_approval_name[$key] . '" />';
                                  }
                    
                              }
                    
                    ?>
                 </div>                  
              </div>
              <div style="padding-top:25px;"></div>


      <div id="heading">Other Requirements</div>
     <div class="row">
        <div class="col-xs-8 col-sm-6">
           <fieldset>
              <div class="row">
                 <div class="col-md-12">
                    <table class="gridtabledoc">
                       <thead>
                          <tr>
                             <th class="text-center">Water Requirement</th>
                             <th class="text-center">Quantity</th>
                             <th class="text-center">Unit</th>
                          </tr>
                          <tr>
                             <td class="text-center">Industrial</td>
                             <td><input type="text" name="industrial_water" value="<?=@$fields->industrial_water?>" readonly class="decimal form-control txt "></td>
                             <td class="text-center">Liters/Year</td>
                          </tr>
                          <tr>
                             <td class="text-center">Domestic</td>
                             <td><input type="text" name="domestic_water" value="<?=@$fields->domestic_water?>" readonly class="decimal form-control txt "></td>
                             <td class="text-center">Liters/Year</td>
                          </tr>
                          <tr>
                             <td class="text-center">Source of water</td>
                             <td colspan="2"><input type="text" name="source_of_water" value="<?=@$fields->source_of_water?>" readonly class="decimal form-control txt "></td>
                          </tr>
                       </thead>
                    </table> 
                 </div>
              </div>
           </fieldset>
        </div>
        <div class="col-xs-8 col-sm-6">
          <div class="row">
             <div class="col-md-12">
                <table class="gridtabledoc">
                   <thead>
                      <tr>
                         <th class="text-center">Source of Fuel</th>
                         <th class="text-center">Quantity</th>
                         <th class="text-center">Unit</th>
                      </tr>
                      <tr>
                         <td class="text-center">Coal</td>
                         <td><input type="text" name="coal" value="<?=@$fields->coal?>" readonly class="decimal form-control txt "></td>
                         <td class="text-center">TONNES</td>
                      </tr>
                      <tr>
                         <td class="text-center">Liquid Petrolium Gas</td>
                         <td><input type="text" name="lpg" value="<?=@$fields->lpg?>"  readonly class="decimal form-control txt "></td>
                         <td class="text-center">KILOGRAM</td>
                      </tr>
                      <tr>
                         <td class="text-center">Electricity</td>
                         <td><input type="text" name="electricity" value="<?=@$fields->electricity?>" readonly class="decimal form-control txt "></td>
                         <td class="text-center">KVA</td>
                      </tr>
                      <tr>
                         <td class="text-center">Solar</td>
                         <td><input type="text" name="solar" value="<?=@$fields->solar?>" readonly class="decimal form-control txt "></td>
                         <td class="text-center">KW</td>
                      </tr>
                   </thead>
                </table> 
             </div>
          </div>
        </div>
     </div>



<?php	
$apprvr_comments= new ApplicationSubmissionExt;
$cmnt=$apprvr_comments->getAprvrComment($data['submission_id']);
?>
<div class="row">
	<div class='col-md-6 comments'>
		<div class='form-group'>
			<label class='control-label'>Previous Level Verifier Comments:</label>
	<?php 
		$roleModel=new RolesExt;
		$uid=$_SESSION['uid'];
		if(!empty($cmnt))
			foreach ($cmnt as $cmnt) {
				$role=$roleModel->getUserRoleViaId($cmnt['next_role_id']);
				if(empty($cmnt['approval_user_comment']))
					echo "<textarea class='form-control txt  comment_section' readonly='readonly' >No Comments</textarea>";
				else{
					echo "<textarea class='form-control txt  comment_section' readonly='readonly' >$role[role_name]: $cmnt[approval_user_comment]</textarea>&nbsp;&nbsp;";
				}
			}
			else
				echo "<textarea class='form-control txt  comment_section' readonly='readonly'>No Comments</textarea>";
	?>
		</div>
	</div>
	<div class='col-md-6'>
		<div class='form-group'>
			<label class='control-label'>Approver Comments:</label>
			<textarea class='form-control txt  apprvr_comments' placeholder="Approver Comments&hellip;" required id="apprvr_comments" name='apprvr_comments'></textarea>
		</div>
		<div class="row" id="error_comnt" style="color:red"></div>
	</div>
	<?php 
	/* echo "<pre>";
	print_r($_SESSION); */
	
	//$role_id = $_SESSION['role_id'];
	$dept_id = $_SESSION['dept_id'];
	$application_sub_id = $_GET['application_sub_id'];
	
	//$sqlCreateDate ="select created_on from bo_application_forward_level where next_role_id IN ('3','5') and forwarded_dept_id=$dept_id and app_Sub_id=$application_sub_id";

	$sqlCreateDate ="select bo_app_forlevel.created_on from bo_application_forward_level bo_app_forlevel left join bo_application_submission as bo_appsub on bo_appsub.submission_id=bo_app_forlevel.app_Sub_id where bo_app_forlevel.next_role_id IN ('3','5') and bo_app_forlevel.forwarded_dept_id=$dept_id and bo_app_forlevel.app_Sub_id=$application_sub_id and bo_app_forlevel.approv_status='P' and bo_appsub.application_status in ('I','B','H','A','Z','R','P')";
	
	$connection = Yii::app()->db; 
	$command = $connection->createCommand($sqlCreateDate);
	$resArr = $command->queryRow();
	$date = $resArr['created_on'];
	$afterAdd15Days = date('Y-m-d H:i:s', strtotime($date. ' + 15 days'));
	$currentDate = date('Y-m-d H:i:s');
	if(isset($resArr) && !empty($resArr))
	{
	if(strtotime($currentDate) > strtotime($afterAdd15Days))
	{
	?>
		<div class='col-md-6'>
			<div class='form-group'>
				<label class='control-label'>Reason for Delay:</label>
				<input type="text" name="reason_for_delay" id="reason_for_delay" class='form-control txt  reason_delay'>
			</div>
			<div class="row" id="reason_error_comnt" style="color:red"></div>
		</div>
	<?php } 
	}?>
</div>	
<?php
    $status_pen=false;
   if(isset($docs) && !empty($docs)){
      echo "<div class='row'>&nbsp;</div><div id='heading'>Uploaded Documents</div>";
      echo "<table class='gridtabledoc'>
                     <thead>
                           <tr>
                              <th>Document Name</th>
                              <th>View/Download</th>
                              <th>Status</th>
                              <th>Action</th>
                           </tr>";
      foreach ($docs as $doc) {
         if(empty($doc))
            continue;
          if($doc['status']===200){
          echo "<tr>
                        <td>$doc[doc_name]</td>";
                        echo "<td><a href='".Yii::app()->createAbsoluteUrl('admin/DownloadDocuments/appDocuments/application/'.base64_encode($data['application_id']).'/user/'.base64_encode($data['user_id']).'/document/'.base64_encode($doc['cdn_doc_id']))."'>Download</a></td>
                        <td>";
                        echo "<span class='label label-danger'>";
                        if($doc['doc_status']=='P')
                           echo "Pending for verification";
                        elseif($doc['doc_status']=='V')
                           echo "Verified";
                        elseif($doc['doc_status']=='R')
                           echo "Rejected";
                        echo "</span></td>
                        <td colspan='5'>";
                            if($doc['doc_status']=='P'){
                                $status_pen=true;
                                echo "<div class='form-inline'>";
                                echo "<form class='submit_doc form-group' action='".Yii::app()->createAbsoluteUrl('/admin/ApplicationView/verifyDocuments')."' method='POST'>
                              <input type='hidden' class='verify_documents' name='document_doc_id' value='".$doc['cdn_doc_id']."'>
                              <input type='hidden' class='application_id' name='application_id' value='".$data['application_id']."'>
                              <input type='hidden' class='submit_user_id' name='submit_user_id' value='".$data['user_id']."'>
                              <input type='hidden' class='submit_user_id' name='application_submit_id' value='".$data['submission_id']."'>
                              <input type='submit' class='btn btn-primary' value='Verify Document'>
                                </form>";
                               echo " &nbsp;&nbsp;<form class='submit_doc form-group' action='".Yii::app()->createAbsoluteUrl('/admin/ApplicationView/rejectDocuments')."' method='POST'>
                              <input type='hidden' name='document_doc_id' value='".$doc['cdn_doc_id']."'>
                              <input type='hidden' class='application_id' name='application_id' value='".$data['application_id']."'>
                              <input type='hidden' class='submit_user_id' name='submit_user_id' value='".$data['user_id']."'>
                              <input type='hidden' class='submit_user_id' name='application_submit_id' value='".$data['submission_id']."'>
                              <input type='submit' class='btn btn-danger' value='Reject Document'>
                               </form>";
                              echo "&nbsp;&nbsp;<a href='#' class='forward_to_next_level btn btn-default form-group'>Forward to Next Level</a>";
                        }
                        echo "</div></td>


               </tr>";
         }
         else
          continue;
   }
   echo "</table>";
}
else
echo "No documents";
$status_pen=false;
?>

<div class="row ">
	<div class="file_error" style="color:red">
	</div>
</div>



<div class="row"> &nbsp;</div>
<div id="heading">Verifier Documents</div>
	<div class="row">
		<?php 
			if(isset($verifier_docs) && !empty($verifier_docs)){
				echo "<label class='control-label col-md-4'>Uploaded Documents</label>";
				foreach ($verifier_docs as $doc) {
				  echo "<div class='row'>";
				        echo "<div class='col-md-12'>
					    		<div class='col-md-3'>
					            	<div class='fileupload fileupload-new'>
					                	<div class='fileupload-preview fileupload-exists thumbnail' style='max-width: 200px; max-height: 150px; line-height: 20px;'>
					                    	<img src='data:".$doc->document_mime_type.";base64, $doc->document' />
					                    </div>
					                </div>
					            </div>
					        <div>
					   </div>";
				}
			}
			else{
				echo "<div class='row'>
						<div class='col-md-6'>
						 <label class='control-label col-md-3' > No Documents</label>
						</div>
					 </div>";
			}

		  echo "<div class='row'>
		  	  	<div class='col-md-12'>
		  	  		<div class='col-md-6'>
		  	  	  		<frameset><legend>Upload Documents</legend>
		  	  	  	</div>
		  	  	  	<div class='row'>&nbsp;</div>
		  	  			<div class='col-md-6'>";
		  	  				echo "<form action='".Yii::app()->createUrl('admin/ApplicationView/uploadVerifierDocs')."'  enctype='multipart/form-data' class='form-inline' name='verify_doc' method='post'>";
		  	  				echo "<input type='hidden' name='ApplicationField[sub_id]' value='$data[submission_id]'>";
		  					echo "<input type='file' class='form-control txt ' name='verifier_files'>&nbsp;&nbsp;";
		  					echo "<input type='submit' value='upload' class='btn btn-primary'>";
		  					echo "</form>";
		  		  echo "</div>";
		  	     echo "</frameset>
		  	    </div>
		  	 </div>";
		?>
	</div>
   <div class="row application_action_options" <?php if($status_pen) echo "style='display:none'";?>>
      <div class="row application_action_options" <?php if($status_pen) echo "style='display:none'";?>>
         <div class='col-md-12 text-center'>
            <div class='form-group'>   
               <a class="btn btn-shadow btn-info" id="revert_back_dept"> Revert Back </a>
               <a class="btn btn-shadow btn-success" href="<?php echo Yii::app()->createAbsoluteUrl('admin/ApplicationView/downloadapp/id/');echo "/".$data['submission_id']."/name/".$app_name['application_name'];?>"> <i class='fa fa-print'></i>  Print</a>
            </div>   
         </div>   
      </div>   
   </div>
</div>
<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="forward_to_multi_dept" class="modal fade">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Select the Departments</h4>
         </div>
         <div class="modal-body">
         <div class="row"

         <?php $role_id=''; $Departments=DefaultUtility::getAllDeptFiltered($data['submission_id'],$role_id);
         echo "<div class='row'>&nbsp;</div><div class='col-md-5'>
         <form action='".Yii::app()->createAbsoluteUrl('admin/ApplicationView/forwardToDept')."' method='post'>
         <select class='form-control txt  MasterSelectBox' multiple></div>";
         foreach ($Departments as $dept) {
               echo "<option value='$dept[dept_id]'>$dept[department_name]</option>";
            }
            echo "</select></div>";
            echo "<div class='col-md-2'><a href='#' class='btn btn-default btn_select' id='btnAdd'>></a>
                     <a href='#' class='btn btn-default btn_select' id='btnRemove'><</a></div>";
            echo "<div class='col-md-5'><select class='PairedSelectBox' required multiple  name='forwardDept[]' style='min-width: 200px;float:left;'>
              </select></div>";
             echo "<input type='hidden' id='sub_id' name='app_sub_id' value='".$data['submission_id']."'>";
         echo "<div class='row'>&nbsp;</div><div class='row'>&nbsp;</div><div class='col-md-12'><textarea class='form-control txt ' name='comments' placeholder='Enter Some Message' required></textarea>";
         ?>
            <div class="row"><span class="select_error"></span></div>
         </div>
         </div>
         <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
            <input type='submit' class="btn btn-success" value="Forward">
            </form>
         </div>
      </div>
   </div>
    </div>
   </fieldset>
</div>


<!-- /Modal -->

<script type="text/javascript">
$(document).ready(function(){
	$(".IUID").before('<div class="row">&nbsp;</div><div id="heading">Company Details Part A</div>');
	$(".md_name").before('<div class="row">&nbsp;</div><div id="heading">details of M.D/Managing Partner/CEO / Lead   Promoter/ Proprietor</div>');
	$(".auth_name").before('<div class="row">&nbsp;</div><div id="heading">Details of Authorized Coordinator/Person</div>');
	$(".fnc_year").before('<div class="row">&nbsp;</div><div id="heading"> Financial Indicators of the Company / Firm for Last 3 Years in Rs. Crores (if any)</div>');
	$(".noforg").before('<div class="row">&nbsp;</div><div id="heading">Organisation Details</div>');
	$(".ntrofunit").before('<div class="row">&nbsp;</div><div id="heading">Investment Details:</div>');
	$(".psname").before('<div class="row">&nbsp;</div><div id="heading">Proposed Product/Service Name</div>');
	$(".duration_of_investment").before('<div class="row">&nbsp;</div><div id="heading">Investment</div>');
	$(".invstmnt_in_year").before('<div class="row">&nbsp;</div><div id="heading">Annual details of Investment (Rs in Crores)</div>');
	$(".means_of_finace_Promoter_equity").before('<div class="row">&nbsp;</div><div id="heading">Means of Finance(Rs. in Crores)</div>');
	$(".borrowed_working_capital").before('<div class="row">&nbsp;</div><div id="heading">Borrowed Working Capital</div>');
	$(".Proposed_details_of_Land").before('<div class="row">&nbsp;</div><div id="heading">Requirements of Land /Space</div>');
	$(".Land_in_Heetares").before('<div class="row">&nbsp;</div><div id="heading" >Detail of Land</div>');
	$(".water_requirement").before('<div class="row">&nbsp;</div><div id="heading">Other Requirements</div>');
	$(".comments").before('<div class="row">&nbsp;</div><div id="heading">Application Comments</div>');

	var dol = $("#Proposed_details_of_Land").val();
	if(dol=="rented"){
		$(".Land_in_Heetares").hide()
		$(".detail_of_plot").hide()
		$(".Location").hide()
		$(".detail_of_leased_space_area_in_sq_meters").show()
		$(".detail_of_leased_space_detail_of_space").show()
		$(".detail_of_leased_space_location").show()
		}
	else{
		$(".Land_in_Heetares").show()
		$(".detail_of_plot").show()
		$(".Location").show()
		$(".detail_of_leased_space_area_in_sq_meters").hide()
		$(".detail_of_leased_space_detail_of_space").hide()
		$(".detail_of_leased_space_location").hide()
	}	
      var url ="<?php echo Yii::app()->createUrl('ajax/alldept');?>";
          getAllDeptAPI(url,'#ApplicationsFieldsMapping_dept_id');
    $('.MasterSelectBox').pairMaster();

    $('#btnAdd').click(function(){
      $('.MasterSelectBox').addSelected('.PairedSelectBox');
    });

    $('#btnRemove').click(function(){
      $('.PairedSelectBox').removeSelected('.MasterSelectBox'); 
    });

})

</script>

<script type="text/javascript">
   $('#revert_back_dept').click(function(e){
            e.preventDefault();
			var reason="";
            if(!confirm("Are you sure you want Revert back Application?"))
               return false;
            var sub_id=$("#sub_id").val();
            if(sub_id!=''){
               var comments=$("#apprvr_comments").val();
               if(comments.length==0){
                  $("#error_comnt").text("Please give comments");
                  return false;
               }
			   <?php
			    if(isset($resArr) && !empty($resArr))
				{
					if(strtotime($currentDate) > strtotime($afterAdd15Days))
					{
				?>
					if($('#reason_for_delay').length){
						var reason=$("#reason_for_delay").val();					
						if(reason.length==0){
							$("#reason_error_comnt").text("Please give reasons for delay");
							return false;
						}
					}else{
						var reason="";
					}
					
				<?php
					}
				}	
				?>
               var url="<?php echo Yii::app()->createUrl('/frontuser/ajax/revertBackToDept');?>";
               var app_id="<?php echo $data['application_id'];?>";
               var data={"app_id":app_id,"sub_id":sub_id,"comments":comments,"reason_for_delay":reason};
               jQuery.ajax({
                  url: url,
                  type: 'POST',
                  dataType: 'json',
                  data: data,
                  success: function (data) {
                     if(data!=''){
                        alert(data.STATUS);
                        $("#error_comnt").empty();
                        $("#error_comnt").show();
                        $("#error_comnt").text(data.status);
                        window.location = "<?php echo Yii::app()->createUrl('/admin');?>";
                     return true;
                     }
                    
                  },
                  error: function (data) {
                      console.log(data);
                  }
              });
            }
         
             
      
   })
</script>
