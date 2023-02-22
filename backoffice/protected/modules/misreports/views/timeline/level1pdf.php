

<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 <thead>   
   <tr style="font-size: 10;">
       <th width="5%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
       </th>
       <th width="21%" style="border: 1px solid black; text-align: center;"><strong>Service Name</strong> 
       </th>
        <th width="7%" style="border: 1px solid black; text-align: center;"><strong>
          Draft</strong>
         </th>
      <th width="10%" style="border: 1px solid black; text-align: center;"><strong>Payment Due</strong> 
       </th>                              
       <th width="12%" style="border: 1px solid black; text-align: center;"><strong>Pending for Approval</strong>
       </th>                               
       <th width="12%" style="border: 1px solid black; text-align: center;"><strong>Approved</strong>
       </th>
	   <th width="11%" style="border: 1px solid black; text-align: center;"><strong>Reverted</strong>
       </th>
	   <th width="10%" style="border: 1px solid black; text-align: center;"><strong>Other Status</strong>
       </th><th width="12%" style="border: 1px solid black; text-align: center;"><strong>Total Application</strong>
       </th>
       
   </tr>
    </thead>
   <tbody>
    <?php 
  $d = $pd = $pfa = $a = $rev = $o = $ts = 0;
    foreach ($records as $key => $value) { ?>
      <tr>
         <td width="5%" style="border: 1px solid black; text-align: center;">
          <?= $key+1 ?>
         </td>
         <td width="21%" style="border: 1px solid black;">
            <?php echo $value['core_service_name']; ?>
         </td>
     
          <td width="7%" style="border: 1px solid black; text-align: center;"><?= $value['Draft'] ?></td>

         <td width="10%" style="border: 1px solid black; text-align: center;">
            <?php echo $value['Payment_Due']; ?>
         </td>

         <td width="12%" style="border: 1px solid black; text-align: center;">
            <?php echo $value['Pending_For_Approval']; ?>
         </td>
       
         <td width="12%" style="border: 1px solid black; text-align: center;">
          <?php echo $value['Approved']; ?>
         </td>
		 <td width="11%" style="border: 1px solid black; text-align: center;">
          <?php echo $value['Reverted']; ?>
         </td>
		 <td width="10%" style="border: 1px solid black; text-align: center;">
          <?php echo $value['Others']; ?>
         </td>
		 <td width="12%" style="border: 1px solid black; text-align: center;">
           <?php $total_status =  $value['Draft'] + $value['Payment_Due'] + $value['Pending_For_Approval']+$value['Approved']+$value['Reverted'] + $value['Others'] ;
                  echo $total_status;
                  ?>
         </td>
     </tr>

     <?php 

      $d = $value['Draft'] + $d;
                 $pd = $value['Payment_Due'] + $pd;
                 $pfa = $value['Pending_For_Approval'] + $pfa;
                 $a = $value['Approved'] + $a;
                 $rev = $value['Reverted'] + $rev;
                 $o = $value['Others'] + $o;
                 $ts = $total_status + $ts;
     
   } ?> 

 </tbody>
  <tfoot>
                         <tr>
                           <td width="26%"  colspan="2" style="border: 1px solid black; text-align: right;">
                             <strong> Total </strong>
                           </td>
                            <td width="7%" style="border: 1px solid black; text-align: center;">
                             <strong> <?= $d ?> </strong>
                           </td>
                           <td width="10%"  style="border: 1px solid black; text-align: center;">
                             <strong> <?= $pd ?> </strong>
                           </td>
                           <td width="12%"  style="border: 1px solid black; text-align: center;">
                             <strong> <?= $pfa ?> </strong>
                           </td>
                           <td width="12%"  style="border: 1px solid black; text-align: center;">
                             <strong> <?= $a ?> </strong>
                           </td>
                           <td width="11%"  style="border: 1px solid black; text-align: center;">
                             <strong> <?= $rev ?> </strong>
                           </td>
                           <td width="10%"  style="border: 1px solid black; text-align: center;">
                             <strong> <?= $o ?> </strong>
                           </td>
                           <td width="12%"  style="border: 1px solid black; text-align: center;">
                             <strong> <?= $ts ?> </strong>
                           </td>
                         </tr>
                       </tfoot>

             </table>