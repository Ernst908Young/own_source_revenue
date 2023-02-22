
<?php 

if(isset($fieldValues['UK-FCL-00117_0'])){
  $string =  $fieldValues['UK-FCL-00117_0'];

  $str_arr = implode(",", $string); 
  $trim = trim($str_arr,',');
  $array = explode(',',$trim);
}

 ?>

<table style="padding-top: 10px;">
    <tr>
    <td style="text-align:center;">     
        <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span><br>
        <span style="font-size: 12;">(Sections 66 & 74)</span>   <br><br>
        <span style="font-size: 14;"><strong>NOTICE OF DIRECTORS</strong></span>   <br>
        <span style="font-size: 14;"><strong>OR</strong></span>   <br>
        <span style="font-size: 14;"><strong>NOTICE OF CHANGE OF DIRECTORS</strong></span>  
    </td>
     </tr>
</table>
<br><br><br>

<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>Name of Company :</strong> <span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00090_0'])){ echo $fieldValues['UK-FCL-00090_0'];}?></span>
      </td>
    </tr>
     <!-- <tr>
      <td width="5%">  
          2.      
      </td>
      <td width="95%"><strong>Company Number :</strong> <span  style="margin-top:10px;"><?php //echo $fieldValues['UK-FCL-00088_0']; ?></span>
      </td>
    </tr> -->
    <!-- <tr>
      <td width="5%"> 
      3.        
      </td>
      <td width="95%"><strong>Notice is given that on the <span  style="margin-top:10px;"></span> day of <span  style="margin-top:10px;"></span> , <span  style="margin-top:10px;"></span> the following was appointed director <span  style="margin-top:10px;"></strong></span>
       </td>
    </tr> -->
</table>

<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>

<!-- <table style="padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse; padding: 5px;">
  <tr>
    <th class="latabv"><strong>Name</strong></th>
    <th class="latabv"><strong>Residential Address</strong></th>
    <th class="latabv"><strong>Occupation</strong></th>
  </tr>
  <tr>
    <td class="latabv"></td>
    <td class="latabv"></td>
    <td class="latabv"></td>
  </tr>
</table> -->

<!-- <table style="padding-top: 10px; font-size: 12;" width="100%">
<tr>
      <td width="5%"> 
      4.        
      </td>
      <td width="95%"><strong>Notice is given that on the <span  style="margin-top:10px;"><strong></strong></span> day of <span  style="margin-top:10px;"></span> , <span  style="margin-top:10px;"></span> the following person ceased to hold office as director</strong> <span  style="margin-top:10px;">
       </span>
       </td>
    </tr>
</table> -->
<br><br>

<!-- <table style="padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse; padding: 5px;">
  <tr>
    <th class="latabv" width="32%"><strong>Name</strong></th>
    <th class="latabv" width="68%"><strong>Residential Address</strong></th>
  </tr>
  <tr>
    <td class="latabv" width="32%"></td>
    <td class="latabv" width="68%"></td>
  </tr>
</table> -->



<table style="padding-top: 10px; font-size: 12;" width="100%">
<tr>
      <td width="5%"> 
      3.        
      </td>
      <td width="95%"><strong>The directors of the company as of this date are:</strong></td>
    </tr>
</table>
<br><br>

<table style="padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse; padding: 5px;">
  <tr>
    <th class="latabv"><strong>Name</strong></th>
    <th class="latabv"><strong>Residential Address</strong></th>
    <th class="latabv"><strong>Occupation</strong></th>
  </tr>

  <?php 
     
     $arrayFields = array_unique($fieldValues['UK-FCL-00150_0']);

     if(is_array($arrayFields)){
         
     foreach ($arrayFields as $key => $value) {  
          
    ?>
  <tr>
    <td class="latabv"><?php echo @$value .' '. @$fieldValues['UK-FCL-00133_0'][$key] .' '.@$fieldValues['UK-FCL-00134_0'][$key];?></td>
    <td class="latabv"><?php echo @$fieldValues['UK-FCL-00107_0'][$key];?></td>
    <td class="latabv"><?php echo @$array[$key];?></td>
  </tr>
<?php } }?>

</table>

<br><br><br>

<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
    <td width="5%"> 
      4.        
      </td>
      <td width="95%"> 
      <table width="100%" style="padding-top: 10px; font-size: 12; padding: 5px;">
        <tr>
            <th class="" width="9%">Date :</th>
            <th width="20%"> <?php  echo date('d/m/y'); ?></th>
            <th class="" width="25%">Electronically signed</th>
            <th width="25%"></th>
            <th class="" width="8%">Title :</th>
            <th width="20%"></th>
        </tr>
        </table> 
    </td>
</tr>
</table>



