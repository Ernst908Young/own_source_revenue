<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">   
<thead>        
   <tr style="font-size: 10;">
     <th width="10%" style="border: 1px solid black; text-align: center;">
      <strong>SR. No.</strong>
     </th>

     <th width="30%" style="border: 1px solid black; text-align: center;">
      <strong>Service Name</strong>
     </th>

     <th width="15%" style="border: 1px solid black; text-align: center;">
      <strong>Total Number of Service Availed</strong>
     </th>

      <th width="15%" style="border: 1px solid black; text-align: center;">
        <strong>Total Amount Received (BBD$)</strong>
     </th>

     <th width="15%" style="border: 1px solid black; text-align: center;">
      <strong>Total Amount Refunded (BBD$)</strong>
     </th>
     <th width="15%" style="border: 1px solid black; text-align: center;">
      <strong>Total Revenue (BBD$)</strong>
     </th>

       
   </tr>
   </thead>
   <tbody>
    <?php 
$total_amt = 0;
$total_ref = 0;
$total_net = 0;
$total_srn = 0;
if(count($records)>0){
     foreach ($records as $key => $value) {
                               
                             ?>
                            <tr>
                                <td width="10%" style="border: 1px solid black; text-align: center;">
                                <?= $key+1 ?>
                               </td>
                           
                                <td width="30%" style="border: 1px solid black; text-align: center;">
                                 <?php echo $value['service_name'] ?> 
                               </td>
                               <td width="15%" style="border: 1px solid black; text-align: center;">
                                  <?php echo $value['total_services'] ?>
                               </td>
                                <td width="15%" style="border: 1px solid black; text-align: center;">
                                  <?php echo round($value['total_amount'],2); ?>
                               </td>
                                

                                <td width="15%" style="border: 1px solid black; text-align: center;">
									 <?php $refund = $value['ref_amt'];
                                   echo   round($refund , 2); ?>
								</td>
                                <td width="15%" style="border: 1px solid black; text-align: center;">
									<?php
								$net = $value['total_amount'] -  $refund ;
                                 echo  round($net ,2) ; ?>
								</td>
                                
                            </tr>

                          <?php
    $total_srn = $total_srn+$value['total_services'];
 $total_amt =  $total_amt+$value['total_amount'];
     $total_ref  = $total_ref + $value['ref_amt'];
      $total_net =  $total_net + $net;
}} ?> 

                         </tbody>
						 <tr>
   <td width="40%"  colspan="2" style="border: 1px solid black;  text-align: right;">
    <strong>Total</strong>
   </td>

   <td width="15%"  style="border: 1px solid black; text-align: center;">
      <strong><?= $total_srn ?></strong>
   </td> 
   <td width="15%"  style="border: 1px solid black; text-align: center;">
      <strong><?= round($total_amt,2) ?></strong>
   </td>
   
<td  width="15%" style="border: 1px solid black; text-align: center;">
      <strong><?= round($total_ref,2) ?></strong>
   </td>
<td  width="15%" style="border: 1px solid black; text-align: center;">
      <strong><?= round($total_net,2) ?></strong>
   </td>


  
</tr> 
             </table>