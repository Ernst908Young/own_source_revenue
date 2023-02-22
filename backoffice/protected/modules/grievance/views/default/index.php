<?php
 //for($i=1; $i<=100; $i++){
/*	Yii::app()->db->createCommand("INSERT INTO bo_infowiz_formfield_options (formfield_id, options, type, is_active, user_agent, remote_ip, created) VALUES (1121, $i, 'radio', 'Y', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36', '61.2.157.109','2021-06-30 17:06:37')")->execute();*/

/*$q = Yii::app()->db->createCommand("SELECT * FROM  bo_infowiz_formfield_options  WHERE formfield_id=969 ORDER BY id ASC")->queryAll();
foreach($q as $val){
	$id = $val['id'];
	$p = $val['options'];
	Yii::app()->db->createCommand("UPDATE  bo_infowiz_formfield_options SET prefrence= $p  WHERE id=$id")->execute();
}*/

//}
 ?> <style type="text/css">
.form-part.bussiness-det .form-group>div {
	margin-bottom: 0px;
}

.form-control-feedback {
	color: red;
}

.select-box:after {
	border: 0;
}
p.balance_count {
    font-size: 11px;
}
</style>
<div class="dashboard-home">
	<div class="applied-status">
		<ul class="breadcrumb">
			<li><a href="/backoffice/investor/home/investorWalkthrough">Home</a></li>
			<li><a href="/backoffice/investor/services/ticketquery/tq">Grievance</a></li>
			<li>Your Grievance Details</li>
		</ul>
		<div class="status-title d-flex flex-wrap align-items-center justify-content-between">
			<h4>Welcome to Digital Corporate Registry System</h4>
			<div class="serach-bar">
			</div>
		</div>
	</div>
	<div class="m-wizard m-wizard--3 m-wizard--success" id="m_wizard">
		<div class="reservation-form"> <?php $srnss = array_merge([array('submission_id'=>'Other')],$srns);  

$sub_id = isset($_GET['srn_no']) ? base64_decode($_GET['srn_no']) : NULL; ?> <form id="m_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/grievance/default/index"); ?>" enctype="multipart/form-data">
				<div class="form-part bussiness-det">
					<h4 class="form-heading">Raise a New Grievance</h4>
					<div class="form-row row">
						<div class="col-md-6 form-group text-start mb-3">
							<label>Grievance Type <span style="color: red;">*</span></label>
							<select name="category" id="category" onchange="getexcid($(this).val())" class="select2-me" required>
								<option value="">Select Grievance Type </option> 
								<!--option value="Functional">Functional</option> 
							    <option value="Technical">Technical</option--> 
							    <option value="Ticket">Existing Ticket</option> 
								<option value="Query">Existing Query</option> 
								<!--option value="Other">Other</option--> 

							</select>
							<span id="category-error" style="color: red;"> </span>
						</div>
						<div class="col-md-6 form-group ref_no_div text-start mb-3 hidden">
							<label><span id="reference">Reference No.</span> <span style="color: red;">*</span></label> 
							 <select name="category_id" id="category_id" class="select2-me" required>
								<!--option value="">Select Reference Number </option--> 
							</select>
							<span id="c_id-error" style="color: red;"></span>
						</div>
						<!-- <input type="hidden" id="hid_category_id" name="category_id"> -->
						<div id="exist_data_table">   
          
          				</div>
						<div class="col-lg-12 form-group text-start mb-3">
							<label>Subject <span style="color: red;">*</span></label>
							<input type="text" name="subject" class="form-control" placeholder="Enter Subject" required maxlength="300" onkeyup="countChars(this,'charNumSubject',300);">
							<small style="display:none;"><span id="charNumSubject">400</span>/400 characters remaining</small>
						</div>
						<div class="col-lg-12 form-group text-start mb-3">
							<label>Message <span style="color: red;">*</span></label>
							<textarea name="message" id="message" placeholder="Enter your Message here" rows='12' class="form-control" required maxlength="1000" onkeyup="countChars(this,'charNumMessage',1000);"></textarea>
							<!-- <small tyle="display:none;"><span id="charNumMessage">1000</span>/1000 characters remaining</small> -->
						</div>

						<!-- <div class="col-md-6 form-group text-start mb-3">
							<label>Grievance Status</label>
							<select name="status" id="status" class="select2-me" required>
								<option value="O">Open</option>		
								<option value="W">Withdrawn</option> 					   

							</select>
							<span id="status-error" style="color: red;"></span>	   		
						</div> -->

						<div class="col-lg-12 form-group text-start">
							<label>Upload Supporting Document</label>
						</div>
						<input type="file" id="input-id" name="input-100[]" multiple accept="image/*, application/pdf">
						<!-- <input type="file" id="input-id" name="input-100[]" multiple>  -->
						<small><i>(Please upload PDF, JPG, PNG only.)</i></small>
					</div>
					<div class="form-row row">
						<div class="form-group col-md-12" style="text-align: center;">
							<a href="javascript:void(0);" class="submitForm custome-btn" data-wizard-action="submit">
								<span>
									<i class="fa fa-check"></i> &nbsp;&nbsp; <span> Submit </span>
								</span>
							</a>
							<!--  <button type="submit" class="btn-secondary" style="font-size: 18px; width: 120px;">Submit</button> -->
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$("#input-id").fileinput({
		uploadUrl: "/backoffice/grievance/default/fileupload",
		enableResumableUpload: true,
		showCaption: false,
		showRemove: false,
		showCancel: false,
		showUpload: true,
		allowedFileExtensions: ["png", "jpg", "pdf"],
		resumableUploadOptions: {
			// uncomment below if you wish to test the file for previous partial uploaded chunks
			// to the server and resume uploads from that point afterwards
			// testUrl: "http://localhost/test-upload.php"
		},
		uploadExtraData: {
			'uploadToken': 'SOME-TOKEN', // for access control / security 
			'user_id' : "<?= $user_id ?>"
		},
		maxFileCount: 5,
		initialPreviewAsData: true,
		overwriteInitial: false,
		// initialPreview: [],          // if you have previously uploaded preview files
		// initialPreviewConfig: [],    // if you have previously uploaded preview files
		theme: 'fas',
		deleteUrl: "http://localhost/file-delete.php"
	});
	/*$('#kvFileinputModal').appendTo('body').modal('show');*/
	$(".kv-fileinput-error, .fileinput-remove").hide();
});
/*function showtextsc(){
	alert($("#srn_app_id").val());
	getcatser($("#srn_app_id").val());
}*/
/* 
 *Count character in text box 
 */
function countChars(obj,ID,count){
    var maxLength = count;
    var strLength = obj.value.length;
    var charRemain = (maxLength - strLength);
    
    if(charRemain < 0){
        document.getElementById(ID).innerHTML = '<span style="color: red; font-size: 16px;" >Maximum characters '+maxLength+' allowed</span>';
            obj.value = obj.value.substring(0, maxLength);
    }  else{
        document.getElementById(ID).innerHTML = charRemain;
    }
}

/*function getservices(cat) {
	if(cat == "" || cat == "0") {
		$("#service_id").html("<option>-</option>");
	} else {
		$.ajax({
			type: "POST",
			dataType: 'html',
			url: "/backoffice/ticketing/default/getservices/category/" + cat,
			beforeSend: function() {
				$("#category-error").text("Please Wait...");
			},
			success: function(result) {
				$("#category-error").text("");
				$("#service_id").html(result);
			}
		});
	}
}*/

function getexcid(category){
	//alert(category);
	$("#exist_data_table").css("display", "none");
	$("#category_id").val("").trigger("change");
	if(category == "" || category == "Other"){
		
		$(".ref_no_div").addClass("hidden");
	}else{
		$("#category_id").select2("val","");
	// alert(category);
		$.ajax({
			type: "POST",
			dataType: 'html',
			url: "/backoffice/grievance/default/getexistingid/category/" + category,
			beforeSend: function() {
				$("#c_id-error").text("Please Wait...");				
			},
			success: function(result) {
				// console.log(result);
			    $("#c_id-error").text("");
			    if(result==false){
					
			    	$(".ref_no_div").addClass("hidden");
			    	$("#category_id").html();
			    	
			    }else{
			    	$(".ref_no_div").removeClass("hidden");
					$("#category_id").html(result);
					// alert(category);
					if(category == 'Ticket'){
						$('#reference').text("Reference No. of Ticket");
						$('#category_id').val("").trigger("change");					
					}
					if(category == 'Query'){
						$('#reference').text("Reference No. of Query");
						$('#category_id').val("").trigger("change");							
					}
			    	
			    	
					
			    }
				
			}
		});
	}
}

$(document).ready(function() {
$("#category_id").on("change",function () {
	var id = $(this).val();
	if(id == "" || id == "Other"){
		$("#exist_data_table").css("display", "none");
	}else{
		$("#exist_data_table").css("display", "block");	
		var cat = $("#category").val();
		
		$.ajax({
			type: "POST",
			dataType: 'html',
			url: "/backoffice/grievance/default/getexistingdata/category/" + cat+"/existing_cat_id/"+id,
			beforeSend: function() {
				$("#c_id-error").text("Please Wait...");				
			},
			success: function(result) {
			    $("#c_id-error").text("");
                var details = result.details;
                $("#exist_data_table").html(result);
                
			}
		});
	}
});
});


/*function getcatser(srn) {
	//alert(srn);
	if(srn == "" || srn == "Other") {
		//$("#service_id").html("<option>-</option>");
		$("#servicecategory_text").val("");
		$("#servicecategory_text_value").val("");
		$("#service_id_text").val("");
		$("#service_id_text_value").val("");
		$("#div_cat_text, #div_ser_text").hide();
		$("#div_cat_select, #div_ser_select").show();
	} else {
		$("#div_cat_select, #div_ser_select").hide();
		$("#div_cat_text, #div_ser_text").show();
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: "/backoffice/ticketing/default/getcatser/srn/" + srn,
			beforeSend: function() {
				$("#srn-error").text("Please Wait...");
				$("#servicecategory_text").val("");
				$("#servicecategory_text_value").val("");
				$("#service_id_text").val("");
				$("#service_id_text_value").val("");
			},
			success: function(result) {
				console.log(JSON.stringify(result.status));
				if(result.status == true) {
					$("#srn-error").text("");
					$("#servicecategory_text").val(result.category_name);
					$("#servicecategory_text_value").val(result.category_id);
					$("#service_id_text").val(result.service_name);
					$("#service_id_text_value").val(result.service_id);
				}
			}
		});
	}
}*/


/*function getsrn(s_id){
		if(s_id){
				$.ajax({
		            type: "POST",
		            dataType:'html',
		            url: "/backoffice/ticketing/default/getsrn/s_id/" + s_id,
		            beforeSend:function(){
		           
    				$("#services-error").text("Please Wait...");
    				
		            },
		            success: function(result) {	         		            		
            			$("#services-error").text("");       
            		    $("#srn_app_id").html(result);	           		            	
		            			              
		            }
		        });
		}	
	}*/
</script>
<script src="/backoffice/themes/swcsNewTheme/fb/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="/backoffice/themes/swcsNewTheme/fb/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<script src="/backoffice/themes/swcsNewTheme/fb/demo/default/custom/components/forms/wizard/ticketwizard.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript">
</script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/form-repeater.min.js" type="text/javascript">
</script>
<!-- form repeater js -->
<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
<!-- Theme framework -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/eakroko.min.js"></script>
<!-- default icons used in the plugin are from Bootstrap 5.x icon library (which can be enabled by loading CSS below) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
<!-- alternatively you can use the font awesome icon library if using with `fas` theme (or Bootstrap 4.x) by uncommenting below. -->
<!-- link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" crossorigin="anonymous" -->
<!-- the fileinput plugin styling CSS file -->
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<!-- if using RTL (Right-To-Left) orientation, load the RTL CSS file after fileinput.css by uncommenting below -->
<!-- link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/css/fileinput-rtl.min.css" media="all" rel="stylesheet" type="text/css" /-->
<!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/piexif.min.js" type="text/javascript"></script>
<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
    This must be loaded before fileinput.min.js -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/sortable.min.js" type="text/javascript"></script>
<!-- bootstrap.bundle.min.js below is needed if you wish to zoom and preview file content in a detail modal
    dialog. bootstrap 5.x or 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<!-- the main fileinput plugin script JS file -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/fileinput.min.js"></script>
<!-- following theme script is needed to use the Font Awesome 5.x theme (`fas`). Uncomment if needed. -->
<!-- script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/themes/fas/theme.min.js"></script -->
<!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/locales/LANG.js"></script>