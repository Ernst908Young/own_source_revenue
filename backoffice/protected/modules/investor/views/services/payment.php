<style>
#ezpay_payment_button{
width:151px;
height:36px;
}

.backbtn{
  width: 151px;
    height: 36px;
    background: #cccccc;
    border-color: #ccc;
    color: #000;
}

#overlay {
    position: fixed;
  top:0%;
  left:0%;
  width:100%;
  height:100%;  
  background: black;
  opacity: .2;
  z-index: 100;
}
#overlay_text{
   width: 50px;
    height: 57px;
    position: absolute;
    top: 50%;
    left: 50%;
    margin: -28px 0 0 -25px;   
    font-size: 25px;
    opacity: 10;
     z-index: 101;
}
/*opup*/
/*body { margin-top:20px; }*/
.panel-title {display: inline;font-weight: bold;}
.checkbox.pull-right { margin: 0; }
.pl-ziro { padding-left: 0px; }


</style>
<div id="overlay" style="display: none;">
  <div id="overlay_text" style="color: red;">
  <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
  <span class="sr-only">Sending Email Please Wait Loading...</span>
</div>
</div>

    
    <div class="Dashboard-wrapper">
        <div class="dashborad-inner">
          <?php if(Yii::app()->user->hasFlash('failed')): ?>
            <h5 style="text-align: center; color:red;">
              <?php 
//echo"<pre>";print_r($latefee);die;
              echo Yii::app()->user->getFlash('failed'); ?>
            </h5>
          <?php endif; ?> 
          <?php if(Yii::app()->user->hasFlash('initiated')): ?>
            <h5 style="text-align: center; color:orange;">
              <?php echo Yii::app()->user->getFlash('initiated'); ?>
            </h5>
          <?php endif; ?> 
           <?php //echo"<pre>";print_r($service);die;?>
            <div class="row m-0">
               
                <div class="col-lg-12 p-0">
                    <div class="dashboard-conetnt">                        
                        <div class="dashboard-home">
                            <div class="applied-status">
                                                      


                                <ul class="breadcrumb">
                                    <li><a href="#">Home</a></li>
                                    <li>Payment Detail</li>
                                  </ul>
                                  <div class="row">
                                      <div class="col-md-12"> 
                                          <div class="paymentbox row">
                                                
                                                    <div class="form-group col-md-6 mb-3">
                                                        <div class="text-start">
                                                          <label>Service Name</label>
                                                          <input type="text" value="" readonly class="form-control" placeholder="<?= $sercename ?>">
                                                        </div>    
                                                    </div>
                                                    <div class="form-group col-md-6 mb-3">
                                                        <div class="text-start">
                                                          <label>SRN No.</label>
                                                          <input type="text" id="srn_no" class="form-control" readonly placeholder="<?= $service_srn['submission_id']?>">
                                                        </div>  
                                                    </div>
                                                    <div class="form-group col-md-6 mb-3">
                                                        <div class="text-start">
                                                          <label>Applicant Name</label>
                                                          <input type="text" class="form-control" readonly placeholder="<?= $user_profile['first_name'].' '.$user_profile['last_name'].' '.$user_profile['surname'] ?>">
                                                        </div>  
                                                    </div>
                                                    <div class="form- col-md-6 mb-3">
                                                        <div class="text-start">
                                                          <label>Email Id</label>
                                                          <input type="email" class="form-control" readonly placeholder="<?= $user['email']?>">
                                                        </div>  
                                                    </div>
                                                    <div class="form-group col-md-6 mb-3">
                                                        <div class="text-start">
                                                          <label>Contact No.</label>
                                                          <input type="number" class="form-control" readonly placeholder="<?= $user['mobile_no']?>">
                                                        </div>  
                                                    </div>
                                                    <div class="form-group col-md-6 mb-3">
                                                        <div class="text-start">
                                                          <label>Total Fee</label>
                                                          <?php 
$sql = "SELECT * FROM bo_service_booking_schedule WHERE  submission_id =".$service_srn['submission_id'];
$get_booking_details = Yii::app()->db->createCommand($sql)->queryRow();
if($get_booking_details['total_amount']>0){
$total_fees = $get_booking_details['total_amount'];
}else{
  $total_fees = $servicefee;
}
                                                          ?>
                                                          <input type="text" class="form-control" readonly placeholder="<?= $total_fees ?>">
                                                        </div>  
                                                    </div>

                                                   <!-- <div class="d-flex justify-content-between">
                                                        <button id="ezpay_button" class="paymentbtn">
                                                            <img src="/themes/investuk/assets/applicant/images/ezpay.png">
                                                        </button>
                                                         <form action="" method="post">
                                <input type="hidden" name="srnno" value="<?= $service_srn['submission_id']?>">
                               <button type="submit" class="btn-primary"> Pay Offline</button>
                                  <button type="submit"  class="paymentbtn">
                                                            <img src="/themes/investuk/assets/applicant/images/paycounter.png">
                                                        </button>
                              </form>
                                                      
                                                    </div> -->
                                                  
<div class="row"> 
 <div class="d-flex justify-content-center">
 <?php
 $srn = $service_srn['submission_id']; $message = '';  $reverify_btn = false;
  $checkpayment = Yii::app()->db->createCommand("SELECT * FROM tbl_payment WHERE submission_id = $srn ORDER BY id DESC")->queryRow();
 if($checkpayment){
  if($checkpayment['payment_mode']==3){
    $form_show = false;
    $message = 'You select a offline mode payment';
  }else{
    if($checkpayment['payment_mode']==1){
      if($checkpayment['payment_status']=='success'){
        $form_show = false;
        $message = 'Your online payment was already successful';
      }else{
        if($checkpayment['payment_status']=='failed'){
          $form_show = true;
        }else{
          $form_show = false;
          $message = 'Your online payment was already Initiated. Click on reverify button to reverify the payment process';
          $reverify_btn = true;
        }
      }
    }else{
      $form_show = false;
      $message = 'Sorry something went worg please connect to support';
    }
  }
 }else{
  $form_show = true;
 }
   ?>    



   <?php if($form_show==true){ ?>
      <!-- <div class="mx-2" style="" id="ezpay_button"></div> -->
   <button id="paynow" type="" class="btn btn-secondary">PAY NOW</button>
 
      <form  class="mx-2" action="" method="post">
      <input type="hidden" name="srnno" id="srnno" value="<?= $service_srn['submission_id']?>">
      <input type="hidden" name="latefee" value="<?= $latefee?>">
      <button type="submit" class="btn btn-secondary" title="Persons can make payment at the Cashier's booth at our Office located at Baobab Tower, Warrens, St. Michael. This facility is available to persons who do not have access to credit card or debit payment facilities. Persons must book an appointment to visit our Office via https://booking.appointy.com/en-US/caiposearch/bookings/service." style="margin-bottom: 5px;">
        PAY AT COUNTER                               
     </button>
  </form>
    
     <a class="btn btn-primary backbtn mx-2" href="javascript:;" onclick="window.history.go(-1);">Back</a> 
 <?php }else{
  echo $message.'<br><br>'; 
    if($reverify_btn==true){
     $transaction_no = $checkpayment['transaction_number'];
  ?>
   <a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('investor/services/verifyPaymentDetail/tno/'.base64_encode($transaction_no));?>" title="Reverify Payment" class="btn btn-secondary">Reverify Payment             
   </a>
 <?php } } ?>
                            
  
  </div>
                                  <!-- <div class="d-flex justify-content-center mt-3">
                                  <input class="btn btn-secondary" type="button" value="Back" onclick="window.history.back()" />
                                    <a class="btn btn-primary" href="javascript:;" onclick="window.history.go(-1);">Back</a>
                                  </div> -->
</div>
                                                
                                          </div>
                                      </div>
                                      <!-- <div class="col-md-6">
                                          <div class="d-flex justify-content-end">
                                          <img src="/themes/investuk/assets/applicant/images/payment.png" alt="" clas="img-fluid">
                                          </div>
                                      </div> -->
                                  </div>
                                  <!--<div class="row">
                                      <div class="col-md-12">
                                          <div class="paymentbox">
                                              <p>Service Name : <span><?= $service['service_name'] ?></span></p>
                                              <p>SRN No. : <?= $service_srn['submission_id']?><span></span></p>
                                              <p>User Name : <span><?= $user_profile['first_name'] ?></span></p>
                                              <p>User Email : <span><?= $user['email']?></span></p>
                                              <p>User Contact : <span><?= $user['mobile_no']?></span></p>
                                              <p>Total Fee : $<?= $servicefee ?> <span></span></p>
                                          </div>
                                      </div>
                                  </div>
                                  </br></br> -->
                                  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
       
        <div class="panel-heading">
                    <h3 class="panel-title">
                        Payment Details
                    </h3>
                    
                </div>
                 <!-- <button type="button" class=" close" data-dismiss="modal">&times;</button> -->
      </div>

      <div class="modal-body">
    
    <div class="row">
       <!--  <div class="col-xs-12 col-md-12"> -->
            <!-- <div class="panel panel-default"> -->
                
                <!-- <div class="panel-body"> -->
                  <form role="form">


                     <div class="col-xs-12 col-md-12">
                    <div class="form-group">
                        <label for="cardNumber">
                            CARD NUMBER</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="cardNumber" placeholder="Valid Card Number"
                                required autofocus />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        </div>
                    </div>
                  </div>
                    <div class="row my-3">
                        <div class="col-xs-7 col-md-7">
                            <div class="form-group row">
                                <label for="expityMonth">
                                    EXPIRY DATE</label>
                                <div class=" col-md-6 ">
                                
                                  <select name="month" class="form-control">
                               <?php
                            for ($i = 0; $i < 12; $i++) {
                                $time = strtotime(sprintf('%d months', $i));   
                                $label = date('F', $time);   
                                $value = date('n', $time);
                                echo "<option value='$value'>$label</option>";
                            }
                            ?>
                                  </select>

                                  
                                    <!-- <input type="text" class="form-control" id="expityMonth" placeholder="MM" required /> -->
                                </div>
                                <div class="col-md-6">
                                     <select name="Year" class="form-control">
                               <?php
                                  for ($i = 2023; $i <2123; $i++) {
                                     
                                      echo "<option value='.$i'>$i</option>";
                                  }
                                ?>
                                  </select>
                                    <!-- <input type="text" class="form-control" id="expityYear" placeholder="YY" required /></div> -->
                            </div>
                        </div>
                      </div>
                        <div class="col-xs-5 col-md-5">
                            <div class="form-group">
                                <label for="cvCode">
                                    CVV NUMBER</label>
                                <input type="password" class="form-control" id="cvCode" placeholder="CVV NUMBER" required />
                            </div>
                        </div>
                    </div>
                  </form>
                <!-- </div> -->
            <!-- </div> -->
          
           
        <!-- </div> -->
      </br>
      <div class="col-xs-12 col-md-12">
      <h4 style="text-align: center;">Final Payment Of : &#8377; <?= $total_fees ?></h4>
         <a href="<?= '/panchayatiraj/backoffice/investor/services/dummypayment/srn_no/'.$_GET['srn_no']?>
           " class="btn btn-success btn-lg d-block" role="button">Pay</a>
      </div>
    </div>
        
    </div>

      
    <!--   <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Clo>se</button>
      </div> -->
    </div>
</div>
  </div>
</div>

  
<!--  
<script src="https://dev.ezpay.gov.bb/portal/scripts/ezpay_plugin_eservices.js" type="text/javascript">
</script> -->


<script>
  $(document).ready(function(){
    $("#ezpay_payment_button").attr('style','height:35px;');



  });
function LoadEzpayButton()
{

ez_payment_code = "<?= !empty($service_fee['payment_code'])?$service_fee['payment_code']:'' ?>";  // Payment Code for the Specific form or Service(From Ezpay)
ez_payment_amount = <?= $servicefee ?>; //Total Amount the User will pay
ez_payment_details = "<?= $service['service_name'] ?>"; // Description of the Service
ez_process_id = <?= $service_srn['submission_id']?>;//"12345678912345678912"; // Services Unique Identifier
ez_reference_email = "<?= $user['email']?>"; // Receipts can be emailed to the reference email
ez_reference_name = "<?= $user_profile['first_name'].' '.$user_profile['last_name'].' '.$user_profile['surname'] ?>"; // Name of the User/Applicant
ez_reference_number = <?= $user['mobile_no']?>; // Vendor's reference number
$("#EzPaymentModal").modal("show"); //Open the Ezpay Modal
}



function ezpay_callback(response)
{

 var payment_code = "<?= !empty($service_fee['payment_code'])?$service_fee['payment_code']:'' ?>"; 
 var s = response.split('{')[1]; // remove notice and warning error
 var data = '{'+s;

var rep = JSON.parse(data); // Parsed to an array
 $("#overlay").attr("style",'display:block;');
 $(".swal2-actions").addClass('hidden');
$.ajax({

            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/investor/services/reverifyPayment/pcode/"+payment_code,
            data:  rep,
           beforeSend: function(){
              /* $(".swal2-actions").addClass('hidden');
                $("#overlay").attr("style",'display:block;');
                console.log(rep['success']);*/
            },
            success: function (data) {
              if(data=='success' || data == 'Success'){
              /*   $("#overlay").attr("style",'display:none;');
                 $(".swal2-actions").addClass('hidden');*/
              	    $("#EzPaymentModal").modal("hide");
                /*  window.location.href = "/panchayatiraj/backoffice/investor/home/investorWalkthroughLevel2/type/SERVICES/financial_year/ALL"; */   
                   window.location.href = "/panchayatiraj/backoffice/investor/home/investorWalkthrough"; 

              }else{
              	$("#EzPaymentModal").modal("hide");
                var srn_no = $("#srnno").val();
                 // window.location.href = "/backoffice/investor/services/payment/srn_no/"+base64_encode(srn_no);  
                 window.location.href = window.location.href;
              }

            },

            error: function (jqXHR, textStatus, errorThrown) {

                alert('Error::' + errorThrown);

            }           

        });

// Vendor code to the handle response from payment processing on EZpay

}

$(function() {
  $('form').submit(function(e) {
     $("#overlay").attr("style",'display:block;');
  });
   $("#paynow").on("click",function(){
     $("#myModal").modal("show");

   })  
   $("#datepicker").datepicker( {
    format: "mm-yyyy",
    startView: "months", 
    minViewMode: "months"
});  
});
</script>


