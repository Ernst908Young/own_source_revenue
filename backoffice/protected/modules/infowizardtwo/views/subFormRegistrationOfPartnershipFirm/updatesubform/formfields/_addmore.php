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
		</a>&nbsp;&nbsp;<br/><br/><span style="color:red;font-size:12px;">(Please click on the button "+Save Detail(s)" to capture details provided above in tabular form)</span>
	</div>
<div class="col-md-12 admr mb-3" id="add_more_<?php echo $id;?>">
<hr>	
<div style="overflow:auto;">
	<table class="table table-striped table-bordered table-hover responsive-table" id="tbl_<?php $tblID="tbl_".$id; echo $id;?>" style="">
	<thead>
		<tr class="add_more_<?php echo $id;?>">
			<?php 
			if(isset($get_selected_field) && !empty($get_selected_field)){
				foreach ($get_selected_field as $key => $valued) 
				{
					if($fd['id']==$valued['button_id']){
				?>
				<th><?php echo $valued['name']; ?> <b class='ukfcl'>(<?php echo $valued['formchk_id']; ?>)</b></th>
				<?php	} 
				} 
			}
			?>
			<th>Action</th>
		</tr>
	</thead>
<tbody>
<?php 
$arrofIn=array(); 
if(!empty($get_selected_field)){
foreach ($get_selected_field as $key => $valued) 
{
	if($fd['id']==$valued['button_id'])
	{ 
		$fcode=$valued['formchk_id'];
		$btnID=$valued['button_id'];
		if(!in_array($valued['button_id'],$arrofIn))
		{
			$arrofIn[]=$valued['button_id'];						
			$ShowTableflg=0;
			//print_r($allData23);die;
			if(isset($allData23[$fcode]))
			{	
				for($k=0; $k<(count($allData23[$fcode]));$k++)
				{ 
					if(isset($allDataMappedWithButton[$btnID]) && !empty($allDataMappedWithButton[$btnID])) 
					{ 
						$btnCoin=0;
						foreach($allDataMappedWithButton[$btnID] as $key1=>$datag){ 
					?>
					<?php if(isset($allData23[$datag]) && is_array($allData23[$datag])){ if(isset($allData23[$datag][$k]) && !empty($allData23[$datag][$k])) { $ShowTableflg=1; $btnCoin=1; } }else{ if(isset($allData23[$datag][$k]) && !empty($allData23[$datag][$k])) { $ShowTableflg=1; $btnCoin=1; } } } } ?>
				<?php if($btnCoin==1){ ?>
				
					<tr class="add_more_<?php echo $id;?>">
						<?php 
						if(isset($allDataMappedWithButton[$btnID]) && !empty($allDataMappedWithButton[$btnID])) 
						{  
						?>
						
						<?php
							$fomFeildMasterArr = array('UK-FCL-00298_0','UK-FCL-00299_0');
							foreach($allDataMappedWithButton[$btnID] as $key1=>$datag){ 
							
							
							if(isset($allData23[$datag]) && is_array($allData23[$datag])){ if(isset($allData23[$datag][$k]) && !empty($allData23[$datag][$k])) { $ShowTableflg=1; $gho=@$allData23[$datag][$k];} }else{ if(isset($allData23[$datag][$k]) && !empty($allData23[$datag][$k])) { $ShowTableflg=1; $gho=@$allData23[$datag];} } 
							
						
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
								<input class="form-control  <?php if(@$datag=='UK-FCL-00226_4'){ echo "sklmf_".$clsr;$clsr=$clsr+1; } ?><?php if(@$datag=='UK-FCL-00226_7'){ echo "skmf"; } ?>" name="<?php echo @$datag;?>[]" type="text" value="<?php if(isset($approvalval) && !empty($approvalval)){ echo $approvalval; }else{ if(isset($allData23[$datag]) && is_array($allData23[$datag])){ if(isset($allData23[$datag][$k]) && !empty($allData23[$datag][$k])) { $ShowTableflg=1; echo @$allData23[$datag][$k];} }else{ if(isset($allData23[$datag][$k]) && !empty($allData23[$datag][$k])) { $ShowTableflg=1; echo @$allData23[$datag];} } } ?>" readonly title="<?php if(isset($approvalval) && !empty($approvalval)){ echo $approvalval; }else{ if(isset($allData23[$datag]) && is_array($allData23[$datag])){ if(isset($allData23[$datag][$k]) && !empty($allData23[$datag][$k])) { $ShowTableflg=1; echo @$allData23[$datag][$k];} }else{ if(isset($allData23[$datag][$k]) && !empty($allData23[$datag][$k])) { $ShowTableflg=1; echo @$allData23[$datag];} } } ?>"> 
							</td>

						<?php } 
						}?>
						<td style="text-align:center;">
							<a onclick='deleterow(this,<?= $id ?>)' class="btn btn-danger del_1" pi="add_more_<?php echo $id;?>">
								<i class="fa fa-trash" aria-hidden="true"></i>
							</a>
						</td>
					</tr>
				<?php 
					} 
				}
			}
		}
	} 
}
}?>
</tbody>
</table>
</div>
<?php 										
if(isset($fieldValues[$tablefieldname])){		
	if(in_array($fieldValues[$tablefieldname],$ButtonsArrayNew)){ ?>
	<style>
		#add_more_<?php echo $id;?>{
			display:block;
		}	
	</style>					
<?php }
}else{ ?>
	<script>
		$("#tbl_<?php echo $id;?>  tbody").html("");
	</script>
<?php }	?>
										
</hr>
										
<?php if(isset($ShowTableflg) && $ShowTableflg==0){ ?>
	<style>
		#<?php echo $tblID;?> { display: none; } 
		#btn_<?php echo $tblID;?> { display: none;}
	</style>
<?php } ?>
</div>	
