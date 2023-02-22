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
.cent{text-align:center !important;}
.vln{vertical-align:middle !important;}
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
				<td><?php echo @$caf_id; ?></td>
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
		<thead><tr>
		<th class="cent vln">S.No</th>
		<th class="cent vln">Document Code</th>
		<th class="vln">Document Type</th>
		<th class="vln">Is Document Type Required</th>
		<th class="vln">Issued By</th>
		<th class="vln">Document Name</th>
		<th class="vln">Is Document Required</th>
		<th class="vln">Comment</th>
		<th class="cent vln">Version</th>
		<th class="cent vln">Status</th>
		<th class="cent vln">Action</th>
		</tr>
		</thead>
                            <tbody>
							<?php
							$disable_btn_text = false;
							$disable_btn_help_text = false;
							$documents_id='';
							$documents_id_name='';
							$new_mapped_doc_type_arr=array();
							
							if(count($document_type_mapping_array)>0){
								foreach($document_type_mapping_array as $key=>$document_type_mapping_array_data){
									$new_mapped_doc_type_arr[$document_type_mapping_array_data['doc_id']] = $document_type_mapping_array_data['is_required'];
								}
							}
							if(count($mapped_documents_array)>0){
								foreach($mapped_documents_array as $key=>$mapped_documents_array_data){
									$new_mapped_doc_arr[$mapped_documents_array_data['doc_id']] = $mapped_documents_array_data['is_required'];
									$doc_datas = ApplyServiceExt::getDocumentsDataByID($mapped_documents_array_data['doc_id']);
									if(!isset($new_mapped_doc_type_arr[$doc_datas['doc_id']])){
										$new_mapped_doc_type_arr[$doc_datas['doc_id']]='NA';
									}
									$new_mapped_doc_type_with_doc_arr[$doc_datas['doc_id']][$doc_datas['docchk_id']] = $mapped_documents_array_data['is_required'];
								}
							}
							//echo '<pre>doc_type'; print_r($new_mapped_doc_type_arr); 
							//echo '<pre>doc'; print_r($new_mapped_doc_arr); 
							//echo '<pre>4'; print_r($new_mapped_doc_type_with_doc_arr); 
							//die;
							
							if(count($mapped_documents_array)>0){
								foreach($mapped_documents_array as $key=>$mapped_documents_array_data){
									$doc_datas = ApplyServiceExt::getDocumentsDataByID($mapped_documents_array_data['doc_id']);
									$dms_datas = ApplyServiceExt::getUploadedDocumentsDataByID($mapped_documents_array_data['doc_id']);
									$doc_ids = getMainDocumentType($mapped_documents_array_data['doc_id'],$new_mapped_doc_type_arr);
							?>
							<tr>
							<td class="cent vln"><?php echo $key+1; ?></td>
							<td class="cent vln"><?php echo $doc_datas['chklist_id']; ?></td>
							<td class="vln">
							<?php if($doc_ids){echo getMainDocumentTypeName($doc_ids);} ?>
							</td>
							<td class="cent vln">
							<?php if($doc_ids){ if($new_mapped_doc_type_arr[$doc_ids]!='NA'){echo $new_mapped_doc_type_arr[$doc_ids];}} ?>
							</td>
							<td class="vln"><?php echo $doc_datas['issuerby_name']; ?></td>
							<td class="vln"><?php echo $doc_datas['document_name']; ?></td>
							<td class="cent vln"><?php echo $mapped_documents_array_data['is_required']; ?></td>
							<td class="vln"><?php echo $mapped_documents_array_data['doc_comment']; ?></td>
							<td class="cent vln" width="10%">
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
										$disable_btn_help_text="Please upload mandatory document(s) as well as non-mandatory document(s) which might be required for the application processing as per your specific criteria. You can only continue once you have at least uploaded mandatory document(s).";
									}else if($mapped_documents_array_data['is_required'] == 'N' && $new_mapped_doc_type_arr[$doc_datas['doc_id']]=='Y'){
										$r_flag = validateAllUploaded($doc_datas['doc_id'],$new_mapped_doc_type_with_doc_arr[$doc_datas['doc_id']]);
										if($r_flag == false){
											$disable_btn_text="disabled";
											$disable_btn_help_text="Please upload mandatory document(s) as well as non-mandatory document(s) which might be required for the application processing as per your specific criteria. You can only continue once you have at least uploaded mandatory document(s).";
										}
									}
								}
							?>
							</td>
							<td class="cent vln" width="10%">
							<?php 
								if(!empty($dms_datas)){
									echo $status_array[$dms_datas['doc_status']];
								}else{
									echo 'N.A';
								}
							?>
							</td>
							<td class="cent vln" width="10%">
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
	<input type="hidden" name="caf_id" value='<?php echo @$caf_id; ?>' />
	<input type="hidden" name="documents_id" value='<?php echo trim($documents_id,","); ?>' />
	<input type="hidden" name="documents_id_name" value='<?php echo trim($documents_id_name,","); ?>' />
	<input type="hidden" name="department_id" value='<?php echo $department_id; ?>' />
	<input type="hidden" name="swcs_department_id" value='<?php echo $swcs_department_id; ?>' />
    <input type="hidden" name="swcs_service_id" value='<?php echo $swcs_service_id; ?>' />
							
	
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


<?php
function validateAllUploaded($doc_type_id,$mapped_doc_with_type){
	// echo count(array_unique($mapped_doc_with_type)); return;
	$return_flag=true;
	if(count(array_unique($mapped_doc_with_type)) == 1){
		$return_flag=false;
		foreach($mapped_doc_with_type as $key=>$val){
			$dms_datas = ApplyServiceExt::getUploadedDocumentsDataByID($key);
			if(!empty($dms_datas)){
				$return_flag=true;
			}
		}
	}
	return $return_flag;
}

function getMainDocumentType($doc_id,$doc_type_arr){
	$doc_idss=false;
	
	if(count($doc_type_arr)>0){
		foreach($doc_type_arr as $doc_type_id=>$mand){
			if($mand!='NA')
				$new_mapped_doc_type_arr[$doc_type_id]=$mand;
		}
	}
	$sqlSa = "SELECT * FROM bo_infowizard_documentchklist WHERE docchk_id='$doc_id' AND is_docchklist_active='Y' ORDER BY doc_id DESC LIMIT 1";
	$connection=Yii::app()->db; 
	$command=$connection->createCommand($sqlSa);
	$res_sa = $command->queryRow();
	if(!empty($res_sa)){
		$doc_ids = $res_sa['doc_id'];
		$doc_ids_arr = explode(",",$doc_ids);
		if(count($doc_ids_arr)>0){
			foreach($doc_ids_arr as $key=>$val){
				if(isset($new_mapped_doc_type_arr[$val])){
					// $doc_type_name[$val] = getMainDocumentTypeName($val);
					return $val;
				}
			}
		}
	}
	return $doc_idss;
}

function getMainDocumentTypeName($doc_id){
	$doc_type_name = false;
	$sqlSa = "SELECT * FROM bo_infowizard_docunenttype_master WHERE doc_id='$doc_id' AND is_doc_active='Y' ORDER BY doc_id DESC LIMIT 1";
	$connection=Yii::app()->db; 
	$command=$connection->createCommand($sqlSa);
	$res_sa = $command->queryRow();
	if(!empty($res_sa)){
		$doc_type_name = $res_sa['name'];
	}
	return $doc_type_name;
}
?>