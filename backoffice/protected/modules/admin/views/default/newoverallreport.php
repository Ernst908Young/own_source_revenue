<?php


// Rahul Kumar
// 12-12-2017


$this->breadcrumbs=array(

	'Bo Application Submissions'=>array('index'),

	'Manage',

);



$this->menu=array(

	array('label'=>'List BoApplicationSubmission', 'url'=>array('index')),

	array('label'=>'Create BoApplicationSubmission', 'url'=>array('create')),

);



Yii::app()->clientScript->registerScript('search', "

$('.search-button').click(function(){

	$('.search-form').toggle();

	return false;

});

$('.search-form form').submit(function(){

	$('#bo-application-submission-grid').yiiGridView('update', {

		data: $(this).serialize()

	});

	return false;

});

");

?>



<style>

.grid-view table.items th {

    color: white;

    background: url('images/sort_both.png') no-repeat center right #778899;

    text-align: center;

    text-transform: lowercase;

    text-transform: capitalize;

}

.grid-view table.items tr.odd {

    background: #f1f2f7;  

}

.grid-view table.items tr.even {

    background: #FFFFFF;

}

.grid-view table.items th, .grid-view table.items td {

    font-size: 0.9em;

    border: 1px solid #ddd;

    padding: 0.3em;

    text-transform: lowercase;

    text-transform: capitalize;

}

.grid-view table.items tbody tr.odd:hover {

    background: #f1f2f7;

}

.grid-view table.items tbody tr.even:hover {

    background: #FFFFFF;

}

.grid-view table.items th, .grid-view table.items td {

    font-size: 13px;

    border: 1px solid #ddd;

    padding: 0.3em;

    font-weight: 500;

    text-transform: lowercase;

    text-transform: capitalize;

}

.grid-view table.items th a {

    color: #FFF;

    font-weight: 500;

    text-decoration: none;

    text-transform: lowercase;

    text-transform: capitalize;

}

</style>



<style>

.panel {

    overflow: hidden;

}

.panel-body{

	padding: 0px;

}

.section-data{

    float: left;

}

.section-data li{

    border-left: 1px solid #eee;

    border-bottom: 1px solid #eee;

    padding: 5px 6px;

    text-align: center;

}

.header-se{

    height: 50px;

    background: #ccc;

    color: #000;

}

</style>

<style type="text/css">

    .rsltstatus{color:red;}

    .panel{

      background-color: #FFFFFF;

    }



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

   text-align: center;

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



</style>






<?php
$connection=Yii::app()->db;
$sql="Select district_id, distric_name from bo_district";            
$command=$connection->createCommand($sql);
$depptt=$command->queryAll(); 
?>



  <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <i style="font-size:24px" class="font-dark"></i>
                                            <span class="caption-subject bold uppercase">Overall Proposals Report Under Single Window Clearance System </span>
                                        </div>
                                        <div class="tools" style="padding:5px 0 8px"> <button type="button" class="btn dark btn-outline sbold uppercase"> <a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('/mis/boApplicationSubmission/pdfoverallreport/'); ?>">PDF</button></a></div>
                                    </div>
                                    <div class="portlet-body">

                           <table cellpadding="2" cellspacing="0" border="0" class="gridtabledoc1" id="sample_1">
                               <thead>
                               <tr>
                               <th colspan="14" align="center"><b>District Level Proposals Under Single Window Clearance System and their Status</b></th>
                               </tr>
                               <tr>
                               	   <th>S.No.</th>
                                   <th>District</th>
                                   <!--<th>Archived</th>
                                   <th>Incomplete</th>
                                   <th>Pending for Payment</th>-->
                                   <th>Total Submitted</th>
                                   <th align="centre">Pending with DIC</th>
                                   <th>Reverted back to Investor</th>
                                   <th>Forwarded to Departments</th>
                                    <th>Pending with Departments</th>
                                   <th style="background-color:red !important;">Rejected</th>
                                    <th style="background-color:greenyellow !important;">Approved</th>
                                   
                                    <th style="background-color:greenyellow !important;">Total Employment Male</th>
                                     <th style="background-color:greenyellow !important;">Total Employment Female</th>
                                     <th style="background-color:greenyellow !important;"> Total Investment (in INR Cr.)</th>
                                   
                               
                                                                 
                               </tr>
                               </thead>
                               <tbody>

                              <?php 
$totalArchived=0;
$totalPendingForPayment=0;
                              $count=1;
                              $count1=0;
                              $count2=0;
                              $count3=0;
                              $count4=0;
                              $count5=0;
                              $count6=0;
                              $count7=0;
                              $count8=0;
                              $count9=0;
                              $count10=0;
                              $count11=0;
                              $count12=0;
                            foreach ($depptt as $key => $dept) {

                            if($dept['district_id']=='6')           
                            {         

                            $totoaldistrictDDN=ApplicationExt::getTotalOverAllDistrictReceivedDDNApps('6');
                            $totalDICPendingDDN=ApplicationExt::getTotalOverAllDistrictDICPendingDDNApps('6','P');
                            // $totalDIC48PendingDDN=ApplicationExt::getTotalOverAllDistrictDICPending48DDNApps('6','P');
							           $totalDIC48PendingDDN=ApplicationExt::getTotalOverAllDistrictDICPending48DDNAppsV('6','P');
            							$totalRevertedDDN=ApplicationExt::getTotalOverAllDistrictRevertedDDNApps('6','H'); 
            							$totalForwardedDDN=ApplicationExt::getTotalOverAllDistrictForwardedDDNApps('6');
            							$totalApprovedDDN=ApplicationExt::getTotalOverAllDistrictApprovedDDNApps('6','A');
            							$totalRejectedDDN=ApplicationExt::getTotalOverAllDistrictRejectedDDNApps('6','R');
            							$totalForwardedDeptDDN=ApplicationExt::getTotalOverAllDistrictForwardedDeptDDNApps('6','F'); 
            							$totalMaleEmpDDN=ApplicationExt::getProjectTotalEMPDDNMale('6');
                            $totalFemaleEmpDDN=ApplicationExt::getProjectTotalEMPDDNFemale('6');
                            $totalInvestmentDDN=ApplicationExt::getProjectTotalDDNInvestment('6');
							}

							else

							{

							

							$totalCAFrecived=ApplicationExt::getTotalOverAllDistrictReceivedApps($dept['district_id']);

							$totalDICPending=ApplicationExt::getTotalOverAllDistrictDICPendingApps($dept['district_id'],'P');

							$totalDIC48Pending=ApplicationExt::getTotalOverAllDistrictDICPending48Apps($dept['district_id'],'P');

							$totalReverted=ApplicationExt::getTotalOverAllDistrictRevertedApps($dept['district_id'],'H'); 

							$totalForwarded=ApplicationExt::getTotalOverAllDistrictForwardedApps($dept['district_id']);

							$totalApproved=ApplicationExt::getTotalOverAllDistrictApprovedApps($dept['district_id'],'A');

							$totalRejected=ApplicationExt::getTotalOverAllDistrictRejectedApps($dept['district_id'],'R');

							$totalForwardedDept=ApplicationExt::getTotalOverAllDistrictForwardedDeptApps($dept['district_id'],'F');  

                            $totalMaleEmp=ApplicationExt::getProjectTotalEMPMale($dept['district_id']);

                            $totalFemaleEmp=ApplicationExt::getProjectTotalEMPFemale($dept['district_id']);

                            $totalInvestment=ApplicationExt::getProjectTotalInvestment($dept['district_id']);





                            $count1+=$totalCAFrecived;

							$count2+=$totalDICPending;

							$count3+=$totalDIC48Pending;

							$count4+=$totalReverted;

							$count5+=$totalForwarded;

							$count6+=$totalApproved;

							$count7+=$totalRejected;

							$count8+=$totalForwardedDept;

							$count9+=$totalMaleEmp;

							$count10+=$totalFemaleEmp;

							$count11+=$totalInvestment ;



                        	}





                            echo "<tr>";

                             ?>



							<td align="center"><?php echo $count ?></td>

                         	<td  align="center"><?php echo $dept['distric_name'] ?></td>
                         	<!--<td  align="center"><?php 	$sql="SELECT count(*) as total FROM bo_application_submission WHERE application_status='Z' AND user_id not in('11')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$archivedCount=$command->queryRow();	
		if($archivedCount===false){
                echo 0;}else{
		//echo  $archivedCount['total']; 
                    echo 0;
               $totalArchived=@$totalArchived+$archivedCount['total'];
                }
                ?></td>
                         	<td  align="center"><?php 	$sql="SELECT count(*) as total FROM bo_application_submission WHERE application_status='B' AND user_id not in('11')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$pendingForPaymentCount=$command->queryRow();	
		if($pendingForPaymentCount===false){
                echo 0;}else{
		echo  0;
                    //$pendingForPaymentCount['total']; 
              // $totalPendingForPayment=$totalPendingForPayment+$pendingForPaymentCount['total'];
                }
                ?></td>
                         	<td  align="center"><?php echo 0;// ?></td>-->

                         	<td align="center"><b><?php if($dept['district_id']=='6'){ echo $totoaldistrictDDN; }  else{ echo $totalCAFrecived;} ?></b></td>

                           	<td align="center"><b><?php if($dept['district_id']=='6'){ echo $totalDICPendingDDN+$totalDIC48PendingDDN; }  else{ echo $totalDICPending+$totalDIC48Pending; } ?></b></td>

                           	<!--<td align="center"><b><?php if($dept['district_id']=='6'){ echo $totalDIC48PendingDDN; }  else{ echo $totalDIC48Pending; } ?></b></td>-->

                           	<td align="center"><b><?php if($dept['district_id']=='6'){ echo $totalRevertedDDN; }  else{ echo $totalReverted; }  ?></b></td>

                           	<td align="center"><b><?php if($dept['district_id']=='6'){ echo $totalForwardedDDN; }  else{ echo $totalForwarded; }   ?></b></td>

                           
                           	<!--<td align="center"><b><?php if($dept['district_id']=='6'){ echo $totalForwardedDeptDDN; }  else{ echo $totalForwardedDept; } ?></b></td>-->

                           	<!--<td align="center"><b><?php if($dept['district_id']=='6'){ echo $totalMaleEmpDDN; }  else{ echo $totalMaleEmp; } ?></b></td>

                           	<td align="center"><b><?php if($dept['district_id']=='6'){ echo $totalFemaleEmpDDN; }  else{ echo $totalFemaleEmp; }  ?></b></td>

                           	<td align="center"><b><?php if($dept['district_id']=='6'){ echo $totalInvestmentDDN; }  else{ echo $totalInvestment; }  ?></b></td>-->

                                
                                 <td align="center"><b><?php if($dept['district_id']=='6'){ echo $totalForwardedDeptDDN; }  else{ echo $totalForwardedDept; } ?></b></td>
                                 
                           	<td align="center" >&nbsp;<b><?php if($dept['district_id']=='6'){ echo $totalRejectedDDN; }  else{ echo $totalRejected; } ?></b></td>
                                 <td align="center" ><b><?php if($dept['district_id']=='6'){ echo $totalApprovedDDN; }  else{ echo $totalApproved; }  ?></b></td>
                               
<td align="center"><b><?php if($dept['district_id']=='6'){ echo $totalMaleEmpDDN; }  else{ echo $totalMaleEmp; } ?></b></td>

                           	<td align="center"><b><?php if($dept['district_id']=='6'){ echo $totalFemaleEmpDDN; }  else{ echo $totalFemaleEmp; }  ?></b></td>

                           	<td align="center" ><b><?php if($dept['district_id']=='6'){ echo $totalInvestmentDDN; }  else{ echo $totalInvestment; }  ?></b></td>





                           </tr>

<?php





$count++;







                            }



                               ?>

                               <tr>

                               <th colspan="2">Total</th>

							<!--   <th><?php 	$sql="SELECT count(*) as total FROM bo_application_submission WHERE application_status='Z' AND user_id not in('11') AND application_id=1";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$archivedCount=$command->queryRow();	
		if($archivedCount===false){
                echo 0;}else{		
               echo $archivedCount['total'];
                }
                ?></th>
							   <th><?php 	$sql="SELECT count(*) as total FROM bo_application_submission WHERE application_status='I' AND user_id not in('11') AND application_id=1";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$incompleteCount=$command->queryRow();	
		if($incompleteCount===false){
                echo 0;}else{		
               echo $incompleteCount['total'];
                }
                ?></th>
							   <th><?php $sql="SELECT count(*) as total FROM bo_application_submission WHERE application_status='B' AND user_id not in('11') AND application_id=1";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$pendingForPaymentCount=$command->queryRow();	
		if($pendingForPaymentCount===false){
                echo 0;}else{		
               echo $pendingForPaymentCount['total'];
                }
                ?></th>-->
							  <th><?php echo $count1+$totoaldistrictDDN ?></th>

							   <th><?php echo ($count2+$totalDICPendingDDN)+($count3+$totalDIC48PendingDDN); ?></th>

							   <th><?php echo $count4+$totalRevertedDDN ?></th>

							   <th><?php echo $count5+$totalForwardedDDN ?></th>
                                                             <th><?php echo $count8+$totalForwardedDeptDDN ?></th>
                                                         

							   <th style="background-color: red !important;"><?php echo $count7+$totalRejectedDDN ?></th>
                                                           
                                                             <th style="background-color: greenyellow !important;"><?php echo $count6+$totalApprovedDDN ?></th>
                                                             
                                                           
                                                              <th style="background-color: greenyellow !important;"><?php echo $count9+$totalMaleEmpDDN ?></th>

							   <th style="background-color: greenyellow !important;"><?php echo $count10+$totalFemaleEmpDDN ?></th>

							   <th style="background-color: greenyellow !important;"><?php echo $count11+$totalInvestmentDDN ?></th>


								</tr>

                               </tbody>

                           </table>


 


</br>

</br>





<table cellpadding="2" cellspacing="0" border="0" class="gridtabledoc1" id="hidden-table-info">

                               <thead>

                               <tr>

                               <th colspan="14" align="center"><b>State Level Proposals Under Single Window Clearance System and their Status</b></th>

                               </tr>

                               <tr>

                               	   <th>S.No.</th>

                                   <th>District</th>
                                   <!--<th>Archived</th>
                                   <th>Incomplete</th>
                                   <th>Pending for Payment</th>-->

                                   <th>Total Submitted</th>

                                   <th align="centre">Pending with DIC</th>

                                   <th>Reverted back to Investor</th>

                                   <th>Forwarded to Departments</th>
                                   
                                     
                                     <th>Pending with Departments</th>   
                                   
                                    <th  style="background-color: red !important;">Rejected Applications</th>
                                    
                                     <th  style="background-color: greenyellow !important;">Approved Applications</th>                                     
                                                                 

                                   <th  style="background-color: greenyellow !important;">Total Employment Male</th>
                                   
                                   <th style="background-color: greenyellow !important;">Total Employment Female</th>

                                   <th  style="background-color: greenyellow !important;">Total Investment (in INR Cr.)</th>  

                               </tr>

                               </thead>

                               <tbody>

                              <?php 

                             

                            $totoaldistrictSTATEDDN=ApplicationExt::getTotalOverAllDistrictReceivedSTATEDDNApps('6');

                            $totalDICPendingSTATEDDN=ApplicationExt::getTotalOverAllDistrictDICPendingSTATEDDNApps('6','P');

							$totalDIC48PendingSTATEDDN=ApplicationExt::getTotalOverAllDistrictDICPending48STATEDDNApps('6','P');

							$totalRevertedSTATEDDN=ApplicationExt::getTotalOverAllDistrictRevertedSTATEDDNApps('6','H'); 

							$totalForwardedSTATEDDN=ApplicationExt::getTotalOverAllDistrictForwardedSTATEDDNApps('6');

							$totalApprovedSTATEDDN=ApplicationExt::getTotalOverAllDistrictApprovedSTATEDDNApps('6','A');

							$totalRejectedSTATEDDN=ApplicationExt::getTotalOverAllDistrictRejectedSTATEDDNApps('6','R');

							$totalForwardedDeptSTATEDDN=ApplicationExt::getTotalOverAllDistrictForwardedDeptSTATEDDNApps('6','F'); 

							$totalMaleEmpSTATEDDN=ApplicationExt::getProjectTotalEMPSTATEDDNMale('6');

                            $totalFemaleEmpSTATEDDN=ApplicationExt::getProjectTotalEMPSTATEDDNFemale('6');

                            $totalInvestmentSTATEDDN=ApplicationExt::getProjectTotalSTATEDDNInvestment('6');



							





                            echo "<tr>";

                             ?>



							<td align="center"><?php echo '1' ?></td>

                         	<td><?php echo 'STATE ' ?></td>
                         	<!--<td  align="center"><?php echo 0 ?></td>
                         	<td  align="center"><?php echo 0 ?></td>
                         	<td  align="center"><?php echo 0 ?></td>-->

                         	<td align="center"><?php echo $totoaldistrictSTATEDDN ?></td>

                           	<td align="center"><?php echo $totalDICPendingSTATEDDN + $totalDIC48PendingSTATEDDN ?></td>

                           	<td align="center"><?php echo $totalRevertedSTATEDDN  ?></td>

                           	<td align="center"><?php echo $totalForwardedSTATEDDN ?></td>
                                <td align="center" ><?php echo $totalForwardedDeptSTATEDDN ?></td>

                                <td align="center"><?php echo $totalRejectedSTATEDDN ?></td>

                           	<td align="center" ><?php echo $totalApprovedSTATEDDN ?></td>

                           	
                           	

                           	<td align="center"><?php echo $totalMaleEmpSTATEDDN ?></td>

                           	<td align="center"><?php echo $totalFemaleEmpSTATEDDN  ?></td>

                           	<td align="center"><?php echo $totalInvestmentSTATEDDN  ?></td>

                                 



                           </tr>



                                                    



                               <tr>

                               <th colspan="2">Grand Total (District+State)</th>
                              <!-- <th>0</th>
                               <th>0</th>
                               <th>0</th>-->

							   <th><?php echo $count1+$totoaldistrictDDN+$totoaldistrictSTATEDDN ?></th>

							   <th><?php echo $count2+$totalDICPendingDDN+$totalDICPendingSTATEDDN +$count3+$totalDIC48PendingDDN+$totalDIC48PendingSTATEDDN; ?></th>

							   <th><?php echo $count4+$totalRevertedDDN+$totalRevertedSTATEDDN ?></th>

							   <th><?php echo $count5+$totalForwardedDDN+$totalForwardedSTATEDDN ?></th>
                                                            <th><?php echo $count8+$totalForwardedDeptDDN+$totalForwardedDeptSTATEDDN ?></th>


                                                              <th  style="background-color: red !important;"><?php echo $count7+$totalRejectedDDN+$totalRejectedSTATEDDN ?></th>

                                                              
							   <th  style="background-color: greenyellow !important;"><?php echo $count6+$totalApprovedDDN+$totalApprovedSTATEDDN ?></th>

							
							   <th  style="background-color: greenyellow !important;"><?php echo $count9+$totalMaleEmpDDN+$totalMaleEmpSTATEDDN ?></th>

							   <th  style="background-color: greenyellow !important;"><?php echo $count10+$totalFemaleEmpDDN+$totalFemaleEmpSTATEDDN ?></th>

							   <th  style="background-color: greenyellow !important;"><?php echo $count11+$totalInvestmentDDN+$totalInvestmentSTATEDDN ?></th>

								</tr>

                               </tbody>

                           </table>


<table cellpadding="2" cellspacing="0" border="0" class="gridtabledoc1" id="hidden-table-info" style="margin-top:30px;">

                               <thead>

                               <tr>

                               <th colspan="15" align="center"><b>Grand total with all status</b></th>

                               </tr>

                               <tr>

                               	   <th>S.No.</th>

                                   <th>District</th>
                                   <th>Archived</th>
                                   <th>Incomplete</th>
                                   <th>Pending for Payment</th>

                                   <th>Total Submitted</th>

                                   <th align="centre">Pending with DIC</th>

                                   <th>Reverted back to Investor</th>

                                   <th>Forwarded to Departments</th>
                                   
                                    <th>Rejected Applications</th>
                                    
                                     <th>Approved Applications</th>
                                     
                                     <th>Pending with Departments</th>

                                  

                                   <th>Total Employment Male</th>
                                   
                                   <th>Total Employment Female</th>

                                   <th>Total Investment (in INR Cr.)</th>  

                               </tr>

                               </thead>
                               <tbody>
                                              <tr>

                               <th colspan="2">Grand Total (District+State)</th>
                                <th><?php 	$sql="SELECT count(*) as total FROM bo_application_submission WHERE application_status='Z' AND user_id not in('11')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$archivedCount=$command->queryRow();	
		if($archivedCount===false){
                echo 0;}else{		
               echo $archivedCount['total'];
                }
                ?></th>
							   <th><?php 	$sql="SELECT count(*) as total FROM bo_application_submission WHERE application_status='I' AND application_id=1 AND user_id not in('11')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$incompleteCount1=$command->queryRow();	
		if($incompleteCount1===false){
                echo 0;}else{		
               echo $incompleteCount1['total'];
                }
                ?></th>
							   <th><?php $sql="SELECT count(*) as total FROM bo_application_submission WHERE application_status='B' AND user_id not in('11')";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$pendingForPaymentCount=$command->queryRow();	
		if($pendingForPaymentCount===false){
                echo 0;}else{		
               echo $pendingForPaymentCount['total'];
                }
                ?></th>

							   <th><?php echo $count1+$totoaldistrictDDN+$totoaldistrictSTATEDDN ?></th>

							  			   <th><?php echo $count2+$totalDICPendingDDN+$totalDICPendingSTATEDDN +$count3+$totalDIC48PendingDDN+$totalDIC48PendingSTATEDDN; ?></th>

							   <th><?php echo $count4+$totalRevertedDDN+$totalRevertedSTATEDDN ?></th>

							   <th><?php echo $count5+$totalForwardedDDN+$totalForwardedSTATEDDN ?></th>

                                                              <th><?php echo $count7+$totalRejectedDDN+$totalRejectedSTATEDDN ?></th>

                                                              
							   <th><?php echo $count6+$totalApprovedDDN+$totalApprovedSTATEDDN ?></th>

							 <th><?php echo $count8+$totalForwardedDeptDDN+$totalForwardedDeptSTATEDDN ?></th>

							   <th><?php echo $count9+$totalMaleEmpDDN+$totalMaleEmpSTATEDDN ?></th>

							   <th><?php echo $count10+$totalFemaleEmpDDN+$totalFemaleEmpSTATEDDN ?></th>

							   <th><?php echo $count11+$totalInvestmentDDN+$totalInvestmentSTATEDDN ?></th>

								</tr>
                               </tbody>
</table>






  </div>
                                </div>
                            </div>
                        </div>













    </section><!--/.panel-->



