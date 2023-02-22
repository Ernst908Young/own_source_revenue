<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>

<table style="padding-top: 10px;">
    <tr>
      <td style="text-align:center;">     
        <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span><br>
        <span style="font-size: 11;">(Section 169(1) and (2))</span>   <br>
        <span style="font-size: 14;"><strong>NOTICE OF ADDRESS</strong></span><br>   
        <span style="font-size: 14;"><strong>OR</strong></span>   <br>
        <span style="font-size: 12;"><strong>NOTICE OF CHANGE OF ADDRESS OF REGISTERED OFFICE</strong></span><br><span style="font-size: 12;"><strong>Form 4</strong></span>  
    </td>
     </tr>
</table>
<br><br><br>

<table style="padding-top: 10px;" width="100%">
    <tr>
      <td width="5%">     
       1.
      </td>
      <td  width="95%"><strong>Name of Company</strong> <br><br><span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00305_0']; ?></span>
      </td>
    </tr>
     <tr>
      <td width="5%">        
      </td>
      <td width="95%"><strong>Company Number</strong><br><br><span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00403_0']; ?></span>
      </td>
    </tr>
      <tr>
      <td width="5%">     
       2.
      </td>
      <td width="95%"><strong>Purpose of Filing the Form</strong> <br><br><span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00012_0']; ?></span>
      </td>
    </tr>
     <?php if(@$fieldValues['UK-FCL-00012_0']!='Change in mailing address'){ ?>
    <tr>
      <td width="5%"> 
        
      </td>
        <td width="95%" style="text-align:justify;"><strong>Address of Registered Office.</strong><br><br><span  style="margin-top:10px;"><?php 
					
					if(isset($fieldValues['UK-FCL-00404_0'])){
            if($fieldValues['UK-FCL-00404_0']){
                $parish1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00404_0'])->queryRow(); 
            }else{
               $parish1 = [];
            }
					
					}else{
					  $parish1 = [];
					}
				

					/*if(isset($fieldValues['UK-FCL-00094_0'])){
						if($fieldValues['UK-FCL-00094_0']){
							$prases1 = Yii::app()->db->createCommand("SELECT * from bo_postalcode_in_barbados where id=".$fieldValues['UK-FCL-00094_0'])->queryRow(); 
							$pc1 = $prases1['code'];
						}else{
							$pc1 = "";
						}
					}else{
						$pc1 = "";
					}*/
					
					echo @$fieldValues['UK-FCL-00093_0'].' '.@$fieldValues['UK-FCL-00309_0'].' '.@$parish1['lr_name'].' '.$fieldValues['UK-FCL-00096_0'].'  '.@$fieldValues['UK-FCL-00094_0'];
				?>
			</span>
        </td>
    </tr>
<?php } ?>
 <?php if(@$fieldValues['UK-FCL-00012_0']!='Change in registered office address'){ ?>
    <tr>
      <td width="5%"> 
        
      </td>
        <td width="95%" style="text-align:justify;"><strong>Mailing Address.</strong><br><br><span  style="margin-top:10px;"><?php 
					if(isset($fieldValues['UK-FCL-00402_0'])){
            if($fieldValues['UK-FCL-00402_0']){
              $country1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00402_0'])->queryRow(); 
             
            }else{
               $country1 = [];
            }						
					}else{
					   $country1 = [];
					}

					if(isset($fieldValues['UK-FCL-00458_0'])){
            if($fieldValues['UK-FCL-00458_0']){
               $parish1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00458_0'])->queryRow();
             }else{
               $parish1 = [];
             }
					  
					}else{
					  $parish1 = [];
					}
				
					echo @$fieldValues['UK-FCL-00107_0'].' '.@$fieldValues['UK-FCL-00335_0'].' '.@$parish1['lr_name'].' '.@$country1['lr_name'].' '.@$fieldValues['UK-FCL-00401_0'];
				?>
			</span>
        </td>
    </tr>
     <?php } ?>

    <?php if(@$fieldValues['UK-FCL-00012_0']!='Change in mailing address'){ ?>
    <tr>
      <td width="5%"> 
     
      </td>
      <td width="95%"><strong>If change of address, give previous address of Registered Office.</strong><br><br><span  style="margin-top:10px;"><?php echo $fieldValues['UK-FCL-00104_0'].' '.$fieldValues['UK-FCL-00238_0'].' '.@$fieldValues['UK-FCL-00406_0'].' '.@$fieldValues['UK-FCL-00384_0'].'  '.$fieldValues['UK-FCL-00383_0']; ?></span>
      </td>
    </tr>
 <?php } ?>
</table>



<br><br><br>
<?php if($app_status=='A'){ 
   echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>
 <br><br><br>
<table style="border-collapse: collapse; ">
      <tr>
         <td style="text-align:center;">
            <span><strong> SIGNATORY DETAILS</strong></span>           
         </td>
      </tr>
     <br>
       <tr>
         <td>
      <table style="padding: 5px;">
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



