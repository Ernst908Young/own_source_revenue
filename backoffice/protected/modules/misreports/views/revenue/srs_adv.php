<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>


<?php $baseUrl = Yii::app()->theme->baseUrl; ?>

        		<div class="form-row">
             
        <?php 
$i=0;
$service_array = $net_revenues_array = [];
 foreach ($records as $key => $value) {

  if($value['service_id']=='2.0'){
     $cnr_records = Yii::app()->db->createCommand("SELECT a.service_id,  p.total_amount, a.submission_id, a.field_value, p.payment_status, p.is_fee_refunded
      FROM bo_new_application_submission a
      INNER JOIN tbl_payment p
      ON a.submission_id=p.submission_id
      WHERE a.service_id='2.0' AND p.payment_status in ('refund success','success')")->queryAll();

        $next_array = [];
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
        foreach ($next_array as $k => $val) {
          if($min_amt==NULL || $max_amt==NULL || ($val['paid_amt']>=$min_amt && $val['paid_amt']<=$max_amt)){
               if($k==1){
                    $name = 'Name Reservation-Society (Form 15)';
                  }else{
                    if($k==2){
                      $name = 'Name Reservation-Company (Form 33)';
                    }else{
                      if($k==3)
                        $name = "Business Name Registration (Form 1)";
                      else
                        $name = 'NA';
                    }
                  }  
              $service_array[$i] = $name ;
              $net_revenues_array[$i] = $val['paid_amt'];
              $i=$i+1;
          }
        }
    
  }else{
    if($min_amt==NULL || $max_amt==NULL || ($value['total_revenue']>=$min_amt && $value['total_revenue']<=$max_amt)){
        $service_array[$i] = $value['core_service_name'];
        $net_revenues_array[$i] = round($value['total_revenue'],2);
        $i=$i+1;
    }    
  }
  
 }

  $services = json_encode($service_array);
  $net_revenues = json_encode($net_revenues_array);
  $colors = Colorpicker::getcolor($i);
   // print_r($colors);
  $colors = json_encode($colors);
 ?>
          



<?php 

  $grap_fl = ['line'=>'line_graph','bar'=>'bar_graph','pie'=>'pie_graph','donate'=>'donate_graph'];

  foreach ($grap_id as $key => $value) {
     echo $this->renderPartial('/graph/'.$grap_fl[$value],['services'=>$services,'net_revenues'=>$net_revenues,'colors'=>$colors]);
  
}
  

   

?>
     
					
    			</div>
          <br>
     





