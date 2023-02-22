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
</style><?php $fields=json_decode($data['field_value']);?>

   
   <div class="row">&nbsp;</div>


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
       <?php $nicname= ApplicationExt::getV_Name(@$fields->industry_type) ?>
      <tr>
      <td>Sectorial Code (NIC)</td>
      <td colspan="5"><?php echo $nicname?></td>
      </tr>
   </table>
   <?php 
   if(isset($fields->ntrofunit) && $fields->ntrofunit=='Services'){
      ?>
         <div class="row">&nbsp;</div>
         <div class="heading">Proposed Product/Service Name</div>
         <div class="row">&nbsp;</div>

         <table cellpadding="3" cellspacing="3"  border="1" class="gridtable">
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
 <table cellpadding="2" cellspacing="0" border="0" class="gridtable">
      <tr>
     <th colspan="6">Process Description</th></tr>
      <tr>
         <td colspan="2">Type of Industry</td>
         <td colspan="1"><?=@$fields->type_of_industry?></td>
         <td colspan="2"> Expected date of production</td>
         <td colspan="1"><?=@$fields->expected_date_of_commercial_production?></td>
      </tr>
     <tr>
       <td colspan="3">Brief Description about processes</td>
       <td colspan="3"><?=@$fields->Brief_Description_about_Processes?></td>
     </tr>
   </table>
      <?php
   }
   ?>

 
   
</div>

