<?php 
$data=json_decode(json_encode($data));
  //print_r(getEvaluationMarks($data->edu_cert_qual,'intermediate'));
   // echo "<pre>"; print_r($data); die; 
  //print_r($this->getEvaluationMarks('edu_cert_qual',$data->edu_cert_qual));die;


?>
<style type="text/css">
   
table.gridtabledoc1 {
   font-family: verdana,arial,sans-serif;
   color:#333333;
   width: 100%;
   margin-left: 20px;
}
table.gridtabledoc1 th {

   padding: 8px;
   text-align: center;

   background-color: #dedede;
}
table.gridtabledoc1 td {

   padding: 8px;
   font-size: 250px;
   background-color: #ffffff;
}
.aa {
    vertical-align:middle;
}

</style>


 <table cellpadding="2" cellspacing="0" border="1" class="gridtabledoc1" id="hidden-table-info">
 	<tr>
      <th colspan="6"><b>Evaluation Criteria for Land Allotment</b></th>
    </tr>
    <tr><th  width="3%"></th>
    <th width="32%">Name of the Unit</th>
    <th width="65%" colspan="4" align="left"><b> <?php echo $data->company_name ?></b></th>
    </tr>

    <tr>
      <th width="3%"></th>
      <th>Criteria</th>
      <th>Points Distribution</th>
      <th>Max. Points</th>
      <th>Weightage</th>
      <th>Point Scored</th>
    </tr>

 
    <tr>
    <th width="3%">1</th>
    <th colspan="5" align="left"><b>Educational Qualification</b></th>
    </tr>
    <tr>
    <td>a</td>
    <td>Upto Class 12</td>
    <td align="center">3</td>
    <td rowspan="3" align="center" class="aa">5</td>
    <td rowspan="3" align="center" class="aa">5%</td>
    <td rowspan="3" align="center" class="aa"> <?php echo $this->getEvaluationMarks('edu_cert_qual',$data->edu_cert_qual) ?></td>
    </tr>
    <tr>
    <td>b</td>
    <td>Graduation</td>
    <td align="center">4</td>
    </tr>
    <tr>
    <td>c</td>
    <td>Post Graduation and Above</td>
    <td align="center">5</td>
    </tr>

    <tr>
    <th width="3%">2</th>
    <th colspan="5" align="left"><b>Techincal Qualification</b></th>
    </tr>
    <tr>
    <td>a</td>
    <td>None</td>
    <td align="center">2</td>
    <td rowspan="4" align="center">5</td>
    <td rowspan="4" align="center">5%</td>
    <td rowspan="4" align="center"> <?php echo $this->getEvaluationMarks('edu_tech_qual',$data->edu_tech_qual) ?></td>
    </tr>
    <tr>
    <td>b</td>
    <td>ITI</td>
    <td align="center">3</td>
    </tr>
    <tr>
    <td>c</td>
    <td>Diploma</td>
    <td align="center">4</td>
    </tr>
    <tr>
    <td>d</td>
    <td>BE/B.Tech/MCA/MBA/CA</td>
    <td align="center">5</td>
    </tr>

    <tr>
    <th width="3%">3</th>
    <th colspan="5" align="left"><b>Professional Qualification</b></th>
    </tr>
    <tr>
    <td>a</td>
    <td>None</td>
    <td align="center">0</td>
    <td rowspan="3" align="center">10</td>
    <td rowspan="3" align="center">10%</td>
    <td rowspan="3" align="center">  <?php echo $this->getEvaluationMarks('cert_prof_exp',$data->cert_prof_exp) ?></td>
    </tr>
    <tr>
    <td>b</td>
    <td>Experience in Non - Similar Line</td>
    <td align="center">5</td>
    </tr>
    <tr>
    <td>c</td>
    <td>Experience in Similar Line</td>
    <td align="center">10</td>
    </tr>

    <tr>
    <th width="3%">4</th>
    <th colspan="5" align="left"><b>Equity</b></th>
    </tr>
    <tr>
    <td>a</td>
    <td>&lt; 19.99%</td>
    <td align="center">2</td>
    <td rowspan="4" align="center">10</td>
    <td rowspan="4" align="center">10%</td>
    <td rowspan="4" align="center"><?php echo $this->getEvaluationMarks('cert_equity',$data->cert_equity) ?></td>
    </tr>
    <tr>
    <td>b</td>
    <td>&gt; = 20.00% to &lt; 29.99%</td>
    <td align="center">6</td>
    </tr>
    <tr>
    <td>c</td>
    <td>&gt; = 30.00% to &lt; 39.99%</td>
    <td align="center">8</td>
    </tr>
    <tr>
    <td>d</td>
    <td>&gt; = 40.00%</td>
    <td align="center">10</td>
    </tr>

    <tr>
    <th width="3%">5</th>
    <th colspan="5" align="left"><b>Whether unit approved and sanctioned by Financial Institution / NBFC</b></th>
    </tr>
    <tr>
    <td>a</td>
    <td>Yes</td>
    <td align="center">5</td>
    <td rowspan="2" align="center">5</td>
    <td rowspan="2" align="center">5%</td>
    <td rowspan="2" align="center"> <?php echo $this->getEvaluationMarks('cert_unit_approv_sanct',$data->cert_unit_approv_sanct) ?></td>
    </tr>
    <tr>
    <td>b</td>
    <td>No</td>
    <td align="center">0</td>
    </tr>
    
    <tr>
    <th width="3%">6</th>
    <th colspan="5" align="left"><b>Project Cost</b></th>
    </tr>
    <tr>
    <td>a</td>
    <td>Above 1 crore</td>
    <td align="center">10</td>
    <td rowspan="4" align="center">10</td>
    <td rowspan="4" align="center">10%</td>
    <td rowspan="4" align="center"><?php echo $this->getEvaluationMarks('cert_project_cost',$data->cert_project_cost) ?></td>
    </tr>
    <tr>
    <td>b</td>
    <td>Above 50 Lakhs</td>
    <td align="center">7</td>
    </tr>
    <tr>
    <td>c</td>
    <td>Above 25 Lakhs</td>
    <td align="center">5</td>
    </tr>
    <tr>
    <td>d</td>
    <td>Below 25 Lakhs</td>
    <td align="center">3</td>
    </tr>


    <tr>
    <th width="3%">7</th>
    <th colspan="5" align="left"><b>Debt Coverage Ratio</b></th>
    </tr>
    <tr>
    <td>a</td>
    <td> &gt; 2.00 or Zero (when there is no loan)</td>
    <td align="center">5</td>
    <td rowspan="5" align="center">5</td>
    <td rowspan="5" align="center">5%</td>
    <td rowspan="5" align="center"><?php echo $this->getEvaluationMarks('cert_debt_cover_ratio',$data->cert_debt_cover_ratio) ?></td>
    </tr>
    <tr>
    <td>b</td>
    <td>&gt; 1.75 to &lt; = 2.00</td>
    <td align="center">4</td>
    </tr>
    <tr>
    <td>c</td>
    <td>&gt; 1.50 to &lt; = 1.75</td>
    <td align="center">3</td>
    </tr>
    <tr>
    <td>d</td>
    <td>&gt; 1.25 to &lt; = 1.50</td>
    <td align="center">2</td>
    </tr>
    <tr>
    <td>e</td>
    <td>&gt; 1.00 to &lt; = 1.25</td>
    <td align="center">1</td>
    </tr>


    <tr>
    <th width="3%">8</th>
    <th colspan="5" align="left"><b>Pollution Category</b></th>
    </tr>
    <tr>
    <td>a</td>
    <td>White</td>
    <td align="center">5</td>
    <td rowspan="4" align="center">5</td>
    <td rowspan="4" align="center">5%</td>
    <td rowspan="4" align="center"><?php echo $this->getEvaluationMarks('cert_poll_cat',$data->cert_poll_cat) ?></td>
    </tr>
    <tr>
    <td>b</td>
    <td>Green</td>
    <td align="center">4</td>
    </tr>
    <tr>
    <td>c</td>
    <td>Orange</td>
    <td align="center">3</td>
    </tr>
    <tr>
    <td>d</td>
    <td>Red</td>
    <td align="center">2</td>
    </tr>

    <tr>
    <th width="3%">9</th>
    <th colspan="5" align="left"><b>Adoption of Water Conservation System</b></th>
    </tr>
    <tr>
    <td>a</td>
    <td>Yes</td>
    <td align="center">5</td>
    <td rowspan="2" align="center">5</td>
    <td rowspan="2" align="center">5%</td>
    <td rowspan="2" align="center"><?php echo $this->getEvaluationMarks('cert_adpt_water_system',$data->cert_adpt_water_system) ?></td>
    </tr>
    <tr>
    <td>b</td>
    <td>No</td>
    <td align="center">0</td>
    </tr>


    <tr>
    <th width="3%">10</th>
    <th colspan="5" align="left"><b>Usage of Local Raw Materials</b></th>
    </tr>
    <tr>
    <td>a</td>
    <td>For 30% of total raw material</td>
    <td align="center">2</td>
    <td rowspan="3" align="center">5</td>
    <td rowspan="3" align="center">5%</td>
    <td rowspan="3" align="center"><?php echo $this->getEvaluationMarks('cert_usage_local_materail',$data->cert_usage_local_materail) ?></td>
    </tr>
    <tr>
    <td>b</td>
    <td>For 10% additional, one mark will be given</td>
    <td align="center">1</td>
    </tr>
    <tr>
    <td>c</td>
    <td>None</td>
    <td align="center">0</td>
    </tr>

    <tr>
    <th width="3%">11</th>
    <th colspan="5" align="left"><b>Whether the unit is registered as a Startup with the Ministry of MSME / DIPP, Government of India</b></th>
    </tr>
    <tr>
    <td>a</td>
    <td>Yes</td>
    <td align="center">10</td>
    <td rowspan="2" align="center">10</td>
    <td rowspan="2" align="center">10%</td>
    <td rowspan="2" align="center"><?php echo $this->getEvaluationMarks('cert_regist_startup',$data->cert_regist_startup) ?></td>
    </tr>
    <tr>
    <td>b</td>
    <td>No</td>
    <td align="center">0</td>
    </tr>
    
    <tr>
    <th width="3%">12</th>
    <th colspan="5" align="left"><b>Whether the proposal is from the family, whose land was acquired for the development of the particular land bank</b></th>
    </tr>
    <tr>
    <td>a</td>
    <td>Yes</td>
    <td align="center">10</td>
    <td rowspan="2" align="center">10</td>
    <td rowspan="2" align="center">10%</td>
    <td rowspan="2" align="center"><?php echo $this->getEvaluationMarks('cert_land_acquistion',$data->cert_land_acquistion) ?></td>
    </tr>
    <tr>
    <td>b</td>
    <td>No</td>
    <td align="center">0</td>
    </tr>


    <tr>
    <th width="3%">13</th>
    <th colspan="5" align="left"><b>Type of Enterpreneur</b></th>
    </tr>
    <tr>
    <td>a</td>
    <td>Women</td>
    <td align="center">5</td>
    <td rowspan="3" align="center">5</td>
    <td rowspan="3" align="center">5%</td>
    <td rowspan="3" align="center"><?php echo $this->getEvaluationMarks('cert_enterprenure_type',$data->cert_enterprenure_type) ?></td>
    </tr>
    <tr>
    <td>b</td>
    <td>Retired Army professional and / or Freedom fighters</td>
    <td align="center">5</td>
    </tr>
    <tr>
    <td>c</td>
    <td>None of above</td>
    <td align="center">0</td>
    </tr>


    <tr>
    <th width="3%">14</th>
    <th colspan="5" align="left"><b>Type of unit</b></th>
    </tr>
    <tr>
    <td>a</td>
    <td>Export Oriented and Ancillary / Vendor units for Large and Medium Industries</td>
    <td align="center">5</td>
    <td rowspan="2" align="center">5</td>
    <td rowspan="2" align="center">5%</td>
    <td rowspan="2" align="center"><?php echo $this->getEvaluationMarks('cert_unit_type',$data->cert_unit_type) ?></td>
    </tr>
    <tr>
    <td>b</td>
    <td>If not as above</td>
    <td align="center">0</td>
    </tr>


<tr>
    <th width="3%">15</th>
    <th colspan="5" align="left"><b>Whether unit is benifited through Central / State Sponsored Schemes</b></th>
    </tr>
    <tr>
    <td>a</td>
    <td>Yes</td>
    <td align="center">5</td>
    <td rowspan="2" align="center">5</td>
    <td rowspan="2" align="center">5%</td>
    <td rowspan="2" align="center"><?php echo $this->getEvaluationMarks('cert_unit_benifited',$data->cert_unit_benifited) ?></td>
    </tr>
    <tr>
    <td>b</td>
    <td>No</td>
    <td align="center">0</td>
    </tr>


</table>