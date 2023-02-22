<?php 
$base=Yii::app()->theme->baseUrl;
$baseUrl=Yii::app()->theme->baseUrl;
?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?=$baseUrl?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?=$baseUrl?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<div class="dt-buttons" style="margin:3px 5px 0 0;float: right; "><a class="btn yellow btn" tabindex="0" href="<?=$this->createUrl('/dms/DocumentManagement/')?>"><span>Upload New</span></a>
</div>
<div class='portlet box green'>


<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>My Documents List</div>
    <div class='tools'>
	
	</div>
	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">
</div></div>
<?php
	//echo '<pre>'; print_r($documents_data);
	//echo count($documents_data);
	if(!empty($documents_data)){
?>
<table id="sample_31" class="table table-striped table-bordered" width="100%">
                            <thead>
                              <tr>
                                <th style="width:5%">S.N.</th>
                                <th style="width:10%">Document Name</th>
                                <th style="width:10%">Code</th>
                                <!--<th style="width:20%">Uploaded Document</th>-->
                                <th style="width:5%">Version</th>
                                <th style="width:5%">Status</th>
                                <th style="width:12%">Actions</th>
                                <th style="width:10%">Uploaded Date</th>
                              </tr>
                            </thead>
                            <tbody>
							<?php 
								$count = count($documents_data);  
								foreach($documents_data as $documents_array){ 
									if($documents_array['doc_status']=='U'){
										$status_text ='Unverified';$btn='success';
									}
									else if($documents_array['doc_status']=='V'){
										$status_text ='Verified';$btn='primary';
									}
									else if($documents_array['doc_status']=='R'){
										$status_text ='Rejected';$btn='danger';
									}else if($documents_array['doc_status']=='M'){
										$status_text ='Mismatch';$btn='danger';
									}
									$doc_link = FRONT_BASEURL."themes/backend/mydoc/".$documents_array['iuid']."/".$documents_array['document_name'];
									$used = DmsDocumentsExt::isDocumentUsed($documents_array['iuid'],$documents_array['doc_ref_number']);
									$is_document_active = $documents_array['is_document_active'];
									$delete_class = $is_document_active=='N'?'delete_class':'';
									if($is_document_active == 'N'){
										$status_text='Deleted';$btn='disabled';
									}
							?>
							<tr class="<?php echo $delete_class; ?>">
                                <td class="<?php echo $delete_class; ?>"><?php echo $count;  ?></td>
                                <td><?php echo $documents_array['name']; ?></td>
                                <td><?php echo $documents_array['chklist_id']; ?></td>
                                <!--<td>Uploaded Document</td>-->
                                <td><?php echo $documents_array['document_version_type'].$documents_array['document_version']; ?></td>
                                <td>
								<a href="#dms_log" data-toggle="modal" title="View document transactions" onclick="GetDocumentLogs('<?php echo $documents_array['documents_id']; ?>')">								<span class="btn btn-sm btn-<?php echo $btn; ?>"><i class="fa fa-info"></i>  <?php echo $status_text; ?></span>								</a>
								</td>
                                <td>
								<?php if($is_document_active == 'Y'){ ?>
								<!-- <a href="" class="btn btn-icon-only purple"><i class="fa fa-info"></i></a> -->
								<a href="<?php echo Yii::app()->request->baseUrl; ?>/dms/DocumentManagement/DownloadMyDocument/ref_no/<?php echo base64_encode($documents_array['doc_ref_number']); ?>" class="btn btn-icon-only yellow" title="Download Me"><i class="fa fa-download"></i></a>
								<a href="javascript:void(0)" <?php if(!$used){ ?>onclick="deleteMyDocument('<?php echo base64_encode($documents_array['doc_ref_number']); ?>','<?php echo base64_encode($documents_array['is_document_active']); ?>');" <?php } ?> class="btn btn-icon-only red <?php if($used){ ?>disabled <?php } ?>" title="Delete Me"><i class="fa fa-times"></i></a>
								
								<?php if(($documents_array['doc_status'] == 'M' || $documents_array['doc_status'] == 'R') && $documents_array['is_uploaded'] == 'N'){ ?>
								<a href="#newGrievence" data-toggle="modal" class="btn btn-icon-only purple" title="Upload Document" onclick="setFormDatas('<?php echo $documents_array['doc_type_id']; ?>','<?php echo $documents_array['issuer_id']; ?>','<?php echo $documents_array['issued_by_id']; ?>','<?php echo $documents_array['docchk_id']; ?>','<?php echo $documents_array['name']; ?>','<?php echo $documents_array['chklist_id']; ?>','<?php echo $documents_array['doc_status']; ?>','<?php echo $documents_array['documents_id']; ?>')">
								<i class="fa fa-upload"></i></a>
								<?php } ?>
								<?php } ?>
								</td>
                                <td><?php echo $documents_array['created_on']; ?></td>
                            </tr>
							<?php $count = $count-1;$delete_class='';} ?>
							
							</tbody></table>
<?php }else{ echo "No document uploaded.";} ?>
</div></div><!-- form -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="newGrievence" class="modal">
 <form role="form" action="" enctype="multipart/form-data" method="post" id="submit_form" name="submit_form">
		<input type="hidden" name='FileUpload[YII_CSRF_TOKEN]' value="<?php echo Yii::app()->getRequest()->getCsrfToken(); ?>">
		<input type="hidden" name="FileUpload[documents_id]" id="documents_id" required="required" >
		<input type="hidden" name="FileUpload[doc_id]" id="doc_id" required="required" >
		<input type="hidden" name="FileUpload[issuer_id]" id="issuer_id" required="required" >
		<input type="hidden" name="FileUpload[issued_by]" id="issued_by" required="required">
		<input type="hidden" name="FileUpload[doc_code]" id="doc_code" required="required">
		<input type="hidden" name="FileUpload[mydoc_status]" id="mydoc_status" value="active" required="required">
		<div class="modal-header">
          <button onclick="$('#submit_form').reset();" type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Upload <span id="title_txt" style="font-weight:bold;"></span></h4>
        </div>
		  <div class="row">	
			<div class="form-group col-lg-12">
				<label class="col-lg-4 control-label">Upload *</label>
				<div class="col-lg-8">
					<label id="new_copy_label" style="margin-right:10px;"><input type="radio" name="FileUpload[doc_version_type]" value="V" id="new_copy" disabled>New </label>
					 </label id="duplicate_copy_label"><input type="radio" name="FileUpload[doc_version_type]" value="D" id="duplicate_copy" checked>Duplicate  </label>
				</div>
			</div>
		  </div>
		  <div class="row">	
				<div class="form-group col-lg-12">
					<label class="col-lg-4 control-label">Select File *</label>
					<div class="col-lg-8">
						  <input type="file" style="width:30px;display:none;" required="required" name="dms_doc_uploads" class="inputfile inputfile-1" id="doc_uploads">
						  <label for="doc_uploads" style="margin-right:10px;">
							<i class="fa fa-upload btn btn-primary"></i> <span>Choose a file</span>
						  </label>
					 <b id="up_b" style="margin-right:10px;"></b>
					 </div>
				</div>
		</div>
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label"></label>
			<div class="col-lg-6" style="margin-top:20px;">
				<label id="plz_wait" style="display:none;">Please wait...</label>
				<input value="Submit" id="submit_btn" class="btn btn-primary" type="button" onclick="validateAndSubmit();">    
             </div>
		</div>
</form>
</div>
  
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="dms_log" class="modal"> 		<div class="modal-header">            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>			<h4 class="modal-title">Document Transactions</h4>        </div>		  <div class="row">				<div class="form-group col-lg-12" id="log_html">							</div>		  </div>		</div>


<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=$baseUrl?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?=$baseUrl?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?=$baseUrl?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?=$baseUrl?>/assets/pages/scripts/table-datatables-scroller.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#sample_31').dataTable( {
        "order": [[0,'DESC']]
    } );
	$('td').removeClass('sorting_1');
	$('body').on('click',function(){
		$('td').removeClass('sorting_1');
	});
} );
</script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?=$baseUrl?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
<link href="<?=$baseUrl?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->

 <!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=$baseUrl?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="<?=$baseUrl?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<style>
.error_span{color:red; font-weight:bold;}
.delete_class{background-color:#eeeeee !important;}
.sorting_1{background-color:#eeeeee !important;}
#dms_log{ width:80% !important; height:70% !important; left:10% !important; top:50% !important; margin-left:auto !important;}
</style>
<script>
var flag;
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
		// checkDuplicateDoc($doc_code.val());
		submitDMSForm('SUCCESS');
	}
}

function submitDMSForm(flag){
	
		/*if(flag == 'duplicate'){
			var doc_version_type = confirm("This document is already exists. Are you want to upload duplicate copy?");
			if(doc_version_type){
				doc_version_type = 'D';
			}else{
				doc_version_type='V';
			}
			$('#doc_version_type').val(doc_version_type);
		}*/
		// submit form --
		//$('#submit_btn').hide();
		$('#plz_wait').html('Please wait...').show();
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
					$('#plz_wait').html(data);
				   }
				},
			error:function(jqXHR, textStatus, errorThrown){
				alert('error::'+errorThrown);
			}
	   });
}


function deleteMyDocument(ref_no,doc_status){
	var cnf = confirm("Are you sure you want to delete this document?");
	if(cnf){
		$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->request->baseUrl; ?>/dms/DocumentManagement/deleteMyDocument/",
				data:
				{
					ref_no: ref_no,doc_status:doc_status
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
function GetDocumentLogs(document_id){
		$('#log_html').html('Please wait...');
		$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->request->baseUrl; ?>/dms/DocumentManagement/GetDocumentLogs/",
				data:
				{
					document_id: document_id
				},
			   success:  function(data) { //alert(data);
				   $('#log_html').html(data);
				},
			error:function(jqXHR, textStatus, errorThrown){
				alert('error::'+errorThrown);
			}
	   });
}

function setFormDatas(doctypeid,issuerid,issuedbyid,docchkid,name,code,docstatus,documents_id){
	$('#documents_id').val(documents_id);
	$('#doc_id').val(doctypeid);
	$('#doc_id').val(doctypeid);
	$('#issuer_id').val(issuerid);
	$('#issued_by').val(issuedbyid);
	$('#doc_code').val(docchkid);
	$('#title_txt').html(name+' ('+code+')');
	if(docstatus == 'M' || docstatus == 'R'){
		$('#new_copy').removeAttr('disabled');
		$('#new_copy_label').show();
	}else{
		$('#new_copy_label').hide();
		$('#new_copy').addAttr('disabled');
	}
}
</script>


