

<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 <thead>   
   <tr style="font-size: 10;">
       <th width="5%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
       </th>
       <th width="35%" style="border: 1px solid black; text-align: center;"><strong>Service Description</strong> 
       </th>
        <th width="10%" style="border: 1px solid black; text-align: center;"><strong>
          Total Gross Filings (# SRNs)</strong>
         </th>
      <th width="9%" style="border: 1px solid black; text-align: center;"><strong>Total Refund (# SRNs)</strong> 
       </th>                              
       <th width="10%" style="border: 1px solid black; text-align: center;"><strong>Total Net Filings (# SRNs)</strong>
       </th>                               
       <th width="11%" style="border: 1px solid black; text-align: center;"><strong>Gross Revenue Received (BBD$)</strong>
       </th>
        <th width="11%" style="border: 1px solid black; text-align: center;"><strong>Total Revenue Refunded (BBD$)</strong>
       </th>
        <th width="11%" style="border: 1px solid black; text-align: center;"><strong>Net Revenue (BBD$)</strong>
       </th>
       
   </tr>
    </thead>
   <tbody>
    <?php 
       $total_refund_count = 0;
      $total_paid_count = 0;   
      $total_ref_amt = 0;
      $total_paid_amt = 0;
        $i=1;
    foreach ($records as $key => $value) { 
        if($value['service_id']=='2.0'){
             $cnr_records = Yii::app()->db->createCommand("SELECT a.service_id,  p.total_amount, a.submission_id, a.field_value, p.payment_status, p.is_fee_refunded
FROM bo_new_application_submission a
INNER JOIN tbl_payment p
ON a.submission_id=p.submission_id
WHERE DATE(p.created_at) BETWEEN '".date('Y-m-d',strtotime($from_date))."' AND '".date('Y-m-d',strtotime($to_date))."' AND a.service_id='2.0' AND p.payment_status in ('refund success','success')")->queryAll();
            $next_array = [];
            $ref_amt = $paid_amt= 0;
            $refund_count = $paid_count = $ref_amt = $paid_amt = 0;
        foreach ($cnr_records as $key => $v) {
           $newAppSubArr = json_decode($v['field_value'],true);

          if(isset($newAppSubArr['UK-FCL-00044_0']) && array_key_exists($newAppSubArr['UK-FCL-00044_0'], $next_array)){
       
              if($v['is_fee_refunded']==1){
                  $refund_count = $next_array[$newAppSubArr['UK-FCL-00044_0']]['refund_count']+1;
                  $paid_count = $next_array[$newAppSubArr['UK-FCL-00044_0']]['paid_count'];
                  $ref_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['ref_amt']+$v['total_amount'];
                  $paid_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['paid_amt'];
                 }else{
                  $refund_count = $next_array[$newAppSubArr['UK-FCL-00044_0']]['refund_count'];
                  $paid_count = $next_array[$newAppSubArr['UK-FCL-00044_0']]['paid_count']+1;
                  $ref_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['ref_amt'];
                  $paid_amt = $next_array[$newAppSubArr['UK-FCL-00044_0']]['paid_amt'] + $v['total_amount'];
                 }
              $next_array[$newAppSubArr['UK-FCL-00044_0']] = ['refund_count'=>$refund_count, 'paid_count'=>$paid_count ,'ref_amt'=>$ref_amt,'paid_amt'=>$paid_amt,'subservice'=>$newAppSubArr['UK-FCL-00044_0']];

            }else{
               if($v['is_fee_refunded']==1){
                    $ref_amt = $v['total_amount'];
                    $refund_count = 1;
                 }else{
                  $paid_amt = $v['total_amount'];
                  $paid_count = 1;
                 }
              
               $next_array[$newAppSubArr['UK-FCL-00044_0']] = ['refund_count'=>$refund_count,'paid_count'=>$paid_count,'ref_amt'=>$ref_amt,'paid_amt'=>$paid_amt,'subservice'=>$newAppSubArr['UK-FCL-00044_0']];
            }
        }

            foreach ($next_array as $key => $val) { 
              if($min_amt==NULL || $max_amt==NULL || ($val['paid_amt']>=$min_amt && $val['paid_amt']<=$max_amt)){
              ?>
                  <tr nobr="true">
                   <td width="5%" style="border: 1px solid black; text-align: center;">
                    <?= $i ?>
                   </td>

                   <td width="35%" style="border: 1px solid black;">
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
                   <td width="10%" style="border: 1px solid black; text-align: center;">
                    <?= $val['refund_count']+$val['paid_count']  ?>
                      
                    </td>
                    <td width="9%" style="border: 1px solid black; text-align: center;">
                    <?= $val['refund_count'] ?>
                      
                    </td>
                    <td width="10%" style="border: 1px solid black; text-align: center;">
                    <?= $val['paid_count'] ?>
                      
                    </td>
          

                   <td width="11%" style="border: 1px solid black; text-align: center;">
                      <?php  $gross_amt = $val['ref_amt']+$val['paid_amt'];
                   echo round($gross_amt,2); ?>
                   </td>
                    <td width="11%" style="border: 1px solid black; text-align: center;">
                      <?php echo round($val['ref_amt'],2); ?>
                   </td>
                    <td width="11%" style="border: 1px solid black; text-align: center;">
                      <?php echo round($val['paid_amt'],2); ?>
                   </td>

                 
               </tr>
           <?php  
           $total_refund_count = $total_refund_count+$val['refund_count'] ;
        $total_paid_count = $total_paid_count+ $val['paid_count'];   
        $total_ref_amt = $total_ref_amt+ $val['ref_amt'] ;
        $total_paid_amt = $total_paid_amt+ $val['paid_amt'];  

           $i++;
         }
       }
      } else{
           if($min_amt==NULL || $max_amt==NULL || ($value['total_revenue']>=$min_amt && $value['total_revenue']<=$max_amt)){
         ?>

      <tr nobr="true">
         <td width="5%" style="border: 1px solid black; text-align: center;">
          <?= $i ?>
         </td>
         <td width="35%" style="border: 1px solid black;">
            <?php echo $value['core_service_name']; ?>
         </td>
     
          <td width="10%" style="border: 1px solid black; text-align: center;"><?= $value['total_gross_filling'] ?></td>
          <td width="9%" style="border: 1px solid black; text-align: center;"><?= $value['total_refund'] ?></td>
          <td width="10%" style="border: 1px solid black; text-align: center;"><?= $value['total_net_filling'] ?></td>

         <td width="11%" style="border: 1px solid black; text-align: center;">
           <?php echo round($value['gross_revenue_recived'],2); ?>
         </td>
          <td width="11%" style="border: 1px solid black; text-align: center;">
           <?php echo round($value['total_revenue_refunded'],2); ?>
         </td>
          <td width="11%" style="border: 1px solid black; text-align: center;">
           <?php echo round($value['total_revenue'],2); ?>
         </td>

       
     </tr>

     <?php 
         $total_refund_count = $total_refund_count + $value['total_refund'];
        $total_paid_count = $total_paid_count + $value['total_net_filling'];   
        $total_ref_amt = $total_ref_amt +  round($value['total_revenue_refunded'],2);
        $total_paid_amt = $total_paid_amt + round($value['total_revenue'],2); 
      $i++;
   }
 }
   } ?> 
<tr nobr="true">
   <td width="40%"  colspan="2" style="border: 1px solid black;  text-align: right;">
    <strong>Total</strong>
   </td>

 <td width="10%"  style="border: 1px solid black; text-align: center;">
   <strong><?= $total_refund_count+$total_paid_count ?></strong>
   </td>
    <td width="9%" style="border: 1px solid black; text-align: center;">
      <strong><?= $total_refund_count ?></strong>
   </td>
    <td width="10%" style="border: 1px solid black; text-align: center;">
      <strong><?= $total_paid_count ?></strong>
   </td>
   <td width="11%" style="border: 1px solid black; text-align: center;">
      <strong><?= round(($total_ref_amt+$total_paid_amt),2) ?></strong>
   </td>

   <td width="11%" style="border: 1px solid black; text-align: center;">
      <strong><?= round($total_ref_amt ,2) ?></strong>
   </td>
 
   <td width="11%" style="border: 1px solid black; text-align: center;">
    <strong><?= round($total_paid_amt,2) ; ?></strong>
   </td>
</tr>
 </tbody>

             </table>

            