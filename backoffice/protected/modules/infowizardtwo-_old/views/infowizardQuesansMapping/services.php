<style>



table.tftable {font-size:12px;color:#333333;width:100%;border-width: 1px;border-color: #729ea5;border-collapse: collapse;}

table.tftable th {font-size:12px;background-color:#acc8cc;border-width: 1px;padding: 8px;border-style: solid;border-color: #729ea5;text-align:left;}

table.tftable tr {background-color:#d4e3e5;}

table.tftable td {font-size:12px;border-width: 1px;padding: 2px;border-style: solid;border-color: #729ea5;}

</style>

<?php



$stringArr=array();

if(!empty($result)) { 

foreach($result as $rstl)

$stringArr[]=$rstl;

$var = $implodedString=implode(",",$stringArr);

//print_r($var); die;
  }
 else { echo "<p>Not Selected Any Question.</p>"; }
 
$connection=Yii::app()->db;
$sql="SELECT distinct sm.* FROM  bo_infowizard_quesans_serviceform as ansm,bo_information_wizard_service_master as sm WHERE ansm.service_id=sm.id and ansm.queans_mapp_id 
in ($var) and ansm.is_active='Y'";

$command=$connection->createCommand($sql);
$resultdata=$command->queryAll();//will return array if there is any record otherwise return false
//print_r($resultdata); die;
?>

<?php foreach ($resultdata as $keyss => $allDi) {  // print_r($allDi); 
if ($allDi['incidence_pre_establishment']==1) {   $stringid[]=$allDi['id']; } 
if ($allDi['incidence_pre_operation']==1) {    $stringidper[]=$allDi['id']; }
if ($allDi['incidence_post_operation']==1) {   $stringidpost[]=$allDi['id']; }
 }

//print_r($stringid); echo "--"; 
//print_r($stringidper);
//print_r($stringidpost);

?>




<?php if(!empty($stringid)) { ?>


<div class="container">

	<div class="services-result">

		<h5>Mandatory State Approvals for Setting up of Business ( Pre-Establishment ) </h5>

			<table class="tftable">

			<tr>

			<th align="centre">S.No.</th>

			<th>Services</th>

			<th>Department</th>

			</tr>
			<?php $ni=1;
			foreach ($stringid as $key => $preest) {  ?>
			
             <tr>

			<td align="center"><?php echo $ni++;  ?></td>

			<td><?php $adata=InfowizardQuesansMappingController::getDetailofService($preest); echo $adata[0]['service_name']; ?></td>

			<td><?php  $issuername=InfowizardQuesansMappingController::getNameOfIssuerBy($adata[0]['issuerby_id']); echo $issuername['name'];  ?></td>

			

			</tr>
<?php } ?>
 </table>

</div>

</div>

<?php } ?>

<br />

<?php if(!empty($stringidper)) { ?>


<div class="container">

	<div class="services-result">

		<h5>Mandatory State Approvals for Setting up of Business ( Pre-Operation ) </h5>

			<table class="tftable">

			<tr>

			<th align="centre">S.No.</th>

			<th>Services</th>

			<th>Department</th>

			</tr>
			<?php $nii=1;
			foreach ($stringidper as $key => $preoperation) {   ?>
			
             <tr>

			<td align="center"><?php echo $nii++;  ?></td>

			<td><?php $bdata=InfowizardQuesansMappingController::getDetailofService($preoperation); echo $bdata[0]['service_name'];  ?></td>

			<td><?php $issuernameb=InfowizardQuesansMappingController::getNameOfIssuerBy($bdata[0]['issuerby_id']); echo $issuernameb['name'];  ?></td>

			

			</tr>
<?php } ?>
 </table>

</div>

</div>

<?php } ?>


<br />

<?php if(!empty($stringidpost)) { ?>


<div class="container">

	<div class="services-result">

		<h5>Mandatory State Approvals for Setting up of Business ( Post-Operation ) </h5>

			<table class="tftable">

			<tr>

			<th align="centre">S.No.</th>

			<th>Services</th>

			<th>Department</th>

			</tr>
			<?php $niiaa=1;
			foreach ($stringidpost as $key => $postoperation) {  ?>
			
             <tr>

			<td align="center"><?php echo $niiaa++;  ?></td>

			<td><?php $cdata=InfowizardQuesansMappingController::getDetailofService($postoperation); echo $cdata[0]['service_name'];  ?></td>

			<td><?php $issuernamec=InfowizardQuesansMappingController::getNameOfIssuerBy($cdata[0]['issuerby_id']); echo $issuernamec['name'];  ?></td>

			

			</tr>
<?php } ?>
 </table>

</div>

</div>

<?php } if (empty($stringid) && empty($stringidpre) && empty($stringidpost)) { echo "<p>No Service for These Question.</p>"; }?>
