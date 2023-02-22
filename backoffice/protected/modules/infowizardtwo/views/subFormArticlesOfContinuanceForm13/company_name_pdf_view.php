<table style="padding-top: 10px;">
    <tr>
      <td style="text-align:center;">     
        <span style="font-size: 13;">SOCIETIES WITH RESTRICTED LIABILITY ACT OF BARBADOS</span><br>
        <span style="font-size: 11;">(Section 52)</span>   <br>
        <span style="font-size: 14;"><strong>ARTICLES OF CONTINUANCE</strong></span>   <br>  
    </td>
     </tr>
</table>
<table style="padding-top: 5px; font-size: 12;" width="100%">
    <tr>
      <td width="6%">     
       1.
      </td>
      <td  width="94%"><strong>Name of Society:</strong> <br><br><span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00197_0'])){ echo $fieldValues['UK-FCL-00197_0'];}?></span>
      </td>
    </tr>
     <tr>
      <td width="6%">        
      </td>
      <td width="94%"><strong>Society Number:</strong><br><br><span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00360_0'])){ echo $fieldValues['UK-FCL-00360_0'];}?></span>
      </td>
    </tr>
  <tr>
    <td width="6%">     
     2.
    </td>
    <td  width="94%"><strong>The purpose for which the Society was formed:</strong> <br><br><span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00199_0'])){ echo $fieldValues['UK-FCL-00199_0'];}?></span>
    </td>
  </tr>
  <tr>
    <td width="6%"> 
        3.
    </td>
      <td width="94%"><strong>The duration of the Society (shall not exceed 50 years):</strong><br><br><span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00513_0'])){ echo $fieldValues['UK-FCL-00513_0'];}?></span>
      </td>
  </tr>
        <?php
            if(isset($fieldValues['UK-FCL-00368_0']) && is_array($fieldValues['UK-FCL-00368_0'])){
            
               foreach ($fieldValues['UK-FCL-00368_0'] as $newkey => $authorisedDetails) {
                 echo '
                  <tr>
                    <td width="6%">
                    4.            
                    </td>
                    <td width="94%"><strong>The classes and any maximum number of quotas that the Society is authorized to issue</strong>
                      <span style="text-align: justify;"> '.@$fieldValues['UK-FCL-00368_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00368_0'][$newkey] . '          
                      </span>
                    </td>
                  </tr>               
                                  
                 ';
               }
            }
    ?> 
  <tr>
    <td width="6%">
   5.   
    </td>
    <td width="94%"><strong>Restriction on transfer of quotas:</strong><br><br><span  width="100%" style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00230_0'])){ echo $fieldValues['UK-FCL-00230_0'];}?></span>
    </td>
    </tr>
    <tr>
    <td width="6%">
   6.   
    </td>
    <td width="94%"><strong>Restriction, if any, on business the Society may carry on:</strong><br><br><span  width="100%" style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00232_0'])){ echo $fieldValues['UK-FCL-00232_0'];}?></span>
    </td>
    </tr>
  <tr>
    <td width="6%">
   7.   
    </td>
    <td width="94%"><strong>If change of name affected, previous name:</strong><br><br><span  width="100%" style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00505_0'])){ echo $fieldValues['UK-FCL-00505_0'];}?></span>
    </td>
    </tr>
  <tr>
    <td width="6%">
   8.   
    </td>
    <td width="94%"><strong>Jurisdiction in which society is organised and date of organisation:</strong><br><br><span  width="100%" style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00548_0'])){ echo $fieldValues['UK-FCL-00548_0'];}?></span>
    </td>
    </tr>
  <tr>
    <td width="6%">
   9.   
    </td>
    <td width="94%"><strong>Name of overseas Society:</strong><br><br><span  width="100%" style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00518_0'])){ echo $fieldValues['UK-FCL-00518_0'];}?></span>
    </td>
    </tr>
    <tr>
    <td width="6%">
   10.   
    </td>
    <td width="94%"><strong>Other provisions required for articles of organisation under the Act:</strong><br><br><span  width="100%" style="margin-top:10px;"><?php echo implode(", ",$fieldValues['UK-FCL-00519_0']); ?>
    </span>
    </td>
    </tr>



</table>