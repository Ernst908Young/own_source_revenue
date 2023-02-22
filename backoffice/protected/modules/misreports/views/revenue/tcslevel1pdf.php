

<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 
	<thead>   
	   <tr style="font-size: 10;">
		   <th width="5%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
		   </th>
		   <th width="15%" style="border: 1px solid black; text-align: center;"><strong>Payment Code</strong>
		   </th>
			<th width="30%" style="border: 1px solid black; text-align: center;"><strong>
			 Service Description</strong>
			 </th>
		  <th width="15%" style="border: 1px solid black; text-align: center;"><strong>Fee Type</strong> 
		   </th>                              
		   <th width="15%" style="border: 1px solid black; text-align: center;"><strong>Payment Count</strong>
		   </th>                               
			<th width="11%" style="border: 1px solid black; text-align: center;"><strong>Unit Charge</strong>
		   </th> 
		   <th width="11%" style="border: 1px solid black; text-align: center;"><strong>Net Revenue</strong>
		   </th>   
		   
	   </tr>
    </thead>
	<tbody>
			<?php
   $_SESSION['tcrl1previousurl'] = $_SERVER['REQUEST_URI']; 
           $late_fee_arr = ['12.0','13.0'];
           $i=1;  $total_amt=0;

       foreach ($records as $key => $value) {    
          if($value['service_id']=='2.0'){
              $cnr_records = Yii::app()->db->createCommand("SELECT 
              q.total_amount as total_amount,     
                q.submission_id,
                q.service_id,
                nas.field_value     
                FROM tbl_payment as q 
                INNER JOIN bo_new_application_submission nas ON nas.submission_id = q.submission_id   
                where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' 
                  AND q.payment_status IN ('success') AND q.payment_mode=3 AND q.service_id='2.0'")->queryAll();
                    
             $next_array = [];

              foreach ($cnr_records as $key => $v) {
                 $newAppSubArr = json_decode($v['field_value'],true);

                if(isset($newAppSubArr['UK-FCL-00044_0']) && array_key_exists($newAppSubArr['UK-FCL-00044_0'], $next_array)){
                    $count = $next_array[$newAppSubArr['UK-FCL-00044_0']]['count'];
                    $total_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['total_amt'] + $v['total_amount'];
                     

                    $next_array[$newAppSubArr['UK-FCL-00044_0']] = ['count'=>$count+1,'total_amt'=>$total_amt,'subservice'=>$newAppSubArr['UK-FCL-00044_0']];

                  }else{
                                          
                     $total_amt = $v['total_amount'];
                     $next_array[$newAppSubArr['UK-FCL-00044_0']] = ['count'=>1,'total_amt'=>$total_amt,'subservice'=>$newAppSubArr['UK-FCL-00044_0']];
                  }
              }   

               foreach ($next_array as $k => $val) { 
                $fee_master = Yii::app()->db->createCommand("SELECT * FROM tbl_service_fee WHERE service_id='2.0' AND page_form_id=$k")->queryRow();
                if($fee_type==NULl || $fee_type==$fee_master['fee_detail']){
                  
                ?>
                  <tr>
                     <td width="5%" style="border: 1px solid black;">
                      <?= $i ?>
                     </td>
                     <td width="15%" style="border: 1px solid black;">
                       
                       
                           <?= $fee_master['payment_code'] ? $fee_master['payment_code']  : $value['service_id'] ?>
                          
                       
                     </td>
                     <td width="30%" style="border: 1px solid black;">
                       <?php if($k==1){
                          echo 'Name Reservation-Society (Form 15)';
                        }else{
                          if($k==2){
                            echo 'Name Reservation-Company (Form 33)';
                          }else{
                            if($k==3)
                              echo "Business Name Registration (Form 1)";
                            else
                              echo 'NA';
                          }
                        }  ?>
                     </td>
                     <td width="15%" style="border: 1px solid black;">
                       <?= $fee_master['fee_detail'] ?>
                     </td>
                     <td width="15%" style="border: 1px solid black;">
                       <?= $val['count'] ?>
                     </td>
                     <td width="11%" style="border: 1px solid black;">
                       <?= $fee_master['fee_amount'] ?>                                  
                     </td>                   
                      <td width="11%" style="border: 1px solid black;">
                        <?= $val['total_amt'] ?>        
                     </td>
                 </tr>
              <?php 
                $total_amt = $total_amt+$val['total_amt'];
              $i++;
            }}
               }else{ 

               if(in_array($value['service_id'], $late_fee_arr)){
                  $fee_master = Yii::app()->db->createCommand("SELECT * FROM tbl_service_fee WHERE service_id='".$value['service_id']."'")->queryAll();
               }else{
                  $fee_master = Yii::app()->db->createCommand("SELECT * FROM tbl_service_fee WHERE service_id='".$value['service_id']."'")->queryAll();
               }

               foreach ($fee_master as $k=>$val) {
                 if($fee_type==NULl || $fee_type==$val['fee_detail']){
               
       ?>
        
        
      <tr>
         <td width="5%" style="border: 1px solid black;">
          <?= $i ?>
         </td>

         <td width="15%" style="border: 1px solid black;">
          
           
              <?= $val['payment_code'] ? $val['payment_code']  : $value['service_id'] ?>
          
           
         </td>
         <td width="30%" style="border: 1px solid black;">
           <?= $value['core_service_name'] ?>
         </td>
         <td width="15%" style="border: 1px solid black;">
            <?= $val['fee_detail'] ?>
         </td>

         <td width="15%" style="border: 1px solid black;">
          <?php if($val['fee_detail']=='late fee'){
            echo $value['late_fee_count'];
          }else{
            echo $value['service_fees_count'];
          } ?>
           
         </td>


         <td width="11%" style="border: 1px solid black;">
           <?= $val['fee_amount'] ?>
         </td>

       
          <td width="11%" style="border: 1px solid black;">
          <?php if($val['fee_detail']=='late fee'){
            echo $value['late_fee'];
             $total_amt = $total_amt+$value['late_fee'];
          }else{
            echo $value['service_total_fee'];
            $total_amt = $total_amt+$value['service_total_fee'];
          } ?>
           
         </td>
     </tr>

     <?php
     $i++;

     }}
   }
     
      }  ?> 

	</tbody>

</table>

            