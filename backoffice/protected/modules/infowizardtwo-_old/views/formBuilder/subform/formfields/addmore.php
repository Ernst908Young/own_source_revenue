<?php 

$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
						
 /* echo " <b>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
  echo ")</b>"; */
    ?>
	
    <div class="col-md-12 mb-3" id="div_<?php echo $tablefieldname; ?>">
       
			<input type="hidden" name="<?php echo $tablefieldname; ?>" value="<?php echo $id; ?>" id="btn-UKCL-<?php echo $id; ?>">
            <a href="javascript:;" class="btn-primary mt-3 add-more-btn" relf="<?php echo @$_GET['service_id'] ?>" rel="<?php echo $fd['page_name']; ?>" relid="<?php echo $id; ?>" ><i class="fa fa-plus"></i><?php
            echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
           
             ?><b class="ukfcl" style="display:none;">(<?php echo $tablefieldname; ?>)</b><?php
               
                if ($fd['is_required'] == 'Y') {
                    echo "<span style='color:red;'> *</span>";
                }
                ?>
                <?php
                if (!empty($fd['helptext'])) {
                    $helptext = $fd['helptext'];
                    echo " <i class='fa fa-question-circle text-info fa-lg' title='$helptext'></i>";
                }
                ?> </a>&nbsp;&nbsp;<br/><br/><span style="color:red;font-size:12px;">
				
				
				(Please click on the button "+Save Detail(s)" to capture details provided above in tabular form)
				
				</span>
       
    </div>
	<div class="col-md-12 mb-3" id="add_more_<?php echo $id; ?>" style="display: none;">
		
			<div style="overflow:auto;">
			<?php
			
			$sub_from_list = InfowizardQuestionMasterExt::getSubFromList($fd['page_name'], $_GET['service_id'], $button_id);
			
			$_dat1 = '';
			if ($sub_from_list) {
				//echo "<pre>"; print_r($sub_from_list);
			   // $sub_from_list = array_filter($sub_from_list);
				$_dat1 = '<hr><table class="table table-striped table-bordered table-hover responsive-table" i id=tbl_' . $id . '><thead><tr class=add_more_' . $id . '>';
				foreach ($sub_from_list as $data) {
					$formchk_id = $data['formchk_id'];
					$_dat1 .='<th><b class="ukfcl" style="display:none;" title="'.$data["idd"].'">'.$formchk_id.': </b>' . $data['full_name'] .'</th>';
					
				}
				$_dat1 .='<th style="text-align:center;">Delete</th>';
				$_dat1 .='</tr></thead><tbody></tbody></table><hr>';
			}
			echo $_dat1;
			?>
			</div>
		
	</div>