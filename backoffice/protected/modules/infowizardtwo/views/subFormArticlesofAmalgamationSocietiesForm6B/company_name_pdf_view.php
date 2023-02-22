<table style="padding-top: 10px;">
    <tr>
        <td style="text-align:center;">     
            <span style="font-size: 13;">CSOCIETIES WITH RESTRICTED LIABILITY ACT OF BARBADOS</span><br>
            <span style="font-size: 11;">Cap. 318B</span>   <br>
            <span style="font-size: 11;">(Section 29F)</span><br>
            <span style="font-size: 14;"><strong>ARTICLES OF AMALGAMATION</strong></span><br>
        </td>
    </tr>
</table>
<br><br><br>
<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
        <td width="7%">     
         1. 
        </td>
        <td width="93%"><strong>Name of Society: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00520_0'])){ echo $fieldValues['UK-FCL-00520_0'];}?>        
        </td>
    </tr>
</table>
<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
        <td width="7%">
         2. 
        </td>
        <td width="93%"><strong>Society Number: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00290_0'])){ echo $fieldValues['UK-FCL-00290_0'];}?>      </td>
    </tr>
   <tr>
      <td width="7%">     
         3.
      </td>
      <td width="93%"><strong>The purpose for which the Society is formed </strong><br><br><span style="text-align: justify;"><?php  if(isset($fieldValues['UK-FCL-00199_0'])){ echo $fieldValues['UK-FCL-00199_0'];}?>   </span>  
      </td>
   </tr>
   <tr>
      <td width="7%">     
         4. 
      </td>
      <td width="93%"><strong>The duration of the Society </strong><br><br><span style="text-align: justify;"><?php  if(isset($fieldValues['UK-FCL-00200_0'])){ echo $fieldValues['UK-FCL-00200_0'];}?>   </span>  
      </td>
   </tr>
   <tr>
      <td width="7%">     
         5. 
      </td>
      <td width="93%"><strong>The registered office of the Society in Barbados</strong><br><?= @$fieldValues['UK-FCL-00104_0'] . ' ' . @$fieldValues['UK-FCL-00238_0'] . ' ' .@$fieldValues['UK-FCL-00382_0']. ' ' .InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00337_0']). ' ' . @$fieldValues['UK-FCL-00357_0'].' ' . @$fieldValues['UK-FCL-00242_0']?> 
      </td>
   </tr>
   <tr>
      <td width="7%">     
         6. 
      </td>
      <td width="93%"><strong>The name and address of the Society’s agent in Barbados</strong><br><br><?= @$fieldValues['UK-FCL-00301_0'] . ' ' . @$fieldValues['UK-FCL-00466_0'] . ' ' .@$fieldValues['UK-FCL-00317_0']. ' ' .@$fieldValues['UK-FCL-00468_0']. ' ' . @$fieldValues['UK-FCL-00469_0']. ' ' . @$fieldValues['UK-FCL-00459_0']. ' ' .InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00406_0']). ' ' . @$fieldValues['UK-FCL-00453_0'].' ' . @$fieldValues['UK-FCL-00473_0']?>    
      </td>
   </tr>
   <tr>
      <td width="7%">     
         7. 
      </td>
      <td width="93%"><strong>The classes and any maximum number of quotas that the Society is authorised to issue </strong><br><br><span style="text-align: justify;"><?php  if(isset($fieldValues['UK-FCL-00299_0'])){ echo $fieldValues['UK-FCL-00299_0'];}?> </span>  
      </td>
   </tr>
   <br>
   <tr>
      <td width="7%">     
         8. 
      </td>
      <td width="93%"><strong>Restrictions if any on quota transfers </strong><br><br><span style="text-align: justify;"><?php  if(isset($fieldValues['UK-FCL-00515_0'])){ echo $fieldValues['UK-FCL-00515_0'];}?> </span>  
      </td>
   </tr>
   <tr>
      <td width="7%">     
         9. 
      </td>
      <td width="93%"><strong>Restrictions if any on business the Society may carry on </strong><br><br><span style="text-align: justify;"><?php  if(isset($fieldValues['UK-FCL-00232_0'])){ echo $fieldValues['UK-FCL-00232_0'];}?> </span>  
      </td>
   </tr><br><br>
   <tr>
      <td width="7%">     
         10. 
      </td>
      <td width="93%"><strong>Other provisions if any </strong><br><br><span style="text-align: justify;"><?php  if(isset($fieldValues['UK-FCL-00233_0'])){ echo $fieldValues['UK-FCL-00233_0'];}?> </span>  
      </td>
   </tr><br>
   <tr>
      <td width="7%">     
         11. 
      </td>
      <td width="93%">
         <table style="padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse; padding: 5px;">
            <tr>
               <th class="latabv"><strong>Name of Amalgamating Societies</strong></th>
               <th class="latabv"><strong>Society Number </strong></th>
               <th class="latabv"><strong>Type of Society H- Holding S- Subsidiary </strong></th>
            </tr>
            <?php        
               if(isset($fieldValues['UK-FCL-00606_0']) && is_array($fieldValues['UK-FCL-00606_0'])){
               foreach ($fieldValues['UK-FCL-00606_0'] as $newkey => $authorisedDetails) {
                 
                    echo '<tr>
                            <td class="latabv">'.@$fieldValues['UK-FCL-00606_0'][$newkey] .'</td>
                            <td class="latabv">'.@$fieldValues['UK-FCL-00607_0'][$newkey].'</td>
                            <td class="latabv">'.@$fieldValues['UK-FCL-00608_0'][$newkey].'</td>
                          
                            
                        </tr>';
                  }
                }
                ?>         
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