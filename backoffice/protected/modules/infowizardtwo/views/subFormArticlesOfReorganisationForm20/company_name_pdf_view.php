<table style="padding-top: 10px;">
   <tr>
      <td style="text-align:center;">     
         <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span><br>
         <span style="font-size: 11;">(Sections 223 and 224)</span>   <br><br>
         <span style="font-size: 14;"><strong>ARTICLES OF RE-ORGANISATION/ARRANGEMENT</strong></span>   <br>
          
      </td>
   </tr>
</table>
<br><br><br>
<table style="padding-top: 10px; font-size: 12;" width="100%">
  <tr>
    <td width="5%">     
      1. 
    </td>
    <td width="95%"><strong>Name of Company: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00089_0'])){ echo $fieldValues['UK-FCL-00089_0'];}?>        
    </td>
  </tr>
</table>
<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
          
      </td>
      <td width="95%"><strong>Company Number: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00403_0'])){ echo $fieldValues['UK-FCL-00403_0'];}?>      </td>
    </tr>
	
    <tr>
      <td width="5%"> 2.      
      </td>
      <td width="95%"><b>In accordance with the order of re-organisation/arrangement, the Articles of Incorporation are amended with respect to the following:</b>
        <br><br><?php 
        $typeodchange = [];
        if(isset($fieldValues['UK-FCL-00673_0'])){
          if(is_array($fieldValues['UK-FCL-00673_0'])){
            if(!empty($fieldValues['UK-FCL-00673_0'])){
              $typeodchange = $fieldValues['UK-FCL-00673_0'];
              foreach ($typeodchange as $key => $value) {
                 echo '- '.$value.'<br>';
              }
             
            }
          }
        } ?>
      </td>
    </tr>
	
	<?php if(in_array('Name of the Company', $typeodchange)){ ?>
    <tr>
		<td width="5%"> </td>
			<td width="95%"><strong>SRN of Name Reservation form (Form 33):</strong><br><span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00331_0']; ?></span>
			</td>
	</tr>
	<tr> 
		<td width="5%"> </td>
			<td width="95%"><strong>New Name of Company: </strong><br><span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00507_0']; ?></span>
		</td>
		
	</tr>
	<?php } ?>
	
	<!--- 2 step---->
	<?php if(in_array('Details of shares and share transfer', $typeodchange)){ ?>
		<tr>
			<td width="5%"> </td>
				<td width="95%"><strong>The classes and any maximum number of shares that the Company is authorized to issue:</strong><br>
				</td>
			
		</tr>
		
		<tr>
			<td width="5%"></td>
		<td width="95%">
     
		<?php 
		
		$arrayFields = $fieldValues['UK-FCL-00095_0'];
		
		if(is_array($arrayFields)){ ?>
			<table style="padding: 5px;">
					
					<?php  foreach ($arrayFields as $key => $value) {  
						  
					?>

					<tr nobr="true">
						<th class="latabv" ><strong>Type of Shares</strong></th>
						<td class="latabv"><?php echo @$value;?></td>
					</tr>
					
					<tr nobr="true">
						<th class="latabv"><strong>Name of class of shares</strong></th>
						<td class="latabv"><?php echo @$fieldValues['UK-FCL-00263_0'][$key];?></td>
					</tr>
					
					<tr nobr="true">
						<th class="latabv"><strong>Maximum no. of shares</strong></th>
						<td class="latabv"><?php echo @$fieldValues['UK-FCL-00264_0'][$key];?></td>
					</tr>
					
					<tr nobr="true">
						<th class="latabv" ><strong>Are these shares redeemable</strong></th>
						<td class="latabv"><?php echo @$fieldValues['UK-FCL-00265_0'][$key];?></td>
					</tr>
					
					<tr nobr="true">
						<th class="latabv"><strong>Price / formula for calculation of price</strong></th>
						<td class="latabv"><?php echo @$fieldValues['UK-FCL-00266_0'][$key];?></td>
					</tr>
					
					<tr nobr="true">
						<th class="latabv"><strong>Rights & privileges attached to the share</strong></th>
						<td class="latabv"><?php echo @$fieldValues['UK-FCL-00113_0'][$key];?></td>
					</tr>
					
					<tr nobr="true">
						<th colspan="2"></th>
					</tr>

				<?php } ?> 

			</table>
		<?php }  ?>
		</td>
    </tr>
		
	
		
	<tr> 
		<td width="5%"> </td>
			<td width="95%"><strong>Restriction if any on share transfers: </strong><br>
			<?php 
				if(isset($fieldValues['UK-FCL-00334_0'])){
					if($fieldValues['UK-FCL-00334_0'] == 'Yes'){
						if(is_array($fieldValues['UK-FCL-00504_0'])){
							foreach ($fieldValues['UK-FCL-00504_0'] as $key => $value) {
								if($value=='Other Restrictions'){
								  echo  @$value.'<br>'. @$fieldValues['UK-FCL-00116_0'];
								}else{
								  echo @$value.'<br><br>';
								}
							}
						}
					}else{
						echo "<br> No";
					}
				}
			?>

		</td>
		
	</tr>
		
	<?php } ?>
	
	<!--- 3 step---->
	<?php if(in_array('Details of Directors', $typeodchange)){ ?>
    <tr>
		<td width="5%"> </td>
			<td width="95%"><strong>Number (or minimum and maximum number) of Directors:</strong><br><br><?= @$fieldValues['UK-FCL-00240_0'] == 'Fixed Number' ? ("Number of Directors are : ".@$fieldValues['UK-FCL-00241_0']) : (" Minimum : ".@$fieldValues['UK-FCL-00119_0'].", Maximum : ".@$fieldValues['UK-FCL-00120_0']) ?>
			</td>
	</tr>
	
	<?php } ?>
	
	<!--- 4 step---->
	<?php if(in_array('Business of the Company', $typeodchange)){ ?>
    <tr>
		<td width="5%"> </td>
			<td width="95%"><strong>Restrictions if any on the business the company may carry on:</strong><br><br>
				<?php echo @$fieldValues['UK-FCL-00122_0']; ?>
			</td>
	</tr>
	
	<?php } ?>
	
	
	<!--- 5 step---->
	
	<?php if(in_array('Type of Company', $typeodchange)){ ?>
    <tr>
		<td width="5%"> </td>
			<td width="95%"><strong>Type of Company:</strong><br><br>
				<?php  if(isset($fieldValues['UK-FCL-00306_0'])){ echo $fieldValues['UK-FCL-00306_0'];}?>        
				
			</td>
	</tr>
	
	<?php } ?>
	
	
	<!--- 6 step---->
	<?php if(in_array('Other Provisions', $typeodchange)){ ?>
    <tr>
		<td width="5%"> </td>
			<td width="95%"><strong>Other provisions, if any:</strong><br><br>
				<?php echo @$fieldValues['UK-FCL-00233_0']; ?>
			</td>
	</tr>
	
	<?php } ?>
	
	<tr>
      <td width="5%">     
        4. 
      </td>
      <td width="95%"><strong>Date of passing of resolution:</strong><br><br><?php  if(isset($fieldValues['UK-FCL-00667_0'])){ echo $fieldValues['UK-FCL-00667_0'];}?>        
      </td>
    </tr>
	
	<tr>
      <td width="5%">     
        5. 
      </td>
      <td width="95%"><strong>Special Resolution attached as:</strong><br><br><?php  if(isset($fieldValues['UK-FCL-00668_0'])){ echo $fieldValues['UK-FCL-00668_0'];}?>        
      </td>
    </tr>
  
  

</table>

<?php 

    if(isset($fieldValues2['UK-FCL-00546_0']) && $fieldValues2['UK-FCL-00546_0']=='Yes')
      $this->renderPartial('form4_pdf', array('aap' => $allActivePages, 'formData' => $formData, 'fieldValues' => $fieldValues2, 'app_id' => $fieldValues['submission_id'], 'app_status' => $fieldValues['application_status'], 'application_created_date' => $fieldValues['application_created_date']), true);
    if(isset($fieldValues2['UK-FCL-00547_0']) && $fieldValues2['UK-FCL-00547_0']=='Yes')
      $this->renderPartial('form9_pdf', array('aap' => $allActivePages, 'formData' => $formData, 'fieldValues' => $fieldValues2, 'app_id' => $fieldValues['submission_id'], 'app_status' => $fieldValues['application_status'], 'application_created_date' => $fieldValues['application_created_date']), true);

?>

<style type="text/css">
   .latabv {
   border: 1px solid black;
   }
</style>

<br><br>
