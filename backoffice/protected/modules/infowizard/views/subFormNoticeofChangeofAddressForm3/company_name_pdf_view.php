
<?php 
   
   // echo '<pre>';
   // print_r($fieldValues);
   // die;

 ?>

<table style="padding-top: 10px;">
    <tr>
      <td style="text-align:center;">     
        <span style="font-size: 13;">SOCIETIES WITH RESTRICTED LIABILITY ACT OF BARBADOS</span><br>
        <span style="font-size: 11;">(Section 23(1) and (2))</span>   <br>
        <span style="font-size: 14;"><strong>NOTICE OF ADDRESS</strong></span><br>   
        <span style="font-size: 14;"><strong>OR</strong></span>   <br>
        <span style="font-size: 12;"><strong>NOTICE OF CHANGE OF ADDRESS OF REGISTERED OFFICE</strong></span>  
    </td>
     </tr>
</table>
<br><br><br>

<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
       1.
      </td>
      <td  width="95%"><strong>Name of Society</strong> <br><br><span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00193_0']; ?></span>
      </td>
    </tr>
     <tr>
      <td width="5%">        
      </td>
      <td width="95%"><strong>Society Number</strong><br><br><span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00290_0']; ?></span>
      </td>
    </tr>
    <tr>
      <td width="5%"> 
      2.   
      </td>
        <td width="95%" style="text-align:justify;"><strong>Address of Registered Office.</strong><br><br>
			<span  style="margin-top:10px;">
				
			
				<?php 
					
					if(isset($fieldValues['UK-FCL-00404_0'])){
            if($fieldValues['UK-FCL-00404_0']){
               $parish1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00404_0'])->queryRow(); 
            }else{
               $parish1 = [];
            }
					 
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
					
					echo @$fieldValues['UK-FCL-00093_0'].' '.@$fieldValues['UK-FCL-00309_0'].' '.@$parish1['lr_name'].' '.@$pc1.' '.@$fieldValues['UK-FCL-00096_0'];
				?>
			</span>
        </td>
    </tr>

    <tr>
      <td width="5%"> 
      3.   
      </td>
        <td width="95%" style="text-align:justify;"><strong>Mailing Address.</strong><br><br>
			<span  style="margin-top:10px;">
				
			
				<?php 
					if(isset( $fieldValues['UK-FCL-00402_0'])){
						$country1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00402_0'])->queryRow(); 
						$country = $country1['lr_name'];
					}else{
					   $country = [];
					}
					if(isset( $fieldValues['UK-FCL-00372_0'])){
					  $parish1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00372_0'])->queryRow(); 
					}else{
					  $parish1 = [];
					}
				
					echo @$fieldValues['UK-FCL-00107_0'].' '.@$fieldValues['UK-FCL-00335_0'].' '.@$parish1['lr_name'].' '.@$fieldValues['UK-FCL-00401_0'].' '.$country;
				?>
			
			</span>
        </td>
    </tr>
    
    <tr>
      <td width="5%"> 
     4.
      </td>
      <td width="95%"><strong>If change of address, give previous address of Registered Office.</strong><br><br>
		<span  style="margin-top:10px;">
			<?php echo @$fieldValues['UK-FCL-00104_0'].' '.@$fieldValues['UK-FCL-00238_0'].' '.@$fieldValues['UK-FCL-00406_0'].' '.@$fieldValues['UK-FCL-00383_0'].' '.@$fieldValues['UK-FCL-00384_0']; ?>
		</span>
      </td>
    </tr>

</table>


<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>
<br><br><br>
<table>
  <tr>
    <td width="5%"></td>
    <td width="95%">
            <table style="padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse; padding: 5px;">
        <tr>
          <th class="latabv"><strong>Date</strong></th>
          <th class="latabv"><strong>Signature</strong></th>
          <th class="latabv"><strong>Title</strong></th>
        </tr>
        <tr>
          <td class="latabv"><?php echo date('d/m/y'); ?></td>
          <td class="latabv">Electronically signed</td>
          <td class="latabv"></td>
        </tr>
      </table>
    </td>
  </tr>
</table>



