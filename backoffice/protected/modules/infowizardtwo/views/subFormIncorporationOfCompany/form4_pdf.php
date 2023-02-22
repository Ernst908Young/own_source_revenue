<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>

<table style="padding-top: 10px;">
    <tr>
    <td style="text-align:center;">     
        <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span><br>
        <span style="font-size: 11;">(Section 169(1) and (2))</span>   <br><br>
        <span style="font-size: 14;"><strong>NOTICE OF ADDRESS</strong></span>   <br>
        <span style="font-size: 14;"><strong>OR</strong></span>   <br>
        <span style="font-size: 14;"><strong>NOTICE OF CHANGE OF ADDRESS OF REGISTERED OFFICE</strong></span>  
    </td>
    </tr>
</table>
<br><br><br>

<table style="padding-top: 10px; " width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>Name of Company :</strong> <br><br><?php  if(isset($fieldValues['UK-FCL-00089_0'])){ echo $fieldValues['UK-FCL-00089_0'];}?>
      </td>
    </tr>

   <!--  <tr>
      <td width="5%">     
        2. 
      </td>
      <td width="95%"><strong>Company Number :</strong> <br><br><1?php echo $fieldValues['UK-FCL-00088_0']; ?>
      </td>
    </tr> -->

    <tr>
      <td width="5%"> 
      3.        
      </td>
      <td width="95%"><strong>Address of Registered Office.:</strong> <br><br>
        <?php   
       if(isset( $fieldValues['UK-FCL-00345_0'])){
          $parish1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00345_0'])->queryRow(); 
        }else{
          $parish1 = [];
        }
    

if(isset($fieldValues['UK-FCL-00346_0'])){
      if($fieldValues['UK-FCL-00346_0']){
         $prases1 = Yii::app()->db->createCommand("SELECT * from bo_postalcode_in_barbados where id=".$fieldValues['UK-FCL-00346_0'])->queryRow(); 
       $pc1 = $prases1['code'];
     }else{
        $pc1 = "";
     }
      
      }else{
        $pc1 = "";
      }

       

      echo @$fieldValues['UK-FCL-00340_0'].' '.@$fieldValues['UK-FCL-00341_0'].' '.@$fieldValues['UK-FCL-00344_0'].' '.@$parish1['lr_name'].' '.@$fieldValues['UK-FCL-00347_0'].' '. @$pc1 ; 
?>
      
       
        <br>
      </td>
    </tr>

    <tr>
      <td width="5%"> 
      4.        
      </td>
      <td width="95%"><strong>Mailing Address:</strong><br><br>
        <?php 
if(isset($fieldValues['UK-FCL-00493_0'])){
  if($fieldValues['UK-FCL-00493_0']=='Yes'){
      $is_same_regadd = true;
  }else{
     $is_same_regadd = false;
  }
}else{
   $is_same_regadd = true;
}

if($is_same_regadd==false){

        if(isset( $fieldValues['UK-FCL-00351_0'])){
          $country1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00351_0'])->queryRow(); 
        }else{
           $country1 = [];
        }
      
     if(isset($fieldValues['UK-FCL-00349_0'])){
        if($fieldValues['UK-FCL-00349_0']==''){
 $state =[];
        }else{
           $state = Yii::app()->db->createCommand("SELECT lr_id, lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00349_0'])->queryRow(); 
        }
      
     }else{
        $state =[];
     }

     $mpc = @$fieldValues['UK-FCL-00350_0'];
if(@$fieldValues['UK-FCL-00493_0']){
  if($fieldValues['UK-FCL-00493_0']=='Yes'){
    $mpc = $pc1;
  }
}


      echo @$fieldValues['UK-FCL-00342_0'].' '.@$fieldValues['UK-FCL-00343_0'].' '.@$fieldValues['UK-FCL-00348_0'].' '. @$state['lr_name'].' '.@$country1['lr_name'].' '.$mpc ;   
}else{
   echo @$fieldValues['UK-FCL-00340_0'].' '.@$fieldValues['UK-FCL-00341_0'].' '.@$fieldValues['UK-FCL-00344_0'].' '.@$parish1['lr_name'].' '.@$fieldValues['UK-FCL-00347_0'].' '. @$pc1 ; 
}

      ?>        
      </td>
    </tr>

    <!-- <tr>
      <td width="5%"> 
      5.       
      </td>
      <td width="95%"><strong>If change of address, give previous address of Registered Office: </strong><br><br> 
      </td>
    </tr> -->

   

</table>

<br><br>


<table>
  <tr>
    <td width="5%"></td>
    <td width="95%">
        <table>
      <tr>
         <td style="text-align:center;">
            <span><strong> SIGNATORY DETAILS</strong></span>           
         </td>
      </tr>
     <br>
       <tr>
         <td>
      <table style="border-collapse: collapse; padding: 5px;">
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
       <?php        
          if(isset($signatoryDetails) && count($signatoryDetails) > 0){ ?>
      <br>  <br>
      <table>
        <tr>
                <td><b>I declare that:</b><br>- I am the person identified in this submission;<br>- I am authorised by law to sign and submit this form; and<br>- I have read and understood the questions required by this form and my responses/answers herein are true and correct to the best of my knowledge and belief.<br><br>Pursuant to Section 432 of the Companies Act, the submission of any report, return, notice or document that contains an untrue statement of a material fact or omits to state a material fact required is guilty of an offence and an liable on summary conviction to a fine of BDS$20,000.00 or to imprisonment to a term of two years, or to both.</td>
            </tr>
      </table>
    <?php } ?>
    </td>
  </tr>
</table>
    </td>
    </tr>
</table>



