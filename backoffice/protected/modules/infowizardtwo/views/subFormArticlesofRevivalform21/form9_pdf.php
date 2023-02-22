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
       
         <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span><br>
         <span style="font-size: 12;">(Sections 66)</span>   <br><br>
         <span style="font-size: 14;"><strong>NOTICE OF DIRECTORS (Form 9)</strong></span>   <br>
          
      </td>
   </tr>
</table>
<br>
<table style="padding-top: 10px; font-size: 12;" width="100%">
   <tr>
      <td width="5%">  
         1.   
      </td>
      <td width="95%"><b>Name of Company:</b><br><br><?php  if(isset($fieldValues['UK-FCL-00539_0'])){ echo $fieldValues['UK-FCL-00539_0'];}?>        
      </td>
   </tr>
   <tr>
      <td width="5%">     
         2. 
      </td>
      <td width="95%"><b>Company Number: </b><br><br><?php  if(isset($fieldValues['UK-FCL-00403_0'])){ echo $fieldValues['UK-FCL-00403_0'];}?>   
      </td>
   </tr>
   
   
   <tr>
		<td width="7%">    
		3.
		</td>
		<td width="93%"><strong>No. of directors of the company as of this date are:</strong><br><br>
			<?php  if(isset($fieldValues['UK-FCL-00132_0']) && is_array($fieldValues['UK-FCL-00132_0'])){ ?>
			
			<table style="padding: 5px;">
				<?php  
				foreach ($fieldValues['UK-FCL-00132_0'] as $key => $names) { ?>
                  
		   

				<tr nobr="true">
					<th class="latabv" ><strong>Name</strong></th>
					<td class="latabv"><?php echo @$fieldValues['UK-FCL-00132_0'][$key] . ' ' . strtoupper(@$fieldValues['UK-FCL-00105_0'][$key])  . ' ' . @$fieldValues['UK-FCL-00106_0'][$key] ?>  </td>
				</tr>
				
				<tr nobr="true">
				   <th class="latabv"><strong>Address</strong></th>
				  <td class="latabv"> <?php 
					if($show_main==true){
					  
						echo @$fieldValues['UK-FCL-00093_0'][$key] . ' ' . @$fieldValues['UK-FCL-00238_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00310_0'][$key] .'  ' . strtoupper(@$fieldValues['UK-FCL-00129_0'][$key]). '  '  .strtoupper(@$fieldValues['UK-FCL-00096_0'][$key]). '    ' . @$fieldValues['UK-FCL-00094_0'][$key];
					}else{
						echo "Not available publicly";
					}
					
				  ?> </td>
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Occupation </strong></th>
				<td class="latabv"><?php echo @$fieldValues['UK-FCL-00137_0'][$key] ?>  </td>
				
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Prominent public office: </strong></th>
				<td class="latabv"><?php echo @$fieldValues['UK-FCL-00480_0'][$key] ?>  </td>
				
				</tr>
				
				<tr nobr="true">
					<th class="latabv"><strong>Details of office held: </strong></th>
				<td class="latabv"><?php echo @$fieldValues['UK-FCL-00181_0'][$key] ?>  </td>
				
				</tr>
				
				
				
			 
				<?php } ?>

			</table>
			<?php } ?>
		</td>
	</tr>
  <!-- 
   <tr>
      <td width="5%">     
         3. 
      </td>
      <td width="95%"><b>No. of directors of the company as of this date are :</b> <?php  if(isset($fieldValues['UK-FCL-00131_0'])){ echo $fieldValues['UK-FCL-00131_0'];}?>
      </td>
   </tr>

   <?php
     $count=1;
      
      if(isset($fieldValues['UK-FCL-00132_0']) && is_array($fieldValues['UK-FCL-00132_0']))
         foreach ($fieldValues['UK-FCL-00132_0'] as $key => $names) {
            echo '<tr>
                     <td width="5%"> 
                     '.$count++.'    
                        
                     </td>
                     <td width="95%"><b>Name:</b> '.@$fieldValues['UK-FCL-00132_0'][$key] . ' ' . @$fieldValues['UK-FCL-00105_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00106_0'][$key] .'
                     </td>
                  </tr>
                  <tr>
                     <td>&nbsp;</td>
                 
                     <td width="95%"><b>Address: </b>'.@$fieldValues['UK-FCL-00093_0'][$key] . ' ' . @$fieldValues['UK-FCL-00238_0'][$key]  . ' ' . @$fieldValues['UK-FCL-00310_0'][$key] .'  ' . @$fieldValues['UK-FCL-00129_0'][$key]. '  '  .@$fieldValues['UK-FCL-00096_0'][$key]. '    ' . @$fieldValues['UK-FCL-00094_0'][$key] .'
                     </td>
                  </tr>
                  <tr>
                     <td>&nbsp;</td>
                  
                     <td width="95%"><b>Occupation:</b> '.@$fieldValues['UK-FCL-00137_0'][$key] . '
                     </td>
                  </tr>
                   <tr>
                     <td>&nbsp;</td>
                  
                     <td width="95%"><b>Prominent public office: </b>'.@$fieldValues['UK-FCL-00480_0'][$key] . '
                     </td>
                  </tr>
                  <tr>
                     <td>&nbsp;</td>
                  
                     <td width="95%"><b>Details of office held: </b>'.@$fieldValues['UK-FCL-00181_0'][$key] . '
                     </td>
      
            </tr>';
         }
     
    
      ?>
   
  -->
 






<tr>
      <td width="5%"> </td>
      <td width="95%">
      </td>
   </tr>
</table>
<br><br><br>
<?php if($app_status=='A'){ 
   echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>
 <br><br>