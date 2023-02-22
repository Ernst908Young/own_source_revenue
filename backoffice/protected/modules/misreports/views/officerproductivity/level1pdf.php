 <strong>Total Pending Applications: </strong><?= $app_count['Pending_For_Approval'] ?> <br><strong>Total Approved/Rejected: </strong>
     <?php $tara = 0;

     foreach($records as $v) {
     $sumar= $v['approved'] + $v['reject'];
       $tara = $tara+$sumar;

     }
     echo  $tara;?> <br>
 <br>
<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 <thead>   
   <tr style="font-size: 10;">
       <th width="10%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
       </th>
       <th width="30%" style="border: 1px solid black; text-align: center;"><strong>Officer Name</strong> 
       </th>
        <th width="15%" style="border: 1px solid black; text-align: center;"><strong>
          Total No. of Applications Approved</strong>
         </th>
      <th width="15%" style="border: 1px solid black; text-align: center;"><strong>Total No. of Applications Rejected</strong> 
       </th>                              
       <th width="15%" style="border: 1px solid black; text-align: center;"><strong>Total No. of Applications</strong>
       </th>     
 <th width="15%" style="border: 1px solid black; text-align: center;"><strong>Efficiency</strong>
       </th>     

   </tr>
    </thead>
   <tbody>
	<?php
						 $total_appr = 0;
$total_rej = 0;
$total_apps = 0;
    if($records){
       
        foreach($records as $key => $value){  
                ?>    
      <tr>
         <td width="10%" style="border: 1px solid black; text-align: center;">
          <?= $key+1 ?>
         </td>
         <td width="30%" style="border: 1px solid black;">
            <?php echo $value['full_name'].' '.$value['middle_name'].' '.$value['last_name'].'-'.$value['email'] ?>
         </td>
     
          <td width="15%" style="border: 1px solid black; text-align: center;">
		  <?= $value['approved'] ?>    
		  </td>

         <td width="15%" style="border: 1px solid black; text-align: center;">
          <?= $value['reject'] ?>  
         </td>

         <td width="15%" style="border: 1px solid black; text-align: center;">
            <?php 
                    $total_app = $value['approved']+$value['reject'];
                   echo $total_app; ?>
         </td>
  <td width="15%" style="border: 1px solid black; text-align: center;">
             <?php if($tara>0){
                      echo round(($total_app/$tara)*100,2).'%';
                    }else{
                      echo '0%';
                    } ?>
       
         </td>

         
     </tr>

     <?php   
       $total_appr = $total_appr+ $value['approved']; 
               $total_rej = $total_rej+ $value['reject'];    
                $total_apps = $total_apps+  $total_app;  
                    
                  }
                }
            ?>
 </tbody>
 <tfoot>
                           <tr>
   <td  width="40%" colspan="2" style="border: 1px solid black; text-align: right;">
    <strong>Total</strong>
   </td>

<td  width="15%" style="border: 1px solid black; text-align: center;">
      <strong><?= $total_appr ?></strong>
   </td>
   <td  width="15%" style="border: 1px solid black; text-align: center;">
      <strong><?=  $total_rej ?></strong>
   </td>

   <td  width="15%" style="border: 1px solid black; text-align: center;">
      <strong><?= $total_apps ?></strong>
   </td>
 <td  width="15%" style="border: 1px solid black; text-align: center;">
   
   </td>
 
</tr>              
</tfoot>   

             </table>