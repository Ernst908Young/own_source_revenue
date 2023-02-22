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
<br>
<table style="padding-top: 10px;" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>Name of Company :</strong> <span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00089_0']; ?></span>
      </td>
    </tr>
     <tr>
      <td width="5%">  
          2.      
      </td>
      <td width="95%"><strong>Company Number :</strong> <span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00403_0']; ?></span>
      </td>
    </tr>
    <tr>
      <td width="5%">  
          3.      
      </td>
      <td width="95%"><strong>Purpose of Filing the Form :</strong> <span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00012_0']; ?></span>
      </td>
    </tr> 
   <?php 
        $date = '';
        if(isset($fieldValues['UK-FCL-00395_0'])){
          if($fieldValues['UK-FCL-00395_0']!=""){
            $date = $fieldValues['UK-FCL-00395_0'];
          }
        }
   ?>
     <?php if(@$fieldValues['UK-FCL-00012_0']!='Cessation of Director(s)'){ ?>
      <tr>
      <td width="5%"> 
             
      </td>
      <td width="95%"><strong>Notice is given that on <?= $date ?>  , the following was appointed director 
         </strong>
       </td>
         </tr> 

         <tr>
  <td width="5%"></td>
  <td width="95%"><table style="padding: 5px;">
  <tr nobr="true">
    <th class="latabv"><strong>Name</strong></th>
    <th class="latabv"><strong>Residential Address</strong></th>
    <th class="latabv"><strong>Occupation</strong></th>
    <th class="latabv"><strong>Details of office</strong></th>
  </tr>
  <?php 
     
    
      if(isset($fieldValues['UK-FCL-00132_0'])){   
         $arrayFields = $fieldValues['UK-FCL-00132_0'];
         if(is_array($arrayFields)){
     foreach ($arrayFields as $key => $value) {  
          
    ?>
  <tr nobr="true">
    <td class="latabv"><?php echo $value .' '. $fieldValues['UK-FCL-00105_0'][$key] .' '.$fieldValues['UK-FCL-00106_0'][$key];?></td>
    <td class="latabv"><?php  if($show_main==true){ 
     echo $fieldValues['UK-FCL-00093_0'][$key].' '.$fieldValues['UK-FCL-00309_0'][$key].' '.$fieldValues['UK-FCL-00399_0'][$key].' '.$fieldValues['UK-FCL-00400_0'][$key].' '.$fieldValues['UK-FCL-00096_0'][$key].' '.$fieldValues['UK-FCL-00401_0'][$key];
   }else{
      echo "XXXXX";
   }
     ?></td>
   
    <td class="latabv"><?php echo $fieldValues['UK-FCL-00304_0'][$key];?></td>
    <td class="latabv"><?php echo @$fieldValues['UK-FCL-00481_0'][$key]; ?></td>
  </tr>
    <?php }}} ?>
  
</table>
</td>
</tr> 



 <br>

       <?php } ?>
  

<?php if(@$fieldValues['UK-FCL-00012_0']!='Appointment of Director(s)'){ ?>
  <tr>
      <td width="5%"> 
  
            
      </td>
      <td width="95%"><strong>Notice is given that on <?= $date ?> ,  the following person ceased to hold office as director</strong> 
       </td>
      
    </tr> 




 <tr>
  <td width="5%"></td>
  <td width="95%"><table style="padding: 5px;">
    <tr nobr="true">
    <th class="latabv"><strong>Name</strong></th>
    <th class="latabv"><strong>Residential Address</strong></th>
    <th class="latabv"><strong>Details of office</strong></th>
  </tr>
  

  <?php 
     
     
	 if(isset($fieldValues['UK-FCL-00431_0'])){    
    $arrayFields =$fieldValues['UK-FCL-00431_0'];
   if(is_array($arrayFields)){
     foreach ($arrayFields as $key => $value) {  
   
          
    ?>
  <tr nobr="true">
    <td class="latabv"><?php echo $value .' '. @$fieldValues['UK-FCL-00432_0'][$key] .' '.@$fieldValues['UK-FCL-00433_0'][$key];?></td>
    <td class="latabv"><?php  if($show_main==true){ 
     echo @$fieldValues['UK-FCL-00434_0'][$key].' '.@$fieldValues['UK-FCL-00435_0'][$key].' '.@$fieldValues['UK-FCL-00436_0'][$key].' '.@$fieldValues['UK-FCL-00438_0'][$key].' '.@$fieldValues['UK-FCL-00437_0'][$key].' '.@$fieldValues['UK-FCL-00439_0'][$key]; 
   }else{
    echo "XXXXX";
     } ?>      
    </td>
   <td class="latabv"><?php echo @$fieldValues['UK-FCL-00491_0'][$key]; ?></td>
  </tr>
	 <?php }
  }
  }
	 ?>
  </table>
    
  </td>
</tr> 
<br>
<?php } ?>





<tr>
      <td width="5%"> 
        
      </td>
      <td width="95%"><strong>The directors of the company as of this date are:</strong></td>
    </tr>



<tr>
  <td width="5%"></td>
  <td width="95%"><table style="padding: 5px;">
  <tr nobr="true">
    <th class="latabv"><strong>Name</strong></th>
    <th class="latabv"><strong>Residential Address</strong></th>
    <th class="latabv"><strong>Occupation</strong></th>
     <th class="latabv"><strong>Details of office</strong></th>
  </tr>

  <?php 
     if(isset($fieldValues['UK-FCL-00441_0'])){ 
          if(is_array($fieldValues['UK-FCL-00441_0'])){
     foreach ($fieldValues['UK-FCL-00441_0'] as $key => $value) {  
          
    
	//	 print_r($value); ?>
		 <tr nobr="true">
   <td class="latabv"><?php echo $value .' '. @$fieldValues['UK-FCL-00442_0'][$key] .' '.@$fieldValues['UK-FCL-00443_0'][$key];?></td>
  <td class="latabv"><?php  if($show_main==true){ 
   echo @$fieldValues['UK-FCL-00444_0'][$key].' '.@$fieldValues['UK-FCL-00445_0'][$key].' '.@$fieldValues['UK-FCL-00448_0'][$key].' '.@$fieldValues['UK-FCL-00447_0'][$key].' '.@$fieldValues['UK-FCL-00446_0'][$key].' '.@$fieldValues['UK-FCL-00449_0'][$key];
   }else{
    echo "XXXXX";
   } ?>
      
    </td>
   
  <td class="latabv"><?php echo @$fieldValues['UK-FCL-00450_0'][$key];?></td>
  <td class="latabv"><?php echo @$fieldValues['UK-FCL-00490_0'][$key]; ?></td>
  </tr>
  
	 <?php }
    }
  } ?>

</table></td>
</tr>
<br><br><br>
<?php if($app_status=='A'){ 
   echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>

 <br><br><br>
<tr>
  <td width="5%"></td>
  <td width="95%"><table style="border-collapse: collapse;" width="100%">
      <tr>
         <td style="text-align:center;">
            <span><strong> SIGNATORY DETAILS</strong></span>           
         </td>
      </tr>
     <br>
       <tr>
         <td><table style="padding: 5px;">
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
