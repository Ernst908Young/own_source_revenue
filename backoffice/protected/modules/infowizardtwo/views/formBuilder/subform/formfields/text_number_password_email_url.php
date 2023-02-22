<?php 
$default_form_data = @$_SESSION['applicant_data_from_pdf'][$_GET['service_id']];
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
					
					<label class="col-md-12 control-label text-left" for=""  id="label_<?php echo $tablefieldname;?>" >
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

				<?php 
					


				if(!empty($default_form_data)){
					if(array_key_exists($tablefieldname, $default_form_data)){
						$default_value = @$default_form_data[$tablefieldname]['value'];
						if($default_value=='' || empty($default_value)){
							$default_value = NULL;
						}
					}else{
						$default_value = NULL;
					}
				}else{
					$default_value = NULL;	
				}
				

					
				?> 

					<div class="col-md-12" id="input_<?php echo $tablefieldname;?>">
					<input value="<?= $default_value ?>" type="<?php echo $inputType; ?>" name="<?php echo $tablefieldname; ?>" placeholder='<?php echo $formName ?>' <?php if(!empty($pattern)){ ?> pattern="<?php echo $pattern; ?>" <?php  } ?>  <?php if($maxLength>0){?>maxlength="<?php echo $maxLength; ?>"<?php  } ?> <?php if($minLength>0){?>minlength="<?php echo $minLength; ?>"<?php  } ?> labelname="<?php echo $ln; ?>" class="form-control <?php echo $val_cls; ?>" <?php if ($fd['is_required'] == 'Y' && $val_cls == '') { echo "required"; } ?> pattern=".*\S+.*" id="<?php echo $tablefieldname; ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo $formName ?>'" <?php echo $addAttr; ?>>
					</div>
				</div>