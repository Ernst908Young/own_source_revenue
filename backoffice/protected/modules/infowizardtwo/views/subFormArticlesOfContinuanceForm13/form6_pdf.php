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
      <td width="95%"><strong>Name of Society:</strong> <span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00197_0'])){ echo $fieldValues['UK-FCL-00197_0'];}?></span>
      </td>
    </tr>
     <tr>
      <td width="5%">  
               
      </td>
      <td width="95%"><strong>Society Number:</strong> <span  style="margin-top:10px;"><?php  if(isset($fieldValues['UK-FCL-00360_0'])){ echo $fieldValues['UK-FCL-00360_0'];}?></span>
      </td>
    </tr>
       <tr>
            <td width="5%">    
            3.
            </td>
            <td width="95%"><strong>No. of directors of the company as of this date are:</strong><br><br>
                <?php  if(isset($fieldValues['UK-FCL-00397_0']) && is_array($fieldValues['UK-FCL-00397_0'])){ ?>
                <table style="padding: 5px;"><?php  
                    foreach ($fieldValues['UK-FCL-00397_0'] as $key => $names) { ?>
                    <tr nobr="true">
                    <th class="latabv" ><strong>Name</strong></th>
                        <td class="latabv"><?php echo @$fieldValues['UK-FCL-00397_0'][$key] . ' ' . @$fieldValues['UK-FCL-00466_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00398_0'][$key] ?> </td>
                    </tr>                    
                    <tr nobr="true">
                    <th class="latabv"><strong>Address</strong></th>
                    <td class="latabv"><?php if($show_main==true){
						
						echo @$fieldValues['UK-FCL-00468_0'][$key] . ' ' . @$fieldValues['UK-FCL-00238_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00382_0'][$key] .'  ' . @$fieldValues['UK-FCL-00372_0'][$key]. '  '  .@$fieldValues['UK-FCL-00384_0'][$key]. '    ' . @$fieldValues['UK-FCL-00383_0'][$key];
					}else{
						echo "Not available publicly";
					}
						
					?> </td>
                    </tr>                    
                    <tr nobr="true"><th class="latabv"><strong>Occupation </strong></th>
                    <td class="latabv"><?php echo @$fieldValues['UK-FCL-00239_0'][$key] ?>  </td>
                    
                    </tr><br>
                    
               
                    
                    
                    
                 
                    <?php } ?>

                </table>
                <?php } ?>
            </td>
        </tr>
</table>
<?php 
	if($fieldValues['UK-FCL-00362_0']!='Yes'){
		if($app_status=='A'){ 
			echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
		} 
	}
	
?>
