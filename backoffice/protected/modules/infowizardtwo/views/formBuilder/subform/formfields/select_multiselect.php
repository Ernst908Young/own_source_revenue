<?php 
$default_form_data = @$_SESSION['applicant_data_from_pdf'][$_GET['service_id']];
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
	echo " <i class='fa fa-question-circle text-info fa-lg' data-html='true' data-toggle='tooltip' title='$helptext'></i>";
}
?>								
</label>
<?php
$options = Yii::app()->db->createCommand("SELECT bo.*, bm.master_table_name,bm.condition, bm.key_id, bm.field_value, bm.is_active_field,
 bm.is_active_value FROM bo_infowiz_formfield_options as bo
 LEFT JOIN bo_master_tables as bm ON bo.master_table_id=bm.id
 WHERE bo.formfield_id=$fd[id] AND bo.master_table_id!=0 AND bo.is_active='Y' ORDER BY bo.id DESC")->queryRow();

	if (isset($options) && !empty($options)) {
		$table_name = $options['master_table_name'];
		$key_id = $options['key_id'];
		$field_value = $options['field_value'];
		$is_active_field = $options['is_active_field'];
		$is_active_value = $options['is_active_value'];
		$condition = @$options['condition'];
		
		if(isset($condition) && !empty($condition)){
			$allList = InfowizardQuestionMasterExt::getMasterList($table_name, $key_id, $field_value, $is_active_field, $is_active_value,'prefrence',$condition);
		}	
		else{
			$allList = InfowizardQuestionMasterExt::getMasterList($table_name, $key_id, $field_value, $is_active_field, $is_active_value,'prefrence');
		}
		//asort($allList);
		?>
		<div class="col-md-12"  id="input_<?php echo $tablefieldname;?>">
			<select name="<?php echo $tablefieldname; if ($inputType != "select") {   echo "[]"; } ?>" 	<?php if ($inputType == "multipleselect") {
			echo " multiple='multiple'";} ?> placeholder="<?php echo $formName; ?>" class="<?php echo $val_cls; ?> select2-me"  
					<?php
					if ($fd['is_required'] == 'Y' && $val_cls == '') {
						echo "required";
					}
					?> id="<?php echo $tablefieldname; ?>" labelname="<?php echo $ln; ?>" >

				<option value="">Please Select </option>
					<?php foreach ($allList as $key => $val) { ?>
					<option value="<?php echo $key; ?>" ><?php echo $val; ?></option>
				<?php } ?>
			</select>    
		</div>



	<?php } else {
		$options = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_formfield_options WHERE formfield_id=$fd[id] AND is_active='Y' ORDER BY prefrence ASC")->queryAll();
		?>						
		<div class="col-md-12"  id="input_<?php echo $tablefieldname;?>">
			<select name="<?php echo $tablefieldname; if($inputType != "select") {	echo "[]";}	?>" 
			<?php if ($inputType == "multipleselect") {	echo " multiple='multiple' ";}  ?> placeholder='<?php echo $formName; ?>' class="<?php echo $val_cls; ?> select2-me"  
			<?php
			if ($fd['is_required'] == 'Y' && $val_cls == '') {
				echo "required";
			}
			?> id="<?php echo $tablefieldname; ?>" labelname="<?php echo $ln; ?>">

				<option value="">Please Select </option>
			<?php foreach ($options as $option) { 
					$selected = '';
					if(!empty($default_form_data)){
						if(array_key_exists($tablefieldname, $default_form_data)){
							if(strcasecmp(@$default_form_data[$tablefieldname]['value'], $option['options']) ==0){
								$selected = 'selected';
							}
						}
					}

				
				?>
					<option value="<?php echo $option['options']; ?>" <?= $selected ?> ><?php echo $option['options']; ?></option>
			<?php } ?>
			</select>    
		</div>								
		<?php } ?>		

</div>