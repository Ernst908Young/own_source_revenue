

<table style="padding-top: 10px;">
   <tr>
      <td style="text-align:center;">     
         <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span><br>
         <span style="font-size: 11;">(Sections 362)</span>   <br><br>
         <span style="font-size: 14;"><strong>ARTICLES OF REVIVAL</strong></span>   <br>
          
      </td>
   </tr>
</table>
<br><br><br>
<table style="padding-top: 10px; font-size: 12;" width="100%">
  <tr>
    <td width="5%">     
      1. 
    </td>
    <td width="95%"><strong>Name of Dissolved Company: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00539_0'])){ echo $fieldValues['UK-FCL-00539_0'];}?>        
    </td>
  </tr>
</table>
<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
         2. 
      </td>
      <td width="95%"><strong>Company Number: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00403_0'])){ echo $fieldValues['UK-FCL-00403_0'];}?>      </td>
    </tr>
    <tr>
      <td width="5%">     
         3. 
      </td>
      <td width="95%"><strong>SRN of Form 33 filed for reserving name of the Company being revived: </strong><br><br><span style="text-align: justify;"><?php  if(isset($fieldValues['UK-FCL-00645_0'])){ echo $fieldValues['UK-FCL-00645_0'];}?>   </span>  
      </td>
    </tr>
    <tr>
      <td width="5%">     
         4. 
      </td>
      <td width="95%"><strong>Name reserved vide Form 33: </strong><br><br><span style="text-align: justify;"><?php  if(isset($fieldValues['UK-FCL-00646_0'])){ echo $fieldValues['UK-FCL-00646_0'];}?>   </span>  
      </td>
    </tr>
    <tr>
      <td width="5%">     
         5. 
      </td>
      <td width="95%"><strong>Reason for Dissolution: </strong><br><br><span style="text-align: justify;"><?php  if(isset($fieldValues['UK-FCL-00521_0'])){ echo $fieldValues['UK-FCL-00521_0'];}?>   </span>  
      </td>
    </tr>
    <tr>
      <td width="5%">     
         6. 
      </td>
      <td width="95%"><strong>Interest of applicant in revival of Company: </strong><br><br><span style="text-align: justify;"><?php  if(isset($fieldValues['UK-FCL-00540_0'])){ echo $fieldValues['UK-FCL-00540_0'];}?>   </span>  
      </td>
    </tr>
    <?php
            if(isset($fieldValues['UK-FCL-00002_0']) && is_array($fieldValues['UK-FCL-00002_0'])){
            
               foreach ($fieldValues['UK-FCL-00002_0'] as $newkey => $authorisedDetails) {
                 '
                  <tr>
                    <td width="5%">
                    7.            
                    </td>
                    <td width="95%"><strong>Name of applicant:</strong>
                      <span style="text-align: justify;">  '.@$fieldValues['UK-FCL-00002_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00003_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00004_0'][$newkey]  .'             
                      </span>
                    </td>
                  </tr>               
                  <tr>
                    <td width="5%"> 
                    8.           
                    </td>
                    <td width="95%"><strong>Address of applicant:</strong>
                      <span style="text-align: justify;">'; 
                                                 
                        @$fieldValues['UK-FCL-00011_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00327_0'][$newkey] . '  ' . @$fieldValues['UK-FCL-00010_0'][$newkey]  .' ' . strtoupper(@$fieldValues['UK-FCL-00523_0'][$newkey])  .' ' . strtoupper(@$fieldValues['UK-FCL-00007_0'][$newkey])  .'  ' . @$fieldValues['UK-FCL-00328_0'][$newkey];
                         
                       
                     '
                      </span>     
                    </td>
                  </tr>                   
                 ';
               }
            }
    ?> 
  

</table>


<style type="text/css">
   .latabv {
   border: 1px solid black;
   }
</style>
<br><br>
