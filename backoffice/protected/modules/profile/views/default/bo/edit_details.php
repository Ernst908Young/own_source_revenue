<div class="dashboard-home">
    <div class="applied-status">
    	<ul class="breadcrumb">
        <li><a href="/panchayatiraj/backoffice/admin">Home</a></li>   
        <li><a href="/panchayatiraj/backoffice/profile/default/myaccountbo">My Account</a></li>   
         </li>
          <li>Edit Account Details</li>
          </ul>
      
             </div>
        </div>
<div class="reservation-form">
	<div class="form-part bussiness-det">   
        <h4 class="form-heading">Edit Your Account Details</h4>
        	<form id="editprofile" method="post" enctype='multipart/form-data'>
		        <div class="form-row row"> 
		        	<?php 
		        	$uid = $_SESSION['uid'];
						$profiledetail = Yii::app()->db->createCommand("SELECT * FROM bo_user WHERE uid=".$uid)->queryRow();    
						 $signaturedetail = Yii::app()->db->createCommand("SELECT * FROM tbl_bo_signature_detail WHERE userid=".$uid)->queryRow();	
					?>
		        	<input type="hidden" name="uid" value="<?php echo base64_encode($uid) ?>">
		        	<div class="col-md-6 form-group mb-3">
		        		  <label>First Name</label>
		        		<input type="text" name="full_name" value="<?= $profiledetail['full_name'] ?>" required />
		        	</div>
					<div class="col-md-6 form-group mb-3">
		        		  <label>Middle Name</label>
		        		<input type="text" name="middle_name" value="<?= $profiledetail['middle_name'] ?>" />
		        	</div>
		        	<div class="col-md-6 form-group mb-3">
		        		  <label>Surname</label>
		        		<input type="text" name="last_name" value="<?= $profiledetail['last_name'] ?>" required />
		        	</div>
				
					
					<div class="col-md-6 form-group mb-3">
		        		  <label>Mobile</label>
		        		<input type="number" onblur="checklength($(this).val())" id="mobile" maxlength="10" minlength="10" name="mobile" value="<?= $profiledetail['mobile'] ?>" />
		        		<span class='errors' id="mobileerror" style='color:red;'></span>
		        	</div>

		        	<div class="col-md-6 form-group mb-3">
		        		  <label>Fax</label>
		        		<input type="text" name="fax" value="<?= $profiledetail['fax'] ?>"  />
		        	</div>
					<div class="col-md-6 form-group mb-3">
		        		  <label>Delegate Officer No</label>
		        		<input type="text" name="delegate_officer_number" value="<?= $profiledetail['delegate_officer_number'] ?>" />
		        	</div>
		        	<div class="col-md-6 form-group mb-3">
		        		  <label>Delegate Officer Name</label>
		        		<input type="text" name="delegate_officer_name" value="<?= $profiledetail['delegate_officer_name'] ?>"  />
		        	</div>
		        	<div class="col-md-6 form-group mb-3">
		        		  <label>Delegate Officer Email</label>
		        		<input type="text" name="delegate_officer_email" value="<?= $profiledetail['delegate_officer_email'] ?>" />
		        	</div>
		        	<div class="col-md-6 form-group mb-3">
		        		  <label>Office Number</label>
		        		<input type="text" name="office_no" value="<?= $profiledetail['office_no'] ?>" />
		        	</div>
		        	<div class="col-md-6 form-group mb-3">
		        	<?php if($signaturedetail){ 
		        		$sign_path = Yii::app()->theme->baseUrl.'/img/'.$signaturedetail['signature'];
		        		?>
		        		<img src="<?=  $sign_path ?>" style="width:100px; height:50px;">
		        	<?php } ?>
		        	
		        		  <label>Update Signature</label>
		        		<input type="file" name="sign" accept="image/png, image/jpeg"  />
		        	</div>
		        	
				
		        </div>
		        <div class="form-row" style="text-align: center;">
		        	<div class="col-lg-12">        		
		        		<button type="submit" name="editprofile" id="submitbtn" class="btn-primary">Submit</button>
		 			</div>
		        </div>
			</form>
    </div>

</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
	function checklength(mlen){
		if(mlen){
			mlen = $('#mobile').val().length;
			  if(mlen==10){				  	
				$('#submitbtn').prop('disabled', false);
				$("#mobileerror").html("");
			  }else{			  
			  	$("#mobileerror").html( "Please put 10 digit mobile number");
				$('#submitbtn').prop('disabled', true);
			  }			
		}else{
			$('#submitbtn').prop('disabled', false);
			$("#mobileerror").html("");
		}
	}

function checkDob() {
	if($("#dob").val()!=""){
		var dateString = $("#dob").val();
		var parts = dateString.split("-");
		
		var dtDOB = new Date(parts[1] + "-" + parts[2] + "-" + parts[0]);
		var dtCurrent = new Date();
		if (dtCurrent.getFullYear() - dtDOB.getFullYear() < 18) {
			//$("#dob").find(".error").distroy;
			$("#doberror").html( "Age limit for the applicant is 18 years.");
			$('#submitbtn').prop('disabled', true);
			return false;
		}
		else{
			$('#submitbtn').prop('disabled', false);
			$("#doberror").html( "");
			
		}
		
	}
}
</script>