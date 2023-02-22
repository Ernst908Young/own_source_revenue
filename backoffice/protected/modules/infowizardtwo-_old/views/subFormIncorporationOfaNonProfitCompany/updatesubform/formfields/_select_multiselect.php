<?php $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
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
	//echo " <i class='fa fa-question-circle tooltipCustom'><span class='tooltiptext'>$helptext</span></i>";
	echo " <i class='fa fa-question-circle' title='$helptext'></i>";
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
		
		/*$allList = InfowizardQuestionMasterExt::getMasterList($table_name, $key_id, $field_value, $is_active_field, $is_active_value);
		asort($allList);*/
		?>
		<div class="col-md-12">
			<select name="<?php echo $tablefieldname; if ($inputType != "select") {   echo "[]"; } ?>" 	<?php if ($inputType == "multipleselect") {		echo " multiple='multiple' style='max-height:120px;'";}?> placeholder="<?php echo $formName; ?>" class="<?php echo $val_cls; ?> select2-me"	<?php if($fd['is_required'] == 'Y' && $val_cls == '') {	echo "required"; }?> id="<?php echo $tablefieldname; ?>" labelname="<?php echo $ln; ?>" style="<?php echo $classEditOrNot;?>">
				<option value="">Please Select </option>
					<?php foreach ($allList as $key => $val) { ?>
					<option value="<?php echo $key; ?>" <?php if ($inputType == "multipleselect" && isset($fieldValues[$tablefieldname]) && !empty($fieldValues[$tablefieldname]) && is_array($fieldValues[$tablefieldname])) { if(in_array($key,@$fieldValues[$tablefieldname])){ echo "selected";}} else { if(@$fieldValues[$tablefieldname]==$key) { echo "selected";}}?>><?php echo $val; ?></option>
				<?php } ?>
			</select>    
		</div>



	<?php } else {
		$options = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_formfield_options WHERE formfield_id=$fd[id] AND is_active='Y' ORDER BY id DESC")->queryAll();
		if(!empty($options)){
		?>						
		<div class="col-md-12">
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
		<?php }else{ ?>

			  <div class="col-md-12">
			<select name="<?php echo $tablefieldname;?>" 
			 placeholder='<?php echo $formName; ?>' class="<?php echo $val_cls; ?> select2-me"  
			<?php
			if ($fd['is_required'] == 'Y' && $val_cls == '') {
				echo "required";
			}
			?> id="<?php echo $tablefieldname; ?>" labelname="<?php echo $ln; ?>" style="<?php echo $classEditOrNot; ?>">

				<option value="">Please Select </option>

			<?php 

			if($tablefieldname == 'UK-FCL-00242_0'){
				$p_id = $fieldValues['UK-FCL-00405_0'];			
		         $postalcode = Yii::app()->db->createCommand("SELECT * from bo_postalcode_in_barbados where p_id=$p_id")->queryAll();        
		         if($postalcode){		        
		            foreach ($postalcode as $key => $value) {
		            	$select = $fieldValues['UK-FCL-00242_0']==$value['id'] ? 'selected' : '';
		             echo "<option value='".$value['id']."' $select>".$value['district'].' - '.$value['code']."</option>";
		            }
		         }else{
		            echo "<option>-</option>";
		         }
			}

			if($tablefieldname == 'UK-FCL-00471_0'){
					$c_id = $fieldValues['UK-FCL-00295_0'];
						$options =  Yii::app()->db->createCommand("SELECT lr_id,lr_name FROM bo_landregion where parent_id='$c_id' and lr_type='state' AND is_lr_active='Y'")->queryAll();        
					        foreach ($options as $k => $v) {
					           
					            $select = $fieldValues['UK-FCL-00471_0']==$v['lr_id'] ? 'selected' : '';
							echo "<option value='".$v['lr_id']."' $select>".$v['lr_name']."</option>";
					        }
     				}
				

			?>

			
			</select>    
		</div>	

		<?php } } ?>		

</div>

