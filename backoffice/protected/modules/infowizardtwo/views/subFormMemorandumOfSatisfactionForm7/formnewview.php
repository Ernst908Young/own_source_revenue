	<style type="text/css">
	table.gridtable th {
        border-width: 1px solid;
        padding: 8px;
        border-style: solid;
        border-color: #000000;
        background-color: #dedede;
        text-align: center;
        font-size: 0.9em;

    }
    table.gridtable td {
        font-size: 1.3em;
    }

    .br td, th, td{
        border: 1px solid black;
        border-collapse: collapse;

    }
	</style>
	<table  cellspacing="0" width="100%" cellpadding="2" style="padding-top:10px;" class="gridtable">	
	<tr>
		<td style="text-align:center;"><strong>Application ID</strong></td>
		<td style="text-align:center;"><?php echo $_GET['subID']; ?></td>
	</tr>	
	<tr>
		<td style="text-align:center;" colspan="2">
		<strong style="color:#000;padding:10px;"><?php echo $aap[0]['page_name']; ?></strong>
		</td>
	</tr>
	<?php
	$pageID = $_GET['pageID'];$coin=0;
	$page_name = ''; 	
	$arry_a = array();
	$arr_id = array();
	$categoryPreference = array();
	$get_selected_field = InfowizardQuestionMasterExt::get_selected_field($_GET['service_id']);
	$allData23 = InfowizardQuestionMasterExt::getsubmittedvalues($_GET['service_id'],$_GET['subID']);
	$btnArray	=	array();
	$allDataMappedWithButton	=	array();
	foreach($get_selected_field as $gsf){

		$btnArray[]=$gsf['button_id'];
		$btnID=$gsf['button_id'];
		$sfArray[]=$gsf['selected_field_id'];
		if(!isset($allDataMappedWithButton[$btnID])){
			$allDataMappedWithButton[$btnID]=array();
		}
		$allDataMappedWithButton[$btnID][]=$gsf['formchk_id'];
	}

	foreach ($formData as $key => $fd) 
	{
		if(!in_array($fd['id'], $sfArray))
		{
			/* Pankaj Singh code for Add more */
			$page_name = $fd['page_name'];
			$button_id = $fd['id'];
			$ext_chk = InfowizardQuestionMasterExt::checkSubform($fd['service_id'],$fd['id'],$fd['page_name']);
			if($ext_chk){
				$arr_id[] = $fd['id'];
				$arry_a[$fd['id']]['id'] = $fd['id'];
				$arry_a[$fd['id']]['category_id'] = $fd['category_id'];
				$arry_a[$fd['id']]['form_field_id'] = $fd['form_field_id'];
			} 

			$inputType = $fd['input_type'];
			if (!in_array($fd['category_id'], $categoryPreference)) 
			{
				
			
			if($coin==1){
				echo "<td></td></tr>";
			}
				$keyy = -2;
				$count = 0;
				$categoryPreference[] = $fd['category_id'];
				?>
				
				<tr>
					<td colspan="2" style="background-color:#EEF1F5;">
						<strong>
						<?php echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowiz_form_categories', $fd['category_id'], 'category_name', 'id'); ?>
						</strong>
					</td>					
				</tr>				
				
    <?php 	}
			if(!in_array($fd['id'], $btnArray))
			{ 
				$count++;
				if ($keyy % 2 == 0) { 
				?>
				<tr>
				<?php	
				}
				$keyy = $keyy + 1; 
				
				// Genrating text field for type text and number 
				if ($inputType == "text" || $inputType == "number" || $inputType == "password") 
				{  
					$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ;
					
				?>
					<td>
						<strong><?php 						
						echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');?> (<?php echo $tablefieldname;?>):</strong>
						<br/>
						<?php if(!is_array(@$fieldValues[$tablefieldname])) 
						echo  @$fieldValues[$tablefieldname]; ?>
					</td>
					
		<?php   }?>
			<?php
				// Genrating select field for type select and multiple select
				if ($inputType == "select" || $inputType == "multipleselect") 
				{
					$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ;
					
				?>
					<td>
						<strong><?php 						
						echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
						?> (<?php echo $tablefieldname;?>):</strong>
						<br/>
						<?php 
							$options = Yii::app()->db->createCommand("SELECT bo.*, bm.master_table_name, bm.key_id, bm.field_value, bm.is_active_field,
												 bm.is_active_value FROM bo_infowiz_formfield_options as bo
												 LEFT JOIN bo_master_tables as bm ON bo.master_table_id=bm.id
												 WHERE bo.formfield_id=$fd[id] AND bo.master_table_id!=0 AND bo.is_active='Y' ORDER BY bo.id DESC")->queryRow();
							if(isset($options) && !empty($options))
							{							    
								$table_name=$options['master_table_name'];
								$key_id=$options['key_id'];
								$field_value=$options['field_value'];
								$is_active_field=$options['is_active_field'];
								$is_active_value=$options['is_active_value'];
							    $allList   = InfowizardQuestionMasterExt::getMasterList($table_name, $key_id, $field_value,$is_active_field, $is_active_value);		 
								
								foreach ($allList as $key=>$val) { 
									if(@$fieldValues[$tablefieldname]==$key) { 
										echo $val;
									}
								} 
							
							}else{
							
								$options = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_formfield_options WHERE formfield_id=$fd[id] AND is_active='Y' ORDER BY id DESC")->queryAll(); 
								if(isset($options) && !empty($options))
								{							
									foreach ($options as $option) 
									{ 
										if(@$fieldValues[$tablefieldname]==$option['options']) 
										{ 
											echo $option['options'];
										}
									}
								}	
							}
						?>							
					</td>
				<?php					
				}
				?>
				<?php 
				// Genrating select field for type select and multiple select
				if ($inputType == "checkbox" || $inputType == "radio") 
				{
					$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ;
					
				?>
                    <td>                       
						<strong><?php						
						echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
						
						 $options = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_formfield_options where formfield_id=$fd[id] AND is_active='Y' ORDER BY id DESC")->queryAll();
						?>
						(<?php echo $tablefieldname ?>):</strong>
						<br/>
						<?php  
						$checkdradio = "";
						if(isset($options) && !empty($options))
						{
							foreach($options as $option) 
							{ 							
								if($inputType== "radio") 
								{ 
									if(@$fieldValues[$tablefieldname]==$option['options'])
									{ 
										$checkdradio = "checked";
									} 
								}
							
								if($inputType== "radio"){ 
									echo $option['options']; 
								} 
							 
								if($inputType== "checkbox")
								{ 
									if(in_array($option['options'],$fieldValues[$tablefieldname]))
									{ 
										echo $option['options']; 
									} 
								}							
							} 
						}	
					?>                            	   
                    </td> 
				<?php 
				} 
				?>
				<?php
				// Genrating textarea
				if ($inputType == "textarea") 
				{
					$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
					
				?>
					<td>
						<strong>
						<?php 						
						echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');?> (<?php echo $tablefieldname ?>) :</strong>
						<br/>
						<?php echo @$fieldValues[$tablefieldname];?>
					</td>
			<?php 
				} 
			?>
				
	<?php	}else{
			
			?>
			<tr>
				<td colspan="2">
					<table cellspacing="0" width="100%" cellpadding="2" >
						<tr>
						<?php //print_r($get_selected_field);die();
							foreach ($get_selected_field as $key => $valued) 
							{
								if($fd['id']==$valued['button_id']){
						?>
							<th><?php 						
						echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $valued['formvar_id'], 'name', 'formvar_id');?> (<?php echo $valued['formchk_id']; ?>)</th>
						<?php	} 
							}
						?>
						</tr>
						<?php 
						$arrofIn=array(); ?>
						<?php 
						foreach ($get_selected_field as $key => $valued) 
						{
							if($fd['id']==$valued['button_id'])
							{
								$fcode=$valued['formchk_id'];
								$btnID=$valued['button_id'];

								if(!in_array($valued['button_id'],$arrofIn))
								{
									$arrofIn[]=$valued['button_id'];

							
						?>
									<?php for($k=0; $k<(count($allData23[$fcode]));$k++)
									{ 
									?>
										<tr>
											<?php 
											foreach($allDataMappedWithButton[$btnID] as $key1=>$datag)
											{ 
											?> 
												<td style="margin-left:2px;">
												<?php if(is_array($allData23[$datag])){ echo @$allData23[$datag][$k]; }else{echo $allData23[$datag];} ?>
												</td>
										<?php 
											} 
										?>
										</tr>
						<?php 			
									}
								}		
							} 
						} 
					?>
					</table>
				</td>
			
			<?php 
			}
			if ($keyy % 2 == 0) {
				$coin=0;
			?>	
			</tr>
			
			<?php
			}else{
				$coin=1;
			}
		}
	}
	if($coin==1){
			echo "<td></td></tr>";
			} ?>
	</table>

		