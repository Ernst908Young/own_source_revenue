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
?>

<?php 
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

$ButtonsArrayNew = explode(",",$ButtonsArray['bti']);
$basePath = Yii::app()->basePath;
if(isset($_GET['service_id'])){
	$ss=explode(".", $_GET['service_id']);
	include_once($basePath."/modules/infowizard/views/formBuilder/".$ss[0].'_'.$ss[1]."_validation.php");
}
?>
<link href="<?= Yii::app()->theme->baseUrl ?>/css/update_custom.css" rel="stylesheet" type="text/css" />
<link href="/backoffice/themes/swcsNewTheme/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<?php
include($_SERVER["DOCUMENT_ROOT"] . '/backoffice/themes/swcsNewTheme/views/layouts/subfromtabs.php');
$get_form_name = InfowizardQuestionMasterExt::getFormNameFrmMap($ID, $formCodeID_);
//print_r($get_form_name); die;
?>
<?php
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
                                    $this->renderPartial('subformloggerview', array('aap' => $allActivePages, 'formData' => $formData, 'fieldValues' => $form_data_, 'processingformData' => $processingformData));
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
		
		
        <!--begin::Base Styles -->
		<link href="/backoffice/themes/swcsNewTheme/fb/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/backoffice/themes/swcsNewTheme/fb/demo/default/base/sp.css" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<!--<link rel="shortcut icon" href="/backoffice/themes/swcsNewTheme/images/favicon.ico" />-->
	
	
		
	<!--begin: Portlet Body-->
							<div class="m-portlet__body m-portlet__body--no-padding  ooooo">
								<!--begin: Form Wizard-->
								<div class="m-wizard m-wizard--3 m-wizard--success" id="m_wizard">
									<!--begin: Message container -->
									<div class="m-portlet__padding-x">
										<!-- Here you can put a message or alert -->
									</div>
									<!--end: Message container -->
									<div class="row m-row--no-padding" style="background-color: #fff;">
									  <div class="col-md-12 uiui">
										  <?php if($_GET['formCodeID']==1){ ?>
										  <div class="col-md-2" style="background-color: #fff;">
                                                                                  
											<!--begin: Form Wizard Head -->
											<div class="m-wizard__head" style="padding: 20px 0px 5px 0px !important;">
												<!--begin: Form Wizard Progress -->
												<div class="m-wizard__progress"> 
													<div class="progress">
														<div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
													</div>
												</div>
												<!--end: Form Wizard Progress --> 
			            <!--begin: Form Wizard Nav -->
												<div class="m-wizard__nav">
													<div class="m-wizard__steps">
												  <?php foreach ($aap as $pageKey => $ap) 
														{ 
														?>
															<div class="m-wizard__step m-wizard__step--current" m-wizard-target="m_wizard_form_step_<?php echo $pageKey+1; ?>">
																<div class="m-wizard__step-info">
																	<a href="#" class="m-wizard__step-number">
																		<span>
																			<span>
																				<?php echo $pageKey+1; ?>
																			</span>
																		</span>
																	</a>
																	<div class="m-wizard__step-line">
																		<span></span>
																	</div>
																	<div class="m-wizard__step-label">
																		<?php echo $ap['page_name']; ?>
																	</div>
																</div>
															</div>                                    
													<?php 
														} 
													?>
													</div>
												</div>
												<!--end: Form Wizard Nav -->
											</div>
											<!--end: Form Wizard Head -->
										</div>
                                                                                  <?php } ?>
										<div class="col-md-10" style="background-color: #fff;">
											<!--begin: Form Wizard Form-->
											<div class="m-wizard__form"><p style="color:red;">Fields marked with * are mandatory fields, however, in case any of these fields in not applicable in your case, then please mention "Not Applicable" or "NA"</p>
												<!--
							1) Use m-form--label-align-left class to alight the form input lables to the right
							2) Use m-form--state class to highlight input control borders on form validation
						-->
					<?php 
					$action = Yii::app()->db->createCommand("SELECT  form_action_controller,form_service_js FROM bo_infowiz_form_builder_configuration where service_id=$_GET[service_id]")->queryRow();
					if(isset($action['form_action_controller']) && !empty($action['form_action_controller']))
					{ 
					?> 
						<form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/infowizard/".$action['form_action_controller']."/saveUpdateSubForm"); ?>" enctype="multipart/form-data">
					<?php } ?>
						<input type="checkbox" name="show_ukfcl" id="show_ukfcl" style="float:right;">
						<input type="hidden" name="approval_id" id="approval_id" value="<?php echo @$_GET['approval_id']; ?>">
						<input type="hidden" name="submission_id" id="submission_id" value="<?php echo @$_GET['subID']; ?>">
						<input type="hidden" name="stype" id="stype" value="<?php echo @$_GET['stype']; ?>">
						<!--begin: Form Body -->
						<div class="m-portlet__body m-portlet__body--no-padding">
						<?php  foreach ($aap as $pageKey => $ap) { ?>
							<!--begin: Form Wizard Step 1-->
							<div class="m-wizard__form-step" id="m_wizard_form_step_<?php echo $pageKey+1;?>">
							<input type="hidden" name="service_id" value="<?php echo $serviceID; ?>">

                                        <?php
										
                                        $serviceIDArray = explode(".",$_GET['service_id']);
                                        $mainserviceID = $serviceIDArray[0];
										$get_selected_field = InfowizardQuestionMasterExt::get_selected_field($_GET['service_id']);
										
										
										if(isset($sqlServMasterExist['totExist']) && $sqlServMasterExist['totExist'] > 0 && isset($_GET['stype']) && $_GET['stype']=='new'){	
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
										//print_r($allDataMappedWithButton);die;
                                        $serviceDetail = Yii::app()->db->createCommand("SELECT issuerby_id from bo_information_wizard_service_master where id=$mainserviceID")->queryRow();
                                        $issuerByID = $serviceDetail['issuerby_id'];
                                        ?>
                                        <input type="hidden" name="issuer_id" value="<?php echo $issuerByID; ?>">
                                        <?php
                                        $pageID = $_GET['pageID'];
                                        $categoryPreference = array();
										
                                        foreach($formData as $key => $fd) {
                                        
                                            if ($ap['id'] == $fd['page_name']) {
                                                 // echo $ap['id']."==".$fd['page_name']."==m_wizard_form_step_".($pageKey+1)."///";
                                        
                                                $inputType = $fd['input_type'];
                                                $minLength = $fd['min_length'];
                                                $maxLength = $fd['max_length'];
                                                $button_id = $fd['id'];

                                                $_exist_addmore_table = InfowizardQuestionMasterExt::checkExist($fd['service_id'], $fd['page_name'], $fd['id']);
                                                if ($_exist_addmore_table && $fd['is_required'] == 'Y'){
                                                    $val_cls = 'val';
												}	
                                                else{
                                                    $val_cls = '';
												}	
                                                $id = $fd['id'];

                                                if (!in_array($fd['category_id'], $categoryPreference)) {
                                                    $keyy = -1;
                                                    $categoryPreference[] = $fd['category_id'];
													$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
                                                    ?>
                                                    </br>
                                                    <div class="row"></div><?php //echo $fd['category_id'];?>
                                                    <div class="portlet-title" id="title_<?php echo $tablefieldname;?>">														
                                                        <div class="caption">
                                                            <i class="fa fa-tags font-red-sunglo"></i>
                                                            <span class="caption-subject font-red-sunglo bold uppercase">
                                                            <?php echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowiz_form_categories', $fd['category_id'], 'category_name', 'id'); 
															$fieldList=InfowizardQuestionMasterExt::getCopyofFields($_GET['service_id'],$fd['category_id']);
															?>
                                                            </span>
															<span class="pull-right">
															<?php 
															if(isset($fieldList) && !empty($fieldList))
															{
																$field = explode("=",$fieldList);
															?>
															&nbsp;&nbsp;<input type="checkbox" name="<?php echo @$field[0]; ?>" style="float:right;" class="copyField" rel="<?php echo @$field[1];?>"><span style="float:left;">Same as SWCS Registration Details</span>

															<?php	
															}															
															?>
															</span>
                                                        </div>
														<?php
														if($tablefieldname=="UK-FCL-00045_2")
														{
														?>
															<span id="errors_skill" style="color:red"></span>
														<?php 														
														}
														?>
                                                        <div class="actions">
                                                            <div class="portlet-input input-inline input-small">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr id="hr_<?php echo $tablefieldname;?>">
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                                if ($keyy % 2 == 0) {
                                                    echo "<div class=''>";
                                                }
                                                $keyy = $keyy + 1;
                                                ?>
								
                                                    
                                                   <?php    if ($inputType == "html") {
                                                       
                                                     
                                                       $sql="select * from bo_infowiz_form_builder_html_container where mapped_form_field_primary_id=$fd[id] AND is_active='Y'";
                                                       $result = Yii::app()->db->createCommand($sql)->queryRow(); 
                                                         //echo "here";
                                                         
                                                       echo @$result['html_content'];
                                                   }
                                               
                                                // Genrating text field for type text and number 
                                                if ($inputType == "text" || $inputType == "number" || $inputType == "password"  || $inputType == "email" || $inputType == "url") 
												{
													$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
													$addAttr ="";
													if($inputType =='number')
													{
														$addAttr = "min=0";
														if(isset($fd['step']) && !empty($fd['step']))
														{
															$addAttr = $addAttr." step='".$fd['step']."'";
														}	
													}
                                                    ?>
                                                    <div class="form-group col-md-6" id="div_<?php echo $tablefieldname;?>">
                                                    	 <?php  if(in_array($fd['id'],$addMoreLineCheck) && $_GET['service_id']=='591.0'){ ?>
														  <span class="h4 col-md-12 caption-subject font-red-sunglo bold uppercase"><i class="fa fa-plus font-red-sunglo"></i> Add Data In Table</span>
														  <hr>
														<?php } ?>
                                                        <label class="col-md-12 control-label text-left" for=""  id="label_<?php echo $tablefieldname;?>">
                                                            <?php echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');

                                                            echo $fcode = "<b class='ukfcl'>(" . $tablefieldname. ")</b>";

                                                            $ln = $formName . "" . $fcode;
                                                            if ($fd['is_required'] == 'Y') {
                                                                echo "<span style='color:red;'> *</span>";
                                                            }
                                                            ?>
                                                            <?php
                                                            if (!empty($fd['helptext'])) {
                                                                $helptext = $fd['helptext'];
                                                              echo " <i class='fa fa-question-circle text-info fa-lg' data-html='true' data-toggle='tooltip' title='$helptext'></i>";
                                                            }
															
                                                            ?>
                                                        </label>

                                                        <div class="col-md-12" id="input_<?php echo $tablefieldname;?>">
															<input type="<?php echo $inputType; ?>" name="<?php echo $tablefieldname; ?>" placeholder='<?php echo $formName ?>' labelname="<?php echo $ln; ?>" class="form-control <?php echo $val_cls; ?>" <?php if ($fd['is_required'] == 'Y' && $val_cls == '') { echo "required"; } ?> id="<?php echo $tablefieldname; ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo $formName ?>'" value="<?php if(!is_array(@$fieldValues[$tablefieldname])) echo  @$fieldValues[$tablefieldname]; ?>" <?php if($maxLength>0){?>maxlength="<?php echo $maxLength; ?>"<?php  } ?> <?php if($minLength>0){?>minlength="<?php echo $minLength; ?>"<?php  } ?>  <?php echo $addAttr; ?> style="<?php echo $classEditOrNot;?>">
															<div id="loader_name" style="display: none;"><i class="icon-spinner icon-spin icon-large"></i> (Checking Avalility of Name...)</div>
                                                        </div>
                                                    </div>
                                                <?php 
												} 
												?>					
									<?php
											// Genrating select field for type select and multiple select
									if ($inputType == "select" || $inputType == "multipleselect") 
									{
										$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
									?>
										<div class="form-group col-md-6" id="div_<?php echo $tablefieldname;?>">
											 <?php  if(in_array($fd['id'],$addMoreLineCheck) && $_GET['service_id']=='591.0'){ ?>                    
											  <span class="h4 col-md-12 caption-subject font-red-sunglo bold uppercase"><i class="fa fa-plus font-red-sunglo"></i> Add Data In Table</span>
											  <hr>
											<?php } ?>
											<label class="col-md-12 control-label text-left" for="" id="label_<?php echo $tablefieldname;?>">						
												<?php echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');

												echo $fcode = " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
												?><?php
											echo ")</b>";

											$ln = $formName . "" . $fcode;
											if ($fd['is_required'] == 'Y') {
												echo "<span style='color:red;'>* </span>";
											}
											?> 

											<?php
											if (!empty($fd['helptext'])) {
												$helptext = $fd['helptext'];
												echo " <i class='fa fa-question-circle text-info fa-lg' data-html='true' data-toggle='tooltip' title='$helptext'></i>";
											}
											?>								
											</label>
											<?php
											$options = Yii::app()->db->createCommand("SELECT bo.*, bm.master_table_name, bm.key_id, bm.field_value, bm.is_active_field,
											 bm.is_active_value FROM bo_infowiz_formfield_options as bo
											 LEFT JOIN bo_master_tables as bm ON bo.master_table_id=bm.id
											 WHERE bo.formfield_id=$fd[id] AND bo.master_table_id!=0 AND bo.is_active='Y' ORDER BY bo.id DESC")->queryRow();

												if (isset($options) && !empty($options)) {
													$table_name = $options['master_table_name'];
													$key_id = $options['key_id'];
													$field_value = $options['field_value'];
													$is_active_field = $options['is_active_field'];
													$is_active_value = $options['is_active_value'];
													$allList = InfowizardQuestionMasterExt::getMasterList($table_name, $key_id, $field_value, $is_active_field, $is_active_value);
													asort($allList);
													?>
													<div class="col-md-12" id="input_<?php echo $tablefieldname;?>">
														<select name="<?php echo $tablefieldname; if ($inputType != "select") {   echo "[]"; } ?>" 	<?php if ($inputType == "multipleselect") {		echo " multiple='multiple' style='max-height:120px;'";}?> placeholder="<?php echo $formName; ?>" class="<?php echo $val_cls; ?> select2-me"	<?php if($fd['is_required'] == 'Y' && $val_cls == '') {	echo "required"; }?> id="<?php echo $tablefieldname; ?>" labelname="<?php echo $ln; ?>" style="<?php echo $classEditOrNot;?>">
															<option value="">Please Select </option>
																<?php foreach ($allList as $key => $val) { ?>
																<option value="<?php echo $key; ?>" <?php if ($inputType == "multipleselect" && isset($fieldValues[$tablefieldname]) && !empty($fieldValues[$tablefieldname]) && is_array($fieldValues[$tablefieldname])) { if(in_array($key,@$fieldValues[$tablefieldname])){ echo "selected";}} else { if(@$fieldValues[$tablefieldname]==$key) { echo "selected";}}?>><?php echo $val; ?></option>
															<?php } ?>
														</select>    
													</div>



												<?php } else {
													$options = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_formfield_options WHERE formfield_id=$fd[id] AND is_active='Y' ORDER BY id DESC")->queryAll();
													?>						
													<div class="col-md-12" id="input_<?php echo $tablefieldname;?>">
														<select name="<?php echo $tablefieldname; if($inputType != "select") {	echo "[]";}	?>" 
														<?php if ($inputType == "multipleselect") {	echo " multiple='multiple' style='max-height:120px;'";}  ?> placeholder='<?php echo $formName; ?>' class="<?php echo $val_cls; ?> select2-me"  
														<?php
														if ($fd['is_required'] == 'Y' && $val_cls == '') {
															echo "required";
														}
														?> id="<?php echo $tablefieldname; ?>" labelname="<?php echo $ln; ?>" style="<?php echo $classEditOrNot;?>">

															<option value="">Please Select </option>
														<?php foreach ($options as $option) { ?>
																<option value="<?php echo $option['options']; ?>" <?php if ($inputType == "multipleselect") { if(in_array($option['options'],@$fieldValues[$tablefieldname])){ echo "selected";} }else{
																if(@$fieldValues[$tablefieldname]==$option['options']) { echo "selected";} }?>><?php echo $option['options']; ?></option>
														<?php } ?>
														</select>    
													</div>								
													<?php } ?>		

											</div>
												<?php } ?>	
										<?php
										// Genrating select field for type select and multiple select
										if ($inputType == "checkbox" || $inputType == "radio") {
											 $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id')
											?>
											<div class="form-group col-md-12" id="div_<?php echo $tablefieldname;?>">
												 <?php  if(in_array($fd['id'],$addMoreLineCheck)){ ?>
												  <span class="h4 col-md-12 caption-subject font-red-sunglo bold uppercase"><i class="fa fa-plus font-red-sunglo"></i> Add Data In Table</span>
												  <hr>
												<?php } ?>
												<label class="col-md-12 control-label text-left" for="" label="label_<?php echo $tablefieldname;?>">
													<?php echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');

													echo $fcode = " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
													?><?php
													echo ")</b>";

													$ln = $formName . "" . $fcode;
													if ($fd['is_required'] == 'Y') {
														echo "<span style='color:red;'> *</span>";
													}
													?> 
													<?php
													if (!empty($fd['helptext'])) {
														$helptext = $fd['helptext'];
														echo " <i class='fa fa-question-circle text-info fa-lg' data-html='true' data-toggle='tooltip' title='$helptext'></i>";
													}
													?>
												</label>
												<div class="col-md-12" id="input_<?php echo $tablefieldname;?>">
													<?php $options = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_formfield_options where formfield_id=$fd[id] AND is_active='Y' ORDER BY id DESC")->queryAll();
													?>
													<?php
													$checkdradio = "";
													foreach($options as $option) {
															
															if($inputType== "radio") 
															{ 
																if(@$fieldValues[$tablefieldname]==$option['options'])
																{ 
																	$checkdradio = "checked";
																} 
															}
														?>
														<div class="col-md-6">
															<input name="<?php echo $tablefieldname;if ($inputType == "checkbox") { echo "[]";}?>" type="<?php echo $inputType; ?>" value="<?php echo $option['options']; ?>" name="<?php echo $fd['id'] ?>" class="chk_<?php echo $tablefieldname." ".$val_cls; ?>" labelname="<?php echo $ln; ?>" <?php echo @$checkdradio; if($inputType== "checkbox") { if(isset($fieldValues[$tablefieldname]) && in_array($option['options'],$fieldValues[$tablefieldname])){ echo "checked";} } ?> >&nbsp;<?php echo $option['options']; ?>
														</div> 
												<?php 
													} 
													?>

												</div>
											</div>
										<?php } ?>
										<?php
										// Genrating textarea
										if ($inputType == "textarea") {
										$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
											?>
											<div class="form-group col-md-6" id="div_<?php echo $tablefieldname;?>">
												 <?php  if(in_array($fd['id'],$addMoreLineCheck)){ ?>
                                                                                    
                                                                                    
                                                                                      <span class="h4 col-md-12 caption-subject font-red-sunglo bold uppercase"><i class="fa fa-plus font-red-sunglo"></i> Add Data In Table</span>
                                                                                      <hr>
                                                                                    <?php } ?>
												<label class="col-md-12 control-label text-left" for="" id="label_<?php echo $tablefieldname;?>" >
													<?php echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');

													echo $fcode = " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
													?>
													<?php
															echo ")</b>";

															$ln = $formName . "" . $fcode;
															if ($fd['is_required'] == 'Y') {
																echo "<span style='color:red;'> *</span>";
															}
																	  
													?>
													<?php
															if (!empty($fd['helptext'])) {
																$helptext = $fd['helptext'];
																echo " <i class='fa fa-question-circle text-info fa-lg' data-html='true' data-toggle='tooltip' title='$helptext'></i>";
															}
													?> 
												</label>
												<div class="col-md-12" id="input_<?php echo $tablefieldname;?>">
													<textarea name="<?php echo $tablefieldname; ?>" class="form-control <?php echo $val_cls; ?>" row="2" id="<?php echo $tablefieldname; ?>" labelname="<?php echo $ln; ?>" <?php if ($fd['is_required'] == 'Y' && $val_cls == '') { echo "required"; } ?> style="<?php echo $classEditOrNot;?>"><?php if(!is_array(@$fieldValues[$tablefieldname])) echo @$fieldValues[$tablefieldname];?></textarea>
												</div>
											</div>
											<?php } ?>
											<?php
											// Genrating Calender
											if ($inputType == "calender") {
											$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
												?>
											<div class="form-group col-md-6" id="div_<?php echo $tablefieldname;?>">
												 <?php  if(in_array($fd['id'],$addMoreLineCheck)){ ?>             
												  <span class="h4 col-md-12 caption-subject font-red-sunglo bold uppercase"><i class="fa fa-plus font-red-sunglo"></i> Add Data In Table</span>
												  <hr>
												<?php } ?>
												<label class="col-md-12 control-label text-left" for="" id="label_<?php echo $tablefieldname;?>">
												<?php echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');

												echo $fcode = " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
												?><?php
												echo ")</b>";

												$ln = $formName . "" . $fcode;
												if ($fd['is_required'] == 'Y') {
													echo "<span style='color:red;'> *</span>";
												}
												?>
												<?php
												if (!empty($fd['helptext'])) {
													$helptext = $fd['helptext'];
													echo " <i class='fa fa-question-circle text-info fa-lg' data-html='true' data-toggle='tooltip' title='$helptext'></i>";
												}
												?>
												</label>
												<div class="col-md-12" id="input_<?php echo $tablefieldname;?>">
													<input type="text" autocomplete="off" id="<?php echo $tablefieldname; ?>" name="<?php echo $tablefieldname; ?>" class="datepicker form-control <?php echo $val_cls; ?>" labelname="<?php echo $ln; ?>" value="<?php if(!is_array(@$fieldValues[$tablefieldname]))echo @$fieldValues[$tablefieldname];?>" style="<?php echo $classEditOrNot;?>">
												</div>
											</div>
										<?php } ?>
										<?php
										/*
										 * * Add More button Condition

										 */
                                        if ($inputType == "add_more_button") {
											$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
											$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ;											
										?>	
												
										   <div class="form-group col-md-12">                
												<div class="col-md-12" id="div_<?php echo $tablefieldname;?>">
												
													 <?php  if(in_array($fd['id'],$addMoreLineCheck)){ ?>
													  <span class="h4 col-md-12 caption-subject font-red-sunglo bold uppercase"><i class="fa fa-plus font-red-sunglo"></i> Add Data In Table</span>
													  <hr>
													<?php } ?>
													<input type="hidden" name="<?php echo $tablefieldname; ?>" value="<?php echo $id; ?>" id="btn-UKCL-<?php echo $id; ?>">								
													<a href="javascript:;" class="btn btn-success add-more-btn div_<?php echo $tablefieldname;?>" relf="<?php echo @$_GET['service_id']?>" rel="<?php echo $fd['page_name']; ?>" relid="<?php echo $id; ?>" id="disabled_btn_tbl_<?php echo $id;?>"><i class="fa fa-plus"></i><?php echo $formName;												
													echo " <b class='ukfcl'>(" . $tablefieldname; ?><?php echo  ")</b>";
													if ($fd['is_required'] == 'Y') {
														echo "<span style='color:red;'> *</span>";
													} ?>
													<?php if (!empty($fd['helptext'])) {
														$helptext = $fd['helptext'];
														echo " <i class='fa fa-question-circle text-info fa-lg' data-html='true' data-toggle='tooltip' title='$helptext'></i>";
													} ?> 
													</a>
												</div>
											</div>
											<div class="col-md-12 admr" id="add_more_<?php echo $id;?>">
											
											<hr>
											<div style="overflow:auto;">
											<table class="table table-striped table-bordered table-hover responsive-table" id="tbl_<?php $tblID="tbl_".$id; echo $id;?>" style="">
												<thead>
													<tr class="add_more_<?php echo $id;?>">
														<?php 
														if(isset($get_selected_field) && !empty($get_selected_field)){
															foreach ($get_selected_field as $key => $valued) 
															{
																if($fd['id']==$valued['button_id']){
															?>
															<th><?php echo $valued['name']; ?> <b class='ukfcl'>(<?php echo $valued['formchk_id']; ?>)</b></th>
															<?php	} 
															} 
														}
														?>
														<th>Action</th>
													</tr>
												</thead>
											<tbody>
											<?php 
											$arrofIn=array(); 
											if(!empty($get_selected_field)){
											foreach ($get_selected_field as $key => $valued) 
											{
												if($fd['id']==$valued['button_id'])
												{ 
													$fcode=$valued['formchk_id'];
													$btnID=$valued['button_id'];
													if(!in_array($valued['button_id'],$arrofIn))
													{
														$arrofIn[]=$valued['button_id'];						
														$ShowTableflg=0;
														//print_r($allData23);die;
														if(isset($allData23[$fcode]))
														{	
															for($k=0; $k<(count($allData23[$fcode]));$k++)
															{ 
																if(isset($allDataMappedWithButton[$btnID]) && !empty($allDataMappedWithButton[$btnID])) 
																{ 
																	$btnCoin=0;
																	foreach($allDataMappedWithButton[$btnID] as $key1=>$datag){ 
																?>
																<?php if(isset($allData23[$datag]) && is_array($allData23[$datag])){ if(isset($allData23[$datag][$k]) && !empty($allData23[$datag][$k])) { $ShowTableflg=1; $btnCoin=1; } }else{ if(isset($allData23[$datag][$k]) && !empty($allData23[$datag][$k])) { $ShowTableflg=1; $btnCoin=1; } } } } ?>
															<?php if($btnCoin==1){ ?>
															
																<tr class="add_more_<?php echo $id;?>">
																	<?php 
																	if(isset($allDataMappedWithButton[$btnID]) && !empty($allDataMappedWithButton[$btnID])) 
																	{  
																	?>
																	
																	<?php
																		$fomFeildMasterArr = array('UK-FCL-00298_0','UK-FCL-00299_0');
																		foreach($allDataMappedWithButton[$btnID] as $key1=>$datag){ 
																		
																		
																		if(isset($allData23[$datag]) && is_array($allData23[$datag])){ if(isset($allData23[$datag][$k]) && !empty($allData23[$datag][$k])) { $ShowTableflg=1; $gho=@$allData23[$datag][$k];} }else{ if(isset($allData23[$datag][$k]) && !empty($allData23[$datag][$k])) { $ShowTableflg=1; $gho=@$allData23[$datag];} } 
																		
																	
																		$approvalval = '';
																		if(isset($gho) && in_array($datag,$fomFeildMasterArr) && is_numeric($gho))
																		{
																			if($datag=='UK-FCL-00298_0'){
																				$deptName=Yii::app()->db->createCommand("select department_name from bo_departments where dept_id=$gho")->queryRow();
																				$approvalval = $deptName['department_name'];
																			}
																			if($datag=='UK-FCL-00299_0'){
																				$deptName=Yii::app()->db->createCommand("select app_name from bo_sp_all_applications where app_id=$gho")->queryRow();
																				$approvalval = $deptName['app_name'];
																			}
																		}
																		
																	?>
																		
																		<td><?php //echo $datag."==".$allData23[$datag][$k]."===".$serviceID."==".$approvalval; ?>
																			<input class="form-control  <?php if(@$datag=='UK-FCL-00226_4'){ echo "sklmf_".$clsr;$clsr=$clsr+1; } ?><?php if(@$datag=='UK-FCL-00226_7'){ echo "skmf"; } ?>" name="<?php echo @$datag;?>[]" type="text" value="<?php if(isset($approvalval) && !empty($approvalval)){ echo $approvalval; }else{ if(isset($allData23[$datag]) && is_array($allData23[$datag])){ if(isset($allData23[$datag][$k]) && !empty($allData23[$datag][$k])) { $ShowTableflg=1; echo @$allData23[$datag][$k];} }else{ if(isset($allData23[$datag][$k]) && !empty($allData23[$datag][$k])) { $ShowTableflg=1; echo @$allData23[$datag];} } } ?>" readonly title="<?php if(isset($approvalval) && !empty($approvalval)){ echo $approvalval; }else{ if(isset($allData23[$datag]) && is_array($allData23[$datag])){ if(isset($allData23[$datag][$k]) && !empty($allData23[$datag][$k])) { $ShowTableflg=1; echo @$allData23[$datag][$k];} }else{ if(isset($allData23[$datag][$k]) && !empty($allData23[$datag][$k])) { $ShowTableflg=1; echo @$allData23[$datag];} } } ?>"> 
																		</td>

																	<?php } 
																	}?>
																	<td style="text-align:center;"><button class="btn btn-danger del_1" pi="add_more_<?php echo $id;?>"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
																</tr>
															<?php 
																} 
															}
														}
													}
												} 
											}
											}?>
											</tbody>
											</table>
											</div>
											<?php 										
											if(isset($fieldValues[$tablefieldname])){
												//echo "<pre>"; print_r($ButtonsArrayNew);
												if(in_array($fieldValues[$tablefieldname],$ButtonsArrayNew)){
												//echo @$fieldValues[$tablefieldname]; 
											?>
												<style>
													#add_more_<?php echo $id;?>{
														display:block;
													}	
												</style>
												<!--<script>
												$("#btn-UKCL-<?php echo $id;?>").attr('disabled',true);
												</script>-->
											<?php }
											}else{ ?>
												<script>
													$("#tbl_<?php echo $id;?>  tbody").html("");
												</script>
											<?php }	?>
										
										</hr>
										
										<?php if(isset($ShowTableflg) && $ShowTableflg==0){?>
											<style>
												#<?php echo $tblID;?> { display: none; } 											
												#btn_<?php echo $tblID;?> { display: none; } 											
											</style>
										<?php } ?>
										</div>	   
                                        <?php }

                                        /* End  for Add more button */
                                       
                                        if ($keyy % 2 != 0) {
                                            echo "</div>";
                                        }
                                        ?>
                                    <?php
                                    }
                                }
                                ?>
								</div>
								<!--end: Form Wizard Step 1-->
				  <?php } ?>
		
							</div>
							<!--end: Form Body -->
							<!--begin: Form Actions -->
								<div class="m-portlet__foot m-portlet__foot--fit m--margin-top-40">
									<div class="m-form__actions">
										<div class="row">
										<div class="col-md-12">
											<div class="col-lg-6 m--align-left back">
												<a href="javascript:void(0);" class="btn btn-default m-btn m-btn--custom m-btn--icon" data-wizard-action="prev" style="background-color:#E5E5E5;">
													<span>
														<i class="fa fa-arrow-left"></i>
														&nbsp;&nbsp;
														<span>
															Back
														</span>
													</span>
												</a>
											</div>
											<div class="col-lg-6 m--align-right">
												<a href="javascript:void(0);" class="btn btn-primary m-btn m-btn--custom m-btn--icon submitForm" data-wizard-action="submit" rel="<?php echo @$_GET['service_id']?>">
													<span>
														<i class="fa fa-check"></i>
														&nbsp;&nbsp;
														<span>
															Submit
														</span>
													</span>
												</a>
												<a href="javascript:void(0);" class="btn btn-success m-btn m-btn--custom m-btn--icon" data-wizard-action="next" rel="<?php echo @$_GET['service_id']?>">
													<span>
														<span>
															Save & Continue
														</span>
														&nbsp;&nbsp;
														<i class="fa fa-arrow-right"></i>
													</span>
												</a>
											</div>
											</div>
										</div>
									</div>
								</div>
								<!--end: Form Actions -->
							</form>
						</div>
						<!--end: Form Wizard Form-->
					</div>
				</div>
			</div>
			<!--end: Form Wizard-->
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
<?php } ?>

<!-- datepicker js -->
<link href="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<script type="text/javascript">
$(document).ready(function () {
	 
	$('.skmf').each(function(e) {	
		var str = $(this).val().trim();		
		var res = str.toLowerCase()+"Emp";		
		$(".sklmf_"+e).addClass(res);
	});
});

$(document).ready(function () {
	
	$('[data-toggle="tooltip"]').tooltip(); 
	$(document).on('click','.datepicker',function(){		
		$(".datepicker-days").show();	
	});
	$(document).on('click','.del_1', function () {
		// alert("==");
		$(this).closest('tr').remove();
		var uio= $(this).attr('pi');
		if($("."+uio).length<2){
			$("#"+uio).css('display','none');
		}
	});
			
	var date = new Date();
	date.setDate(date.getDate());
	
	<?php 
	$serviceArr = array('2.0');
	if(in_array($_GET['service_id'],$serviceArr))
	{	
	?>
		$(".datepicker").datepicker({
			changeMonth: true,
			changeYear: true,
			startDate: '15-06-1940',
			endDate: date,
			format: 'dd/mm/yyyy'
		});
	<?php 
	}else{
	?>
		$(".datepicker").datepicker({
			changeMonth: true,
			changeYear: true
		});
	<?php 
	}
	?>
	
	$(".ukfcl").hide();
	/* Add more  */

	$('.add-more-btn').on('click', function () {		
		var id = $(this).attr("rel");
		var service_id = $(this).attr("relf");
		var div_id = $(this).attr("relid");		
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
							if($("#UK-FCL-00044_0").val()=='3' && $("#UK-FCL-00068_0").val()=='No' && (formchk_id=='UK-FCL-00072_0' || formchk_id=='UK-FCL-00069_0' || formchk_id=='UK-FCL-00070_0' || formchk_id=='UK-FCL-00071_0'))
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
						$("#div_"+formchk_id).append("<b style='color:red;padding-left:16px;' class='errorDetail'>Please fill the required field: "+$.trim(labelData)+"</b>");
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

				});
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
			}
		});
	});
	$("#show_ukfcl").on('click', function () {
		$(".ukfcl").toggle();
	});
	$('.start').on('click', function () {
		$('div #start').toggle();
	});

	$('div #start').toggle();
		
	});
	
</script> 

<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

