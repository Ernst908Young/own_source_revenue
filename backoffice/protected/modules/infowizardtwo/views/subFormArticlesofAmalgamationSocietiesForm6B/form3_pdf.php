<style type="text/css">
   .latabv {
   border: 1px solid black;
   }
</style>
<table style="padding-top: 10px;">
    <tr>
        <td style="text-align:center;">     
            <span style="font-size: 13;">CSOCIETIES WITH RESTRICTED LIABILITY ACT OF BARBADOS</span><br>
            <span style="font-size: 11;">(Section 23(1) and (2))</span>   <br>
            <span style="font-size: 14;"><strong>NOTICE OF ADDRESS</strong></span><br>
            <span style="font-size: 14;"><strong>OR</strong></span><br>
            <span style="font-size: 14;"><strong>NOTICE OF CHANGE OF ADDRESS OF REGISTERED OFFICE</strong></span><br>
        </td>
    </tr>
</table>
<br><br><br>
<table style="padding-top: 10px; font-size: 12;" width="100%">
  <tr>
    <td width="5%">     
      1. 
    </td>
    <td width="95%"><strong>Name of Company : </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00520_0'])){ echo $fieldValues['UK-FCL-00520_0'];}?>        
    </td>
  </tr>
  <tr>
    <td width="5%">     
      2. 
    </td>
    <td width="95%"><strong>Company Number : </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00290_0'])){ echo $fieldValues['UK-FCL-00290_0'];}?>   
    </td>
  </tr>

  <?php
    if($fieldValues['UK-FCL-00012_0']=='Notice of Address' || $fieldValues['UK-FCL-00012_0']=='Notice of change in registered office address' || $fieldValues['UK-FCL-00012_0']=='Notice of change in registered office address and mailing address'){
      ?>
  
  <tr>
    <td width="5%">     
      3.
    </td>
    <td width="95%"><strong>Address of Registered office :</strong><br> <br><?php
    
            echo @$fieldValues['UK-FCL-00340_0'] . ' ' . @$fieldValues['UK-FCL-00341_0'] . ' ' . InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00345_0']). '  ' . @$fieldValues['UK-FCL-00347_0'].' ' . @$fieldValues['UK-FCL-00346_0']; ?>     
    </td>
  </tr>

  <?php

    }
    if($fieldValues['UK-FCL-00012_0']=='Notice of change in mailing address' || $fieldValues['UK-FCL-00012_0']=='Notice of Address' || $fieldValues['UK-FCL-00012_0']=='Notice of change in registered office address and mailing address'){
      ?>
  
  <tr>
    <td width="5%">     
      4.
    </td>
    <td width="95%"><strong>Mailing Address :</strong><br> <br><?= @$fieldValues['UK-FCL-00342_0'] . ' ' . @$fieldValues['UK-FCL-00343_0'] . ' ' . InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00349_0']) . ' ' . InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00351_0']). '  ' . @$fieldValues['UK-FCL-00350_0']?>   
    </td>
  </tr>
  
  <?php
  }

  if($fieldValues['UK-FCL-00012_0']=='Notice of change in registered office address' || $fieldValues['UK-FCL-00012_0']=='Notice of change in registered office address and mailing address'){
    ?>

  <tr>
    <td width="5%">     
      5.
    </td>
    <td width="95%"><strong>If change of address, give previous address of registered office :</strong><br> <br><?php
    
            echo @$fieldValues['UK-FCL-00528_0'] . ' ' . @$fieldValues['UK-FCL-00529_0'] . ' ' . InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00531_0']). ' ' . @$fieldValues['UK-FCL-00530_0']. ' ' .@$fieldValues['UK-FCL-00532_0']; ?>  
    </td>
  </tr>

      <?php
    }

   ?>
</table>
