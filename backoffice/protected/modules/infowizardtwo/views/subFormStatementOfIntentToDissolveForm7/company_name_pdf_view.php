	
<table style="padding-top: 10px;">
	
    <tr>

      <td style="text-align:center;">     
        <span style="font-size: 13;">SOCIETIES WITH RESTRICTED LIABILITY ACT OF BARBADOS</span>
    </td>
     </tr>
       <tr>
        <td style="text-align:center;">
             <span style="font-size: 13;">(Section 7)</span>       
        </td>
     </tr>
       <tr>
         <td style="text-align:center;">
             <span style="font-size: 11;"><strong>STATEMENT OF INTENT TO DISSOLVE</strong></span> 
                     
        </td>  
        </tr>
    
   
</table>
<br><br><br>

<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>Name of Society</strong><br><br><?php  if(isset($fieldValues['UK-FCL-00197_0'])){ echo $fieldValues['UK-FCL-00197_0'];}?>        
      </td>
    </tr>

    <table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
        2. 
      </td>
      <td width="95%"><strong>Society Number </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00290_0'])){ echo $fieldValues['UK-FCL-00290_0'];}?>        
      </td>
    </tr>
    <tr>
      <td width="5%">     
        3. 
      </td>
      <td width="95%"><strong>The Society intends to liquidate and dissolve. </strong>
        <span style="text-align: justify;">
        <?php   if($fieldValues['UK-FCL-00618_0']=='Intends to liquidate and dissolve') { ?><br><b>Other Intent (If any): </b><?php if(isset($fieldValues['UK-FCL-00617_0'])){ echo $fieldValues['UK-FCL-00617_0']; } ?><?php } ?>

        <?php   if($fieldValues['UK-FCL-00618_0']=='Revokes its intent to dissolve') { ?><br><b>SRN of Form 7 filed for Statement of Intent to dissolve : </b><?php if(isset($fieldValues['UK-FCL-00619_0'])){ echo $fieldValues['UK-FCL-00619_0']; } ?><br><b>Name of the Society : </b><?php if(isset($fieldValues['UK-FCL-00193_0'])){ echo $fieldValues['UK-FCL-00193_0']; } ?>
         <?php } ?>  </span>     
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
            <span style="font-size: 14;"><strong> SIGNATORY DETAILS</strong></span>           
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
    