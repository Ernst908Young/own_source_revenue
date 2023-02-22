<?php //print_r($fieldValues);die;?>
<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>

<table style="padding-top: 10px;">
    <tr>
      <td style="text-align:center;">     
        <span style="font-size: 14;"><strong>BUSINESS NAMES RULES, 1940</strong></span><br><br>
        <span style="font-size: 11;">FORM 4</span><br><br>
        <span style="font-size: 11;"><strong>Notice of Cessation of Business</strong></span><br>
    </td>
     </tr>
</table>
<br><br><br><br><br>

<table style="padding-top: 10px; font-size: 12;" width="100%">
     <tr>
      <td width="5%">        
      </td>
      <td width="95%">To the Registrar,<br>
		<span  style="margin-top:10px;"> 
		<b><?php echo @$fieldValues['UK-FCL-00430_0']; ?></b> 
			
			hereby give you notice in accordance with the requirements of Section 15 of the Registration of Business Names Act, 1940, that the business carried on under the name of <b>
			<?php echo @$fieldValues['UK-FCL-00624_0']; ?></b> 
			and registered on <b><?php echo @$fieldValues['UK-FCL-00625_0']; ?></b> 
			has ceased to carry on business as from  <b>
			<?php echo @$fieldValues['UK-FCL-00626_0'];  ?></b>
			 Dated this <b>
			<?php echo @$fieldValues['UK-FCL-00627_0'];?></b> 
		</span>
      </td>
    </tr>

   
    <br>
 

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