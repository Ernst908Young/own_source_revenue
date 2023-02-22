<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php  $basePath="/themes/investuk/assets/signin"; ?>
<style>
    .captchainput{
        width:25px;
        border:0;
        background-color: transparent;
    }

    .captchainput:focus{
        box-shadow: 0 !important;
        outline: none;
    }
</style>
<form id="register-form" name="register-form" action="" method="post" role="form" data-toggle="validator" class="sky-form">
	<input type="hidden" name="CALL_BACK_URL" value="<?php echo $CALL_BACK_URL; ?>" />
	<input type="hidden" name="callback_failure_url" value="<?php echo $callback_failure_url; ?>" />
	<input type="hidden" name="callback_success_url" value="<?php echo $callback_success_url; ?>" />
				
    <div class="form-group">
        <label class="small mb-1" for="inputname">Name</label>
        <input class="form-control" id="name" name="name" type="text" placeholder="Name" required="required" maxlength="150" autocomplete="off">
    </div>
	<div class="row">
		<div class="form-group col-md-12">
			<label class="small mb-1" for="inputname">First Name</label>
			<input class="form-control" id="fname" name="fname" type="text" placeholder="First Name">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6">
			<label class="small mb-1" for="inputname">Middle Name</label>
			<input class="form-control" id="mname" name="mname" type="text" placeholder="Middle Name">
		</div>
		<div class="form-group col-md-6">
			<label class="small mb-1" for="inputname">Last Name</label>
			<input class="form-control" id="lname" name="lname" type="text" placeholder="Last Name">
		</div>
		<div class="form-group col-md-12">
			<input type="checkbox" id="mnamechekbox" name="middlechcekbox" value="">
			<label for="middlechcekbox"> I don't have middle name</label>
		</div>
	</div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group"> 
                <label class="small mb-1" for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender" autocomplete="off">
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="small mb-1" for="dob">Date of Birth</label>
                    <input class="form-control" id="dob" name="dob" type="date"  required="required" onchange="checkDob()"autocomplete="off">
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-md-6">
    <div class="form-group">
        <label class="small mb-1" for="mobile">Mobile no.</label>
        <div class="d-flex justify-content-between">
            <input class="form-control" id="countrycode" type="text"
                placeholder="+91" style="width:25%;margin-right:10px" required="required" autocomplete="off">
                <input class="form-control" id="mobile" name="mobile" type="number"
                    placeholder="Mobile no." required="required"  maxlength="10" onkeypress="return isNumberKey(event)" autocomplete="off">    
        </div>
    </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="small mb-1" for="telcountrycode">Telephone(Office)</label>
                <div class="d-flex justify-content-between">
                    
                        <input class="form-control" id="telephone" name="telephone" type="number"
                            placeholder="Telephone(Office)">    
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="small mb-1" for="email">Email Id</label>
        <input class="form-control" id="email" name="email" type="email"
            placeholder="Email Id" required="required" autocomplete="off">
    </div>
	<div class="form-group">
		<label class="small mb-1" for="inputnational">Password</label>
		<input class="form-control" id="password1"name="password1" type="password"
			placeholder="Password">
	</div>
	<div class="form-group">
		<label class="small mb-1" for="inputnational">Confirm Password</label>
		<input class="form-control" id="password2" name="password2" type="password"
			placeholder="Confirm password">
	</div>
    <div class="form-group">
        <label class="small mb-1" for="nationality">Nationality</label>
        <input class="form-control" id="nationality" name="nationality" type="text"
            placeholder="Nationality" required="required" autocomplete="off">
    </div>
    <div class="form-group">
		<label class="small mb-1" for="inputaddress">Registered Address</label>
		<input class="form-control mb-3" id="address1" name="address1" type="text"
			placeholder="Address Line 1">
		<input class="form-control" id="address2" name="address2" type="text"
		placeholder="Address Line 2">
	</div>
	<div class="row">
		<div class="form-group col-md-6">
			<label class="small mb-1" for="inputname">Country</label>
			<select class="form-control" id="country" name="country">
				<option>Select Country</option>
				<option>Country 1</option>
				<option>Country 2</option>
			</select>
		</div>
		<div class="form-group col-md-6">
			<label class="small mb-1" for="inputname">State/Parish</label>
			<select class="form-control" id="state" name="state">
				<option value="">Select State/Parish</option>
				<option value="">State 1</option>
				<option>State 2</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-6">
			<label class="small mb-1" for="inputaddress">City</label>
		<input class="form-control" id="city" name="city" type="text" placeholder="City">
		</div>
		<div class="form-group col-md-6">
			<label class="small mb-1" for="inputaddress">Postal Code</label>
			<input class="form-control" id="pincode" name="pincode" type="text" placeholder="Postal Code">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-md-12">
			<input type="checkbox" id="termcondition" name="termcondition" value="">
			<label for="termcondition"> <a href="#">Terms & Conditions</a></label>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		<div class="d-flex justify-content-start">
		   <div class="d-flex justify-content-start">
			<input class="captchainput" id="capnum1" name="capnum1" type="text" value="1" readonly >
			<input class="captchainput" type="text" id="capsign" name="capsign" value="+" readonly style="width:35px !important;">
			<input class="captchainput" type="text" value="5" id="capnum2"  name="capnum2" readonly >
		</div>
		<div class="d-flex justify-content-start">
			<p class="mt-3">=</p>
			<input class="form-control" type="text" value="6" id="capnum3" name="capnum3" style="width:50px;margin-left:15px;">
			<a  class="mt-3 ml-3" href="#">Refresh Captcha</a>
		</div>
		</div>
			<span>error</span>
		</div>
	</div>
	
	
	
	<!--div class="row">
        <div class="col-md-3">
			<div class="form-group">
				<label class="small mb-1" for="mobile">Captcha</label>
				<div class="d-flex justify-content-between">
					<input id="num1" class="sum" style="width:20%;margin-right:10px;border:none;"  type="text" name="num1" value="<?php echo rand(1,4) ?>" readonly="readonly" />+
						<input id="num2" class="sum" style="width:20%;margin-right:10px;border:none;" type="text" name="num2" value="<?php echo rand(5,9) ?>" readonly="readonly" />=
						<input id="num3" class="sum" style="width:20%;" type="text" name="num3" />
				</div>
			</div>
    </div-->


		<!--div class="g-recaptcha" data-sitekey="6LeySZkbAAAAABsQUyOxqsxu4eGRZADRmYAdBt-H"></div-->

	
    <div
        class="form-group d-flex align-items-center justify-content-center mt-4 mb-0">
        <a id="signin_verify" class="btn btn-secondary" href="javascript:void(0);">Register</a>
    </div>
</form>

<script src="<?php echo $basePath; ?>/assests/js/signin.js"></script>
<!--script src="<?php //echo $basePath; ?>/assests/js/jquery-1.10.2.js"></script-->
