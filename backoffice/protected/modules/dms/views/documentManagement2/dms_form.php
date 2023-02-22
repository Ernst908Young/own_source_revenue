<?php 
$base=Yii::app()->theme->baseUrl;
$DocumentMaster = InfowizardQuestionMasterExt::getDocumentForInfoWizard();
$IssuerMaster = InfowizardQuestionMasterExt::getIssuerForInfoWizard();

//echo '<pre>'; print_r($Document);

?>

<?php 
$cls="Incentive";
if(isset($_GET['is']) &&  $_GET['is'] != '')
	$is = $_GET['is'];
else $is = "no";

	
if(isset($_GET['is']) && ($_GET['is']== 'SE')){	
			$cls="PES";
			include('/var/www/html/backoffice/themes/swcsNewTheme/views/layouts/pageBarServiceExisting.php');
		} else{
	// include('/var/www/html/backoffice/themes/swcsNewTheme/views/layouts/pageBarService.php');
 }
 ?>



<div class='portlet box green'>





<div class='portlet-title'>

    <div class='caption'>

        <i style=" font-size:20px;" class='fa fa-list'></i>Document Management</div>

    <div class='tools'>

	

	</div>
	
	
	<div class="dto-buttons" style="margin:3px 5px 0 0;float: right; "><a class="btn yellow btn" tabindex="0" href="<?=$this->createUrl('/dms/DocumentManagement/myDocuments/')?>"><span>My Documents</span></a>

<a class="btn red btn" href="#faqs_div" data-toggle="modal"><span>FAQ!</span></a>

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

			<label class="col-lg-2 control-label">Type of document *</label>

			<div class="col-md-4">

				<select class="form-control" autocomplete="off"  name="FileUpload[doc_id]" id="doc_id" required="required" onchange="resetDropdown('all');">

				<option value="" selected="selected">--Select Document Type--</option>

				<?php foreach($DocumentMaster as $key=>$val){ ?>
				<?php if((($is=='SE') && ($val['name'] == 'Central Government -  Incentive Registration') || ($val['name']=='State Government - Incentive Registration')) || ($is=='no')){ ?>	
				<option value="<?php echo $val['doc_id']; ?>"><?php echo $val['name']; ?></option>

				<?php }} ?>

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

				</select>

			</div>

		</div>

	</div>

	

	<div class="row" id="new_row" style="display:none;">	

		<div class="form-group col-lg-12">

			<label class="col-lg-2 control-label">Upload Type *</label>
			<div class="col-lg-4">
					<label id="new_copy_label" style="margin-right:10px;padding: 6px 12px;height: 50px;">
					<input class="rad" type="radio" name="FileUpload[doc_version_type]" value="V" checked id="new_copy">New 
					</label>
					<input class="rad" type="radio" name="FileUpload[doc_version_type]" value="D" id="duplicate_copy">Duplicate  
			</div>
			<label style="display:none;" class="col-lg-2 control-label dupl_row">Uploaded History</label>
			<div style="display:none;" class="col-md-4 dupl_row">
				<select class="form-control" autocomplete="off" required="required" name="FileUpload[doc_code_old]" id="doc_code_old">
				<option value="" selected="selected">--Select Document--</option>
				</select>
				<a href="" id="ddddddddd" target="_blank">View Selected Document</a>
				<b id="doc_code_old_b" style="margin-right:10px;"></b>
			</div>
			 

		</div>

	</div>

	

	<div class="row">	

		<div class="form-group col-lg-12">

			<label class="col-lg-2 control-label">Select File *</label>

			<div class="col-lg-4">

                  <input type="file" style="width:30px;display:none;" required="required" name="dms_doc_uploads" class="inputfile inputfile-1" id="doc_uploads">

				  <label for="doc_uploads" style="margin-right:10px;">

					<i class="fa fa-upload btn btn-primary"></i> <span>Choose a file</span>

				  </label>

             <b id="up_b" style="margin-right:10px;"></b>

             </div>
			 <label style="display:none;" class="col-lg-2 control-label doc_dddddddd">Document reference number</label>

			<div  style="display:none;" class="col-md-4 doc_dddddddd">

				<input type="text" class="form-control" autocomplete="off" name="FileUpload[document_reference_number]" id="document_reference_number">
				<b id="ref_b" style="margin-right:10px;"></b>
			</div>
			 

		</div>

	</div>
	<div class="row validity_dddddddd" style="display:none;">	

		<div class="form-group col-md-12">

			<label class="col-lg-2 control-label">Valid From</label>

			<div class="col-md-4">
				<div class="input-group">
				<input type="text" class="form-control date-picker" autocomplete="off" name="FileUpload[valid_from]" id="valid_from">
				</div>
				<b id="valid_from_b" style="margin-right:10px;"></b>
			</div>

			<label class="col-lg-2 control-label">Valid To</label>

			<div class="col-md-4">

				<input type="text" class="form-control date-picker" autocomplete="off" name="FileUpload[valid_to]" id="valid_to">
				<b id="valid_to_b" style="margin-right:10px;"></b>
			</div>

		</div>

	</div>
	<div class="row">	

		<div class="form-group col-md-12">

			<label class="col-lg-2 control-label">Comments</label>

			<div class="col-md-10" id="comments">

				<input type="text" class="form-control" autocomplete="off" name="FileUpload[comments]" id="comments" maxlength="255">

			</div>

			

		</div>

	</div>
	

	

	<div class="row">	

		<div id="error_div1" style="display:none; color:red;" class="alert alert-error alert-dismissable">

		<strong>ERROR</strong> <label id="label_text"></label>

		</div>

		<div class="form-group col-md-12">

			<label class="col-lg-4 col-sm-4 control-label"></label>

			<div class="col-lg-4" style="margin-top:20px;text-align:center;">

				<label id="plz_wait" style="display:none;">Please wait...</label>

				<input value="Upload" id="submit_btn" class="btn btn-primary" type="button" onclick="validateAndSubmit();">    

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

<hr>

<table class="table table-striped table-bordered" width="100%">

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

								$count = 1;//count($documents_data);  

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

									$status_text ='Ready To Submit';$btn='primary';

									

									$doc_link = FRONT_BASEURL."themes/backend/mydoc/".$documents_array['iuid']."/".$documents_array['document_name'];

							?>

							<tr>

                                <td><?php echo $count;  ?></td>

                                <td><?php echo $documents_array['name']; ?></td>

                                <td><?php echo $documents_array['chklist_id']; ?></td>

                                <!--<td>Uploaded Document</td>-->

                                <td><?php echo $documents_array['document_version_type'].$documents_array['document_version']; ?></td>

                                <td>

								<span class="btn btn-sm btn-<?php echo $btn; ?>"><i class="fa fa-info"></i>  <?php echo $status_text; ?></span>

								</td>

                                <td>

								<!-- <a href="" class="btn btn-icon-only purple"><i class="fa fa-info"></i></a> -->

								<a href="<?php echo Yii::app()->request->baseUrl; ?>/dms/DocumentManagement/DownloadMyDocument/ref_no/<?php echo base64_encode($documents_array['doc_ref_number']); ?>" class="btn btn-icon-only yellow"><i class="fa fa-download"></i></a>

								<a href="javascript:void(0)" onclick="deleteMyDocument('<?php echo base64_encode($documents_array['doc_ref_number']); ?>','<?php echo base64_encode($documents_array['is_document_active']); ?>');" class="btn btn-icon-only red"><i class="fa fa-times"></i></a>

								

								</td>

                                <td><?php echo $documents_array['created_on']; ?></td>

                            </tr>

							<?php $count = $count+1;} ?>

							

							</tbody></table>

							<input value="Submit" id="submit_btn" class="btn btn-primary" type="button" onclick="activateAllDocuments();">

<?php } ?>

</div></div><!-- form -->

<div id="faqs_div" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">

	<div class="modal-header">

          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

            <h4 class="modal-title">Upload <span id="title_txt" style="font-weight:bold;"></span></h4>

    </div>

	<div class="col-lg-12">

	   Content goes here...

	</div>

</div>		



<!-- BEGIN PAGE LEVEL PLUGINS -->

<link href="<?=$base?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />

<link href="<?=$base?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />

<!-- END PAGE LEVEL PLUGINS -->

 <!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="<?=$base?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>

<script src="<?=$base?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->
<script src="/backoffice/themes/swcsNewTheme/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>
<script src="/backoffice/themes/swcsNewTheme/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="/backoffice/themes/swcsNewTheme/assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script>
<script src="/backoffice/themes/swcsNewTheme/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="/backoffice/themes/swcsNewTheme/assets/global/plugins/bootstrap-datepicker/js/moment.min.js" type="text/javascript"></script>
<script src="/backoffice/themes/swcsNewTheme/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

<style>

.error_span{color:red; font-weight:bold;}

</style>

<script>
$("document").ready(function(){
	$(".date-picker").datepicker({
		rtl: App.isRTL(),
		autoclose: !0,
		format: 'yyyy-mm-dd',
		useCurrent: false,
	});
	
	$(".rad").change(function(){
		$('.dupl_row').hide();
		if($(this).attr('value') == 'D'){
			$('.dupl_row').show();
		}
	});
	$("#doc_code_old").change(function(){
		var iddd = $(this).val();
		if(iddd != ''){
			
			var mv1 = $('#opd-'+iddd).attr('data-vf');
			var mv2 = $('#opd-'+iddd).attr('data-vt');
			var mv3 = $('#opd-'+iddd).attr('data-ref');
			//alert(iddd+mv1+mv2+mv3);
			$('#valid_from').val(mv1);
			$('#valid_to').val(mv2);
			$('#document_reference_number').val(mv3);
			var urlop = 'http://investuttarakhand.co.in/themes/backend/mydoc/'+$('#opd-'+iddd).attr('iuid')+'/'+$('#opd-'+iddd).attr('href');
			$('#ddddddddd').attr('href',urlop);
			console.log(mv1);
			console.log(mv2);
			console.log(mv3);
		}
	});
	
	
});
var flag;
function showHideDiv(val){
	$('#new_row').hide();
	$('.validity_dddddddd').hide();
	$('.doc_dddddddd').hide();
	if(val == ''){
		$('#new_row').hide();
	}else{
		var $doc_code = $('#doc_code');
		var mv1 = $('#op-'+$doc_code.val()).attr('data-mv');
		var mv2 = $('#op-'+$doc_code.val()).attr('data-v');
		var mv3 = $('#op-'+$doc_code.val()).attr('data-ref');
		
		if(mv1=='Y'){
			
			$('#new_row').show();

			

		}
		if(mv2=='Y'){

			$('.validity_dddddddd').show();

			

		}
		
		if(mv3=='Y'){

			$('.doc_dddddddd').show();

			

		}
		
		getAllDocumentCheckListNew(val);
	}
}

function getAllDocumentCheckListNew(val){
	$.ajax({
				type: "get",
				url: "<?php echo Yii::app()->request->baseUrl; ?>/dms/DocumentManagement/GetAllDocumentCheckListHistory/chk_id/"+val,
				
			   success:  function(data) { 
				   $('#doc_code_old').html(data);
				}
	   });
}

function validateAndSubmit(){

	$('.error_span').hide();

	var $doc_id = $('#doc_id');

	var $issuer_id = $('#issuer_id');

	var $issued_by = $('#issued_by');

	var $doc_code = $('#doc_code');

	var $doc_uploads = $('#doc_uploads');

	var error=0;
	var mov;

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
		var mv1 = $('#op-'+$doc_code.val()).attr('data-mv');
		var mv2 = $('#op-'+$doc_code.val()).attr('data-v');
		var mv3 = $('#op-'+$doc_code.val()).attr('data-ref');
		if(mv2=='Y' && $('#valid_from').val()==''){

			$('#valid_from_b').after('<span class="error_span">This field is required.</span>');

			error=1;

		}
		if(mv2=='Y' && $('#valid_to').val()==''){

			$('#valid_to_b').after('<span class="error_span">This field is required.</span>');

			error=1;

		}
		if(mv3=='Y' && $('#document_reference_number').val()==''){

			$('#ref_b').after('<span class="error_span">This field is required.</span>');

			error=1;

		}
		
		if(error == 0){
			checkDuplicateDoc($doc_code.val(), mv1);
		}
		//checkDuplicateDoc($doc_code.val(), $('#op-'+$doc_code.val()).attr('data-mv'));

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

					$('#plz_wait').hide();

				   }

				},

			error:function(jqXHR, textStatus, errorThrown){

				alert('Error::'+errorThrown);

			}

	   });

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

			   resetDropdown('one');

			},

		error:function(jqXHR, textStatus, errorThrown){

			alert('Error::'+errorThrown);

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

			alert('Error::'+errorThrown);

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

			alert('Error::'+errorThrown);

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

				alert('Error::'+errorThrown);

			}

	   });

   }

}



function checkDuplicateDoc(dms_doc_id,mv1){

	$('#plz_wait').show();

	$.ajax({

			type: "POST",

			dataType: "json",

			url: "<?php echo Yii::app()->request->baseUrl; ?>/dms/DocumentManagement/checkDuplicateDoc",

			data:

			{

				dms_doc_id: dms_doc_id, mv: mv1,

			},

		   success:  function(data) {  

				

				var obj = data;

				if(obj.response == 'SUCCESS'){

					submitDMSForm(data);

				}else if(obj.response == 'FAILED'){

					$('#plz_wait').hide();
					var msg_new= 'Document already uploaded in your documents list.';
					alert(obj.response_msg);

				}

				//submitDMSForm(data);

			},

		error:function(jqXHR, textStatus, errorThrown){

			alert('Error::'+errorThrown);

		}

   });

}

function activateAllDocuments(){

	$.ajax({

			type: "POST",

			url: "<?php echo Yii::app()->request->baseUrl; ?>/dms/DocumentManagement/activateAllDocuments",

			data:

			{

				flag: 'activate',

			},

		   success:  function(data) { 

				if(data == 'success'){

					window.location.href='<?php echo Yii::app()->request->baseUrl; ?>/dms/DocumentManagement/myDocuments';

				}

			},

		error:function(jqXHR, textStatus, errorThrown){

			alert('Error::'+errorThrown);

		}

   });

}



function resetDropdown(flag){

	if(flag == 'all'){

		$('#issued_by_div').html('<select class="form-control" autocomplete="off" name="FileUpload[issued_by]" id="issued_by" required="required"><option value="" selected="selected">--Select Issued By--</option></select>');

		$('#document_div').html('<select class="form-control" autocomplete="off" required="required" name="FileUpload[doc_code]" id="doc_code"><option value="" selected="selected">--Select Document--</option></select>');

		$('#issuer_id').val('');

	}else if(flag == 'one'){

		$('#document_div').html('<select class="form-control" autocomplete="off" required="required" name="FileUpload[doc_code]" id="doc_code"><option value="" selected="selected">--Select Document--</option></select>');

	}

}
</script>