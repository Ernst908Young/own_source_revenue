<?php
/* Rahul Kumar  25032018 */
$ID = $_GET['service_id'];
$hide=0;
if(isset($hide_header)){
	$hide=1;
}

?>
<style>
    .errorSummary{ color:red;}
    .text-left{ text-align:left !important; }
    hr{ margin: 2px !important; }
    a:hover{ background:#36C6D3 !important;}
    .page-footer-inner { padding: 1px 1px 1px !important; }
</style>

<?php 
if($hide ==0) 
	include($_SERVER["DOCUMENT_ROOT"].'/backoffice/themes/swcsNewTheme/views/layouts/subfromtabs.php'); 
?>
<link href="/backoffice/themes/swcsNewTheme/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />


		
        <!--begin::Base Styles -->
		<!--<link href="/backoffice/themes/swcsNewTheme/fb/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />-->
		<link href="/backoffice/themes/swcsNewTheme/fb/demo/default/base/sp.css" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="/backoffice/themes/swcsNewTheme/fb/demo/default/media/img/logo/favicon.ico" />
	
	
		
	<!--begin: Portlet Body-->
							<div class="m-portlet__body m-portlet__body--no-padding">
								<!--begin: Form Wizard-->
								<div class="m-wizard m-wizard--3 m-wizard--success" id="m_wizard">
									<!--begin: Message container -->
									<div class="m-portlet__padding-x">
										<!-- Here you can put a message or alert -->
									</div>
									<!--end: Message container -->
									<div class="row m-row--no-padding" style="background-color: #fff;">
                                                                              <div class="col-md-12">
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
                                                                                                              <?php  foreach ($aap as $pageKey => $ap) { ?>
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
                                    
                            <?php } ?>
                                                                                                            
														
													</div>
												</div>
												<!--end: Form Wizard Nav -->
											</div>
											<!--end: Form Wizard Head -->
										</div>
                                                                                  <?php } ?>
										<div class="col-md-10" style="background-color: #fff;    ">
											<!--begin: Form Wizard Form-->
											<div class="m-wizard__form">
												<!--
							1) Use m-form--label-align-left class to alight the form input lables to the right
							2) Use m-form--state class to highlight input control borders on form validation
						-->
												<form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/infowizard/subForm/saveUpdateSubForm"); ?>">
													<!--begin: Form Body -->
													<div class="m-portlet__body m-portlet__body--no-padding">
                                                                                                            
                                                                                                              <?php  foreach ($aap as $pageKey => $ap) { ?>
														<!--begin: Form Wizard Step 1-->
														<div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_<?php echo $pageKey+1;?>"><input type="hidden" name="submission_id" value="<?php echo $_GET['subID'];?>">
			<?php
			$pageID = $_GET['pageID'];     
			$arry_a = array();
			$categoryPreference = array();

			$arry_a = array();
			$arr_id = array();
			$categoryPreference = array();
			$get_selected_field = InfowizardQuestionMasterExt::get_selected_field($_GET['service_id']);
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

			foreach ($formData as $key => $fd) 
			{
                            
                       if ($ap['id'] == $fd['page_name']) {
                                               
                    $inputType = $fd['input_type'];
					$button_id = $fd['id'];
					/* 
                    ** Pankaj Singh
                    **Check existing entry in add more sub from table 
					*/
					$_exist_addmore_table = InfowizardQuestionMasterExt::checkExist($fd['service_id'],$fd['page_name'],$fd['id']);
					if($_exist_addmore_table && $fd['is_required'] == 'Y') $val_cls = 'val';
					else $val_cls = '';
					$id = $fd['id'];

					$page_name = $fd['page_name'];
					$button_id = $fd['id'];
					$ext_chk = InfowizardQuestionMasterExt::checkSubform($fd['service_id'],$fd['id'],$fd['page_name']);
					if($ext_chk){
						$arr_id[] = $fd['id'];
						$arry_a[$fd['id']]['id'] = $fd['id'];
						$arry_a[$fd['id']]['category_id'] = $fd['category_id'];
						$arry_a[$fd['id']]['form_field_id'] = $fd['form_field_id'];
					} 

					//if(!in_array($fd['id'], $arry_a))
					//{                  
						$inputType = $fd['input_type'];
						if (!in_array($fd['category_id'], $categoryPreference)) {
							$keyy = -1;
							$categoryPreference[] = $fd['category_id'];
							?>
							<br>
							<div class="row">
							</div>
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-tags font-red-sunglo">
									</i>
									<span class="caption-subject font-red-sunglo bold uppercase">
											<?php echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowiz_form_categories', $fd['category_id'], 'category_name', 'id'); ?>
									</span>
								</div>
								<div class="actions">
									<div class="portlet-input input-inline input-small">
									</div>
								</div>
							</div>
							<hr>
                <?php 	} ?>
							<?php //echo "======".$keyy;
							if ($keyy % 2 == 0) { 
							echo "<div class='row'>";
							} $keyy = $keyy + 1; 
							?>
							<?php // Genrating text field for type text and number 
							if ($inputType == "text" || $inputType == "number" || $inputType == "password") 
							{  ?>
								<div class="form-group col-md-6">
								<label class="col-md-12 control-label text-left" for="" >
								<?php echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
								echo " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ; ?><?php echo  ")</b>";
								if ($fd['is_required'] == 'Y') {
								echo "<span style='color:red;'> *</span>";
								} ?>
								<?php if (!empty($fd['helptext'])) {
								$helptext = $fd['helptext'];
								echo " <i class='fa fa-question-circle' title='$helptext'></i>";
								} ?>
								</label>
								<div class="col-md-12">
								<input type="<?php echo $inputType; ?>" id="<?php echo $tablefieldname;?>" name="<?php echo $tablefieldname; ?>" placeholder='<?php echo $formName ?>' class="form-control <?php echo $val_cls; ?>" <?php if ($fd['is_required'] == 'Y' && $val_cls=='') { echo "required"; } ?> value="<?php if(!is_array(@$fieldValues[$tablefieldname])) echo  @$fieldValues[$tablefieldname]; ?>">
								</div>
								</div>
					<?php   } ?>
					
						  <?php // Genrating select field for type select and multiple select
							if ($inputType == "select" || $inputType == "multipleselect") 
							{
						  ?>
								<div class="form-group col-md-6">
								<label class="col-md-12 control-label text-left" for="" >						
                                <?php  echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
                                        echo " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ; ?><?php echo  ")</b>";
                                 
                                if ($fd['is_required'] == 'Y') {
                                    echo "<span style='color:red;'> </span>";
                                } ?> 
								
								<?php if (!empty($fd['helptext'])) {
									$helptext = $fd['helptext'];
									echo " <i class='fa fa-question-circle' title='$helptext'></i>";
								} ?>								
								</label>
								<?php $options = Yii::app()->db->createCommand("SELECT bo.*, bm.master_table_name, bm.key_id, bm.field_value, bm.is_active_field,
												 bm.is_active_value FROM bo_infowiz_formfield_options as bo
												 LEFT JOIN bo_master_tables as bm ON bo.master_table_id=bm.id
												 WHERE bo.formfield_id=$fd[id] AND bo.master_table_id!=0 AND bo.is_active='Y' ORDER BY bo.id DESC")->queryRow();
												 
						         
							if(isset($options) && !empty($options))
							{							    
								$table_name=$options['master_table_name'];
								$key_id=$options['key_id'];
								$field_value=$options['field_value'];
								$is_active_field=$options['is_active_field'];
								$is_active_value=$options['is_active_value'];
							    $allList   = InfowizardQuestionMasterExt::getMasterList($table_name, $key_id, $field_value, $is_active_field, $is_active_value);							     
								?>
						        <div class="col-md-12">								
									<select name="<?php echo $tablefieldname;if ($inputType != "select") { echo "[]"; } ?>" 
										<?php if ($inputType == "multipleselect") {
											echo " multiple='true' style='max-height:120px;'";  } ?> placeholder='<?php echo $formName; ?>' id="<?php echo $tablefieldname;?>" class="form-control <?php echo $val_cls; ?>"  
												<?php if ($fd['is_required'] == 'Y' && $val_cls=='') {
													echo "required";
										} ?> >										
											<option value="">Please Select </option>
											<?php foreach ($allList as $key=>$val) { ?>
												<option value="<?php echo $key; ?>" <?php if(@$fieldValues[$tablefieldname]==$key) { echo "selected";}?>><?php echo $val; ?></option>
											<?php } ?>
									</select>    
								</div>
					<?php 	}else
								{							
									$options = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_formfield_options WHERE formfield_id=$fd[id] AND is_active='Y' ORDER BY id DESC")->queryAll(); ?>						
										<div class="col-md-12">
										<select name="<?php echo $tablefieldname; if ($inputType != "select") { echo "[]"; } ?>" 
											<?php if ($inputType == "multipleselect") {	echo " multiple='true' style='max-height:120px;'";  } ?> placeholder='<?php echo $formName; ?>' id="<?php echo $tablefieldname;?>" class="form-controll <?php echo $val_cls;?>"  
										<?php if ($fd['is_required'] == 'Y' && $val_cls=='') {
											echo "required";
											} ?>>
											
												<option value="">Please Select </option>
												<?php foreach ($options as $option) { ?>
													<option value="<?php echo $option['options']; ?>" <?php if(@$fieldValues[$tablefieldname]==$option['options']) { echo "selected";}?>><?php echo $option['options']; ?></option>
												<?php } ?>
										</select>    
										</div>
								
							<?php   } ?>		
						
							</div>
				<?php   } ?>
	
	
					<?php
				// Genrating select field for type select and multiple select
					if ($inputType == "checkbox" || $inputType == "radio") 
					{
						
					?>
                    <div class="form-group col-md-6">
                        <label class="col-md-12 control-label text-left" for="" >
							<?php echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
							echo " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ; ?><?php echo  ")</b>";
							;
							if ($fd['is_required'] == 'Y') {
								echo "<span style='color:red;'> *</span>";
							} ?> 
						<?php if (!empty($fd['helptext'])) {
							$helptext = $fd['helptext'];
							echo " <i class='fa fa-question-circle' title='$helptext'></i>";
						} ?>
                        </label>
                        <div class="col-md-12">
							<?php $options = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_formfield_options where formfield_id=$fd[id] AND is_active='Y' ORDER BY id DESC")->queryAll();
							/* echo "<pre>";
							print_r(@$fieldValues); */
							//echo $tablefieldname;
							//echo $inputType;
							?>
							<?php  
							$checkdradio = ""; 
							
							//print_r($fieldValues[$tablefieldname]);
							foreach ($options as $option) { 
							
								if($inputType== "radio") 
								{ 
									if(@$fieldValues[$tablefieldname]==$option['options'])
									{ 
										$checkdradio = "checked";
									} 
								}
							?>
                                <div class="col-md-6">
                                    <input name="<?php echo $tablefieldname; if($inputType== "checkbox") {
										echo "[]"; } ?>" type="<?php echo $inputType; ?>" value="<?php echo $option['options']; ?>" name="<?php echo $fd['id'] ?>" class="chk_<?php echo $tablefieldname; echo " "; echo $val_cls;?>" <?php echo $checkdradio; if($inputType== "checkbox") { if(in_array($option['options'],$fieldValues[$tablefieldname])){ echo "checked";} } ?>  >&nbsp;
									<?php echo $option['options']; ?>									
								</div> 
					<?php 	} ?>                            	   
                        </div>
						</div>
				<?php } ?>
						<?php
					// Genrating textarea
						if ($inputType == "textarea") {
							?>
							<div class="form-group col-md-6">
								<label class="col-md-12 control-label text-left" for="" >
								<?php echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
								echo " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ; ?><?php echo  ")</b>";
								;
								if ($fd['is_required'] == 'Y') {
									echo "<span style='color:red;'> *</span>";
								} ?>
								<?php if (!empty($fd['helptext'])) {
									$helptext = $fd['helptext'];
									echo " <i class='fa fa-question-circle' title='$helptext'></i>";
								} ?> 
								</label>
								<div class="col-md-12">
									<textarea name="<?php echo $tablefieldname; ?>" id="<?php echo $tablefieldname;?>" class="form-control <?php echo $val_cls;?> row="2" ><?php if(!is_array(@$fieldValues[$tablefieldname])) echo @$fieldValues[$tablefieldname];?>
									</textarea>
								</div>
							</div>
						<?php } ?>
						<?php
						// Genrating Calender					
						if ($inputType == "calender") {
							?>
							<div class="form-group col-md-6">
								<label class="col-md-12 control-label text-left" for="">
								<?php echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
								echo " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id'); ?><?php echo  ")</b>";											
								if ($fd['is_required'] == 'Y') {
									echo "<span style='color:red;'> *</span>";
								} ?>
								<?php if (!empty($fd['helptext'])) {
									$helptext = $fd['helptext'];
									echo " <i class='fa fa-question-circle' title='$helptext'></i>";
								} ?>
								</label>
								<div class="col-md-12">
									<input type="text" id="<?php echo $tablefieldname;?>" name="<?php  if(!is_array($tablefieldname)) echo $tablefieldname; ?>" class="datepicker form-control <?php echo $val_cls;?> value="<?php if(!is_array(@$fieldValues[$tablefieldname]))echo @$fieldValues[$tablefieldname];?>">
								</div>
							</div>
						<?php } ?>
						<?php 
						/*
					** Add More button Condition
					** Pankaj Singh 19-11-2018
				*/
					if ($inputType == "add_more_button") {?>
						<div class="form-group col-md-6">                
							<div class="col-md-12">
								<a href="javascript:;" class="btn btn-success add-more-btn" relf="<?php echo @$_GET['service_id']?>" rel="<?php echo $fd['page_name']; ?>" relid="<?php echo $id; ?>" ><i class="fa fa-plus"></i><?php 
								echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
								echo " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ; ?><?php echo  ")</b>";
							if ($fd['is_required'] == 'Y') {
								echo "<span style='color:red;'> *</span>";
							} ?>
							<?php if (!empty($fd['helptext'])) {
								$helptext = $fd['helptext'];
								echo " <i class='fa fa-question-circle' title='$helptext'></i>";
							} ?> </a>
							</div>
						</div>
					<div class="col-md-12" id="add_more_<?php echo $id;?>" style="">						 
						<table class="table table-striped table-bordered table-hover responsive-table" id="tbl_<?php echo $id;?>" style="">
						<tr>
							<?php foreach ($get_selected_field as $key => $valued) {
								if($fd['id']==$valued['button_id']){
							?>
							<th><?php echo $valued['formchk_id']; ?></th>
							<?php	} } ?>
						</tr>
					<?php //echo "<pre/>"; print_r($get_selected_field);
					$arrofIn=array(); ?>
					<?php foreach ($get_selected_field as $key => $valued) {
						if($fd['id']==$valued['button_id']){
							$fcode=$valued['formchk_id'];
							$btnID=$valued['button_id'];
							if(!in_array($valued['button_id'],$arrofIn)){
							$arrofIn[]=$valued['button_id'];						
					?>
					<?php
					for($k=0; $k<(count($allData23[$fcode]));$k++){ ?>
					<tr>
						<?php foreach($allDataMappedWithButton[$btnID] as $key1=>$datag){ ?>
							<td>
								<input class="form-control" name="<?php echo $datag;?>[]" type="text" value="<?php if(is_array($allData23[$datag])){ echo @$allData23[$datag][$k]; }else{echo $allData23[$datag];} ?>" readonly>
							</td>

						<?php } ?>
						<td><button class="btn-danger" onclick="$(this).closest('tr').remove();"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
					</tr>
					<?php }}} } ?>
					</table>
					</div>
				<?php }
						if ($keyy % 2 != 0) {
							echo "</div>";
						}
						?>
                        <?php } } ?>		
			
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
																<div class="col-lg-6 m--align-left">
																	<a href="#" class="btn btn-alert m-btn m-btn--custom m-btn--icon" data-wizard-action="prev">
																		<span>
																			<i class="la la-arrow-left"></i>
																			&nbsp;&nbsp;
																			<span>
																				Back
																			</span>
																		</span>
																	</a>
																</div>
																<div class="col-lg-6 m--align-right">
																	<a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon submitForm" data-wizard-action="submit">
																		<span>
																			<i class="la la-check"></i>
																			&nbsp;&nbsp;
																			<span>
																				Submit
																			</span>
																		</span>
                                                                                                                                            <!--<input type="submit" value="submit">-->
																	</a>
																	<a href="#" class="btn btn-success m-btn m-btn--custom m-btn--icon" data-wizard-action="next">
																		<span>
																			<span>
																				Save & Continue
																			</span>
																			&nbsp;&nbsp;
																			<i class="la la-arrow-right"></i>
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
<?php //} ?>



<!-- datepicker js -->
<link href="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/js/typeahead.min.js" type="text/javascript"></script>
<!-- datepicker js -->

<!-- form repeater js -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript">
</script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/form-repeater.min.js" type="text/javascript">
</script>
<!-- form repeater js -->

<link rel="stylesheet" href="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
<!-- Theme framework -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/eakroko.min.js"></script>


<script>
    $(document).ready(function () {
        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true
        });

        /* Add more pankaj singh */
		$('.add-more-btn').on('click',function(){
        //alert($(this).attr("rel"));
        var id = $(this).attr("rel");
        var service_id = $(this).attr("relf");
        var div_id = $(this).attr("relid");
        //alert(div_id);
        $.ajax({
          type: "GET",
          dataType: 'json',
          data:{"button_id":id,"service_id":service_id,"add_more_button_di":div_id},
          url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formFieldMaster/getAddmoreData",
          success: function(data){
               console.log(data);
               var tr_ = "<tr>";
               var td_ ='';
               var err = 0;
              $.each(data, function(key, item) {               
                  var id = item.id;
                  var vall;
                  var name = item.full_name;
                  var formchk_id  =item.formchk_id;
                  var selector = $('[name="'+formchk_id+'"]');
                   var cls ='';
                  //console.log(selector);
                    if ($(selector).is("input")) {
                        if($("input:radio[name='"+formchk_id+"']").attr('type')=='radio'){
                            vall = $("input:radio[name='"+formchk_id+"']:checked").val();
                            if($("input:radio[name='"+formchk_id+"']").hasClass('val')){
                            	cls ='val';
                            }
                            $("input:radio[name='"+formchk_id+"']").prop('checked', false);
                        }
                        else {
                            vall = $("input[name*='"+formchk_id+"']").val(); 
                            $('#'+formchk_id).val("");
                            if($("input[name*='"+formchk_id+"']").hasClass('val')){
                            	cls ='val';
                            }
                        }
                        
                    }
                    else if ($(selector).is("select") || $('#'+formchk_id).is("select")) {
                        if($('#'+formchk_id).prop('multiple')){
                            var selMulti = $.map($("#"+formchk_id+" option:selected"), function (el, i) {
                                return $(el).text();
                            });
                            vall = selMulti.join(", ");
                            if($('#'+formchk_id).hasClass('val')){
                            	cls ='val';
                            }
                            $("#"+formchk_id+" option").removeAttr("selected");
                        }
                        else { 
                            vall = $("select[name='"+formchk_id+"'] option:selected").text();
                            if($("select[name='"+formchk_id+"']").hasClass('val')){
                            	cls ='val';
                            }
                            $("#"+formchk_id+" option").removeAttr("selected");
                        }
                    } 
                    else if ($(selector).is("textarea")) {
                        vall = $("textarea[name='"+formchk_id+"']").val();
                        if($("textarea[name='"+formchk_id+"']").hasClass('val')){
                            	cls ='val';
                            }
                        $('#'+formchk_id).val("");
                    }
                    else if($('.chk_'+formchk_id).is(':checkbox')){
                        vall = $('.chk_'+formchk_id+':checked').map(function() {
                            return this.value;
                        }).get().join(',');
                        if($('.chk_'+formchk_id).hasClass('val')){
                            	cls ='val';
                            }
                        $('.chk_'+formchk_id+':checked').removeAttr('checked');
                    }
                    if(cls=='val' &&(vall=='' || vall=='undefined')){
						alert("Please fill the required field:  "+$("#"+formchk_id).attr('labelname'));                
						err = err+1;
						return false;						
                    }/*else if (cls=='val' && $("#"+formchk_id).is(":not(:checked)")){
                    	alert("Please fill the required field:  "+$("#"+formchk_id).attr('labelname'));                
						err = err+1;
						return false;
                    }*/
                    else{
                    	$('#'+formchk_id).val("");
                    	td_ +="<td><input name='"+formchk_id+"[]' value='"+vall+"' class='form-control' readonly/></td>";
                    }
                    
              });
              //alert(err);
              if(err==0){
              	$('#add_more_'+div_id).show();
              	tr_ +=td_+"</tr>";
               $(tr_).appendTo($('#tbl_'+div_id));
              }else return false;
             
              
            }
          });
		});
		$("#show_ukfcl").on('click',function(){
			$(".ukfcl").toggle();		
		});
                
                $(".submitForm").click(function(){
  document.getElementById("m_form").submit(); 
})
	});	
</script>