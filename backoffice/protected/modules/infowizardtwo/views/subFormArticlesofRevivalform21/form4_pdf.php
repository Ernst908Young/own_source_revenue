<style type="text/css">
   .latabv {
   border: 1px solid black;
   }
</style>
<table style="padding-top: 10px;">
   <tr>
      <td style="text-align:center;">     
         <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span><br>
         <span style="font-size: 11;">(Section 169(1))</span>   <br><br>
         <span style="font-size: 14;"><strong>NOTICE OF ADDRESS (Form 4)</strong></span>   <br>
         
      </td>
   </tr>
</table>
<br><br><br>
<table style="padding-top: 10px; font-size: 12;" width="100%">
  <tr>
    <td width="5%">     
      1. 
    </td>
    <td width="95%"><strong>Name of Company: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00539_0'])){ echo $fieldValues['UK-FCL-00539_0'];}?>        
    </td>
  </tr>
  <tr>
    <td width="5%">     
      2. 
    </td>
    <td width="95%"><strong>Company Number: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00403_0'])){ echo $fieldValues['UK-FCL-00403_0'];}?>   
    </td>
  </tr>
  
  <tr>
    <td width="5%">     
      3.
    </td>
    <td width="95%"><strong>Address of Registered office:</strong><br><?php
      
            echo @$fieldValues['UK-FCL-00340_0'] . ' ' . @$fieldValues['UK-FCL-00341_0'] . ' ' . InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00345_0']). ' ' . @$fieldValues['UK-FCL-00347_0'].' '. @$fieldValues['UK-FCL-00346_0']; ?>     
    </td>
  </tr>

  
  <tr>
    <td width="5%">     
      4.
    </td>
    <td width="95%"><strong>Mailing Address:</strong> <br><?= @$fieldValues['UK-FCL-00342_0'] . ' ' . @$fieldValues['UK-FCL-00343_0'] . ' ' . InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00349_0']) . ' ' . InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00351_0']). '  ' . @$fieldValues['UK-FCL-00350_0']?>   
    </td>
  </tr>
  




</table>