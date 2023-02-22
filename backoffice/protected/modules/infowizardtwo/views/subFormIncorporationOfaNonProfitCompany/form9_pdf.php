<?php 
$show_main = true;
if(isset($_GET['is_vpd'])){
  if($_GET['is_vpd']=='yes'){
    $show_main = false;
  }
} ?>

<?php 

/*if(isset($fieldValues['UK-FCL-00117_0'])){
  $string =  $fieldValues['UK-FCL-00117_0'];

  $str_arr = implode(",", $string); 
  $trim = trim($str_arr,',');
  $array = explode(',',$trim);
}*/

 ?>
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
        <span style="font-size: 14;"><strong>NOTICE OF DIRECTORS (Form 9)</strong></span>   <br>
        <span style="font-size: 14;"><strong>OR</strong></span>   <br>
        <span style="font-size: 14;"><strong>NOTICE OF CHANGE OF DIRECTORS</strong></span>  
    </td>
     </tr>
</table>
<br><br><br>

<table style="padding-top: 10px;" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>Name of Company </strong><br><br><span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00090_0'])){ echo $fieldValues['UK-FCL-00090_0'];}?></span>
      </td>
    </tr>
     <!-- <tr>
      <td width="5%">  
          2.      
      </td>
      <td width="95%"><strong>Company Number :</strong> <span  style="margin-top:10px;"><?php //echo $fieldValues['UK-FCL-00088_0']; ?></span>
      </td>
    </tr> -->
    <!-- <tr>
      <td width="5%"> 
      3.        
      </td>
      <td width="95%"><strong>Notice is given that on the <span  style="margin-top:10px;"></span> day of <span  style="margin-top:10px;"></span> , <span  style="margin-top:10px;"></span> the following was appointed director <span  style="margin-top:10px;"></strong></span>
       </td>
    </tr> -->
</table>



<!-- <table style="padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse; padding: 5px;">
  <tr>
    <th class="latabv"><strong>Name</strong></th>
    <th class="latabv"><strong>Residential Address</strong></th>
    <th class="latabv"><strong>Occupation</strong></th>
  </tr>
  <tr>
    <td class="latabv"></td>
    <td class="latabv"></td>
    <td class="latabv"></td>
  </tr>
</table> -->

<!-- <table style="padding-top: 10px; font-size: 12;" width="100%">
<tr>
      <td width="5%"> 
      4.        
      </td>
      <td width="95%"><strong>Notice is given that on the <span  style="margin-top:10px;"><strong></strong></span> day of <span  style="margin-top:10px;"></span> , <span  style="margin-top:10px;"></span> the following person ceased to hold office as director</strong> <span  style="margin-top:10px;">
       </span>
       </td>
    </tr>
</table> -->
<br><br>

<!-- <table style="padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse; padding: 5px;">
  <tr>
    <th class="latabv" width="32%"><strong>Name</strong></th>
    <th class="latabv" width="68%"><strong>Residential Address</strong></th>
  </tr>
  <tr>
    <td class="latabv" width="32%"></td>
    <td class="latabv" width="68%"></td>
  </tr>
</table> -->



<table style="" width="100%">
<tr>
      <td width="5%"> 
      3.        
      </td>
      <td width="95%"><strong>The directors of the company as of this date are:</strong></td>
    </tr><br>
    
    <tr>
      <td width="5%"> 
             
      </td>
      <td width="95%"><table style="padding: 5px;">
  <tr nobr="true">
    <th class="latabv"><strong>Name</strong></th>
    <th class="latabv"><strong>Residential Address</strong></th>
    <th class="latabv"><strong>Occupation</strong></th>
    <th class="latabv"><strong>Details of office</strong></th>
  </tr>


  <?php 
     if(isset($fieldValues['UK-FCL-00150_0'])){
   if(is_array($fieldValues['UK-FCL-00150_0'])){
                 $faltu = count($fieldValues['UK-FCL-00150_0'])/2;
                  $Occupation = array_slice($fieldValues['UK-FCL-00117_0'], -$faltu);
               $ddo = array_slice($fieldValues['UK-FCL-00317_0'], -$faltu); 
                  for ($key = 0; $key < $faltu; $key++) {
                     
    ?>
  <tr nobr="true">
    <td class="latabv"><?php echo @$fieldValues['UK-FCL-00150_0'][$key] .' '. @$fieldValues['UK-FCL-00133_0'][$key] .' '.@$fieldValues['UK-FCL-00134_0'][$key];?></td>

   <td class="latabv"><?php 
    if($show_main==true){  echo @$fieldValues['UK-FCL-00107_0'][$key].' '.@$fieldValues['UK-FCL-00390_0'][$key].' '.@$fieldValues['UK-FCL-00463_0'][$key].' '.@$fieldValues['UK-FCL-00383_0'][$key].' '.@$fieldValues['UK-FCL-00400_0'][$key].' '.@$fieldValues['UK-FCL-00320_0'][$key]; 
  }else{
      echo 'XXXXX';
    } ?>  </td>

    <td class="latabv"><?php echo $Occupation[$key] ?></td>
    <td class="latabv"><?php echo $ddo[$key] ?></td>
  </tr>
<?php } } } ?>

</table>

      </td>
    </tr>
    <br>
  <br><br><br>
  <?php if($app_status=='A'){ 
   echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>
 <br><br><br><br>
    <tr>
      <td width="5%"></td>
      <td width="95%"><table>
      <tr>
         <td style="text-align:center;">
            <span><strong> SIGNATORY DETAILS</strong></span>           
         </td>
      </tr>
     <br>
       <tr>
         <td><table style="border-collapse: collapse; padding: 5px;">
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
</table>







