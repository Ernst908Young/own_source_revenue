<?php
// ob_start(); 
?>
<style type="text/css">
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
   td.heading{
    font-family: verdana,arial,sans-serif;
   
   padding: 8px;
   
   background-color: #dedede;
   text-align: center;
   font-weight: bold;
   font-size: 1.0em;
   }
   
    div.heading{
      border-width: 1px solid;
   padding: 8px;
   border-style: solid;
   border-color: #000000;
   background-color: #dedede;
   text-align: center;
   font-size: 1.1em;
   }

table.gridtable {
   font-family: verdana,arial,sans-serif;
   font-size: 1.3em;
   color:#333333;
   width: 100%;
   border-width: 1px solid;
   border-color: #000000;

   
}
table.gridtable th {
   border-width: 1px solid;
   padding: 8px;
   border-style: solid;
   border-color: #000000;
   background-color: #dedede;
   text-align: center;
   font-size: 0.9em;
   
}
table.gridtable td {
   
   
   font-size: 0.8em;
}

.brtd, th, td{
border: 1px solid black;
border-collapse: collapse;
   
}

 .ack{
   font-size: 1.3em;
   font-weight: 800;
   height: 20px;
   text-align: center;
   }

   .control-label{
   font-size: 0.9em;
   font-weight: 800;
   height: 20px;
   text-align: left;
   }
   ::-webkit-input-placeholder { font-size:.9em;font-weight: bold }
   ::-moz-placeholder { font-size:.9em; font-weight: bold}
   :-ms-input-placeholder { font-size:.9em; font-weight: bold}
   input:-moz-placeholder { font-size:.9em; font-weight: bold}
</style>
<?php $fields=json_decode($data['field_value']);?>
<div class="ack" align="center" >Acknowledgement of CAF</div></br>


   <table cellpadding="2" cellspacing="0" border="0" class="gridtable">
      <tr>
      <td>CAF ID</td>
      <td colspan="2"><?php echo $data['submission_id'] ?></td>
      <td>CAF Date</td>
      <td colspan="2"><?php echo $data['application_created_date'] ?></td>
    </tr>
   <tr>
   <th colspan="6"> Enterprise Details </th>
   
   </tr>
      <tr>
         <td>IUID</td>
         <td colspan="2"><?=@$fields->IUID?></td>
         <td>Enterprise Name</td>
         <td colspan="2"><?=@$fields->company_name?></td>
        
      </tr>
      <tr>
         <td>Corresponding Address</td>
         <td colspan="2"><?=@$fields->Address?></td>
         <td>Pin Code</td>
         <td colspan="2"><?=@$fields->pin_code?></td>
      </tr>
      <tr>
         <td>Mobile Number</td>
         <td colspan="2"><?=@$fields->mob_number?></td>
         <td>Telephone No</td>
         <td colspan="2"><?=@$fields->tel_phone?></td>
      </tr>
      <tr>
         <td>Email Address</td>
         <td colspan="2"><?=@$fields->email?></td>
         <td>Fax</td>
         <td colspan="2"><?=@$fields->fax?></td>
      </tr>
  
   <tr>
   <th colspan="6">Details of M.D/Managing Partner/CEO/Lead Promoter/Proprietor</th>
  </tr>
    
    <tr>
         <td>Name</td>
         <td><?=@$fields->md_name?></td>
         <td>Designation</td>
         <td><?=@$fields->designation?></td>
         <td>Email Address</td>
         <td><?=@$fields->md_email?></td>
      </tr>
  
     
      <tr>
         <td>Mobile Number</td>
         <td colspan="2"><?=@$fields->md_mob?></td>
         <td>Telephone No</td>
         <td colspan="2"><?=@$fields->md_tel?></td>
      </tr>
      <tr>
         <td>fax</td>
         <td colspan="2"><?=@$fields->md_fax?></td>
         <td>Category</td>
         <td colspan="2"><?=@$fields->org_category?></td>
      </tr>
    
   <tr>
   <th colspan="6">Details of Authorized Coordinator/Person</th>
  </tr>
        <tr>
         <td>Name</td>
         <td colspan="2"><?=@$fields->auth_name?></td>
         <td>Designation</td>
         <td colspan="2"><?=@$fields->auth_designation?></td>
      </tr>
      <tr>
         <td>Email</td>
         <td colspan="2"><?=@$fields->auth_email?></td>
         <td>Mobile Number</td>
         <td colspan="2"><?=@$fields->auth_mob?></td>
      </tr>
      <tr>
         <td>Telephone No</td>
         <td colspan="2"><?=@$fields->auth_tel?></td>
         <td>Fax Number</td>
         <td colspan="2"><?=@$fields->auth_fax?></td>
      </tr>
   
   <tr>
   <th colspan="6"> Financial Indicators of the Company / Firm for Last 3 Years in INR Lakhs (if any)</th>
 </tr>
   
      <tr>
         <td>Year</td>
         <td>Turn Over</td>
         <td>Profit Before Tax </td>
         <td>Net Worth</td>
         <td> Reserves & Surplus </td>
         <td>Share Capital </td>
      </tr>
      <?php
         if(isset($fields->fnc_year)){
          foreach ($fields->fnc_year as $key=>$value) { 
            ?>
      <tr>
         <td><?=@$fields->fnc_year[$key]?></td>
         <td><?=@$fields->fnc_turnover[$key]?></td>
         <td><?=@$fields->fnc_prftBfrTax[$key]?></td>
         <td><?=@$fields->fnc_netWrth[$key]?></td>
         <td><?=@$fields->fnc_rsrvSrpls[$key]?></td>
         <td><?=@$fields->fnc_sharCaps[$key]?></td>
      </tr>
      <?php   
         }
         }
         ?>
 

   <tr>
   <th colspan="6">Organisation Details</th>
   </tr>
   
        <tr>
         <td colspan="3">Nature Of organisation</td>
         <td colspan="3"><?=@$fields->noforg?></td>
      </tr>
      <tr>
         <td colspan="3">Project Status</td>
         <td colspan="3"><?=@$fields->project_status?></td>
      </tr>
         <tr>
         <td colspan="3">Description about company</td>
         <td colspan="3"><?=@$fields->activity_of_company?></td>
      </tr>
   
   <tr>
   <th  colspan="6">Investment Details</th>
   </tr>
   
      <tr>
         <td>Natue of Unit</td>
         <td colspan="2"><?=@$fields->ntrofunit?></td>
         <td>Unit Type</td>
         <td colspan="2"><?=@$fields->ntrofunittype?></td>
      </tr>
   </table>
   <?php 
   if(isset($fields->ntrofunit) && $fields->ntrofunit=='Services'){
      ?>
         <div class="row">&nbsp;</div>
         <div class="heading">Proposed Product/Service Name</div>
         <div class="row">&nbsp;</div>

         <table cellpadding="2" cellspacing="0"  border="1" class="gridtable">
            <tr>
               <td>SNo</td>
               <td colspan="7">Proposed Product/Service</td>
            </tr>
            <?php 
            if(isset($fields->product_service_name)){
               $count=1;
               foreach ($fields->product_service_name as $key => $value) {
                ?>
            <tr>
               <td><?php echo $count++;?></td>
               <td colspan="7"><?=@$fields->product_service_name[$key]?></td>
            </tr>
            <?php
               }}
               ?>  
         </table>

      <?php
   }
   ?>
    <?php 
   if(isset($fields->ntrofunit) && $fields->ntrofunit=='Manufacturing'){
      ?>
         
         <div class="heading">Raw Material Detail</div>
         

         <table cellpadding="2" cellspacing="0"  border="0" class="gridtable">

         
            
            <tr>
               <td>Name of the Raw Material</td>
               <td>Annual Requirement Unit</td>
               <td>Quantity</td>

            </tr>
            <?php 
            if(isset($fields->Name_of_the_Raw_Material)){
               foreach ($fields->Name_of_the_Raw_Material as $key => $value) {
                ?>
            <tr>
               <td><?=@$fields->Name_of_the_Raw_Material[$key]?></td>
               <td><?=@$fields->Annual_Requirement_Unit[$key]?></td>
               <td><?=@$fields->material_quantity[$key]?></td>
            </tr>

            <?php
               }
             }
               ?>  
         </table>


         
         <div class="heading">Products to be Manufactured</div>
         
         <table cellpadding="2" cellspacing="0"  border="0" class="gridtable">
            <tr>
               <td>Product Description</td>
               <td>Annual Install Capacity</td>
               <td>Quantity</td>
               <td>NIC Code</td>
            </tr>
            <?php 
            if(isset($fields->Product_Description)){
               foreach ($fields->Product_Description as $key => $value) {
                ?>
            <tr>
               <td><?=@$fields->Product_Description[$key]?></td>
               <td><?=@$fields->Annual_Install_Capacity[$key]?></td>
               <td><?=@$fields->product_manufactured_Quantity[$key]?></td>
               <td><?=@$fields->NIC_Code[$key]?></td>
            </tr>
            <?php
               }}
          ?>  
         </table>

      <?php
   }
   ?>
 <table cellpadding="2" cellspacing="0" border="0" class="gridtable">
      <tr>
     <th colspan="6">Process Description</th></tr>
      <tr>
         <td colspan="2">Type of Industry</td>
         <td colspan="1"><?=@$fields->type_of_industry?></td>
         <td colspan="2"> Expected date of production</td>
         <td colspan="1"><?=@$fields->expected_date_of_commercial_production?></td>
      </tr>
   </table>
 
   
   
   <table cellpadding="2" cellspacing="0"  border="0" class="gridtable">
     <tr>
     <th colspan="6">Details of Investment (Rs in Crores)</th></tr>
      <tr>
         <td>Land</td>
         <td>Building</td>
         <td>Plant & Machinery </td>
         <td>Capital Margin</td>
         <td>Other</td>
         <td>Total</td>
      </tr>
      <?php
         if(isset($fields->invstmnt_in_land)){ 
         foreach ($fields->invstmnt_in_land as $key => $value) {
          ?>  
      <tr>
         <td align="right"><?=@$fields->invstmnt_in_land[$key]?></td>
         <td align="right"><?=@$fields->invstmnt_in_building[$key]?></td>
         <td align="right"><?=@$fields->invstmnt_in_plant[$key]?></td>
         <td align="right"><?=@$fields->invstmnt_in_wrkingcapital[$key]?></td>
         <td align="right"><?=@$fields->invstmnt_in_other[$key]?></td>
         <td align="right"><?=@$fields->invstmnt_in_total[$key]?></td>
      </tr>
      <?php
         }
         }
         ?>
   </table>
  
    <table cellpadding="2" cellspacing="0"  border="0" class="gridtable">
    <tr>
     <th colspan="6">Annual Proposed Employement</th></tr>
          <tr>
             <td colspan="2" class="text-center">Employment</td>
             <td colspan="2" class="text-center">Male</td>
             <td colspan="2" class="text-center">Female</td>
          </tr>
       <tr>
          <td colspan="2">Skilled</td>
          <td colspan="2"><?=@$fields->no_of_emp_mskilled[0]?></td>
          <td  colspan="2"><?=@$fields->no_of_emp_fskilled[0]?></td>
       </tr>
       <tr>
        <td colspan="2">Unskilled</td>
          <td  colspan="2"><?=@$fields->no_of_emp_munskilled[0]?></td>
          <td  colspan="2"><?=@$fields->no_of_emp_funskilled[0]?></td>
       </tr>
       <tr>
          <td colspan="2">Supervisory</td>
          <td  colspan="2"><?=@$fields->no_of_emp_msupervisory[0]?></td>
          <td  colspan="2"><?=@$fields->no_of_emp_fsupervisory[0]?></td>
       </tr>
       <tr>
          <td colspan="2">Engineer</td>
          <td  colspan="2"><?=@$fields->no_of_emp_mengineer[0]?></td>
          <td  colspan="2"><?=@$fields->no_of_emp_fengineer[0]?></td>
       </tr>
       <tr>
          <td colspan="2">IT/ITeS Professional</td>
          <td  colspan="2"><?=@$fields->no_of_emp_it_mprofessional[0]?></td>
          <td  colspan="2"><?=@$fields->no_of_emp_it_fprofessional[0]?></td>
       </tr>
       <tr>
          <td colspan="2">Management</td>
          <td  colspan="2"><?=@$fields->no_of_emp_mmanagement[0]?></td>
          <td  colspan="2"><?=@$fields->no_of_emp_fmanagement[0]?></td>
       </tr>
       <tr>
          <td colspan="2">Total</td>
          <td  colspan="2"><?=@$fields->no_of_emp_mtotal[0]?></td>
          <td  colspan="2"><?=@$fields->no_of_emp_ftotal[0]?></td>
       </tr>

    </table>
    
  
   <div class="heading">Requirements of Land /Space</div>
   
   <table cellpadding="2" cellspacing="0" border="0" class="gridtable">
   
      <tr>
         <td>Proposed details of Land</td>
         <td><?=@$fields->Proposed_details_of_Land?></td>
      </tr>
   </table>


   <?php 
      if($fields->Proposed_details_of_Land=='rented'){
        echo " <div id='heading' class='dt_land'>Details of Leased/Rented Space</div>";
        $distric_name=DistrictExt::getDistricNameById($fields->land_disctric);

        ?>
   <table cellpadding="2" cellspacing="0" class="gridtable">
      <tr>
         <td>Area in Sq. Meters</td>
         <td><?=@$fields->detail_of_leased_space_area_in_sq_meters?></td>
         <td>Address</td>
         <td><?=@$fields->detail_of_leased_address?></td>
       </tr>
       <tr>
         <td>Tehsil</td>
         <td><?=@$fields->detail_of_leased_space_tehsil?></td>
          <td>Distric</td>
         <td><?=@$distric_name?></td>
      </tr>
   </table>

   <?php  
      }
       
      else{
       // echo " <div class='row'>&nbsp;</div> ";
        $distric_name=DistrictExt::getDistricNameById($fields->land_leased_disctric);

        ?>
   <div class="heading">Detail of Land</div>
   
   <table cellpadding="2" cellspacing="0" border="0" class="gridtable">
      <tr>
         <td>Land in Sq. Meters</td>
         <td><?=@$fields->Land_in_Hectares?></td>
         <td>Tehsil</td>
         <td><?=@$fields->tehsil?></td>
          <td>District</td>
         <td><?=@$distric_name?></td>
      </tr>
    <tr>
      <?php
         if(isset($fields->land_area_pin_code)) {
             ?>
       <td>Pin Code</td>
         <td><?=@$fields->land_area_pin_code?></td>
        <?php
         }
        else{
        echo "<td>&nbsp;</td>";
        }
       ?>
         <?php
         if(isset($fields->Khasra_no)) {
             ?>
       <td>Khasra No</td>
         <td><?=@$fields->Khasra_no?></td>
        <?php
         }
        else{
        echo "<td>&nbsp;</td>";
        }
 echo "<td>&nbsp;</td>";
  echo "<td>&nbsp;</td>";
       ?>
      </tr>

      <tr>
         <td >Address</td>
         <td colspan="5" ><?=@$fields->land_address?></td>
      </tr>
   </table>

   <?php
      }
      ?>
 
  <div class="heading">Other Requirements</div>
 
  <table border="0" cellpadding="2" cellspacing="0" class="gridtable">
<tr>
<td>Type of Water</td>
<td >Quantity</td>
<td >Unit</td>
<td >Source of Energy</td>
<td >Quantity</td>
<td >Unit</td>
</tr>
     <tr>
        <td>Industrial Water</td>
        <td><?=@$fields->industrial_water?></td>
        <td>Liters/Year</td>

        <td >Coal</td>
        <td ><?=@$fields->coal?></td>
        <td >KILOGRAM</td>

        </tr>
        <tr>
        <td>Domestic Water</td>
        <td ><?=@$fields->domestic_water?></td>
        <td>Liters/Year</td>

        <td >LPG</td>
        <td ><?=@$fields->lpg?></td>
        <td >TONNES</td>

        </tr>
        <tr>
        <td>Source of Water</td>
        <td colspan="2"><?=@$fields->source_of_water?></td>
        <td >Electricity</td>
        <td ><?=@$fields->electricity?></td>
        <td >KVA</td>
      </tr>


    

      <tr>
      <td colspan="3"></td>
        <td >Solar</td>
        <td ><?=@$fields->solar?></td>
        <td >KWH</td>
      </tr>


  </table>
  


  <div class="heading">Existing Approval Details</div>
  
  <table cellpadding="2" cellspacing="0"  border="0" class="gridtable">
     <tr>
      <td>Name of the Department</td>
      <td>Name of the Approval</td>
      <td>Reference no of the letter</td>
      <td>Date of the Approval</td>
     </tr>
      <?php 
      if(isset($fields->Name_of_the_Department)){
         foreach ($fields->Name_of_the_Department as $key => $value) {
          ?>
      <tr>
         <td><?=@$fields->Name_of_the_Department[$key]?></td>
         <td><?=@$fields->Name_of_the_Approval[$key]?></td>
         <td><?=@$fields->Reference_no_of_the_letter[$key]?></td>
         <td><?=@$fields->Date_of_the_Approval[$key]?></td>
      </tr>
      <?php
         }
         }
         ?>
  </table>
  
  <div class="heading">Required Approvals</div>
  
  <table cellpadding="2" cellspacing="0"  border="0" class="gridtable">
     <tr>
      <td>Name of the Department</td>
      <td>Name of the Approval</td>
     </tr>
      <?php 
      if(isset($fields->requried_approval_department)){
         foreach ($fields->requried_approval_department as $key => $value) {
          ?>
      
      <tr>
         <td><?=@$fields->requried_approval_department[$key]?></td>
         <td><?=@$fields->required_approval_name[$key]?></td>
      </tr>
      <?php
         }}
         ?>
   </table>
   <?php
   if($fields->ntrofunittype!='micro'){
    $critera= new CDbCriteria;
    $critera->condition="app_sub_id=:app_sub_id";
    $critera->params=array(":app_sub_id"=>$data['submission_id']);
    $critera->order="payment_id DESC";
    $checkPay=PaymentDetail::model()->find($critera);
    if(!empty($checkPay)){
      ?>
      
  <div class="heading">Payment Detail</div>
  
      <table cellpadding="2" cellspacing="0" border="0" class="gridtable">
          <tr>
             <td>Order Id</td>
             <td>Transaction Id</td>
             <td>Status</td>
             <td>Amount</td>
             <td>Date Time</td>
          </tr>
       <?php
          $amount=$checkPay->amount/100;
          $statusCode=$checkPay->statusCode;
       ?>
          <tr>
             <td><?=@$checkPay->orderId;?></td>
              <td><?=@$checkPay->pgMeTrnRefNo;?></td>
              <td><?=@$checkPay->status_description;?></td>
              <td><?=@$amount;?></td>
              <td><?=@$checkPay->trnReqDate;?></td>
          </tr>
    </table>

      <?php

    }
   }

   ?>
</div>


<?php
// ob_end_clean();
?>
