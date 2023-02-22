<?php 
$default_form_data = @$_SESSION['applicant_data_from_pdf'][$_GET['service_id']];

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
					/* echo " <i class='fa fa-question-circle tooltipCustom'><span class='tooltiptext'>$helptext</span></i>"; */
					echo " <i class='fa fa-question-circle text-info fa-lg' data-html='true' data-toggle='tooltip' title='$helptext'></i>";
				}
		?> 
	</label>

	<?php 
					


				

				if(!empty($default_form_data)){
					if(array_key_exists($tablefieldname, $default_form_data)){
						$default_value = @$default_form_data[$tablefieldname];
					}else{
						$default_value = NULL;
					}
				}else{
					$default_value = NULL;	
				}
				

					
				?> 

	<div class="col-md-12" id="input_<?php echo $tablefieldname;?>">
		<textarea name="<?php echo $tablefieldname; ?>" class="form-control <?php echo $val_cls; ?>" rows="2" id="<?php echo $tablefieldname; ?>" labelname="<?php echo $ln; ?>" <?php if ($fd['is_required'] == 'Y' && $val_cls == '') { echo "required"; } ?>><?= $default_value ?></textarea>
	</div>
</div>