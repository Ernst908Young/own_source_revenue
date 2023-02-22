
<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>
<table style="padding-top: 10px;">
    <tr>
      <td style="text-align:center;">     
        <span style="font-size: 14;"><strong>BUSINESS NAMES RULES, 1940</strong></span><br><br>
        <span style="font-size: 11;">FORM 3</span><br><br>
        <span style="font-size: 11;"><strong>STATEMENT GIVING NOTICE OF CHANGES</strong></span><br>
    </td>
     </tr>
</table>
<br><br><br>

<table style="padding-top: 10px;" width="100%">
     <tr>
      <td width="5%">        
      </td>
      <td width="95%">To the Registrar,<br><span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00430_0']; ?> hereby give you notice in accordance of the following Changes in the firm of in respect of the <?php echo @$fieldValues['UK-FCL-00488_0']; ?> carrying on business in the name of<br><?php echo @$fieldValues['UK-FCL-00489_0']; ?><br>which is required to be registered under Section 8 of The Registration of Business Names Act, Cap. 317.</span>
      </td>
    </tr>

    <tr>
      <td width="5%">        
      </td>
      <td width="95%"><b>Type of change</b>
        <br><br><?php 
        $typeodchange = [];
        if(isset($fieldValues['UK-FCL-00416_0'])){
          if(is_array($fieldValues['UK-FCL-00416_0'])){
            if(!empty($fieldValues['UK-FCL-00416_0'])){
              $typeodchange = $fieldValues['UK-FCL-00416_0'];
              foreach ($typeodchange as $key => $value) {
                 echo '- '.$value.'<br>';
              }
             
            }
          }
        } ?>
      </td>
    </tr>

<!--- 1 step---->
 <?php if(in_array('Change of name of firm', $typeodchange)){ ?>
    <tr>
      <td width="5%">        
      </td>
      <td width="95%"><strong>Change of Name of Firm:</strong><br><span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00418_0']; ?></span>
      </td>
    </tr><br>
  <?php }?>
   
  <!--- 2 step---->
<?php if(in_array('Change of persons with names in full of new individuals', $typeodchange)){ ?>
   <tr>
          <td width="5%">        
          </td>
           <td width="95%"><strong>Change of persons with names in full of new individuals:</strong><br><br>
            <table style="text-align: center; padding: 5px;">
              <tr nobr="true">
                 <td class="latabv"><strong>Sr. No.</strong></td>
                 <td class="latabv"><strong>Full Name</strong></td>
                 <td class="latabv"><strong>Address</strong></td>
              </tr>
   <?php if(isset($fieldValues['UK-FCL-00301_0'])){
    if(is_array($fieldValues['UK-FCL-00301_0'])){
      if(sizeof($fieldValues['UK-FCL-00301_0'])>0){ 
       foreach($fieldValues['UK-FCL-00301_0'] as $k=>$val){ ?>
              <tr nobr="true">
                 <td class="latabv"><?= $k+1 ?></td>
                 <td class="latabv"><?= $val.' '.@$fieldValues['UK-FCL-00105_0'][$k].' '.@$fieldValues['UK-FCL-00106_0'][$k] ?></td>
                 <td class="latabv"><?php   echo @$fieldValues['UK-FCL-00093_0'][$k].' '.@$fieldValues['UK-FCL-00309_0'][$k].' '.@$fieldValues['UK-FCL-00404_0'][$k].' '.@$fieldValues['UK-FCL-00096_0'][$k].' '.@$fieldValues['UK-FCL-00094_0'][$k]; 
                 
                 ?></td>
              </tr>
            <?php } } } } ?>
           </table>
          </td>
        </tr>
   <?php  } ?>

<!--- 3 step---->
<?php if(in_array('Change of the name of persons who own the firm or business', $typeodchange)){ ?>
  <tr>
    <td width="5%">        
    </td>
    <td width="95%"><strong>Change of the name of persons who own the firm or business:</strong><br><br>
      <table style="text-align: center; padding: 5px;">
        <tr nobr="true">
           <td class="latabv"><strong>Sr. No.</strong></td>
           <td class="latabv"><strong>Full Name</strong></td>
           <td class="latabv"><strong>Address</strong></td>
        </tr>
    <?php if(isset($fieldValues['UK-FCL-00315_0'])){
    if(is_array($fieldValues['UK-FCL-00315_0'])){
     
       foreach($fieldValues['UK-FCL-00315_0'] as $k=>$val){?>
              <tr nobr="true">
                 <td class="latabv"><?= $k+1 ?></td>
                 <td class="latabv"><?= $val.' '.@$fieldValues['UK-FCL-00133_0'][$k].' '.@$fieldValues['UK-FCL-00419_0'][$k] ?></td>
                 <td class="latabv"><?php 
                 echo  @$fieldValues['UK-FCL-00104_0'][$k].' '.@$fieldValues['UK-FCL-00238_0'][$k].' '.@$fieldValues['UK-FCL-00405_0'][$k].' '.@$fieldValues['UK-FCL-00384_0'][$k] .' '.@$fieldValues['UK-FCL-00383_0'][$k]; 
              ?></td>
              </tr>
            <?php } } } ?>
          </table>
          </td>
        </tr>
   <?php }  ?>
  
  <!--- 4 step----> 
 <?php if(in_array('Change in Partner details where partner is a company', $typeodchange)){ ?>
   <tr>
          <td width="5%">        
          </td>
          <td width="95%"><strong>Change in Change in Partner details where partner is a company:</strong><br><br>
            <table style="text-align: center; padding: 5px;">
              <tr nobr="true">
                 <td class="latabv"><strong>Sr. No.</strong></td>
                 <td class="latabv"><strong>Company Number</strong></td>
                   <td class="latabv"><strong>Company Name</strong></td>
                 <td class="latabv"><strong>Address</strong></td>
                  <td class="latabv"><strong>Type of Change</strong></td>
              </tr>

<?php if(isset($fieldValues['UK-FCL-00420_0'])){
    if(is_array($fieldValues['UK-FCL-00420_0'])){
      if(sizeof($fieldValues['UK-FCL-00420_0'])>0){ 
       foreach($fieldValues['UK-FCL-00420_0'] as $k=>$val){?>
              <tr nobr="true">
                 <td class="latabv"><?= $k+1 ?></td>
                 <td class="latabv"><?= $val ?></td>
                 <td class="latabv"><?= @$fieldValues['UK-FCL-00084_0'][$k] ?></td>
                  <td class="latabv"><?= @$fieldValues['UK-FCL-00421_0'][$k] ?></td>
                   <td class="latabv"><?= @$fieldValues['UK-FCL-00422_0'][$k] ?></td>
              </tr>
            <?php } } } } ?>
           </table>
          </td>
        </tr>
   <?php  } ?>


     <!--- 5 step----> 
 <?php if(in_array('Nationality of persons who own firm or business', $typeodchange)){ ?>
   <tr>
          <td width="5%">        
          </td>
          <td width="95%"><strong>Change in Nationality of persons who own firm or business:</strong><br><br>
            <table style="text-align: center; padding: 5px;">
              <tr nobr="true">
                 <td class="latabv"><strong>Sr. No.</strong></td>
                <td class="latabv"><strong>Full Name</strong></td>
                 <td class="latabv"><strong>  Present Nationality</strong></td>
                  <td class="latabv"><strong>Nationality of origin</strong></td>
              </tr>

    <?php if(isset($fieldValues['UK-FCL-00397_0'])){
    if(is_array($fieldValues['UK-FCL-00397_0'])){
      if(sizeof($fieldValues['UK-FCL-00397_0'])>0){ 
       foreach($fieldValues['UK-FCL-00397_0'] as $k=>$val){?>
              <tr nobr="true">
                 <td class="latabv"><?= $k+1 ?></td>
                 <td class="latabv"><?= $val.' '.@$fieldValues['UK-FCL-00316_0'][$k].' '.@$fieldValues['UK-FCL-00423_0'][$k] ?></td>
                 <td class="latabv"><?= @$fieldValues['UK-FCL-00424_0'][$k] ?></td>
                  <td class="latabv"><?= @$fieldValues['UK-FCL-00425_0'][$k] ?></td>
              
              </tr>
            <?php } } } } ?>
           </table>
          </td>
        </tr>
   <?php }  ?>
 
     <!--- 6 step----> 
 <?php if(in_array('Change of place of business', $typeodchange)){ ?>

  

    <tr>
      <td width="5%">        
      </td><?php 

      if(isset($fieldValues['UK-FCL-00295_0'])){
     if($fieldValues['UK-FCL-00295_0']){
       $country2 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00295_0'])->queryRow(); 
       $c2 = $country2['lr_name'];
      }else{
        $c2 = "";
      }
  }else{
     $c2 = "";
  }


  if(isset($fieldValues['UK-FCL-00129_0'])){
     if($fieldValues['UK-FCL-00129_0']){
       $pos = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00129_0'])->queryRow(); 
       $p2 = $pos['lr_name'];
      }else{
        $p2 = "";
      }
  }else{
     $p2 = "";
  }
                 
      ?>
      <td width="95%"><br><strong>Change of place of business:</strong><br><br> <?= @$fieldValues['UK-FCL-00169_0'].' '.@$fieldValues['UK-FCL-00353_0'].' '.@$fieldValues['UK-FCL-00310_0'].' '. $p2.' '.$c2. @$fieldValues['UK-FCL-00242_0'];?>
      </td>
    </tr><br>
  <?php } ?>


  <!--- 7 step----> 
 <?php if(in_array('Change of registered office', $typeodchange)){ ?>
    <tr>
      <td width="5%">        
      </td><?php 
  if(isset($fieldValues['UK-FCL-00406_0'])){
     if($fieldValues['UK-FCL-00406_0']){
       $country2 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00406_0'])->queryRow(); 
       $p2 = $country2['lr_name'];
      }else{
        $p2 = "";
      }
  }else{
     $p2 = "";
  }
                 
      ?>
      <td width="95%"><br><strong>Change of registered office:</strong><br><br><?= @$fieldValues['UK-FCL-00107_0'].' '.@$fieldValues['UK-FCL-00335_0'].' '. $p2.' Barbados '. @$fieldValues['UK-FCL-00401_0'];?>
      </td>
    </tr><br>
  <?php } ?>


<!--- 8 step----> 
 <?php if(in_array('Change of nature of business', $typeodchange)){ ?>
    <tr>
      <td width="5%">        
      </td>
     
      <td width="95%"><br><strong>Change of Nature of Business:</strong><br><br>Business Activity: 
          <?php $ba = '';
          if(is_array($fieldValues['UK-FCL-00426_0'])){
            foreach ($fieldValues['UK-FCL-00426_0'] as $key => $val) {
              $bad = Yii::app()->db->createCommand("SELECT * FROM bo_business_industry_list WHERE id=$val")->queryRow();
              $ba_arr[] = $bad['name'];
            }     
             $ba = implode(',', $ba_arr);     
          }

          
            echo $ba.'<br>';
           ?><?= 'Nature/description of busines: '.@$fieldValues['UK-FCL-00427_0'].'<br>Type of Change: '.@$fieldValues['UK-FCL-00428_0'] ?>
      </td>
    </tr><br>
  <?php } ?>

  <!--- 9 step----> 
 <?php if(in_array('Any other change', $typeodchange)){ ?>
    <tr>
      <td width="5%">        
      </td>    
      <td width="95%"><strong>Any other change:</strong>
        <br><br><?= @$fieldValues['UK-FCL-00429_0'] ?>
  </td>
    </tr><br>
  <?php } ?>
<br><br><br>
<?php if($app_status=='A'){ 
   echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>

 <br><br><br>

 <tr>
      <td width="5%"></td>
      <td width="95%"><table style="border-collapse: collapse; ">
      <tr>
         <td style="text-align:center;">
            <strong> SIGNATORY DETAILS</strong>   
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
</table></td>
 </tr>

  



</table>




