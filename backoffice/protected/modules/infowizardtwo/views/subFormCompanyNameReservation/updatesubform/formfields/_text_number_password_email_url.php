<?php $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
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
	 <?php  if(in_array($fd['id'],$addMoreLineCheck) && $_GET['service_id']=='591.0'){ ?>
	  <span class="h4 col-md-12 caption-subject font-red-sunglo bold uppercase"><i class="fa fa-plus font-red-sunglo"></i> Add Data In Table</span>
	  <hr>
	<?php } ?>
    <label class="col-md-12 control-label text-left" for=""  id="label_<?php echo $tablefieldname;?>">
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
         // echo " <i class='fa fa-question-circle tooltipCustom'><span class='tooltiptext'>$helptext</span></i>";
            echo " <i class='fa fa-question-circle' title='$helptext'></i>";
        }
		
        ?>
    </label>

    <div class="col-md-12" id="input_<?php echo $tablefieldname ?>">
		<input type="<?php echo $inputType; ?>" name="<?php echo $tablefieldname; ?>" placeholder='<?php echo $formName ?>' labelname="<?php echo $ln; ?>" class="form-control <?php echo $val_cls; ?>" <?php if ($fd['is_required'] == 'Y' && $val_cls == '') { echo "required"; } ?> id="<?php echo $tablefieldname; ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo $formName ?>'" value="<?php if(!is_array(@$fieldValues[$tablefieldname])) echo  @$fieldValues[$tablefieldname]; ?>" <?php if($maxLength>0){?>maxlength="<?php echo $maxLength; ?>"<?php  } ?> <?php if($minLength>0){?>minlength="<?php echo $minLength; ?>"<?php  } ?>  <?php echo $addAttr; ?> style="<?php echo $classEditOrNot;?>">
    </div>
</div>