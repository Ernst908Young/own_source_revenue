<?php
// @SANTOSH FOR Offline/Online
// Date - 24-10-2017
// 
//@Edited By Rahul Kumar
//Date - 04052018
// Description of Change : New Mapping with sub_service_id 
//echo '<pre>'; print_r($res_s); die;
?>
<style>
a:hover{ color:#000;}
.dt-buttons {
    margin-top: -52px !important;
}
</style>

 <?php //$cls="Incentive";include('/var/www/html/backoffice/themes/swcsNewTheme/views/layouts/pageBarService.php');?>
 
 <div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i><?=@$service?> - List of Services</div>
    <div class='tools'> </div>
</div>
 <div class="portlet-body">
 
 
<div class="row" style="margin:10px 0 10px 0;">
<label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Select Department:</label>
<div class="col-lg-4">	
<select name="issuerby_id" class="form-control" onchange="window.location='/backoffice/frontuser/ApplyService/ServiceListingNew/id/'+this.value">
	<option value="">Select Department</option>
	<?php if($res_d)foreach($res_d as $dep_arr){ ?>
	<option value="<?php echo $dep_arr['issuerby_id']; ?>" <?php if($id == $dep_arr['issuerby_id']){echo 'selected';} ?>><?php echo $dep_arr['name']; ?></option>
	<?php } ?>
</select>


</div>

</div>

<?php 
if($id == 58){
?>
<div class="row" style="margin:10px 0 10px 0;">
<div class="col-lg-12">
<strong>
Investors intend to avail "Application for Building Plan Approval/ Consent to Establish" services needs to apply through "Apply for Sectorial Clearances (Beta)". To apply "Application for Building Plan Approval/ Consent to Establish" service now, please <a target="_blank" href="/backoffice/frontuser/applyServiceCP/ServiceListing">click here</a></strong>
</div>
</div>
<?php 
}
?>


<section class="panel site-min-height" style="display:">
  <header class="panel-heading">
	  Department Services
  </header>
  
    <div class="panel-body">
	<div class="table">
	<table class="table table-bordered" width="100%">
       <thead>
		  <tr>
			<th style="width:5%">ID</th>
			<th style="width:30%">Service Name</th>
			<th style="width:10%">Service Incidence</th>
			<th style="width:20%">Type Of Service</th>
			<th style="width:15%">Status Of Service</th>
			<th style="width:10%">CAF</th>
			<!-- <th style="width:10%">Document Checklist</th> -->
			<th style="width:10%">Action</th>
		  </tr>
		</thead>
		<tbody>
			<?php 
							
							
							if($res_s)foreach($res_s as $key=>$data_arr){
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
							<?php 
							
							//if((($type == 'PES') && $data_arr['incidence_pre_establishment']==1) || (($type == 'POS') && $data_arr['incidence_pre_operation']==1) || (($type == 'PO') && $data_arr['incidence_post_operation']==1) || $type ='')
							//{
								?>
							<form action="/backoffice/frontuser/ApplyService/DocumentsChecklist/" method="GET" target="_blank">
							<input type="hidden" name="service_id" value='<?php echo $service_id; ?>' />
                            <input type="hidden" name="sub_service_id" value='<?php echo $sub_service_id; ?>' />
							
                            <input type="hidden" name="department_id" value='<?php echo $id; ?>' />
                            <input type="hidden" name="swcs_department_id" value='<?php echo $swcs_department_id; ?>' />
                            <input type="hidden" name="swcs_service_id" value='<?php echo $swcs_service_id; ?>' />
							<input type="hidden" name="new_name" value='<?php echo $data_arr['core_service_name']; ?>' />
							
							<tr>
							<td><?php echo $service_id.".".$sub_service_id; ?></td>
							<td><?php echo $data_arr['core_service_name']; ?></td>
							<td><?php 		if($data_arr['incidence_pre_establishment']==1){ 
                                               echo "Pre Establishment Service";
											}elseif($data_arr['incidence_pre_operation']==1){
												echo "Pre Operations Service";
											}elseif($data_arr['incidence_post_operation']==1){
												echo "Post Operation Service";
											}
											?></td>
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
							<td>
							<?php 
									$required_text ='';
									$blank ='';
									if(($offline_flag == 1 || $swcs_flag==1 )){
										$required_text = 'required';
									}
									$caf_dropdown = '<select name="caf_id" class="form-control" '.$required_text.'>
										<option value="'.$blank.'">Select Approved CAF</option>';
										if($res_caf)foreach($res_caf as $keyc=>$caf_arr){
											//$caf_dropdown .= '<option value="'.$caf_arr['submission_id'].'">CAF ID - '.$caf_arr['submission_id'].'</option>';
											if($caf_arr['application_id'] == 1){
											$caf_dropdown .= '<option value="'.$caf_arr['submission_id'].'">CAF ID - '.$caf_arr['submission_id'].'</option>';
											}else if($caf_arr['application_id'] == 11){
											$caf_dropdown .= '<option value="'.$caf_arr['submission_id'].'">EU - '.$caf_arr['submission_id'].'</option>';
											}
										}
										if($swcs_flag==1 && $id!=18 && $id!=22){
											$caf_dropdown .= '<option value="NULL">Existing Unit</option>';
										}
									$caf_dropdown .= '</select>';
									
									if($id!=1 && ($offline_flag == 1 || $swcs_flag==1 )){ echo $caf_dropdown; } 
							?>
							</td>
							<?php
								$mapped_docs = json_decode($data_arr['document_checklist_creation'],true);
								
							?>
							<!-- <td> <a onclick="openDMSPopup('<?php echo $service_id;?>','<?php echo $sub_service_id;?>')">View</a><?php //echo '<pre>'; print_r($mapped_docs); ?></td> -->
							<td>
							<?php
							if($online_flag == 1){
								echo '<a target="_blank" href="'.$data_arr['service_url'].'">Apply Now</a>';
							}else if($offline_flag == 1){
								//echo "N.A";
								//echo '<button type="submit" class="btn btn-success">Apply Now</button>';
							}else if($swcs_flag == 1){
								//echo "N.A";
								echo '<button type="submit" class="btn btn-success">Apply Now</button>';
							}
							?>
							
							
							</td>
							
							
							</tr>
							
							<input type="hidden" name="type" value='<?php echo $status_text; ?>' />
							</form>
							<?php }}?>
							
		</tbody>
	</table>
</section>
</div></div></div>
<script type="text/javascript">
function goToNextPage(service_id,sub_service_id,caf_id){
	window.location.href='/backoffice/frontuser/ApplyService/DocumentsChecklist/service_id/'+service_id+'/sub_service_id/'+sub_service_id+'/caf_id/'+caf_id;
}
</script>