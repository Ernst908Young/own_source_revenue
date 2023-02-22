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

<br>
<table style="padding-top: 10px;">
   <tr>
      <td style="text-align:center;">     
         <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span>
      </td>
   </tr>
   <tr>
      <td style="text-align:center;">
         <span style="font-size: 13;">(Section 15A)</span>       
      </td>
   </tr>
   <tr>
      <td style="text-align:center;">
         <span style="font-size: 11;"><strong>ANNUAL RETURN</strong></span>           
      </td>
   </tr>
</table>
<br><br>
<table style="padding-top: 20px; font-size: 12;" width="100%" >
   <tr>
      <td width="7%">     
         1. 
      </td>
      <td width="93%"><strong>Name of Company: </strong><?php echo @$fieldValues['UK-FCL-00632_0']?>      
      </td>
   </tr>
   <tr>
      <td width="7%">     
         2. 
      </td>
      <td width="93%"><strong>Company Number: </strong><?php echo @$fieldValues['UK-FCL-00631_0']?>
      </td>
   </tr>
   <tr>
      <td width="7%">     
         3. 
      </td>
      <td width="93%"><strong>Return for the year: </strong><span style="text-align: justify;"><?php echo @$fieldValues['UK-FCL-00556_0']?> </span>     
      </td>
   </tr>
   <tr>
      <td width="7%">     
         4. 
      </td>
      <td width="93%"><strong>Registered Office of Company:</strong> <?= @$fieldValues['UK-FCL-00340_0'] . ' ' . @$fieldValues['UK-FCL-00341_0'] . ' ' . @$fieldValues['UK-FCL-00344_0']. ' ' .strtoupper(@$fieldValues['UK-FCL-00345_0']) . ' ' . @$fieldValues['UK-FCL-00347_0'].' ' . @$fieldValues['UK-FCL-00346_0']?>   
      </td>
   </tr>
   <tr>
      <td width="7%">     
         5. 
      </td>
      <td width="93%"><strong>Date of Incorporation/Continuance/Amalgamation: </strong><?php echo @$fieldValues['UK-FCL-00557_0']?>   
      </td>
   </tr>
   
   <tr>
		<td width="7%">    
		6.
		</td>
		<td width="93%"><strong>SHARE CAPITAL/Quota:</strong><br><br>
			<?php if(isset($fieldValues['UK-FCL-00639_0'])){ ?>
			
			<table style="padding: 5px;">
				<?php  
				foreach (@$fieldValues['UK-FCL-00639_0'] as $key => $shareDetails) { ?>
                  
		   

				<tr nobr="true">
					<th class="latabv" ><strong>Share Capital Class of Shares/Quotas</strong></th>
					<td class="latabv"><?php echo  @$fieldValues['UK-FCL-00639_0'][$key] ?> </td>
				</tr>
				
				<tr nobr="true">
				   <th class="latabv"><strong>Share Capital Number issued & outstanding</strong></th>
				  <td class="latabv"> <?php echo  @$fieldValues['UK-FCL-00642_0'][$key] ?> </td>
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Issued by Company in the year ending Number of Shares/Quotas </strong></th>
				<td class="latabv"> <?php echo  @$fieldValues['UK-FCL-00640_0'][$key] ?></td>
				
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Transferred by Company in the year ending Number of Shares/Quotas</strong></th>
					
					<td class="latabv"> <?php echo  @$fieldValues['UK-FCL-00641_0'][$key] ?></td>
				</tr>
				
			 
				<?php } ?>

			</table>
			<?php } ?>
		</td>
	</tr>	
	
	 <tr>
		<td width="7%">    
		7.
		</td>
		<td width="93%"><strong>AUTHORISED SHARE CAPITAL:</strong><br><br>
			
			<?php if(isset($fieldValues['UK-FCL-00643_0']) && is_array($fieldValues['UK-FCL-00643_0']) ){ ?>
			<table style="padding: 5px;">
			
				<?php foreach($fieldValues['UK-FCL-00643_0'] as $key => $authorisedDetails) { ?>
				<tr nobr="true">
					<th class="latabv" ><strong>Class of Shares/Quotas</strong></th>
					<td class="latabv"> <?php echo @$fieldValues['UK-FCL-00643_0'][$key] ?> </td>
				</tr>
				
				
				<tr nobr="true">
					<th class="latabv"><strong>Number of Shares/Quotas in each class</strong></th>
					
					<td class="latabv"> <?php echo @$fieldValues['UK-FCL-00644_0'][$key] ?></td>
				</tr>
				
				<?php } ?>
			</table>
			
			<?php } else { ?>
				<table style="padding: 5px;">
					
						<tr nobr="true">
							<th class="latabv" ><strong>Class of Shares/Quotas</strong></th>
							<td class="latabv"> <?php echo @$fieldValues['UK-FCL-00643_0'] ?> </td>
						</tr>
						
						
						<tr nobr="true">
							<th class="latabv"><strong>Number of Shares/Quotas in each class</strong></th>
							
							<td class="latabv"> <?php echo @$fieldValues['UK-FCL-00644_0'] ?></td>
						</tr>
						
					
				
				</table>
			
			<?php }  ?>
				
			
			
		</td>
	</tr>
	
 
   
   <tr>
      <td width="7%">     
         8. 
      </td>
      <td width="93%"><strong>Did the assets or revenue of the Company/Society during the year ending exceed $4 million?</strong><br><?php echo @$fieldValues['UK-FCL-00562_0']?>   
      </td>
   </tr>
   <tr>
      <td width="7%">     
         9. 
      </td>
      <td width="93%"><strong>Total amount secured by the Company/Society in respect of all charges which are required to be registered with the Registrar under section 237 of the Companies Act:</strong><br><?php echo @$fieldValues['UK-FCL-00563_0']?>     
      </td>
   </tr>
   
   <tr>
		<td width="7%">    
		10.
		</td>
		<td width="93%"><strong>The Directors/Managers of the Company/Society as of the date of the Annual Return are:</strong><br><br>
			<?php if(isset($fieldValues['UK-FCL-00132_0']) && is_array($fieldValues['UK-FCL-00132_0'])){ ?>
			
			<table style="padding: 5px;">
				<?php  
				foreach ($fieldValues['UK-FCL-00132_0'] as $newkey => $authorisedDetails) { ?>
                  
		   

				<tr nobr="true">
					<th class="latabv" ><strong>Name</strong></th>
					<td class="latabv"><?php echo @$fieldValues['UK-FCL-00132_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00105_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00317_0'][$newkey]  ?>  </td>
				</tr>
				
				
	
				<tr nobr="true">
				   <th class="latabv"><strong>Address</strong></th>
					<td class="latabv"> <?php  if($show_main==true){
						
						echo @$fieldValues['UK-FCL-00093_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00309_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00310_0'][$newkey]  .' ' . strtoupper(@$fieldValues['UK-FCL-00129_0'][$newkey])  .' ' . strtoupper(@$fieldValues['UK-FCL-00096_0'][$newkey])  .'  ' . @$fieldValues['UK-FCL-00094_0'][$newkey];
					}else{
						 echo "Not available publicly";
					}
					
					?> 
					</td>
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Occupation </strong></th>
				<td class="latabv"><?php echo @$fieldValues['UK-FCL-00137_0'][$newkey] ?>  </td>
				
				</tr>
				
				
				
			 
				<?php } ?>

			</table>
			<?php } ?>
		</td>
	</tr>
	
	<tr>
		<td width="7%">    
		11.
		</td>
		<td width="93%"><strong>Whether the Company have a Secretary</strong><br><br>
			
			
			<?php if(isset($fieldValues['UK-FCL-00672_0'])  && $fieldValues['UK-FCL-00672_0'] == 'Yes'){  ?>
				<?php echo @$fieldValues['UK-FCL-00672_0'];  ?><br><br>
			<table style="padding: 5px;">
				
                  
		   

				<tr nobr="true">
					<th class="latabv" ><strong>Name</strong></th>
					<td class="latabv"><?php echo @$fieldValues['UK-FCL-00150_0'] . ' ' . @$fieldValues['UK-FCL-00133_0'] . ' ' . @$fieldValues['UK-FCL-00324_0']  ?>  </td>
				</tr>
				
				<tr nobr="true">
				   <th class="latabv"><strong>Address</strong></th>
				  <td class="latabv"> <?php 
					if($show_main==true){
					
						echo @$fieldValues['UK-FCL-00107_0'] . ' ' . @$fieldValues['UK-FCL-00335_0'] . ' ' . @$fieldValues['UK-FCL-00354_0']. ' ' . InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00372_0']). ' ' .InfowizardQuestionMasterExt::getCountryStateNameByID( @$fieldValues['UK-FCL-00320_0']). '  ' . @$fieldValues['UK-FCL-00356_0']; 
					}else{
						echo "Not available publicly";
					}
						?> </td>
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Occupation </strong></th>
				<td class="latabv"><?php echo @$fieldValues['UK-FCL-00304_0'] ?>  </td>
				
				</tr>
				
				
				
			 
				

			</table>
				
			<?php } else{
				echo "No";
			}?>
			
			


			 
			
			

		   

			
			
				
				
			 
				

		</td>
	</tr>
	
   <!--
   <tr>
      <td width="7%">
         11.            
      </td>
      <td width="93%"><strong>The Secretary (if any) of the Company as of the date of the Annual Return is:</strong><span style="text-align: justify;">  </span>     
      </td>
   </tr>
   <tr>
      <td width="7%">            
      </td>
      <td width="93%"><strong>Name:</strong><span style="text-align: justify;"> <?= @$fieldValues['UK-FCL-00150_0'] . ' ' . @$fieldValues['UK-FCL-00133_0'] . ' ' . @$fieldValues['UK-FCL-00324_0']?>    </span>     
      </td>
   </tr>
   <tr>
      <td width="7%">            
      </td>
      <td width="93%"><strong>Address:</strong><span style="text-align: justify;"> <?= @$fieldValues['UK-FCL-00107_0'] . ' ' . @$fieldValues['UK-FCL-00335_0'] . ' ' . @$fieldValues['UK-FCL-00354_0']. ' ' . InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00372_0']). ' ' .InfowizardQuestionMasterExt::getCountryStateNameByID( @$fieldValues['UK-FCL-00320_0']). '  ' . @$fieldValues['UK-FCL-00356_0']?>  </span>     
      </td>
   </tr>
   <tr>
      <td width="7%">            
      </td>
      <td width="93%"><strong>Occupation:</strong><span style="text-align: justify;"> <?= @$fieldValues['UK-FCL-00304_0']?>    </span>     
      </td>
   </tr>
   
   -->
   <tr>
      <td width="7%">12.(a)</td>
      <td width="93%"><strong>During the period to which this Annual Return refers did any director or beneficial owner hold a prominent public office in Barbados?</strong><br><span style="text-align: justify;"><?php echo @$fieldValues['UK-FCL-00566_0']?> </span>     
      </td>
   </tr>
   <tr>
      <td width="7%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(b)</td>
      <td width="93%"><strong>During the period to which this Annual Return refers did any director or beneficial owner or an affiliate of such a person hold a prominent public offi ce in any other country?</strong><br><span style="text-align: justify;"><?php echo @$fieldValues['UK-FCL-00567_0']?>   </span>     
      </td>
   </tr>
   <tr>
      <td width="7%">  
         13.          
      </td>
      <td width="93%"><strong>I certify that the Company has maintained at its Registered Office the records pertaining to the Company including the records pertaining to beneficial ownership in accordance with sections 170 to 172 of the Companies Act.</strong><span style="text-align: justify;">  </span>     
      </td>
   </tr>
   <tr>
      <td width="7%">  
      </td>
      <td width="93%"><strong>I also certify that notification of any change in beneficial ownership was submitted to the Registrar in accordance with secion 170A of the Companies Act and that all beneficial ownership information maintained at the registered offi ce has been verified by the director.</strong><span style="text-align: justify;">  </span>     
      </td>
   </tr>
   
</table>
<br><br><br><br>

<?php if($app_status=='A'){ 
	echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>
 <br>
 <br>
 <br>

<table style=" font-size: 12; border-collapse: collapse; ">
      <tr>
         <td style="text-align:center;">
            <span style="font-size: 12;"><strong> SIGNATORY DETAILS</strong></span>           
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

