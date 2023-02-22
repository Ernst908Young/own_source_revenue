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
        <span style="font-size: 13;">SOCIETIES WITH RESTRICTED LIABILITY OF BARBADOS</span><br>
        <span style="font-size: 12;">(Sections 18)</span>   <br><br>
        <span style="font-size: 14;"><strong>NOTICE OF MANAGERS</strong></span>   <br>
        <span style="font-size: 14;"><strong>OR</strong></span>   <br>
        <span style="font-size: 14;"><strong>NOTICE OF CHANGE OF MANAGERS (Form 6)</strong></span>  
    </td>
     </tr>
</table>
<br><br><br>

<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>No. of managers in the Society as of this date are:</strong> <br><br><span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00649_0'])){ echo $fieldValues['UK-FCL-00649_0'];}?></span>
      </td>
    </tr>
   
	
	<tr>
      <td width="5%"> 
      2.        
      </td>
      <td width="93%"><strong>The details of the managers of the society as of this date are:</strong><br><br>
      	<?php  if(isset($fieldValues['UK-FCL-00132_0']) && is_array($fieldValues['UK-FCL-00132_0'])){ ?>
      	
      	<table style="padding: 5px;">
      		<?php  
      		foreach ($fieldValues['UK-FCL-00132_0'] as $key => $names) { ?>
                      
         

      		<tr nobr="true">
      			<th class="latabv" ><strong>Name</strong></th>
      			<td class="latabv"><?php echo @$fieldValues['UK-FCL-00132_0'][$key] . ' ' . @$fieldValues['UK-FCL-00105_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00324_0'][$key] ?>  </td>
      		</tr>
      		
      		<tr nobr="true">
      		   <th class="latabv"><strong>Address</strong></th>
      		  <td class="latabv"> 
            <?php 
			if($show_main==true){
				echo @$fieldValues['UK-FCL-00093_0'][$key] . ' ' . @$fieldValues['UK-FCL-00309_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00310_0'][$key] .'  ' . @$fieldValues['UK-FCL-00372_0'][$key]. '  '  .@$fieldValues['UK-FCL-00096_0'][$key]. '    ' . @$fieldValues['UK-FCL-00094_0'][$key]; 
			}else{
				echo "Not available publicly";
			}
			

           ?> 
         </td>
      		</tr>
      		
      		<tr nobr="true">
      			<th class="latabv"><strong>Occupation </strong></th>
      		<td class="latabv"><?php echo @$fieldValues['UK-FCL-00137_0'][$key]; ?>  </td>
      		
      		</tr>
      		
      		
      		
      		
      		
      	 
      		<?php } ?>

      	</table>
      	<?php } ?>
      </td>




      

    </tr>
	
	
	