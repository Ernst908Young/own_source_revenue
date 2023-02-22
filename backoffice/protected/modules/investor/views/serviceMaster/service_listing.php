<?php
// @ CODE Edited by SANTOSH FOR DMS
// Date - 14-10-2017

$base=Yii::app()->theme->baseUrl;
$sql_d = "SELECT * FROM bo_infowizard_issuerby_master WHERE is_issuerby_active='Y' ORDER BY name ASC";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql_d);
$res_d = $command->queryAll();

if(isset($_GET['id']) && $_GET['id']>0){
	$id=$_GET['id'];
	$display="block";
	
	// Get list of all services and sub-services
	/*$sql_s = "SELECT * FROM bo_information_wizard_service_master as sm  
			  INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id
			  WHERE issuerby_id='$id' ORDER BY service_name ASC";*/
        $sql_s="SELECT * FROM bo_information_wizard_service_master as sm  
			  INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id
                         
			  WHERE issuerby_id='$id' ORDER BY service_name ASC";
	$connection=Yii::app()->db; 
	$command=$connection->createCommand($sql_s);
	$res_s = $command->queryAll();
     //  echo '<pre>'; print_r($res_s); die;
	$user_id = $_SESSION['RESPONSE']['user_id'];
	// bo_application_submission
	$sql_caf = "SELECT * FROM bo_application_submission  WHERE user_id='$user_id' AND application_status='A' AND application_id='1' ORDER BY submission_id ASC";
	$connection=Yii::app()->db; 
	$command=$connection->createCommand($sql_caf);
	$res_caf = $command->queryAll();
//echo '<pre>'; print_r($res_caf); die;
}else{
	$id='';
	$display="none";
}
?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?=$base?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->

<div class="row" style="margin:10px 0 10px 0;">
	<label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Select Department:</label>
	<div class="col-lg-4">	
	<select name="issuerby_id" class="form-control" onchange="window.location='/backoffice/frontuser/ServiceMaster/listing/id/'+this.value">
		<option value="">Select Department</option>
		<?php foreach($res_d as $dep_arr){ ?>
		<option value="<?php echo $dep_arr['issuerby_id']; ?>" <?php if($id == $dep_arr['issuerby_id']){echo 'selected';} ?>><?php echo $dep_arr['name']; ?></option>
		<?php } ?>
	</select>
	</div>
	</div>
<section class="panel site-min-height" style="display:<?php echo $display; ?>">
  <header class="panel-heading">
	  Department of Labour :: Service Listing
  </header>
  
  
  <div class="panel-body">
	<div class="table-scrollable">
	<table class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                              <tr>
                                <th style="width:5%">ID</th>
                                <th style="width:40%">Service Name</th>
                                <th style="width:20%">Type Of Service</th>
                                <th style="width:15%">Status Of Service</th>
                                <!-- <th style="width:10%">CAF</th> -->
                                <th style="width:10%">Document Checklist</th>
                                <th style="width:10%">Document Checklist Uploaded</th>
                                <th style="width:10%">Document Checklist Upload</th>
								<th style="width:10%">Statutory Form Uploaded</th>
								<th style="width:10%">Statutory Form Upload</th>
								<th style="width:10%">Fee Structure Uploaded</th>
								<th style="width:10%">Fee Structure Upload</th>
								<th style="width:10%">Standard Operating Procedure (SOP) Uploaded</th>
								<th style="width:10%">Standard Operating Procedure (SOP) Upload</th>
								<th style="width:10%">View Statutory Timelines</th>
                              </tr>
                            </thead>
                            <tbody>
							<?php 
							$caf_dropdown = '<select name="caf_id" class="form-control">
								<option value="">Select Approved CAF</option>';
								foreach($res_caf as $keyc=>$caf_arr){
									$caf_dropdown .= '<option value="1">CAF ID - '.$caf_arr['submission_id'].'</option>';
								}
							$caf_dropdown .= '</select>';
							
							foreach($res_s as $key=>$data_arr){
								$service_id 	= $data_arr['service_id'];
								$sub_service_id = $data_arr['servicetype_additionalsubservice'];
							?>
							<!--<form action="/backoffice/frontuser/ServiceMaster/documentCheckList/" method="POST">-->
							<input type="hidden" name="service_id" value='<?php echo $service_id; ?>' />
                            <input type="hidden" name="sub_service_id" value='<?php echo $sub_service_id; ?>' />
							
							<tr>
							<td><?php echo $service_id.".".$sub_service_id; ?></td>
							<td><?php echo $data_arr['core_service_name']; ?></td>
							<td><?php echo $data_arr['service_type']; ?></td>
							<td>
							<?php
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
								echo $status_text;
							?>
							</td>
							<!--<td>
							<?php if($swcs_flag == 1 || $offline_flag == 1){ echo $caf_dropdown; } ?>
							</td> -->
							<?php
								$mapped_docs = json_decode($data_arr['document_checklist_creation'],true);
								
							?>
							<td>-- <a onclick="openDMSPopup('<?php echo $service_id;?>','<?php echo $sub_service_id;?>')">Docs</a><?php //echo '<pre>'; print_r($mapped_docs); ?></td>
                                                        <td><?php if(!empty($data_arr['document_checklist_upload'])){ ?><a href="<?php echo $data_arr['document_checklist_upload']; ?>">Yes</a><?php }else{ echo "No";} ?></td>
							<td>
							<?php
							if($online_flag == 1){
								//echo '<a target="_blank" href="'.$data_arr['service_url'].'">Apply Now</a>';
							}else if($offline_flag == 1){
								//echo '<a target="_blank" href="#">Apply Now</a>';
							}else if($swcs_flag == 1){
								//echo '<button type="submit" class="btn btn-success">Apply Now</button>';
							}
							?>
                                                        <form action='<?=$this->createUrl("/infowizard/serviceParameters/uploadDocs/serivceID/$service_id/subServiceID/$sub_service_id/uploadFor/document_checklist_upload/docName/documentchecklist/location/services");?>' method="post" enctype="multipart/form-data">
							<input type="file" name="file" > <br>
                                                        <input type="submit" name="submit" class="btn btn-danger" value="Upload New" >    <?php if(!empty($data_arr['document_checklist_upload'])){ ?><a class="btn btn-primary" href="<?php echo $data_arr['document_checklist_upload']; ?>"><i class="fa fa-file"></i></a><?php } ?>
                                                        
							</form>
							</td>
							<td>
                                                             <?php if(!empty($data_arr['statutory_form_upload'])){ ?><a href="<?php echo $data_arr['statutory_form_upload']; ?>">Yes</a><?php }else{ echo "No";} ?>
                                                            </td>
							<td>
                                                            
                                                            
							 <form action='<?=$this->createUrl("/infowizard/serviceParameters/uploadDocs/serivceID/$service_id/subServiceID/$sub_service_id/uploadFor/statutory_form_upload/docName/statutory_form/location/services");?>' method="post" enctype="multipart/form-data">
							<input type="file" name="file" > <br>
							  <input type="submit" name="submit" class="btn btn-danger" value="Upload New" >    <?php if(!empty($data_arr['statutory_form_upload'])){ ?><a class="btn btn-primary" href="<?php echo $data_arr['statutory_form_upload']; ?>"><i class="fa fa-file"></i></a><?php } ?>
                                                       
							</form>
							</td>
							<td><?php 
                                                            $sql_f = "SELECT * FROM bo_information_wizard_service_fee WHERE service_id=$service_id AND servicetype_additionalsubservice='$sub_service_id'";
                                                            $connection=Yii::app()->db; 
                                                            $command=$connection->createCommand($sql_f);
                                                            $res_f = $command->queryAll(); ?>
                                                            
                                                            <?php if(!empty($res_f[0])){ if(!empty($res_f[0]['upload_fee_structure'])){ ?><a href="<?php echo $res_f[0]['upload_fee_structure']; ?>">Yes</a><?php }else{echo "No";} }else{echo "No";} ?></td>
							<td>
                                                            
							<form action='<?=$this->createUrl("/infowizard/serviceParameters/uploadDocs/serivceID/$service_id/subServiceID/$sub_service_id/uploadFor/upload_fee_structure/docName/fee_structure/location/services");?>' method="post" enctype="multipart/form-data">
							<input type="file" name="file" > <br>
                                                          <input type="submit" name="submit" class="btn btn-danger" value="Upload New" >    <?php if(!empty($res_f[0])){ if(!empty($res_f[0]['upload_fee_structure'])){ ?><a class="btn btn-primary" href="<?php echo $res_f[0]['upload_fee_structure']; ?>"><i class="fa fa-file"></i></a><?php } } ?>
                                                       
							</form>
							</td>
							
                                                        <td><?php if(!empty($data_arr['sop'])){ ?><a href="<?php echo $data_arr['sop']; ?>">Yes</a><?php }else{echo "No";} ?></td>
							<td>
							 <form action='<?=$this->createUrl("/infowizard/serviceParameters/uploadDocs/serivceID/$service_id/subServiceID/$sub_service_id/uploadFor/sop/docName/sop/location/services");?>' method="post" enctype="multipart/form-data">
							<input type="file" name="file" > <br>
							  <input type="submit" name="submit" class="btn btn-danger" value="Upload New" >    <?php if(!empty($data_arr['sop'])){ ?><a class="btn btn-primary" href="<?php echo $data_arr['sop']; ?>"><i class="fa fa-file"></i></a><?php } ?>
                                                       
							</form>
							</td>
							
							<!--<td>-- <a>View</a></td>-->
                                                        
							<td><a onclick="openTimelinesPopup('<?php echo $service_id;?>','<?php echo $sub_service_id;?>')">View Timelines</a></td>
							</tr>
							</form>
							<?php } ?>  
							  						
							</tbody></table>
  </div>
  </div>
  
									</section>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="model_div" class="modal abc">
	<div class="modal-header">
	  <button type="button" class="" data-dismiss="modal" aria-hidden="true" style="margin-right:50px; float:right;">Close</button>
		<h4 class="modal-title">Documents CheckList</h4>
	</div>
   
   <div class="model-content" id="model_content" style="margin:10px;">
   Documents list
   </div>
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?=$base?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
<link href="<?=$base?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=$base?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>

<script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/moment.min.js" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/pages/scripts/table-datatables-scroller.min.js" type="text/javascript"></script>

<style type="">
.modal{
	width:900px;
	margin-left:-400px;
}
</style>

<script type="text/javascript">


function openDMSPopup(service_id,sub_service_id){
	// open popup using ajax
	$.ajax({
	type: "POST",
	url: "/backoffice/frontuser/ServiceMaster/getRequiredDocuments/",
	data:{'service_id':service_id,'sub_service_id':sub_service_id},		   
	success:  function(html) {
			$('#model_content').html(html);
			$('#model_div').modal();
		}
	});
	
	
}

function openTimelinesPopup(service_id,sub_service_id){
	//alert('Open popup'); return;
	// open popup using ajax
	$.ajax({
	type: "POST",
	url: "/backoffice/frontuser/ServiceMaster/getTimelines/",
	data:{'service_id':service_id,'sub_service_id':sub_service_id},		   
	success:  function(html) {
			
			$('#model_content').html(html);
			$('#model_div').modal();
		}
	});
	
}
</script>
