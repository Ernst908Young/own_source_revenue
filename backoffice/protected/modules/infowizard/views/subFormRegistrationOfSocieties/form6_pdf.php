<table style="padding-top: 10px;">
    <tr>
    <td style="text-align:center;">     
        <span style="font-size: 13;">SOCIETIES WITH RESTRICTED LIABILITY OF BARBADOS</span><br>
        <span style="font-size: 12;">(Sections 18)</span>   <br><br>
        <span style="font-size: 14;"><strong>NOTICE OF MANAGERS</strong></span>   <br>
        <span style="font-size: 14;"><strong>OR</strong></span>   <br>
        <span style="font-size: 14;"><strong>NOTICE OF CHANGE OF MANAGERS</strong></span>  
    </td>
     </tr>
</table>
<br><br><br>

<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>Name of Society :</strong> <span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00197_0'])){ echo $fieldValues['UK-FCL-00197_0'];}?></span>
      </td>
    </tr>
     <tr>
      <td width="5%">  
          2.      
      </td>
      <td width="95%"><strong>Society Number :</strong> <span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00360_0'])){ echo $fieldValues['UK-FCL-00360_0'];}?></span>
      </td>
    </tr>
</table>


<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>

<br><br>


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
     if(isset($fieldValues['UK-FCL-00397_0']) && !empty($fieldValues['UK-FCL-00397_0'])){
     foreach ($fieldValues['UK-FCL-00397_0'] as $key => $value) {  
          
    ?>
  <tr>
    <td class="latabv"><?php echo $value .' '. @$fieldValues['UK-FCL-00466_0'][$key] .' '.@$fieldValues['UK-FCL-00398_0'][$key];?></td>
    <td class="latabv"><?php echo @$fieldValues['UK-FCL-00238_0'][$key];?></td>
    <td class="latabv"><?php echo @$fieldValues['UK-FCL-00239_0'][$key];?></td>
  </tr>
<?php } }?>

</table>
<br><br><br>


<table style="padding-top: 10px; font-size: 12;" width="100%">
<tr>
      <td width="5%"> 
      4.         
      </td>
    </tr>
</table>
<br><br>

<table style="font-size: 12;" width="100%">
    <tr>
    <td width="5%">        
      </td>
      <td width="95%"> 
      <table width="100%" style="padding-top: 10px; font-size: 12; padding: 5px;">
        <tr>
            <th width="9%">Date :</th>
            <th width="20%"> <?php  echo date('d/m/y'); ?></th>
            <th width="25%">Electronically signed</th>
            <th width="25%"></th>
            <th width="8%">Title :</th>
            <th width="20%"></th>
        </tr>
        </table> 
    </td>
</tr>
</table>
