<?php
//echo "<pre/>"; print_r($_SESSION); die;
/* Rahul Kumar  25032018 */
$ID = $_GET['service_id'];

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
?>
<style>
    .form-control-feedback {
padding-top: 3px !important;
}
    .errorSummary{ color:red;}
    .text-left{ text-align:left !important;}
	hr{ margin: 0px !important;margin-bottom: 23px !important;}
    a:hover{ background:#36C6D3 !important;}
    textarea{height: 90px !important;}
    .page-footer-inner { padding: 1px 1px 1px !important; }
    .dashboard-stat.yellow{ background-color: #F1C40F;    } 
    .mt-element-step .step-thin .done {
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#1e5799+0,2989d8+34,207cca+62,7db9e8+100 */background: #1e5799; /* Old browsers */background: -moz-linear-gradient(top, #1e5799 0%, #2989d8 34%, #207cca 62%, #7db9e8 100%); /* FF3.6-15 */background: -webkit-linear-gradient(top, #1e5799 0%,#2989d8 34%,#207cca 62%,#7db9e8 100%); /* Chrome10-25,Safari5.1-6 */background: linear-gradient(to bottom, #1e5799 0%,#2989d8 34%,#207cca 62%,#7db9e8 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#7db9e8',GradientType=0 ); /* IE6-9 */
    }
    .mt-step-col{cursor: pointer;}
    .portlet.box .dataTables_wrapper .dt-buttons { margin-top: 14px; }
    @media (min-width: 700px){
        .col-lg-3 { width: 20%;}
    }
    .href_link:hover{ color:#23527c;}
    .href_link1{ color: #ffffff; font-size: 13px; font-family: "Open Sans",sans-serif; font-weight: 300; text-align: center;vertical-align: top; padding: 2px 5px; }        
    .movetoDashboard{ cursor: pointer; }
    .top_tab { padding: 10px; background-color: #36C6D3; color: #fff; }
    .flt_rgt { float: right !important; }
	.form-control-feedback {
		position: absolute !important;
		top: 25px !important;
		right: 0;
		left: 17px;
		z-index: 2;
		display: block;
		width: 100% !important;
		height: 34px;
		line-height: 34px;
		text-align: left !important;
		pointer-events: none;
	}
	.mt-element-step .step-thin .mt-step-content {
		padding-left: 60px;
		margin-top: 8px;
	}
	.datepicker {
		min-width: 399px !important;
		padding: 10px;
	}
	
	.control-label .required, .form-group .required {
		color: #555;
		font-size: 14px;		
	}
	.select2-container .select2-choice {
		display: block;
		height: 34px !important;
		padding: 0px 0px 0px 8px;
		overflow: hidden;
		position: relative;
		border: 1px solid #aaa;
		white-space: nowrap;
		line-height: 33px !important;
		color: #444;
		text-decoration: none;
	}
	.select2-container-multi .select2-choices {
		min-height: 34px !important;
	}
	#UK-FCL-00648_0{	
		opacity: 0.6;
		pointer-events: none;
	}
	#UK-FCL-00038_6{	
		opacity: 0.6;
		pointer-events: none;
	}	
</style>
<?php 
/*
$serviceDetails = explode(".",$_GET['service_id']);
if(isset($serviceDetails[1])){
    $validationFileName=$serviceDetails[0]."_".$serviceDetails[1]."_validation";
}

$this->renderPartial($validationFileName);

*/
if(isset($_GET['service_id']) && ($_GET['service_id']=='592.0' || $_GET['service_id']=='593.0' || $_GET['service_id']=='604.0' ||  $_GET['service_id']=='572.6' || $_GET['service_id']=='574.6' || $_GET['service_id']=='575.6' || $_GET['service_id']=='603.0' || $_GET['service_id']=='607.0' || $_GET['service_id']=='609.0'  || $_GET['service_id']=='606.0' || $_GET['service_id']=='605.0' || $_GET['service_id']=='611.0' || $_GET['service_id']=='597.0'))
{ 
    
$this->renderPartial('592_0_validation');
}
if(isset($_GET['service_id']) && $_GET['service_id']=='596.0')
{ 
    
$this->renderPartial('596_0_validation');
}
if(isset($_GET['service_id']) && $_GET['service_id']=='591.0')
{ 
?>
<!--<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/scripts/cafform.js" type="text/javascript"></script>-->
<?php
$basePath = Yii::app()->basePath;
include_once($basePath."/modules/infowizard/views/formBuilder/cafform_validation.php");
//$this->renderPartial($basePath.'/modules/infowizard/views/formBuilder/cafform_validation');
?>
<?php	
}else if(isset($_GET['service_id']) && $_GET['service_id']=='590.0'){
	$this->renderPartial('itda_validation');
?>
	<script type="text/javascript">
		$(document).ready(function () {
			$(".back").hide();
		});
	</script>
	
<?php }else if(isset($_GET['service_id']) && $_GET['service_id']=='578.0'){
	$this->renderPartial('itda_validation');
 ?>
	<script type="text/javascript">
		$(document).ready(function () {
			$(".back").hide();
		});
	</script>
<?php 
	} else if(isset($_GET['service_id']) && $_GET['service_id']=='121.0'){
	$this->renderPartial('121_0_validation');
 } else if(isset($_GET['service_id']) && $_GET['service_id']=='120.0'){
	$this->renderPartial('120_0_validation');
 }?>

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
		<link rel="shortcut icon" href="/backoffice/themes/swcsNewTheme/images/favicon.ico" />
	
	
		
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
											<div class="m-wizard__form">
												<!--
							1) Use m-form--label-align-left class to alight the form input lables to the right
							2) Use m-form--state class to highlight input control borders on form validation
						-->
						
					<form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/infowizard/subForm/saveUpdateSubForm/dev/Y"); ?>">
						<input type="checkbox" name="show_ukfcl" id="show_ukfcl" style="float:right;">
						<input type="hidden" name="approval_id" id="approval_id" value="<?php echo @$_GET['approval_id']; ?>">
						<input type="hidden" name="submission_id" id="submission_id" value="<?php echo @$_GET['subID']; ?>">
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
										//print_r($get_selected_field);die;
										$allData23 = InfowizardQuestionMasterExt::getsubmittedvalues($_GET['service_id'],$_GET['subID']);
										$btnArray=array();
										$allDataMappedWithButton=array();
										foreach($get_selected_field as $gsf){
											$btnArray[]=$gsf['button_id'];
											$btnID=$gsf['button_id'];
											$sfArray[]=$gsf['selected_field_id'];

											if(!isset($allDataMappedWithButton[$btnID])){
												$allDataMappedWithButton[$btnID]=array();
											}
											$allDataMappedWithButton[$btnID][]=$gsf['formchk_id'];
										}
										//print_r($allDataMappedWithButton);die;
                                        $serviceDetail = Yii::app()->db->createCommand("SELECT issuerby_id from bo_information_wizard_service_master where id=$mainserviceID")->queryRow();
                                        $issuerByID = $serviceDetail['issuerby_id'];
                                        ?>
                                        <input type="hidden" name="issuer_id" value="<?php echo $issuerByID; ?>">
                                        <?php
                                        $pageID = $_GET['pageID'];
                                        $categoryPreference = array();
										
                                        foreach ($formData as $key => $fd) {
                                        
                                            if ($ap['id'] == $fd['page_name']) {
                                                 // echo $ap['id']."==".$fd['page_name']."==m_wizard_form_step_".($pageKey+1)."///";
                                        
                                                $inputType = $fd['input_type'];
                                                $minLength = $fd['min_length'];
                                                $maxLength = $fd['max_length'];
                                                $button_id = $fd['id'];

                                                $_exist_addmore_table = InfowizardQuestionMasterExt::checkExist($fd['service_id'], $fd['page_name'], $fd['id']);
                                                if ($_exist_addmore_table && $fd['is_required'] == 'Y')
                                                    $val_cls = 'val';
                                                else
                                                    $val_cls = '';
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
                                                    ?>
                                                    <div class="form-group col-md-6" id="div_<?php echo $tablefieldname;?>">
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
                                                                echo " <i class='fa fa-question-circle' title='$helptext'></i>";
                                                            }
                                                            ?>
                                                        </label>

                                                        <div class="col-md-12">
															<input type="<?php echo $inputType; ?>" name="<?php echo $tablefieldname; ?>" placeholder='<?php echo $formName ?>' labelname="<?php echo $ln; ?>" class="form-control <?php echo $val_cls; ?>" <?php if ($fd['is_required'] == 'Y' && $val_cls == '') { echo "required"; } ?> id="<?php echo $tablefieldname; ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo $formName ?>'" value="<?php if(!is_array(@$fieldValues[$tablefieldname])) echo  @$fieldValues[$tablefieldname]; ?>" <?php if($maxLength>0){?>maxlength="<?php echo $maxLength; ?>"<?php  } ?> <?php if($minLength>0){?>minlength="<?php echo $minLength; ?>"<?php  } ?>>
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
												echo " <i class='fa fa-question-circle' title='$helptext'></i>";
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
													<div class="col-md-12">
														<select name="<?php echo $tablefieldname; if ($inputType != "select") {   echo "[]"; } ?>" 	<?php if ($inputType == "multipleselect") {		echo " multiple='true' style='max-height:120px;'";}?> placeholder="<?php echo $formName; ?>" class="<?php echo $val_cls; ?> select2-me"	<?php if($fd['is_required'] == 'Y' && $val_cls == '') {	echo "required"; }?> id="<?php echo $tablefieldname; ?>" labelname="<?php echo $ln; ?>">
															<option value="">Please Select </option>
																<?php foreach ($allList as $key => $val) { ?>
																<option value="<?php echo $key; ?>" <?php if ($inputType == "multipleselect" && isset($fieldValues[$tablefieldname]) && !empty($fieldValues[$tablefieldname]) && is_array($fieldValues[$tablefieldname])) { if(in_array($key,@$fieldValues[$tablefieldname])){ echo "selected";}} else { if(@$fieldValues[$tablefieldname]==$key) { echo "selected";}}?>><?php echo $val; ?></option>
															<?php } ?>
														</select>    
													</div>



												<?php } else {
													$options = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_formfield_options WHERE formfield_id=$fd[id] AND is_active='Y' ORDER BY id DESC")->queryAll();
													?>						
													<div class="col-md-12">
														<select name="<?php echo $tablefieldname; if($inputType != "select") {	echo "[]";}	?>" 
														<?php if ($inputType == "multipleselect") {	echo " multiple='true' style='max-height:120px;'";}  ?> placeholder='<?php echo $formName; ?>' class="<?php echo $val_cls; ?> select2-me"  
														<?php
														if ($fd['is_required'] == 'Y' && $val_cls == '') {
															echo "required";
														}
														?> id="<?php echo $tablefieldname; ?>" labelname="<?php echo $ln; ?>">

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
														echo " <i class='fa fa-question-circle' title='$helptext'></i>";
													}
													?>
												</label>
												<div class="col-md-12">
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
																echo " <i class='fa fa-question-circle' title='$helptext'></i>";
															}
													?> 
												</label>
												<div class="col-md-12">
													<textarea name="<?php echo $tablefieldname; ?>" class="form-control <?php echo $val_cls; ?>" row="2" id="<?php echo $tablefieldname; ?>" labelname="<?php echo $ln; ?>"><?php if(!is_array(@$fieldValues[$tablefieldname])) echo @$fieldValues[$tablefieldname];?></textarea>
												</div>
											</div>
											<?php } ?>
											<?php
											// Genrating Calender
											if ($inputType == "calender") {
											$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
												?>
											<div class="form-group col-md-6" id="div_<?php echo $tablefieldname;?>">
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
													echo " <i class='fa fa-question-circle' title='$helptext'></i>";
												}
												?>
												</label>
												<div class="col-md-12">
													<input type="inputType" autocomplete="off" id="<?php echo $tablefieldname; ?>" name="<?php echo $tablefieldname; ?>" class="datepicker form-control <?php echo $val_cls; ?>" labelname="<?php echo $ln; ?>" value="<?php if(!is_array(@$fieldValues[$tablefieldname]))echo @$fieldValues[$tablefieldname];?>">
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
													<a href="javascript:;" class="btn btn-success add-more-btn div_<?php echo $tablefieldname;?>" relf="<?php echo @$_GET['service_id']?>" rel="<?php echo $fd['page_name']; ?>" relid="<?php echo $id; ?>" id="disabled_btn_tbl_<?php echo $id;?>"><i class="fa fa-plus"></i><?php echo $formName;												
													echo " <b class='ukfcl'>(" . $tablefieldname; ?><?php echo  ")</b>";
													if ($fd['is_required'] == 'Y') {
														echo "<span style='color:red;'> *</span>";
													} ?>
													<?php if (!empty($fd['helptext'])) {
														$helptext = $fd['helptext'];
														echo " <i class='fa fa-question-circle' title='$helptext'></i>";
													} ?> 
													</a>
												</div>
											</div>
											<div class="col-md-12" id="add_more_<?php echo $id;?>" style="">			
											<table class="table table-striped table-bordered table-hover responsive-table" id="tbl_<?php $tblID="tbl_".$id; echo $id;?>" style="">
											<tr class="add_more_<?php echo $id;?>">
												<?php 
												foreach ($get_selected_field as $key => $valued) 
												{
													if($fd['id']==$valued['button_id']){
												?>
												<th><?php echo $valued['name']; ?> <b class='ukfcl'>(<?php echo $valued['formchk_id']; ?>)</b></th>
												<?php	} 
												} 
												?>
												<th>Action</th>
											</tr>
											<?php //echo "<pre/>"; print_r($get_selected_field);
											$arrofIn=array(); 
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
																	foreach($allDataMappedWithButton[$btnID] as $key1=>$datag){ 
																?>
																	<td>
																		<input class="form-control" name="<?php echo @$datag;?>[]" type="text" value="<?php if(isset($allData23[$datag]) && is_array($allData23[$datag])){ if(isset($allData23[$datag][$k]) && !empty($allData23[$datag][$k])) { $ShowTableflg=1; echo @$allData23[$datag][$k];} }else{ if(isset($allData23[$datag][$k]) && !empty($allData23[$datag][$k])) { $ShowTableflg=1; echo @$allData23[$datag];} } ?>" readonly> 
																	</td>

																<?php } 
																}?>
																<td style="text-align:center;"><button class="btn btn-danger del_1" pi="add_more_<?php echo $id;?>"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
															</tr>
															<?php } }
															}
													}
											} 
										} ?>
										</table>
										
										<?php if($ShowTableflg==0){?>
										<style>
										#<?php echo $tblID;?> {display:none;} 											
										#btn_<?php echo $tblID;?> {display:none;} 											
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
												<a href="javascript:void(0);" class="btn btn-primary m-btn m-btn--custom m-btn--icon submitForm" data-wizard-action="submit">
													<span>
														<i class="fa fa-check"></i>
														&nbsp;&nbsp;
														<span>
															Submit
														</span>
													</span>
												</a>
												<a href="javascript:void(0);" class="btn btn-success m-btn m-btn--custom m-btn--icon" data-wizard-action="next">
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
		<script src="/backoffice/themes/swcsNewTheme/fb/demo/default/custom/components/forms/wizard/subformwizard.js" type="text/javascript"></script>
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


<script type="text/javascript">
$(document).ready(function () {
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
	$(".datepicker").datepicker({
		changeMonth: true,
		changeYear: true
	});
	$(".ukfcl").hide();
	/* Add more  */

	$('.add-more-btn').on('click', function () {
		
		var id = $(this).attr("rel");
		var service_id = $(this).attr("relf");
		var div_id = $(this).attr("relid");
		//alert(div_id);
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
							if ($("input:radio[name='" + formchk_id + "']").hasClass('val')) {
								cls = 'val';
							}
							$("input:radio[name='" + formchk_id + "']").prop('checked', false);
						}
						else {
							vall = $("input[name='" + formchk_id + "']").val();
							$('#' + formchk_id).val("");
							typeVal = 'text';
							if ($("input[name*='" + formchk_id + "']").hasClass('val')) {
								cls = 'val';
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
							
							if ($('#' + formchk_id).hasClass('val')) {
								cls = 'val';
							}
							$("#" + formchk_id + " option").removeAttr("selected");
							$("#" + formchk_id + "").select2("val", "");							
						}
						else {	
							typeVal = 'dropdown';
							vall = $("select[name='" + formchk_id + "'] option:selected").text();
							
							if ($("select[name='" + formchk_id + "']").hasClass('val')) {
								cls = 'val';
							}
							$("#" + formchk_id + " option").removeAttr("selected");
							
							$("#" + formchk_id + "").select2("val", "");
						}
					}
					else if ($(selector).is("textarea")) {	
						typeVal = 'textarea';
						vall = $("textarea[name='" + formchk_id + "']").val();
						
						if ($("textarea[name='" + formchk_id + "']").hasClass('val')) {
							cls = 'val';
						}
						$('#' + formchk_id).val("");
					}
					else if ($('.chk_' + formchk_id).is(':checkbox')) {
						typeVal = 'checkbox';
						vall = $('.chk_' + formchk_id + ':checked').map(function () {
							return this.value;
						}).get().join(',');
						
						if ($('.chk_' + formchk_id).hasClass('val')) {
							cls = 'val';
						}
						$('.chk_' + formchk_id + ':checked').removeAttr('checked');
					}
					if (cls == 'val' && (vall == '' || vall == 'undefined')) {
						alert("Please fill the required field:  " + $("#" + formchk_id).attr('labelname'));
						err = err + 1;
						return false;
					}/*else if (cls=='val' && $("#"+formchk_id).is(":not(:checked)")){
					 alert("Please fill the required field:  "+$("#"+formchk_id).attr('labelname'));                
					 err = err+1;
					 return false;
					 }*/
					else {
						//console.log(typeVal);
						td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
						/* if(typeVal=='text' || typeVal=='textarea')
						{
							td_ += "<td><input type='text' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
						}
						else  if(typeVal=='radio'){
							td_ += "<td><input type='radio' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
						}
						else if(typeVal=='checkbox'){
							td_ += "<td><input type='checkbox' name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
						}
						else if(typeVal=='dropdown'){
							td_ += "<td><select name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly></select></td>";
						}	
						else if(typeVal=='multiple'){
							td_ += "<td><input name='" + formchk_id + "[]' value='" + vall + "' class='form-control' readonly/></td>";
						} */
					}

				});
				//console.log(td_);
				//alert(err);
				if (err == 0) {
					$('#add_more_' + div_id).show();
					$('#tbl_' + div_id).show();
					td_ += "<td style='text-align:center;'><a class='btn btn-danger del_1' pi='add_more_"+div_id+"'><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
					tr_ += td_ + "</tr>";
					$(tr_).appendTo($('#tbl_' + div_id));
				} else
					return false;
				/*$(document).on('click','.del_1', function () {
                                 alert("==");
					$(this).closest('tr').remove();
                                     alert($(this).closest('table').html());
                                        
				});*/
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
		$(".submitForm").click(function(){
		  document.getElementById("m_form").submit(); 
		});
	});
	
	</script>    

<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<?php 
if(isset($_GET['service_id']) && $_GET['service_id']=='591.0')
{  
	$basePath = Yii::app()->basePath;
	include_once($basePath."/modules/infowizard/views/formBuilder/skilled_popup.php");
}
?>