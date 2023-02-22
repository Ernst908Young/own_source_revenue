<?php 
// echo"<pre>";print_r(@$_SESSION['RESPONSE']['user_id']);
//$getcc =   Yii::app()->db->createCommand("SELECT * from bo_information_wizard_service_parameters where CONCAT(service_id,'.',servicetype_additionalsubservice)=$model->service_id AND is_active='Y'")->queryRow(); 






$user_id = @$_SESSION['RESPONSE']['user_id'];
$user =  Yii::app()->db->createCommand("SELECT * FROM sso_profiles WHERE user_id = $user_id")->queryRow();
$cname =  $user['first_name'].' '.$user['last_name'].' '.$user['surname'];

$country = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$user['country_name'])->queryRow(); 

$state = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$user['state_name'])->queryRow(); 

  $fulladdress =     $user['address'].' '.$user['address2'].' '.$user['city_name'].' '. $user['pin_code'].' '.$state['lr_name'].' '.$country['lr_name']  ;



if($model['entity_name']){
	$com_detail = Yii::app()->db->createCommand("SELECT * from bo_company_details where reg_no='".$model['entity_name']."'")->queryRow(); 
	$com_name = $com_detail['company_name'] ? $com_detail['company_name'] : 'NA';

	$com_address = $com_detail['address'] ? $com_detail['address'] : 'NA';
}else{
	$com_name = 'NA';
	$com_address = 'NA';
}
//echo $model['submission_id'];


 $payment = Yii::app()->db->createCommand("SELECT * FROM tbl_payment WHERE payment_status='success' AND submission_id=".$model['submission_id'])->queryRow();

?>
  <div class="dashboard-home">
  <div class="applied-status">
  	<ul class="breadcrumb">
      <li><a href="/panchayatiraj/backoffice/investor/home/investorWalkthrough">Home</a></li>   
      <li>Refund Form</li>
    </ul>
  </div>
<div class="reservation-form">  
<form id="ticket_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/cashier/default/cancel"); ?>">

     <div class="form-part bussiness-det">   
        <h4 class="form-heading">Government of Uttar Pradesh Application for Refund</h4>
        <div class="form-row row">   
        	<input type="hidden" name="submission_id" value="<?= $model['submission_id']?>">
        <!-- <div class="col-md-6 form-group text-start mb-3">  	   		
	   		<label>Date</label> 
	   		<input type="date" class="form-control"  value ="">	   		
	   	</div>  -->
           <div class="clearfix"></div>

           <div class="col-md-6 form-group text-start mb-3">  	   		
	   		<label>Name of Applicant</label> 
	   		<input type="text" name="applicant_name" class="form-control"  value ="<?= $cname ?>" readonly>	   		
	   	</div> 
           <!-- <div class="col-md-6 form-group text-start mb-3">  	   		
	   		<label>Signature</label> 
	   		<input type="text" class="form-control"  value ="">	   		
	   	</div>  -->
           <div class="col-md-12 form-group text-start mb-3">  	   		
	   		<label>Address</label> 
	   		<textarea class="form-control" name="address" readonly ><?=   $fulladdress ?></textarea>   		
	   	</div> 
		   <div class="col-md-6 form-group text-start mb-3">  	   		
	   		<label>National Registration</label> 
	   		<input type="text" name="national_registration" class="form-control"  value ="">	   		
	   	</div> 
		   <div class="col-md-6 form-group text-start mb-3">  	   		
	   		<label>NIS Number</label> 
	   		<input type="text" name="nis_number" class="form-control"  value ="">	   		
	   	</div> 
		   <div class="col-md-12 form-group text-start mb-3">  	   		
	   		<label>Company Name</label> 
            <input type="text" name="company_name" class="form-control" readonly value ="<?= $com_name ?>">		

	   	</div> 
		   <div class="col-md-12 form-group text-start mb-3">  	   		
	   		<label>Company Address</label> 
	   		<textarea class="form-control" name="company_address" readonly><?= $com_address ?></textarea>   		
	   	</div> 
		   <div class="col-md-12 form-group text-start mb-3">  	   		
	   		<label>Reason for Change (Refund)</label> <span style="color:red;"> *</span>
	   		<textarea name="reason_for_change" class="form-control" required></textarea>   		
	   	</div> 
		   <div class="col-md-6 form-group text-start mb-3">  	   		
	   		<label>Amount requested for Refund</label> 
	   		<input type="text" name="fee_amount" class="form-control" readonly value ="<?= $payment['total_amount'] ?>" readonly>	   		
	   	</div> 
		   <div class="col-md-6 form-group text-start mb-3">  	   		
	   		<label>Officer Submitting Request</label> 
	   		<input type="text" name="officer_request" class="form-control"  value ="">	   		
	   	</div> 
		   <div class="col-md-6 form-group text-start mb-3">  	   		
	   		<label>Date</label> 
	   		<!-- <input type="date" class="form-control"  value ="">	   	 -->	
	   		<input type="text" name="refund_date" class="form-control"  value ="<?= date('d-m-Y') ?>" readonly>
	   	</div>
           <div class="clearfix"></div>
		   <p>NB: Please attach the Original Receipt to assist with processing</p>
           <div class="form-row row">
	   		<div class="form-group col-md-12"  style="text-align: center;">
	   	      <button type="submit" class="btn-secondary" style="font-size: 18px; width: 120px;">Refund</button>
	   	    </div>
	   </div>
    </div>
       </form>
</div> 
</div>
<script type="text/javascript">
$(document).ready(function(){

});
</script>