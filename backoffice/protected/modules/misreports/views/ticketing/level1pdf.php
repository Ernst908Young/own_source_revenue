<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">  
  <thead>   
   <tr style="font-size: 10;">
       <th width="4%" style="border: 1px solid black; text-align: center;">
          <strong>SR. No.</strong>
       </th>
       <th width="12%" style="border: 1px solid black; text-align: center;">
         <strong>Ticket ID </strong>
                               </th>
                              <th width="12%" style="border: 1px solid black; text-align: center;">
         <strong>Ticket Type</strong>
                               </th>                              
                                <th width="12%" style="border: 1px solid black; text-align: center;">
         <strong>Ticket Timestamp</strong>
                               </th>
							   <th width="12%" style="border: 1px solid black; text-align: center;">
         <strong>Resolution Due Date</strong>
                               </th>
							   <th width="12%" style="border: 1px solid black; text-align: center;">
         <strong>Pendency<br>(days)</strong>
                               </th>
                               <th width="12%" style="border: 1px solid black; text-align: center;">
         <strong>Status of Ticket</strong>
                               </th>
							    <th width="12%" style="border: 1px solid black; text-align: center;">
         <strong>Resolution Timestamp</strong>
                               </th>
                              <th width="12%" style="border: 1px solid black; text-align: center;">
         <strong> Assigned To</strong>
                               </th>
                              
                               
                          </tr>
                       </thead>
                           <tbody class="ticket-item">
                           <?php
						
    if($records){
     
       if($Pendency){   
        $pem_c = [];  
           foreach ($Pendency as $pk => $pv) {
             $pem_c[$pv] = $pv;
           }
        }
$i =0;
        foreach($records as $key => $value){  
           if(($t_id==NULL || in_array($value['supporttypecode'], $t_id))){ 
            if($value['status']=='C'){                  
                   $date1 = date_create(date('Y-m-d',strtotime($value['updated_on'])));
                  $date2 = date_create(date('Y-m-d',strtotime($value['created_on'])));
                  $diff  = date_diff($date1,$date2);
                  $ad    = $diff->format("%a");
                }else{
                   $date1 = date_create(date('Y-m-d'));
                  $date2 = date_create(date('Y-m-d',strtotime($value['created_on'])));
                  $diff  = date_diff($date1,$date2);
                  $ad    = $diff->format("%a");
               }  

     $pendecy_check = [
          1=> $ad<=5, 
          2 => $ad>5 && $ad<=10, 
          3 => $ad>10 && $ad<=15,
          4 => $ad>15 && $ad<=20,
          5 => $ad>21 && $ad<=30,
          6 => $ad>30, 
        ];

      if($Pendency){          
        
          $result=array_intersect_key($pendecy_check,$pem_c);
            $pendency_show = in_array('1', $result);
        
      }else{
         $pendency_show = 'All';
      }  

        

      if($pendency_show=='All' || $pendency_show){
         $i=$i+1;
        $assign_to = Yii::app()->db->createCommand("
        SELECT s.*,p.full_name,p.middle_name,p.last_name FROM supportmain s
          LEFT JOIN bo_user p ON s.currently_assign_to = p.uid
          WHERE s.supportmaincode='".$value['supportmaincode']."' ")->queryRow();
            ?>   
              <tr>
               <td width="4%" style="border: 1px solid black; text-align: center;">
                  <?= $key+1 ?>
                 </td>
                 <td width="12%" style="border: 1px solid black; text-align: center;">
                  <?= $value['supporttypecode'] ?>
                 </td>
                 <td width="12%" style="border: 1px solid black; text-align: center;">
                   <?= $value['ticket_type'] ?>
                 </td>
               <td width="12%" style="border: 1px solid black; text-align: center;">
                    <?= $value['created_on'] ?>                         
                 </td>
				  <td width="12%" style="border: 1px solid black; text-align: center;">
				  <?php echo date('Y-m-d H:i:s', strtotime($value['created_on'].' + 7 days')); ?>
                                         
                 </td>
				 <td width="12%" style="border: 1px solid black; text-align: center;">
                      <?= $ad ?>
                </td>
				<td width="12%" style="border: 1px solid black; text-align: center;">
                    <?php 
						if($value['status']=='O'){
							$status = 'Open';
						}
						if($value['status']=='RV'){
							$status = 'Reverted';
						}
						if($value['status']=='RS'){
							$status = 'Resolved';
						}
						if($value['status']=='RO'){
							$status = 'Reopened';
						}
						if($value['status']=='C'){
							$status = 'Closed';
						}
            if($value['status']=='ESC'){
							$status = 'Escalated';
						}
					?>
                     <?= $status; ?>
                 </td>
				 <td width="12%" style="border: 1px solid black; text-align: center;">
                     <?= $value['status']!=1 ? $value['updated_on'] : "-" ?>
                 </td>
                  <td width="12%" style="border: 1px solid black; text-align: center;">
                     <?php 
                            //if($assign_to){
                            if($assign_to['currently_assign_to']!=0 && $value['status']=='ESC'){
                      echo $assign_to['full_name'].' '.$assign_to['middle_name'].' '.$assign_to['last_name'];
                     } else { echo "-";} ?>
                </td>
                   
              </tr>                                    
             <?php   
                    }
                  }
                }
              }
            ?>
                         
                       </tbody> 
                    </table>