<?php 
$show_main = true;
if(isset($_GET['is_vpd'])){
  if($_GET['is_vpd']=='yes'){
    $show_main = false;
  }
} ?>
<table style="padding-top: 10px;">
	
    <tr>

      <td style="text-align:center;">     
        <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span>
    </td>
     </tr>
       <tr>
        <td style="text-align:center;">
             <span style="font-size: 13;">(Section 139(1))</span>       
        </td>
     </tr>
       <tr>
         <td style="text-align:center;">
             <span style="font-size: 11;"><strong>FORM OF PROXY (Form 10)</strong></span>           
        </td>        
        </tr>
    
   
</table>
<br><br><br>

<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>Name of Company </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00089_0'])){ echo $fieldValues['UK-FCL-00089_0'];}?>        
      </td>
    </tr>

    <table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
        2. 
      </td>
      <td width="95%"><strong>Company Number </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00403_0'])){ echo $fieldValues['UK-FCL-00403_0'];}?>        
      </td>
    </tr>
    <tr>
      <td width="5%">     
        3. 
      </td>
      <td width="95%"><strong>Particulars of Meeting</strong><br><br><span style="text-align: justify;">
        <?php  if(isset($fieldValues['UK-FCL-00550_0'])){ echo $fieldValues['UK-FCL-00550_0'];} ?>  </span>     
      </td>
    </tr>
     <?php if(isset($fieldValues['UK-FCL-00132_0'])){
          if(is_array($fieldValues['UK-FCL-00132_0'])){?>
     <tr>
      <td width="5%">     
       
     
      </td>
      <td width="95%"><?php 
        echo sizeof($fieldValues['UK-FCL-00132_0'])>1 ?"We ":'I ' ;
        foreach($fieldValues['UK-FCL-00132_0'] as $key=>$val){
			
          echo $val.' '.$fieldValues['UK-FCL-00133_0'][$key].' '.$fieldValues['UK-FCL-00134_0'][$key];  ?> of <?php if($show_main==true){ echo $fieldValues['UK-FCL-00093_0'][$key].' '.$fieldValues['UK-FCL-00309_0'][$key].' '.$fieldValues['UK-FCL-00310_0'][$key].' '.$fieldValues['UK-FCL-00129_0'][$key].' '.$fieldValues['UK-FCL-00096_0'][$key].'   '.$fieldValues['UK-FCL-00094_0'][$key]; }else{
			  echo "Not available publicly";
		  } ?>
		  <?php 
          if(sizeof($fieldValues['UK-FCL-00132_0'])==($key+1)){

          }else{
            // echo ' <br>and ';
          }
        }
         echo sizeof($fieldValues['UK-FCL-00132_0'])>1 ? " shareholder in the above Company appoints ":' shareholders in the above Company appoint ' ;
         // echo '<br>';
         foreach($fieldValues['UK-FCL-00150_0'] as $key=>$val){
          echo $val.' '.$fieldValues['UK-FCL-00105_0'][$key].' '.$fieldValues['UK-FCL-00106_0'][$key]; ?> of <?php if($show_main==true){ echo $fieldValues['UK-FCL-00107_0'][$key].' '.$fieldValues['UK-FCL-00335_0'][$key].'  '.$fieldValues['UK-FCL-00354_0'][$key].' '.$fieldValues['UK-FCL-00372_0'][$key].' '.$fieldValues['UK-FCL-00320_0'][$key].'  '.$fieldValues['UK-FCL-00356_0'][$key];}else{
			  echo "Not available publicly";
		  } ?>
		  <?php 
          if(sizeof($fieldValues['UK-FCL-00150_0'])==($key+1)){

          }else{
            echo ' & ';
          }
        }

         echo sizeof($fieldValues['UK-FCL-00132_0'])> 1 ? " to be my ":' to be our ' ;
         echo 'proxy at the above meeting and any adjournment there of.';
         ?>
        

      </td>
      
    </tr>
    <?php  }
        } ?>
  </table>

  <style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>
<br><br><br>
<?php if($app_status=='A'){ 
  echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>

 <br><br><br><br>


<table style=" font-size: 12; border-collapse: collapse; ">
      <tr>
         <td style="text-align:center;">
            <span style="font-size: 12;"><strong> SIGNATORY DETAILS</strong></span>           
         </td>
      </tr>
      <br>
      <table style="padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse; padding: 5px;">
         <tr>
            <th class="latabv"><strong>Full Name</strong></th>           
            <th class="latabv"><strong>Designation</strong></th>
            <th class="latabv"><strong>Signature</strong></th>
            <th class="latabv"><strong>Date of Signature </strong></th>
         </tr>
         <?php
         $signDate=date('d M,Y');
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
      
</table>
    