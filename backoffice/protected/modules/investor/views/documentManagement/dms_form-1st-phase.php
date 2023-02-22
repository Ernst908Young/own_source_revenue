<?php 
$base=Yii::app()->theme->baseUrl;
$DocumentMaster = InfowizardQuestionMasterExt::getDocumentForInfoWizard();
$IssuerMaster = InfowizardQuestionMasterExt::getIssuerForInfoWizard();
//echo '<pre>'; print_r($Document);
?>

<div class='portlet box green'>


<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>Document Management</div>
    <div class='tools'>
	
	</div>
	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">

<form role="form" action="" enctype="multipart/form-data" method="post" id="submit_form" name="submit_form">
<input type='hidden' name='FileUpload[YII_CSRF_TOKEN]' value="<?php echo Yii::app()->getRequest()->getCsrfToken(); ?>" />
<div class="form form-horizontal" role="form">
	<div class="row">	
		<div class="form-group col-md-12">
			<label class="col-lg-2 control-label">Type of documents *</label>
			<div class="col-md-4">
				<select class="form-control" autocomplete="off"  name="FileUpload[doc_id]" id="doc_id" required="required">
				<option value="" selected="selected">--Select Document Type--</option>
				<?php foreach($DocumentMaster as $key=>$val){ ?>
				<option value="<?php echo $val['doc_id']; ?>"><?php echo $val['name']; ?></option>
				<?php } ?>
				</select>
			</div>
			<label class="col-lg-2 control-label">Select Issuer *</label>
			<div class="col-md-4">
				<select class="form-control" autocomplete="off" name="FileUpload[issuer_id]" id="issuer_id" onchange="getAllIssuerBy(this.value,$('#doc_id').val())" required="required">
				<option value="" selected="selected">--Select Issuer--</option>
				<?php foreach($IssuerMaster as $key=>$val){ ?>
				<option value="<?php echo $val['issuer_id']; ?>"><?php echo $val['name']; ?></option>
				<?php } ?>
				<option value="all">All</option>
				</select>
			</div>
		</div>
	</div>
	
	<!--<div class="row">	
		<div class="form-group col-md-12">
			<label class="col-lg-2 control-label">Select Issuer *</label>
			<div class="col-md-4">
				<select class="form-control" autocomplete="off" name="FileUpload[issuer_id]" id="issuer_id" onchange="getAllIssuerBy(this.value,$('#doc_id').val())">
				<option value="" selected="selected">--Select Issuer--</option>
				<?php foreach($IssuerMaster as $key=>$val){ ?>
				<option value="<?php echo $val['issuer_id']; ?>"><?php echo $val['name']; ?></option>
				<?php } ?>
				<option value="all">All</option>
				</select>
			</div>
		</div>
	</div> -->
	
	<div class="row">	
		<div class="form-group col-md-12">
			<label class="col-lg-2 control-label">Issued By *</label>
			<div class="col-md-4" id="issued_by_div">
				<select class="form-control" autocomplete="off"  name="FileUpload[issued_by]" id="issued_by" required="required">
				<option value="" selected="selected">--Select Issued By--</option>
				</select>
			</div>
			<label class="col-lg-2 control-label">Select Document *</label>
			<div class="col-md-4" id="document_div">
				<select class="form-control" autocomplete="off" required="required" name="FileUpload[doc_code]" id="doc_code">
				<option value="" selected="selected">--Select Document--</option>
				<?php
					$sql="SELECT * FROM bo_infowizard_documentchklist WHERE is_docchklist_active='Y' ORDER BY name ASC";
					$connection=Yii::app()->db; 
					$command=$connection->createCommand($sql);
					$doc_chk=$command->queryAll();
					if(count($doc_chk)>0){
						foreach($doc_chk as $doc_chk_arr){
							//echo '<option value="'.$doc_chk_arr['docchk_id'].'">'.$doc_chk_arr['name'].' - ('.$doc_chk_arr['chklist_id'].')</option>';
						}
					}
				?>
				</select>
			</div>
		</div>
	</div>
	
	
	
	<div class="row">	
		<div class="form-group col-lg-12">
			<label class="col-lg-2 control-label">Select File *</label>
			<div class="col-lg-8">
                  <input type="file" style="width:30px;display:none;" required="required" name="dms_doc_uploads" class="inputfile inputfile-1" id="doc_uploads">
				  <label for="doc_uploads" style="margin-right:10px;">
					<i class="fa fa-upload btn btn-primary"></i> <span>Choose a file</span>
				  </label>
             <b id="up_b" style="margin-right:10px;">(Only PDF/JPEG File Allowed)</b>
             </div>
		</div>
	</div>
	
	<div class="row">	
		<div id="error_div1" style="display:none; color:red;" class="alert alert-error alert-dismissable">
		<strong>ERROR</strong> <label id="label_text"></label>
		</div>
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label"></label>
			<div class="col-lg-6" style="margin-top:20px;">
				<label id="plz_wait" style="display:none;">Please wait...</label>
				<input value="Submit" id="submit_btn" class="btn btn-primary" type="button" onclick="validateAndSubmit();">    
             </div>
		</div>
		
	</div>
	
	
	
</div>
</form>

</div></div>
<?php
	//echo '<pre>'; print_r($documents_data);
	//echo count($documents_data);
	if(!empty($documents_data)){
?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?=$base?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<hr>
<table id="sample_31" class="table table-striped table-bordered" width="100%">
                            <thead>
                              <tr>
                                <th style="width:5%">S.N.</th>
                                <th style="width:15%">Document Name</th>
                                <th style="width:10%">Code</th>
                                <!--<th style="width:20%">Uploaded Document</th>-->
                                <th style="width:5%">Version</th>
                                <th style="width:5%">Status</th>
                                <th style="width:10%">Actions</th>
                                <th style="width:10%">Uploaded Date</th>
                              </tr>
                            </thead>
                            <tbody>
							<?php 
								$count = count($documents_data);  
								foreach($documents_data as $documents_array){ 
									if($documents_array['doc_status']=='U'){
										$status_text ='Un-verified';$btn='success';
									}
									else if($documents_array['doc_status']=='V'){
										$status_text ='Verified';$btn='primary';
									}
									else if($documents_array['doc_status']=='R'){
										$status_text ='Rejected';$btn='danger';
									}
									$doc_link = FRONT_BASEURL."themes/backend/mydoc/".$documents_array['iuid']."/".$documents_array['document_name'];
							?>
							<tr>
                                <td><?php echo $count;  ?></td>
                                <td><?php echo $documents_array['name']; ?></td>
                                <td><?php echo $documents_array['chklist_id']; ?></td>
                                <!--<td>Uploaded Document</td>-->
                                <td><?php echo $documents_array['document_version']; ?></td>
                                <td>
								<span class="btn btn-sm btn-<?php echo $btn; ?>"><i class="fa fa-info"></i>  <?php echo $status_text; ?></span>
								</td>
                                <td>
								<!-- <a href="" class="btn btn-icon-only purple"><i class="fa fa-info"></i></a> -->
								<a href="<?php echo Yii::app()->request->baseUrl; ?>/dms/DocumentManagement/DownloadMyDocument/ref_no/<?php echo base64_encode($documents_array['doc_ref_number']); ?>" class="btn btn-icon-only yellow"><i class="fa fa-download"></i></a>
								<a href="javascript:void(0)" onclick="deleteMyDocument('<?php echo base64_encode($documents_array['doc_ref_number']); ?>');" class="btn btn-icon-only red"><i class="fa fa-times"></i></a>
								
								</td>
                                <td><?php echo $documents_array['created_on']; ?></td>
                            </tr>
							<?php $count = $count-1;} ?>
							
							</tbody></table>
<?php } ?>
</div></div><!-- form -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/pages/scripts/table-datatables-scroller.min.js" type="text/javascript"></script>
<style>
.error_span{color:red; font-weight:bold;}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $('#sample_31').dataTable( {
        "order": [[0,'DESC']]
    } );
} );
</script>
<!-- END PAGE LEVEL PLUGINS -->
<script>
function validateAndSubmit(){
	$('.error_span').hide();
	var $doc_id = $('#doc_id');
	var $issuer_id = $('#issuer_id');
	var $issued_by = $('#issued_by');
	var $doc_code = $('#doc_code');
	var $doc_uploads = $('#doc_uploads');
	var error=0;
	if($doc_id.val()==''){
		$doc_id.after('<span class="error_span">This is required field.</span>');
		error=1;
	}
	if($issuer_id.val()==''){
		$issuer_id.after('<span class="error_span">This is required field.</span>');
		error=1;
	}
	if($issued_by.val()==''){
		$issued_by.after('<span class="error_span">This is required field.</span>');
		error=1;
	}
	if($doc_code.val()==''){
		$doc_code.after('<span class="error_span">This is required field.</span>');
		error=1;
	}
	if($doc_uploads.val()==''){
		$('#up_b').after('<span class="error_span">This is required field.</span>');
		error=1;
	}
	
	if(error == 0){
		// submit form --
		$('#submit_btn').hide();
		$('#plz_wait').show();
		var formData = new FormData($('form')[0]);
		$.ajax({
				type: "POST",
				async: false,
				cache: false,
				contentType: false,
				processData: false,
				url: "<?php echo Yii::app()->createAbsoluteUrl('dms/DocumentManagement/');?>",
				data:formData,
			   success:  function(data) { 
				   //$('#issued_by_div').html(data);
				   if(data=='success'){
						window.location.reload();
				   }else{
					//alert(data);
					$('#error_div1').show();
					$('#error_div1').focus();
					$('#label_text').html(data);
				   }
				},
			error:function(jqXHR, textStatus, errorThrown){
				alert('error::'+errorThrown);
			}
	   });
	}
}
function getAllIssuerBy(val,doc_id){
	$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->request->baseUrl; ?>/dms/DocumentManagement/getAllIssuerBy",
			data:
			{
				issuerid: val,doc_id:doc_id
			},
		   success:  function(data) { //alert(data);
			   $('#issued_by_div').html(data);
			},
		error:function(jqXHR, textStatus, errorThrown){
			alert('error::'+errorThrown);
		}
   });
}

function getAllDocumentCheckList(val){
	$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->request->baseUrl; ?>/dms/DocumentManagement/getAllDocumentCheckList",
			data:
			{
				doc_id: $('#doc_id').val(),issuer_id:$('#issuer_id').val(),issued_by:val
			},
		   success:  function(data) { //alert(data);
			   $('#document_div').html(data);
			},
		error:function(jqXHR, textStatus, errorThrown){
			alert('error::'+errorThrown);
		}
   });
}
function checkDocCheckListID(){
	$.ajax({
			type: "POST",
			url: "<?php echo Yii::app()->request->baseUrl; ?>/dms/DocumentManagement/getAllIssuerBy",
			data:
			{
				issuer_id: $('#issuer_id').val(),doc_id:$('#doc_id').val(),issued_by:$('#issued_by').val(),
			},
		   success:  function(data) { //alert(data);
			   if(data == false){
					alert("Not mapped");
					return false;
			   }
			   return true;
			},
		error:function(jqXHR, textStatus, errorThrown){
			alert('error::'+errorThrown);
		}
   });
}

function deleteMyDocument(ref_no){
	var cnf = confirm("Are you sure you want to delete this document?");
	if(cnf){
		$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->request->baseUrl; ?>/dms/DocumentManagement/deleteMyDocument/",
				data:
				{
					ref_no: ref_no,
				},
			   success:  function(data) { //alert(data);
				   if(data == 'success'){
						window.location.reload();
						return;
				   }
				   alert(data);
				},
			error:function(jqXHR, textStatus, errorThrown){
				alert('error::'+errorThrown);
			}
	   });
   }
}
</script>


