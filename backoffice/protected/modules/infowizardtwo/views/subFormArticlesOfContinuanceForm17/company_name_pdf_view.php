
<table style="padding-top: 10px;">
    <tr>
      <td style="text-align:center;">     
        <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span>
    </td>
     </tr>
       <tr>
        <td style="text-align:center;">
             <span style="font-size: 13;">(Section 351)</span>       
        </td>
     </tr>
       <tr>
         <td style="text-align:center;">
             <span style="font-size: 11;"><strong>ARTICLES OF CONTINUANCE</strong></span>           
        </td>        
        </tr>
</table>
<br><br><br>

<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>Name of Company: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00089_0'])){ echo $fieldValues['UK-FCL-00089_0'];}?>        
      </td>
    </tr>
    <!--  <tr>
      <td width="5%">  
      2.      
      </td>
      <td width="95%"><strong>Company Number</strong><br><br><?= $fieldValues['UK-FCL-00331_0'] ?>   
      </td>
    </tr>  -->
    <tr>
      <td width="5%">  
      2.      
      </td>
      <td width="95%"><strong>SRN Number:</strong><br><br><?= $fieldValues['UK-FCL-00331_0'] ?>   
      </td>
    </tr> 
	
	<tr>
      <td width="5%"> 
      2.        
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
	
	
    <!--tr>
      <td width="5%"> 
      3.        
      </td>
      <td width="95%"><strong>The classes and any maximum number of shares that the Company is authorized to issue</strong><br><br><?php echo @$fieldValues['UK-FCL-00092_0']?>

      </td>
    </tr-->
   
	<!--
    <tr>
      <td width="5%"> 
      4.        
      </td>
      <td width="95%"><strong>Restriction if any on share transfers</strong><br><br><?php
       echo @$fieldValues['UK-FCL-00504_0']
       ?>
      </td>
    </tr>
	-->
    <tr>
      <td width="5%"> 
      4.       
      </td>
      <td width="95%"><strong>Number (or minimum and maximum number) of Directors:</strong><br><br>
       <?php $minmax = "Minimum : ".@$fieldValues['UK-FCL-00119_0'].", Maximum : ".@$fieldValues['UK-FCL-00120_0'] ;?>
        <?php echo @$fieldValues['UK-FCL-00240_0'] == 'Fixed Number' ? ("Number of Directors are : ".@$fieldValues['UK-FCL-00241_0']) : $minmax ?>
      </td>
    </tr>
    <tr>
      <td width="5%">  
      5.      
      </td>
      <td width="95%"><strong>Restrictions if any on the business the company may carry on:</strong><br><br><?php
        if(isset($fieldValues['UK-FCL-00334_0'])){
          if($fieldValues['UK-FCL-00334_0'] == 'Yes'){
              if(is_array($fieldValues['UK-FCL-00115_0'])){
              foreach ($fieldValues['UK-FCL-00115_0'] as $key => $value) {
                if($value=='Other Restrictions'){
                  echo @$fieldValues['UK-FCL-00116_0'];
                }else{
                  echo @$value.'<br><br>';
                }
             }
           }
          }else{
            echo "";
          }
        }
       ?>
      </td>
    </tr>
    
    <tr>
      <td width="5%">  
      6.      
      </td>
      <td width="95%"><strong>If change of name affected, previous name:</strong><br><br><?php  if(isset($fieldValues['UK-FCL-00505_0'])){ echo $fieldValues['UK-FCL-00505_0'];}?>
      </td>
    </tr>
    <tr>
      <td width="5%">  
      7.      
      </td>
      <td width="95%"><strong>Details of incorporation:</strong><br><br><?php  if(isset($fieldValues['UK-FCL-00506_0'])){ echo $fieldValues['UK-FCL-00506_0'];}?>
      </td>
    </tr>
    <tr>
      <td width="5%">    
      8.    
      </td>
      <td width="95%"><strong>Other provisions if any:</strong><br><br>
	<?php 
           if(isset($fieldValues['UK-FCL-00124_0'])){
            if($fieldValues['UK-FCL-00124_0'] == 'Yes'){
              if(is_array($fieldValues['UK-FCL-00233_0'])){
              foreach ($fieldValues['UK-FCL-00233_0'] as $key => $value) {
                 if($value=='Others'){
                  echo @$fieldValues['UK-FCL-00116_0'];
                }else{
                  echo $value.'<br><br>';
                }
              }
              if(isset($fieldValues['UK-FCL-00126_0'])){
                echo $fieldValues['UK-FCL-00126_0'];
              }
            }
          }else{
            echo "";
          }
        }
        ?>
        
      </td>
    </tr>
    <!-- <tr>
      <td width="5%">
      7.        
      </td>
      <td width="95%"><strong>Incorporators:</strong><br><strong>Date:</strong><?= date('d M,Y') ?>
      </td>
    </tr> -->

</table>

<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>
<br><br>

  <!-- <tr> -->
    <!-- <td width="5%"></td> -->
    <!-- <td width="95%"> -->
      <!-- <table style="padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse; padding: 5px;"> -->
  <!-- <tr> -->
    <!-- <th class="latabv"><strong>Name</strong></th>
    <th class="latabv"><strong>Address</strong></th> -->
    <!-- <th class="latabv"><strong>Date</strong></th> -->
    <!-- <th class="latabv"><strong>Signature</strong></th> -->
  <!-- </tr> -->
 
  <!-- <tr> -->
   <!--  <td class="latabv"></td>
    <td class="latabv"></td> -->
     <!-- <td class="latabv"><?= date('d M,Y') ?></td> -->
    <!-- <td class="latabv">Electronically signed</td> -->
  <!-- </tr> -->

<!-- </table> -->

    <!-- </td> -->
  <!-- </tr> -->
  <!-- <?php
  if($app_status == 'A'){?>
    <table>
  <br><br>
<tr>
  <td width="20%"> </td>
  <td width="60%">  
    <table style="padding-top: 10px; font-size: 12; border: 1px blue solid  ; border-collapse: collapse; padding: 5px;">
    <tr>
   <td style="text-align:center; color:blue; ">  
         <span style="font-size: 10;"><strong>REGISTERED  </strong></span>   <br>
        <span style="font-size: 9 ;"><strong> CORPORATE AFFAIRS AND INTELLECTUAL PROPERTY OFFICE</strong></span>  
    </td>
     </tr>
   </table>
  </td>
  <td width="20%"> </td>
</tr>
</table>
 <?php } ?> -->
