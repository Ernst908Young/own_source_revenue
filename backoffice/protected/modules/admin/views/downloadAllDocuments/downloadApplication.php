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
   div.heading{
   background-color: #006699;
   text-align: center;
   color:#fff;
   padding-top: 7px;
   padding-bottom: 7px;
   margin-bottom: 20px;
   font-weight: bold;
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
<div class="panel-body">
   <div class="heading">Company Details Part A</div>
   <div class="row">&nbsp;</div>
   <table cellpadding="3" cellspacing="3">
      <tr>
         <td>
            <b>IUID</b>
         </td>
         <td>
            <?=@$fields->IUID?>
         </td>
         <td>
            <b>Company Name</b>
         </td>
         <td>
            <?=@$fields->company_name?>
         </td>
      </tr>
      <tr>
         <td>
            <b>Corresponding Address</b>
         </td>
         <td>
            <?=@$fields->Address?>
         </td>
         <td>
            <b>Pin Code</b>
         </td>
         <td>
            <?=@$fields->pin_code?>
         </td>
      </tr>
      <tr>
         <td>
            <b> Mobile Number</b>
         </td>
         <td>
            <?=@$fields->mob_number?>
         </td>
         <td>
            <b>Telephone Number</b>
         </td>
         <td>
            <?=@$fields->tel_phone?>
         </td>
      </tr>
      <tr>
         <td>
            <b>Email Address</b>
         </td>
         <td>
            <?=@$fields->email?>
         </td>
         <td>
            <b>Fax</b>
         </td>
         <td>
            <?=@$fields->fax?>
         </td>
      </tr>
   </table>
   <div class="row">&nbsp;</div>
   <div class="heading">Details of M.D/Managing Partner/CEO / Lead   Promoter/ Proprietor</div>
   <div class="row">&nbsp;</div>
   <table cellpadding="3" cellspacing="3">
      <tr>
         <td>
            <b>Name of the M.D</b>
         </td>
         <td>
            <?=@$fields->md_name?>
         </td>
         <td>
            <b>Email Address</b>
         </td>
         <td>
            <?=@$fields->md_email?>
         </td>
      </tr>
      <tr>
         <td>
            <b>Mobile Number</b>
         </td>
         <td>
            <?=@$fields->md_mob?>
         </td>
         <td>
            <b>Telephone Number</b>
         </td>
         <td>
            <?=@$fields->md_tel?>
         </td>
      </tr>
      <tr>
         <td>
            <b>fax</b>
         </td>
         <td>
            <?=@$fields->md_fax?>
         </td>
         <td>
            <b>Organisation Category</b>
         </td>
         <td>
            <?=@$fields->org_category?>
         </td>
      </tr>
   </table>
   <div class="row">&nbsp;</div>
   <div class="heading">Details of Authorized Coordinator/Person</div>
   <div class="row">&nbsp;</div>
   <table cellpadding="3" cellspacing="3">
      <tr>
         <td>
            <b>Name</b>
         </td>
         <td>
            <?=@$fields->auth_name?>
         </td>
         <td>
            <b>Designation</b>
         </td>
         <td>
            <?=@$fields->auth_designation?>
         </td>
      </tr>
      <tr>
         <td>
            <b>Email</b>
         </td>
         <td>
            <?=@$fields->auth_email?>
         </td>
         <td>
            <b>Mobile Number</b>
         </td>
         <td>
            <?=@$fields->auth_mob?>
         </td>
      </tr>
      <tr>
         <td>
            <b>Telephone Number</b>
         </td>
         <td>
            <?=@$fields->auth_tel?>
         </td>
         <td>
            <b>Fax Number</b>
         </td>
         <td>
            <?=@$fields->auth_fax?>
         </td>
      </tr>
   </table>
   <div class="row">&nbsp;</div>
   <div class="heading"> Financial Indicators of the Company / Firm for Last 3 Years in Rs. Crores (if any)</div>
   <div class="row">&nbsp;</div>
   <table cellpadding="3" cellspacing="3">
      <tr>
         <td><b>Year</b></td>
         <td><b>Turn Over</b></td>
         <td><b>Profit Before Tax </b></td>
         <td><b>Net Worth</b></td>
         <td><b> Reserves & Surplus </b></td>
         <td><b>Share Capital </b></td>
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
   </table>

   <div class="row">&nbsp;</div>
   <div class="heading">Organisation Details</div>
   <div class="row">&nbsp;</div>
   <table cellpadding="3" cellspacing="3">
      <tr>
         <td><b>Nature Of organisation</b></td>
         <td><?=@$fields->noforg?></td>
      </tr>
      <tr>
         <td><b>Description about company</b></td>
      </tr>
      <tr>
         <td colspan="2" align="justify"><?=@$fields->activity_of_company?></td>
      </tr>
   </table>
   <div class="row">&nbsp;</div>
   <div class="heading">Investment Details</div>
   <div class="row">&nbsp;</div>
   <table cellpadding="3" cellspacing="3">
      <tr>
         <td><b>Natue of Unit</b></td>
         <td><?=@$fields->ntrofunit?></td>
         <td><b>Unit Type</b></td>
         <td><?=@$fields->ntrofunittype?></td>
      </tr>
   </table>
   <div class="row">&nbsp;</div>
   <div class="heading">Proposed Product/Service Name</div>
   <div class="row">&nbsp;</div>
   <table cellpadding="3" cellspacing="3">
      <tr>
         <td><b>SNo</b></td>
         <td colspan="7"><b>Proposed Product/Service</b></td>
      </tr>
      <?php 
         $count=1;
         foreach ($fields->psname as $key => $value) {
          ?>
      <tr>
         <td><?php echo $count++;?></td>
         <td colspan='7'><?=@$fields->psname[$key]?></td>
      </tr>
      <?php
         }
         ?>  
   </table>
   <div class="row">&nbsp;</div>
   <div class="heading">Investment</div>
   <div class="row">&nbsp;</div>
   <table cellpadding="3" cellspacing="3">
      <tr>
         <td><b>Duration of Investment</b></td>
         <td><?=@$fields->duration_of_investment?></td>
         <td><b> Expected date of commercial production</b></td>
         <td colspan="2"><?=@$fields->expected_date_of_commercial_production?></td>
      </tr>
   </table>
   <div class="row">&nbsp;</div>
   <div class="heading">Annual details of Investment (Rs in Crores)</div>
   <div class="row">&nbsp;</div>
   <table cellpadding="3" cellspacing="3">
      <tr>
         <td><b>Year</b></td>
         <td><b>Land</b></td>
         <td><b>Building</b></td>
         <td><b>Plant & Machinery </b></td>
         <td><b>Working Capital Margin</b></td>
         <td><b>Other</b></td>
         <td><b>Total</b></td>
      </tr>
      <?php 
         foreach ($fields->invstmnt_in_year as $key => $value) {
          ?>  
      <tr>
         <td><?=@$fields->invstmnt_in_year[$key]?></td>
         <td><?=@$fields->invstmnt_in_land[$key]?></td>
         <td><?=@$fields->invstmnt_in_building[$key]?></td>
         <td><?=@$fields->invstmnt_in_plant[$key]?></td>
         <td><?=@$fields->invstmnt_in_wrkingcapital[$key]?></td>
         <td><?=@$fields->invstmnt_in_other[$key]?></td>
         <td><?=@$fields->invstmnt_in_total[$key]?></td>
      </tr>
      <?php
         }
         
         ?>
   </table>
   <div class="row">&nbsp;</div>
   <div class="heading">Annual Proposed Employement</div>
   <div class="row">&nbsp;</div>
   <table cellpadding="3" cellspacing="3">
      <tr>
         <td><b>Year</b></td>
         <td><b>Skilled</b></td>
         <td><b>Unskilled</b></td>
         <td><b>Supervisory</b></td>
         <td><b>Engineer</b></td>
         <td><b>IT/ITeS Professional</b></td>
         <td><b>Management</b></td>
         <td><b>Total</b></td>
      </tr>
      <?php 
         foreach ($fields->no_of_emp_year as $key => $value) {
          ?>
      <tr>
         <td><?=@$fields->no_of_emp_year[$key]?></td>
         <td><?=@$fields->no_of_emp_skilled[$key]?></td>
         <td><?=@$fields->no_of_emp_unskilled[$key]?></td>
         <td><?=@$fields->no_of_emp_supervisory[$key]?></td>
         <td><?=@$fields->no_of_emp_engineer[$key]?></td>
         <td><?=@$fields->no_of_emp_it_professional[$key]?></td>
         <td><?=@$fields->no_of_emp_management[$key]?></td>
         <td><?=@$fields->no_of_emp_total[$key]?></td>
      </tr>
      <?php
         }
         ?>
   </table>
   <div class="row">&nbsp;</div>
   <div class="heading">Means of Finance(Rs. in Crores)</div>
   <div class="row">&nbsp;</div>
   <table cellpadding="3" cellspacing="3">
      <tr>
         <td><b>Promoter's Equity</b></td>
         <td><?=@$fields->means_of_finace_Promoter_equity?></td>
         <td><b> Foreign Equity</b></td>
         <td ><?=@$fields->means_of_finace_Foreign_Equity?></td>
      </tr>
      <tr>
         <td><b>Institutions Equity</b></td>
         <td><?=@$fields->means_of_finace_Institutions_Equity?></td>
         <td><b> Term Loan from (Bank/FI)</b></td>
         <td ><?=@$fields->means_of_finace_Bank_terms_Loan?></td>
      </tr>
      <tr>
         <td><b>Others</b></td>
         <td><?=@$fields->means_of_finace_others?></td>
         <td><b>Subsidy/Grants</b></td>
         <td><?=@$fields->means_of_finace_subsidy?></td>
      </tr>
      <tr>
         <td><b>Total</b></td>
         <td><?=@$fields->means_of_finace_total?></td>
      </tr>
   </table>
   <div class="row">&nbsp;</div>
   <div class="heading">Borrowed Working Capital</div>
   <div class="row">&nbsp;</div>
   <table cellpadding="3" cellspacing="3">
      <tr>
         <td><b>Borrowed Working Capital</b></td>
         <td><?=@$fields->borrowed_working_capital?></td>
      </tr>
   </table>
   <div class="row">&nbsp;</div>
   <div class="heading">Requirements of Land /Space</div>
   <div class="row">&nbsp;</div>
   <table cellpadding="3" cellspacing="3">
      <tr>
         <td><b>Proposed details of Land</b></td>
         <td><?=@$fields->Proposed_details_of_Land?></td>
      </tr>
   </table>
   <div class="row">&nbsp;</div>
   <?php 
      if($fields->Proposed_details_of_Land=='rented'){
        echo " <div id='heading' class='dt_land'>Details of Leased/Rented Space</div>";
        ?>
   <table cellpadding="3" cellspacing="3">
      <tr>
         <td><b>Area in Sq. Meters</b></td>
         <td><?=@$fields->detail_of_leased_space_area_in_sq_meters?></td>
         <td><b>Details of Space</b></td>
         <td><?=@$fields->detail_of_leased_space_detail_of_space?></td>
         <td><b>Location</b></td>
         <td><?=@$fields->detail_of_leased_space_location?></td>
      </tr>
   </table>
   <?php  
      }
       
      else{
        echo " <div class='row'>&nbsp;</div> ";
        ?>
   <div class="heading">Detail of Land</div>
   <div class="row">&nbsp;</div>
   <table cellpadding="3" cellspacing="3">
      <tr>
         <td><b>Land in Acres</b></td>
         <td><?=@$fields->Land_in_Heetares?></td>
         <td><b>Details of Plot</b></td>
         <td><?=@$fields->detail_of_plot?></td>
         <td><b>Location</b></td>
         <td><?=@$fields->Location?></td>
      </tr>
   </table>
   <?php
      }
      ?>
  <div class="row">&nbsp;</div>
  <div class="heading">Other Requirements</div>
  <div class="row">&nbsp;</div>
  <table cellpadding="3" cellspacing="3">
     <tr>
        <td><b>Water Requirements</b></td>
        <td><?=@$fields->water_requirement?></td>
        <td><b>Source of Water</b></td>
        <td><?=@$fields->source_of_water?></td>
     </tr>
     <tr>
        <td><b>Electricity Requirements</b></td>
        <td><?=@$fields->electricity_required_load?></td>
        <td><b>Required load</b></td>
        <td><?=@$fields->electricity_unit?></td>
     </tr>
     <tr>
        <td><b>Date of Power Requirement</b></td>
        <td><?=@$fields->date_of_power_of_requirements ?></td>
     </tr>
  </table>
  <div class="row">&nbsp;</div>
  <div class="heading">Comments</div>
  <div class="row">&nbsp;</div>
  <table cellpadding="3" cellspacing="3">
     <tr>
        <td><b>SNo</b></td>
        <td><b>Commenter's Name</b></td>
        <td colspan="5"><b>Comments</b></td>
     </tr>
     <?php
        if(!empty($app_comments)){
          $count=1;
          foreach ($app_comments as $key => $comment) {
            echo "<tr>
              <td>$count</td>
              <td>";
              if(preg_match('/_/', $comment['full_name']))
                 echo ucwords(str_replace('_', ' ', $comment['full_name']));
              else
                echo ucwords($comment['full_name']);
              echo "</td>
              <td colspan='5'>$comment[approval_user_comment]</td>
            </tr>";
            $count++;
          }
        }
        ?>
  </table>
  <div class="row">&nbsp;</div>
  <div class="heading">Other Department Comments</div>
  <div class="row">&nbsp;</div>
  <?php
     /**
        Other Department comments
     */
     $otheDeptCmnt= ApplicationSubmissionExt::getOtherDepartmentComments($data['submission_id']);
     if(!empty($otheDeptCmnt)){
        echo "<table>
                  <tr><th><b>S.No.</b></th><th><b>Forwarded Dept Name</b></th><th><b>Verifier Name</b></th><th><b>Comments</b></th></tr>";
                           $count=1;
        foreach ($otheDeptCmnt as $key => $value) {
           $dept_name=DepartmentsExt::getDeptbyId($value['forwarded_dept_id']);
           $uname=UserExt::getUNameviaIdMap($value['verifier_user_id']);
           if(preg_match('/_/', $uname))
              $uname=ucwords(str_replace('_', ' ', $uname));
           echo "<tr><td>".$count++."</td><td>$dept_name[department_name]</td><td>$uname</td><td>";
           if(empty($value['verifier_user_comment'])){
              echo "No comments yet";
           }
           else
              echo "$value[verifier_user_comment]</td></tr>";
                       
        }
        echo "</table>";
     }
    /**
      investor's documents
    */
   ?>

</div>