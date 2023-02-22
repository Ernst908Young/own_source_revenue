<style type="text/css">
   .latabv {
   border: 1px solid black;
   }
</style>
<br>
<table style="padding-top: 10px;">
   <tr>
      <td style="text-align:center;">     
         <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span>
      </td>
   </tr>
   <tr>
      <td style="text-align:center;">
         <span style="font-size: 13;">(Section 251)</span>       
      </td>
   </tr>
   <tr>
      <td style="text-align:center;">
         <span style="font-size: 11;"><strong>REGISTRATION OF ENFORCEMENT OF SECURITY</strong></span>           
      </td>
   </tr>
</table>
<br><br>
<table style="padding-top: 10px; font-size: 12;" width="100%" >
   <tr>
		<td width="5%">  
        1.      
		</td>
		<td width="95%"><strong>Type of entity:</strong>
			<br><br><?php  if(isset($fieldValues['UK-FCL-00675_0'])){ echo $fieldValues['UK-FCL-00675_0'];}?>
		</td>
	</tr>

	<table style="padding-top: 10px; font-size: 12;" width="100%">
	<?php if($fieldValues['UK-FCL-00675_0'] == "Company other than Unregistered External Company" || $fieldValues['UK-FCL-00675_0'] == "Society") { ?>
	
	<?php if($fieldValues['UK-FCL-00675_0'] == 'Company other than Unregistered External Company') { ?>
    <tr>
      <td width="5%">     
        2. 
      </td>
      <td width="95%"><strong>Name of Company: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00651_0'])){ echo $fieldValues['UK-FCL-00651_0'];}?>        
      </td>
    </tr>
	<?php } else {?>
	<tr>
      <td width="5%">     
        2. 
      </td>
      <td width="95%"><strong>Name of Society: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00651_0'])){ echo $fieldValues['UK-FCL-00651_0'];}?>        
      </td>
    </tr>
	<?php } ?>
    
	<?php if($fieldValues['UK-FCL-00675_0'] == 'Company other than Unregistered External Company') { ?>
    <tr>
      <td width="5%">     
        3. 
      </td>
      <td width="95%"><strong>Company Number: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00650_0'])){ echo $fieldValues['UK-FCL-00650_0'];}?>        
      </td>
    </tr>
	<?php } else { ?>
	 <tr>
      <td width="5%">     
        3. 
      </td>
      <td width="95%"><strong>Society Number: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00650_0'])){ echo $fieldValues['UK-FCL-00650_0'];}?>        
      </td>
    </tr>
	<?php } ?>
	
	<?php } else { ?>
	
	<tr>
      <td width="5%">     
        2. 
      </td>
      <td width="95%"><strong>Unregistered External Entity Number: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00676_0'])){ echo $fieldValues['UK-FCL-00676_0'];}?>        
      </td>
    </tr>

    
    <tr>
      <td width="5%">     
        3. 
      </td>
      <td width="95%"><strong>Name of Unregistered External Entity:</strong><br><br><?php  if(isset($fieldValues['UK-FCL-00677_0'])){ echo $fieldValues['UK-FCL-00677_0'];}?>        
      </td>
    </tr>
	
	<?php } ?>
	
   <tr>
      <td width="5%">     
        4. 
      </td>
      <td width="95%"><strong>Name of person: </strong><span style="text-align: justify;"><?= @$fieldValues['UK-FCL-00132_0'] . ' ' . @$fieldValues['UK-FCL-00105_0'] . ' ' . @$fieldValues['UK-FCL-00106_0']?>  </span>     
      </td>
   </tr>
   <tr>
      <td width="5%">     
        5. 
      </td>
      
      <td width="95%"><strong>Is the above mentioned person obtained an order for the appointement of a receiver, if yes please fill the details:</strong><br><br> <?php if($fieldValues['UK-FCL-00693_0'] == 'Yes'){ 
					
					echo @$fieldValues['UK-FCL-00617_0'];
				}else{
					
					echo "Not Applicable";
				}
		
		?>
      </td>
   </tr>
   
   <tr>
      <td width="5%">     
        6. 
      </td>
      
      <td width="95%"><strong>Has the above mentioned person appointed of a receiver, if yes please fill the details:</strong><br><br> <?php if($fieldValues['UK-FCL-00694_0'] == 'Yes'){ 
					
					echo @$fieldValues['UK-FCL-00636_0'];
				}else{
					
					echo "Not Applicable";
				}
		
		?>
      </td>
   </tr>
	
	<tr>
      <td width="5%">     
        7. 
      </td>
      
      <td width="95%"><strong>Has the above mentioned person entered into possession of, if yes please fill the details:</strong><br><br> <?php if($fieldValues['UK-FCL-00695_0'] == 'Yes'){ 
					
					echo @$fieldValues['UK-FCL-00637_0'];
				}else{
					
					echo "Not Applicable";
				}
		
		?>
      </td>
	</tr>
	
	<tr>
      <td width="5%">     
        8. 
      </td>
      
      <td width="95%"><strong>Has the above mentioned person ceased to act as receiver, if yes please fill the details:</strong><br><br> <?php if($fieldValues['UK-FCL-00696_0'] == 'Yes'){ 
					
					echo @$fieldValues['UK-FCL-00689_0'];
				}else{
					
					echo "Not Applicable";
				}
		
		?>
      </td>
	</tr>
	<tr>
      <td width="5%">     
        9. 
      </td>
      
      <td width="95%"><strong>Has the above mentioned person gone out of possession, if yes please fill the details:</strong><br><br> <?php if($fieldValues['UK-FCL-00697_0'] == 'Yes'){ 
					
					echo @$fieldValues['UK-FCL-00698_0'];
				}else{
					
					echo "Not Applicable";
				}
		
		?>
      </td>
	</tr> 
   
</table>

<br><br><br><br><br><br>
<?php if($app_status=='A'){ 
  echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>
 <br><br>


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

