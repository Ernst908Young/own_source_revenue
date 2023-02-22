<?php
// @ CODE Edited by Rahul Kumar 
//

$base=Yii::app()->theme->baseUrl;
$sql_d = "SELECT * FROM bo_infowizard_issuerby_master WHERE is_issuerby_active='Y' AND issuer_id='2' ORDER BY name ASC";
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
        $sql_s="SELECT *,sp.service_type as p_service_type,sp.service_id as service_id,sp.servicetype_additionalsubservice  FROM bo_information_wizard_service_master as sm
			  INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id
              LEFT JOIN bo_information_wizard_inspection as iwi ON iwi.service_id=sm.id           
			  WHERE issuerby_id='$id' AND sp.is_active='Y' ORDER BY service_name ASC";
	$connection=Yii::app()->db; 
	$command=$connection->createCommand($sql_s);
	$res_s = $command->queryAll();
  
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
	<select name="issuerby_id" class="form-control" onchange="window.location='/backoffice/infowizard/ServiceDocuments/listingInspection/id/'+this.value">
		<option value="">Select Department</option>
		<?php foreach($res_d as $dep_arr){ ?>
		<option value="<?php echo $dep_arr['issuerby_id']; ?>" <?php if($id == $dep_arr['issuerby_id']){echo 'selected';} ?>><?php echo $dep_arr['name']; ?></option>
		<?php } ?>
	</select>
	</div>
	</div>
<section class="panel site-min-height" style="display:<?php echo $display; ?>">
  <header class="panel-heading">
	   Service Listing
  </header>
  
  
  <div class="panel-body" style="background: #fff;">
	
	<table class="table table-bordered" width="100%" id="sample_133" style="background: #fff;">
                            <thead>
                              <tr>
                                <th align="center" style="vertical-align:middle;width:5%" >ID</th>
                                <th align="center" style="vertical-align:middle;width:5%">Service Name</th>
                                <th align="center" style="vertical-align:middle;width:5%" >Type Of Service</th>
                                <th align="center" style="vertical-align:middle;width:5%" >Inspection Checklist Format</th>
                                <th align="center" style="vertical-align:middle;width:5%" >Inspection Checklist Format Upload</th>
                                <th align="center" style="vertical-align:middle;width:5%" >Inspection Checklist GO/ Excerpt</th>
                                <th align="center" style="vertical-align:middle;width:5%" >Inspection Checklist GO/ Excerpt Upload</th>
                                <th align="center" style="vertical-align:middle;width:5%" >Self-certification Format</th>
                                <th align="center" style="vertical-align:middle;width:5%" >Self-certification Format Upload</th>
								<th align="center" style="vertical-align:middle;width:5%" >Self Certification GO/ Excerpt</th>
								<th align="center" style="vertical-align:middle;width:5%" >Self Certification GO/ Excerpt Upload</th>
								<th align="center" style="vertical-align:middle;width:5%" >Third Party Certification Format</th>
								<th align="center" style="vertical-align:middle;width:5%" >Third Party Certification Format Upload</th>
								<th align="center" style="vertical-align:middle;width:5%" >Third Party Certification  GO/ Excerpt</th>
								<th align="center" style="vertical-align:middle;width:5%" >Third Party Certification  GO/ Excerpt Upload</th>
								<th align="center" style="vertical-align:middle;width:5%" >Periodic Checklist Format</th>
								<th align="center" style="vertical-align:middle;width:5%" >Periodic Checklist Format Upload</th>
								<th align="center" style="vertical-align:middle;width:5%" >Surprise Inspection Report Format</th>
								<th align="center" style="vertical-align:middle;width:5%" >Surprise Inspection Report Format Upload</th>
                              </tr>
                            </thead>
                            <tbody>
							<?php 
							
							$rtyu=array();
							foreach($res_s as $key=>$data_ar){
                                                                $service_id 	= $data_ar['service_id'];
								$sub_service_id = $data_ar['servicetype_additionalsubservice'];
                                                                $sidd=$service_id."-".$sub_service_id;
                                                                if(!in_array($sidd, $rtyu)){
                                                                    $rtyu[]=$sidd;
                                                                
                                                                $sql_si="SELECT * FROM bo_information_wizard_inspection WHERE service_id='$service_id' AND servicetype_additionalsubservice='$sub_service_id' ORDER BY id DESC LIMIT 1";
                                                                $connection=Yii::app()->db; 
                                                                $command=$connection->createCommand($sql_si);
                                                                $data_arr = $command->queryRow();
                                                                if(count($data_arr)<=0){
                                                                 $data_arr=false;
                                                                }
							?>
							<!--<form action="/backoffice/frontuser/ServiceMaster/documentCheckList/" method="POST">-->
							<input type="hidden" name="service_id" value='<?php echo $service_id; ?>' />
                            <input type="hidden" name="sub_service_id" value='<?php echo $sub_service_id; ?>' />
							
							<tr>
							<td style="vertical-align:middle;width:5%"><?php echo $service_id.".".$sub_service_id; ?></td>
							<td style="vertical-align:middle;width:5%"><?php echo $data_ar['core_service_name']; ?></td>
							<td style="vertical-align:middle;width:5%"><?php echo $data_ar['p_service_type']; ?></td>
							<td  align="center" style="vertical-align:middle;width:5%">
							 
                                                            <!-- Inspection Checklist Format  ---->
                                                            <?php if(!empty($data_arr['inspection_checklist_format'])){ ?><a  target="_blank" href="<?php echo $data_arr['inspection_checklist_format']; ?>">Yes</a><?php }else{ echo "N.A";} ?>
							</td>
                                                        <td>
							 <form action='<?=$this->createUrl("/infowizard/serviceParameters/uploadInspectionDocs/serivceID/$service_id/subServiceID/$sub_service_id/uploadFor/inspection_checklist_format/docName/icf/location/services");?>' method="post" enctype="multipart/form-data">
							<input type="file" name="file" > <br>
							  <input type="submit" name="submit" class="btn btn-danger" value="Upload New" ><?php if(!empty($data_arr['inspection_checklist_format'])){ ?><a class="btn btn-primary" href="<?php echo $data_arr['inspection_checklist_format']; ?>"><i class="fa fa-file"></i></a><?php } ?>
                                                       </form>
							</td>
                                                        
                                                        
                                                        <!----Inspection Checklist GO/ Excerpt ----->
							<td  align="center" style="vertical-align:middle;width:5%">
							 <?php if(!empty($data_arr['inspection_excerpt_from_act'])){ ?><a  target="_blank" href="<?php echo $data_arr['inspection_excerpt_from_act']; ?>">Yes</a><?php }else{ echo "N.A";} ?>
							</td>
                                                         <td>
							 <form action='<?=$this->createUrl("/infowizard/serviceParameters/uploadInspectionDocs/serivceID/$service_id/subServiceID/$sub_service_id/uploadFor/inspection_excerpt_from_act/docName/ice/location/services");?>' method="post" enctype="multipart/form-data">
							<input type="file" name="file" > <br>
							  <input type="submit" name="submit" class="btn btn-danger" value="Upload New" ><?php if(!empty($data_arr['inspection_excerpt_from_act'])){ ?><a class="btn btn-primary" href="<?php echo $data_arr['inspection_excerpt_from_act']; ?>"><i class="fa fa-file"></i></a><?php } ?>
                                                       </form>
							</td>
                                                        
                                                        
                                                        <!--   Self-certification Format ---->
							<td  align="center" style="vertical-align:middle;width:5%">
							 <?php if(!empty($data_arr['self_certification_format'])){ ?><a  target="_blank" href="<?php echo $data_arr['self_certification_format']; ?>">Yes</a><?php }else{ echo "N.A";} ?>
							</td>
                                                         <td>
							 <form action='<?=$this->createUrl("/infowizard/serviceParameters/uploadInspectionDocs/serivceID/$service_id/subServiceID/$sub_service_id/uploadFor/self_certification_format/docName/scf/location/services");?>' method="post" enctype="multipart/form-data">
							<input type="file" name="file" > <br>
							  <input type="submit" name="submit" class="btn btn-danger" value="Upload New" ><?php if(!empty($data_arr['self_certification_format'])){ ?><a class="btn btn-primary" href="<?php echo $data_arr['self_certification_format']; ?>"><i class="fa fa-file"></i></a><?php } ?>
                                                       </form>
							</td>
                                                        
                                                        <!--    Self Certification GO/ Excerpt  ---->
							<td  align="center" style="vertical-align:middle;width:5%">
							 <?php if(!empty($data_arr['self_certification_excerpt_from_act'])){ ?><a  target="_blank" href="<?php echo $data_arr['self_certification_excerpt_from_act']; ?>">Yes</a><?php }else{ echo "N.A";} ?>
							</td>
                                                         <td>
							 <form action='<?=$this->createUrl("/infowizard/serviceParameters/uploadInspectionDocs/serivceID/$service_id/subServiceID/$sub_service_id/uploadFor/self_certification_excerpt_from_act/docName/sce/location/services");?>' method="post" enctype="multipart/form-data">
							<input type="file" name="file" > <br>
							  <input type="submit" name="submit" class="btn btn-danger" value="Upload New" ><?php if(!empty($data_arr['self_certification_excerpt_from_act'])){ ?><a class="btn btn-primary" href="<?php echo $data_arr['self_certification_excerpt_from_act']; ?>"><i class="fa fa-file"></i></a><?php } ?>
                                                       </form>
							</td>
                                                        
                                                         <!--    Third Party Certification Format  ---->
							<td  align="center" style="vertical-align:middle;width:5%">
							 <?php if(!empty($data_arr['third_party_cettification_format'])){ ?><a  target="_blank" href="<?php echo $data_arr['third_party_excerpt_from']; ?>">Yes</a><?php }else{ echo "N.A";} ?>
							</td>
                                                         <td>
							 <form action='<?=$this->createUrl("/infowizard/serviceParameters/uploadInspectionDocs/serivceID/$service_id/subServiceID/$sub_service_id/uploadFor/third_party_cettification_format/docName/tpc/location/services");?>' method="post" enctype="multipart/form-data">
							<input type="file" name="file" > <br>
							  <input type="submit" name="submit" class="btn btn-danger" value="Upload New" ><?php if(!empty($data_arr['third_party_cettification_format'])){ ?><a class="btn btn-primary" href="<?php echo $data_arr['third_party_cettification_format']; ?>"><i class="fa fa-file"></i></a><?php } ?>
                                                       </form>
							</td>
                                                        
                                                         <!--    Third Party Certification GO/ Excerpt  ---->
							<td  align="center" style="vertical-align:middle;width:5%">
							 <?php if(!empty($data_arr['third_party_excerpt_from'])){ ?><a  target="_blank" href="<?php echo $data_arr['third_party_excerpt_from']; ?>">Yes</a><?php }else{ echo "N.A";} ?>
							</td>
                                                         <td>
							 <form action='<?=$this->createUrl("/infowizard/serviceParameters/uploadInspectionDocs/serivceID/$service_id/subServiceID/$sub_service_id/uploadFor/third_party_excerpt_from/docName/tpe/location/services");?>' method="post" enctype="multipart/form-data">
							<input type="file" name="file" > <br>
							  <input type="submit" name="submit" class="btn btn-danger" value="Upload New" ><?php if(!empty($data_arr['third_party_excerpt_from'])){ ?><a class="btn btn-primary" href="<?php echo $data_arr['third_party_excerpt_from']; ?>"><i class="fa fa-file"></i></a><?php } ?>
                                                       </form>
							</td>
                                                        
                                                     <!---   Periodic Checklist Format--->
							<td  align="center" style="vertical-align:middle;width:5%">
							 <?php if(!empty($data_arr['upload_periodic_checklist_format'])){ ?><a  target="_blank" href="<?php echo $data_arr['upload_periodic_checklist_format']; ?>">Yes</a><?php }else{ echo "N.A";} ?>
							</td>
                                                        <td>
                                                         <form action='<?=$this->createUrl("/infowizard/serviceParameters/uploadInspectionDocs/serivceID/$service_id/subServiceID/$sub_service_id/uploadFor/upload_periodic_checklist_format/docName/pcf/location/services");?>' method="post" enctype="multipart/form-data">
							<input type="file" name="file" > <br>
							  <input type="submit" name="submit" class="btn btn-danger" value="Upload New" ><?php if(!empty($data_arr['upload_periodic_checklist_format'])){ ?><a class="btn btn-primary" href="<?php echo $data_arr['upload_periodic_checklist_format']; ?>"><i class="fa fa-file"></i></a><?php } ?>
                                                       </form>
							</td>
                                                        
                                                        <!-- Surprise Inspection Report Format  -->
							<td  align="center" style="vertical-align:middle;width:5%">
							 <?php if(!empty($data_arr['upload_periodic_checklist_format_sruprise'])){ ?><a  target="_blank" href="<?php echo $data_arr['upload_periodic_checklist_format_sruprise']; ?>">Yes</a><?php }else{ echo "N.A";} ?>
							</td>
                                                         <td>
                                                         <form action='<?=$this->createUrl("/infowizard/serviceParameters/uploadInspectionDocs/serivceID/$service_id/subServiceID/$sub_service_id/uploadFor/upload_periodic_checklist_format_sruprise/docName/sir/location/services");?>' method="post" enctype="multipart/form-data">
							<input type="file" name="file" > <br>
							  <input type="submit" name="submit" class="btn btn-danger" value="Upload New" ><?php if(!empty($data_arr['upload_periodic_checklist_format_sruprise'])){ ?><a class="btn btn-primary" href="<?php echo $data_arr['upload_periodic_checklist_format_sruprise']; ?>"><i class="fa fa-file"></i></a><?php } ?>
                                                       </form>
							</td>
							
							</tr>
							</form>
                                                        <?php } }  ?>  
							  						
							</tbody></table>
  
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
        height:500px;
}

</style>

<script type="text/javascript">


function openDMSPopup(service_id,sub_service_id){
	// open popup using ajax
	$.ajax({
	type: "POST",
	url: "/backoffice/infowizard/ServiceDocuments/getRequiredDocuments/",
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
	url: "/backoffice/infowizard/ServiceDocuments/getTimelines/",
	data:{'service_id':service_id,'sub_service_id':sub_service_id},		   
	success:  function(html) {
			
			$('#model_content').html(html);
			$('#model_div').modal();
		}
	});
	
}
</script>
