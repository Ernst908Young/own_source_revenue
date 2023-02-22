<?php 
$show_main = true;
if(isset($_GET['is_vpd'])){
  if($_GET['is_vpd']=='yes'){
    $show_main = false;
  }
} ?>
<?php 

  // echo '<pre>';
  // print_r($fieldValues);
  // die;

 ?>

<table style="padding-top: 10px;">
    <tr>
      <td style="text-align:center;">     
        <span style="font-size: 13;">SOCIETIES WITH RESTRICTED LIABILITY ACT OF BARBADOS</span><br>
        <!-- <span style="font-size: 11;">(Section 5)</span>   <br> -->
        <span style="font-size: 14;"><strong>Regn. of Limited Partnership</strong></span>   <br>  
    </td>
     </tr>
</table>
<br><br><br>

<table style="padding-top: 10px;" width="100%">
    <tr>
      <td width="5%">     
       1.
      </td>
      <td  width="95%"><strong>Proposed Firm Name</strong> <br><br><span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00268_0'])){ echo $fieldValues['UK-FCL-00268_0'];}?></span>
      </td>
    </tr>
     <tr>
      <td width="5%">        
      </td>
      <td width="95%"><strong>General Nature of business of Firm</strong><br><br><span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00269_0'])){ echo $fieldValues['UK-FCL-00269_0'];}?></span>
      </td>
    </tr>
    <tr>
      <td width="5%"> 
      2.   
      </td>
      <td width="95%" style="text-align:justify;"><strong>Address</strong><br><br><span  style="margin-top:10px;"> <?php   
       if(isset( $fieldValues['UK-FCL-00404_0'])){
          $parish1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00404_0'])->queryRow(); 
        }else{
          $parish1 = [];
        }
    

if(isset($fieldValues['UK-FCL-00094_0'])){
      if($fieldValues['UK-FCL-00094_0']){
         $prases1 = Yii::app()->db->createCommand("SELECT * from bo_postalcode_in_barbados where id=".$fieldValues['UK-FCL-00094_0'])->queryRow(); 
       $pc1 = $prases1['code'];
     }else{
        $pc1 = "";
     }
      
      }else{
        $pc1 = "";
      }

       

      echo @$fieldValues['UK-FCL-00107_0'].' '.@$fieldValues['UK-FCL-00309_0'].' '.@$fieldValues['UK-FCL-00310_0'].' '.@$parish1['lr_name'].' '.@$fieldValues['UK-FCL-00096_0'].' '. @$pc1; ?></span>
      </td>
    </tr>
    <tr>
      <td width="5%"> 
      3.
      </td>
      <td width="95%"><strong>Whether the firm will carry on the business of Banking</strong><br><br><span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00270_0'])){ echo $fieldValues['UK-FCL-00270_0'];}?></span>
      </td>
    </tr>
    <tr>
      <td width="5%"> 
     4.
      </td>
      <td width="95%"><strong>Term of Partnership (if any)</strong><br><br><span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00277_0'])){ echo $fieldValues['UK-FCL-00277_0'];}?></span>
      </td>
    </tr>
    
    <tr>
      <td width="5%">    
     5.
      </td>
      <td width="95%"><strong>Date of commencement of Partnership firm</strong><br><br><span  width="100%" style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00278_0'])){ echo @$fieldValues['UK-FCL-00278_0'];}?></span>
      </td>
    </tr>
    <tr>
      <td width="5%">
     6.   
      </td>
    
      <td width="95%"><strong>Whether the Partnership firm is Limited.</strong><br><br><span  width="100%" style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00270_0'])){ echo @$fieldValues['UK-FCL-00270_0'];}?></span>
      </td>
	
      </tr>
</table>
<br><br>
<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>

<table>
  <tr>
    <td width="5%"></td>
    <td width="95%">
            <table style="border-collapse: collapse; padding: 5px;">
        <tr nobr="true">
          <th class="latabv"><strong>Partner Name</strong></th>
          <th class="latabv"><strong>Partner Address</strong></th>
          <th class="latabv"><strong>Type of Partner</strong></th>
          <th class="latabv"><strong>Partner Description</strong></th>
        </tr>
        <?php  if(isset($fieldValues['UK-FCL-00301_0'])){ 
		if(is_array($fieldValues['UK-FCL-00301_0'])){
		?>
        <?php foreach ($fieldValues['UK-FCL-00301_0'] as $key => $value) {
        	
         ?>
        <tr nobr="true">
          <td class="latabv"><?php echo $value;?></td>
          <td class="latabv"><?php    if($show_main==true){  echo @$fieldValues['UK-FCL-00093_0'][$key] . ' ' . @$fieldValues['UK-FCL-00335_0'][$key] . ' ' . @$fieldValues['UK-FCL-00399_0'][$key]  .' ' . @$fieldValues['UK-FCL-00372_0'][$key].' ' . @$fieldValues['UK-FCL-00320_0'][$key] .' ' . @$fieldValues['UK-FCL-00460_0'][$key]; 
          }else{
            echo 'XXXXX';
          } ?></td>
          <td class="latabv"><?php echo @$fieldValues['UK-FCL-00274_0'][$key];?></td>
          <td class="latabv"><?php echo @$fieldValues['UK-FCL-00275_0'][$key];?></td>
        </tr>
		<?php }} } ?>
      </table>
    </td>
  </tr>
  <br><br><br>
  <?php if($app_status=='A'){ 
   echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>
 <br><bsr><br>
  <tr>
    <td width="5%"></td>
    <td width="95%"><table style="border-collapse: collapse; ">
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
</table></td>
  </tr>
</table>




