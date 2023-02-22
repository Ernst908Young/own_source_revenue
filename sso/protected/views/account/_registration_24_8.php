<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php  $basePath="/themes/investuk/assets/signin"; ?>
<style>
    .captchainput{
        width:25px;
        border:0;
        background-color: transparent;
		margin-top: 15px;
    }

    .captchainput:focus{
        box-shadow: 0 !important;
        outline: none;
    }
	#captcharesult{
		display: none;
	}
	/* Chrome, Safari, Edge, Opera */
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	  -webkit-appearance: none;
	  margin: 0;
	}

	/* Firefox */
	input[type=number] {
	  -moz-appearance: textfield;
	}
</style>
<form id="register-form" name="register-form" action="" method="post" role="form" data-toggle="validator" class="sky-form">
	<input type="hidden" name="CALL_BACK_URL" value="<?php echo $CALL_BACK_URL; ?>" />
	<input type="hidden" name="callback_failure_url" value="<?php echo $callback_failure_url; ?>" />
	<input type="hidden" name="callback_success_url" value="<?php echo $callback_success_url; ?>" />
				
    
	<p style="color:red; font-size: 12px;">"Fields marked with * are mandatory fields."</p>
	<div class="row">
		<div class="form-group col-md-6">
			<label class="small mb-1" for="inputname">First Name <span style="color:red;font-size:13px"> *</span></label>
			<input class="form-control" id="fname" name="Profile[first_name]" type="text" placeholder="First Name" value="<?= ($_GET['first_name']!='' ? $_GET['first_name'] : '' )?>" <?= ($_GET['first_name']!='' ? 'readonly' : '' )?>>
		</div>
		<div class="form-group col-md-6">
			<label class="small mb-1" for="inputname">Middle Name</label>
			<input class="form-control" id="mname" name="Profile[last_name]" type="text" placeholder="Middle Name"  value="<?= ($_GET['middle_name']!='' ? $_GET['middle_name'] : '' )?>" <?= ($_GET['middle_name']!='' ? 'readonly' : '' )?>>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6">
			<label class="small mb-1" for="inputname">Last Name <span style="color:red;font-size:13px"> *</span></label>
			<input class="form-control" id="lname" name="Profile[surname]" type="text" placeholder="Last Name"  value="<?= ($_GET['surname']!='' ? $_GET['surname'] : '' )?>" <?= ($_GET['surname']!='' ? 'readonly' : '' )?>>
		</div>
		<?php if($_GET['middle_name']==""):?>
		<div class="form-group col-md-6">
			<input type="checkbox" id="mnamechekbox" name="middlenamecheckbox"  <?= (isset($_GET['middle_name']) ? 'checked' : '' )?>>
			<label for="middlenamecheckbox"> I don't have middle name</label><br>
			<span style="color:red" id="middlenameerror"></span>
		</div>
		<?php endif;?>
		
	</div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group"> 
                <label class="small mb-1" for="gender">Gender <span style="color:red;font-size:13px"> *</span></label>
                <select class="form-control" id="gender" name="Profile[gender]">
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="small mb-1" for="dob">Date of Birth <span style="color:red;font-size:13px"> *</span></label>
                    <input class="form-control" id="dob" name="Profile[dob]" type="date"  required="required" onchange="checkDob()">
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-md-6">
    <div class="form-group">
        <label class="small mb-1" for="mobile">Mobile no. <span style="color:red;font-size:13px"> *</span></label>
        <div class="d-flex justify-content-between">
		
                <input class="form-control" id="mobile" name="Users[mobile_no]" type="number"
                    placeholder="Mobile no." required="required"  maxlength="10" onblur="checkMobileExist()"  value="<?= ($_GET['mobile']!='' ? $_GET['mobile'] : '' )?>" >    
        </div>
    </div>
	<span style="color:red" id="mobspanerror"></span>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="small mb-1" for="telcountrycode">Telephone(Office)</label>
                <div class="d-flex justify-content-between">
                    
                        <input class="form-control" id="telephone" name="Profile[telephone]" type="number"
                            placeholder="Telephone(Office)" maxlength="10">    
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="email">Email Id <span style="color:red;font-size:13px"> *</span></label>
        <input class="form-control" id="email" name="Users[email]" type="email"
            placeholder="Email Id" required="required"  value="<?= ($_GET['email']!='' ? $_GET['email'] : '' )?>">
    </div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="small mb-1" for="inputnational">Password <span style="color:red;font-size:13px"> *</span></label>
				<input class="form-control" id="password1"name="Users[password]" type="password"
					placeholder="Password"  onblur="checkPassword()">
			</div>
		</div>
	
		<div class="col-md-6">
			<div class="form-group">
				<label class="small mb-1" for="inputnational">Confirm Password <span style="color:red;font-size:13px"> *</span></label>
				<input class="form-control" id="password2" name="confirm_password" type="password"
					placeholder="Confirm password" onblur="checkConfirmPassword()" >
			</div>
		</div>
	</div>
    
    <div class="form-group">
		<label class="small mb-1" for="inputaddress">Registered Address <span style="color:red;font-size:13px"> *</span></label>
		<input class="form-control mb-3" id="address1" name="Profile[address]" type="text"
			placeholder="Address Line 1">
		<input class="form-control" id="address2" name="Profile[address2]" type="text"
		placeholder="Address Line 2">
	</div>
	<div class="row">
		<div class="form-group col-md-4">
			<label class="small mb-1" for="nationality">Nationality <span style="color:red;font-size:13px"> *</span></label>
        
		<?php 
			$active='Y';
			/* $sql = "SELECT lr.lr_id,lr.lr_name FROM bo_landregion lr INNER JOIN bo_country bc ON lr.lr_id = bc.lr_id WHERE lr.is_lr_active=:active"; */
			
			$sql = "SELECT lr.lr_id,lr.lr_name FROM bo_landregion lr WHERE lr.lr_type='country' and  lr.is_lr_active=:active";
			$connection = Yii::app()->db;
			$command = $connection->createCommand($sql);
			$command->bindParam(":active", $active, PDO::PARAM_STR);
			$countries = $command->queryAll();
			//echo "<--<pre>".print_r($countries);echo "</pre>-->";
			if (isset($countries)) {
				 echo "<select id='nationality' name=Profile[nationality] class='register-sbox form-control' required='required'>";
				 echo "<option value='' selected disabled>Nationality</option>";
				 foreach ($countries as $country)
					 echo "<option value='$country[lr_id]'>$country[lr_name]</option>";
				 echo "</select>";
				 echo "<i></i>";
			} else {
				 echo"<input type='text' name=Profile[nationality] id='nationality' class='register-tbox form-control' placeholder='Please select your nationality'";
			}
		?>
		</div>
		<div class="form-group col-md-4">
			<label class="small mb-1" for="inputname">Country <span style="color:red;font-size:13px"> *</span></label>
			<!--select class="form-control" id="country" name="Profile[country_name]">
				<option>Select Country</option>
				<option value="1">Country 1</option>
				<option value="2">Country 2</option>
			</select-->
			<?php 
				$active='Y';
				/* $sql = "SELECT lr.lr_id,lr.lr_name FROM bo_landregion lr INNER JOIN bo_country bc ON lr.lr_id = bc.lr_id WHERE lr.is_lr_active=:active"; */
				
				$sql = "SELECT lr.lr_id,lr.lr_name FROM bo_landregion lr WHERE lr.lr_type='country' and  lr.is_lr_active=:active";
				$connection = Yii::app()->db;
				$command = $connection->createCommand($sql);
				$command->bindParam(":active", $active, PDO::PARAM_STR);
				$countries = $command->queryAll();
				//echo "<--<pre>".print_r($countries);echo "</pre>-->";
				if (isset($countries)) {
					 echo "<select id='country' name=Profile[country_name] class='register-sbox form-control' required='required'>";
					 echo "<option value='' selected disabled>Country</option>";
					 foreach ($countries as $country)
						 echo "<option value='$country[lr_id]'>$country[lr_name]</option>";
					 echo "</select>";
					 echo "<i></i>";
				} else {
					 echo"<input type='text' name=Profile[country_name] id='country' class='register-tbox form-control' placeholder='Pleas Enter your country'";
				}user_type
			?>
			
		</div>
		<div class="form-group col-md-4">
			<label class="small mb-1" for="inputname">State/Parish <span style="color:red;font-size:13px"> *</span></label>
			<select required="required" id="state" name="Profile[state_name]" class="register-sbox form-control">
				<option value="" selected disabled>State</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6">
			<label class="small mb-1" for="inputaddress">City <span style="color:red;font-size:13px"> *</span></label>
		<input class="form-control" id="city" name="Profile[city_name]" type="text" placeholder="City">
		</div>
		<div class="form-group col-md-6">
			<label class="small mb-1" for="inputaddress">Postal Code <span style="color:red;font-size:13px"> *</span></label>
			<input class="form-control" id="pincode" name="Profile[pin_code]" type="text" placeholder="Postal Code">
		</div>
	</div>
	
	<div class="form-group">
	<?php if(empty($_GET)):?>
		<input type="radio" name="Users[user_type]" id="user_type" value="1"><span style="font-size: 15px;" > Individual </span>
	<?php endif;?>	<input type="radio" name="Users[user_type]" id="user_type" value="2" required="required" <?= (!empty($_GET) ? 'checked' : '' )?>> <span style="font-size: 15px;" >Corporate Trust Service Provider (CTSP) / Corporate Representative (CR)</span><br>
		<span style="color:red" id="user_type_error"></span>
	</div>
	
	<div class="row">
		<div class="form-group col-md-12">
			<input type="checkbox" id="termcondition" name="termcondition" value="">
			<label for="termcondition"> <a href="#">Terms & Conditions</a></label><br>
			<span style="color:red" id="termconditionerror"></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		<div class="d-flex justify-content-start">
		   <div class="d-flex justify-content-start">
			<span class="captchainput" id="capnum1" name="capnum1"></span>
			<span class="captchainput" id="capsign" name="capsign" style="width:35px !important;">+</span>
			<span class="captchainput" id="capnum2"  name="capnum2"></span>
			<span class=""id="captcharesult"  name="captcharesult"></span>
			<!--input class="captchainput" id="capnum1" name="capnum1" type="text" value="" readonly >
			<input class="captchainput" type="text" id="capsign" name="capsign" value="+" readonly style="width:35px !important;">
			<input class="captchainput" type="text" value="" id="capnum2"  name="capnum2" readonly >
			<input class="" type="hidden" value="" id="captcharesult"  name="captcharesult" readonly -->
		</div>
		<div class="d-flex justify-content-start">
			<p class="mt-3">=</p>
			<input class="form-control" type="text" value="" id="capnum3" name="capnum3" style="width:50px;margin-left:15px;">
			<a  class="mt-3 ml-3" href="javascript:void(0);" onclick="getCaptcha()">Refresh Captcha</a>
		</div>
		</div>
			<span id="captchaerror" style="color:red"></span>
			<span id="captchasuccess" style="color:green"></span>
		</div>
	</div>
	
	  <div class="form-group mt-4 mb-0 text-center">
        <a id="otp_verify" class="btn btn-secondary" href="javascript:void(0);">Register</a>
		<a style="width:auto;display: block;text-align:right;margin-top: -25px;" href="<?php echo  Yii::app()->createUrl('/account/passwordresetrequest'); ?>">Forgot Password?</a>
    </div>
</form>

<form class="reg3" id="otp-form" style="display: none; margin:0 auto; width:32%;">
	<label class="" for="inputEmailAddress">Verify OTP<p id="userotp"></p></label>
	<div class="">
		<div class="form-group">
			<input class="form-control mr-2 otp" id="otp_num1" type="text"
				maxlength="1" style="width:40px;padding:6px 12px;float:left;">
			<input class="form-control mx-2 otp" id="otp_num2" type="text"
				maxlength="1" style="width:40px;padding:6px 12px;float:left;">
			<input class="form-control mx-2 otp" id="otp_num3" type="text"
				maxlength="1" style="width:40px;padding:6px 12px;float:left;">
			<input class="form-control mx-2 otp" id="otp_num4" type="text"
				maxlength="1" style="width:40px;padding:6px 12px;float:left;">
		</div><br><br>
	</div>
	<span id="otperror" style="color:red"></span><br><br>
	<span id="beforesend" style="color:red"></span><br><br>
	<div class="form-group text-center">
		<a id="register_verify" class="btn btn-secondary" href="javascript:void(0);">Verify OTP & Proceed</a></br></br>
		<a href="javascript:void(0);" onclick="sendotp();">Resend OTP</a>
	</div>
</form>



<script src="<?php echo $basePath; ?>/assests/js/signin.js"></script>
<!--script src="<?php //echo $basePath; ?>/assests/js/jquery-1.10.2.js"></script-->
