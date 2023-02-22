
<?php 
         $status_count = []; $srn_no_arr=[];
           foreach ($records as $key => $value) {
              if($subservice_id!=0){
                  $newAppSubArr = json_decode($value['field_value'],true);
                   if(isset($newAppSubArr['UK-FCL-00044_0']) && !empty($newAppSubArr['UK-FCL-00044_0']) && $newAppSubArr['UK-FCL-00044_0']==$subservice_id){
                      $row = true;
                   }else{
                     $row = false;
                   }
               }else{
                 $row = true;
               }
                if($row==true){
                   $status_res = Servicecategory::appstatus($value['application_status']);
                  if(array_key_exists($status_res, $status_count)){
                    $status_count[$status_res] = 1+$status_count[$status_res];
                  }else{
                    $status_count[$status_res] = 1;
                  } 
                   $srn_no_arr[$value['submission_id']]=$value['submission_id'];   
                }
              }
			  
			  
			 ?>
<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 
	<thead>   
	   <tr style="font-size: 10;">
		   <th width="10%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
		   </th>
		   <th width="10%" style="border: 1px solid black; text-align: center;"><strong>Srn No.</strong>
		   </th>
			<th width="50%" style="border: 1px solid black; text-align: center;"><strong>
			 Service Status</strong>
			 </th>
			 <th width="30%" style="border: 1px solid black; text-align: center;"><strong>
			 Applied On</strong>
			 </th>
		  
	   </tr>
    </thead>
	<tbody>
		 	<?php 


        foreach ($records as $key => $value) {
           if($subservice_id!=0){
              $newAppSubArr = json_decode($value['field_value'],true);
               if(isset($newAppSubArr['UK-FCL-00044_0']) && !empty($newAppSubArr['UK-FCL-00044_0']) && $newAppSubArr['UK-FCL-00044_0']==$subservice_id){
                  $row = true;
               }else{
                 $row = false;
               }
           }else{
             $row = true;
           }

           if($row==true){
             if($srn_no==NULL || in_array($value['submission_id'], $srn_no)){ 
         ?>
				   
				   
		
		<tr>
			<td width="10%" style="border: 1px solid black; text-align: center;">
				<?= $key+1 ?>
			</td>

			 <td width="10%" style="border: 1px solid black; text-align: center;">
				  <?=$value['submission_id'] ?>
			 </td>
			<td width="50%" style="border: 1px solid black; text-align: center;">
			    <?php  $status_res = Servicecategory::appstatus($value['application_status']);
                         echo $status_res;
                    ?> 
			 </td>
			 <td width="30%" style="border: 1px solid black; text-align: center;">
			   <?= $value['application_created_date'] ? date('d-m-Y',strtotime($value['application_created_date'])) : '' ?>
			 </td>

		 </tr>
	<?php
 
        }
                         }
                         }
                       
                          ?>
	</tbody>
 
</table>

            