<style type="text/css">
 	.rbcb{
 		width: 50%;
 	}
</style>

 <?php $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id')
?>
					
<div id="div_<?php echo $tablefieldname;?>" class='pcr'>
	<div class="form-group">
	<label for="" label="label_<?php echo $tablefieldname;?>">
		<?php echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');

		echo $fcode = " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
		?><?php
		echo ")</b>";

		$ln = $formName . "" . $fcode;
		if ($fd['is_required'] == 'Y') {
		echo "<span style='color:red;'> *</span>";
		$rcreq = 'required';
		}else{
			$rcreq = '';
		}
		?> 
		<?php
		if (!empty($fd['helptext'])) {
		$helptext = $fd['helptext'];
		echo " <i class='fa fa-question-circle text-info fa-lg' data-html='true' data-toggle='tooltip' title='$helptext'></i>";
		}
		?>
	</label>
	</div>
	<div id="input_<?php echo $tablefieldname;?>">
		<?php $options = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_formfield_options where formfield_id=$fd[id] AND is_active='Y' ORDER BY id DESC")->queryAll();
		?>
		  <div class="row">
		<div class="form-group rbcb-group" style="margin-bottom: 10px;">
		<?php
		foreach ($options as $option) {
			?>			
			<input name="<?php echo $tablefieldname;
			if ($inputType == "checkbox") {
			echo "[]";
			}
			?>" type="<?php echo $inputType; ?>" value="<?php echo $option['options']; ?>" name="<?php echo $fd['id'] ?>" class="rbcb chk_<?php echo $tablefieldname;
			echo " ";
			echo $val_cls; ?>" labelname="<?php echo $ln; ?>" <?php echo $rcreq ?> >&nbsp;
			<span class="rc_label"><?php echo $option['options']; ?></span>
			<br>
	<?php } ?>

</div>
</div>
	</div>
</div>

