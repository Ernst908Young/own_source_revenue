<?php 



$user_id = @$_SESSION['uid'];
$user =  Yii::app()->db->createCommand("SELECT * FROM bo_user WHERE uid = $user_id")->queryRow();
$cname =  $user['full_name'].' '.$user['last_name'].' '.$user['middle_name'];
?>
<div class="dashboard-home">
  <div class="applied-status">
    <ul class="breadcrumb">
      <li><a href="/backoffice/admin">Home</a></li>   
      <li>Document Fee Payment Due</li>
    </ul>
</div>
<div class="reservation-form">  
<form id="lf_form" method="post">
	  <div class="form-part bussiness-det">   
        <h4 class="form-heading">Submit Document Fee Payment</h4>
        <input type="hidden" name="vpd_id" value="<?= $model['id'] ?>">
        <div class="form-row row"> 
        	 <div class="col-md-6 form-group text-start mb-3">
	   		
	   		<label>Document Fee</label>
	   		<input type="text" class="form-control" name="total_fee" value ="$ <?= $model['total_fee'] ?>" readonly>
	   		
	   	</div>     
      
        <div class="col-md-6 form-group text-start mb-3">
	   		
	   		<label>Receipt Number</label>
	   		<input type="text" class="form-control" name="chalan_no" value ="<?= $model['recipet_no'] ?>" readonly>
	   		
	   	</div>  
           
           <div class="col-md-6 form-group text-start mb-3">
	   		
	   		<label>Applicant Name</label>
	   		<input type="text" class="form-control" value="<?= $model['app_name'] ?>"  readonly>
	   		
	   	</div>
           <div class="col-md-6 form-group text-start mb-3">
	   		
	   		<label>Applicant Contact No</label>
	   		<input type="text" class="form-control" value="<?= $model['mobile_no'] ?>"  readonly>
	   		
	   	</div>
           <div class="col-md-6 form-group text-start mb-3">
	   		
	   		<label>Applicant Email</label>
	   		<input type="text" class="form-control" value="<?= $model['email'] ?>"  readonly>
	   		
	   	</div>
           <div class="col-md-6 form-group text-start mb-3">
	   		
	   		<label>Cashier Name</label>
	   		<input type="text" class="form-control" value="<?= $cname ?>"  readonly>
	   		<input type="hidden" name="payment_received_by" value="<?= $user_id ?>" class="form-control"  readonly>
	   		
	   	</div>
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
           <div class="col-md-6 form-group text-start mb-3" id="payment_no">
	   		
	   		<label>Payment Refrence No.</label><span style="color:red;"> *</span>
	   		<input type="text" id="refrence" name="payment_offline_detail_no" class="form-control">
	   		
	   	</div>
 

<div class="col-md-6 form-group text-start mb-3" id="bank_name">
	   		
	   		<label>Bank Name</label><span style="color:red;"> *</span>
	   		<input type="text" id="banknameid" name="bank_name" class="form-control">
	   		
	   	</div>

	   		<div class="col-lg-12 form-group text-start mb-3">
            <label>Comments </label><span style="color:red;"> *</span>
	   		<input type="text" name="subject" class="form-control" placeholder="Enter Comments" required>
             </div>
        </div>
        <div class="form-row row">
	   		<div class="form-group col-md-12"  style="text-align: center;">
	   	      <button type="submit" class="btn-secondary" style="font-size: 18px; width: 120px;">Submit</button>
	   	    </div>
	   </div>  
        </div>
    </div>
	</form>
</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("#payment_no,#bank_name").hide();		
$("#type").on('change', function() {
        var code = $(this).val();
		if(code === 'Cash' || code==''){
			$("#payment_no,#bank_name").hide();		
			$("#refrence,#banknameid").removeAttr('required');
			$("#refrence,#banknameid").val("");
		}else{
			$("#payment_no,#bank_name").show();
			$("#refrence,#banknameid").attr('required', 'required');
		}
    });
});
</script>