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
        <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span>
    </td>
     </tr>
       <tr>
        <td style="text-align:center;">
             <span style="font-size: 13;">(Sections 363 to 370)</span>       
        </td>
     </tr>
       <tr>
         <td style="text-align:center;">
             <span style="font-size: 11;"><strong>ARTICLES OF DISSOLUTION</strong></span> <br>  
                 
        </td>  
        </tr>
    
   
</table>
<br><br><br>

<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>Name of Company </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00089_0'])){ echo $fieldValues['UK-FCL-00089_0'];}?>        
      </td>
    </tr>

    <table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
        2. 
      </td>
      <td width="95%"><strong>Company Number </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00403_0'])){ echo $fieldValues['UK-FCL-00403_0'];}?>        
      </td>
    </tr>
    <tr>
      <td width="5%">     
        3. 
      </td>
      <td width="95%"><strong>The Company </strong><br><span style="text-align: justify;"><?php  if(isset($fieldValues['UK-FCL-00613_0'])){ echo $fieldValues['UK-FCL-00613_0'];}?> 
         </span>     
      </td>
     
    </tr>

	<tr>
		<td width="5%">    
		4.
		</td>
		<td width="95%"><strong>Documents and records of the company shall be kept for 6 years following the date of dissolution by:</strong><br><br>
			
			<table style="padding: 5px;">
				
				<tr nobr="true">
					<th class="latabv" ><strong>Full Name</strong></th>
					<td class="latabv"><?php echo  @$fieldValues['UK-FCL-00132_0'] . ' ' . @$fieldValues['UK-FCL-00105_0'] . ' ' . @$fieldValues['UK-FCL-00106_0'] ?> </td>
				</tr>
				
				<tr nobr="true">
				   <th class="latabv"><strong>Address</strong></th>
				  <td class="latabv"> <?php 
					if($show_main==true){
	
						echo @$fieldValues['UK-FCL-00093_0'] . ' ' . @$fieldValues['UK-FCL-00238_0'] . ' ' .strtoupper(InfowizardQuestionMasterExt::getCountryStateNameByID( @$fieldValues['UK-FCL-00129_0'])). ' ' . strtoupper(@$fieldValues['UK-FCL-00096_0']).' ' . @$fieldValues['UK-FCL-00094_0'];
					}else{
						 echo "Not available publicly";
					}
					
					?> </td>
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Occupation</strong></th>
				<td class="latabv"> <?php echo @$fieldValues['UK-FCL-00137_0'] ?></td>
				
				</tr>
				
				

			</table>
			
		</td>
	</tr>
	
	
	
   
   
   
  
  </table>

  <style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>
<br><br><br><br>

<?php if($app_status=='A'){ 
  echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>

 <br><br><br><br>
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
    