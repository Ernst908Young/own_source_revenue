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
         <span style="font-size: 13;">(Sections 412 (5))</span>       
      </td>
   </tr>
   <tr>
      <td style="text-align:center;">
         <span style="font-size: 11;"><strong>APPLICATION TO RESTORE NAME TO THE REGISTER</strong></span>           
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
         2. 
      </td>
      <td width="92%"><strong>Date company struck off the register: </strong><span style="text-align: justify;"><?php echo @$fieldValues['UK-FCL-00582_0']?> </span>     
      </td>
   </tr>
   <tr>
      <td width="8%">     
         3.
      </td>
      <td width="92%"><strong>Full address of registered office if incorporated under the laws of Barbados:</strong> <?= @$fieldValues['UK-FCL-00340_0'] . ' ' . @$fieldValues['UK-FCL-00341_0'] . ' ' . @$fieldValues['UK-FCL-00344_0']. ' ' . InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00345_0']) . ' ' . @$fieldValues['UK-FCL-00347_0'].' ' . @$fieldValues['UK-FCL-00346_0']?>   
      </td>
   </tr>
   <tr>
      <td width="8%">     
         4. 
      </td>
      <td width="92%"><strong>Full address of registered or principal office if incorporated other than under the laws of Barbados:</strong> <?= @$fieldValues['UK-FCL-00570_0'] . ' ' . @$fieldValues['UK-FCL-00571_0'] . '  ' . @$fieldValues['UK-FCL-00572_0']. '  ' . InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00584_0']) . ' ' .InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00575_0']). ' ' . @$fieldValues['UK-FCL-00574_0']?>   
      </td>
   </tr>
   
	<tr>
		<td width="8%">    
		5.
		</td>
		<td width="92%"><strong>The directors of the company are:</strong><br><br>
			<?php if(isset($fieldValues['UK-FCL-00132_0'])){ ?>
			
			<table style="padding: 5px;">
				<?php  
				foreach ($fieldValues['UK-FCL-00132_0'] as $newkey => $authorisedDetails) { ?>
                  
		   

				<tr nobr="true">
					<th class="latabv" ><strong>Full Name</strong></th>
					<td class="latabv"><?php echo  @$fieldValues['UK-FCL-00132_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00105_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00106_0'][$newkey] ?> </td>
				</tr>
				
				<tr nobr="true">
				   <th class="latabv"><strong>Address</strong></th>
				  <td class="latabv"> 
            <?php 
			if($show_main==true){
               echo  @$fieldValues['UK-FCL-00093_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00238_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00310_0'][$newkey]  .' ' . @$fieldValues['UK-FCL-00129_0'][$newkey]  .' ' . strtoupper(@$fieldValues['UK-FCL-00096_0'][$newkey])  .'  ' . strtoupper(@$fieldValues['UK-FCL-00094_0'][$newkey]);
			}else{
				 echo "Not available publicly";
			}
              
                ?> </td>
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Occupation</strong></th>
				<td class="latabv"> <?php echo @$fieldValues['UK-FCL-00137_0'][$newkey] ?></td>
				
				</tr>
				
				
				
			 
				<?php } ?>

			</table>
			<?php } ?>
		</td>
	</tr>


   
</table>
<br><br><br>

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

