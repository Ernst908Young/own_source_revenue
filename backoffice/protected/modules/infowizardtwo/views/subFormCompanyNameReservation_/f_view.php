<?php 
	//$formData = $this->alignInSequence($service_id,$applicantFormId);	
	//$invData =InfowizardQuestionMasterExt::getUserApplicationInfo($sub_id); 
	//$invData1 = (json_decode($invData['field_value'],true));
	//$formName = InfowizardQuestionMasterExt::getFormNameFrmMap($service_id,$invData['form_id']);
	//$fieldValues = $invData1;
	//$form_name = $formName['form_name'];
	$fieldValues=''; //$invData;
?>

<style type="text/css">
	.page-footer-inner { padding: 1px 1px 1px !important; }
</style>
<div class="portlet-body form">
<ul class="nav nav-pills nav-justified steps">	
	<li style="background:#36C6D3;">
		<a href="#" data-toggle="tab" class="step" aria-expanded="true"	style="color:#fff;font-weight:bold;font-size:16px !important;text-align:left; pointer-events: none;">
			<span class="desc"><span class="number"><?php //echo $form_name; ?></span></span>
		</a>
	</li>
</ul>
<?php
	$categoryPreference = array();
	$arry_a = array();
	$arr_id = array();
	$categoryPreference = array();
	$get_selected_field = InfowizardQuestionMasterExt::get_selected_field($service_id);	
	$allData23 = InfowizardQuestionMasterExt::getsubmittedvalues($service_id,$sub_id);
				
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
	//echo "<pre/>"; print_r($sfArray); //die;
    foreach ($formData as $key => $fd) 
	{
		$showFlag=0;
		//print_r($fd); die;
	 	if(!in_array($fd['id'], $sfArray)){
			$page_name = $fd['page_name'];
			$button_id = $fd['id'];
			$inputType = $fd['input_type'];
			if (!in_array($fd['category_id'], $categoryPreference)) {
				$keyy = -1;
				$categoryPreference[] = $fd['category_id'];?>
				<br>
				<div class="row"></div>
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-tags font-red-sunglo"></i>
						<span class="caption-subject font-red-sunglo bold uppercase">
							<?php echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowiz_form_categories', $fd['category_id'], 'category_name', 'id'); ?>
						</span>
					</div>
					<div class="actions">
						<div class="portlet-input input-inline input-small"></div>
					</div>
				</div><hr>
    	<?php } ?>
	<?php if(!in_array($fd['id'], $btnArray)){  //IF IN ARRAY START
			if ($keyy % 2 == 0) { 
				echo "<div class='row'>";
			} $keyy = $keyy + 1; 
			if ($inputType == "text" || $inputType == "number" || $inputType == "password") {  ?>
			<div class="form-group col-md-6">
				<label class="col-md-12 control-label text-left" for="" >
					<?php echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
					echo " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ; ?><?php echo  ")</b>";
					if ($fd['is_required'] == 'Y') echo "<span style='color:red;'> *</span>";
					if (!empty($fd['helptext'])) {
						$helptext = $fd['helptext'];
						echo " <i class='fa fa-question-circle' title='$helptext'></i>";
					} ?>
				</label>
				<div class="col-md-12">
					<input type="<?php echo $inputType; ?>" name="<?php echo $tablefieldname; ?>" placeholder='<?php echo $formName ?>' class="form-control"  
					<?php if ($fd['is_required'] == 'Y') echo "required";?> value="<?php if(!is_array(@$fieldValues[$tablefieldname])) echo @$fieldValues[$tablefieldname]; ?>" readonly>
				</div>
			</div>
    <?php  } 
		if ($inputType == "select" || $inputType == "multipleselect"){?>
			<div class="form-group col-md-6">
				<label class="col-md-12 control-label text-left" for="" >						
					<?php  echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
					echo " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ; ?><?php echo  ")</b>";

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
						$allList   = InfowizardQuestionMasterExt::getMasterList($table_name, $key_id, $field_value, $is_active_field, $is_active_value);?>
						<div class="col-md-12">
							<select name="<?php echo $tablefieldname;if ($inputType != "select") { echo "[]"; } ?>" 
								<?php if ($inputType == "multipleselect") echo " multiple='true' style='max-height:120px;'"?> placeholder='<?php echo $formName; ?>' class="form-control"  
								<?php if ($fd['is_required'] == 'Y') echo "required";?> disabled>
								<option value="">Please Select </option>
								<?php foreach ($allList as $key=>$val) { ?>
									<option value="<?php echo $key; ?>" <?php if(@$fieldValues[$tablefieldname]==$key) echo "selected";?>>
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
						<?php if ($inputType == "multipleselect") {	echo " multiple='true' style='max-height:120px;'";  } ?> placeholder='<?php echo $formName; ?>' class="form-control"  
						<?php if ($fd['is_required'] == 'Y') echo "required";?> disabled>

						<option value="">Please Select </option>
						<?php foreach ($options as $option) { ?>
						<option value="<?php echo $option['options']; ?>" <?php if(@$fieldValues[$tablefieldname]==$option['options']) { echo "selected";}?>><?php echo $option['options']; ?></option>
						<?php } ?>
						</select>    
					</div>
			<?php } ?>
			</div>
	<?php } 
		if ($inputType == "checkbox" || $inputType == "radio"){?>
			<div class="form-group col-md-6">
				<label class="col-md-12 control-label text-left" for="" >
					<?php echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
					echo " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ; ?><?php echo  ")</b>";
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
								echo "[]"; } ?>" type="<?php echo $inputType; ?>" value="<?php echo $option['options']; ?>" id="<?php echo $fd['id'] ?>" <?php echo $checkdradio; if($inputType== "checkbox") { if(in_array($option['options'],$fieldValues[$tablefieldname])){ echo "checked";} } ?> disabled >&nbsp;
								<?php echo $option['options']; ?>
								<?php if($inputType== "radio"){ ?>
									<input type="hidden" name="<?php echo $tablefieldname;?>" value="<?php echo $option['options']; ?>">
								<?php } ?>
								<?php if($inputType== "checkbox"){ 
									if(in_array($option['options'],$fieldValues[$tablefieldname])){?>
										<input type="hidden" name="<?php echo $tablefieldname;?>[]" value="<?php echo $option['options']; ?>">
									<?php } 
								}?>
							</div> 
					<?php } ?>                            	   
				</div>
			</div>
	<?php } 
		if ($inputType == "textarea") {?>
			<div class="form-group col-md-6">
				<label class="col-md-12 control-label text-left" for="" >
					<?php echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
					echo " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ; ?><?php echo  ")</b>";
						;
					if ($fd['is_required'] == 'Y') echo "<span style='color:red;'> *</span>";
					if (!empty($fd['helptext'])) {
						$helptext = $fd['helptext'];
						echo " <i class='fa fa-question-circle' title='$helptext'></i>";
					} ?> 
				</label>
				<div class="col-md-12">
					<textarea name="<?php echo $tablefieldname; ?>" class="form-control" row="2" readonly ><?php if(!is_array(@$fieldValues[$tablefieldname])) echo @$fieldValues[$tablefieldname];?>
					</textarea>
				</div>
			</div>
	<?php } 
					
		if ($inputType == "calender") {?>
			<div class="form-group col-md-6">
				<label class="col-md-12 control-label text-left" for="">
				<?php echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
				echo " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id'); ?><?php echo  ")</b>";											
				if ($fd['is_required'] == 'Y') echo "<span style='color:red;'> *</span>";?>
				<?php if (!empty($fd['helptext'])) {
					$helptext = $fd['helptext'];
					echo " <i class='fa fa-question-circle' title='$helptext'></i>";
				} ?>
				</label>
				<div class="col-md-12">
					<input type="text" name="<?php echo $tablefieldname; ?>" class="form-control" value="<?php echo @$fieldValues[$tablefieldname];?>" readonly>
				</div>
			</div>
		<?php }  	
	}
	else{ //IF IN ARRAY END ?>
			
				<table class="table table-striped table-bordered table-hover responsive-table" id="forest_table" style="">
				<tr>
					<?php 
					//echo "<pre/>"; print_r($get_selected_field); die;
					foreach ($get_selected_field as $key => $valued) {
						if($fd['id']==$valued['button_id']){?>
							<th>
								<?php 						
									echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $valued['formvar_id'], 'name', 'formvar_id');?> (<?php echo $valued['formchk_id']; ?>)
							</th>
					<?php } 
					} ?>
				</tr>
				<?php //echo "<pre/>"; print_r($get_selected_field);
				$arrofIn=array();  
				foreach ($get_selected_field as $key => $valued) {
					if($fd['id']==$valued['button_id']){
						$fcode=$valued['formchk_id'];
						$btnID=$valued['button_id'];
						if(!in_array($valued['button_id'],$arrofIn)){
							$arrofIn[]=$valued['button_id'];						
							for($k=0; $k<(count($allData23[$fcode]));$k++){ ?>
							<tr>
								<?php foreach($allDataMappedWithButton[$btnID] as $key1=>$datag){ ?>
								<td>
									<input class="form-control" type="text" value="<?php if(is_array($allData23[$datag])){ echo @$allData23[$datag][$k]; }else{echo $allData23[$datag];} ?>" title="<?php if(is_array($allData23[$datag])){ echo @$allData23[$datag][$k]; }else{echo $allData23[$datag];} ?>" readonly>
								</td>
								<?php } ?>
							</tr>
							<?php }
						}
					} 
				} ?>
				</table>
							
<?php }//IF IN ARRAY ELSE END
				
}
if ($keyy % 2 != 0) { echo "</div>";} 
}?>	   
</div>
</div>
