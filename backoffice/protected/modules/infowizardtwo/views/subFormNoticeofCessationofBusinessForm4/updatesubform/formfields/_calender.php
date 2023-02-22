<?php
$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
	
											?>
											<div class="form-group col-md-6" id="div_<?php echo $tablefieldname;?>">
												 <?php  if(in_array($fd['id'],$addMoreLineCheck)){ ?>             
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
													echo "<span style='color:red;'> *</span>";
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
												<div class="col-md-12">
													<input type="text" autocomplete="off" id="<?php echo $tablefieldname; ?>" name="<?php echo $tablefieldname; ?>" class="datepicker form-control <?php echo $val_cls; ?>" labelname="<?php echo $ln; ?>" value="<?php if(!is_array(@$fieldValues[$tablefieldname]))echo @$fieldValues[$tablefieldname];?>" style="<?php echo $classEditOrNot;?>">
												</div>
												
												
												<?php 
												// date related changes 
												if(@$fieldValues['UK-FCL-00627_0']!='' && $tablefieldname == 'UK-FCL-00627_0' ){ ?>
												
													<div class="col-md-12" id="<?php echo $tablefieldname; ?>">
														<input type="text" name="<?php echo $tablefieldname; ?>" placeholder="Dated this" labelname="Dated this<b class='ukfcl'>(UK-FCL-00627_0)</b>" class="form-control " id="<?php echo $tablefieldname; ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Dated this'" value="<?php echo @$date; ?>" style="" readonly="" aria-invalid="false">
													</div>
												<?php } ?>
											</div>