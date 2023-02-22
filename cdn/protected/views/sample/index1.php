<h3>Investor Registration Form :: Sample</h3>
<?php
$readonly=$disabled='';
if(!$is_valid_sso_token){
	$readonly=' readonly="readonly" ';
	$disabled=' disabled="disabled" ';
?> 
<form method="post" action="<?=SSO_URL3?>">
	<div class="form-horizontal">
		<div class="control-group">
	 		<div class="controls">

	 			<h5>Please Authenticate via SSO to continue.</h5>		
	 			<div class="row">&nbsp;</div>	
				<input type="submit" class="btn btn-danger" value="LOGIN" />
				<input type="hidden" name="CALL_BACK_URL" value="<?=$CALL_BACK_URL?>" />
				<input type="hidden" name="CALLBACK_FAILURE_URL" value="<?=$CALL_BACK_URL?>" />
				<input type="hidden" name="CALLBACK_SUCCESS_URL" value="<?=$CALL_BACK_URL?>" />
				<input type="hidden" name="HMAC_HASH" value="<?=$HMAC_HASH?>" />
				<input type="hidden" name="SP_TAG" value="<?=$SP_TAG?>" />
				<div class="row">&nbsp;</div><div class="row">&nbsp;</div>
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
				<input <?=$readonly?> class="input-xxlarge" name="full_name" id="full_name" value="<?=@$full_name?>" type="text" placeholder="Name of Applicant" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Corresponding Address</label>
			<div class="controls">
				<textarea <?=$readonly?> class="input-xxlarge" type="text" name="corresponding_address" id="corresponding_address" placeholder="Corresponding Address"></textarea>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Street Address</label>
			<div class="controls">
				<input <?=$readonly?> class="input-xxlarge" name="street_address" id="street_address" type="text" placeholder="Street Address" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Address Line 2</label>
			<div class="controls">
				<input <?=$readonly?> class="input-xxlarge" name="address2" id="address2" type="text" placeholder="Address Line 2" />
			</div>
		</div>
					
		<div class="control-group">
			<label class="control-label">City</label>
			<div class="controls">
				<input <?=$readonly?> class="input-xxlarge" name="city" id="city" type="text" placeholder="City" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">State</label>
			<div class="controls">
				<input <?=$readonly?> class="input-xxlarge" name="state" id="state" type="text" placeholder="State" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Pin Code</label>
			<div class="controls">
				<input <?=$readonly?> class="input-xxlarge" name="pincode" id="pincode" type="text" placeholder="Pin Code" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Country</label>
			<div class="controls">
				<input <?=$readonly?> class="input-xxlarge" name="country" id="country" type="text" placeholder="Country" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Phone</label>
			<div class="controls">
				<input <?=$readonly?> class="input-xxlarge" name="phone" id="phone" type="text" placeholder="Phone" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Fax</label>
			<div class="controls">
				<input <?=$readonly?> class="input-xxlarge" name="fax" id="fax" type="text" placeholder="Fax" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">E-mail</label>
			<div class="controls">
				<input <?=$readonly?> class="input-xxlarge" name="email" value="<?=@$email?>" id="email" type="text" placeholder="E-mail" />
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">Mobile</label>
			<div class="controls">
				<input <?=$readonly?> class="input-xxlarge" name="mobile" value="<?=@$mobile?>" id="mobile" type="text" placeholder="Mobile" />
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