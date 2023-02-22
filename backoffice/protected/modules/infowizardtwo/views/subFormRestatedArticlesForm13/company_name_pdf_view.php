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
        <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span>
    </td>
     </tr>
       <tr>
        <td style="text-align:center;">
             <span style="font-size: 13;">(Section 205)</span>       
        </td>
     </tr>
       <tr>
         <td style="text-align:center;">
             <span style="font-size: 11;"><strong>RESTATED ARTICLES OF INCORPORATION</strong></span>           
        </td>        
        </tr>
</table>
<br><br><br>

<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>Name of Company/Society:  </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00651_0'])){ echo $fieldValues['UK-FCL-00651_0'];}?>        
      </td>
    </tr>
    <tr>
   <td width="5%">        
      2.
   </td>
      <td width="95%"><strong>Company/Society Number: </strong><br><br><?= @$fieldValues['UK-FCL-00650_0'] ?>   
      </td>
</tr>
 <?php
    if($fieldValues['UK-FCL-00675_0']=='Company'){
      ?>
<tr>
   <td width="5%">        
      3.
   </td>
      <td width="95%"><strong>Restrictions if any on the business the Company/Society may carry on: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00652_0'])){ echo $fieldValues['UK-FCL-00652_0'];}?>  
      </td>
</tr> 

 
    <tr>
      <td width="5%"> 
      5.       
      </td>
      <td width="95%"><strong>Number (or minimum and maximum number) of Directors: </strong><br><br><?= @$fieldValues['UK-FCL-00240_0'] == 'Fixed Number' ? ("Number of Directors are : ".@$fieldValues['UK-FCL-00241_0']) : (" Minimum : ".@$fieldValues['UK-FCL-00119_0'].", Maximum : ".@$fieldValues['UK-FCL-00120_0']) ?>
      </td>
    </tr>

    <tr>
      <td width="5%">  
      6.      
      </td>
      <td width="95%"><strong>Is the company being incorporated a public company or private company: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00123_0'])){ echo $fieldValues['UK-FCL-00123_0'];}?>
      </td>
    </tr>
    <tr>
      <td width="5%">    
      7.    
      </td>
      <td width="95%"><strong>Is there any other provisions to be included: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00124_0'])){ echo $fieldValues['UK-FCL-00124_0'];}?>
     
        
      </td>
    </tr>


     <?php

    }
	
    if($fieldValues['UK-FCL-00675_0']=='Society'){

      ?>
      <tr>
   <td width="5%">        
      3.
   </td>
      <td width="95%"><strong>Restrictions if any on the business the Company/Society may carry on: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00652_0'])){ echo $fieldValues['UK-FCL-00652_0'];}?>  
      </td>
    </tr> 


     <tr>
      <td width="5%">    
      4.    
      </td>
      <td width="95%"><strong>The purpose for which the Society is formed: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00199_0'])){ echo $fieldValues['UK-FCL-00199_0'];}?>
     
        
      </td>
    </tr>
     <tr>
      <td width="5%">    
      5.    
      </td>
      <td width="95%"><strong>The duration of the Society: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00200_0'])){ echo $fieldValues['UK-FCL-00200_0'];}?>
     
        
      </td>
    </tr>

    <tr>
       <td width="5%">     
        6. 
       </td>
       <td width="95%"><strong>The registered office of the Society in Barbados:</strong><br><br><?= @$fieldValues['UK-FCL-00093_0'] . ' ' . @$fieldValues['UK-FCL-00238_0'] . ' ' . @$fieldValues['UK-FCL-00310_0']. ' ' .strtoupper(@$fieldValues['UK-FCL-00129_0']) . ' ' . @$fieldValues['UK-FCL-00096_0'].' ' . @$fieldValues['UK-FCL-00094_0']?>   
       </td>
    </tr>
    <tr>
      <td width="5%">    
      7.    
      </td>
      <td width="95%"><strong>Is the society appointing a person as its registered agent: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00362_0'])){ echo $fieldValues['UK-FCL-00362_0'];}?>
     
        
      </td>
    </tr>
	  <?php
    }	

   ?>
	<?php if(@$fieldValues['UK-FCL-00362_0'] == 'Yes') { ?>
	
	<tr>
		<td width="5%"> 
			8.        
		</td>
		<td width="95%"><strong>The details of the Society’s agent in Barbados:</strong><br>
		</td>
    </tr>
	
	<tr>
      <td width="5%"></td>
      <td width="95%">
     
		
			<table style="padding: 5px;">
				

			
			
			<tr nobr="true">
				<th class="latabv"><strong>Name</strong></th>
				<td class="latabv"><?php echo @$fieldValues['UK-FCL-00132_0'] . ' ' . @$fieldValues['UK-FCL-00105_0'] . ' ' . @$fieldValues['UK-FCL-00106_0']?> </td>
			</tr>
			
			<tr nobr="true">
				<th class="latabv"><strong>Address</strong></th>
				<td class="latabv"><?php  if($show_main==true){ echo @$fieldValues['UK-FCL-00104_0'] . ' ' . @$fieldValues['UK-FCL-00309_0'] . ' ' . @$fieldValues['UK-FCL-00336_0']. ' ' .strtoupper(@$fieldValues['UK-FCL-00372_0']) . ' ' . @$fieldValues['UK-FCL-00320_0'].' ' . @$fieldValues['UK-FCL-00242_0'];
				}else{
					echo "Not available publicly";
				}?>  
			</td>
			</tr>
			
			<tr nobr="true">
				<th colspan="2"></th>
			</tr>

		 

	</table>
		
		</td>
    </tr>
	
	
	
	
	
     
    
     <?php
    }	

   ?>

</table>

<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>
<br><br><br>
<?php if($app_status=='A'){ 
  echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>

 <br><br><br>

<table style=" font-size: 12; border-collapse: collapse; ">
      <tr>
         <td style="text-align:center;">
            <span style="font-size: 12;"><strong> SIGNATORY DETAILS</strong></span>           
         </td>
      </tr>
     <br>
       <tr>
         <td>
      <table style="padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse; padding: 5px;">
         <tr>
            <th class="latabv"><strong>Full Name</strong></th>           
            <th class="latabv"><strong>Designation </strong></th>
            <th class="latabv"><strong>Signature </strong></th>
            <th class="latabv"><strong>Date of Signature </strong></th>
         </tr>
         <?php        
          if(isset($signatoryDetails) && count($signatoryDetails) > 0){
            foreach ($signatoryDetails as $key => $signDetails) {
              $signDate=date('d M,Y',strtotime($signDetails['date_of_signing']));
              echo '<tr>
                      <td class="latabv">'.$signDetails['first_name'].' '.$signDetails['middle_name'].' '.$signDetails['last_name'].'</td>
                      <td class="latabv">'.$signDetails['designation'].'</td>
                      <td class="latabv">Electronically signed</td>
                      <td class="latabv">'.$signDate.'</td>
                  </tr>';
            }
          }
         ?>         
      </table>
    </td>
  </tr>
</table>
