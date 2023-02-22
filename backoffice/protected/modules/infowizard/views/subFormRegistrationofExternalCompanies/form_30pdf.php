<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>
<table style="padding-top: 10px;">
    <tr>
    <td style="text-align:center;">     
        <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span><br>  
        <span style="font-size: 12;">(Section 332)</span><br>   
          
         <span style="font-size: 14;"><strong>POWER OF ATTORNEY</strong></span>   <br><br>
     
    </td>
     </tr>
</table>


<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%"> 
      </td>
      <td width="95%"><strong>Know all men by these presents that </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00211_0'])){ echo $fieldValues['UK-FCL-00211_0'];}?> 
        <?php 
          $country1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00347_0'])->queryRow(); 

       $state = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00385_0'])->queryRow(); 

      echo @$fieldValues['UK-FCL-00340_0'].' '.@$fieldValues['UK-FCL-00341_0'].' '.@$fieldValues['UK-FCL-00344_0'].' '.@$fieldValues['UK-FCL-00346_0'].' '. @$state['lr_name'].' '.@$country1['lr_name'] ; 
        ?>

       
        <br><small>(Name and address of external company)</small><br>hereinafter called the "Company"
      </td>
    </tr>
     <tr>
      <td width="5%">     
        
      </td>
      <td width="95%"><strong>hereby appoints</strong><br><br><?php echo @$fieldValues['UK-FCL-00150_0'].' '.@$fieldValues['UK-FCL-00105_0'].' '.@$fieldValues['UK-FCL-00106_0'].' ';       

             $country1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00402_0'])->queryRow(); 

           $state = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00400_0'])->queryRow(); 

          echo @$fieldValues['UK-FCL-00107_0'].' '.@$fieldValues['UK-FCL-00335_0'].' '.@$fieldValues['UK-FCL-00399_0'].' '.@$fieldValues['UK-FCL-00401_0'].' '. @$state['lr_name'].' '.@$country1['lr_name'] ;       
        ?>
        <br><small>(Name and address of Attorney)</small>
        <br><br>its true and lawful attorney, to act as such, and as such to sue and be sued, plead and be impleaded in any Court in Barbados, and generally on behalf of the Company within Barbados to accept service of process and to receive all lawful notices and, for the purposes of the Company to do all the acts and to execute all deeds and other instruments relating to the matters within the scope of this power of attorney. It is hereby declared that service of process in respect of suits and proceedings by or against the Company and of lawful notices on the attorney will be binding on the Company for all purposes. Where more than one person is hereby appointed attorney, any one of them, without the others, may act as true and lawful Attorney of the Company.This appointment revokes all previous appointments in so far as such appointment relates to the scope of the powers prescribed by this power.
      </td>
    </tr> 
    <tr>
      <td width="5%">     
        
      </td>
      <td width="95%"><strong>This appointment revokes all previous appointments in so far as such appointment related  to the scope of the powers predcribed by the power.</strong></td>
    </tr>
    <tr>
      <td width="5%"></td>
      <td width="95%"><table  style="padding-top: 10px; font-size: 12; " width="100%">
          <tr>
            <td>Date :</td>
            <td>Electronically signed</td>
            <td>Title:</td>
          </tr>
        </table></td>
    </tr>
     <tr>
      <td width="5%">     
        
      </td>
      <td width="95%">Consent to act as Attorney:</td>
    </tr>
    
  </table>