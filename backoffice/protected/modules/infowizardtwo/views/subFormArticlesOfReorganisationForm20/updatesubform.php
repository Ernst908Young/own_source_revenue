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
<p style="color:red; font-size: 14px;">Fields marked with * are mandatory fields, however, in case any of these fields is (are) not applicable in your case, then please mention "Not Applicable" or "NA"</p>

			
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
	
	var radioForm6 = $('input[name=UK-FCL-00306_0]:checked').val(); 
	// alert(radioForm6);
	$('#div_UK-FCL-00138_0').hide();
	$("input[name=middlenamecheckbox00133_0]").attr("disabled", true);
	 // alert($('#UK-FCL-00546_0').is(':checked'));
	var form4 = $("#UK-FCL-00012_0").val();
	if(form4=='Notice of Address'){
			showregis(); 
			showmail(); 
			hidepre();
		}
   
		if(form4=='Notice of change in registered office address'){
			
			showregis(); 
			hidemail();
			showpre(); 
		}
		if(form4=='Notice of change in mailing address'){
			 hideregis();
			 showmail(); 
			 hidepre();
		}
		if(form4=='Notice of change in registered office address and mailing address'){
			showregis(); 
			showmail(); 
			showpre(); 
		}
		
	$("#UK-FCL-00012_0").on("change",function(){
		var val12 = $(this).val();
		if(val12=='Notice of Address'){
			showregis(); 
			showmail(); 
			hidepre();
		}
   
		if(val12=='Notice of change in registered office address'){
			
			showregis(); 
			hidemail();
			showpre(); 
		}
		if(val12=='Notice of change in mailing address'){
			 hideregis();
			 showmail(); 
			 hidepre();
		}
		if(val12=='Notice of change in registered office address and mailing address'){
			showregis(); 
			showmail(); 
			showpre(); 
		}
	});	
		
	var form9 = $("#UK-FCL-00533_0").val();
	// alert(form4);
	if(form9=='Notice of Director(s)'){
			$("#div_UK-FCL-00395_0").hide();
			hideappoint();
			hidecess();
			showpresent(); 
		}

		if(form9=='Notice of Change (Appointment of Director(s))'){
			$("#div_UK-FCL-00395_0").show();
			showappoint(); 
			hidecess();
			showpresent(); 
			$('#add_more_3190').hide();
			$('#tbl_3190').hide();
			$('#tbl_3190').find('tbody').empty();
			// $(result.cessation_table).appendTo($('#tbl_3190')); 
		}
		if(form9=='Notice of Change (Cessation of Director(s))'){
			$("#div_UK-FCL-00395_0").show();
			hideappoint();
			showcess(); 
			showpresent();
		}
		if(form9=='Notice of Change (Appointment and Cessation of Director(s))'){
			$("#div_UK-FCL-00395_0").show();
			showappoint(); 
			showcess();
			showpresent(); 
		}
		
	
	
	
	$("#UK-FCL-00533_0").on("change",function(){
    var val533 = $(this).val();

		if(val533=='Notice of Director(s)'){
			$("#div_UK-FCL-00395_0").hide();
			hideappoint();
			hidecess();
			showpresent(); 
		}

		if(val533=='Notice of Change (Appointment of Director(s))'){
			$("#div_UK-FCL-00395_0").show();
			showappoint(); 
			hidecess();
			showpresent(); 
			$('#add_more_3190').hide();
			$('#tbl_3190').hide();
			$('#tbl_3190').find('tbody').empty();
			// $(result.cessation_table).appendTo($('#tbl_3190')); 
		}
		if(val533=='Notice of Change (Cessation of Director(s))'){
			$("#div_UK-FCL-00395_0").show();
			hideappoint();
			showcess(); 
			showpresent();
		}
		if(val533=='Notice of Change (Appointment and Cessation of Director(s))'){
			$("#div_UK-FCL-00395_0").show();
			showappoint(); 
			showcess();
			showpresent(); 
		}

	});
	
	

	function showregis(){
    $("#form2regisaddtitle, #div_UK-FCL-00340_0, #div_UK-FCL-00341_0, #div_UK-FCL-00345_0, #div_UK-FCL-00346_0, #div_UK-FCL-00347_0").show();
   }
   function hideregis(){
	   // alert("hide");
    $("#form2regisaddtitle, #div_UK-FCL-00340_0, #div_UK-FCL-00341_0, #div_UK-FCL-00345_0, #div_UK-FCL-00346_0, #div_UK-FCL-00347_0").hide();
   }
   function showmail(){
    $("#form2mailaddtitle, #div_UK-FCL-00342_0, #div_UK-FCL-00343_0, #div_UK-FCL-00351_0, #div_UK-FCL-00349_0, #div_UK-FCL-00350_0").show();
   }
   function hidemail(){
    $("#form2mailaddtitle, #div_UK-FCL-00342_0, #div_UK-FCL-00343_0, #div_UK-FCL-00351_0, #div_UK-FCL-00349_0, #div_UK-FCL-00350_0").hide();
   }
   function showpre(){
    $("#form2preaddtitle, #div_UK-FCL-00528_0, #div_UK-FCL-00529_0, #div_UK-FCL-00531_0, #div_UK-FCL-00532_0, #div_UK-FCL-00530_0").show();
   }
   function hidepre(){
    $("#form2preaddtitle, #div_UK-FCL-00528_0, #div_UK-FCL-00529_0, #div_UK-FCL-00531_0, #div_UK-FCL-00532_0, #div_UK-FCL-00530_0").hide();
   }
   
   
	function showappoint(){
        /*$("#div_UK-FCL-00132_0, #div_UK-FCL-00105_0, #middlenamecheckbox00105_0_div, #div_UK-FCL-00106_0, #div_UK-FCL-00093_0, #div_UK-FCL-00238_0, #div_UK-FCL-00096_0, #div_UK-FCL-00129_0, #div_UK-FCL-00310_0, #div_UK-FCL-00094_0, #div_UK-FCL-00137_0").show();*/
        $("#title_UK-FCL-00132_0").closest("div.form-part").show();
    } 
   function hideappoint(){
    /*$("#div_UK-FCL-00132_0, #div_UK-FCL-00105_0, #middlenamecheckbox00105_0_div, #div_UK-FCL-00106_0, #div_UK-FCL-00093_0, #div_UK-FCL-00238_0, #div_UK-FCL-00096_0, #div_UK-FCL-00129_0, #div_UK-FCL-00310_0, #div_UK-FCL-00094_0, #div_UK-FCL-00137_0").hide();*/
    $("#title_UK-FCL-00132_0").closest("div.form-part").hide();
    } 
    function showcess(){
        $("#title_UK-FCL-00150_0").closest("div.form-part").show();
    } 
    function hidecess(){
        $("#title_UK-FCL-00150_0").closest("div.form-part").hide();
    } 
    function showpresent(){
        $("#title_UK-FCL-00172_0").closest("div.form-part").show();
    } 
    function hidepresent(){
        $("#title_UK-FCL-00172_0").closest("div.form-part").hide();
    }
	
	// alert("hdhd");
	
	$('[data-toggle="tooltip"]').tooltip();   
	
	/*$(document).on('click','.datepicker',function(){		
		$(".datepicker-days").show();	
	});*/
	
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
		
			addmoreaction(id,service_id,div_id);			
		
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