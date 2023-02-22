<title>CTSP - Late Fee Payment Page</title>
<style type="text/css">
#overlay {
    position: fixed;
  top:0%;
  left:0%;
  width:100%;
  height:100%;  
  background: black;
  opacity: .2;
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
}
 .form-part.bussiness-det .form-group > div {
    margin-bottom: 0px;
}
.form-control-feedback{
  color: red;
}
</style>

<div id="overlay" style="display: none;">
  <div id="overlay_text" style="color: red;">
      <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
      <span class="sr-only">Loading...</span>
  </div>
</div>

<div class="dashboard-home">
  <div class="applied-status">
    <ul class="breadcrumb">
      <li><a href="/backoffice/investor/home/investorWalkthrough">Home</a></li>   
      <li><a href="/backoffice/investor/serviceprovider/observiceprovider/obsp/1">Onboard <?= $model->sp_type ?></a></li>
      <li>Late Fee Payment</li>
    </ul>
  </div>
<div class="reservation-form">  
    <div class="form-part bussiness-det">   
        <h4 class="form-heading">Late Fee Payment Form</h4>
		  <form id="spp_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/investor/serviceprovider/paymentsave"); ?>">
		  	<input type="hidden" name="id" value="<?= $model->id ?>">
		  	<div class="form-row row">
		  		<div class="form-group col-md-6 text-start mb-3">                  
                      <label>Selected Entity</label>
                      <?php
                      	$company = Yii::app()->db->createCommand("SELECT * FROM bo_company_details 
								where  id=$model->company_id")->queryRow();
                      	$comap_name = $company['company_name'];
                       ?>
                      <input type="text" class="form-control" readonly value="<?= $comap_name ?>">           
                </div>
                <div class="form-group col-md-6 text-start mb-3">                  
                      <label>Entity Reg. No.</label>
                      <?php
                      
                      	$comap_regno = $company['reg_no'];
                       ?>
                      <input type="text" class="form-control" readonly value="<?= $comap_regno ?>">
                </div>  
                <div class="form-group col-md-6 text-start mb-3">  
                   <?php 
               $app_details = Yii::app()->db->createCommand("SELECT *, CONCAT(up.first_name,' ',up.last_name,' ',up.surname) as name, u.mobile_no, u.email
  FROM sso_users u 
    INNER JOIN sso_profiles up on u.user_id=up.user_id
       where u.user_id=".$model->user_id)->queryRow(); 
                   ?>             
                      <label>Applicant Name</label>
                       <?php
                          $app_name = $app_details['name'];
                       ?>
                     <input type="text" class="form-control" readonly value="<?= $app_name ?>">           
                </div>
                <div class="form-group col-md-6 text-start mb-3">                  
                      <label>Applicant Email ID</label>
                      <?php                      
                        $app_email = $app_details['email'];
                       ?>
                      <input type="text" class="form-control" readonly value="<?= $app_email ?>">
                </div>  
               
<?php 
if($model->agent_user_id){
	$ctsp_details = Yii::app()->db->createCommand("SELECT *, CONCAT(up.first_name,' ',up.last_name,' ',up.surname) as name, u.mobile_no, u.email
	FROM sso_users u 
		INNER JOIN sso_profiles up on u.user_id=up.user_id
	     where u.user_id=".$model->agent_user_id)->queryRow();
}else{
	$ctsp_details = ['name'=>$model->first_name.' '.$model->middle_name.' '.$model->surname,'mobile_no'=>$model->mobile,'email'=>$model->email];
}


?>
                 <div class="col-md-6 form-group text-start mb-3">	   		
			   		<label>CTSP Name</label>
			   		<input type="text" class="form-control" value="<?= $ctsp_details['name'] ?>"  readonly>
				</div>
			   <div class="col-md-6 form-group text-start mb-3">					
					<label>CTSP Contact No</label>
					<input type="text" class="form-control" value="<?= $ctsp_details['mobile_no'] ?>"  readonly>					
				</div>
			   <div class="col-md-6 form-group text-start mb-3">					
					<label>CTSP Email</label>
					<input type="text" class="form-control" value="<?= $ctsp_details['email'] ?>"  readonly>	
				</div>
		  		<div class="form-group col-md-6 text-start mb-3">                  
                      <label>Total Late Fee</label>
                      <input type="text" class="form-control" name="late_fee" readonly value="<?= $model->late_fee ?>">                    
                </div>
		 	</div>
		 <div class="form-row row"> 
       <div class="d-flex justify-content-center">

        <?php 
        $message = '';  $reverify_btn = false;
        $checkpayment = Yii::app()->db->createCommand("SELECT * FROM agent_service_provider_payment WHERE asp_id = $model->id ORDER BY id DESC")->queryRow();
        if(empty($checkpayment) && $model->sp_status=='PD'){
           $form_show = true;
        }else{
          if($checkpayment){
            if($checkpayment['payment_mode']==2){
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
                $form_show = false;
                $message = 'Sorry something went worg please connect to support';
          }
        } ?>

   <?php if($form_show==true){ ?>
      <div class="mx-2" style="" id="ezpay_button"></div>
     <div class="mx-2">
      <button type="submit" class="btn btn-secondary" title="Persons can make payment at the Cashier's booth at our Office located at Baobab Tower, Warrens, St. Michael. This facility is available to persons who do not have access to credit card or debit payment facilities. Persons must book an appointment to visit our Office via https://booking.appointy.com/en-US/caiposearch/bookings/service." style="margin-bottom: 5px;">
        PAY AT COUNTER                               
     </button>
    </div>
     <div class="mx-2">
    <?php  echo '<a href="/backoffice/investor/serviceprovider/obspupdate/obsp/1/asp_id/'.base64_encode($model->id).'" class="btn btn-primary backbtn mx-2">Back</a>'; ?>
  </div>
 <?php }else{
  echo $message.'<br><br>'; 
    if($reverify_btn==true){
     $transaction_no = $checkpayment['transaction_number'];
  ?>
   <a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('investor/services/verifyPaymentDetail/tno/'.base64_encode($transaction_no));?>" title="Reverify Payment" class="btn btn-secondary">Reverify Payment             
   </a>
 <?php } } ?>

        
              
      </div>
    </div>
		  </form>
		</div>
	</div>
</div>


<script src="https://dev.ezpay.gov.bb/portal/scripts/ezpay_plugin_eservices.js" type="text/javascript">
</script>


<script>
  $(document).ready(function(){
    $("#ezpay_payment_button").attr('style','height:35px;');
  });
function LoadEzpayButton()
{

ez_payment_code = "53lwVYrKHx";  // Payment Code for the Specific form or Service(From Ezpay)
ez_payment_amount = <?= $model->late_fee ?>; //Total Amount the User will pay
ez_payment_details = "Late fee service provider"; // Description of the Service
ez_process_id = <?= $model['id']?>;//"12345678912345678912"; // Services Unique Identifier
ez_reference_email = "<?= $app_email ?>"; // Receipts can be emailed to the reference email
ez_reference_name = "<?= $app_name  ?>"; // Name of the User/Applicant
ez_reference_number = <?= $app_details['mobile_no']?>; // Vendor's reference number
$("#EzPaymentModal").modal("show"); //Open the Ezpay Modal
}

function ezpay_callback(response)
{

 var payment_code = "53lwVYrKHx"; 
 var s = response.split('{')[1]; // remove notice and warning error
 var data = '{'+s;

var rep = JSON.parse(data); // Parsed to an array
 $("#overlay").attr("style",'display:block;');
 $(".swal2-actions").addClass('hidden');
$.ajax({

            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/investor/serviceprovider/reverifyPayment/pcode/"+payment_code,
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
                /*  window.location.href = "/backoffice/investor/home/investorWalkthroughLevel2/type/SERVICES/financial_year/ALL"; */   
                   window.location.href = "/backoffice/investor/serviceprovider/observiceprovider/obsp/1"; 

              }else{
                $("#EzPaymentModal").modal("hide");
               
                 // window.location.href = "/backoffice/investor/services/payment/srn_no/"+base64_encode(srn_no);  
                 window.location.href = "/backoffice/investor/serviceprovider/observiceprovider/obsp/1"; 
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
});
</script>


