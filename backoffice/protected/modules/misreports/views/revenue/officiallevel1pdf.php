

<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">        
 <thead>           
   <tr style="font-size: 10;">
       <th width="7%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
       </th>
       <th width="45%" style="border: 1px solid black; text-align: center;"><strong>CAIPO Officer Name</strong> 
       </th>
        <th width="12%" style="border: 1px solid black; text-align: center;"><strong>
          Total Number of SRN</strong>
         </th>
      <th width="12%" style="border: 1px solid black; text-align: center;"><strong>Total amount received (BBD$)</strong> 
       </th>                              
       <th width="12%" style="border: 1px solid black; text-align: center;"><strong>Total Refund Issued (BBD$)</strong>
       </th>                               
       <th width="12%" style="border: 1px solid black; text-align: center;"><strong>Net revenue (BBD$)</strong>
       </th>
       
   </tr>
    </thead>
   <tbody>
    <?php
       $total_srn = 0;
$total_amt = 0;
$total_ref = 0;
$total_net = 0;

     foreach ($records as $key => $value) {
                               
                             ?>
                            <tr>
                               <td width="7%"  style="border: 1px solid black; text-align: center;">
                                <?= $key+1 ?>
                               </td>
                               <td width="45%"  style="border: 1px solid black;">
                                  <?php echo $value['full_name'].' '.$value['middle_name'].' '.$value['last_name'].'-'.$value['email'] ?>
                               </td>
                           
                                <td width="12%"  style="border: 1px solid black; text-align: center;"><?= $value['total_services'] ?></td>

                               <td width="12%"  style="border: 1px solid black; text-align: center;">
                                 <?php echo round($value['total_amount'],2); ?>
                               </td>

                               <td width="12%"  style="border: 1px solid black; text-align: center;">
                                <?php $refund = $value['ref_amt'];
                                   echo   round($refund , 2); ?>
                               </td>
                             
                               <td width="12%"  style="border: 1px solid black; text-align: center;">
                                 <?php
                              $net = $value['total_amount'] -  $refund ;
                                 echo  round($net ,2) ; ?>
                               </td>
                           </tr>

                           <?php 
     $total_srn = $total_srn+$value['total_services'];
 $total_amt =  $total_amt+$value['total_amount'];
     $total_ref = $total_ref  + $value['ref_amt'];
      $total_net =  $total_net + $net;
   } ?> 
<tr>
   <td width="52%"  colspan="2" style="border: 1px solid black;  text-align: right;">
    <strong>Total</strong>
   </td>
    <td width="12%"  style="border: 1px solid black; text-align: center;">
  <strong><?= $total_srn ?></strong>
</td>
   <td width="12%"  style="border: 1px solid black; text-align: center;">
       <strong><?= $total_amt ?></strong>
   </td>

   <td width="12%"  style="border: 1px solid black; text-align: center;">
      <strong> <?= $total_ref ?></strong>
   </td>
 
   <td  width="12%" style="border: 1px solid black; text-align: center;">
     <strong><?= $total_net ; ?></strong>
   </td>
</tr> 
                            </tbody>
             </table>