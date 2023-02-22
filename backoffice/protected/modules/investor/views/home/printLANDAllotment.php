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
<?php 
  $fields=json_decode($data['field_value']);
    $sql = "SELECT la_auction_detail.auc_id,la_auction_detail.district_id,bo_district.distric_name,bo_district.district_id
      FROM bo_district
      INNER JOIN la_auction_detail
      ON bo_district.district_id=la_auction_detail.district_id
      WHERE la_auction_detail.is_active='Y'
      GROUP BY la_auction_detail.district_id";
  $connection=Yii::app()->db; 
  $command=$connection->createCommand($sql);
  $AustionDistricts=$command->queryAll();

  if(isset($fields->district)){
      $sql = "SELECT la_auction_detail.auc_id,la_estates.land_estate_id,la_estates.land_estate_name,la_estates.estate_area
              FROM la_estates
              INNER JOIN la_auction_detail
              ON la_estates.land_estate_id=la_auction_detail.estate_id
              WHERE la_auction_detail.is_active='Y' 
              AND la_auction_detail.auc_status='O'
              AND la_auction_detail.district_id=$fields->district
              GROUP BY la_auction_detail.estate_id";
      $connection=Yii::app()->db; 
      $command=$connection->createCommand($sql);
      $Plots=$command->queryAll();
      if(!empty($Plots))
          foreach ($Plots as $k => $v)
              $estates[]=array("land_estate_id" => $v['land_estate_id'],'land_estate_name'=>$v['land_estate_name']);
  }

  if(isset($fields->estate)){
      $sql = "SELECT *
              FROM la_auction_plots
              INNER JOIN la_auction_detail
              ON la_auction_plots.auc_plot_id=la_auction_detail.plot_id
              WHERE la_auction_detail.is_active='Y' 
              AND la_auction_detail.auc_status='O'
              AND la_auction_detail.estate_id=$fields->estate";
      $connection=Yii::app()->db; 
      $command=$connection->createCommand($sql);
      $PlotsData=$command->queryAll();
      if(!empty($PlotsData))
        $PlotsArray=array();
        foreach ($PlotsData as $k => $v){
            $now = strtotime(date("Y-m-d"));
            $StartDate = strtotime($v['auc_start_date']);
            $EndDate = strtotime($v['auc_end_date']);

            if($now >= $StartDate && $now <= $EndDate)
                $PlotsArray[]=array("plot_id" => $v['auc_plot_id'],'area_name'=>$v['area_name'],'plot_area'=>$v['plot_area']);
        }
  }
?>
  <br>
  <table cellpadding="2" cellspacing="0" border="0" class="gridtable">
    <tr>
      <td>Land Allotment ID</td>
      <td colspan="2"><?php echo $data['submission_id'] ?></td>
      <td>Land Allotment Date</td>
      <td colspan="2"><?php echo $data['application_created_date'] ?></td>
    </tr>
  </table>
  
  <table cellpadding="2" cellspacing="0" border="0" class="gridtable">
    <tr>
      <th colspan="3" class="heading">Applicant Details</th>
    </tr>
    <tr>
      <td>Applicant Name: <?php echo @$fields->applicant_name;?></td>
      <td>Name of the Firm/Company: <?php echo @$fields->company_name;?></td>
      <td>Constitution of the Firm/Comapany: 
          <?php 
            if(isset($fields->firm_company_constitution) && $fields->firm_company_constitution=="proprietorship_id_47") echo "Proprietorship";
            if(isset($fields->firm_company_constitution) && $fields->firm_company_constitution=="partnership_firm_id_48") echo "Partnership Firm";
            if(isset($fields->firm_company_constitution) && $fields->firm_company_constitution=="limited_liability_partnership_id_49") echo "Limited Liability Partnership";
            if(isset($fields->firm_company_constitution) && $fields->firm_company_constitution=="private_limited_company_id_50") echo "Private Limited Company";
            if(isset($fields->firm_company_constitution) && $fields->firm_company_constitution=="public_limited_company_id_51") echo "Public Limited Company";
            if(isset($fields->firm_company_constitution) && $fields->firm_company_constitution=="cooperative_society_id_52") echo "Cooperative Society";
            if(isset($fields->firm_company_constitution) && $fields->firm_company_constitution=="self_help_group_id_53") echo "Self Help Group";
            if(isset($fields->firm_company_constitution) && $fields->firm_company_constitution=="section_25_company_id_54") echo "Section 25 Company";
            if(isset($fields->firm_company_constitution) && $fields->firm_company_constitution=="one_man_company_id_55") echo "One Man Company";
          ?>
      </td>
    </tr>
    <tr>
      <td>Gender: <?php 
                    if(isset($fields->gender) && $fields->gender=="M") echo "Male";
                    if(isset($fields->gender) && $fields->gender=="F") echo "Female";
                    if(isset($fields->gender) && $fields->gender=="O") echo "Other";
                  ?>
      </td>
      <td>Mobile: <?php echo @$fields->mob_number;?></td>
      <td>Telephone: <?php echo @$fields->tel_phone;?></td>
    </tr>
    <tr>
      <td>Email: <?php echo @$fields->email?></td>
      <td>Fax: <?php echo @$fields->fax;?></td>
      <td>Corresponding Address: <?php echo @$fields->Address;?></td>
    </tr>

    <tr>
      <td>Handicapped: <?php echo @$fields->handicapped?></td>
      <td>Category: <?php echo @$fields->category;?></td>
    </tr>

    <tr>
      <th colspan="3" class="heading">Particulars of Area</th>
    </tr>
    <tr>
      <td>District:<?php 
                    foreach ($AustionDistricts as $k => $v)
                      if ($fields->district == $v['district_id'])
                        echo $v['distric_name'];
                    ?>
      </td>
      <td>Estates: <?php 
                    foreach ($estates as $k => $v)
                      if ($fields->estate == $v['land_estate_id'])
                        echo $v['land_estate_name'];
                  ?>
      </td>
      <td>Available Plots Area in Sq. Meters: <?php 
                                                  if(isset($PlotsArray)){
                                                      $areaArray=array();
                                                      foreach ($fields->area_square_meter as $k => $v)
                                                          $areaArray[]=$v;
                                                      foreach ($PlotsArray as $k => $v)
                                                          if (in_array($v['plot_id'], $areaArray))
                                                            echo $v['area_name']." ( ".$v['plot_area']." )";
                                                  }
                                              ?>
      </td>
    </tr>
    <tr>
      
      <td>Type of Industry: <?php 
                              if(isset($fields->nature_of_area) && $fields->nature_of_area=="new_unit") echo "New Unit";
                              if(isset($fields->nature_of_area) && $fields->nature_of_area=="expansion") echo "Expansion";
                              if(isset($fields->nature_of_area) && $fields->nature_of_area=="modernization") echo "Modernization";
                            ?>
      </td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table cellpadding="2" cellspacing="0" border="0" class="gridtable">
    <tr>
      <th colspan="4" class="heading">Unit Details</th>
    </tr>
    <?php 
        if(isset($fields->proposed_product)){
            foreach ($fields->proposed_product as $k => $v) {
                $proposed_product = $fields->proposed_product;
                $proposed_installed_capacity = $fields->proposed_installed_capacity;
                $proposed_product_unit = $fields->proposed_product_unit;
                echo "<tr>
                        <td>Proposed Product: ".$proposed_product[$k]."</td>
                        <td>Proposed Installed Capacity: ".$proposed_installed_capacity[$k]."</td>
                        <td>Unit: ".$proposed_product_unit[$k]."</td>
                      </tr>";
            }
        }
    ?>
    <tr>
      <td colspan="2">Nature of Project: <?php if(isset($fields->nature_project) && $fields->nature_project=="manufacturing") echo "Manufacturing";?></td>
      <td colspan="2">Projected Sales Unit (1st year): <?=@$fields->projected_sales_unit?></td>
    </tr>
  </table>

  <table cellpadding="2" cellspacing="0" border="0" class="gridtable">
    <tr>
      <th colspan="5" class="heading">Project Cost (Rupees INR)</th>
    </tr>
    <tr>
      <td>Plant and Machinery: <?=@$fields->plant_machinery_invst?></td>
      <td>Building: <?=@$fields->building_construction_invst?> </td>
      <td>Others: <?=@$fields->other_invst?> </td>
      <td>Total Project Cost: <?=@$fields->total_investment?></td>
    </tr>
  </table>

  <table cellpadding="2" cellspacing="0" border="0" class="gridtable">
    <tr>
      <th colspan="5" class="heading">Means of Finance (Rupees INR)</th>
    </tr>
    <tr>
      <td>Equity: <?=@$fields->mean_of_fin_equity?></td>
      <td>Term Loan: <?=@$fields->mean_of_fin_term_loan?></td>
      <td>Assistance From Other Sources: <?=@$fields->mean_of_fin_assistance?></td>
      <td>Working Capital: <?=@$fields->mean_of_fin_grant?></td>
      <td>Total: <?=@$fields->total_means?></td>
    </tr>
  </table>

  <table cellpadding="2" cellspacing="0" border="0" class="gridtable">
    <tr>
      <th colspan="10" class="heading">Proposed Employment Details</th>
    </tr>
    <tr>
        <td colspan="2">Manegerial</td>
        <td colspan="2">Supervisor</td>
        <td colspan="2">Skilled</td>
        <td colspan="2">Unskilled</td>
        <td colspan="2">Total Employment</td>
    </tr>
    <tr>
        <td>Male </td>
        <td>Female </td>
        <td>Male </td>
        <td>Female </td>
        <td>Male </td>
        <td>Female </td>
        <td>Male </td>
        <td>Female </td>
        <td>Male </td>
        <td>Female </td>
    </tr>
    <tr>
        <td><?=@$fields->manegerial_emp_male?></td>
        <td><?=@$fields->manegerial_emp_female?></td>
        
        <td><?=@$fields->supervisor_emp_male?></td>
        <td><?=@$fields->supervisor_emp_female?></td>
        
        <td><?=@$fields->skilled_emp_male?></td>
        <td><?=@$fields->skilled_emp_female?></td>
        
        <td><?=@$fields->unskilled_emp_male?></td>
        <td><?=@$fields->unskilled_emp_female?></td>

        <td><?=@$fields->total_emp_male?></td>
        <td><?=@$fields->total_emp_female?></td>
    </tr>
  </table>

  <table cellpadding="2" cellspacing="0" border="0" class="gridtable">
    <tr>
      <th colspan="3" class="heading">Effluent Details</th>
    </tr>
    <tr>
      <td>Solid Wastage (Kg): <?=@$fields->solid_waste_per_kg?></td>
      <td>Liquid Wastage (Litres): <?=@$fields->liquid_waste_per_kg?></td>
      <td>Gases (Cubic Metres): <?=@$fields->gases?></td>
    </tr>
  </table>

  <table cellpadding="2" cellspacing="0" border="0" class="gridtable">
    <tr>
      <th colspan="4" class="heading">Implementation Schedule ( within months from date of land / shed allotment)</th>
    </tr>
    <tr>
      <td>Start of Construction: <?=@$fields->construction_month?></td>
      <td>Installation / Erection of machine: <?=@$fields->installation_month?></td>
      <td>Commercial Production: <?=@$fields->commercial_month?></td>
      <td></td>
    </tr>
  </table>

  </br><div class="ack" align="center" >Questionnaire</div></br></br></br>
  <table cellpadding="2" cellspacing="0" border="0" class="gridtable">
    <tr>
          <td> Q: Educational Qualification: <br> A: <?php 
                                        if(isset($fields->edu_cert_qual) && $fields->edu_cert_qual=="intermediate")  echo "Upto Class 12";
                                        if(isset($fields->edu_cert_qual) && $fields->edu_cert_qual=="graduation")  echo "Graduation";
                                        if(isset($fields->edu_cert_qual) && $fields->edu_cert_qual=="post_grad_or_above")  echo "Post-Graduation and Above"; 
                                      ?>
          </td>
          <td> Q: Technical Qualification: <br> A: <?php 
                                          if(isset($fields->edu_tech_qual) && $fields->edu_tech_qual=="none")  echo "None";
                                          if(isset($fields->edu_tech_qual) && $fields->edu_tech_qual=="iti")  echo "ITI";
                                          if(isset($fields->edu_tech_qual) && $fields->edu_tech_qual=="diploma")  echo "Diploma"; 
                                          if(isset($fields->edu_tech_qual) && $fields->edu_tech_qual=="BE_BTech_MCA_MBA_CA")  echo "BE / B.Tech / MCA / MBA / CA";
                                        ?>
          </td>
        </tr>
        <tr>
          <td> Q: Professional Experience: <br>A: <?php 
                                           if(isset($fields->cert_prof_exp) && $fields->cert_prof_exp=="non_similar")  echo "Experience in Non - Similar Line";
                                           if(isset($fields->cert_prof_exp) && $fields->cert_prof_exp=="similar")  echo "Experience in Similar Line";
                                           if(isset($fields->cert_prof_exp) && $fields->cert_prof_exp=="none")  echo "None";
                                         ?>
          </td>
          <td>Q: Equity (If any): <br>
            A:  <?php 
                              if(isset($fields->cert_equity) && $fields->cert_equity=="less_then_19")  echo "Less than 19.99%";
                              if(isset($fields->cert_equity) && $fields->cert_equity=="greater_then_12_less_then_29_99")  echo "Greater than 20.00% to Less than 29.99%";
                              if(isset($fields->cert_equity) && $fields->cert_equity=="greater_then_30_less_then_39_99")  echo "Greater than 30.00% to Less than 39.99%";
                              if(isset($fields->cert_equity) && $fields->cert_equity=="greater_then_40")  echo "Greater than 40.00%";
                            ?>
          </td>
        </tr>
        <tr>
          <td>
           Q: Whether unit approved and sanctioned by Financial Institution / NBFC: <br>
           A: <?php 
              if(isset($fields->cert_unit_approv_sanct) && $fields->cert_unit_approv_sanct=="Yes")  echo "Yes";
              if(isset($fields->cert_unit_approv_sanct) && $fields->cert_unit_approv_sanct=="none")  echo "No";
              ?>
          </td>
          <td>
           Q: Project Cost<br>
           A: <?php 
              if(isset($fields->cert_project_cost) && $fields->cert_project_cost=="1cr")  echo "Above 1 crore";
              if(isset($fields->cert_project_cost) && $fields->cert_project_cost=="50lcs")  echo "Above 50 Lakhs";
              if(isset($fields->cert_project_cost) && $fields->cert_project_cost=="25lcs")  echo "Above 25 Lakhs";
              if(isset($fields->cert_project_cost) && $fields->cert_project_cost=="below25lcs")  echo "Below 25 Lakhs";
              ?>
           </td>
        </tr>
        <tr>
           <td>
              Q: Whether unit is benifited through Central / State Sponsored Schemes<br>
              A: <?php if(isset($fields->cert_unit_benifited) && $fields->cert_unit_benifited=="yes")  echo "Yes";
                 if(isset($fields->cert_unit_benifited) && $fields->cert_unit_benifited=="none")  echo "No"; ?>
                 </td>
          <td>
              Q: Pollution Category<br>
              A: <?php if(isset($fields->cert_poll_cat) && $fields->cert_poll_cat=="white")  echo "White";
                 if(isset($fields->cert_poll_cat) && $fields->cert_poll_cat=="green")  echo "Green";
                 if(isset($fields->cert_poll_cat) && $fields->cert_poll_cat=="orange")  echo "Orange";
                 if(isset($fields->cert_poll_cat) && $fields->cert_poll_cat=="red")  echo "Red";
                 ?>
           </td>
        </tr>
        <tr>
           <td>
              Q: Adoption of Water Conservation System<br>
              A: <?php if(isset($fields->cert_adpt_water_system) && $fields->cert_adpt_water_system=="yes")  echo "Yes";
                 if(isset($fields->cert_adpt_water_system) && $fields->cert_adpt_water_system=="none")  echo "No";?>
            </td>
          <td>  
             Q: Usage of Local Raw Materials<br>
              A: <?php if(isset($fields->cert_usage_local_materail) && $fields->cert_usage_local_materail=="30%")  echo " For 30% of total raw material";
                 if(isset($fields->cert_usage_local_materail) && $fields->cert_usage_local_materail=="10%")  echo "For 10% additional, one mark will be given";
                 if(isset($fields->cert_usage_local_materail) && $fields->cert_usage_local_materail=="none")  echo "None";
                 ?>
           </td>
        </tr>
        <tr>
           <td>
              Q: Whether the unit is registered as a Startup with the Ministry of MSME / DIPP, Government of India<br>
              A: <?php if(isset($fields->cert_regist_startup) && $fields->cert_regist_startup=="yes")  echo "Yes";
                 if(isset($fields->cert_regist_startup) && $fields->cert_regist_startup=="none")  echo "No";
              ?>
              </td>
          <td>
             Q: Whether the proposal is from the family, whose land was acquired for the development of the particular land bank<br>
             A: <?php if(isset($fields->cert_land_acquistion) && $fields->cert_land_acquistion=="acquired")  echo "Yes";
                 if(isset($fields->cert_land_acquistion) && $fields->cert_land_acquistion=="none")  echo "No";
                 ?>
           </td>
        </tr>
        <tr>
           <td>
              Q: Type of Enterpreneur<br>
              A: <?php if(isset($fields->cert_enterprenure_type) && $fields->cert_enterprenure_type=="women")  echo "Women";
                 if(isset($fields->cert_enterprenure_type) && $fields->cert_enterprenure_type=="army_fighter")  echo "Retired Army professional and / or Freedom fighters";
                 if(isset($fields->cert_enterprenure_type) && $fields->cert_enterprenure_type=="SC/ST/Physically Handicapped")  echo "SC/ST/Physically Handicapped"; 
                 if(isset($fields->cert_enterprenure_type) && $fields->cert_enterprenure_type=="none")  echo "None of above"; ?>
                 </td>
          <td>
              Q: Type of unit<br>
              A: <?php if(isset($fields->cert_unit_type) && $fields->cert_unit_type=="vender")  echo "Export Oriented and Ancillary / Vendor units for Large and Medium Industries";
                 if(isset($fields->cert_unit_type) && $fields->cert_unit_type=="none")  echo "If not as above"; ?>
           </td>
        </tr>
        <tr>
           <td>
              Q: Debt Coverage Ratio<br>
              A: <?php if(isset($fields->cert_debt_cover_ratio) && $fields->cert_debt_cover_ratio=="none")  echo "None";
                 if(isset($fields->cert_debt_cover_ratio) && $fields->cert_debt_cover_ratio=="1.70-2.00")  echo "> 1.75 to <= 2.00";
                 if(isset($fields->cert_debt_cover_ratio) && $fields->cert_debt_cover_ratio=="1.50-1.75")  echo "> 1.50 to <= 1.75";
                 if(isset($fields->cert_debt_cover_ratio) && $fields->cert_debt_cover_ratio=="1.25-1.50")  echo "> 1.25 to <= 1.50";
                 if(isset($fields->cert_debt_cover_ratio) && $fields->cert_debt_cover_ratio=="1.00-1.2")  echo "> 1.00 to <= 1.25";
                 ?>
           </td>
           <td></td>
        </tr>
  </table>
  <?php
    $critera= new CDbCriteria;
    $critera->condition="app_sub_id=:app_sub_id";
    $critera->params=array(":app_sub_id"=>$data['submission_id']);
    $critera->order="payment_id DESC";
    $checkPay=PaymentDetail::model()->find($critera);
    if(!empty($checkPay)){ ?>
      <div class="ack" align="center" >Payment Detail</div></br>
      <table cellpadding="2" cellspacing="0" border="0" class="gridtable">
          <tr>
             <th>Order Id</th>
             <th>Transaction Id</th>
             <th>Status</th>
             <th>Amount</th>
             <th>Date Time</th>
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
  ?>
<?php
// ob_end_clean();
?>