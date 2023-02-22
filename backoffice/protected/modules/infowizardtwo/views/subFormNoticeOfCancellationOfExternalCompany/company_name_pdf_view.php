
<table style="padding-top: 10px;">
	
    <tr>

      <td style="text-align:center;">     
        <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span>
    </td>
     </tr>
       <tr>
        <td style="text-align:center;">
             <span style="font-size: 13;">(Section 338)</span>       
        </td>
     </tr>
       <tr>
         <td style="text-align:center;">
             <span style="font-size: 11;"><strong>NOTICE OF CANCELLATION</strong></span><br> 
             <span style="font-size: 11;"><strong>OF</strong></span><br>
             <span style="font-size: 11;"><strong>EXTERNAL COMPANY</strong></span> 
                     
        </td>  
        </tr>
    
   
</table>
<br><br><br>

<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>Name of Company</strong><br><br><?php  if(isset($fieldValues['UK-FCL-00089_0'])){ echo $fieldValues['UK-FCL-00089_0'];}?>        
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
      <td width="95%"><strong>Address of Registered Office</strong><br><br><span style="text-align: justify;"><?= @$fieldValues['UK-FCL-00340_0'] . ' ' . @$fieldValues['UK-FCL-00341_0'] . '  ' . @$fieldValues['UK-FCL-00344_0']. '  ' . strtoupper(@$fieldValues['UK-FCL-00385_0']) . '  ' .strtoupper(@$fieldValues['UK-FCL-00347_0']). ' ' . @$fieldValues['UK-FCL-00346_0']?></span>             
      </td>     
    </tr>  
    <tr>
      <td width="5%">     
        4. 
      </td>
      <td width="95%"><strong>Address of Principal Office in Barbados (if any):</strong><br><br><span style="text-align: justify;"><?= @$fieldValues['UK-FCL-00570_0'] . ' ' . @$fieldValues['UK-FCL-00571_0'] . ' ' . @$fieldValues['UK-FCL-00572_0']. ' ' .strtoupper(@$fieldValues['UK-FCL-00573_0']) . '  ' . strtoupper(@$fieldValues['UK-FCL-00575_0']).' ' . @$fieldValues['UK-FCL-00574_0']?></span>             
      </td>     
    </tr>
     <tr>
      <td width="5%">     
        5. 
      </td>
      <td width="95%"><strong>Details of Cessation of Undertaking in Barbados:</strong><br><br><span style="text-align: justify;"><?php  if(isset($fieldValues['UK-FCL-00623_0'])){ echo $fieldValues['UK-FCL-00623_0'];}?> </span>             
      </td>     
    </tr>  
  </table>

  <style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>
<br><br><br>
<?php if($app_status=='A'){ 
  echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>

 <br><br><br>
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
    