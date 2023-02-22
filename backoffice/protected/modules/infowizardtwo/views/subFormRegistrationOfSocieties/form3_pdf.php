<table>
    <tr>
    <td style="text-align:center;">     
        <span style="font-size: 13;">SOCIETIES WITH RESTRICTED LIABILITY ACT OF BARBADOS</span><br>
        <span style="font-size: 11;">(Section 23(1) and (2))</span>   <br><br>
        <span style="font-size: 14;"><strong>NOTICE OF ADDRESS (Form 3)</strong></span>   <br>
        <span style="font-size: 14;"><strong>OR</strong></span>   <br>
        <span style="font-size: 14;"><strong>NOTICE OF CHANGE OF ADDRESS OF REGISTERED OFFICE</strong></span>  
    </td>
     </tr>
</table>
<br><br>
<table style="" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>Name of Society :</strong> <br><span><?php  if(isset($fieldValues['UK-FCL-00197_0'])){ echo $fieldValues['UK-FCL-00197_0'];}?></span>
      </td>
    </tr><br>
   <!--  <tr>
      <td width="5%">     
        2. 
      </td>
      <td width="95%"><strong>Society Number :</strong> <br><span><?php  if(isset($fieldValues['UK-FCL-00360_0'])){ echo $fieldValues['UK-FCL-00360_0'];}?></span>
      </td>
    </tr><br> -->
    <tr>
      <td width="5%"> 
      2.        
      </td>
      <td width="95%"><strong>Mailing Address:</strong><br><span><?php
          if($fieldValues['UK-FCL-00103_0']=='Yes'){ 

 if(isset($fieldValues['UK-FCL-00404_0'])){
    if($fieldValues['UK-FCL-00404_0']!=''){
       $asparish1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00404_0'])->queryRow(); 
     }else{
       $asparish1 = [];
     }
         
        }else{
          $asparish1 = [];
        }

        if(isset($fieldValues['UK-FCL-00094_0'])){
      if($fieldValues['UK-FCL-00094_0']){
         $prases1 = Yii::app()->db->createCommand("SELECT * from bo_postalcode_in_barbados where id=".$fieldValues['UK-FCL-00094_0'])->queryRow(); 
       $pc1 = $prases1['code'];
     }else{
        $pc1 = "";
     }
      
      }else{
        $pc1 = "";
      }
      
      }else{
        
         if(isset($fieldValues['UK-FCL-00228_0'])){
          if($fieldValues['UK-FCL-00228_0']!=''){
            $asparish1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00228_0'])->queryRow(); 
          }else{
            $asparish1 = [];
          }
          
        }else{
          $asparish1 = [];
        }

        if(isset($fieldValues['UK-FCL-00338_0'])){
              if($fieldValues['UK-FCL-00338_0']){
                 $prases1 = Yii::app()->db->createCommand("SELECT * from bo_postalcode_in_barbados where id=".$fieldValues['UK-FCL-00338_0'])->queryRow(); 
               $pc1 = $prases1['code'];
             }else{
                $pc1 = "";
             }
              
              }else{
                $pc1 = "";
              }
      }

        echo @$fieldValues['UK-FCL-00104_0'].' '.@$fieldValues['UK-FCL-00335_0'].' '.@$fieldValues['UK-FCL-00336_0'].' '.@$asparish1['lr_name'].' '.@$fieldValues['UK-FCL-00351_0'].' '. @$pc1; ?></span>
      </td>
    </tr><br>
    <!-- <tr>
      <td width="5%"> 
      3.       
      </td>
      <td width="95%"><strong>If change of address, give previous address of Registered Office: </strong><br>
      </td>
    </tr><br> -->
</table>

<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>
 <br> <br>
<table>
  <tr>
    <td width="5%"></td>
    <td width="95%">
      <table style="border-collapse: collapse; ">
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
