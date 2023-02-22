<?php $base=Yii::app()->theme->baseUrl; ?>
<div class='portlet box green'>
   <div class="portlet-body">
      <div class="site-min-height">
         <div class="form form-horizontal" role="form">
            <form role="form" action="" enctype="multipart/form-data" method="post" id="submit_form1" name="submit_form">
               <input type='hidden' name='FileUpload[YII_CSRF_TOKEN]' value="<?php echo Yii::app()->getRequest()->getCsrfToken(); ?>" />
               <div class="form form-horizontal" role="form">
                  <input type="hidden" name="FileUpload[doc_id]" id="doc_id" value="<?php echo $doc_id; ?>">
                  <input type="hidden" name="FileUpload[issuer_id]" id="issuer_id" value="<?php echo $issuer_id; ?>">
                  <input type="hidden"  name="FileUpload[issued_by]" id="issued_by" value="<?php echo $issued_by; ?>" >
                  <input type="hidden"  name="FileUpload[doc_code]" id="doc_code" value="<?php echo $doc_code; ?>" >
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
                  <div class="row" id="issuance_dddddddd" style="display:none;">
                     <label class="col-lg-2 control-label">Date of Issuance</label>
                     <div class="col-md-4">
                        <div class="input-group">
                           <input type="text" class="form-control date-picker" autocomplete="off" name="FileUpload[doc_date_of_issuance]" id="doc_date_of_issuance">
                        </div>
                        <b id="doc_date_of_issuance_b" style="margin-right:10px;"></b>
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
         </div>
      </div>
   </div>
</div>
<!-- form -->
<div id="faqs_div" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
      <h4 class="modal-title">Upload <span id="title_txt" style="font-weight:bold;"></span></h4>
   </div>
   <div class="col-lg-12">
      Content goes here...
   </div>
</div>
<!-- END PAGE LEVEL PLUGINS 
   <script src="/backoffice/themes/investuk/assets/global/scripts/datatable.js" type="text/javascript"></script>
   <script src="/backoffice/themes/swcsNewTheme/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>
   
   <script src="/backoffice/themes/swcsNewTheme/assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script>
   <script src="/backoffice/themes/swcsNewTheme/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
   <script src="/backoffice/themes/swcsNewTheme/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>-->
<script src="/backoffice/themes/swcsNewTheme/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="/backoffice/themes/swcsNewTheme/assets/global/plugins/bootstrap-datepicker/js/moment.min.js" type="text/javascript"></script>
<style>
   .error_span{color:red; font-weight:bold;}
</style>
<script type="text/javascript">
   showHideDiv("<?php echo $doc_code; ?>");
   $("document").ready(function(){
   $(".date-picker").datepicker({
	   //rtl: App.isRTL(),
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
   
   
   
   });
   var flag;
    function showHideDiv(val){
	   //  val="<?php echo $doc_code;?>";
	   // alert(val);
		   $('#new_row').hide();
	   $('.validity_dddddddd').hide();
	   $('.doc_dddddddd').hide();
	   if(val == ''){
			$('#new_row').hide();
	   }else{
		   var $doc_code = $('#doc_code');
		   var mv1 = "<?php echo $docDetail['is_multi_version_allowed'];?>"
		   var mv2 = "<?php echo $docDetail['is_validity_required'];?>";
		   var mv3 = "<?php echo $docDetail['is_document_reference_no_required'];?>";
		   var mv4 = "<?php echo @$docDetail['date_of_issuance'];?>";
		   
		   if(mv1=='Y'){		   
			$('#new_row').show();
		   }
		   if(mv2=='Y'){
		   
			$('.validity_dddddddd').show();
		   }
		   
		   if(mv3=='Y'){
		   
			$('.doc_dddddddd').show();
		   
		   }
		   if(mv4=='Y'){
			
			$('#issuance_dddddddd').show();
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
   //alert('continue..');
   function validateAndSubmit()
   {
   
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
		   var mv1 = "<?php echo $docDetail['is_multi_version_allowed'];?>"
		   var mv2 = "<?php echo $docDetail['is_validity_required'];?>";
		   var mv3 = "<?php echo $docDetail['is_document_reference_no_required'];?>";
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
	   
	   $('#plz_wait').show();
	   
	   var formData = new FormData($('form')[1]);
	   
	   $.ajax({
	   
	   type: "POST",
	   
	   async: false,
	   
	   cache: false,
	   
	   contentType: false,
	   
	   processData: false,
	   
	   url: "<?php echo Yii::app()->createAbsoluteUrl('frontuser/DocumentManagement/');?>",
	   
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