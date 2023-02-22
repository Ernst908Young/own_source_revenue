

<table style="padding-top: 10px; ">
    <tr>
    <td style="text-align:center;">     
        <span style="font-size: 13;">SOCIETIES WITH RESTRICTED LIABILITY ACT OF BARBADOS</span><br>
        <span style="font-size: 11;">(Section 23(1) and (2))</span>   <br><br>
        <span style="font-size: 14;"><strong>NOTICE OF ADDRESS</strong></span>   <br>
        <span style="font-size: 14;"><strong>OR</strong></span>   <br>
        <span style="font-size: 14;"><strong>NOTICE OF CHANGE OF ADDRESS OF REGISTERED OFFICE</strong></span>  
    </td>
     </tr>
</table>
<br><br><br>
<table style="font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>Name of Society:</strong> <br><br><span  style=""><?php  if(isset($fieldValues['UK-FCL-00197_0'])){ echo $fieldValues['UK-FCL-00197_0'];}?></span>
      </td>
    </tr><br>
    <tr>
      <td width="5%">     
        2. 
      </td>
      <td width="95%"><strong>Society Number:</strong> <br><br><span  style=""><?php  if(isset($fieldValues['UK-FCL-00360_0'])){ echo $fieldValues['UK-FCL-00360_0'];}?></span>
      </td>
    </tr><br>
    <tr>
      <td width="5%"> 
      3.        
      </td>
      <td width="95%"><strong>Address of Registered Office:</strong> <br><br><?php   
       if(isset( $fieldValues['UK-FCL-00228_0'])){
          $parish1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00228_0'])->queryRow(); 
        }else{
          $parish1 = [];
        }
    

if(isset($fieldValues['UK-FCL-00401_0'])){
      if($fieldValues['UK-FCL-00401_0']){
      //   $prases1 = Yii::app()->db->createCommand("SELECT * from bo_postalcode_in_barbados where id=".$fieldValues['UK-FCL-00346_0'])->queryRow(); 
       $pc1 = "";//$prases1['code'];
     }else{
        $pc1 = "";
     }
      
      }else{
        $pc1 = "";
      }
	  
	
      echo @$fieldValues['UK-FCL-00104_0'].' '.@$fieldValues['UK-FCL-00335_0'].' '.@$fieldValues['UK-FCL-00336_0'].' '.@$parish1['lr_name'].' '.@$fieldValues['UK-FCL-00465_0'].' '. @$pc1 ;
	 
	?>
      </td>
    </tr><br>
    <tr>
      <td width="5%"> 
      4.        
      </td>
      <td width="95%"><strong>Mailing Address:</strong><br><br><?php 
        if(isset( $fieldValues['UK-FCL-00096_0'])){
          $country1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00096_0'])->queryRow(); 
        }else{
           $country1 = [];
        }
      
     if(isset($fieldValues['UK-FCL-00129_0'])){
        if($fieldValues['UK-FCL-00129_0']==''){
 $state =[];
        }else{
           $state = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00129_0'])->queryRow(); 
        }
      
     }else{
        $state =[];
     }

     $mpc = @$fieldValues['UK-FCL-00094_0'];
if(@$fieldValues['UK-FCL-00493_0']){
  if($fieldValues['UK-FCL-00493_0']=='Yes'){
    $mpc = $pc1;
  }
}


      echo @$fieldValues['UK-FCL-00093_0'].' '.@$fieldValues['UK-FCL-00309_0'].' '.@$fieldValues['UK-FCL-00310_0'].' '. @$state['lr_name'].' '.@$country1['lr_name'].' '.$mpc ;
	
	
	  ?>        
      </td>
    </tr>
   
  
</table>

<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>
