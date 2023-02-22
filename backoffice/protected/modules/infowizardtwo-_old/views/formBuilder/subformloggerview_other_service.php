<style type="text/css">
	.ukfcl {display:none;}	
	.page-footer-inner { padding: 1px 1px 1px !important; }
	.disabled_dropdown{		
		opacity: 0.6;
		pointer-events: none;
		background-color:#eef1f5;
		color: #555;
	}	
</style>
<!-- select2 -->


<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/eakroko.min.js"></script>

<?php 
$basePath = Yii::app()->basePath;
/*if(isset($_GET['service_id']) && $_GET['service_id']=='591.0')
{ 	
	include_once($basePath."/modules/infowizard/views/formBuilder/cafform_validation.php");
}else if(isset($_GET['service_id']) && $_GET['service_id']=='590.0'){
	include_once($basePath."/modules/infowizard/views/formBuilder/itda_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='121.0'){
	include_once($basePath."/modules/infowizard/views/formBuilder/121_0_validation.php");
 } else if(isset($_GET['service_id']) && $_GET['service_id']=='120.0'){	
	include_once($basePath."/modules/infowizard/views/formBuilder/120_0_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='332.0'){
		include_once($basePath."/modules/infowizard/views/formBuilder/332_0_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='334.0'){
		include_once($basePath."/modules/infowizard/views/formBuilder/334_0_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='336.0'){
		include_once($basePath."/modules/infowizard/views/formBuilder/336_0_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='593.0'){
		include_once($basePath."/modules/infowizard/views/formBuilder/593_0_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='328.0'){
		include_once($basePath."/modules/infowizard/views/formBuilder/328_0_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='119.0'){
		include_once($basePath."/modules/infowizard/views/formBuilder/119_0_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='119.1'){
		include_once($basePath."/modules/infowizard/views/formBuilder/119_1_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='119.3'){
		include_once($basePath."/modules/infowizard/views/formBuilder/119_3_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='119.5'){
		include_once($basePath."/modules/infowizard/views/formBuilder/119_5_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='227.0'){
		include_once($basePath."/modules/infowizard/views/formBuilder/227_0_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='227.1'){
		include_once($basePath."/modules/infowizard/views/formBuilder/227_1_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='227.3'){
		include_once($basePath."/modules/infowizard/views/formBuilder/227_3_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='227.5'){
		include_once($basePath."/modules/infowizard/views/formBuilder/227_5_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='227.6'){
		include_once($basePath."/modules/infowizard/views/formBuilder/227_6_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='226.0'){
		include_once($basePath."/modules/infowizard/views/formBuilder/226_0_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='226.1'){
		include_once($basePath."/modules/infowizard/views/formBuilder/226_1_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='226.3'){
		include_once($basePath."/modules/infowizard/views/formBuilder/226_3_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='226.5'){
		include_once($basePath."/modules/infowizard/views/formBuilder/226_5_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='228.0'){
		include_once($basePath."/modules/infowizard/views/formBuilder/228_0_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='228.1'){
		include_once($basePath."/modules/infowizard/views/formBuilder/228_1_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='228.3'){
		include_once($basePath."/modules/infowizard/views/formBuilder/228_3_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='228.5'){
		include_once($basePath."/modules/infowizard/views/formBuilder/228_5_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='228.6'){
		include_once($basePath."/modules/infowizard/views/formBuilder/228_6_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='226.6'){
		include_once($basePath."/modules/infowizard/views/formBuilder/226_6_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='597.0'){
		include_once($basePath."/modules/infowizard/views/formBuilder/597_0_validation.php");
 }else if(isset($_GET['service_id']) && $_GET['service_id']=='571.0'){
		include_once($basePath."/modules/infowizard/views/formBuilder/571_0_validation.php");
 } */
if(isset($_GET['service_id'])){
	$ss=explode(".", $_GET['service_id']);
	include_once($basePath."/modules/infowizard/views/formBuilder/".$ss[0].'_'.$ss[1]."_validation.php");
}

 ?>
<div class="portlet-body form">

<?php 
    extract($_GET);

    //echo "<pre/>"; print_r($fieldValues);
	//die;
	$categoryPreference = array();
	$arry_a = array();
	$arr_id = array();
	$categoryPreference = array();
	$get_selected_field = InfowizardQuestionMasterExt::get_selected_field($service_id);	
	$allData23 = InfowizardQuestionMasterExt::getsubmittedvalues($service_id,$sub_id);
				
	$sfArray=array();
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
	//echo "<pre>"; print_r($formData); die;
    foreach ($formData as $key => $fd) 
	{
		$showFlag=0;
		//print_r($fd); die;
	 	if(!in_array($fd['id'], $sfArray))
		{
			$inputType = $fd['input_type'];
			if (!in_array($fd['category_id'], $categoryPreference)) 
			{
				$keyy = -1;
				$categoryPreference[] = $fd['category_id'];
				$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
			?>
				<br>
				<div class="row"></div>
				<div class="portlet-title" id="title_<?php echo $tablefieldname;?>">
					<div class="caption" style="text-align:left;">
						<i class="fa fa-tags font-red-sunglo"></i>
						<span class="caption-subject font-red-sunglo bold uppercase">
							<?php echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowiz_form_categories', $fd['category_id'], 'category_name', 'id'); ?>
						</span>
					</div>
					<div class="actions">
						<div class="portlet-input input-inline input-small"></div>
					</div>
				</div><hr id="hr_<?php echo $tablefieldname;?>">
    	<?php } ?>
	<?php if(!in_array($fd['id'], $btnArray)){  //IF IN ARRAY START
			if ($keyy % 2 == 0) { 
				echo "<div>";
			} $keyy = $keyy + 1; 
			if ($inputType == "text" || $inputType == "number" || $inputType == "password") {  
			
			@$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ;
			?>
			<div class="form-group col-md-6" id="div_<?php echo $tablefieldname; ?>">
				<label class="col-md-12 control-label text-left" for=""  id="label_<?php echo $tablefieldname; ?>">
					<?php echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
					echo " <b class='ukfcl'>(" . @$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ; ?><?php echo  ")</b>";
					if ($fd['is_required'] == 'Y') echo "<span style='color:red;'> *</span>";
					if (!empty($fd['helptext'])) {
						$helptext = $fd['helptext'];
						echo " <i class='fa fa-question-circle' title='$helptext'></i>";
					} ?>
				</label>
				<div class="col-md-12">
					<input type="<?php echo $inputType; ?>" id="<?php echo $tablefieldname; ?>" name="<?php echo $tablefieldname; ?>" placeholder='<?php echo $formName ?>' class="form-control"  
					<?php if ($fd['is_required'] == 'Y') echo "required";?> value="<?php if(!is_array(@$fieldValues[$tablefieldname])) echo @$fieldValues[$tablefieldname]; ?>" readonly>
				</div>
			</div>
    <?php  } 
		if ($inputType == "select" || $inputType == "multipleselect"){
			@$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
			?>
			<div class="form-group col-md-6" id="div_<?php echo $tablefieldname; ?>">
				<label class="col-md-12 control-label text-left" for="" id="label_<?php echo $tablefieldname; ?>">						
					<?php  echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
					echo " <b class='ukfcl'>(" . @$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ; ?><?php echo  ")</b>";

					if ($fd['is_required'] == 'Y') echo "<span style='color:red;'> </span>"; 
					if (!empty($fd['helptext'])) {
						$helptext = $fd['helptext'];
						echo " <i class='fa fa-question-circle' title='$helptext'></i>";
					} ?>								
				</label>
				<?php 
					$options = Yii::app()->db->createCommand("
								SELECT bo.*, bm.master_table_name, bm.key_id, bm.field_value, bm.is_active_field,
										bm.is_active_value 
								FROM 
									bo_infowiz_formfield_options AS bo
								LEFT JOIN 
									bo_master_tables AS bm 
									ON 
										bo.master_table_id=bm.id
								WHERE 
									bo.formfield_id=$fd[id] 
									AND 
										bo.master_table_id!=0 
									AND 
										bo.is_active='Y' 
								ORDER BY 
									bo.id DESC")->queryRow();

					if(isset($options) && !empty($options))
					{							   
						$table_name=$options['master_table_name'];
						$key_id=$options['key_id'];
						$field_value=$options['field_value'];
						$is_active_field=$options['is_active_field'];
						$is_active_value=$options['is_active_value'];
						$allList   = InfowizardQuestionMasterExt::getMasterList($table_name, $key_id, $field_value, $is_active_field, $is_active_value);
						/* echo "<pre>";
						print_r(@$fieldValues[$tablefieldname]); */
						
						?>
						<div class="col-md-12">
							<select name="<?php echo $tablefieldname;if ($inputType != "select") { echo "[]"; } ?>" 
								<?php if ($inputType == "multipleselect") echo " multiple='true' style='max-height:120px;'"?> placeholder='<?php echo $formName; ?>' class="form-control disabled_dropdown"  <?php if ($fd['is_required'] == 'Y') echo "required";?> id="<?php echo $tablefieldname; ?>" >
								<option value="">Please Select </option>
								<?php foreach ($allList as $key=>$val) { ?>
									<option value="<?php echo $key; ?>" <?php if ($inputType == "multipleselect" && isset($fieldValues[$tablefieldname]) && !empty($fieldValues[$tablefieldname]) && is_array($fieldValues[$tablefieldname])) { if(in_array($key,@$fieldValues[$tablefieldname])){ echo "selected";}} else { if(@$fieldValues[$tablefieldname]==$key) { echo "selected";}}?>>
										<?php echo $val; ?>
									</option>
								<?php } ?>
							</select>    
						</div>
				<?php }
				else
				{							
					$options = Yii::app()->db->createCommand("
								SELECT * 
								FROM 
									bo_infowiz_formfield_options 
								WHERE 
									formfield_id=$fd[id] 
									AND 
										is_active='Y' 
								ORDER BY id DESC")->queryAll(); ?>						
					<div class="col-md-12">
						<select name="<?php echo $tablefieldname; if ($inputType != "select") { echo "[]"; } ?>" 
						<?php if ($inputType == "multipleselect") {	echo " multiple='true'";  } ?> placeholder='<?php echo $formName; ?>' class="form-control disabled_dropdown"  <?php if ($fd['is_required'] == 'Y') echo "required";?> id="<?php echo $tablefieldname; ?>">

						<option value="">Please Select </option>
						<?php foreach ($options as $option) { ?>
						<option value="<?php echo $option['options']; ?>" <?php if ($inputType == "multipleselect") { if(in_array($option['options'],@$fieldValues[$tablefieldname])){ echo "selected";} }else{ if(@$fieldValues[$tablefieldname]==$option['options']) { echo "selected";} }?>><?php echo $option['options']; ?></option>
						<?php } ?>
						</select>    
					</div>
			<?php } ?>
			</div>
	<?php } 
		if ($inputType == "checkbox" || $inputType == "radio"){
				 @$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ;
			?>
			<div class="form-group col-md-6" id="div_<?php echo @$tablefieldname;?>">
				<label class="col-md-12 control-label text-left" for=""  id="label_<?php echo $tablefieldname; ?>">
					<?php echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
					echo " <b class='ukfcl'>(" . @$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ; ?><?php echo  ")</b>";
					;
					if ($fd['is_required'] == 'Y') echo "<span style='color:red;'> *</span>";?> 
					<?php if (!empty($fd['helptext'])) {
						$helptext = $fd['helptext'];
						echo " <i class='fa fa-question-circle' title='$helptext'></i>";
					} ?>
				</label>
				<div class="col-md-12">
					<?php 
						$options = Yii::app()->db->createCommand("
									SELECT * 
									FROM 
										bo_infowiz_formfield_options 
									WHERE 
										formfield_id=$fd[id] 
										AND 
											is_active='Y' 
									ORDER BY id DESC")->queryAll();
						$checkdradio = "";
						foreach ($options as $option) { 
							if($inputType== "radio") 
							{ 
								if(@$fieldValues[$tablefieldname]==$option['options'])$checkdradio = "checked";
							}?>
							<div class="col-md-6">
								<input name="<?php echo $tablefieldname; if($inputType== "checkbox") {
								echo "[]"; } ?>" type="<?php echo $inputType; ?>" value="<?php echo $option['options']; ?>" id="<?php echo $fd['id'] ?>" <?php echo $checkdradio; if($inputType== "checkbox") { if(isset($fieldValues[$tablefieldname]) && is_array($fieldValues[$tablefieldname]) && in_array($option['options'],$fieldValues[$tablefieldname])){ echo "checked";} } ?> disabled id="<?php echo $tablefieldname; ?>">&nbsp;
								<?php echo $option['options']; ?>
								<?php if($inputType== "radio"){ ?>
									<input type="hidden" name="<?php echo $tablefieldname;?>" value="<?php echo $option['options']; ?>">
								<?php } ?>
								<?php if($inputType== "checkbox"){ 
									if(isset($fieldValues[$tablefieldname]) && is_array($fieldValues[$tablefieldname]) && in_array($option['options'],@$fieldValues[$tablefieldname])){
									?>
										<input type="hidden" name="<?php echo $tablefieldname;?>[]" value="<?php echo $option['options']; ?>">
									<?php } 
								}?>
							</div> 
					<?php } ?>                            	   
				</div>
			</div>
	<?php } 
		if ($inputType == "textarea") {
			 @$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
			?>
			<div class="form-group col-md-6"  id="div_<?php echo @$tablefieldname;?>">
				<label class="col-md-12 control-label text-left" for=""  id="label_<?php echo $tablefieldname; ?>">
					<?php echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
					echo " <b class='ukfcl'>(" . @$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ; ?><?php echo  ")</b>";
						;
					if ($fd['is_required'] == 'Y') echo "<span style='color:red;'> *</span>";
					if (!empty($fd['helptext'])) {
						$helptext = $fd['helptext'];
						echo " <i class='fa fa-question-circle' title='$helptext'></i>";
					} ?> 
				</label>
				<div class="col-md-12">
					<textarea name="<?php echo $tablefieldname; ?>" class="form-control" row="2" readonly id="<?php echo $tablefieldname; ?>"><?php if(!is_array(@$fieldValues[$tablefieldname])) echo @$fieldValues[$tablefieldname];?>
					</textarea>
					<!--<input type="text"  name="<?php //echo $tablefieldname; ?>" class="form-control" id="<?php //echo $tablefieldname; ?>" value="<?php //if(!is_array(@$fieldValues[$tablefieldname])) echo @$fieldValues[$tablefieldname];?>" style="height:100px;">-->
				</div>
			</div>
	<?php } 
					
		if ($inputType == "calender") { 
			@$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id'); 
		?>
			<div class="form-group col-md-6"  id="div_<?php echo @$tablefieldname;?>">
				<label class="col-md-12 control-label text-left" for=""  id="label_<?php echo $tablefieldname; ?>">
				<?php echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
				echo " <b class='ukfcl'>(" . @$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id'); ?><?php echo  ")</b>";											
				if ($fd['is_required'] == 'Y') echo "<span style='color:red;'> *</span>";?>
				<?php if (!empty($fd['helptext'])) {
					$helptext = $fd['helptext'];
					echo " <i class='fa fa-question-circle' title='$helptext'></i>";
				} ?>
				</label>
				<div class="col-md-12">
					<input type="text" name="<?php echo $tablefieldname; ?>" class="form-control" value="<?php echo @$fieldValues[$tablefieldname];?>" readonly id="<?php echo $tablefieldname; ?>">
				</div>
			</div>
		<?php }  	
	}
	else{ //IF IN ARRAY END
			if ($inputType == "add_more_button") {
				$flagTab = 0;
				$flagtbl = 0;
	?>
			<div class="form-group col-md-12">
				<table class="table table-striped table-bordered table-hover responsive-table addmore_tbl  <?php echo $tblID="tbl_".$fd['id'];?>" id="forest_table" style="">
				<tr>
					<?php 
					//echo "<pre/>"; print_r($get_selected_field); die;
					if(isset($get_selected_field) && !empty($get_selected_field))
					{	
						foreach ($get_selected_field as $key => $valued) {
							if($fd['id']==$valued['button_id']){?>
								<th>
									<?php 						
										echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $valued['formvar_id'], 'name', 'formvar_id');?> (<?php echo $valued['formchk_id']; ?>)
								</th>
						<?php } 
						}
					}	
					?>
				</tr>
				<?php //echo "<pre/>"; print_r($get_selected_field);die;
				$arrofIn=array();
					
				if(isset($get_selected_field) && !empty($get_selected_field))
				{		
					foreach ($get_selected_field as $key => $valued) {
						 if($fd['id']==$valued['button_id']){
							$fcode=$valued['formchk_id'];
							$btnID=$valued['button_id'];
							//print_r($arrofIn);die;
							
							if(is_array($arrofIn) && !in_array($valued['button_id'],$arrofIn)){
								$arrofIn[]=$valued['button_id'];
								if(isset($allData23[$fcode]) && !empty($allData23[$fcode]))
								{	
														
									for($k=0; $k<(count($allData23[$fcode]));$k++){ 
									?>
									<tr>
										<?php 
										if(isset($allDataMappedWithButton[$btnID]) && !empty($allDataMappedWithButton[$btnID])) 
										{ 
											$flagtbl = 1;
											$fomFeildMasterArr = array('UK-FCL-00298_0','UK-FCL-00299_0');
											foreach($allDataMappedWithButton[$btnID] as $key1=>$datag){ 
												if(isset($allData23[$datag]) && is_array($allData23[$datag])){ 
													$gho=@$allData23[$datag][$k]; 
												}else{
													$gho=@$allData23[$datag];
												}	
												
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
										<td>
											<input class="form-control" type="text" value="<?php if(isset($approvalval) && !empty($approvalval)){ echo $approvalval;}else{ if(isset($allData23[$datag]) && is_array($allData23[$datag])){ echo @$allData23[$datag][$k]; }else{echo @$allData23[$datag];} } ?>" title="<?php if(isset($allData23[$datag]) && is_array($allData23[$datag])){ echo @$allData23[$datag][$k]; }else{echo @$allData23[$datag];} ?>" readonly>
										</td>
										<?php }
										}
										?>
									</tr>
									<?php 
									}
								}
							}								
						} 
					}
				}
				?>
				</table>
				<?php if($flagtbl==0){ ?>
				<script>
				$(".<?php echo @$tblID; ?>").remove();
				</script>
				<?php }?>
			</div>
							
<?php 		}//IF IN ARRAY ELSE END
		}	
	}
		if ($keyy % 2 != 0) { echo "</div>";} 
	}
?>	
	<?php
		// document list for Verifier 
		$documents_datas = array();
		$appSubID=$app_Sub_id;
		$sqlspapp="Select bo_sp_applications.sno,bo_sp_applications.sp_tag,bo_new_application_submission.dept_id,bo_new_application_submission.user_id,
bo_new_application_submission.processing_level from bo_sp_applications
		INNER JOIN  bo_new_application_submission 
		ON bo_new_application_submission.submission_id=bo_sp_applications.app_id 
		INNER JOIN  sso_service_providers 
		ON bo_new_application_submission.dept_id=sso_service_providers.department_id 		
		where bo_sp_applications.app_id='$appSubID' AND sso_service_providers.service_provider_tag=bo_sp_applications.sp_tag"; 		
		$result = Yii::app()->db->createCommand($sqlspapp)->queryRow();
			/* echo "<pre>";
			print_r($result);die; */
		if(isset($result)){
			$role_id = $_SESSION['role_id'];
			$sqlVeriSql = "Select * from bo_new_application_submission 
			INNER JOIN bo_infowiz_form_builder_configuration on bo_infowiz_form_builder_configuration.service_id=bo_new_application_submission.service_id AND bo_new_application_submission.processing_level=bo_infowiz_form_builder_configuration.processing_level AND bo_infowiz_form_builder_configuration.current_role_id='$role_id' AND bo_infowiz_form_builder_configuration.can_revert_to_investor='Y' AND bo_new_application_submission.submission_id='$appSubID'"; 
			$VeriFyData = Yii::app()->db->createCommand($sqlVeriSql)->queryRow();
			
			$sqlsupportDoc = "Select * from bo_new_application_submission WHERE bo_new_application_submission.submission_id='$appSubID'"; 
			
			$supportDocArr = Yii::app()->db->createCommand($sqlsupportDoc)->queryRow();
			/*  echo "<pre>";
			print_r($VeriFyData);die;  */
	
	?>
	<div class='row'>&nbsp;</div>
	<div id='portlet box green' style="background-color:#3996bd;border:1px solid #32c5d2;">
   		<div class="portlet-title" style="border-bottom:0;padding:10px 7px ;margin-bottom:0;color:#fff;">
			<div class="caption">Uploaded Documents</div>
			<?php if(isset($supportDocArr['certificate_path']) && !empty($supportDocArr['certificate_path'])){?>			
				<div style="float: left;display: inline-block;padding: 12px 0 8px;"><a href="<?php echo $supportDocArr['certificate_path'];?>" style="color:#fff;" class="btn btn-primary" target="_blank">Download Supporting Documents</a></div>
			<?php }?>
			<?php if(isset($VeriFyData) && !empty($VeriFyData)){?>			
				<div style="float: right;display: inline-block;padding: 12px 0 8px;"><a href="/backoffice/dms/DepartmentDMSNew/view/sno/<?php echo base64_encode($result['sno']); ?>/user/<?php echo base64_encode($VeriFyData['user_id'])?>" style="color:#fff;" class="btn btn-primary">Verify Documents</a></div>
			<?php }?>
		</div>
	
			<div class="portlet-body" style="background-color: #fff;">				
				<?php  				
				
					$AppDmsMapExt = new ApplicationDmsDocumentsMappingExt;
					$status_array['U'] = 'Pending';
					$status_array['V'] = 'Approved';
					$status_array['R'] = 'Rejected';
					$status_array_lb['U'] = 'warning';
					$status_array_lb['V'] = 'success';
					$status_array_lb['R'] = 'danger';
				
					$list_arr =  $AppDmsMapExt::getAllUsedDocumentsOfInvestorServiceWise($result['sno'],$result['user_id'],'U');  
					//print_r($list_arr);die;
				?>
														
				<table id="sample_31" class="table table-striped table-bordered" width="100%">
					<thead>
						<tr>
							<th class="td_center">S.N.</th>
							<th class="td_center">Document Code</th>
							<th class="td_left">Document Name</th>
							<th class="td_center">Date</th>
							<th class="td_center">Status</th>
							<th class="td_center">Download</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$docStatusFlag=array("pending"=>false,"rejected"=>false);
						$verifiedDocumentflg=0;
						$rejectedDocumentflg=0;
						$checkDuplicate=array();
						if($list_arr){
							$sn =1;
							/*echo "<pre>";
							print_r($list_arr);*/
							foreach($list_arr as $key=>$val_arr){

								if($verifiedDocumentflg==0)
								{

								}  
								if(!in_array($val_arr['chklist_id'],$checkDuplicate))
								{
									$checkDuplicate[]=$val_arr['chklist_id'];
									if($val_arr['status']!="V" && $val_arr['status']!="R")
										$docStatusFlag['pending']=true;   
									if($val_arr['status']=="R")
										$docStatusFlag['rejected']=true;  
									?>
									<tr>
									<td class="td_center"><?php echo $sn; ?></td>
									<td class="td_center"><?php echo $val_arr['chklist_id']; ?></td>
									<td class="td_left"><?php echo $val_arr['d_name']; ?></td>
									<td class="td_center"><?php echo $val_arr['created_on']; ?></td>
									<td class="td_center">
									<span class="label label-<?php echo $status_array_lb[$val_arr['status']]; ?>"><i class="fa fa-hourglass-half fa-spin-hover"></i>  <?php echo $status_array[$val_arr['status']]; ?> </span>
									</td>
									<td class="td_center">
									<a target="_blank" href="<?php echo FRONT_BASEURL."themes/backend/mydoc/".$val_arr['iuid']."/".$val_arr['document_name']; ?>">View</a>
									<!--| <a href="<?php echo Yii::app()->request->baseUrl; ?>/dms/DepartmentDMS/DownloadMyDocument/ref_no/<?php echo base64_encode($val_arr['doc_ref_number']); ?>/iuid/<?php echo base64_encode($val_arr['iuid']); ?>">Download</a>-->
									</td>

									</tr>
								<?php ++$sn; 
									}
							}
						}else{
							echo "<tr><td colspan='6' style='text-align:center;'>No document found.</td></tr>";
						} 
						?>
					</tbody>
				</table>
			</div>		
	</div>
	<?php }?>

<?php 
if($formCodeID !=1 && $is_dept_active !="no" ){ ?>

<!-- Departmental Processing Form -->
			<div class="row deptuseonly" style="padding: 12px;">
				 <?php
					//$pageID = $_GET['pageID'];			
					$categoryPreference = array();
					/*  echo "<pre>";
					print_r($processingformData);  */
					foreach ($processingformData as $key => $fd) 
					{
						/* if($pageID==$fd['page_name'])
						{ */
							$inputType = $fd['input_type'];
							if (!in_array($fd['category_id'], $categoryPreference)) 
							{
								$keyy = -1;
								$categoryPreference[] = $fd['category_id'];
								
								$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
							?>
								</br>
								<div class="row"></div>
								<div class="portlet-title" id="title_<?php echo $tablefieldname;?>">
									<div class="caption" style="text-align:left;">
										<i class="fa fa-tags font-red-sunglo"></i>
										<span class="caption-subject font-red-sunglo bold uppercase">
											<?php echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowiz_form_categories', $fd['category_id'], 'category_name', 'id'); 
											 $catNameDept=$fd['category_id'];
											
											?>
										</span>
									</div>
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
							if($keyy % 2 == 0) { 
								if(!isset($flg)) 
								{	
									echo "<div class='row'>"; 
								}
							} 
							$keyy = $keyy + 1; 
							?>
							<?php // Genrating text field for type text and number 
							if ($inputType == "text" || $inputType == "number" || $inputType == "password") 
							{  
								$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id'); 
							?>
								<div class="form-group col-md-6" id="div_<?php echo $tablefieldname;?>">
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
										<input type="<?php echo $inputType; ?>" name="<?php echo $tablefieldname; ?>" placeholder='<?php echo $formName ?>' class="form-control"  
										<?php if ($fd['is_required'] == 'Y') {
											echo "required";
										} ?> id="<?php echo $tablefieldname;?>">
									</div>
								</div>
					 <?php  } ?>					
							<?php // Genrating select field for type select and multiple select
							if ($inputType == "select" || $inputType == "multipleselect") 
							{
								$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id'); 
							?>
								<div class="form-group col-md-6" id="div_<?php echo $tablefieldname;?>">
									<label class="col-md-12 control-label text-left" for="">						
										<?php  echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
										echo " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ; ?><?php echo  ")</b>";
										; 
										if ($fd['is_required'] == 'Y') {
										echo "<span style='color:red;'> </span>";
										} ?> 

										<?php if (!empty($fd['helptext'])) {
										$helptext = $fd['helptext'];
										echo " <i class='fa fa-question-circle' title='$helptext'></i>";
										} ?>								
									</label>
									<?php 	$rawquery="";
									
									$configOptions = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_config_values WHERE service_id ='$_GET[service_id]' AND formvar_code='$tablefieldname' AND is_active='Y'")->queryRow();	
									/*echo "SELECT * FROM bo_infowiz_form_builder_config_values WHERE service_id ='$_GET[service_id]' AND formvar_code='$tablefieldname'"; die;*/
									if(!empty($configOptions)){
										$rawquery = $configOptions["raw_query"];
									}
								//	echo $rawquery; die;
									
									$options = Yii::app()->db->createCommand("SELECT bo.*, bm.master_table_name, bm.key_id, bm.field_value, bm.is_active_field,
													 bm.is_active_value FROM bo_infowiz_formfield_options as bo
													 LEFT JOIN bo_master_tables as bm ON bo.master_table_id=bm.id
													 WHERE bo.formfield_id=$fd[id] AND bo.master_table_id!=0 AND bo.is_active='Y' ORDER BY bo.id DESC")->queryRow();
										/*echo "Here";*/
										$flgU=0;
											if(!empty($rawquery)){
												//$allList   = InfowizardQuestionMasterExt::getConfigList($table_name, $key_id, $field_value, $is_active_field, $is_active_value,$rawquery);
												$allList   = InfowizardQuestionMasterExt::getConfigList($rawquery);
											//	print_r($allList);die;
												$flgU=1;
											}
											//die("====");
									if((isset($options) && !empty($options) )|| ($flgU==1))
									{ 			
											    if($flgU!=1){
											$table_name=$options['master_table_name'];
											$key_id=$options['key_id'];
											$field_value=$options['field_value'];
											$is_active_field=$options['is_active_field'];
											$is_active_value=$options['is_active_value'];
											//echo $table_name."--".$key_id."--".$field_value."--".$is_active_field."--".$is_active_value;
											$allList   = InfowizardQuestionMasterExt::getMasterList($table_name, $key_id, $field_value, $is_active_field, $is_active_value);
											
											
											}
											//show selected department for CAF
											$selectedDeptArr = array();
											if(isset($selectedDept) && !empty($selectedDept))
											{
												$selectedDeptArr = array_column($selectedDept, 'dept_id');
											}	
											
									?>
									<div class="col-md-12">
										<select name="<?php echo $tablefieldname;if ($inputType != "select") { echo "[]"; } ?>" 
											<?php if ($inputType == "multipleselect") {	echo " multiple='true' style='max-height:120px;'";  } ?> placeholder='<?php echo $formName; ?>' class="<?php if ($inputType == "multipleselect") { echo 'select2-me'; }else{ echo 'form-control'; }?>"  
											<?php if ($fd['is_required'] == 'Y') {
												echo "required";
											} ?> id="<?php echo $tablefieldname;?>">
											
												<option value="">Please Select </option>
												<?php foreach ($allList as $key=>$val) { //UK-FCL-00190_0?>
													<option value="<?php echo $key; ?>" <?php if ($tablefieldname=='UK-FCL-00190_0' && in_array($key,$selectedDeptArr)){ echo "selected"; } ?> ><?php echo $val; ?></option>
												<?php } ?>
										</select>    
									</div>
									
									
									
							<?php 	}else{
										//show selected department for CAF
											
										$options = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_formfield_options 
			WHERE formfield_id=$fd[id] AND is_active='Y' ORDER BY id DESC")->queryAll(); ?>						
										<div class="col-md-12">
											<select name="<?php echo $tablefieldname;if ($inputType != "select") { echo "[]"; } ?>" <?php if ($inputType == "multipleselect") {		echo " multiple='true' style='max-height:120px;'";  } ?> placeholder='<?php echo $formName; ?>' class="<?php if ($inputType == "multipleselect") { echo 'select2-me'; }else{ echo 'form-control'; }?>"  
												<?php if ($fd['is_required'] == 'Y') {
													echo "required";
												} ?> id="<?php echo $tablefieldname;?>">
												
													<option value="">Please Select </option>
													<?php foreach ($options as $option) { ?>
														<option value="<?php echo $option['options']; ?>"><?php echo $option['options']; ?></option>
													<?php } ?>
											</select>    
										</div>								
								<?php } ?>		
									
								</div>
					<?php 	} ?>	
							<?php
							// Genrating select field for type select and multiple select
							if($inputType == "checkbox" || $inputType == "radio") 
							{
								$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id'); 
						?>
								<div class="form-group col-md-6" id="div_<?php echo $tablefieldname;?>">
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
										<?php 
										$options = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_formfield_options where formfield_id=$fd[id] AND is_active='Y' ORDER BY id DESC")->queryAll();
										
										?>
										<?php foreach ($options as $option) 
										{ 
										?>
											<div class="col-md-6">
												<input name="<?php echo $tablefieldname;if ($inputType == "checkbox") {	echo "[]";} ?>" type="<?php echo $inputType; ?>" value="<?php echo $option['options']; ?>" name="<?php echo $fd['id'] ?>" id="<?php echo $tablefieldname;?>">&nbsp;	<?php echo $option['options']; ?>
											</div> 
										<?php } ?>
										 
									</div>
								</div>
						<?php } ?>
						<?php
						// Genrating textarea
						if ($inputType == "textarea") 
						{
							$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id'); 
						?>
							<div class="form-group col-md-6" id="div_<?php echo $tablefieldname;?>">
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
									<textarea name="<?php echo $tablefieldname; ?>" id="<?php echo $tablefieldname; ?>" class="form-control comment" row="2"></textarea>
								</div>
							</div>
					<?php } ?>
						<?php
						// Genrating Calender
						if ($inputType == "calender") 
						{
							$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id'); 
						?>
							<div class="form-group col-md-6" id="div_<?php echo $tablefieldname;?>">
								<label class="col-md-12 control-label text-left" for="" >
									<?php echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
									echo " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id')  ; ?><?php echo  ")</b>";
									
									if ($fd['is_required'] == 'Y') {
										echo "<span style='color:red;'> *</span>";
									} ?>
									<?php if (!empty($fd['helptext'])) {
										$helptext = $fd['helptext'];
										echo " <i class='fa fa-question-circle' title='$helptext'></i>";
									} ?>
								</label>
								<div class="col-md-12">
									<input type="inputType" name="<?php echo $tablefieldname; ?>" id="<?php echo $tablefieldname; ?>" class="datepicker form-control">
								</div>
							</div>
							 
					<?php } ?>
					<?php
						// Genrating date time Calender
						if($inputType == "datetimecalendar") 
						{
							$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id'); 
						?>
							<div class="form-group col-md-6" id="div_<?php echo $tablefieldname;?>">
								<label class="col-md-12 control-label text-left" for="" >
									<?php echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
									echo " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id')  ; ?><?php echo  ")</b>";
									
									if ($fd['is_required'] == 'Y') {
										echo "<span style='color:red;'> *</span>";
									} ?>
									<?php if (!empty($fd['helptext'])) {
										$helptext = $fd['helptext'];
										echo " <i class='fa fa-question-circle' title='$helptext'></i>";
									} ?>
								</label>
								<div class="col-md-12">	
									<?php 
									$latesInsDate = "";
									if($tablefieldname == 'UK-FCL-00813_0'){
										$connection=Yii::app()->db; 
										$sql = 	"SELECT inspection_date from bo_infowiz_formbuilder_application_forward_level WHERE app_Sub_id=$_GET[app_Sub_id] order by appr_lvl_id DESC limit 1";
										$command = $connection->createCommand($sql);
										$linsd = $command->queryRow();
										if(isset($linsd['inspection_date']) && !empty($linsd['inspection_date'])){
											$latesInsDate = @$linsd['inspection_date'];
										}
									}	
									?>
									<input type="text" name="<?php echo $tablefieldname; ?>" id="<?php echo $tablefieldname; ?>" class="controls form-control date form_datetime" data-date-format="yyyy-mm-dd HH:ii:ss" value="<?php echo $latesInsDate;?>">
								</div>
							</div>
							 
					<?php } ?>
							
						<?php	
						
						if($inputType == "button") 
						{ 	
							//exit($formCodeID."pankaj");
							if(!isset($flg)) { $flg =0; }
							
							if($flg==0 && $catNameDept=="31"  && in_array($_GET['service_id'],array('191.0','226.0','228.0','227.0'))){ 
								echo '<div class="form-group col-md-6" style="$sshow">
												<label class="col-md-12 control-label text-left" for="">
													Upload Signed Certificate
												</label>
												<div class="col-md-12">								
													<input type="file" id="signed_certificate" name="signed_certificate"/>
												</div>
											</div><div class="clear"></div>'; 	
								if($formCodeID!=1)
								{
									$sshow= "display:block";
								}else{
									$sshow= "display:none";
								}
								/* echo "</div><div class'row'><br></div><div class='row deptuseonly showApprov showReject' ><label class='col-md-3 control-label text-left' style='padding-top:0px;$sshow'>Upload Supporting Documents</label><div class='col-md-3' style='$sshow'><input type='file' id='upload' name='upload'/></div><div></div><div class='row showalways' id='processingButton' style='text-align:center;'><div class='clear'></div>"; */	 
								echo '</div><div class="row"><br></div><div class="row deptuseonly showApprov showReject">
											<div class="form-group col-md-6" style="$sshow">
												<label class="col-md-12 control-label text-left" for="">
													Upload Supporting Documents
												</label>
												<div class="col-md-12">								
													<input type="file" id="upload" name="upload"/>
												</div>
											</div></div><div class="row showalways" id="processingButton" style="text-align:center;"><div class="clear"></div></div>'; 	
											
								$flg=1; 
							}
							if(!isset($flg2)) { $flg2 =0; }
							if($flg2==0 && $catNameDept=="141"){ 
								if($formCodeID!=1)
								{
									$sshow= "display:block";
								}else{
									$sshow= "display:none";
								} 								
								echo '<div class="row"><br></div><div class="row deptuseonly showApprov showReject">
											<div class="form-group col-md-6 inspectionReport">
												<label class="col-md-12 control-label text-left" for="">
													Upload Inspection Report
												</label>
												<div class="col-md-12">								
													<input type="file" id="inspection_report" name="inspection_report"/>
												</div>
											</div></div><div class="row showalways" id="processingButton" style="text-align:center;"><div class="clear"></div></div>'; 	
								$flg2=1;
							}	
							$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
							$status = "";
						//echo $formName;
							if($formName=='Approve'){
							   $status = "A"; $cls="btn btn-success"; 
							    $showFlag=1;							    
							   //if(!empty($allData['can_approve']) && $allData['can_approve']=='Y') { $showFlag=1;}
							}
							elseif($formName=='Reject'){
								$status = "R"; $cls="btn btn-primary";  $showFlag=1;
								//if(!empty($allData['can_reject']) && $allData['can_reject']=='Y') { $showFlag=1;}
							}
							elseif($formName=='Revert' ){
								$status = "H"; $cls="btn btn-primary";  

								$showFlag=1; 
								//if(!empty($allData['can_revert']) && $allData['can_revert']=='Y') { $showFlag=1;}
							}
							elseif($formName=='Forward'){
								$status = "F";	 $cls="btn btn-warning	";  $showFlag=1;
								//if(!empty($allData['can_forward']) && $allData['can_forward']=='Y') { $showFlag=1;}
							}
							elseif($formName=='Submit'){	
								$status = "V";	 $cls="btn btn-primary ";  $showFlag=1;
								//if(!empty($allData['can_submit']) && $allData['can_submit']=='Y') { $showFlag=1;}else{$showFlag=1;}
							}
							elseif($formName=='Forward to Approver'){	
								$status = "FA";	 $cls="btn btn-primary ";  $showFlag=1;
								//if(!empty($allData['can_submit']) && $allData['can_submit']=='Y') { $showFlag=1;}else{$showFlag=1;}
							}
							elseif($formName=='Revert to Nodal'){	
								$status = "P";	 $cls="btn btn-primary ";  $showFlag=1;
								//if(!empty($allData['can_submit']) && $allData['can_submit']=='Y') { $showFlag=1;}else{$showFlag=1;}
							}
							elseif($formName=='Schedule Inspection'){	
								$status = "INSD";	 $cls="btn btn-primary ";  $showFlag=1;
								//if(!empty($allData['can_submit']) && $allData['can_submit']=='Y') { $showFlag=1;}else{$showFlag=1;}
							}elseif($formName=='Save Inspection Detail'){	
								$status = "SINS";	 $cls="btn btn-primary ";  $showFlag=1;
								//if(!empty($allData['can_submit']) && $allData['can_submit']=='Y') { $showFlag=1;}else{$showFlag=1;}
							}
						?>
							<?php
							//exit($showFlag."--".$formCodeID);
							// $docStatusFlag=array("pending"=>false,"rejected"=>false);
							// echo "<pre>";print_r($docStatusFlag);die;
							//echo $status;
							if(isset($formCodeID) && !$docStatusFlag['pending'])
							{
								/*$verifiedDocumentflg=1;
							    $rejectedDocumentflg=1;*/
								//if($showFlag==1 && (($docStatusFlag['rejected'] && $status=='H') || !$docStatusFlag['rejected'])){
								if($showFlag==1){ 
							?>
									<input type="button"  value="<?php echo $formName; ?>" class="<?php echo $cls; ?> status_butt" rel="<?php echo $status;?>">
							<?php } 							
							}else{
								if($showFlag==1 && !$docStatusFlag['pending'])
								{
							?>		<a href="<?php echo $_SERVER['REQUEST_URI'];?>/status/<?php echo $status;?>" class="<?php echo $cls; ?>"><?php echo $formName; ?>
									</a>	
							<?php	
								}
							}
							?>
								
							
				<?php 	} ?>
						<?php if ($inputType != "button") {
								if ($keyy % 2 != 0) {
									echo "</div>";
								}
						}
						?>
				<?php 		
					} 
				?>
			
			<input type="hidden" name="app_Sub_id" value="<?php echo $sub_id; ?>">
			<input type="hidden" name="app_status" id="app_status" value="">
			<input type="hidden" name="service_id" value="<?php echo $service_id;?>">
			<input type="hidden" name="form_id" value="<?php echo $formCodeID;?>">
	
			</div>
		<!-- Departmental Processing Form End Here1-->	
	<?php } ?>
</div>
</div>
<?php 
$sqlInspDateAdd = "Select count(*) as totInsDate from bo_infowiz_formbuilder_application_forward_level WHERE bo_infowiz_formbuilder_application_forward_level.app_Sub_id='$sub_id' AND action_status='INSD' order by appr_lvl_id DESC"; 
$sqlInspDateShow = Yii::app()->db->createCommand($sqlInspDateAdd)->queryRow();
?>

<script type="text/javascript">
	$(".status_butt").on('click',function(){
			var butt_sttaus = $(this).attr('rel');
			$("#app_status").val(butt_sttaus);
			$("#UK-FCL-00810_0").next('.field-validation-error').remove();
			$("#UK-FCL-00812_0").next('.field-validation-error').remove();
			$("#UK-FCL-00813_0").next('.field-validation-error').remove();
			$("#UK-FCL-00814_0").next('.field-validation-error').remove();
			$("#UK-FCL-00815_0").next('.field-validation-error').remove();
			$("#UK-FCL-00816_0").next('.field-validation-error').remove();
			$("#UK-FCL-00181_2").next('.field-validation-error').remove();
			$("#inspection_report").next('.field-validation-error').remove();
			$("#signed_certificate").next('.field-validation-error').remove();
			
			
			if(butt_sttaus=='INSD' && $("#UK-FCL-00810_0").val()==''){
				$("#UK-FCL-00810_0").after("<div style='color:red;margin-bottom:20px;' class='field-validation-error'>Please enter inspection date.</div>");
				return false;
			}
			else if(butt_sttaus=='INSD' && $("#UK-FCL-00812_0").val()==''){
				$("#UK-FCL-00812_0").after("<div style='color:red;margin-bottom:20px;' class='field-validation-error'>Please enter inspection schedule comment.</div>");
				return false;
			}else if(butt_sttaus=='SINS' && $("#UK-FCL-00813_0").val()==''){
				$("#UK-FCL-00813_0").after("<div style='color:red;margin-bottom:20px;' class='field-validation-error'>Please enter inspection start date.</div>");
				return false;
			}else if(butt_sttaus=='SINS' && $("#UK-FCL-00814_0").val()==''){
				$("#UK-FCL-00814_0").after("<div style='color:red;margin-bottom:20px;' class='field-validation-error'>Please enter inspection end date.</div>");
				return false;
			}else if(butt_sttaus=='SINS' && $("#UK-FCL-00815_0").val()==''){
				$("#UK-FCL-00815_0").after("<div style='color:red;margin-bottom:20px;' class='field-validation-error'>Please enter inspection completed comment.</div>");
				return false;
			}else if(butt_sttaus=='SINS' && $("#UK-FCL-00816_0").val()=='' && $("#div_UK-FCL-00816_0").css('display')=='block'){
				$("#UK-FCL-00816_0").after("<div style='color:red;margin-bottom:20px;' class='field-validation-error'>Please enter reason for delay.</div>");
				return false;
			}else if(butt_sttaus=='SINS' && $("#inspection_report")[0].files.length==0){
				$("#inspection_report").after("<div style='color:red;margin-bottom:20px;' class='field-validation-error'>Please select inspection report.</div>");
				return false;
			}else if(butt_sttaus=='A' && $("#UK-FCL-00181_2").val()==''){
				$("#UK-FCL-00181_2").after("<div style='color:red;margin-bottom:20px;' class='field-validation-error'>Please enter comment.</div>");
				return false;
			}
	<?php if($_GET['service_id']!='571.0') { ?>
			else if(butt_sttaus=='A' && $("#signed_certificate")[0].files.length==0 ){
			
				$("#signed_certificate").after("<div style='color:red;margin-bottom:20px;' class='field-validation-error'>Please select signed certificate.</div>");
				return false;
			
			}
				<?php } ?>
				else if(butt_sttaus=='R' && $("#UK-FCL-00181_2").val()==''){
				$("#UK-FCL-00181_2").after("<div style='color:red;margin-bottom:20px;' class='field-validation-error'>Please enter comment.</div>");
				return false;
			}else if(butt_sttaus=='P' && $("#UK-FCL-00181_2").val()==''){
				$("#UK-FCL-00181_2").after("<div style='color:red;margin-bottom:20px;' class='field-validation-error'>Please enter comment.</div>");
				return false;
			}else if(butt_sttaus=='FA' && $("#UK-FCL-00181_2").val()==''){
				$("#UK-FCL-00181_2").after("<div style='color:red;margin-bottom:20px;' class='field-validation-error'>Please enter comment.</div>");
				return false;
			}else if(butt_sttaus=='H' && $("#UK-FCL-00181_2").val()==''){
				$("#UK-FCL-00181_2").after("<div style='color:red;margin-bottom:20px;' class='field-validation-error'>Please enter comment.</div>");
				return false;
			}else{	
				$("#FB_form").submit();	
				return true;				
			}	
			
			
			/* $("#file_error").html("");
	$(".demoInputBox").css("border-color","#F0F0F0");
	var file_size = $('#file')[0].files[0].size;
	if(file_size>2097152) {
		$("#file_error").html("File size is greater than 2MB");
		$(".demoInputBox").css("border-color","#FF0000");
		return false;
	}  */
	});
	$(".addmore_tbl").each(function(){
		
	});	
	$('.form_datetime').datetimepicker({
        minDate:new Date(),
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	
	$(document).ready(function(){
		$("#div_UK-FCL-00816_0").hide();
		$("#UK-FCL-00813_0").prop("readonly", true);
		$("#UK-FCL-00814_0").on('change',function(){
			var startDate = $("#UK-FCL-00813_0").val();
			var endDate = $("#UK-FCL-00814_0").val();
			/* alert(startDate);
			alert(endDate);
			alert(Date.parse(startDate));
			alert(Date.parse(endDate)); */
			if(Date.parse(startDate) > Date.parse(endDate)){
			   alert("Inspection End date should be greater then inspection start date.");
			   $("#div_UK-FCL-00814_0").val("");
			   return false;
			}
			var startDate1 =  new Date(startDate);
			var endDate1 = new Date(endDate);
			var diff =(endDate1.getTime() - startDate1.getTime()) / 1000;
			diff /= (60 * 60);
			var totHour = Math.abs(Math.round(diff));
			/* alert(totHour); */
			if(totHour > 48){
				$("#div_UK-FCL-00816_0").show();
			}
		});
		
		if("<?php echo $sqlInspDateShow['totInsDate'];?>" > 0){
			
			$("#title_UK-FCL-00813_0").show();
			$("#hr_UK-FCL-00813_0").show();
			$("#div_UK-FCL-00813_0").show();
			$("#div_UK-FCL-00814_0").show();
			$("#div_UK-FCL-00815_0").show();
			$("#div_UK-FCL-00181_2").show();
			$(".inspectionReport").show();			
			$('[rel=SINS]').show();
			$('[rel=FA]').show();
			$('[rel=H]').show();
					
		}else{
			$("#title_UK-FCL-00813_0").hide();
			$("#hr_UK-FCL-00813_0").hide();
			$("#div_UK-FCL-00813_0").hide();
			$("#div_UK-FCL-00814_0").hide();
			$("#div_UK-FCL-00815_0").hide();
			$("#div_UK-FCL-00181_2").hide();
			$(".inspectionReport").hide();
			$('[rel=SINS]').hide();
			$('[rel=FA]').hide();
			$('[rel=H]').hide();
			
		}	
	});
</script>