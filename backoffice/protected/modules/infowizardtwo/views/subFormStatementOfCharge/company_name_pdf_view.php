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
             <span style="font-size: 13;">(Section 33 and 203)</span>       
        </td>
     </tr>
       <tr>
         <td style="text-align:center;">
             <span style="font-size: 11;"><strong>STATEMENT OF CHARGE</strong></span>           
        </td>        
        </tr>
    
   
</table>
<br><br><br>
<?php $count = 0; ?>
<table style="padding-top: 10px; font-size: 12;" width="100%">

  <tr>
    <td width="5%">  
        <?=++$count?>     
    </td>
    <td width="95%"><strong>Type of entity:</strong>
      <br><br><?php  if(isset($fieldValues['UK-FCL-00675_0'])){ echo $fieldValues['UK-FCL-00675_0'];}?>
    </td>
  </tr>

  <table style="padding-top: 10px; font-size: 12;" width="100%">
  <?php if($fieldValues['UK-FCL-00675_0'] == "Company other than Unregistered External Company" || $fieldValues['UK-FCL-00675_0'] == "Society") { ?>
   
    <tr>
      <td width="5%">     
       <?=++$count?> 
      </td>
      <td width="95%"><strong>Name of Company/Society: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00651_0'])){ echo $fieldValues['UK-FCL-00651_0'];}?>        
      </td>
    </tr>

    
    <tr>
      <td width="5%">     
       <?=++$count?>
      </td>
      <td width="95%"><strong>Company/Society Number: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00650_0'])){ echo $fieldValues['UK-FCL-00650_0'];}?>        
      </td>
    </tr>
  
  <?php } else { ?>
  
  <tr>
      <td width="5%">     
       <?=++$count?>
      </td>
      <td width="95%"><strong>Unregistered External Entity Number: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00676_0'])){ echo $fieldValues['UK-FCL-00676_0'];}?>        
      </td>
    </tr>

    
    <tr>
      <td width="5%">     
       <?=++$count?>
      </td>
      <td width="95%"><strong>Name of Unregistered External Entity:</strong><br><br><?php  if(isset($fieldValues['UK-FCL-00677_0'])){ echo $fieldValues['UK-FCL-00677_0'];}?>        
      </td>
    </tr>
  
  <?php } ?>

    <tr>
      <td width="5%">     
       <?=++$count?>
      </td>
      <td width="95%"><strong>Date of Creation of Charge: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00593_0'])){ echo $fieldValues['UK-FCL-00593_0'];}?>        
      </td>
    </tr>
    <tr>
      <td width="5%">     
       <?=++$count?>
      </td>
      <td width="95%"><strong>Whether previous charges were upstamped, if Yes please provide the details: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00680_0'])){ echo $fieldValues['UK-FCL-00680_0'];}?><br><br><strong>If Yes please provide the details: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00689_0'])){ echo $fieldValues['UK-FCL-00689_0'];}?>

      </td>
    </tr>
  <tr>
      <td width="5%">     
      <?=++$count?>
      </td>
      <td width="95%"><strong>Nature of the Charge: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00594_0'])){ echo $fieldValues['UK-FCL-00594_0'];}?>        
      </td>
    </tr>
    <tr>
      <td width="5%">     
     <?=++$count?>
      </td>
      <td width="95%"><strong>Amount secured by the Charge: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00595_0'])){ echo $fieldValues['UK-FCL-00595_0'];}?>        
      </td>
    </tr>
   <tr>
      <td width="6%">     
       <?=++$count?>
      </td>
      <td width="94%"><strong>Short particulars of the property charged: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00596_0'])){ echo $fieldValues['UK-FCL-00596_0'];}?>        
      </td>
    </tr> 

   <tr>
      <td width="6%">     
       <?=++$count?>
      </td>
      <td width="94%"><strong>Persons entitled to the charge: </strong><br><br>
        <strong>Name: </strong><?php   echo  @$fieldValues['UK-FCL-00132_0'] . ' ' . @$fieldValues['UK-FCL-00105_0'] . ' ' . @$fieldValues['UK-FCL-00106_0']; ?><br><br>    
        <strong>Address: </strong> <?php 
		if($show_main==true){ 
			echo  @$fieldValues['UK-FCL-00093_0'] . ' ' . @$fieldValues['UK-FCL-00238_0'] . ' ' . @$fieldValues['UK-FCL-00310_0'].' ' . InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00129_0']).' ' . InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00096_0']). ' ' .@$fieldValues['UK-FCL-00094_0'];  
		}else{
				echo "Not available publicly";
			}   
                ?> 
      </td>
    </tr> 

    <tr>
      <td width="6%">     
     <?=++$count?>
      </td>
      <td width="94%"><strong>Is there any restriction in case of floating charge, if Yes please provide the details: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00681_0'])){ echo $fieldValues['UK-FCL-00681_0'];}?><br><br><strong>If Yes please provide the details: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00617_0'])){ echo $fieldValues['UK-FCL-00617_0'];}?>

      </td>
    </tr>
    <tr>
      <td width="6%">     
       <?=++$count?>
      </td>
      <td width="94%"><strong>Is section 238(2) applicable on the charge: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00682_0'])){ echo $fieldValues['UK-FCL-00682_0'];}?>        
      </td>
    </tr> 
          <?php if ($fieldValues['UK-FCL-00682_0'] == 'Yes'){ ?>
        <tr>
         <td width="5%"><?=++$count?></td>
            <td width="95%"><strong>The total amount secured by the whole series:</strong><br><br>
           
           <?=@$fieldValues['UK-FCL-00683_0']?>             
               
            </td>
      </tr>
        <?php }
        ?>
   

          <?php if ($fieldValues['UK-FCL-00682_0'] == 'Yes'){ ?>
        <tr>
         <td width="5%"><?=++$count?></td>
            <td width="95%"><strong>The dates of the resolutions authorising the issue of the series and the date of any covering instrument by which the security interest is created or defined:</strong><br><br>
           
           <?=@$fieldValues['UK-FCL-00684_0']?>             
               
            </td>
      </tr>
        <?php }
        ?>
       <?php if ($fieldValues['UK-FCL-00682_0'] == 'Yes'){ ?>
        <tr>
         <td width="5%"> <?=++$count?></td>
            <td width="95%"><strong>The name of any trustee for the debenture holders:</strong><br><br>
           
           <?=@$fieldValues['UK-FCL-00685_0']?>             
               
            </td>
      </tr>
        <?php }
        ?>

         <?php if ($fieldValues['UK-FCL-00682_0'] == 'Yes'){ ?>
        <tr>
         <td width="5%"><?=++$count?></td>
            <td width="95%"><strong>The nature of the charge:</strong><br><br>
           
           <?=@$fieldValues['UK-FCL-00686_0']?>             
               
            </td>
      </tr>
        <?php }
        ?>


         <?php if ($fieldValues['UK-FCL-00682_0'] == 'Yes'){ ?>
        <tr>
         <td width="5%"><?=++$count?> </td>
            <td width="95%"><strong>Short particulars of property charged:</strong><br><br>
           
           <?=@$fieldValues['UK-FCL-00687_0']?>             
               
            </td>
      </tr>
        <?php }
        ?>

       <?php if ($fieldValues['UK-FCL-00682_0'] == 'Yes'){ ?>
        <tr>
         <td width="6%"><?=++$count?> </td>
            <td width="94%"><strong>In the case of a floating charge, the nature of any restriciton on the power of the company to grant furhter charges ranking in priority to, or equally with, the charge thereby created:</strong><br><br>
           
           <?=@$fieldValues['UK-FCL-00688_0']?>             
               
            </td>
      </tr>
        <?php }
        
        ?>


     
  </table>





  <style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>
<br><br><br><br><br>

<?php if($app_status=='A'){ 
  echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>

 <br>
 <br>
 <br>
<table style=" font-size: 12; border-collapse: collapse; ">
   <tr>
         <td style="text-align:center;">
            <span style="font-size: 14;"><strong> SIGNATORY DETAILS</strong></span>           
         </td>
   </tr>
   <br>
   <tr>
         <td>
            <table style="padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse; padding: 5px;">
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
</table>
      
</table>
