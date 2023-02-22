<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>
<table style="padding-top: 10px;">
    <tr>
    <td style="text-align:center;">     
        <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span><br>  
        <span style="font-size: 12;">(Section 343)</span><br>   
          <span style="font-size: 13;">EXTERNAL COMPANY</span><br>   <br>   
         <span style="font-size: 14;"><strong>APPLICATION FOR REGISTRATION</strong></span>   <br><br>
     
    </td>
     </tr>
</table>
<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>Name of Company </strong><?php  if(isset($fieldValues['UK-FCL-00211_0'])){ echo $fieldValues['UK-FCL-00211_0'];}?>        
      </td>
    </tr>
   
     <tr>
      <td width="5%">     
        2. 
      </td>
      <td width="95%"><strong>Address of Registered or Head Office </strong><br><br><?php   
      $country1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00347_0'])->queryRow(); 

       $state = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00385_0'])->queryRow(); 

      echo $fieldValues['UK-FCL-00340_0'].' '.$fieldValues['UK-FCL-00341_0'].' '.$fieldValues['UK-FCL-00344_0'].' '.$fieldValues['UK-FCL-00346_0'].' '. $state['lr_name'].' '.$country1['lr_name'] ;        
      ?>        
      </td>
    </tr>
    <?php if($fieldValues['UK-FCL-00352_0']){ ?>
    <tr>
      <td width="5%">     
        3. 
      </td>
      <td width="95%"><strong>Address of principal office, if any, in Barbados </strong><br><br><?php   
     
      if($fieldValues['UK-FCL-00355_0']){

       $country2 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00355_0'])->queryRow(); 
       $c2 = $country2['lr_name'];
      }else{
        $c2 = "";
      }
      if($fieldValues['UK-FCL-00356_0']){

       $prases2 = Yii::app()->db->createCommand("SELECT * from bo_postalcode_in_barbados where id=".$fieldValues['UK-FCL-00356_0'])->queryRow(); 
       $pc2 = $prases2['code'];
      }else{
        $pc2 = "";
      }

      echo @$fieldValues['UK-FCL-00352_0'].' '.@$fieldValues['UK-FCL-00353_0'].' '.@$fieldValues['UK-FCL-00355_0'].' '. @$pc2.' '.@$c2.' '.@$fieldValues['UK-FCL-00357_0'] ;        
      ?>                   
      </td>
    </tr>
    <?php } ?> 
   <tr>
      <td width="5%">     
        4. 
      </td>
      <td width="95%"><strong> Corporate Structure: </strong><br><table style="padding-top:10px; font-size: 12;" width="100%">
          <tr>
            <td width="5%">a)</td>
            <td width="95%"><strong>Jurisdiction in which incorporated: </strong><?= @$fieldValues['UK-FCL-00217_0'] ?>        
            </td>
          </tr>
          <tr>
            <td width="5%">b)</td>
            <td width="95%"><strong>Date and manner of incorporation: </strong><?= @$fieldValues['UK-FCL-00218_0'].' '.@$fieldValues['UK-FCL-00219_0'] ?>        
            </td>
          </tr>
          <tr>
            <td width="5%">c)</td>
            <td width="95%"><strong>Period fixed for duration of Company: </strong><?= @$fieldValues['UK-FCL-00220_0'] ?>        
            </td>
          </tr>
          <tr>
            <td width="5%">d)</td>
            <td width="95%"><strong>Extent to which liability of shareholders is limited: </strong><?= @$fieldValues['UK-FCL-00221_0'] ?>        
            </td>
          </tr>
        </table>

      </td>
    </tr><br>
     <tr>
      <td width="5%">     
        5. 
      </td>
      <td width="95%"><strong>Share Capital</strong></td>
    </tr>
    <tr>
      <td colspan="2" width="100%"><br><br><table style="text-align: center; padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse; padding: 5px;">
        <tr>
          <td rowspan="2" class="latabv"><strong>Class of Shares</strong></td>
          <td rowspan="2" class="latabv"><strong>Number issued and outstanding</strong></td>
          <td rowspan="2" class="latabv"><strong>Authorised capital</strong></td>
          <td colspan="2" class="latabv"><strong>Purchased by Company</strong></td>
          <td colspan="2" class="latabv"><strong>Redeemed by Company</strong></td>         
        </tr>
        <tr>
          <td class="latabv"><strong>In last financial period</strong></td>
          <td class="latabv"><strong>Cumulative Total</strong></td>
          <td class="latabv"><strong>In last financial period</strong></td>
          <td class="latabv"><strong>Cumulative Total</strong></td>
        </tr>
        
        <?php 
     
               $arrayFields = array_unique($fieldValues['UK-FCL-00248_0']);

              if(isset($arrayFields)){
                   
               foreach ($arrayFields as $key => $value) {  
                    
              ?>
            <tr>
              <td class="latabv"><?php echo @$value ?></td>
              <td class="latabv"><?php echo @$fieldValues['UK-FCL-00249_0'][$key];?></td>
              <td class="latabv"><?php echo @$fieldValues['UK-FCL-00250_0'][$key];?></td>
              <td class="latabv"><?php echo @$fieldValues['UK-FCL-00256_0'][$key];?></td>
              <td class="latabv"><?php echo @$fieldValues['UK-FCL-00257_0'][$key];?></td>
              <td class="latabv"><?php echo @$fieldValues['UK-FCL-00258_0'][$key];?></td>
              <td class="latabv"><?php echo @$fieldValues['UK-FCL-00259_0'][$key];?></td>
            </tr>
          <?php } } ?>
      </table>       
    </td>
    </tr><br>
     <tr>
      <td width="5%">     
        6. 
      </td>
      <td width="95%">
        <strong>Main Business Activity Description</strong><br><br><?php foreach($fieldValues['UK-FCL-00222_0'] as $k=>$va){
          $bc = Yii::app()->db->createCommand("SELECT * FROM bo_business_industry_list WHERE id=$va")->queryRow();
          echo '- '.  $bc['name'].'<br>';
        }?>
      </td>
    </tr>
     <tr>

      <td width="5%">     
        7. 
      </td>
      <td width="95%"><strong>Main type of business carried on and the date on which the Company intends to commence any of its operations in Barbados: </strong><br><br><?php echo $fieldValues['UK-FCL-00223_0'];
        if($fieldValues['UK-FCL-00366_0']=='Select Date'){
          echo $fieldValues['UK-FCL-00253_0'];
        }else{
          echo $fieldValues['UK-FCL-00366_0'];
        }
               ?>        
      </td>
    </tr>
    <tr>
      <td width="5%">     
        8. 
      </td>
      <td width="95%"><strong>The Directors of the Company are:</strong></td>
    </tr>
    <tr>
      <td colspan="2" width="100%"><br><br><table style="text-align: center; padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse; padding: 5px;">
          <tr>
            <th class="latabv"><strong>Full Name</strong></th>
            <th class="latabv"><strong>Residential Address</strong></th>
            <th class="latabv"><strong>Occupation</strong></th>
          </tr>
           <?php 
     
               $arrayFields = array_unique($fieldValues['UK-FCL-00132_0']);
                   
               foreach ($arrayFields as $key => $value) {  
                    
              ?>
            <tr>
              <td class="latabv"><?php echo $value .' '. $fieldValues['UK-FCL-00133_0'][$key] .' '.$fieldValues['UK-FCL-00134_0'][$key];?></td>
              <td class="latabv">
                <?php echo $fieldValues['UK-FCL-00093_0'][$key].' '.$fieldValues['UK-FCL-00309_0'][$key].' '.$fieldValues['UK-FCL-00310_0'][$key].' '.$fieldValues['UK-FCL-00094_0'][$key].' '.$fieldValues['UK-FCL-00372_0'][$key].' '.$fieldValues['UK-FCL-00096_0'][$key];?>
                  
                </td>

              <td class="latabv"><?php echo $fieldValues['UK-FCL-00137_0'][$key];?></td>
            </tr>
          <?php } ?>
      </table>
    </td>
  </tr><br>
   <tr>
      <td width="5%">     
        9. 
      </td>
      <td width="95%"><strong> Documents attached are: </strong><br><table style="padding-top:10px; font-size: 12;" width="100%">
          <tr>
            <td width="5%">a)</td>
            <td width="90%"><strong>Verified copy of corporate instruments defining constitution of company </strong>
            </td>
            <td>
              <table width="100%">
                <tr>
                  <td class="latabv" width="10%"></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td width="5%">b)</td>
            <td width="90%"><strong>Power of Attorney in accordance with Section 332 </strong>
            </td>
            <td>
              <table width="100%">
                <tr>
                  <td class="latabv" width="10%"></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td width="5%">c)</td>
            <td width="90%"><strong>Statutory declaration by Directors </strong>
            </td>
            <td>
              <table width="100%">
                <tr>
                  <td class="latabv" width="10%"></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td width="5%">d)</td>
            <td width="90%"><strong>Statutory declaration by Attorney-at-Law. </strong>
            </td>
            <td>
              <table width="100%">
                <tr>
                  <td class="latabv" width="10%"></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>

      </td>
    </tr><br><br><br><br>
    <tr>
      <td width="5%"></td>
      <td width="95%"><table  style="padding-top: 10px; font-size: 12; " width="100%">
          <tr>
            <td>Date :</td>
            <td>Electronically signed</td>
            <td>Title:</td>
          </tr>
        </table></td>
    </tr>
</table>





