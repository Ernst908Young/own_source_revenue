<table style="padding-top: 10px;">
   <tr>
      <td style="text-align:center;">     
         <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span><br>
         <span style="font-size: 11;">(Section 211)</span>   <br><br>
         <span style="font-size: 14;"><strong>ARTICLES OF AMALGAMATION</strong></span>   <br>
          
      </td>
   </tr>
</table>
<?php   //print_r($fieldValues['UK-FCL-00706_0']);die;?>  
<br><br><br>
<table style="padding-top: 10px; font-size: 12;" width="100%">
  
	<tr>
		<td width="5%">     
		  1. 
		</td>
		<td width="95%"><strong>Type of amalgamation: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00699_0'])){ echo $fieldValues['UK-FCL-00699_0'];}?>        
		</td>
	</tr>
	
	<tr>
		<td width="5%">     
		  2. 
		</td>
		<td width="95%"><strong>Number of entities being amalgamated: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00700_0'])){ echo $fieldValues['UK-FCL-00700_0'];}?>        
		</td>
	</tr>
	
	
	<tr>
		<td width="5%"> 
			3.        
		</td>
		<td width="95%"><strong>Details of companies being amalgamated:</strong><br>
		</td>
    </tr>
	
	<tr>
      <td width="5%"></td>
      <td width="95%">
     
	<?php 
		$arrayFields = $fieldValues['UK-FCL-00420_0'];
		$counter = 0;
		if(is_array($arrayFields)){ ?>
			<table style="padding: 5px;">
				<?php  foreach ($arrayFields as $key => $value) {  
				  
				?>

			<tr nobr="true">
				<th class="latabv" ><strong>Company Number (<?php echo ++$counter; ?>)</strong></th>
				<td class="latabv"><?php echo @$value;?></td>
			</tr>
			
			<tr nobr="true">
				<th class="latabv"><strong>Company Name</strong></th>
				<td class="latabv"><?php echo @$fieldValues['UK-FCL-00701_0'][$key];?></td>
			</tr>
			
			
			
			<tr nobr="true">
				<th colspan="2"></th>
			</tr>

		<?php } ?> 

	</table>
		<?php }  ?>
		</td>
    </tr>
	
	
	
	
	
	
	<?php if($fieldValues['UK-FCL-00703_0'] ==  "No"){ ?>
		<tr>
			<td width="5%">     
			4. 
			</td>
			<td width="95%"><strong>SRN of approved Form 33: </strong><br><br><?php   echo $fieldValues['UK-FCL-00704_0'];?>        
			</td>
		</tr>
		<tr>
			<td width="5%">     
			5. 
			</td>
			<td width="95%"><strong>Name of the Amalgamated Company: </strong><br><br><?php   echo $fieldValues['UK-FCL-00705_0'];?>        
			</td>
		</tr>
	<?php }else{ ?>
		<tr>
			<td width="5%">     
			4. 
			</td>
			<td width="95%"><strong>Company Number of which name is to be retained: </strong><br><br><?php   echo $fieldValues['UK-FCL-00711_0'];?>        
			</td>
		</tr>
		<tr>
			<td width="5%">     
			5. 
			</td>
			<td width="95%"><strong>Company Name of which name is to be retained: </strong><br><br><?php   echo $fieldValues['UK-FCL-00712_0'];?>        
			</td>
		</tr>
	<?php }	?>
	
	<tr>
      <td width="5%"> 
      6.        
      </td>
      <td width="95%"><strong>The classes and any maximum number of shares that the Company is authorized to issue:</strong><br>

      </td>
    </tr>
	<tr>
      <td width="5%"></td>
      <td width="95%">
     
	<?php 
		$arrayFields = $fieldValues['UK-FCL-00095_0'];

		if(is_array($arrayFields)){ ?>
	<table style="padding: 5px;">
			
			<?php  foreach ($arrayFields as $key => $value) {  
				  
			?>

			<tr nobr="true">
				<th class="latabv" ><strong>Type of Shares</strong></th>
				<td class="latabv"><?php echo @$value;?></td>
			</tr>
			
			<tr nobr="true">
				<th class="latabv"><strong>Name of class of shares</strong></th>
				<td class="latabv"><?php echo @$fieldValues['UK-FCL-00263_0'][$key];?></td>
			</tr>
			
			<tr nobr="true">
				<th class="latabv"><strong>Maximum no. of shares</strong></th>
				<td class="latabv"><?php echo @$fieldValues['UK-FCL-00264_0'][$key];?></td>
			</tr>
			
			<tr nobr="true">
				<th class="latabv" ><strong>Are these shares redeemable</strong></th>
				<td class="latabv"><?php echo @$fieldValues['UK-FCL-00265_0'][$key];?></td>
			</tr>
			
			<tr nobr="true">
				<th class="latabv"><strong>Price / formula for calculation of price</strong></th>
				<td class="latabv"><?php echo @$fieldValues['UK-FCL-00266_0'][$key];?></td>
			</tr>
			
			<tr nobr="true">
				<th class="latabv"><strong>Rights & privileges attached to the share</strong></th>
				<td class="latabv"><?php echo @$fieldValues['UK-FCL-00113_0'][$key];?></td>
			</tr>
			
			<tr nobr="true">
				<th colspan="2"></th>
			</tr>

		<?php } ?> 

	</table>
		<?php }  ?>
		</td>
    </tr>
	
	<tr>
		<td width="5%">  
		7.      
		</td>
		<td width="95%"><strong>Restrictions if any on the business the company may carry on:</strong><br><br><?php
        if(isset($fieldValues['UK-FCL-00334_0'])){
			if($fieldValues['UK-FCL-00334_0'] == 'Yes'){
				if(is_array($fieldValues['UK-FCL-00709_0'])){
					foreach ($fieldValues['UK-FCL-00709_0'] as $key => $value) {
						if($value=='Other Restrictions'){
							echo @$fieldValues['UK-FCL-00116_0'];
						}else{
							echo @$value.'<br><br>';
						}
					}
				}
			}else{
				echo "No";
			}
        }
		?>
		</td>
    </tr>
	
	<tr>
		<td width="5%"> 
		8.       
		</td>
		<td width="95%"><strong>Number (or minimum and maximum number) of Directors:</strong><br><br>
			<?php $minmax = "Minimum : ".@$fieldValues['UK-FCL-00604_0'].", Maximum : ".@$fieldValues['UK-FCL-00605_0'] ;?>
			<?php echo @$fieldValues['UK-FCL-00240_0'] == 'Fixed Number of Directors' ? ("Number of Directors are : ".@$fieldValues['UK-FCL-00241_0']) : $minmax ?>
		</td>
    </tr>
	
	<tr>
		<td width="5%">     
		9. 
		</td>
		<td width="95%"><strong>Restrictions on the business the company may carry on: </strong><br><br><?php   echo $fieldValues['UK-FCL-00339_0'];?>        
		</td>
	</tr>
	
	<tr>
		<td width="5%">     
		10. 
		</td>
		<td width="95%"><strong>Other provisions (if any): </strong><br><br><?php   echo $fieldValues['UK-FCL-00098_0'];?>        
		</td>
	</tr>
	<?php if($fieldValues['UK-FCL-00699_0'] == "Long Form Amalgamation by Agreement") {?>
	
		<tr>
		<td width="5%">     
		11. 
		</td>
		<td width="95%"><strong>The Companies being amalgamated through this form hereby confirm that: </strong><br><br>
		    <?php $arrayFields = $fieldValues['UK-FCL-00706_0']; 
				if(is_array($arrayFields)){ ?>
			<?php  foreach ($arrayFields as $key => $value) {  
				  echo @$value.'<br>';
			?>
				<?php } }?>
		</td>
	</tr>
	<?php } ?>
	
	<?php if($fieldValues['UK-FCL-00699_0'] == "Vertical Short Form Amalgamation") {?>
	
		<tr>
		<td width="5%">     
		11. 
		</td>
		<td width="95%"><strong>The Companies being amalgamated through this form hereby confirm that: </strong><br><br>
		    <?php $arrayFields = $fieldValues['UK-FCL-00707_0']; 
				if(is_array($arrayFields)){ ?>
			<?php  foreach ($arrayFields as $key => $value) {echo @$value.'<br>';
			?>
				<?php } }?>
		</td>
	</tr>
	<?php } ?>
	<?php if($fieldValues['UK-FCL-00699_0'] == "Horizontal Short Form Amalgamation") {?>
	
		<tr>
		<td width="5%">     
		11. 
		</td>
		<td width="95%"><strong>The Companies being amalgamated through this form hereby confirm that: </strong><br><br>
		    <?php 
		
		    $arrayFields = $fieldValues['UK-FCL-00710_0']; 

				if(is_array($arrayFields)){ ?>
			<?php  foreach ($arrayFields as $key => $value) {echo @$value.'<br>';
			?>
				<?php } }?>
		</td>
	</tr>
	<?php } ?>
	
	
	
	
</table>

<br><br><br><br>



<style type="text/css">
   .latabv {
   border: 1px solid black;
   }
</style>

<br><br>
