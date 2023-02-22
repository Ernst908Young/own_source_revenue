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
        <span style="font-size: 11;">Pursuant to Section 62(1)</span>   <br>
        <span style="font-size: 14;"><strong>NOTICE OF APPOINTMENT OF SECRETARY</strong></span><br>   
        <span style="font-size: 14;"><strong>AND</strong></span>   <br>
        <span style="font-size: 12;"><strong>NOTICE OF CHANGE OF SECRETARY</strong></span>  
    </td>
     </tr>
</table>
<br><br><br>

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
$statement = '';
if(isset($fieldValues['UK-FCL-00395_0'])){
  if($fieldValues['UK-FCL-00395_0']){
    $statement = ' on '.$fieldValues['UK-FCL-00395_0'].', ';
  }
} ?>

<?php if(isset($fieldValues['UK-FCL-00012_0'])){
  if($fieldValues['UK-FCL-00012_0']!=""){
    if(@$fieldValues['UK-FCL-00012_0']!="Appointment of Secretary"){ ?>
        <!--Cession detail as shown-->
         <tr>
             <td width="5%"></td>
              <td width="95%"><strong>Notice is given that <?= $statement ?> the following person ceased to hold office as Secretary. </strong>
               </td>
            </tr> 

        <tr>
          <td width="5%"></td>
          <td width="95%"><table style="padding: 5px;">
          <tr nobr="true">
            <th class="latabv"><strong>Name</strong></th>
            <th class="latabv"><strong>Residential Address</strong></th>
          </tr>
          
          <tr nobr="true">
            <td class="latabv"><?php echo @$fieldValues['UK-FCL-00301_0'] .' '. @$fieldValues['UK-FCL-00466_0'] .' '.@$fieldValues['UK-FCL-00324_0'];?></td>
            <td class="latabv"><?php  if($show_main==true){  
                echo @$fieldValues['UK-FCL-00468_0'].' '.@$fieldValues['UK-FCL-00469_0'].' '.@$fieldValues['UK-FCL-00354_0'].' '.InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00400_0']).' '. InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00470_0']).'  '.@$fieldValues['UK-FCL-00094_0']; 
              }else{
                    echo 'XXXXX';
              }
            ?></td>
            
          </tr>

        </table></td>
        </tr> 
         <br>
  <?php  }

    if(@$fieldValues['UK-FCL-00012_0']!="Cessation of Secretary"){ ?>
      <!--appointed detail as shown-->
        <tr>
            <td width="5%"> 
            </td>
            <td width="95%"><strong>Notice is given that <?= $statement ?> the following person was appointed Secretary of the Company.</strong> <span  style="margin-top:10px;">
             </span>
             </td>     
          </tr> 
       <tr>
        <td width="5%"></td>
        <td width="95%"><table style="padding: 5px;">
          <tr nobr="true">
          <th class="latabv" ><strong>Name</strong></th>
          <th class="latabv" ><strong>Residential Address</strong></th>
          <th class="latabv" ><strong>Occupation</strong></th>
        </tr>
        
        <tr nobr="true">
          <td class="latabv"><?php echo @$fieldValues['UK-FCL-00132_0'] .' '. @$fieldValues['UK-FCL-00105_0'] .' '.@$fieldValues['UK-FCL-00317_0'];?></td>
          <td class="latabv"><?php echo @$fieldValues['UK-FCL-00352_0'].' '.@$fieldValues['UK-FCL-00309_0'].' '.@$fieldValues['UK-FCL-00310_0'].' '. InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00471_0']).' '. InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00402_0']).'  '.@$fieldValues['UK-FCL-00338_0'];?></td>
          <td class="latabv"><?php echo @$fieldValues['UK-FCL-00137_0'];?></td>
        </tr>
        </table>
        </td>
      </tr> 

   <?php }
  }
} ?>
  

<br><br><br>
<?php if($app_status=='A'){ 
   echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>
 <br><br><br>







<br><br>
<tr>
  <td width="5%"></td>
  <td width="95%"><table>
      <tr width="100%">
         <td style="text-align:center;">
            <span><strong> SIGNATORY DETAILS</strong></span>           
         </td>
      </tr>
   
       <tr width="100%">
         <td><table style="padding: 5px;">
         <tr nobr='true'>
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
