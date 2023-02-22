<?php 
$show_main = true;
if(isset($_GET['is_vpd'])){
  if($_GET['is_vpd']=='yes'){
    $show_main = false;
  }
} ?>
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


<table style="padding-top: 10px;" width="100%">
    <tr>
      <td width="5%"> 
      </td>
      <td width="95%"><strong>Know all men by these presents that </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00211_0'])){ echo $fieldValues['UK-FCL-00211_0'];}?> 
        <?php 
          $country1 =   $state = [];
        if(isset($fieldValues['UK-FCL-00347_0'])){
          $country1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00347_0'])->queryRow();
        }
       
        if(isset($fieldValues['UK-FCL-00385_0'])){
          $state = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00385_0'])->queryRow(); 
        }
       

      echo @$fieldValues['UK-FCL-00340_0'].' '.@$fieldValues['UK-FCL-00341_0'].' '.@$fieldValues['UK-FCL-00344_0'].' '. @$state['lr_name'].' '.@$country1['lr_name'] .' '.@$fieldValues['UK-FCL-00346_0'];    
       ?>

       
        <br><small>(Name and address of external company)</small><br>hereinafter called the "Company"
      </td>
    </tr>
     <tr>
      <td width="5%">     
        
      </td>
      <td width="95%"><strong>hereby appoints</strong><br><br><?php echo @$fieldValues['UK-FCL-00150_0'].' '.@$fieldValues['UK-FCL-00105_0'].' '.@$fieldValues['UK-FCL-00106_0'].' ';       

             if(isset($fieldValues['UK-FCL-00402_0'])){
              $country1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00402_0'])->queryRow(); 
             }

             if (isset($fieldValues['UK-FCL-00400_0'])) {
               $state = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00400_0'])->queryRow(); 
             }
           
if($show_main==true){ 
          echo @$fieldValues['UK-FCL-00107_0'].' '.@$fieldValues['UK-FCL-00335_0'].' '.@$fieldValues['UK-FCL-00399_0'].' '. @$state['lr_name'].' '.@$country1['lr_name'].' '.@$fieldValues['UK-FCL-00401_0']; 
        }else{
          echo 'XXXXX';
        }

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

    <br><br><br>
    <?php if($app_status=='A'){ 
   echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>

<br><br><br>
    <tr>
      <td width="5%"></td>
      <td width="95%"><table style="border-collapse: collapse; ">
      <tr>
         <td style="text-align:center;">
            <span><strong> SIGNATORY DETAILS</strong></span>           
         </td>
      </tr>
     <br>
       <tr>
         <td>
      <table style="padding: 5px;">
         <tr nobr="true">
            <th class="latabv"><strong>Full Name</strong></th>           
            <th class="latabv"><strong>Designation </strong></th>
            <th class="latabv"><strong>Signature </strong></th>
            <th class="latabv"><strong>Date of Signature </strong></th>
         </tr>
         <?php        
          if(isset($signatoryDetails) && count($signatoryDetails) > 0){
            foreach ($signatoryDetails as $key => $signDetails) {
              $signDate=date('d M,Y',strtotime($signDetails['date_of_signing']));
              echo '<tr nobr="true">
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
</td>
    </tr>
     <tr>
      <td width="5%">     
        
      </td>
      <td width="95%">Consent to act as Attorney:</td>
    </tr>
    
  </table>