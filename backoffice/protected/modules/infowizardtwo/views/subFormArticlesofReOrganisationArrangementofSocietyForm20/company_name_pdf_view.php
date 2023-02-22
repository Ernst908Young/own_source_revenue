<table style="padding-top: 10px;">
   <tr>
      <td style="text-align:center;">     
         <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span><br>
         <span style="font-size: 11;">(Sections 223 and 224)</span>   <br><br>
         <span style="font-size: 14;"><strong>Articles of Re-Organisation/Arrangement of Society</strong></span>   <br>
          
      </td>
   </tr>
</table>
<br><br><br>
<table style="padding-top: 10px; font-size: 12;" width="100%">
  <tr>
    <td width="5%">     
      1. 
    </td>
    <td width="95%"><strong>Name of Society: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00197_0'])){ echo $fieldValues['UK-FCL-00197_0'];}?>        
    </td>
  </tr>
</table>
<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
          
      </td>
      <td width="95%"><strong>Society Number: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00290_0'])){ echo $fieldValues['UK-FCL-00290_0'];}?>      </td>
    </tr>
    <tr>
      <td width="5%">     
         2. 
      </td>
      <td width="95%"><strong>In accordance with the order of re-organisation/arrangement, the Articles of Incorporation are amended as follows: </strong><br><br><?php 
         $typeodchange = [];
                 if(isset($fieldValues['UK-FCL-00583_0'])){
                   if(is_array($fieldValues['UK-FCL-00583_0'])){
                     if(!empty($fieldValues['UK-FCL-00583_0'])){
                       $typeodchange = $fieldValues['UK-FCL-00583_0'];
                       foreach ($typeodchange as $key => $value){
                          echo '- '.$value.'<br>';
                       }
                      
                     }
                   }
                 } ?>



      </td>
   </tr>

      <?php if(in_array('Name of the Society', $typeodchange)){ ?>
       <tr>
         <td width="5%"> </td>
            <td width="95%"><strong>Enter SRN of Name Reservation form (Form 15):</strong><br><span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00360_0']; ?></span>
            </td>
      </tr>
      <tr> 
         <td width="5%"> </td>
            <td width="95%"><strong>Name of Society: </strong><br><span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00503_0']; ?></span>
         </td>
         
      </tr>
      <?php } ?>
      
      <!--- 2 step---->
      <?php if(in_array('Details of quotas and quota transfer', $typeodchange)){ ?>
         <tr>
            <td width="5%"> </td>
               <td width="95%"><strong>The classes and maximum number of Quotas that the Society is authorised to issue:</strong><br>
               </td>
            
         </tr>
         
         <tr>
            <td width="5%"></td>
         <td width="95%">
        
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
                     <th class="latabv"><strong>Rights & privileges attached to the Quota</strong></th>
                     <td class="latabv"><?php echo @$fieldValues['UK-FCL-00371_0'][$key];?></td>
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
         <td width="5%"> </td>
            <td width="95%"><strong>Restriction if any on Quota transfers: </strong><br>
            <?php
               if(isset($fieldValues['UK-FCL-00230_0'])){
                  if($fieldValues['UK-FCL-00230_0'] == 'Yes'){
                     if(is_array($fieldValues['UK-FCL-00664_0'])){
                        foreach ($fieldValues['UK-FCL-00664_0'] as $key => $value) {
                           if($value=='Others (Please specify)'){
                             echo @$fieldValues['UK-FCL-00671_0'];
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
         
      <?php } ?>
      
   
      
      <!--- 4 step---->
      <?php if(in_array('Business Activity/Purpose of Society', $typeodchange)){ ?>
      <!--  <tr>
         <td width="5%"> </td>
            <td width="95%"><strong>Main Business Activity Description, which the Society proposes to carry on</strong><br><br>
             <?php 
         $typeodchange = [];
                 if(isset($fieldValues['UK-FCL-00198_0'])){
                   if(is_array($fieldValues['UK-FCL-00198_0'])){
                     if(!empty($fieldValues['UK-FCL-00198_0'])){
                       $typeodchange = $fieldValues['UK-FCL-00198_0'];
                       foreach ($typeodchange as $key => $value){
                          echo '- '.$value.'<br>';
                       }
                      
                     }
                   }
                 } ?>
            </td>
      </tr> -->
      
      <?php } ?>
      
      

      
      <!--- 6 step---->
      <?php if(in_array('Duration of the Society', $typeodchange)){ ?>
       <tr>
         <td width="5%"> </td>
            <td width="95%"><strong>The duration of the Society</strong><br><br>
               <?php echo @$fieldValues['UK-FCL-00200_0']; ?>
            </td>
      </tr>
      
      <?php } ?>
      <!--- 7 step---->
      <?php if(in_array('Registered office of the Society', $typeodchange)){ ?>
       <tr>
         <td width="5%"> </td>
            <td width="95%"><strong>The registered office of the Society in Barbados:</strong><br><br>
               <?php echo @$fieldValues['UK-FCL-00093_0'] . ' ' . @$fieldValues['UK-FCL-00238_0'] . ' ' . InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00337_0']). ' ' . @$fieldValues['UK-FCL-00096_0'].' '. @$fieldValues['UK-FCL-00094_0']; ?> 
            </td>
      </tr>
      
      <?php } ?>

      <!--- 7 step---->
      <?php if(in_array('Registered Agent', $typeodchange)){ ?>
         <tr>
         <td width="5%"> </td>
            <td width="95%"><strong>Is the society appointing a person as its registered agent:</strong><br><br>
               <?php echo @$fieldValues['UK-FCL-00362_0']; ?>

               <?php if ($fieldValues['UK-FCL-00362_0'] == 'Yes'){

                  echo '<br><br><b>The details of the Society’s agent in Barbados:</b><br>';
                  echo '<br><b>Name: </b>';
                  echo  @$fieldValues['UK-FCL-00132_0'] . ' ' . @$fieldValues['UK-FCL-00105_0'] . ' ' . @$fieldValues['UK-FCL-00106_0'];
                   echo'<br><b>Address: </b>';
                  } 
                  ?>
                  <?php
                  echo @$fieldValues['UK-FCL-00104_0'] . ' ' . @$fieldValues['UK-FCL-00309_0'] . ' ' . InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00337_0']). ' ' .@$fieldValues['UK-FCL-00096_0'].' '. @$fieldValues['UK-FCL-00242_0'];             
               
                   ?>
               
            </td>
      </tr>
      
      <?php } ?>

      <!--- 6 step---->
      <?php if(in_array('Business of the Society', $typeodchange)){ ?>
       <tr>
         <td width="5%"> </td>
            <td width="95%"><strong>Restrictions if any on the business the Society may carry on</strong><br><br>
               <?php echo @$fieldValues['UK-FCL-00665_0']; ?>
            </td>
      </tr>
      
      <?php } ?>

      <!--- 6 step---->
      <?php if(in_array('Other Provisions', $typeodchange)){ ?>
       <tr>
         <td width="5%"> </td>
            <td width="95%"><strong>Other provisions, if any</strong><br><br>
               <?php echo @$fieldValues['UK-FCL-00233_0']; ?>
            </td>
      </tr>
      
      <?php } ?>

  <tr>
    <td width="5%">     
      3. 
    </td>
    <td width="95%"><strong>Is Form 3- Notice of Address or Notice of Change of Address of Registered office also required to be filed: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00525_0'])){ echo $fieldValues['UK-FCL-00525_0'];}?>        
    </td>
  </tr>
  <tr>
    <td width="5%">     
      4. 
    </td>
    <td width="95%"><strong>Is Form 6- Notice of Managers or Notice of Change of Managers also required to be filed: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00526_0'])){ echo $fieldValues['UK-FCL-00526_0'];}?>        
    </td>
  </tr>

      
  
  

</table>

<?php 

    if(isset($fieldValues2['UK-FCL-00525_0']) && $fieldValues2['UK-FCL-00525_0']=='Yes')
      $this->renderPartial('form3_pdf', array('aap' => $allActivePages, 'formData' => $formData, 'fieldValues' => $fieldValues2, 'app_id' => $fieldValues['submission_id'], 'app_status' => $fieldValues['application_status'], 'application_created_date' => $fieldValues['application_created_date']), true);
    if(isset($fieldValues2['UK-FCL-00526_0']) && $fieldValues2['UK-FCL-00526_0']=='Yes')
      $this->renderPartial('form6_pdf', array('aap' => $allActivePages, 'formData' => $formData, 'fieldValues' => $fieldValues2, 'app_id' => $fieldValues['submission_id'], 'app_status' => $fieldValues['application_status'], 'application_created_date' => $fieldValues['application_created_date']), true);

?>

<style type="text/css">
   .latabv {
   border: 1px solid black;
   }
</style>

<br><br>
