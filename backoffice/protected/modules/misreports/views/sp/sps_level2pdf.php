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
$total_paid = 0;
$total_ref = 0;
$total_net = 0;
$total_srn = 0;
$net =0;
$i=1;

foreach ($records as $key => $value) {
  $service_id = $value['service_id'];
   if($service_id=='2.0'){
    $cnr_records = Yii::app()->db->createCommand("
        SELECT     
        (CASE when q.is_fee_refunded=0 AND q.payment_status='success'  then q.total_amount end) as paid_amt,
        (CASE when q.is_fee_refunded=1 AND q.payment_status='refund success' then q.total_amount end) as ref_amt,
         s.field_value, q.is_fee_refunded
        from bo_new_application_submission as s
        Right join tbl_payment as q  on q.submission_id = s.submission_id       
        where s.agent_user_id='".$agent_user_id."' and DATE(s.application_created_date) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND s.service_id='2.0'")->queryAll();

      $next_array = [];
       $ref_amt = $paid_amt = 0;

        foreach ($cnr_records as $key => $v) {
           $newAppSubArr = json_decode($v['field_value'],true);

          if(array_key_exists($newAppSubArr['UK-FCL-00044_0'], $next_array)){
              $count = $next_array[$newAppSubArr['UK-FCL-00044_0']]['count'];

                if($v['is_fee_refunded']==1){
                  $ref_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['ref_amt']+$v['ref_amt'];
                  $paid_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['paid_amt'];
                 }else{
                  $ref_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['ref_amt'];
                  $paid_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['paid_amt'] + $v['paid_amt'];
                 }
              $next_array[$newAppSubArr['UK-FCL-00044_0']] = ['count'=>$count+1,'ref_amt'=>$ref_amt,'paid_amt'=>$paid_amt,'subservice'=>$newAppSubArr['UK-FCL-00044_0']];

            }else{
               if($v['is_fee_refunded']==1){
                    $ref_amt = $v['ref_amt'];
                 }else{
                  $paid_amt = $v['paid_amt'];
                 }
              
               $next_array[$newAppSubArr['UK-FCL-00044_0']] = ['count'=>1,'ref_amt'=>$ref_amt,'paid_amt'=>$paid_amt,'subservice'=>$newAppSubArr['UK-FCL-00044_0']];
            }
        }
         foreach ($next_array as $k => $val) { ?>
              <tr>
               <td width="10%" style="border: 1px solid black; text-align: center;">
                <?= $i ?>
               </td>

               <td width="30%" style="border: 1px solid black; text-align: center;">       
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
               <td width="15%" style="border: 1px solid black; text-align: center;">
                <?= $val['count'] ?>
               </td>
      

               <td width="15%" style="border: 1px solid black; text-align: center;">
                  <?php echo round($val['paid_amt'],2); ?>
               </td>

               <td width="15%" style="border: 1px solid black; text-align: center;">
                  <?php $refund =$val['ref_amt'];
                   echo   round($refund , 2); ?>
               </td>
             
               <td width="15%" style="border: 1px solid black; text-align: center;">
                <?php
              $net = $val['paid_amt'] -  $refund ;
                 echo  round($net ,2) ; ?>
               </td>
           </tr>
       <?php  
       $total_srn = $total_srn+$val['count'];
       $total_paid =  $total_paid+$val['paid_amt'];
       $total_ref  = $total_ref+$val['ref_amt'];
       $total_net =  $total_net + $net; 

       $i++;
     }

   }else{                             
       ?>
      <tr>
          <td width="10%" style="border: 1px solid black; text-align: center;">
          <?= $i ?>
         </td>
     
          <td width="30%" style="border: 1px solid black; text-align: center;">
           <?php echo $value['service_name'] ?> 
         </td>
         <td width="15%" style="border: 1px solid black; text-align: center;">
            <?php echo $value['total_services'] ?>
         </td>
          <td width="15%" style="border: 1px solid black; text-align: center;">
            <?php echo round($value['paid_amount'],2); ?>
         </td>
          

          <td width="15%" style="border: 1px solid black; text-align: center;">
             <?php $refund = $value['ref_amt'];
             echo   round($refund , 2); ?>
          </td>
          <td width="15%" style="border: 1px solid black; text-align: center;">
						<?php $net = $value['paid_amount'] -  $refund ;
                echo  round($net ,2) ; ?>
          </td>
          
      </tr>

                          <?php
    $total_srn = $total_srn+$value['total_services'];
 $total_paid =  $total_paid+$value['paid_amount'];
     $total_ref  = $total_ref + $value['ref_amt'];
      $total_net =  $total_net + $net;
       $i++;
    }
} ?> 

                         </tbody>
						 <tr>
   <td width="40%"  colspan="2" style="border: 1px solid black;  text-align: right;">
    <strong>Total</strong>
   </td>

   <td width="15%"  style="border: 1px solid black; text-align: center;">
      <strong><?= $total_srn ?></strong>
   </td> 
   <td width="15%"  style="border: 1px solid black; text-align: center;">
      <strong><?= round($total_paid,2) ?></strong>
   </td>
   
<td  width="15%" style="border: 1px solid black; text-align: center;">
      <strong><?= round($total_ref,2) ?></strong>
   </td>
<td  width="15%" style="border: 1px solid black; text-align: center;">
      <strong><?= round($total_net,2) ?></strong>
   </td>


  
</tr> 
             </table>