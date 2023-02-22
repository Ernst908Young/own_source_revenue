<?php
// @SANTOSH FOR Offline/Online
// Date - 24-10-2017

//echo '<pre>'; print_r($res_s); die;
$pre_service_id_arr = false;$serviceDocArr=array();
if($res_s){
	//echo '<pre>'; print_r($res_s);
	$pre_service_id = $res_s[0]['pre_service_id'];
	$pre_service_id_arr = json_decode($pre_service_id,true);
	
}
/*if(!isset($_GET['department_id'])){
	$department_id = $_GET['department_id'];
}else{
	$department_id=NULL;
}*/

// echo '<!-- <pre>'; print_r($res_d); echo ' -->';
?>
<style>
a:hover{ color:#000;}
.mdl{vertical-align:middle !important;}
.cent{text-align:center !important;}
.left{text-align:left !important;}
</style>

<?php //print_r($_GET);die;
//$docShouldBe="0";
$mapped_documents_array=array();
if(!empty($_GET['final_service_id'])){
$getpreRequesties="select pre_service_id from bo_information_wizard_pre_service_mapping where service_id=".$_GET['final_service_id'];
$preReques=Yii::app()->db->createCommand($getpreRequesties)->queryRow();
//print_r($preReques);die;

if(!empty($preReques)){
    $allServiceRequiredBeforApply = json_decode($preReques['pre_service_id']);
    foreach($allServiceRequiredBeforApply as $particularService){
        $SerID[]=$particularService->mapped_service_id;  
        $getpreRequestiesCertificateDocument="select doc_checklist_id from bo_information_wizard_service_certificate_maping where final_service_id=".$particularService->mapped_service_id;
        $preRequesCertificateDocument=Yii::app()->db->createCommand($getpreRequestiesCertificateDocument)->queryRow();
        //print_r($preRequesCertificateDocument);
       //$docShouldBe.=",".$preRequesCertificateDocument['doc_checklist_id'];
        $serviceCertificate[$particularService->mapped_service_id]=$preRequesCertificateDocument['doc_checklist_id'];
        $mapped_documents_array[]['doc_id']=$preRequesCertificateDocument['doc_checklist_id'];
    }
}
}
//print_r($docShouldBe);die;
?>

<!-- Already Applied Service's Certificate Upload -  
     Rahul Kumar @ 01032018
-->
<!--<div id="document Upload" class="modal fade" role="dialog">-->
<div id="myModal" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="width: 150%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">NOC Certificate Upload</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-scrollable table-lg mt-lg mb-0" width="150%">
		<thead><tr><th>S.No</th><th>Document Code</th><th>Document Type</th><th>Issued By</th><th>Document Name</th><th>Is Required</th><th>Comment</th><th>Version</th><th>Status</th><th>Action</th></tr></thead>
                            <tbody>
							<?php
							$disable_btn_text = false;
							$disable_btn_help_text = false;
							$documents_id='';
							$documents_id_name='';
							$appDmsArr=array();
                                                        
                                                        
                                                        //$mapped_documents_array[]['doc_id']="132"; 
                                                       // $mapped_documents_array[]['doc_id']="129"; 
							if(count($mapped_documents_array)>0){
								foreach($mapped_documents_array as $key=>$mapped_documents_array_data){
									$doc_datas = ApplyServiceExt::getDocumentsDataByID($mapped_documents_array_data['doc_id']);
									$dms_datas = ApplyServiceExt::getUploadedDocumentsDataByID($mapped_documents_array_data['doc_id']);
                                                                        $mapped_documents_array_data['is_required']="Y";
                                                                        $mapped_documents_array_data['doc_comment']="NA";
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
                                                                        $serviceDocArr[]=$mapped_documents_array_data['doc_id'];
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
									//echo $status_array[$dms_datas['doc_status']];
								}else{
									echo 'N.A';
								}
							?>
							</td>
							<td width="10%">
								<?php 
								if(!empty($dms_datas)){
									?>
									<!--<a href="/themes/backend/mydoc/<?php //echo $iuid; ?>/<?php echo $dms_datas['document_name']; ?>" target="_blank" class="btn btn-icon-only red" title="Download Me"><i class="fa fa-download"></i></a>-->
									<!--<a href="javascript:void(0)" class="btn btn-icon-only red disabled " title="Delete Me"><i class="fa fa-times"></i></a>-->
									<?php
								}else{
									?>
									<form name="dms_form" id="formdocnoc" action="/backoffice/dms/DocumentManagement" method="POST" enctype="multipart/form-data">
                                                                            <input name="FileUpload[YII_CSRF_TOKEN]" type="hidden" value="5bba089b9a6aee506ef01d327abe350620d66660">
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
			 <input type="button" value="Submit" class="btn btn-primary yellow" id="SubmitNocDocument" rel="formdocnoc<?php echo $key; ?>">
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
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div class="row" style="margin:10px 0 10px 0;">
<form action="/backoffice/frontuser/ApplyServiceCP/ServiceListing" method="GET">
<div class="col-sm-4">	
<select name="department_id" class="form-control" required onchange="getServiceByDepartment(this.value)">
	<option value="">Select Department</option>
	<?php if($res_dep)foreach($res_dep as $dep_arr){ 
		
	?>
	<option value="<?php echo $dep_arr['issuerby_id']; ?>" <?php if($department_id == $dep_arr['issuerby_id']){echo 'selected';} ?>>
	<?php echo $dep_arr['name']; ?>
	</option>
	<?php } ?>
</select>
</div>

<div class="col-sm-4">	
<select name="final_service_id" class="form-control" required>
	<option value="">Select Service</option>
	<?php if($res_d)foreach($res_d as $dep_arr){ 
		$service_id 	= $dep_arr['service_id'];
		$sub_service_id = $dep_arr['servicetype_additionalsubservice'];
		$final_id = $service_id.".".$sub_service_id;
	?>
	<option value="<?php echo $final_id; ?>" <?php if($id == $final_id){echo 'selected';} ?>>
	<?php echo $final_id; ?> - 
	<?php echo $dep_arr['core_service_name']; ?>
	</option>
	<?php } ?>
</select>
</div>
<div class="col-sm-3">
<select name="caf_id" class="form-control" required>
	<option value="">Select Approved CAF</option>
	<?php if($res_caf)foreach($res_caf as $keyc=>$caf_arr){ ?>
		<option value="<?php echo $caf_arr['submission_id'];?>" <?php if($caf_id == $caf_arr['submission_id']){echo 'selected';} ?>>CAF ID - <?php echo $caf_arr['submission_id'];?></option>
	<?php } ?>
                <option value="NULL" <?php if($caf_id == "NULL"){echo 'selected';} ?>>Existing Unit</option>
</select>
</div>
<div class="col-sm-1">
   <input type="submit" value="Submit" class="btn btn-primary">
</div>
</form>
</div>

<?php if(isset($_GET['final_service_id'])){ echo '<div class="row" style="margin:10px 0 10px 0;">';
    list($final_service_id,$final_sub_service_id) = explode(".",$_GET['final_service_id']);
	$fee_arr = getFeeServiceDatasFromInfowiz($final_service_id,$final_sub_service_id);
	if(isset($fee_arr['upload_fee_structure']) && $fee_arr['upload_fee_structure']!=''){
	?>
	<a href="<?php echo $fee_arr['upload_fee_structure']; ?>" target="_blank">Click here to view fee</a>
	<?php }else{ ?>
	<?php } echo '</div>';} ?>

<section class="panel site-min-height" style="display:">
  <header class="panel-heading">
	  Sectorial SWCS Services
  </header>
  
    <div class="panel-body">
	<div class="table">
	<table class="table table-bordered" width="100%">
       <thead>
		  <tr>
			<th class="mdl cent" style="width:5%">ID</th>
			<th class="mdl left" style="width:25%;">Department</th>
			<th class="mdl left" style="width:25%">Service Name</th>
			<th class="mdl cent" style="width:10%;">Is Mandatory</th>
			<th class="mdl cent" style="width:10%;">CAF ID</th>
			<th class="mdl cent" style="width:10%;">Applied Status</th>
			<th class="mdl cent" style="width:5%;">Fee</th>
			<th class="mdl cent" style="width:10%">Action</th>
		  </tr>
		</thead>
		<tbody>
			<?php 
							
					$disabled_btn=false;		
							if($pre_service_id_arr){foreach($pre_service_id_arr as $key=>$data_arr_new){
								list($service_id,$sub_service_id) = explode(".",$data_arr_new['mapped_service_id']);
								$data_arr = getServiceDatasFromInfowizWithDepartment($service_id,$sub_service_id);
								$service_id 	= $data_arr['service_id'];
								$sub_service_id = $data_arr['servicetype_additionalsubservice'];
								if($data_arr['is_integrated_with_swcs'] == 'Y'){
									$swcs_department_id = $data_arr['department_id'];
									$swcs_service_id = $data_arr['swcs_service_id'];
								}else{
									$swcs_department_id = false;
									$swcs_service_id = false;
								}
								if($data_arr['core_service_name']!=''){
							?>
							<form action="/backoffice/frontuser/ApplyService/DocumentsChecklist/" method="GET" target="_blank">
							<input type="hidden" name="service_id" value='<?php echo $service_id; ?>' />
                                            <input type="hidden" name="sub_service_id" value='<?php echo $sub_service_id; ?>' />
                                            <input type="hidden" name="department_id" value='<?php echo $id; ?>' />
                                            <input type="hidden" name="swcs_department_id" value='<?php echo $swcs_department_id; ?>' />
                                            <input type="hidden" name="swcs_service_id" value='<?php echo $swcs_service_id; ?>' />
                                            <input type="hidden" name="new_name" value='<?php echo $data_arr['core_service_name']; ?>' />
                                            <input type="hidden" name="caf_id" value='<?php echo $caf_id; ?>' />
							
							<tr>
							<td class="mdl cent"><?php echo $completeServiceID=$service_id.".".$sub_service_id; ?></td>
							<td class="mdl left"><?php echo $data_arr['department_name']; ?></td>
							<td class="mdl left"><?php echo $data_arr['core_service_name']; ?></td>
							<td class="mdl cent"><?php echo $data_arr_new['is_required']; ?></td>
							<td class="mdl cent">
							<?php   $abletoapply=1;
								$offline_flag	=0;
								$online_flag	=0;
								$swcs_flag		=0;
								
								$is_online 					= $data_arr['is_online'];
								$is_integrated_with_swcs 	= $data_arr['is_integrated_with_swcs'];
								if($is_online=='N'){
									$status_text = "Offline";
									$offline_flag	=1;
									$online_flag	=0;
									$swcs_flag		=0;
								}else if($is_online == 'Y' && $is_integrated_with_swcs=='Y'){
									$status_text = "Integrated With SWCS";
									$offline_flag	=0;
									$online_flag	=0;
									$swcs_flag		=1;
								}else if($is_online=='Y' && $is_integrated_with_swcs == 'N'){
									$status_text = "Online";
									$offline_flag	=0;
									$online_flag	=1;
									$swcs_flag		=0;
								}
								// echo $status_text;
								echo $caf_id;
							?>
							</td>
							<td class="mdl cent">
							<?php 
									$required_text ='';
									$blank ='';
									if($offline_flag == 1){
										$required_text = 'required';
									}
									$caf_dropdown = '<select name="caf_id" class="form-control" '.$required_text.'>
										<option value="'.$blank.'">Select Approved CAF-</option>';
										if($res_caf)foreach($res_caf as $keyc=>$caf_arr){
											$caf_dropdown .= '<option value="'.$caf_arr['submission_id'].'">CAF ID - '.$caf_arr['submission_id'].'</option>';
										}
                                                                            
									$caf_dropdown .= '</select>';
									
									//if($swcs_flag == 1 || $offline_flag == 1){ echo $caf_dropdown; } 
									$applied_services_flag = getAppliedServiceStatus($user_id,$swcs_service_id,$caf_id);
									if($applied_services_flag == false){
										echo 'Not Applied Yet';
									}else{
										echo 'Applied';
										$swcs_flag=0;
									}
									
									if($data_arr_new['is_required'] == 'Y' && $applied_services_flag == false){
										$disabled_btn=true;
									}
							?>
							</td>
							<td class="mdl cent">
							<?php 
							$fee_arr = getFeeServiceDatasFromInfowiz($service_id,$sub_service_id);
							if(isset($fee_arr['upload_fee_structure']) && $fee_arr['upload_fee_structure']!=''){
							?>
							<a href="<?php echo $fee_arr['upload_fee_structure']; ?>" target="_blank">YES</a>
							<?php }else{ ?>
							N.A
							<?php } ?>
							</td>
							<?php
								$mapped_docs = json_decode($data_arr['document_checklist_creation'],true);
								
							?>
							<!-- <td> <a onclick="openDMSPopup('<?php echo $service_id;?>','<?php echo $sub_service_id;?>')">View</a><?php //echo '<pre>'; print_r($mapped_docs); ?></td> -->
							<td class="mdl cent">
							<?php
							if($online_flag == 1){
								//echo '<a target="_blank" href="'.$data_arr['service_url'].'">Apply Now</a>';
							}else if($offline_flag == 1){
								//echo '<button type="submit" class="btn btn-success">Apply Now</button>';
							}else if($swcs_flag == 1){
								//echo "N.A";
                                                            // Added : Rahul Kumar 01032018
                                                           // echo $serviceCertificate[$completeServiceID];print_r($serviceDocArr);
                                                               if(!in_array($serviceCertificate[$completeServiceID],$serviceDocArr)) { 
                                                                   if($abletoapply==1){$abletoapply=0;}
								echo '<button type="submit" class="btn btn-success notapplied">Apply Now >></button>';
                                                               }
							}
							?>
                                                            <!-- // Added : Rahul Kumar 01032018 -->
                                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" style="margin-top:10px;">Do you already have  NOC ?</button>
							
							</td>
							
							
							</tr>
							<input type="hidden" name="type" value='<?php echo $status_text; ?>' />
							</form>
							<?php }} 
								
								if(isset($_GET['final_service_id'])){
									list($final_service_id,$final_sub_service_id) = explode(".",$_GET['final_service_id']);
									$final_data_arr = getServiceDatasFromInfowiz($final_service_id,$final_sub_service_id);
									if($final_data_arr['is_integrated_with_swcs'] == 'Y'){
										$final_swcs_department_id = $final_data_arr['department_id'];
										$final_swcs_service_id = $final_data_arr['swcs_service_id'];
									}else{
										$final_swcs_department_id = false;
										$final_swcs_service_id = false;
									}
							?>
							<form action="/backoffice/frontuser/ApplyService/DocumentsChecklist/" method="GET" target="_blank">
							<input type="hidden" name="service_id" value='<?php echo $final_service_id; ?>' />
                            <input type="hidden" name="sub_service_id" value='<?php echo $final_sub_service_id; ?>' />
                            <input type="hidden" name="department_id" value='<?php echo $final_service_id; ?>' />
                            <input type="hidden" name="swcs_department_id" value='<?php echo $final_swcs_department_id; ?>' />
                            <input type="hidden" name="swcs_service_id" value='<?php echo $final_swcs_service_id; ?>' />
                            <input type="hidden" name="new_name" value='<?php echo $final_data_arr['core_service_name']; ?>' />
                            <input type="hidden" name="caf_id" value='<?php echo $caf_id; ?>' />
							<tr><td colspan="8" align="center">
							<?php if($disabled_btn == false && $caf_id>0 && $abletoapply==1){ 
                                                            
                                                         ?>
							<button type="submit" class="btn btn-success">Apply Now</button>
							<?php }else{ ?>
								<p style="color:red; font-size:16px; font-weight:bold;">
									You have not applied for all prerequisite services. Please apply for services as indicated in the above table.
								</p>
							<?php } ?>
							</td>
							</form>
							<?php }} ?>
		</tbody>
	</table>
</section>
<script type="text/javascript">
function goToNextPage(service_id,sub_service_id,caf_id){
	window.location.href='/backoffice/frontuser/ApplyService/DocumentsChecklist/service_id/'+service_id+'/sub_service_id/'+sub_service_id+'/caf_id/'+caf_id;
}

function getServiceByDepartment(id){
	$.ajax({
		type: "POST",
		url: "/backoffice/frontuser/ApplyServiceCP/GetServiceListingAjax/id/"+id,
		success:  function(data) { 
		   $('#final_service_id').html(data);
		},
		error:function(jqXHR, textStatus, errorThrown){
			alert('Error::'+errorThrown);
		}
	});
}
</script>
<?php
function getServiceDatasFromInfowiz($service_id,$sub_service_id){
	$sql_s="SELECT * FROM bo_information_wizard_service_parameters as sp  
	WHERE sp.service_id='$service_id' AND sp.servicetype_additionalsubservice='$sub_service_id'  ORDER BY sp.id DESC LIMIT 1";
	$connection=Yii::app()->db; 
	$command=$connection->createCommand($sql_s);
	$res_s = $command->queryRow();
	return $res_s;
}

function getServiceDatasFromInfowizWithDepartment($service_id,$sub_service_id){
	/*$sql_s="SELECT * FROM bo_information_wizard_service_parameters as sp  
	WHERE sp.service_id='$service_id' AND sp.servicetype_additionalsubservice='$sub_service_id'  ORDER BY sp.id DESC LIMIT 1";*/
	$sql_s = "SELECT sp.*,m.name as department_name FROM bo_information_wizard_service_parameters as sp
				INNER JOIN bo_information_wizard_service_master as sm ON sm.id=sp.service_id
				INNER JOIN bo_infowizard_issuerby_master as m ON sm.issuerby_id=m.issuerby_id WHERE sp.service_id='$service_id' AND sp.servicetype_additionalsubservice='$sub_service_id' ORDER BY sp.id DESC LIMIT 1";
	$connection=Yii::app()->db; 
	$command=$connection->createCommand($sql_s);
	$res_s = $command->queryRow();
	return $res_s;
}

function getFeeServiceDatasFromInfowiz($service_id,$sub_service_id){
	$sql_s="SELECT * FROM bo_information_wizard_service_fee as f  
	WHERE f.service_id='$service_id' AND f.servicetype_additionalsubservice='$sub_service_id'  ORDER BY f.id DESC LIMIT 1";
	$connection=Yii::app()->db; 
	$command=$connection->createCommand($sql_s);
	$res_s = $command->queryRow();
	if(count($res_s)>0)
		return $res_s;
	return false;
}

function getAppliedServiceStatus($user_id,$swcs_service_id,$caf_id){
	$sql_s="SELECT * FROM bo_sp_applications WHERE sp_app_id='$swcs_service_id' AND caf_id='$caf_id' AND user_id='$user_id' AND app_status !='I' ORDER BY sno ASC";
	$connection=Yii::app()->db; 
	$command=$connection->createCommand($sql_s);
	$res_s = $command->queryAll();
	if(count($res_s)>0)
		return $res_s;
	return false;
}
?>


<script>
    $(document).ready(function(){
        $("#SubmitNocDocument").click(function(){        
        var formData = new FormData($('form')[0]);
        $.ajax({
				type: "POST",
				async: false,
				cache: false,
				contentType: false,
				processData: false,
				url: "/backoffice/dms/DocumentManagement",
				data:formData,
			   success:  function(data) { 
                              if(data=='success'){
						window.location.reload();
				   }else{
					$('#error_div1').show();
					$('#error_div1').focus();
					$('#label_text').html(data);
				    }
				},
			error:function(jqXHR, textStatus, errorThrown){
				alert('Error::'+errorThrown);
			}
	   }); 
	   }); 
       
    });
    $(window).load(function()){
        
        $('.notapplied').each(function(e)){
            alert(e);
        }); 
    });
    
    
    </script>