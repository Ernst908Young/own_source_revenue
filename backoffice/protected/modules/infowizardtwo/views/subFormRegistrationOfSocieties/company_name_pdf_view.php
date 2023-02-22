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
<table>
    <tr>
      <td style="text-align:center;">     
        <span style="font-size: 13;">SOCIETIES WITH RESTRICTED LIABILITY ACT OF BARBADOS</span><br>
        <span style="font-size: 11;">(Section 5)</span>   <br>
        <span style="font-size: 14;"><strong>ARTICLES OF ORGANISATION (Form 1)</strong></span>   <br>  
    </td>
     </tr>
</table>
<br><br><br>

<table width="100%">
    <tr>
      <td width="5%">     
       1.
      </td>
      <td  width="95%"><strong>Name of Society</strong> <br><span><?php  if(isset($fieldValues['UK-FCL-00197_0'])){ echo $fieldValues['UK-FCL-00197_0'];}?></span>
      </td>
    </tr><br>
     <!-- <tr>
      <td width="5%">        
      </td>
      <td width="95%"><strong>Society Number</strong><br><br><span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00360_0'])){ echo $fieldValues['UK-FCL-00360_0'];}?></span>
      </td>
    </tr> -->
    <tr>
      <td width="5%"> 
      2.   
      </td>
      <td width="95%" style="text-align:justify;"><strong>The purpose for which the Society was formed</strong><br><span><?php  if(isset($fieldValues['UK-FCL-00199_0'])){ echo $fieldValues['UK-FCL-00199_0'];}?></span>
      </td>
    </tr>
    <tr><br>
      <td width="5%"> 
      3.
      </td>
      <td width="95%"><strong>The duration of the Society</strong><br><span><?php  if(isset($fieldValues['UK-FCL-00361_0'])){ echo $fieldValues['UK-FCL-00361_0'];}?></span>
      </td>
    </tr><br>
    <tr>
      <td width="5%"> 
     4.
      </td>
      <?php 


         if(isset( $fieldValues['UK-FCL-00405_0'])){
          $parish1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00405_0'])->queryRow(); 
        }else{
          $parish1 = [];
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

      ?>
      <td width="95%"><strong>The registered office of the Society in Barbados</strong><br><span> <?php echo @$fieldValues['UK-FCL-00308_0'] .' '. @$fieldValues['UK-FCL-00309_0'];?> <?php echo @$fieldValues['UK-FCL-00310_0'].' '.@$parish1['lr_name'].' '.@$fieldValues['UK-FCL-00096_0'].' '. @$pc1;?></span>
      </td>
    </tr><br>
    <tr>
      <td width="5%">  
     5. 
      </td>

      <td width="95%"><strong>The name and address of the Society’s agent in Barbados:</strong>
        <?php if($fieldValues['UK-FCL-00362_0']=='Yes'){ 

 if(isset( $fieldValues['UK-FCL-00404_0'])){
          $asparish1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00404_0'])->queryRow(); 
        }else{
          $asparish1 = [];
        }
    

if(isset($fieldValues['UK-FCL-00455_0'])){
      if($fieldValues['UK-FCL-00455_0']){
         $asprases1 = Yii::app()->db->createCommand("SELECT * from bo_postalcode_in_barbados where id=".$fieldValues['UK-FCL-00455_0'])->queryRow(); 
       $aspc1 = $asprases1['code'];
     }else{
        $aspc1 = "";
     }
      
      }else{
        $aspc1 = "";
      }
          ?>
      <br><span >  Name : <?php echo @$fieldValues['UK-FCL-00301_0'] .' '. @$fieldValues['UK-FCL-00105_0'].' '.@$fieldValues['UK-FCL-00324_0'];?><br>Address: <?php  
        if($show_main==true){
          echo @$fieldValues['UK-FCL-00107_0'];?> <?php echo @$fieldValues['UK-FCL-00457_0'];?> <?php echo @$fieldValues['UK-FCL-00463_0'].'  '.@$asparish1['lr_name'];?>  <?php echo @$fieldValues['UK-FCL-00320_0'].' '. @$aspc1; 
        }else{ echo "XXXXX"; } 
        ?></span>
      <?php } ?>
      </td>
    </tr><br>
    <tr>
      <td width="5%">    
     6.
      </td>
      <td width="95%"><strong>The classes and any maximum number of quotas that the Society is authorized to issue.</strong><br>
         <?php 
     
    $arrayFields = $fieldValues['UK-FCL-00367_0'];

     if(is_array($arrayFields)){ ?>
      <table style="padding: 5px;">
         
       
   <?php  foreach ($arrayFields as $key => $value) {  
          
    ?>

  <tr nobr="true">
      <th class="latabv" ><strong>Type of Quota</strong></th>
      <td class="latabv"><?php echo @$value;?></td>
  </tr>
    <tr nobr="true">
       <th class="latabv"><strong>Name of class of Quota</strong></th>
      <td class="latabv"><?php echo @$fieldValues['UK-FCL-00368_0'][$key];?></td>
    </tr>
      <tr nobr="true">
         <th class="latabv"><strong>Maximum no. of Quota</strong></th>
      <td class="latabv"><?php echo @$fieldValues['UK-FCL-00369_0'][$key];?></td>
    </tr>
      <tr nobr="true">
        <th class="latabv" ><strong>Are these Quota redeemable</strong></th>
      <td class="latabv"><?php echo @$fieldValues['UK-FCL-00370_0'][$key];?></td>
    </tr>
      <tr nobr="true">
          <th class="latabv"><strong>Price / formula for calculation of price</strong></th>
      <td class="latabv"><?php echo @$fieldValues['UK-FCL-00266_0'][$key];?></td>
    </tr>
      <tr nobr="true">
        <th class="latabv"><strong>Rights & privileges attached to the Quota </strong></th>
      <td class="latabv"><?php echo @$fieldValues['UK-FCL-00371_0'][$key];?></td>
    </tr>
    <tr nobr="true">
         <th class="latabv"><strong>Any other additional rights & privilege attached</strong></th>   
      <td class="latabv"><?php echo @$fieldValues['UK-FCL-00288_0'][$key];?></td>
    </tr>
    <tr nobr="true">
      <th colspan="2"></th>
    </tr>

<?php } ?> 



  </table>
<?php }  ?>
      </td>
    </tr><br>
    <tr>
      <td width="5%">
     7.   
      </td>
      <td width="95%"><strong>Restriction on transfer of quotas.</strong><br><span  width="100%"><?php //echo @$fieldValues['UK-FCL-00231_0']; 
        if(@$fieldValues['UK-FCL-00231_0']){
          if(is_array($fieldValues['UK-FCL-00231_0'])){
            foreach ($fieldValues['UK-FCL-00231_0'] as $key => $value) {
              if($value=='Others (Please specify)'){
                echo '- '.@$fieldValues['UK-FCL-00377_0'];
              }else{
                 echo '- '.$value;
              }
              echo '<br>';
            }
          }
        }
      ?></span>
      </td>
      </tr><br>

      <tr>
      <td width="5%">
     8.   
      </td>
      <td width="95%"><strong>Restriction if any on business the Society may carry on.</strong><br><span  width="100%"><?php  if(isset($fieldValues['UK-FCL-00232_0'])){ echo $fieldValues['UK-FCL-00232_0'];}?></span>
      </td>
      </tr><br>
    <tr>
      <td width="5%">
     9.   
      </td>
      <td width="95%"><strong>Other provisions if any.</strong><br><span  width="100%"><?php 
          if(@$fieldValues['UK-FCL-00233_0']){
          if(is_array($fieldValues['UK-FCL-00233_0'])){
            foreach ($fieldValues['UK-FCL-00233_0'] as $key => $value) {
              if($value=='Others'){
                echo '- '.@$fieldValues['UK-FCL-00126_0'];
              }else{
                 echo '- '.$value;
              }
              echo '<br>';
            }
          }
        }
       ?>
       </span>
      </td>
    </tr><br>


</table>


<br><br>
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

