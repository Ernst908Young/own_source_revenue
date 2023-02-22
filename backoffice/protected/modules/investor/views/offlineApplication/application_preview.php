<?php
// @SANTOSH FOR Offline/Online
// Date - 24-10-2017

@extract($_GET);
//$service_id = $service_id;
//$sub_service_id = $sub_service_id;
//$caf_id = $caf_id;

$status_array = array("U"=>'Unverified',"V"=>'Verified');
$invData = ApplyServiceExt::getInvestorDetails();
?>
<style>
.mt-element-step .step-thin .mt-step-title a{font-size:14px; font-weight:bold;}
.mt-step-number .bg-white .font-grey{font-size:16px;}
.col-md-2{width:20%;}
a:hover{ color:#000;}
h4{font-weight:bold;}
</style>
<div class="portlet-body">
<div class="mt-element-step">
	
	<div class="row step-thin print_hide">
	   
		<div class="col-md-12 bg-grey  mt-step-col ">
			
			<h4>#<?php echo $res_app['offline_application_reference_number']; ?> :: <?php echo $res_sp_app['app_name']; ?></h4>
			
		</div>
		
	</div>
	
   
</div>
</div>
<form action="" name="form" method="POST">
<section class="panel site-min-height">
 
  
    <div class="panel-body">
	<table class="table table-scrollable table-lg mt-lg mb-0" width="100%">
			<tr>
				<td><b>Name</b></td>
				<td><?php echo $invData['first_name']." ".$invData['last_name']; ?></td>
				<td><b>IUID</b></td>
				<td><?php echo $invData['iuid']; ?></td>
			</tr>
			<tr>
				<td><b>CAF ID</b></td>
				<td><?php echo $res_app['caf_id']; ?></td>
				<td><b>Phone number</b></td>
				<td><?php echo $invData['mobile_number']; ?></td>
			</tr>
			<tr>
				<td><b>Email ID</b></td>
				<td><?php echo $invData['email']; ?></td>
				<td><b>Application Reference Number</b></td>
				<td><?php echo $res_app['offline_application_reference_number']; ?></td>
			</tr>
			<!--<tr>
				<td><b>Apply Date</b></td>
				<td><?php echo $res_sp_app['created_on']; ?></td>
				<td><b>Application Reference Number</b></td>
				<td><?php echo $res_app['offline_application_reference_number']; ?></td>
			</tr>-->
		</table>
		<br>
	
	<div class="table">
		


<br>
		<table class="table table-bordered table-scrollable table-lg mt-lg mb-0" width="150%">
		<thead><tr><th>S.No</th><th>Document Code</th><th>Document Type</th><th>Issued By</th><th>Document Name</th><th>Is Required</th><th>Comment</th><th>Version</th><th>Status</th><th>View</th></tr></thead>
                            <tbody>
							<?php
							$disable_btn_text = false;
							$disable_btn_help_text = false;
							$documents_id='';
							$documents_id_name='';
							if(count($mapped_documents_array)>0){
								foreach($mapped_documents_array as $key=>$mapped_documents_array_data){
									$doc_datas = ApplyServiceExt::getDocumentsDataByID($mapped_documents_array_data['doc_id']);
									$dms_datas = ApplyServiceExt::getUploadedDocumentsDataByID($mapped_documents_array_data['doc_id']);
							?>
							<tr>
							<td>1.<?php echo $key; ?></td>
							<td><?php echo $doc_datas['chklist_id']; ?></td>
							<td><?php echo $doc_datas['document_type']; ?></td>
							<td><?php echo $doc_datas['issuerby_name']; ?></td>
							<td><?php echo $doc_datas['document_name']; ?></td>
							<td><?php echo $mapped_documents_array_data['is_required']; ?></td>
							<td><?php echo $mapped_documents_array_data['doc_comment']; ?></td>
							<td width="10%">
							<?php 
								if(!empty($dms_datas)){
									echo $dms_datas['document_version_type'].$dms_datas['document_version'];
									$documents_id .= $dms_datas['documents_id'].","; 
									$documents_id_name .= $dms_datas['document_name'].","; 
								}else{
									echo 'N.A';
									if($mapped_documents_array_data['is_required'] == 'Y'){
										$disable_btn_text="disabled";
										$disable_btn_help_text="Please upload mandatory document(s) as well as non-mandaotry document(s) which might be required for the application processing as per your specific criteria. You can only continue once you have atleast uploaded mandatory document(s).";
									}
								}
							?>
							</td>
							<td width="10%">
							<?php 
								if(!empty($dms_datas)){
									echo $status_array[$dms_datas['doc_status']];
								}else{
									echo 'N.A';
								}
							?>
							</td>
							<td width="10%">
								<?php 
								if(!empty($dms_datas)){
									?>
									<a href="/themes/backend/mydoc/<?php echo $iuid; ?>/<?php echo $dms_datas['document_name']; ?>" target="_blank" class="btn btn-icon-only red print_hide" title="Download Me"><i class="fa fa-download"></i></a>
									<!--<a href="javascript:void(0)" class="btn btn-icon-only red disabled " title="Delete Me"><i class="fa fa-times"></i></a>-->
									<?php
								}
								?>
								
							</td>
							</tr>
								
							<?php 
								}
							}
							?>							
							
							  						
							</tbody></table>
							
							<br><br>
							<h2>Offline statutory form/Other documents</h2>
							<table class="table table-bordered table-scrollable table-lg mt-lg mb-0" width="150%">
		<thead><tr><th>S.No</th><th>Document Type</th><th>Document Name</th><th>View</th></tr></thead>
                            <tbody>
							<?php foreach($res_app_docs as $key=>$res_app_docsArr){ ?>
								
							<tr><td>2.<?php echo $key; ?></td>
							<td><?php echo $res_app_docsArr['type_of_document']=='S'?'Statutory Form':'Other Documents'; ?></td>
							<td><?php echo $res_app_docsArr['document_name']; ?></td>
							<th><a class="print_hide" target="_blank" href="/themes/backend/mydoc/<?php echo $iuid; ?>/offline/<?php echo $res_app_docsArr['document_file_name']; ?>">View</a></th></tr>
							</tbody>
							<?php } ?>
							</table>
							
							<br><br>
							<h2>Offline payment details</h2>
							<table class="table table-bordered table-scrollable table-lg mt-lg mb-0" width="150%" style="display:;">
		<thead><tr><th>S.No</th><th>Reference No</th><th>Details</th><th>Amount</th><th>Fee Receipt</th></tr></thead>
                            <tbody>
							<?php foreach($res_app_pay as $key=>$res_app_payArr){ ?>
								
							<tr><td>3.<?php echo $key; ?></td>
							<td><?php echo $res_app_payArr['reference_no']; ?></td>
							<td><?php echo $res_app_payArr['payment_details']; ?></td>
							<td><?php echo $res_app_payArr['amount']; ?></td>
							<td><?php 
									if(isset($res_app_payArr['fee_receipt'])){
										echo '<a target="_blank" href="/themes/backend/mydoc/'.$iuid.'/offline/'.$res_app_payArr['fee_receipt'].'">View Receipt</a>';
									}else{ echo 'N.A';}
							?></td></tr>
							</tbody>
							<?php } ?>
							</tbody>

							</table>
	
		
	</div>
	<div class="col-md-12 print_hide" align="center">
	<input type="button" value="Print" class="btn btn-green" onclick="printMe();">
	</div>
	</div>
  
</section>
</form>
<script type="text/javascript">
function goToNextPage(service_id,sub_service_id,caf_id){
	window.location.href='/backoffice/frontuser/ApplyService/StatutoryForm/service_id/'+service_id+'/sub_service_id/'+sub_service_id+'/caf_id/'+caf_id;
}

function printMe(){
	$('.print_hide').hide();
	window.print();
	$('.print_hide').show();
}
</script>
