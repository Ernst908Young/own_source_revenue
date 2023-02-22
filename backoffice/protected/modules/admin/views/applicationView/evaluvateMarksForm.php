<?php
$data = json_decode(json_encode($data));
//print_r($data);die;
 //echo "<pre>"; print_r($evaluatedCritearea); die; 
//print_r($this->getEvaluationMarks('edu_cert_qual',$data->edu_cert_qual));die;
?>
<style type="text/css">
.selectedAnswer{font-weight: bold;color:rgb(40,96,144);}
    table.gridtabledoc1 {
        font-family: verdana,arial,sans-serif;
        color:#333333;
        width: 90%;
        margin-left: 5%;
        
    }
    table.gridtabledoc1 th {

        padding: 8px;
        

        background-color: #dedede;
    }
    table.gridtabledoc1 td {

        padding: 8px;

        background-color: #ffffff;
    }
    .aa {
        vertical-align:middle;
    }

</style>
<form name="EveluvateMark" action="" method="post">

<table cellpadding="2" cellspacing="0" border="1" class="gridtabledoc1" id="hidden-table-info">
    <tr>
        <th colspan="7"><b>Evaluation Criteria for Land Allotment</b></th>
    </tr>
    <tr><th ></th>
        <th>Name of the Unit</th>
        <th colspan="5" align="left"><b> <?php echo $data->company_name ?></b></th>
    </tr>

    <tr>
        <th></th>
        <th>Criteria</th>
        <th>Points Distribution</th>
        <th>Max. Points</th>
        <th>Weightage</th>
        <th>Point Scored</th>
        <th>Point Allotment</th>
    </tr>


    <tr>
        <th>1</th>
        <th colspan="6" align="left"><b>Educational Qualification</b></th>
    </tr>
    <tr>
        <td>a</td>
        
        <td <?php if($data->edu_cert_qual=="intermediate") {echo "class='selectedAnswer'";}?>>Upto Class 12</td>
        <td align="center">3</td>
        <td rowspan="3" align="center" class="aa">5</td>
        <td rowspan="3" align="center" class="aa">5%</td>
        <td rowspan="3" align="center" class="aa"> <?php echo $this->getEvaluationMarks('edu_cert_qual', $data->edu_cert_qual) ?></td>
        <td rowspan="3" align="center"> 
             <input type="hidden" name="sys_cert_qual" value="<?php echo $this->getEvaluationMarks('edu_cert_qual', $data->edu_cert_qual) ?>">
            <select name="cert_qual" required>
                <option value="">-Select point-</option>
 <?php if($evaluatedCritearea!="none"){ $v=$evaluatedCritearea['cert_qual'];}else{$v="";} ?>
            
                <option value="3" <?php if($v==3){ echo "selected"; } ?>>3</option>
                <option value="4" <?php if($v==4){ echo "selected"; } ?>>4</option>
                <option value="5" <?php if($v==5){ echo "selected"; } ?>>5</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>b</td>
        <td <?php if($data->edu_cert_qual=="graduation") {echo "class='selectedAnswer'";}?>>Graduation</td>
        <td align="center">4</td>
    </tr>
    <tr>
        <td>c</td>
        <td <?php if($data->edu_cert_qual=="post_grad_or_above") {echo "class='selectedAnswer'";}?>>Post Graduation and Above</td>
        <td align="center">5</td>
    </tr>

    <tr>
        <th>2</th>
        <th colspan="6" align="left"><b>Techincal Qualification</b></th>
    </tr>
    <tr>
        <td>a</td>
        <td <?php if($data->edu_tech_qual=="none") {echo "class='selectedAnswer'";}?>>None</td>
        <td align="center">2</td>
        <td rowspan="4" align="center">5</td>
        <td rowspan="4" align="center">5%</td>
        <td rowspan="4" align="center"> <?php echo $this->getEvaluationMarks('edu_tech_qual', $data->edu_tech_qual) ?></td>
        <td rowspan="4" align="center"> 
             <input type="hidden" name="sys_tech_qual" value="<?php echo $this->getEvaluationMarks('edu_tech_qual', $data->edu_tech_qual) ?>">
            <select name="tech_qual" required>
                 <?php if($evaluatedCritearea!="none"){ $v=$evaluatedCritearea['tech_qual'];}else{$v="";} ?>
         
              
                <option value="">-Select point-</option>
                <option value="2" <?php if($v==2){ echo "selected"; } ?>>2</option>
                <option value="3" <?php if($v==3){ echo "selected"; } ?>>3</option>
                <option value="4" <?php if($v==4){ echo "selected"; } ?>>4</option>
                <option value="5" <?php if($v==5){ echo "selected"; } ?>>5</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>b</td>
        <td <?php if($data->edu_tech_qual=="iti") {echo "class='selectedAnswer'";}?>>ITI</td>
        <td align="center">3</td>
    </tr>
    <tr>
        <td>c</td>
        <td <?php if($data->edu_tech_qual=="diploma") {echo "class='selectedAnswer'";}?>>Diploma</td>
        <td align="center">4</td>
    </tr>
    <tr>
        <td>d</td>
        <td <?php if($data->edu_tech_qual=="BE_BTech_MCA_MBA_CA") {echo "class='selectedAnswer'";}?>>BE/B.Tech/MCA/MBA/CA</td>
        <td align="center">5</td>
    </tr>

    <tr>
        <th>3</th>
        <th colspan="6" align="left"><b>Professional Qualification</b></th>
    </tr>
    <tr>
        <td>a</td>
        <td <?php if($data->cert_prof_exp=="none") {echo "class='selectedAnswer'";}?>>None</td>
        <td align="center">0</td>
        <td rowspan="3" align="center">10</td>
        <td rowspan="3" align="center">10%</td>
        <td rowspan="3" align="center">  <?php echo $this->getEvaluationMarks('cert_prof_exp', $data->cert_prof_exp) ?></td>
        <td rowspan="3" align="center"> 
              <input type="hidden" name="sys_prof_exp" value="<?php echo $this->getEvaluationMarks('cert_prof_exp', $data->cert_prof_exp) ?>">
            <select name="prof_exp" required>
                <option value="">-Select point-</option>
   <?php if($evaluatedCritearea!="none"){ $v=$evaluatedCritearea['prof_exp'];}else{$v="";} ?>
            
                <option value="0" <?php if($v==0){ echo "selected"; } ?>>0</option>
                <option value="5" <?php if($v==5){ echo "selected"; } ?>>5</option>
                <option value="10" <?php if($v==10){ echo "selected"; } ?>>10</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>b</td>
        <td <?php if($data->cert_prof_exp=="non_similar") {echo "class='selectedAnswer'";}?>>Experience in Non - Similar Line</td>
        <td align="center">5</td>
    </tr>
    <tr>
        <td>c</td>
        <td <?php if($data->cert_prof_exp=="similar") {echo "class='selectedAnswer'";}?>>Experience in Similar Line</td>
        <td align="center">10</td>
    </tr>

    <tr>
        <th>4</th>
        <th colspan="6" align="left"><b>Equity</b></th>
    </tr>
    <tr>
        <td>a</td>
        <?php $eq=$this->getEvaluationMarks('cert_equity', $data->cert_equity) ?>
        <td <?php if($eq=="4") {echo "class='selectedAnswer'";}?>>&lt; 19.99%</td>
        <td align="center">4</td>
        <td rowspan="4" align="center">10</td>
        <td rowspan="4" align="center">10%</td>
        <td rowspan="4" align="center"><?php echo $eq; ?></td>
        <td rowspan="4" align="center"> 
              <input type="hidden" name="sys_equity" value="<?php echo $eq; ?>">
            <select name="equity" required>
                <option value="">-Select point-</option>
   <?php if($evaluatedCritearea!="none"){ $v=$evaluatedCritearea['equity'];}else{$v="";} ?>
                <?php if($v==4){ echo "selected"; } ?>
            <option value="4" <?php if($v==4){ echo "selected"; } ?>>4</option>
                <option value="6" <?php if($v==6){ echo "selected"; } ?>>6</option>
                <option value="8" <?php if($v==8){ echo "selected"; } ?>>8</option>
                <option value="10" <?php if($v==10){ echo "selected"; } ?>>10</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>b</td>
        <td <?php if($eq=="6") {echo "class='selectedAnswer'";}?>>&gt; = 20.00% to &lt; 29.99%</td>
        <td align="center">6</td>
    </tr>
    <tr>
        <td>c</td>
        <td <?php if($eq=="8") {echo "class='selectedAnswer'";}?>>&gt; = 30.00% to &lt; 39.99%</td>
        <td align="center">8</td>
    </tr>
    <tr>
        <td>d</td>
        <td <?php if($eq=="10") {echo "class='selectedAnswer'";}?>>&gt; = 40.00%</td>
        <td align="center">10</td>
    </tr>

    <tr>
        <th>5</th>
        <th colspan="6" align="left"><b>Whether unit approved and sanctioned by Financial Institution / NBFC</b></th>
    </tr>
    <tr>
        <td>a</td>
        <td <?php if($data->cert_unit_approv_sanct=="Yes") {echo "class='selectedAnswer'";}?>>Yes</td>
        <td align="center">5</td>
        <td rowspan="2" align="center">5</td>
        <td rowspan="2" align="center">5%</td>
        <td rowspan="2" align="center"> <?php echo $this->getEvaluationMarks('cert_unit_approv_sanct', $data->cert_unit_approv_sanct) ?></td>
        <td rowspan="2" align="center"> 
            <input type="hidden" name="sys_unit_approv_sanct" value="<?php echo $this->getEvaluationMarks('cert_unit_approv_sanct', $data->cert_unit_approv_sanct) ?>">
            <select name="unit_approv_sanct" required>
                 <?php if($evaluatedCritearea!="none"){ $v=$evaluatedCritearea['unit_approv_sanct'];}else{$v="";} ?>
                <option value="">-Select point-</option>                       
                <option value="5" <?php if($v==5){ echo "selected"; } ?>>5</option>
                <option value="0" <?php if($v==0){ echo "selected"; } ?>>0</option>                         

            </select>
        </td>
    </tr>
    <tr>
        <td>b</td>
        <td <?php if($data->cert_unit_approv_sanct=="none") {echo "class='selectedAnswer'";}?>>No</td>
        <td align="center">0</td>
    </tr>
<?php $cpc=@$data->cert_project_cost;if(isset($cpc) && !empty($cpc)){ ?>
    <tr>
        <th>6</th>
        <th colspan="6" align="left"><b>Project Cost</b></th>
    </tr>
    <tr>
        <td>a</td>
        <td <?php if(isset($cpc) && !empty($cpc)){ if($cpc=="1cr") {echo "class='selectedAnswer'";}}?>>Above 1 crore</td>
        <td align="center">10</td>
        <td rowspan="4" align="center">10</td>
        <td rowspan="4" align="center">10%</td>
        <td rowspan="4" align="center"><?php  if(isset($cpc) && !empty($cpc)){ echo @$this->getEvaluationMarks('cert_project_cost', $cpc);} ?></td>
        <td rowspan="4" align="center"> 
             <input type="hidden" name="sys_project_cost" value="<?php  if(isset($cpc) && !empty($cpc)){ echo @$this->getEvaluationMarks('cert_project_cost', $cpc); } ?>">
            <select name="project_cost" required>
                <?php if($evaluatedCritearea!="none"){ $v=$evaluatedCritearea['project_cost'];}else{$v="";} ?>
             
                <option value="">-Select point-</option>
                <option value="10"  <?php if($v==10){ echo "selected"; } ?>>10</option>
                <option value="7" <?php if($v==7){ echo "selected"; } ?>>7</option>
                <option value="5" <?php if($v==5){ echo "selected"; } ?>>5</option>
                <option value="3" <?php if($v==4){ echo "selected"; } ?>>4</option>


            </select>
        </td>
    </tr>
    <tr>
        <td>b</td>
        <td <?php if(isset($cpc) && !empty($cpc)){ if($cpc=="50lcs") {echo "class='selectedAnswer'";}}?>>Above 50 Lakhs</td>
        <td align="center">7</td>
    </tr>
    <tr>
        <td>c</td>
        <td <?php if(isset($cpc) && !empty($cpc)){ if($cpc=="25lcs") {echo "class='selectedAnswer'";}}?>>Above 25 Lakhs</td>
        <td align="center">5</td>
    </tr>
    <tr>
        <td>d</td>
        <td <?php if(isset($cpc) && !empty($cpc)){ if($cpc=="below25lcs") {echo "class='selectedAnswer'";}}?>>Below 25 Lakhs</td>
        <td align="center">4</td>
    </tr>
<?php } ?>

    <tr>
        <th>7</th>
        <th colspan="6" align="left"><b>Debt Coverage Ratio</b></th>
    </tr>
    <tr>
        <td>a</td>
        <td <?php if($data->cert_debt_cover_ratio=="none") {echo "class='selectedAnswer'";}?>> &gt; 2.00 or Zero (when there is no loan)</td>
        <td align="center">5</td>
        <td rowspan="5" align="center">5</td>
        <td rowspan="5" align="center">5%</td>
        <td rowspan="5" align="center"><?php echo $this->getEvaluationMarks('cert_debt_cover_ratio', $data->cert_debt_cover_ratio) ?></td>
        <td rowspan="5" align="center"> 
            <input type="hidden" name="sys_debt_cover_ratio" value="<?php echo $this->getEvaluationMarks('cert_debt_cover_ratio', $data->cert_debt_cover_ratio) ?>">
            <select name="debt_cover_ratio" required>
                 <?php if($evaluatedCritearea!="none"){ $v=$evaluatedCritearea['debt_cover_ratio'];}else{$v="";} ?>
                <option value="">-Select point-</option>
                <option value="5" <?php if($v==5){ echo "selected"; } ?>>5</option>
                <option value="4" <?php if($v==4){ echo "selected"; } ?>>4</option>
                <option value="3" <?php if($v==3){ echo "selected"; } ?>>3</option>
                <option value="2" <?php if($v==2){ echo "selected"; } ?>>2</option>
                <option value="1" <?php if($v==1){ echo "selected"; } ?>>1</option>


            </select>
        </td>
    </tr>
    <tr>
        <td>b</td>
        <td <?php if($data->cert_debt_cover_ratio=="1.70-2.00") {echo "class='selectedAnswer'";}?>>&gt; 1.75 to &lt; = 2.00</td>
        <td align="center">4</td>
    </tr>
    <tr>
        <td>c</td>
        <td <?php if($data->cert_debt_cover_ratio=="1.50-1.75") {echo "class='selectedAnswer'";}?>>&gt; 1.50 to &lt; = 1.75</td>
        <td align="center">3</td>
    </tr>
    <tr>
        <td>d</td>
        <td <?php if($data->cert_debt_cover_ratio=="1.25-1.50") {echo "class='selectedAnswer'";}?>>&gt; 1.25 to &lt; = 1.50</td>
        <td align="center">2</td>
    </tr>
    <tr>
        <td>e</td>
        <td <?php if($data->cert_debt_cover_ratio=="1.00-1.25") {echo "class='selectedAnswer'";}?>>&gt; 1.00 to &lt; = 1.25</td>
        <td align="center">1</td>
    </tr>


    <tr>
        <th>8</th>
        <th colspan="6" align="left"><b>Pollution Category</b></th>
    </tr>
    <tr>
        <td>a</td>
        <td <?php if($data->cert_poll_cat=="white") {echo "class='selectedAnswer'";}?>>White</td>
        <td align="center">5</td>
        <td rowspan="4" align="center">5</td>
        <td rowspan="4" align="center">5%</td>
        <td rowspan="4" align="center"><?php echo $this->getEvaluationMarks('cert_poll_cat', $data->cert_poll_cat) ?></td>
        <td rowspan="4" align="center"> 
              <input type="hidden" name="sys_poll_cat" value="<?php echo $this->getEvaluationMarks('cert_poll_cat', $data->cert_poll_cat) ?>">
            <select name="poll_cat" required>
                    <?php if($evaluatedCritearea!="none"){ $v=$evaluatedCritearea['poll_cat'];}else{$v="";} ?>
                <option value="">-Select point-</option>
                <option value="5"  <?php if($v==5){ echo "selected"; } ?>>5</option>
                <option value="4"  <?php if($v==4){ echo "selected"; } ?>>4</option>
                <option value="3"  <?php if($v==3){ echo "selected"; } ?>>3</option>
                <option value="2"  <?php if($v==2){ echo "selected"; } ?>>2</option>



            </select>
        </td>
    </tr>
    <tr>
        <td>b</td>
        <td <?php if($data->cert_poll_cat=="green") {echo "class='selectedAnswer'";}?>>Green</td>
        <td align="center">4</td>
    </tr>
    <tr>
        <td>c</td>
        <td <?php if($data->cert_poll_cat=="orange") {echo "class='selectedAnswer'";}?>>Orange</td>
        <td align="center">3</td>
    </tr>
    <tr>
        <td>d</td>
        <td <?php if($data->cert_poll_cat=="red") {echo "class='selectedAnswer'";}?>>Red</td>
        <td align="center">2</td>
    </tr>

    <tr>
        <th>9</th>
        <th colspan="6" align="left"><b>Adoption of Water Conservation System</b></th>
    </tr>
    <tr>
        <td>a</td>
        <td <?php if($data->cert_adpt_water_system=="yes") {echo "class='selectedAnswer'";}?>>Yes</td>
        <td align="center">5</td>
        <td rowspan="2" align="center">5</td>
        <td rowspan="2" align="center">5%</td>
        <td rowspan="2" align="center"><?php echo $this->getEvaluationMarks('cert_adpt_water_system', $data->cert_adpt_water_system) ?></td>
        <td rowspan="2" align="center"> 
             <input type="hidden" name="sys_adpt_water_system" value="<?php echo $this->getEvaluationMarks('cert_adpt_water_system', $data->cert_adpt_water_system) ?>">
            <select name="adpt_water_system" required>
                <option value="">-Select point-</option>
                  <?php if($evaluatedCritearea!="none"){ $v=$evaluatedCritearea['adpt_water_system'];}else{$v="";} ?>
               
                <option value="5"  <?php if($v==5){ echo "selected"; } ?>>5</option>
                <option value="0" <?php if($v==0){ echo "selected"; } ?>>0</option>




            </select>
        </td>
    </tr>
    <tr>
        <td>b</td>
        <td <?php if($data->cert_adpt_water_system=="none") {echo "class='selectedAnswer'";}?>>No</td>
        <td align="center">0</td>
    </tr>


    <tr>
        <th>10</th>
        <th colspan="6" align="left"><b>Usage of Local Raw Materials</b></th>
    </tr>
    <tr>
        <td>a</td>
        <td <?php if($data->cert_usage_local_materail=="30%") {echo "class='selectedAnswer'";}?>>For 30% of total raw material</td>
        <td align="center">2</td>
        <td rowspan="3" align="center">5</td>
        <td rowspan="3" align="center">5%</td>
        <td rowspan="3" align="center"><?php echo $this->getEvaluationMarks('cert_usage_local_materail', $data->cert_usage_local_materail) ?></td>
        <td rowspan="3" align="center"> 
              <input type="hidden" name="sys_usage_local_materail" value="<?php echo $this->getEvaluationMarks('cert_usage_local_materail', $data->cert_usage_local_materail) ?>">
            <select name="usage_local_materail" required>
                <option value="">-Select point-</option>
                 <?php if($evaluatedCritearea!="none"){ $v=$evaluatedCritearea['usage_local_materail'];}else{$v="";} ?>
                <option value="5" <?php if($v==5){ echo "selected"; } ?>>5</option>
                <option value="4" <?php if($v==4){ echo "selected"; } ?>>4</option>
                <option value="3" <?php if($v==3){ echo "selected"; } ?>>3</option>
                <option value="2" <?php if($v==2){ echo "selected"; } ?>>2</option>
                <option value="1" <?php if($v==1){ echo "selected"; } ?>>1</option>
                <option value="0" <?php if($v==0){ echo "selected"; } ?>>0</option>




            </select>
        </td>
    </tr>
    <tr>
        <td>b</td>
        <td <?php if($data->cert_usage_local_materail=="10%") {echo "class='selectedAnswer'";}?>>For 10% additional, one mark will be given</td>
        <td align="center">1</td>
    </tr>
    <tr>
        <td>c</td>
        <td <?php if($data->cert_usage_local_materail=="none") {echo "class='selectedAnswer'";}?>>None</td>
        <td align="center">0</td>
    </tr>

    <tr>
        <th>11</th>
        <th colspan="6" align="left"><b>Whether the unit is registered as a Startup with the Ministry of MSME / DIPP, Government of India</b></th>
    </tr>
    <tr>
        <td>a</td>
        <td <?php if($data->cert_regist_startup=="yes") {echo "class='selectedAnswer'";}?>>Yes</td>
        <td align="center">10</td>
        <td rowspan="2" align="center">10</td>
        <td rowspan="2" align="center">10%</td>
        <td rowspan="2" align="center"><?php echo $this->getEvaluationMarks('cert_regist_startup', $data->cert_regist_startup) ?></td>
        <td rowspan="2" align="center"> 
             <input type="hidden" name="sys_regist_startup" value="<?php echo $this->getEvaluationMarks('cert_regist_startup', $data->cert_regist_startup) ?>">
            <select name="regist_startup" required>
                 <?php if($evaluatedCritearea!="none"){ $v=$evaluatedCritearea['regist_startup'];}else{$v="";} ?>
               
                <option value="">-Select point-</option>
                <option value="10" <?php if($v==10){ echo "selected"; } ?>>10</option>

                <option value="0" <?php if($v==0){ echo "selected"; } ?>>0</option>




            </select>
        </td>
    </tr>
    <tr>
        <td>b</td>
        <td <?php if($data->cert_regist_startup=="none") {echo "class='selectedAnswer'";}?>>No</td>
        <td align="center">0</td>
    </tr>

    <tr>
        <th>12</th>
        <th colspan="6" align="left"><b>Whether the proposal is from the family, whose land was acquired for the development of the particular land bank</b></th>
    </tr>
    <tr>
        <td>a</td>
        <td <?php if($data->cert_land_acquistion=="acquired") {echo "class='selectedAnswer'";}?>>Yes</td>
        <td align="center">10</td>
        <td rowspan="2" align="center">10</td>
        <td rowspan="2" align="center">10%</td>
        <td rowspan="2" align="center"><?php echo $this->getEvaluationMarks('cert_land_acquistion', $data->cert_land_acquistion) ?></td>
        <td rowspan="2" align="center"> 
             <input type="hidden" name="sys_land_acquistion" value="<?php echo $this->getEvaluationMarks('cert_land_acquistion', $data->cert_land_acquistion) ?>">
            <select name="land_acquistion" required>
                  <?php if($evaluatedCritearea!="none"){ $v=$evaluatedCritearea['land_acquistion'];}else{$v="";} ?>
               
                <option value="">-Select point-</option>
                <option value="10" <?php if($v==10){ echo "selected"; } ?>>10</option>

                <option value="0" <?php if($v==0){ echo "selected"; } ?>>0</option>




            </select>
        </td>
    </tr>
    <tr>
        <td>b</td>
        <td <?php if($data->cert_land_acquistion=="none") {echo "class='selectedAnswer'";}?>>No</td>
        <td align="center">0</td>
    </tr>


    <tr>
        <th>13</th>
        <th colspan="6" align="left"><b>Type of Enterpreneur</b></th>
    </tr>
    <tr>
        <td>a</td>
        <td <?php if($data->cert_enterprenure_type=="women") {echo "class='selectedAnswer'";}?>>Women</td>
        <td align="center">5</td>
        <td rowspan="4" align="center">5</td>
        <td rowspan="4" align="center">5%</td>
        <td rowspan="4" align="center"><?php echo $this->getEvaluationMarks('cert_enterprenure_type', $data->cert_enterprenure_type) ?></td>
        
        <td rowspan="4" align="center"> 
            <input type="hidden" name="sys_enterprenure_type" value="<?php echo $this->getEvaluationMarks('cert_enterprenure_type', $data->cert_enterprenure_type) ?>">
            <select name="enterprenure_type" required>
               <?php if($evaluatedCritearea!="none"){ $v=$evaluatedCritearea['enterprenure_type'];}else{$v="";} ?>
               
                <option value="">-Select point-</option>
                <option value="5" <?php if($v==5){ echo "selected"; } ?>>5</option>                      
                <option value="0" <?php if($v==0){ echo "selected"; } ?>>0</option>     
            </select>
        </td>
    </tr>
    <tr>
        <td>b</td>
        <td <?php if($data->cert_enterprenure_type=="army_fighter") {echo "class='selectedAnswer'";}?>>Retired Army professional and / or Freedom fighters</td>
        <td align="center">5</td>
    </tr>
     <tr>
        <td>c</td>
        <td <?php if($data->cert_enterprenure_type=="SC/ST/Physically Handicapped") {echo "class='selectedAnswer'";}?>>SC / ST / Physically Handicapped</td>
        <td align="center">5</td>
    </tr>
    <tr>
        <td>d</td>
        <td <?php if($data->cert_enterprenure_type=="none") {echo "class='selectedAnswer'";}?>>None of above</td>
        <td align="center">0</td>
    </tr>


    <tr>
        <th>14</th>
        <th colspan="6" align="left"><b>Type of unit</b></th>
    </tr>
    <tr>
        <td>a</td>
        <td <?php if($data->cert_unit_type=="vender") {echo "class='selectedAnswer'";}?>>Export Oriented and Ancillary / Vendor units for Large and Medium Industries</td>
        <td align="center">5</td>
        <td rowspan="2" align="center">5</td>
        <td rowspan="2" align="center">5%</td>
        <td rowspan="2" align="center"><?php echo $this->getEvaluationMarks('cert_unit_type', $data->cert_unit_type) ?></td>
        <td rowspan=2" align="center"> 
             <input type="hidden" name="sys_unit_type" value="<?php echo $this->getEvaluationMarks('cert_unit_type', $data->cert_unit_type) ?>">
            <select name="unit_type" required>
                  <?php if($evaluatedCritearea!="none"){ $v=$evaluatedCritearea['unit_type'];}else{$v="";} ?>
               
                <option value="">-Select point-</option>
                <option value="5" <?php if($v==5){ echo "selected"; } ?>>5</option>                      
                <option value="0" <?php if($v==0){ echo "selected"; } ?>>0</option>     
            </select>
        </td>
    </tr>
    <tr>
        <td>b</td>
        <td <?php if($data->cert_unit_type=="none") {echo "class='selectedAnswer'";}?>>If not as above</td>
        <td align="center">0</td>
    </tr>


    <tr>
        <th>15</th>
        <th colspan="6" align="left"><b>Whether unit is benifited through Central / State Sponsored Schemes</b></th>
    </tr>
    <tr>
        <td>a</td>
        <td <?php if($cpc=="yes") {echo "class='selectedAnswer'";}?>>Yes</td>
        <td align="center">5</td>
        <td rowspan="2" align="center">5</td>
        <td rowspan="2" align="center">5%</td>
        <td rowspan="2" align="center"><?php echo $this->getEvaluationMarks('cert_unit_benifited', $data->cert_unit_benifited) ?></td>
        <td rowspan=2" align="center"> 
            <input type="hidden" name="sys_unit_benifited" value="<?php echo $this->getEvaluationMarks('cert_unit_benifited', $data->cert_unit_benifited) ?>">
            <select name="unit_benifited" required>
                  <?php if($evaluatedCritearea!="none"){ $v=$evaluatedCritearea['unit_benifited'];}else{$v="";} ?>
                <option value="">-Select point-</option>
                <option value="5"  <?php if($v==5){ echo "selected"; } ?>>5</option>                      
                <option value="0"  <?php if($v==0){ echo "selected"; } ?>>0</option>     
            </select>
        </td>
    </tr>
    <tr>
        <td>b</td>
        <td <?php if($data->cert_unit_benifited=="none") {echo "class='selectedAnswer'";}?>>No</td>
        <td align="center">0</td>
    </tr>
    <tr><td colspan="7"><a href="javascript:history.back()" class="btn btn-success">Back</a>&nbsp;<input type="submit" class="pull-right btn btn-primary"value="Save"></td></tr>

</table>
    </form>