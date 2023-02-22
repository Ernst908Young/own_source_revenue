<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/admin">Home</a></li>
           <li>Reports</li>
            <li>
            <a href="<?php echo @$_SESSION['srspreviousurl'] ?>">
             Service Wise Revenue Summary
            </a>
          </li>
        
            <li>Service Wise Revenue Summary Advance Report</li>
          </ul>

		<div class="reservation-form p-0">
			<div class="form-part bussiness-det">                          
            	<h4 class="form-heading">
          			Service Wise Revenue Summary Advance Report
            	</h4>
        		<div class="form-row">
               <form method="get">
                <div class="row">
                <div class="col-lg-4 form-group">
            <label>From Date</label>
            <input type="inputType" autocomplete="off" id="from_date" name="from_date" class="datepicker form-control from_date" labelname="from_date" value="<?= $from_date ?>" readonly required />
          </div>
          <div class="col-lg-4 form-group">
            <label>To Date</label>
            <input type="inputType" autocomplete="off" id="to_date" name="to_date" class="datepicker form-control to_date" labelname="to_date" value="<?= $to_date ?>" readonly required />
          </div>
              <div class="col-lg-4 form-group">
                <label>Graph Type</label>
                  <select name="graph_type"  placeholder="select graph" class="select2-me" id="graph_id" labelname="Graph" >
                       
                       <?php 
                       $grap_op = ['line'=>'Line Graph','bar'=>'Bar Graph','pie'=>'Pie Chart','donate'=>'Donut Chart'];
                       foreach ($grap_op as $k => $v) { 
                        $selects = $grap_id==$k  ? 'selected' : '';
                        ?>
                         <option value="<?= $k ?>" <?= $selects ?>>
                        <?php echo $v ?>
                      </option>
                      <?php } ?>
                   
                  
                  </select>
              </div>
              <br><br> <br><br> 
               <div class="col-lg-4 form-group">
                 <label>Minimum Amount (BBD$)</label>
               <input type="number" name="min_amt" value="<?= $min_amt ?>" class="form-control"> 
               </div>
               <div class="col-lg-4 form-group">
                 <label>Maximum Amount (BBD$)</label>
               <input type="number" name="max_amt" value="<?= $max_amt ?>" class="form-control"> 
               </div>
               <div class="col-lg-3 form-group" style="margin-top: 35px;">
                  <button type="submit" class="btn-primary">Search</button>              
               </div>
               <div class="col-lg-12 form-group" style="color: red;">
               <?php echo $error; ?>
             </div>
               </div>
               
       
      </form>
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
  $net_revenues=json_encode($net_revenues_array);
  $colors = Colorpicker::getcolor($i);
   // print_r($colors);
      $colors = json_encode($colors);
 ?>
          



<?php 
  switch ($grap_id) {
    case 'line':
        echo $this->renderPartial('/graph/line_graph',['services'=>$services,'net_revenues'=>$net_revenues]);
      break;
    case 'bar':
       echo $this->renderPartial('/graph/bar_graph',['services'=>$services,'net_revenues'=>$net_revenues,'colors'=>$colors]);
      break;
    case 'pie':
       echo $this->renderPartial('/graph/pie_graph',['services'=>$services,'net_revenues'=>$net_revenues,'colors'=>$colors]);
      break;
    case 'donate':
        echo $this->renderPartial('/graph/donate_graph',['services'=>$services,'net_revenues'=>$net_revenues,'colors'=>$colors]);
      break;
    
    default:
      echo 'Something went wrong';
      break;
  }
  
   

?>
     
					
    			</div>
     		</div>    
		</div>
    </div>
</div>

 <script type="text/javascript">
    $(document).ready(function () {
      var date = new Date();
  date.setDate(date.getDate());
      $('.datepicker').datepicker({
          changeMonth: true,
          changeYear: true,
            dateFormat: 'dd-mm-yy',
            autoclose:true,
            maxDate: date
            });
    });
  </script>





