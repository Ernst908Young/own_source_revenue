<style type="text/css">
   .latabv {
   border: 1px solid black;
   }
</style>
<?php 
$show_main = true;
if(isset($_GET['is_vpd'])){
  if($_GET['is_vpd']=='yes'){
    $show_main = false;
  }
} ?>
<table style="padding-top: 10px;">
   <tr>
      <td style="text-align:center;">   
         <span style="font-size: 12;">(Form 9)</span>   <br><br>  
         <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span><br>
         <span style="font-size: 12;">(Sections 66 & 74)</span>   <br><br>
         <span style="font-size: 14;"><strong>NOTICE OF DIRECTORS</strong></span>   <br>
         <span style="font-size: 14;"><strong>OR</strong></span>   <br>
         <span style="font-size: 14;"><strong>NOTICE OF CHANGE OF DIRECTORS</strong></span>  
      </td>
   </tr>
</table>
<br>
<table style="padding-top: 10px; font-size: 12;" width="100%">
   
	<tr>
      <td width="5%"> 
      1.        
      </td>
      <td width="95%"><strong>The directors of the company as of this date are:</strong></td>
    </tr>



<tr>
  <td width="5%"></td>
  <td width="95%"><table style="padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse; padding: 5px;">
  <tr>
    <th class="latabv"><strong>Name</strong></th>
    <th class="latabv"><strong>Residential Address</strong></th>
    <th class="latabv"><strong>Occupation</strong></th>
    <th class="latabv"><strong>Details of office</strong></th>
  </tr>

  <?php 
     
     $arrayFields = array_unique($fieldValues['UK-FCL-00132_0']);

  if(is_array($arrayFields)){
         
     foreach ($arrayFields as $key => $value) {  
          
    ?>
  <tr>
    <td class="latabv"><?php echo @$value .' '. @$fieldValues['UK-FCL-00133_0'][$key] .' '.@$fieldValues['UK-FCL-00134_0'][$key];?></td>
	
    <td class="latabv"><?php  
	if($show_main==true){  
		echo @$fieldValues['UK-FCL-00093_0'][$key].' '.@$fieldValues['UK-FCL-00309_0'][$key].' '.@$fieldValues['UK-FCL-00310_0'][$key].' '.strtoupper(@$fieldValues['UK-FCL-00372_0'][$key]).' '.strtoupper(@$fieldValues['UK-FCL-00096_0'][$key]).'   '.@$fieldValues['UK-FCL-00094_0'][$key];  
	}else{
		 echo "Not available publicly";
	}
		
		?>
	
	
	</td>
	
    <td class="latabv"><?php echo @$fieldValues['UK-FCL-00137_0'][$key];?></td>
     <td class="latabv"><?php 
     if(isset($fieldValues['UK-FCL-00480_0'])){
         echo isset($fieldValues['UK-FCL-00481_0'][$key]) ? $fieldValues['UK-FCL-00481_0'][$key] : "";
     }
    
     ?></td>
  </tr>
<?php } } ?>

	
</table></td>
</tr>
			
   
   
   
</table>
<br>
<br><br><br>

<?php if($app_status=='A'){ 
   echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>
 <br><br><br>