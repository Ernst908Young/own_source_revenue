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
         <span style="font-size: 13;">(Section 343)</span>       
      </td>
   </tr>
   <tr>
      <td style="text-align:center;">
         <span style="font-size: 11;">EXTERNAL COMPANY</span>           
      </td>
   </tr>
   <tr>
      <td style="text-align:center;">
         <span style="font-size: 12;"><strong>ANNUAL RETURN (FORM 31)</strong></span>           
      </td>
   </tr>
</table>
<br><br>
<table style="padding-top: 10px; font-size: 12;" width="100%" >
   <tr>
      <td width="8%">     
         1. 
      </td>
      <td width="92%"><strong>Name of Company: </strong><?php echo @$fieldValues['UK-FCL-00089_0']?>      
      </td>
   </tr>
   <tr>
      <td width="8%">     
          
      </td>
      <td width="92%"><strong>Company Number: </strong><?php echo @$fieldValues['UK-FCL-00403_0']?>
      </td>
   </tr>
   <tr>
      <td width="8%">     
          
      </td>
      <td width="92%"><strong>Return for year ending: </strong><?php echo @$fieldValues['UK-FCL-00569_0']?>    
      </td>
   </tr>
   <tr>
      <td width="8%">          
      </td>
      <td width="92%"><strong>Address of Registered or Head Office: </strong><?= @$fieldValues['UK-FCL-00340_0'] . ' ' . @$fieldValues['UK-FCL-00341_0'] . '  ' . @$fieldValues['UK-FCL-00344_0']. '  ' . strtoupper(@$fieldValues['UK-FCL-00385_0']) . ' ' .strtoupper(@$fieldValues['UK-FCL-00347_0']). ' ' . @$fieldValues['UK-FCL-00346_0']?>     
      </td>
   </tr>  
   <tr>
      <td width="8%">      
      </td>
      <td width="92%"><strong>Address of principal office, if any, in Barbados:</strong><?= @$fieldValues['UK-FCL-00570_0'] . ' ' . @$fieldValues['UK-FCL-00571_0'] . ' ' . @$fieldValues['UK-FCL-00572_0']. ' ' . strtoupper(@$fieldValues['UK-FCL-00573_0']) . ' ' . strtoupper(@$fieldValues['UK-FCL-00575_0']).' ' . @$fieldValues['UK-FCL-00574_0']?>   
      </td>
   </tr>
   <tr>
      <td width="8%">           
      </td>
      <td width="92%"><strong>Date of Registration:</strong><?php echo @$fieldValues['UK-FCL-00194_0']?>     
      </td>
   </tr><br>   
   <tr>
      <td width="8%">
         2.            
      </td>
      <td width="92%"><strong>List any changes in corporate structure:</strong><?php echo @$fieldValues['UK-FCL-00576_0']?>  
      </td>
   </tr><br>
   
	<tr>
		<td width="5%">    
		 3.
		</td>
		<td width="95%"><strong>Share Capital:</strong><br>
			<?php if(isset($fieldValues['UK-FCL-00248_0'])){ ?>
			
			<table style="padding: 5px;">
				<?php  
				foreach (@$fieldValues['UK-FCL-00248_0'] as $key => $shareDetails) { ?>
                  
		   

				<tr nobr="true">
					<th class="latabv" ><strong>Class of Shares</strong></th>
					<td class="latabv"><?php echo  @$fieldValues['UK-FCL-00248_0'][$key] ?> </td>
				</tr>
				
				<tr nobr="true">
				   <th class="latabv"><strong>Number of Shares issued</strong></th>
				  <td class="latabv"> <?php echo  @$fieldValues['UK-FCL-00249_0'][$key] ?> </td>
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Authorised Capital</strong></th>
				<td class="latabv"> <?php echo  @$fieldValues['UK-FCL-00250_0'][$key] ?></td>
				
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Purchased by Company In last financial period</strong></th>
					
					<td class="latabv"> <?php echo  @$fieldValues['UK-FCL-00256_0'][$key] ?></td>
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Purchased by Company Cumulative Total</strong></th>
					
					<td class="latabv"> <?php echo  @$fieldValues['UK-FCL-00257_0'][$key] ?></td>
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Redeemed by Company In last financial period</strong></th>
					<td class="latabv"><?php echo  @$fieldValues['UK-FCL-00258_0'][$key] ?> </td>
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Redeemed by Company Cumulative Total</strong></th>
					<td class="latabv"><?php echo  @$fieldValues['UK-FCL-00259_0'][$key] ?> </td>
				</tr>
			 
				<?php } ?>

			</table>
			<?php } ?>
		</td>
	</tr>	  
   
   
   
   <br>
   <tr>
      <td width="8%">
         4.            
      </td>
      <td width="92%"><strong>Main type of business carried on:</strong><?php echo @$fieldValues['UK-FCL-00223_0']?>  
      </td>
   </tr><br>
   <tr>
      <td width="8%">
         5.            
      </td>
      <td width="92%"><strong>Name and address of Attorney or Attorneys appoint under Section 332:</strong><?= @$fieldValues['UK-FCL-00132_0'] . ' ' . @$fieldValues['UK-FCL-00105_0'] . ' ' . @$fieldValues['UK-FCL-00106_0'] ?>
		<?php  
			if($show_main==true){
				echo  @$fieldValues['UK-FCL-00093_0'] . ' ' . @$fieldValues['UK-FCL-00309_0'] . ' ' .strtoupper(@$fieldValues['UK-FCL-00096_0']). ' ' . strtoupper(@$fieldValues['UK-FCL-00129_0']) . ' ' . @$fieldValues['UK-FCL-00310_0'] . '  ' . @$fieldValues['UK-FCL-00094_0'];
			}else{
				echo "Not available publicly";
			}
			
		?>    
      </td>
   </tr><br>
   
   
	<tr>
		<td width="7%">    
		6.
		</td>
		<td width="93%"><strong>Director(s) of Company:</strong><br><br>
			<?php  if(isset($fieldValues['UK-FCL-00150_0']) && is_array($fieldValues['UK-FCL-00150_0'])){ ?>
			
			<table style="padding: 5px;">
				<?php  
				 foreach ($fieldValues['UK-FCL-00150_0'] as $newkey => $authorisedDetails) { ?>
                  
		   

				<tr nobr="true">
					<th class="latabv" ><strong>Full Name</strong></th>
					<td class="latabv"><?php echo @$fieldValues['UK-FCL-00150_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00133_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00134_0'][$newkey]  ?>  </td>
				</tr>
				
				<tr nobr="true">
				   <th class="latabv"><strong>Address</strong></th>
				  <td class="latabv"> <?php if($show_main==true){
					  echo @$fieldValues['UK-FCL-00169_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00335_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00354_0'][$newkey]  .' ' . @$fieldValues['UK-FCL-00372_0'][$newkey]  .' ' . @$fieldValues['UK-FCL-00295_0'][$newkey]  .'  ' . @$fieldValues['UK-FCL-00356_0'][$newkey]; 
					}else{
						  echo "Not available publicly";
					 }
					 ?> </td>
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
	
	
   
   
   
   
   
   <br><br>
   <tr>
      <td width="8%">     
         7. (a) 
      </td>
      <td width="92%"><strong>During the period to which this Annual Return refers did any director or beneficial owner hold a prominent public office in Barbados?</strong><br><?php echo @$fieldValues['UK-FCL-00566_0']?>              
      </td>
   </tr>
   <tr>
      <td width="8%">  &nbsp;&nbsp;&nbsp;&nbsp;(b) 
      </td>
      <td width="92%"><strong>During the period to which this Annual Return refers did any director or beneficial owner hold a prominent public office in Barbados?</strong><br><?php echo @$fieldValues['UK-FCL-00567_0']?>                
      </td>
   </tr>   
</table><br><br><br><br>
<?php if($app_status=='A'){ 
	echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>

 <br>
 <br><br>
<table style="font-size: 12; border-collapse: collapse; ">
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
                  <th class="latabv"><strong>Designation</strong></th>
                  <th class="latabv"><strong>Signature</strong></th>
                  <th class="latabv"><strong>Date of Signature</strong></th>
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
</table><br><br>




