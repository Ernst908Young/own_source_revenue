<h3>Investor Registration Form :: DEMO</h3>
<style type="text/css">
	.error{
		color:#ff0000;
		font-weight:200;
	}
</style>
<?php
if(isset($RESPONSE)){
extract($RESPONSE);
$full_name=$first_name." ".$last_name;	
}
if(isset($_POST['msg'])){
	echo "<font color='red'>$_POST[msg]</font>";
}
//echo "<pre>"; print_r($RESPONSE); echo "</pre>";
$readonly=$disabled='';
if(!$is_valid_sso_token){
	$readonly=' readonly="readonly" ';
	$disabled=' disabled="disabled" ';
	if(isset($error) && !empty($error)){
		echo "<div class='error'>$error</div>";
	}
?> 
<form method="post" action="<?=SSO_URL3?>">
	<div class="form-horizontal">
		<div class="control-group">
	 		   <h5>Please Authenticate via SSO to continue.</h5>			
	 			<div class="form-group">
				<input type="submit" class="btn btn-danger" value="Login via SSO" />
				<input type="hidden" name="CALL_BACK_URL" value="<?=$CALL_BACK_URL?>" />
				<input type="hidden" name="CALLBACK_FAILURE_URL" value="<?=$CALL_BACK_URL?>" />
				<input type="hidden" name="CALLBACK_SUCCESS_URL" value="<?=$CALL_BACK_URL?>" />
				<input type="hidden" name="HMAC_HASH" value="<?=$HMAC_HASH?>" />
				<input type="hidden" name="SP_TAG" value="<?=$SP_TAG?>" />
			</div>
		</div>
	</div>	
</form>
<?php
}
else{
?>

<div class="form-horizontal">
	<form method="post">
		 <div class="control-group">
			<label class="control-label">Name of Applicant</label>
			<div class="controls">
				<input <?=$readonly?> class="form-control" name="full_name" id="full_name" value="<?=@$full_name?>" type="text" placeholder="Name of Applicant" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Corresponding Address</label>
			<div class="controls">
				<input <?=$readonly?> class="form-control" value="<?=@$address?>" name="address" id="address" type="text" placeholder="Corresponding Address" />
			</div>
		</div>
					
		<div class="control-group">
			<label class="control-label">City</label>
			<div class="controls">
				<input <?=$readonly?> class="form-control" value="<?=@$city_name?>" name="city" id="city" type="text" placeholder="City" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">State</label>
			<div class="controls">
				<input <?=$readonly?> class="form-control" value="<?=@$state_name?>" name="state" id="state" type="text" placeholder="State" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Pin Code</label>
			<div class="controls">
				<input <?=$readonly?> class="form-control" value="<?=@$pin_code?>"  name="pincode" id="pincode" type="text" placeholder="Pin Code" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Country</label>
			<div class="controls">
				<input <?=$readonly?> class="form-control" value="<?=@$country_name?>"  name="country" id="country" type="text" placeholder="Country" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Phone</label>
			<div class="controls">
				<input <?=$readonly?> class="form-control" name="phone" id="phone" type="text" placeholder="Phone" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Fax</label>
			<div class="controls">
				<input <?=$readonly?> class="form-control" name="fax" id="fax" type="text" placeholder="Fax" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">E-mail</label>
			<div class="controls">
				<input <?=$readonly?> class="form-control" name="email" value="<?=@$email?>" id="email" type="text" placeholder="E-mail" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Mobile</label>
			<div class="controls">
				<input <?=$readonly?> class="form-control" name="mobile" value="<?=@$mobile_number?>" id="mobile" type="text" placeholder="Mobile" />
			</div>
		</div>
		
		<div class="control-group">
			<div class="controls">
				<input <?=$disabled?>  type="submit" class="btn btn-success" value="Register" />
			</div>
		</div>

	</form>
</div>
<?php } ?>