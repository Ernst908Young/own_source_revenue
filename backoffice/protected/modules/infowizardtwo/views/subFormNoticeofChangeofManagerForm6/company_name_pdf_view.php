

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
<br>
<table style="padding-top: 10px;" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>Name of Society :</strong> <span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00193_0']; ?></span>
      </td>
    </tr>

     <tr>
      <td width="5%">  
          2.      
      </td>
      <td width="95%"><strong>Society Number :</strong> <span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00290_0']; ?></span>
      </td>
    </tr> 
     <tr>
      <td width="5%">  
          3.      
      </td>
      <td width="95%"><strong>Purpose of the Form :</strong> <span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00394_0']; ?></span>
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

   <?php if(@$fieldValues['UK-FCL-00394_0']!='Notice of Cessation of Manager(s)'){ ?>

   <tr>
    
      <td width="5%"></td>
      <td width="95%"><strong>Notice is given that on  <?= $date ?>,  the following was appointed manager </strong>
       </td>
   </tr> 
    <tr>
      <td width="5%"></td>
      <td width="95%"><table style="padding:5px;">
      <tr nobr="true">
        <td class="latabv"><strong>Name</strong></td>
        <td class="latabv"><strong>Residential Address</strong></td>
        <td class="latabv"><strong>Occupation</strong></td>
      </tr>

       <?php 
         
         if(isset($fieldValues['UK-FCL-00132_0'])){
         if(is_array($fieldValues['UK-FCL-00132_0'])){       
         foreach ($fieldValues['UK-FCL-00132_0'] as $key => $value) {  
              
        ?>
      <tr nobr="true">
        <td class="latabv"><?php echo $value .' '. @$fieldValues['UK-FCL-00105_0'][$key] .' '.@$fieldValues['UK-FCL-00324_0'][$key];?></td>
        <td class="latabv"><?php 
         echo @$fieldValues['UK-FCL-00093_0'][$key].' '.@$fieldValues['UK-FCL-00309_0'][$key].' '.@$fieldValues['UK-FCL-00310_0'][$key].' '.@$fieldValues['UK-FCL-00129_0'][$key].' '.@$fieldValues['UK-FCL-00096_0'][$key].'   '.@$fieldValues['UK-FCL-00094_0'][$key]; 
       ?></td>
        <td class="latabv"><?php echo @$fieldValues['UK-FCL-00304_0'][$key];?></td>
      </tr>
    <?php } } } ?>
      

     </table>
    </td>
    </tr> 
 

  <?php } ?>
  
<?php if(@$fieldValues['UK-FCL-00394_0']!='Notice of Appointment of Manager'){ ?>
  <tr>
      <td width="5%"></td>
      <td width="95%"><strong>Notice is given that on <?= $date ?>, the following person ceased to hold office as manager</strong> 
       </td>
  </tr> 
     <tr>
      <td width="5%"></td>
      <td width="95%"><table style="padding:5px;">
        <tr nobr="true">
        <th class="latabv" width="32%"><strong>Name</strong></th>
        <th class="latabv" width="68%"><strong>Residential Address</strong></th>
      </tr>
      

      <?php 
         
            if(isset($fieldValues['UK-FCL-00315_0'])){
                if(is_array($fieldValues['UK-FCL-00315_0'])){    
         foreach ($fieldValues['UK-FCL-00315_0'] as $key => $value) {  
              
        ?>
      <tr nobr="true">
        <td class="latabv"><?php echo $value .' '. @$fieldValues['UK-FCL-00316_0'][$key] .' '.@$fieldValues['UK-FCL-00317_0'][$key];?></td>
        <td class="latabv"><?php 
         echo @$fieldValues['UK-FCL-00104_0'][$key].' '.@$fieldValues['UK-FCL-00238_0'][$key].' '.@$fieldValues['UK-FCL-00382_0'][$key].' '.@$fieldValues['UK-FCL-00471_0'][$key].' '.@$fieldValues['UK-FCL-00320_0'][$key].' '.@$fieldValues['UK-FCL-00383_0'][$key]; 
    
   ?></td>
       
      </tr>
    <?php } } } ?>
      </table>
        
      </td>
    </tr> 

  <?php } ?>
  





  <tr>
    <td width="5%">  </td>
    <td width="95%"><strong>The managers of the Society as of this date are:</strong></td>
  </tr>

    <tr>
      <td width="5%"></td>
      <td width="95%"><table style="padding: 5px;">
      <tr nobr="true">
        <th class="latabv"><strong>Name</strong></th>
        <th class="latabv"><strong>Residential Address</strong></th>
        <th class="latabv"><strong>Occupation</strong></th>
      </tr>

      <?php 
          if(isset($fieldValues['UK-FCL-00397_0'])){
                if(is_array($fieldValues['UK-FCL-00397_0'])){    
         foreach ($fieldValues['UK-FCL-00397_0'] as $key => $value) {  
        
              
        ?>
      <tr nobr="true">
        <td class="latabv"><?php echo $value .' '. @$fieldValues['UK-FCL-00133_0'][$key] .' '.@$fieldValues['UK-FCL-00398_0'][$key];?></td>
        <td class="latabv"><?php 
         echo @$fieldValues['UK-FCL-00107_0'][$key].' '.@$fieldValues['UK-FCL-00335_0'][$key].' '.@$fieldValues['UK-FCL-00399_0'][$key].' '.@$fieldValues['UK-FCL-00400_0'][$key].' '.@$fieldValues['UK-FCL-00402_0'][$key].' '.@$fieldValues['UK-FCL-00401_0'][$key]; 
   
         ?></td>
        <td class="latabv"><?php echo @$fieldValues['UK-FCL-00137_0'][$key];?></td>
      </tr>
    <?php }}} ?>

    </table></td>
    </tr>

 <br><br><br>
 <?php if($app_status=='A'){ 
   echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>
 <br><br><br>

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


