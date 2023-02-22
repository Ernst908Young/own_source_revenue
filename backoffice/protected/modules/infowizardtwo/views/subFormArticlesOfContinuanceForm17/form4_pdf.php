<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>

<table style="padding-top: 10px;">
    <tr>
    <td style="text-align:center;">     
        <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span><br>
        <span style="font-size: 11;">(Section 169(1) and (2))</span>   <br><br>
        <span style="font-size: 14;"><strong>NOTICE OF ADDRESS</strong></span>   <br>
        <span style="font-size: 14;"><strong>OR</strong></span>   <br>
        <span style="font-size: 14;"><strong>NOTICE OF CHANGE OF ADDRESS OF REGISTERED OFFICE</strong></span>  
    </td>
    </tr>
</table>
<br><br><br>

<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>Name of Company:</strong> <br><br><?php  if(isset($fieldValues['UK-FCL-00089_0'])){ echo $fieldValues['UK-FCL-00089_0'];}?>
      </td>
    </tr>

     <tr>
      <td width="5%">     
        2. 
      </td>
      <td width="95%"><strong>SRN Number:</strong> <br><br><?php echo $fieldValues['UK-FCL-00331_0']; ?>
      </td>
    </tr> 

    <tr>
      <td width="5%"> 
      3.        
      </td>
      <td width="95%"><strong>Address of Registered Office:</strong> <br><br><?php   
       if(isset( $fieldValues['UK-FCL-00345_0'])){
          $parish1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00345_0'])->queryRow(); 
        }else{
          $parish1 = [];
        }
    

	if(isset($fieldValues['UK-FCL-00346_0'])){
      if($fieldValues['UK-FCL-00346_0']){
      //   $prases1 = Yii::app()->db->createCommand("SELECT * from bo_postalcode_in_barbados where id=".$fieldValues['UK-FCL-00346_0'])->queryRow(); 
       $pc1 = "";//$prases1['code'];
     }else{
        $pc1 = "";
     }
      
      }else{
        $pc1 = "";
      }

       
	
      echo @$fieldValues['UK-FCL-00340_0'].' '.@$fieldValues['UK-FCL-00341_0'].' '.@$fieldValues['UK-FCL-00344_0'].' '.strtoupper(@$parish1['lr_name']).' '.strtoupper(@$fieldValues['UK-FCL-00347_0']).' '. @$pc1;
	  
	 
	  
	?>
      
       
        <br>
      </td>
    </tr>

    <tr>
      <td width="5%"> 
      4.        
      </td>
      <td width="95%"><strong>Mailing Address:</strong><br><br><?php 
        if(isset( $fieldValues['UK-FCL-00351_0'])){
          $country1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00351_0'])->queryRow(); 
        }else{
           $country1 = [];
        }
    

		$mpc = @$fieldValues['UK-FCL-00350_0'];
	if(@$fieldValues['UK-FCL-00493_0']){
		if($fieldValues['UK-FCL-00493_0']=='Yes'){
			$mpc = $pc1;
		}
	}

	
      echo @$fieldValues['UK-FCL-00342_0'].' '.@$fieldValues['UK-FCL-00343_0'].' '.@$fieldValues['UK-FCL-00348_0'].' '.strtoupper(InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00349_0'])).' '.strtoupper(@$country1['lr_name']).' '.$mpc;
	
	  
	  ?>        
      </td>
    </tr>

  
<br><br>

</table>



