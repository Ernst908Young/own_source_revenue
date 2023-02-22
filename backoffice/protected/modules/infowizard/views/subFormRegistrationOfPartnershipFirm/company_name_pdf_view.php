
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

<table style="padding-top: 10px; font-size: 12;" width="100%">
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
      <td width="95%" style="text-align:justify;"><strong>Address</strong><br><br><span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00107_0'])){ echo $fieldValues['UK-FCL-00107_0'];}?></span>
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
      <td width="95%"><strong>Date of commencement of Partnership firm</strong><br><br><span  width="100%" style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00278_0'])){ echo $fieldValues['UK-FCL-00278_0'];}?></span>
      </td>
    </tr>
    <tr>
      <td width="5%">
     6.   
      </td>
      <?php if(isset($fieldValues['UK-FCL-00279_0'])) { if(is_array($fieldValues['UK-FCL-00279_0'])) { ?>
      <?php foreach ($fieldValues['UK-FCL-00279_0'] as $key => $value) { ?>
      <td width="95%"><strong>Whether the Partnership firm is Limited.</strong><br><br><span  width="100%" style="margin-top:10px;"><?php echo @$value; ?></span>
      </td>
	  <?php } }}?>
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
          <th class="latabv"><strong>Partner Name</strong></th>
          <th class="latabv"><strong>Partner Address</strong></th>
          <th class="latabv"><strong>Type of Partner</strong></th>
          <th class="latabv"><strong>Partner Description</strong></th>
        </tr>
        <?php if(isset($fieldValues['UK-FCL-00301_0'])){ 
		if(is_array($fieldValues['UK-FCL-00301_0'])){
		?>
        <?php foreach ($fieldValues['UK-FCL-00301_0'] as $key => $value) {
        	
         ?>
        <tr>
          <td class="latabv"><?php echo $value;?></td>
          <td class="latabv"><?php echo @$fieldValues['UK-FCL-00093_0'][$key];?></td>
          <td class="latabv"><?php echo @$fieldValues['UK-FCL-00274_0'][$key];?></td>
          <td class="latabv"><?php echo @$fieldValues['UK-FCL-00275_0'][$key];?></td>
        </tr>
		<?php }} } ?>
      </table>
    </td>
  </tr>
</table>
<br><br>
<table style="padding-top: 10px; font-size: 12;" width="100%">
  <tr style="text-align: right;">
   
    <td>Electronically signed </td>
  </tr>
 
</table>


