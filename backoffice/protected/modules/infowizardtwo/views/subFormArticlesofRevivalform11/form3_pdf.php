<table style="padding-top: 10px;">
    <tr>
    <td style="text-align:center;">     
        <span style="font-size: 13;">SOCIETIES WITH RESTRICTED LIABILITY ACT OF BARBADOS</span><br>
        <span style="font-size: 11;">(Section 23(1) and (2))</span>   <br><br>
        <span style="font-size: 14;"><strong>NOTICE OF ADDRESS</strong></span>   <br>
        <span style="font-size: 14;"><strong>OR</strong></span>   <br>
        <span style="font-size: 14;"><strong>NOTICE OF CHANGE OF ADDRESS OF REGISTERED OFFICE (Form 3)</strong></span>  
    </td>
     </tr>
</table>
<br><br><br>
<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>Name of Society :</strong> <br><br><span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00520_0'])){ echo $fieldValues['UK-FCL-00520_0'];}?></span>
      </td>
    </tr>
    <tr>
      <td width="5%">     
        2. 
      </td>
      <td width="95%"><strong>Society Number :</strong> <br><br><span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00290_0'])){ echo $fieldValues['UK-FCL-00290_0'];}?></span>
      </td>
    </tr>
    <tr>
      <td width="5%"> 
      3.        
      </td>
      <td width="95%"><strong>Address of Registered Office:</strong><br><br><span  style="margin-top:10px;"><?php 

       if(isset( $fieldValues['UK-FCL-00345_0'])){
        if($fieldValues['UK-FCL-00345_0']){
          $parish1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00345_0'])->queryRow(); 
        }else{
          $parish1 = [];
        }
        }else{
           $parish1 = [];
        }

          
    



      echo @$fieldValues['UK-FCL-00340_0'].' '.@$fieldValues['UK-FCL-00341_0'].' '.@$parish1['lr_name'].' '.@$fieldValues['UK-FCL-00347_0'].' '. strtoupper(@$fieldValues['UK-FCL-00346_0']); ?></span>
      </td>
    </tr>
    <tr>
      <td width="5%"> 
      4.        
      </td>
      <td width="95%"><strong>Mailing Address:</strong><br><br><span  style="margin-top:10px;"><?php 
 if(isset($fieldValues['UK-FCL-00351_0'])){
  if($fieldValues['UK-FCL-00351_0']){
    $ac = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00351_0'])->queryRow(); 
        }else{
          $ac = [];
        }
  }else{
    $ac = [];
  }
          

         if(isset($fieldValues['UK-FCL-00349_0'])){
          if($fieldValues['UK-FCL-00349_0']){
            $as = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00349_0'])->queryRow(); 
            }else{
              $as = [];
            }
          }else{
            $as = [];
          }
          
 echo @$fieldValues['UK-FCL-00342_0'].' '.@$fieldValues['UK-FCL-00343_0'].'  '.@$as['lr_name'].' '.@$ac['lr_name'].' '.@$fieldValues['UK-FCL-00350_0'];

      ?></span>
      </td>
    </tr>
	
	<!--
    <tr>
      <td width="5%"> 
      5.       
      </td>
      <td width="95%"><strong>If change of address, give previous address of Registered Office: </strong><br><br><span  style="margin-top:10px;"><?php 

       if(isset($fieldValues['UK-FCL-00531_0'])){
         if($fieldValues['UK-FCL-00531_0']){
           $parish1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00531_0'])->queryRow(); 
        }else{
          $parish1 = [];
        }
         }else{
           $parish1 = [];
         }
         
    



      echo @$fieldValues['UK-FCL-00528_0'].' '.@$fieldValues['UK-FCL-00529_0'].'  '.@$parish1['lr_name'].' '.@$fieldValues['UK-FCL-00530_0'].' '. @$fieldValues['UK-FCL-00532_0']; ?></span>     
      </td>
    </tr> -->
	
	
</table>

<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>
<br><br>

<!--table style=" font-size: 12; border-collapse: collapse; ">
      <tr>
         <td style="text-align:center;">
            <span style="font-size: 14;"><strong> SIGNATORY DETAILS</strong></span>           
         </td>
      </tr>
     <br>
       <tr>
         <td>
      <table style="padding-top: 1px; font-size: 12; border: 1px solid black; border-collapse: collapse; padding: 5px;">
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
</table-->