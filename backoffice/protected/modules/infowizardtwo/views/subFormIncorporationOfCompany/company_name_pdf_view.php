<style type="text/css">
  .latabv {
    border: .5px solid black;
     border-collapse: collapse;
  }
</style>
<table style="padding-top: 10px;">
    <tr>
      <td style="text-align:center;">     
        <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span>
    </td>
     </tr>
       <tr>
        <td style="text-align:center;">
             <span style="font-size: 13;">(Section 5)</span>       
        </td>
     </tr>
       <tr>
         <td style="text-align:center;">
             <span style="font-size: 11;"><strong>ARTICLES OF INCORPORATION (Form 1)</strong></span>           
        </td>        
        </tr>
</table>
<br><br><br>

<table style="padding-top: 10px;" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>Name of Company </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00089_0'])){ echo $fieldValues['UK-FCL-00089_0'];}?>        
      </td>
    </tr>
    <!--  <tr>
      <td width="5%">        
      </td>
      <td width="95%"><strong>Company Number</strong><br><br><1?= $fieldValues['UK-FCL-00088_0'] ?>   
      </td>
    </tr> -->
    <tr>
      <td width="5%"> 
      2.        
      </td>
      <td width="95%"><strong>The classes and any maximum number of shares that the Company is authorized to issue</strong><br>

      </td>
    </tr>
    <tr>
      <td width="5%"></td>
      <td width="95%">
        <!-- <tr>
    <th class="latabv" ><strong>Type of Shares</strong></th>
    <th class="latabv"><strong>Name of class of shares</strong></th>
    <th class="latabv"><strong>Maximum no. of shares</strong></th>
    <th class="latabv" ><strong>Are these shares redeemable</strong></th>
    <th class="latabv"><strong>Price / formula for calculation of price</strong></th>
    <th class="latabv"><strong>Rights & privileges attached to the share</strong></th>
    <th class="latabv"><strong>Any other additional rights & privilege attached</strong></th>   
  </tr> -->

  <?php 
     
     $arrayFields = $fieldValues['UK-FCL-00095_0'];

     if(is_array($arrayFields)){ ?>
      <table style="padding: 5px;">
         
       
   <?php  foreach ($arrayFields as $key => $value) {  
          
    ?>

  <tr nobr="true">
      <th class="latabv" ><strong>Type of Shares</strong></th>
      <td class="latabv"><?php echo @$value;?></td>
  </tr>
    <tr nobr="true">
       <th class="latabv"><strong>Name of class of shares</strong></th>
      <td class="latabv"><?php echo @$fieldValues['UK-FCL-00263_0'][$key];?></td>
    </tr>
      <tr nobr="true">
         <th class="latabv"><strong>Maximum no. of shares</strong></th>
      <td class="latabv"><?php echo @$fieldValues['UK-FCL-00264_0'][$key];?></td>
    </tr>
      <tr nobr="true">
        <th class="latabv" ><strong>Are these shares redeemable</strong></th>
      <td class="latabv"><?php echo @$fieldValues['UK-FCL-00265_0'][$key];?></td>
    </tr>
      <tr nobr="true">
          <th class="latabv"><strong>Price / formula for calculation of price</strong></th>
      <td class="latabv"><?php echo @$fieldValues['UK-FCL-00266_0'][$key];?></td>
    </tr>
      <tr nobr="true">
        <th class="latabv"><strong>Rights & privileges attached to the share</strong></th>
      <td class="latabv"><?php echo @$fieldValues['UK-FCL-00113_0'][$key];?></td>
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
    </tr>
    

    <tr>
      <td width="5%"> 
      3.        
      </td>
      <td width="95%"><strong>Restriction if any on share transfers</strong><br><br>
		<?php
        if(isset($fieldValues['UK-FCL-00334_0'])){
          if($fieldValues['UK-FCL-00334_0'] == 'Yes'){
              if(is_array($fieldValues['UK-FCL-00115_0'])){
              foreach ($fieldValues['UK-FCL-00115_0'] as $key => $value) {
                if($value=='Other Restrictions'){
                  echo @$fieldValues['UK-FCL-00116_0'];
                }else{
                  echo @$value.'<br><br>';
                }
             }
           }
          }else{
            echo "";
          }
        }
       ?>
      </td>
    </tr>
    <tr>
      <td width="5%"> 
      4.       
      </td>
      <td width="95%"><strong>Number (or minimum and maximum number) of Directors</strong><br><br><?= @$fieldValues['UK-FCL-00240_0'] == 'Fixed Number' ? ("Number of Directors are : ".@$fieldValues['UK-FCL-00241_0']) : (" Minimum : ".@$fieldValues['UK-FCL-00119_0'].", Maximum : ".@$fieldValues['UK-FCL-00120_0']) ?>
      </td>
    </tr>
    <tr>
      <td width="5%">  
      5.      
      </td>
      <td width="95%"><strong>Restrictions if any on the business the company may carry on</strong><br><br><?php  if(isset($fieldValues['UK-FCL-00121_0'])){ 
        echo $fieldValues['UK-FCL-00121_0'];
            if($fieldValues['UK-FCL-00121_0']=='Yes'){
                echo '<br>'.@$fieldValues['UK-FCL-00339_0'];
            }
      }?>
      </td>
    </tr>
    <tr>
      <td width="5%">    
      6.    
      </td>
      <td width="95%"><strong>Other provisions if any</strong><br><br><?php 
           if(isset($fieldValues['UK-FCL-00124_0'])){
            if($fieldValues['UK-FCL-00124_0'] == 'Yes'){
              if(is_array($fieldValues['UK-FCL-00098_0'])){
              foreach ($fieldValues['UK-FCL-00098_0'] as $key => $value) {
                 if($value=='Others - Please State'){
                  echo @$fieldValues['UK-FCL-00116_0'];
                }else{
                  echo $value.'<br><br>';
                }
              }
              if(isset($fieldValues['UK-FCL-00126_0'])){
                echo $fieldValues['UK-FCL-00126_0'];
              }
            }
          }else{
            echo "";
          }
        }
        ?>
        
      </td>
    </tr>
    <!-- <tr>
      <td width="5%">
      7.        
      </td>
      <td width="95%"><strong>Incorporators:</strong><br><strong>Date:</strong><1?= date('d M,Y') ?>
      </td>
    </tr> -->

</table>


<br><br>

<table>
  <tr>
    <td width="5%"></td>
    <td width="95%">
        <table style="border-collapse: collapse; ">
  
      <tr>
         <td style="text-align:center;">
            <span style=""><strong> SIGNATORY DETAILS</strong></span>           
         </td>
      </tr>
     <br>
     <tr>
       <td>
         <table style="border-collapse: collapse; padding: 5px;">
        <thead>
           <tr nobr="true">
              <th class="latabv"><strong>Full Name</strong></th>           
              <th class="latabv"><strong>Designation </strong></th>
              <th class="latabv"><strong>Signature </strong></th>
              <th class="latabv"><strong>Date of Signature </strong></th>
           </tr>
         </thead>
          <tbody>
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
         </tbody>      
      </table>
       </td>
     </tr>
       <tr>
         <td>
      
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




