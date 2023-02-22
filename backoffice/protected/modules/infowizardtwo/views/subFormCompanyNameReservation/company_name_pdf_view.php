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
	
	<?php $gti=0;//echo "<pre>"; print_r($fieldValues);?>
	<h1>Status for <span class = "cblue">Application ID - <?=$_GET['subID']?> </span> <?php if(isset($app_status)){
		 if(($app_status) == 'F') echo " is Forwarded ";
		 if(($app_status) == 'A') echo " is Approved ";
		  if(($app_status) == 'P') echo " is Pending ";
		   if(($app_status) == 'I') echo " is Incomplete ";
			if(($app_status) == 'Z') echo " is Archived ";
			 if(($app_status) == 'R') echo " is Rejected ";
			 if(($app_status) == 'H') echo " is Reverted ";
			 if(($app_status) == 'RBI') echo " is Reverted ";
	 }  ?>As On <?=date('d-m-Y H:i:s')  ?>
	</h1> 
 
	
    
    <div class="row">&nbsp;</div>
	<table  cellspacing="0" width="100%" cellpadding="2" style="padding-top:10px;" class="gridtable">
		
		<tbody>
		<tr>
			<td style="text-align:center;"><strong>Application ID</strong></td>
			<td style="text-align:center;"><?php echo $_GET['subID']; ?></td>
		</tr>	
		<tr>
			<td style="text-align:center;"><strong>Application Date</strong></td>
			<td style="text-align:center;"><?php echo $application_created_date; ?></td>
		</tr>
		<?php
		$flg=0;
		extract($_GET);
		$categoryPreference = array();		
		$arry_a = array();
		$arr_id = array();
		$categoryPreference = array();
		$get_selected_field = InfowizardQuestionMasterExt::get_selected_field($service_id);	
		$allData23 = InfowizardQuestionMasterExt::getsubmittedvalues($service_id,$subID);
		$colspan= '';
		$coin = 0;	
		$sfArray=array();
		$btnArray=array();
		$allDataMappedWithButton=array();
		if(isset($get_selected_field) && !empty($get_selected_field)){
			foreach($get_selected_field as $gsf){
				$btnArray[]=$gsf['button_id'];
				$btnID=$gsf['button_id'];
				$sfArray[]=$gsf['selected_field_id'];

				if(!isset($allDataMappedWithButton[$btnID])){
					$allDataMappedWithButton[$btnID]=array();
				}
				$allDataMappedWithButton[$btnID][]=$gsf['formchk_id'];
			}
		}
		$countOfCategory=array();
		/* echo "<pre>";
		print_r($formData);
		print_r($sfArray);
		print_r($btnArray);
		 die;  */
		//$sf="";
		$flagDecla = 0;
		foreach($formData as $key => $fd) 
		{		
			if(!in_array($fd['id'], $sfArray))
			{
				$inputType = $fd['input_type'];				
				
				if(!isset($countOfCategory[$fd['category_id']])){
					$countOfCategory[$fd['category_id']]=0;
				}
				$countOfCategory[$fd['category_id']]=$countOfCategory[$fd['category_id']]+1;
				
				//this condition check so that category will not reapeat
				if(!in_array($fd['category_id'], $categoryPreference)) 
				{
					$keyy =0;
					
					$lastCategory=$fd['category_id'];					
					$categoryPreference[] = $fd['category_id'];
					
					if($coin==1 && $sf!="</tr>")
					{	
						if($keyy%2==0){
							$rgu=2;
						}else{
							$rgu=1;
						}
						echo "<td colspan=$rgu></td></tr>";
						$coin = 0;
					}	
					
				?>	
		
				<tr>
					<td colspan="2" style="background-color:#EEF1F5;">
						<strong>
						<?php echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowiz_form_categories', $fd['category_id'], 'category_name', 'id'); ?>
						</strong>
					</td>					
				</tr>	
		<?php	}
				//this condition will check add more data will not show in this 
				if(!in_array($fd['id'], $btnArray)){
					
					if ($keyy % 2 == 0) { 						
					?>
					<tr>
					<?php
					$sf="";
					}		
					$keyy = $keyy + 1; 
					$allTypes=array("text","number","password","email","url");
					if (in_array($inputType,$allTypes)) 
					{
						$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ;
						
					?>
						<td>
							<strong><?php echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');?> :</strong>
							<br/>
							<?php 
							if(!is_array(@$fieldValues[$tablefieldname])) 
								echo  @$fieldValues[$tablefieldname]; 
							?>
						</td>
					<?php
					}
					if ($inputType == "select" || $inputType == "multipleselect")
					{
						$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ;
						
					?>
					
						<td  style="text-align:left;">
							<strong>
							<?php echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
							?>:
							</strong>
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
									}else{
									
										$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
										$options2 = Yii::app()->db->createCommand("SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(bo_new_application_submission.field_value,'\"$formName\":\"',-1),'\",',1) as fieldVal FROM bo_new_application_submission WHERE bo_new_application_submission.submission_id='$_GET[subID]'")->queryRow();
										if(isset($options2['fieldVal']) && !empty($options2['fieldVal'])){
											echo $options2['fieldVal'];
										}
									} 
								}
							?>							
						</td>					
					<?php
					}
					if ($inputType == "checkbox" || $inputType == "radio")
					{
						$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id') ;
						
					?>
						<td <?php if($tablefieldname =="UK-FCL-00589_0"){ echo "colspan='2'"; $flagDecla = 1;} ?> width="100%">            
							
								<?php						
								$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
								
								 $options = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_formfield_options where formfield_id=$fd[id] AND is_active='Y' ORDER BY id DESC")->queryAll();
								?>						
							
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
								 
									if($inputType== "checkbox" && $flg==0)
									{ 
									$flg=1;
										if(isset($fieldValues[$tablefieldname]) && !empty($fieldValues[$tablefieldname]))
										{
											if(in_array($option['options'],$fieldValues[$tablefieldname]))
											{ 
												
												echo "<ol>
													<li>I hereby confirm and consent to reservation of first name available for reservation</li>
													<li>All the required attachments have been completely, correctly and legibly attached to this form.</li>
													</ol>";
												
											} 
										}
									}							
								} 
							}	
						?>                            	   
						</td> 
					
					<?php
					}
					if ($inputType == "textarea") 
					{
						$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
					
					?>
						<td <?php if($tablefieldname =="UK-FCL-00027_0"){ echo "colspan='2'"; $flagDecla = 1;} ?>>
							<strong>
							<?php 						
							echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');?>:</strong>
							<br/>
							<?php echo @$fieldValues[$tablefieldname];?>
						</td>
				<?php 
					}
					if ($inputType == "calender") {
						  $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
					?>
						<td>
							<strong>
							<?php 						
							echo  @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');?></strong>: <br/><?php echo @$fieldValues[$tablefieldname];?>
						</td>
					<?php
					
					}	
				}else{
					//echo $countOfCategory[$lastCategory];	
					if(isset($countOfCategory[$lastCategory]) && $countOfCategory[$lastCategory]==2){				
						echo "<td></td></tr>";
					}
				if(!empty($get_selected_field)){ ?>
					<tr>
						<td colspan="2">
							<table cellspacing="0" width="100%" cellpadding="2">
								<thead>
									<tr>									
									<?php //print_r($get_selected_field);die();
										foreach ($get_selected_field as $key => $valued) 
										{
											if($fd['id']==$valued['button_id']){
									?>
											<th><strong>
												<?php echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $valued['formvar_id'], 'name', 'formvar_id');?> </strong>
											</th>
									<?php	} 
										}
									?>
									</tr>
								</thead>
								<tbody>							
								<?php 
								$arrofIn=array();
								
								foreach ($get_selected_field as $key => $valued) {
									 if($fd['id']==$valued['button_id']){
										$fcode=$valued['formchk_id'];
										$btnID=$valued['button_id'];
										//print_r($arrofIn);die;
										
										if(is_array($arrofIn) && !in_array($valued['button_id'],$arrofIn)){
											$arrofIn[]=$valued['button_id'];
											if(isset($allData23[$fcode]) && !empty($allData23[$fcode]))
											{	
																	
												for($k=0; $k<(count($allData23[$fcode]));$k++){ 
												?>
												<tr>
													<?php 
													if(isset($allDataMappedWithButton[$btnID]) && !empty($allDataMappedWithButton[$btnID])) 
													{ 
														$flagtbl = 1;
														$fomFeildMasterArr = array('UK-FCL-00298_0','UK-FCL-00299_0');
														foreach($allDataMappedWithButton[$btnID] as $key1=>$datag){ 
															if(isset($allData23[$datag]) && is_array($allData23[$datag])){ 
																$gho=@$allData23[$datag][$k]; 
															}else{
																$gho=@$allData23[$datag];
															}	
															
															$approvalval = '';
															if(isset($gho) && in_array($datag,$fomFeildMasterArr) && is_numeric($gho))
															{
																if($datag=='UK-FCL-00298_0'){
																	$deptName=Yii::app()->db->createCommand("select department_name from bo_departments where dept_id=$gho")->queryRow();
																	$approvalval = $deptName['department_name'];
																}
																if($datag=='UK-FCL-00299_0'){
																	$deptName=Yii::app()->db->createCommand("select app_name from bo_sp_all_applications where app_id=$gho")->queryRow();
																	$approvalval = $deptName['app_name'];
																}
															}  
													?>
													<td>
														<?php if(isset($approvalval) && !empty($approvalval)){ echo $approvalval;}else{ if(isset($allData23[$datag]) && is_array($allData23[$datag])){ echo @$allData23[$datag][$k]; }else{echo @$allData23[$datag];} } ?>
													</td>
													<?php }
													}
													?>
												</tr>
												<?php 
												}
											}
										}								
									} 
								}
								?>
								</tbody>
							</table>
						</td>
					</tr>
				<?php  $gti=1; $sf="</tr>";
					}
				}
			}
			if($keyy % 2 == 0 && $gti==0) 
			{ 		
				$coin = 0;
				
				if($sf==""){
			?>
			</tr>
			<?php $sf="</tr>";
				} }else{				
				$coin=1;
				if($gti==1){
					$coin=0;
					$gti=0;
				}
			}			
		}
		if($coin==1){
			if($flagDecla==0){
				echo "<td></td></tr>";
			}else{
				echo "</tr>";
			}
		}
		
		?>
    </tbody>		
	</table>
	<br><br>

<table style=" font-size: 12; border-collapse: collapse; ">
      <tr>
         <td style="text-align:center;">
            <span style="font-size: 14;"><strong> SIGNATORY DETAILS</strong></span>           
         </td>
      </tr>
     <br>
       <tr>
         <td>
      <table style="padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse; padding: 5px;">
         <tr>
            <th class="latabv"><strong>Full Name</strong></th>           
            <th class="latabv"><strong>Designation </strong></th>
            <th class="latabv"><strong>Signature </strong></th>
            <th class="latabv"><strong>Date of Signature </strong></th>
         </tr>
         <?php        
          if(isset($signatoryDetails) && count($signatoryDetails) > 0){
            foreach ($signatoryDetails as $key => $signDetails) {
              $signDate=date('d M,Y',strtotime($signDetails['date_of_signing']));
              echo '<tr>
                      <td class="latabv">'.$signDetails['first_name'].' '.$signDetails['middle_name'].' '.$signDetails['last_name'].'</td>
                      <td class="latabv">'.$signDetails['designation'].'</td>
                      <td class="latabv">Electronically signed</td>
                      <td class="latabv">'.$signDate.'</td>
                  </tr>';
            }
          }
         ?>         
      </table>
    </td>
  </tr>
</table>