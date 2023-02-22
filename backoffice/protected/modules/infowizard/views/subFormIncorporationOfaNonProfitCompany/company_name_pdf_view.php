<table style="padding-top: 10px;">
    <tr>
      <td style="text-align:center;">     
        <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span><br>
        <span style="font-size: 11;">(Section 5 and 315)</span>   <br>
        <span style="font-size: 14;"><strong>ARTICLES OF INCORPORATION</strong></span>   <br>
             <span style="font-size: 12;"><strong>NON-PROFIT COMPANY</strong></span>  
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
      <td width="95%"><strong>Number (or minimum and maximum number) of Directors</strong><br><br><span  style="margin-top:10px;"> Minimum :<?php if(isset($fieldValues['UK-FCL-00119_0'])){echo $fieldValues['UK-FCL-00119_0'];} ?>, Maximum : <?php if(isset($fieldValues['UK-FCL-00120_0'])){echo $fieldValues['UK-FCL-00120_0'];} ?></span>
      </td>
    </tr>
    <tr>
      <td width="5%">  
     5. 
      </td>
      <td width="95%"><strong>The address of the principal office or premises of the Company is:</strong><br><br><span  style="margin-top:10px;"><?php if(isset($fieldValues['UK-FCL-00093_0'])){echo $fieldValues['UK-FCL-00093_0'];} ?></span>
      </td>
    </tr>
    <tr>
      <td width="5%">    
     6.
      </td>
      <td width="95%"><strong>Other provisions, if any</strong><br><br><span  width="100%" style="margin-top:10px;"><?php if(isset($fieldValues['UK-FCL-00098_0'])){echo $fieldValues['UK-FCL-00098_0'];} ?></span>
      </td>
    </tr>
    <tr>
      <td width="5%">
     7.   
      </td>
      <td width="95%"><strong>The first Directors, each of whom shall become a member of the Company, are:<br>Date:</strong><span  style="margin-top:10px;"><?php echo date('d/m/y');?></span><br><br>
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
           
           $arrayFields = array_unique($fieldValues['UK-FCL-00150_0']);

        if(is_array($arrayFields)){
               
           foreach ($arrayFields as $key => $value) {  
                
          ?>
        <tr>
          <td class="latabv"><?php echo @$value .' '. @$fieldValues['UK-FCL-00133_0'][$key] .' '.@$fieldValues['UK-FCL-00134_0'][$key];?></td>
          <td class="latabv"><?php echo @$fieldValues['UK-FCL-00107_0'][$key];?> <?php echo @$fieldValues['UK-FCL-00390_0'][$key];?> Country : <?php echo @$fieldValues['UK-FCL-00320_0'][$key];?></td>
          <td class="latabv">Electronically signed</td>
        </tr>
      <?php }} ?>
      </table>
    </td>
  </tr>
</table>



