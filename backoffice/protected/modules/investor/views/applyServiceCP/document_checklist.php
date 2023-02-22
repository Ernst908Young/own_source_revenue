<?php
// @SANTOSH FOR Offline/Online
// Date - 24-10-2017

@extract($_GET);
//$service_id = $service_id;
//$sub_service_id = $sub_service_id;
//$caf_id = $caf_id;

$status_array = array("U"=>'Unverified',"V"=>'Verified');
$invData = ApplyServiceExt::getInvestorDetails();

$old_service_name ='';
if(isset($swcs_service_id)){
	$sqlSa = "SELECT * FROM bo_sp_all_applications WHERE app_id='$swcs_service_id' ORDER BY app_id ASC LIMIT 1";
	$connection=Yii::app()->db; 
	$command=$connection->createCommand($sqlSa);
	$res_sa = $command->queryRow();
	if(!empty($res_sa)){
		$old_service_name = $res_sa['app_name'];
	}
}


?>
<style>
.mt-element-step .step-thin .mt-step-title a{font-size:14px; font-weight:bold;}
.mt-step-number .bg-white .font-grey{font-size:16px;}
.col-md-2{width:20%;}
a:hover{ color:#000;}
</style>
<div class="portlet-body">
<div class="mt-element-step">
	
	<div class="row step-thin">
	   
		<div class="col-md-2 bg-green  mt-step-col ">
			<div class="mt-step-number bg-white font-grey">1</div>
			<div class="mt-step-title uppercase font-grey-cascade"><a href="" >Documents</a></div>
			<div class="mt-step-content font-grey-cascade"> Listing</div>
		</div>
		<?php
		if(isset($type) && $type=='Offline'){
			$actionUrl = "saveOfflineApplication";
			$btn_txt="Save & Continue";
		?>
		<div class="col-md-2 bg-grey  mt-step-col ">
			<div class="mt-step-number bg-white font-grey">2</div>
			<div class="mt-step-title uppercase font-grey-cascade"><a href="" >Statutory</a></div>
			<div class="mt-step-content font-grey-cascade"> Form</div>
		</div>
		 <div class="col-md-2 bg-grey  mt-step-col ">
			<div class="mt-step-number bg-white font-grey">3</div>
			<div class="mt-step-title uppercase font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('frontuser/offline/feedetail/appID/1/serviceID/9/subserviceID/0')?>" >Payment</a></div>
			<div class="mt-step-content font-grey-cascade"> Form</div>
		</div>
		 <div class="col-md-2 bg-grey  mt-step-col ">
			<div class="mt-step-number bg-white font-grey">4</div>
			<div class="mt-step-title uppercase font-grey-cascade"><a href="" >Application</a></div>
			
			<div class="mt-step-content font-grey-cascade"> Preview</div>
		</div>
		 <div class="col-md-2 bg-grey  mt-step-col ">
			<div class="mt-step-number bg-white font-grey">5</div>
			<div class="mt-step-title uppercase font-grey-cascade">
<a href="<?php echo Yii::app()->createAbsoluteUrl('frontuser/offline/modeofsubmission/appID/1/serviceID/9/subserviceID/0')?>" >Mode of</a></div>
			<div class="mt-step-content font-grey-cascade"> Submission</div>
		</div>
		<?php
		}else{
			$actionUrl = "RedirectToDeprtmentURL";
			$btn_txt="Continue & Apply";
		}
		?>
		 <!--<div class="col-md-2 bg-grey  mt-step-col ">
			<div class="mt-step-number bg-white font-grey">6</div>
			<div class="mt-step-title uppercase font-grey-cascade"><a href="" >Others</a></div>
			<div class="mt-step-content font-grey-cascade"> Form</div>
		</div> -->
		
	</div>
	
   
</div>
</div>
<section class="panel site-min-height">
 
  
    <div class="panel-body">
	<h4 style="font-size:10px !important;">
	<?php echo $old_service_name; ?> :: <b>( <?php echo $new_name; ?> )</b>
	</h4>
	<div class="table">
		<table class="table table-scrollable table-lg mt-lg mb-0" width="100%">
			<tr>
				<td><b>Name</b></td>
				<td><?php echo $invData['first_name']." ".$invData['last_name']; ?></td>
				<td><b>IUID</b></td>
				<td><?php echo $invData['iuid']; ?></td>
			</tr>
			<tr>
				<td><b>Phone number</b></td>
				<td><?php echo $invData['mobile_number']; ?></td>
				<td><b>CAF ID</b></td>
				<td><?php echo $caf_id; ?></td>
			</tr>
			<tr>
				<td><b>Email ID</b></td>
				<td><?php echo $invData['email']; ?></td>
				<td></td>
				<td></td>
			</tr>
		</table>
		<br>
		<table class="table table-bordered table-scrollable table-lg mt-lg mb-0" width="150%">
		<thead><tr><th>S.No</th><th>Document Code</th><th>Document Type</th><th>Issued By</th><th>Document Name</th><th>Is Required</th><th>Comment</th><th>Version</th><th>Status</th><th>Action</th></tr></thead>
                            <tbody>
							<?php
							$disable_btn_text = false;
							$disable_btn_help_text = false;
							$documents_id='';
							$documents_id_name='';
							$appDmsArr=array();
							if(count($mapped_documents_array)>0){
								foreach($mapped_documents_array as $key=>$mapped_documents_array_data){
									$doc_datas = ApplyServiceExt::getDocumentsDataByID($mapped_documents_array_data['doc_id']);
									$dms_datas = ApplyServiceExt::getUploadedDocumentsDataByID($mapped_documents_array_data['doc_id']);
							?>
							<tr>
							<td><?php echo $key+1; ?></td>
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
									//echo '<!-- <pre>'; print_r($dms_datas); echo ' </pre> -->';
									$appDmsArr[] = $doc_datas['chklist_id']."~".$dms_datas['document_name'];
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
									<a href="/themes/backend/mydoc/<?php echo $iuid; ?>/<?php echo $dms_datas['document_name']; ?>" target="_blank" class="btn btn-icon-only red" title="Download Me"><i class="fa fa-download"></i></a>
									<!--<a href="javascript:void(0)" class="btn btn-icon-only red disabled " title="Delete Me"><i class="fa fa-times"></i></a>-->
									<?php
								}else{
									?>
									<form name="dms_form" action="" method="POST" enctype="multipart/form-data">
									 <input type="hidden" name="FileUpload[doc_id]" value="<?php echo $doc_datas['doc_id']; ?>">
									 <input type="hidden" name="FileUpload[issuer_id]" value="<?php echo $doc_datas['issuer_id']; ?>">
									 <input type="hidden" name="FileUpload[issued_by]" value="<?php echo $doc_datas['issuerby_id']; ?>">
									 <input type="hidden" name="FileUpload[doc_code]" value="<?php echo $doc_datas['docchk_id']; ?>">
									 <input type="hidden" name="FileUpload[mydoc_status]" value="active">
									 <input type="hidden" name="FileUpload[doc_version_type]" value="V">
									 
									 <input type="file" style="width:30px;display:none;" required="required" name="dms_doc_uploads" class="inputfile inputfile-1" id="doc_uploads-<?php echo $key; ?>">
				  <label for="doc_uploads-<?php echo $key; ?>" style="margin-right:10px;">
					<i class="fa fa-upload btn btn-primary"></i> <span>Choose a file</span>
				  </label>
             <b id="up_b" style="margin-right:10px;"></b>
			 <input type="submit" value="Submit" class="btn btn-primary yellow">
									</form>
									
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
	
	</div>
	<form action="/backoffice/frontuser/ApplyService/<?php echo $actionUrl; ?>" method="POST">
	<input type="hidden" name="service_id" value='<?php echo $service_id; ?>' />
	<input type="hidden" name="sub_service_id" value='<?php echo $sub_service_id; ?>' />
	<input type="hidden" name="caf_id" value='<?php echo $caf_id; ?>' />
	<input type="hidden" name="documents_id" value='<?php echo trim($documents_id,","); ?>' />
	<input type="hidden" name="documents_id_name" value='<?php echo trim($documents_id_name,","); ?>' />
	<input type="hidden" name="department_id" value='<?php echo $department_id; ?>' />
	<input type="hidden" name="swcs_department_id" value='<?php echo $swcs_department_id; ?>' />
    <input type="hidden" name="swcs_service_id" value='<?php echo $swcs_service_id; ?>' />
    <?php if(count($appDmsArr)>0){ ?>
	<input type="hidden" name="dms_string" value='<?php echo implode("::",$appDmsArr) ?>' />
	<?php }else{ ?>
	<input type="hidden" name="dms_string" value='' />
	<?php } ?>
	
	<div class="row buttons" align="center">
	<br><br>
	<?php echo '<strong style="color:red;">'.$disable_btn_help_text.'</strong>'; ?>
	<br><br>
	<?php if($disable_btn_help_text == false){ ?>
	<input <?php echo $disable_btn_text; ?> type="submit" value="<?php echo $btn_txt; ?>" class="btn btn-primary">
	<?php } ?>
	</div>
	
	
	</div>
	</form>
  
</section>
<script type="text/javascript">
function goToNextPage(service_id,sub_service_id,caf_id){
	window.location.href='/backoffice/frontuser/ApplyService/StatutoryForm/service_id/'+service_id+'/sub_service_id/'+sub_service_id+'/caf_id/'+caf_id;
}
</script>
