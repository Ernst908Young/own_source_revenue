<style type="text/css">
   .latabv {
   border: 1px solid black;
   }
</style>
<table style="padding-top: 10px;">
   <tr>
      <td style="text-align:center;">   
         
         <span style="font-size: 13;">SOCIETIES WITH RESTRICTED LIABILITY OF BARBADOS</span><br>
         <span style="font-size: 12;">(Sections 18)</span>   <br><br>
         <span style="font-size: 14;"><strong>NOTICE OF MANAGERS</strong></span>   <br>
         <span style="font-size: 14;"><strong>OR</strong></span>   <br>
         <span style="font-size: 14;"><strong>NOTICE OF CHANGE OF MANAGERS</strong></span>  
      </td>
   </tr>
</table>
<br>
<table style="padding-top: 10px; font-size: 12;" width="100%">
   <tr>
      <td width="5%">  
         1.   
      </td>
      <td width="95%">Name of Society : <?= @$fieldValues['UK-FCL-00520_0']?>       
      </td>
   </tr>
   <tr>
      <td width="5%">     
         2. 
      </td>
      <td width="95%">Society Number : <?= @$fieldValues['UK-FCL-00290_0']?>   
      </td>
   </tr>
   <?php
         
      if($fieldValues['UK-FCL-00533_0']=='Notice of Change (Appointment of Manager(s))' || $fieldValues['UK-FCL-00533_0']=='Notice of Change (Appointment and Cessation of Manager(s))'){
        ?>

   <tr>
      <td width="5%">     
         3. 
      </td>
      <td width="95%"> Notice is given that on the <strong><?=((!isset($fieldValues['UK-FCL-00395_0']) || empty($fieldValues['UK-FCL-00395_0'])) ? date('d', strtotime(date("Y-m-d"))) .  ' of ' . date('F', strtotime(date("Y-m-d"))) . ' , '. date('Y', strtotime(date("Y-m-d")))   : date('d', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0']))) .' of '. date('F', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0']))) .' , '. date('Y', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))) ?></strong> following person(s) was/were appointed manager(s):   
      </td>
   </tr>
   <?php
      $count=1;
      if(isset($fieldValues['UK-FCL-00132_0']) && is_array($fieldValues['UK-FCL-00132_0']))
         foreach ($fieldValues['UK-FCL-00132_0'] as $key => $names) {
            echo '<tr>
                     <td width="5%">     
                        '.$count++.'
                     </td>
                     <td width="95%"> Name: '.@$fieldValues['UK-FCL-00132_0'][$key] . ' ' . @$fieldValues['UK-FCL-00105_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00106_0'][$key] .'
                     </td>
                  </tr>
                  <tr>
                     <td>&nbsp;</td>
                 
                     <td width="95%"> Residential Address: '.@$fieldValues['UK-FCL-00093_0'][$key] . ' ' . @$fieldValues['UK-FCL-00309_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00310_0'][$key] .'   ' . @$fieldValues['UK-FCL-00129_0'][$key]. '  '  .@$fieldValues['UK-FCL-00096_0'][$key]. ' ' . @$fieldValues['UK-FCL-00094_0'][$key] .'
                     </td>
                  </tr>
                  <tr>
                     <td>&nbsp;</td>
                  
                     <td width="95%"> Occupation: '.@$fieldValues['UK-FCL-00137_0'][$key] . '
                     </td>
                  </tr>
                   
      
            ';
         }
      }

      if($fieldValues['UK-FCL-00533_0']=='Notice of Change (Cessation of Manager(s))' || $fieldValues['UK-FCL-00533_0']=='Notice of Change (Appointment and Cessation of Manager(s))'){
      ?>
   <tr>
      <td width="5%">     
         4. 
      </td>
      <td width="95%"> Notice is given that on the <strong><?=((!isset($fieldValues['UK-FCL-00395_0']) || empty($fieldValues['UK-FCL-00395_0'])) ? date('d', strtotime(date("Y-m-d"))) .  ' of ' . date('F', strtotime(date("Y-m-d"))) . ' , '. date('Y', strtotime(date("Y-m-d")))   : date('d', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0']))) .' of '. date('F', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0']))) .' , '. date('Y', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))) ?></strong>of following person(s) ceased to hold office as manager(s):  
      </td>
   </tr>
   <?php
      $count=1;
      if(isset($fieldValues['UK-FCL-00150_0']) && is_array($fieldValues['UK-FCL-00150_0']))
         foreach ($fieldValues['UK-FCL-00150_0'] as $key => $names) {
            echo '<tr>
                     <td width="5%">     
                        '.$count++.'
                     </td>
                     <td width="95%"> Name: '.@$fieldValues['UK-FCL-00150_0'][$key] . ' ' . @$fieldValues['UK-FCL-00316_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00134_0'][$key] .'
                     </td>
                  </tr>
                  <tr>
                     <td>&nbsp;</td>
                 
                     <td width="95%"> Residential Address: '.@$fieldValues['UK-FCL-00107_0'][$key] . ' ' . @$fieldValues['UK-FCL-00335_0'][$key]  . '  ' . @$fieldValues['UK-FCL-00354_0'][$key] .'   ' . @$fieldValues['UK-FCL-00372_0'][$key]. ' '  .@$fieldValues['UK-FCL-00320_0'][$key]. '   ' . @$fieldValues['UK-FCL-00356_0'][$key] .'
                     </td>
                  </tr>
                ';
         }
      }
      if($fieldValues['UK-FCL-00533_0']=='Notice of Manager(s)' || $fieldValues['UK-FCL-00533_0']=='Notice of Change (Appointment of Manager(s))' || $fieldValues['UK-FCL-00533_0']=='Notice of Change (Cessation of Manager(s))' || $fieldValues['UK-FCL-00533_0']=='Notice of Change (Appointment and Cessation of Manager(s))'){

      
      ?>
   <tr>
      <td width="5%">     
         5. 
      </td>
      <td width="95%">The current manager of the Society as of the <strong><?=((!isset($fieldValues['UK-FCL-00395_0']) || empty($fieldValues['UK-FCL-00395_0'])) ? date('d', strtotime(date("Y-m-d"))) .  ' of ' . date('F', strtotime(date("Y-m-d"))) . ' , '. date('Y', strtotime(date("Y-m-d")))   : date('d', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0']))) .' of '. date('F', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0']))) .' , '. date('Y', strtotime(str_replace('/', '-', $fieldValues['UK-FCL-00395_0'])))) ?></strong> are: 
      </td>
   </tr>
   <?php
      $count=1;
       if(isset($fieldValues['UK-FCL-00172_0']) && is_array($fieldValues['UK-FCL-00172_0']))
            foreach ($fieldValues['UK-FCL-00172_0'] as $key => $names) {
               echo '<tr>
                        <td width="5%">     
                           '.$count++.'
                        </td>
                        <td width="95%"> Name: '.@$fieldValues['UK-FCL-00172_0'][$key] . ' ' . @$fieldValues['UK-FCL-00133_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00423_0'][$key] .'
                        </td>
                     </tr>
                     <tr>
                        <td>&nbsp;</td>
                    
                        <td width="95%"> Residential Address: '.@$fieldValues['UK-FCL-00169_0'][$key] . ' ' . @$fieldValues['UK-FCL-00353_0'][$key]  . '  ' . @$fieldValues['UK-FCL-00399_0'][$key] .'  ' . @$fieldValues['UK-FCL-00400_0'][$key]. '   '  .@$fieldValues['UK-FCL-00295_0'][$key]. '  ' . @$fieldValues['UK-FCL-00401_0'][$key] .'
                        </td>
                     </tr>
                     <tr>
                        <td>&nbsp;</td>
                     
                        <td width="95%"> Occupation: '.@$fieldValues['UK-FCL-00461_0'][$key] . '
                        </td>
                     </tr>
                      ';
            }
         }
      
      ?>
</table>

