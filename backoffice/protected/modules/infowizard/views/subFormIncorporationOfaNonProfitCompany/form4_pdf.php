<?php 

  // echo '<pre>';
  // print_r($fieldValues);
  // die;

 ?>
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
      <td width="95%"><strong>Name of Company :</strong> <br><br><span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00090_0'])){ echo $fieldValues['UK-FCL-00090_0'];}?></span>
      </td>
    </tr>

    <!-- <tr>
      <td width="5%">     
        2. 
      </td>
      <td width="95%"><strong>Company Number :</strong> <br><br><span  style="margin-top:10px;"><?php //echo $fieldValues['UK-FCL-00088_0']; ?></span>
      </td>
    </tr> -->

    <tr>
      <td width="5%"> 
      3.        
      </td>
      <td width="95%"><strong>Address of Registered Office.:</strong> <br><br><span  style="margin-top:10px;">

    

       <?php   
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

       

      echo @$fieldValues['UK-FCL-00093_0'].' '.@$fieldValues['UK-FCL-00309_0'].' '.@$fieldValues['UK-FCL-00310_0'].' '. @$pc1.' '.@$parish1['lr_name'].' '.@$fieldValues['UK-FCL-00096_0'] ; ?>
        

      </span>
      </td>
    </tr>

    <tr>
      <td width="5%"> 
      4.        
      </td>
       <td width="95%"><strong>Mailing Address:</strong><br><br>
        <?php 
        if(isset( $fieldValues['UK-FCL-00295_0'])){
          $country1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00295_0'])->queryRow(); 
        }else{
           $country1 = [];
        }
      
     if(isset($fieldValues['UK-FCL-00471_0'])){

       $state = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00471_0'])->queryRow(); 
     }else{
        $state =[];
     }

$mpc = @$fieldValues['UK-FCL-00094_0'];
if(@$fieldValues['UK-FCL-00103_0']){
  if($fieldValues['UK-FCL-00103_0']=='Yes'){
    $mpc = $pc1;
  }
}

      echo @$fieldValues['UK-FCL-00104_0'].' '.@$fieldValues['UK-FCL-00335_0'].' '.@$fieldValues['UK-FCL-00336_0'].' '.$mpc.' '. @$state['lr_name'].' '.@$country1['lr_name'] ;        
      ?>        
      </td>
    </tr>

    <tr>
      <td width="5%"> 
      5.       
      </td>
      <td width="95%"><strong>If change of address, give previous address of Registered Office: </strong><br><br><span  style="margin-top:10px;"></span>     
      </td>
    </tr>

</table>

<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>

<table width="100%" style="padding-top: 10px; font-size: 12;   padding: 5px;">
        <tr>
            <th class="" width="9%">Date :</th>
            <th width="20%"> <?php  echo date('d/m/y'); ?></th>
            <th class="" width="25%">Electronically signed</th>
            <th width="25%"></th>
            <th class="" width="8%">Title :</th>
            <th width="20%"></th>
        </tr>
        </table> 


