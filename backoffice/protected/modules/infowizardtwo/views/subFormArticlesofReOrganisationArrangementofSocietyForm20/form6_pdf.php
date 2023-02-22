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
         <span style="font-size: 14;"><strong>NOTICE OF MANAGERS</strong></span>   <br>
         <span style="font-size: 14;"><strong>OR</strong></span>   <br>
         <span style="font-size: 14;"><strong>NOTICE OF CHANGE OF MANAGERS</strong></span>  
      </td>
   </tr>
</table>
<br>
<table style="padding-top: 10px; font-size: 12;" width="100%">
   <tr>
      <td width="5%">  
         1.   
      </td>
      <td width="95%">Name of Society : <?= @$fieldValues['UK-FCL-00197_0']?>       
      </td>
   </tr>
   <tr>
      <td width="5%">     
         2. 
      </td>
      <td width="95%">Socity Number : <?= @$fieldValues['UK-FCL-00290_0']?>   
      </td>
   </tr>
   <?php
         
      if($fieldValues['UK-FCL-00533_0']=='Notice of Change (Appointment of Managers(s))' || $fieldValues['UK-FCL-00533_0']=='Notice of Change (Appointment and Cessation of Managers(s))'){
        ?>
	
	<tr>
		<td width="5%">    
		 3.
		</td>
		<td width="95%"> <strong>Notice is given that on the <?=date('d', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?> </strong> of <strong><?=date('F', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?>, <?=date('Y', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?> following person(s) was/were appointed managers(s):   </strong> <br>
			<?php if(isset($fieldValues['UK-FCL-00150_0']) && is_array($fieldValues['UK-FCL-00150_0'])) { ?>
			<br><br>
			<table style="padding: 5px;">
				<?php  
				foreach ($fieldValues['UK-FCL-00150_0'] as $key => $names) { ?>
				<tr nobr="true">
					<th class="latabv" ><strong>Name: </strong></th>
					<td class="latabv"><?php echo  @$fieldValues['UK-FCL-00150_0'][$key] . ' ' . @$fieldValues['UK-FCL-00133_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00134_0'][$key] ?> </td>
				</tr>
				
				<tr nobr="true">
				   <th class="latabv"><strong>Residential Address: </strong></th>
				  <td class="latabv"><?php 
					if($show_main==true){
						echo  @$fieldValues['UK-FCL-00107_0'][$key] . ' ' . @$fieldValues['UK-FCL-00335_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00354_0'][$key] .'  ' . @$fieldValues['UK-FCL-00129_0'][$key]. '  '  .@$fieldValues['UK-FCL-00320_0'][$key]. '    ' . @$fieldValues['UK-FCL-00338_0'][$key]; 
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
					<th colspan="2"></th>
				</tr>
				<?php } ?>

			</table>
			<?php } ?>
		</td>
	</tr>
	
	
	
	<!--
   <tr>
      <td width="5%">     
         3. 
      </td>
      <td width="95%"> <strong>Notice is given that on the <?=date('d', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?> </strong> of <strong><?=date('F', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?>, <?=date('Y', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?> following person(s) was/were appointed managers(s):   </strong> 
      </td>
   </tr>
   <!--?php
      $count=1;
      if(isset($fieldValues['UK-FCL-00150_0']) && is_array($fieldValues['UK-FCL-00150_0']))
         foreach ($fieldValues['UK-FCL-00150_0'] as $key => $names) {
            echo '<tr>
                     <td width="5%">     
                        '.$count++.'
                     </td>
                     <td width="95%"> Name: '.@$fieldValues['UK-FCL-00150_0'][$key] . ' ' . @$fieldValues['UK-FCL-00133_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00134_0'][$key] .'
                     </td>
                  </tr>
                  <tr>
                     <td>&nbsp;</td>
                 
                     <td width="95%"> Residential Address: '.@$fieldValues['UK-FCL-00107_0'][$key] . ' ' . @$fieldValues['UK-FCL-00335_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00354_0'][$key] .'  ' . @$fieldValues['UK-FCL-00129_0'][$key]. '  '  .@$fieldValues['UK-FCL-00320_0'][$key]. '    ' . @$fieldValues['UK-FCL-00338_0'][$key] .'
                     </td>
                  </tr>
                  <tr>
                     <td>&nbsp;</td>
                  
                     <td width="95%"> Occupation: '.@$fieldValues['UK-FCL-00137_0'][$key] . '
                     </td>
                  </tr>
                   ';
         }
      }
	-->
	<?php }
      if($fieldValues['UK-FCL-00533_0']=='Notice of Change (Cessation of Managers(s))' || $fieldValues['UK-FCL-00533_0']=='Notice of Change (Appointment and Cessation of Managers(s))'){
      ?>
	  
	  
	<tr>
		<td width="5%">    
		 4.
		</td>
		<td width="95%"><strong> Notice is given that on the <?=date('d', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?> </strong> of <strong><?=date('F', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?>, <?=date('Y', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?> of following person(s) ceased to hold office as managers(s):  </strong><br>
			<?php if(isset($fieldValues['UK-FCL-00397_0']) && is_array($fieldValues['UK-FCL-00397_0'])) { ?>
			<br><br>
			<table style="padding: 5px;">
				<?php  
				foreach ($fieldValues['UK-FCL-00397_0'] as $key => $names) { ?>
                  
		   

				<tr nobr="true">
					<th class="latabv" ><strong>Name: </strong></th>
					<td class="latabv"><?php echo  @$fieldValues['UK-FCL-00397_0'][$key] . ' ' . @$fieldValues['UK-FCL-00466_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00419_0'][$key]  ?> </td>
				</tr>
				
				<tr nobr="true">
				   <th class="latabv"><strong>Residential Address: </strong></th>
				  <td class="latabv"> <?php  if($show_main==true){ echo  @$fieldValues['UK-FCL-00468_0'][$key] . ' ' . @$fieldValues['UK-FCL-00238_0'][$key]  . '  ' . @$fieldValues['UK-FCL-00382_0'][$key] .'  ' . @$fieldValues['UK-FCL-00372_0'][$key]. '  '  .@$fieldValues['UK-FCL-00384_0'][$key]. '  ' . @$fieldValues['UK-FCL-00383_0'][$key];
					}else{
							echo 'Not available publicly';
						}
					
					?> </td>
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Occupation: </strong></th>
				<td class="latabv"> <?php echo  @$fieldValues['UK-FCL-00239_0'][$key]  ?></td>
				
				</tr>
				<tr nobr="true">
					<th colspan="2"></th>
				</tr>
				
				
				
			 
				<?php } ?>

			</table>
			<?php } ?>
		</td>
	</tr>
	
	
	<!--
   <tr>
      <td width="5%">     
         4. 
      </td>
      <td width="95%"><strong> Notice is given that on the <?=date('d', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?> </strong> of <strong><?=date('F', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?>, <?=date('Y', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?> of following person(s) ceased to hold office as managers(s):  </strong>
      </td>
   </tr>
   <!--?php
      $count=1;
      if(isset($fieldValues['UK-FCL-00397_0']) && is_array($fieldValues['UK-FCL-00397_0']))
         foreach ($fieldValues['UK-FCL-00397_0'] as $key => $names) {
            echo '<tr>
                     <td width="5%">     
                        '.$count++.'
                     </td>
                     <td width="95%"> Name: '.@$fieldValues['UK-FCL-00397_0'][$key] . ' ' . @$fieldValues['UK-FCL-00466_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00419_0'][$key] .'
                     </td>
                  </tr>
                  <tr>
                     <td>&nbsp;</td>
                 
                     <td width="95%"> Residential Address: '.@$fieldValues['UK-FCL-00468_0'][$key] . ' ' . @$fieldValues['UK-FCL-00238_0'][$key]  . '  ' . @$fieldValues['UK-FCL-00382_0'][$key] .'  ' . @$fieldValues['UK-FCL-00372_0'][$key]. '  '  .@$fieldValues['UK-FCL-00384_0'][$key]. '  ' . @$fieldValues['UK-FCL-00383_0'][$key] .'
                        </td>
                  </tr>
                  <tr>
                     <td>&nbsp;</td>
                  
                     <td width="95%"> Occupation: '.@$fieldValues['UK-FCL-00239_0'][$key] . '
                     </td>
                  </tr>
                   ';
         }
      }
	  
	-->
	<?php }
      if($fieldValues['UK-FCL-00533_0']=='Notice of Change (Appointment of Managers(s))' || $fieldValues['UK-FCL-00533_0']=='Notice of Change (Cessation of Managers(s))' || $fieldValues['UK-FCL-00533_0']=='Notice of Change (Appointment and Cessation of Managers(s))'){

      
      ?>
	  
	  
	
	<tr>
		<td width="5%">    
		 5.
		</td>
		 <td width="95%"><strong>The current managers of the Society as of the <?=date('d', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?> </strong> of <strong><?=date('F', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?>, <?=date('Y', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?> are: </strong><br>
			<?php if(isset($fieldValues['UK-FCL-00397_0']) && is_array($fieldValues['UK-FCL-00397_0'])) { ?>
			<br><br>
			<table style="padding: 5px;">
				<?php  
				foreach ($fieldValues['UK-FCL-00397_0'] as $key => $names) { ?>
                  
		   

				<tr nobr="true">
					<th class="latabv" ><strong>Name: </strong></th>
					<td class="latabv"><?php echo @$fieldValues['UK-FCL-00397_0'][$key] . ' ' . @$fieldValues['UK-FCL-00466_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00398_0'][$key] ?>  </td>
				</tr>
				
				<tr nobr="true">
				   <th class="latabv"><strong>Residential Address: </strong></th>
				  <td class="latabv"> <?php  if($show_main==true){
				  	echo  @$fieldValues['UK-FCL-00468_0'][$key] . ' ' . @$fieldValues['UK-FCL-00238_0'][$key]  . '  ' . @$fieldValues['UK-FCL-00382_0'][$key] .'  ' . @$fieldValues['UK-FCL-00372_0'][$key]. '  '  .@$fieldValues['UK-FCL-00384_0'][$key]. '  ' . @$fieldValues['UK-FCL-00383_0'][$key]; 
					}else{
							echo 'Not available publicly';
						}
					
					?>  </td>
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Occupation: </strong></th>
				<td class="latabv"> <?php echo  @$fieldValues['UK-FCL-00239_0'][$key] ?></td>
				
				</tr>
				<tr nobr="true">
					<th colspan="2"></th>
				</tr>
				
				<?php } ?>

			</table>
			<?php } ?>
		</td>
	</tr>
	
	
	
	<!--
   <tr>
      <td width="5%">     
         5. 
      </td>
      <td width="95%"><strong>The current managers of the Society as of the <?=date('d', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?> </strong> of <strong><?=date('F', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?>, <?=date('Y', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))?> are: </strong>
      </td>
   </tr>
   <!--?php
      $count=1;
       if(isset($fieldValues['UK-FCL-00397_0']) && is_array($fieldValues['UK-FCL-00397_0']))
            foreach ($fieldValues['UK-FCL-00397_0'] as $key => $names) {
               echo '<tr>
                        <td width="5%">     
                           '.$count++.'
                        </td>
                        <td width="95%"> Name: '.@$fieldValues['UK-FCL-00397_0'][$key] . ' ' . @$fieldValues['UK-FCL-00466_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00398_0'][$key] .'
                        </td>
                     </tr>
                     <tr>
                        <td>&nbsp;</td>
                    
                        <td width="95%"> Residential Address: '.@$fieldValues['UK-FCL-00468_0'][$key] . ' ' . @$fieldValues['UK-FCL-00238_0'][$key]  . '  ' . @$fieldValues['UK-FCL-00382_0'][$key] .'  ' . @$fieldValues['UK-FCL-00372_0'][$key]. '  '  .@$fieldValues['UK-FCL-00384_0'][$key]. '  ' . @$fieldValues['UK-FCL-00383_0'][$key] .'
                        </td>
                     </tr>
                     <tr>
                        <td>&nbsp;</td>
                     
                        <td width="95%"> Occupation: '.@$fieldValues['UK-FCL-00239_0'][$key] . '
                        </td>
                     </tr>
                      ';
            }
         }
      
      ?>
	  
	-->
	 <?php
      
         }
      
      ?>
</table>
<br><br><br>
<?php if($app_status=='A'){ 
	echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?><br><br>