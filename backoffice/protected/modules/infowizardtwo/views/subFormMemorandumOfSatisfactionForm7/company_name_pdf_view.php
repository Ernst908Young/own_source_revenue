
<table style="padding-top: 10px;">
	
    <tr>

      <td style="text-align:center;">     
        <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span>
    </td>
     </tr>
       <tr>
        <td style="text-align:center;">
             <span style="font-size: 13;">(Section 33 and 203)</span>       
        </td>
     </tr>
       <tr>
         <td style="text-align:center;">
             <span style="font-size: 11;"><strong>ARTICLES OF AMENDMENT (Form 5)</strong></span>           
        </td>        
        </tr>
    
   
</table>
<br><br><br>

<table style="padding-top: 10px; font-size: 12;" width="100%">

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
   
    <tr>
      <td width="5%">     
        2. 
      </td>
      <td width="95%"><strong>Name of Company: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00632_0'])){ echo $fieldValues['UK-FCL-00632_0'];}?>        
      </td>
    </tr>

    
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
	  
		<td width="95%"><strong>Property or undertaking charged: </strong><br>
			
				<strong>Details of property or undertaking charged:</strong><br><br><?php  if(isset($fieldValues['UK-FCL-00678_0'])){ echo $fieldValues['UK-FCL-00678_0'];}?> <br><br>
				
				<strong>Volume and page number of the charge:</strong><br><br><?php  if(isset($fieldValues['UK-FCL-00679_0'])){ echo $fieldValues['UK-FCL-00679_0'];}?> 
		</td>
    </tr>
	
	<tr>
      <td width="5%">     
        5. 
      </td>
      <td width="95%"><strong>Particulars of Satisfaction: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00586_0'])){ echo $fieldValues['UK-FCL-00586_0'];}?>        
      </td>
    </tr>
    
  </table>

  <style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>
<br><br>

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
      
</table>
    