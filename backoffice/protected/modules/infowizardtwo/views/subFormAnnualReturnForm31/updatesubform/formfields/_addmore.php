<?php

		$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
		$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id'); 


		?>										
									   
<div class="col-md-12" id="div_<?php echo $tablefieldname;?>">
		 <?php  if(in_array($fd['id'],$addMoreLineCheck)){ ?>
		  <span class="h4 col-md-12 caption-subject font-red-sunglo bold uppercase"><i class="fa fa-plus font-red-sunglo"></i> Add Data In Table</span>
		  <hr>
		<?php } ?>
		
		<input type="hidden" name="<?php echo $tablefieldname; ?>" value="<?php echo $id; ?>" id="btn-UKCL-<?php echo $id; ?>">								
		<a href="javascript:;" class="btn-primary mt-3 add-more-btn div_<?php echo $tablefieldname;?>" relf="<?php echo @$_GET['service_id']?>" rel="<?php echo $fd['page_name']; ?>" relid="<?php echo $id; ?>" id="disabled_btn_tbl_<?php echo $id;?>"><i class="fa fa-plus"></i><?php echo $formName;												
		echo " <b class='ukfcl'>(" . $tablefieldname; ?><?php echo  ")</b>";
		if ($fd['is_required'] == 'Y') {
			echo "<span style='color:red;'> *</span>";
		} ?>
		<?php if (!empty($fd['helptext'])) {
			$helptext = $fd['helptext'];
			//echo " <i class='fa fa-question-circle tooltipCustom'><span class='tooltiptext'>$helptext</span></i>";
			echo " <i class='fa fa-question-circle' title='$helptext'></i>";
		} ?> 
		</a>
	</div>

