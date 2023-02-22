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


<br>
<table style="padding-top: 10px;">
   <tr>
      <td style="text-align:center;">     
         <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span>
      </td>
   </tr><br>
   <tr>
      <td style="text-align:center;">
         <span style="font-size: 13;"><b>APPLICATION FOR EXEMPTION (FORM 34) </b></span>       
      </td>
   </tr>
   
</table>
<br><br>
<table style="padding-top: 10px; font-size: 12;" width="100%" >
   <tr>
      <td width="8%">     
         1. 
      </td>
      <td width="92%"><strong>Name of Company: </strong><br><br><?php echo @$fieldValues['UK-FCL-00089_0']?>      
      </td>
   </tr>
   <tr>
      <td width="8%">     
         2. 
      </td>
      <td width="92%"><strong>Company Number: </strong><br><br><?php echo @$fieldValues['UK-FCL-00403_0']?>
      </td>
   </tr>
   <tr>
      <td width="8%">     
         3. 
      </td>
      <td width="92%"><strong>Type of application for exemption: </strong><br><br><?php echo @$fieldValues['UK-FCL-00579_0']?>
      </td>
   </tr>
   <tr>
      <td width="8%">     
         4. 
      </td>
      <td width="92%"><strong>Application for exemption is made for the following reasons: </strong><br><br><?php echo @$fieldValues['UK-FCL-00581_0']?>
      </td>
   </tr>

	<tr>
		<td width="7%">    
		5.
		</td>
		<td width="93%"><strong>The Directors of the Company as of the date of the Annual Return are:</strong><br><br>
			<?php if(isset($fieldValues['UK-FCL-00132_0']) && is_array($fieldValues['UK-FCL-00132_0'])){ ?>
			
			<table style="padding: 5px;">
				<?php  
				 foreach ($fieldValues['UK-FCL-00132_0'] as $newkey => $authorisedDetails) { ?>
                  
		   

				<tr nobr="true">
					<th class="latabv" ><strong>Name</strong></th>
					<td class="latabv"><?php echo @$fieldValues['UK-FCL-00132_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00105_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00324_0'][$newkey]    ?>  </td>
				</tr>
				
				<tr nobr="true">
				   <th class="latabv"><strong>Address</strong></th>
				  <td class="latabv"> 
               <?php 
			   if($show_main==true){ 
					echo @$fieldValues['UK-FCL-00093_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00309_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00310_0'][$newkey]  .'  ' . strtoupper(@$fieldValues['UK-FCL-00129_0'][$newkey])  .' ' . strtoupper(@$fieldValues['UK-FCL-00096_0'][$newkey])  .'  ' . @$fieldValues['UK-FCL-00094_0'][$newkey];
			   }else{
				   echo "Not available publicly";
			   }
              
                ?>



                </td>
				</tr>
				
				<tr nobr="true">
					<th colspan="2"></th>
				</tr>
				
				
				
			 
				<?php } ?>

			</table>
			<?php } ?>
		</td>
	</tr>

	<!--
   <tr>
      <td width="8%">     
         4. 
      </td>
      <td width="92%"><strong>The Directors of the Company as of the date of the Annual Return are:</strong></td>
   </tr>
      <?php
            foreach ($fieldValues['UK-FCL-00132_0'] as $newkey => $authorisedDetails) {
              echo '<tr>
                         <td width="10%">            
                         </td>
                         <td width="90%"><strong>Name:</strong><span style="text-align: justify;">  '.@$fieldValues['UK-FCL-00132_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00105_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00324_0'][$newkey]  .'             
                   </span>  </td>
              </tr>
            
                <tr>
                   <td width="10%">            
                   </td>
                   <td width="90%"><strong>Address:</strong><span style="text-align: justify;">  '.@$fieldValues['UK-FCL-00093_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00309_0'][$newkey] . ' ' . @$fieldValues['UK-FCL-00310_0'][$newkey]  .'  ' . strtoupper(@$fieldValues['UK-FCL-00129_0'][$newkey])  .' ' . strtoupper(@$fieldValues['UK-FCL-00096_0'][$newkey])  .'  ' . @$fieldValues['UK-FCL-00094_0'][$newkey]  .' </span>     
                   </td>
                </tr>
                
              ';
            }
         ?> 

	-->
   <tr>
      <td width="8%">     
         6. 
      </td>
      <td width="92%"><strong>Capacity of applicant: </strong><br><br><?php echo @$fieldValues['UK-FCL-00580_0']?>
      </td>
   </tr>
    <tr>
      <td width="8%">     
         7. 
      </td>
      <td width="92%"><strong>Application for exemption is made for the following reasons: </strong><br><br><?php echo @$fieldValues['UK-FCL-00581_0']?>
      </td>
   </tr>
</table><br><br><br>

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
</table><br><br>

