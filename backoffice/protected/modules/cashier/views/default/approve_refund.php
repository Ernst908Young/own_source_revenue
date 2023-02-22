<?php 
$getcc =   Yii::app()->db->createCommand("SELECT * from bo_information_wizard_service_parameters where CONCAT(service_id,'.',servicetype_additionalsubservice)='".$model['service_id']."' AND is_active='Y'")->queryRow(); 
$user_id = @$_SESSION['uid'];
$user =  Yii::app()->db->createCommand("SELECT * FROM bo_user WHERE uid = $user_id")->queryRow();
$cname =  $user['full_name'].' '.$user['last_name'].' '.$user['middle_name'];
//print_r($model);die;
?>
<?php if(Yii::app()->user->hasFlash('success')): ?>

<div style="text-align:center;font-size:16px;color:green;">
    <?php echo Yii::app()->user->getFlash('success'); ?>
</div>

<?php endif; ?> 
<?php if(Yii::app()->user->hasFlash('error')): ?>

<div style="text-align:center;font-size:16px;color:red;">
    <?php echo Yii::app()->user->getFlash('error'); ?>
</div>

<?php endif; ?> 
 <div class="dashboard-home">
  <div class="applied-status">
  	<ul class="breadcrumb">
      <li><a href="/backoffice/investor/home/investorWalkthrough">Home</a></li>   
      <li>Refund Request</li>
    </ul>
  </div>
<div class="reservation-form">  
<form id="ticket_form" method="post">
     <div class="form-part bussiness-det">   
        <h4 class="form-heading">Payment Detail</h4>
        <div class="form-row row">   
      
    	<div class="col-md-6 form-group text-start mb-3">  
	   		
	   		<label>Service Name</label> 
	   		<input type="text" class="form-control"  value ="<?= $getcc['core_service_name'] ?>" readonly>
	   		
	   	</div>   
		   <div class="col-md-6 form-group text-start mb-3">  
	   		
	   		<label>SRN No.</label> 
	   		<input type="text" class="form-control" name="submission_id"  value ="<?= $sub_id ?>" readonly>
	   		
	   	</div>   
		   <div class="col-md-6 form-group text-start mb-3" >
	   		
	   		<label>National Registration</label>
	   		<input type="text" class="form-control" value ="<?= !empty($refund_request['national_registration'])?$refund_request['national_registration']:'NA'?>"readonly  >
	   		
	   	</div>
		   <div class="col-md-6 form-group text-start mb-3" >
	   		
	   		<label>NIS No.</label>
	   		<input type="text" class="form-control" value ="<?= !empty($refund_request['nis_number'])?$refund_request['nis_number']:'NA'?>"readonly  >
	   		
	   	</div>
           <div class="col-md-6 form-group text-start mb-3">
	   		
	   		<label>Service Fee</label>
	   		<input type="text" class="form-control"  value ="$ <?= $model['service_total_fee'] ?>" readonly>
	   		
	   	</div>     
        <div class="col-md-6 form-group text-start mb-3">
	   		
	   		<label>Cashier Code</label>
	   		<input type="text" class="form-control"  value ="<?=  $getcc['cashier_code'] ?>" readonly>
	   		
	   	</div>
		   
        <div class="col-md-6 form-group text-start mb-3">
		<?php if($model['payment_mode'] == 3){ // Offline payment ?>
	   		<label>Receipt Number</label>
	   		<input type="text" class="form-control"  value ="<?= $model['chalan_no'] ?>" readonly>
	    <?php } else { ?>
			<label>Transaction No.</label>
	   		<input type="text" class="form-control"  value ="<?= $model['transaction_number'] ?>" readonly>
        <?php } ?>	   		
	   	</div>  
           
           <div class="col-md-6 form-group text-start mb-3">
	   		
	   		<label>Applicant Name</label>
	   		<input type="text" class="form-control" value="<?= $model['reference_name'] ?>"  readonly>
	   		
	   	</div>
           <div class="col-md-6 form-group text-start mb-3">
	   		
	   		<label>Applicant Contact No</label>
	   		<input type="text" class="form-control" value="<?= $model['reference_number'] ?>"  readonly>
	   		
	   	</div>
           <div class="col-md-6 form-group text-start mb-3">
	   		
	   		<label>Applicant Email</label>
	   		<input type="text" class="form-control" value="<?= $model['reference_email'] ?>"  readonly>
	   		
	   	</div>
           <div class="col-md-6 form-group text-start mb-3">
	   		
	   		<label>Cashier Name</label>
	   		<input type="text" class="form-control" value="<?= $cname ?>"  readonly>
	   		<input type="hidden" name="payment_received_by" value="<?= $user_id ?>" class="form-control"  readonly>
	   		
	   	</div>
		  <?php if($model['payment_mode'] == 3){ // Offline payment ?>
           <div class="col-md-6 form-group text-start mb-3">
                 
                <label>Payment Type <span style="color: red;">*</span></label>
	   		<?php
	   			$type = array('Cash'=>'Cash','DD'=>'DD','Cheque'=>'Cheque');
	   		?>
 	
	   		<select name="type" placeholder="Select type" id="type"  required style="appearance: auto;">
				<option value="">Select Payment Type </option>
					<?php foreach ($type as $key => $val) { ?>
					<option value="<?php echo $key; ?>" ><?php echo $val; ?></option>
				<?php } ?>
			</select> 
		
			<span id="type-error" style="color: red;"></span>	 
          </div>
        <?php } ?>
           <div class="col-md-6 form-group text-start mb-3" >
	   		
	   		<label>Reason for Change (Refund)</label>
	   		<input type="text" class="form-control" value ="<?= !empty($refund_request['reason_for_change'])?$refund_request['reason_for_change']:'NA'?>"readonly  >
	   		
	   	</div>
		   
           <div class="col-md-6 form-group text-start mb-3" id="payment_no">
	   		
	   		<label>Payment Refrence No.</label>
	   		<input type="text" class="form-control" value ="<?= $model['payment_offline_detail_no']?>"  >
	   		
	   	</div>
 

<!-- <div class="col-md-6 form-group text-start mb-3" id="bank_name">
	   		
	   		<label>Bank Name</label>
	   		<input type="text" name="" class="form-control" value ="<?= $model['bank_name'] ?>" >
	   		
	   	</div> -->

	   		<div class="col-lg-12 form-group text-start mb-3">
            <label>Comments </label><span style="color:red;"> *</span>
			<textarea name="items" class="form-control" placeholder="Enter Comments"required></textarea>
             </div>
        </div>
        <div class="form-row row">
	   		<div class="form-group col-md-12"  style="text-align: center;">
	   	      <button type="submit" class="btn-secondary" style="font-size: 18px; width: 120px;">Submit</button>
	   	    </div>
	   </div>
    </div>
       </form>
</div> 
</div>

