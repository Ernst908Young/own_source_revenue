<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>

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
<br>

<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>Name of Society :</strong> <span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00193_0']; ?></span>
      </td>
    </tr>

     <tr>
      <td width="5%">  
          2.      
      </td>
      <td width="95%"><strong>Society Number :</strong> <span  style="margin-top:10px;"><?php echo @$fieldValues['UK-FCL-00290_0']; ?></span>
      </td>
    </tr> 
   <tr>
    
      <td width="5%"> 
      3.        
      </td>
      <td width="95%"><strong>Notice is given that on the <span  style="margin-top:10px;"></span> day of <span  style="margin-top:10px;"></span> , <span  style="margin-top:10px;"></span> the following was appointed manager <span  style="margin-top:10px;"></strong></span>
       </td>
     
    </tr> 






<tr>
  <td width="5%"></td>
  <td width="95%">
    <table style="padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse;">
  <tr>
    <td class="latabv"><strong>Name</strong></td>
    <td class="latabv"><strong>Residential Address</strong></td>
    <td class="latabv"><strong>Occupation</strong></td>
  </tr>


   <?php 
     
     if(isset($fieldValues['UK-FCL-00132_0'])){
     if(is_array($fieldValues['UK-FCL-00132_0'])){       
     foreach ($fieldValues['UK-FCL-00132_0'] as $key => $value) {  
          
    ?>
  <tr>
    <td class="latabv"><?php echo $value .' '. @$fieldValues['UK-FCL-00105_0'][$key] .' '.@$fieldValues['UK-FCL-00324_0'][$key];?></td>
    <td class="latabv"><?php echo @$fieldValues['UK-FCL-00093_0'][$key].' '.@$fieldValues['UK-FCL-00309_0'][$key].' '.@$fieldValues['UK-FCL-00096_0'][$key].' '.@$fieldValues['UK-FCL-00129_0'][$key].' '.@$fieldValues['UK-FCL-00310_0'][$key].' '.@$fieldValues['UK-FCL-00094_0'][$key];?></td>
    <td class="latabv"><?php echo @$fieldValues['UK-FCL-00304_0'][$key];?></td>
  </tr>
<?php } } } ?>
  

 </table>
</td>
</tr> 
 



<?php if(isset($fieldValues['UK-FCL-00315_0'])&& !empty($fieldValues['UK-FCL-00315_0'])){ ?>
  <tr>
      <td width="5%"> 
      <?= (((isset($fieldValues['UK-FCL-00132_0'])&& !empty($fieldValues['UK-FCL-00132_0'])))?'4.':'3.'); ?>
            
      </td>
      <td width="95%"><strong>Notice is given that on the <span  style="margin-top:10px;"><strong></strong></span> day of <span  style="margin-top:10px;"></span> , <span  style="margin-top:10px;"></span> the following person ceased to hold office as manager</strong> <span  style="margin-top:10px;">
       </span>
       </td>
      
    </tr> 




 <tr>
  <td width="5%"></td>
  <td width="95%"><table style="padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse;">
    <tr>
    <th class="latabv" width="32%"><strong>Name</strong></th>
    <th class="latabv" width="68%"><strong>Residential Address</strong></th>
  </tr>
  

  <?php 
     
        if(isset($fieldValues['UK-FCL-00315_0'])){
            if(is_array($fieldValues['UK-FCL-00315_0'])){    
     foreach ($fieldValues['UK-FCL-00315_0'] as $key => $value) {  
          
    ?>
  <tr>
    <td class="latabv"><?php echo $value .' '. @$fieldValues['UK-FCL-00316_0'][$key] .' '.@$fieldValues['UK-FCL-00317_0'][$key];?></td>
    <td class="latabv"><?php echo @$fieldValues['UK-FCL-00093_0'][$key].' '.@$fieldValues['UK-FCL-00309_0'][$key].' '.@$fieldValues['UK-FCL-00096_0'][$key].' '.@$fieldValues['UK-FCL-00129_0'][$key].' '.@$fieldValues['UK-FCL-00310_0'][$key].' '.@$fieldValues['UK-FCL-00094_0'][$key];?></td>
   
  </tr>
<?php } } } ?>
  </table>
    
  </td>
</tr> 

<?php } ?>





<tr>
      <td width="5%"> 
      <?php if((isset($fieldValues['UK-FCL-00132_0'])&& !empty($fieldValues['UK-FCL-00132_0']))&& (isset($fieldValues['UK-FCL-00315_0'])&& !empty($fieldValues['UK-FCL-00315_0']))){ ?>
      5. <?php } else { ?> 
        4.  
        <?php } ?>    
      </td>
      <td width="95%"><strong>The managers of the Society as of this date are:</strong></td>
    </tr>



<tr>
  <td width="5%"></td>
  <td width="95%"><table style="padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse; padding: 5px;">
  <tr>
    <th class="latabv"><strong>Name</strong></th>
    <th class="latabv"><strong>Residential Address</strong></th>
    <th class="latabv"><strong>Occupation</strong></th>
  </tr>

  <?php 
      if(isset($fieldValues['UK-FCL-00397_0'])){
            if(is_array($fieldValues['UK-FCL-00397_0'])){    
     foreach ($fieldValues['UK-FCL-00397_0'] as $key => $value) {  
    
          
    ?>
  <tr>
    <td class="latabv"><?php echo $value .' '. @$fieldValues['UK-FCL-00133_0'][$key] .' '.@$fieldValues['UK-FCL-00398_0'][$key];?></td>
    <td class="latabv"><?php echo @$fieldValues['UK-FCL-00093_0'][$key].' '.@$fieldValues['UK-FCL-00309_0'][$key].' '.@$fieldValues['UK-FCL-00096_0'][$key].' '.@$fieldValues['UK-FCL-00129_0'][$key].' '.@$fieldValues['UK-FCL-00310_0'][$key].' '.@$fieldValues['UK-FCL-00094_0'][$key];?></td>
    <td class="latabv"><?php echo @$fieldValues['UK-FCL-00137_0'][$key];?></td>
  </tr>
<?php }}} ?>

</table></td>
</tr>



<tr>
  <td width="5%">
  <?php if((isset($fieldValues['UK-FCL-00132_0'])&& !empty($fieldValues['UK-FCL-00132_0']))&& (isset($fieldValues['UK-FCL-00315_0'])&& !empty($fieldValues['UK-FCL-00315_0']))){ ?>
      6. <?php } else { ?> 
        5.  
        <?php } ?>     
</td>
  <td width="95%">   
      <table width="100%" style="font-size: 12;">
        <tr>
            <th  width="9%">Date :</th>
            <th width="20%"> <?php  echo date('d/m/y'); ?></th>
            <th  width="25%">Electronically signed</th>
            <th width="25%"></th>
            <th  width="8%">Title :</th>
            <th width="20%"></th>
        </tr>
        </table> 
    </td>
</tr>



</table>