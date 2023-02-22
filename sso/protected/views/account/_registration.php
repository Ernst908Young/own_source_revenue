<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" />
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
<div class="alert alert-primary alert-dismissible fade show" id="success-register-alert" role="alert" style="
    padding: 8%;display:none;
">
OTP Verified. <strong style="color:red;fot-style:bold;">Please check your email for account activation link.</strong>
	
</div>
<form id="register-form" name="register-form" action="" method="post" role="form" data-toggle="validator" class="sky-form">
	<input type="hidden" name="CALL_BACK_URL" value="<?php echo $CALL_BACK_URL; ?>" />
	<input type="hidden" name="callback_failure_url" value="<?php echo $callback_failure_url; ?>" />
	<input type="hidden" name="callback_success_url" value="<?php echo $callback_success_url; ?>" />
				
    
	<p style="color:red; font-size: 12px;">"Fields marked with * are mandatory fields."</p>
	 <input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>"/>
	<div class="row">
		<div class="form-group col-md-6">
			<label class="small mb-1" for="inputname">
				First Name <span style="color:red;font-size:13px"> *</span>
			</label>
			<input class="form-control" id="fname" name="Profile[first_name]" type="text" placeholder="First Name" value="<?= ($_GET['first_name']!='' ? $_GET['first_name'] : '' )?>" >
		</div>
		<div class="form-group col-md-6">
			<label class="small mb-1" for="inputname">Middle Name</label>
			<input class="form-control" id="mname" name="Profile[last_name]" type="text" placeholder="Middle Name"  value="<?= ($_GET['middle_name']!='' ? $_GET['middle_name'] : '' )?>" <?= ($_GET['middle_name']!='' ? 'readonly' : '' )?>>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6">
			<label class="small mb-1" for="inputname">Last Name <span style="color:red;font-size:13px"> *</span></label>
			<input class="form-control" id="lname" name="Profile[surname]" type="text" placeholder="Last Name"  value="<?= ($_GET['surname']!='' ? $_GET['surname'] : '' )?>" >
		</div>
		<?php //if($_GET['middle_name']==""):?>
		<div class="form-group col-md-6">
			<input type="checkbox" id="mnamechekbox" name="middlenamecheckbox"  <?= (isset($_GET['middle_name']) && empty($_GET['middle_name']) ? 'checked' : '' )?> >
			<label for="middlenamecheckbox"> I don't have middle name</label><br>
			<span style="color:red" id="middlenameerror"></span>
		</div>
		<?php //endif;?>
		
	</div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group"> 
                <label class="small mb-1" for="gender">Gender <span style="color:red;font-size:13px"> *</span></label>
                <select class="form-control" id="gender" name="Profile[gender]">
                    <option value="">Select Gender</option>
                    <option value="male" <?= ($_GET['gender']=='Male' ? 'selected': '' )?>>Male</option>
                    <option value="female" <?= ($_GET['gender']=='Female' ? 'selected': '' )?>>Female</option>
                    <option value="other" <?= ($_GET['gender']=='Other' ? 'selected': '' )?>>Other</option>
                </select>
            </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="small mb-1" for="dob">Date of Birth 
						<span style="color:red;font-size:13px"> *</span> 
						<i class="fa fa-question-circle text-info fa-lg" data-html="true" data-toggle="tooltip" title="You must older than 18 or 18+ years to submit this form." style="color: skyblue;"></i></label>
						<input class="form-control" id="dob" name="Profile[dob]" type="date"  required="required" onchange="checkDob()" >
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-md-6">
    <div class="form-group">
        <label class="small mb-1" for="mobile">Mobile No. 
        	<span style="color:red;font-size:13px"> *</span>
        </label>
        <div class="d-flex justify-content-between">
		
                <input class="form-control" id="mobile" onblur="checkMobile()" name="Users[mobile_no]" type="number" placeholder="Mobile No." required="required"  maxlength="10" value="<?= ($_GET['mobile']!='' ? $_GET['mobile'] : '' )?>" <?= ($_GET['mobile']!='' ? 'readonly' : '' )?>>    
        </div>
        <span style="color:red" id="mobspanerror"></span>
    </div>
	
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="small mb-1" for="telcountrycode">Telephone(Office)</label>
                <div class="d-flex justify-content-between">
                    
                        <input class="form-control" id="telephone" name="Profile[telephone]" type="number"
                            placeholder="Telephone(Office)" maxlength="10" value="<?= ($_GET['telephone']!='' ? $_GET['telephone'] : '' )?>">    
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="email">Email Id <span style="color:red;font-size:13px"> *</span><i class="fa fa-question-circle text-info fa-lg" data-html="true" data-toggle="tooltip" title="Please enter the email address in lower case only. This email address will be used to alert and send verification email" style="color: skyblue;"></i></label>
        <input class="form-control" id="email" name="Users[email]" type="email"
            placeholder="Email Id" required="required"  value="<?= ($_GET['email']!='' ? $_GET['email'] : '' )?>" <?= ($_GET['email']!='' ? 'readonly' : '' )?>>
    </div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="small mb-1" for="inputnational">Password <span style="color:red;font-size:13px"> * <i class="fa fa-question-circle text-info fa-lg" data-html="true" data-toggle="tooltip" title="Your password must contain a minimum of 6 characters including with at least 1 upper case letter, 1 number, and 1 special character from !, #, $, ^, %, @, & and *(other special characters are not supported)." style="color: skyblue;"></i></span></label>
				<input class="form-control" id="password1"name="Users[password]" type="password" autocomplete="off"	placeholder="Password"  onblur="checkPassword()">
			</div>
		</div>
	
		<div class="col-md-6">
			<div class="form-group">
				<label class="small mb-1" for="inputnational">Confirm Password <span style="color:red;font-size:13px"> *</span></label>
				<input class="form-control" id="password2" name="confirm_password" type="password" autocomplete="off"
					placeholder="Confirm password" onblur="checkConfirmPassword()" >
			</div>
		</div>
	</div>
    
    <div class="form-group">
		<label class="small mb-1" for="inputaddress">Registered Address <span style="color:red;font-size:13px"> *</span></label>
		<input class="form-control mb-3" id="address1" name="Profile[address]" type="text"
			placeholder="Address Line 1" value="<?= ($_GET['address']!='' ? $_GET['address'] : '' )?>">
		<input class="form-control" id="address2" name="Profile[address2]" type="text"
		placeholder="Address Line 2" value="<?= ($_GET['address2']!='' ? $_GET['address2'] : '' )?>">
	</div>
	<div class="row">
		<div class="form-group col-md-4">
			<label class="small mb-1" for="nationality">Nationality <span style="color:red;font-size:13px"> *</span></label>
			<?php $country =Yii::app()->db->createCommand("SELECT lr.lr_id,lr.lr_name FROM bo_landregion lr WHERE lr.lr_type='country' and  lr.is_lr_active='Y' ORDER BY lr.lr_name ASC")->queryAll(); 

				?>
				<select id='nationality' name='Profile[nationality]' class='register-sbox form-control' required='required'>

				<option value='' selected disabled>Nationality</option>					
				<?php	 
					foreach ($country as $n){ 
				?>
				<option value="<?= $n['lr_id'] ?>">
					<?= $n['lr_name'] ?>
				</option>
					
					
			<?php	} ?>
			</select>
		
		</div>
		 <input type="hidden" id="csrf_token" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>"/>
		 
		<div class="form-group col-md-4">
			<label class="small mb-1" for="inputname">Country <span style="color:red;font-size:13px"> *</span></label>
			<!--select class="form-control" id="country" name="Profile[country_name]">
				<option>Select Country</option>
				<option value="1">Country 1</option>
				<option value="2">Country 2</option>
			</select-->
			
				<select id='country' name=Profile[country_name] class='register-sbox form-control' required='required'>

				<option value='' selected disabled>Country</option>					
				<?php	 
				$param_country = $_GET['country_name'] ? $_GET['country_name'] : '';
				foreach ($country as $cv){ 
				$select_country = $cv['lr_id'] == $param_country ? 'selected' : ''
					?>
				<option value="<?= $cv['lr_id'] ?>" <?= $select_country ?>>
					<?= $cv['lr_name'] ?>
						
					</option>
					
					
			<?php	} ?>
			</select>
		</div>
		<div class="form-group col-md-4">
			<label class="small mb-1" for="inputname">State/Parish <span style="color:red;font-size:13px"> *</span></label>

	<?php 	
	if($_GET['state_name']){
		$state =Yii::app()->db->createCommand("SELECT lr.lr_id,lr.lr_name FROM bo_landregion lr WHERE lr.lr_type='state' and parent_id=$param_country and  lr.is_lr_active='Y'")->queryAll();  ?>
		<select id='state' name="Profile[state_name]" class='register-sbox form-control' required='required'>

					<option value="" selected disabled>State</option>
				<?php	 
				$param_state = $_GET['state_name'] ;
				foreach ($state as $sv){ 
				$select_state = $sv['lr_id'] == $param_state ? 'selected' : ''
					?>
				<option value="<?= $sv['lr_id'] ?>" <?= $select_state ?>>
					<?= $sv['lr_name'] ?>
						
					</option>
					
					
			<?php	} ?>
			</select>


	<?php }else{ ?>
		<select required="required" id="state" onclick="checkcountry()" name="Profile[state_name]" class="register-sbox form-control">
				<option value="" selected disabled>State</option>
			</select>
<?php	} ?>
	</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6">
			<label class="small mb-1" for="inputaddress">City </label>
		<input class="form-control" id="city" name="Profile[city_name]" type="text" placeholder="City" value="<?= ($_GET['city_name']!='' ? $_GET['city_name'] : '' )?>">
		</div>
		<div class="form-group col-md-6">
			<label class="small mb-1" for="inputaddress">Postal Code </label>
			<input class="form-control" id="pincode" name="Profile[pin_code]" type="text" placeholder="Postal Code" value="<?= ($_GET['pin_code']!='' ? $_GET['pin_code'] : '' )?>">
		</div>
	</div>
	
	<div class="form-group">
	<?php if(empty($_GET)):?>
		<input type="radio" name="Users[user_type]" id="user_type" value="1">
			<span style="font-size: 15px;" > Applicant </span>
	 <?php endif;?>	
	 <input type="radio" name="Users[user_type]" id="user_type" value="2" required="required" <?= (!empty($_GET) ? 'checked' : '' )?>  style=""> <span style="font-size: 15px;" >GP Assistance</span> 
	
		<span style="color:red" id="user_type_error" ></span> 
	</div>




	<?php if(empty($_GET)):?>
	<div class="form-group" id="sp_radio_btn_div" style="display: none">
	<?php else:?>
	<div class="form-group" id="sp_radio_btn_div">
	
	<?php endif;?>

	<?php 

	if($_GET['sp_type']){
		if($_GET['sp_type'] == 'Corporate Trust Service Provider (CTSP)'){
			$cr =  ''; $cr_show = 'none';
			$ctsp = 'checked';  $ctsp_show = '';
			$subuser = ''; $subuser_show = 'none';			
			$lin_comp_name = '';
		}else{
			if($_GET['sp_type'] == 'Corporate Representative (CR)'){
				$cr =  'checked'; $cr_show = '';
				$ctsp = ''; $ctsp_show = 'none';
				$subuser = ''; $subuser_show = 'none';				 	
			 	$lin_comp_name = 'none';
			}else{
				if($_GET['sp_type'] == 'Sub User'){
					$cr =  ''; $cr_show = 'none';
					$ctsp = ''; $ctsp_show = 'none';
					$subuser = 'checked'; $subuser_show = '';				 	
				 	$lin_comp_name = 'none';
				}else{
					$cr =  $ctsp = $subuser = '';
					$cr_show = $ctsp_show = $subuser_show = '';
					$lin_comp_name = 'none';
				}
			}
		}

	}else{
		$cr =  $ctsp = $subuser = '';
		$cr_show = $ctsp_show = $subuser_show ='';

		$lin_comp_name = 'none';
	}
	?>


		<!--div class="row">
			
			<div class="col-md-6">
				<div class="form-group">
					<label class="small mb-1" for="telcountrycode">Entity Type</label>
					<div class="d-flex justify-content-between">
						<input class="form-control" id="entity_type" name="entity_type" type="text"
								placeholder="Entity Type" value="<?= ($_GET['entity_type']!='' ? $_GET['entity_type'] : '' )?>">    
					</div>
				</div>
			</div>
		</div-->
		<label class="small mb-1" for="inputaddress">Type of Representative<span style="color:red;font-size:13px"> *</span></label><br>

    <span style="display: <?= $cr_show ?>;">
		<input type="radio" name="Users[user_sp_type]" id="user_sp_type" value="Corporate Representative (CR)"><span style="font-size: 15px;" <?= $cr ?>> Corporate Representative (CR) </span>
	</span>
	 <span style="display: <?= $ctsp_show ?> ;">
		<input type="radio" name="Users[user_sp_type]" id="user_sp_type" value="Corporate Trust Service Provider (CTSP)" required="required" <?= $ctsp ?>> <span style="font-size: 15px;" >Corporate Trust Service Provider (CTSP)</span>
	</span>
	 <span style="display: <?= $subuser_show ?> ;">
		<input type="radio" name="Users[user_sp_type]" id="user_sp_type" value="Sub User" required="required" <?= $subuser ?>> <span style="font-size: 15px;" >Sub User</span>
	</span>
	
		<br>
		<span style="color:red" id="sp_type_error"></span>
	</div>



	<div class="form-group" id="ctsp_div" style="display: none;">	

	
		<label class="small mb-1">Company / Business Name<span style="color:red;font-size:13px"> *</span></label>
	
		<input class="form-control" id="entity_name" name="entity_name" type="text"
			placeholder="Company / Business Name" value="<?= ($_GET['entity_name']!='' ? $_GET['entity_name'] : '' )?>">    
				
				<br>
<span style="color:red" id="entity_name_error"></span>
      	<label class="small mb-1">
      		Licence Number
      		<!-- <span style="color:red;font-size:13px"> *</span> -->
      	</label><br>
      <input type="text" class="form-control" placeholder="Enter Licence Number" id="lic_no" name="lic_no" > 		
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
			<p><b>Solve this captcha to register</b></p>
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
	
	</div>
	<div>			
			<span id="captchaerror" style="color:red"></span>
			<span id="captchasuccess" style="color:green"></span>
		</div>
</div>
	  <div class="form-group mt-4 mb-0 text-center">
        <a id="otp_verify" class="btn btn-secondary" href="javascript:void(0);">Register</a>
		
    </div>
</form>


<form class="reg3" id="otp-form" style="display: none; margin:0 auto;">
<div style="font-size: 20px;font-weight: bold;">OTP Verification</div>
<label class="" for="inputEmailAddress">Enter the otp we just sent on your email id <strong style="color: #d46c1a;;" id="otp_email"></strong><p id="userotp"></p></label>
	<!--label class="" for="inputEmailAddress">OTP has been sent to your Email ID. Please enter your OTP<p id="userotp"></p></label-->
	<div>
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

	<div class="form-group">
		<a id="register_verify" class="btn btn-secondary" href="javascript:void(0);">Verify OTP</a> &nbsp;
		<span style="color: green;font-weight: bold;" id="timer">05:00</span>
		<a href="javascript:void(0);" onclick="sendotp();" id="resent_otp_btn" class="btn btn-secondary">Resend OTP</a>
	</div>
	</div>
</form>


<script>
	function checkcountry(){
 		var country = $("#country").val();
 		$(".errors").remove();
 		if(country){

 		}else{ 			
 			$("#country").after("<span class='errors' style='color:red;'>Select Country First</span>");
 		}
 	}
 $(function() {

 	$("#address1, #address2").bind("keypress",function(){
	var regex=  new RegExp("^[ A-Za-z0-9(),.&:;-]*$"); //;
	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       return false
    }
});



	$("input[id='user_type']").change(function() {
		if($("input[id=user_type]").is(':checked')){
			if($(this).val()==2){
				$("#ctsp_div").show();
			}
			else{
				$("#ctsp_div").hide();
				$("input[id=user_sp_type]").prop('checked', false);
				
			}
		}	
	});
	
	$("input[id='user_sp_type']").change(function() {
		if($("input[id=user_sp_type]").is(':checked')){
			$("#sp_type_error").text("");
			if($(this).val()=='Corporate Trust Service Provider (CTSP)'){
				$("#ctsp_div").show();
			}else{
				$("#ctsp_div").hide();
			}			
		}
	});
	
 });
 
 function uploaddoc(){
 	
  var file_data = $("#input-id").prop("files")[0]; 
  var form_data = new FormData(); 
  form_data.append("file", file_data) 
  form_data.append("user_email", $('#email').val()) 
  $.ajax({
    url: "/sso/account/updoc", 
    dataType: 'json',
    cache: false,
    contentType: false,
    processData: false,
    data: form_data, 
    type: 'post',
    beforeSend: function(){
    	$("#pre_div").html("<span style='color:red;'>Please wait while uploading document...</span>");
    },
    success: function(data) {
       if(data.status) { 
       			$("#pre_div").html('<a href="'+data.file_url+'" target="_blank"  title="Click to see uploaded document">Preview</a>');            
            }else{
            	alert("Sorry! something went wrong please try again");
            } 
    }
  });

 }
 
 
 
</script>

<!--script src="<?php echo $basePath; ?>/assests/js/signin.js"></script-->
<script src="/panchayatiraj/themes/investuk/assets/signin/assests/js/register.js"></script>
<!--script src="<?php //echo $basePath; ?>/assests/js/jquery-1.10.2.js"></script-->
