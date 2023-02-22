<style type="text/css">
   .latabv {
   border: 1px solid black;
   }
</style>
<?php 
$show_main = true;
if(isset($_GET['is_vpd'])){
  if($_GET['is_vpd']=='yes'){
    $show_main = false;
  }
} ?>
<table style="padding-top: 10px;">
   <tr>
      <td style="text-align:center;">   
         <span style="font-size: 12;">(Form 9)</span>   <br><br>  
         <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span><br>
         <span style="font-size: 12;">(Sections 66 & 74)</span>   <br><br>
         <span style="font-size: 14;"><strong>NOTICE OF DIRECTORS</strong></span>   <br>
         <span style="font-size: 14;"><strong>OR</strong></span>   <br>
         <span style="font-size: 14;"><strong>NOTICE OF CHANGE OF DIRECTORS</strong></span>  
      </td>
   </tr>
</table>
<br>
<table style="padding-top: 10px; font-size: 12;" width="100%">
   <tr>
      <td width="5%">  
         1.   
      </td>
      <td width="95%">Name of Company : <?= @$fieldValues['UK-FCL-00089_0']?>       
      </td>
   </tr>
   <tr>
      <td width="5%">     
         2. 
      </td>
      <td width="95%">Company Number : <?= @$fieldValues['UK-FCL-00403_0']?>   
      </td>
   </tr>
   <?php
         
      if($fieldValues['UK-FCL-00533_0']=='Notice of Change (Appointment of Director(s))' || $fieldValues['UK-FCL-00533_0']=='Notice of Change (Appointment and Cessation of Director(s))'){
        ?>
		
	<tr>
		<td width="5%">    
		 3.
		</td>
		<td width="95%"><strong>Notice is given that on the <strong><?=date('d', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?> </strong> of <strong><?=date('F', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?>, <?=date('Y', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?></strong> following person(s) was/were appointed directors(s): </strong><br><br>
			<?php if(isset($fieldValues['UK-FCL-00132_0']) && is_array($fieldValues['UK-FCL-00132_0'])) { ?>
			
			<table style="padding: 5px;">
				<?php  
				foreach ($fieldValues['UK-FCL-00132_0'] as $key => $names) { ?>
                  
		   

				<tr nobr="true">
					<th class="latabv" ><strong>Name: </strong></th>
					<td class="latabv"><?php echo  @$fieldValues['UK-FCL-00132_0'][$key] . ' ' . @$fieldValues['UK-FCL-00105_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00106_0'][$key] ?> </td>
				</tr>
				
				<tr nobr="true">
				   <th class="latabv"><strong>Residential Address: </strong></th>
				  <td class="latabv"> <?php  
					if($show_main==true){
						echo @$fieldValues['UK-FCL-00093_0'][$key] . ' ' . @$fieldValues['UK-FCL-00309_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00310_0'][$key] .'  ' . @$fieldValues['UK-FCL-00129_0'][$key]. '  '  .@$fieldValues['UK-FCL-00096_0'][$key]. '    ' . @$fieldValues['UK-FCL-00094_0'][$key];
					}else{
						echo "Not available publicly";
					}
				
					
					?>  </td>
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Occupation: </strong></th>
				<td class="latabv"> <?php echo  @$fieldValues['UK-FCL-00137_0'][$key] ?></td>
				
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Prominent public office: </strong></th>
					
					<td class="latabv"> <?php echo  @$fieldValues['UK-FCL-00480_0'][$key] ?></td>
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Details of office: </strong></th>
					
					<td class="latabv"> <?php echo  @$fieldValues['UK-FCL-00481_0'][$key] ?></td>
				</tr>
				
				<tr nobr="true">
					<th colspan="2"></th>
				</tr>
				
				
			 
				<?php } ?>

			</table>
			<?php } ?>
		</td>
	</tr>
	
	

   
   <?php
      
      }

      if($fieldValues['UK-FCL-00533_0']=='Notice of Change (Cessation of Director(s))' || $fieldValues['UK-FCL-00533_0']=='Notice of Change (Appointment and Cessation of Director(s))'){
      ?>
	<tr>
		<td width="5%">    
		 4.
		</td>
		<td width="95%"><strong>Notice is given that on the <strong><?=date('d', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?> </strong>  of <strong><?=date('F', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?>, <?=date('Y', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?> </strong> of following person(s) ceased to hold office as directors(s): </strong><br><br>
			<?php if(isset($fieldValues['UK-FCL-00132_0']) && is_array($fieldValues['UK-FCL-00132_0'])) { ?>
			
			<table style="padding: 5px;">
				<?php  
				foreach ($fieldValues['UK-FCL-00132_0'] as $key => $names) { ?>
                  
		   

				<tr nobr="true">
					<th class="latabv" ><strong>Name: </strong></th>
					<td class="latabv"><?php echo  @$fieldValues['UK-FCL-00132_0'][$key] . ' ' . @$fieldValues['UK-FCL-00133_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00134_0'][$key] ?> </td>
				</tr>
				
				<tr nobr="true">
				   <th class="latabv"><strong>Residential Address: </strong></th>
				  <td class="latabv"> <?php  
					if($show_main==true){ 
						echo @$fieldValues['UK-FCL-00093_0'][$key] . ' ' . @$fieldValues['UK-FCL-00309_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00310_0'][$key] .' ' . @$fieldValues['UK-FCL-00372_0'][$key]. '  '  .@$fieldValues['UK-FCL-00096_0'][$key]. '   ' . @$fieldValues['UK-FCL-00094_0'][$key]; 
					}else{
						echo "Not available publicly";
					}
				 
					
					?> 
					 </td>
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Occupation: </strong></th>
				<td class="latabv"> <?php echo  @$fieldValues['UK-FCL-00137_0'][$key] ?></td>
				
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Prominent public office: </strong></th>
					
					<td class="latabv"> <?php echo  @$fieldValues['UK-FCL-00480_0'][$key] ?></td>
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Details of office: </strong></th>
					
					<td class="latabv"> <?php echo  @$fieldValues['UK-FCL-00481_0'][$key] ?></td>
				</tr>
				
				<tr nobr="true">
					<th colspan="2"></th>
				</tr>
				
				
			 
				<?php } ?>

			</table>
			<?php } ?>
		</td>
	</tr>
   <?php
      
      }
      if($fieldValues['UK-FCL-00533_0']=='Notice of Director(s)' || $fieldValues['UK-FCL-00533_0']=='Notice of Change (Appointment of Director(s))' || $fieldValues['UK-FCL-00533_0']=='Notice of Change (Cessation of Director(s))' || $fieldValues['UK-FCL-00533_0']=='Notice of Change (Appointment and Cessation of Director(s))'){

      
      ?>
	  
	<tr>
		<td width="5%">    
		 5.
		</td>
		<td width="95%"><strong>The current directors of the Company as of the <strong><?=date('d', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?> </strong> of <strong><?=date('F', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?>, <?=date('Y', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?> </strong> are:  </strong><br><br>
			<?php if(isset($fieldValues['UK-FCL-00132_0']) && is_array($fieldValues['UK-FCL-00132_0'])) { ?>
			
			<table style="padding: 5px;">
				<?php  
				foreach ($fieldValues['UK-FCL-00132_0'] as $key => $names) { ?>
                  
		   

				<tr nobr="true">
					<th class="latabv" ><strong>Name: </strong></th>
					<td class="latabv"><?php echo  @$fieldValues['UK-FCL-00132_0'][$key] . ' ' . @$fieldValues['UK-FCL-00133_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00134_0'][$key] ?>  </td>
				</tr>
				
				<tr nobr="true">
				   <th class="latabv"><strong>Residential Address: </strong></th>
				  <td class="latabv"> <?php 
					if($show_main==true){ 
						echo @$fieldValues['UK-FCL-00093_0'][$key] . ' ' . @$fieldValues['UK-FCL-00309_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00310_0'][$key] .' ' . @$fieldValues['UK-FCL-00372_0'][$key]. '  '  .@$fieldValues['UK-FCL-00096_0'][$key]. '   ' . @$fieldValues['UK-FCL-00094_0'][$key];
				    }else{
						echo "Not available publicly";
					}
					
					?>   </td>
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Occupation: </strong></th>
				<td class="latabv"> <?php echo  @$fieldValues['UK-FCL-00137_0'][$key] ?></td>
				
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Prominent public office: </strong></th>
					
					<td class="latabv"> <?php echo  @$fieldValues['UK-FCL-00480_0'][$key] ?></td>
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Details of office: </strong></th>
					
					<td class="latabv"> <?php echo  @$fieldValues['UK-FCL-00481_0'][$key] ?></td>
				</tr>
				
				
				<tr nobr="true">
					<th colspan="2"></th>
				</tr>
				
			 
				<?php } ?>

			</table>
			<?php } ?>
		</td>
	</tr>
	
	
	  
   
   <?php
      
         }
      
      ?>
</table>
<br><br><br><br>
<?php 
if($app_status=='A'){ 
   echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>


 <br><br><br><br>