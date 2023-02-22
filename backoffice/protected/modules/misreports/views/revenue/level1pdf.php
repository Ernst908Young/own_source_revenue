

<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 <thead>   
   <tr style="font-size: 10;">
       <th width="7%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
       </th>
       <th width="45%" style="border: 1px solid black; text-align: center;"><strong>Service Description</strong> 
       </th>
        <th width="12%" style="border: 1px solid black; text-align: center;"><strong>
          Total Number of SRN</strong>
         </th>
      <th width="12%" style="border: 1px solid black; text-align: center;"><strong>Total Amount Received (BBD$)</strong> 
       </th>                              
       <th width="12%" style="border: 1px solid black; text-align: center;"><strong>Total Refund Issued (BBD$)</strong>
       </th>                               
       <th width="12%" style="border: 1px solid black; text-align: center;"><strong>Net Revenue (BBD$)</strong>
       </th>
       
   </tr>
    </thead>
   <tbody>
    <?php 
        $total_amt = 0;
        $total_ref = 0;
        $total_net = 0;
        $total_srn = 0;
        $net =0;
        $i=1;
    foreach ($records as $key => $value) { 
        if($value['service_id']=='2.0'){
             $cnr_records = Yii::app()->db->createCommand("SELECT 
              q.total_amount as total_amount,
              (CASE when q.is_fee_refunded=0 then q.total_amount end) as paid_amt,
              (CASE when q.is_fee_refunded=1 then q.total_amount end) as ref_amt,
              q.is_fee_refunded, q.service_id, q.payment_mode, q.transaction_number, 
              q.reference_number,q.bank_name,q.reference_name, q.reference_email, 
              q.created_at, nas.application_status, cd.company_name as entity_name, nas.submission_id,
              s.service_name , u.iuid, q.payment_received_by, nas.field_value
              FROM tbl_payment as q
                INNER JOIN bo_information_wizard_service_master s ON s.id = q.service_id
                INNER JOIN bo_new_application_submission nas ON nas.submission_id = q.submission_id 
                INNER JOIN sso_users u ON nas.user_id = u.user_id
                LEFT OUTER JOIN bo_company_details cd on cd.reg_no = nas.entity_name
                where DATE(q.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' 
                AND q.payment_status IN ('success','refund success') AND q.service_id='2.0' order by q.created_at desc")->queryAll();
            $next_array = [];
            $ref_amt = $paid_amt= 0;
            foreach ($cnr_records as $key => $v) {
                 $newAppSubArr = json_decode($v['field_value'],true);

                                  if(array_key_exists($newAppSubArr['UK-FCL-00044_0'], $next_array)){
                                      $count = $next_array[$newAppSubArr['UK-FCL-00044_0']]['count'];

                                        if($v['is_fee_refunded']==1){
                                          $ref_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['ref_amt']+$v['total_amount'];
                                          $paid_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['paid_amt'];
                                         }else{
                                          $ref_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['ref_amt'];
                                          $paid_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['paid_amt'] + $v['total_amount'];
                                         }


                                       

                                      $next_array[$newAppSubArr['UK-FCL-00044_0']] = ['count'=>$count+1,'ref_amt'=>$ref_amt,'paid_amt'=>$paid_amt,'subservice'=>$newAppSubArr['UK-FCL-00044_0']];

                                    }else{
                                       if($v['is_fee_refunded']==1){
                                            $ref_amt = $v['total_amount'];
                                         }else{
                                          $paid_amt = $v['total_amount'];
                                         }
                                       $total_amtc = $v['total_amount'];
                                       $next_array[$newAppSubArr['UK-FCL-00044_0']] = ['count'=>1,'ref_amt'=>$ref_amt,'paid_amt'=>$paid_amt,'subservice'=>$newAppSubArr['UK-FCL-00044_0']];
                                    }
            }

            foreach ($next_array as $key => $val) { ?>
                  <tr>
                   <td width="7%" style="border: 1px solid black; text-align: center;">
                    <?= $i ?>
                   </td>

                   <td width="45%" style="border: 1px solid black;">
                    
                    
                      <?php if($key==1){
                        echo 'Name Reservation-Society (Form 15)';
                      }else{
                        if($key==2){
                          echo 'Name Reservation-Company (Form 33)';
                        }else{
                          if($key==3)
                            echo "Business Name Registration (Form 1)";
                          else
                            echo 'NA';
                        }
                      }  ?>
                   </td>
                   <td width="12%" style="border: 1px solid black; text-align: center;"><?= $val['count'] ?></td>
          

                   <td width="12%" style="border: 1px solid black; text-align: center;">
                      <?php echo round($val['paid_amt'],2); ?>
                   </td>

                   <td width="12%" style="border: 1px solid black; text-align: center;">
                      <?php $refund =$val['ref_amt'];
                       echo   round($refund , 2); ?>
                   </td>
                 
                   <td width="12%" style="border: 1px solid black; text-align: center;">
                    <?php
                  $net = $val['paid_amt'] -  $refund ;
                     echo  round($net ,2) ; ?>
                   </td>
               </tr>
           <?php  
           $total_srn = $total_srn+$val['count'];
           $total_amt =  $total_amt+$val['paid_amt'];
           $total_ref  = $total_ref+$val['ref_amt'];
           $total_net =  $total_net + $net; 

           $i++;
         }
      } else{
           
         ?>

      <tr>
         <td width="7%" style="border: 1px solid black; text-align: center;">
          <?= $i ?>
         </td>
         <td width="45%" style="border: 1px solid black;">
            <?php echo $value['service_name']; ?>
         </td>
     
          <td width="12%" style="border: 1px solid black; text-align: center;"><?= $value['total_services'] ?></td>

         <td width="12%" style="border: 1px solid black; text-align: center;">
           <?php echo round($value['total_amount'],2); ?>
         </td>

         <td width="12%" style="border: 1px solid black; text-align: center;">
            <?php $refund = $value['ref_amt'];
                                   echo   round($refund , 2); ?>
         </td>
       
         <td width="12%" style="border: 1px solid black; text-align: center;">
             <?php
                              $net = $value['total_amount'] -  $refund ;
                                 echo  round($net ,2) ; ?>
         </td>
     </tr>

     <?php 
       $total_srn = $total_srn+$value['total_services'];
 $total_amt =  $total_amt+$value['total_amount'];
     $total_ref  = $total_ref + round($value['ref_amt'],2);
      $total_net =  $total_net + $net;
      $i++;
   }
   } ?> 
<tr>
   <td width="52%"  colspan="2" style="border: 1px solid black;  text-align: right;">
    <strong>Total</strong>
   </td>

 <td width="12%"  style="border: 1px solid black; text-align: center;">
   <strong><?= $total_srn ?></strong>
   </td>
   <td width="12%" style="border: 1px solid black; text-align: center;">
      <strong><?= $total_amt ?></strong>
   </td>

   <td width="12%" style="border: 1px solid black; text-align: center;">
      <strong><?= $total_ref ?></strong>
   </td>
 
   <td width="12%" style="border: 1px solid black; text-align: center;">
    <strong><?= $total_net ; ?></strong>
   </td>
</tr> </tbody>

             </table>

