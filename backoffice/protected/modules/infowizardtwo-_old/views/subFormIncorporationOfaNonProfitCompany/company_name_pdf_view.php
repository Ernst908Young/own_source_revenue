<table style="padding-top: 10px;">
    <tr>
      <td style="text-align:center;">     
        <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span><br>
        <span style="font-size: 11;">(Section 5 and 315)</span>   <br>
        <span style="font-size: 14;"><strong>ARTICLES OF INCORPORATION</strong></span>   <br>
        <span style="font-size: 14;"><strong>NON-PROFIT COMPANY (Form 2)</strong></span>  
    </td>
     </tr>
</table>
<br><br><br>

<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
       1.
      </td>
      <td  width="95%"><strong>Name of Company</strong> <br><br><span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00090_0'])){ echo $fieldValues['UK-FCL-00090_0'];}?></span>
      </td>
    </tr>
     <!-- <tr>
      <td width="5%">        
      </td>
      <td width="95%"><strong>Company Number</strong><br><br><span  style="margin-top:10px;"><?php //echo $fieldValues['UK-FCL-00088_0']; ?></span>
      </td>
    </tr> -->
    <tr>
      <td width="5%"> 
      2.   
      </td>
      <td width="95%" style="text-align:justify;"><strong>The company has no authorized share capital, is to be carried on without pecuniary gain to its members, and anyprofits or other accretions to the assets of the Company are to be used in furthering its undertaking.
      </strong><br><br><span  style="margin-top:10px;">Yes</span>
      </td>
    </tr>
    <tr>
      <td width="5%"> 
      3.
      </td>
      <td width="95%"><strong>Restrictions on the undertaking that the Company may carry on:</strong><br><br><span  style="margin-top:10px;"><?php if(isset($fieldValues['UK-FCL-00091_0'])){echo $fieldValues['UK-FCL-00091_0'];} ?></span>
      </td>
    </tr>
    <tr>
      <td width="5%"> 
     4.
      </td>
      <td width="95%"><strong>Number (or minimum and maximum number) of Directors</strong><br><br><?= @$fieldValues['UK-FCL-00240_0'] == 'Fixed Number' ? ("Number of Directors are : ".@$fieldValues['UK-FCL-00100_0']) : (" Minimum : ".@$fieldValues['UK-FCL-00119_0'].", Maximum : ".@$fieldValues['UK-FCL-00120_0']) ?>

      </td>
    </tr>
    <tr>
      <td width="5%">  
     5. 
      </td>
      <td width="95%"><strong>The address of the principal office or premises of the Company is:</strong><br><br><span  style="margin-top:10px;"> <?php   
       if(isset( $fieldValues['UK-FCL-00405_0'])){
          $parish1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00405_0'])->queryRow(); 
        }else{
          $parish1 = [];
        }
    

if(isset($fieldValues['UK-FCL-00242_0'])){
      if($fieldValues['UK-FCL-00242_0']){
         $prases1 = Yii::app()->db->createCommand("SELECT * from bo_postalcode_in_barbados where id=".$fieldValues['UK-FCL-00242_0'])->queryRow(); 
       $pc1 = $prases1['code'];
     }else{
        $pc1 = "";
     }
      
      }else{
        $pc1 = "";
      }

       

      echo @$fieldValues['UK-FCL-00093_0'].' '.@$fieldValues['UK-FCL-00309_0'].' '.@$fieldValues['UK-FCL-00310_0'].' '. @$pc1.' '.@$parish1['lr_name'].' '.@$fieldValues['UK-FCL-00096_0'] ; ?></span>
      </td>
    </tr>
    <tr>
      <td width="5%">    
     6.
      </td>
      <td width="95%"><strong>Other provisions, if any</strong><br><br><span  width="100%" style="margin-top:10px;"><?php if(isset($fieldValues['UK-FCL-00233_0'])){
          if(!empty($fieldValues['UK-FCL-00233_0'])){
            foreach ($fieldValues['UK-FCL-00233_0'] as $key => $value) {
              echo $value.'<br><br>';
            }
          }
        } ?>
        <?php if(isset($fieldValues['UK-FCL-00494_0'])){echo $fieldValues['UK-FCL-00494_0'];} ?>
          
        </span>
      </td>
    </tr>
    <tr>
      <td width="5%">
     7.   
      </td>
      <td width="95%"><strong>The first Directors, each of whom shall become a member of the Company, are:</strong><!-- <br>Date:</strong><span  style="margin-top:10px;"><1?php echo date('d/m/y');?></span> --><br>
      </td>
    </tr>

</table>

<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>

<table>
  <tr>
    <td width="5%"></td>
    <td width="95%">
            <table style="padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse; padding: 5px;">
        <tr>
          <th class="latabv"><strong>Name</strong></th>
          <th class="latabv"><strong>Address</strong></th>
          <th class="latabv"><strong>Signature</strong></th>
        </tr>
        <?php 
           
        
        if(is_array($fieldValues['UK-FCL-00150_0'])){
                 $faltu = count($fieldValues['UK-FCL-00150_0'])/2;
                  for ($key = 0; $key < $faltu; $key++) {
       
                
          ?>
        <tr>
          <td class="latabv"><?php echo @$fieldValues['UK-FCL-00150_0'][$key] .' '. @$fieldValues['UK-FCL-00133_0'][$key] .' '.@$fieldValues['UK-FCL-00134_0'][$key];?></td>
          <td class="latabv"><?php echo @$fieldValues['UK-FCL-00107_0'][$key].' '.@$fieldValues['UK-FCL-00390_0'][$key].' '.@$fieldValues['UK-FCL-00463_0'][$key].' '.@$fieldValues['UK-FCL-00383_0'][$key].' '.@$fieldValues['UK-FCL-00400_0'][$key].' '.$fieldValues['UK-FCL-00320_0'][$key];?>  </td>
          <td class="latabv">Electronically signed</td>
        </tr>
      <?php }} ?>
      </table>
    </td>
  </tr>
</table>



