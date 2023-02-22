<div class="dashboard-home">
    <div class="applied-status">
    	<ul class="breadcrumb">
          <li><a href="/backoffice/investor/home/investorWalkthrough">Home</a></li>
           <li><a href="/backoffice/profile/default/agentaccount">My Account Detail</a></li>
         </li>
          <li>Edit Account Details</li>
          </ul>
      
             </div>
        </div>
<div class="reservation-form">
	<div class="form-part bussiness-det">   
        <h4 class="form-heading">Edit Your Account Details</h4>
        	<form id="editprofile" method="post">
		        <div class="form-row row"> 
		        	<?php 
						$profiledetail = Yii::app()->db->createCommand("SELECT * FROM sso_profiles WHERE user_id=".$_SESSION['RESPONSE']['agent_user_id'])->queryRow();     	
					?>
		        	<input type="hidden" name="user_profile_id" value="<?php echo $profiledetail['profile_id'] ?>">
		        	<div class="col-md-6 form-group mb-3">
		        		  <label>First Name</label>
		        		<input type="text" name="first_name" value="<?= $profiledetail['first_name'] ?>" required />
		        	</div>
					<div class="col-md-6 form-group mb-3">
		        		  <label>Middle Name</label>
		        		<input type="text" name="middle_name" value="<?= $profiledetail['last_name'] ?>" />
		        	</div>
		        	<div class="col-md-6 form-group mb-3">
		        		  <label>Surname</label>
		        		<input type="text" name="surname" value="<?= $profiledetail['surname'] ?>" required />
		        	</div>
					<div class="col-md-6 form-group mb-3">
						<label>Gender </label>
						<select id="gender" name="gender" required />
							<option value="">Select Gender</option>
							<option value="male" <?= ($profiledetail['gender']=='male') ? 'selected' : ''?>>Male</option>
							<option value="female" <?= ($profiledetail['gender']=='female') ? 'selected' : ''?>>Female</option>
						</select>
					</div>
					
					<div class="col-md-6 form-group mb-3">
		        		  <label>Date of Birth</label>
		        		<input type="date" id="dob" name="dob" value="<?= $profiledetail['date_of_birth'] ?>" required="required" onchange="checkDob()" />
						<span class='errors' id="doberror" style='color:red;'></span>
					</div>
					<div class="col-md-6 form-group mb-3">
		        		  <label>Telephone(Office)</label>
		        		<input type="number" name="telephone" value="<?= $profiledetail['telephone'] ?>" onchange="checkDob()" />
		        	</div>
		        	<div class="col-md-6 form-group mb-3">
					<?php $country_arr = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where parent_id=0 AND lr_type='country' AND is_lr_active='Y' ")->queryAll(); ?>
		        		  <label>Nationality</label>
		        		 <select name="nationality" required>
		        		  	<option value="">Select Nationality</option>
		        		  	<?php foreach($country_arr as $key=>$val){ 
		        		  		$cs = $val['lr_id']==$profiledetail['nationality'] ? 'selected' : '';
		        		  		?>
		        		  		<option value="<?php echo $val['lr_id'] ?>" <?= $cs ?>>
		        		  			<?= $val['lr_name'] ?>
		        		  		</option>
		        		  	<?php	} ?>
		        		  </select>
		        	</div>
		        <!-- 	<div class="col-md-6 form-group mb-3">
		        		  <label>Pan Card Number</label>
		        		<input type="text" name="pan_card" value="<1?= $profiledetail['pan_card'] ?>" />
		        	</div> -->
		        	<div class="col-md-6 form-group mb-3">
		        		  <label>Address Line 1</label>
		        		<input type="text" name="address" value="<?= $profiledetail['address'] ?>" required />
		        	</div>
		        	<div class="col-md-6 form-group mb-3">
		        		  <label>Address Line 2</label>
		        		<input type="text" name="address2" value="<?= $profiledetail['address2'] ?>" />
		        	</div>
		        	
					
					<div class="col-md-6 form-group mb-3">
					<?php $country_arr = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where parent_id=0 AND lr_type='country' AND is_lr_active='Y' ")->queryAll(); ?>
		        		  <label>Country</label>
		        		 <select name="country" required>
		        		  	<option value="">Select country</option>
		        		  	<?php foreach($country_arr as $key=>$val){ 
		        		  		$cs = $val['lr_id']==$profiledetail['country_name'] ? 'selected' : '';
		        		  		?>
		        		  		<option value="<?php echo $val['lr_id'] ?>" <?= $cs ?>>
		        		  			<?= $val['lr_name'] ?>
		        		  		</option>
		        		  	<?php	} ?>
		        		  </select>
		        	</div>
					<div class="col-md-6 form-group mb-3">
						<?php $state_arr = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_type='state' AND is_lr_active='Y' ")->queryAll(); ?>
		        		  <label>State/Parish</label>
		        		  <select name="state_parish" required>
		        		  	<option value="">Select state/parsih</option>
		        		  	<?php foreach($state_arr as $k=>$v){ 
		        		  		$ss = $v['lr_id']==$profiledetail['state_name'] ? 'selected' : '';
		        		  		?>
		        		  		<option value="<?php echo $v['lr_id'] ?>" <?= $ss ?>>
		        		  			<?= $v['lr_name'] ?>
		        		  		</option>
		        		  <?php	} ?>
		        		  </select>
		       		</div>
					<div class="col-md-6 form-group mb-3">
		        		  <label>City</label>
		        		<input type="text" name="city_name" value="<?= $profiledetail['city_name'] ?>"  />
		        	</div>
		        	<div class="col-md-6 form-group mb-3">
		        		  <label>Postal Code</label>
		        		<input type="text" name="pin_code" value="<?= $profiledetail['pin_code'] ?>"  />
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