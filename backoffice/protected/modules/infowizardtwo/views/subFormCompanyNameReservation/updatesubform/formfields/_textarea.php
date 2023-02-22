<?php $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
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
					echo " <i class='fa fa-question-circle' title='$helptext'></i>";
				}
		?> 
	</label>
	<div class="col-md-12" id="input_<?php echo $tablefieldname ?>">
		<textarea name="<?php echo $tablefieldname; ?>" class="form-control <?php echo $val_cls; ?>" row="2" id="<?php echo $tablefieldname; ?>" labelname="<?php echo $ln; ?>" <?php if ($fd['is_required'] == 'Y' && $val_cls == '') { echo "required"; } ?> style="<?php echo $classEditOrNot;?>"><?php if(!is_array(@$fieldValues[$tablefieldname])) echo @$fieldValues[$tablefieldname];?></textarea>
	</div>
</div>
										