<?php
//Query for check field show editable or not	
$servID=$_GET['service_id'];
$sqlEdit="SELECT show_field_editable_or_not FROM bo_infowiz_form_builder_configuration where service_id=$servID";
$rowEditYesorNo=Yii::app()->db->createCommand($sqlEdit)->queryRow();
$classEditOrNot = "";
$classEditOrNotbut = "";
if(isset($rowEditYesorNo['show_field_editable_or_not']) && $rowEditYesorNo['show_field_editable_or_not']==1){
	$classEditOrNot = "pointer-events:none;background-color:#ccc;";
	$classEditOrNotbut = "pointer-events:none;";
}	
//Query for check field show editable or not

$clsr=0;
//echo "<pre/>"; print_r($_SESSION); die;
/* Rahul Kumar  25032018 */
$serviceIDArr = explode(".",$_GET['service_id']);
$sqlServMasterExist = Yii::app()->db->createCommand("SELECT count(*) as totExist FROM  bo_information_wizard_additional_sub_service_master WHERE id=$serviceIDArr[1] AND copy_form_fields='Y'")->queryRow();

if($sqlServMasterExist['totExist'] > 0){
	$ID = $serviceIDArr[1].'.0';
}else{
	$ID = $_GET['service_id'];
}

$submittion_id = $loggedin_userid_ = '';
$get_Subtd_app = '';
if (isset($_GET['sub_id'])) {
    $submittion_id = $_GET['sub_id'];
} else if (isset($_SESSION['RESPONSE']['user_id'])) {
    $loggedin_userid_ = @$_SESSION['RESPONSE']['user_id'];
} else
    $loggedin_userid_ = @$_SESSION['uid'];

$formCodeID_ = $_GET['formCodeID'];
$pageID_ = $_GET['pageID'];
$addMoreLineCheck=array();
if(!empty($ID)){ 
	$sql="select bo_infowiz_subform_addmore_master.* 
	from bo_infowiz_subform_addmore_master  
	inner join(
	  select 
		button_id, min(prefrence) as minpref
	  from bo_infowiz_subform_addmore_master Where is_active='Y'
	  group by button_id 
	) r
	  on bo_infowiz_subform_addmore_master.prefrence= r.minpref 
	and bo_infowiz_subform_addmore_master.button_id= r.button_id and service_id='$ID' and is_active='Y' group by r.button_id 
	order by r.minpref"; 
	$addmoreids=Yii::app()->db->createCommand($sql)->queryAll();
	foreach($addmoreids as $abn){
		$addMoreLineCheck[]=$abn['selected_field_id'];
	}
}

if($sqlServMasterExist['totExist'] > 0 && $_GET['stype']=='new')
{	
	$sqlExistLicence = "SELECT count(*) as tot FROM bo_new_application_submission WHERE service_id = $_GET[service_id] and user_id = '$loggedin_userid_' ORDER BY submission_id DESC";
	$connection=Yii::app()->db; 
	$command=$connection->createCommand($sqlExistLicence);
	$ExistLice = $command->queryRow();
	if(isset($ExistLice['tot']) && !empty($ExistLice['tot']))
	{
		$serviceIDAmedSurrRenDup = $_GET['service_id'];
	}else{
		$sqlExistLicence = "SELECT service_id FROM bo_new_application_submission WHERE submission_id = '$_GET[subID]'";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sqlExistLicence);
		$serviceArr = $command->queryRow();
		if(isset($serviceArr['service_id']) && !empty($serviceArr['service_id'])){
			$serviceIDAmedSurrRenDup = $serviceArr['service_id'];
		}else{
			$serviceIDAmedSurrRenDup = $serviceIDArr[0].'.0';
		}	
	}
		
	$ButtonsArray = Yii::app()->db->createCommand("SELECT GROUP_CONCAT(DISTINCT bo_information_wizard_form_builder.id) as bti FROM bo_infowiz_subform_addmore_master 
	INNER JOIN bo_information_wizard_form_builder ON bo_information_wizard_form_builder.id = bo_infowiz_subform_addmore_master.button_id
	INNER JOIN bo_infowizard_formvariable_master ON bo_infowizard_formvariable_master.formvar_id = bo_information_wizard_form_builder.form_field_id
	WHERE bo_infowiz_subform_addmore_master.service_id = '$serviceIDAmedSurrRenDup' and bo_infowiz_subform_addmore_master.is_active='Y'")->queryRow();
	
}else{

	$ButtonsArray = Yii::app()->db->createCommand("SELECT GROUP_CONCAT(DISTINCT bo_information_wizard_form_builder.id) as bti FROM bo_infowiz_subform_addmore_master 
	INNER JOIN bo_information_wizard_form_builder ON bo_information_wizard_form_builder.id = bo_infowiz_subform_addmore_master.button_id
	INNER JOIN bo_infowizard_formvariable_master ON bo_infowizard_formvariable_master.formvar_id = bo_information_wizard_form_builder.form_field_id
	WHERE bo_infowiz_subform_addmore_master.service_id = '$_GET[service_id]' and bo_infowiz_subform_addmore_master.is_active='Y'")->queryRow();
}
//print_r($ButtonsArray['bti']);

$ButtonsArrayNew = explode(",",$ButtonsArray['bti']);
$basePath = Yii::app()->basePath;
 $serviceIDArray = explode(".",$_GET['service_id']);


$this->renderPartial('/formBuilder/'.$serviceIDArray[0].'_'.$serviceIDArray[1].'_validation');

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
   	 $get_Subtd_app = InfowizardQuestionMasterExt::getFormApplicationSubmittedStatus($ID, $loggedin_userid_, $formCodeID_, $pageID_, $submittion_id);
    if ($submittion_id)
        $get_Subtd_app = InfowizardQuestionMasterExt::getBusinessApplicationLog($ID, $formCodeID_, $submittion_id);

    if ($get_Subtd_app) {
        $btn_name = "Submitted";
        $btn_cls = "submitted";
        $invData = InfowizardQuestionMasterExt::getUserApplicationInfo($get_Subtd_app[0]['submission_id']);
        $get_logg = InfowizardQuestionMasterExt::getApplicationLog($ID, $formCodeID_, $get_Subtd_app[0]['submission_id']);
        ?>
        <?php
        if (!empty($get_logg)) {
            $statusArray = array('A' => 'Approved', 'B' => 'Pending For Payment', 'H' => 'Reverted', 'I' => 'Incomplete', 'R' => 'Rejected', 'F' => 'Forwarded', 'Z' => 'Archived', 'P' => 'Pending');
            foreach ($get_logg as $vall) {
                if (isset($vall['action_status']))
                    $app_stat = $vall['action_status'];
                if (isset($vall['application_status']))
                    $app_stat = $vall['application_status'];
                $btn_name = $statusArray[$app_stat];
                $btn_cls = $statusArray[$app_stat];
                ?>
                <div class="col-md-12 top_tab"><strong><?php echo $get_form_name['form_name']; ?><strong>
							
                            <button class="btn white btn-outline flt_rgt <?php echo $btn_cls; ?>" rel="<?php echo $btn_cls; ?>" onclick=" $('div #<?php echo $btn_cls; ?>').toggle();"><?php echo $btn_name; ?>
                            </button>		
                            </div><br/>
                            <div class='portlet box green' id="<?php echo $btn_cls; ?>" style="display:none;">
                                <div class="portlet-body">

                                    <?php
                                    if (!empty($ID)) {
                                        $serviceID = $ID ;
										
                                        $applicantFormId = 1;
                                        $allActivePages = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$ID AND is_active='Y' AND form_id = $formCodeID_ order by prefrence ASC")->queryAll();
                                        $formData = $this->alignInSequence($ID, $applicantFormId);
                                        extract($_GET);
                                        $allProcessingFormFieldsArr = Yii::app()->db->createCommand("SELECT page_name,id FROM bo_infowiz_page_master where service_id=$ID AND is_active='Y' AND form_id = $formCodeID_ order by prefrence ASC")->queryAll();
                                         $processingformData = $this->alignInSequence($ID, $formCodeID_);
                                        if (isset($submittion_id) && !empty($submittion_id)) {
                                            $fieldValues = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id=$submittion_id")->queryRow();
                                            $fieldValues2 = (array) json_decode($fieldValues['field_value']);
                                        }
                                    }

                                    $form_data_ = (array) (json_decode($invData['field_value']));
                                   /* $this->renderPartial('subformloggerview', array('aap' => $allActivePages, 'formData' => $formData, 'fieldValues' => $form_data_, 'processingformData' => $processingformData));*/
                                    ?>  
                                </div>
                            </div>
                <?php
            }
        }
    }
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
$this->renderPartial('updatesubform/tab_name',['aap'=>$aap]);
}
?>
<div class="reservation-form p-0"> 
<!--begin: Form Wizard Form-->
<div class="m-wizard__form" style="padding: 17px 33px 0px;">
<p style="color:red; font-size: 13px;">Fields marked with * are mandatory fields, however, in case any of these fields is (are) not applicable in your case, then please mention "Not Applicable" or "NA"</p>

			
<?php 
		$action = Yii::app()->db->createCommand("SELECT  form_action_controller,form_service_js FROM bo_infowiz_form_builder_configuration where service_id=$_GET[service_id]")->queryRow();

		if(isset($action['form_action_controller']) && !empty($action['form_action_controller'])){	?> 
			<form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/infowizardtwo/".$action['form_action_controller']."/saveUpdateSubForm"); ?>" enctype="multipart/form-data">
		<?php }if((isset($_SESSION['role_id']) && $_SESSION['role_id']==63)){ ?>
			<input type="checkbox" name="show_ukfcl" id="show_ukfcl" style="float:right;">
		<?php } ?>

<input type="hidden" name="approval_id" id="approval_id" value="<?php echo @$_GET['approval_id']; ?>">
<input type="hidden" name="submission_id" id="submission_id" value="<?php echo @$_GET['subID']; ?>">
<input type="hidden" name="stype" id="stype" value="<?php echo @$_GET['stype']; ?>">
<!-- <div class="m-portlet__body m-portlet__body--no-padding"> -->

<?php 
//print_r($aap);
foreach ($aap as $pageKey => $ap) {

?>						
<div class="m-wizard__form-step" id="m_wizard_form_step_<?php echo $pageKey+1;?>">
<input type="hidden" name="service_id" value="<?php echo $serviceID; ?>">
<?php		
	$mainserviceID = $serviceIDArray[0];
			$get_selected_field = InfowizardQuestionMasterExt::get_selected_field($_GET['service_id']);							
                                       
   if(isset($sqlServMasterExist['totExist']) && $sqlServMasterExist['totExist'] > 0 && isset($_GET['stype']) && $_GET['stype']=='new'){	

		$sqlExistLicence = "SELECT count(*) as tot FROM bo_new_application_submission WHERE service_id = $_GET[service_id] and user_id = '$loggedin_userid_' ORDER BY submission_id DESC";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sqlExistLicence);
		$ExistLice = $command->queryRow();									
		
		if(isset($ExistLice['tot']) && !empty($ExistLice['tot'])){
			$serviceIDAmedSurrRenDup = $_GET['service_id'];
		}else{
			$sqlExistLicence = "SELECT service_id FROM bo_new_application_submission WHERE submission_id = '$_GET[subID]'";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sqlExistLicence);
			$serviceArr = $command->queryRow();
			if(isset($serviceArr['service_id']) && !empty($serviceArr['service_id'])){
				$serviceIDAmedSurrRenDup = $serviceArr['service_id'];
			}else{
				$serviceIDAmedSurrRenDup = $serviceIDArray[0].'.0';
			}	
		}
											
		$allData23 = InfowizardQuestionMasterExt::getsubmittedvalues($serviceIDAmedSurrRenDup,$_GET['subID']);
											
	}else{									
		$allData23 = InfowizardQuestionMasterExt::getsubmittedvalues($_GET['service_id'],$_GET['subID']);
	}
										
	$btnArray=array();
	$allDataMappedWithButton=array();
	if(isset($get_selected_field) && !empty($get_selected_field)){
		foreach($get_selected_field as $gsf){
			$btnArray[]=$gsf['button_id'];
			$btnID=$gsf['button_id'];
			$sfArray[]=$gsf['selected_field_id'];

			if(!isset($allDataMappedWithButton[$btnID])){
				$allDataMappedWithButton[$btnID]=array();
			}
			$allDataMappedWithButton[$btnID][]=$gsf['formchk_id'];
		}
	}					
$serviceDetail = Yii::app()->db->createCommand("SELECT issuerby_id from bo_information_wizard_service_master where id=$mainserviceID")->queryRow();
$issuerByID = $serviceDetail['issuerby_id'];
?>
<input type="hidden" name="issuer_id" value="<?php echo $issuerByID; ?>">



							
<?php 

$this->renderPartial('updatesubform/section_category',['formData'=>$formData,'ap'=>$ap,'addMoreLineCheck'=>$addMoreLineCheck,'classEditOrNot'=>$classEditOrNot,'fieldValues'=>$fieldValues,'ButtonsArrayNew'=>$ButtonsArrayNew,'get_selected_field'=>$get_selected_field,'allData23'=>$allData23,'allDataMappedWithButton'=>$allDataMappedWithButton]); ?>
							
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
<!-- </div> -->
<?php if($_GET['subID']){
		$app_id = $_GET['subID'];
	 ?>

			<a href="/backoffice/infowizardtwo/formBuilder/resetData/submission_id/<?= base64_encode($app_id) ?>" data-method="post" class="custome-btn reset_btn" onclick="return confirm('This will clear the entire form. Do you want to proceed ?')">
				<span>
					<i class="fa fa-undo"></i>
					&nbsp;&nbsp;
					<span>
						Reset
					</span>
				</span>
			</a>
		<?php } ?>
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
	<a href="javascript:void(0);" class="custome-btn" data-wizard-action="next" rel="<?php echo @$_GET['service_id']?>" >
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
	
	var middle = $("#UK-FCL-00105_0").val();
	if(middle == ''){
		$("#UK-FCL-00105_0").attr('readonly', true);
		$("input[name=middlenamecheckbox]").prop('checked', true);
	}else{
		$("#UK-FCL-00105_0").attr('readonly', false);
		$("input[name=middlenamecheckbox]").prop('checked', false);
	}
	
	$("#UK-FCL-00675_0").on("change",function(){
		if($(this).val()){
			if($(this).val()=="Company other than Unregistered External Company" || $(this).val()=="Society"){
					one_show(); 
				}else{
				one_hide();
			}
			if($(this).val()=="Unregistered External Company"){
				two_show(); 
			}else{
				two_hide();
			}
		  
		}
	});
	
	// 1	
	var check = $('input[name="UK-FCL-00693_0"]:checked').val();
	if(check == "No"){
		$("#UK-FCL-00617_0").attr("readonly",true);             
    
	}
	// 2	
	var check = $('input[name="UK-FCL-00694_0"]:checked').val();
	if(check == "No"){
		$("#UK-FCL-00636_0").attr("readonly",true);             
    
	}
	// 3	
	var check = $('input[name="UK-FCL-00695_0"]:checked').val();
	if(check == "No"){
		$("#UK-FCL-00637_0").attr("readonly",true);             
    
	}
	// 4	
	var check = $('input[name="UK-FCL-00696_0"]:checked').val();
	if(check == "No"){
		$("#UK-FCL-00689_0").attr("readonly",true);             
    
	}
	// 5	
	var check = $('input[name="UK-FCL-00697_0"]:checked').val();
	if(check == "No"){
		$("#UK-FCL-00698_0").attr("readonly",true);             
    
	}
	
	var data = $("#UK-FCL-00675_0").val();
	if(data){
			if(data == "Company other than Unregistered External Company" || data == "Society"){
				one_show(); 
			}else{
				one_hide();
			}
			if(data == "Unregistered External Company"){
				two_show(); 
			}else{
				two_hide();
			}
		  
		}
		
	$('[data-toggle="tooltip"]').tooltip();   
	
	/*$(document).on('click','.datepicker',function(){		
		$(".datepicker-days").show();	
	});*/
	
	
	function one_show(){
    $("#div_UK-FCL-00650_0").show();
    $("#div_UK-FCL-00651_0").show();
	}
	function one_hide(){
		$("#div_UK-FCL-00650_0").hide();
		$("#div_UK-FCL-00651_0").hide();
	}
	function two_show(){
		$("#div_UK-FCL-00676_0").show();
		$("#div_UK-FCL-00677_0").show();
	   
	}
	function two_hide(){
		$("#div_UK-FCL-00676_0").hide();
		$("#div_UK-FCL-00677_0").hide();
		
	}

	var date = new Date();
	date.setDate(date.getDate());
	
	<?php 
	$serviceArr = array('2.0','4.0','7.0','16.0','13.0','15.0');
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
			changeYear: true
		});
	<?php } } ?>
	$(".ukfcl").hide();
	/* Add more  */

	$('.add-more-btn').on('click', function () {		
		var id = $(this).attr("rel");
		var service_id = $(this).attr("relf");
		var div_id = $(this).attr("relid");		
		// this code was written by aamir
		if(service_id=='4.0' || service_id=='7.0' || service_id=='8.0' ||service_id=='6.0' ||service_id=='5.0' || service_id=='9.0' || service_id=='10.0' || service_id=='12.0' || service_id=='14.0' || service_id=='13.0'){			
			addmoreaction(id,service_id,div_id);			
		}
		else{
		// end aamir code
		$.ajax({
			type: "GET",
			dataType: 'json',
			data: {"button_id": id, "service_id": service_id, "add_more_button_di": div_id},
			url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formFieldMaster/getAddmoreData",
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
					//console.log(selector);
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
							if($("#UK-FCL-00044_0").val()=='3' && (formchk_id=='UK-FCL-00065_0' || formchk_id=='UK-FCL-00066_0'))
							{
								$("input[name*='UK-FCL-00066_0']").removeClass('val');
								$("input[name*='UK-FCL-00065_0']").removeClass('val');
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
						//alert(formchk_id);
						$("#div_"+formchk_id).append("<span style='color:red;padding-left:16px;' class='errorDetail'>Please fill the required field: "+$.trim(labelData)+"</span>");
						//alert("Please fill the required field:  " + $.trim(labelData));
						err = err + 1;
						return false;
					}
					else {
						$(".errorDetail").remove();
						//console.log(typeVal);
						td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
						fieldsIDArr.push(formchk_id);						
					}

				}); //each loop end here
				if (err == 0) {
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
}
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
<script type="text/javascript">
function deleterow(id,table_id){
	if(confirm('Are you sure to delete the record?')) 
		{
			var i = id.parentNode.parentNode.rowIndex;
			document.getElementById("tbl_"+table_id).deleteRow(i);	
		}	
	}
</script>
