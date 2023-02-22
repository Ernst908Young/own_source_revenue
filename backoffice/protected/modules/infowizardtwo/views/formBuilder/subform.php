<title>Digital Platform For Corporate Affairs Services</title>
<?php
$ID = $_GET['service_id'];
$submittion_id = $loggedin_userid_ = $get_Subtd_app = '';

if (isset($_SESSION['RESPONSE']['user_id'])) {
    $loggedin_userid_ = @$_SESSION['RESPONSE']['user_id'];
} else
    $loggedin_userid_ = @$_SESSION['uid'];

$formCodeID_ = $_GET['formCodeID'];
$pageID_ = $_GET['pageID'];

$serviceIDArray = explode(".", $serviceID);
$mainserviceID = $serviceIDArray[0];
// echo $serviceIDArray[0].'_'.$serviceIDArray[1];die;
$this->renderPartial($serviceIDArray[0].'_'.$serviceIDArray[1].'_validation',array('service_id'=>$ID));


?>


<!-- <link href="<?= Yii::app()->theme->baseUrl ?>/css/custom.css" rel="stylesheet" type="text/css" /> -->
<!-- <script src="<1?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> -->
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!--  <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<!--  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
 

<?php $get_form_name = InfowizardQuestionMasterExt::getFormNameFrmMap($ID, $formCodeID_);
	//print_r($get_form_name);  die();//This varial gives Form Name like Company Incorporation Form

$btn_name = "Start";
$frm_styl = "display:none";

if (isset($submittion_id) && !empty($submittion_id)) {
   
} else {

    $frm_styl = "display:none";
    $btn_cls = "start";
    ?>
		<link href="/backoffice/themes/swcsNewTheme/fb/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/backoffice/themes/swcsNewTheme/fb/demo/default/base/sp.css" rel="stylesheet" type="text/css" />

<div class="dashboard-home">
	<div class="applied-status">
		<div class="status-title d-flex flex-wrap align-items-center justify-content-between">
		    <h4><?= $get_form_name['form_name'] ?></h4>
		</div>
	</div>
</div>
		
       
		<!--begin: Portlet Body-->
		  
				<!--begin: Form Wizard-->
<div class="m-wizard m-wizard--3 m-wizard--success" id="m_wizard">
					<!--begin: Message container -->
					
					<!--end: Message container -->
					<!-- <div class="row m-row--no-padding"> -->
						<!-- <div class="col-md-12 uiui"> -->
							
<?php						
if(($_GET['formCodeID']==1) || (isset($_SESSION['role_id']) && $_SESSION['role_id']==63) )
{ 
$this->renderPartial('subform/tab_name',['aap'=>$aap]);
}
?>
<div class="reservation-form p-0"> 
<!--begin: Form Wizard Form-->
<div class="m-wizard__form" style="padding: 17px 33px 0px;">
<p style="color:red; font-size: 14px;">Fields marked with * are mandatory fields, however, in case any of these fields is (are) not applicable in your case, then please mention "Not Applicable" or "NA"</p>




 
	  
	  
	  


<?php //print_r($default_form_data); ?>
			
<?php 
$action = Yii::app()->db->createCommand("SELECT  form_action_controller,form_service_js FROM bo_infowiz_form_builder_configuration where service_id=$_GET[service_id]")->queryRow();
if(isset($action['form_action_controller']) && !empty($action['form_action_controller']))
{ 
?> 
<form  id="m_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/infowizardtwo/".$action['form_action_controller']."/saveData"); ?>" enctype="multipart/form-data">
<?php 
}
if((isset($_SESSION['role_id']) && $_SESSION['role_id']==63)){
?>
<input type="checkbox" name="show_ukfcl" id="show_ukfcl" style="float:right;">
<?php
} 
?>

<!-- <div class="m-portlet__body m-portlet__body--no-padding"> -->

<?php 
//print_r($aap);
foreach ($aap as $pageKey => $ap) {

?>						
<div class="m-wizard__form-step" id="m_wizard_form_step_<?php echo $pageKey+1;?>">
<input type="hidden" name="service_id" value="<?php echo $serviceID; ?>">
<?php							
$serviceDetail = Yii::app()->db->createCommand("SELECT issuerby_id from bo_information_wizard_service_master where id=$mainserviceID")->queryRow();
$issuerByID = $serviceDetail['issuerby_id'];
?>
<input type="hidden" name="issuer_id" value="<?php echo $issuerByID; ?>">

<?php if(isset($postedData['user_id']) && !empty($postedData['user_id'])){  ?>
<input type="hidden" name="user_id" id="user_id" value="<?php echo @$postedData['user_id']; ?>">
<input type="hidden" name="iuid" id="iuid" value="<?php echo @$postedData['iuid']; ?>">
<?php } ?>
<input type="hidden"  id="prestep" >
							
<?php 

$this->renderPartial('subform/section_category',['formData'=>$formData,'ap'=>$ap,'serviceID'=>$serviceID]); ?>
							
								</div>
								<!--end: Form Wizard Step 1-->
				  <?php } ?>
		
				<!-- </div> -->
						<!--end: Form Body -->
						<!--begin: Form Actions -->
							<!-- <div class="m-portlet__foot m-portlet__foot--fit m--margin-top-40" >
								<div class="m-form__actions"> -->
									<!-- <div class="row">
									<div class="col-md-12" style="padding-top: 40px;"> -->
<div class="next-btn">   
  

				<!-- <div class="col-lg-6 m--align-left back"> -->
	<a href="javascript:void(0);" class="custome-btn back_btn" data-wizard-action="prev">
		<span>
			<i class="fa fa-arrow-left"></i>
			&nbsp;&nbsp;
			<span>
				Back
			</span>
		</span>
	</a>

	<a href="" class="custome-btn reset_btn" data-wizard-action="reset" onclick="return confirm('This will clear the entire form. Do you want to proceed ?')">
		<span>
			<i class="fa fa-undo"></i>
			&nbsp;&nbsp;
			<span>
				Reset
			</span>
		</span>
	</a>
<!-- </div> -->
<!-- <div class="col-lg-6 m--align-right"> -->
	<a href="javascript:void(0);" class="submitForm custome-btn" data-wizard-action="submit" rel="<?php echo @$_GET['service_id']?>">
		<span>
			<i class="fa fa-check"></i>
			&nbsp;&nbsp;
			<span>
				Submit
			</span>
		</span>												
	</a>

	<a href="javascript:void(0);" class="next_btn custome-btn" data-wizard-action="next" rel="<?php echo @$_GET['service_id']?>" >
		<span>
			<span>
				Next
				<!-- Save & Continue -->
			</span>
			&nbsp;&nbsp;
			<i class="fa fa-arrow-right"></i>
		</span>
	</a>
<!-- </div> -->
</div>
									<!-- 	</div>
									</div> -->
								<!-- </div>
							</div> -->
							<!--end: Form Actions -->
</form>
					<!-- </div> -->
					<!--end: Form Wizard Form-->
				
		
</div>
<!--end: Form Wizard-->

</div>
</div>
	<!--end: Portlet Body-->
	<!-- begin::Quick Nav -->	
	<!--begin::Base Scripts -->
	<script src="/backoffice/themes/swcsNewTheme/fb/vendors/base/vendors.bundle.js" type="text/javascript"></script>
	<script src="/backoffice/themes/swcsNewTheme/fb/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
	<!--end::Base Scripts -->   
	<!--begin::Page Resources -->	
	<?php if(isset($action['form_service_js']) && !empty($action['form_service_js'])){ ?>		
		<script src="/backoffice/themes/swcsNewTheme/fb/demo/default/custom/components/forms/wizard/<?php echo @$action['form_service_js'];?>" type="text/javascript"></script>
	<?php }?>
	<!--end::Page Resources -->
		<script src="/backoffice/themes/swcsNewTheme/fb/demo/default/custom/components/forms/wizard/mainerrmessage.js" type="text/javascript"></script>
	
<?php 
	} 
	?>
<!-- datepicker js -->

<!-- <script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script> -->
<!--<script src="<?= Yii::app()->theme->baseUrl ?>/js/typeahead.min.js" type="text/javascript"></script>-->
<!-- datepicker js -->

<!-- form repeater js -->
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
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

<script type="text/javascript">
$(document).ready(function () {
		
	$('[data-toggle="tooltip"]').tooltip();   
	
	/*$(document).on('click','.datepicker',function(){		
		$(".datepicker-days").show();	
	});*/
	
	var date = new Date();
	date.setDate(date.getDate());
	
	<?php 
	$serviceArr = array('2.0','4.0','7.0','16.0','18.0','13.0','12.0','15.0','17.0','22.0','23.0','24.0','25.0','29.0','32.0','37.0','38.0','43.0','19.0','20.0','45.0','36.0');
	if(in_array($_GET['service_id'],$serviceArr))
	{	

	?>
	
		$(".datepicker").datepicker({
			changeMonth: true,
			changeYear: true,
			maxDate: date,
			dateFormat: 'dd/mm/yy'
		});
	<?php 
	}else{
		if($_GET['service_id']=="8.0"){ ?>

			$('#UK-FCL-00218_0').datepicker({
				  changeMonth: true,
				  changeYear: true,
			      dateFormat: 'dd/mm/yy',
			      autoclose:true,
			      maxDate: date
			      });
    		$("#UK-FCL-00253_0").datepicker({
					changeMonth: true,
					changeYear: true,
					minDate: date,
					dateFormat: 'dd/mm/yy'
				});
		<?php }else{ ?>
		$(".datepicker").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd/mm/yy'
		});
	<?php } } ?>
	$(".ukfcl").hide();
	/* Add more  */
	
	$('.add-more-btn').on('click', function () {		
		var id = $(this).attr("rel");
		var service_id = $(this).attr("relf");
		var div_id = $(this).attr("relid");		
		// this code was written by aamir
		/*if(service_id=='2.0' || service_id=='4.0' ||  service_id=='7.0' || service_id=='8.0' ||service_id=='6.0' ||service_id=='5.0' || service_id=='9.0' || service_id=='10.0' || service_id=='12.0' || service_id=='14.0' || service_id=='13.0' || service_id=='17.0' || service_id=='23.0' || service_id=='22.0' || service_id == '21.0'|| service_id == '24.0' || service_id == '25.0' || service_id == '28.0' || service_id == '29.0' || service_id == '30.0' || service_id == '31.0' || service_id == '32.0'){	*/		
			addmoreaction(id,service_id,div_id);			
		/*}else{

	
		$(".form-control-feedback-addmore").remove();
		$.ajax({
			type: "GET",
			dataType: 'json',
			data: {"button_id": id, "service_id": service_id, "add_more_button_di": div_id},
			url: "<1?php echo Yii::app()->request->baseUrl; ?>/infowizardtwo/formFieldMaster/getAddmoreData",
			success: function (data) {
				console.log(data);
				var tr_ = "<tr class='add_more_"+div_id+"'>";
				var td_ = '';
				var err = 0;
				var fieldsIDArr = new Array();
				$.each(data, function (key, item) {
					var id = item.id;
					var vall;
					var typeVal;
					var name = item.full_name;
					var formchk_id = item.formchk_id;
					var selector = $('[name="' + formchk_id + '"]');
					var cls = '';
				
					if ($(selector).is("input")) {
						if ($("input:radio[name='" + formchk_id + "']").attr('type') == 'radio') {
							vall = $("input:radio[name='" + formchk_id + "']:checked").val();
							typeVal = 'radio';
							$("input:radio[name='" + formchk_id + "']").addClass('val');
							if ($("input:radio[name='" + formchk_id + "']").hasClass('val')) {
								cls = 'val';
							}
						}else if ($("input[name='" + formchk_id + "']").attr('type') == 'number') {
							vall = $("input[name='" + formchk_id + "']").val();
							typeVal = 'number';
							$("input[name='" + formchk_id + "']").addClass('val');
							if ($("input[name='" + formchk_id + "']").hasClass('val')) {
								cls = 'val';
							}							
						}
						else {
							vall = $("input[name='" + formchk_id + "']").val();
							typeVal = 'text';
							$("input:text[name='" + formchk_id + "']").addClass('val');
							if ($("input[name*='" + formchk_id + "']").hasClass('val')) {
								cls = 'val';
							}
							if($("#UK-FCL-00044_0").val()=='3' && (formchk_id=='UK-FCL-00065_0' || formchk_id=='UK-FCL-00066_0' || formchk_id=='UK-FCL-00376_0' || formchk_id=='UK-FCL-00081_0' || formchk_id=='UK-FCL-00086_0'))
							{
								$("input[name*='UK-FCL-00066_0']").removeClass('val');
								$("input[name*='UK-FCL-00065_0']").removeClass('val');
								$("input[name*='UK-FCL-00376_0']").removeClass('val');
								$("input[name*='UK-FCL-00081_0']").removeClass('val');
								$("input[name*='UK-FCL-00086_0']").removeClass('val');
								cls = '';
							}
							if($("#UK-FCL-00044_0").val()=='3' && $("#UK-FCL-00068_0").val()=='Not Applicable' && (formchk_id=='UK-FCL-00072_0' || formchk_id=='UK-FCL-00069_0' || formchk_id=='UK-FCL-00070_0' || formchk_id=='UK-FCL-00071_0'))
							{
								$("input[name*='UK-FCL-00069_0']").removeClass('val');
								$("input[name*='UK-FCL-00070_0']").removeClass('val');
								$("input[name*='UK-FCL-00071_0']").removeClass('val');
								$("input[name*='UK-FCL-00072_0']").removeClass('val');
								cls = '';
							}
						}

					}
					else if ($(selector).is("select") || $('#' + formchk_id).is("select")) {						
						if ($('#' + formchk_id).prop('multiple')) {
							typeVal = 'multiple';
							var selMulti = $.map($("#" + formchk_id + " option:selected"), function (el, i) {
								return $(el).text();
							});
							vall = selMulti.join(", ");
							$('#' + formchk_id).addClass('val');
							if ($('#' + formchk_id).hasClass('val')) {
								cls = 'val';
							}
							$("#" + formchk_id + " option").removeAttr("selected");
						}
						else {	
							typeVal = 'dropdown';
							vall = $("select[name='" + formchk_id + "'] option:selected").text();
							$("select[name='" + formchk_id + "']").addClass('val');	
							if ($("select[name='" + formchk_id + "']").hasClass('val')) {
								cls = 'val';
							}
							$("#" + formchk_id + " option").removeAttr("selected");
						}
					}
					else if ($(selector).is("textarea")) {	
						typeVal = 'textarea';
						vall = $("textarea[name='" + formchk_id + "']").val();
						$("textarea[name='" + formchk_id + "']").addClass('val');
						if ($("textarea[name='" + formchk_id + "']").hasClass('val')) {
							cls = 'val';
						}
					}
					else if ($('.chk_' + formchk_id).is(':checkbox')) {
						typeVal = 'checkbox';
						vall = $('.chk_' + formchk_id + ':checked').map(function () {
							return this.value;
						}).get().join(',');
						$('.chk_' + formchk_id).addClass('val');
						if ($('.chk_' + formchk_id).hasClass('val')) {
							cls = 'val';
						}	
					}
					if (cls == 'val' && (vall == '' || vall == 'undefined' || vall == 'Please Select ')) {
						var labelData = $("#label_" + formchk_id).text();
						labelData=labelData.replace('('+formchk_id+')',"");
						//

						if(div_id==95){
							
							if(formchk_id=='UK-FCL-00065_0'){
										var mnt = $("#UK-FCL-00065_0").val();
										if(mnt){
											var checkfield = true;
										}else{
											var mncb = $('input[name=checkbox_UK-FCL-00065_0]:checked').val(); 
											if(mncb){
												var checkfield = true;
											}else{
												var checkfield = false;
											}
										}
									}else{
										var checkfield = true;
									}

									if(formchk_id=='UK-FCL-00068_0'){
										var mnt = $("#UK-FCL-00068_0").val();
										if(mnt){
											var check1field = true;
										}else{
											var mncb = $('input[name=checkbox_UK-FCL-00068_0]:checked').val(); 
											if(mncb){
												var check1field = true;
											}else{
												var check1field = false;
											}
										}
									}else{
										var check1field = true;
									}

									if(formchk_id=='UK-FCL-00069_0'){
										var mnt = $("#UK-FCL-00069_0").val();
										if(mnt){
											var check2field = true;
										}else{
											var mncb = $('input[name=checkbox_UK-FCL-00069_0]:checked').val(); 
											if(mncb){
												var check2field = true;
											}else{
												var check2field = false;
											}
										}
									}else{
										var check2field = true;
									}

									if(formchk_id=='UK-FCL-00064_0' || checkfield==false || check1field==false || check2field==false || formchk_id=='UK-FCL-00067_0' || formchk_id=='UK-FCL-00074_0' || formchk_id=='UK-FCL-00073_0' || formchk_id=='UK-FCL-00075_0' || formchk_id=='UK-FCL-00076_0' || formchk_id=="UK-FCL-00077_0" || formchk_id=="UK-FCL-00078_0" || formchk_id=="UK-FCL-00082_0" || formchk_id=="UK-FCL-00376_0" || formchk_id=="UK-FCL-00080_0" || formchk_id=="UK-FCL-00083_0"){
									
									var labelData = $("#label_" + formchk_id).text();

									labelData=labelData.replace('('+formchk_id+')',"");
									//alert(formchk_id);
									if(formchk_id=="UK-FCL-00065_0" || formchk_id=="UK-FCL-00068_0" | formchk_id=="UK-FCL-00069_0"){
										$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>Please enter the required information or select the check box</div>");
										//$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>Please fill the required field: Please enter the required information or select the check box</span>");	
											
									}else{
										$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");
										//$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>Please fill the required field: "+$.trim(labelData)+"</span>");								
									}
															
									err = err + 1;
									return false;
									}else{
										$(".errorDetail").remove();	
										td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' title='"+vall+"'  readonly/></td>";
													fieldsIDArr.push(formchk_id);		
									}

						}else{
							$("#input_"+formchk_id).append("<div class='form-control-feedback-addmore'>This field is required</div>");
							//$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>Please fill the required field: "+$.trim(labelData)+"</span>");						
								err = err + 1;
								return false;
						}
						
					}
					else {
						$(".form-control-feedback-addmore").remove();
						//$(".errorDetail").remove();
						//console.log(typeVal);
						td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' title='"+vall+"'  readonly/></td>";
						fieldsIDArr.push(formchk_id);						
					}

				}); //each loop end here
				if (err == 0) {
					
					if(confirm('Before adding, please check whether the details entered is correct')){					
						$('#add_more_' + div_id).show();
						$('#tbl_' + div_id).show();
						td_ += "<td style='text-align:center;'><a class='btn btn-danger del_1' pi='add_more_"+div_id+"'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
						tr_ += td_ + "</tr>";
						$(tr_).appendTo($('#tbl_' + div_id));
						//alert(fieldsIDArr);
						fieldsIDArr.forEach(myFunction);
						function myFunction(value, index, array) {	
							$("input:radio[name='" + value + "']").prop('checked', false);
							$('#' + value).val("");
							$("#" + value + "").select2("val", "");
							$('.chk_' + value + ':checked').removeAttr('checked');
						}
						if(div_id == '789'){
							$("#UK-FCL-00294_11").removeClass("required"); 
							$("#UK-FCL-00002_7").removeClass("required");
							$("#UK-FCL-00026_0").removeClass("required");
							$("#UK-FCL-00009_4").removeClass("required"); 
							$("#UK-FCL-00029_0").removeClass("required");
						}
						if(div_id == '788'){
						   $("#UK-FCL-00025_0").removeClass("required");
						   $("#UK-FCL-00294_11").removeClass("required");
						   $("#UK-FCL-00002_7").removeClass("required");
						   $("#UK-FCL-00027_0").removeClass("required"); 
						   $("#UK-FCL-00028_0").removeClass("required"); 
						   $("#UK-FCL-00026_0").removeClass("required");
						}
					}	
					
				} else
					return false;
                                    
				$('.del_1').on('click', function () {					
					$(this).closest('tr').remove();
					var uio= $(this).attr('pi');
					if($("."+uio).length<2){
						$("#"+uio).css('display','none');
					}
                                        
				});
			} // success function close here
		}); //ajax end here
}*/
	}); // add more on click function end here


	$("#show_ukfcl").on('click', function () {
		$(".ukfcl").toggle();
	});
	$('.start').on('click', function () {
		$('div #start').toggle();
	});

	$('div #start').toggle();
		/* $(".submitForm").click(function(){
		  document.getElementById("m_form").submit(); 
		}); */
	});
	
	$('.copyField').on('click', function() {
        if ($(this).prop("checked") == true) {
            var relStr = $(this).attr('rel');
            var str_array = relStr.split(':');
            for (var i = 0; i < str_array.length; i++) {
                //console.log(str_array[i]);
                var fieldStr = str_array[i].split('~');               
                $("#" + fieldStr[1]).val($("#" + fieldStr[0]).val());
            }
        }
    }); 

   
</script>   
<!--<div id="confirm" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				Are you sure?
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-primary" id="yes">Yes, correct</button>
				 <button type="button" class="btn btn-default" data-dismiss="modal" id="close">Close</button>
			</div>
		</div>	
	</div>
</div>-->
