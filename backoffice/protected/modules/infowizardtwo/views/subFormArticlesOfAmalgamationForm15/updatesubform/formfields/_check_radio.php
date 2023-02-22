<?php $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id')
											?>
<div id="div_<?php echo $tablefieldname;?>" class="pcr">
	 <?php  if(in_array($fd['id'],$addMoreLineCheck)){ ?>
	  <span class="h4 col-md-12 caption-subject font-red-sunglo bold uppercase"><i class="fa fa-plus font-red-sunglo"></i> Add Data In Table</span>
	  <hr>
	<?php } ?>
	<div class="form-group">
	<label class="col-md-12 control-label text-left" for="" label="label_<?php echo $tablefieldname;?>">
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
			//echo " <i class='fa fa-question-circle tooltipCustom'><span class='tooltiptext'>$helptext</span></i>";
			echo " <i class='fa fa-question-circle' title='$helptext'></i>";
		}
		?>
	</label>
	</div>
	<div id="input_<?php echo $tablefieldname;?>">
		<?php $options = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_formfield_options where formfield_id=$fd[id] AND is_active='Y' ORDER BY id DESC")->queryAll();

		//print_r($options);
		?>
			 <div class="row">
		<div class="form-group rbcb-group" style="margin-bottom: 10px;">
		<?php
		$checkdradio = '';
		foreach($options as $option) {
				
				/*if($inputType== "radio") 
				{ 
					$checkdradio = "";
					if(!is_array($fieldValues[$tablefieldname])){						
						if($fieldValues[$tablefieldname]==$option['options'])			{ 								
								$checkdradio = "checked";	
							} 
					}
					
				}*/
			?>
			
				<input <?php echo $rcreq ?> name="<?php echo $tablefieldname;if ($inputType == "checkbox") { echo "[]";}?>" type="<?php echo $inputType; ?>" value="<?php echo $option['options']; ?>" name="<?php echo $fd['id'] ?>" class="chk_<?php echo $tablefieldname." ".$val_cls; ?>" labelname="<?php echo $ln; ?>" 
					<?php 
					if(isset($fieldValues[$tablefieldname])){
							if($inputType== "checkbox") { 
						if(in_array($option['options'],$fieldValues[$tablefieldname])){
						 echo "checked";} 
						}else{
							if($fieldValues[$tablefieldname]==$option['options']){
								echo "checked";
							}
						}
					}
					 ?> >&nbsp;
						<?php echo $option['options']; ?>
						<br>
			
	<?php 
		} 

		

		?>
</div>
	</div>
</div>
</div>

<script type="text/javascript">
	 $("input[name=UK-FCL-00546_0]").change(function(){
	    checksubmitbutton();
	}); 

	$("input[name=UK-FCL-00547_0]").change(function(){
	    checksubmitbutton();
	}); 

	 //checksubmitbutton();

	function checksubmitbutton(){
	 
	    var ff00546_0 = $('input[name=UK-FCL-00546_0]:checked').val(); 
	    var ff00547_0 = $('input[name=UK-FCL-00547_0]:checked').val(); 
	   
	    
	    if(ff00546_0=='No' && ff00547_0=='No'){
	    	
	        $(".submitForm").attr("style",'display:inline-block;');
	        $(".next_btn").attr("style",'display:none;');
	    }else{
	        $(".submitForm").attr("style",'display:none;');
	        $(".next_btn").attr("style",'display:inline-block;');
	    }
	}


</script>