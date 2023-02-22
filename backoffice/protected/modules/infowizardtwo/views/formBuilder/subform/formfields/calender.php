<?php $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
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
						$calenderreq = 'required';
							}else{
								$calenderreq = '';
							}
						?>
						<?php
						if (!empty($fd['helptext'])) {
							$helptext = $fd['helptext'];
							echo " <i class='fa fa-question-circle text-info fa-lg' data-html='true' data-toggle='tooltip' title='$helptext'></i>";
						}
						?>
						</label>
						<div class="col-md-12"  id="input_<?php echo $tablefieldname;?>">
							<input type="inputType" autocomplete="off" id="<?php echo $tablefieldname; ?>" name="<?php echo $tablefieldname; ?>" class="datepicker form-control <?php echo $val_cls; ?>" labelname="<?php echo $ln; ?>" <?php echo $calenderreq ?>>
						</div>
					</div>