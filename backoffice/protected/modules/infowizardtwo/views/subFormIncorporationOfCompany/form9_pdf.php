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
        <span style="font-size: 12;">(Sections 66 & 74)</span>   <br><br>
        <span style="font-size: 14;"><strong>NOTICE OF DIRECTORS</strong></span>   <br>
        <span style="font-size: 14;"><strong>OR</strong></span>   <br>
        <span style="font-size: 14;"><strong>NOTICE OF CHANGE OF DIRECTORS</strong></span>  
    </td>
     </tr>
</table>
<br>

<table style="padding-top: 10px;" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>Name of Company :</strong> <span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00089_0'])){ echo $fieldValues['UK-FCL-00089_0'];}?></span>
      </td>
    </tr>
   

<br>


<tr>
      <td width="5%"> 
      2.        
      </td>
      <td width="95%"><strong>The directors of the company as of this date are:</strong></td>
    </tr>



<tr>
  <td width="5%"></td>
  <td width="95%"><table style="border-collapse: collapse; padding: 5px;">
  <tr nobr="true">
    <th class="latabv"><strong>Name</strong></th>
    <th class="latabv"><strong>Residential Address</strong></th>
    <th class="latabv"><strong>Occupation</strong></th>
    <th class="latabv"><strong>Details of office</strong></th>
  </tr>

  <?php 
     
    
if(isset($fieldValues['UK-FCL-00132_0'])){
  if(is_array($fieldValues['UK-FCL-00132_0'])){         
     foreach ($fieldValues['UK-FCL-00132_0'] as $key => $value) {  
          
    ?>
  <tr nobr="true">
    <td class="latabv"><?php echo @$value .' '. @$fieldValues['UK-FCL-00133_0'][$key] .' '.@$fieldValues['UK-FCL-00134_0'][$key];?></td>

    <td class="latabv"><?php 
    if($show_main==true){ 
    echo @$fieldValues['UK-FCL-00093_0'][$key].' '.@$fieldValues['UK-FCL-00309_0'][$key].' '.@$fieldValues['UK-FCL-00310_0'][$key].' '.@$fieldValues['UK-FCL-00372_0'][$key].' '.@$fieldValues['UK-FCL-00096_0'][$key].' '.@$fieldValues['UK-FCL-00094_0'][$key];
}else{
  echo 'XXXXX';
}
    ?></td>

    <td class="latabv"><?php echo @$fieldValues['UK-FCL-00137_0'][$key];?></td>
     <td class="latabv"><?php 
     if(isset($fieldValues['UK-FCL-00480_0'])){
         echo isset($fieldValues['UK-FCL-00481_0'][$key]) ? $fieldValues['UK-FCL-00481_0'][$key] : "";
     }
    
     ?></td>
  </tr>
<?php } } } ?>

</table></td>
</tr>




</table>
<br><br><br><br>

<?php if($app_status=='A'){ 
   echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>

 <br><br><br>

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
              echo '<tr  nobr="true">
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




