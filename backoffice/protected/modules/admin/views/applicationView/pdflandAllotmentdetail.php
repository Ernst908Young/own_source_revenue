<?php 
  $data=json_decode(json_encode($data));
  // echo "<pre>"; print_r($data); die; 

  $sql = "SELECT la_auction_detail.auc_id,la_auction_detail.district_id,bo_district.distric_name,bo_district.district_id
      FROM bo_district
      INNER JOIN la_auction_detail
      ON bo_district.district_id=la_auction_detail.district_id
      WHERE la_auction_detail.is_active='Y'
      GROUP BY la_auction_detail.district_id";
  $connection=Yii::app()->db; 
  $command=$connection->createCommand($sql);
  $AustionDistricts=$command->queryAll();

  if(isset($data->district)){
      $sql = "SELECT la_auction_detail.auc_id,la_estates.land_estate_id,la_estates.land_estate_name,la_estates.estate_area
              FROM la_estates
              INNER JOIN la_auction_detail
              ON la_estates.land_estate_id=la_auction_detail.estate_id
              WHERE la_auction_detail.is_active='Y' 
              AND la_auction_detail.auc_status='O'
              AND la_auction_detail.district_id=$data->district
              GROUP BY la_auction_detail.estate_id";
      $connection=Yii::app()->db; 
      $command=$connection->createCommand($sql);
      $Plots=$command->queryAll();
      if(!empty($Plots))
          foreach ($Plots as $k => $v)
              $estates[]=array("land_estate_id" => $v['land_estate_id'],'land_estate_name'=>$v['land_estate_name']);
  }

  if(isset($data->estate)){
      $sql = "SELECT *
              FROM la_auction_plots
              INNER JOIN la_auction_detail
              ON la_auction_plots.auc_plot_id=la_auction_detail.plot_id
              WHERE la_auction_detail.is_active='Y' 
              AND la_auction_detail.auc_status='O'
              AND la_auction_detail.estate_id=$data->estate";
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
  <table cellpadding="2" cellspacing="0" border="0" class="gridtable">
    <tr>
      <th>Application Name: <?php echo @$name;?></th>
      <th>Application Name: <?php echo @$name;?></th>
      <th>Application Id: <?php echo @$data->submission_id;?></th>
    </tr>  
  </table> 
  
  <table class="tbl" >
    <tr>
      <th colspan="3" style="text-align:center">Applicant Details</th>
    </tr>
    <tr>
      <th>Applicant Name: <?php echo @$data->applicant_name;?></th>
      <th>Name of the Firm/Company: <?php echo @$data->company_name;?></th>
      <th>Constitution of the Firm/Comapany: 
          <?php 
            if(isset($data->firm_company_constitution) && $data->firm_company_constitution=="proprietorship_id_47") echo "Proprietorship";
            if(isset($data->firm_company_constitution) && $data->firm_company_constitution=="partnership_firm_id_48") echo "Partnership Firm";
            if(isset($data->firm_company_constitution) && $data->firm_company_constitution=="limited_liability_partnership_id_49") echo "Limited Liability Partnership";
            if(isset($data->firm_company_constitution) && $data->firm_company_constitution=="private_limited_company_id_50") echo "Private Limited Company";
            if(isset($data->firm_company_constitution) && $data->firm_company_constitution=="public_limited_company_id_51") echo "Public Limited Company";
            if(isset($data->firm_company_constitution) && $data->firm_company_constitution=="cooperative_society_id_52") echo "Cooperative Society";
            if(isset($data->firm_company_constitution) && $data->firm_company_constitution=="self_help_group_id_53") echo "Self Help Group";
            if(isset($data->firm_company_constitution) && $data->firm_company_constitution=="section_25_company_id_54") echo "Section 25 Company";
            if(isset($data->firm_company_constitution) && $data->firm_company_constitution=="one_man_company_id_55") echo "One Man Company";
          ?>
      </th>
    </tr>
    <tr>
      <th>Gender: <?php 
                    if(isset($data->gender) && $data->gender=="M") echo "Male";
                    if(isset($data->gender) && $data->gender=="F") echo "Female";
                    if(isset($data->gender) && $data->gender=="O") echo "Other";
                  ?>
      </th>
      <th>Mobile: <?php echo @$data->mob_number;?></th>
      <th>Telephone: <?php echo @$data->tel_phone;?></th>
    </tr>
    <tr>
      <th>Email: <?php echo @$data->email?></th>
      <th>Fax: <?php echo @$data->fax;?></th>
      <th>Corresponding Address: <?php echo @$data->Address;?></th>
    </tr>

    <tr>
      <th colspan="3" style="text-align:center">Particulars of Area</th>
    </tr>
    <tr>
      <th>District:<?php 
                    foreach ($AustionDistricts as $k => $v)
                      if ($data->district == $v['district_id'])
                        echo $v['distric_name'];
                    ?>
      </th>
      <th>Estates: <?php 
                    foreach ($estates as $k => $v)
                      if ($data->estate == $v['land_estate_id'])
                        echo $v['land_estate_name'];
                  ?>
      </th>
      <th>Available Plots Area in Sq. Meters: <?php 
                                                  if(isset($PlotsArray)){
                                                      $areaArray=array();
                                                      foreach ($data->area_square_meter as $k => $v)
                                                          $areaArray[]=$v;
                                                      foreach ($PlotsArray as $k => $v)
                                                          if (in_array($v['plot_id'], $areaArray))
                                                            echo $v['area_name']." ( ".$v['plot_area']." )";
                                                  }
                                              ?>
      </th>
    </tr>
    <tr>
      <th>Area Requirement in Sq. Meters: <?=@$data->optional_specific_plot_size?></th>
      <th>Type of Industry: <?php 
                              if(isset($data->nature_of_area) && $data->nature_of_area=="new_unit") echo "New Unit";
                              if(isset($data->nature_of_area) && $data->nature_of_area=="expansion") echo "Expansion";
                              if(isset($data->nature_of_area) && $data->nature_of_area=="modernization") echo "Modernization";
                            ?>
      </th>
      <th>&nbsp;</th>
    </tr>
  </table>
  <table class="tbl" >
    <tr>
      <th colspan="4" style="text-align:center">Unit Details</th>
    </tr>
    <?php 
        if(isset($data->proposed_product)){
            foreach ($data->proposed_product as $k => $v) {
                $proposed_product = $data->proposed_product;
                $proposed_installed_capacity = $data->proposed_installed_capacity;
                $proposed_product_unit = $data->proposed_product_unit;
                echo "<tr>
                        <th>Proposed Product: ".$proposed_product[$k]."</th>
                        <th>Proposed Installed Capacity: ".$proposed_installed_capacity[$k]."</th>
                        <th>Unit: ".$proposed_product_unit[$k]."</th>
                      </tr>";
            }
        }
    ?>
    <tr>
      <th colspan="2">Nature of Project: <?php if(isset($data->nature_project) && $data->nature_project=="manufacturing") echo "Manufacturing";?></th>
      <th colspan="2">Projected Sales Unit (1st year): <?=@$data->projected_sales_unit?></th>
    </tr>
  </table>

  <table class="tbl" >
    <tr>
      <th colspan="5" style="text-align:center">Project Cost (Rupees INR)</th>
    </tr>
    <tr>
      <th>Plant and Machinery: <?=@$data->plant_machinery_invst?></th>
      <th>Building Construction: <?=@$data->building_construction_invst?> </th>
      <th>Site Development: <?=@$data->site_development_invst?> </th>
      <th>Others: <?=@$data->other_invst?> </th>
      <th>Total Project Cost: <?=@$data->total_investment?></th>
    </tr>
  </table>

  <table class="tbl" >
    <tr>
      <th colspan="5" style="text-align:center">Means of Finance (Rupees INR)</th>
    </tr>
    <tr>
      <th>Equity: <?=@$data->mean_of_fin_equity?></th>
      <th>Term Loan: <?=@$data->mean_of_fin_term_loan?></th>
      <th>Assistance From Other Sources: <?=@$data->mean_of_fin_assistance?></th>
      <th>Grant: <?=@$data->mean_of_fin_grant?></th>
      <th>Total: <?=@$data->total_means?></th>
    </tr>
  </table>

  <table class="tbl" >
    <tr>
      <th colspan="10" style="text-align:center">Proposed Employment Details</th>
    </tr>
    <tr>
        <th colspan="2">Manegerial</th>
        <th colspan="2">Supervisor</th>
        <th colspan="2">Skilled</th>
        <th colspan="2">Unskilled</th>
        <th colspan="2">Total Employment</th>
    </tr>
    <tr>
        <th>Male </th>
        <th>Female </th>
        <th>Male </th>
        <th>Female </th>
        <th>Male </th>
        <th>Female </th>
        <th>Male </th>
        <th>Female </th>
        <th>Male </th>
        <th>Female </th>
    </tr>
    <tr>
        <th><?=@$data->manegerial_emp_male?></th>
        <th><?=@$data->manegerial_emp_female?></th>
        
        <th><?=@$data->supervisor_emp_male?></th>
        <th><?=@$data->supervisor_emp_female?></th>
        
        <th><?=@$data->skilled_emp_male?></th>
        <th><?=@$data->skilled_emp_female?></th>
        
        <th><?=@$data->unskilled_emp_male?></th>
        <th><?=@$data->unskilled_emp_female?></th>

        <th><?=@$data->total_emp_male?></th>
        <th><?=@$data->total_emp_female?></th>
    </tr>
  </table>

  <table class="tbl" >
    <tr>
      <th colspan="3" style="text-align:center">Effluent Details</th>
    </tr>
    <tr>
      <th>Solid Wastage (Kg per day): <?=@$data->solid_waste_per_kg?></th>
      <th>Liquid Wastage (Litres per day): <?=@$data->liquid_waste_per_kg?></th>
      <th>Gases: <?=@$data->gases?></th>
    </tr>
  </table>

  <table class="tbl" >
    <tr>
      <th colspan="4" style="text-align:center">Implementation Schedule</th>
    </tr>
    <tr>
      <th>Acquisition of Land: <?=@$data->acquistion_month?></th>
      <th>Start of Construction: <?=@$data->construction_month?></th>
      <th>Installation / Erection of machine: <?=@$data->installation_month?></th>
      <th>Commercial Production: <?=@$data->commercial_month?></th>
    </tr>
  </table>

  <table class="tbl" >
    <tr>
      <th colspan="2" style="text-align:center">Questionnaire</th>
    </tr>
    <tr>
      <th> Q: Educational Qualification: <br> A: <?php 
                                    if(isset($data->edu_cert_qual) && $data->edu_cert_qual=="intermediate")  echo "Upto Class 12";
                                    if(isset($data->edu_cert_qual) && $data->edu_cert_qual=="graduation")  echo "Graduation";
                                    if(isset($data->edu_cert_qual) && $data->edu_cert_qual=="post_grad_or_above")  echo "Post-Graduation and Above"; 
                                  ?>
      </th>
      <th> Q: Technical Qualification: <br> A: <?php 
                                      if(isset($data->edu_tech_qual) && $data->edu_tech_qual=="none")  echo "None";
                                      if(isset($data->edu_tech_qual) && $data->edu_tech_qual=="iti")  echo "ITI";
                                      if(isset($data->edu_tech_qual) && $data->edu_tech_qual=="diploma")  echo "Diploma"; 
                                      if(isset($data->edu_tech_qual) && $data->edu_tech_qual=="BE_BTech_MCA_MBA_CA")  echo "BE / B.Tech / MCA / MBA / CA";
                                    ?>
      </th>
    </tr>
    <tr>
      <th> Q: Professional Experience: <br>A: <?php 
                                       if(isset($data->cert_prof_exp) && $data->cert_prof_exp=="non_similar")  echo "Experience in Non - Similar Line";
                                       if(isset($data->cert_prof_exp) && $data->cert_prof_exp=="similar")  echo "Experience in Similar Line";
                                       if(isset($data->cert_prof_exp) && $data->cert_prof_exp=="none")  echo "None";
                                     ?>
      </th>
      <th>Q: Equity (If any): <br>
        A:  <?php 
                          if(isset($data->cert_equity) && $data->cert_equity=="less_then_19")  echo "Less than 19.99%";
                          if(isset($data->cert_equity) && $data->cert_equity=="greater_then_12_less_then_29_99")  echo "Greater than 20.00% to Less than 29.99%";
                          if(isset($data->cert_equity) && $data->cert_equity=="greater_then_30_less_then_39_99")  echo "Greater than 30.00% to Less than 39.99%";
                          if(isset($data->cert_equity) && $data->cert_equity=="greater_then_40")  echo "Greater than 40.00%";
                        ?>
      </th>
    </tr>
    <tr>
      <th>
       Q: Whether unit approved and sanctioned by Financial Institution / NBFC: <br>
       A:  <?php 
          if(isset($data->cert_unit_approv_sanct) && $data->cert_unit_approv_sanct=="Yes")  echo "Yes";
          if(isset($data->cert_unit_approv_sanct) && $data->cert_unit_approv_sanct=="none")  echo "No";
          ?>
      </th>
      <th>
       Q: Project Cost<br>
       A:  <?php 
          if(isset($data->cert_project_cost) && $data->cert_project_cost=="1cr")  echo "Above 1 crore";
          if(isset($data->cert_project_cost) && $data->cert_project_cost=="50lcs")  echo "Above 50 Lakhs";
          if(isset($data->cert_project_cost) && $data->cert_project_cost=="25lcs")  echo "Above 25 Lakhs";
          if(isset($data->cert_project_cost) && $data->cert_project_cost=="below25lcs")  echo "Below 25 Lakhs";
          ?>
       </th>
    </tr>
    <tr>
       <th>
          Q: Debt Coverage Ratio<br>
          A:  <?php if(isset($data->cert_debt_cover_ratio) && $data->cert_debt_cover_ratio=="none")  echo "More than 2.00 or Not applicable in case of No Loans";
             if(isset($data->cert_debt_cover_ratio) && $data->cert_debt_cover_ratio=="1.70-2.00")  echo "1.75 to 2.00";
             if(isset($data->cert_debt_cover_ratio) && $data->cert_debt_cover_ratio=="1.50-1.75")  echo "1.50 to 1.75";
             if(isset($data->cert_debt_cover_ratio) && $data->cert_debt_cover_ratio=="1.25-1.50")  echo "1.25 to 1.50";
             if(isset($data->cert_debt_cover_ratio) && $data->cert_debt_cover_ratio=="1.00-1.25")  echo "1.00 to 1.25";
             ?>
             </th>
      <th>
          Q: Pollution Category<br>
          A:  <?php if(isset($data->cert_poll_cat) && $data->cert_poll_cat=="white")  echo "White";
             if(isset($data->cert_poll_cat) && $data->cert_poll_cat=="green")  echo "Green";
             if(isset($data->cert_poll_cat) && $data->cert_poll_cat=="orange")  echo "Orange";
             if(isset($data->cert_poll_cat) && $data->cert_poll_cat=="red")  echo "Red";
             ?>
       </th>
    </tr>
    <tr>
       <th>
          Q: Adoption of Water Conservation System<br>
          A:  <?php if(isset($data->cert_adpt_water_system) && $data->cert_adpt_water_system=="yes")  echo "Yes";
             if(isset($data->cert_adpt_water_system) && $data->cert_adpt_water_system=="none")  echo "No";?>
        </th>
      <th>  
         Q: Usage of Local Raw Materials<br>
          A:  <?php if(isset($data->cert_usage_local_materail) && $data->cert_usage_local_materail=="30%")  echo " For 30% of total raw material";
             if(isset($data->cert_usage_local_materail) && $data->cert_usage_local_materail=="10%")  echo "For 10% additional, one mark will be given";
             if(isset($data->cert_usage_local_materail) && $data->cert_usage_local_materail=="none")  echo "None";
             ?>
       </th>
    </tr>
    <tr>
       <th>
          Q: Whether the unit is registered as a Startup with the Ministry of MSME / DIPP, Government of India<br>
          A:  <?php if(isset($data->cert_regist_startup) && $data->cert_regist_startup=="yes")  echo "Yes";
             if(isset($data->cert_regist_startup) && $data->cert_regist_startup=="none")  echo "No";
          ?>
          </th>
      <th>
         Q: Whether the proposal is from the family, whose land was acquired for the development of the particular land bank<br>
         A:  <?php if(isset($data->cert_land_acquistion) && $data->cert_land_acquistion=="acquired")  echo "Yes";
             if(isset($data->cert_land_acquistion) && $data->cert_land_acquistion=="none")  echo "No";
             ?>
       </th>
    </tr>
    <tr>
       <th>
          Q: Type of Enterpreneur<br>
          A:  <?php if(isset($data->cert_enterprenure_type) && $data->cert_enterprenure_type=="women")  echo "Women";
             if(isset($data->cert_enterprenure_type) && $data->cert_enterprenure_type=="army_fighter")  echo "Retired Army professional and / or Freedom fighters";
             if(isset($data->cert_enterprenure_type) && $data->cert_enterprenure_type=="none")  echo "None of above"; ?>
             </th>
      <th>
          Q: Type of unit<br>
          A: <?php if(isset($data->cert_unit_type) && $data->cert_unit_type=="vender")  echo "Export Oriented and Ancillary / Vendor units for Large and Medium Industries";
             if(isset($data->cert_unit_type) && $data->cert_unit_type=="none")  echo "If not as above"; ?>
       </th>
    </tr>
    <tr>
       <th>
          Q: Whether unit is benifited through Central / State Sponsored Schemes<br>
          A: 
          <?php if(isset($data->cert_unit_benifited) && $data->cert_unit_benifited=="yes")  echo "Yes";
             if(isset($data->cert_unit_benifited) && $data->cert_unit_benifited=="none")  echo "No"; ?>
       </th>
       <th></th>
    </tr>
  </table>